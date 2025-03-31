<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    // ... (existing code)

    public function priceFilter(Request $request)
    {
        $min_price = $request->min_price;
        $max_price = $request->max_price;

        // Get filtered properties
        $property = Property::where('status', 1)
            ->where('property_status', 'buy')
            ->when($min_price, function($query) use ($min_price) {
                return $query->where('lowest_price', '>=', $min_price);
            })
            ->when($max_price, function($query) use ($max_price) {
                return $query->where('lowest_price', '<=', $max_price);
            })
            ->paginate(10);

        // Get total buy properties for counter
        $buyproperty = Property::where('property_status', 'buy')->get();

        // Add price range to session for displaying in view
        session()->flash('min_price', $min_price);
        session()->flash('max_price', $max_price);

        return view('frontend.property.buy_property', compact('property', 'buyproperty'));
    }
} 