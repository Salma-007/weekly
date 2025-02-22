<!-- resources/views/categories/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Catégories') }}
        </h2>
    </x-slot>

    <div class="rounded-lg w-full p-6 max-w-5xl mx-auto bg-white shadow-xl mt-3">
        <!-- Titre de la page -->
        <h1 class="text-center text-gray-800 text-3xl mb-6">Liste des Catégories</h1>

        <!-- Bouton pour créer une catégorie -->
        <a href="{{ route('categories.create') }}" class="inline-block py-2 px-6 bg-blue-600 text-white rounded-lg font-bold mb-6 text-center transition-colors duration-300 hover:bg-blue-700 shadow-md hover:shadow-lg">
            Créer une catégorie
        </a>

        <!-- Liste des catégories -->
        <ul class="list-none p-0 space-y-4">
            @foreach($categories as $category)
                <li class="bg-white p-4 rounded-lg shadow-md flex justify-between items-center hover:shadow-lg transition-shadow duration-300">
                    <span class="text-gray-800 font-medium">{{ $category->nom }}</span>
                    
                    <div class="flex items-center space-x-4">
                        <!-- Lien pour modifier -->
                        <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-600 font-bold hover:underline transition-colors duration-300">Modifier</a>
                        
                        <!-- Formulaire de suppression -->
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 transition-colors duration-300 shadow-sm hover:shadow-md">Supprimer</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
