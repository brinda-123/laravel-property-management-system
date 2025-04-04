<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Schedule;

class UserController extends Controller
{
    public function Index(){
        return view('frontend.index');
    } // End Method 


    public function UserProfile(){

        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('frontend.dashboard.edit_profile',compact('userData'));

    } // End Method 


    public function UserProfileStore(Request $request){
        // Add validation rules
        $request->validate([
            'username' => ['required', 'string', 'regex:/^[a-zA-Z0-9_]{3,20}$/', 'unique:users,username,' . Auth::id()],
            'name' => ['required', 'string', 'regex:/^[a-zA-Z ]{2,50}$/'],
            'email' => ['required', 'email', 'regex:/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/', 'unique:users,email,' . Auth::id()],
            'phone' => ['required', 'regex:/^[0-9]{10,15}$/'],
            'address' => ['required', 'regex:/^[a-zA-Z0-9\s,.-]{5,100}$/'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
        ], [
            // Custom error messages
            'username.regex' => 'Username must be 3-20 characters long and can only contain letters, numbers, and underscores',
            'name.regex' => 'Name must be 2-50 characters long and can only contain letters and spaces',
            'email.regex' => 'Please enter a valid email address',
            'phone.regex' => 'Phone number must be 10-15 digits long',
            'address.regex' => 'Address must be 5-100 characters long and can contain letters, numbers, spaces, and basic punctuation'
        ]);

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address; 

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName(); 
            $file->move(public_path('upload/user_images'),$filename);
            $data['photo'] = $filename;  
        }

        $data->save();

        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method 


  public function UserLogout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

         $notification = array(
            'message' => 'User Logout Successfully',
            'alert-type' => 'success'
        ); 
        return redirect('/login')->with($notification);
    }// End Method 


    public function UserChangePassword(){

        return view('frontend.dashboard.change_password');

    }// End Method 


    public function UserPasswordUpdate(Request $request){

        // Validation 
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'

        ]);

        /// Match The Old Password

        if (!Hash::check($request->old_password, auth::user()->password)) {

           $notification = array(
            'message' => 'Old Password Does not Match!',
            'alert-type' => 'error'
        );

        return back()->with($notification);
        }

        /// Update The New Password 

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)

        ]);

         $notification = array(
            'message' => 'Password Change Successfully',
            'alert-type' => 'success'
        );

        return back()->with($notification); 

     }// End Method 


       public function UserScheduleRequest(){

        $id = Auth::user()->id;
        $userData = User::find($id);

        $srequest = Schedule::where('user_id',$id)->get();
        return view('frontend.message.schedule_request',compact('userData','srequest'));

    } // End Method 


     public function LiveChat(){

        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('frontend.dashboard.live_chat',compact('userData'));

    } // End Method 


}
