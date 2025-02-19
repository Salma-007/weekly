<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Voir une Catégorie</title>
</head>
<body>
    <h1>{{ $category->name }}</h1>
    <a href="{{ route('categories.index') }}">Retour à la liste</a>
</body>
</html>
