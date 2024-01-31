<?php

namespace App\Http\Controllers;

use App\Models\LogM;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 

class ProfileC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       

    $subtitle = "Profile";
    $usersM = User::all();
    return view('profile', compact('usersM','subtitle'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
       
        $subtitle = "Edit Profile";
        $users = User::find($id);
    
        // Check if the logged-in user is not an admin
        // if (Auth::user()->role !== 'admin') {
            // If not admin, restrict access to role field
            return view('edit.profile_edit', compact('users', 'subtitle'))->with(['readonlyRole' => true]);
        // }
    
       
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
        
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Mengedit Profile'
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

        return redirect()->route('profile.index')->with('success', 'User Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    
    public function changepassword($id)
    {
        $subtitle = "Edit Password";
        $users = User::find($id);
        return view('edit.profile_changepassword', compact( 'users','subtitle'));
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
        return redirect()->route('profile.index')->with('success', ' Kata Sandi Berhasil Diperbarui!');
    
    }
}
