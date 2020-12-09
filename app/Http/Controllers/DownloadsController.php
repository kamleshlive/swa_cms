<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use App\Download;
use Illuminate\Http\Request;

class DownloadsController extends Controller
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
            $downloads = Download::where('title', 'LIKE', "%$keyword%")
            ->orWhere('file', 'LIKE', "%$keyword%")
            ->latest()->paginate($perPage);
        } else {
            $downloads = Download::latest()->paginate($perPage);
        }

        return view('downloads.index', compact('downloads'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\View\View
    */
    public function create()
    {
        return view('downloads.create');
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
            // 'file' => 'required|mimes:doc,pdf,docx|max:20000',
             'order'=>"required",
        ]);

        $requestData = $request->all();
        $files = Input::file('file');
        $file = $files->getClientOriginalName();
        $destinationPath = 'uploads';
        $upload_success = Input::file('file')->move($destinationPath, $file);

        if($upload_success)
        {
            $requestData['file'] = $file;
            $a = Download::create($requestData);

            if($a)
            {
                return redirect('downloads')->with('flash_message', 'Download added!');
            }
        }

            return redirect('downloads')->with('flash_message', 'Something went wrong on file upload!');
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
        $download = Download::findOrFail($id);

        return view('downloads.show', compact('download'));
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
        $download = Download::findOrFail($id);

        return view('downloads.edit', compact('download'));
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
            // 'file' => 'required|mimes:doc,pdf,docx|max:10000',
            'title'=>'required|max:50',
            'order'=>"required",
        ]);

        $requestData = $request->all();
        $requestData['file'] = $request->file('file')->store('uploads', 'public');

        $download = Download::findOrFail($id);
        $download->update($requestData);

        return redirect('downloads')->with('flash_message', 'Download updated!');
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
        Download::destroy($id);

        return redirect('downloads')->with('flash_message', 'Download deleted!');
    }
}
