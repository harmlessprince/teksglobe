<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Credit a user wallet
 *
 * @param int $user
 * @param float $amount
 * @param string $narration
 * @param int $investment
 * @return void
 */
function creditInterestTable(int $user, float $amount, string $narration, int $investment = null): void
{
    DB::table('interests')->insertOrIgnore(
        [
            'user_id' => $user,
            'amount' => $amount,
            'investment_id' => $investment,
            'narration' => $narration,
            'type' => 'credit',
            'balance' => calculateLedgerBalance($user) + $amount,
            'created_at' => now(),
            'updated_at' => now(),
        ]
    );
}

/**
 * Debit a user wallet
 *
 * @param int $user
 * @param float $amount
 * @param string $narration
 * @return void
 */
function debitInterestTable(int $user, float $amount, string $narration): void
{
    DB::table('interests')->insertOrIgnore(
        [
            'user_id' => $user,
            'amount' => $amount,
            'narration' => $narration,
            'type' => 'debit',
            'balance' => calculateLedgerBalance($user) - $amount,
            'created_at' => now(),
            'updated_at' => now(),
        ]
    );
}

/**
 * Calculate user ledger wallet balance
 *
 * @param int $user
 * @return float
 */
function calculateLedgerBalance(int $user): float
{
    return DB::table('interests')
        ->select('balance')
        ->where('user_id', $user)
        ->latest('id')
        ->value('balance') ?? 0.00;
}

/**
 * Calculate user available wallet balance
 *
 * @param int $user
 * @return float
 */
function calculateAvailableBalance(int $user): float
{
    $amount = (float)calculateLedgerBalance($user);
    $pending = DB::table('withdraws')
        ->where('user_id', $user)
        ->where('status', 'pending')
        ->sum('amount');
    return $amount - $pending;
}

/**
 * Generate initials from a name
 *
 * @param string $name
 * @source https://chrisblackwell.me/generate-perfect-initials-using-php/ Generate Initials using PHP
 * @return string
 */
function generateInitials(string $name): string
{
    $words = explode(' ', $name);
    if (count($words) >= 2) {
        return strtoupper(substr($words[0], 0, 1) . substr(end($words), 0, 1));
    }
    return makeInitialsFromSingleWord($name);
}

/**
 * Make initials from a word with no spaces
 *
 * @param string $name
 * @source https://chrisblackwell.me/generate-perfect-initials-using-php/ Generate Initials using PHP
 * @return string
 */
function makeInitialsFromSingleWord(string $name): string
{
    preg_match_all('#([A-Z]+)#', $name, $capitals);
    if (count($capitals[1]) >= 2) {
        return substr(implode('', $capitals[1]), 0, 2);
    }
    return strtoupper(substr($name, 0, 2));
}

/**
 * Calculate charge on withdrawal
 *
 * @param float $amount
 * @return float
 */
function calculateChargeOnWithdrawal(float $amount = null): float
{
    $charge = (float)config('app.withdraw_fee');
    return ($amount * $charge) / 100;
}

/**
 * Calculate charge on transfer
 *
 * @param float $amount
 * @return float
 */
function calculateChargeOnTransfer(float $amount = null): float
{
    $charge = (float)config('app.transfer_fee');
    return ($amount * $charge) / 100;
}

/**
 * Calculate interest charge on loan
 *
 * @param float $amount
 * @return float
 */
function calculateInterestOnLoan(float $amount = null): float
{
    $interest = (float)config('app.interest_fee');
    return ($amount * $interest) / 100;
}

/**
 * Generate Reference number for user
 *
 * @return void
 */
function generatePaymentReference()
{
    $reference = Str::uuid();
    return str_replace('-', '', $reference);
}

/**
 * Return a successful JSON response
 *
 * @param array $payload
 * @param string $message
 * @param int $status
 * @return JsonResponse
 */
function respondWithSuccess($payload = [], $message = 'Successful', $status = 200): JsonResponse {
    return response()->json(['success' => true, 'message' => $message, 'payload' => $payload], $status);
}

/**
 * Return a successful JSON response
 *
 * @param array $payload
 * @param string $message
 * @param int $status
 * @return JsonResponse
 */
function respondWithError($payload = [], $message = 'An erorr occured', $status = 500): JsonResponse {
    return response()->json(['success' => false, 'message' => $message, 'payload' => $payload], $status);
}

/**
 * Credit a loan account
 *
 * @param int $user
 * @param float $amount
 * @param string $narration
 * @param string $investment
 * @return void
 */
function creditLoanAccountTable(int $user, float $amount, string $narration, int $investment = null): void
{
    DB::table('loan_accounts')->insertOrIgnore(
        [
            'user_id' => $user,
            'amount' => $amount,
            'narration' => $narration,
            'type' => 'credit',
            'investment_id' => $investment,
            'balance' => calculateUserLoanAccountBalance($user) + $amount,
            'total' => calculateLoanAccountBalance() + $amount,
            'created_at' => now(),
            'updated_at' => now(),
        ]
    );
}

/**
 * Debit a loan account
 *
 * @param int $user
 * @param float $amount
 * @param string $narration
 * @param int $investment
 * @return void
 */
function debitLoanAccountTable(int $user, float $amount, string $narration, int $investment = null): void
{
    DB::table('loan_accounts')->insertOrIgnore(
        [
            'user_id' => $user,
            'amount' => $amount,
            'narration' => $narration,
            'type' => 'debit',
            'investment_id' => $investment,
            'balance' => calculateUserLoanAccountBalance($user) - $amount,
            'total' => calculateLoanAccountBalance() - $amount,
            'created_at' => now(),
            'updated_at' => now(),
        ]
    );
}

/**
 * Calculate total account loan balance
 *
 * @return float
 */
function calculateLoanAccountBalance(): float
{
    return DB::table('loan_accounts')
        ->select('total')
        ->latest('id')
        ->value('total') ?? 0.00;
}

/**
 * Calculate total account loan balance
 *
 * @param int $user
 * @return float
 */
function calculateUserLoanAccountBalance(int $user): float
{
    return DB::table('loan_accounts')
        ->where('user_id', $user)
        ->select('balance')
        ->latest('id')
        ->value('balance') ?? 0.00;

    // return DB::table('loan_accounts')
    //     ->select(DB::raw("SUM(CASE WHEN type='credit' THEN amount ELSE -amount END) as amount"))
    //     ->value('amount') ?? '0.00';
}
