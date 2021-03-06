<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Sc_membership_legal;
use Illuminate\Http\Request;
use Cloudder;
use Illuminate\Support\Facades\Input;


class Sc_membership_legalController extends Controller
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
            $sc_membership_legal = Sc_membership_legal::where('about', 'LIKE', "%$keyword%")
                ->orWhere('image_icon', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('designation', 'LIKE', "%$keyword%")
                ->orWhere('popup_image', 'LIKE', "%$keyword%")
                ->orWhere('popup_description', 'LIKE', "%$keyword%")
                ->orWhere('sort', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $sc_membership_legal = Sc_membership_legal::latest()->paginate($perPage);
        }

        return view('sc_membership_legal.index', compact('sc_membership_legal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('sc_membership_legal.create');
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


           $a = Sc_membership_legal::create($requestData);
             

           if($a)
           { 
            return redirect('sc_membership_legal')->with('flash_message', 'Added Legal');
           }
           else{
             return redirect('sc_membership_legal')->with('flash_message', 'Something went wrong on Added Legal!!');
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
        $sc_membership_legal = Sc_membership_legal::findOrFail($id);

        return view('sc_membership_legal.show', compact('sc_membership_legal'));
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
        $sc_membership_legal = Sc_membership_legal::findOrFail($id);

        return view('sc_membership_legal.edit', compact('sc_membership_legal'));
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
 
 
           $sc_membership_legal = sc_membership_legal::findOrFail($id);
           $a = $sc_membership_legal->update($requestData);
              
            if($a)
            { 
             return redirect('sc_membership_legal')->with('flash_message', 'Added Legal');
            }else{
             return redirect('sc_membership_legal')->with('flash_message', 'Something went wrong on Added Legal!!');
 
            }
            
         }
        
         }
         else{
             $sc_membership_legal = Sc_membership_legal::findOrFail($id);
             $a = $sc_membership_legal->update($requestData);
             if($a)
            { 
             return redirect('sc_membership_legal')->with('flash_message', 'Added Legal');
            }else{
             return redirect('sc_membership_legal')->with('flash_message', 'Something went wrong on Added Legal!!');
 
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
        Sc_membership_legal::destroy($id);

        return redirect('sc_membership_legal')->with('flash_message', 'Membership Legal deleted!');
    }
}
