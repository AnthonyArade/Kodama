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

        // Search filter
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'LIKE', "%{$search}%")
                    ->orWhere('auteur', 'LIKE', "%{$search}%");
            });
        }

        // Category filter
        if ($request->has('categories')) {
            $query->whereIn('category_id', $request->categories);
        }

        // Price filter
        if ($request->has('max_price')) {
            $query->where('prix', '<=', $request->max_price);
        }

        // Sorting
        switch ($request->get('sort', 'featured')) {
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'price_low_high':
                $query->orderBy('prix', 'asc');
                break;
            case 'price_high_low':
                $query->orderBy('prix', 'desc');
                break;
            case 'most_liked':
                $query->orderBy('like', 'desc');
                break;
            case 'most_popular':
                // Add your popularity logic here
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $livres     = $query->paginate(12);
        $categories = Category::all();

        return view('livre.store', compact('livres', 'categories'));
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
