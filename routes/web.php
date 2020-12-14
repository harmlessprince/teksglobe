<?php

use App\Http\Controllers\InterestController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WithdrawController;
use App\Models\Withdraw;
use Database\Factories\WithdrawFactory;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\EmailVerificationNotificationController;
use Laravel\Fortify\Http\Controllers\EmailVerificationPromptController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Laravel\Fortify\Http\Controllers\VerifyEmailController;

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

$limiter = config('fortify.limiters.login');

// Authentication...
Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->middleware(['guest'])
    ->name('login');

Route::post('/', [AuthenticatedSessionController::class, 'store'])
    ->middleware(array_filter([
        'guest',
        $limiter ? 'throttle:' . $limiter : null,
    ]));

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

// Reset Password
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware(['guest'])
    ->name('password.request');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware(['guest'])
    ->name('password.reset');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware(['guest'])
    ->name('password.email');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware(['guest'])
    ->name('password.update');
// Registration
Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware(['guest'])
    ->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware(['guest']);
// Email Verification...
Route::get('/email/verify', [EmailVerificationPromptController::class, '__invoke'])
    ->middleware(['auth'])
    ->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');
// Verify Payment
Route::post('payment/verify', [PaymentController::class, 'verify'])->name('payment.verify');

Route::middleware('auth', 'verified')->group(function () {
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::view('dashboard', 'admin.dashboard')->name('dashboard');
        Route::get('packages/create', [PackageController::class, 'create'])->name('packages.create');
        Route::post('packages', [PackageController::class, 'store'])->name('packages.store');
        Route::delete('packages/{package}', [PackageController::class, 'destroy'])->name('packages.destroy');
        Route::get('packages', [PackageController::class, 'adminIndex'])->name('packages.index');
        Route::get('investments', [InvestmentController::class, 'adminIndex'])->name('investments.adminindex');
        Route::get('investments/pending', [InvestmentController::class, 'pendingInvestments'])->name('investments.pending');
        Route::get('investments/declined', [InvestmentController::class, 'declinedInvestments'])->name('investments.declined');
        Route::post('investments/{investment}', [InvestmentController::class, 'update'])
            ->name('investments.update');
        Route::post('withdrawals/{withdrawal}', [WithdrawController::class, 'update'])->name('withdrawals.update');
        Route::get('withdrawals/pending', [WithdrawController::class, 'pendingWithdrawal'])->name('withdraws.pending');
        Route::get('withdrawals/approved', [WithdrawController::class, 'approvedWithdrawal'])->name('withdraws.approved');
        Route::get('withdrawals/declined', [WithdrawController::class, 'declinedWithdrawal'])->name('withdraws.declined');
        Route::get('membership', [MembershipController::class, 'index'])->name('membership.index');
        Route::post('membership/{user}', [MembershipController::class, 'update'])->name('membership.update');
        Route::get('membership/active', [MembershipController::class, 'index'])->name('membership.active');
        Route::get('membership/inactive', [MembershipController::class, 'index'])->name('membership.inactive');
        Route::get('loans/completed', [LoanController::class, 'completed'])->name('loans.completed');
        Route::get('loans/pending', [LoanController::class, 'pending'])->name('loans.pending');
        Route::get('loans/declined', [LoanController::class, 'declined'])->name('loans.declined');
        Route::get('loans/approved', [LoanController::class, 'approved'])->name('loans.approved');
        Route::post('loans/{loan}', [LoanController::class, 'update'])->name('loans.update');
    });

    Route::name('user.')->group(function () {
        Route::view('dashboard', 'user.dashboard')->name('dashboard');
        Route::post('investments/{investment}/loans', [LoanController::class, 'store'])
            ->name('loans.store');
        Route::get('investments/{investment}', [InvestmentController::class, 'show'])
            ->name('investments.show');
        Route::post('packages/{package}/investments', [InvestmentController::class, 'store'])
            ->name('investments.store');
        Route::get('investments', [InvestmentController::class, 'index'])->name('investments.index');
        Route::get('loans', [LoanController::class, 'index'])->name('loans.index');
        Route::get('packages', [PackageController::class, 'index'])->name('packages.index');
        Route::get('packages/{package}', [PackageController::class, 'show'])->name('packages.show');
        Route::get('membership', [MembershipController::class, 'show'])->name('membership.show');
        Route::post('transfers/confirm', [TransferController::class, 'confirm'])->name('transfers.confirm');
        Route::get('transfers', [TransferController::class, 'index'])->name('transfers.index');
        Route::post('transfers', [TransferController::class, 'store'])->name('transfers.store');
        Route::post('withdrawals', [WithdrawController::class, 'store'])->name('withdraws.store');
        Route::get('withdrawals/create', [WithdrawController::class, 'create'])->name('withdraws.create');
        Route::get('withdrawals/pending', [WithdrawController::class, 'pending'])->name('withdraws.pending');
        Route::get('withdrawals/approved', [WithdrawController::class, 'approved'])->name('withdraws.approved');
        Route::get('wallets', [InterestController::class, 'index'])->name('wallet.index');
        Route::get('profile', [UserController::class, 'show'])->name('profile.show');
    });
});
