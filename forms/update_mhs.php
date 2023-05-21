<?php 
    session_start();
    if( !isset($_SESSION["logindsn"]) ) {
        header("Location: ./../auth/login_dsn.php");
    }

    require_once "./../php/conn.php";
    require_once "./../php/functions.php";

    $loggeduser = $_SESSION['usernamedsn'];
    $dosen = queryRead("SELECT * FROM dosen WHERE username = '$loggeduser'");

    $id_km = $_GET['id_km'];
    $enroll = queryRead("SELECT * FROM kelas_mahasiswa WHERE id_km = $id_km");
    $rowcount = getRowCount("SELECT * FROM kelas_mahasiswa WHERE nip = '{$_SESSION["nip"]}'");

    if(isset($_POST['submit'])) {
        if(queryUpdateNilai($_POST) > 0) {
            echo 
                '<script> 
                alert("Sukses edit nilai")
                document.location.href = "./../homepages/home_dsn.php"
                </script>
            ';
        } else {
            echo 
                '<script> 
                alert("Gagal edit nilai")
                document.location.href = "./../homepages/home_dsn.php"
                </script>
            ';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <title>Home</title>
</head>
<body class="bg-slate-50">

    <button data-drawer-target="cta-button-sidebar" data-drawer-toggle="cta-button-sidebar" aria-controls="cta-button-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
    </svg>
    </button>

    <aside id="cta-button-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 py-8 overflow-y-auto bg-white border-r">
        <ul class="font-medium">
            <li>
                <a href="./../homepages/home_dsn.php" class="flex items-center p-5 text-slate-500 rounded-lg hover:bg-slate-100 mb-2">
                <svg aria-hidden="true" class="w-6 h-6 text-gray-500 transition duration-75 group-medium:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
                <span class="ml-3">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="./buat_kelas.php" class="flex items-center p-5 text-slate-500 rounded-lg hover:bg-slate-100 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-gray-500 transition duration-75">
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 9a.75.75 0 00-1.5 0v2.25H9a.75.75 0 000 1.5h2.25V15a.75.75 0 001.5 0v-2.25H15a.75.75 0 000-1.5h-2.25V9z" clip-rule="evenodd" />
                </svg>
                <span class="ml-3">Buat Kelas</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center p-5 text-white rounded-lg hover:bg-green-700 bg-green-600 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="w-6 h-6 text-gray-500 transition duration-75">
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 9a.75.75 0 00-1.5 0v2.25H9a.75.75 0 000 1.5h2.25V15a.75.75 0 001.5 0v-2.25H15a.75.75 0 000-1.5h-2.25V9z" clip-rule="evenodd" />
                </svg>
                <span class="ml-3">Edit Mahasiswa</span>
                </a>
            </li>
            <li>
                <a href="./../auth/logout.php" class="flex items-center p-5 text-red-500 rounded-lg bg-red-50">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                </svg>
                <span class="flex-1 ml-3 whitespace-nowrap">Logout</span>
                </a>
            </li>
        </ul>
        <div id="dropdown-cta" class="p-5 mt-6 mx-3 rounded-lg bg-green-50" role="alert">
            <div class="flex items-center mb-3">
                <span class="bg-orange-100 text-orange-800 text-sm font-semibold mr-2 px-2.5 py-0.5 rounded">Beta</span>
                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-100 text-green-800 rounded-lg focus:ring-2 focus:ring-blue-400 p-1 hover:bg-green-200 inline-flex h-6 w-6" data-dismiss-target="#dropdown-cta" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <p class="mb-3 text-sm text-green-700">
                eLearning sisi pengguna dosen memiliki akses untuk membuat kelas dan input serta edit nilai mahasiswa.
            </p>
            <a class="text-sm text-green-700 underline font-medium hover:text-green-800  " href="#">Turn new navigation off</a>
        </div>
    </div>
    </aside>

    <div class="py-12 px-24 sm:ml-64">
        <div class="w-full flex flex-row items-center justify-between p-4 pb-12 mb-12 border-b">
            <div>
                <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="./../berkas/<?= $dosen['berkas'] ?>" alt="Lecturer Photo"/>
            </div>
            <div class="flex flex-col gap-y-2">
                <div class="text-xl text-slate-400 font-medium">
                    Selamat datang,
                </div>
                <div class="text-3xl text-slate-900 font-semibold">
                    <?= $dosen['nama'] ?>
                </div>
            </div>
            <div class="flex flex-col gap-y-2">
                <div class="text-xl text-slate-400 font-medium">
                        Mahasiswa diampu:
                    </div>
                    <div class="text-3xl text-slate-900 font-semibold">
                        <?= $rowcount ?>
                    </div>
            </div>
                
                
        </div>

        <form action="" method="post" class="p-4">
        <div class="mb-6">
                <label for="id_km" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"></label>
                <input type="hidden" id="id_km" name="id_km" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="<?= $enroll['id_km'] ?>" required>
            </div>
            <div class="mb-6">
                <label for="nilai" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nilai</label>
                <input type="text" id="nilai" name="nilai" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="<?= $enroll['nilai'] ?>" required>
            </div>
            
            <button type="submit" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center gap-x-3" name="submit">Update Nilai</button>
        </form>
    </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>
</html>