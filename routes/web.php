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

Route::get('try', function () {
    return view('demo');
});

Route::middleware('auth')->group(function () {
    Route::get('/', 'Controller@redirectToLogin');
    Route::get('changePasswordView', 'Controller@changePasswordView')->name('changePasswordView');

    Route::post('changePassword', 'Controller@changePassword')->name('changePassword');

    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

//Loanee Routes
    Route::get('add-Loanee', 'LoanUserController@addLoaneeView')->name('addLoaneeView');
    Route::get('/view-Loanee', 'LoanUserController@viewLoanee')->name('viewLoanee');
    Route::get('get-Loanee', 'LoanUserController@getLoanee')->name('getLoanee');
    Route::get('get-details/{id}', 'LoanUserController@viewLoaneeDetails')->name('getLoaneeDetails');
    Route::post('/storeLoanee', 'LoanUserController@addLoanee')->name('addLoanee');
    Route::post('editLoanee/{id}', 'LoanUserController@editLoanee')->name('editLoanee');
    Route::get('getAgent', 'LoanUserController@getAgent')->name('getAgent');
    Route::get('viewAgent', 'LoanUserController@viewAgent')->name('viewAgent');
    Route::get('getAgentDetails/{id}', 'LoanUserController@getAgentDetails')->name('getAgentDetails');


//Loan Routes
    Route::get('/giveLoan', 'LoanController@giveLoan')->name('giveLoanView');

// Store Different Types of Loan
    Route::post('/store', 'LoanController@store')->name('storeLoan');
    Route::post('/storePercentage', 'LoanPercentageController@store')->name('storePercentageLoan');
    Route::post('/storeRoom', 'LoanRoomController@store')->name('storeRoomLoan');

    Route::get('/view-Loan', 'LoanController@viewLoan')->name('viewLoans');
    Route::get('get-Loans/{id}/{id2}', 'LoanController@getLoans')->name('getLoans');
    Route::get('view-Loans/{id}', 'LoanController@viewLoanDetails')->name('viewLoanDetails');
    Route::get('get-Records/{id}', 'LoanController@getRecords')->name('getRecords');
    Route::get('view-LoanDetails/{id}', 'LoanController@LoanDetails')->name('getLoanDetails');
    Route::get('closeCard/{id}', 'LoanController@closeCard')->name('closeCard');
    Route::get('extendRecord/{id}', 'LoanController@extendRecords')->name('extendRecord');

//List Of All Types of Requests
    Route::get('days_list', 'LoanController@list')->name('list-days');
    Route::get('percentage_list', 'LoanPercentageController@list')->name('list-percentage');
    Route::get('room_list', 'LoanRoomController@list')->name('list-room');
    Route::get('pending_list', 'RecordController@pending_list')->name('pending_list');

    //Loan Profile Page
    Route::get('loan_percentage_show/{id}', 'LoanPercentageController@show');
    Route::get('loan_room_show/{id}', 'LoanRoomController@show');


    Route::get('test_check', 'LoanRoomController@get_pending_records');
    //Loan Close Routes
    Route::get('close_percentage/{id}', 'LoanPercentageController@close_card')->name('close_percentage');
    Route::get('close_room/{id}', 'LoanRoomController@close_card')->name('close_room');

    //Loan All Pending Records Routes
    Route::get('pending_percentage_records', 'LoanPercentageController@getPending')->name('pending_percentage_records');
    Route::get('pending_room_records', 'LoanRoomController@get_pending_records')->name('pending_room_records');

    Route::get('/add-Record', 'RecordController@showRecordView')->name('showRecordView');
    Route::get('/add-BulkRecord', 'RecordController@showBulkRecordView')->name('showBulkRecordView');
    Route::get('/view-todays-records', 'RecordController@showTodayRecords')->name('todaysRecords');
    Route::get('/today-Records', 'RecordController@getTodayRecords')->name('getTodayRecords');
    Route::get('getAllPendingRecords', 'RecordController@getAllPendingRecords')->name('getAllPendingRecords');

    Route::get('payBulkRecords/{id}', 'RecordController@payBulkRecords')->name('payBulkRecords');


    //Loan Bulk Pay Amount Routes
    Route::get('pay_bulk_records_amount/{id}', 'RecordController@pay_bulk_records_amount')->name('pay_bulk_records_amount');

    Route::get('create-penalty', 'PenaltyController@viewPenalty')->name('penalty');
    Route::get('getPenaltiesByLoan/{id}', 'PenaltyController@getPenaltiesByLoan')->name('getPenaltiesByLoan');
    Route::get('payPenalty/{id}', 'PenaltyController@payPenalty')->name('payPenalty');
    Route::get('refreshPenalty', 'PenaltyController@refreshPenalty')->name('refreshPenalty');
    Route::get('pay-custom-penalty/{id}', 'PenaltyController@customPenalty')->name('customPenalty');

    //Single Record
    Route::prefix('record')->group(function(){
        Route::get('pay-Full-record/{id}', 'RecordController@payFullRecord')->name('payFullRecord');
        Route::get('pay_single_percentage_record', 'LoanPercentageRecordController@pay_single_record')->name('pay_single_percentage_record');
        Route::get('pay_single_room_record', 'LoanRoomRecordController@pay_single_record')->name('pay_single_room_record');
    });


    Route::get('create-penalty','PenaltyController@viewPenalty')->name('penalty');
    Route::get('getPenaltiesByLoan/{id}','PenaltyController@getPenaltiesByLoan')->name('getPenaltiesByLoan');
    Route::get('payPenalty/{id}','PenaltyController@payPenalty')->name('payPenalty');
    Route::get('refreshPenalty','PenaltyController@refreshPenalty')->name('refreshPenalty');
    Route::get('pay-custom-penalty/{id}','PenaltyController@customPenalty')->name('customPenalty');
    
    Route::prefix('reports')->group(function (){
       Route::get('daily_reports','Report\DailyReportController@get_view')->name('daily_reports');
       Route::get('make_daily_reports/{id?}','Report\DailyReportController@daily_report')->name('make_daily_reports');
    });

    Route::get('/start-Backup', 'BackupController@createBackup')->name('startBackup');
    Route::get('/restore-Backup-view', 'BackupController@RestoreView')->name('RestoreView');
    Route::post('/restore-Backup', 'BackupController@Restore')->name('Restore');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
