<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Annonces') }}
    </h2>
</x-slot>

<div class="rounded-lg w-full p-6">
    <h1 class="text-center text-gray-800 text-3xl mb-6">Liste des Annonces</h1>

    <a href="{{ route('annonces.create') }}" class="inline-block py-2 px-4 bg-blue-600 text-white rounded-md font-bold mb-6 text-center transition-colors duration-300 hover:bg-blue-700">Créer une annonce</a>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($annonces as $annonce)
            <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:translate-y-[-5px]">
                @if($annonce->image)
                    <img src="{{ asset('storage/' . $annonce->image) }}" alt="Image de l'annonce" class="w-full h-48 object-cover">
                @else
                    <img src="https://via.placeholder.com/600x400" alt="Image par défaut" class="w-full h-48 object-cover">
                @endif
                <div class="p-4">
                    <div class="text-xl font-bold text-gray-800 mb-4">{{ $annonce->titre }}</div>
                    <div class="flex justify-between items-center">
                        <a href="{{ route('annonces.show.details', $annonce->id) }}" class="text-blue-600 font-bold hover:underline">Voir Détails</a> 
                        <a href="{{ route('annonces.edit', $annonce->id) }}" class="text-blue-600 font-bold hover:underline">Modifier</a>
                        <form action="{{ route('annonces.destroy', $annonce->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 transition-colors duration-300">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $annonces->links() }}
    </div>
</div>
</x-app-layout>
