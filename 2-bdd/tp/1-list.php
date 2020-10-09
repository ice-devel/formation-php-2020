<?php
/*
 * Liste des produits
 */
    $pdo = new PDO("mysql:host=localhost;dbname=formation_202008", "root");
    $sql = "SELECT * FROM product ORDER BY created_at DESC;";
    $stmt = $pdo->query($sql);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    <a href="2-insert.php">Ajouter un produit</a>

    <table>
        <?php
            foreach ($products as $product) {
                $product['price'] = str_replace('.', ',', $product['price']);
                echo "
                    <tr>
                        <td>".$product['id']."</td>
                        <td>".$product['name']."</td>
                        <td>".$product['price']."</td>
                        <td><a href='3-update.php?id=".$product['id']."'>Editer</a></td>
                        <td><a href='4-delete.php?id=".$product['id']."'>Supprimer</a></td>
                    </tr>";
            }
        ?>
    </table>
</body>
</html>
