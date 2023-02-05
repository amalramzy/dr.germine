<?php

use Akaunting\Apexcharts\Charts;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\DoseController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VlogController;
use App\Http\Controllers\Admin\XrayController;
use App\Http\Controllers\Admin\ChildController;
use App\Http\Controllers\Admin\ClincController;
use App\Http\Controllers\Admin\SlotsController;
use App\Http\Controllers\Admin\OpeningController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\Admin\ExpensesController;
use App\Http\Controllers\Admin\FollowUpController;
use App\Http\Controllers\Admin\MedicineController;
use App\Http\Controllers\Admin\RevenuesController;
use App\Http\Controllers\Admin\AdminAjaxController;
use App\Http\Controllers\Admin\SummaryController;

use App\Http\Controllers\Admin\DiagnosticController;
use App\Http\Controllers\Admin\EvaluationController;
use App\Http\Controllers\Admin\SalePersonController;
use App\Http\Controllers\Admin\MedicaltestController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\VaccinationController;
use App\Http\Controllers\Admin\RepReservationController;
use App\Http\Controllers\Admin\MedicalRepRequestsController;
use App\Http\Controllers\Admin\MinistryvaccinationController;

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
    return view('welcome');
});
Route::get('/r', function () {
    return view('admin.prescription.print-view');
});

Route::get('/pre', [App\Http\Controllers\Doctor\PrescriptionController::class, 'index']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => '/', 'middleware' => ['guest']], function () {

    //login admin
    Route::get('admin/login', [App\Http\Controllers\Admin\AdminLoginController::class, 'indexLogin'])->name('login.index');
    Route::post('admin/login/submit', [App\Http\Controllers\Admin\AdminLoginController::class, 'loginAdmin'])->name('admin.login');
    Route::get('admin/logout', [App\Http\Controllers\Admin\AdminLoginController::class, 'adminLogout'])->name('admin.logout');

    //login doctor
    Route::get('doctor/login', [App\Http\Controllers\Doctor\DoctorLoginController::class, 'indexLogin'])->name('logindoctor.index');
    Route::post('doctor/login/submit', [App\Http\Controllers\Doctor\DoctorLoginController::class, 'loginDoctor'])->name('doctor.login');
    Route::get('doctor/logout', [App\Http\Controllers\Doctor\DoctorLoginController::class, 'doctorLogout'])->name('doctor.logout');

});

Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {

    //dashboard

    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
//prescription
Route::get('/prescription/{id}', [App\Http\Controllers\Doctor\PrescriptionController::class, 'show'])->name('prescription.show');
Route::get('/medical-test/{id}', [App\Http\Controllers\Doctor\PrescriptionController::class, 'showMedicalTest'])->name('medicalTest.show');


//crud admin ajax
    Route::resource('admins', AdminAjaxController::class);
    Route::resource('sale-persons', SalePersonController::class);
    Route::resource('users', UserController::class);
    Route::resource('children', ChildController::class);
    Route::resource('doctors', DoctorController::class);

//diagnostic
    Route::resource('diagnostic', DiagnosticController::class);
    Route::resource('dose', DoseController::class);
    Route::resource('medicaltest', MedicaltestController::class);
    Route::resource('medicine', MedicineController::class);
    Route::resource('xrays', XrayController::class);
    Route::resource('blog', BlogController::class);
    Route::resource('vlog', VlogController::class);
    Route::resource('clinc', ClincController::class);
    Route::resource('ministry', MinistryvaccinationController::class);
    Route::resource('vaccination', VaccinationController::class);

    Route::resource('area', AreaController::class);
    Route::resource('evaluation', EvaluationController::class);
    Route::resource('slots', SlotsController::class);
    Route::resource('opening', OpeningController::class);
    Route::resource('expenses', ExpensesController::class);
    Route::resource('revenues', RevenuesController::class);
    Route::resource('reservation', ReservationController::class);
    Route::resource('represervation', RepReservationController::class);
    Route::resource('follow-up', FollowUpController::class);
    Route::resource('medical-rep-requests', MedicalRepRequestsController::class);
    Route::resource('summary', SummaryController::class);

    // repservation
    Route::get('repvisit-previous', [App\Http\Controllers\Admin\RepReservationController::class, 'repPreviousVisits'])->name('rep.visit.previous');

    Route::get('represervation/editAll/{id}', [App\Http\Controllers\Admin\RepReservationController::class, 'editAll'])->name('rep.edit.all');



    Route::post('timeArrive/store/{id}', [App\Http\Controllers\Admin\TimeController::class, 'timeArrive'])->name('timeArrive.store');
    Route::post('timeEnter/store/{id}', [App\Http\Controllers\Admin\TimeController::class, 'timeEnter'])->name('timeEnter.store');
    Route::post('timeFinish/store/{id}', [App\Http\Controllers\Admin\TimeController::class, 'timeFinish'])->name('timeFinish.store');
    // time for represervation
    Route::post('repTimeArrive/store/{id}', [App\Http\Controllers\Admin\TimeController::class, 'repTimeArrive'])->name('rep.timeArrive.store');
    Route::post('repTimeEnter/store/{id}', [App\Http\Controllers\Admin\TimeController::class, 'repTimeEnter'])->name('rep.timeEnter.store');
    Route::post('repTimeFinish/store/{id}', [App\Http\Controllers\Admin\TimeController::class, 'repTimeFinish'])->name('rep.timeFinish.store');

    Route::post('status/store/{represervation_id}', [App\Http\Controllers\Admin\StatusController::class, 'statusCancleForRep']);
    Route::post('status/cancel/{reservation_id}', [App\Http\Controllers\Admin\StatusController::class, 'statusCanceledReservation']);
    // cancel all reservation
    Route::get('status/cancel/all', [App\Http\Controllers\Admin\StatusController::class, 'statusCanceledAllReservationTODay'])->name('status.cancel.all');
    Route::get('status/close', [App\Http\Controllers\Admin\StatusController::class, 'statusCloseClinc'])->name('status.close.clinc');


    Route::get('visit-current', [App\Http\Controllers\Admin\VisitsController::class, 'currentVisits'])->name('visit.current');
    Route::get('visit-previous', [App\Http\Controllers\Admin\VisitsController::class, 'previousVisits'])->name('visit.previous');

//notify
    Route::get('notify', [App\Http\Controllers\Admin\NotifyController::class, 'indexNotify'])->name('notify.index');
    Route::post('notify-all-user', [App\Http\Controllers\Admin\NotifyController::class, 'sendAllUser'])->name('notify.sendalluser');
    // notify users today
    Route::post('notify-all-user-today', [App\Http\Controllers\Admin\NotifyController::class, 'sendAllUserToday'])->name('notify.sendalluser.today');
    Route::post('notify-user/{user}', [App\Http\Controllers\Admin\NotifyController::class, 'sendOneUser'])->name('notify.sendUser');

    Route::post('notify-all-person', [App\Http\Controllers\Admin\NotifyController::class, 'sendAllPerson'])->name('notify.sendallperson');
    Route::post('notify-select-user', [App\Http\Controllers\Admin\NotifyController::class, 'sendSelectUser'])->name('notify.sendselectuser');
//setting
    Route::get('setting/index', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('setting.index');
    Route::post('setting/store', [App\Http\Controllers\Admin\SettingController::class, 'store'])->name('setting.update');

    Route::get('visit-current', [App\Http\Controllers\Admin\ReservationController::class, 'currentVisits'])->name('visit.current');
    Route::get('visit-previous', [App\Http\Controllers\Admin\ReservationController::class, 'previousVisits'])->name('visit.previous');
    Route::get('child/summary/{child?}', [App\Http\Controllers\Admin\ReservationController::class, 'summary'])->name('child.summary');
    Route::post('child/upload/{id}', [App\Http\Controllers\Admin\ChildButtonController::class, 'uploadeChildTest'])->name('child.upload');
    // Route::delete('child/photo-destroy/{id}', [App\Http\Controllers\Admin\ChildButtonController::class, 'destroyPhoto'])->name('child.destroyPhoto');

    Route::delete('images/{img}',[App\Http\Controllers\Admin\ChildButtonController::class, 'deleteimg'])->name('delete.child_history');

    Route::put('child/update-profile/{id}', [App\Http\Controllers\Admin\ChildButtonController::class, 'editProfile'])->name('child.updateProfile');
    Route::get('child/reservation/{id}', [App\Http\Controllers\Admin\ChildReservationController::class, 'childReservationTable'])->name('childReservation.show');

    //notify
    Route::get('notify', [App\Http\Controllers\Admin\NotifyController::class, 'indexNotify'])->name('notify.index');
    Route::post('notify-all-user', [App\Http\Controllers\Admin\NotifyController::class, 'sendAllUser'])->name('notify.sendalluser');
    Route::post('notify-all-person', [App\Http\Controllers\Admin\NotifyController::class, 'sendAllPerson'])->name('notify.sendallperson');
    Route::post('notify-select-user', [App\Http\Controllers\Admin\NotifyController::class, 'sendSelectUser'])->name('notify.sendselectuser');


    // DOCTOR PAGE

    Route::get('active-reservation/{child?}', function (\App\Models\Child $child =null) {
        $reservation = \App\Models\Reservation::where('status', 'entered')->first();
        return view('admin.active-reservation.index', compact('reservation','child'));
    })->name('active.reservation');

    Route::get('edit-previous-reservation/{child}/{reservation}', function (\App\Models\Child $child ,\App\Models\Reservation $reservation) {
        $editMode = true;
        return view('admin.active-reservation.index', compact('reservation','child','editMode'));
    })->name('reservation.edit.previous');


    // users
    Route::post('users/block/{user_id}', [App\Http\Controllers\Admin\UserController::class, 'block'])->name('users.block');
    Route::post('users/change-password', [App\Http\Controllers\Admin\UserController::class, 'changePassword'])->name('users.changePassword');

    //sale_people
    Route::post('sale-persons/block/{user_id}', [App\Http\Controllers\Admin\SalePersonController::class, 'block'])->name('SalePerson.block');
    Route::post('sale-persons/change-password', [App\Http\Controllers\Admin\SalePersonController::class, 'changePassword'])->name('SalePerson.changePassword');

    // follow up
    Route::get('available-followUp', [App\Http\Controllers\Admin\FollowUpController::class, 'availableFollowUp'])->name('available.followUp');

    // medical-rep-requests
    Route::post('medical-rep-requests/reject', [App\Http\Controllers\Admin\MedicalRepRequestsController::class, 'reject'])->name('MedicalRepRequest.reject');
    Route::post('medical-rep-requests/approve', [App\Http\Controllers\Admin\MedicalRepRequestsController::class, 'approve'])->name('MedicalRepRequest.approve');

});


// Route::get('lang/home', [App\Http\Controllers\LangController::class, 'index']);
Route::get('lang/change', [App\Http\Controllers\LangController::class, 'change'])->name('changeLang');
