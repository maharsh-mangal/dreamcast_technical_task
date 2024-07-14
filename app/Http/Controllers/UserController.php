<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Inertia\Response
    {
        return Inertia::render('User/Index', [
            'users' => UserResource::collection(User::all()),
            'roles' => Role::all()->pluck('name', 'id'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): \Illuminate\Http\JsonResponse
    {
        $file = $request->file('photo');
        $fileName = Str::random(20).'.'.$file->getClientOriginalExtension();
        Storage::disk('public')->putFileAs('profile_images', $file, $fileName);

        User::query()->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            //no point showing the input field for it because users are just added, not registered
            'password' => bcrypt($request->input('password')),
            'role_id' => $request->input('role_id'),
            'phone_number' => $request->input('phone'),
            'description' => $request->input('description'),
            'profile_photo_path' => $fileName,
        ]);

        return response()->json([
            'message' => 'User created successfully'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
