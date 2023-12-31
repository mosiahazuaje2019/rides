<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateResquest;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    protected $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(
            new UserCollection(
                $this->user->orderBy('id','asc')->get()
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request): JsonResponse
    {
        $userData = $request->all();

        $userData['password'] = Hash::make($userData['password']);

        $user = $this->user->create($userData);
        return response()->json(new UserResource($user),201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): JsonResponse
    {
        return response()->json(
            new UserResource($user)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateResquest $request, User $user): JsonResponse
    {
        $userData = $request->all();
        
        isset($userData['password']) ? $userData['password'] = Hash::make($userData['password']) : null;

        $user->update($userData);
        return response()->json(new UserResource($user));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();
        return response()->json(null, 204);
    }

    public function get_drivers(): JsonResponse {
        $users = User::where('profile', 'Driver')->get();

        return response()->json(new UserCollection($users));
    }
}
