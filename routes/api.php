<?php

use Illuminate\Http\Request;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::resource('users','UsersController',
    ['only' => [ 'index','store','show','update','destroy']]
);

Route::resource('admin_users','AdminUsersController',
    ['only' => [ 'index','store','show','update','destroy']]
);

Route::resource('restaurants','RestaurantsController', ['only' => [
    'index','store','show','update','destroy'
]]);

Route::resource('bookings','BookingsController', ['only' => [
    'index','store','show','update','destroy'
]]);

Route::resource('opinions','OpinionsController', ['only' => [
    'index','store','show','update','destroy'
]]);

Route::resource('coupons','CouponsController', ['only' => [
    'index','store','show','update','destroy'
]]);

Route::resource('products','ProductsController', ['only' => [
    'index','store','show','update','destroy'
]]);

Route::resource('commensals_capacity_per_hour','CommensalPerHourController', ['only' => [
    'index','store','show','update','destroy'
]]);

Route::put('/restaurants/updateimage/{restaurant}', 'RestaurantsController@updateImage');
Route::put('/restaurants/rating/{restaurant}/{rating}', 'RestaurantsController@updateRating');
Route::put('/restaurants/idadmin/{restaurant}/{idAdmin}', 'RestaurantsController@updateIdAdmin');
Route::put('/products/{product}', 'ProductsController@updateProductCategory');
Route::get('/products/restaurant/{restaurant}', 'ProductsController@getProductsOfRestaurant');
Route::get('/opinions/restaurant/{restaurant}', 'OpinionsController@getOpinionsOfRestaurant');
Route::get('/coupons/user/{user}', 'CouponsController@getCouponsOfUser');
Route::get('/bookings/user/{user}', 'BookingsController@getBookingsOfUser');
Route::get('/bookings/restaurant/{restaurant}', 'BookingsController@getBookingsOfRestaurant');
Route::get('/commensals_capacity_per_hour/restaurant/{restaurant}','CommensalPerHourController@getCapacityPerHourOfRestaurant');
Route::put('/bookings/status/{booking}', 'BookingsController@updateBookingStatus');
Route::put('/bookings/canrate/{booking}/true', 'BookingsController@updateBookingCanRateToTrue');
Route::put('/bookings/canrate/{booking}/false', 'BookingsController@updateBookingCanRateToFalse');
Route::get('/users/{email}/{password}','UsersController@getUserIfExists');

Route::get('/admin_users/{email}/{password}','AdminUsersController@getAdminIfExists');

Route::get('/user/email/{email}','UsersController@getUserOfThisEmail');
Route::get('/admin_user/email/{email}','AdminUsersController@getUserOfThisEmail');


Route::put('/users/updateinfo/{user}','UsersController@updateUserInfo');
Route::put('/users/updatepassword/{user}/{oldpassword}/{newpassword}','UsersController@updateUserPassword');

Route::put('/notifications','FirebaseNotificationController@createNotification');

Route::put('/users/registertoken/{user}/{token}','UsersController@updateUserToken');
Route::put('/admin_users/registertoken/{user}/{token}','AdminUsersController@updateUserToken');

