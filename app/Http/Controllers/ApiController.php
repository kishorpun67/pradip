<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ApiController extends Controller
{
    public function user(Request $request)
    {
        return $request->user();
    }
}
