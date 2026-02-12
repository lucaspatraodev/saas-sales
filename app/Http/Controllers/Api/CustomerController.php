<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return Customer::where('tenant_id', auth()->user()->tenant_id)
            ->paginate(20);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
        ]);

        $validated['tenant_id'] = auth()->user()->tenant_id;
        $customer = Customer::create($validated);

        return response()->json($customer, 201);
    }

    // show/update/destroy = igual ProductController
}
