<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MembermanageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShopmanageController;
use App\Http\Controllers\PosPriceController;
use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'prevent-back-history'], function () {
    Route::group(['prefix' => 'authen'], function () {
        Route::controller(LoginController::class)->group(function () {
            Route::get('/', 'authen_from_center');
        });
    });
    Auth::routes(['verify' => true]);
    Route::get('kaceepos', function () {
        return redirect()->to('http://kaceecenter:1668');
    })->name('kaceepos');
    Route::get('kaceecenter', function () {
        return redirect()->to('https://kaceecenter:1450');
    })->name('kaceecenter');
    Route::get('kaceecenter/callback-logout', function () {
        return redirect()->to('https://kaceecenter:1450/callback-logout');
    })->name('kaceecenter-callback-logout');
    Route::get('kaceecenter/callback/{message}', function ($message) {
        return redirect()->to('https://kaceecenter:1450/callback/' . $message);
    })->name('kaceecenter-callback');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('autologin', 'autologin');
});
Route::group(['middleware' => ['auth', 'sessiontoken', 'permission']], function () {
    Route::group(['middleware' => ['checkproduct']], function () {
        Route::controller(DashboardController::class)->group(function () {
            Route::get('/', [DashboardController::class, 'home'])->name('home');
            Route::get('home', [DashboardController::class, 'home']);
            Route::get('dashboard/shop', [DashboardController::class, 'selectShop']);
            Route::get('dashboard/select_date', 'selectDate');
        });
    });
    Route::controller(OrderController::class)->group(function () {
        Route::group(['prefix' => 'admin'], function () {
            Route::get('orderlist', 'orderlist');
            Route::get('orderlist', 'orderlist')->name('searchorder');
            Route::get('order-select', 'order_select')->name('order.select');
            Route::get('order-detail-export/{id}/{order_number}', 'order_detail_export')->name('order.detail_export');
            Route::get('order/detail/pdf/{id}/{order_number}', 'orderdetail_pdf')->name('order.detail_pdf');
        });
        Route::get('detail/order/{status}/{order_id}', 'orderdetail');
        Route::group(['middleware' => ['checkmanager']], function () {
            Route::get('order/edit/{order_id}', 'order_edit');
            Route::post('order/update/{id}', 'order_update')->name('order.update');
        });
        Route::get('order/pdf/nobar/{id}/{order_number}', 'pdfnobar');
    });

    Route::controller(ProductController::class)->group(function () {
        Route::group(['prefix' => 'admin'], function () {
            Route::get('product-list', 'product_list')->name('productlist');
            Route::get('product-detail-export/{sku}', 'product_detail_export')->name('detail_export');
            Route::get('product-detail-pdf/{sku}/{product_name}/{barcode}', 'product_detail_pdf')->name('detail_pdf');
            Route::get('product-select', 'product_select')->name('product.select');
        });
        Route::get('product-detail/{sku}/{product_name}/{barcode}/{status}/{date}', 'product_detail');
    });

    Route::group(['middleware' => ['admin']], function () {
        Route::controller(MembermanageController::class)->group(function () {
            Route::group(['prefix' => 'admin'], function () {
                Route::get('pos-register', 'register');
                Route::post('createmember', 'createuser')->name('createuser');
                Route::get('member-manage', 'index');
                Route::post('member-edit/{id}', 'updateuser')->name('edit.user');
                Route::get('reset/{id}', 'resetpass')->name('resetpass');
                Route::get('delete/{id}', 'delete');
                Route::post('chagepassword/{id}', 'store')->name('changepassword');
            });
            Route::get('change-password/{id}', 'changepassword');
            Route::get('member-edit/{id}', 'edit');
        });

        Route::controller(ShopmanageController::class)->group(function () {
            Route::group(['prefix' => 'admin'], function () {
                Route::get('shop-manage', 'index');
                Route::get('shop-create', 'shopcreate');
                Route::post('shop-create/create', 'create')->name('createshop');
                Route::get('shop-delete/{id}', 'delete');
                Route::post('shop-edit/{id}', 'updateshop')->name('edit.shop');
            });
            Route::get('shop-edit/{id}', 'edit');
        });

        Route::controller(RoleController::class)->group(function () {
            Route::group(['prefix' => 'admin'], function () {
                Route::get('/level', 'index');
                Route::get('user-level', 'user_level');
                Route::get('add-level', 'add_level');
                Route::post('create-level', 'createlevel')->name('create.level');
                Route::get('delete/level/{id}', 'dellevel');
                Route::post('level-edit', 'updatelevel')->name('update.level');
                Route::get('user-role', 'user_role');
                Route::get('user-role-add', 'user_role_add');
                Route::post('user-role-create', 'create_role')->name('role.create');
                Route::get('user-role/delete/{id}', 'user_role_delete');
                Route::post('user-role/update/{id}', 'user_role_update')->name('role.update');
            });
            Route::get('level-edit/{id}/{name}', 'editlevel');
            Route::get('user-role/edit/{id}', 'user_role_edit');
            Route::group(['prefix' => 'employee'], function () {
                Route::get('search-emp', 'search_emp');
                Route::get('get-emp', 'get_emp');
            });
        });
    });
    Route::controller(PosPriceController::class)->group(function () {
        Route::get('pos/price', 'index');
        Route::group(['middleware' => ['productprice']], function () {
            Route::get('product/pos/edit/{id}', 'geteditone');
            Route::get('product/pos/edit/', 'getedit')->name('getedit');
            Route::post('product/pos/edit/update/', 'update_price')->name('update_price');
            Route::post('product/pos/edit/updateone/{id}', 'updateone')->name('update_priceone');
        });
    });
    Route::controller(RequestController::class)->group(function () {
        Route::get('/order/list', 'getOrderList');
    });

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
