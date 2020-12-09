<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Sc_dsc;
use Illuminate\Http\Request;

use Cloudder;
use Illuminate\Support\Facades\Input;

// use Session;
use Illuminate\Support\Facades\Session;

class Sc_dscController extends Controller
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
            $sc_dsc = Sc_dsc::where('about', 'LIKE', "%$keyword%")
                ->orWhere('image_icon', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $sc_dsc = Sc_dsc::latest()->paginate($perPage);
        }

        return view('sc_dsc.index', compact('sc_dsc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('sc_dsc.create');
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
            'image_icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'name' => 'required'
            ]);


        if ($request->hasFile('image_icon')) {
        $files = Input::file('image_icon');
        $file = $files->getClientOriginalName();

        $image_name = $request->file('image_icon')->getRealPath();
        $upload_success = Cloudder::upload($image_name, null, array("folder"=>"swa_cms","use_filename"=>TRUE ,"unique_filename"=>FALSE));
        list($width, $height) = getimagesize($image_name);
        $image_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);




        if($upload_success)
        {
         $requestData['image_icon'] =  $image_url;
           $a = Sc_dsc::create($requestData);
           if($a)
           {
            return redirect('mediacenter')->with('flash_message', 'Added Media Center Image and text');
           }
           else{
             return redirect('mediacenter')->with('flash_message', 'Something went wrong on Media Center Image and text!!');
           }

        }else{
            return redirect('mediacenter')->with('flash_message', 'Something went wrong on Media Center Image and text!!');
        }
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
        $sc_dsc = Sc_dsc::findOrFail($id);

        return view('sc_dsc.show', compact('sc_dsc'));
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
        $sc_dsc = Sc_dsc::findOrFail($id);

        return view('sc_dsc.edit', compact('sc_dsc'));
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

        if ($request->hasFile('image_icon'))
        {
        $files = Input::file('image_icon');
        $file = $files->getClientOriginalName();

        $image_name = $request->file('image_icon')->getRealPath();
        $upload_success = Cloudder::upload($image_name, null, array("folder"=>"swa_cms","use_filename"=>TRUE ,"unique_filename"=>FALSE));
        list($width, $height) = getimagesize($image_name);
        $image_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);

        if($upload_success)
        {
         $requestData['image_icon'] =  $image_url;

          $Sc_dsc = Sc_dsc::findOrFail($id);
          $a = $Sc_dsc->update($requestData);

           if($a)
           {
            return redirect('mediacenter')->with('flash_message', 'Update Image and Text successfully!');
           }else{
            return redirect('mediacenter')->with('flash_message', 'Something went wrong on Update!!');
           }

        }

        }
        else{
            $Sc_dsc = Sc_dsc::findOrFail($id);
            $a = $Sc_dsc->update($requestData);

           if($a)
           {
            return redirect('mediacenter')->with('flash_message', 'Update Image and Text successfully!');
           }else{
            return redirect('mediacenter')->with('flash_message', 'Something went wrong on Update!!');
           }
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
        Sc_dsc::destroy($id);

        return redirect('mediacenter')->with('flash_message', 'Media Center deleted!');
    }
}
