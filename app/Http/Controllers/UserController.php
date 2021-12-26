<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $users = User::all();

        return view('backend.user.index', [
            'users' => $users, 
        ]);
    }

    public function create() {
        return view('backend.user.add');  
    }

    //insert data to table
    public function store(Request $request) {
        //data yg akan diterima function store
        $name = $request->name;
        $email = $request->email;
        $jk = $request->jk;
        $level = $request->level;
        $no_telp = $request->no_telp;
        $password = Hash::make($request->password);

        //validasi sebelum insert ke table
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'jk' => 'required',
            'level' => 'required',
            'no_telp' => 'required',
            'password' => 'required',
        ]);

        //buat objek untuk simpan data ke table
        $user = new User;

        //kirim nilai" yg didapat dari form ke table
        $user->name = $name;
        $user->email = $email;
        $user->jk = $jk;
        $user->level = $level;
        $user->no_telp = $no_telp;
        $user->password = $password;

        //simpan data yg telah diterima kedalam dable
        $user->save();

        //redirect ke halaman users
        return redirect('users');   
    }

    public function edit($id) {
        $user = User::find($id);
        // dd($user);

        //tampilkan form edit dan kirim datanya
        return view('backend.user.edit', compact('user'));
    }

    public function update(Request $request) {
        //data yg akan diterima function store
        $id = $request->id;
        $name = $request->name;
        $email = $request->email;
        $jk = $request->jk;
        $level = $request->level;
        $no_telp = $request->no_telp;

        //buat objek untuk simpan data ke table
        $user = User::find($id);

        //kirim nilai" yg didapat dari form ke table
        $user->name = $name;
        $user->email = $email;
        $user->jk = $jk;
        $user->level = $level;
        $user->no_telp = $no_telp;

        //simpan data yg telah diterima kedalam dable
        $user->update();

        //redirect ke halaman users
        return redirect('users');   
    }

    public function delete($id) {
        $user = User::find($id)->delete();

        return redirect('users');
    }
}
