<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Livre;
use Illuminate\Http\Request;

class LivreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories     = Category::all();
        $livres         = Livre::all();
        $featuredLivres = Livre::orderBy('date_sortie', 'desc')->take(4)->get();
        return view('livre.index', compact('livres', 'featuredLivres', 'categories'));
    }

    public function store(Request $request)
    {
        $query = Livre::with('category');
        $livres     = $query->paginate(12);
        $categories = Category::all();
        return view('livre.store', compact('livres', 'categories'));
    }

    

public function storeByCategory(Category $category)
{
    // Récupère les livres par category
    $livres = Livre::where('category_id', $category->id)->paginate(12);

    // Debug
    // dd($livres);

    return view('livre.store', compact('livres'));
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $livre = Livre::findOrFail($id);
        
        $featuredLivres = Livre::where('category_id', $livre->category_id)
        ->where('id', '!=', $livre->id)
        ->inRandomOrder()
        ->take(4)
        ->get();

        return view('livre.detail', compact('livre'));
    }
}
