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
use App\Http\Controllers\MailController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SurveyAnswerController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\User\BlogController as UserBlogController;
use App\Http\Controllers\User\GalleryController as UserGalleryController;
use App\Http\Controllers\User\SurveyController as UserSurveyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/sendmail', [MailController::class, 'index']);
Route::get('/', [GuestController::class, 'index'])->name('first_page');
Route::get('discussion', [GuestController::class, 'discussion'])->name('discussion');
Route::get('alumni', [GuestController::class, 'alumni'])->name('alumni');
Route::get('agenda', [GuestController::class, 'agenda'])->name('agenda');
Route::get('survey', [UserSurveyController::class, 'category'])->name('survey.category');
// Route::get('tes', [SurveyAnswerController::class, 'index'])->name('survey.answer');
Route::get('category/{category}', [UserSurveyController::class, 'survey'])->name('survey.survey');
Route::get('category-survey', [UserSurveyController::class, 'get_category'])->name('detail_category');
Route::prefix('blogs')->name('blog.')->group(function () {
    Route::get('/', [UserBlogController::class, 'index'])->name('public');
    Route::get('detail/{title}', [UserBlogController::class, 'detail'])->name('detail');
});
Route::prefix('galleries')->name('gallery.')->group(function () {
    Route::get('/', [UserGalleryController::class, 'index'])->name('public');
    Route::get('detail/{title}', [UserGalleryController::class, 'detail'])->name('detail');
    Route::get('preview/{image}', [UserGalleryController::class, 'preview'])->name('preview');
    // Route::get('delete', [AdminController::class, 'delete'])->name('delete');
});

Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('verify', [AuthController::class, 'verify_login'])->name('verify_login');
    Route::post('verify-register', [AuthController::class, 'verify_register'])->name('verify_register');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('auth:user,admin')->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'admin'])->name('dashboard');
        Route::prefix('manages')->name('manage.')->group(function () {
            Route::get('/', [AdminController::class, 'index'])->name('page');
            Route::post('/', [AdminController::class, 'store'])->name('store');
            Route::get('detail', [AdminController::class, 'detail'])->name('detail');
            Route::get('delete', [AdminController::class, 'delete'])->name('delete');
        });

        Route::prefix('users')->name('user.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('page');
            Route::post('/', [UserController::class, 'store'])->name('store');
            Route::get('detail', [UserController::class, 'detail'])->name('detail');
            Route::get('delete', [UserController::class, 'delete'])->name('delete');
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
            Route::get('delete', [CommentDiscussionController::class, 'delete'])->name('delete');
            Route::get('detail', [CommentDiscussionController::class, 'detail'])->name('detail');
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

        Route::prefix('answer')->name('answer.')->group(function () {
            Route::get('category/{category}', [SurveyAnswerController::class, 'index'])->name('category');
            Route::post('/', [SurveyAnswerController::class, 'store'])->name('store');
            Route::get('detail/{category}', [SurveyAnswerController::class, 'detail_category'])->name('detail_category');
        });

        Route::prefix('agendas')->name('agenda.')->group(function () {
            Route::get('/', [AgendaController::class, 'index'])->name('page');
            Route::post('/', [AgendaController::class, 'store'])->name('store');
            Route::get('detail', [AgendaController::class, 'detail'])->name('detail');
            Route::get('full-detail', [AgendaController::class, 'full_detail'])->name('full_detail');
            Route::get('update_status', [AgendaController::class, 'update_status'])->name('update_status');
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
            Route::get('load-image', [GalleryController::class, 'load_image'])->name('load_image');
            Route::get('download/{code}', [GalleryController::class, 'download'])->name('download');
            Route::get('update-status', [GalleryController::class, 'update_status'])->name('update_status');
            Route::get('update-publish', [GalleryController::class, 'update_publish'])->name('update_publish');
        });

        Route::prefix('majors')->name('major.')->group(function () {
            Route::get('/', [MajorController::class, 'index'])->name('page');
            Route::post('/', [MajorController::class, 'store'])->name('store');
            Route::get('delete', [MajorController::class, 'delete'])->name('delete');
            Route::get('detail', [MajorController::class, 'detail'])->name('detail');
            Route::get('update-status', [MajorController::class, 'update_status'])->name('update_status');
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
