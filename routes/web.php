<?php
use App\Http\Controllers\EspaceVertController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\RessourceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AIMessageController;
use App\Http\Controllers\PartenaireController;
use App\Http\Controllers\FinancementController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProjetReportController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AnalyseIAController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
use App\Http\Controllers\AIMessageController;
/* 
Route::get('/', function () {
    return view('welcome');
}); */

/* Route::get('/', function () {
    return view('frontoffice/home');
}); */

Route::get('/custom-verify', function () {
    return view('auth.custom-verify'); // your custom Blade view
})->name('verification.notice')->middleware('auth');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('status', 'verification-link-sent');
})->middleware(['auth'])->name('verification.send');

/* Route par défaut */

Route::get('/forgot-password', [UserController::class, 'showForgetPassword'])->name('password.request');
Route::post('/forgot-password', [UserController::class, 'sendResetLink'])->name('password.email');

Route::get('/reset-password/{token}', [UserController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [UserController::class, 'reset'])->name('reset');

Route::get('/partenaires', [PartenaireController::class, 'indexFront'])->name('partenaires.indexFront');
/* Backoffice */
Route::prefix('dashboard')->middleware(['auth', 'verified', 'role:Admin'])->group(function () {
    Route::get('/profile', [UserController::class, 'profileAdmin'])->name('admin.profile');
    Route::get('/profile/reset-password', [UserController::class, 'showResetPasswordAdmin'])->name('admin.password.reset');
    Route::put('/profile/update-password', [UserController::class, 'updatePassword'])->name('admin.password.update');
    Route::get('/profile/update-profile', [UserController::class, 'showUpdateProfile'])->name('admin.profile.showUpdate');
    Route::put('/profile/update-profile', [UserController::class, 'updateProfile'])->name('admin.profile.update');


    Route::get('/users',[UserController::class, 'index'])->name('users.index');
    Route::post('/users/delete/{id}',[UserController::class, 'destroy'])->name('users.destroy');
        // Gestion des événements
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');
    Route::get('/', function () {
        return view('backoffice/home');
    })->name('dashboard.home');

    // Resource routes for activities
    Route::resource('activities', ActivityController::class);
    Route::get('activities/search', [ActivityController::class, 'search'])->name('activities.search');
    Route::get('activities/export', [ActivityController::class, 'export'])->name('activities.export');


    Route::resource('projects', controller: ProjetController::class);
    
    Route::resource('espaces_verts', EspaceVertController::class) ->parameters(['espaces_verts' => 'espace']);

    Route::get('/members', function () {
        return view('backoffice/members');
    })->name('dashboard.members');


    // CRUD Ressources
Route::resource('ressources', RessourceController::class);

// AI analysis for resources
Route::post('/ressources/analyze', [RessourceController::class, 'analyze'])->name('ressources.analyze');
    // CRUD Fournisseurs
    Route::resource('fournisseurs', FournisseurController::class);
    // CRUD partenaires => /dashboard/partenaires
    Route::resource('partenaires', PartenaireController::class);

   
   
       Route::prefix('financements')->group(function () {
        Route::get('/analyse-ia', [AnalyseIAController::class, 'showForm'])->name('financements.analyse.form');
        Route::post('/analyse-ia/run', [AnalyseIAController::class, 'analyser'])->name('financements.analyse.run');
    });
     Route::resource('financements', FinancementController::class);
});

/* Authentification */
Route::get('/register', function () {
    return view('auth/register');
})->middleware('RedirectIfAuthenticated')->name('register');

Route::get('/signin', function () {
    return view('auth/login');
})->middleware('RedirectIfAuthenticated')->name('login');

Route::post('/signup', [UserController::class, 'signup'])->name('signup');
Route::post('/login', [UserController::class, 'login'])->name('signin');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// ==================== BACKOFFICE (Dashboard - Authentifié) ====================
Route::prefix('dashboard')->middleware(['auth', 'verified', 'role:Admin'])->group(function () {

});

// Routes pour les projets

// Optional extra page: show a confirmation page before deleting

Route::prefix('')->middleware(['blockAdmin'])->group(function(){
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/profile',[UserController::class, 'showProfile'])->middleware('auth', 'verified', 'role:User')->name('profile');
    Route::get('/profile/reset-password', [UserController::class, 'showResetPassword'])->middleware('auth', 'verified', 'role:User')->name('reset.password');
    Route::put('/profile/password', [UserController::class, 'updatePassword'])->middleware('auth', 'verified', 'role:User')->name('password.update');
    Route::get('/profile/update-profile', [UserController::class, 'showUpdateProfileUser'])->middleware('auth', 'verified', 'role:User')->name('user.profile.showUpdate');
    Route::put('/profile/update-profile', [UserController::class, 'updateProfile'])->middleware('auth', 'verified', 'role:User')->name('user.profile.update');

    Route::get('/Projects', [ProjetController::class, 'frontIndex'])->name('projects.front.index');
    Route::get('/Projects/{project}', [ProjetController::class, 'frontShow'])
        ->name('projects.front.show');
    Route::get('/MyActivities', [ActivityController::class, 'indexFront'])->name('activities.front.index');
    Route::post('/feedbacks/add-feedback/{idActivite}', [FeedbackController::class, 'store'])->name('activities.feedback.store');
    Route::post('/feedbacks/update/{idFeedback}', [FeedbackController::class, 'update'])->name('activities.feedback.update');
    Route::post('/feedbacks/delete/{idFeedback}', [FeedbackController::class, 'destroy'])->name('activities.feedback.delete');
    // Routes frontoffice pour les événements
    Route::get('/events', [App\Http\Controllers\EventController::class, 'frontIndexAll'])->name('events.front.index');
    Route::get('/events/{id}', [App\Http\Controllers\EventController::class, 'frontShow'])->name('events.front.show'); 
});

   

Route::get('/projets/{id}/rapport', [ProjetReportController::class, 'generate'])
    ->name('projects.pdf');
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::get('/notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.read');
Route::delete('/destroy/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy'); 

Route::post('/events/generate-ai', [EventController::class, 'generateAiImage'])
    ->name('events.generateAI');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    $user = Auth::user();

    // ✅ Redirect based on role after verification
    if ($user->role === 'Admin') {
        return redirect('/dashboard');
    }

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');
    /******/
Route::post('/events/{idEvenement}/participate', [EventController::class, 'participate'])
    ->name('events.participate');

Route::middleware('auth')->group(function () {
    Route::post('/events/{idEvenement}/cancel', [EventController::class, 'annulerParticipation'])
         ->name('events.cancel');
});



Route::post('/activities/{idActivite}/participate', [ActivityController::class, 'participate'])
    ->name('activite.participate')->middleware(['auth','role:User']);

Route::middleware('auth')->group(function () {
    Route::post('/activities/{idActivite}/cancel', [ActivityController ::class, 'annulerParticipation'])
         ->name('activite.cancel');
});

Route::post('/ai/generate-email', [AIMessageController::class, 'generate'])->name('ai.generate');


Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

