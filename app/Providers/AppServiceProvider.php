<?php

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Event;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (env('APP_ENV') === 'local') {
        DB::connection()->enableQueryLog();
    }
        if (env('APP_ENV') === 'local') {
            Event::listen('kernel.handled', function ($request, $response) {
                if ( $request->has('sql-debug') ) {
                    $queries = DB::getQueryLog();
                    dump($queries);
                }
            });
        }

        Collection::macro('pluckMultiple', function ($assoc) {
            return $this->map(function ($item) use ($assoc) {
                $list = [];
                foreach ($assoc as $key) {
                    $list[$key] = data_get($item, $key);
                }
                return $list;
            }, new static);
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
