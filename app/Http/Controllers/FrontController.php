<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
            $title                          = 'Sign In / Sign Up';
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
                        $remember_token = rand(1000, 9999);
                        $postData = [
                            'remember_token'        => $remember_token,
                        ];
                        User::where('id', '=', $checkUser->id)->update($postData);
                        /* email sent */
                        $generalSetting              = GeneralSetting::find('1');
                        $message                     = str_replace("{{otp1}}", substr($remember_token, 0, 1), $generalSetting->email_template_forgot_password);
                        $message1                    = str_replace("{{otp2}}", substr($remember_token, 1, 1), $message);
                        $message2                    = str_replace("{{otp3}}", substr($remember_token, 2, 1), $message1);
                        $message3                    = str_replace("{{otp4}}", substr($remember_token, 3, 1), $message2);
                        $subject                     = $generalSetting->site_name . ' :: Forgot Password OTP';
                        $this->sendMail($checkUser->email, $subject, $message3);
                        /* email sent */
                        /* email log save */
                        $postData2 = [
                            'name'                  => $checkUser->first_name . ' ' . $checkUser->last_name,
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
                        $remember_token = $checkUser->remember_token;
                        if ($remember_token == $otp) {
                            $postData = [
                                'remember_token'        => '',
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
                                'password'        => Hash::make($password),
                            ];
                            User::where('id', '=', $checkUser->id)->update($postData);
                            /* email sent */
                            $generalSetting              = GeneralSetting::find('1');
                            $message                     = str_replace("{{name}}", $checkUser->first_name . ' ' . $checkUser->last_name, $generalSetting->email_template_change_password);
                            $message1                    = str_replace("{{email}}", $checkUser->email, $message);
                            $subject                     = $generalSetting->site_name . ' :: Reset Password';
                            $this->sendMail($checkUser->email, $subject, $message1);
                            /* email sent */
                            /* email log save */
                            $postData2 = [
                                'name'                  => $checkUser->first_name . ' ' . $checkUser->last_name,
                                'email'                 => $checkUser->email,
                                'subject'               => $subject,
                                'message'               => $message1
                            ];
                            EmailLog::insertGetId($postData2);
                            /* email log save */
                            return redirect('signin/')->with('success_message', 'Password Reset Successfully. Please Sign In !!!');
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
    /* after login */
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
        /* home */
            public function home(Request $request)
            {
                $user_id                        = session('user_id');
                $data = [];
                $title                          = 'Home';
                $page_name                      = 'home';
                echo $this->front_after_login_layout($title, $page_name, $data);
            }
        /* home */
        /* home */
            public function magazines(Request $request)
            {
                $user_id                        = session('user_id');
                $data = [];
                $title                          = 'Mgazines';
                $page_name                      = 'magazines';
                echo $this->front_after_login_layout($title, $page_name, $data);
            }
        /* home */
    /* after login */
}
