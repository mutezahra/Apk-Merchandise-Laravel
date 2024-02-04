<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\LogM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Auth;

class userC extends Controller
{
    public function index() {

      
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Data User'
        ]);

        $subtitle = "Daftar Users";
        $usersM = User::all();
        return view('users_index', compact('usersM','subtitle'));
        
    }

    public function create() {
        $subtitle = "Tambah Data Pengguna";
        
        return view('create.users_create' , compact('subtitle'));
    }


    public function store(Request $request){


       $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Menambahkan Data User'
        ]); 
        $validatedData =$request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
            'role' => 'required',
        ]);

        $user = new User([
            'nama' => $validatedData['nama'],
            'username' => $validatedData['username'],
            'password' => Hash::make($validatedData['password']), // Fix the typo here
            'role' => $validatedData['role'],
        ]);
        $user->save();

        return redirect()->route('users.index')->with('success', 'Pengguna Berhasil Ditambahkan!');
        
    }



    public function edit($id ) {
        $subtitle = "Edit Users";
        $users = User::find($id);

        // Check if the logged-in user is not an admin
        if (Auth::user()->role !== 'admin') {
            // If not admin, restrict access to role field
            return view('edit.users_edit', compact('users', 'subtitle'))->with('readonlyRole', true);
        }

        return view('edit.users_edit', compact('users', 'subtitle'));
    }

    public function update(Request $request, $id)
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Mengedit Data user'
        ]);

        $users = User::findOrFail($id);

        // Check if the logged-in user is not an admin
        if (Auth::user()->role !== 'admin') {
            // If not admin, restrict updating the role field
            $users->update($request->only(['nama', 'username']));
        } else {
            // If admin, update all fields
            $users->update($request->all());
        }

        return redirect()->route('users.index')->with('success', 'User Berhasil Diperbarui');
    }
    
  

    public function destroy($id)
    {
    $LogM = LogM::create([
        'id_user' => Auth::user()->id,
        'activity' => 'User Menghapus users'
    ]);
    LogM::where('id_user', $id)->delete();
    // LogM::where('id_user', $id)->delete();
    User::where('id', $id)->delete();

    return redirect()->route('users.index')->with('success', 'User Berhasil Dihapus');
    }



    public function changepassword($id)
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Mengedit Password'
        ]);
        $subtitle = "Edit Kata Sandi Pengguna";
        $data = User::find($id);
        return view('edit.changgepassword_edit', compact( 'data', 'subtitle'));
    }

    public function change( Request $request, $id){
       
        $request->validate([
            'password_new' => 'required',
            'password_confirm' => 'required|same:password_new',
        ]);
        $users = User::where("id",$id)->first();
        $users ->update([
            'password' => Hash::make($request->password_new),
        ]);
        return redirect()->route('users.index')
        ->with('success', ' Kata Sandi Berhasil Diperbarui!');
    
    }


   
}
