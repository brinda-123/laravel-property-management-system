<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Property;
use App\Mail\PropertySubmissionMail;

class SellerController extends Controller
{
    public function showRegistrationForm()
    {
        return view('frontend.seller.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'seller'; // store role as 'seller' lowercase as per your request
        $user->save();

        return redirect()->route('seller.login')->with('success', 'Registration successful. Please login.');
    }

    public function showLoginForm()
    {
        return view('frontend.seller.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'seller') {
                $request->session()->regenerate();
                // Redirect explicitly to seller dashboard after login
                return redirect()->route('seller.dashboard');
            }
            Auth::logout();
            return back()->withErrors([
                'email' => 'You are not authorized as a seller.',
            ]);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function dashboard()
    {
        $agents = User::where('role', 'agent')->get();
        return view('frontend.seller.dashboard', compact('agents'));
    }

    public function submitProperty(Request $request)
    {
        $request->validate([
            'property_title' => 'required|string|max:255',
            'property_description' => 'required|string',
            'property_price' => 'required|numeric',
            'agent_id' => 'required|exists:users,id',
        ]);

        $property = new Property();
        $property->title = $request->property_title;
        $property->description = $request->property_description;
        $property->price = $request->property_price;
        $property->seller_id = Auth::id();
        $property->save();

        // Send email to selected agent
        $agent = User::find($request->agent_id);
        $sellerName = Auth::user()->name;
        $propertyData = $request->only('property_title', 'property_description', 'property_price');

        Mail::to($agent->email)->send(new PropertySubmissionMail($propertyData, $sellerName));

        return redirect()->route('seller.dashboard')->with('success', 'Property details submitted successfully and email sent to the agent.');
    }
}
