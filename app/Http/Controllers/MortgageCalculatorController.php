<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class MortgageCalculatorController extends Controller
{
    public function mortgageCalculate(Request $request)
    {
        $request->validate([
            'total_amount' => 'required|numeric|min:0',
            'down_payment' => 'required|numeric|min:0',
            'interest_rate' => 'required|numeric|min:0',
            'loan' => 'required|numeric|min:1',
            'payment_frequency' => 'required|in:monthly,yearly',
            'property_id' => 'required|integer|exists:properties,id',
        ]);

        $totalAmount = $request->input('total_amount');
        $downPayment = $request->input('down_payment');
        $interestRate = $request->input('interest_rate');
        $loanYears = $request->input('loan');
        $paymentFrequency = $request->input('payment_frequency');
        $propertyId = $request->input('property_id');

        // Calculate principal loan amount
        $principal = $totalAmount - $downPayment;

        // Convert annual interest rate percentage to decimal
        $annualInterestRate = $interestRate / 100;

        // Determine number of payments and periodic interest rate
        if ($paymentFrequency === 'monthly') {
            $numberOfPayments = $loanYears * 12;
            $periodicInterestRate = $annualInterestRate / 12;
        } else { // yearly
            $numberOfPayments = $loanYears;
            $periodicInterestRate = $annualInterestRate;
        }

        // Calculate mortgage payment using formula:
        // M = P * r * (1 + r)^n / ((1 + r)^n - 1)
        if ($periodicInterestRate > 0) {
            $mortgagePayment = $principal * $periodicInterestRate * pow(1 + $periodicInterestRate, $numberOfPayments) / (pow(1 + $periodicInterestRate, $numberOfPayments) - 1);
        } else {
            // If interest rate is 0, simple division
            $mortgagePayment = $principal / $numberOfPayments;
        }

        // Find the property to pass back to view
        $property = Property::findOrFail($propertyId);

        // Pass mortgage result to the view
        return redirect()->route('property.details', ['id' => $property->id, 'slug' => $property->property_slug])
            ->with('mortgage_result', [
                'payment' => round($mortgagePayment, 2),
                'payment_frequency' => $paymentFrequency,
                'principal' => $principal,
                'interest_rate' => $interestRate,
                'loan_years' => $loanYears,
            ]);
    }
}
