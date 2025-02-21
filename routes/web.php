<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\BatchController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\StudentProgramEnrollmentController;
use App\Http\Controllers\Admin\TestSeries\StudentDetailController;
use App\Http\Controllers\Admin\TestSeries\PreparationDetailController;
use App\Http\Controllers\Admin\TestSeries\SourcesUsedController;
use App\Http\Controllers\Admin\TestSeries\CsatPreparationController;
use App\Http\Controllers\Admin\TestSeries\AdditionalPreparationController;
use App\Http\Controllers\Admin\TestSeries\PersonalityDetailController;
use App\Http\Controllers\Admin\TestSeries\SfgProgramKnowledgeController;

// Form Controller
use App\Http\Controllers\Web\StudentFormController;
use App\Http\Controllers\Web\StudentController;

// use App\Http\Controllers\Web\StudentRegistrationController;
// Subhankarbasakmail
use App\Http\Controllers\Form\StudentRegistrationController;
use App\Http\Controllers\Web\StudentInfoController;
use App\Http\Controllers\Web\DeepseekFormController;







// Route::get('/', function () {
//     return view('welcome');
// });

// Admin Routes

// Program routes
Route::resource('admin/programs', ProgramController::class);

// Student routes
Route::resource('admin/students', StudentController::class);
Route::resource('admin/enrollments', StudentProgramEnrollmentController::class);

// Batch routes
Route::resource('admin/batches', BatchController::class);

// Section routes
Route::resource('admin/sections', SectionController::class);

// For TestSeries Details
Route::resource('admin/student_details', StudentDetailController::class);
Route::resource('admin/preparation_details', PreparationDetailController::class);
Route::resource('admin/sources-used', SourcesUsedController::class);
Route::resource('admin/csat_preparations', CsatPreparationController::class);
Route::resource('admin/preparations', AdditionalPreparationController::class);
Route::resource('admin/personality_details', PersonalityDetailController::class);
Route::resource('admin/sfg_program_knowledges', SfgProgramKnowledgeController::class);


// 

// Step 1: Verify Student

Route::get('/verify-student', [StudentController::class, 'showVerifyForm'])->name('verify_student');
Route::post('/verify-student', [StudentController::class, 'verifyStudent'])->name('verify_student.post');
// Route::post('/verify-student', [StudentController::class, 'verifyStudent'])->name('verify_student');

// Step 2: Personal Details
Route::get('/student/{student_id}/personal-details', [StudentController::class, 'showPersonalDetailsForm'])->name('personal_details_form');
Route::post('/student/{student_id}/personal-details', [StudentController::class, 'savePersonalDetails'])->name('save_personal_details');

// Step 3: Student Details
Route::get('/student/{student_id}/student-details', [StudentController::class, 'showStudentDetailsForm'])->name('student_details_form');
Route::post('/student/{student_id}/student-details', [StudentController::class, 'saveStudentDetails'])->name('save_student_details');

// Step 4: Preparation Details
Route::get('/student/{student_id}/preparation-details', [StudentController::class, 'showPreparationDetailsForm'])->name('preparation_details_form');
Route::post('/student/{student_id}/preparation-details', [StudentController::class, 'savePreparationDetails'])->name('save_preparation_details');

// Step 5: Sources Used
Route::get('/student/{student_id}/sources-used', [StudentController::class, 'showSourcesUsedForm'])->name('sources_used_form');
Route::post('/student/{student_id}/sources-used', [StudentController::class, 'saveSourcesUsed'])->name('save_sources_used');

// Step 6: CSAT Preparation
Route::get('/student/{student_id}/csat-preparation', [StudentController::class, 'showCsatPreparationForm'])->name('csat_preparation_form');
Route::post('/student/{student_id}/csat-preparation', [StudentController::class, 'saveCsatPreparation'])->name('save_csat_preparation');

// Step 7: Additional Preparation
Route::get('/student/{student_id}/additional-preparation', [StudentController::class, 'showAdditionalPreparationForm'])->name('additional_preparation_form');
Route::post('/student/{student_id}/additional-preparation', [StudentController::class, 'saveAdditionalPreparation'])->name('save_additional_preparation');

// Step 8: Personality Details
Route::get('/student/{student_id}/personality-details', [StudentController::class, 'showPersonalityDetailsForm'])->name('personality_details_form');
Route::post('/student/{student_id}/personality-details', [StudentController::class, 'savePersonalityDetails'])->name('save_personality_details');

// Step 9: SFG Program Knowledge
Route::get('/student/{student_id}/sfg-program-knowledge', [StudentController::class, 'showSfgProgramKnowledgeForm'])->name('sfg_program_knowledge_form');
Route::post('/student/{student_id}/sfg-program-knowledge', [StudentController::class, 'saveSfgProgramKnowledge'])->name('save_sfg_program_knowledge');

// 

// Route::get('/student/register', [StudentRegistrationController::class, 'showLoginForm'])->name('student.register');
// Route::post('/student/verify', [StudentRegistrationController::class, 'verifyStudent'])->name('student.verify');

// Route::prefix('student')->middleware(['student.auth'])->group(function () {
//     Route::get('/step/{step}', [StudentRegistrationController::class, 'showForm'])->name('student.form');
//     Route::post('/step/{step}', [StudentRegistrationController::class, 'storeStep']);
//     Route::get('/preview/{unique_id}', [StudentRegistrationController::class, 'preview']);
//     Route::post('/final-submit', [StudentRegistrationController::class, 'finalSubmit']);
// });

Route::get('/student/register', [StudentRegistrationController::class, 'showLoginForm'])->name('student.register');
// Route::post('/student/verify', [StudentRegistrationController::class, 'verifyStudent'])->name('student.verify');

Route::prefix('student')->middleware(['student.auth'])->group(function () {
    Route::get('/form/{step}', [StudentRegistrationController::class, 'showForm'])->name('student.form');
    
    Route::post('/form/{step}', [StudentRegistrationController::class, 'storeStep'])->name('student.step');
    Route::get('/preview/{unique_id}', [StudentRegistrationController::class, 'preview'])->name('student.preview');
    Route::post('/final-submit', [StudentRegistrationController::class, 'finalSubmit'])->name('student.finalSubmit');
});



//

// Route::get('/student', [StudentFormController::class, 'showStudentForm'])->name('student.form');
// Route::post('/verify', [StudentFormController::class, 'verifyStudent'])->name('verify.student');
// Route::get('/form/step/{step}', [StudentFormController::class, 'showStep'])->name('form.step');
// Route::post('/form/step/{step}', [StudentFormController::class, 'saveStep'])->name('form.step.save');

// 





// subhankarbasakmail
// Route::get('/student/verify', [StudentRegistrationController::class, 'showVerificationForm'])->name('student.verify');
// Route::post('/student/verify', [StudentRegistrationController::class, 'verifyStudent'])->name('student.verify.post');

Route::get('/student/registration', [StudentRegistrationController::class, 'showRegistrationForm'])
    ->name('student.registration')
    ->middleware('verified.student');

// 
Route::get('/student/registration/step-1', [StudentRegistrationController::class, 'showPersonalDetails'])
    ->name('student.registration.step1')
    ->middleware('verified.student');

Route::post('/student/registration/step-1', [StudentRegistrationController::class, 'storePersonalDetails'])
    ->name('student.registration.step1.store');

Route::post('/student/registration/step-1/confirm', [StudentRegistrationController::class, 'confirmPersonalDetails'])
    ->name('student.registration.step1.confirm');

// 
Route::get('/student/registration/step1', [StudentRegistrationController::class, 'showStep1Form'])->name('student.step1');
Route::post('/student/registration/confirmStep1', [StudentRegistrationController::class, 'confirmStep1'])->name('student.registration.confirmStep1');
Route::post('/student/registration/previewStep1', [StudentRegistrationController::class, 'previewStep1'])->name('student.registration.previewStep1');
Route::post('/student/registration/finalizeStep1', [StudentRegistrationController::class, 'finalizeStep1'])->name('student.registration.finalizeStep1');
Route::get('/student/registration/step2', [StudentRegistrationController::class, 'showStep2Form'])->name('student.step2');




// 


// Show the enrollment form
// Route::get('/student/form', [StudentInfoController::class, 'showForm'])->name('student.form');

// Step 1: Store data for personal details
Route::post('/student/step1', [StudentInfoController::class, 'storeStep1'])->name('student.step1.store');

// Step 2: Store data for other details
Route::post('/student/step2', [StudentInfoController::class, 'storeStep2'])->name('student.step2.store');

// Step 3: Store data for additional details
Route::post('/student/step3', [StudentInfoController::class, 'storeStep3'])->name('student.step3.store');

// Generate PDF
Route::post('/student/generate-pdf', [StudentInfoController::class, 'generatePdf'])->name('student.generate.pdf');

// Final form submission
Route::post('/student/final-submit', [StudentInfoController::class, 'finalSubmit'])->name('student.final.submit');

// Confirm the submission
Route::post('/student/confirm-submission', [StudentInfoController::class, 'confirmSubmission'])->name('student.confirm.submit');




// Deepseek:
    
    // Verification Routes
    Route::get('/', [DeepseekFormController::class, 'showVerification'])
    ->name('student.verification');

    // Route::get('/student-form', [DeepseekFormController::class, 'showVerification'])
    //     ->name('student.verification');
    
    Route::post('/student-form/verify', [DeepseekFormController::class, 'verifyStudent'])
        ->name('student.verify');
    
    // Protected Form Steps
    Route::middleware(['student.verified'])->group(function () {
        // Form Steps
        Route::get('/form/step/{step}', [DeepseekFormController::class, 'showStep'])
            ->name('form.step');
        
        Route::post('/form/step/{step}', [DeepseekFormController::class, 'submitStep']);
        
        // Preview & Submission
        Route::get('/form/preview', [DeepseekFormController::class, 'showPreview'])
            ->name('form.preview');
        
        Route::post('/form/final-submit', [DeepseekFormController::class, 'finalSubmit'])
            ->name('form.final-submit');
        
        Route::get('/form/download-pdf', [DeepseekFormController::class, 'downloadPdf'])
            ->name('form.download-pdf');
        
        // Completion Page
        Route::get('/form/complete', [DeepseekFormController::class, 'completion'])
            ->name('form.complete');

            Route::get('/form/submit', [DeepseekFormController::class, 'finalSubmit'])
            ->name('form.submit');
    });




// Enrollment routes
// Route::get('admin/students/{student}/enrollments', [EnrollmentController::class, 'showEnrollments'])->name('students.enrollments');
// Route::get('admin/students/{student}/enrollments/current', [EnrollmentController::class, 'showCurrentEnrollments'])->name('students.currentEnrollments');
// Route::post('admin/students/{student}/enroll', [EnrollmentController::class, 'enroll'])->name('students.enroll');
// Route::delete('admin/students/{student}/enrollment/{enrollment}', [EnrollmentController::class, 'withdraw'])->name('students.withdraw');



//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

// Clear All at once

Route::get('/clear', function() {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');

    return "Cleared!";

});