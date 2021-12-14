<?php

$fn = "save.txt";

    if (!empty($_POST['note'])) {
        $file = fopen($fn, "a");

            fwrite($file, json_encode($_POST['date']));
            fwrite($file, "\n");
            fwrite($file, json_encode($_POST['note']));
            fwrite($file, "\n");

        fclose($file);
    }

    if (isset($_POST['clear'])) {
        $f = @fopen($fn, "r+");
        if ($f !== false) {
            ftruncate($f, 0);
            fclose($f);
        }
    }

header('Location: index.php');
exit;