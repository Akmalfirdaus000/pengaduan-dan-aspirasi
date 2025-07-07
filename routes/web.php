<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatTextController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\Admin\RekapController;
use App\Http\Controllers\CompaintStatusHistoryController;


// Route Landig=ng Page
Route::get('/', function () {
    return view('landingPage');
});

// Route Authentikasi
Route::controller(AuthController::class)->group(function (){
    Route::get('login', 'login')->name('login');
    Route::post('login/action', 'login_action')->name('login.action');

    Route::get('register', 'register')->name('register');
    Route::post('register/action', 'register_action')->name('register.action');

    Route::get('logout', 'logout')->name('logout');
});

// Route Untuk Pengguna dengan Role 'user'
Route::middleware(['auth', 'user'])->prefix('user')->group(function (){

    Route::controller(DashboardController::class)->group(function(){
        Route::get('dashboard', 'user_dashboard')->name('user.dashboard');
    });

    Route::controller(ComplaintController::class)->prefix('complaints')->group(function(){
        Route::get('list', 'complaint_list')->name('complaint');
        Route::get('view/{id}', 'complaint_view')->name('complaint.view');
        Route::get('form', 'complaint_form')->name('complaint.form');
        Route::post('add', 'complaint_add')->name('complaint.add');
Route::get('edit/{id}', 'edit')->name('complaint.edit');
Route::put('update/{id}', 'update')->name('complaint.update');

    });



Route::delete('/complaint/delete/{id}', [ComplaintController::class, 'destroy'])->name('complaint.delete');


    Route::controller(ResponseController::class)->prefix('responses')->group(function(){
        Route::post('add', 'response_add')->name('response.add');
    });

    Route::controller(CompaintStatusHistoryController::class)->prefix('history')->group(function(){
        Route::get('list', 'history_list')->name('history.list');
    });

    Route::controller(ChatController::class)->prefix('chat')->group(function(){
        Route::get('list', 'user_chat_list')->name('user.chat.list');
    });

    Route::controller(ChatTextController::class)->prefix('chatText')->group(function(){
        Route::get('view/{id}', 'chatText_list')->name('user.chatText');
        Route::post('send', 'user_send_chat')->name('user.send.chat');
    });

});


// Route Untuk Pengguna dengan Role 'admin'
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function (){

    Route::controller(DashboardController::class)->group(function(){
        Route::get('dashboard', 'admin_dashboard')->name('admin.dashboard');
    });

    Route::controller(ComplaintController::class)->prefix('complaints')->group(function(){
        Route::get('list', 'complaint_list_admin')->name('complaint.admin');
        Route::get('view/{id}', 'complaint_view')->name('complaint.view.admin');
    });

    Route::controller(ResponseController::class)->prefix('responses')->group(function(){
        Route::post('add', 'response_add')->name('response.add.admin');
    });
    Route::get('/complaint/print/{id}', [ComplaintController::class, 'print'])->name('complaint.print');
 Route::get('/rekap', [RekapController::class, 'index'])->name('rekap.index');

    Route::controller(CompaintStatusHistoryController::class)->prefix('history')->group(function(){
        Route::post('process/{id}', 'process')->name('complaint.process');
    });

    Route::controller(CategoryController::class)->prefix('category')->group(function(){
        Route::get('list', 'category_list')->name('category.list');
        Route::get('form', 'category_form')->name('category.form');
        Route::post('add', 'category_add')->name('category.add');
        Route::get('delete/{id}', 'category_delete')->name('category.delete');
    });

    Route::controller(ChatController::class)->prefix('chat')->group(function(){
        Route::get('list', 'chat_list')->name('chat.list');
        Route::get('form/{id}', 'chat_form')->name('chat.form');
        Route::post('new', 'new_chat')->name('chat.new');
        Route::get('status/change/{id}', 'chatChange')->name('chatStatus.change');
    });

    Route::controller(ChatTextController::class)->prefix('chatText')->group(function(){
        Route::get('view/{id}', 'chatText_list')->name('chatText');
        Route::post('send', 'send_chat')->name('send.chat');
    });

});

// Route untuk admin dan User
Route::middleware('auth')->controller(UserController::class)->prefix('u')->group(function(){
    Route::get('profile', 'profile')->name('profile');

    Route::post('profile-change-name', 'profile_change_name')->name('profile.change.name');
    Route::post('profile-change-password', 'profile_change_password')->name('profile.change.password');
});

// Route untuk Login dengan Google
Route::controller(SocialiteController::class)->prefix('auth')->group(function(){
    Route::get('{driver}/redirect', 'redirect')->name('redirect');
    Route::get('{driver}/callback', 'callback')->name('callback');
});
