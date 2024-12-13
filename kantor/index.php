<?php
require_once dirname(__FILE__).'/config.php';

if (file_exists(_ROOT_PATH.'/app/calc_view.php')) {
    include _ROOT_PATH.'/app/calc_view.php';
} else {
    die('Nie można załadować widoku kantoru.');
}
?>