<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photos;
use Auth;
use App\Providers\Response;
use App\User;

class Searcher extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$test = (bool) $request->input('choice'); 
        //dd($test);

        if ($request->input('choice') == "false") {
        $searchable = ['title'];
        $data = $request->input('search');
        $model = Photos::select($searchable)->get(); 
        $first = true; 
        foreach ($model as $value) {
            $attr = $value->getAttributes();
            $search = $attr['title'];
            $search = str_replace($data, '~', $search);
            if (preg_match("#~+#", $search) === 1) {
                if ($first) {
                $res = Photos::where($attr)->get();
                $result[] = $res[0]->getAttributes();
               
                }
            }
        }

            foreach ($result as $value) {
                foreach ($value as $k => $v) {    
                    if ($k == 'id')
                    $fin[] = $v;
                }
            }
            $isUs = false;
            $isActive = false;

            if (empty($result)) $paginator = false;
            else
            { 
                $paginator = Photos::whereIn('id', $fin)->paginate(4);  
            }
            return view('hel', compact('paginator', 'isUs', 'isActive')); 
        }elseif ($request->input('choice') == "true") {
        $searchable = ['name'];
        $data = $request->input('search');
        $model = User::select($searchable)->get(); 
        $first = true; 
        foreach ($model as $value) {
            $attr = $value->getAttributes();
            $search = $attr['name'];
            $search = str_replace($data, '~', $search);
            //dd($search);
            if (preg_match("#~+#", $search) === 1) {
              //  $result = Photos::where($attr);
                ##Use Querying Relations## title
                if ($first) {
                $res = User::where($attr)->get();
                $result[] = $res[0]->getAttributes();
               
            }
            }
            }
            if (!empty($result)) {
            foreach ($result as $value) {
                foreach ($value as $k => $v) {    
                    if ($k == 'id')
                    $fin[] = $v;
                }
            }
        }
            $isUs = true;
            $isActive = false;

            if (empty($result)) $paginator = false;
            else
            {
                //dd($fin);
                //dd($paginator);     
                $paginator = User::whereIn('id', $fin)->paginate(4);  
                //dd($paginator);          
            }
        
            return view('hel', compact('paginator', 'isUs', 'isActive')); 
        }       
    }
}
