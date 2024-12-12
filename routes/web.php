<?php

use App\Http\Controllers\adminNavController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('index');
})->name('home');

// Rute untuk kuisioner, mengarahkan ke halaman identitas
Route::get('/questionnaire', [QuestionnaireController::class, 'viewQuesionnaire'])->middleware(['role:alumni'])->name('identity');

// Menangani pengiriman status kuisioner
Route::post('/questionnaire/status', [QuestionnaireController::class, 'storeStatus'])->name('questionnaire.storeStatus');

Route::middleware(['role:alumni'])->group(function () {
    Route::get('/questionnaire/form-bekerja', [QuestionnaireController::class, 'viewBekerja'])->name('questionnaire.form-bekerja');
    Route::get('/questionnaire/form-belum-bekerja', [QuestionnaireController::class, 'viewBelumBekerja'])->name('questionnaire.form-belum-bekerja');
    Route::get('/questionnaire/form-wiraswasta', [QuestionnaireController::class, 'viewWiraswasta'])->name('questionnaire.form-wiraswasta');
    Route::get('/questionnaire/form-melanjutkan-pendidikan', [QuestionnaireController::class, 'viewMelanjutkanPendidikan'])->name('questionnaire.form-melanjutkan-pendidikan');
    Route::get('/questionnaire/form-mencari-kerja', [QuestionnaireController::class, 'viewMencariKerja'])->name('questionnaire.form-mencari-kerja');
});

Route::get('/usersurvey', function () {
    return view('usersurvey');
})->name('usersurvey');  // Tidak ada middleware 'auth'

Route::get('/report', [ReportController::class, 'view'])->name('report');
Route::get('/get-prodi', [ReportController::class, 'getProdi'])->name('report.get-prodi');
Route::get('/get-tahun-angkatan', [ReportController::class, 'getAngkatan'])->name('report.get-tahun-angkatan');
Route::get('/get-report', [ReportController::class, 'getReport'])->name('report.get-report');


Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('post.login');
Route::post('/logout', [AuthController::class, 'getLogout'])->name('logout');

// Admin Routes
Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/admin', [adminNavController::class, 'showDashboard'])->name('dashboard');
    Route::get('/admin/questionnaire', [adminNavController::class, 'showQuestionnaire'])->name('data.questionnaire');
    Route::get('/admin/questionnaire/data', [adminNavController::class, 'dataQuestionnaire'])->name('data.data-questionnaire');
    Route::get('/admin/questionnaire/add', [adminNavController::class, 'addQuestionnaire'])->name('data.add-questionnaire');
    Route::get('/admin/questionnaire/edit/{id}', [adminNavController::class, 'editQuestionnaire'])->name('data.edit-questionnaire');
    Route::post('/admin/questionnaire', [adminNavController::class, 'postAddQuestionnaire'])->name('data.post-add-questionnaire');
    Route::post('/admin/questionnaire/edit/{id}', [adminNavController::class, 'postEditQuestionnaire'])->name('data.post-edit-questionnaire');
    Route::get('/admin/questionnaire/delete/{id}', [adminNavController::class, 'deleteQuestionnaire'])->name('data.delete-questionnaire');

    Route::get('/admin/responden', [adminNavController::class, 'showRespondens'])->name('data.responden');
    Route::get('/admin/responden/data', [adminNavController::class, 'dataResponden'])->name('data.data-responden');
    Route::get('/admin/statistik', [adminNavController::class, 'showStatistik'])->name('data.statistik');
    Route::get('/admin/unggah-data', [adminNavController::class, 'showUnggah'])->name('data.unggah');
    Route::get('/admin/unduh-data', [adminNavController::class, 'showUnduh'])->name('data.unduh');
    Route::get('/admin/unduh-data/csv/{survey_id}', [adminNavController::class, 'unduhCSV'])->name('data.unduh-data-csv');
    Route::get('/admin/panduan-form', [adminNavController::class, 'showPanduan'])->name('data.panduan');
    Route::get('/admin/faq', [adminNavController::class, 'showFAQ'])->name('data.faq');
    Route::get('/admin/contact', [adminNavController::class, 'showContact'])->name('data.contact');
    Route::get('/admin/user-survey', [adminNavController::class, 'showSurvey'])->name('user.survey');

    // Logout route for admin
    Route::post('/admin/logout', [AuthController::class, 'getLogout'])->name('admin.logout');
});

// Questionnaire Submission
Route::post('/questionnaire/submit', [App\Http\Controllers\QuestionnaireController::class, 'submit'])
    ->middleware(['auth', 'role:alumni'])
    ->name('questionnaire.submit');