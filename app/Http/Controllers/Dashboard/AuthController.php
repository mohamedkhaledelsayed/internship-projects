<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Mail\UserResetPasswordMail;
use App\Models\Admin;
use App\Models\Scopes\TenantScope;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function loginForm()
    {
        if (Auth::guard('admins')->user()) {
            return redirect()->route('index');
        }
        return view('dashboard.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => ['required', 'email', Rule::exists('admins', 'email')],
            'password' => ['required'],
        ]);
        $admin = Admin::where('email', $request['email'])->first();
        if (!$admin) {
            return redirect()->back()->withInput()->with(['error' => 'Invalid Email Or Password!']);
        }

        if (Auth::guard('admins')->attempt($request->only(['email', 'password']))) {
            $request->session()->regenerate();
            return redirect()->intended(route('index'));
        }

        return redirect()->back()->withErrors(['error' => 'Invalid Email Or Password!']);
    }

    public function getResetPassword()
    {
        return view('dashboard.auth.reset-password');
    }

    public function postResetPassword(Request $request)
    {
        $admin = Admin::where('email', $request['email'])->first();

        if (!$admin) {
            return redirect()->back()->with(['error' => 'Email Not Found']);
        }

        if ($admin->status != 'active') {
            return redirect()->back()->with(['error' => 'Your Account is Not Active']);
        }

        DB::table('password_reset_tokens')->where('email', '=', $request['email'])->delete();

        $adminName = $admin->first_name . ' ' . $admin->last_name;
        $resetCode = rand(11111111, 99999999);
        $resetLink = url('super_admin_dashboard/check-reset-password?code=' . $resetCode);

        DB::table('password_reset_tokens')->insert([
            'email'           => $request['email'],
            'token'           => $resetCode,
            'created_at'      => date('Y-m-d h:i:s'),
            'expiration_date' => date("Y-m-d h:i:s", strtotime('+8 hours')),
        ]);

        // Mail::to($request['email'])->send(new UserResetPasswordMail($adminName, $resetLink));

        return redirect()->back()->with(['success' => 'Reset Link Sent To Your Email']);
    }

    public function checkResetCode(Request $request)
    {
        $checkResetCode = DB::table('password_reset_tokens')->where('token', $request['code'])->first();

        if (!$checkResetCode) {
            return view('dashboard.auth.reset-password')->with(['error' => 'Reset Code is Invalid']);
        }

        // Check Reset Code Expiration
        $currentDate = Carbon::parse(date('Y-m-d h:i:s'));
        $expirationDate = Carbon::parse($checkResetCode->expiration_date);
        $diff = $currentDate->diffInHours($expirationDate);

        if ($diff >= 8) {
            return view('dashboard.auth.reset-password')->with(['error' => 'Reset Code is Expired']);
        }

        return view('dashboard.auth.new-password')->with(['code' => $checkResetCode->token]);
    }

    public function changePassword(Request $request)
    {
        $checkCode = DB::table('password_reset_tokens')->where('token', $request['code'])->first();
        $admin = User::where('email', $checkCode->email)->first();

        // Check New Password and Confirm Password
        if ($request['new_password'] != $request['confirm_password']) {
            return redirect()->back()->with(['error' => 'New Password Does Not Match Confirm Password']);
        }

        $admin->update(['password' => Hash::make($request['new_password'])]);

        return redirect()->route('postLogin');
    }

    public function logout()
    {
        Auth::guard('admins')->logout();
        return redirect()->route('login');
    }
}
