<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\PayPalController;
use App\Models\Product;
use App\Services\Schema\ProductSchemaService;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::match(['get', 'post'], '/', 'App\Http\Controllers\FrontController@signin');
Route::match(['get', 'post'], '/forgot-password', 'App\Http\Controllers\FrontController@forgotPassword');
Route::match(['get', 'post'], '/validate-otp/{id}', 'App\Http\Controllers\FrontController@validateOTP');
Route::match(['get', 'post'], '/reset-password/{id}', 'App\Http\Controllers\FrontController@resetPassword');
Route::match(['get', 'post'], '/logout', 'App\Http\Controllers\FrontController@signout');
Route::match(['get', 'post'], '/change-password', 'App\Http\Controllers\FrontController@changePassword')->middleware('user');
Route::match(['get', 'post'], '/edit-profile', 'App\Http\Controllers\FrontController@editProfile')->middleware('user');

Route::match(['get'], '/delete-account', 'App\Http\Controllers\FrontController@deleteaccountview');
Route::post('delete-account-update', [FrontController::class, 'deleteaccount'])->name('delete-account.store');

Route::match(['get', 'post'], '/home', 'App\Http\Controllers\FrontController@home');

Route::match(['get', 'post'], '/events', 'App\Http\Controllers\FrontController@events');
Route::match(['get', 'post'], '/event-details/{id}', 'App\Http\Controllers\FrontController@eventDetail');

Route::match(['get', 'post'], '/news', 'App\Http\Controllers\FrontController@news');
Route::match(['get', 'post'], '/news-details/{id}', 'App\Http\Controllers\FrontController@newsDetail');

Route::match(['get', 'post'], '/awards', 'App\Http\Controllers\FrontController@awards');
Route::match(['get', 'post'], '/awards-details/{id}', 'App\Http\Controllers\FrontController@awardsDetail');

Route::match(['get', 'post'], '/magazines', 'App\Http\Controllers\FrontController@magazines');

Route::match(['get', 'post'], '/media', 'App\Http\Controllers\FrontController@media');
Route::match(['get', 'post'], '/media-details/{id}', 'App\Http\Controllers\FrontController@mediaDetail');

Route::match(['get', 'post'], '/page/{id}', 'App\Http\Controllers\FrontController@page');

Route::match(['get', 'post'], '/reach', 'App\Http\Controllers\FrontController@reach');

Route::match(['get', 'post'], '/society-members', 'App\Http\Controllers\FrontController@societyMembers');
Route::match(['get', 'post'], '/employee-members', 'App\Http\Controllers\FrontController@employeeMembers');
Route::match(['get', 'post'], '/teacher-members', 'App\Http\Controllers\FrontController@teacherMembers');

/* Admin Panel */
    Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){
        Route::match(['get', 'post'], '/', 'UserController@login');
        Route::match(['get','post'],'/forgot-password', 'UserController@forgotPassword');
        Route::match(['get','post'],'/validateOtp/{id}', 'UserController@validateOtp');
        Route::match(['get','post'],'/changePassword/{id}', 'UserController@changePassword');
        Route::group(['middleware' => ['admin']], function(){
            Route::get('dashboard', 'UserController@dashboard');
            Route::get('dashboard-filter', 'UserController@dashboardFilter');
            Route::get('logout', 'UserController@logout');
            Route::get('email-logs', 'UserController@emailLogs');
            Route::match(['get','post'],'/email-logs/details/{id}', 'UserController@emailLogsDetails');
            Route::get('login-logs', 'UserController@loginLogs');
            // Route::match(['get','post'], 'update-product-view', 'UserController@update_product_view')->name('updateProductView');;
            Route::match(['get', 'post'], 'image-gallery', 'UserController@imageGallery');
            Route::get('dashboard-new', 'UserController@dashboardNew');
            Route::get('stats', 'UserController@stats');
            Route::get('message', 'UserController@message');
            Route::get('user-all-activity', 'UserController@userAllActivity');
            /* setting */
                Route::get('settings', 'UserController@settings');
                Route::post('profile-settings', 'UserController@profile_settings');
                Route::post('general-settings', 'UserController@general_settings');
                Route::post('change-password', 'UserController@change_password');
                Route::post('email-settings', 'UserController@email_settings');
                Route::post('email-template', 'UserController@email_template');
                Route::post('sms-settings', 'UserController@sms_settings');
                Route::post('footer-settings', 'UserController@footer_settings');
                Route::post('seo-settings', 'UserController@seo_settings');
                Route::post('payment-settings', 'UserController@payment_settings');
                Route::post('shipping-settings', 'UserController@shipping_settings');
          		Route::get('test-email', 'UserController@testEmail');
            /* setting */
            /* institute */
                Route::get('institute/list', 'InstituteController@list');
                Route::match(['get', 'post'], 'institute/add', 'InstituteController@add');
                Route::match(['get', 'post'], 'institute/edit/{id}', 'InstituteController@edit');
                Route::get('institute/delete/{id}', 'InstituteController@delete');
                Route::get('institute/change-status/{id}', 'InstituteController@change_status');
            /* institute */
            /* category */
                Route::get('category/list', 'CategoryController@list');
                Route::match(['get', 'post'], 'category/add', 'CategoryController@add');
                Route::match(['get', 'post'], 'category/edit/{id}', 'CategoryController@edit');
                Route::get('category/delete/{id}', 'CategoryController@delete');
                Route::get('category/change-status/{id}', 'CategoryController@change_status');
            /* category */
            /* society member */
                Route::get('society-member/list', 'SocietyMemberController@list');
                Route::match(['get', 'post'], 'society-member/add', 'SocietyMemberController@add');
                Route::match(['get', 'post'], 'society-member/edit/{id}', 'SocietyMemberController@edit');
                Route::get('society-member/delete/{id}', 'SocietyMemberController@delete');
                Route::get('society-member/change-status/{id}', 'SocietyMemberController@change_status');
            /* society member */
            /* admin & employee member */
                Route::get('employee-member/list', 'EmployeeMemberController@list');
                Route::match(['get', 'post'], 'employee-member/add', 'EmployeeMemberController@add');
                Route::match(['get', 'post'], 'employee-member/edit/{id}', 'EmployeeMemberController@edit');
                Route::get('employee-member/delete/{id}', 'EmployeeMemberController@delete');
                Route::get('employee-member/change-status/{id}', 'EmployeeMemberController@change_status');
            /* admin & employee member */
            /* teacher member */
                Route::get('teacher-member/list', 'TeacherMemberController@list');
                Route::match(['get', 'post'], 'teacher-member/add', 'TeacherMemberController@add');
                Route::match(['get', 'post'], 'teacher-member/edit/{id}', 'TeacherMemberController@edit');
                Route::get('teacher-member/delete/{id}', 'TeacherMemberController@delete');
                Route::get('teacher-member/change-status/{id}', 'TeacherMemberController@change_status');
            /* teacher member */
            /* page */
                Route::get('page/list', 'PageController@list');
                Route::match(['get', 'post'], 'page/add', 'PageController@add');
                Route::match(['get', 'post'], 'page/edit/{id}', 'PageController@edit');
                Route::get('page/delete/{id}', 'PageController@delete');
                Route::get('page/change-status/{id}', 'PageController@change_status');
            /* page */

            /* news */
                Route::get('news/list', 'NewsController@list');
                Route::match(['get', 'post'], 'news/add', 'NewsController@add');
                Route::match(['get', 'post'], 'news/edit/{id}', 'NewsController@edit');
                Route::get('news/delete/{id}', 'NewsController@delete');
                Route::get('news/change-status/{id}', 'NewsController@change_status');
            /* news */
            /* magazine */
                Route::get('magazine/list', 'MagazineController@list');
                Route::match(['get', 'post'], 'magazine/add', 'MagazineController@add');
                Route::match(['get', 'post'], 'magazine/edit/{id}', 'MagazineController@edit');
                Route::get('magazine/delete/{id}', 'MagazineController@delete');
                Route::get('magazine/change-status/{id}', 'MagazineController@change_status');
            /* magazine */
            /* achievement */
                Route::get('achievement/list', 'AchievementController@list');
                Route::match(['get', 'post'], 'achievement/add', 'AchievementController@add');
                Route::match(['get', 'post'], 'achievement/edit/{id}', 'AchievementController@edit');
                Route::get('achievement/delete/{id}', 'AchievementController@delete');
                Route::get('achievement/change-status/{id}', 'AchievementController@change_status');
            /* achievement */
            /* event */
                Route::get('event/list', 'EventController@list');
                Route::match(['get', 'post'], 'event/add', 'EventController@add');
                Route::match(['get', 'post'], 'event/edit/{id}', 'EventController@edit');
                Route::get('event/delete/{id}', 'EventController@delete');
                Route::get('event/change-status/{id}', 'EventController@change_status');
            /* event */
            /* media */
                Route::get('media/institute-list', 'MediaController@list');
                Route::get('media/category-list/{id}', 'MediaController@categoryList');
                Route::get('media/media-list/{id}/{id2}', 'MediaController@mediaList');
                Route::post('media/media-list/{id}/{id2}', 'MediaController@mediaList');
                Route::get('media/delete/{id}', 'MediaController@delete');

                Route::match(['get', 'post'], 'media/add', 'MediaController@add');
                Route::match(['get', 'post'], 'media/edit/{id}', 'MediaController@edit');
                Route::get('media/delete/{id}', 'MediaController@delete');
                Route::get('media/change-status/{id}', 'MediaController@change_status');
            /* media */
        });
    });
/* Admin Panel */
