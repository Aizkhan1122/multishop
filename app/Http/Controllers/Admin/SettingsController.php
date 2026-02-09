<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    // public function index()
    // {
    //     $settings = Setting::pluck('value', 'key')->toArray();
    //     return view('admin.settings.index', compact('settings'));
    // }

    // public function update(Request $request)
    // {
    //     $request->validate([
    //         'site_name' => 'required|string',
    //         'admin_email' => 'required|email',
    //         'logo' => 'nullable|image'
    //     ]);

    //     // Update logo if uploaded
    //     if ($request->hasFile('logo')) {
    //         $file = $request->file('logo');
    //         $fileName = 'logo.' . $file->getClientOriginalExtension();
    //         $file->move(public_path('uploads'), $fileName);

    //         Setting::updateOrCreate(['key' => 'logo'], ['value' => $fileName]);
    //     }

    //     // Update other settings
    //     Setting::updateOrCreate(['key' => 'site_name'], ['value' => $request->site_name]);
    //     Setting::updateOrCreate(['key' => 'admin_email'], ['value' => $request->admin_email]);

    //     return redirect()->back()->with('success', 'Settings updated successfully!');
    // }

   // Show Profile Page
    public function profile()
    {
        $settings = [
            'site_name' => config('app.name'),
            'admin_email' => Auth::guard('admin')->user()->email,
            'logo' => 'logo.png' // example, replace with DB if needed
        ];

        $admin = Auth::guard('admin')->user();

        return view('admin.settings.profile', compact('settings', 'admin'));
    }
    
    public function settings()
    {
    return view('admin.settings.index'); // create this Blade for Security, Privacy, Notifications etc.
    } 
    // Update Site Settings
    public function updateSiteSettings(Request $request)
    {
        // handle site_name, admin_email, logo upload
        // example: save to DB or config
        return back()->with('success', 'Site settings updated.');
    }

    // Update Admin Profile
    public function updateProfile(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $admin->update($request->only('name','email'));
        return back()->with('success', 'Profile updated.');
    }

    // Update Password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $admin = Auth::guard('admin')->user();

        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $admin->update(['password' => Hash::make($request->password)]);
        return back()->with('success', 'Password updated.');
    }

    // Delete Admin Account
    public function destroy()
    {
        $admin = Auth::guard('admin')->user();
        Auth::guard('admin')->logout();
        $admin->delete();
        return redirect('/')->with('success','Admin account deleted.');
    }
}   
