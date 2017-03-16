<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\StoreUser;

define('width', '426');
define('height', '426');
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null) {
        if ($id === null) {
            return User::all();
        } else {
            return $this->show($id);
        }
    }
    public function uploadImage(Request $request) {
        if($request->hasFile('file')) :
            $image = $request->file('file');
            $imageName = $image->getClientOriginalName();
            $destinationPath = public_path('/image');
            $newImage = \Image::make($image->getRealPath())
                        ->resize(width, height)
                        ->save($destinationPath.'/'.$imageName);
            $userPhoto = 'image/'.$imageName;
        endif;
        return $userPhoto;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {   
        $user = new User;
        $user->name = $request->input('name');
        $user->address = $request->input('address');
        $user->age = $request->input('age');
        $user->photo = $request->photo;
        if($user->save() ){
            return array("status"=>'true');
        }
        return array("status"=>'false');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUser $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->address = $request->input('address');
        $user->age = $request->input('age');
        $user->photo = $request->photo;
        $user->save();

        return "Sucess updating user #" . $user->id;
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

        return "User record successfully deleted #" . $user->id;
    }
}
