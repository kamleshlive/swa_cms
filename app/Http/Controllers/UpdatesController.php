<?php

namespace App\Http\Controllers;
use Input;
use Cloudder;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Update;
use Illuminate\Http\Request;

class UpdatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $updates = Update::where('left_text', 'LIKE', "%$keyword%")
                ->orWhere('right_text', 'LIKE', "%$keyword%")
                ->orWhere('image', 'LIKE', "%$keyword%")
                ->orWhere('link', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $updates = Update::latest()->paginate($perPage);
        }

        return view('updates.index', compact('updates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('updates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:width=800,height=687',
            'left_text' => 'required',
            'right_text' => 'required',
            'link' => 'required'
        ]);
        

        if ($request->hasFile('image')) {
            $files = Input::file('image');    
            $file = $files->getClientOriginalName();

        
        $image_name = $request->file('image')->getRealPath();;

        $upload_success = Cloudder::upload($image_name, null, array("folder"=>"swa_cms","use_filename"=>TRUE ,"unique_filename"=>FALSE));
        list($width, $height) = getimagesize($image_name);
        $image_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);
    
        if($upload_success)
        { 
         $requestData['image'] =  $image_url;

           $a = Update::create($requestData);  

           if($a)
           { 
            return redirect('updates')->with('flash_message', 'Update added!');
           }
           else{
             return redirect('updates')->with('flash_message', 'Something went wrong on Update!');
           } 
        }
        else{
            return redirect('updates')->with('flash_message', 'Something went wrong on Update upload!');
        }
    }
    else{
        return redirect('updates')->with('flash_message', 'Something went wrong on updates upload!');
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $update = Update::findOrFail($id);

        return view('updates.show', compact('update'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $update = Update::findOrFail($id);

        return view('updates.edit', compact('update'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:width=800,height=687',
            'left_text' => 'required',
            'right_text' => 'required',
            'link' => 'required'
        ]);
        

        if ($request->hasFile('image')) {
            $files = Input::file('image');    
            $file = $files->getClientOriginalName();

        
        $image_name = $request->file('image')->getRealPath();;

        $upload_success = Cloudder::upload($image_name, null, array("folder"=>"swa_cms","use_filename"=>TRUE ,"unique_filename"=>FALSE));
        list($width, $height) = getimagesize($image_name);
        $image_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);
    
        if($upload_success)
        { 
         $requestData['image'] =  $image_url;

           $a = Update::create($requestData);  

           if($a)
           { 
            return redirect('updates')->with('flash_message', 'Update added!');
           }
           else{
             return redirect('updates')->with('flash_message', 'Something went wrong on Update!');
           } 
        }
        else{
            return redirect('updates')->with('flash_message', 'Something went wrong on Update upload!');
        }
    }
    else{
        return redirect('updates')->with('flash_message', 'Something went wrong on updates upload!');
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Update::destroy($id);

        return redirect('updates')->with('flash_message', 'Update deleted!');
    }
}
