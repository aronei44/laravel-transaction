<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create(){
        $name = 'nama anda';
        $email = 'emailanda89@gmail.com';
        $password = Hash::make('password');
        $role = 'tukang';
        // role hanya bisa diisi user atau admin
        DB::beginTransaction();
        try {
            $user = User::create([
                'name'=>$name,
                'email'=>$email,
                'password'=>$password
            ]);
            $role = Role::create([
                'user_id'=>$user->id,
                'role_name'=>$role 
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            //throw $th;
        }
    }
}
