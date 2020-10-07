<?php

?>

<form>
    <input type="text" value="Valeur par defaut"/><br>

    <select>
        <option></option>
        <option>Option 1</option>
        <option>Option 2</option>
        <option selected>Option 3</option>
    </select><br>

    <input type="radio" name="group" /> BTN1<br>
    <input type="radio" name="group" /> BTN2<br>
    <input type="radio" name="group" checked/> BTN3<br>

    <input type="checkbox" checked/><br>

    <p>
        Champ file : impossible de mettre une valeur par défaut,
        cela consisterait à pouvoir aller chercher sur l'ordinateur
        d'un client sans son autorisation : sécurité
    </p>
    <input type="file" /><br>
</form>


