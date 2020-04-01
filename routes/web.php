<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Chat\ChatContorller;

Route::get('/', function () {
    return redirect(route('Home.Home'));
});

Route::get('/change_Path', 'change_Path_controller@index');
Route::get('test/', function () {
    return view('test');
});

Route::namespace('Auth')->group(function () {
    Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'RegisterController@register')->name('do_register');
    Route::get('confirm/{active}', 'RegisterController@confirm')->name('confirm');

    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login')->name('do_login');

    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{reset_token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');

    Route::get('/Facebook/redirect/{provider}', 'FbLoginController@redirect')->name('fbLogin');
    Route::get('/FBcallback/{provider}', 'FbLoginController@callback');

    Route::get('/auth/chengePassword', 'ResetPasswordController@userReset')->name('user.password.update')->middleware('auth');
    // https://192.168.1.166/php/TW_SIM_Evaluate/public/FBcallback/facebook
});

Route::middleware(['auth', 'checkLogin'])->prefix('Met')->name('Met.')->group(function () {
    Route::namespace('Meteorology')->group(function () {
        Route::get('/Evaluate', 'EvaluateController@index')->name('Evaluate');
        Route::get('/Evaluate/data/{Met_evaluates}', 'EvaluateController@detail')->name('detail_Evaluate');
        Route::get('/Evaluate/img/{area}/{Met_evaluates}', 'EvaluateController@detailImg')->name('detail_img_Evaluate');
        Route::post('/post/Evaluate', 'EvaluateController@evaluate')->name('do_Evaluate');
        Route::get('/Evaluate/download/{Time_Period}', 'EvaluateController@download')->name('download_Evaluate');
        Route::delete('/Evaluate/delete/{Met_eva}', 'EvaluateController@delete')->name('delete_Evaluate');


        Route::get('/MetData', 'MetDataController@index')->name('MetData');

        Route::get('/MetMonthData/get/{year}/{month}/{datatype}/{var}', 'MetDataController@MetMonthData')->name('MetMonthData');
        Route::post('/MetMonthData/post/{year}/{month}/{datatype}/{var}', 'MetDataController@MetUpload')->name('UploatMet');
        Route::get('/MetMonthData/download/{DataID}/{datatype}/{var}', 'MetDataController@download')->name('download_MetMonth');
        Route::post('/MetMonthData/multiple/{method}/{datatype}/{var}', 'MetDataController@Multiple')->name('Multiple');


        Route::delete('/DELETE/{DataID}/{datatype}/{var}', 'MetDataController@MetDelete')->name('DeleteMet');
    });
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
});

Route::middleware(['auth', 'checkLogin'])->prefix('Member')->name('Member.')->namespace('Member')->group(function () {
    Route::get('List', 'MemberController@index')->middleware('getOutNotAdmin')->name('List');
    Route::middleware('checkOwn')->group(function () {
        Route::get('{member}', 'MemberController@memberPage')->name('memberPage');
        Route::POST('{member}/check', 'MemberController@memberCheck')->name('Check');
        Route::PUT('{member}/Update', 'MemberController@memberUpdate')->name('Update');
        Route::get('{member}/updatePasswordPage', 'MemberController@memberUpdatePwdPage')->name('UpdatePwdPage');
        Route::PUT('{member}/updatePassword', 'MemberController@memberUpdatePwd')->name('UpdatePwd');
    });
});

Route::middleware('checkLogin')->prefix('Home')->name('Home.')->namespace('Home')->group(function () {
    Route::get('/', 'HomeController@index')->name('Home');

    Route::middleware(['auth', 'getOutNotAdmin'])->prefix('Admin')->group(function () {
        Route::get('/', 'HomeController@HomeAdmin')->name('Admin');
        Route::post('/CheckChange', 'HomeController@homeCheckChange')->name('checkChange');
        Route::put('/Update', 'HomeController@homeUpdate')->name('homeUpdate');

        Route::post('/create/studentSkill', 'HomeController@addStudentSkill')->name('addStudentSkill');
        Route::delete('/delete/studentSkill/{studentSkill}', 'HomeController@delStudentSkill')->name('delStudentSkill');

        Route::post('/create/workSkill', 'HomeController@addWorkSkill')->name('addWorkSkill');
        Route::delete('/workSkill/{workSkill}', 'HomeController@delWorkSkill')->name('delWorkSkill');
    });
});

//商品
Route::middleware(['auth', 'checkLogin'])->namespace('Transaction')->group(function () {
    Route::prefix('merchandise')->name('Merchandise.')->group(function () {

        Route::get('/', 'MerchandiseController@merchandiseListPage')->name('Home');

        Route::middleware('getOutNotAdmin')->group(function () {
            Route::get('/create', 'MerchandiseController@merchandiseCreateProcess')->name('Create');
            Route::get('/manage', 'MerchandiseController@merchandiseManageListPage')->name('Manage');
            //指定商品
            Route::group(['prefix' => '{merchandise}'], function () {
                Route::put('/', 'MerchandiseController@merchandiseItemUpdateProcess')->name('Update');
                Route::get('/edit', 'MerchandiseController@merchandiseEditPage')->name('Edit');
            });
        });

        Route::group(['prefix' => '{Merchandise}'], function () {
            Route::get('/', 'MerchandiseController@merchandiseItemPage')->name('Item');
            Route::post('/buy', 'MerchandiseController@merchandiseItemBuyProcess')->middleware('auth')->name('Buy');
        });
    });

    //交易
    Route::get('/transaction', 'TransactionController@transactionListPage')->name('trade');
});

//聊天
Route::middleware(['auth','checkLogin'])->namespace('Chat')->prefix('Chat')->name('Chat.')->group(function(){
    Route::get('/','ChatContorller@index')->name('index');
    
    Route::post('/post/msg','ChatContorller@post')->name('post');
    Route::delete('/delete/message/{message}', 'ChatContorller@delMsg')->name('delMsg');
    Route::put('/put/message/{message}', 'ChatContorller@editMsg')->name('editMsg');

    Route::post('/post/reply','ChatContorller@reply')->name('reply');
    Route::delete('/delete/reply/{reply}', 'ChatContorller@delreply')->name('delReply');
    Route::put('/put/reply/{reply}', 'ChatContorller@editReply')->name('editReply');
    
});
