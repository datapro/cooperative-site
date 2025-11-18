<?php

namespace App\Http\Controllers\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commodity_request;
use Illuminate\Support\Facades\Auth; // Import this!
class CommodityRequestController extends Controller
{
    //
    public function commodity(){
          $user_id = auth()->id();
        $commodities = Commodity_request::where('user_id', $user_id)
                 ->latest()  // same as orderBy('created_at', 'desc')
                 ->get();
        $user = Auth::user();
        if (!$user) {
            return back()->with('error', 'User not authenticated and logged out.');
        }

        $commodity = Commodity_request::where('user_id', $user->id)
                ->where('status', 'active')
                ->first();
        return view('member.commodity_request', compact('commodities','commodity'));
    }

    public function requestCommodity(Request $request)
{
    // Validate input
    $validated = $request->validate([
        'price' => 'required|numeric|min:1',
        'payment_plan' => 'required|string|max:50',     // e.g. weekly, monthly, quarterly
        'payment_option' => 'required|string|max:50',   // e.g. full, installment
        'note' => 'nullable|string|max:255',   
        // 'created_by' => 'required|numeric|min:1',
        
    ]);

    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Please log in to request loan.');
    }

    $user = Auth::user();
    if ($user->status !== 'active') {
        return back()->with('error', 'Your account is inactive. Please contact admin.');
    }

    // Save Loan
    Commodity_request::create([
        'user_id' => $user->id,
        'price' => $validated['price'],
        'payment_plan' => $validated['payment_plan'],
        'payment_option' => $validated['payment_option'],
        'note' => $validated['note'],
        'status' => 'pending',
    ]);

    return back()->with('success', 'Commodity request submitted successfully and awaiting approval.');
}


}
