<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\Models\User;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function profile()
    {
        $user = auth()->user(); // Get the logged-in user's information

        $additionalData = DB::table('users')
            ->where('id', $user->id)
            ->first(); // Fetch the teacher's data

        return view('user.profile', compact('user', 'additionalData')); // Pass user and additional data to the view
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            //'role' => 'required|integer',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            //'role' => $request->role,
        ]);

        return redirect()->back()->with('success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserModel $userModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserModel $userModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $request->id,
            //'role' => 'required|integer',
        ]);

        $user = User::find($request->id);

        if (!$user) {
            return back()->with('error', 'User not found.');
        }
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        //$user->role = $request->role;
        $user->save();

        return redirect()->route('user.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found!');
        }

        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully!');
    }
}
