<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer une Catégorie</title>
</head>
<body>
    <h1>Créer une Catégorie</h1>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <label for="name">Nom de la catégorie:</label>
        <input type="text" name="name" id="name" required>
        <button type="submit">Créer</button>
    </form>
</body>
</html>
