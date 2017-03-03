<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        dd($request->photo);
        $user = new User;
        $user->name = $request->input('name');
        $user->address = $request->input('address');
        $user->age = $request->input('age');
        $user->photo = $request->input('photo');
        // if($request->file('photo')!==null) :
        //     $image = $request->file('photo');
        //     $imageName = time().'.'.$image->getClientOriginalExtension();
        //     $destinationPath = public_path('/img');
        //     $img = Image::make($image->getRealPath())
        //                 ->resize(426, 590)
        //                 ->save($destinationPath.'/'.$imageName);
        //     $product->photo = 'img/'.$imageName;
        // endif;  
        $user->save();
        return 'User record successfully created with id ' . $user->id;
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
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->address = $request->input('address');
        $user->age = $request->input('age');
        if($request->file('photo')!==null) :
            $image = $request->file('photo');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/image');
            //create an image in destinationPath folder
            $width = 426;
            $height = 590;
            $photo = Image::make($image->getRealPath())
                        ->resize($width, $height)
                        ->save($destinationPath.'/'.$imageName);
            $product->photo = 'image/'.$imageName;
        endif;  
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
