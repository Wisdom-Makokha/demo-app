<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\subcountycontroller;
use App\Http\Controllers\TownController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//middleware additions
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Sanctum
Route::group(['middleware' => ['auth:sanctum']], function () {
    //routes for the user model
    Route::post('/userLogout', [UserController::class, 'userlogout']);
    Route::get('/readAllUsers', [UserController::class, 'readallusers']);
    Route::get('/readAUser', [UserController::class, 'readauser']);
    Route::put('/updateUser', [UserController::class, 'updateuser']);
    Route::delete('/deleteUser', [UserController::class, 'deleteuser']);
    Route::get('getUserPhoneTown', [UserController::class, 'getuserphonetown']);

    //Routes for the phone model
    Route::post('/createPhone', [PhoneController::class, 'createphone']);
    Route::get('/readAllPhones', [PhoneController::class, 'readallphones']);
    Route::get('/readAPhone', [PhoneController::class, 'readaphone']);
    Route::delete('/deletePhone', [PhoneController::class, 'deletephone']);

    //Routes for the town model
    Route::post('/createTown', [TownController::class, 'createtown']);
    Route::put('/updateTown', [TownController::class, 'updatetown']);
    Route::delete('/deleteTown', [TownController::class, 'deletetown']);

    //routes for the subcounty model
    Route::post('/createSubcounty', [subcountycontroller::class, 'createsubcounty']);
    Route::put('updateSubcounty', [subcountycontroller::class, 'updatesubcounty']);
    Route::delete('deleteSubcounty', [subcountycontroller::class, 'deletesubcounty']);


    //routes for the roles model
    Route::post('/createRole', [RoleController::class, 'createrole']);
    
    Route::put('/updateRole', [RoleController::class, 'updaterole']);
    Route::delete('/deleteRole', [RoleController::class, 'deleterole']);
    Route::get('/getUserRole', [RoleController::class, 'getuserrole']);

});

//route for the user creation and login
Route::post('/createUser', [UserController::class, 'createuser']);
Route::post('/userLogin', [UserController::class, 'userlogin']);

//not all read requests should not be completely blocked
//town read routes
Route::get('/readAllTowns', [TownController::class, 'readalltowns']);
Route::get('/readATown/{id}', [TownController::class, 'readatown']);

//subcounty read routes
Route::get('readAllSubcounty', [subcountycontroller::class, 'readallsubcounty']);
Route::get('readASubcounty', [subcountycontroller::class, 'readasubcounty']);

//roles read routes
Route::get('/readARole', [RoleController::class, 'readarole']);
Route::get('/readAllRoles', [RoleController::class, 'readallroles']);

//routes for the authcontroller
Route::post('/register', [AuthController::class, 'register']);


//new routes for the subcounty model ** extra **
Route::get('/getUsers', [subcountycontroller::class, 'getusers']);
Route::get('/getUser', [subcountycontroller::class, 'getuser']);
Route::get('/getSubcountyName', [subcountycontroller::class, 'getsubcountyname']);
Route::get('/getUserSubcounty', [subcountycontroller::class, 'getusersubcounty']);