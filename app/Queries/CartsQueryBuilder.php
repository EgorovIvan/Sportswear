<?php

namespace App\Queries;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CartsQueryBuilder extends QueryBuilder
{
    public function getModel(): Builder
    {
        return Cart::query();
    }

    public function getAll(): Collection
    {
        return $this->getModel()->get();
    }

    public function getProducts(): Collection
    {
        return $this->getModel()->join('products', 'products.id', '=', 'carts.product_id')->get();
    }
}
