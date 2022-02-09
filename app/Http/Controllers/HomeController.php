<?php

namespace App\Http\Controllers;

use App\Models\Main;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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
    public function index()
    {
        $mainModel = Main::with('categories')->orderBy('id', 'desc')->where('user_id', Auth::id())->paginate(7);

        return view('home.index', ['mainModel' => $mainModel]);
    }


    public function search(Request $request)
    {
        $data = $request->validate([
            'search' => 'string'
        ]);

        $categories = Category::where('title', 'like', "%{$data['search']}%")->pluck('id');


        $mainModel = Main::where('user_id', Auth::id())->whereIn('category_id', $categories)->orderBy('id', 'desc')->paginate(7);


        return view('home.index', ['mainModel' => $mainModel]);
    }

    public function stat(Request $request) {
        $data = $request->validate([
            'type_id' => '',
            'date_start' => '',
            'date_end' => '',
        ]);

        if($data['type_id'] == 1) {
            $count = Main::where('user_id', Auth::id())->where('type_id', 1)->whereBetween("date", [$data['date_start'], $data['date_end']])->sum('sum');
            return redirect()->route('home.index')->with('stat', "С {$data['date_start']} до {$data['date_end']} вы заработали $count $");
        } elseif ($data['type_id'] == 2) {
            $count = Main::where('user_id', Auth::id())->where('type_id', 2)->whereBetween("date", [$data['date_start'], $data['date_end']])->sum('sum');
            return redirect()->route('home.index')->with('stat', "С {$data['date_start']} до {$data['date_end']} вы потратили $count $");
        } else {
            $countIncome = Main::where('user_id', Auth::id())->where('type_id', 1)->whereBetween("date", [$data['date_start'], $data['date_end']])->sum('sum');
            $countSpend = Main::where('user_id', Auth::id())->where('type_id', 2)->whereBetween("date", [$data['date_start'], $data['date_end']])->sum('sum');
            $count = $countIncome - $countSpend;
            return redirect()->route('home.index')->with('stat', "С {$data['date_start']} до {$data['date_end']} вы потратили $count $");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories1 = Category::where('user_id', Auth::id())->where('type_id', 1)->get();
        $categories2 = Category::where('user_id', Auth::id())->where('type_id', 2)->get();
        $date_now = Carbon::now()->toDateString();
        return view('home.create', ['date_now' => $date_now, 'categories1' => $categories1, 'categories2' => $categories2]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'type_id' => 'required',
            'category_id' => 'required',
            'date' => 'required',
            'sum' => 'required',
            'comment' => 'max:100'
        ]);

        $prevResult = DB::table('mains')->where('user_id', Auth::id())->orderBy('id', 'desc')->pluck('result')->first();

        $mainModel = new Main();
        $mainModel->type_id = $request->input('type_id');
        $mainModel->category_id = $request->input('category_id');
        $mainModel->date = $request->input('date');
        $mainModel->sum = $request->input('sum');
        $mainModel->comment = $request->input('comment');
        $mainModel->user_id = Auth::id();


        if ($request->input('type_id') == 1) {
            $mainModel->result = $prevResult + $request->input('sum');
        } else if ($request->input('type_id') == 2) {
            $mainModel->result = $prevResult - $request->input('sum');
        }

        $mainModel->save();

        return redirect()->route('home.index')->with('success', 'Добавлена новая запись');
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
        $mainModelData = Main::with('categories')->find($id);
        $categoryModel = Category::where('user_id', Auth::id())->get();
        $date_now = Carbon::now()->toDateString();
        return view('home.edit', ['data' => $mainModelData, 'date_now' => $date_now, 'categoryModel' => $categoryModel]);
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
        $request->validate([
            'type_id' => 'required',
            'category_id' => 'required',
            'date' => 'required',
            'sum' => 'required',
            'comment' => 'max:100'
        ]);


        $mainModel = Main::find($id);
        $mainModel->type_id = $request->input('type_id');
        $mainModel->category_id = $request->input('category_id');
        $mainModel->date = $request->input('date');
        $mainModel->sum = $request->input('sum');
        $mainModel->comment = $request->input('comment');
        $mainModel->save();


        // обновление динамичного result
        $mainDB = DB::table("mains")->where('user_id', Auth::id())->where('deleted_at', null)->where('id', '>=', $id)->get();
        foreach ($mainDB as $key => $el) {
            $mainModel = Main::find($el->id);
            $prevResult = DB::table('mains')->where('user_id', Auth::id())->where('id', '<', $el->id)->where('deleted_at', null)->orderBy('id', 'desc')->pluck('result')->first();
            if ($mainModel->type_id == 1) {
                $mainModel->result = $prevResult + $mainModel->sum;
                $mainModel->save();
            } else if ($mainModel->type_id == 2) {
                $mainModel->result = $prevResult - $mainModel->sum;
                $mainModel->save();
            }
        }


        return redirect()->route("home.index")->with('success', "Данные изменены");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $softDelete = Main::destroy($id);
        // Вытаскивает все данные из таблицы mains пользователя
        $mainModelDB = DB::table('mains')->where('user_id', Auth::id())->get();
        // Вытаскивает первый неудаленный столбец из таблицы mains
        $startModel = DB::table('mains')->where('user_id', Auth::id())->where('deleted_at', null)->first();


        // пересчитывает все result после удаленной строки
        foreach ($mainModelDB as $key => $el) {
            if ($el->id <= $id) {
                continue;
            }
            $mainModel = Main::find($el->id);
            $prevData = DB::table('mains')->where('id', '<', $el->id)->where('deleted_at', null)->orderBy('id', 'desc')->first();
            if ($el->type_id == 1) {
                if ($el->id == $startModel->id) {
                    $mainModel->result = $el->sum;
                } else {
                    $mainModel->result = $prevData->result + $el->sum;
                }
                $mainModel->save();
            } else if ($el->type_id == 2) {
                if ($el->id == $startModel->id) {
                    $mainModel->result = 0 - $el->sum;
                } else {
                    $mainModel->result = $prevData->result - $el->sum;
                }
                $mainModel->save();
            }
        }


        return redirect()->route("home.index")->with("success", "Данные удалены");
    }
}
