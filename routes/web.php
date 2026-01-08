<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Member\MemberSavingsController;
use App\Http\Controllers\Member\MemberLoanController;
use App\Http\Controllers\Member\CommodityRequestController;

use App\Http\Controllers\Admin\UserDashboardController;
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [App\Http\Controllers\PagesController::class, 'index'])->name('index');
Route::get('/about', [App\Http\Controllers\PagesController::class, 'about'])->name('about');
// contact
Route::get('/send', [App\Http\Controllers\ContactController::class, 'send'])->name('contact.send');

// Loan
// Route::get('/apply', [App\Http\Controllers\LoanController::class, 'apply'])->name('apply');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users/{user}/dashboard', [UserDashboardController::class, 'show'])
        ->name('admin.users.dashboard');

        //    Route::get('/member/users/{user}/savings', [MemberSavingsController::class, 'memberSavings'])
        // ->name('member.users.savings');

        Route::post('/membersavings', [App\Http\Controllers\Member\MemberSavingsController::class, 'savings'])->name('membersavings');
        Route::get('/membercontributions', [App\Http\Controllers\Member\MemberSavingsController::class, 'contribution'])->name('membercontributions');
        Route::get('/member/{id}/memberupdate', [App\Http\Controllers\Member\MemberSavingsController::class, 'memberedit'])->name('member.memberedit');
        Route::put('/member/{id}/memberupdate', [App\Http\Controllers\Member\MemberSavingsController::class, 'memberupdate'])->name('member.memberupdate');
        Route::get('/member/{user}/savings', [MemberSavingsController::class, 'memberSavings'])->name('member.showsavings');
        Route::post('/member/{user}/savings', [App\Http\Controllers\Member\MemberSavingsController::class, 'storesaving'])->name('member.savings');

        // loan request
        Route::post('/member/loan', [MemberLoanController::class, 'requestLoan'])->name('member.loan');

        // commdity request 
        Route::get('/commodity_request', [App\Http\Controllers\Member\CommodityRequestController::class, 'commodity'])->name('commodity_request');
        Route::post('/member/commodity_request', [App\Http\Controllers\Member\CommodityRequestController::class, 'requestCommodity'])->name('member.commodity_request');

        Route::get('/memberdashboard/{user}', [App\Http\Controllers\HomeController::class, 'memberdashboard'])->name('memberdashboard');
   
    });




Route::middleware(['auth', 'admin'])->group(function () {

    Route::post('/admin/membermanagement/{member}/toggle-admin', [App\Http\Controllers\Admin\AdminController::class, 'toggleAdmin'])->name('admin.toggleAdmin');
    
        // admin
        Route::get('/admin', [App\Http\Controllers\Admin\AdminController::class, 'dash'])->name('admin');
        // resourse route
        Route::get('/membermanagement', [App\Http\Controllers\Admin\AdminController::class, 'managemeber'])->name('membermanagement');
        Route::put('/admin/members/{id}/toggle-status', [App\Http\Controllers\Admin\AdminController::class, 'toggleStatus'])->name('admin.members.toggleStatus');
        Route::get('/admin/{id}/editmember', [App\Http\Controllers\Admin\AdminController::class, 'edit'])
            ->name('admin.editmember');
        Route::put('/admin/members/{id}', [App\Http\Controllers\Admin\AdminController::class, 'update'])
            ->name('admin.member');

        Route::post('/admin/users/{user}/savings', [SavingController::class, 'storeSaving'])
    ->name('admin.users.savings.store');
    
        // multiple member creation route 
        Route::post('/admin/members/import', [App\Http\Controllers\Admin\AdminController::class, 'importMembers'])
            ->name('admin.members.import');

        // delete member 
        Route::delete('/admin/members/{id}', [App\Http\Controllers\Admin\AdminController::class, 'destroy'])
            ->name('admin.members.destroy');

        // delete member 
        Route::put('/admin/contributionsavings/{id}/approve', [App\Http\Controllers\Admin\ApproveController::class, 'approveSaving'])
            ->name('admin.contributionsavings.approve');

        // ✅ Correct — includes {loanId}
        Route::get('/contributionsavings', [App\Http\Controllers\Admin\AdminController::class, 'contribution'])->name('contributionsavings');
        Route::get('/admin/{id}/repay-loan', [App\Http\Controllers\Admin\AdminController::class, 'show'])->name('admin.repay-loan');
        Route::get('/loanManagement', [App\Http\Controllers\Admin\AdminController::class, 'loanManagement'])->name('loanManagement');
        Route::get('/accountTransaction', [App\Http\Controllers\Admin\AdminController::class, 'accountTransaction'])->name('accountTransaction');
        Route::get('/reportAnalytics', [App\Http\Controllers\Admin\AdminController::class, 'reportAnalytics'])->name('reportAnalytics');
        Route::get('/settings', [App\Http\Controllers\Admin\AdminController::class, 'settings'])->name('settings');
        Route::get('/comodity', [App\Http\Controllers\Admin\AdminController::class, 'allCommodityRequests'])->name('comodity');
        Route::get('/search-member', [App\Http\Controllers\Admin\AdminController::class, 'search'])->name('search');
       
       
        // search member savingd and approved
        Route::get('/search-member', [App\Http\Controllers\Admin\AdminController::class, 'search'])->name('search');
        Route::get('/search-loan', [App\Http\Controllers\Admin\AdminController::class, 'searchLoanReport'])->name('search.loan');
             
        // Route::get('/ledger-receipt', [App\Http\Controllers\Admin\AdminController::class, 'showLedger'])->name('ledger.receipt');
              
        Route::post('/comodity', [App\Http\Controllers\Admin\AdminController::class, 'allCommodityRequests'])->name('comodity');
        Route::post('/admin/comodity/{userId}', [App\Http\Controllers\Admin\AdminController::class, 'approveAll'])->name('admin.comodity');
        // pay commodity 
        Route::post('/admin/comodity/pay/{userId}', [App\Http\Controllers\Admin\AdminController::class, 'payCommodity'])->name('comodity.pay');
        Route::get('/commodity-report/{id}', [App\Http\Controllers\Admin\AdminController::class, 'showComReport'])->name('commodity.admin.report');
//consolidation
        Route::get('/admin/consolidation', [App\Http\Controllers\Admin\ConsolidationController::class, 'index'])->name('admin.consolidation');


        // Member side
        Route::get('/admin/{$id}/repay-loan', [App\Http\Controllers\Admin\AdminController::class, 'show'])->name('admin.repay-loan');
        
        Route::get('/admin/receipt/{id}', [App\Http\Controllers\Admin\AdminController::class, 'transactions'])->name('admin.receipt');
       
        // Route::post('/member/loan/{loan}/repay', [App\Http\Controllers\Admin\LoanRepaFymentController::class, 'store'])->name('loan.repay.store');
        Route::post('/member/loan/{userId}/repay', [App\Http\Controllers\Admin\LoanRepaymentController::class, 'finalizeCalculations'])->name('member.loan.repay');
        Route::put('/admin/loans/{id}/status', [App\Http\Controllers\Admin\LoanRepaymentController::class, 'approveOrReject'])->name('admin.loans.status');


        // Aprove member total savings
        Route::get('/admin/savings', [App\Http\Controllers\Admin\AdminController::class, 'membersSavings'])->name('admin.members.savings');
            Route::post('/admin/{id}/approve-savings', [App\Http\Controllers\Admin\AdminController::class, 'approveMemberSavings'])->name('admin.members.approveSavings');

        });

Auth::routes();
// Login
Route::get('/userlogin', [App\Http\Controllers\Auth\LoginController::class, 'userlogin'])->name('userlogin');
// member controller 
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// member loan 
Route::get('/profile', [App\Http\Controllers\Member\MemberSavingsController::class, 'profile'])->name('profile');
Route::get('/memberloan', [App\Http\Controllers\LoanController::class, 'memberloan'])->name('memberloan');
// savving
// Route::get('/membersavings', [App\Http\Controllers\Member\MemberSavingsController::class, 'savings'])->name('membersavings');
       Route::post('/membersavings', [App\Http\Controllers\Member\MemberSavingsController::class, 'savings'])->name('membersavings');
        Route::get('/membercontributions', [App\Http\Controllers\Member\MemberSavingsController::class, 'contribution'])->name('membercontributions');
        Route::get('/member/{id}/memberupdate', [App\Http\Controllers\Member\MemberSavingsController::class, 'memberedit'])->name('member.memberedit');
        Route::put('/member/{id}/memberupdate', [App\Http\Controllers\Member\MemberSavingsController::class, 'memberupdate'])->name('member.memberupdate');
        // Route::get('/member/{user}/savings', [MemberSavingsController::class, 'memberSavings'])->name('member.showsavings');
        // Route::post('/member/{user}/savings', [App\Http\Controllers\Member\MemberSavingsController::class, 'storesaving'])->name('member.savings');

        // loan request
        Route::post('/member/loan', [MemberLoanController::class, 'requestLoan'])->name('member.loan');

        // commdity request 
        Route::get('/commodity_request', [App\Http\Controllers\Member\CommodityRequestController::class, 'commodity'])->name('commodity_request');
        Route::post('/member/commodity_request', [App\Http\Controllers\Member\CommodityRequestController::class, 'requestCommodity'])->name('member.commodity_request');

        // Route::get('/memberdashboard', [App\Http\Controllers\HomeController::class, 'memberdashboard'])->name('memberdashboard');
        Route::get('/memberdashboard/{user}', [App\Http\Controllers\HomeController::class, 'memberdashboard'])->name('memberdashboard');
          Route::get('/member/{user}/savings', [MemberSavingsController::class, 'memberSavings'])->name('member.showsavings');
        // Route::post('/member/{user}/savings', [App\Http\Controllers\Member\MemberSavingsController::class, 'storesaving'])->name('member.savings');
