<?php

namespace App\Providers;

use App\Queries\CartsQueryBuilder;
use App\Queries\ProductsQueryBuilder;
use App\Queries\QueryBuilder;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Schema::defaultStringLength(191);
        $this->app->bind(QueryBuilder::class, ProductsQueryBuilder::class);
        $this->app->bind(QueryBuilder::class, CartsQueryBuilder::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
