<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Saving;
use App\Models\Loan;
use App\Models\Transaction;

class ConsolidationController extends Controller
{
public function index(Request $request)
{
    $search = $request->input('name');

   $usersQuery = User::with(['loans' => fn($q) => $q->whereIn('status', ['approved', 'complete'])]);


    if ($search) {
        $usersQuery->where('name', 'LIKE', "%{$search}%");
    }

    $users = $usersQuery->orderBy('created_at', 'desc')->paginate(20)->appends(['name' => $search]);

    // Prepare consolidation data
    $consolidation = $users->map(function ($user) {

        $totalLoans = 0;
        $totalInterest = 0;
        $totalRepaid = 0;
        $totalOutstanding = 0;
        $totalExcess = 0;

        $loansDetails = $user->loans->map(function ($loan) use (&$totalLoans, &$totalInterest, &$totalRepaid, &$totalOutstanding, &$totalExcess) {
            $principal = $loan->requested_amount;
            $interest  = ($loan->interest_rate / 100) * $principal * max(1, $loan->duration);
            $totalDue  = $principal + $interest;
            $repaid    = $loan->amount_repaid;

            $outstanding = max(0, $totalDue - $repaid);
            $excess = max(0, $repaid - $totalDue);

            $durationMonths = max(1, $loan->duration);
            $monthlyPrincipal = $principal / $durationMonths;
            $monthlyInterest  = $interest / $durationMonths;
            $monthlyExpected  = $monthlyPrincipal + $monthlyInterest;

            $totalLoans       += $principal;
            $totalInterest    += $interest;
            $totalRepaid      += $repaid;
            $totalOutstanding += $outstanding;
            $totalExcess      += $excess;

            return (object)[
                'id' => $loan->id,
                'principal' => $principal,
                'interest' => $interest,
                'totalDue' => $totalDue,
                'monthlyPrincipal' => $monthlyPrincipal,
                'monthlyInterest' => $monthlyInterest,
                'monthlyExpected' => $monthlyExpected,
                'amountRepaid' => $repaid,
                'outstanding' => $outstanding,
                'excess' => $excess,
                'status' => $loan->status,
                'created_at' => $loan->created_at,
            ];
        })->sortByDesc('created_at');

        return (object)[
            'id' => $user->id,
            'name' => $user->name,
            'totalLoans' => $totalLoans,
            'totalInterest' => $totalInterest,
            'totalRepaid' => $totalRepaid,
            'totalOutstanding' => $totalOutstanding,
            'totalExcess' => $totalExcess,
            'loansDetails' => $loansDetails,
        ];
    });

    return view('admin.consolidation', [
        'consolidation' => $consolidation,
        'users' => $users,
        'search' => $search,
    ]);
}

}