<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChangePass;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Models\Multipic;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $abouts = DB::table('home_abouts')->first();
    $images = Multipic::all();
    return view('home',compact('brands','abouts','images'));
});

// Category Route
Route::get('/all/category', [CategoryController::class, 'AllCat'])->name('all.category');
Route::post('/add/category', [CategoryController::class, 'AddCat'])->name('store.category');
Route::get('/edit/category/{id}', [CategoryController::class, 'Edit']);
Route::post('/category/update/{id}', [CategoryController::class, 'Update']);
Route::get('/softdelete/category/{id}', [CategoryController::class, 'SoftDelete']);
Route::get('/category/restore/{id}', [CategoryController::class, 'Restore']);
Route::get('/trash/category/{id}', [CategoryController::class, 'TrashCat']);

// Brand Route
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'AddBrand'])->name('store.brand');
Route::get('/edit/brand/{id}', [BrandController::class, 'Edit']);
Route::post('/brand/update/{id}', [BrandController::class, 'Update']);
Route::get('/delete/brand/{id}', [BrandController::class, 'Delete']);

// Multi Image Route
Route::get('/multi/image', [BrandController::class, 'Multpic'])->name('mult.image');
Route::post('/multi/add', [BrandController::class, 'StoreImg'])->name('store.image');





// Admin All Route
Route::get('/home/slider', [HomeController::class, 'HomeSlider'])->name('home.slider');
Route::get('/add/slider', [HomeController::class, 'AddSlider'])->name('add.slider');
Route::post('/store/slider', [HomeController::class, 'StoreSlider'])->name('store.slider');
Route::get('/edit/slider/{id}', [HomeController::class, 'Edit']);
Route::post('/slider/update/{id}', [HomeController::class, 'Update']);
Route::get('/delete/slider/{id}', [HomeController::class, 'Delete']);


// Home About All Route
Route::get('/home/about', [AboutController::class, 'HomeAbout'])->name('home.about');
Route::get('/add/about', [AboutController::class, 'AddAbout'])->name('add.about');
Route::post('/store/about', [AboutController::class, 'StoreAbout'])->name('store.about');
Route::get('/edit/about/{id}', [AboutController::class, 'EditAbout']);
Route::post('/update/homeabout/{id}', [AboutController::class, 'UpdateAbout']);
Route::get('/delete/about/{id}', [AboutController::class, 'DeleteAbout']);


//Portfolio Page  Route
Route::get('/portfolio', [AboutController::class, 'Portfolio'])->name('portfolio');


// Admin Contact Page Route
Route::get('/admin/contact', [ContactController::class, 'AdminContact'])->name('admin.contact');
Route::get('/admin/add/contact', [ContactController::class, 'AdminAddContact'])->name('add.contact');
Route::post('/admin/store/contact', [ContactController::class, 'AdminStoreContact'])->name('store.contact');
Route::get('/edit/contact/{id}', [ContactController::class, 'EditAdminContact']);
Route::post('/update/contact/{id}', [ContactController::class, 'UpdateAdminContact']);
Route::get('/delete/contact/{id}', [ContactController::class, 'DeleteAdminContact']);
Route::get('/admin/message', [ContactController::class, 'AdminMessag'])->name('admin.message');
Route::get('/delete/message/{id}', [ContactController::class, 'DeleteMessage']);

// Home Contact Page Route
Route::get('/contact', [ContactController::class, 'Contact'])->name('contact');
Route::post('/contact/form', [ContactController::class, 'ContactForm'])->name('contact.form');






// Auth Route
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        // $users = User::all();
        // $users = DB::table('users')->get();

        return view('admin.index');
    })->name('dashboard');
});

Route::get('/user/logout', [BrandController::class, 'Logout'])->name('user.logout');

// Change Passwor and user profile Route
Route::get('/user/password', [ChangePass::class, 'CPassword'])->name('change.password');
Route::post('/password/update', [ChangePass::class, 'UpdatePassword'])->name('password.update');

// User Profile
Route::get('/user/profile', [ChangePass::class, 'Pupdate'])->name('profile.update');
Route::post('/user/profile/update', [ChangePass::class, 'UpdateProfile'])->name('update.user.profile');