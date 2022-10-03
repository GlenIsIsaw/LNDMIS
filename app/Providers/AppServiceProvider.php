<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer(['livewire.training.training-modal','employee.compindex','idp.create','idp.create2','idp.edit','idp.edit2','attendanceforms.create',"attendanceforms.edit"], function ($view) {

            if(auth()->user()->teacher == 'Yes')
            {
                $list = DB::table('competencies')
                ->where('teaching','=', 1)
                ->orderBy('competency_group','asc')
                ->get();
            }else
            {
                $list = DB::table('competencies')
                ->where('nonteaching','=', 1)
                ->orderBy('competency_group','asc')
                ->get();
            }
            $comp = $list->groupBy('competency_group')->toArray();



            
            $view->with('comps', $comp);
        });
    }
}
