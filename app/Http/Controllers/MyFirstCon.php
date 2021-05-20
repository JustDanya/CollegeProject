<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photos;
use Auth;
use App\Providers\Response;
use App\User;

class MyFirstCon extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$paginator = \DB::table('another')->paginate(2);
        $paginator = Photos::paginate(4);
        //dd($paginator);
        $isUs = false;
        $isActive = true;
        return view('hel', compact('paginator', 'isUs', 'isActive'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->input();
        //dd($a);
        request()->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    //    
       /* if($request->hasFile('photo')) {
        $file = $request->file('photo');
        $imageName = time().'.'. strtolower($file->getClientOriginalExtension());
    }*/
    //
        $_FILES["photo"]["name"] = time() .  $_FILES["photo"]["name"];
        move_uploaded_file($_FILES["photo"]["tmp_name"], 'D:\\OpenServer\\domains\\wsr.loc\\public\\Photos\\'.$_FILES["photo"]["name"]);
        $data['photo'] = "Photos\\" . $_FILES["photo"]["name"];
        //$data['user_id'] = (int) $data['user_id'];
        //dd($data);  
        //dd();
       /* request()->image->move(public_path('Photos'), $imageName);*/
        $item = (new Photos())->create($data); 
        return redirect()
                ->route('conTest.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $model = Photos::find($id);
        if (!empty($model)) {
        $content = $model->getAttributes();
        //dd($model);
        $user = User::find($content['user_id']);
       
        //dd($content);
        return view('show', compact('content', 'model', 'user'));
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Photos::find($id);
        $response = \Gate::inspect('edit-settings', $model);
        if ($response->allowed()) {
        $content = $model->getAttributes();
        return view('edit', compact('content'));    
        } else {
        echo $response->message();
        }

       /* $model = Photos::findOrFail($id);
        $content = $model->getAttributes();
        return view('edit', compact('content'));   */ 
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
        $update = Photos::find($id);
        $response = \Gate::inspect('edit-settings', $update);

        if ($response->allowed()) {
        $data = ['title' => $request->input('title')];
        //dd($data);
        $update = $update->update($data); //fill(['title' => $data])->save();

        if($update) { 
            return redirect()
                ->route('conTest.show', ['contr' => $id]);
        }
        else {
            return back()
                    ->withErrors(['msg' => "Не удалось изменить запись "]);
        }
        }else {
        echo $response->message();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Photos::find($id);
        $response = \Gate::inspect('edit-settings', $model);

        if ($response->allowed()) {
        $content = $model->getAttributes();
        unlink($content['photo']);
        //dd($content['photo']);
        $model->delete();


        return redirect()
                ->route('conTest.index');   

        } else {
        echo $response->message();
        }                
    }

}
