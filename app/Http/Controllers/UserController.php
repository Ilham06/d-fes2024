<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');

        $users = User::withTrashed();
        $users = $users->when($keyword, function ($query) use ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%')->orWhere('email', 'like', '%' . $keyword . '%');
        })->get();
        
        return view('pages.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserCreateRequest $request)
    {
        $input = $request->all();
        $input['is_admin'] = false;
        $input['password'] = Hash::make($input['password']);
        DB::beginTransaction();
        try {
            User::create($input);
            DB::commit();
            return redirect()->route('user.index')
                ->with('success', 'Sukses menambahkan data user');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
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
    public function edit($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        return view('pages.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $input = $request->all();
        DB::beginTransaction();
        try {
            $user = User::withTrashed()->findOrFail($id);
            $user->update([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => $input['password'] !== '' ? Hash::make($input['password']) : $user->password
            ]);
            DB::commit();
            return redirect()->route('user.index')
                ->with('success', 'Sukses mengubah data user');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('user.index')
                ->with('success', 'Sukses meng non aktifkan user');
    }

    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->route('user.index')
                ->with('success', 'Sukses mengaktifkan kembali user');
    }
}
