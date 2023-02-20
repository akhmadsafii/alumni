<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategorySurveyController;
use App\Http\Controllers\ClusterController;
use App\Http\Controllers\CommentDiscussionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\User\SurveyController as UserSurveyController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GuestController::class, 'index'])->name('first_page');
Route::get('discussion', [GuestController::class, 'discussion'])->name('discussion');
Route::get('alumni', [GuestController::class, 'alumni'])->name('alumni');
Route::get('agenda', [GuestController::class, 'agenda'])->name('agenda');
Route::get('survey', [UserSurveyController::class, 'category'])->name('survey.category');
Route::get('category/{category}', [UserSurveyController::class, 'survey'])->name('survey.survey');

Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    // Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('verify', [AuthController::class, 'verify_login'])->name('verify_login');
    // Route::post('verify-register', [AuthController::class, 'verifyRegister'])->name('verify_register');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('auth:admin')->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'admin'])->name('dashboard');
        Route::prefix('manages')->name('manage.')->group(function () {
            Route::get('/', [AdminController::class, 'index'])->name('page');
            Route::post('/', [AdminController::class, 'store'])->name('store');
            Route::get('detail', [AdminController::class, 'detail'])->name('detail');
            Route::get('delete', [AdminController::class, 'delete'])->name('delete');
        });
        Route::prefix('settings')->name('setting.')->group(function () {
            Route::get('/', [SettingController::class, 'index'])->name('page');
            Route::post('/', [SettingController::class, 'store'])->name('store');
            Route::get('reset', [SettingController::class, 'reset'])->name('reset');
        });

        Route::prefix('profiles')->name('profile.')->group(function () {
            Route::get('/', [ProfileController::class, 'admin'])->name('page');
            Route::post('update', [ProfileController::class, 'update'])->name('update');
            Route::post('reset-password', [ProfileController::class, 'update_password'])->name('update_password');
        });

        Route::prefix('discussions')->name('discussion.')->group(function () {
            Route::get('/', [DiscussionController::class, 'index'])->name('page');
            Route::post('/', [DiscussionController::class, 'store'])->name('store');
            Route::post('update', [DiscussionController::class, 'update'])->name('update');
            Route::get('delete', [DiscussionController::class, 'delete'])->name('delete');
            Route::get('detail', [DiscussionController::class, 'detail'])->name('detail');
        });

        Route::prefix('comments')->name('comment.')->group(function () {
            Route::post('/', [CommentDiscussionController::class, 'store'])->name('store');
        });

        Route::prefix('categories')->name('category.')->group(function () {
            Route::post('/', [CategorySurveyController::class, 'store'])->name('store');
            Route::get('delete', [CategorySurveyController::class, 'delete'])->name('delete');
            Route::get('detail', [CategorySurveyController::class, 'detail'])->name('detail');
        });

        Route::prefix('denomination')->name('cluster.')->group(function () {
            Route::get('type/{type}', [ClusterController::class, 'index'])->name('type');
            Route::post('type/{type}', [ClusterController::class, 'store'])->name('store');
            Route::get('update-status', [ClusterController::class, 'update_status'])->name('update_status');
            Route::get('delete', [ClusterController::class, 'delete'])->name('delete');
            Route::get('detail', [ClusterController::class, 'detail'])->name('detail');
        });

        Route::prefix('surveys')->name('survey.')->group(function () {
            Route::get('/', [SurveyController::class, 'index'])->name('page');
            Route::post('/', [SurveyController::class, 'store'])->name('store');
            Route::get('delete', [SurveyController::class, 'delete'])->name('delete');
            Route::get('detail/{code}', [SurveyController::class, 'detail'])->name('detail');
            Route::get('info', [SurveyController::class, 'info'])->name('info');
            Route::get('information/{code}', [SurveyController::class, 'information'])->name('information');
        });

        Route::prefix('agendas')->name('agenda.')->group(function () {
            Route::get('/', [AgendaController::class, 'index'])->name('page');
            Route::post('/', [AgendaController::class, 'store'])->name('store');
            Route::get('detail', [AgendaController::class, 'detail'])->name('detail');
        });

        Route::prefix('blogs')->name('blog.')->group(function () {
            Route::get('/', [BlogController::class, 'index'])->name('page');
            Route::get('create', [BlogController::class, 'create'])->name('create');
            Route::post('/', [BlogController::class, 'store'])->name('store');
            Route::get('edit/{code}', [BlogController::class, 'edit'])->name('edit');
            Route::get('detail/{code}', [BlogController::class, 'detail'])->name('detail');
            Route::get('delete', [BlogController::class, 'delete'])->name('delete');
        });

        Route::prefix('galleries')->name('gallery.')->group(function () {
            Route::get('/', [GalleryController::class, 'index'])->name('page');
            Route::post('/', [GalleryController::class, 'store'])->name('store');
            Route::get('more/{code}', [GalleryController::class, 'more'])->name('more');
            Route::get('download/{code}', [GalleryController::class, 'download'])->name('download');
        });
    });
});

Route::prefix('users')->name('user.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'user'])->name('dashboard');

    // Route::prefix('admins')->name('admin.')->group(function () {
    //     Route::get('/', [AdminController::class, 'index'])->name('index');
    //     Route::post('/', [AdminController::class, 'store'])->name('store');
    //     Route::get('create', [AdminController::class, 'create'])->name('create');
    // });
})->middleware('auth:user');
