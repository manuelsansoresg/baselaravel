<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Role;
use App\RoleUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $user;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $this->user = User::find(Auth::user()->id);
            return $next($request);

        });
    }

    public function index()
    {
        $users = User::all();

        return view('admin.user.list')->with('users' , $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.user.form')->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User($request->except('_token', 'role_user'));
        $user->password = bcrypt($request->password);
        $user->save();
        $role_user = Role::find($request->role_user);
        $user->attachRole($role_user);

        flash('Usuario guardado');
        return redirect('/admin/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::select('users.id', 'role_user.role_id', 'users.name', 'email')
                        ->where('users.id',$id)->leftJoin('role_user', 'user_id', '=', 'users.id')
                       ->leftJoin('roles', 'roles.id', '=', 'role_user.role_id')->first();
        $roles = Role::all();

        return view('admin.user.edit')->with(array('user' => $user, 'roles' => $roles ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $role_id = $user->roles->toArray()[0]['id'];
        $user->fill($request->except('_token', 'role_user'));
        $user->password = bcrypt($request->password);
        $user->update();
        if($role_id != $request->role_user){
            $user->roles()->detach(Role::find($request->$role_id));
            $user->roles()->attach($request->role_user);
        }

        return redirect('/admin/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/admin/user');
    }
}
