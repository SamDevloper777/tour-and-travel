<?php

use App\Livewire\Admin\Category\CategoryList;
use App\Livewire\Admin\Destination\DestinationList;
use App\Livewire\Admin\Hotel\Category\HotelCategoryList;
use App\Livewire\Admin\Hotel\Hotel\HotelList;
use App\Livewire\Auth\AdminLogin;
use App\Livewire\Admin\Dashboard\Dashboard;
use App\Livewire\Public\Home\Home;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', Home::class)->name('home');

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
   Route::get('/',Dashboard::class)->name('dashboard');
   Route::get('/category',CategoryList::class)->name('category.list');
   Route::get('/destination',DestinationList::class)->name('destination.list');
   Route::get('/hotel-category',HotelCategoryList::class)->name('hotel-category.list');
   Route::get('/hotel',HotelList::class)->name('hotel.list');
    Route::get('/hotel/create',\App\Livewire\Admin\Hotel\Hotel\AddHotel::class)->name('hotel.create');
    Route::get('/hotel/{id}/edit',\App\Livewire\Admin\Hotel\Hotel\UpdateHotel::class)->name('hotel.edit');
});

Route::get('/login',AdminLogin::class)->name('login');

Route::get('logout',function(){
    Auth::logout();
    return redirect()->route('login');
})->name('logout');