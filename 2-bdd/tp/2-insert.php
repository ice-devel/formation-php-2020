<?php
    // récupérer toutes les catégories pour pouvoir les afficher dans le formulaire
    $pdo = new PDO("mysql:host=localhost;dbname=formation_202008", "root");
    $sql = "SELECT * FROM category";
    $stmt = $pdo->query($sql);
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 1 - formulaire soumis ?
    if (isset($_POST['btn-product'])) {
        // 2 - récupération
        $code = filter_input(INPUT_POST, 'code');
        $name = filter_input(INPUT_POST, 'name');
        $price = filter_input(INPUT_POST, 'price');
        $category = filter_input(INPUT_POST, 'category');;

        // 3 - vérifications
        $errors = [];

        if ($name == "" || mb_strlen($name) > 50) {
            $errors['name'] = "Le nom est obligatoire et doit faire max 50 carac.";
        }

        if ($code == "" || !preg_match("/^[A-Z]{3}-[0-9]{3}$/", $code)) {
            $errors['strength'] = "Code produit invalide";
        }

        if ($price == "" || !preg_match("/^\d{1,3}(.\d{1,2})?$/", $price)) {
            $errors['strength'] = "Prix invalide";
        }

        // on a choisi une équipe ?
        if ($category != "") {
            // est-ce que l'équipe en base ?
            $categoryExist = false;
            foreach ($categories as $c) {
                if ($c['id'] == $category) {
                    $categoryExist = true;
                }
            }
            if ($categoryExist == false) {
                $errors[] = "la catégorie n'existe pas";
            }
        }

        // 4 - si pas d'erreur, requete
        if (empty($errors)) {
            // 5 - enregistrement en bdd
            // 1 - connexion bdd
            //$pdo = new PDO("mysql:host=localhost;dbname=formation_202008", "root");
            // 2 - requete sql
            $query = "INSERT INTO product (code, name, price, created_at, category_id)
                      VALUES (:code, :name, :price, :createdAt, :category)";
            // 3 - preparation
            $stmt = $pdo->prepare($query);
            $result = $stmt->execute([
                ':code' => $code,
                ':name' => $name,
                ':price' => $price,
                ':createdAt' => date('Y-m-d H:i:s'),
                ':category' => $category != "" ? $category : null
            ]);

            if ($result) {
                // rediriger vers la liste
                header('Location: 1-list.php?created-article');
                exit;
            }
        }
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
    if (isset($errors)) {
        foreach ($errors as $error) {
            echo $error."<br>";
        }
    }
?>
<form method="post">
    <input type="text" name="code" placeholder="Code" />
    <input type="text" name="name" placeholder="Nom"/>
    <input type="number" name="price" placeholder="Price" step="0.01"/>
    <select name="category">
        <option></option>
        <?php
            foreach ($categories as $c) {
                echo "<option value='".$c['id']."'>".$c['name']."</option>";
            }
        ?>
    </select>
    <input type="submit" name="btn-product" />
</form>
</body>
</html>
