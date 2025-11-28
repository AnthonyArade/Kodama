<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Livre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LivreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();


        $livres = Livre::all();
        $featuredLivres = Livre::orderBy('date_sortie', 'desc')->take(4)->get();
        return view('livre.index', compact('livres', 'featuredLivres', 'categories'));
    }

    public function byCategory($category)
    {
        //recupere les livres par category par le model livre

        $livres = Livre::where('category_id', $category->id)->get();
        return view('category', compact('livres'));
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $livre = Livre::findOrFail($id);
        return view('show', compact('livre'));
    }
}
