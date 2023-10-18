<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\Store;
use App\Http\Requests\Product\Update;
use App\Models\Product;
use App\Queries\ProductsQueryBuilder;
use App\Queries\QueryBuilder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CatalogController extends Controller
{
    protected QueryBuilder $productsQueryBuilder;

    public function __construct(
        ProductsQueryBuilder $productsQueryBuilder
    ) {
        $this->productsQueryBuilder = $productsQueryBuilder;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.catalog.index', [
            'products' => $this->productsQueryBuilder->getAll(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.catalog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request): RedirectResponse
    {
//        dd($request);
        $catalog = Product::create($request->validated());
        if ($catalog) {
            return redirect()->route('admin.catalog.index')->with('success', __('Product has been created'));
        }

        return back()->with('error', __('Product has not been created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $product = Product::find($id);
//        dd($product);
        return view('admin.catalog.edit', [
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request, string $id): RedirectResponse
    {
        $product = Product::find($id);
        $product = $product->fill($request->validated());
        if ($product->save()) {
            return redirect()->route('admin.catalog.index')->with('success', __('Product has been updated'));
        }

        return back()->with('error', __('Product has not been updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {

        $product = Product::find($id);

        try {
            $product->delete();

            return  response()->json('ok');
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());

            return  response()->json('error', 400);
        }
    }
}
