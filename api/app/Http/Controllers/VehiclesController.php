<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehiclesController extends Controller
{
    public function list() {
        return response()->json(Vehicle::all());
    }

    public function loanOptions(Request $request, $id) {
        if(!$request->initialPayment)
            return response()->json(['error' => 'The initialPayment param is required', 400]);

        $vehicle = Vehicle::findOrFail($id);

        return response()->json([
            [
                'installments' => 48,
                'amount' => floor(($vehicle->amount - $request->initialPayment) / 48)
            ],
            [
                'installments' => 12,
                'amount' => floor(($vehicle->amount - $request->initialPayment) / 12)
            ],
            [
                'installments' => 6,
                'amount' => floor(($vehicle->amount - $request->initialPayment) / 6)
            ],
        ]);
    }
}
