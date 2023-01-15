<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserSearchController extends Controller
{
    /**
     * Search for users
     * For simplicity sake, return users who are not friends or has pending friend request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function index()
    {
        try {
            $name = request()->get('query') ?? '';
            if ($name === '') {
                return response()->json(collect());
            }
            $userQuery = User::query()
                ->where('name', 'like', "{$name}%")
                ->whereDoesntHave('friends')
                ->whereDoesntHave('friendsTo');
            return response()->json(
                UserResource::collection($userQuery->get())
            );
        }
        catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }
}
