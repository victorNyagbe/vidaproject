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
use App\Http\Controllers\Admin\Project\TaskController;

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

/* Partie welcome */

Route::get('/', [MainController::class, 'welcome'])->name('guests.welcome');

Route::prefix('collaborateur/')->group( function() {
    Route::get('dashboard', [MainController::class, 'dashboard'])->name('guests.dashboard');
});

Route::get('deconnexion', [LoginController::class, 'logout'])->name('guests.logout');

/* Partie login avec google */

Route::get('/acces', [MainController::class, 'login'])->name('guests.login');

Route::post('/inscription', [RegisterController::class, 'registerNewUser'])->name('guests.registration');

Route::post('/connexion', [LoginController::class, 'login'])->name('guests.login.processing');

Route::get('/connexion-via-google', [RegisterController::class, 'redirectToGoogle'])->name('guests.google.redirection');

Route::get('/connexion-via-google/callback', [RegisterController::class, 'handleGoogleCallback'])->name('guests.google.callback');


/* Partie Administrateur */
Route::get('accueil', [AdminMainController::class, 'home'])->name('admin.home');

Route::get('creation-du-premier-projet', [AdminProjectController:: class, 'createProjectLogin'])->name('admin.createProjectLogin');

Route::prefix('dashboard')->group( function() {
    Route::get('', [AdminMainController::class, 'dashboard'])->name('admin.dashboard');

    Route::post('store-processing', [AdminProjectController::class, 'store_project_login'])->name('admin.home.store');
});

Route::prefix('projects')->group( function() {

    Route::get('', [AdminProjectController::class, 'index'])->name('admin.project.project');

    Route::post('store-processing', [AdminProjectController::class, 'store'])->name('admin.project.project.store');

    Route::get('/{project}/destroy-processing', [AdminProjectController::class, 'destroy'])->name('admin.project.project.destroy');

    // Route::prefix('mon-du-projet')->group( function() {

        Route::get('/{project}/tableau-de-bord', [AdminProjectController::class, 'show'])->name('admin.projectBoard.project.showBoard');

        Route::prefix('details')->group( function() {

            // Route::get('/', [AdminProjectController:: class, 'update_index'])->name('admin.project.projectUpdate');

            Route::get('/{project}/edition', [AdminProjectController::class, 'edit'])->name('admin.project.edit');

            Route::patch('/{project}/update-processing', [AdminProjectController::class, 'update'])->name('admin.project.update');

            Route::get('/{project}/destroy-project-processing', [AdminProjectController::class, 'destroy_edit'])->name('admin.project.edit.destroy');

            // depuis projectBoard

            Route::get('/{project}/project-edition', [AdminProjectProjectController::class, 'edit'])->name('admin.projectBoard.project.edit');

            Route::patch('/{project}/update-project-processing', [AdminProjectProjectController::class, 'update'])->name('admin.projectBoard.project.update');

            Route::get('/{project}/destroy-processing', [AdminProjectProjectController::class, 'destroy_edit'])->name('admin.projectBoard.project.edit.destroy');

        });

        Route::prefix('gallerie')->group( function() {

            Route::get('{project}/', [AdminGalleryController::class, 'projectGallery'])->name('admin.projectBoard.gallery');

            Route::post('/store-processing', [AdminGalleryController::class, 'store'])->name('admin.projectBoard.gallery.store');

            Route::get('/{gallerie}/destroy-processing', [AdminGalleryController::class, 'destroy'])->name('admin.projectBoard.gallery.destroy');
        });

        /* Project board */

        Route::get('/{project}/bureau', [AdminBoardController::class, 'board'])->name('admin.board');

        Route::get('/{project}/collaborateur', [AdminProjectPartnerController::class, 'collaborateur'])->name('admin.projectBoard.collaborateur');

        Route::get('/{project}/client', [AdminProjectPartnerController::class, 'client'])->name('admin.projectBoard.client');

        // Route::post('envoi-de-la-demande', [AdminProjectPartnerController::class, 'mailForAdd'])->name('admin.projectBoard.client.add');

        Route::post('{project}/envoi-demande', [AdminProjectPartnerController::class, 'sendInvitationForCollab'])->name('admin.projectBoard.sendInvitationForCollab');

        Route::get('/{project}/diagrammes', [AdminChartController::class, 'projectChart'])->name('admin.projectBoard.charts');

        Route::get('/{project}/calendrier', [AdminProjectCalendarController::class, 'calendar'])->name('admin.projectBoard.calendar');

        Route::get('/{project}/messages', [AdminProjectChatController::class, 'chat'])->name('admin.projectBoard.message.chat');

        Route::get('/{project}/autres-projets', [AdminProjectProjectController::class, 'index'])->name('admin.projectBoard.project.project');

        Route::prefix('taches/')->group(function () {
            Route::post('{project}/storeProccesing', [TaskController::class, 'store'])->name('admin.task.store');

            Route::patch('{project}/{task}/updateProccesing', [TaskController::class, 'update'])->name('admin.task.update');

            Route::get('{project}/{task}/{value}/updateStatusProccesing', [TaskController::class, 'updateStatus'])->name('admin.task.updateStatus');

            Route::get('{task}/destroyProccesing', [TaskController::class, 'destroy'])->name('admin.task.destroy');
        });

        Route::prefix('rapport')->group(function(){

            Route::get('{project}/', [AdminProjectPartnerController::class, 'index'])->name('admin.projectBoard.rapport.index');

            Route::post('/{project1}/store_processing', [AdminProjectPartnerController::class, 'store_rapport'])->name('admin.projectBoard.rapport.store');

            Route::get('/{rapport}/{project}/details', [AdminProjectPartnerController::class, 'edit'])->name('admin.projectBoard.rapport.edit');

            Route::post('/voir-le-pdf', [AdminProjectPartnerController::class, 'viewPdf'])->name('admin.projectBoard.rapport.viewPdf');

            Route::post('/{rapport}/telecharger-le-pdf', [AdminProjectPartnerController::class, 'downloadPdf'])->name('admin.projectBoard.rapport.downloadPdf');

            Route::get('/{rapport}/destroy-processing', [AdminProjectPartnerController::class, 'destroy_rapport'])->name('admin.projectBoard.rapport.destroy');

        });

        // Route::get('email', [MailController::class, 'mail'])->name('admin.projectBoard.email.mail');
    // });
});


Route::get('client', [AdminPartnerController::class, 'client'])->name('admin.client');

Route::get('diagrammes', [AdminChartController::class, 'chart'])->name('admin.charts');

Route::get('collaborateur', [AdminPartnerController::class, 'collaborateur'])->name('admin.collaborateur');

Route::get('calendrier', [AdminCalendarController::class, 'calendar'])->name('admin.calendar');

Route::get('gallerie', [AdminGalleryController::class, 'gallery'])->name('admin.gallery');

Route::get('messages', [AdminChatController::class, 'chat'])->name('admin.message.chat');

Route::prefix('email')->group( function() {

    Route::get('', [AdminMailController::class, 'mail'])->name('admin.email.mail');

    Route::get('boite-de-reception', [AdminMailController::class, 'getInbox'])->name('admin.email.inboxMail');

    Route::get('envoyer-un-message', [AdminMailController::class, 'getNewMail'])->name('admin.email.newMail');

    Route::get('message-envoyé', [AdminMailController::class, 'getSentMail'])->name('admin.email.sentMail');

    Route::get('brouillon', [AdminMailController::class, 'getDraftMail'])->name('admin.email.draftMail');

    Route::get('Corbeille', [AdminMailController::class, 'getTrashMail'])->name('admin.email.trashMail');

});


// Login du lien d'invitation

Route::get('invitation/login/', [MainController::class, 'inviteLogin'])->name('partners.inviteLogin');

Route::post('invitation/login/collaborateur/store-processing', [AdminProjectPartnerController::class, 'collab_store'])->name('partners.collaborator.register');

Route::get('invitation/login/client', [MainController::class, 'inviteClientLogin'])->name('partners.addClientLogin');

Route::post('invitation/login/client/store-processing', [AdminProjectPartnerController::class, 'client_store'])->name('partners.client.register');

Route::get('invitation/login/connexion', [MainController::class, 'inviteLoginConnexion'])->name('partners.inviteLoginConnexion');

Route::post('invitation/login/connexion-processing', [MainController::class, 'partner_login'])->name('partners.invitePartnerLogin');



