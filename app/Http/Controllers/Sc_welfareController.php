<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Sc_welfare;
use Illuminate\Http\Request;
use Cloudder;
use Illuminate\Support\Facades\Input;


class Sc_welfareController extends Controller
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
            $sc_welfare = Sc_welfare::where('about', 'LIKE', "%$keyword%")
                ->orWhere('image_icon', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('designation', 'LIKE', "%$keyword%")
                ->orWhere('popup_image', 'LIKE', "%$keyword%")
                ->orWhere('popup_description', 'LIKE', "%$keyword%")
                ->orWhere('sort', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $sc_welfare = Sc_welfare::latest()->paginate($perPage);
        }

        return view('sc_welfare.index', compact('sc_welfare'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('sc_welfare.create');
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
        $this->validate($request, [
            'image_icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'popup_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
            ]);

        $requestData = $request->all();

        if ($request->hasFile('image_icon') && $request->hasFile('image_icon') ) {
            $files = Input::file('image_icon');
            $file = $files->getClientOriginalName();

        $image_name = $request->file('image_icon')->getRealPath();
        $upload_success = Cloudder::upload($image_name, null, array("folder"=>"swa_cms","use_filename"=>TRUE ,"unique_filename"=>FALSE));
        list($width, $height) = getimagesize($image_name);
        $image_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);

        $popup_files = Input::file('popup_image');
        $popup_file = $popup_files->getClientOriginalName();

        $popup_name = $request->file('popup_image')->getRealPath();;

        $upload_success = Cloudder::upload($popup_name, null, array("folder"=>"swa_cms","use_filename"=>TRUE ,"unique_filename"=>FALSE));
         list($width, $height) = getimagesize($popup_name);
         $popup_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);

    
        if($upload_success)
        { 
         $requestData['image_icon'] =  $image_url;
         $requestData['popup_image'] =  $popup_url;


           $a = Sc_welfare::create($requestData);
             

           if($a)
           { 
            return redirect('sc_welfare')->with('flash_message', 'Walfare Added');
           }
           else{
             return redirect('sc_welfare')->with('flash_message', 'Something went wrong on Walfare Added!!');
           } 
        
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
        $sc_welfare = Sc_welfare::findOrFail($id);

        return view('sc_welfare.show', compact('sc_welfare'));
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
        $sc_welfare = Sc_welfare::findOrFail($id);

        return view('sc_welfare.edit', compact('sc_welfare'));
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

        if ($request->hasFile('image_icon') && $request->hasFile('image_icon') ) {
            $files = Input::file('image_icon');
            $file = $files->getClientOriginalName();

        $image_name = $request->file('image_icon')->getRealPath();
        $upload_success = Cloudder::upload($image_name, null, array("folder"=>"swa_cms","use_filename"=>TRUE ,"unique_filename"=>FALSE));
        list($width, $height) = getimagesize($image_name);
        $image_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);

        $popup_files = Input::file('popup_image');
        $popup_file = $popup_files->getClientOriginalName();

        $popup_name = $request->file('popup_image')->getRealPath();;

        $upload_success = Cloudder::upload($popup_name, null, array("folder"=>"swa_cms","use_filename"=>TRUE ,"unique_filename"=>FALSE));
         list($width, $height) = getimagesize($popup_name);
         $popup_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);

         if($upload_success)
         { 
          $requestData['image_icon'] =  $image_url;
          $requestData['popup_image'] =  $popup_url;
 
 
           $sc_welfare = Sc_welfare::findOrFail($id);
           $a = $sc_welfare->update($requestData);
              
            if($a)
            { 
             return redirect('sc_welfare')->with('flash_message', 'Walfare Added');
            }else{
             return redirect('sc_welfare')->with('flash_message', 'Something went wrong on Walfare Added!!');
 
            }
            
         }
        
         }
         else{
             $sc_welfare = Sc_welfare::findOrFail($id);
             $a = $sc_welfare->update($requestData);
                
            if($a)
            { 
             return redirect('sc_welfare')->with('flash_message', 'Walfare Added');
            }else{
             return redirect('sc_welfare')->with('flash_message', 'Something went wrong on Walfare Added!!');
 
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
        Sc_welfare::destroy($id);

        return redirect('sc_welfare')->with('flash_message', 'Welfare deleted!');
    }
}
