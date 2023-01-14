<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserSearchController extends Controller
{
    public function index()
    {
        try {
            $query = request()->get('query') ?? '';

            if ($query === '') {
                return response()->json(collect());
            }

            return response()->json(UserResource::collection(
                User::query()->where('name', 'like', "{$query}%")
                ->get()
            ));
        }
        catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }
}
