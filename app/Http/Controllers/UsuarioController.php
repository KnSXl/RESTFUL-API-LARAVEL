<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Http\Resources\UsuarioResource;
use App\Http\Requests\StoreUpdateUsuarioRequest;
use App\Http\Controllers\ResponseController;

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
    public function index()
    {
        $users = Usuario::all();

        return $this->responseController->sendResponse('Users found successfully', UsuarioResource::collection($users), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Usuario::find($id);

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
        $user = Usuario::create($request->all());
        
        return $this->responseController->sendResponse('User created successfully', new UsuarioResource($user), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateUsuarioRequest $request, string $id)
    {
        $user = Usuario::find($id);

        if (!$user) {
            return $this->responseController->sendError('User not found', 404);
        }

        $user->update($request->all());
        
        return $this->responseController->sendResponse('User updated successfully', new UsuarioResource($user), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Usuario::find($id);
        
        if (!$user) {
            return $this->responseController->sendError('User not found', 404);
        }

        $user->delete();
        
        return $this->responseController->sendResponse('User deleted successfully', null, 200);
    }
}
