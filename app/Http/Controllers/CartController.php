<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cart\Store;
use App\Http\Requests\Cart\Update;
use App\Models\Cart;
use App\Queries\CartsQueryBuilder;
use App\Queries\ProductsQueryBuilder;
use App\Queries\QueryBuilder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Throwable;

class CartController extends Controller
{
    protected QueryBuilder $cartsQueryBuilder;
    protected QueryBuilder $productsQueryBuilder;

    public function __construct(
        CartsQueryBuilder    $cartsQueryBuilder,
        ProductsQueryBuilder $productsQueryBuilder,
    )
    {
        $this->cartsQueryBuilder = $cartsQueryBuilder;
        $this->productsQueryBuilder = $productsQueryBuilder;
    }

    public function index(): View
    {
        $resource = $this->cartsQueryBuilder->getProducts();

        $count = $resource->sum('quantity');

        $plural = ['product' => '{0} товаров
                |{1} :count товар
                |[2,4] :count товара
                |[5,20] :count товаров
                |{21} :count товар
                |[22,24] :count товара
                |[25,*] :count товаров'];

        $singular = trans_choice($plural['product'], $count);

        $total = 0;
        foreach ($resource as $product) {
            $total = $total + ($product->price * $product->quantity);
        }

        return view('cart.index', [
            'resource' => $resource,
            'count' => $count,
            'total' => $total,
            'singular' => $singular
        ]);
    }

    public function add(Store $request): RedirectResponse
    {
        $resource = $this->cartsQueryBuilder->getAll();
        $data = $request->validated();

        if (empty($resource->contains('product_id', $data['product_id']))) {
            $cart = Cart::create($request->validated());
        }
        return back()->with('error', __('Resource has not been created'));
    }

    public function addQuantity(Update $request, Cart $cart)
    {
        $cart = $cart->fill($request->validated());
        $product_id = $cart->product_id;
        $product = $cart->where('product_id', $product_id)->first();

        if (isset($product)) {
            $product->quantity = $product->quantity + 1;;
            $product->save();
        }

        return redirect()->route('cart.index');
    }

    public function reduceQuantity(Update $request, Cart $cart): RedirectResponse
    {
        $cart = $cart->fill($request->validated());
        $product_id = $cart->product_id;
        $product = $cart->where('product_id', $product_id)->first();

        if (isset($product)) {
            $product->quantity = $product->quantity - 1;;
            $product->save();
        }
        return redirect()->route('cart.index');
    }

    public function destroy(string $id, Cart $cart): RedirectResponse | JsonResponse
    {

        $product = $cart->where('product_id', $id)->first();
        try {
            $product->delete();


            return redirect()->route('catalog.index');
        } catch (Throwable $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());

            return response()->json('error', 400);
        }
    }
}
