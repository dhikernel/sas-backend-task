<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 *@OA\Info(
 * title="Book Store - API reference",
 * version="1.0.0",
 * description="Documentation of each EndPoint for integration.",
 * @OA\Contact(
 *  email="dhipereira21@gmail.com"
 * ),
 *),
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
