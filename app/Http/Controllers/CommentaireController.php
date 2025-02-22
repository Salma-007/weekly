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
    public function destroy($id)
    {
        // Récupérer le commentaire par son ID
        $commentaire = Commentaire::findOrFail($id);

        // Vérifier si l'utilisateur authentifié est celui qui a écrit le commentaire
        if ($commentaire->user_id != auth()->id()) {
            return redirect()->back()->with('error', 'Vous ne pouvez supprimer que vos propres commentaires.');
        }

        // Supprimer le commentaire
        $commentaire->delete();

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Commentaire supprimé avec succès.');
    }
}


