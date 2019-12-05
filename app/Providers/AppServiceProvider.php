<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Auth;
use App\Model\Transaction;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        view()->composer('partials._navbar',function($view){
            $view->with('count_assign', Transaction::where('transactions.is_archive','<>', 1)->where( 'assign_id', Auth::user()->id )->count()  );   
        });
       
    }
}
