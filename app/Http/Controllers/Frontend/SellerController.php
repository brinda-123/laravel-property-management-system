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

        $property->property_name = $request->property_title;

        $property->short_descp = $request->property_description;

        $property->lowest_price = $request->property_price;

        // Set required columns with default or dummy values to avoid DB errors
        $property->ptype_id = 'default_ptype'; // Set a default or get from request if available
        $property->amenities_id = 'default_amenities'; // Set a default or get from request if available
        $property->property_slug = \Str::slug($request->property_title);
        $property->property_code = 'CODE' . rand(1000, 9999);
        $property->property_status = 'available';
        $property->property_thambnail = 'default_thumbnail.jpg';

        $property->agent_id = $request->agent_id;

        $property->save();



        // Send email to selected agent

        $agent = User::find($request->agent_id);

        $sellerName = Auth::user()->name;

        $propertyData = $request->only('property_title', 'property_description', 'property_price');



        \Log::info('Before sending mail to agent: ' . $agent->email);
        try {
            // Commenting out from() override to use default MAIL_FROM_ADDRESS
            Mail::to($agent->email)->send(new PropertySubmissionMail($propertyData, $sellerName));
            // Mail::to($agent->email)->send((new PropertySubmissionMail($propertyData, $sellerName))
            //     ->from(Auth::user()->email, Auth::user()->name));
            \Log::info('Mail sent successfully to agent: ' . $agent->email);
        } catch (\Exception $e) {
            \Log::error('Mail sending failed: ' . $e->getMessage());
        }
        \Log::info('After mail sending attempt to agent: ' . $agent->email);



        return redirect()->route('seller.dashboard')->with('success', 'Property details submitted successfully and email sent to the agent.');

    }
    // public function submitProperty(Request $request)
    // {
    //     $request->validate([
    //         'property_title' => 'required|string|max:255',
    //         'property_description' => 'required|string',
    //         'property_price' => 'required|numeric',
    //         'agent_id' => 'required|exists:users,id',
    //     ]);
    
    //     // Get the selected agent
    //     $agent = User::where('role', 'agent')->findOrFail($request->agent_id);
    
    //     // Wrap property data in an array
    //     $propertyData = [
    //         'property_title' => $request->property_title,
    //         'property_description' => $request->property_description,
    //         'property_price' => $request->property_price,
    //     ];
    
    //     $sellerName = Auth::user()->name;
    
    //     // Send mail to agent
    //     Mail::to($agent->email)->send(new PropertySubmissionMail($propertyData, $sellerName));
    
    //     return redirect()->back()->with('success', 'Property submitted and email sent to agent!');
    // }
    

}
