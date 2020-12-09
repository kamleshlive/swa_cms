<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\MediaCenter;
use Illuminate\Http\Request;

use Cloudder;
use Illuminate\Support\Facades\Input;

class MediaCenterController extends Controller
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
            $mediacenter = MediaCenter::where('title', 'LIKE', "%$keyword%")
                ->orWhere('image', 'LIKE', "%$keyword%")
                ->orWhere('link', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $mediacenter = MediaCenter::latest()->paginate($perPage);
        }

        return view('media-center.index', compact('mediacenter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('media-center.create');
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
			'document' => 'mimes:pdf',
		]);
        $requestData = $request->all();
        if ( $request->hasFile('document')) {
            if( $request->hasFile('document') ) {
              $filename = $this->getFileName($request->document);
            $request->document->move(base_path('public/public/mediadocuments'), $filename);
            $requestData['document'] = $filename;
             }
             $a = MediaCenter::create($requestData);
             if($a){
              return redirect('media-center')->with('flash_message', 'media-center added!');
             }
             else{
               return redirect('media-center')->with('flash_message', 'Something went wrong on media-center!');
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
        $mediacenter = MediaCenter::findOrFail($id);

        return view('media-center.show', compact('mediacenter'));
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
        $mediacenter = MediaCenter::findOrFail($id);
        return view('media-center.edit', compact('mediacenter'));
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
      'document' => 'mimes:pdf',
		]);
        $requestData = $request->all();
          if( $request->hasFile('document') ) {
            $filename = $this->getFileName($request->document);
          $request->document->move(base_path('public/public/mediadocuments'), $filename);
          $requestData['document'] = $filename;
           }
        $mediacenter = MediaCenter::findOrFail($id);
        $mediacenter->update($requestData);
        return redirect('media-center')->with('flash_message', 'Media Center updated!');
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
        MediaCenter::destroy($id);

        return redirect('media-center')->with('flash_message', 'MediaCenter deleted!');
    }

    protected function getFileName($file)
    {
    return str_random(16) . '.' . $file->extension();
    }
}
