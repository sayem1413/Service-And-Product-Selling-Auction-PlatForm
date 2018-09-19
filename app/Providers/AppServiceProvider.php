<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use View;
use App\Division;
use App\District;
use App\Upazila;
use DB;

class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Schema::defaultStringLength(191);

        View::composer('frontEnd.includes.header', function($view) {
//            $divisions = DB::table('divisions')
//                        ->join('districts', 'districts.division_id', '=', 'divisions.id')
//                        ->select('divisions.id', 'divisions.divisionName', 'districts.districtName')
//                        ->get();

            $divisions = Division::all();
            $districts = District::all();
            $upazilas = Upazila::all();

            $view->with('divisions', $divisions)
                    ->with('districts', $districts)
                    ->with('upazilas', $upazilas);

//            $view->with('divisions',$divisions);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

}
