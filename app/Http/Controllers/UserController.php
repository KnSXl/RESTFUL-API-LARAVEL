<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreUpdateUserRequest;
use App\Http\Controllers\ResponseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends ResponseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // search filter
        $query = User::query();
        $fields = ['id', 'name', 'email'];
        
        foreach ($fields as $field) {
            if ($request->has($field)) {
                $query->where($field, 'like', '%' . $request->input($field) . '%');
            }
        }    

        // No pagination
        $users = $query->get();
        return UserResource::collection($users);

        // With pagination
        // $users = $query->paginate(15);
        // return UserResource::collection($users);

        // More tables no pagination
        /*
            $users = $query->get();
            $variables = Variable::all();

            $usersWithVariables = $users->map(function ($user) use ($variables) {
                $user->variable = $variables;
                return $user;
            });

            return UserResource::collection($usersWithVariables);
        */
        
        // More tables with pagination
        /*
            $users = $query->paginate(15);
            $variables = Variable::all();

            $users->getCollection()->transform(function ($user) use ($variables) {
                $user->variable = $variables;
                return $user;
            });

            return UserResource::collection($users);
       */
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return $this->sendError('User not found', 404);
        }

        // More tables no pagination
        // $variable = Variable::all();
        // $user->variable = $variable;

        return $this->sendResponse('User found successfully', new UserResource($user), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateUserRequest $request)
    {
        // Encrypt password
        $requestData = $request->all();
        $requestData['password'] = Hash::make($requestData['password']);
        
        $user = User::create($requestData);
        
        return $this->sendResponse('User created successfully', new UserResource($user), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateUserRequest $request, string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return $this->sendError('User not found', 404);
        }
                
        // Encrypt password
        $requestData = $request->all();

        if (isset($requestData['password'])) {
            $requestData['password'] = Hash::make($requestData['password']);
        }
        
        $user->update($requestData);
        
        return $this->sendResponse('User updated successfully', new UserResource($user), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        
        if (!$user) {
            return $this->sendError('User not found', 404);
        }

        $user->delete();
        
        return $this->sendResponse('User deleted successfully', new UserResource($user), 200);
    }
}
