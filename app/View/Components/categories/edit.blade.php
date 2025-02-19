<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une Catégorie</title>
</head>
<body>
    <h1>Modifier la Catégorie</h1>
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Nom de la catégorie:</label>
        <input type="text" name="name" id="name" value="{{ $category->name }}" required>
        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>
