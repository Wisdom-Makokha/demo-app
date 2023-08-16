<?php


use App\Http\Controllers\PhoneController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//routes for the user model
Route::post('/createUser', [UserController::class, 'createuser']);
Route::get('/readAllUsers', [UserController::class, 'readallusers']);
Route::get('/readAUser', [UserController::class, 'readauser']);
Route::put('/updateUser', [UserController::class, 'updateuser']);
Route::delete('/deleteUser', [UserController::class, 'deleteuser']);

//Routes for the phone model
Route::post('/createPhone', [PhoneController::class, 'createphone']);
Route::get('/readAllPhones', [PhoneController::class, 'readallphones']);
Route::get('/readAPhone', [PhoneController::class, 'readaphone']);
Route::delete('/deletePhone', [PhoneController::class, 'deletephone']);

//Routes for the town model
Route::post('/createTown', [TownController::class, 'createtown']);
Route::get('/readAllTowns', [TownController::class, 'readalltowns']);
Route::get('/readATown', [TownController::class, 'readatown']);
Route::put('/updateTown', [TownController::class, 'updatetown']);
Route::delete('/deleteTown', [TownController::class, 'deletetown']);

//routes for the subcounty model
Route::post('/createSubcounty', [subcountycontroller::class, 'createsubcounty']);
Route::get('readAllSubcounty', [subcountycontroller::class, 'readallsubcounty']);
Route::get('readASubcounty', [subcountycontroller::class, 'readasubcounty']);
Route::put('updateSubcounty', [subcountycontroller::class, 'updatesubcounty']);
Route::delete('deleteSubcounty', [subcountycontroller::class, 'deletesubcounty']);
//new routes for the subcounty model ** extra **
Route::get('/getUsers', [subcountycontroller::class, 'getusers']);
Route::get('/getUser', [subcountycontroller::class, 'getuser']);
Route::get('/getSubcountyName', [subcountycontroller::class, 'getsubcountyname']);
Route::get('/getUserSubcounty', [subcountycontroller::class, 'getusersubcounty']);

