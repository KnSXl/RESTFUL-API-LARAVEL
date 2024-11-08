<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UsuarioResource;
use App\Http\Requests\StoreUpdateUsuarioRequest;
use App\Http\Controllers\ResponseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    protected $responseController;

    public function __construct()
    {
        $this->responseController = new ResponseController();
    }

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
        return UsuarioResource::collection($users);

        // With pagination
        // $users = $query->paginate(15);
        // return UsuarioResource::collection($users);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return $this->responseController->sendError('User not found', 404);
        }

        return $this->responseController->sendResponse('User found successfully', new UsuarioResource($user), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateUsuarioRequest $request)
    {
        // Encrypt password
        $requestData = $request->all();
        $requestData['password'] = Hash::make($requestData['password']);
        
        $user = User::create($requestData);
        
        return $this->responseController->sendResponse('User created successfully', new UsuarioResource($user), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateUsuarioRequest $request, string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return $this->responseController->sendError('User not found', 404);
        }
                
        // Encrypt password
        $requestData = $request->all();

        if (isset($requestData['password'])) {
            $requestData['password'] = Hash::make($requestData['password']);
        }
        
        $user->update($requestData);
        
        return $this->responseController->sendResponse('User updated successfully', new UsuarioResource($user), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        
        if (!$user) {
            return $this->responseController->sendError('User not found', 404);
        }

        $user->delete();
        
        return $this->responseController->sendResponse('User deleted successfully', new UsuarioResource($user), 200);
    }
}
