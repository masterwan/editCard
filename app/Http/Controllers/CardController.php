<?php

namespace App\Http\Controllers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $wear_id = $request->get('id');
        $category_id = $request->get('category');

        $categories = DB::table('wear_category')->orderBy('name')->get();

        $wears = DB::table('wear')
            ->where('dress_mode', '>',0)
            ->where(function($query) use ($wear_id){ if(isset($wear_id)) $query->where('id', $wear_id);})
            ->where(function($query) use ($category_id){ if(isset($category_id)) $query->where('wear_category_id', $category_id);})
            ->paginate(12);

        return view('index.cards.index', [
                                                'search_data' => ['wear_id' => $wear_id, 'cetegory_id' => $category_id],
                                                'wears' => $wears->appends($request->input()),
                                                'categories' => $categories,
                                                ]);
    }

    public function edit($id)
    {
        $wear = DB::table('wear')->where('id', $id)->first();
        $category_id = $wear->wear_category_id;
        $sex = DB::table('wear_category')->where('id', $category_id)->first();

        if (@is_array(getimagesize($wear->image_url))) $img_exist = True;
        else $img_exist = False;

        return view('index.cards.edit', ['wear' => $wear, 'sex' => $sex->sex_id, 'img_exist' => $img_exist]);
    }

    public function downloadImage($id)
    {
        $file = new Filesystem;
        $file->cleanDirectory('images/temp');

        $wear_image = DB::table('wear')->where('id', $id)->first()->image_url;

        if (@is_array(getimagesize($wear_image))) {
            $img_bin = file_get_contents($wear_image);
            $img_array = explode('/', $wear_image);
            $img_name = array_pop($img_array);
            $save_img_path = 'images/temp/' . $img_name;
            file_put_contents($save_img_path, $img_bin);

            return \Response::download($save_img_path);
        }

        return back();
    }

    public function uploadImage($id)
    {
        $wear_image = DB::table('wear')->where('id', $id)->first()->image_url;
        $img_array = explode('/', $wear_image);
        $img_name = array_pop($img_array);

        request()->validate(['wear_image' => 'required|image|mimes:png']);

        \File::delete(public_path('images/api/wear/original/' . $img_name));

        $img = request()->wear_image;
//        $img_name = $img->getClientOriginalName();
        $img->move(public_path('images\api\wear\original'), $img_name);

        return back()
            ->with('success','You have successfully upload image.');
    }
}
