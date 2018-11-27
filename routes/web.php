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

Route::get('/', 'FrontEnd\HomeController@index');
Route::get('/home', 'FrontEnd\HomeController@index');
Route::get('/category', 'FrontEnd\CategoryController@index');
Route::get('/json-subcategories', 'FrontEnd\CategoryController@subcategories');

//Search Result//
Route::get('/category/search/{id}', 'FrontEnd\CategoryWiseAdController@categoryWiseAlladd');
Route::get('/division/search', 'FrontEnd\CategoryWiseAdController@areaWiseAlladd');
Route::get('/search', 'FrontEnd\LiveSearchController@action');
//Search Result//

//Internal Search Result//
Route::post('/internal/search-result', 'FrontEnd\InternalSearchController@index');
Route::get('/search/result', 'FrontEnd\InternalSearchController@searchResultShow');
//Internal Search Result//

//Header Search Result//
Route::post('/header/search', 'FrontEnd\InternalSearchController@headerSearch');
Route::get('/search/results', 'FrontEnd\InternalSearchController@headerSearchResults');
//Header Search Result//

//Filter Search Result//
Route::post('/filter/search', 'FrontEnd\InternalFilterController@filterSearch');
Route::get('/filter/searches', 'FrontEnd\InternalFilterController@filterSearchResults');
//Filter Search Result//

//GPS Search Result//
Route::post('/geo/search', 'FrontEnd\GpsSearchController@gpsSearch');
Route::get('/geo-search/results', 'FrontEnd\GpsSearchController@gpsSearchResults');
//GPS Search Result//

//JSON Return//
Route::get('/subcategories', 'FrontEnd\SelectCategoryAreaController@subcategories');
Route::get('/districts', 'FrontEnd\SelectCategoryAreaController@districts');
Route::get('/upazilas', 'FrontEnd\SelectCategoryAreaController@upazilas');
//JSON Return//

//Auction Details//
Route::get('/auction/details/{id}', 'FrontEnd\AuctionDetailsViewController@index');
//Auction Details//

//Profile View//
Route::get('/user/profile-view/{id}', 'FrontEnd\ProfileViewController@index');
//Profile View//

Auth::routes();
Route::group(['middleware' => 'AuthenticateUser'], function() {
    Route::get('/profile', 'FrontEnd\UserHomeController@index')->name('home');

    // Post-Ad //

    Route::get('/post-ad/category-area-select', 'FrontEnd\SelectCategoryAreaController@categorySelect');
    Route::get('/json-subcategories', 'FrontEnd\SelectCategoryAreaController@subcategories');
    Route::get('/json-districts', 'FrontEnd\SelectCategoryAreaController@districts');
    Route::get('/json-upazilas', 'FrontEnd\SelectCategoryAreaController@upazilas');

    Route::post('/post-ad/category-area-save', 'FrontEnd\PostAdController@categoryAreaSave');
    Route::get('/post-ad/details', 'FrontEnd\PostAdController@postAdDetails');
    Route::post('/post-ad/post-ad-save', 'FrontEnd\PostAdController@postAdSave');

    // Post-Ad //
    
    // Manage-Auction //
    
    Route::get('/auctions-manage/user/{id}', 'FrontEnd\UserAdManageController@manageUserAuction');
    Route::get('/user/auction-edit/{id}', 'FrontEnd\UserAdManageController@editUserAuction');
    Route::post('/user/auction-update', 'FrontEnd\UserAdManageController@updateUserAuction');
    Route::get('/user/auction-delete/{id}', 'FrontEnd\UserAdManageController@deleteUserAuction');
    
    Route::get('/comments/auction/{id}', 'FrontEnd\UserAdManageController@auctionComments');
    Route::get('/auction/delete-comment/{id}', 'FrontEnd\UserAdManageController@auctionCommentDelete');
    
    Route::get('/bids/auction/{id}', 'FrontEnd\UserAdManageController@auctionBids');
    Route::get('/auction/delete-bid/{id}', 'FrontEnd\UserAdManageController@auctionBidDelete');
    
    // Manage-Auction //
    
    // Manage-User Profile //
    
    Route::get('/user-profile/create/{id}', 'FrontEnd\UserProfileManageController@createUserProfile');
    Route::post('/user-profile/save/', 'FrontEnd\UserProfileManageController@saveUserProfile');
    Route::get('/user-profile/edit/{id}', 'FrontEnd\UserProfileManageController@editUserProfile');
    Route::post('/user-profile/update/', 'FrontEnd\UserProfileManageController@updateUserProfile');
    
    // Manage-User Profile //
    
    // Comment Section //
    Route::post('addComment', 'FrontEnd\CommentsController@addComment');
    // Comment Section //
    
    // Activity Section //
    Route::get('/user/activity/{id}', 'FrontEnd\CommentsController@manageComment');
    Route::get('/user/comment-edit/{id}', 'FrontEnd\CommentsController@editComment');
    Route::post('/user-comment/update/', 'FrontEnd\CommentsController@updateComment');
    Route::get('/user/comment-delete/{id}', 'FrontEnd\CommentsController@distroyComment');
    // Activity Section //
    
    //Credit Card Section//
     
    Route::get('/user/payment-form/', 'FrontEnd\CardPaymentController@addPaymentCardForm');
    Route::post('/user/payment-form-save/', 'FrontEnd\CardPaymentController@savePaymentCardInfo');
    
    Route::get('/user/payment-form/edit/', 'FrontEnd\CardPaymentController@editPaymentCardInfo');
    Route::post('/user/payment-info/update/', 'FrontEnd\CardPaymentController@updatePaymentCardInfo');
    Route::get('/user/payment-info/delete/{id}', 'FrontEnd\CardPaymentController@deletePaymentCardInfo');
    
    //Credit Card Section//
    
    //Auction Bidding Section//
    
    Route::post('/user-bid/auction/{id}', 'FrontEnd\BidController@createBid');
    Route::get('/user/manage-bids/{id}', 'FrontEnd\BidController@manageBids');
    Route::get('/user/edit-bid/{id}', 'FrontEnd\BidController@editBid');
    Route::post('/user-bid/update/', 'FrontEnd\BidController@updateBid');
    Route::get('/user/delete-bid/{id}', 'FrontEnd\BidController@deleteBid');
    
    //Auction Bidding Section//
    
    //Auction Bid Winner//
    
    Route::get('/bid-winner/auction/{id}', 'FrontEnd\BidWinnerController@bidWinnerForUserAuction');
    
    //Auction Bid Winner//
    
    
});


/* Admin as a Guest */
Route::group(['middleware' => 'admin_guest'], function() {

    Route::get('admin', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('admin', 'Admin\Auth\LoginController@login');

// Registration Routes...
    Route::get('admin/register', 'Admin\Auth\RegisterController@showRegistrationForm')->name('admin.register');
    Route::post('admin/register', 'Admin\Auth\RegisterController@registerAdmin');

    // Password Reset Routes...
    Route::get('admin-password/reset', 'Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('admin-password/email', 'Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('admin-password/reset/{token}', 'Admin\Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('admin-password/reset', 'Admin\Auth\ResetPasswordController@reset');
});

/* Admin as a Guest */

/* Admin Auth */

Route::group(['middleware' => 'admin_auth'], function() {

    Route::post('admin/logout', 'Admin\Auth\LoginController@logout');
    Route::get('admin/home', 'Admin\AdminHomeController@index');

    /* Category Routes */
    Route::get('admin/category-add', 'Admin\CategoryController@index');
    Route::post('admin/category-save', 'Admin\CategoryController@store');
    Route::get('admin/category-manage', 'Admin\CategoryController@manageCategory');
    Route::get('admin/sub-categories/{id}', 'Admin\CategoryController@categoryWiseSubCategories');
    Route::get('admin/category-edit/{id}', 'Admin\CategoryController@edit');
    Route::post('admin/category-update', 'Admin\CategoryController@update');
    Route::get('admin/category-delete/{id}', 'Admin\CategoryController@destroy');
    /* Category Routes */

    /* Sub Category Routes */
    Route::get('admin/sub-category-add', 'Admin\SubCategoryController@index');
    Route::post('admin/sub-category-save', 'Admin\SubCategoryController@store');
    Route::get('admin/sub-category-manage', 'Admin\SubCategoryController@manageSubCategory');
    Route::get('admin/sub-category-edit/{id}', 'Admin\SubCategoryController@edit');
    Route::post('admin/sub-category-update', 'Admin\SubCategoryController@update');
    Route::get('admin/sub-category-delete/{id}', 'Admin\SubCategoryController@destroy');
    
    Route::get('admin/manufactures/{id}', 'Admin\SubCategoryController@manufacturers');
    /* Sub Category Routes */

    /* Manufacturer Info */
    Route::get('admin/manufacturer-add', 'Admin\ManufacturerController@index');
    Route::post('admin/manufacturer-save', 'Admin\ManufacturerController@store');
    Route::get('admin/manufacturer-manage', 'Admin\ManufacturerController@manageManufacturer');
    Route::get('admin/manufacturer-edit/{id}', 'Admin\ManufacturerController@edit');
    Route::post('admin/manufacturer-update', 'Admin\ManufacturerController@update');
    Route::get('admin/manufacturer-delete/{id}', 'Admin\ManufacturerController@destroy');
    
    Route::get('admin/manufacturer/sub-categories/{id}', 'Admin\ManufacturerController@subCategories');
    /* Manufacturer Info */

    /* Sub-Category Manufacturer Info */
    Route::get('admin/subcategorymanufacturer-add', 'Admin\SubcategoryManufacturerController@index');
    Route::post('admin/subcategorymanufacturer-save', 'Admin\SubcategoryManufacturerController@store');
    Route::get('admin/subcategorymanufacturer-manage', 'Admin\SubcategoryManufacturerController@manageSubCategoryAndManufacturer');
    Route::get('admin/subcategorymanufacturer-edit/{id}', 'Admin\SubcategoryManufacturerController@edit');
    Route::post('admin/subcategorymanufacturer-update', 'Admin\SubcategoryManufacturerController@update');
    Route::get('admin/subcategorymanufacturer-delete/{id}', 'Admin\SubcategoryManufacturerController@destroy');
    /* Sub-Category Manufacturer Info */

    /* Color Routes */
    Route::get('admin/color-add', 'Admin\ColorController@index');
    Route::post('admin/color-save', 'Admin\ColorController@store');
    Route::get('admin/color-manage', 'Admin\ColorController@manageColor');
    Route::get('admin/color-edit/{id}', 'Admin\ColorController@edit');
    Route::post('admin/color-update', 'Admin\ColorController@update');
    Route::get('admin/color-delete/{id}', 'Admin\ColorController@destroy');
    /* Color Routes */

    /* Division Routes */
    Route::get('admin/division-add', 'Admin\DivisionController@index');
    Route::post('admin/division-save', 'Admin\DivisionController@store');
    Route::get('admin/division-manage', 'Admin\DivisionController@manageDivisions');
    Route::get('admin/division-edit/{id}', 'Admin\DivisionController@edit');
    Route::post('admin/division-update', 'Admin\DivisionController@update');
    Route::get('admin/districts-list/{id}', 'Admin\DivisionController@divisionWiseDistricts');
    Route::get('admin/division-delete/{id}', 'Admin\DivisionController@destroy');
    /* Division Routes */

    /* District Routes */
    Route::get('admin/district-add', 'Admin\DistrictController@index');
    Route::post('admin/district-save', 'Admin\DistrictController@store');
    Route::get('admin/district-manage', 'Admin\DistrictController@manageDistricts');
    Route::get('admin/district-edit/{id}', 'Admin\DistrictController@edit');
    Route::post('admin/district-update', 'Admin\DistrictController@update');
    Route::get('admin/upazilas-list/{id}', 'Admin\DistrictController@districtWiseUpazilas');
    Route::get('admin/district-delete/{id}', 'Admin\DistrictController@destroy');
    /* District Routes */

    /* Upazila Routes */
    Route::get('admin/upazila-add', 'Admin\UpazilaController@index');
    Route::post('admin/upazila-save', 'Admin\UpazilaController@store');
    Route::get('admin/upazila-manage', 'Admin\UpazilaController@manageUpazilas');
    Route::get('admin/upazila-edit/{id}', 'Admin\UpazilaController@edit');
    Route::post('admin/upazila-update', 'Admin\UpazilaController@update');
    Route::get('admin/upazila-delete/{id}', 'Admin\UpazilaController@destroy');
    /* Upazila Routes */

    /* Dropdown Test Routes */
    Route::get('admin/dropdown-test', 'Admin\DropDownTestController@dropDownShow');

    Route::get('admin/json-subcategories', 'Admin\DropDownTestController@subcategories');

    Route::get('admin/json-districts', 'Admin\DropDownTestController@districts');

    Route::get('admin/json-upazilas', 'Admin\DropDownTestController@upazilas');
    /* Dropdown Test Routes */
    
    /* Manage Users */
    Route::get('/admin/manage-users', 'Admin\UserManageController@manageUsers');
    Route::get('/admin/user-details/{id}', 'Admin\UserManageController@userDetails');
    
    Route::get('/admin/user-comments/{id}', 'Admin\UserManageController@userComments');
    Route::get('/admin/delete-comment/{id}', 'Admin\UserManageController@userCommentDelete');
    
    Route::get('/admin/user-bids/{id}', 'Admin\UserManageController@userBids');
    Route::get('/admin/delete-bid/{id}', 'Admin\UserManageController@userBidDelete');
    
    
    Route::get('/admin/user-auctions/{id}', 'Admin\UserManageController@userAuctions');
    Route::get('/admin/user-auction/show/{id}', 'Admin\UserManageController@userAuctionShow');
    Route::get('/admin/user-auction-delete/{id}', 'Admin\UserManageController@deleteUserAuction');
    
    Route::get('/admin/delete-user/{id}', 'Admin\UserManageController@destroy');
    /* Manage Users */
    
    
    /* Manage Total Auctions */
    Route::get('/admin/auctions/manage', 'Admin\AuctionsManageController@manageAuctions');
    Route::get('/admin/auction/show/{id}', 'Admin\AuctionsManageController@showAuctionDetails');
    
    Route::get('/admin/auction-comments/{id}', 'Admin\AuctionsManageController@auctionComments');
    Route::get('/admin/auction/delete-comment/{id}', 'Admin\AuctionsManageController@auctionCommentDelete');
    
    Route::get('/admin/auction-bids/{id}', 'Admin\AuctionsManageController@auctionBids');
    Route::get('/admin/auction/delete-bid/{id}', 'Admin\AuctionsManageController@auctionBidDelete');
    
    Route::get('/admin/auction/delete/{id}', 'Admin\AuctionsManageController@deleteAuction');
    /* Manage Total Auctions */
    
    
});

/*Admin Auth*/