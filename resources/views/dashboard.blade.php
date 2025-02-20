<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}

                    <!-- Cards for Stats -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                        <!-- Annonces Stat -->
                        <div class="bg-blue-600 text-white p-6 rounded-lg shadow-md flex items-center justify-between">
                            <div>
                                <p class="text-lg font-bold">Annonces</p>
                                <p class="text-2xl">{{ $annoncesCount }}</p>
                            </div>
                            <div class="text-3xl">
                                <i class="fas fa-bullhorn"></i>
                            </div>
                        </div>

                        <!-- Categories Stat -->
                        <div class="bg-green-600 text-white p-6 rounded-lg shadow-md flex items-center justify-between">
                            <div>
                                <p class="text-lg font-bold">Categories</p>
                                <p class="text-2xl">{{ $categoriesCount }}</p>
                            </div>
                            <div class="text-3xl">
                                <i class="fas fa-tags"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Links for Announcements and Categories -->
                    <div class="mt-6 space-y-4">
                        <a href="{{ route('annonces.index') }}" class="text-blue-600 hover:underline">Voir les Annonces</a>
                        <a href="{{ route('categories.index') }}" class="text-blue-600 hover:underline">Voir les Categories</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
