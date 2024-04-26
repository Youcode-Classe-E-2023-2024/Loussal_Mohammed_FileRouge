<?php

use App\Http\Controllers\AdminDashboard;
use App\Http\Controllers\comments\comments;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\groups\groups;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\posts\posts;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\users\users;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
$middleware = ['RoleController'];

Route::get('/', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware($middleware)->group(function()
{
    Route::get('/listUsers', [users::class, 'listUsers']);
    Route::delete('/listUsers/{user}', [users::class, 'dropUser'])->name('dropUser');
    Route::post('/listUsers/{user}', [users::class, 'restoreUser'])->name('restoreUser');
    Route::get('/listPosts', [posts::class, 'listPosts']);
    Route::delete('/listPosts/{post}', [posts::class, 'dropPost'])->name('dropPost');
    Route::post('/listPosts/{post}', [posts::class, 'restorePost'])->name('restorePost');
    Route::get('/listGroups', [groups::class, 'listGroups']);
    Route::delete('/listGroups/{group}', [groups::class, 'dropGroup'])->name('dropGroup');
    Route::post('/listUsers/{group}', [groups::class, 'restoreGroup'])->name('restoreGroup');
    Route::get('/listComments', [comments::class, 'listComments']);
    Route::delete('/listComments/{post}', [comments::class, 'dropComment'])->name('dropComment');
    Route::post('/listComments/{post}', [comments::class, 'restoreComment'])->name('restoreComment');
});

Route::get('/api/getNombreJours', [AdminDashboard::class, 'getNombreJours']);

Route::get('/u/{user:username}', [ProfileController::class, 'index'])
    ->name('profile');

Route::get('/g/{group:slug}', [GroupController::class, 'profile'])
    ->name('group.profile');

Route::get('/group/approve-invitation/{token}', [GroupController::class, 'approveInvitation'])
    ->name('group.approveInvitation');

Route::middleware('auth')->group(function () {

    // Groups
    Route::prefix('/group')->group(function () {

        Route::post('/', [GroupController::class, 'store'])
            ->name('group.create');

        Route::put('/{group:slug}', [GroupController::class, 'update'])
            ->name('group.update');

        Route::post('/update-images/{group:slug}', [GroupController::class, 'updateImage'])
            ->name('group.updateImages');

        Route::post('/invite/{group:slug}', [GroupController::class, 'inviteUsers'])
            ->name('group.inviteUsers');

        Route::post('/join/{group:slug}', [GroupController::class, 'join'])
            ->name('group.join');

        Route::post('/approve-request/{group:slug}', [GroupController::class, 'approveRequest'])
            ->name('group.approveRequest');

        Route::delete('/remove-user/{group:slug}', [GroupController::class, 'removeUser'])
            ->name('group.removeUser');

        Route::post('/change-role/{group:slug}', [GroupController::class, 'changeRole'])
            ->name('group.changeRole');
    });

//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/update-images', [ProfileController::class, 'updateImage'])
        ->name('profile.updateImages');

    Route::post('/user/follow/{user}', [UserController::class, 'follow'])->name('user.follow');

    // Posts
    Route::prefix('/post')->group(function () {
        Route::get('/{post}', [PostController::class, 'view'])
            ->name('post.view');

        Route::post('', [PostController::class, 'store'])
            ->name('post.create');

        Route::put('/{post}', [PostController::class, 'update'])
            ->name('post.update');

        Route::delete('/{post}', [PostController::class, 'destroy'])
            ->name('post.destroy');

        Route::get('/download/{attachment}', [PostController::class, 'downloadAttachment'])
            ->name('post.download');

        Route::post('/{post}/reaction', [PostController::class, 'postReaction'])
            ->name('post.reaction');

        Route::post('/{post}/comment', [PostController::class, 'createComment'])
            ->name('post.comment.create');

        Route::post('/ai-post', [PostController::class, 'aiPostContent'])
            ->name('post.aiContent');

        Route::post('/fetch-url-preview', [PostController::class, 'fetchUrlPreview'])
            ->name('post.fetchUrlPreview');

        Route::post('/{post}/pin', [PostController::class, 'pinUnpin'])
            ->name('post.pinUnpin');
    });

    // Comments
    Route::delete('/comment/{comment}', [PostController::class, 'deleteComment'])
        ->name('comment.delete');

    Route::put('/comment/{comment}', [PostController::class, 'updateComment'])
        ->name('comment.update');

    Route::post('/comment/{comment}/reaction', [PostController::class, 'commentReaction'])
        ->name('comment.reaction');

    Route::get('/search/{search?}', [SearchController::class, 'search'])
        ->name('search');

});

require __DIR__ . '/auth.php';
