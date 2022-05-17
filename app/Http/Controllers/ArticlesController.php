<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Articles;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Articles::paginate(5);
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articles = Articles::paginate(5);
        $users = User::all();
        $categories = Category::all();
        return view('articles.create', compact('articles', 'users', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'required',
            'category_id' => 'required'
        ]);

        if($request->file('image')) {
            $validateData['image'] = $request->file('image')->store('storage');
        }

        $validateData['user_id'] = auth()->user()->id;

        Articles::create($validateData);

        return redirect('/articles')->with('success', 'Article baru telah di tambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Articles $article)
    {
        return view('articles.edit', [
            'article' => $article,
            'users' => User::all(),
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Articles $article)
    {
        $updateData = [
            'title' => 'required|max:255',
            'content' => 'required',
            'image',
            'category_id' => 'required'
        ];

        $validateData = $request->validate($updateData);
        if($request->file('image')) {
            if($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $imageTitle = $request->title;
            $extension = $request->image->extension();  
            $imageName = $imageTitle . '.' . $extension;
            $validateData['image'] = $request->file('image')->storeAs('storage', $imageName);
        }

        $validateData['user_id'] = auth()->user()->id;

        Articles::where('id', $article->id)->update($validateData);
        return redirect('/articles')->with('success', 'Article berhasil di Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Articles::destroy($id);

        return back()->with('delete', 'Article telah dihapus');
    }
    
}
