<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\AdminController;
use \App\Http\Controllers\Admin\StudenController;
use \App\Http\Controllers\Admin\CourseController;
use \App\Http\Controllers\Admin\TeacherController;
use \App\Http\Controllers\Admin\GradController;
use \App\Http\Controllers\LoginController;
use \App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Teacher\TeacheController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/user_dashboard', function () {
//     return view('welcome');
// });
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Auth::routes();




Route::get('/test', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    return 'done';
});


Route::group(['prefix' => 'admin'], function () { //middleware
    Route::get('/login', [AdminController::class, 'getlogin']);
    Route::get('/dashboard', function () {
        return view('auth_admin.dashboard');
    });
    Route::post('/login', [AdminController::class, 'postlogin'])->name('admin_login');
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/logout', [AdminController::class, 'logout'])->name('logout_admin');

        Route::group(['prefix' => 'teachers'], function () {
            Route::get('/', [TeacherController::class, 'index'])->name('index_teacher');
            Route::post('/store', [TeacherController::class, 'store'])->name('store_teacher');
            Route::delete('/delete/{id}', [TeacherController::class, 'destroy'])->name('delete_teacher');
            Route::get('/edit/{id}/edit', [TeacherController::class, 'edit'])->name('edit_teacher');
            Route::put('/update/{id}', [TeacherController::class, 'update'])->name('update_teacher');
        });
        Route::group(['prefix' => 'Student'], function () {
            Route::get('/', [StudenController::class, 'index'])->name('index_student');
            Route::post('/store', [StudenController::class, 'store'])->name('store_student');
            Route::post('/storeteacher', [StudenController::class, 'storeteacher'])->name('store_course_teacher');
            Route::get('/getTeacher/{id}', [StudenController::class, 'getTeacher'])->name('get_teacher');
            Route::get('/getUserCourse/{id}', [StudenController::class, 'getTacherCourse'])->name('get_teacher_course');
            Route::delete('/delete/{id}', [StudenController::class, 'destroy'])->name('delete_student');
            Route::get('/edit/{id}/edit', [StudenController::class, 'edit'])->name('edit_student');
            Route::put('/update/{id}', [StudenController::class, 'update'])->name('update_student');
        });
        Route::group(['prefix' => 'course'], function () {
            Route::get('/', [CourseController::class, 'index'])->name('index_course');
            Route::post('/store', [CourseController::class, 'store'])->name('store_course');
            Route::delete('/delete/{id}', [CourseController::class, 'destroy'])->name('delete_course');
            Route::get('/edit/{id}/edit', [CourseController::class, 'edit'])->name('edit_course');
            Route::put('/update/{id}', [CourseController::class, 'update'])->name('update_course');
        });
        Route::group(['prefix' => 'grade'], function () {
            Route::get('/', [GradController::class, 'index'])->name('index_grade');
        });
    });
});





Route::get('/loginform', [LoginController::class, 'index'])->name('login');
Route::get('/', [LoginController::class, 'getlogin']);
Route::post('/', [LoginController::class, 'postlogin'])->name('login_user');
Route::group(['middleware' => 'auth:web'], function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout_user');

    Route::group(['prefix' => 'students'], function () {
        Route::get('/', [StudentController::class, 'index'])->name('profile_student');
        Route::get('/view_course', [StudentController::class, 'viewCourse'])->name('view_course');
        Route::get('/add_course', [StudentController::class, 'addCourse'])->name('add_course');
        Route::get('/view_grade', [StudentController::class, 'viewGrade'])->name('view_grade');
        Route::get('/getTeacher/{id}', [StudentController::class, 'getTeacher']);
        Route::post('/storeteacher', [StudentController::class, 'store'])->name('add_course_teacher');


    });
    Route::group(['prefix' => 'teacher'], function () {
        Route::get('/', [TeacheController::class, 'index'])->name('profle_teacher');
        Route::get('/courses_teacher', [TeacheController::class, 'coursesTeacher'])->name('courses_teacher');
        Route::get('/get_student/{id}', [TeacheController::class, 'getStudent'])->name('get_student');
        Route::post('/add_student', [TeacheController::class, 'store'])->name('add_student');
        Route::put('/update/{id}', [CourseController::class, 'update'])->name('update_grade');


    });
});
