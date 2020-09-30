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

    <script>
        console.log("test");
    </script>
</body>
</html>