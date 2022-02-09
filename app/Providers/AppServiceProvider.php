<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
        //custom if jika sertifikat ada maka tampilkan centang mun teu berarti x
        Blade::directive('icon', function ($expression) {
            // $params = null;
            // eval("\$params = [$expression];");
            // list($cert_data, $cert_name, $nrp) = $params;
            $cert_data = $expression[0];
            $cert_name = $expression[1];
            $nrp = $expression[2];
            // dd($expression);
            
            if($cert_data != 0){
                $icon = "<a class='icon_{$cert_name}' id='icon_{$cert_name}' data-nrp='{$nrp}' href='' data-toggle='modal' data-target='#modal-gambar'>
                <i class='fa fa-check fa-lg' aria-hidden='true' style='color: #3cd67c;'></i></a>";
            }else{
                $icon = '<i class="fa fa-times fa-lg" aria-hidden="true" style="color: red;"></i>'; // default icon == 0
            }
            // dd($icon);
            return $icon;
        });
    }
}
