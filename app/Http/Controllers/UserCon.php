<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Photos;
use Illuminate\Http\Request;
use App\Providers\Response;
use Auth;

class UserCon extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(true);
        $paginator = User::paginate(10);
        $isUs = true;
        $isActive = 0;
        return view('hel', compact('paginator', 'isUs', 'isActive'));
    }

   

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $photos = Photos:: where('user_id', $id)
               ->orderBy('created_at', 'desc')
               ->paginate(3);
             
        return view('user', compact('photos', 'user'));       
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $user = User::find($id);
        $model = Photos::where('user_id', $id)
                    ->get();
        $response = \Gate::inspect('del-use', $user);
        //dd($model);

        if ($response->allowed()) {
        //$content = $model->getAttributes();
        foreach ($model as $value) {
        $attr = $value->getAttributes();
        //dd($attr);
        unlink($attr['photo']);
        $value->delete();
        }
        //$model->delete();
        $user->delete();

        return redirect()
                ->route('conUse.index');   

        } else {
        echo $response->message();
        }     
    }
}
