<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\User;
use App\Models\Loan;
use App\Models\Saving;
use App\Models\Transaction;
use App\Models\Commodity_request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
// multiple user creation 
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MembersImport;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dash()
    {
        //
        return view('admin.dash');
    }

    public function toggleStatus($id)
{
    $member = User::findOrFail($id);

    $member->status = $member->status === 'active' ? 'inactive' : 'active';
    $member->save();

    return redirect()->back()->with('success', 'Member status updated successfully!');
}

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

      // Load member with loans & savings
    $member = User::with(['savings' => function ($q) {
            $q->orderBy('created_at', 'desc');
        },
        'loans' => function ($q) {
            $q->orderBy('created_at', 'desc');
        }])->findOrFail($id);
    $availableSavings = $member->totalSavings();
    // Compute totals for this member
    $totalLoans = $member->loans->sum('requested_amount') ?? 0;
    $totalRepaid = $member->loans->sum('amount_repaid') ?? 0;
    $outstanding = max($totalLoans - $totalRepaid, 0);
    // $userId = auth()->id();

    // Pass everything to the view
    return view('admin.repay-loan', compact('member','totalLoans', 'totalRepaid','outstanding','availableSavings'));
}

    /**
     * Show the form for editing the specified resource.
     */
  public function edit($id)
{
    $member = User::findOrFail($id);
    return view('admin.editMember', compact('member'));
}

public function update(Request $request, $id)
{
    $member = User::findOrFail($id);

    // Validate form data
    $request->validate([
        'name' => 'required|string|max:255',
        'department' => 'required|string|max:255',
        'membership_no' => 'required|string|max:255',
        'password' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'phone' => 'nullable|string|max:20',
        'status' => 'required|in:active,inactive',
    ]);

    // Update record
    $member->update([
        'name' => $request->name,
        'department' => $request->department,
        'membership_no' => $request->membership_no,
        'password' => Hash::make($request->password), // Hashing the password
        'email' => $request->email,
        'phone' => $request->phone,
        'status' => $request->status,
    ]);

    return redirect()->route('membermanagement')->with('success', 'Member information updated successfully!');
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        //
        $member = User::findOrFail($id);

    // Optional: prevent admin from deleting themselves
    if (auth()->id() === $member->id) {
        return redirect()->back()->with('error', 'You cannot delete your own account.');
    }

    // Optional: delete related data (loans, savings, etc.)
    $member->loans()->delete();
    $member->savings()->delete();

     // Delete profile picture from storage (if exists)
    if ($member->passport) {
        $profilePath = public_path('images/' . $member->passport);
        if (file_exists($profilePath)) {
            @unlink($profilePath);
        }
    }


    // Delete the member
    $member->delete();

    return redirect()->route('membermanagement')->with('success', 'Member deleted successfully!');
    }

public function importMembers(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls,csv|max:2048',
    ]);

    Excel::import(new MembersImport, $request->file('file'));

    return redirect()->back()->with('success', 'Members imported successfully!');
}

    // member management 
    public function managemeber(Request $request){
        $query = User::with(['loans', 'savings']);

    // Filter by name
    if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');
    }
        $members = $query->paginate(20);
        return view('admin.membermanagement',compact('members'));

    }



    // memeber contribution and savings 
    /**
     * Display member contribution and savings page.
     */
public function contribution(Request $request)
{
    // Base query with relationships
    $query = User::with(['loans', 'savings']);

    // 🔹 Filter by name
    if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');
    }

    // 🔹 Filter by loan status (if provided)
    if ($request->filled('status')) {
        $query->whereHas('loans', function ($q) use ($request) {
            $q->where('status', $request->status);
        });
    }

    // 🔹 Filter by registration date
    if ($request->filled('created_at') && $request->filled('updated_at')) {
        $query->whereBetween('created_at', [$request->created_at, $request->updated_at]);
    }

    // 🔹 Load members and compute pending savings
    $members = $query
        ->withSum(['savings as total_pending' => function ($q) {
            $q->where('status', 'pending');
        }], 'amount')
        ->paginate(20);

    // 🔹 For each member, compute loan totals dynamically
     // Add calculated values to each member
    foreach ($members as $member) {
        $member->totalApprovedSavings = $member->savings->where('status', 'approved')->sum('amount');
        $member->totalLoans = $member->loans->where('status', 'approved')->sum('requested_amount');
        $member->totalRepaid = $member->loans->where('status', 'approved')->sum('amount_repaid');
        $member->total_outstanding = max($member->totalLoans - $member->totalRepaid, 0);
    }

    // grab status from the request (nullable)
    $status = $request->input('status', null);

    // 🔹 You can calculate global totals (optional)
    $totalLoans = $members->sum('totalLoans');
    $totalRepaid = $members->sum('totalRepaid');
    $total_outstanding = $members->sum('total_outstanding');

    // 🔹 Return data to the view
    return view('admin.contributionsavings', compact(
        'members',
        'status'
    ));
}

 public function membersSavings()
    {
        $members = User::with('savings')->paginate(20);

        // Calculate per member totals
        foreach ($members as $member) {
            $member->totalApproved = $member->savings->where('status', 'approved')->sum('amount');
            $member->totalPending = $member->savings->where('status', 'pending')->sum('amount');
        }

        return view('admin.savings', compact('members'));

    }

      // Approve all pending savings for a member
    public function approveMemberSavings($id)
{
    $member = User::with('savings')->findOrFail($id);

    // Get total pending savings
    $pendingTotal = $member->savings->where('status', 'pending')->sum('amount');

    if ($pendingTotal <= 0) {
        return redirect()->back()->with('info', "{$member->name} has no pending savings to approve.");
    }

    // Approve all pending savings
    Saving::where('user_id', $member->id)
        ->where('status', 'pending')
        ->update(['status' => 'approved','is_applied'=>true,'remark'=>"Approved"]);

    // ✅ Update user's total_savings field
    $totalApproved = Saving::where('user_id', $member->id)
        ->where('status', 'approved')
        ->sum('amount');

    $member->update(['total_savings' => $totalApproved]);
  

    return redirect()->back()->with('success', "{$member->name}'s pending savings approved successfully! Total savings updated to ₦" . number_format($totalApproved, 2));
}

public function toggleAdmin(User $member): RedirectResponse
{
    // Don't allow self demotion
    if (auth()->id() == $member->id) {
        return back()->with('error', 'You cannot change your own admin status.');
    }

    $member->is_admin = !$member->is_admin;
    $member->save();

    return back()->with('status', 'Admin status updated for ' . $member->name);
}

    public function loanManagement(){
        return view('admin.loanManagement');
    }

    public function transactions(Request $request, $user_Id)
{
    $user = User::findOrFail($user_Id);

    // Filters
    $type = $request->type;
    $loanType = $request->loan_type;
    $dateFrom = $request->date_from;
    $dateTo = $request->date_to;

    $query = Transaction::where('user_Id', $user_Id);

    if ($type) {
        $query->where('type', $type);
    }

    if ($loanType) {
        $query->where('loan_type', $loanType);
    }

    if ($dateFrom) {
        $query->whereDate('created_at', '>=', $dateFrom);
    }

    if ($dateTo) {
        $query->whereDate('created_at', '<=', $dateTo);
    }

    // Paginate
    $transactions = $query->orderBy('created_at', 'desc')->paginate(20);

    // Total Approved Savings
    $totalApprovedSavings = Saving::where('user_Id', $user_Id)
        ->where('status', 'approved')
        ->sum('amount');

    // Total Loan Paid
    $totalLoanPaid = Loan::where('user_Id', $user_Id)
        ->where('status', 'approved')
        ->sum('amount_repaid');

    // Outstanding Loan
    $totalOutstandingLoan = Loan::where('user_Id', $user_Id)
        ->where('status', 'approved')
        ->sum('outstanding_balance');

    // Total transactions amount (footer total)
    $tableTotal = $query->sum('amount');

    // ledger reports  
     $user = User::with(['savings', 'loans', 'commodityRequests'])->findOrFail($user_Id);

        // --- SAVINGS ---
        $savingBF = $user->savings()
            ->where('status', 'approved')
            ->whereDate('created_at', '<', now()->startOfMonth())
            ->sum('amount');

        $savingsThisMonth = $user->savings()
            ->where('status', 'approved')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('amount');

        $totalSavings = $savingBF + $savingsThisMonth;

        // --- LOANS ---
        $loanBF = $user->loans()->where('status', 'approved')->sum('outstanding_balance');
        $loanGranted = $user->loans()->whereMonth('created_at', now()->month)->sum('requested_amount');
        $loanPrincipalRepayment = $user->loans()->sum('amount_repaid');
        $loanRepaymentCF = $loanBF + $loanGranted - $loanPrincipalRepayment;
        $loanLedgerCF = $loanRepaymentCF; // or calculate differently if needed
        // $loanInterest = $user->loans()->sum('interest_rate');

        // --- COMMODITY SALES ---
        $commodityBF = $user->commodityRequests()->where('status', 'approved')->sum('price');
        $commodityDuring = $user->commodityRequests()->where('status', 'approved')->whereMonth('created_at', now()->month)->sum('price');
        $commodityRepayment = $user->commodityRequests()->where('status', 'approved')->sum('payment_amount');
        $commodityCF = $commodityBF + $commodityDuring - $commodityRepayment;
        $principalRecovery = $user->commodityRequests()->sum('payment_amount');
        // $interestCharge = $user->commodityRequests()->sum('interest_rate');
        $commoditySalesRepayment = $user->commodityRequests()->sum('payment_amount');

        // --- CHARGES ---
        // $incidentalCharges = $user->charges()->sum('incidental_charges');
        $extraCharges = $user->transactions()->sum('processing_charge');

        // --- TOTAL DEDUCTION ---
        $totalDeduction = $loanPrincipalRepayment + $commodityRepayment + $extraCharges;

    return view('admin.receipt', compact(
        'transactions',
        'user',
        'totalApprovedSavings',
        'totalLoanPaid',
        'totalOutstandingLoan',
        'tableTotal',
         'user',
            'savingBF',
            'savingsThisMonth',
            'totalSavings',
            'loanBF',
            'loanGranted',
            'loanPrincipalRepayment',
            'loanRepaymentCF',
            'loanLedgerCF',
            // 'loanInterest',
            'commodityBF',
            'commodityDuring',
            'commodityRepayment',
            'commodityCF',
            'principalRecovery',
            // 'interestCharge',
            'commoditySalesRepayment',
            // 'incidentalCharges',
            'extraCharges',
            'totalDeduction'
    ));
}



    /**
     * Display account transaction page.
     */


public function allCommodityRequests()
{
    $users = User::with('commodityRequests')->paginate(20);

    foreach ($users as $user) {

        // Total approved commodity price
        $user->approved_total = $user->commodityRequests
            ->where('status', 'approved')
            ->sum('price');

        // Total pending
        $user->pending_total = $user->commodityRequests
            ->where('status', 'pending')
            ->sum('price');

        // Total paid
        $user->total_paid = $user->commodityRequests
            ->where('status', 'approved')
            ->sum('payment_amount');

        // Interest (6% of approved total)
        $user->interest = $user->approved_total * 0.06;

        // Total amount owed including interest
        $user->amount_due = $user->approved_total + $user->interest;

        // Balance including interest
        $user->balance = max($user->amount_due - $user->total_paid, 0);
    }

    // Grand totals
    $grandPending = $users->sum('pending_total');
    $grandApproved = $users->sum('approved_total');
    $grandPaid = $users->sum('total_paid');
    $grandInterest = $users->sum('interest');
    $grandDue = $users->sum('amount_due');
    $grandBalance = $users->sum('balance');

    return view('admin.comodityManagement', compact(
        'users',
        'grandApproved',
        'grandPaid',
        'grandBalance',
        'grandPending',
        'grandInterest',
        'grandDue'
    ));
}





public function approveAll($userId)
{
    $user = User::with('commodityRequests')->findOrFail($userId);

    // Filter pending requests
    $pendingRequests = $user->commodityRequests->where('status', 'pending');

    if ($pendingRequests->isEmpty()) {
        return back()->with('error', 'No pending commodities to approve.');
    }

    $totalApproved = $pendingRequests->sum('price'); // Sum price safely


    // Approve and update each request
    foreach ($pendingRequests as $request) {
        $request->update([
            'approved_price' => $request->price,
            'status' => 'approved'
        ]);
    }

    return back()->with('success', 'All pending commodities approved successfully!');
}
        public function search(Request $request)
    {
        $search = $request->input('query');

        // Search users by name and load their commodity requests
        $users = User::with('commodityRequests')
            ->where('name', 'LIKE', "%{$search}%")
            ->get();
     foreach ($users as $user) {

        // Total approved commodity price
        $user->approved_total = $user->commodityRequests
            ->where('status', 'approved')
            ->sum('price');

        // Total pending
        $user->pending_total = $user->commodityRequests
            ->where('status', 'pending')
            ->sum('price');

        // Total paid
        $user->total_paid = $user->commodityRequests
            ->where('status', 'approved')
            ->sum('payment_amount');

        // Interest (6% of approved total)
        $user->interest = $user->approved_total * 0.06;

        // Total amount owed including interest
        $user->amount_due = $user->approved_total + $user->interest;

        // Balance including interest
        $user->balance = max($user->amount_due - $user->total_paid, 0);
    }

    // Grand totals
    $grandPending = $users->sum('pending_total');
    $grandApproved = $users->sum('approved_total');
    $grandPaid = $users->sum('total_paid');
    $grandInterest = $users->sum('interest');
    $grandDue = $users->sum('amount_due');
    $grandBalance = $users->sum('balance');

    return view('admin.comodityManagement', compact('users', 'search','grandApproved', 'grandPaid', 'grandBalance','grandPending'));
    }

public function payCommodity(Request $request, $userId)
{
    $validated = $request->validate([
        'payment_amount' => 'required|numeric|min:1'
    ]);

    $user = User::with('commodityRequests')->findOrFail($userId);

    $approvedTotal = $user->commodityRequests
        ->where('status', 'approved')
        ->sum('price');

    // 6% interest
    $interest = $approvedTotal * 0.06;
    $amountDue = $approvedTotal + $interest;

    $totalPaid = $user->commodityRequests
        ->where('status', 'approved')
        ->sum('payment_amount');

    // Payment Outstanding
    $outstanding = $amountDue - $totalPaid;

    if ($outstanding <= 0) {
        $outstanding = 0; // <<< force display 0 instead of negative or error
    }

    // Validate payment only if there is outstanding
    if ($outstanding == 0) {
        return back()->with('error', 'All payments completed.');
    }

    if ($validated['payment_amount'] > $outstanding) {
        return back()->with('error', 'Payment cannot exceed outstanding balance (₦' . number_format($outstanding, 2) . ')');
    }

    foreach ($user->commodityRequests->where('status', 'approved') as $req) {
        $req->payment_amount = ($req->payment_amount ?? 0) + $validated['payment_amount'];
        $req->save();
        break;
    }

    $totalPaid = $user->commodityRequests
        ->where('status', 'approved')
        ->sum('payment_amount');

    if ($totalPaid >= $amountDue) {
        foreach ($user->commodityRequests->where('status', 'approved') as $req) {
            $req->status = 'completed';
            $req->save();
        }
    }

    return back()->with('success', 'Payment recorded successfully.');
}

public function showComReport($userId){

         $user = User::with('commodityRequests')->findOrFail($userId);
    
    // Total Approved Cost
    $approvedTotal = $user->commodityRequests
        ->where('status', 'approved')
        ->sum('price');

    // Total Pending
    $pendingTotal = $user->commodityRequests
        ->where('status', 'pending')
        ->sum('price');

    // Total Paid
    $totalPaid = $user->commodityRequests
        ->where('status', 'approved')
        ->sum('payment_amount');

    // Interest 6%
    $interest = $approvedTotal * 0.06;

    // Amount Due including interest
    $amountDue = $approvedTotal + $interest;

    // Balance
    $balance = max($amountDue - $totalPaid, 0);

    return view('admin.comreport', compact(
        'user', 'approvedTotal', 'pendingTotal', 'totalPaid', 'interest', 'amountDue', 'balance'
    ));



}



        public function  searchSavingsReport(Request $request)
        {
         $search = $request->input('query');
         // Get total pending savings
        // Get all users matching the search + calculate totals
        $members = User::with('savings')
            ->where('name', 'LIKE', "%{$search}%")
            ->paginate(20)
            ->appends(['query' => $search]);

        foreach ($members as $member) {
        $member->totalApproved = $member->savings->where('status', 'approved')->sum('amount');
        $member->totalPending = $member->savings->where('status', 'pending')->sum('amount');
    }

        return view('admin.savings', compact('members', 'search'));
        }



//  public function showLedger($userId)
//     {
//         $user = User::with(['savings', 'loans', 'commodities'])->findOrFail($userId);

//         // --- SAVINGS ---
//         $savingBF = $user->savings()
//             ->where('status', 'approved')
//             ->whereDate('created_at', '<', now()->startOfMonth())
//             ->sum('amount');

//         $savingsThisMonth = $user->savings()
//             ->where('status', 'approved')
//             ->whereMonth('created_at', now()->month)
//             ->whereYear('created_at', now()->year)
//             ->sum('amount');

//         $totalSavings = $savingBF + $savingsThisMonth;

//         // --- LOANS ---
//         $loanBF = $user->loans()->where('status', 'approved')->sum('principal_balance_bf');
//         $loanGranted = $user->loans()->whereMonth('created_at', now()->month)->sum('amount');
//         $loanPrincipalRepayment = $user->loans()->sum('principal_repayment');
//         $loanRepaymentCF = $loanBF + $loanGranted - $loanPrincipalRepayment;
//         $loanLedgerCF = $loanRepaymentCF; // or calculate differently if needed
//         $loanInterest = $user->loans()->sum('interest_charges');

//         // --- COMMODITY SALES ---
//         $commodityBF = $user->commodities()->sum('balance_bf');
//         $commodityDuring = $user->commodities()->whereMonth('created_at', now()->month)->sum('sales_amount');
//         $commodityRepayment = $user->commodities()->sum('repayment');
//         $commodityCF = $commodityBF + $commodityDuring - $commodityRepayment;
//         $principalRecovery = $user->commodities()->sum('principal_recovery');
//         $interestCharge = $user->commodities()->sum('interest_charge');
//         $commoditySalesRepayment = $user->commodities()->sum('repayment');

//         // --- CHARGES ---
//         $incidentalCharges = $user->charges()->sum('incidental_charges');
//         $extraCharges = $user->charges()->sum('extra_charges');

//         // --- TOTAL DEDUCTION ---
//         $totalDeduction = $loanPrincipalRepayment + $loanInterest + $commodityRepayment + $incidentalCharges + $extraCharges;

//         return view('admin.receipt', compact(
//             'user',
//             'savingBF',
//             'savingsThisMonth',
//             'totalSavings',
//             'loanBF',
//             'loanGranted',
//             'loanPrincipalRepayment',
//             'loanRepaymentCF',
//             'loanLedgerCF',
//             'loanInterest',
//             'commodityBF',
//             'commodityDuring',
//             'commodityRepayment',
//             'commodityCF',
//             'principalRecovery',
//             'interestCharge',
//             'commoditySalesRepayment',
//             'incidentalCharges',
//             'extraCharges',
//             'totalDeduction'
//         ));
//     }       


}
