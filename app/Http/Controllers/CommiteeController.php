<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Commitee;
use Illuminate\Http\Request;

class CommiteeController extends Controller
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
            $commitee = Commitee::where('name', 'LIKE', "%$keyword%")
                ->orWhere('parent_id', 'LIKE', "%$keyword%")
                ->orWhere('about', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orWhere('sort_order', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $commitee = Commitee::latest()->paginate($perPage);
        }

        return view('commitee.index', compact('commitee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $parent_commitee = Commitee::where('status','=','1')->where('parent_id','=','0')->get();
        return view('commitee.create',compact('parent_commitee'));
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
			'name' => 'required'
		]);
        $requestData = $request->all();

        Commitee::create($requestData);

        return redirect('commitee')->with('flash_message', 'Commitee added!');
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
        $commitee = Commitee::findOrFail($id);

        return view('commitee.show', compact('commitee'));
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
        $commitee = Commitee::findOrFail($id);
        $parent_commitee = Commitee::where('status','=','1')->where('parent_id','=','0')->get();

        return view('commitee.edit', compact('commitee','parent_commitee'));
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
			'name' => 'required'
		]);
        $requestData = $request->all();

        $commitee = Commitee::findOrFail($id);
        $commitee->update($requestData);

        return redirect('commitee')->with('flash_message', 'Commitee updated!');
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
        Commitee::destroy($id);

        return redirect('commitee')->with('flash_message', 'Commitee deleted!');
    }
}
