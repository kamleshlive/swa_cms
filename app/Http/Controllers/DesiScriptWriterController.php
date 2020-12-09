<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\DesiScriptWriter;
use Cloudder;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class DesiScriptWriterController extends Controller
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
            $desiscriptwriter = DesiScriptWriter::where('title', 'LIKE', "%$keyword%")
                ->orWhere('thumbnail', 'LIKE', "%$keyword%")
                ->orWhere('image', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $desiscriptwriter = DesiScriptWriter::latest()->paginate($perPage);
        }

        return view('desi-script-writer.index', compact('desiscriptwriter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('desi-script-writer.create');
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
			'title' => 'required',
			'image' => 'required',
			'thumbnail' => 'required'
		]);
        $requestData = $request->all();

                if($request->hasFile('image') && $request->hasFile('thumbnail') ) {
                    $files = Input::file('image');
                    $file = $files->getClientOriginalName();

                    $image_name = $request->file('image')->getRealPath();
                    $upload_success = Cloudder::upload($image_name, null, array("folder"=>"swa_cms","use_filename"=>TRUE ,"unique_filename"=>FALSE));
                    list($width, $height) = getimagesize($image_name);
                    $image_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);

                    $popup_files = Input::file('thumbnail');
                    $popup_file = $popup_files->getClientOriginalName();

                    $popup_name = $request->file('thumbnail')->getRealPath();;

                    $upload_success = Cloudder::upload($popup_name, null, array("folder"=>"swa_cms","use_filename"=>TRUE ,"unique_filename"=>FALSE));
                     list($width, $height) = getimagesize($popup_name);
                     $thumbnail_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);


                if($upload_success){
                 $requestData['image'] = $image_url;
                 $requestData['thumbnail'] =$thumbnail_url;
                   $a = DesiScriptWriter::create($requestData);
                   if($a){
                    return redirect('desi-script-writer')->with('flash_message', 'DesiScriptWriter added!');
                   }
                   else{
                     return redirect('desi-script-writer')->with('flash_message', 'Something went wrong on DesiScriptWriter added!!!');
                   }

                }else{
                    return redirect('desi-script-writer')->with('flash_message', 'Something went wrong on DesiScriptWriter added!!!');
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
        $desiscriptwriter = DesiScriptWriter::findOrFail($id);
        return view('desi-script-writer.show', compact('desiscriptwriter'));
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
        $desiscriptwriter = DesiScriptWriter::findOrFail($id);
        return view('desi-script-writer.edit', compact('desiscriptwriter'));
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

		]);
        $requestData = $request->all();

        if ($request->hasFile('image')) {
            $files = Input::file('image');
            $file = $files->getClientOriginalName();

        $image_name = $request->file('image')->getRealPath();
        $upload_success = Cloudder::upload($image_name, null, array("folder"=>"swa_cms","use_filename"=>TRUE ,"unique_filename"=>FALSE));
        list($width, $height) = getimagesize($image_name);
        $image_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);
        $requestData['image'] =  $image_url;
        }

        if ($request->hasFile('thumbnail')) {
            $files = Input::file('thumbnail');
            $file = $files->getClientOriginalName();

        $image_name = $request->file('thumbnail')->getRealPath();
        $upload_success = Cloudder::upload($image_name, null, array("folder"=>"swa_cms","use_filename"=>TRUE ,"unique_filename"=>FALSE));
        list($width, $height) = getimagesize($image_name);
        $image_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);
        $requestData['thumbnail'] =  $image_url;
        }


           $ecommittee = DesiScriptWriter::findOrFail($id);
           $a = $ecommittee->update($requestData);
           if($a){
            return redirect('desi-script-writer')->with('flash_message', 'Desi Script Writer updated!');
           }
           else{
             return redirect('desi-script-writer')->with('flash_message', 'Something went wrong on Desi Script Writer updated!!!');
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
        DesiScriptWriter::destroy($id);

        return redirect('desi-script-writer')->with('flash_message', 'DesiScriptWriter deleted!');
    }
}
