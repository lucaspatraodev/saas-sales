<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * CUSTOMER -> Get ALL (Tenant filtered)
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'code' => 200,
            'data' => Customer::withCount('sales')
                ->orderBy('created_at', 'desc')
                ->paginate(20)
        ]);
    }

    /**
     * CUSTOMER -> Create
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:customers,email',
            'phone' => 'nullable|string|max:20',
        ]);

        $customer = Customer::create($validated + [
            'tenant_id' => auth()->user()->tenant_id
        ]);

        return response()->json([
            'success' => true,
            'code' => 201,
            'data' => $customer
        ], 201);
    }

    /**
     * CUSTOMER -> Get ESPECIFIC
     */
    public function show(Customer $customer)
    {
        return response()->json([
            'success' => true,
            'code' => 200,
            'data' => $customer->loadCount('sales')
        ]);
    }

    /**
     * CUSTOMER -> Update
     */
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|nullable|email|unique:customers,email,' . $customer->id,
            'phone' => 'sometimes|nullable|string|max:20',
        ]);

        $customer->update($validated);

        return response()->json([
            'success' => true,
            'code' => 200,
            'data' => $customer->loadCount('sales')
        ]);
    }

    /**
     * CUSTOMER -> Delete
     */
    public function destroy(Customer $customer)
    {
        if ($customer->sales()->count() > 0) {
            return response()->json([
                'success' => false,
                'code' => 422,
                'message' => 'Cliente tem vendas associadas'
            ], 422);
        }

        $customer->delete();

        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'Cliente deletado.'
        ]);
    }
}
