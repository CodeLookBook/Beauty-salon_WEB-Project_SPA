<?php

namespace App\Providers;

use App\Customer;
use App\Order;
use App\OrderState;
use App\Service;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //Router parameters patterns
        Route::pattern('skip', '[0-9]+');
        Route::pattern('take', '[0-9]+');

        parent::boot();

        Route::bind('trashedOrder', function ($id) {

            return Order::onlyTrashed()->findOrFail($id);

        });

        Route::bind('trashedService', function ($id) {

            return Service::onlyTrashed()->findOrFail($id);

        });

        Route::bind('trashedCustomer', function ($id){

           return Customer::onlyTrashed()->findOrFail($id);

        });

        Route::bind('trashedOrderState', function ($id){

            return OrderState::onlyTrashed()->findOrFail($id);

        });
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
