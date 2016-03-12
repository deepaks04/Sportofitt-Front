<?php
/*
 * |--------------------------------------------------------------------------
 * | Application Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register all of the routes for an application.
 * | It's a breeze. Simply tell Laravel the URIs it should respond to
 * | and give it the controller to call when that URI is requested.
 * |
 */
Route::get('/', function () {
    return view('views/home', ['cell' => '9457912886',
        'email' => 'select@sportofitt.com',
    ]);
});

Route::get('/sportofittpartneragreement', function () {
    return view('views/agreement', ['cell' => '9457912886',
        'email' => 'select@sportofitt.com',
    ]);
});

Route::post('/contact', 'PreGuestController@saveGuestUser');
Route::get('/select', function () {
    return view('STANDARD/select/index');
});
/* For Vendor Only */
Route::group(['prefix' => 'api/v1/vendor/'], function () {
    Route::post('create', array('uses' => 'UsersController@storeVendor'));
    Route::put('update-first-login', array('uses' => 'Vendor\VendorsController@updateFirstLoginFlag'));
    Route::get('my-profile', array('uses' => 'Vendor\VendorsController@getProfile'));
    Route::put('my-profile', array('uses' => 'Vendor\VendorsController@updateProfile'));
    Route::get('billing-info', array('uses' => 'Vendor\VendorsController@getBillingInformation'));
    Route::put('billing-info', array('uses' => 'Vendor\VendorsController@updateBillingInformation'));
    Route::get('bank-info', array('uses' => 'Vendor\VendorsController@getBankDetails'));
    Route::put('bank-info', array('uses' => 'Vendor\VendorsController@updateBankDetails'));
    Route::post('images', array('uses' => 'Vendor\VendorsController@addImages'));
    Route::get('images', array('uses' => 'Vendor\VendorsController@getImages'));
    Route::get('images/{id}', array('uses' => 'Vendor\VendorsController@deleteImage'));
    Route::post('facility', array('uses' => 'Vendor\VendorsController@createFacility'));
    Route::get('facility', array('uses' => 'Vendor\VendorsController@getFacility'));
    Route::get('facility/{id}', array('uses' => 'Vendor\VendorsController@getFacilityById'));
    Route::put('facility/{id}', array('uses' => 'Vendor\VendorsController@updateFacility'));
    Route::put('facility/update-status/{id}', array('uses' => 'Vendor\VendorsController@enableDisableFacility'));

    //NEW
    Route::get('package-types', array('uses' => 'Vendor\SessionPackageController@types'));
    Route::post('package', array('uses' => 'Vendor\SessionPackageController@createPackage'));
    Route::put('package/{id}', array('uses' => 'Vendor\SessionPackageController@updatePackage'));
    Route::get('package/{id}', array('uses' => 'Vendor\SessionPackageController@getPackage'));
    Route::get('delete-package/{id}', array('uses' => 'Vendor\SessionPackageController@deletePackage'));
    Route::post('opening-time', array('uses' => 'Vendor\SessionPackageController@createOpeningTime'));
    Route::put('opening-time/{id}', array('uses' => 'Vendor\SessionPackageController@updateOpeningTime'));

    Route::get('opening-time/{id}', array('uses' => 'Vendor\SessionPackageController@getOpeningTime'));
    Route::get('delete-opening-time/{id}', array('uses' => 'Vendor\SessionPackageController@deleteOpeningTime'));
    Route::post('session-duration', array('uses' => 'Vendor\SessionPackageController@updateDuration'));
    Route::get('facility-detail/{id}', array('uses' => 'Vendor\VendorsController@getFacilityDetailInformation'));
    Route::get('duration', array('uses' => 'Vendor\SessionPackageController@getDuration'));
    Route::post('multiple-sessions', array('uses' => 'Vendor\SessionPackageController@createSession'));
    Route::put('multiple-sessions/{id}', array('uses' => 'Vendor\SessionPackageController@updateSession'));
    Route::get('multiple-sessions/{id}', array('uses' => 'Vendor\SessionPackageController@deleteSession'));
    Route::get('sessions-data/{id}', array('uses' => 'Vendor\SessionPackageController@getSessionData'));

    Route::post('calendar-block', array('uses' => 'Vendor\SessionPackageController@blockCalendar'));
    Route::get('calendar-block/{id}', array('uses' => 'Vendor\SessionPackageController@deleteBlockedData'));
    Route::get('get-calendar-block/{yearmonth}', array('uses' => 'Vendor\SessionPackageController@getBlockData'));
    Route::get('calendar-block/{id}/{yearmonth}', array('uses' => 'Vendor\SessionPackageController@getBlockDataFacilityWise'));
    Route::put('calendar-block/{id}', array('uses' => 'Vendor\SessionPackageController@updateBlockedData'));

    //peak off peak prices
    Route::get('calculate-price/{id}/{off_peak_count}/{peak_count}', array('uses' => 'Vendor\SessionPackageController@getActualSessionPrice'));
});

/* For Customer Only */
Route::group(['prefix' => 'api/v1/customer/'], function () {
    Route::post('create/', array('uses' => 'UsersController@storeCustomer'));
    Route::put('profile', array('uses' => 'Customer\CustomersController@updateProfileInformation'));
    Route::get('profile', array('uses' => 'Customer\CustomersController@getProfileInformation'));
});

/* For Superadmin Only */
Route::group(['prefix' => 'api/v1/superadmin/'], function () {
    
});

/* Common to All Users */
Route::group(['prefix' => 'api/v1/user/'], function () {
    Route::get('confirm/{token}', array('uses' => 'UsersController@confirm'));
    Route::post('auth', array('uses' => 'Auth\AuthController@authenticate'));
    Route::get('logout', array('uses' => 'Auth\AuthController@logout'));
    Route::get('get-root-category', array('uses' => 'UsersController@getRootCategory'));
    Route::get('get-sub-category/{id}', array('uses' => 'UsersController@getSubCategory'));
    Route::get('areas', array('uses' => 'UsersController@getArea'));
    // New
    Route::put('change-password', array('uses' => 'Auth\PasswordController@change'));
    // Password reset link request routes...
    Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
    //Route::get('password/reset', 'Auth\PasswordController@getReset');
    Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
    Route::post('password/reset', 'Auth\PasswordController@postReset');
    /* Day master */
    Route::get('day-master', 'UsersController@dayMaster');
});
Route::group(['prefix' => 'api/v1/user/'], function () {
    Route::post('sign-up', array('uses' => 'Auth\AuthController@postRegisterUser'));
    Route::post('sign-in', array('uses' => 'Auth\AuthController@postLoginUser'));
});
Route::group(['prefix' => 'api/v1/user/', 'middleware' => ['userfromtoken']], function () {
    Route::post('authenticated-user', array('uses' => 'Auth\AuthController@getAuthenticatedUser'));
    Route::get('dashboard', array('uses' => 'Customer\DashboardController@index'));
    Route::post('update-profile', array('uses' => 'Customer\DashboardController@updateProfile'));
    Route::post('change-profile-picture', array('uses' => 'Customer\DashboardController@changeProfilePicture'));
    Route::post('change-password', array('uses' => 'Customer\DashboardController@changePassword'));
    Route::get('mybookings', array('uses' => 'Customer\BookingController@index'));
    Route::get('booking/{id}', array('uses' => 'Customer\BookingController@show'));
    Route::get('bodystats', array('uses' => 'Customer\BodyStatsController@index'));
    Route::post('bodystats/save', array('uses' => 'Customer\BodyStatsController@store'));
});

Route::group(['prefix' => 'api/v1/index/'], function() {
    Route::get('featured', array('uses' => 'IndexController@featuredListing'));
    Route::get('latest', array('uses' => 'IndexController@latestFacilities'));
    Route::get('search', array('uses' => 'IndexController@index'));
    Route::get('show', array('uses' => 'IndexController@show'));
});
Route::get('temp', array('uses' => 'Vendor\VendorsController@index'));
Route::get('messages', array('uses' => 'Admin\MessagesController@index'))->name('messages');
Route::post('savemessages', array('uses' => 'Admin\MessagesController@save'));
Route::get('success', array('uses' => 'Admin\MessagesController@show'))->name('success');
