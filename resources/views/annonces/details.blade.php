<!-- resources/views/annonces/details.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Annonce Détail: ' . $annonce->titre) }}
        </h2>
    </x-slot>

    <div class="rounded-lg w-full p-6">
        <h1 class="text-center text-gray-800 text-3xl mb-6">{{ $annonce->titre }}</h1>
        <p>{{ $annonce->description }}</p>

        @if($annonce->image)
            <img src="{{ asset('storage/' . $annonce->image) }}" alt="Image de l'annonce" class="w-full h-48 object-cover mb-6">
        @else
            <img src="https://via.placeholder.com/600x400" alt="Image par défaut" class="w-full h-48 object-cover mb-6">
        @endif

        <!-- Section for displaying comments -->
        <h3 class="text-xl mb-4">Commentaires</h3>
        @foreach($commentaires as $commentaire)
            <div class="mb-4 p-4 border-b">
                <p><strong>{{ $commentaire->user->name }}</strong> a dit:</p>
                <p>{{ $commentaire->contenu }}</p>
            </div>
        @endforeach

        <!-- Form for adding a new comment -->
        @auth
            <form action="{{ route('comments.store', $annonce->id) }}" method="POST" class="mt-6">
                @csrf
                <textarea name="contenu" rows="4" class="w-full border p-2 rounded" placeholder="Ajouter un commentaire..."></textarea>
                <button type="submit" class="mt-2 bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">Ajouter un commentaire</button>
            </form>
        @else
            <p class="mt-4">Veuillez vous <a href="{{ route('login') }}" class="text-blue-600">connecter</a> pour ajouter un commentaire.</p>
        @endauth
    </div>
</x-app-layout>
