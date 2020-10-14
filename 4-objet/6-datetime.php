<?php
  /*
   * L'objet DateTime : faciliter l'utilisation des dates
   */

    // procédural
    $currentDate = date("d/m/Y");
    $currentTime = date("H:i:s");
    $currentDateTime = date("d/m/Y H:i:s");
    echo $currentDateTime."<br>";

    $currentDateSQL = date("Y-m-d");
    echo $currentDateSQL."<br>";

    $ts = strtotime("2015-10-13");
    echo $ts."<br>";
    $anotherDate = date("d/m/Y", $ts);
    echo $anotherDate."<br>";

    // objet
    /*
     * Date du jour
     */
    $now = new DateTime();

    // afficher date en fr
    echo $now->format("d/m/Y")."<br>";
    echo $now->format("d/m/Y H:i")."<br>";

    // afficher date en sql
    echo $now->format("Y-m-d")."<br>";

    /*
     * Date précise
     */
    $otherDate = new DateTime("2015-10-13 12:54:54");

    echo $otherDate->format("d/m/Y")."<br>";
    echo $otherDate->format("d/m/Y H:i:s")."<br>";

    /*
     * Dates dynamiques :
     * https://www.php.net/manual/fr/datetime.formats.relative.php
     */
    $yesterday = new DateTime("yesterday");

    $tenDaysBefore = new DateTime("10 days ago 14:00");
    echo $tenDaysBefore->format("d/m/Y H:i")."<br>";

    $lastDayOfLastMonth = new DateTime("last day of last month");
    echo $lastDayOfLastMonth->format("d/m/Y H:i")."<br>";

    /*
     * Ajouter ou soutraire un interval
     * P : période
     * T : time
     * sub / add
     */
    // 30 jours
    $interval30j = new DateInterval("P30D");
    $lastDayOfLastMonth->sub($interval30j);
    echo $lastDayOfLastMonth->format("d/m/Y H:i")."<br>";

    // 2 mois
    $interval2m = new DateInterval("P2M");
    $lastDayOfLastMonth->add($interval2m);
    echo $lastDayOfLastMonth->format("d/m/Y H:i")."<br>";

    // 2 mois 2 jours
    $interval2m2d = new DateInterval("P2M2D");
    $lastDayOfLastMonth->add($interval2m2d);
    echo $lastDayOfLastMonth->format("d/m/Y H:i")."<br>";

    // interval 2h
    $interval2h = new DateInterval("PT2H");
    $lastDayOfLastMonth->add($interval2h);
    echo $lastDayOfLastMonth->format("d/m/Y H:i")."<br>";

    $otherDate = new DateTime("2015-10-13 12:54:54");
    $yesterday = new DateTime("yesterday");

    // différence entre deux dates donne un objet interval
    $interval = $otherDate->diff($yesterday);
    echo $interval->days."<br>"; // nombre de jours total
    echo $interval->y."<br>"; // nb d'année
    echo $interval->m."<br>"; // nd de mois
    echo $interval->d."<br>"; // nb de jours dans le mois
    echo $interval->h."<br>"; // nb d'heure
    echo $interval->i."<br>"; // nb de minutes
    echo $interval->s."<br>"; // nb de secondes

    // on peut comparer des objets datetime entre eux
    if ($yesterday > $otherDate) {

    }


