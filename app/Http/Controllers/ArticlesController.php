<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Cloudder;
use App\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
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
            $articles = Article::where('banner', 'LIKE', "%$keyword%")
                ->orWhere('main_heading', 'LIKE', "%$keyword%")
                ->orWhere('sub_heading', 'LIKE', "%$keyword%")
                ->orWhere('author', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $articles = Article::latest()->paginate($perPage);
        }

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('articles.create');
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
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg', |dimensions:width=1000,height=900 |max:2048
            'main_heading' => 'required',
            'sub_heading' => 'required',
            'author' => 'required|string'
        ]);


     /*   if ($request->hasFile('banner')) {
            $files = Input::file('banner');
            $file = $files->getClientOriginalName();


        /*$image_name = $request->file('banner')->getRealPath();

        $upload_success = Cloudder::upload($image_name, null, array("folder"=>"swa_cms","use_filename"=>TRUE ,"unique_filename"=>FALSE));
        list($width, $height) = getimagesize($image_name);
        $image_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);
*/


    function upload(Request $request)
    {
     $this->validate($request, [
      'select_file'  => 'required|image|mimes:jpg,png,gif|max:2048'
     ]);

     $art_main_banner = $request->file('select_file');

     $new_name = rand() . '.' . $art_main_banner->getClientOriginalExtension();

     $art_main_banner->move(public_path('images'), $new_name);
     return back()->with('success', 'Image Uploaded Successfully')->with('path', $new_name);
    }
}



        if($image_url)
        { 

          $requestData['banner'] =  $img_path;

           //$a = Article::create($requestData);
           //print_r($a);

           if($a)
           {
            return redirect('articles')->with('flash_message', 'Article added!');
           }
           else{
             return redirect('articless')->with('flash_message', 'Something went wrong on article upload!');
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
        $article = Article::findOrFail($id);

        return view('articles.show', compact('article'));
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
        $article = Article::findOrFail($id);

        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id){

    // $this->validate($request, [
    //     'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:width=1000,height=900',
    //     'main_heading' => 'required',
    //     'sub_heading' => 'required',
    //     'author' => 'required|string'
    // ]);
    try{

    $requestData = $request->all();

    if ($request->hasFile('banner')) {
        $files = Input::file('banner');
        $file = $files->getClientOriginalName();


    $image_name = $request->file('banner')->getRealPath();;
    $upload_success = Cloudder::upload($image_name, null, array("folder"=>"swa_cms","use_filename"=>TRUE ,"unique_filename"=>FALSE));
    list($width, $height) = getimagesize($image_name);
    $image_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);

    if($upload_success)
    {
     $requestData['banner'] =  $img_path;

       $a = Article::create($requestData);

       if($a)
       {

        return redirect('articles')->with('flash_message', 'Article added!');
       }
       else{

         return redirect('articless')->with('flash_message', 'Something went wrong on article upload!');
       }
    }
            else{

            }
                return redirect('articles')->with('flash_message', 'Something went wrong on article upload!');
        }
        else{

            return redirect('articles')->with('flash_message', 'Something went wrong on article upload!');
        }
    }catch(\Exception $ex)
    {
        dd($ex);
    }
        }


public function destroy($id)
    {
        //Article::destroy($id);
	  $model = Article::findOrFail($id);
      $img_path = str_replace(env('APP_URL'), "", $model->art_main_banner);
      $model->delete();

        return redirect('articles')->with('flash_message', 'Article deleted!');
    }


}
