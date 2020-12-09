<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Cloudder;
use App\LatestVideo;
use Illuminate\Http\Request;

class LatestVideosController extends Controller
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
            $latestvideos = LatestVideo::where('video_text', 'LIKE', "%$keyword%")
                ->orWhere('video_link', 'LIKE', "%$keyword%")
                ->orWhere('image', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orWhere('sort_order', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $latestvideos = LatestVideo::latest()->paginate($perPage);
        }

        return view('latest-videos.index', compact('latestvideos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('latest-videos.create');
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
            'video_text' => 'required',
            'video_link' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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

            if($image_url)
            {
             $requestData['image'] = $img_path;

               $a = LatestVideo::create($requestData);

               if($a)
               {
                return redirect('latest-videos')->with('flash_message', 'LatestVideo added!');
               }
               else{
                 return redirect('latest-videos')->with('flash_message', 'Something went wrong on banner upload!');
               }
            }
            else{
                return redirect('latest-videos')->with('flash_message', 'Something went wrong on banner upload!');
            }
        }
        else{
            return redirect('latest-videos')->with('flash_message', 'Something went wrong on banner upload!');
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
        $latestvideo = LatestVideo::findOrFail($id);

        return view('latest-videos.show', compact('latestvideo'));
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
        $latestvideo = LatestVideo::findOrFail($id);

        return view('latest-videos.edit', compact('latestvideo'));
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
            'video_text' => 'required',
            'video_link' => 'required',
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

            if($s3_path)
            {
             $requestData['image'] = $img_path;

               $latestvideo = LatestVideo::findOrFail($id);
               $img_path = str_replace(env('APP_URL'), "", $latestvideo->image);
               
               $a = $latestvideo->update($requestData);

               if($a)
               {
                return redirect('latest-videos')->with('flash_message', 'LatestVideo added!');
               }
               else{
                 return redirect('latest-videos')->with('flash_message', 'Something went wrong on banner upload!');
               }
            }
            else{
                return redirect('latest-videos')->with('flash_message', 'Something went wrong on banner upload!');
            }
        }
        else{
               $latestvideo = LatestVideo::findOrFail($id);
               $a = $latestvideo->update($requestData);

               if($a)
               {
                return redirect('latest-videos')->with('flash_message', 'LatestVideo Edit Successfully!');
               }
               else{
                 return redirect('latest-videos')->with('flash_message', 'Something went wrong on edit banner!');
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
        //LatestVideo::destroy($id);

        $model = LatestVideo::findOrFail($id);
        $img_path = str_replace(env('APP_URL'), "", $model->image);
        $model->delete();

        return redirect('latest-videos')->with('flash_message', 'LatestVideo deleted!');
    }


}
