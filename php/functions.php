<?php 
// if( !isset($_SESSION["logindsn"]) && !isset($_SESSION["loginmhs"]) ) {
//     header("Location: ./../auth/login_dsn.php");
// }

if(isset($_SESSION['logindsn'])) {
    $loggeduser = $_SESSION['usernamedsn'];
    $loggednip = $_SESSION['nip'];
}

require_once "conn.php";

function handleUpload()
{
    $nama_berkas = $_FILES['berkas']['name'];
    $ukuran_berkas = $_FILES['berkas']['size'];
    $error = $_FILES['berkas']['error'];
    $tmpname = $_FILES['berkas']['tmp_name'];

    if( $error === 4) {
        echo 
                '<script> 
                alert("Silahkan upload file")
                document.location.href = "../index.php"
                </script>
            ';
        return false;
    }

    $valid_extension = ['jpg', 'png', 'jpeg'];
    $berkas_extension = explode('.', $nama_berkas);
    $berkas_extension = strtolower(end($berkas_extension));

    if( !in_array($berkas_extension, $valid_extension) ) {
        echo 
                '<script> 
                alert("File harus berupa gambar")
                document.location.href = "../index.php"
                </script>
            ';
        return false;
    }

    if( $ukuran_berkas > 2000000 ) {
        echo 
                '<script> 
                alert("File terlalu besar")
                document.location.href = "../index.php"
                </script>
            ';
        return false;
    }

    $nama_berkas_baru = uniqid();
    $nama_berkas_baru .= '.'; $nama_berkas_baru .= $berkas_extension;

    move_uploaded_file( $tmpname, '../berkas/' . $nama_berkas_baru );

    return $nama_berkas_baru;

}

function userRegisterMahasiswa($data)
{
    // catch db connection
    global $conn;

    // store the data array
    $username = strtolower(stripslashes($data['username']));
    $password = mysqli_real_escape_string($conn, $data['password']);
    $nrp = htmlspecialchars($data['nrp']);
    $namalengkap = htmlspecialchars($data['namalengkap']);
    $prodi = $data['prodi'];
    $jenjang = $data['jenjang'];
    $berkas = handleUpload();
    $regdate = date('Y-m-d H:i:s');

    // check for img
    if(!$berkas) {
        return false;
    }

    // check if the mahasiswa is already registered
    $result = mysqli_query($conn, "SELECT username FROM mahasiswa WHERE username = '$username'");

    if(mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('Username sudah terdaftar');
            </script>";
        return false;
    }

    // encrypt the pass
    $password = password_hash($password, PASSWORD_DEFAULT);

    // insert data to db
    $query = "INSERT INTO mahasiswa( nrp, nama, jurusan, username, password, jenjang, berkas, regdate ) VALUES( '$nrp', '$namalengkap', '$prodi', '$username', '$password', '$jenjang', '$berkas', '$regdate' )";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function userRegisterDosen($data)
{
    global $conn;

    // store the data array
    $username = strtolower(stripslashes($data['username']));
    $password = mysqli_real_escape_string($conn, $data['password']);
    $nip = htmlspecialchars($data['nip']);
    $namalengkap = htmlspecialchars($data['namalengkap']);
    $jabatan = $data['jabatan'];
    $berkas = handleUpload();
    $regdate = date('Y-m-d H:i:s');

    // check for img
    if(!$berkas) {
        return false;
    }

    // check if the dosen is already registered
    $result = mysqli_query($conn, "SELECT username FROM dosen WHERE username = '$username'");

    if(mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('Username sudah terdaftar');
            </script>";
        return false;
    }

    // encrypt the pass
    $password = password_hash($password, PASSWORD_DEFAULT);

    // insert data to db
    $query = "INSERT INTO dosen( nip, nama, jabatan, username, password, berkas, regdate ) VALUES( '$nip', '$namalengkap', '$jabatan', '$username', '$password', '$berkas', '$regdate' )";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function queryRead($query)
{
    global $conn;
    
    // get data from db and store it in assoc array
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    
    return $row;
}

function queryReadAll($query)
{
    global $conn;
    
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    
    return $rows;
}

function queryCreateKelas($data)
{
    global $conn;

    $nip = $_SESSION['nip'];
    $nama_kelas = htmlspecialchars($data['namakelas']);
    $sks = htmlspecialchars($data['sks']);

    $query = "INSERT INTO kelas(nip, sks, nama_kelas) VALUES ('$nip', '$sks', '$nama_kelas')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function queryEnroll($data) 
{
    global $conn;

    $id_kelas = $data['idkelas'];
    $nrp = $data['nrp'];
    $nilai = htmlspecialchars($data['nilai']);
    $nip = $_SESSION['nip'];
    $enrdate = date('Y-m-d H:i:s');

    // check if there are any students already enrolled in a certain class
    $result = mysqli_query($conn, "SELECT * FROM kelas_mahasiswa WHERE id_kelas = '$id_kelas' AND nrp = '$nrp'");
    if(mysqli_fetch_assoc($result)) {
        echo "<script>
        alert('Mahasiswa sudah terdaftar di kelas ini');
        </script>";

        return false;
    }

    $query = "INSERT INTO kelas_mahasiswa(nrp, id_kelas, nilai, enrdate, nip) VALUES ('$nrp', '$id_kelas', '$nilai', '$enrdate', '$nip')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function queryUpdateNilai($data)
{
    global $conn;

    $id_km = $data['id_km'];
    $nilai = $data['nilai'];

    $query = "UPDATE kelas_mahasiswa SET nilai = '$nilai' WHERE id_km = '$id_km'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function queryDeleteNilai($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM kelas_mahasiswa WHERE id_km = $id");
    return mysqli_affected_rows($conn);
}

function getRowCount($query)
{
    global $conn;

    $rowcount = mysqli_num_rows(mysqli_query($conn, $query));

    return $rowcount;
}

?>