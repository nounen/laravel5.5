<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AdminBaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $data;

    protected $auth;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->auth = Auth::user();

            return $next($request);
        });
    }

}
