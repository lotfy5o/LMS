<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\UpdateAdminProfileReq;
use App\Http\Requests\UpdateAdminPasswordReq;
use Symfony\Component\HttpFoundation\RedirectResponse;


class AdminController extends Controller
{
    public function AdminDashboard()
    {
        return view('admin.index');
    }

    public function AdminLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function AdminLogin()
    {
        return view('admin.admin-login');
    }

    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin-profile', get_defined_vars());
    }



    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $admin = User::find($id);

        $admin->name = $request->name;
        $admin->username = $request->username;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->address = $request->address;

        if ($request->hasFile('photo')) {

            // delete old photo
            $admin->clearMediaCollection('admins');

            $admin->addMediaFromRequest('photo')
                ->usingFileName(time() . '.' . $request->file('photo')->getClientOriginalExtension())
                ->toMediaCollection('admins');
        }



        $admin->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function AdminChangePassword()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view('admin.admin-change-password', get_defined_vars());
    }

    public function AdminPasswordUpdate(UpdateAdminPasswordReq $request)
    {
        $data = $request->validated();
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            $notification = array(
                'message' => 'Old Password Does not Match!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => 'Password Changed Successfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
