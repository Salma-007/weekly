<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afficher l'Annonce</title>

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

        .back-button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
            display: inline-block;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>{{ $annonce->titre }}</h1>
    <p>{{ $annonce->description }}</p>
    @if($annonce->image)
        <img src="{{ Storage::url($annonce->image) }}" alt="Image de l'annonce" style="width: 100%; height: auto;">
    @endif

    <div>
        <strong>Catégorie:</strong> {{ $annonce->categorie->nom }}
    </div>
    <div>
        <strong>Statut:</strong> {{ ucfirst($annonce->status) }}
    </div>

    <a href="{{ route('annonces.index') }}" class="back-button">Retour à la liste</a>
</div>

</body>
</html>
