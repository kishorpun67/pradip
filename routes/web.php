    <?php
use App\Mail\WelcomeMail;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', 'HomeController@home');

// Auth::routes(['verify'=>true]);
// Route::get('/email', function (){
//     return new WelcomeMail();
// });
// Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('/admin')->namespace('Admin')->group(function() {
    Route::match(['get', 'post'], '/', 'AdminController@login')->name('admin');
    Route::group(['middleware' => ['admin']], function() {
        Route::get('dashboard', 'AdminController@dashboard')->name('admin.dashboard');
        Route::get('logout', 'AdminController@logout')->name('admin.logout');
        Route::get('settings', 'AdminController@settings')->name('admin.settings');
        Route::post('check-current-password', 'AdminController@checkCurrentPassword');
        Route::post('update-current-password', 'AdminController@updateCurrentPassword')->name('admin.update.current.password');
        Route::match(['get', 'post'], 'update-admin-details', 'AdminController@updateAdminDetails')->name('admin.update.admin.details');

        // route for send message for all subscriber
        Route::post('message', 'AdminController@adminMessage')->name('admin.message');

        // Section
        Route::get('sections', 'SectionController@sections')->name('admin.sections');
        Route::post('update-section-status', 'SectionController@updateSectionStatus')->name('admin.update.section.status');

        // route for barnds
        Route::get('brand', 'BrandsController@viewBrands')->name('admin.brand');
        Route::match(['get', 'post'], 'add-edit-brand/{id?}', 'BrandsController@addEditBrand')->name('admin.add.edit.brand');
        Route::post('update-brand-status', 'BrandsController@updateBrandStatus')->name('admin.update.brand.status');
        Route::get('delete-brand/{id}', 'BrandsController@deleteBrand')->name('admin.delete.brand');


        // category
        Route::get('categories', 'CategoryController@categories')->name('admin.categories');
        Route::post('update-category-status', 'CategoryController@updateCategoryStatus');
        Route::match(['get', 'post'], 'add-edit-category/{id?}', 'CategoryController@addEditCategory')->name('admin.add.edit.category');
        Route::post('append-categories-level', 'CategoryController@appendCategoryLevel');
        Route::get('delete-category/{id?}', 'CategoryController@deleteCategory')->name('delete-category');
        Route::get('add-edit-category/delete-category-image/{id?}', 'CategoryController@deleteCategoryImage');

        // product
        Route::get('products', 'ProductsController@products')->name('admin.products');
        Route::match(['get', 'post'], 'add-edit-product/{id?}', 'ProductsController@addEditProduct')->name('admin.add.edit.product');
        Route::get('delete-product/{id}', 'ProductsController@deleteProduct');
        Route::get('add-edit-product/delete-product-image/{id?}', 'ProductsController@deleteProductImage');
        Route::get('add-edit-product/delete-product-video/{id?}', 'ProductsController@deleteProductVideo');
        Route::post('update-product-status', 'ProductsController@updateProductStatus');

        // products attributes
        Route::match(['get', 'post'], 'add-attribte/{id?}', 'ProductsAttributesController@addAttributes')->name('admin.add.attribte');
        Route::match(['get', 'post'], 'edit-attribte/{id?}', 'ProductsAttributesController@editAttributes')->name('admin.edit.attribte');
        Route::post('update-product-attr-status', 'ProductsAttributesController@updateProductAttributeStatus');
        Route::match(['get', 'post'], 'add-images/{id?}', 'ProductsAttributesController@addImages')->name('admin.add.images');
        Route::post('update-product-img-status', 'ProductsAttributesController@updateProductImageStatus');
        Route::get('add-attribte/delete-attribute/{id}', 'ProductsAttributesController@deleteAttribute');
        Route::get('add-attribte/delete-attribute/{id}', 'ProductsAttributesController@deleteAttribute');
        Route::get('add-images/delete-image/{id}', 'ProductsAttributesController@deleteImages');


        // Route for coupon
        Route::get('coupons', 'CouponsController@Coupons')->name('admin.coupons');
        Route::match(['get','post'],'add-edit-coupon/{id?}', 'CouponsController@addCoupon')->name('admin.add.edit.coupon');
        Route::post('update-coupon-status', 'CouponsController@updateCouponStatus');
        Route::get('delete-coupons/{id?}', 'CouponsController@deleteCoupon');

        // banner
        Route::get('posts', 'PostController@posts')->name('admin.posts');
        Route::match(['get', 'post'], 'add-edit-post/{id?}', 'PostController@addEditPost')->name('admin.add.edit.post');
        Route::post('update-post-status', 'PostController@updatePostStatus')->name('admin.update.posts.status');
        Route::get('delete-post/{id}', 'PostController@deletePost')->name('admin.delete.post');
        Route::get('add-edit-post/delete-post-image/{id?}', 'PostController@deletePostImage');

        //  orders routes
        Route::get('view-orders', 'ProductsController@viewOrders')->name('admin.view.orders');

        // order details routes
        Route::get('view-order/{id}', 'ProductsController@viewOrderDetails')->name('admin.view.order');

        // order invoice
        Route::get('view-order-invoice/{id}', 'ProductsController@viewOrderInvoice')->name('admin.view.order.invoice');

        //route for update order status
        Route::post('/update-order-status/{id}', 'ProductsController@updateOrderStatus')->name('admin.update.order.status');

        // route for delete order
        Route::get('/delete-order/{id}', 'ProductsController@deleteOrder')->name('admin.');


        // route for view user
        Route::get('/view-users', 'ProductsController@viewUsers')->name('admin.view.users');

        // route for delete user
        Route::get('/delete-user/{id}', 'ProductsController@deleteUsers')->name('admin.delete.user');


        // update user status
        Route::post('update-user-status', 'ProductsController@updateUserStatus')->name('admin.update.user.status');

        // view news letter subcribers
        Route::get('/view-newsletter-subscribers', 'NewsletteController@newsLetterSubscriber')->name('admin.view.newsletter.subscribers');

        // update news letter subscribers
        Route::post('/update-newsletter-status', 'NewsletteController@updateNewsLetterSubscriber')->name('admin.newsletter.status');

        // delete news letter subscribers
        Route::get('/delete-newsletter/{id}', 'NewsletteController@deleteNewsletters')->name('admin.delete.newsletter');


        // route for  csm pages
        // Route::get('/view-cms-page', 'CmsController@viewCmsPages')->name('admin.view.cms.page');
        // Route::match(['get','post'], 'add-edit-cms-page/{id?}', 'CmsController@addEditCmsPage')->name('admin.add.edit.cms.page');
        // Route::get('delete-cmspage/{id}', 'CmsController@delteCmsPage')->name('admin.delete.cmspage');
        // Route::post('update-cms-status', 'CmsController@updateCmsStatus')->name('admin.update.cms.status');

        // route for user charts
        Route::get('user-chart', 'ChartsController@userChart')->name('admin.user.chart');
        Route::get('orders-chart', 'ChartsController@ordersChart')->name('admin.orders.chart');

        // route for contat
        Route::match(['get','post'], '/contact/{id?}', 'ContactController@contact')->name('admin.contact');



    });
});

//  Route for user

//home page
Route::match(['get','post'],'/', 'HomeController@home')->name('home');

// Route for category lsiting page
Route::match(['get', 'post'], 'products/{url?}', 'ProductsController@products')->name('products');

// Porduct Detail page
Route::get('product/{id}', 'ProductsController@product')->name('product');

// Get product attribute price
Route::get('/get-product-price', 'ProductsController@getProductPrice')->name('get.product.price');

//Route for login and register/login
Route::match(['get','post'], '/login-register', 'UserController@register')->name('user.register');

// route for user login
Route::match(['get', 'post'],'/user-login', 'UserController@login')->name('user.login');

// route for active account

Route::get('/confirm/{code}', 'UserController@Confirm')->name('confirm');

// Route for logout user
Route::get('/user-logout', 'UserController@userLogout')->name('user.logout');

// Route for forget passwoed
Route::match(['get', 'post'],'forgot/password', 'UserController@forgetPassword')->name('forget.password');
Route::match(['get', 'post'],'/change/{$email?}', 'UserController@changePassword')->name('change');


// check email if user already exists
Route::match(['get','post'], '/check-email', 'UserController@checkEmail');

// Route for products filter page
Route::post('filter', 'ProductsController@filter')->name('filter');;

// rote for search product
Route::post('/search-products', 'ProductsController@searchProducts')->name('search.products');

Route::middleware(['frontlogin'])->group(function(){
    // Route for account
    Route::match(['get', 'post'], '/account', 'UserController@account')->name('account');

    // Route for check currrent password
    Route::post('/check-current-password', 'UserController@checkCurrentPassword')->name('check.password');

    // Route for update user password
    Route::post('/update-current-password', 'UserController@updateCurrentPassword')->name('update.current.password');

    //  Card Page
    Route::match(['get','post'], '/cart', 'ProductsController@cart')->name('cart');

    // route for wish list
    Route::match(['get','post'], '/add-wish-list', 'ProductsController@addWishList')->name('add.wish.list');

    // Add to card route
    Route::match(['get','post'], '/add-cart', 'ProductsController@addtoCart')->name('add.cart');

    // upadate product  quantity in cart page
    Route::match(['get','post'], 'cart/upate-quantity', 'ProductsController@updateCartQuantity')->name('cart/update.quantity');

    // Delete product from wish list page
    Route::get('/wish_list/delete-product/{id}', 'ProductsController@deleteWishListProduct')->name('wish.delete.product');

    // Delete product from cart page
    Route::get('cart/delete-product/{id}', 'ProductsController@deleteCartProduct')->name('cart/delet.product');



    // Apply for couppon code
    Route::post('cart/apply-coupon', 'ProductsController@applyCoupon')->name('apply.coupon');

    // Route for checkout page
    Route::match(['get', 'post'], '/checkout', 'ProductsController@checkout')->name('checkout');

    // route for order reviwe page
    Route::match(['get', 'post'], '/order-rewiew', 'ProductsController@orderReview')->name('order.review');

    // route for order  place order
    Route::match(['get', 'post'], '/place-order', 'ProductsController@placeOrder')->name('place.order');

    // route for thanks page
    Route::get('/thanks', 'ProductsController@thanks')->name('thanks');

    // route for khalti page
    Route::get('/khalti', 'ProductsController@khalti')->name('khalti');

    // user order page
    Route::get('/orders', 'ProductsController@userOrders')->name('orders');

    Route::get('/order/{id}', 'ProductsController@userOrderDetails')->name('order');
});
// Route for about page
Route::match(['get', 'post'], '/about', 'Admin\CmsController@about')->name('about');

// display contact page
Route::match(['get', 'post'], '/contact', 'Admin\ContactController@userRquest')->name('contact');

// CHEC SUBCIRBER MAIL
Route::post('/check-subcriber-email', 'NewsletterController@checkSubscriber');

// add subscriber
Route::post('/add-subcriber-email', 'NewsletterController@addSubscriber');
