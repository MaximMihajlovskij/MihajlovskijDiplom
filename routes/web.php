<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\TurniketsController;
use App\Http\Controllers\BarriersController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\Scud\IndexxController;
use App\Http\Controllers\Admin\Scud\CameraController;
use App\Http\Controllers\Admin\Scud\FirmController;
use App\Http\Controllers\Admin\Scud\RepairController;
use App\Http\Controllers\Admin\Scud\UsersController;
use App\Http\Controllers\Admin\Scud\StatusController;
use App\Http\Controllers\Admin\Scud\CompleteController;
use App\Http\Controllers\Admin\Scud\CartController;
use App\Http\Controllers\Admin\Scud\CartsItemsController;
use App\Http\Controllers\Admin\Scud\TurniketController;
use App\Http\Controllers\Admin\Scud\BarrierController;
use App\Http\Controllers\Admin\Scud\SpecificationController;
use App\Http\Controllers\Admin\Scud\AccessoriesController;
use App\Http\Controllers\Admin\Scud\ReviewsController; 
use App\Http\Controllers\Admin\Scud\ActionController;
use App\Http\Controllers\CartsController; 
use App\Http\Controllers\ExportController; 
use App\Http\Controllers\ExportCartController; 
use App\Http\Controllers\ReviewController; 
use App\Http\Controllers\AccessoryController; 
use App\Http\Controllers\ProjectController; 
use App\Http\Controllers\WishlistController; 
use App\Http\Controllers\ProfController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Admin\sait\BannersController;
use App\Http\Controllers\Admin\sait\PartnersController;
use App\Http\Controllers\Admin\sait\ProjectsController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');    
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
    //Оставление заявок
    Route::get('/contact', [FeedbackController::class, 'index'])->name('contact');
    Route::post('/contact', [FeedbackController::class, 'create'])->name('feedback');
    Route::get('/repair-history', [FeedbackController::class, 'history'])->name('repair.history');
    //Корзина
    Route::get('/carts', [CartsController::class, 'index'])->name('cart.cart');
    Route::post('/cart/add', [CartsController::class, 'addToCart'])->name('cart.cart.create');
    Route::post('/order/store', [CartsController::class, 'store'])->name('cart.order.store');
    Route::post('/cart/removeOne', [CartsController::class, 'removeOne'])->name('cart.cart.removeOne');
    Route::post('/cart/clear', [CartsController::class, 'clearCart'])->name('cart.cart.clear');
    Route::get('/cart/history', [CartsController::class, 'history'])->name('cart.history');
    Route::get('/order-details/{orderId}', [CartsController::class, 'orderDetails'])->name('order.details');        
    //Оставление отзывов
    Route::post('/camera/{camera}', [ReviewController::class, 'store'])->name('reviews.store');
    Route::post('/barrier/{barrier}', [ReviewController::class, 'store'])->name('reviews.store');
    Route::put('/reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    //Обратная связь
    Route::get('/contactes', [ContactController::class, 'index'])->name('contactes');
    Route::post('/contactes/send', [ContactController::class, 'send'])->name('contact.send');
    //Избранное
    Route::post('/wishlist/add', [WishlistController::class, 'store'])->name('wishlist.add');
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('Wishlist.wishlist');
    Route::delete('/wishlist/{id}', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');
    //Профиль
    Route::post('/profile/update', [ProfController::class, 'update'])->name('profile.update');
    Route::delete('/profile/avatar/delete', [ProfController::class, 'deleteAvatar'])->name('profile.deleteAvatar');
    Route::post('/logout', [ProfController::class, 'logout'])->name('logout');
    Route::delete('/profile/delete', [ProfController::class, 'deleteAccount'])->name('profile.delete');
});

require __DIR__.'/auth.php';

//Мой проект
Route::get('/base', [BaseController::class, 'base'])->name('base');
Route::get('/index', [IndexController::class, 'index'])->name('index');
Route::get('/wishlist/count', [WishlistController::class, 'countWishlist']);
//Поиск
Route::get('/search', [SearchController::class, 'search'])->name('search');
//Страница с видеокамерами
Route::get('/video', [VideoController::class, 'index'])->name('video');
Route::get('/video/{camera}', [VideoController::class, 'show'])->name('video.descriptioncamera');
//Страница с турникетами
Route::get('/turn', [TurniketsController::class, 'index'])->name('turn');
Route::get('/turn/{turniket}', [TurniketsController::class, 'show'])->name('turn.descriptionturn');
//Страница со шлагбаумами
Route::get('/barrier', [BarriersController::class, 'index'])->name('barrier');
Route::get('/barrier/{barrier}', [BarriersController::class, 'show'])->name('barrier.descriptionbarrier');
//Аксессуары
Route::get('/accessories', [AccessoryController::class, 'index'])->name('accessories.accessories');
Route::get('/accessories/{accessorie}', [AccessoryController::class, 'show'])->name('accessories.descriptionaccessories');
//Страница портфолио
Route::get('/portfolio', [ProjectController::class, 'index'])->name('portfolio.portfolio');

// Админ-панель
Route::prefix('admin')->middleware('can:admin-access')->group(function () {   
    //Главная админка
    Route::get('/scud', [IndexxController::class, 'index'])->name('admin.scud.index');
    //Камеры
    Route::prefix('cameras')->group(function () {
        Route::get('/', [CameraController::class, 'index'])->name('admin.scud.crudcamera');
        Route::get('/create', [CameraController::class, 'create'])->name('admin.scud.createcamera');
        Route::post('/create', [CameraController::class, 'store'])->name('admin.scud.storecamera');
        Route::get('/{camera}', [CameraController::class, 'edit'])->name('admin.scud.editercamera');
        Route::put('/{camera}', [CameraController::class, 'update'])->name('admin.scud.updatecamera');
        Route::delete('/{camera}', [CameraController::class, 'destroy'])->name('admin.scud.delcamera');
    });
    //Фирмы
    Route::prefix('firms')->group(function () {
        Route::get('/', [FirmController::class, 'index'])->name('admin.scud.firms');
        Route::get('/create', [FirmController::class, 'create'])->name('admin.scud.createfirms');
        Route::post('/create', [FirmController::class, 'store'])->name('admin.scud.storefirms');
        Route::get('/{firm}', [FirmController::class, 'edit'])->name('admin.scud.editfirms');
        Route::put('/{firm}', [FirmController::class, 'update'])->name('admin.scud.updatefirms');
        Route::delete('/{firm}', [FirmController::class, 'destroy'])->name('admin.scud.delfirms');
    });
    //Заявки на ремонт
    Route::prefix('repaircamera')->group(function () {
        Route::get('/', [RepairController::class, 'index'])->name('admin.scud.repaircamera');
        Route::get('/{repaircamera}', [RepairController::class, 'edit'])->name('admin.scud.editrepaircamera');
        Route::put('/{repaircamera}', [RepairController::class, 'update'])->name('admin.scud.updaterepaircamera');
        Route::delete('/{repaircamera}', [RepairController::class, 'destroy'])->name('admin.scud.delrepaircamera');
        Route::get('/export/excel', [ExportController::class, 'exportExcel'])->name('export.excel');
        Route::get('/export/pdf', [ExportController::class, 'exportPDF'])->name('export.pdf');
    });
    //Пользователи
    Route::prefix('users')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('admin.scud.users');
        Route::get('/{user}', [UsersController::class, 'edit'])->name('admin.scud.useredit');
        Route::put('/{user}', [UsersController::class, 'update'])->name('admin.scud.updateuser');
        Route::delete('/{user}', [UsersController::class, 'destroy'])->name('admin.scud.delusers');
    });
    //Статусы срочности
    Route::prefix('status')->group(function () {
        Route::get('/', [StatusController::class, 'index'])->name('admin.scud.status');
        Route::get('/create', [StatusController::class, 'create'])->name('admin.scud.createstatus');
        Route::post('/create', [StatusController::class, 'store'])->name('admin.scud.storestatus');
        Route::get('/{status}', [StatusController::class, 'edit'])->name('admin.scud.editstatus');
        Route::put('/{status}', [StatusController::class, 'update'])->name('admin.scud.updatestatus');
        Route::delete('/{status}', [StatusController::class, 'destroy'])->name('admin.scud.delstatus');
    });
    //Статусы выполнения
    Route::prefix('complete')->group(function () {
        Route::get('/', [CompleteController::class, 'index'])->name('admin.scud.complete');
        Route::get('/create', [CompleteController::class, 'create'])->name('admin.scud.createcomplete');
        Route::post('/create', [CompleteController::class, 'store'])->name('admin.scud.storecomplete');
        Route::get('/{completed}', [CompleteController::class, 'edit'])->name('admin.scud.editcomplete');
        Route::put('/{completed}', [CompleteController::class, 'update'])->name('admin.scud.updatecomplete');
        Route::delete('/{completed}', [CompleteController::class, 'destroy'])->name('admin.scud.delcomplete');
    });
    //Корзина и её товары
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('admin.scud.cart');
        Route::get('/{cart}/show', [CartController::class, 'show'])->name('admin.scud.showcart');
        Route::get('/{cart}', [CartController::class, 'edit'])->name('admin.scud.editercart');        
        Route::put('/{cart}', [CartController::class, 'update'])->name('admin.scud.updatecart');
        Route::delete('/cart/delete-selected', [CartController::class, 'deleteSelected'])->name('admin.scud.deleteSelected');
    });
    Route::get('/items', [CartsItemsController::class, 'index'])->name('admin.scud.cartitem');
    Route::get('/admin/scud/cartitem/export', [ExportCartController::class, 'exportPDF'])->name('admin.scud.cartitem.export');
    //Турникеты
    Route::prefix('turnikety')->group(function () {
        Route::get('/', [TurniketController::class,'index'])->name('admin.scud.turnikety');
        Route::get('/create', [TurniketController::class, 'create'])->name('admin.scud.createturniket');
        Route::post('/create', [TurniketController::class, 'store'])->name('admin.scud.storeturniket');
        Route::get('/{turniket}', [TurniketController::class, 'edit'])->name('admin.scud.editturniket');
        Route::put('/{turniket}', [TurniketController::class, 'update'])->name('admin.scud.updateturniket');
        Route::delete('/{turniket}', [TurniketController::class, 'destroy'])->name('admin.scud.delturniket');
    });
    //Шлагбаумы  
    Route::prefix('barrier')->group(function () {
        Route::get('/', [BarrierController::class,'index'])->name('admin.scud.barrier');
        Route::get('/create', [BarrierController::class, 'create'])->name('admin.scud.createbarrier');
        Route::post('/create', [BarrierController::class, 'store'])->name('admin.scud.storebarrier');
        Route::get('/{barrier}', [BarrierController::class, 'edit'])->name('admin.scud.editbarrier');
        Route::put('/{barrier}', [BarrierController::class, 'update'])->name('admin.scud.updatebarrier');
        Route::delete('/{barrier}', [BarrierController::class, 'destroy'])->name('admin.scud.delbarrier');
    });
    //Аксессуары 
    Route::prefix('accessories')->group(function () {
        Route::get('/', [AccessoriesController::class,'index'])->name('admin.scud.accessories');
        Route::get('/create', [AccessoriesController::class, 'create'])->name('admin.scud.createaccessories');
        Route::post('/create', [AccessoriesController::class, 'store'])->name('admin.scud.storeaccessories');
        Route::get('/{accessorie}', [AccessoriesController::class, 'edit'])->name('admin.scud.editaccessories');
        Route::put('/{accessorie}', [AccessoriesController::class, 'update'])->name('admin.scud.updateaccessories');
        Route::delete('/{accessorie}', [AccessoriesController::class, 'destroy'])->name('admin.scud.delaccessories');
        Route::get('/accessories/{id}', [AccessoriesController::class, 'show'])->name('admin.scud.showaccessories');
    });
    //Технические характеристики  
    Route::prefix('specification')->group(function () {
        Route::get('/', [SpecificationController::class,'index'])->name('admin.scud.specification');
        Route::get('/create', [SpecificationController::class, 'create'])->name('admin.scud.createspecification');
        Route::post('/create', [SpecificationController::class, 'store'])->name('admin.scud.storespecification');
        Route::get('/{specification}', [SpecificationController::class, 'edit'])->name('admin.scud.editspecification');
        Route::put('/{specification}', [SpecificationController::class, 'update'])->name('admin.scud.updatespecification');
        Route::delete('/{specification}', [SpecificationController::class, 'destroy'])->name('admin.scud.delspecification');
    });
    //Отзывы
    Route::prefix('review')->group(function () {
        Route::get('/', [ReviewsController::class,'index'])->name('admin.scud.review');
        Route::delete('/{reviews}', [ReviewsController::class, 'destroy'])->name('admin.scud.delreview');
    });    
    //Статус ожидания 
    Route::prefix('action')->group(function () {
        Route::get('/', [ActionController::class,'index'])->name('admin.scud.action');
        Route::get('/create', [ActionController::class, 'create'])->name('admin.scud.createaction');
        Route::post('/create', [ActionController::class, 'store'])->name('admin.scud.storeaction');
        Route::get('/{action}', [ActionController::class, 'edit'])->name('admin.scud.editaction');
        Route::put('/{action}', [ActionController::class, 'update'])->name('admin.scud.updateaction');
        Route::delete('/{action}', [ActionController::class, 'destroy'])->name('admin.scud.delaction');
    });

    //По сайту
    Route::prefix('index')->group(function () {
        Route::get('/', [BannersController::class,'index'])->name('admin.scud.sait.index.index');
        Route::get('/create', [BannersController::class, 'create'])->name('admin.scud.sait.index.create');
        Route::post('/create', [BannersController::class, 'store'])->name('admin.scud.sait.index.storebanner');
        Route::get('/{banner}', [BannersController::class, 'edit'])->name('admin.scud.sait.index.edit');
        Route::put('/{banner}', [BannersController::class, 'update'])->name('admin.scud.sait.index.updatebanner');
        Route::delete('/{banner}', [BannersController::class, 'destroy'])->name('admin.scud.sait.index.del');
    });
    //Партнёры
    Route::prefix('partner')->group(function () {
        Route::get('/', [PartnersController::class,'index'])->name('admin.scud.sait.index.partner');
        Route::get('/create', [PartnersController::class, 'create'])->name('admin.scud.sait.index.partnercreate');
        Route::post('/create', [PartnersController::class, 'store'])->name('admin.scud.sait.index.partnerstore');
        Route::get('/{partner}', [PartnersController::class, 'edit'])->name('admin.scud.sait.index.partneredit');
        Route::put('/{partner}', [PartnersController::class, 'update'])->name('admin.scud.sait.index.partnerupdate');
        Route::delete('/{partner}', [PartnersController::class, 'destroy'])->name('admin.scud.sait.index.partnerdel');
    });
    //Выполненные работы(портфолио)
    Route::prefix('project')->group(function () {
        Route::get('/', [ProjectsController::class,'index'])->name('admin.scud.sait.index.projects');
        Route::get('/create', [ProjectsController::class, 'create'])->name('admin.scud.sait.index.createproject');
        Route::post('/create', [ProjectsController::class, 'store'])->name('admin.scud.sait.index.storeproject');
        Route::get('/{project}', [ProjectsController::class, 'edit'])->name('admin.scud.sait.index.editproject');
        Route::put('/{project}', [ProjectsController::class, 'update'])->name('admin.scud.sait.index.updateproject');
        Route::delete('/{project}', [ProjectsController::class, 'destroy'])->name('admin.scud.sait.index.delproject');
    });
});