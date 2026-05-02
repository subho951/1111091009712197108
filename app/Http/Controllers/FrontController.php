<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Services\OpenAiAuth;
use App\Services\AuthorizeNetService;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
use Illuminate\Http\Request;
use PHPExperts\RESTSpeaker\RESTSpeaker;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\Country;
use App\Models\GeneralSetting;
use App\Models\Category;
use App\Models\UserActivity;
use App\Models\User;
use App\Models\Page;
use App\Models\Event;
use App\Models\Magazine;
use App\Models\News;
use App\Models\Institute;
use App\Models\EmailLog;
use App\Models\DeleteAccountRequest;

use Auth;
use Session;
use Helper;
use Hash;
use DB;
use Dompdf\Dompdf;
use Dompdf\Options;

date_default_timezone_set("Asia/Calcutta");

class FrontController extends Controller
{  
    /* authentication */
        public function signin(Request $request)
        {
            // 👇 If already logged in (session OR remember cookie), go home
            if (Auth::check()) {
                return redirect('home');
            }

            if ($request->isMethod('post')) {
                $postData = $request->all();
                // Helper::pr($postData);
                $rules = [
                    'phone'     => 'required|max:10',
                    'password'  => 'required|max:30',
                ];
                if ($this->validate($request, $rules)) {
                    if (Auth::guard('web')->attempt([
                                                        'phone'    => $request->phone,
                                                        'password' => $request->password,
                                                        'status'   => 1
                                                    ], true)) {
                        // Helper::pr(Auth::guard('web')->user());

                        User::where('id', Auth::id())->update([
                            'last_login_at' => now(),
                        ]);

                        $sessionData = Auth::guard('web')->user();
                        $request->session()->put('user_id', $sessionData['id']);
                        $request->session()->put('name', $sessionData['name']);
                        $request->session()->put('email', $sessionData['email']);
                        $request->session()->put('phone', $sessionData['phone']);
                        // Helper::pr($request->session()->all());die;

                        /* user activity */
                        $activityData = [
                            'user_email'        => $sessionData['email'],
                            'user_name'         => $sessionData['name'],
                            'user_type'         => 'USER',
                            'ip_address'        => $request->ip(),
                            'activity_type'     => 1,
                            'activity_details'  => 'Signin Success !!!',
                            'platform_type'     => 'WEB',
                        ];
                        UserActivity::insert($activityData);
                        /* user activity */
                        $redirectURL = url('home');
                        return redirect($redirectURL);
                    } else {
                        /* user activity */
                        $activityData = [
                            'user_email'        => $postData['phone'],
                            'user_name'         => '',
                            'user_type'         => 'USER',
                            'ip_address'        => $request->ip(),
                            'activity_type'     => 0,
                            'activity_details'  => 'Invalid Email Or Password !!!',
                            'platform_type'     => 'WEB',
                        ];
                        UserActivity::insert($activityData);
                        /* user activity */
                        return redirect()->back()->with('error_message', 'Invalid Email Or Password !!!');
                    }
                } else {
                    return redirect()->back()->with('error_message', 'All Fields Required !!!');
                }
            }
            
            $data = [];
            $title                          = 'Sign In';
            $page_name                      = 'signin';
            echo $this->front_before_login_layout($title, $page_name, $data);
        }
        public function signout(Request $request)
        {
            $user_email                             = $request->session()->get('email');
            $user_name                              = $request->session()->get('name');
            /* user activity */
            $activityData = [
                'user_email'        => $user_email,
                'user_name'         => $user_name,
                'user_type'         => 'USER',
                'ip_address'        => $request->ip(),
                'activity_type'     => 2,
                'activity_details'  => 'You Are Successfully Logged Out !!!',
                'platform_type'     => 'WEB',
            ];
            // Helper::pr($activityData);
            UserActivity::insert($activityData);
            /* user activity */
            $request->session()->forget(['user_id', 'name', 'email', 'phone']);
            // Helper::pr(session()->all());die;
            Auth::guard('web')->logout();
            return redirect('/')->with('success_message', 'You Are Successfully Logged Out !!!');
        }
    /* authentication */

    /* forgot password */
        public function forgotPassword(Request $request)
        {
            if ($request->isMethod('post')) {
                $postData = $request->all();
                $rules = [
                    'email'     => 'required|email|max:255'
                ];
                if ($this->validate($request, $rules)) {
                    $email      = $postData['email'];
                    $checkUser  = User::where('email', '=', $email)->first();
                    if ($checkUser) {
                        $signin_otp = rand(1000, 9999);
                        $postData = [
                            'signin_otp'        => $signin_otp,
                        ];
                        User::where('id', '=', $checkUser->id)->update($postData);
                        /* email sent */
                        $generalSetting              = GeneralSetting::find('1');
                        $message                     = str_replace("{{otp1}}", substr($signin_otp, 0, 1), $generalSetting->email_template_forgot_password);
                        $message1                    = str_replace("{{otp2}}", substr($signin_otp, 1, 1), $message);
                        $message2                    = str_replace("{{otp3}}", substr($signin_otp, 2, 1), $message1);
                        $message3                    = str_replace("{{otp4}}", substr($signin_otp, 3, 1), $message2);
                        $subject                     = $generalSetting->site_name . ' :: Forgot Password OTP';
                        $this->sendMail($checkUser->email, $subject, $message3);
                        /* email sent */
                        /* email log save */
                        $postData2 = [
                            'name'                  => $checkUser->name,
                            'email'                 => $checkUser->email,
                            'subject'               => $subject,
                            'message'               => $message3
                        ];
                        EmailLog::insertGetId($postData2);
                        /* email log save */
                        return redirect('validate-otp/' . Helper::encoded($checkUser->id))->with('success_message', 'OTP Is Send To Your Registered Email !!!');
                    } else {
                        return redirect()->back()->with('error_message', 'You Are Not Registered With Us !!!');
                    }
                } else {
                    return redirect()->back()->with('error_message', 'All Fields Required !!!');
                }
            }
            $data                           = [];
            $title                          = 'Forgot Password';
            $page_name                      = 'forgot-password';
            echo $this->front_before_login_layout($title, $page_name, $data);
        }
        public function validateOTP(Request $request, $id)
        {
            if ($request->isMethod('post')) {
                $postData = $request->all();
                $rules = [
                    'otp1'     => 'required|max:4',
                    // 'otp2'     => 'required|max:1',
                    // 'otp3'     => 'required|max:1',
                    // 'otp4'     => 'required|max:1',
                ];
                if ($this->validate($request, $rules)) {
                    $id     = $postData['id'];
                    $otp1   = $postData['otp1'];
                    // $otp2   = $postData['otp2'];
                    // $otp3   = $postData['otp3'];
                    // $otp4   = $postData['otp4'];
                    $otp    = ($otp1);
                    $checkUser = User::where('id', '=', $id)->first();
                    if ($checkUser) {
                        $signin_otp = $checkUser->signin_otp;
                        if ($signin_otp == $otp) {
                            $postData = [
                                'signin_otp'        => '',
                            ];
                            User::where('id', '=', $checkUser->id)->update($postData);
                            return redirect('reset-password/' . Helper::encoded($checkUser->id))->with('success_message', 'OTP Validated. Now Reset Your Password !!!');
                        } else {
                            return redirect()->back()->with('error_message', 'OTP Mismatched !!!');
                        }
                    } else {
                        return redirect()->back()->with('error_message', 'We Don\'t Recognize You !!!');
                    }
                } else {
                    return redirect()->back()->with('error_message', 'All Fields Required !!!');
                }
            }
            $id                             = Helper::decoded($id);
            $data['id']                     = $id;
            $title                          = 'Validate OTP';
            $page_name                      = 'validate-otp';
            echo $this->front_before_login_layout($title, $page_name, $data);
        }
        public function resetPassword(Request $request, $id)
        {
            if ($request->isMethod('post')) {
                $postData = $request->all();
                $rules = [
                    'password'              => 'required',
                    'confirm_password'      => 'required'
                ];
                if ($this->validate($request, $rules)) {
                    $id                 = $postData['id'];
                    $password           = $postData['password'];
                    $confirm_password   = $postData['confirm_password'];
                    $checkUser = User::where('id', '=', $id)->first();
                    if ($checkUser) {
                        if ($password == $confirm_password) {
                            $postData = [
                                'password'            => Hash::make($password),
                                'original_password'   => $password,
                            ];
                            User::where('id', '=', $checkUser->id)->update($postData);
                            /* email sent */
                            $generalSetting              = GeneralSetting::find('1');
                            $message                     = str_replace("{{name}}", $checkUser->name, $generalSetting->email_template_change_password);
                            $message1                    = str_replace("{{email}}", $checkUser->email, $message);
                            $subject                     = $generalSetting->site_name . ' :: Reset Password';
                            $this->sendMail($checkUser->email, $subject, $message1);
                            /* email sent */
                            /* email log save */
                            $postData2 = [
                                'name'                  => $checkUser->name,
                                'email'                 => $checkUser->email,
                                'subject'               => $subject,
                                'message'               => $message1
                            ];
                            EmailLog::insertGetId($postData2);
                            /* email log save */
                            return redirect('/')->with('success_message', 'Password Reset Successfully. Please Sign In !!!');
                        } else {
                            return redirect()->back()->with('error_message', 'Password & Confirm Password Does Not Matched !!!');
                        }
                    } else {
                        return redirect()->back()->with('error_message', 'We Don\'t Recognize You !!!');
                    }
                } else {
                    return redirect()->back()->with('error_message', 'All Fields Required !!!');
                }
            }
            $id                             = Helper::decoded($id);
            $data['id']                     = $id;
            $title                          = 'Reset Password';
            $page_name                      = 'reset-password';
            echo $this->front_before_login_layout($title, $page_name, $data);
        }
    /* forgot password */

    /* change password */
        public function changePassword(Request $request)
        {
            $user = Auth::guard('web')->user();
            if (!$user) {
                return redirect('/')->with('error_message', 'Please sign in first !!!');
            }

            if ($request->isMethod('post')) {
                $rules = [
                    'current_password' => 'required',
                    'new_password'     => 'required|min:6',
                    'confirm_password' => 'required',
                ];

                if ($this->validate($request, $rules)) {
                    $postData = $request->all();

                    if (!Hash::check($postData['current_password'], $user->password)) {
                        return redirect()->back()->with('error_message', 'Current Password Does Not Matched !!!');
                    }

                    if ($postData['new_password'] != $postData['confirm_password']) {
                        return redirect()->back()->with('error_message', 'New Password & Confirm Password Does Not Matched !!!');
                    }

                    User::where('id', '=', $user->id)->update([
                        'password'          => Hash::make($postData['new_password']),
                        'original_password' => $postData['new_password'],
                    ]);

                    return redirect('change-password')->with('success_message', 'Password Changed Successfully !!!');
                }

                return redirect()->back()->with('error_message', 'All Fields Required !!!');
            }

            $data       = [];
            $title      = 'Change Password';
            $page_name  = 'change-password';
            echo $this->front_after_login_layout($title, $page_name, $data);
        }
    /* change password */
    
    /* after login */
        /* home */
            public function home(Request $request)
            {
                $user_id                        = session('user_id');
                $data['events']                 = Event::select('id', 'title', 'venue', 'event_date', 'photo')->where('status', '=', 1)->where('event_date', '>', date('Y-m-d'))->orderBy('id', 'DESC')->get();
                $data['page_content']           = Page::select('page_title', 'long_description')->where('slug', '=', 'about-us')->first();
                $title                          = 'Home';
                $page_name                      = 'home';
                echo $this->front_after_login_layout($title, $page_name, $data);
            }
        /* home */
        /* page */
            public function page(Request $request, $slug)
            {
                $user_id                        = session('user_id');
                $data['page_content']           = Page::select('page_title', 'long_description')->where('slug', '=', $slug)->first();
                $title                          = (($data['page_content'])?$data['page_content']->page_title:'');
                $page_name                      = 'page-content';
                echo $this->front_after_login_layout($title, $page_name, $data);
            }
        /* page */
        /* events */
            public function events(Request $request)
            {
                $user_id                        = session('user_id');
                $data['upcoming_events']        = Event::select('id', 'title', 'venue', 'event_date', 'photo')->where('status', '=', 1)->where('event_date', '>', date('Y-m-d'))->orderBy('id', 'DESC')->get();
                $data['past_events']            = Event::select('id', 'title', 'venue', 'event_date', 'photo')->where('status', '=', 1)->where('event_date', '<=', date('Y-m-d'))->orderBy('id', 'DESC')->get();
                $title                          = 'Events';
                $page_name                      = 'events';
                echo $this->front_after_login_layout($title, $page_name, $data);
            }
            public function eventDetail(Request $request, $id)
            {
                $user_id                        = session('user_id');
                $data['event']                  = Event::where('id', '=', $id)->first();
                $title                          = (($data['event'])?$data['event']->title:'');
                $page_name                      = 'event-detail';
                echo $this->front_after_login_layout($title, $page_name, $data);
            }
        /* events */
        /* magazines */
            public function magazines(Request $request)
            {
                $user_id                        = session('user_id');
                $data['magazines']              = Magazine::select('id', 'name', 'news_date', 'photo', 'mag_file')->where('status', '=', 1)->orderBy('id', 'DESC')->get();
                $title                          = 'Mgazines';
                $page_name                      = 'magazines';
                echo $this->front_after_login_layout($title, $page_name, $data);
            }
        /* magazines */
        /* news */
            public function news(Request $request)
            {
                $user_id                        = session('user_id');
                $data['news']                   = News::select('id', 'name', 'news_date', 'photo')->where('status', '=', 1)->orderBy('id', 'DESC')->get();
                $title                          = 'News';
                $page_name                      = 'news';
                echo $this->front_after_login_layout($title, $page_name, $data);
            }
            public function newsDetail(Request $request, $id)
            {
                $user_id                        = session('user_id');
                $data['row']                    = News::where('id', '=', $id)->first();
                $title                          = (($data['row'])?$data['row']->name:'');
                $page_name                      = 'news-detail';
                echo $this->front_after_login_layout($title, $page_name, $data);
            }
        /* news */
        /* awards */
            public function awards(Request $request)
            {
                $user_id                        = session('user_id');
                $data['awards']                 = Achievement::select('id', 'name', 'news_date', 'photo')->where('status', '=', 1)->orderBy('id', 'DESC')->get();
                $title                          = 'Awards';
                $page_name                      = 'awards';
                echo $this->front_after_login_layout($title, $page_name, $data);
            }
            public function awardsDetail(Request $request, $id)
            {
                $user_id                        = session('user_id');
                $data['row']                    = Achievement::where('id', '=', $id)->first();
                $title                          = (($data['row'])?$data['row']->name:'');
                $page_name                      = 'awards-detail';
                echo $this->front_after_login_layout($title, $page_name, $data);
            }
        /* awards */
        /* media */
            public function media(Request $request)
            {
                $user_id                        = session('user_id');
                $data['ins']                    = Institute::select('id', 'name', 'background_color', 'logo')->where('status', '=', 1)->orderBy('id', 'ASC')->get();
                $title                          = 'Media';
                $page_name                      = 'media';
                echo $this->front_after_login_layout($title, $page_name, $data);
            }
            public function mediaDetail(Request $request, $id)
            {
                $user_id                        = session('user_id');
                $data['institute_id']           = $id;
                $data['institute']              = Institute::select('name')->where('id', '=', $id)->first();
                $data['cats']                   = Category::select('id', 'name')->where('institute_id', '=', $id)->get();
                $title                          = (($data['institute'])?$data['institute']->name:'');
                $page_name                      = 'media-detail';
                echo $this->front_after_login_layout($title, $page_name, $data);
            }
        /* media */
        /* members */
            public function societyMembers(Request $request)
            {
                $user_id                        = session('user_id');
                $data['members']                = User::where('status', '=', 1)->where('type', '=', 1)->orderBy('rank', 'ASC')->get();
                $title                          = 'Society Members';
                $page_name                      = 'society-members';
                echo $this->front_after_login_layout($title, $page_name, $data);
            }
            public function employeeMembers(Request $request)
            {
                $user_id                        = session('user_id');
                $data['members']                = User::where('status', '=', 1)->where('type', '=', 2)->orderBy('name', 'ASC')->get();
                $title                          = 'Employee Members';
                $page_name                      = 'employee-members';
                echo $this->front_after_login_layout($title, $page_name, $data);
            }
            public function teacherMembers(Request $request)
            {
                $user_id                        = session('user_id');
                $data['members']                = User::where('status', '=', 1)->where('type', '=', 3)->orderBy('name', 'ASC')->get();
                $title                          = 'Teacher Members';
                $page_name                      = 'teacher-members';
                echo $this->front_after_login_layout($title, $page_name, $data);
            }
        /* members */
        /* reach */
            public function reach(Request $request)
            {
                $user_id                        = session('user_id');
                $data['settings']               = GeneralSetting::where('published', '=', 1)->first();
                $title                          = 'Reach Us';
                $page_name                      = 'reach-us';
                echo $this->front_after_login_layout($title, $page_name, $data);
            }
        /* reach */
    /* after login */
    /* delete account */
        public function deleteaccountview(Request $request)
        {        
            $data = [];
            $title                          = 'Delete Account';
            $page_name                      = 'delete-account';     

            return view('front.delete-account', $data);
        }
        public function deleteaccount(Request $request)
        {
            if($request->isMethod('post')){
                $postData           = $request->all();
                // Helper::pr($postData);
                $user_type         = $postData['user_type'];
                $Entityname         = $postData['entity_name'];
                $email             = $postData['email'];
                $phone           = $postData['phone'];
                $comment           = !empty($request->comment) ? $request->comment : null;
                $rules = [                                 
                    'user_type'           => 'required',
                    'entity_name'         => 'required',
                    'email'               => 'required|email',
                    'phone'               => 'required|numeric',                
                ];
                
                if ($this->validate($request, $rules)) {
                    $email_validation    = DeleteAccountRequest::where('email', $email)->first();               
                    if($email_validation){
                        $user_id           = $email_validation->id;
                        $fields = [
                            'user_type'       => $user_type,
                            'entity_name'     => $Entityname,
                            'email'           => $email,
                            'is_email_verify' => 1,
                            'is_phone_verify' => 1,
                            'phone'           => $phone,
                            'comments'         => $comment,
                            'created_at'      => date('Y-m-d H:i:s'), 
                            'updated_at'    => date('Y-m-d H:i:s'),             
                            'status'          => 1,                                  
                        ];
                        DeleteAccountRequest::where('id', $user_id)->update($fields);
                    }
                    $fields2 = [
                        'user_type'       => $user_type,
                        'entity_name'     => $Entityname,
                        'email'           => $email,
                        'is_email_verify' => 1,
                        'is_phone_verify' => 1,
                        'phone'           => $phone,
                        'comments'         => $comment,
                        'created_at'      => date('Y-m-d H:i:s'),                    
                        'status'          => 1,                                  
                    ];                
                    DeleteAccountRequest::insert($fields2);                
                    return redirect('delete-account')->with('success_message', 'Delete account request send successfully');
                } else {
                    return redirect('delete-account')->with('error_message', 'Please enter valid data');
                    
                }
            }        
        }
    /* delete account */
}
