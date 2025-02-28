
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une Annonce</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 800px;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .back-button {
            background-color: #dc3545;
            margin-top: 10px;
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            border-radius: 5px;
        }

        .back-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Créer une Annonce</h1>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 20px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('annonces.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="titre">Titre</label>
        <input type="text" id="titre" name="titre" value="{{ old('titre') }}" required>

        <label for="description">Description</label>
        <textarea id="description" name="description" required>{{ old('description') }}</textarea>

        <label for="image">Image</label>
        <input type="file" id="image" name="image">

        <label for="categorie_id">Catégorie</label>
        <select id="categorie_id" name="categorie_id" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('categorie_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->nom }}
                </option>
            @endforeach
        </select>
        
        <label for="status">Statut</label>
        <select id="status" name="status" required>
            <option value="actif" {{ old('status') == 'actif' ? 'selected' : '' }}>Actif</option>
            <option value="brouillon" {{ old('status') == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
            <option value="archivé" {{ old('status') == 'archivé' ? 'selected' : '' }}>Archivé</option>
        </select>

        <button type="submit">Créer l'annonce</button>
    </form>

    <a href="{{ route('annonces.index') }}" class="back-button">Retour à la liste</a>
</div>

</body>
</html>

