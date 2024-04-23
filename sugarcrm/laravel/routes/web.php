<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SugarcrmController;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Str;
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

Route::get('/instructions', function () {
    return view('instructions');
});

Route::get('/', function () {
    return redirect("/sidebar");
});

Route::get('/sidebar', function () {
    return view('sidebar.index');
});

Route::get('/sidebar/left', function () {
    global $moduleVardefs;

    foreach( $moduleVardefs as $beanName => $moduleVardef ) {
        $moduleVardefs[$beanName]['labelPlural'] = Str::plural($moduleVardefs[$beanName]['label']);
    }
    return view('sidebar.left', compact('moduleVardefs'));
});

Route::get('/sidebar/right', [SugarcrmController::class, 'moduleView']);

Route::group(['prefix' => 'module'], function () {
    Route::get('{moduleName}/listview', [SugarcrmController::class, 'moduleListView']);
    Route::get('{moduleName?}/{id}/{view}', [SugarcrmController::class, 'moduleView']);
    Route::put('{moduleName?}/{id}', [SugarcrmController::class, 'moduleSave']);
});

Route::group(['prefix'=>'api'], function() {
    Route::get("module/lt_case/create", [ApiController::class, 'createCase']);
    Route::get("module/lt_case/get/{case}", [ApiController::class, 'getCase']);
    Route::post("module/lt_customer/create", [ApiController::class, 'createCustomer']);
    Route::get("module/lt_customer/get/{id}", [ApiController::class, 'getCustomer']);

    
    Route::put("module/lt_case/{id}/remove-customer", [ApiController::class, 'removeCustomerFromCase']);
    Route::put("module/lt_case/{id}/add-customer", [ApiController::class, 'addCustomerToCase']);

    Route::get("lists/customers", [ApiController::class, 'getCustomers']);
    Route::get("lists/customers/with-policy-names", [ApiController::class, 'getCustomersWithPolicyNames']);
    Route::put("lists/customers/update-id-number-status", [ApiController::class, 'updateHasCorrectIdNumber']);

});