<?php

namespace App\Queries;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductsQueryBuilder extends QueryBuilder
{
    public function getModel(): Builder
    {
        return Product::query();
    }

    public function getAll(): Collection
    {
        return $this->getModel()->get();
    }

    public function filterProduct(array $checked): Collection
    {
        return $this->getModel()->orderBy('price')->whereIn('chapter', array_values($checked))->get();
    }

    public function searchProduct(string $search): Collection
    {
        return $this->getModel()->orderBy('name')->where('name', 'LIKE', "%{$search}%")->get();
    }
}
