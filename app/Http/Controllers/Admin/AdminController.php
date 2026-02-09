<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
   /**
     * Show the admin dashboard
     */
    public function dashboard()
    {
        // You can pass stats or counts if needed
        // e.g. $totalProducts = Product::count();
        return view('admin.login');
    }

    /**
     * Show the admin settings page
     */
    public function settings()
    {
        return view('admin.settings');
    }

    /**
     * Show the admin profile page (optional)
     */
    public function profile()
    {
        return view('admin.profile');
    }

    /**
     * Update admin profile (optional)
     */
    public function updateProfile(Request $request)
    {
        // Example: update authenticated admin info
        /** @var Admin $admin */
        $admin = auth()->guard('admin')->user();

        $admin->name = $request->name;
        $admin->email = $request->email;
        // Add password update if needed
        $admin->save();

        return redirect()->route('admin.dashboard')->with('success', 'Profile updated successfully.');
    }
}
