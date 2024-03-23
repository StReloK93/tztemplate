<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Models\CarRide;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $startRouteId = 17; 

        $carRides = CarRide::with(['cities' => function ($query) use ($startRouteId) {
            $query->orderBy('id', 'asc')->take(1); // Сортируем по id и берем только первую запись
        }])->get();

        dd($carRides[2]);
    }
}
