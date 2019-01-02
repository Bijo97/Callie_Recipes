<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    /**
     * @SWG\Swagger(
     *   basePath="/api",
     *   @SWG\Info(
     *     title="API for users and contents",
     *     version="1.0.0"
     *   )
     * )
     */
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
}
