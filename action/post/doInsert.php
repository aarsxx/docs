<?php

//$_GET adalah array yang berisi data request yang dikirim dengan http method GET
//$_POST adalah array yang berisi data request yang dikirim dengan http method POST
//$_REQUEST adalah array yang berisi data request yang dikirim lewat http method apapun

var_dump($_POST); //menampilkan semua isi array $_POST
$post = $_POST['post']; //simpan data array dengan key 'post' ke dalam variabel $post