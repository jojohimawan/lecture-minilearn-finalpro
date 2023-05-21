<?php
    require_once "../php/conn.php";
    

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    
        // fetch file to download from database
        $query = "SELECT berkas FROM mahasiswa WHERE nrp=$id";
        $result = mysqli_query($conn, $query);
    
        $file = mysqli_fetch_assoc($result);
        $filepath = "./../berkas/{$file['berkas']}";
    
        if (file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($filepath));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize("./../berkas/{$file['berkas']}"));
            readfile("./../berkas/{$file['berkas']}");

            echo 
        '<script> 
        alert("Sukses download")
        document.location.href = "./../homepages/home_mhs.php"
        </script>
        ';
        }
    
    }
?>