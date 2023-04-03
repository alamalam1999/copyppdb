<?php


use App\Http\Controllers\Backend\pricing\PricingController;
use App\Http\Controllers\Backend\pricing\PricingTableController;


// Faq Management
Route::group(['namespace' => 'pricing'], function () {
    Route::get('pricing', [PricingController::class, 'index'])->name('pricing.index');
    Route::post('pricing', [PricingController::class, 'uploadPricing'])->name('pricing.upload');

    Route::get('pricingwave2', [PricingController::class, 'indexwave2'])->name('pricing.indexwave2');
});
