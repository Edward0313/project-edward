<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class testController extends Controller
{
    //
    public function getCSRFToken(){
        return csrf_token();
    }
}
