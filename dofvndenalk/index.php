<?php
    session_start();

    $_SESSION['text'] = [];
    $_SESSION['date'] = [];

    $fn = "save.txt";

    if (!file_exists($fn)) {
        $file = fopen($fn, "w");
        fclose($file);
    }

    $file = fopen($fn, "r");

        for ($i = 0; $i < count(file($fn))/2; $i++) {
            $temp = fgets($file, filesize($fn));
            $_SESSION['date'][$i] = json_decode($temp);
            $temp = fgets($file, filesize($fn));
            $_SESSION['text'][$i] = json_decode($temp);
        }

    fclose($file);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Note</title>
</head>

<body>

    <div class="container">
        <div class="wrap">
            <form class="form__inp" method="post" action="wr.php">
                <input class="form__input" type="text" name="note" placeholder="Введіть замітку">
                <input class="form__input" type="date" name="date" value="2021-12-03">
                <button class="form__btn" type="submit" name="add">Добавити</button>
                <button class="form__btn mt" type="submit" name="clear">Видалити все</button>
            </form>
        </div>

        <div class="wrap">
            <ul>
                <?php
                    out();

                    foreach ($_SESSION['text'] as $key => $txt) {
                        if (isset($_POST['delete_' . $key])) {
                            unset($_SESSION['text'][$key]);
                            unset($_SESSION['date'][$key]);
                            out();
                        }
                    }

                    function out() {
                        foreach ($_SESSION['text'] as $key => $txt) {
                            if (isset($txt)) {
                                echo '<form method="post" action="delete.php" id="form_' . $key . '">';
                                    echo '<li>';
                                        echo '['.$_SESSION['date'][$key].'] '.$txt.'<button class="form__btn"type="submit"name="delete" value="'.$key.'">Видалити</button>';
                                    echo '</li>';
                                echo '</form>';
                            }
                        }
                    }
                ?>
            </ul>
        </div>
    </div>

</body>

</html>