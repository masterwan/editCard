<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
}
