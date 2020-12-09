<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Cloudder;
use App\Author;
use Illuminate\Http\Request;

class AuthorsController extends Controller
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
            $authors = Author::where('author_name', 'LIKE', "%$keyword%")
            ->orWhere('author_img_path', 'LIKE', "%$keyword%")
            ->orWhere('author_text', 'LIKE', "%$keyword%")
            ->orWhere('status', 'LIKE', "%$keyword%")
            ->latest()->paginate($perPage);
        } else {
            $authors = Author::latest()->paginate($perPage);
        }

        return view('authors.index', compact('authors'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\View\View
    */
    public function create()
    {
        return view('authors.create');
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
        $this->validate($request,[
            'author_name' => 'required',
            'author_img_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'author_text' => 'required',
            'status' => 'required',
        ]);

        $requestData = $request->all();
        // dd($request->hasFile('author_img_path'));
        if ($request->hasFile('author_img_path')) {
            $files = Input::file('author_img_path');
            $file = $files->getClientOriginalName();


            $image_name = $request->file('author_img_path')->getRealPath();

            $upload_success = Cloudder::upload($image_name, null, array("folder"=>"swa_cms","use_filename"=>TRUE ,"unique_filename"=>FALSE));
            list($width, $height) = getimagesize($image_name);
            $image_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);

            if($s3_path)
            {
                $requestData['author_img_path'] = $img_path;
                $a = Author::create($requestData);

                if($a)
                {
                    return redirect('authors')->with('flash_message', 'Author added!');
                }
                else{
                    return redirect('authors')->with('flash_message', 'Something went wrong on author upload! Err.A');
                }
            }
            else{
                return redirect('authors')->with('flash_message', 'Something went wrong on author upload! Err.B');
            }
        }
        else{
            return redirect('authors')->with('flash_message', 'Something went wrong on author upload! Err.C');
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
        $author = Author::findOrFail($id);

        return view('authors.show', compact('author'));
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
        $author = Author::findOrFail($id);

        return view('authors.edit', compact('author'));
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

        $this->validate($request,[
            'author_name' => 'required',
            'author_text' => 'required',
            'status' => 'required',
        ]);


        if ($request->hasFile('author_img_path'))
        {
            $files = Input::file('author_img_path');
            $file = $files->getClientOriginalName();


            $image_name = $request->file('author_img_path')->getRealPath();
            $upload_success = Cloudder::upload($image_name, null, array("folder"=>"swa_cms","use_filename"=>TRUE ,"unique_filename"=>FALSE));
            list($width, $height) = getimagesize($image_name);
            $image_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);

            if($upload_success)
            {
                $requestData['author_img_path'] = $img_path;

                $author = Author::findOrFail($id);
                $a = $author->update($requestData);

                if($a)
                {
                    return redirect('authors')->with('flash_message', 'Author added!');
                }
                else
                {
                    return redirect('authors')->with('flash_message', 'Something went wrong on author upload!');
                }
            }
            else
            {
                return redirect('authors')->with('flash_message', 'Something went wrong on author upload!');
            }
        }
        else
        {
            $author = Author::findOrFail($id);
            $a = $author->update($requestData);

            if($a)
            {
                return redirect('authors')->with('flash_message', 'Author Edit Successfully!');
            }
            else{
                return redirect('authors')->with('flash_message', 'Something went wrong on edit author!');
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
        // Author::destroy($id);

        $model = Author::findOrFail($id);
        $img_path = str_replace(env('APP_URL'), "", $model->author_img_path);
        $model->delete();

        return redirect('authors')->with('flash_message', 'Author deleted!');
    }


}
