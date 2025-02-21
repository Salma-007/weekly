<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Toutes les Annonces') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="space-y-8">
            @foreach($annonces as $annonce)
                <article class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                    <!-- En-tête de l'annonce -->
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-4">
                                <div class="text-sm">
                                    <p class="text-gray-500 dark:text-gray-400">
                                        Publié par {{ $annonce->user->name }} · {{ $annonce->created_at->diffForHumans() }}
                                    </p>
                                    <p class="text-gray-500 dark:text-gray-400">
                                        Catégorie: {{ $annonce->categorie->nom }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Contenu de l'annonce -->
                        <div class="flex flex-col md:flex-row gap-6">
                            @if($annonce->image)
                                <div class="md:w-1/3">
                                    <img src="{{ asset('storage/' . $annonce->image) }}" alt="Image de l'annonce" 
                                         class="w-full h-64 object-cover rounded-lg">
                                </div>
                            @endif
                            <div class="md:w-2/3">
                                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
                                    {{ $annonce->titre }}
                                </h2>
                                <p class="text-gray-700 dark:text-gray-300 mb-4">
                                    {{ Str::limit($annonce->description, 250) }}
                                </p>
                                <a href="{{ route('annonces.show', $annonce->id) }}" 
                                   class="inline-flex items-center text-blue-600 hover:text-blue-700">
                                    Lire la suite
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Section commentaires -->
                    <div class="border-t border-gray-200 dark:border-gray-700">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                Commentaires ({{ $annonce->commentaires->count() }})
                            </h3>

                            <!-- Liste des commentaires -->
                            <div class="space-y-4 mb-6">
                                @foreach($annonce->commentaires as $comment)
                                    <div class="flex space-x-4 bg-gray-50 dark:bg-gray-900 rounded-lg p-4">
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between">
                                                <div class="font-medium text-gray-900 dark:text-white">
                                                    {{ $comment->user->name }}
                                                </div>
                                                <div class="flex items-center space-x-2">
                                                    <span class="text-sm text-gray-500 dark:text-gray-400">
                                                        {{ $comment->created_at->diffForHumans() }}
                                                    </span>
                                                    @if(auth()->check() && $comment->user_id === auth()->id())
                                                        <form action="{{ route('commentaires.destroy', $comment->id) }}" 
                                                              method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-600 hover:text-red-800">
                                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                                                          stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                            <p class="mt-2 text-gray-700 dark:text-gray-300">{{ $comment->contenu }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Formulaire d'ajout de commentaire -->
                            <form action="{{ route('commentaires.store', $annonce->id) }}" method="POST" class="mt-6">
                                @csrf
                                <input type="hidden" name="annonce_id" value="{{ $annonce->id }}">
                                <div class="mb-4">
                                    <textarea name="contenu" rows="3" 
                                              class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg 
                                                     focus:ring-2 focus:ring-blue-500 focus:border-transparent 
                                                     dark:bg-gray-700 dark:text-white" 
                                              placeholder="Écrivez un commentaire..."></textarea>
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit" 
                                            class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 
                                                   text-white font-medium rounded-lg transition-colors duration-300">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                        Ajouter un commentaire
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $annonces->links() }}
        </div>
    </div>
</x-app-layout>
