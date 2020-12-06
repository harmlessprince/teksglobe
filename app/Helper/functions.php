<?php

use Illuminate\Support\Facades\DB;

/**
 * Credit a user wallet
 *
 * @param integer $user
 * @param float $amount
 * @param string $narration
 * @return void
 */
function creditInterestTable(int $user, int $investment, float $amount, string $narration): void
{
    DB::table('interests')->insertOrIgnore(
        [
            'user_id' => $user,
            'amount' => $amount,
            'investment_id' => $investment,
            'narration' => $narration,
            'type' => 'credit',
            'balance' => calculateWalletLedgerBalance($user) + $amount,
            'created_at' => now(),
            'updated_at' => now(),
        ]
    );
}

/**
 * Debit a user wallet
 *
 * @param integer $user
 * @param float $amount
 * @param string $narration
 * @return void
 */
function debitWallet(int $user, float $amount, string $narration): void
{
    DB::table('wallets')->insertOrIgnore(
        [
            'user_id' => $user,
            'amount' => $amount,
            'narration' => $narration,
            'type' => 'debit',
            'created_at' => now(),
            'updated_at' => now(),
        ]
    );
}

/**
 * Calculate user ledger wallet balance
 *
 * @param integer $user
 * @return float
 */
function calculateWalletLedgerBalance(int $user): float
{
    return DB::table('interests')
        ->where('user_id', $user)
        ->select(DB::raw("SUM(CASE WHEN type='credit' THEN amount ELSE -amount END) as amount"))
        ->value('amount') ?? 0.00;
}

/**
 * Calculate user available wallet balance
 *
 * @param integer $user
 * @return string
 */
function calculateWalletAvailableBalance(int $user): string
{
    $amount = (float)calculateWalletLedgerBalance($user);
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
