<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ExecutiveCommittee;
use Illuminate\Http\Request;

class ExecutiveCommitteeController extends Controller
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
            $executivecommittee = ExecutiveCommittee::where('about', 'LIKE', "%$keyword%")
                ->orWhere('image_icon', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('designation', 'LIKE', "%$keyword%")
                ->orWhere('popup_image', 'LIKE', "%$keyword%")
                ->orWhere('popup_description', 'LIKE', "%$keyword%")
                ->orWhere('sort', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $executivecommittee = ExecutiveCommittee::latest()->paginate($perPage);
        }

        return view('executive-committee.index', compact('executivecommittee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('executive-committee.create');
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
               
            'name'=>'required',   
            'designation'=>'required',   
            'popup_description'=>'required',   
            'sort'=>'required',
            'image_icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:max_width=120,max_height=118',
            'popup_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:max_width=226,max_height=220',   
            
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


           $a = ExecutiveCommittee::create($requestData);
             

           if($a)
           { 
            return redirect('executive-committee')->with('flash_message', 'ExecutiveCommittee added!');
           }
           else{
             return redirect('executive-committee')->with('flash_message', 'Something went wrong on executive-committee!!');
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
        $executivecommittee = ExecutiveCommittee::findOrFail($id);

        return view('executive-committee.show', compact('executivecommittee'));
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
        $executivecommittee = ExecutiveCommittee::findOrFail($id);

        return view('executive-committee.edit', compact('executivecommittee'));
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
 
 
           $executivecommittee = ExecutiveCommittee::findOrFail($id);
           $a = $executivecommittee->update($requestData);
              
            if($a)
            { 
             return redirect('executive-committee')->with('flash_message', 'executive-committee');
            }else{
             return redirect('executive-committee')->with('flash_message', 'Something went wrong on executive-committee!!');
 
            }
            
         }
        
         }
         else{
             $executivecommittee = ExecutiveCommittee::findOrFail($id);
             $a = $executivecommittee->update($requestData);
             if($a)
            { 
             return redirect('executive-committee')->with('flash_message', 'executive-committee');
            }else{
             return redirect('executive-committee')->with('flash_message', 'Something went wrong on executive-committee!!');
 
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
        ExecutiveCommittee::destroy($id);

        return redirect('executive-committee')->with('flash_message', 'ExecutiveCommittee deleted!');
    }
}
