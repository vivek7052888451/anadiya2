<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\backend\BackendController;
use App\Http\Controllers\backend\LoginController;
use App\Http\Controllers\backend\RegisterController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\frontend\EmployeeVerifyController;


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


Route::get('/',[HomeController::class,'index']);
Route::get('/contactUs',[HomeController::class,'contactUs']);
Route::get('admin/login',[LoginController::class,'login']);
Route::post('admin/login',[LoginController::class,'adminLogin']);

     

Route::group(['prefix'=>'admin/','as' => 'admin.','middleware'=>'auth']
,function(){
     Route::get('logout',[LoginController::class,'adminLogout']);
     Route::get('dashboard',[BackendController::class,'index'])->name('dashboard');


     /*
    |--------------------------------------------------------------------------
    | Roles And Permission Routes Start
    |--------------------------------------------------------------------------
    */

    // [Roles, Modules and Permissions]
    Route::get('/module', [ModuleController::class,'index'])->name('modules.index');
    // Route::get('/module', 'ModuleController@index')->name('modules.index')->middleware('can:Module');
    Route::post('/selected-module', 'ModuleController@selectedModule')->name('selectedModule');
    Route::get('/role-permission', 'ModuleController@show')->name('role_permission.show')->middleware('can:Roles And Permissions');
    Route::post('/add-module', [ModuleController::class,'store'])->name('add-module.store');
    Route::post('/add-permission', 'ModuleController@addPermission')->name('add-permission');
    Route::post('/assign-module-permission' , [ModuleController::class,'assignPermissionToModule'])->name('assign-module-permission');
    Route::get('/edit-module/{id}/edit', [ModuleController::class,'edit'])->name('edit_module.edit');
    Route::match(['get','post'] ,'/edit-module/{id}' , [ModuleController::class,'edit'])->name('edit_module.edit');
    Route::match(['get','post'] ,'/edit-permission/{id}' , [ModuleController::class,'update'])->name('update_permission');
    Route::match(['get','post'] ,'/edit-module-has-permission/{id}' , [ModuleController::class,'updateModuleHasPermission'])->name('update_module_has_permission');
    Route::match(['get','post'] ,'/delete-module/{id}' , [ModuleController::class,'destroy'])->name('delete_module');
    Route::match(['get','post'] ,'/delete-permission/{id}' , [ModuleController::class,'deletePermission'])->name('delete_permission');
    Route::match(['get','post'] ,'/delete-module-permission/{id}' , [ModuleController::class,'deleteModulePermission'])->name('delete_module_permission');
    Route::post('/assign-role-permission' , [ModuleController::class,'assignPermissionToRole'])->name('assign-role-permission');
    Route::GET('/get-Module' , [ModuleController::class,'getModule'])->name('get_module');
    Route::get('/assign-user-permission' , [ModuleController::class,'UserPermission'])->name('assign-user-permission')->middleware('can:Users And Permissions');
    Route::GET('/get-user-permission' , [ModuleController::class,'getUserPermission'])->name('get_user_permission');
    Route::post('/update-user-permission' , [ModuleController::class,'updateUserPermission'])->name('update-user-permission');
    Route::post('/add-role', 'ModuleController@create')->name('add-role');


     Route::get('search-user/{id}' , [ModuleController::class,'searchUser'])->name('search-user');

    
});



Route::post('employee/verify',[EmployeeVerifyController::class,'veriFyEmployee']);
Route::group(['prefix'=>'employee/','as' => 'employee.','middleware'=>'auth']
,function(){

});
// Route::group(['perfix'=>'user','middleware'=>'auth'],function(){
    
// });
