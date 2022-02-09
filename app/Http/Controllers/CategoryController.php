<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Main;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryModel = Category::where('user_id', Auth::id())->paginate(10);
        return view('category.index', ['categoryModel' => $categoryModel]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type_id' => 'required',
            'title' => 'string'
        ]);

        $categoryModel = new Category;
        $categoryModel->type_id = $request->input('type_id');
        $categoryModel->title = $request->input('title');
        $categoryModel->user_id = Auth::id();
        $categoryModel->save();

        return redirect()->route('home.category.index')->with('success', 'Категория создана');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'string'
        ]);

        $catModel = Category::find($id);
        $catModel->title = $request->input('title');
        $catModel->save();

        return redirect()->route('home.category.index')->with('success', 'Категория успешно была изменена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mainModel = Main::where("category_id", $id)->get();
        if($mainModel->count() > 0) {
            return redirect()->route('home.category.index')->with('error', 'Невозможно удалить категорию, потому что она используется');
        } else {
            $delete = Category::destroy($id);
            return redirect()->route('home.category.index')->with('success', 'Категория успешно удалена');
        }
    }
}
