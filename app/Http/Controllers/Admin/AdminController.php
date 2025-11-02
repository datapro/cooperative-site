<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\User;
use App\Models\Loan;
use App\Models\Saving;

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
    public function create()
    {
        //
    }

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
        //
      // Load member with loans & savings
    $member = User::with(['savings', 'loans'])->findOrFail($id);
    $availableSavings = $member->totalSavings();
    // Compute totals for this member
    $totalLoans = $member->loans->sum('requested_amount') ?? 0;
    $totalRepaid = $member->loans->sum('amount_repaid') ?? 0;
    $outstanding = max($totalLoans - $totalRepaid, 0);

    // Pass everything to the view
    return view('admin.repay-loan', compact('member', 'totalLoans', 'totalRepaid', 'outstanding','availableSavings'));
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
        $members = $query->paginate(5);
        return view('admin.membermanagement',compact('members'));

    }



    // memeber contribution and savings 
    /**
     * Display member contribution and savings page.
     */
 public function contribution(Request $request)
{
    // Base query
    $query = User::with(['loans', 'savings']);

    // Filter by name
    if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');
    }

    //  Filter by loan status
    if ($request->filled('status')) {
        $query->whereHas('savings', function ($q) use ($request) {
            $q->where('status', $request->status);
        });
    }

    //  Filter by registration date
    if ($request->filled('created_at') && $request->filled('updated_at')) {
        $query->whereBetween('created_at', [$request->created_at, $request->updated_at]);
    }

    $search = $request->input('search');

    //  Load members with savings + loans
    $members = $query
        ->withSum(['savings as total_pending' => function ($q) {
            $q->where('status', 'pending');
        }], 'amount')
        ->get()
        ->map(function ($member) {
            // Compute outstanding loan per member
            $totalLoans = $member->loans->where('status', 'active')->sum('requested_amount');
            $totalRepaid = $member->loans->sum('amount_repaid');
            $member->total_outstanding = max($totalLoans - $totalRepaid, 0);
            return $member;
        })
        ->filter(fn($member) => $member->total_outstanding > 0 || $member->total_pending > 0)
        ->sortByDesc('total_outstanding');

    // 🔹 Total outstanding loans (global)
    $totalOutstandingAll = Loan::where('status', 'active')
        ->whereNotNull('requested_amount')
        ->sum('requested_amount');

    // 🔹 Paginate manually (since we used ->get())
    $members = $members->values();

    return view('admin.contributionsavings', compact(
        'members',
        'search',
        'totalOutstandingAll'
    ));
}
    public function outStandingLoan(Request $request){
    
        $search = $request->input('search');

        // Members with total outstanding loans (NULL treated as 0)
        $members = User::withSum(['loans as total_outstanding' => function ($query) {
                $query->where('status', 'active');
            }], 'requested_amount')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->get()
            // Replace NULL with 0 and filter out members not owing
            ->map(function ($member) {
                $member->total_outstanding = $member->total_outstanding ?? 0;
                return $member;
            })
            ->filter(function ($member) {
                return $member->total_outstanding > 0;
            })
            ->sortByDesc('total_outstanding');

        // Grand total of outstanding loans (NULL-safe)
        $totalOutstandingAll = Loan::where('status', 'active')
            ->whereNotNull('requested_amount')
            ->sum('requested_amount');

        return view('admin.contributionsavings', compact('members', 'totalOutstandingAll', 'search'));
    }

    public function loanManagement(){
        return view('admin.loanManagement');
    }


    /**
     * Display account transaction page.
     */
    public function accountTransaction()
    {
        return view('admin.accountTransaction');
    }

    /**
     * Display analytics reports for the admin dashboard.
     */
    public function reportAnalytics()
    {
        // Basic metrics (replace table/column names with your actual schema if different)
      return view('admin.reportAnalytics');
    }

    public function settings(){
        return view('admin.settings');
    }

    public function comodity(){
        return view('admin.comodityManagement');
    }
}