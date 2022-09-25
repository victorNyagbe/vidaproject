<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Guests\MainController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\ChatController as AdminChatController;
use App\Http\Controllers\Admin\MailController as AdminMailController;
use App\Http\Controllers\Admin\MainController as AdminMainController;
use App\Http\Controllers\Admin\BoardController as AdminBoardController;
use App\Http\Controllers\Admin\ChartController as AdminChartController;

use App\Http\Controllers\Admin\PartnerController as AdminPartnerController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\CalendarController as AdminCalendarController;
use App\Http\Controllers\Admin\Project\ChatController as AdminProjectChatController;
use App\Http\Controllers\Admin\Project\PartnerController as AdminProjectPartnerController;
use App\Http\Controllers\Admin\Project\ProjectController as AdminProjectProjectController;
use App\Http\Controllers\Admin\Project\CalendarController as AdminProjectCalendarController;

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

/* Partie utilisateur */

Route::get('/', [MainController::class, 'welcome'])->name('guests.welcome');

Route::get('/acces', [MainController::class, 'login'])->name('guests.login');

Route::post('/inscription', [RegisterController::class, 'registerNewUser'])->name('guests.registration');

Route::post('/connexion', [LoginController::class, 'login'])->name('guests.login.processing');

Route::get('/connexion-via-google', [RegisterController::class, 'redirectToGoogle'])->name('guests.google.redirection');

Route::get('/connexion-via-google/callback', [RegisterController::class, 'handleGoogleCallback'])->name('guests.google.callback');


/* Partie Administrateur */
Route::get('Accueil', [AdminMainController::class, 'home'])->name('admin.home');

Route::get('dashboard', [AdminMainController::class, 'dashboard'])->name('admin.dashboard');

Route::prefix('projects')->group( function() {

    Route::get('/', [AdminProjectController::class, 'index'])->name('admin.project.project');

    Route::prefix('nom-du-projet')->group( function() {

        Route::get('/', [AdminProjectController::class, 'show'])->name('admin.project.showBord');

        Route::get('/bureau', [AdminBoardController::class, 'board'])->name('admin.board');

        Route::get('/collaborateur', [AdminProjectPartnerController::class, 'collaborateur'])->name('admin.projectBoard.collaborateur');

        Route::get('/diagrammes', [AdminChartController::class, 'projectChart'])->name('admin.projectBoard.charts');

        Route::get('/calendrier', [AdminProjectCalendarController::class, 'calendar'])->name('admin.projectBoard.calendar');

        Route::get('/gallerie', [AdminGalleryController::class, 'projectGallery'])->name('admin.projectBoard.gallery');

        /* Project board */

        Route::get('messages', [AdminProjectChatController::class, 'chat'])->name('admin.projectBoard.message.chat');

        Route::get('/autres-projets', [AdminProjectProjectController::class, 'index'])->name('admin.projectBoard.project.project');

        Route::get('/rapport', [AdminProjectPartnerController::class, 'rapport'])->name('admin.projectBoard.rapport');

        // Route::get('email', [MailController::class, 'mail'])->name('admin.projectBoard.email.mail');
    });
});


Route::get('client', [AdminPartnerController::class, 'client'])->name('admin.client');

Route::get('diagrammes', [AdminChartController::class, 'chart'])->name('admin.charts');

Route::get('collaborateur', [AdminPartnerController::class, 'collaborateur'])->name('admin.collaborateur');

Route::get('calendrier', [AdminCalendarController::class, 'calendar'])->name('admin.calendar');

Route::get('gallerie', [AdminGalleryController::class, 'gallery'])->name('admin.gallery');

Route::get('messages', [AdminChatController::class, 'chat'])->name('admin.message.chat');

Route::prefix('email')->group( function() {

    Route::get('/', [AdminMailController::class, 'mail'])->name('admin.email.mail');

    Route::get('/boite-de-reception', [AdminMailController::class, 'getInbox'])->name('admin.email.inboxMail');

    Route::get('/envoyer-un-message', [AdminMailController::class, 'getNewMail'])->name('admin.email.newMail');

    Route::get('/message-envoyé', [AdminMailController::class, 'getSentMail'])->name('admin.email.sentMail');

    Route::get('/brouillon', [AdminMailController::class, 'getDraftMail'])->name('admin.email.draftMail');

    Route::get('/Corbeille', [AdminMailController::class, 'getTrashMail'])->name('admin.email.trashMail');

});



