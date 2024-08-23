<?php

namespace App\Http\Controllers\User;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class UserBaseController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    protected $page_title;
    protected $base_view_path;
    protected $base_route_path;
}
