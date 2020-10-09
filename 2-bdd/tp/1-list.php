<?php
/*
 * Liste des produits
 */
    $pdo = new PDO("mysql:host=localhost;dbname=formation_202008", "root");
    $sql = "SELECT * FROM product P
            LEFT OUTER JOIN category C ON P.category_id = C.id
            ORDER BY P.created_at DESC;";
    $stmt = $pdo->query($sql);
    $products = $stmt->fetchAll(PDO::FETCH_NUM);
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
                $product[3] = str_replace('.', ',', $product[3]);
                echo "
                    <tr>
                        <td>".$product[0]."</td>
                        <td>".$product[1]."</td>
                        <td>".$product[2]."</td>
                        <td>".$product[3]."</td>
                        <td>".$product[8]."</td>
                        <td><a href='3-update.php?id=".$product[0]."'>Editer</a></td>
                        <td><a href='4-delete.php?id=".$product[0]."' onclick=\"return confirm('Suppression ".$product[1]." ?')\">Supprimer</a></td>
                    </tr>";
            }
        ?>
    </table>
</body>
</html>
