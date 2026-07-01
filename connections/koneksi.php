<?php
include_once '../config/database.php';

global $koneksi;

if (!isset($koneksi) || !$koneksi) {
    die("Error: Koneksi database tidak tersedia!");
}
?>