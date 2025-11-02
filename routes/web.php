<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Member\MemberSavingsController;
use App\Http\Controllers\Member\MemberLoanController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [App\Http\Controllers\PagesController::class, 'index'])->name('index');
Route::get('/about', [App\Http\Controllers\PagesController::class, 'about'])->name('about');
// contact
Route::get('/send', [App\Http\Controllers\ContactController::class, 'send'])->name('contact.send');
// Loan
Route::get('/apply', [App\Http\Controllers\LoanController::class, 'apply'])->name('apply');

// Login
Route::get('/userlogin', [App\Http\Controllers\Auth\LoginController::class, 'userlogin'])->name('userlogin');




Auth::routes();
// admin

Route::get('/admin', [App\Http\Controllers\Admin\AdminController::class, 'dash'])->name('admin');

// resourse route
Route::get('/membermanagement', [App\Http\Controllers\Admin\AdminController::class, 'managemeber'])->name('membermanagement');

Route::put('/admin/members/{id}/toggle-status', [App\Http\Controllers\Admin\AdminController::class, 'toggleStatus'])->name('admin.members.toggleStatus');
Route::get('/admin/{id}/editmember', [App\Http\Controllers\Admin\AdminController::class, 'edit'])
    ->name('admin.editmember');
Route::put('/admin/members/{id}', [App\Http\Controllers\Admin\AdminController::class, 'update'])
    ->name('admin.member');

// multiple member creation route 
Route::post('/admin/members/import', [App\Http\Controllers\Admin\AdminController::class, 'importMembers'])
    ->name('admin.members.import');

// delete member 
Route::delete('/admin/members/{id}', [App\Http\Controllers\Admin\AdminController::class, 'destroy'])
    ->name('admin.members.destroy');


// ✅ Correct — includes {loanId}
Route::get('/contributionsavings', [App\Http\Controllers\Admin\AdminController::class, 'contribution'])->name('contributionsavings');
Route::get('/admin/{id}/repay-loan', [App\Http\Controllers\Admin\AdminController::class, 'show'])->name('admin.repay-loan');
Route::get('/loanManagement', [App\Http\Controllers\Admin\AdminController::class, 'loanManagement'])->name('loanManagement');
Route::get('/accountTransaction', [App\Http\Controllers\Admin\AdminController::class, 'accountTransaction'])->name('accountTransaction');
Route::get('/reportAnalytics', [App\Http\Controllers\Admin\AdminController::class, 'reportAnalytics'])->name('reportAnalytics');
Route::get('/settings', [App\Http\Controllers\Admin\AdminController::class, 'settings'])->name('settings');
Route::get('/comodity', [App\Http\Controllers\Admin\AdminController::class, 'comodity'])->name('comodity');



// Member side
Route::get('/admin/{$id}/repay-loan', [App\Http\Controllers\Admin\AdminController::class, 'show'])->name('admin.repay-loan');
Route::post('/member/loan/{loan}/repay', [App\Http\Controllers\Admin\LoanRepaymentController::class, 'store'])->name('loan.repay.store');
// Admin side
Route::post('/admin/repayment/{id}/approve', [App\Http\Controllers\Admin\LoanRepaymentController::class, 'approve'])->name('admin.repayment.approve');




// member controller 
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// member loan 
Route::get('/profile', [App\Http\Controllers\Member\MemberSavingsController::class, 'profile'])->name('profile');
Route::get('/memberloan', [App\Http\Controllers\LoanController::class, 'memberloan'])->name('memberloan');


// savving
Route::get('/membersavings', [App\Http\Controllers\Member\MemberSavingsController::class, 'savings'])->name('membersavings');
Route::post('/membersavings', [App\Http\Controllers\Member\MemberSavingsController::class, 'savings'])->name('membersavings');
Route::get('/membercontributions', [App\Http\Controllers\Member\MemberSavingsController::class, 'contribution'])->name('membercontributions');
Route::get('/member/{id}/memberupdate', [App\Http\Controllers\Member\MemberSavingsController::class, 'memberedit'])->name('member.memberedit');
Route::put('/member/{id}/memberupdate', [App\Http\Controllers\Member\MemberSavingsController::class, 'memberupdate'])->name('member.memberupdate');
Route::post('/member/savings', [App\Http\Controllers\Member\MemberSavingsController::class, 'storesaving'])->name('member.savings');
Route::get('/member/savings', [MemberSavingsController::class, 'userSavings'])->name('member.showsavings');

// loan request
Route::post('/member/loan', [MemberLoanController::class, 'requestLoan'])->name('member.loan');
Route::post('/memberloan', [MemberLoanController::class, 'payLoan'])->name('memberloan');