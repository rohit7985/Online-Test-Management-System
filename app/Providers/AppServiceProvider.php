<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Blade;
use Illuminate\Contracts\Encryption\DecryptException;

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
        Blade::directive('decrypt', function ($expression) {
            try {
                $decryptedURL = Crypt::decryptString($expression);
                return "<?php echo $decryptedURL; ?>";
            } catch (DecryptException $e) {
                // Handle decryption errors (e.g., log the error, return a default image URL, etc.)
                return "<?php /* Handle decryption error */ ?>";
            }
        });
    }
}
