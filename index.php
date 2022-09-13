<?php

error_reporting(-1);
function debug($data)
{
    echo '<pre>' . print_r($data, true) . '</pre>';
}
require_once 'classes/File.php';

$file = new File(__DIR__ . '/file.txt');
if (isset($_GET['id'])) {
    $file->deleteFileArray($_GET['id']);
    header('Location: /2/index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<style>
    ol li:nth-child(odd) {
        background: #f1f1f1;
    }
</style>
    <title>Todo</title>
</head>

<body>
    <div class="container">
        <form class="row g-3" method="post">
            <div class="col-auto">
                <input type="text" name="text" class="form-control" placeholder="Введите текст">
            </div>
            <div class="col-auto">
                <button class=" col btn btn-primary mb-3 " type="submit" value="Записать"> Записать</button>
            </div>
        </form>
        <?php
        if (!empty($_POST['text'])) {  // isset — Проверяет, установлен ли переменной значение
            echo  $file->write($_POST['text']); // Записывает в файл
            debug($file->read());
        }
        ?>
        <hr>
        <?php if (count($file->read()) === 1) : ?>
            <div class="alert alert-danger" role="alert">
                Файл пуст
            </div>

            </ol>
        <?php else : ?>
            <ol class="list-group list-group-numbered">
                <?php
                foreach ($file->read() as $key => $value) {
                    if (!empty($value)) {
                        echo "<li class='list-group-item d-flex justify-content-between align-items-start'><div class='ms-2 me-auto'>  {$value}  </div> <a href='?id={$key}'  class='btn-close btn btn-danger bg-danger float-end' aria-label='Close'></a></li>";
                    }
                };
                ?>

            <?php endif; ?>

    </div>

</body>
</html>