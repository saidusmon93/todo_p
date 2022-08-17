<?php

class File
{
    public $fp;
    public $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
        if (!is_writable($this->filename)) { // is_writable — Проверяет, доступен ли файл для записи
            echo "Файл {$this->filename} недоступен для записи";
            exit; // Выход из скрипта
        }
        $this->fp = fopen($this->filename, 'a');  // fopen — Открывает файл или URL
    }

    public function __destruct() // __destruct — Вызывается при выходе из области видимости объекта
    {
        fclose($this->fp);  // fclose — Закрывает файл
    }

    public function write($text)
    {
        if (fwrite($this->fp, $text . PHP_EOL) === false) { // fwrite — Записывает в файл
            echo "Не удалось записать в файл {$this->filename}";
            exit; // exit — Завершает выполнение скрипта
        }
    }
    public function read() {
        $text = file_get_contents($this->filename); // file_get_contents — Читает файл в виде массива строк
        $text = explode(PHP_EOL, $text); // explode — Разбивает строку на части
        return $text;
    } 
    public function deleteFileArray($key) {
        $text = file_get_contents($this->filename); // file_get_contents — Читает файл в виде массива строк
        $text = explode("\n", $text); // explode — Разбивает строку на части
        unset($text[$key]); // unset — Удаляет переменную или индекс массива
        $text = implode("\n", $text); // implode — Объединяет элементы массива в строку
        file_put_contents($this->filename, $text); // file_put_contents — Записывает в файл
    }
}
