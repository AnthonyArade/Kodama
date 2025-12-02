<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Livre;
use Illuminate\Http\Request;

class LivreController extends Controller
{
    /**
     * Méthode index()
     * ----------------
     * Cette méthode est appelée lorsque l’on souhaite afficher la page principale
     * listant les livres. Elle joue trois rôles :
     *
     * 1. Récupérer toutes les catégories disponibles via Category::all()
     *    → permet d’afficher des filtres ou des menus de navigation.
     *
     * 2. Récupérer tous les livres avec Livre::all()
     *    → chargement simple, sans pagination (attention si la BDD grossit).
     *
     * 3. Récupérer les 4 livres les plus récents via :
     *      Livre::orderBy('date_sortie', 'desc')->take(4)->get()
     *    → sert à afficher une zone “livres mis en avant” ou “nouveautés”.
     *
     * Une fois les données collectées, elles sont envoyées à la vue
     * 'livre.index' sous forme de variables compactées.
     */
    public function index()
    {
        $categories     = Category::all();
        $livres         = Livre::all();
        $featuredLivres = Livre::orderBy('date_sortie', 'desc')->take(4)->get();
        return view('livre.index', compact('livres', 'featuredLivres', 'categories'));
    }

    /**
     * Méthode store()
     * ----------------
     * Malgré son nom — qui laisserait penser qu’elle crée un livre — cette méthode
     * sert en réalité à afficher une page listant les livres paginés.
     * 
     * PROCESSUS :
     * 1. Création d'une requête Eloquent incluant la relation "category"
     *      → Livre::with('category')
     *    Cela permet d’éviter les requêtes répétées (N+1 problem) dans la vue.
     *
     * 2. Pagination des résultats par 12
     *      → $query->paginate(12)
     *    Adapté pour une page "boutique", "catalogue", etc.
     *
     * 3. Récupération de toutes les catégories pour les filtres.
     *
     * 4. Retour de la vue 'livre.store' avec les livres paginés.
     *
     * REMARQUE :
     * La méthode devrait idéalement être renommée 
     *       store() → list() ou browse()
     * car elle n’effectue aucune création (pas de logique "store").
     */
    public function store(Request $request)
    {
        $query = Livre::with('category');
        $livres     = $query->paginate(12);
        $categories = Category::all();
        return view('livre.store', compact('livres', 'categories'));
    }

    /**
     * Méthode storeByCategory()
     * --------------------------
     * Affiche les livres filtrés par une catégorie spécifique.
     *
     * PARAMÈTRE :
     * - Category $category : Injection automatique d’un modèle Category
     *   grâce au route model binding (Laravel résout l’ID vers un modèle).
     *
     * PROCESSUS :
     * 1. Récupérer les livres dont la colonne "category_id" correspond
     *    à l’ID de la catégorie reçue.
     *
     * 2. Pagination par 12 (affichage sur plusieurs pages si nécessaire).
     *
     * 3. Retour de la vue 'livre.store' avec uniquement les livres filtrés.
     *
     * À NOTER :
     * - La vue ne reçoit pas la liste de TOUTES les catégories ici.
     *   → si la vue les attend, il faudra envoyer $categories.
     */
    public function storeByCategory(Category $category)
    {
        // Récupère les livres appartenant à la catégorie sélectionnée
        $livres = Livre::where('category_id', $category->id)->paginate(12);

        return view('livre.store', compact('livres'));
    }

    /**
     * Méthode show()
     * ---------------
     * Affiche la page détail d’un livre.
     *
     * PROCESSUS :
     * 1. Recherche du livre via findOrFail()
     *      → si l’ID n’existe pas, Laravel renvoie une 404 automatiquement.
     *
     * 2. Sélection de livres similaires :
     *      - même catégorie
     *      - ID différent du livre affiché
     *      - sélection aléatoire (inRandomOrder())
     *      - limite à 4
     *
     *    Cela permet d’afficher une section “Vous aimerez aussi”.
     *
     * 3. Envoi du livre et des suggestions à la vue 'livre.detail'.
     */
    public function show(string $id)
    {
        $livre = Livre::findOrFail($id);

        $featuredLivres = Livre::where('category_id', $livre->category_id)
            ->where('id', '!=', $livre->id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('livre.detail', compact('livre', 'featuredLivres'));
    }
}
