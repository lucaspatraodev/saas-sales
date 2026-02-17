<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * SALE -> Get ALL  (Tenant filtered)
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'code' => 200,
            'data' => Sale::with('customer')
                ->orderBy('created_at', 'desc')
                ->paginate(20)
        ]);
    }

    /**
     * SALE -> Create
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $sale = DB::transaction(function () use ($validated) {
            $total = 0;
            $saleProducts = [];

            foreach ($validated['products'] as $item) {
                $product = Product::findOrFail($item['product_id']);

                if ($product->stock < $item['quantity']) {
                    abort(422, "Estoque insuficiente: {$product->name}");
                }

                $subtotal = $product->price * $item['quantity'];
                $total += $subtotal;

                $saleProducts[] = [
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'subtotal' => $subtotal,
                ];

                $product->decrement('stock', $item['quantity']);
            }

            return Sale::create([
                'tenant_id' => auth()->user()->tenant_id,
                'customer_id' => $validated['customer_id'],
                'items' => $saleProducts,
                'total' => $total,
            ]);
        });

        return response()->json([
            'success' => true,
            'code' => 201,
            'data' => $sale->load('customer')
        ], 201);
    }

    /**
     * SALE -> Get ESPECIFIC
     */
    public function show(Sale $sale)
    {
        return response()->json([
            'success' => true,
            'code' => 200,
            'data' => $sale->load('customer')
        ]);
    }

    /**
     * SALE -> Update
     */
    public function update(Request $request, Sale $sale)
    {
        $validated = $request->validate([
            'status' => 'sometimes|in:pendente,paga,cancelada',
            'discount' => 'sometimes|numeric|min:0|max:100',
        ]);

        $sale->update($validated);

        return response()->json([
            'success' => true,
            'code' => 200,
            'data' => $sale->fresh()->load(['customer'])
        ]);
    }

    /**
     * SALE -> Delete
     */
    public function destroy(Sale $sale)
    {
        DB::transaction(function () use ($sale) {
            foreach ($sale->items ?? [] as $item) {
                $product = Product::find($item['product_id']);
                if ($product) {
                    $product->increment('stock', $item['quantity']);
                }
            }

            $sale->delete();
        });

        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'Venda cancelada e estoque restaurado.'
        ]);
    }
}
