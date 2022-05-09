<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    function show()
    {
        $category = Category::all();
        $json = $category->toJson();

        return view('index', compact('json','category'));
    }

    function add(Request $request){

        $request->validate([
            'text' => 'required|max:20'
        ]);

        DB::table('categories')->insert(
            ['text' => $request->text, 'parent' => $request->rodzic]
        );
        return redirect()->back();
    }

    function update(Request $request){

        $request->validate([
            'text' => 'required|max:20'
        ]);
        
        DB::table('categories')
            ->where('id', $request->wezel)
            ->update(['text' => $request->text]);

        return redirect()->back();
    }

    function delete(Request $request){
        DB::table('categories')->where('id', '=', $request->wezel)->delete();
        return redirect()->back();
    }


}
