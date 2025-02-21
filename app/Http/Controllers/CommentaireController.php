<?php

// App\Http\Controllers\CommentaireController.php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Annonce;
use Illuminate\Http\Request;

class CommentaireController extends Controller
{
    public function store(Request $request, Annonce $annonce)
    {
        $request->validate([
            'contenu' => 'required|string|max:500',
        ]);

        Commentaire::create([
            'contenu' => $request->contenu,
            'annonce_id' => $annonce->id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('annonces.show.details', $annonce->id);
    }
}


