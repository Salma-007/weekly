<!-- resources/views/annonces/details.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Annonce Détail: ' . $annonce->titre) }}
        </h2>
    </x-slot>

    <div class="rounded-lg w-full p-6 max-w-4xl mx-auto bg-white shadow-lg">
        <h1 class="text-center text-gray-800 text-3xl mb-6">{{ $annonce->titre }}</h1>
        <p class="text-gray-600 mb-6">{{ $annonce->description }}</p>

        @if($annonce->image)
            <img src="{{ asset('storage/' . $annonce->image) }}" alt="Image de l'annonce" class="w-full h-64 object-cover mb-6 rounded-lg">
        @else
            <img src="https://via.placeholder.com/600x400" alt="Image par défaut" class="w-full h-64 object-cover mb-6 rounded-lg">
        @endif

        <!-- Section Commentaires -->
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Commentaires</h3>

        @foreach($commentaires as $commentaire)
            <div class="mb-4 p-4 border border-gray-300 rounded-lg shadow-sm">
                <p class="text-gray-800 font-medium">{{ $commentaire->user->name }}</p>
                <p class="text-gray-600">{{ $commentaire->contenu }}</p>

                @auth
                    @if($commentaire->user_id == auth()->id())
                        <!-- Icône de suppression pour le commentaire -->
                        <form action="{{ route('comments.destroy', $commentaire->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800" title="Supprimer">
                                <i class="fas fa-trash-alt"></i> Supprimer
                            </button>
                        </form>
                    @endif
                @endauth
            </div>
        @endforeach

        <div class="mt-6">
            {{ $commentaires->links() }}
        </div>

        @auth
            <form action="{{ route('comments.store', $annonce->id) }}" method="POST" class="mt-6">
                @csrf
                <textarea name="contenu" rows="4" class="w-full border p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Ajouter un commentaire..."></textarea>
                <button type="submit" class="mt-2 bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700 transition-colors duration-200">Ajouter un commentaire</button>
            </form>
        @else
            <p class="mt-4 text-gray-600">Veuillez vous <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800">connecter</a> pour ajouter un commentaire.</p>
        @endauth
    </div>
</x-app-layout>
