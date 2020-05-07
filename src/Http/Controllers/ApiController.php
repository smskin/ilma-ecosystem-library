<?php

namespace Ilma\Ecosystem\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Route;

class ApiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function isApi(): bool
    {
        if (!Route::current()){
            return false;
        }

        $middleware = Route::current()->middleware();
        return in_array('api',$middleware);
    }

    protected function isWebApi(): bool
    {
        if (!Route::current()){
            return false;
        }

        $middleware = Route::current()->middleware();
        return in_array('web-api',$middleware);
    }

    protected function authMiddleware(): void
    {
        if (!Route::current()){
            return;
        }

        if ($this->isApi()){
            $this->middleware('auth.jwt');
            return;
        }

        if ($this->isWebApi()){
            $this->middleware('auth:web');
            return;
        }
        $this->middleware('auth:api');
    }
}
