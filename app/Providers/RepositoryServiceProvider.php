<?php

namespace App\Providers;
use App\Interfaces\Admin\AdvertisingRepositoryInterface;
use App\Interfaces\Admin\CategoryRepositoryInterface;
use App\Interfaces\Admin\DashboardRepositoryInterface;
use App\Interfaces\Admin\OrderRepositoryInterface;
use App\Interfaces\Admin\ProductiveFamilyRepositoryInterface;
use App\Interfaces\Admin\ProductRepositoryInterface;
use App\Interfaces\Front\IndexRepositoryInterface;
use App\Interfaces\Front\VendorRepositoryInterface;
use App\Interfaces\front\ShopRepositoryInterface;
use App\Interfaces\front\CartRepositoryInterface;
use App\Repositories\Admin\AdvertisingRepository;
use App\Repositories\Admin\CategoryRepository;
use App\Repositories\Admin\DashboardRepository;
use App\Repositories\Admin\OrderRepository;
use App\Repositories\Admin\ProductiveFamilyRepository;
use App\Repositories\Admin\ProductRepository;
use App\Repositories\Front\IndexRepository;
use App\Repositories\Front\VendorRepository;
use App\Repositories\Front\ShopRepository;
use App\Repositories\Front\CartRepository;
use Illuminate\Support\ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(DashboardRepositoryInterface::class, DashboardRepository::class);
        $this->app->bind(AdvertisingRepositoryInterface::class, AdvertisingRepository::class);
        $this->app->bind(ProductiveFamilyRepositoryInterface::class, ProductiveFamilyRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(IndexRepositoryInterface::class, IndexRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(VendorRepositoryInterface::class, VendorRepository::class);
        $this->app->bind(ShopRepositoryInterface::class, ShopRepository::class);
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
        // $this->app->bind(ShopRepositoryInterface::class,ShopRepository::class

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
