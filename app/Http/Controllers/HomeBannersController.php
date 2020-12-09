<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use App\HomeBanner;
use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;

class HomeBannersController extends Controller
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
            $homebanners = HomeBanner::where('title', 'LIKE', "%$keyword%")
                ->orWhere('image', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orWhere('sort_order', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $homebanners = HomeBanner::latest()->paginate($perPage);
        }

        return view('home-banners.index', compact('homebanners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('home-banners.create');
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',//|max:2048|dimensions:width=1920,height=800',
            'status' => 'required',
            'sort_order'=>'required',
        ]);

        $requestData = $request->all();
        $requestData['link'] = urlencode($requestData['link']);

            if ($request->hasFile('image')) {
             $files = Input::file('image');
             $file = $files->getClientOriginalName();


            $image_name = $request->file('image')->getRealPath();
            $upload_success = Cloudder::upload($image_name, null, array("folder"=>"swa_cms","use_filename"=>TRUE ,"unique_filename"=>FALSE));
            list($width, $height) = getimagesize($image_name);
            $image_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);
            // print_r($image_url);
            // die();

            if($image_url)

               
            {
                 $image_url='';

             $requestData['image'] = $img_path;

               $a = HomeBanner::create($requestData);

               if($a)
               {
                return redirect('home-banners')->with('flash_message', 'HomeBanner added!');
               }
               else{
                 return redirect('home-banners')->with('flash_message', 'Something went wrong on banner upload!');
               }
            }
            else{
                return redirect('home-banners')->with('flash_message', 'Something went wrong on banner upload!');
            }
        }
        else{
            return redirect('home-banners')->with('flash_message', 'Something went wrong on banner upload!');
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
        $homebanner = HomeBanner::findOrFail($id);

        return view('home-banners.show', compact('homebanner'));
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
        $homebanner = HomeBanner::findOrFail($id);

        return view('home-banners.edit', compact('homebanner'));
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
        $requestData['link'] = htmlentities($requestData['link']);
        if ($request->hasFile('image')) {
            $files = Input::file('image');
             $file = $files->getClientOriginalName();


            $image_name = $request->file('image')->getRealPath();
            $upload_success = Cloudder::upload($image_name, null, array("folder"=>"swa_cms","use_filename"=>TRUE ,"unique_filename"=>FALSE));
            //dump($image_name);

            list($width, $height) = getimagesize($image_name);
            $image_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);

            if($image_url)
            {
              $image_url='';
             $requestData['image'] = $img_path;

               $homebanner = HomeBanner::findOrFail($id);
               $img_path = str_replace(env('APP_URL'), "", $homebanner->image);
               
                 $a = $homebanner->update($requestData);

               if($a)
               {
                return redirect('home-banners')->with('flash_message', 'HomeBanner added!');
               }
               else{
                 return redirect('home-banners')->with('flash_message', 'Something went wrong on banner upload!');
               }
            }
            else{
                return redirect('home-banners')->with('flash_message', 'Something went wrong on banner upload!');
            }
        }
        else{
                 $homebanner = HomeBanner::findOrFail($id);
                 $a = $homebanner->update($requestData);


               if($a)
               {
                return redirect('home-banners')->with('flash_message', 'HomeBanner Edit Successfully!');
               }
               else{
                 return redirect('home-banners')->with('flash_message', 'Something went wrong on edit banner!');
               }
        }

        return redirect('home-banners')->with('flash_message', 'HomeBanner updated!');
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
      //HomeBanner::destroy($id);
      $model = HomeBanner::findOrFail($id);
      $img_path = str_replace(env('APP_URL'), "", $model->image);
      $model->delete();
      return redirect('home-banners')->with('flash_message', 'HomeBanner deleted!');
    }

}
