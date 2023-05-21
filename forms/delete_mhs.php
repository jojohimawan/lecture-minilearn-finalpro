<?php
    require_once "./../php/conn.php";
    require_once "./../php/functions.php";

    $id_km = $_GET['id_km'];

    if(queryDeleteNilai($id_km) > 0) {
        echo 
        '<script> 
        alert("Sukses drop mahasiswa")
        document.location.href = "./../homepages/home_dsn.php"
        </script>
        ';
    } else {
        echo 
        '<script> 
        alert("Gagal drop mahasiswa")
        document.location.href = "./../homepages/home_dsn.php"
        </script>
        ';
    }

?>