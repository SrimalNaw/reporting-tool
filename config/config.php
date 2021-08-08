<?php 

if($_SERVER['HTTP_HOST'] == "localhost"){
    define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/reporting-tool/');
    define('DOC_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/reporting-tool/');
}
else{
    define('SITE_URL', "http://" . $_SERVER['HTTP_HOST'].'/');
    define('DOC_ROOT', $_SERVER['DOCUMENT_ROOT'].'/');
}

?>