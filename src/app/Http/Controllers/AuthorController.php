<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Models\Author; #このモデル使うよ、宣言
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        // $authors = Author::all();
        // $authors = Author::simplePaginate(4);
        $authors = Author::Paginate(4);
        // dd($authors);
        return view('index', ['authors' => $authors]); #View 側で $authors という変数が使える
    }

    public function find()
    {
        return view('find', ['input' => '']);
    }
    public function search(Request $request)
    {
        $item = Author::where('name', 'LIKE',"%{$request->input}%")->first();
        $param = [
            'input' => $request->input,
            'item' => $item,
        ];
        return view('find', $param);
    }

    public function bind(Author $author)
    {
        $data = [
            'item' => $author,
        ];
        return view('author.binds', $data);
    }


    public function add()
    {
        return view('add');
    }
    public function create(AuthorRequest $request)
    {
        $form = $request->all();
        // dd($form);
        Author::create($form);
        return redirect('/');
    }

    public function edit(Request $request)
    {
        $author = Author::find($request->id); #モデルがこのidのデータを探す
        return view('edit', ['form' => $author]);
    }
    public function update(AuthorRequest $request)
    {
        $form = $request->all();
        unset($form['_token']);
        // dd($form);
        Author::find($request->id)->update($form);
        return redirect('/');
    }

    public function delete(Request $request)
    {
        $author = Author::find($request->id);
        return view('delete', ['author' => $author]);
    }
    public function remove(Request $request)
    {
        Author::find($request->id)->delete();
        // dd($request->all());
        return redirect('/');
    }

    public function verror()
    {
        return view('verror');
    }

    // public function relate()
    // {
    //     $items = Author::all();
    //     return view('author.index', ['items' => $items]);
    // }

    public function relate()
    {
        $hasItems = Author::has('book')->get();
        $noItems = Author::doesntHave('book')->get();
        $param = ['hasItem' => $hasItems, 'noItems' => $noItems];
        return view('author.index', $param);
    }
}
