<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Annonces</title>

    <style>
        /* Global styles */
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
            width: 90%;
            max-width: 1200px;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        a.button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
            font-weight: bold;
            text-align: center;
            transition: background-color 0.3s;
        }

        a.button:hover {
            background-color: #0056b3;
        }

        /* Card styles */
        .cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s;
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            padding: 15px;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .card-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-actions a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .card-actions button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .card-actions button:hover {
            background-color: #c82333;
        }

        /* Hover effect */
        .card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Liste des Annonces</h1>

    <a href="{{ route('annonces.create') }}" class="button">Créer une annonce</a>

    <div class="cards-container">
        @foreach($annonces as $annonce)
            <div class="card">
                @if($annonce->image)
                    <img src="{{ asset('storage/' . $annonce->image) }}" alt="Image de l'annonce">
                @else
                    <img src="https://via.placeholder.com/600x400" alt="Image par défaut">
                @endif
                <div class="card-body">
                    <div class="card-title">{{ $annonce->titre }}</div>
                    <div class="card-actions">
                        <a href="{{ route('annonces.edit', $annonce->id) }}">Modifier</a>
                        <form action="{{ route('annonces.destroy', $annonce->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

</body>
</html>
