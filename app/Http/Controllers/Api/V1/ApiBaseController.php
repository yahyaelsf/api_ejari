<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Traits\ApiResponder;

class ApiBaseController extends BaseController
{
    use ApiResponder;
}
