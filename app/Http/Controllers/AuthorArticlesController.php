<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Author;
use App\Category;
use App\AuthorArticle;
use Illuminate\Http\Request;
use Cloudder;

use Input;

class AuthorArticlesController extends Controller
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
            $articles = AuthorArticle::where('art_main_heading', 'LIKE', "%$keyword%")
                ->orWhere('art_sub_heading', 'LIKE', "%$keyword%")
                ->orWhere('art_author_id', 'LIKE', "%$keyword%")
                ->orWhere('art_contect', 'LIKE', "%$keyword%")
                ->orWhere('art_date', 'LIKE', "%$keyword%")
                ->orWhere('art_category_id', 'LIKE', "%$keyword%")
                ->orWhere('view', 'LIKE', "%$keyword%")
                ->orWhere('publish', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);

        } else {
            $articles = AuthorArticle::latest()->paginate($perPage);
            // dd($articles);
        }

        return view('author-articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        return view('author-articles.create');
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
            'art_main_heading' => 'required',
            'art_sub_heading' => 'required',
            'art_content' => 'required',
            'art_main_banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);
     
        $requestData = $request->all();

        if ($request->hasFile('art_main_banner')) {
         $files = Input::file('art_main_banner');
         $file = $files->getClientOriginalName();
         $requestData['art_date'] = date("Y-m-d H:i:s");
         $image_name = $request->file('art_main_banner')->getRealPath();
         // print_r($requestData);
         //  die();
        



            


         $uploaddir = 'articles/';
         $uploadfile = $uploaddir . basename($_FILES['art_main_banner']['name']);
         move_uploaded_file($_FILES['art_main_banner']['tmp_name'], $uploadfile);
         $url =url('/');
         $save_image=$url.'/'.$uploadfile;
          
        // upload cloudinary images code

        /*$upload_success = Cloudder::upload($image_name, null, array("folder"=>"swa_cms","use_filename"=>TRUE ,"unique_filename"=>FALSE));
        list($width, $height) = getimagesize($image_name);
        $image_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);    */
        


        if($save_image)
        {
          
         $requestData['art_main_banner'] = $save_image;


           $a = AuthorArticle::create($requestData);

           if($a)
           {
            return redirect('author-articles')->with('flash_message', 'Article added!');
           }
           else{
             return redirect('author-articles')->with('flash_message', 'Something went wrong on article upload!');
           }
        }
        else{
            return redirect('author-articles')->with('flash_message', 'Something went wrong on banner upload!');
        }
    }
    else{
        return redirect('author-articles')->with('flash_message', 'Something went wrong on banner upload!');
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
        $article = AuthorArticle::findOrFail($id);
        

        return view('author-articles.show', compact('article'));
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
        $article = AuthorArticle::findOrFail($id);
        // print_r($article);
        // die();

        return view('author-articles.edit', compact('article'));
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
            'art_main_heading' => 'required',
            'art_sub_heading' => 'required',
            'art_content' => 'required',
            //'art_main_banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);
     


        // dd($request->all());
        $requestData = $request->all();

        
        if ($request->hasFile('art_main_banner')) {

         $files = Input::file('art_main_banner');
         $file = $files->getClientOriginalName();
         $image_name = $request->file('art_main_banner')->getRealPath();
         
         
       
         $url =url('/');
         $uploaddir = 'articles/';
         $uploadfile = $uploaddir . basename($_FILES['art_main_banner']['name']);
		 $save_image=$url.'/'.$uploadfile;
         $update_img=move_uploaded_file($_FILES['art_main_banner']['tmp_name'], $uploadfile);
         var_dump($save_image);
         //die();

         // if(storage_path::exists('save_image')){
         //    storage_path::delete('save_image'); }

         
 //        if (File_exists($save_image)) {
 //              unlink($save_image);
              
 // }
 //   parent::delete();

         // $image_delete = ROOT_PATH . $folder_upload . pathinfo($image['image'], PATHINFO_BASENAME);

         // if (!empty($uploadfile['art_main_banner'])) {

         //   if (unlink($uploadfile)) 

         //   { 
         //    echo "<b>{$uploadfile}</b> has been deleted";                                   
         //    } else {
         //       echo "<b>{$uploadfile}</b> error deleting ";                                          
         //      }

         //   } else {
         //    echo "File image not exist";

         //   }
       
    
            
		 //unlink(save_image() . $url->file);
         
          //print_r($save_image);
         // die();
         // $image_url=show(getPublicId(), ["width" => $width, "height"=>$height]);

        // upload cloudinary images code
        /*
        $upload_success = Cloudder::upload($image_name, null, array("folder"=>"swa_cms","use_filename"=>TRUE ,"unique_filename"=>FALSE));
        list($width, $height) = getimagesize($image_name);
        $image_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);
          */
        //$file = $files->getClientOriginalName();


        if($update_img)
        {
         $requestData['art_main_banner'] = $save_image;

             $article = AuthorArticle::findOrFail($id);

             $save_image = str_replace(env('APP_URL'), "", $article->art_main_banner);
           
             $a = $article->update($requestData);
         

           if($a)
           {
                return redirect('author-articles')->with('flash_message', 'Article updated!');
           }
  
           else{

             return redirect('author-articles')->with('flash_message', 'Something went wrong on article upload!');
           }
        }
        else{

            return redirect('author-articles')->with('flash_message', 'Nothing is updated ');
        }
    }
    else{
		
        $article = AuthorArticle::findOrFail($id);
        $a = $article->update($requestData);

        return redirect('author-articles')->with('flash_message', 'Article updated successfully!');
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
        // AuthorArticle::destroy($id);

        $model = AuthorArticle::findOrFail($id);
        $img_path = str_replace(env('APP_URL'), "", $model->art_main_banner);
        $model->delete();


        return redirect('author-articles')->with('flash_message', 'Article deleted!');
    }



}
