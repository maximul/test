<?php

function File_upload($field)
{
    if (empty($_FILES))
        return false;

    if (0 != $_FILES[$field]['error'])
        return false;

    if (is_uploaded_file($_FILES[$field]['tmp_name'])) {
        $image = preg_match('/image/', $_FILES[$field]['type']);
        //print_r($_FILES); die();
        if ($image) {
            $path = __DIR__ . '/../img/';
            if (!file_exists($path)) {
                mkdir($path);
            }
            $res = move_uploaded_file($_FILES[$field]['tmp_name'], $path . iconv("UTF-8", "Windows-1251", $_FILES[$field]['name']));
            if (!$res) {
                return false;
            } else {
                return '/img/' . $_FILES[$field]['name'];
            } 
        } else {
            echo '<div style="color: red">Выбран не верный тип файла.</div>';
            return false;
        }
    }
    return false;
}