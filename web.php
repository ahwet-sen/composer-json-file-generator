<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    foreach (config('composer-json-file-generator.packages') as $laravelVersion => $packageData) {
        foreach (config('composer-json-file-generator.packages.'.$laravelVersion) as $packageName) {
            Artisan::call('composer-json-file-generator '.$laravelVersion.' '.$packageName);

            unset($packageName);
        }

        unset($laravelVersion);

        unset($packageData);
    }
});
