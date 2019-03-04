<?php

namespace App\Http\Controllers;

use App\User;
use App\Report;
use App\MDStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\RegistersUsers;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  

        $user=User::paginate(10);
        if (Auth::check())
            {
                return view('users.show', compact('user'));
            }
        else 
            {
                return redirect()->route('login');
            }

        
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
        $user = User::all();
        $user->password = Hash::make('password');
        

        $this->validate($request,[
            'name' => 'required|string|min:8|max:128',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'status'=> 'required|min:4',
            'role' => 'required',
            
        ]);
        
        User::create([
            'name' => $request['name'],
            'status' => $request['status'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'role' => $request['role'],
        ]);
        
        Alert::success('User Successfully Added', 'Success');
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user = $request->session()->get('login');
        return view('users.show', compact('user'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        if (Auth::check())
            {
                $user=User::findOrFail($id);
                return view('users.edit', compact('user'));
            }
        else {
                return redirect()->route('login');
        }
       
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
        
        $user = User::findOrFail($id);
        $user->password = Hash::make('password');
        $user->update([
        'name' => $request['name'],
        'status' => $request->input('status'),
        'email' => $request['email'],
        'password' => bcrypt($request['password']),
        'role' => $request['role'],
        'status' => $request['status'],
        ]);

        Alert::message('User updated successfully','Success');
        
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        Alert::success('Deleted Success', 'Success');
        return redirect()->route('user.index');
    }

    public function changepassword($id)
    {
        $user = User::findOrFail($id);
        return view('users.changepassword', compact('user'));

    }

    public function gantipwd(Request $request, $id){
        $user = User::findOrFail($id);
        $user->update([
            'password' => bcrypt($request['password']),
        ]);
        // dd($request);
        
        Alert::message('Password changed successfully','Success');
        
        return redirect()->route('home');

    }
}
