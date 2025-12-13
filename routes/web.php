<?php
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\cartitemController;
use App\Http\Controllers\order_tableController;
use App\Http\Controllers\productController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Raw;
use App\Http\Kernel;
use App\Models\Order_table;
use App\Models\User;

// hiển thị trang chủ
Route::get('/', function () {
    return view('products.index');
})->name('home');

Route::middleware(['guest'])->group(function () {
    Route::get('/register', [userController::class, 'register'])
                ->name('register');
    Route::post('/register', [userController::class, 'acpregister'])
                ->name('acpregister');
    Route::get('/login', [userController::class, 'login'])
                ->name('login');
    Route::post('/login', [userController::class, 'checklogin'])
                ->name('checklogin');
});


Route::middleware('auth')->group(function () {
        Route::post('/logout', [userController::class, 'logout'])
            ->name('logout');
        Route::get('/cart', [cartitemController::class, 'index'])
            ->name('cartitems');
        Route::post('/cart',[cartitemController::class,'add'])
            ->name('additems');
        Route::delete('/cart/remove/{id}',[cartitemController::class,'remove'])
            ->name('removeitem');
});

Route::middleware(['auth','auth.admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    
    Route::get('/products',                 [productController::class, 'indexProduct'])->name('products.indexProduct');
    Route::get('/products/create',          [productController::class, 'create'])->name('products.create');
    Route::post('/products/store',          [productController::class, 'store'])->name('products.store');
    Route::get('/products/edit/{id}',       [productController::class, 'edit'])->name('products.edit');
    Route::put('/products/update/{id}',     [productController::class, 'update'])->name('products.update');
    Route::delete('/products/delete/{id}',  [productController::class, 'delete'])->name('products.delete');
    Route::get('/order_table',              [Order_tableController::class, 'indexOrder'])->name('products.indexOrder');
    Route::get('/user',                     [UserController::class, 'indexUser'])->name('products.indexUser');
});
Route::get('/order_table/checkout',[order_tableController::class,'formthanhtoan'])
            ->name('formthanhtoan');
Route::post('/order_table',[order_tableController::class,'thanhtoan'])
            ->name('thanhtoan');
Route::get('/products/{id}',[productController::class,'show'])->name('detail');
Route::get('/products',[productController::class,'search'])->name('home');



// Database test routes
Route::prefix('test-db')->group(function () {
    // Test database connection
    Route::get('/connection', function () {
        try {
            DB::connection()->getPdo();
                return view('products.connection');
        } catch (\Exception $e) {
            return "Kết nối THẤT BẠI. Lỗi: " . $e->getMessage();
        }
    });
});
