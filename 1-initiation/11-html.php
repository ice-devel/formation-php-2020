<?php
    function age($year) {
        return date('Y') - $year;
    }

    $yearToto = 2005;
    $yearDavid = 2016;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HTML</title>
    <style>
        table {
            border-collapse: collapse;
        }
        table td {
            border:1px solid;
        }
    </style>
</head>
<body>
    <h1>Mon titre</h1>

    <p style="font-weight:bold;">
        Age de toto :
        <?php
            echo age($yearToto);
        ?>
    </p>

    <p style="color:red;">
        Age de David :
        <?php
            $ageDavid = age($yearDavid);
            echo $ageDavid;
        ?>
    </p>

    <ul>
        <?php
            $points = [43, 54, 36];
            foreach ($points as $point) {
                echo "<li>".$point."</li>";
            }
        ?>
    </ul>

    <select>
    <?php
        $villes = ["Lille", "Calais", "Dunkerque", "Valenciennes", "Wattignies"];
        foreach ($villes as $ville) {
            echo "<option>".$ville."</option>";
        }
    ?>
    </select>

    <table>
    <?php
        $users = [];

        $toto = ['nom' => 'toto', 'cp' => '59000', 'naissance' => 1910];
        $users[] = $toto;

        $users[] = ['nom' => 'antonio', 'cp' => '75000', 'naissance' => 1920];

        $user = ['nom' => 'Bashir', 'cp' => '75000', 'naissance' => 2020];
        array_push($users, $user);

        // accéder au cp du 2eme user
        // $users[1]['cp'];

        // afficher tous les utilisateurs, sauf qu'on s'en fout de l'année de naissance, on veut l'âge
        for ($i=0;$i<count($users);$i++) {
            $age = age($users[$i]["naissance"]);
            echo "<tr>
                    <td>".$users[$i]["nom"]."</td>
                    <td>".$users[$i]["cp"]."</td>
                    <td>".$age."</td>
                </tr>
            ";
        }

        // la même mais avec foreach
        foreach ($users as $u) {
            $age = age($u["naissance"]);
            echo "<tr>
                    <td>".$u["nom"]."</td>
                    <td>".$u["cp"]."</td>
                    <td>".$age."</td>
                </tr>
            ";
        }
    ?>
    </table>

    <script>
        console.log("test");
    </script>
</body>
</html>