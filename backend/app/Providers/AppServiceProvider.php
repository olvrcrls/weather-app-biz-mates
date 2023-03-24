<?php

namespace App\Providers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

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
        /**
         * Macro definitions
         * for more readable response and programmability
         */

        Response::macro('success', function ($data, string $message = 'OK') {
            if (! is_array($data)) {
                $data = [$data];
            }

            return response()->json([
                'error' => false,
                'data' => $data,
                'message' => $message
            ], 200);
        });

        Response::macro('error', function (string $error, int $status_code = 422) {
            Log::error($error);

            return response()->json([
                'error' => $error,
                'data' => [],
                'message' => $error
            ], $status_code);
        });
    }
}
