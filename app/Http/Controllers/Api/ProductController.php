<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return Product::with('tenant')
            ->paginate(20);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $validated['tenant_id'] = auth()->user()->tenant_id;

        $product = Product::create($validated);

        return response()->json($product, 201);
    }

    public function show(Product $product)
    {
        if ($product->tenant_id !== auth()->user()->tenant_id) {
            abort(403);
        }
        return $product;
    }

    public function update(Request $request, Product $product)
    {
        if ($product->tenant_id !== auth()->user()->tenant_id) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'string|max:255',
            'description' => 'nullable|string',
            'price' => 'numeric|min:0',
            'stock' => 'integer|min:0',
        ]);

        $product->update($validated);
        return $product;
    }

    public function destroy(Product $product)
    {
        if ($product->tenant_id !== auth()->user()->tenant_id) {
            abort(403);
        }
        $product->delete();
        return response()->json(['message' => 'Produto deletado.']);
    }
}
