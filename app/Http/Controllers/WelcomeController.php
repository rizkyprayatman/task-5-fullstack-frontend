<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articles;
use Illuminate\Support\Facades\Storage;

class WelcomeController extends Controller
{
    public function index()
    {
        $articles = Articles::paginate(5);
        return view('welcome', compact('articles'));
    }

    public function show($id)
    {
        $articles = Articles::where('id', $id)->first();
        abort_unless($articles, 404, 'Project not found');
        return view('article', compact('articles'));
    }
    
}
