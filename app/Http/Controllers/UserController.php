<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //

    public function index(){
        $loggedUser = Auth::user();
        $users = User::where('id','!=',$loggedUser->id)->get();
        return view('user.user-list', [
            'users'=>$users
        ]);
    }

    public function update(Request $request, User $user){
        if($request->user()->role == 'Admin'){
            $user->role = $request->get('user-role');
            $user->save();
            return redirect('admin/users');
        }
    }
}
