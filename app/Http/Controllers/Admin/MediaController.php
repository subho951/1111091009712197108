<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use App\Models\GeneralSetting;
use App\Models\User;
use App\Models\Institute;
use App\Models\Category;
use App\Models\Media;

use Auth;
use Session;
use Helper;
use Hash;

class MediaController extends Controller
{
    public function __construct()
    {        
        $this->data = array(
            'title'             => 'Media',
            'controller'        => 'MediaController',
            'controller_route'  => 'media',
            'primary_key'       => 'id',
        );
    }
    /* list */
        public function list(){
            $data['module']                 = $this->data;
            $title                          = $this->data['title'].' List';
            $page_name                      = 'media.institute-list';
            $data['institutes']             = Institute::where('status', '!=', 3)->orderBy('id', 'DESC')->get();
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
        public function categoryList($institute_id){
            $institute_id                   = Helper::decoded($institute_id);
            $data['institute_id']           = $institute_id;
            $data['module']                 = $this->data;
            $title                          = $this->data['title'].' List';
            $page_name                      = 'media.category-list';
            $data['cats']                   = Category::where('status', '!=', 3)->where('institute_id', '=', $institute_id)->orderBy('id', 'DESC')->get();
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
        public function mediaList($institute_id, $category_id){
            $institute_id                   = Helper::decoded($institute_id);
            $category_id                    = Helper::decoded($category_id);

            $data['institute_id']           = $institute_id;
            $data['category_id']            = $category_id;

            $data['module']                 = $this->data;
            $title                          = $this->data['title'].' List';
            $page_name                      = 'media.media-list';
            $data['cats']                   = Category::where('status', '!=', 3)->where('institute_id', '=', $institute_id)->orderBy('id', 'DESC')->get();
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
    /* list */
    /* add */
        public function add(Request $request){
            $data['module']           = $this->data;
            $generalSetting             = GeneralSetting::find('1');

            if($request->isMethod('post')){
                $request->validate([
                    'name'          => 'required|string|max:255|unique:users,name',
                    'news_date'     => 'required|date',
                    'photo'         => 'required|image|mimes:jpg,jpeg,png|max:' . $generalSetting->photo_size,
                    'description'   => 'required|string|max:500',
                    'mag_file'      => 'required|file|mimes:pdf|max:' . $generalSetting->document_size,
                ]);

                /** Photo Upload */
                $photoName = time().'_'.$request->photo->getClientOriginalName();
                $request->photo->move(public_path('uploads/magazine'), $photoName);

                /** file Upload */
                $magfileName = time().'_'.$request->mag_file->getClientOriginalName();
                $request->mag_file->move(public_path('uploads/magazine'), $magfileName);

                Media::create([
                    'name'              => $request->name,
                    'news_date'         => $request->news_date,
                    'photo'             => $photoName,
                    'mag_file'          => $magfileName,
                    'description'       => $request->description,
                ]);

                return redirect('admin/'.$this->data['controller_route'] . "/list")->with('success_message', $this->data['title'].' added successfully !!!');
            }
            $data['module']                 = $this->data;
            $title                          = $this->data['title'].' Add';
            $page_name                      = 'media.add-edit';
            $data['row']                    = [];
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
    /* add */
    /* edit */
        public function edit(Request $request, $id){
            $data['module']                 = $this->data;
            $id                             = Helper::decoded($id);
            $title                          = $this->data['title'].' Update';
            $page_name                      = 'media.add-edit';
            $data['row']                    = Media::where($this->data['primary_key'], '=', $id)->first();
            $generalSetting                 = GeneralSetting::find('1');

            if($request->isMethod('post')){
                $member = Media::findOrFail($id);

                $request->validate([
                    'name'          => 'required|string|max:255|unique:users,name',
                    'news_date'     => 'required|date',
                    'photo'         => 'nullable|image|mimes:jpg,jpeg,png|max:' . $generalSetting->photo_size,
                    'description'   => 'required|string|max:500',
                    'mag_file'      => 'nullable|file|mimes:pdf|max:' . $generalSetting->document_size,
                ]);

                /** Photo Update */
                if ($request->hasFile('photo')) {
                    $oldPath = public_path('uploads/magazine/'.$member->photo);
                    if (File::exists($oldPath)) {
                        File::delete($oldPath);
                    }

                    $photoName = time().'_'.$request->photo->getClientOriginalName();
                    $request->photo->move(public_path('uploads/magazine'), $photoName);
                    $member->photo = $photoName;
                }

                /** file Update */
                if ($request->hasFile('mag_file')) {
                    $oldPath2 = public_path('uploads/magazine/'.$member->mag_file);
                    if (File::exists($oldPath2)) {
                        File::delete($oldPath2);
                    }

                    $magfileName = time().'_'.$request->mag_file->getClientOriginalName();
                    $request->mag_file->move(public_path('uploads/magazine'), $magfileName);
                    $member->mag_file = $magfileName;
                }

                $member->update([
                    'name'              => $request->name,
                    'news_date'         => $request->news_date,
                    'description'       => $request->description,
                ]);

                return redirect('admin/'.$this->data['controller_route'] . "/list")->with('success_message', $this->data['title'].' updated successfully !!!');
            }
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
    /* edit */
    /* delete */
        public function delete(Request $request, $id){
            $id                             = Helper::decoded($id);
            $fields = [
                'status'             => 3
            ];
            Media::where($this->data['primary_key'], '=', $id)->update($fields);
            return redirect('admin/'.$this->data['controller_route'] . "/list")->with('success_message', $this->data['title'].' deleted successfully !!!');
        }
    /* delete */
    /* change status */
        public function change_status(Request $request, $id){
            $id                             = Helper::decoded($id);
            $model                          = Media::find($id);
            if ($model->status == 1)
            {
                $model->status  = 0;
                $msg            = 'deactivated';
            } else {
                $model->status  = 1;
                $msg            = 'activated';
            }            
            $model->save();
            return redirect('admin/'.$this->data['controller_route'] . "/list")->with('success_message', $this->data['title'].' '.$msg.' successfully !!!');
        }
    /* change status */
}
