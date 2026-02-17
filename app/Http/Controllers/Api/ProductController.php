<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * PRODUCT -> Get ALL  (Tenant filtered)
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'code' => 200,
            'data' => Product::with('tenant')
                ->paginate(20)
        ]);
    }

    /**
     * PRODUCT -> Create
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $product = Product::create($validated + [
            'tenant_id' => auth()->user()->tenant_id
        ]);

        return response()->json([
            'success' => true,
            'code' => 201,
            'data' => $product
        ], 201);
    }

    /**
     * PRODUCT -> Get ESPECIFIC
     */
    public function show(Product $product)
    {
        return response()->json([
            'success' => true,
            'code' => 200,
            'data' => $product
        ]);
    }

    /**
     * PRODUCT -> Update
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|nullable|string',
            'price' => 'sometimes|numeric|min:0',
            'stock' => 'sometimes|integer|min:0',
        ]);

        $product->update($validated);

        return response()->json([
            'success' => true,
            'code' => 200,
            'data' => $product
        ]);
    }

    /**
     * PRODUCT -> Delete
     */
    public function destroy(Product $product)
    {
        if ($product->tenant_id !== auth()->user()->tenant_id) {
            return response()->json([
                'success' => false,
                'code' => 403,
                'message' => 'Produto não pertence ao seu tenant'
            ], 403);
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'Produto deletado.'
        ]);
    }
}
