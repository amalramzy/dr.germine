<?php

use App\Helpers\IsSunday;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\EvaluationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\FollowUp;
use App\Models\Opening;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/home', [HomeController::class,'index']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test',function (){
 return User::find(3);
});



// vue apis

Route::get('/diagnostic',[\App\Http\Controllers\Api\DrodownsController::class,'diagnostic']);




Route::get('/medical-test',[\App\Http\Controllers\Api\DrodownsController::class,'MedicalTest']);
Route::post('store-res',[\App\Http\Controllers\Admin\ChildReservationController::class,'store']);
Route::get('/child-reservation/{child}/{reservation?}',[\App\Http\Controllers\Admin\ChildReservationController::class,'getDetails']);
Route::get('/vaccination',[\App\Http\Controllers\Api\DrodownsController::class,'vaccination']);
Route::get('/doses',[\App\Http\Controllers\Api\DrodownsController::class,'doses']);
Route::get('/medicines',[\App\Http\Controllers\Api\DrodownsController::class,'medicines']);
Route::get('/areas',[AreaController::class,'indexApi']);
Route::post('/user/password/updateCustom', [App\Http\Controllers\Api\UserAuthController::class, 'updatePassword'])->name('updatePassCustom');



Route::group(['prefix' => 'auth'],function () {
    //forgotPassword
    Route::post('/forgotPassword',[\App\Http\Controllers\Api\UserAuthController::class, 'sendResetEmail']);
    //login
    Route::post('/login',[\App\Http\Controllers\Api\UserAuthController::class, 'login']);
    //create user
    Route::post('/user/create',[\App\Http\Controllers\Api\UserAuthController::class, 'createUser']);
    //create SalePerson
    Route::post('/salePerson/create',[\App\Http\Controllers\SalePersonController::class, 'createSalePerson']);
    //get user
    Route::get('/user', [\App\Http\Controllers\Api\UserAuthController::class, 'getUser']);
    //logout
    Route::post('/logout', [\App\Http\Controllers\Api\UserAuthController::class, 'logout']);
    //updata profile
    Route::post('/profile/update', [\App\Http\Controllers\Api\UserAuthController::class, 'updateProfile']);

    Route::post('/salePerson/profile/update', [\App\Http\Controllers\SalePersonController::class, 'updateProfile']);


    //create or update child
    Route::post('/user/child', [\App\Http\Controllers\Api\UserChildController::class, 'addChild']);
    Route::post('/user/edit/child/{childId}', [\App\Http\Controllers\Api\UserChildController::class, 'editChild']);
    //delete child
    Route::delete('/user/child/delete', [\App\Http\Controllers\Api\UserChildController::class, 'deleteChild']);
    //create reservation child
    Route::post('/user/child/reservation', [\App\Http\Controllers\Api\ReservationController::class, 'createReservation']);
    Route::post('/user/child/follow-up-reservation', [\App\Http\Controllers\Api\ReservationController::class, 'createFollowUpReservation']);
    //update reservation child
    Route::post('/user/child/reservation/{id}', [\App\Http\Controllers\Api\ReservationController::class, 'updateReservation']);
    //canceled reservation
    Route::delete('/user/child/reservation-cancel/{id}', [\App\Http\Controllers\Api\ReservationController::class, 'statusUpdate']);
    //get specific date
    Route::get('/specific-date', [\App\Http\Controllers\Api\ReservationController::class, 'getSpecificDate']);

    //get slots
    Route::get('/slots', [\App\Http\Controllers\Api\ReservationController::class, 'getSlots']);
    //my reservation
    Route::get('/my-reservation/{id}', [\App\Http\Controllers\Api\ReservationController::class, 'myReservation']);

    // reservations
    Route::get('/previous/reservations', [\App\Http\Controllers\Api\ReservationController::class, 'previous']);
    Route::get('/upcoming/reservations', [\App\Http\Controllers\Api\ReservationController::class, 'upcoming']);
    Route::get('/previous/followups/reservations', [\App\Http\Controllers\Api\ReservationController::class, 'previousFollowUp']);
    Route::get('/upcoming/followups/reservations', [\App\Http\Controllers\Api\ReservationController::class, 'upcomingFollowUp']);
    Route::get('/reservation/{reservId}', [\App\Http\Controllers\Api\ReservationController::class, 'oneReservation']);

    //userReservation
    Route::get('/reservation/user', [\App\Http\Controllers\Api\ReservationController::class, 'reservationUser']);

    //create reservation medical rep
    Route::post('/medicalrep/reservation', [\App\Http\Controllers\Api\ReservationMedicalRepController::class, 'createReservation']);
    //my represervation
    Route::get('/medical-rep/reservation', [\App\Http\Controllers\Api\ReservationMedicalRepController::class, 'myReservation']);

    Route::middleware(['auth:medicalRep-api'])->group(function () {
        // create medical rep req
        Route::post('/medical-rep/reservation/request', [\App\Http\Controllers\Api\ReservationMedicalRepController::class, 'createReservationReq']);
        Route::get('/medical-rep/reservation/requests', [\App\Http\Controllers\Api\ReservationMedicalRepController::class, 'myReservationReq']);

        //updata profile
        Route::post('/salePerson/profile/update', [\App\Http\Controllers\SalePersonController::class, 'updateProfile']);
    });
    //all user
    Route::get('/all-user', [\App\Http\Controllers\Api\UserAuthController::class, 'allUser']);
    //male count
    Route::get('/male-user', [\App\Http\Controllers\Api\UserChildController::class, 'childCount'])->name('child.count');
    //get notification
    Route::get('/notification/user/{type}', [\App\Http\Controllers\Api\NotificationController::class, 'getNotification']);

    Route::middleware(['auth:api'])->group(function () {
        // followups apis
        Route::get('/user/my-followups', [FollowUp::class, 'myFollowups']);
        Route::get('/user/childFollowups/{childId}', [FollowUp::class, 'FollowupsForChild']);

        // children
        Route::get('/user/children', [UserController::class, 'myChildren']);

        //change password
        Route::post('/user/changePassword', [\App\Http\Controllers\Api\UserAuthController::class, 'changePassword']);

        Route::post('/user/profile/editImage', [\App\Http\Controllers\Api\UserAuthController::class, 'updateProfileImage']);
        Route::post('/child/{childId}/editImage', [\App\Http\Controllers\Api\UserChildController::class, 'updateProfileImage']);

        //get vaccine child
        Route::get('/available-vaccines/child/{id}', [\App\Http\Controllers\Api\ReservationController::class, 'getAvailableChildVaccine']);
        Route::get('/vaccines/child/{id}', [\App\Http\Controllers\Api\ReservationController::class, 'getChildVaccines']);

        //get evaluations
        Route::get('/evaluations', [\App\Http\Controllers\Api\EvaluationController::class, 'index']);
        // evaluate a reservation
        Route::post('/evaluate/reservation', [\App\Http\Controllers\Api\EvaluationController::class, 'evaluate']);

    });
});
