<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:librarian|administrator', ['except' => ['me']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(8);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            'birthday' => 'required|date',
            'role' => 'required|in:user,librarian,administrator',
        ]);

        $data = $request->only('name', 'email', 'birthday', 'role');
        $data['password'] = bcrypt($request->password);

        User::create($data);

        return redirect()->route('users.index')
            ->withFlashMessage('User created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user,
            'loans' => $user->loans()->latest()->paginate(8),
        ]);
    }

    public function me(Request $request)
    {
        return $this->show($request->user());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'birthday' => 'required|date',
            'role' => 'required|in:user,librarian,administrator',
            'password' => 'sometimes|confirmed|min:6',
        ]);

        $data = $request->only('name', 'email', 'birthday', 'role');

        if($request->password){
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->back()
            ->withFlashMessage('User updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->loans->count() > 0){
            return redirect()->back()->withErrors(['The user has active book loans.']);
        }

        $user->delete();

        return redirect()->route('users.index')->withFlashMessage('User deleted.');
    }
}
