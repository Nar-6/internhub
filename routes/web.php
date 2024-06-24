<?php

use App\Http\Controllers\AdministrateurController;
use App\Http\Controllers\CandidatController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartementController;
use App\Models\Administrateur;
use App\Models\Candidat;
use App\Models\Candidature;
use App\Http\Controllers\EmployesController;
use App\Models\Employe;
use App\Models\OffreDeStage;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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


// CANDIDAT
Route::get('/', function () {
    return view('accueil');
})->name('home');

Route::get('/my-profile', function () {
    return view('profile');
})->name('profile')->middleware('auth');

Route::get('/offers', function () {
    $offers = OffreDeStage::all();
    return view('intern', compact('offers'));
})->name('offers');

Route::get('/signin', function () {
    return view('forms/signin');
})->name('signin')->middleware('guest');

Route::get('/signup', function () {
    return view('forms/signup');
})->name('signup')->middleware('guest');

Route::get('/admin', function () {
    return view('admin/login');
});

Route::group(['middleware' => ['auth','admin']], function () {

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/admin/dashboard/candidatures', [DashboardController::class, 'candidatures'])->name('dashboard.candidatures');
    Route::get('/admin/dashboard/entretiens', [DashboardController::class, 'entretiens'])->name('dashboard.entretiens');
    Route::get('/admin/dashboard/profil/candidat/{candidat_id}/{candidature_id}', [DashboardController::class, 'profilCandidat'])->name('dashboard.profilCandidat');
    Route::get('/admin/dashboard/candidature/{candidature_id}/{choix}', [DashboardController::class,'choix'])->name('dashboard.choix');
    Route::get('/admin/dashboard/tests', [DashboardController::class,'tests'])->name('dashboard.tests');
    Route::post('/admin/dashboard/tests/questions/form', [DashboardController::class,'questionsShow'])->name('dashboard.questionsShow');
    Route::post('/admin/dashboard/tests/store', [DashboardController::class,'testsStore'])->name('tests.store');
    Route::get('/admin/dashboard/test/{test_id}', [DashboardController::class,'testShow'])->name('admin.test.show');
    Route::post('/admin/dashboard/soumettre/test/{test_id}/{candidature_id}', [DashboardController::class,'soumettreTest'])->name('soumettre.test');
    Route::get('/admin/dashboard/offres', [DashboardController::class,'offres'])->name('dashboard.offres');
    Route::get('/admin/dashboard/offre/{offre_id}', [DashboardController::class,'offreShow'])->name('admin.offre.show');
    Route::post('/admin/dashboard/offres/store', [DashboardController::class,'offresStore'])->name('offres.store');
});


Route::post('/candidat/store', [CandidatController::class, 'store'])->name('candidat.store');
Route::delete('/candidat/logout', [CandidatController::class, 'logout'])->name('candidat.logout');
Route::post('/candidat/login', [CandidatController::class, 'login'])->name('candidat.login');
Route::post('/candidature/create', [CandidatureController::class, 'create'])->name('candidature.create')->middleware(['auth','candidat']);
Route::post('/admin/login', [AdministrateurController::class, 'login'])->name('admin.login');
Route::get('/candidat/passer/test/{candidature_id}/{test_id}',  [CandidatController::class, 'passerTest'])->name('candidat.passer.test')->middleware('auth');
Route::post('/photo', [CandidatController::class, 'photoStore'])->name('photo.store');
Route::post('/ans', [CandidatController::class, 'ansStore'])->name('ans.store');
Route::get('/candidat/resultat/technique/{candidature_id}/{test_id}',  [CandidatController::class, 'resultatTech'])->name('resultat.tech');
Route::post('/entretien',  [CandidatController::class, 'entretien'])->name('entretien');
Route::get('/entretien/{candidature_id}',  [CandidatController::class, 'entretienVideo'])->name('entretien.video');

Route::get('/test', function () {
    return view('test');
});

//les routes pour le crud EmployesController et employé

//departement

Route::get('/index',[DepartementController::class,'index'])->name('index');
Route::get('create',[DepartementController::class,'create'])->name('create');
Route::post('form',[DepartementController::class,'store'])->name('form');
Route::get('{course}/edit',[DepartementController::class,'edit'])->name('edit');
Route::put('{course}/update',[DepartementController::class,'update'])->name('update');
Route::delete('{course}/delete',[DepartementController::class,'destroy'])->name('delete');

//employé

Route::get('/index',[EmployesController::class,'index'])->name('index');
Route::get('create',[EmployesController::class,'create'])->name('create');
Route::post('form',[EmployesController::class,'store'])->name('form');
Route::get('{course}/edit',[EmployesController::class,'edit'])->name('edit');
Route::put('{course}/update',[EmployesController::class,'update'])->name('update');
Route::delete('{course}/delete',[EmployesController::class,'destroy'])->name('delete');

