<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use TradeInTradeUp\Http\Controllers\Auth\ForgotPasswordController;
use TradeInTradeUp\Http\Controllers\Auth\LoginController;
use TradeInTradeUp\Http\Controllers\Auth\RegisterController;
use TradeInTradeUp\Http\Controllers\Auth\ResetPasswordController;
use TradeInTradeUp\Http\Controllers\CustomerInfoSectionsController;
use TradeInTradeUp\Http\Controllers\HomeController;
use TradeInTradeUp\Http\Controllers\PaymentSectionController;
use TradeInTradeUp\Http\Controllers\ReceiptSectionsController;
use TradeInTradeUp\Http\Controllers\SubmissionsController;
use TradeInTradeUp\Http\Controllers\TradedinSectionsController;
use TradeInTradeUp\Http\Controllers\TradedupSectionsController;
use TradeInTradeUp\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (Auth::user()->role !== 0) {
        return redirect('/dashboard');
    }

    return redirect('/submissions');
})->middleware('auth');

// Authentication routes (replaces the removed Auth::routes() helper).
Route::get('login', [LoginController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('login', [LoginController::class, 'login'])->middleware('guest');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->middleware('guest')->name('register');
Route::post('register', [RegisterController::class, 'register'])->middleware('guest');

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->middleware('guest')->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->middleware('guest')->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->middleware('guest')->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->middleware('guest')->name('password.update');

Route::get('/submission-form', [SubmissionsController::class, 'submissionForm'])->middleware('auth');
Route::get('/submissions', [SubmissionsController::class, 'allSubmissions'])->middleware('auth');
Route::get('/submissions/{id}', [SubmissionsController::class, 'getSubmission'])->middleware('auth');
Route::get('/submissions/admin/delete/{id}', [SubmissionsController::class, 'deleteSubmission'])->middleware('auth');
Route::get('/edit-info/customer-info/{id}', [CustomerInfoSectionsController::class, 'edit']);
Route::get('/edit-info/receipt-info/{id}', [ReceiptSectionsController::class, 'edit']);
Route::get('/edit-info/trade-in-info/{id}', [TradedinSectionsController::class, 'edit']);
Route::get('/edit-info/trade-up-info/{id}', [TradedupSectionsController::class, 'edit']);

Route::get('/certificates', [SubmissionsController::class, 'allCertificates'])->middleware('auth');
Route::get('/export-certificates-report', [SubmissionsController::class, 'exportCertificates'])->middleware('auth');
Route::get('/certificates/shipping/{id}', [SubmissionsController::class, 'getShipping'])->middleware('auth');
Route::get('/certificates/disable/{id}', [SubmissionsController::class, 'getCertificate'])->middleware('auth');

Route::post('/customer-update/{id}', [CustomerInfoSectionsController::class, 'update'])->name('customer-update');
Route::post('/receipt-update/{id}', [ReceiptSectionsController::class, 'update'])->name('receipt-update');
Route::post('/tradein-update/{id}', [TradedinSectionsController::class, 'update'])->name('tradein-update');
Route::post('/tradeup-update/{id}', [TradedupSectionsController::class, 'update'])->name('tradeup-update');

Route::get('/payments', [PaymentSectionController::class, 'allPayments'])->middleware('auth');
Route::get('/export-purchases-report', [PaymentSectionController::class, 'exportPurchases'])->middleware('auth');
Route::get('/payments/{id}', [PaymentSectionController::class, 'getPayment'])->middleware('auth');
Route::get('/payments/admin/delete/{id}', [PaymentSectionController::class, 'deletePayment'])->middleware('auth');

Route::post('/update-payments/{id}', [PaymentSectionController::class, 'updatePayment'])->middleware('auth');

Route::post('/update-shipping/{id}', [SubmissionsController::class, 'updateShipping'])->middleware('auth');

Route::get('/logout', function () {
    Auth::logout();

    return redirect('https://asdtoolup.3mcanada.ca/');
});

Route::get('/certificates/shipping/{id}/generate', [SubmissionsController::class, 'generatePDF'])->middleware('web');

Route::get('/api/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request')->middleware('web', 'guest');
Route::get('/api/password/{lang}/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.requestlang')->middleware('web', 'guest');

Route::post('/api/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email')->middleware('web', 'guest');

Route::get('/api/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset')->middleware('web', 'guest');
Route::get('/api/password/{lang}/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.resetlang')->middleware('web', 'guest');

Route::post('/api/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update')->middleware('web', 'guest');

Route::get('/customers', [UserController::class, 'getCustomersView'])->middleware('auth');
Route::get('/customers/{id}', [UserController::class, 'getCustomerView'])->middleware('auth');
Route::get('/settings', [UserController::class, 'settingsView'])->middleware('auth');
Route::post('/update-settings', [UserController::class, 'settingsUpdate'])->middleware('auth');
Route::post('/testSubmit', [SubmissionsController::class, 'createSubmission'])->middleware('auth')->name('testSubmit');

Route::post('/submission-review/{id}', [SubmissionsController::class, 'reviewSubmission'])->middleware('auth');
Route::get('/submissions-history/{id}', [SubmissionsController::class, 'getHistory'])->middleware('auth');

Route::get('/reports/invoice-value-by-user', [SubmissionsController::class, 'invoicevalue'])->middleware('auth');

Route::get('/dashboard', [HomeController::class, 'index'])->middleware('auth');
