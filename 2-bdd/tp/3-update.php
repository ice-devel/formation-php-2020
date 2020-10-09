<?php
    /**
     *  UPDATE
     */
    /*
   *
   * Récap
   * Il faut mettre un moyen d'arriver sur cette page en sachant quel utilisateur supprimé :
   * 1 - créer un lien vers cette page depuis la page liste (par exemple) en passant un paramètre GET
     * contenant l'id du player à modifier
     2 - on arrive sur cette page :
        a - on récupère le paramètre (vérification existe-t-il ?)
        b - on le récupère le joueur associé en base (vérification le joueur est-il toujours en bdd ?)
        c - on affiche les informations du joueur dans le formulaire HTML


   * Soumission d'un formulaire:
   * 1 - formulaire soumis ?
   * 2 - récupération des valeurs
   * 2bis - (façon personnelle fab de faire les choses) écraser les valeurs du tableau PHP player (pour l'affichage)
   * 3 - vérification des valeurs
   * 4 - si pas d'erreurs, requête et/ou traitement avec ces valeurs
   *
   * Requete SQL
   * 1 - connexion serveur / choix base
   * 2 - requete sql
   * 3 - préparation
   * 4 - exécution
   * 5 - !! redirection si l'update est validé (vers la page actuelle ou la page listing par exemple)
     * pour éviter de recharger le même envoi POST si on actualise la page
   *
   */

    // récupérer l'id du joueur qu'on veut éditer : on a passé son id dans l'URL
    $id = filter_input(INPUT_GET, 'id');

    // générer un code 404 si l'id n'est pas passé dans l'url
    if ($id == null) {
        header("HTTP/1.0 404 Not Found");
        die("Cette page n'existe pas");
    }

    // connexion à la bdd
    $pdo = new PDO("mysql:host=localhost;dbname=formation_202008", "root");
    // selectionner le joueur à éditer
    $sql = "SELECT * FROM product WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([
        ':id' => $id
    ]);

    // si la requête plante, on peut envoyer au navigateur le code 503
    if ($result == false) {
        http_response_code(503);
        echo "Désolé erreur 503 (service indisponible), maintenance en cours";
        exit;
    }

    // fetch renvoie le premier resultat (ici le premier joueur de la requete)
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product == false) {
        // générer un code 404 si l'id ne correspondait à aucun joueur en bdd
        header("HTTP/1.0 404 Not Found");
        die("Cette page n'existe pas");
    }

    // récupérer toutes les catégories pour pouvoir les afficher dans le formulaire
    // (pour le choix de l'équipe)
    $sql = "SELECT * FROM category";
    $stmt = $pdo->query($sql);
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 1 - formulaire soumis ?
    if (isset($_POST['btn-edit'])) {
        // 2- récupération
        $code = filter_input(INPUT_POST, 'code');
        $name = filter_input(INPUT_POST, 'name');
        $price = filter_input(INPUT_POST, 'price');
        $category = filter_input(INPUT_POST, 'category');;

        // 2 bis- modifier le tableau player avec les nouvelles informations (pour l'affichage dans le form HTML)
        $product['name'] = $name;
        $product['birthdate'] = $code;
        $product['email'] = $price;
        $product['category'] = $category;

        // 3 - vérifications
        // 3 - vérifications
        $errors = [];

        // todo
        if ($name == "" || mb_strlen($name) > 50) {
            $errors['name'] = "Le nom est obligatoire et doit faire max 50 carac.";
        }

        if ($code == "" || !preg_match("/^[A-Z]{3}-[0-9]{3}$/", $code)) {
            $errors['strength'] = "Code produit invalide";
        }

        if ($price == "" || !preg_match("/^\d{1,3}(.\d{1,2})?$/", $price)) {
            $errors['strength'] = "Prix invalide";
        }

        // on a choisi une categorie ?
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

        // 5 - enregistrement en bdd
        if (empty($errors)) {
            // 1 - connexion bdd (on l'a déjà faite au dessus)
            // $pdo = new PDO("mysql:host=localhost;dbname=formation_202008", "root");
            // 2 - requete sql
            $query = "UPDATE product SET name=:name, code=:code, price=:price,
                      category_id=:cagegory WHERE id = :id";
            // 3 - preparation
            $stmt = $pdo->prepare($query);

            $cat = $category != "" ? $category : null;

            $editOK = $stmt->execute([
                ':name' => $name,
                ':code' => $code,
                ':price' => $price,
                ':cagegory' => $cat,
                ':id' => $id,
            ]);

            if ($editOK == true) {
                // le player a été bien modifié, redirection vers une page
                header('Location: 1-list.php?updated-product='.$id);
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
<h1>Edition d'un joueur</h1>

<?php
    if (isset($errors)) {
        foreach ($errors as $error) {
            echo $error."<br>";
        }
    }

    if (isset($editOK)) {
        echo "Erreur serveur inconnue, veuillez contacter votre administrateur";
    }
?>

<form method="post">
    <input type="text" name="name" placeholder="Nom" value="<?php echo $product['name']; ?>"/><br>
    <input type="text" name="code" placeholder="Code" value="<?php echo $product['code']; ?>"/><br>
    <input type="number" name="price" placeholder="Price" value="<?php echo $product['price']; ?>"/><br>
     <select name="category">
        <option></option>
        <?php
            /*
             * $c est la catégorie qu'on est entrain d'afficher
             */
            foreach ($categories as $c) {
                $isSelected = $c['id'] == $product['category_id'] ? "selected" : "";
                echo "<option value='".$c['id']."' ".$isSelected.">".$c['name']."</option>";
            }
        ?>
    </select>

    <input type="submit" name="btn-edit"/>
</form>
</body>
</html>
