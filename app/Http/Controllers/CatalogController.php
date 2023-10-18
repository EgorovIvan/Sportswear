<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Queries\CartsQueryBuilder;
use App\Queries\ProductsQueryBuilder;
use App\Queries\QueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class CatalogController extends Controller
{
    protected QueryBuilder $productsQueryBuilder;
    protected QueryBuilder $cartsQueryBuilder;

    public function __construct(
        ProductsQueryBuilder $productsQueryBuilder,
        CartsQueryBuilder $cartsQueryBuilder,
    ) {
        $this->productsQueryBuilder = $productsQueryBuilder;
        $this->cartsQueryBuilder = $cartsQueryBuilder;
    }

    public function index(): View
    {
        $productsCart = $this->cartsQueryBuilder->getAll();
        $products = $this->productsQueryBuilder->getAll();

        return view('catalog.index', ['products' => $products, 'productsCart' => $productsCart] );
    }

    public function showFilter(Request $request): View
    {
        $productsCart = $this->cartsQueryBuilder->getAll();

        $checked = $request->all();

        if (count($checked) > 1) {
            $products = $this->productsQueryBuilder->filterProduct($checked);

            return view('catalog.index', ['products' => $products, 'checked' => $checked, 'productsCart' => $productsCart ]);
        }

        return $this->index();
    }

    public function showSearch(Request $request): View
    {
        $search = $request->search;

        $productsCart = $this->cartsQueryBuilder->getAll();
        $products = $this->productsQueryBuilder->searchProduct($search);

        return view('catalog.index', ['products' => $products, 'search' => $search, 'productsCart' => $productsCart]);
    }
}
