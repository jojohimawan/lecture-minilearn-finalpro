<?php
    require_once "./../php/conn.php";
    require_once "./../php/functions.php";

    $id_kelas = $_GET['id_kelas'];

    if(queryDeleteKelas($id_kelas) > 0) {
        echo 
        '<script> 
        alert("Sukses drop mahasiswa")
        document.location.href = "./../forms/manage_kelas.php"
        </script>
        ';
    } else {
        echo 
        '<script> 
        alert("Gagal drop mahasiswa")
        document.location.href = "./../forms/manage_kelas.php"
        </script>
        ';
    }

?>