<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\Setup\ExamController;
use App\Http\Controllers\Backend\Setup\FeeAmountController;
use App\Http\Controllers\Backend\Setup\FeeCategoryController;
use App\Http\Controllers\Backend\Setup\StudentClassController;
use App\Http\Controllers\Backend\Setup\StudentGroupController;
use App\Http\Controllers\Backend\Setup\StudentShiftController;
use App\Http\Controllers\Backend\Setup\StudentYearController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Setup\SchoolSubjectController;
use App\Http\Controllers\Backend\Setup\AssignSubjectController;
use App\Http\Controllers\Backend\Setup\DesignationController;
use App\Http\Controllers\Backend\Student\StudentRegController;




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
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});

Route::get('admin/logout', [AdminController::class, 'Logout'])->name('admin.logout');

//User management all Routes

Route::prefix('users')->group(function(){
    Route::get('/view', [UserController::class, 'UserView'])->name('user.view');
    
    Route::get('/add', [UserController::class, 'UserAdd'])->name('user.add');
    
    Route::post('/store', [UserController::class, 'UserStore'])->name('users.store');

    Route::get('/edit/{id}', [UserController::class, 'UserEdit'])->name('users.edit');
    
    Route::post('/update/{id}', [UserController::class, 'UserUpdate'])->name('users.update');

    Route::get('/delete/{id}', [UserController::class, 'UserDelete'])->name('users.delete');

});

//user profile and change password
Route::prefix('profiles')->group(function(){
    Route::get('/view', [ProfileController::class, 'ProfileView'])->name('profile.view');
    
    Route::get('/edit', [ProfileController::class, 'ProfileEdit'])->name('profile.edit');

    Route::post('/store', [ProfileController::class, 'ProfileStore'])->name('profile.store');

    Route::get('/password/view', [ProfileController::class, 'PasswordView'])->name('password.view');

    Route::post('/password/update', [ProfileController::class, 'PasswordUpdate'])->name('password.update');


});


Route::prefix('setups')->group(function(){
    Route::get('student/class/view', [StudentClassController::class, 'ViewStudent'])->name('student.class.view');
   
    Route::get('student/class/add', [StudentClassController::class, 'StudentClassAdd'])->name('student.class.add');

    Route::post('student/class/store', [StudentClassController::class, 'StoreStudentClass'])->name('store.student.class');

    Route::get('student/class/edit/{id}', [StudentClassController::class, 'StudentClassEdit'])->name('student.class.edit');

    Route::post('student/class/update{id}', [StudentClassController::class, 'StudentClassUpdate'])->name('update.student.class');

    Route::get('student/class/delete{id}', [StudentClassController::class, 'StudentClassDelete'])->name('student.class.delete');

    //student year routes
    Route::get('student/year/view', [StudentYearController::class, 'ViewYear'])->name('student.year.view');
    
    Route::get('student/year/add', [StudentYearController::class, 'StudentYearAdd'])->name('student.year.add');

    Route::post('student/year/store', [StudentYearController::class, 'StudentYearStore'])->name('store.student.year');

    Route::get('student/year/edit/{id}', [StudentYearController::class, 'StudentYearEdit'])->name('student.year.edit');

    Route::post('student/year/update{id}', [StudentYearController::class, 'StudentYearUpdate'])->name('update.student.year');

    Route::get('student/year/delete{id}', [StudentYearController::class, 'StudentYearDelete'])->name('student.year.delete');

    //student group routes
    Route::get('student/group/view', [StudentGroupController::class, 'ViewGroup'])->name('student.group.view');

    Route::get('student/group/add', [StudentGroupController::class, 'StudentGroupAdd'])->name('student.group.add');

    Route::post('student/group/store', [StudentGroupController::class, 'StudentGroupStore'])->name('store.student.group');

    Route::get('student/group/edit/{id}', [StudentGroupController::class, 'StudentGroupEdit'])->name('student.group.edit');

    Route::post('student/group/update{id}', [StudentGroupController::class, 'StudentGroupUpdate'])->name('update.student.group');

    Route::get('student/group/delete{id}', [StudentGroupController::class, 'StudentGroupDelete'])->name('student.group.delete');

    //student group routes
    Route::get('student/shift/view', [StudentShiftController::class, 'ViewShift'])->name('student.shift.view');

    Route::get('student/shift/add', [StudentShiftController::class, 'StudentShiftAdd'])->name('student.shift.add');

    Route::post('student/shift/store', [StudentShiftController::class, 'StudentShiftStore'])->name('store.student.shift');

    Route::get('student/shift/edit/{id}', [StudentShiftController::class, 'StudentShiftEdit'])->name('student.shift.edit');

    Route::post('student/shift/update{id}', [StudentShiftController::class, 'StudentShiftUpdate'])->name('update.student.shift');

    Route::get('student/shift/delete{id}', [StudentShiftController::class, 'StudentShiftDelete'])->name('student.shift.delete');

     //student fee routes
    Route::get('fee/category/view', [FeeCategoryController::class, 'ViewFeeCat'])->name('fee.category.view');

    Route::get('fee/category/add', [FeeCategoryController::class, 'FeeCatAdd'])->name('fee.category.add');

    Route::post('fee/category/store', [FeeCategoryController::class, 'FeeCatStore'])->name('store.fee.cat');

    Route::get('fee/category/edit/{id}', [FeeCategoryController::class, 'FeeCatEdit'])->name('fee.category.edit');

    Route::post('fee/category/update/{id}', [FeeCategoryController::class, 'FeeCatUpdate'])->name('fee.cat.update');

    Route::get('fee/category/delete{id}', [FeeCategoryController::class, 'FeeCatDelete'])->name('fee.category.delete');

//fee category ammount routes
    Route::get('fee/amount/view', [FeeAmountController::class, 'ViewFeeAmount'])->name('fee.amount.view');

    Route::get('fee/amount/add', [FeeAmountController::class, 'AddFeeAmount'])->name('fee.amount.add');

    Route::post('fee/amount/store', [FeeAmountController::class, 'StoreFeeAmount'])->name('store.fee.amount');

    Route::get('fee/amount/edit/{fee_category_id}', [FeeAmountController::class, 'EditFeeAmount'])->name('fee.amount.edit');

    Route::post('fee/amount/update/{fee_category_id}', [FeeAmountController::class, 'UpdateFeeAmount'])->name('update.fee.amount');

    Route::get('fee/amount/details/{fee_category_id}', [FeeAmountController::class, 'DetailsFeeAmount'])->name('fee.amount.details');

     //student exam type routes
     Route::get('exam/type/view', [ExamController::class, 'ViewExamType'])->name('exam.type.view');

     Route::get('exam/type/add', [ExamController::class, 'AddExamType'])->name('exam.type.add');
 
     Route::post('exam/type/store', [ExamController::class, 'StoreExamType'])->name('store.exam.type');
 
     Route::get('exam/type/edit/{id}', [ExamController::class, 'EditExamType'])->name('exam.type.edit');
 
     Route::post('exam/type/update/{id}', [ExamController::class, 'UpdateExamType'])->name('update.exam.type');
 
     Route::get('exam/type/delete{id}', [ExamController::class, 'DeleteExamType'])->name('delete.exam.type');
 

    //school subject route
    Route::get('school/subject/view', [SchoolSubjectController::class, 'ViewSchoolSubject'])->name('school.subject.view');

    Route::get('school/subject/add', [SchoolSubjectController::class, 'AddSchoolSubject'])->name('school.subject.add');

    Route::post('school/subject/store', [SchoolSubjectController::class, 'StoreSchoolSubject'])->name('store.school.subject');

    Route::get('school/subject/edit/{id}', [SchoolSubjectController::class, 'EditSchoolSubject'])->name('school.subject.edit');

    Route::post('school/subject/update/{id}', [SchoolSubjectController::class, 'UpdateSchoolSubject'])->name('update.school.subject');

    Route::get('school/subject/delete{id}', [SchoolSubjectController::class, 'DeleteSchoolSubject'])->name('delete.school.subject');

    //assign subject routes
    Route::get('assign/subject/view', [AssignSubjectController::class, 'ViewAssignSubject'])->name('assign.subject.view');

    Route::get('assign/subject/add', [AssignSubjectController::class, 'AddAssignSubject'])->name('assign.subject.add');

    Route::post('assign/subject/store', [AssignSubjectController::class, 'StoreAssignSubject'])->name('store.assign.subject');

    Route::get('assign/subject/edit/{class_id}', [AssignSubjectController::class, 'EditAssignSubject'])->name('assign.subject.edit');

    Route::post('assign/subject/update/{class_id}', [AssignSubjectController::class, 'UpdateAssignSubject'])->name('update.assign.subject');

    Route::get('assign/subject/details/{class_id}', [AssignSubjectController::class, 'DetailsAssignSubject'])->name('assign.subject.details');

    
    //designation all route
    Route::get('designation/view', [DesignationController::class, 'ViewDesignation'])->name('designation.view');

    Route::get('designation/add', [DesignationController::class, 'AddDesignation'])->name('designation.add');

    Route::post('designation/store', [DesignationController::class, 'StoreDesignation'])->name('store.designation');

    Route::get('designation/edit/{id}', [DesignationController::class, 'EditDesignation'])->name('edit.designation');

    Route::post('designation/update/{id}', [DesignationController::class, 'UpdateDesignation'])->name('update.designation');

    Route::get('designation/delete{id}', [DesignationController::class, 'DeleteDesignation'])->name('delete.designation');



});


Route::prefix('students')->group(function(){
    Route::get('/reg/view', [StudentRegController::class, 'StudentRegView'])->name('student.registration.view');

    Route::get('/reg/add', [StudentRegController::class, 'StudentRegAdd'])->name('student.registration.add');

});


 