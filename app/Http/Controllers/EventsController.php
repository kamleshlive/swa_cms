<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use App\Event;
use Illuminate\Http\Request;
use Cloudder;

class EventsController extends Controller
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
            $events = Event::where('image', 'LIKE', "%$keyword%")
                ->orWhere('title', 'LIKE', "%$keyword%")
                ->orWhere('link', 'LIKE', "%$keyword%")
                ->orWhere('deleted_at', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $events = Event::latest()->paginate($perPage);
        }

        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('events.create');
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required',
            'link' => 'required',
            'status' => 'required',
            'sort_order'=>'required',
        ]);
        $requestData = $request->all();
       
         if ($request->hasFile('image')) {
             $files = Input::file('image');    
             $file = $files->getClientOriginalName();

            
            $image_name = $request->file('image')->getRealPath();

            $upload_success = Cloudder::upload($image_name, null, array("folder"=>"swa_cms","use_filename"=>TRUE ,"unique_filename"=>FALSE));
            list($width, $height) = getimagesize($image_name);
            $image_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);
        
            if($upload_success)
            { 
             $requestData['image'] = $image_url;

               $a = Event::create($requestData);  

               if($a)
               { 
                return redirect('events')->with('flash_message', 'Events added!');
               }
               else{
                 return redirect('events')->with('flash_message', 'Something went wrong on banner upload!');
               } 
            }
            else{
                return redirect('events')->with('flash_message', 'Something went wrong on banner upload!');
            }
        }
        else{
            return redirect('events')->with('flash_message', 'Something went wrong on banner upload!');
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
        $event = Event::findOrFail($id);

        return view('events.show', compact('event'));
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
        $event = Event::findOrFail($id);

        return view('events.edit', compact('event'));
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
         $this->validate($request, [
            'title' => 'required',
            'link' => 'required',
            'status' => 'required',
            'sort_order'=>'required',
        ]);
        $requestData = $request->all();
          if ($request->hasFile('image')) {
             $files = Input::file('image');    
             $file = $files->getClientOriginalName();

            
            $image_name = $request->file('image')->getRealPath();

            $upload_success = Cloudder::upload($image_name, null, array("folder"=>"swa_cms","use_filename"=>TRUE ,"unique_filename"=>FALSE));
            list($width, $height) = getimagesize($image_name);
            $image_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);
        
            if($upload_success)
            { 
             $requestData['image'] = $image_url;

               $event = Event::findOrFail($id);
                 $a = $event->update($requestData);  

               if($a)
               { 
                return redirect('events')->with('flash_message', 'HomeBanner added!');
               }
               else{
                 return redirect('events')->with('flash_message', 'Something went wrong on banner upload!');
               } 
            }
            else{
                return redirect('events')->with('flash_message', 'Something went wrong on banner upload!');
            }
        }
        else{
                 $event = Event::findOrFail($id);
                 $a = $event->update($requestData);
                 
               if($a)
               { 
                return redirect('events')->with('flash_message', 'Event Edit Successfully!');
               }
               else{
                 return redirect('events')->with('flash_message', 'Something went wrong on edit banner!');
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
        Event::destroy($id);

        return redirect('events')->with('flash_message', 'Event deleted!');
    }
}
