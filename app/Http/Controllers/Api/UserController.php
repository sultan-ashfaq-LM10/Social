<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{




//    public function userInfo()
//    {
//        try {
//            return response()->json(
//                new UserResource(auth()->user())
//            );
//        } catch (\Exception $exception) {
//            return response()->json($exception->getMessage(), 500);
//        }
//    }
}
