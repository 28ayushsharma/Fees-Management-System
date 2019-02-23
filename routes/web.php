<?php

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
Route::get('/', 'HomeController@index');


/**================  Admin routing START ==========================**/
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function(){
    /**====== Routes before login =============**/
    Route::get('/', 'LoginController@index')->name('Admin.login');
    Route::post('/login', 'LoginController@login')->name('Admin.logincheck');

    /**====== authadmin middleware Routes START================**/
    Route::middleware(['authadmin'])->group(function (){
        Route::get('/logout', 'LoginController@logout')->name('admin.logout');
        Route::get('/dashboard', 'DashboardController@index')->name('Admin.dashboard');

    /**===== User Management START =====**/
        Route::get('users', 'UserController@index')->name('user.index');
        Route::get('users-add', 'UserController@add')->name('user.add');
        Route::post('users-save', 'UserController@save')->name('user.save');
        Route::get('users-edit/{id}', 'UserController@edit')->name('user.edit');
        Route::post('users-update/{id}', 'UserController@update')->name('user.update');
        Route::get('users-edit-password/{id}', 'UserController@editPassword')->name('user.editPassword');
        Route::post('users-update-password/{id}', 'UserController@updatePassword')->name('user.updatePassword');
        Route::get('users-change-status/{id}', 'UserController@changeStatus')->name('user.changeStatus');
    /**===== User Management END =====**/

    /**===== Class Routing START =====**/
        Route::get('class', 'ClassController@index')->name('Class.index');
        Route::get('class-search', 'ClassController@searchClass')->name('Class.search');
        Route::get('class-add', 'ClassController@addClass')->name('Class.add');
        Route::post('class-save', 'ClassController@saveClass')->name('Class.save');
        Route::get('class-edit/{id}', 'ClassController@editClass')->name('Class.edit');
        Route::post('class-update/{id}', 'ClassController@updateClass')->name('Class.update');
        Route::get('class-delete/{id}', 'ClassController@deleteClass')->name('Class.delete');
    /**===== Class Routing END =====**/

    /**===== Student Routing STARTS =====**/
        Route::get('student', 'StudentController@index')->name('Student.index');
        Route::get('student-incomplete', 'StudentController@getIncompleteStudentList')->name('Student.incompleteList');
        Route::get('student-add', 'StudentController@addstudent')->name('Student.add');
        Route::post('student-save', 'StudentController@saveStudent')->name('Student.save');
        Route::get('student-edit/{id}', 'StudentController@editStudent')->name('Student.edit');
        Route::get('student-view/{id}', 'StudentController@viewStudent')->name('Student.view');
        Route::post('student-update/{id}', 'StudentController@updateStudent')->name('Student.update');
        Route::get('student-delete/{id}', 'StudentController@deleteStudent')->name('Student.delete');
        Route::any('student-search', 'StudentController@searchStudent')->name('Student.search');
        Route::post('student-getlist', 'StudentController@getList')->name('Student.getList');
        /*==> join student routing
        Route::any('/student-create-join', 'StudentController@createJoin')->name('Student.createJoin');
        Route::any('/student-join', 'StudentController@joinStudent')->name('Student.join');
        Route::get('/student-viewviewgroup/{gid}', 'StudentController@viewGroupStudent')->name('Student.viewgroup');
        Route::any('/student-remove', 'StudentController@removeStudent')->name('Student.remove');
        */
    /**===== Student Routing END =====**/

    /*===== Fees Structure Routing STARTS =====*/
        Route::get('fees-structure', 'FeeStructureController@index')->name('feestructure.index');
        Route::get('fees-structure-add', 'FeeStructureController@add')->name('feestructure.add');
        Route::post('fees-structure-save', 'FeeStructureController@save')->name('feestructure.save');
        Route::get('fees-structure-edit/{id}', 'FeeStructureController@edit')->name('feestructure.edit');
        Route::post('fees-structure-update/{id}', 'FeeStructureController@update')->name('feestructure.update');
        Route::get('fees-structure-delete/{id}', 'FeeStructureController@delete')->name('feestructure.delete');
        Route::get('fees-structure-search', 'FeeStructureController@searchClass')->name('feestructure.search');
    /**===== Fees Structure Routing END =====**/

    /**===== Fees Entry Routing STARTS =====**/
        Route::get('fees-entry','FeesEntryController@index')->name('feesEntry.index');
        Route::get('fees-entry-search','FeesEntryController@search')->name('feesEntry.search');
        Route::get('fees-entry-get-details/{id}','FeesEntryController@getDetails')->name('feesEntry.getDetails');
        Route::get('fees-entry-payfees/{id}','FeesEntryController@payFees')->name('feesEntry.payfees');
        Route::post('fees-entry-submitfees/{id}','FeesEntryController@submitFees')->name('feesEntry.submitfees');
        Route::get('fees-entry-print-invoice/{id}','FeesEntryController@printInvoice')->name('feesEntry.printInvoice');

        Route::get('fees-entry-edit/{id}', 'FeesEntryController@edit')->name('feesEntry.edit');
        Route::post('fees-entry-update/{id}', 'FeesEntryController@update')->name('feesEntry.update');
    /**===== Fees Entry routing END =====**/
    
    /**===== Reporting routing START =====**/
        Route::get('reportings/collection-report','ReportingsController@getCollectionReport')->name('reporting.collection');
        Route::any('reportings/collection-report-details','ReportingsController@getCollectionReportDetails')->name('reporting.collectionDetails');
        Route::get('reportings/fees-received-enteryes','ReportingsController@getFeesReceivedData')->name('reporting.feesReceivedData');
    /**===== Reporting routing END  =====**/


    });
    /**====== authadmin middleware Routes END================**/
});//admin namespace
/**================  Admin Routing END ==========================**/