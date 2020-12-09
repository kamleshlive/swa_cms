<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Member;
use App\Commitee;
use App\CommiteeMember;
use Cloudder;
use Illuminate\Http\Request;

class MemberController extends Controller
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
            $member = Member::where('name', 'LIKE', "%$keyword%")
                ->orWhere('designation', 'LIKE', "%$keyword%")
                ->orWhere('image', 'LIKE', "%$keyword%")
                ->orWhere('popup_image', 'LIKE', "%$keyword%")
                ->orWhere('popup_text', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orWhere('sort_order', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $member = Member::latest()->paginate($perPage);
        }

        return view('member.index', compact('member'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(){
    $parent_commitee = Commitee::where('status','=','1')->get();
        return view('member.create',compact('parent_commitee'));
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
        if ($request->hasFile('image')) {
            $image_name = $request->file('image')->getRealPath();
            $upload_success = Cloudder::upload($image_name, null, array("folder"=>"swa_cms","use_filename"=>TRUE ,"unique_filename"=>FALSE));
            list($width, $height) = getimagesize($image_name);
            $image_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);
            $requestData['image'] =  $image_url;

          }
        if ($request->hasFile('popup_image')) {
            $popup_name = $request->file('popup_image')->getRealPath();;
            $upload_success = Cloudder::upload($popup_name, null, array("folder"=>"swa_cms","use_filename"=>TRUE ,"unique_filename"=>FALSE));
            list($width, $height) = getimagesize($popup_name);
            $popup_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);
            $requestData['popup_image'] =  $popup_url;
          }

            $member = Member::create($requestData);
            $member->committees()->sync($requestData['commitee_id']);
            return redirect('member')->with('flash_message', 'Member added!');
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
        $member = Member::findOrFail($id);
        $parent_commitee = Commitee::where('status','=','1')->get();
        return view('member.show', compact('member','parent_commitee'));
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
        $member = Member::where('id',$id)->with('committees')->first();

        $parent_commitee = Commitee::where('status','=','1')->get();


        return view('member.edit', compact('member','parent_commitee'));
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

        if ($request->hasFile('image')) {
            $image_name = $request->file('image')->getRealPath();
            $upload_success = Cloudder::upload($image_name, null, array("folder"=>"swa_cms","use_filename"=>TRUE ,"unique_filename"=>FALSE));
            list($width, $height) = getimagesize($image_name);
            $image_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);
            $requestData['image'] =  $image_url;
          }
        if ($request->hasFile('popup_image')) {
            $popup_name = $request->file('popup_image')->getRealPath();;
            $upload_success = Cloudder::upload($popup_name, null, array("folder"=>"swa_cms","use_filename"=>TRUE ,"unique_filename"=>FALSE));
            list($width, $height) = getimagesize($popup_name);
            $popup_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);
            $requestData['popup_image'] =  $popup_url;
          }


        $member = Member::findOrFail($id);
        $member->update($requestData);
        $member->committees()->sync($requestData['commitee_id']);
        return redirect('member')->with('flash_message', 'Member updated!');
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
        Member::destroy($id);

        return redirect('member')->with('flash_message', 'Member deleted!');
    }
}
