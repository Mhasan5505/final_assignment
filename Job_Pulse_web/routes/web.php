<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobsController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/contact', [HomeController::class,'contact'])->name('contact');
Route::get('/blogs', [HomeController::class,'blogs'])->name('blogs');
Route::get('/jobs', [JobsController::class,'index'])->name('jobs');
Route::get('/jobs/detail/{id}', [JobsController::class,'detail'])->name('jobDetail');
Route::post('/apply-job', [JobsController::class,'applyJob'])->name('applyJob');
Route::post('/saved-job', [JobsController::class,'savedJob'])->name('savedJob');

Route::group(['prefix' => 'admin','middleware' => 'checkRole'], function() {
    Route::get('/dashboard', [DashboardController::class,'index'])->name('admin.dashboard');
    Route::get('/users', [UserController::class,'index'])->name('admin.users');
});

Route::group(['account'], function() {

    //Guest routes
    Route::group(['middleware' => 'guest'], function() {
        Route::get('/registration', [AccountController::class,'registration'])->name('account.registration');
        Route::post('/process-registration', [AccountController::class,'processRegistration'])->name('account.processRegistration');
        Route::get('/login', [AccountController::class,'login'])->name('account.login');
        Route::post('/authenticate', [AccountController::class,'authenticate'])->name('account.authenticate');
    });

    //Auth routes
    Route::group(['middleware' => 'auth'], function() {
        Route::get('/profile', [AccountController::class,'profile'])->name('account.profile');
        Route::put('/update-profile', [AccountController::class,'updateProfile'])->name('account.updateProfile');
        Route::get('/logout', [AccountController::class,'logout'])->name('account.logout');
        Route::post('/update-profile-pic', [AccountController::class,'upadateProfilePic'])->name('account.upadateProfilePic');
        Route::get('/create-job', [AccountController::class,'createJob'])->name('account.createJob');
        Route::post('/save-job', [AccountController::class,'saveJob'])->name('account.saveJob');
        Route::get('/my-jobs', [AccountController::class,'myJobs'])->name('account.myJobs');
        Route::get('/my-jobs/edit/{jobId}', [AccountController::class,'editJob'])->name('account.editJob');
        Route::post('/update-job/{jobId}', [AccountController::class,'updateJob'])->name('account.updateJob');
        Route::post('/delete-job', [AccountController::class,'deleteJob'])->name('account.deleteJob');
        Route::get('/my-job-applications', [AccountController::class,'myJobApplications'])->name('account.myJobApplications');
        Route::post('/remove-job-application', [AccountController::class,'removeJobs'])->name('account.removeJobs');
        Route::get('/saved-jobs', [AccountController::class,'savedJobs'])->name('account.savedJobs');
        Route::post('/remove-saved-job', [AccountController::class,'removeSavedJob'])->name('account.removeSavedJob');
        Route::post('/update-password', [AccountController::class,'updatePassword'])->name('account.updatePassword');

    });
});
