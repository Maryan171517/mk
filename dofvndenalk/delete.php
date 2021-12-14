<?php

if (isset($_POST['delete'])) {

    $id = $_POST['delete'];

    $fn = "save.txt";
    $file = fopen($fn, "r");
    for ($i = 0; $i < count(file($fn)); $i++) {
        $temp = fgets($file, filesize($fn));
        $arr[$i] = json_decode($temp);
    }

    unset($arr[$id*2]);
    unset($arr[$id*2+1]);
    fclose($file);

    $out = array();
    print_r($out);
    for ($i = 0; $i < count($arr)+2; $i++) {
        if (isset($arr[$i])) {
            array_push($out, $arr[$i]);
        }
    }

    $file = fopen($fn, "w");
        for ($i = 0; $i < count($out); $i++) {
            fwrite($file, json_encode($out[$i]));
            fwrite($file, "\n");
        }
    fclose($file);

}

header('Location: index.php');
exit;