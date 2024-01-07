<?php


if (! function_exists('checking_route_name_is_equal')) {
    function checking_route_name_is_equal(array|string $names): string
    {
        if(is_string($names))
        {
            $names = [$names];
        }

        return in_array(\Illuminate\Support\Facades\Route::currentRouteName(),$names);
    }
}

if(! function_exists('route_name')) {
    function route_name(): string
    {
        return \Illuminate\Support\Facades\Route::currentRouteName();
    }
}