<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['role:freelancer']], function () {
    Route::get('/dashboard-freelancer', [DashboardController::class, 'indexFreelancer'])->name('dashboard.freelancer');
});

Route::group(['middleware' => ['role:client']], function () {
    Route::get('/dashboard-client', [DashboardController::class, 'indexClient'])->name('dashboard.client');
});

Route::group(['middleware' => ['role:freelancer|client']], function () {

    /* Detail Project*/
    Route::get('/detail-project/{id}', [ProjectController::class, 'showProjectDetail'])->name('detail-project');

    /* Profile */
    Route::get('/profile/{id}', [ProfileController::class, 'index'])->name('profile');

    Route::group(['middleware' => ['permission:edit profiles']], function () {
        Route::get('/update-profile/{id}', [ProfileController::class, 'edit'])->name('update-profile');
        Route::put('/update-profile/{id}', [ProfileController::class, 'update'])->name('update-profile.update');
    });

    /* Notification */
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');

    /* Task */
    Route::get('/project/{project_id}/task', [TaskController::class, 'index'])->name('task');

    /* Comment */
    Route::group(['middleware' => ['permission:create comments']], function () {
        Route::get('/project/{project_id}/tasks/{task_id}/comments', [CommentController::class, 'index'])->name('comment');
        Route::post('/project/{project_id}/tasks/{task_id}/comments', [CommentController::class, 'store'])->name('comment.store');
    });

    /* Review */
    Route::get('/review', [ReviewController::class, 'index'])->name('review');
});


// Routes for freelancers
Route::group(['middleware' => ['role:freelancer']], function () {

    /* Search Project*/
    Route::get('/freelancer/search-project/category/{id}', [ProjectController::class, 'showByCategory'])->name('freelancer.search-project.category');
    Route::get('/freelancer/search-project', [ProjectController::class, 'show'])->name('freelancer.search-project');

    /* Freelancer Project*/
    Route::get('/freelancer/project', [ProjectController::class, 'freelancerProject'])->name('freelancer.project');

    /* Apply Application*/
    Route::group(['middleware' => ['permission:create applications']], function () {
        Route::post('/freelancer/apply/{project_id}', [ApplicationController::class, 'applyForProject'])->name('freelancer.apply');
    });

    /* CRUD Task */
    Route::group(['middleware' => ['permission:create tasks']], function () {
        Route::get('freelancer/project/{project_id}/create-task', [TaskController::class, 'create'])->name('freelancer.create-task');
        Route::post('freelancer/project/{project_id}/create-task', [TaskController::class, 'store'])->name('freelancer.create-task.store');
    });

    Route::group(['middleware' => ['permission:edit tasks']], function () {
        Route::get('freelancer/project/{project_id}/task/{task_id}/update-task', [TaskController::class, 'edit'])->name('freelancer.update-task');
        Route::put('freelancer/project/{project_id}/task/{task_id}/update-task', [TaskController::class, 'update'])->name('freelancer.update-task.update');
    });

    Route::group(['middleware' => ['permission:delete tasks']], function () {
        Route::delete('freelancer/project/{project_id}/task/{task_id}/delete-task', [TaskController::class, 'destroy'])->name('freelancer.delete-task');
    });
    /* End CRUD Task */

});


// Routes for clients
Route::group(['middleware' => ['role:client']], function () {
    Route::get('/client/my-projects', [ProjectController::class, 'clientProject'])->name('client.my-projects');

    /* Application */
    Route::get('client/waiting-approval-project', [ApplicationController::class, 'waitingApprovalProject'])->name('client.waiting-approval-project');
    Route::get('client/waiting-approval-project/{project_id}/applications', [ApplicationController::class, 'showApplication'])->name('client.application');
    Route::post('client/application/waiting-approval-project/{project_id}/applications/{application_id}/chooseFreelancer', [ApplicationController::class, 'chooseFreelancer'])
        ->name('client.application.chooseFreelancer');

    /* CRUD Project */
    Route::group(['middleware' => ['permission:create projects']], function () {
        Route::get('/client/create-project', [ProjectController::class, 'create'])->name('client.create-project');
        Route::post('/client/create-project', [ProjectController::class, 'store'])->name('client.create-project.store');
    });

    Route::group(['middleware' => ['permission:edit projects']], function () {
        Route::get('/client/update-project/{id}', [ProjectController::class, 'edit'])->name('client.update-project');
        Route::put('/client/update-project/{id}', [ProjectController::class, 'update'])->name('client.update-project.update');
    });

    Route::group(['middleware' => ['permission:delete projects']], function () {
        Route::delete('/client/delete-project/{id}', [ProjectController::class, 'destroy'])->name('client.delete-project');
    });
    /* End CRUD Project */

    /* Project Status Completed */
    Route::post('/client/project/{project_id}/completed', [ProjectController::class, 'completedProject'])->name('client.statusCompleted');
    /* End Project Status Completed */

    /* CRUD Review */
    Route::group(['middleware' => ['permission:create reviews']], function () {
        Route::get('/client/project/{project_id}/create-review', [ReviewController::class, 'create'])->name('client.create-review');
        Route::post('/client/project/{project_id}/create-review', [ReviewController::class, 'store'])->name('client.create-review.store');
    });

    Route::group(['middleware' => ['permission:edit reviews']], function () {
        Route::get('/client/project/{project_id}/update-review/{review_id}', [ReviewController::class, 'edit'])->name('client.update-review');
        Route::put('/client/project/{project_id}/update-review/{review_id}', [ReviewController::class, 'update'])->name('client.update-review.update');
    });

    Route::group(['middleware' => ['permission:delete reviews']], function () {
        Route::delete('/client/project/{project_id}/delete-review/{review_id}', [ReviewController::class, 'destroy'])->name('client.delete-review');
    });
    /* End CRUD Project */

});

require __DIR__ . '/auth.php';
