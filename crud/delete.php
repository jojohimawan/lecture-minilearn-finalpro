<?php
session_start();
if( !isset($_SESSION["login"]) ) {
    header("Location: ./../auth/login.php");
}

require_once "../php/conn.php";
require_once "../php/functions.php";

$id = $_GET["id"];

if( queryDeleteNilai($id) > 0 ) {
    echo 
        '<script> 
        alert("Sukses")
        document.location.href = "./crud.php"
        </script>
    ';
} else {
    echo 
        '<script> 
        alert("Gagal")
        document.location.href = "./crud.php"
        </script>
    ';
}
?>