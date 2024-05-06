<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transactions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    /**
     * dashboard home index
     */
    public function index()
    {

        $allTrans = Transactions::with('user')->paginate(5);
        return view('dashboard.home', compact('allTrans'));
    }

    //deposite trans
    public function depositeTrans()
    {
        $deposites = Transactions::where('transaction_type', 'deposit')->paginate(5);
        return view('dashboard.deposite', compact('deposites'));
    }

    //withdrawl trans
    public function withdrawlTrans()
    {
        $withdrawls = Transactions::where('transaction_type', 'withdrawal')->paginate(5);
        return view('dashboard.withdrawl', compact('withdrawls'));
    }

    //deposite trans index
    public function depositeAmountIndex()
    {
        return view('dashboard.deposite_amount');
    }

    //withdrawl trans index
    public function withdrawlAmountIndex()
    {
        return view('dashboard.withdrawl_amount');
    }


    /**
     * user signup
     */
    public function signup()
    {
        return view('dashboard.user');
    }

    /**
     * create new user
     */
    public function createUser(Request $request)
    {
        //validation for create new user
        $request->validate([
            'name' => 'required|min:3',
            'account_type' => 'required',
            'balance' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $newUser = new User();
        $newUser->name = $request->name;
        $newUser->account_type = $request->account_type;
        $newUser->balance = $request->balance;
        $newUser->email = $request->email;
        $newUser->password = Hash::make($request->password);
        $newUser->save();

        if ($newUser) {
            return redirect()->back()->with('success', 'Successfully create user!');
        }
    }


    /**
     * deposite amount
     */
    public function depositeAmount(Request $request)
    {
        //validation
        $request->validate([
            'deposite_amount' => 'required'
        ]);

        $deposite = new Transactions();
        $deposite->user_id = auth()->user()->id;
        $deposite->transaction_type = 'deposit';
        $deposite->amount = $request->deposite_amount ?? 0;
        $deposite->fee = 0;
        $deposite->date = Carbon::now();
        $deposite->save();

        if ($deposite) {
            $userAddBalance = User::find(auth()->user()->id);
            $userAddBalance->balance =  $userAddBalance->balance + $request->deposite_amount;
            $userAddBalance->save();
            return redirect()->back()->with('success', 'Successfully deposite amount!');
        }
    }


    /**
     * withdrawl amount
     */
    public function withdrawlAmount(Request $request)
    {
        // Validation
        $request->validate([
            'withdrawl_amount' => 'required'
        ]);

        $currentDate = Carbon::now();

        // Track total withdrawal this month
        $totalWithdrawalThisMonth = Transactions::where('user_id', auth()->user()->id)
            ->where('transaction_type', 'withdrawal')
            ->whereYear('date', $currentDate->year)
            ->whereMonth('date', $currentDate->month)
            ->sum('amount');

        $withdrawal = new Transactions();
        $withdrawal->user_id = auth()->user()->id;
        $withdrawal->transaction_type = 'withdrawal';
        $withdrawal->amount = $request->withdrawl_amount ?? 0;

        // Check if it's Friday (free withdrawal)
        if ($currentDate->isFriday()) {
            $withdrawal->fee = 0;
        } else {
            // Check if it's the first $1,000 withdrawal or subsequent $4,000 withdrawal
            if ($totalWithdrawalThisMonth <= 1000) {
                $withdrawal->fee = 0; // First $1,000 withdrawal is free
            } elseif ($totalWithdrawalThisMonth <= 5000) {
                // Subsequent $4,000 withdrawal is free
                if ($withdrawal->amount <= 4000) {
                    $withdrawal->fee = 0;
                } else {
                    // Apply fee for the remaining amount
                    $remainingAmount = $withdrawal->amount - 4000;
                    if (auth()->user()->individual) {
                        $withdrawal->fee = $remainingAmount * 0.015;
                    } elseif (auth()->user()->business) {
                        $withdrawal->fee = $remainingAmount * 0.025;
                    }
                }
            } else {
                // Apply fee for the entire withdrawal amount
                if (auth()->user()->individual) {
                    $withdrawal->fee = $withdrawal->amount * 0.015;
                } elseif (auth()->user()->business) {
                    $withdrawal->fee = $withdrawal->amount * 0.025;
                }
            }
        }

        $withdrawal->date = $currentDate;
        $withdrawal->save();

        if ($withdrawal) {
            // Update user balance
            $user = User::find(auth()->user()->id);
            $user->balance -= $withdrawal->amount;
            $user->save();

            return redirect()->back()->with('success', 'Successfully withdrew amount!');
        }
    }
}
