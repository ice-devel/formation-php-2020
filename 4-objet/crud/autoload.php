<?php
    function loadClass($className) {
        $filename = "../model/".$className.".php";

        if (file_exists($filename)) {
            include $filename;
        }
    }

    spl_autoload_register('loadClass');