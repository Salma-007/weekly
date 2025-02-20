<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\User; 
use App\Models\Category;
use App\Http\Requests\StoreAnnonceRequest;
use App\Http\Requests\UpdateAnnonceRequest;
use Illuminate\Support\Facades\Storage;


class AnnonceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $annonces = Annonce::paginate(4);
        return view('annonces.index', compact('annonces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $categories = Category::all();
        return view('annonces.create', compact('users', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnnonceRequest $request)
    {
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('annonces', 'public'); 
        } else {
            $imagePath = null;
        }
    
        Annonce::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'image' => $imagePath,
            'user_id' => auth()->id(),
            'categorie_id' => $request->categorie_id,
            'status' => $request->status,
        ]);
    
        return redirect()->route('annonces.index');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Annonce $annonce)
    {
        return view('annonces.show', compact('annonce'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Annonce $annonce)
    {
        $users = User::all();
        $categories = Category::all();
        return view('annonces.edit', compact('annonce', 'users', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnnonceRequest $request, Annonce $annonce)
    {
    
        $imagePath = $annonce->image;
        if ($request->hasFile('image')) {
            if ($imagePath) {
                Storage::delete($imagePath);
            }
            $imagePath = $request->file('image')->store('annonces', 'public'); 
        }
    
        $annonce->update([
            'titre' => $request->titre,
            'description' => $request->description,
            'image' => $imagePath,
            'categorie_id' => $request->categorie_id,
            'status' => $request->status,
        ]);
    
        return redirect()->route('annonces.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Annonce $annonce)
    {
        if ($annonce->image) {
            Storage::delete($annonce->image);
        }
    
        $annonce->delete();
    
        return redirect()->route('annonces.index');
    }
}
