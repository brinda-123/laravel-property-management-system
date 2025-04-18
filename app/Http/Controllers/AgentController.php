<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class AgentController extends Controller
{
    // Agent Dashboard
    public function AgentDashboard() {
        return view('agent.index');
    }

    // Show Login Form
    public function AgentLogin() {
        return view('agent.agent_login');
    }

    // Agent Registration Logic
    public function AgentRegister(Request $request) {
        // You can add validation here if needed

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'agent',
            'status' => 'inactive',
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect(RouteServiceProvider::AGENT); // Adjust constant if needed
    }

    // Agent Logout
    public function AgentLogout(Request $request) {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $notification = [
            'message' => 'Agent Logout Successfully',
            'alert-type' => 'success'
        ];

        return redirect('/agent/login')->with($notification);
    }

    // Agent Profile View
    public function AgentProfile() {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('agent.agent_profile_view', compact('profileData'));
    }

    // Agent Profile Update
    public function AgentProfileStore(Request $request) {
        $id = Auth::user()->id;
        $data = User::find($id);

        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/agent_images/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/agent_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = [
            'message' => 'Agent Profile Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    // Show Change Password Page
    public function AgentChangePassword() {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('agent.agent_change_password', compact('profileData'));
    }

    // Handle Password Update
    public function AgentUpdatePassword(Request $request) {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return back()->with([
                'message' => 'Old Password Does not Match!',
                'alert-type' => 'error'
            ]);
        }

        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with([
            'message' => 'Password Changed Successfully',
            'alert-type' => 'success'
        ]);
    }
}
