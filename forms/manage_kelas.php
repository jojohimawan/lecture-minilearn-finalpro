<?php 
    session_start();
    if( !isset($_SESSION["logindsn"]) ) {
        header("Location: ./../auth/login_dsn.php");
    }

    require_once "./../php/conn.php";
    require_once "./../php/functions.php";

    $loggeduser = $_SESSION['usernamedsn'];
    $dosen = queryRead("SELECT * FROM dosen WHERE username = '$loggeduser'");
    $kelas = queryReadAll("SELECT * FROM kelas WHERE nip = '{$_SESSION["nip"]}'");
    $mhscount = getRowCount("SELECT * FROM kelas_mahasiswa WHERE nip = '{$_SESSION["nip"]}'");
    $classcount = getRowCount("SELECT * FROM kelas WHERE nip = '{$_SESSION["nip"]}'");
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
                <a href="#" class="flex items-center p-5 text-white rounded-lg hover:bg-green-700 bg-green-600 mb-2">
                <svg aria-hidden="true" class="w-6 h-6 text-gray-500" fill="white" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
                <span class="ml-3">Manajemen Kelas</span>
                </a>
            </li>
            <li>
                <a href="./../forms/buat_kelas.php" class="flex items-center p-5 text-slate-500 rounded-lg hover:bg-slate-100 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-gray-500">
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 9a.75.75 0 00-1.5 0v2.25H9a.75.75 0 000 1.5h2.25V15a.75.75 0 001.5 0v-2.25H15a.75.75 0 000-1.5h-2.25V9z" clip-rule="evenodd" />
                </svg>
                <span class="ml-3">Buat Kelas</span>
                </a>
            </li>
            <li>
                <a href="./../forms/tambah_mhs.php" class="flex items-center p-5 text-slate-500 rounded-lg hover:bg-slate-100 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-gray-500 transition duration-75">
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 9a.75.75 0 00-1.5 0v2.25H9a.75.75 0 000 1.5h2.25V15a.75.75 0 001.5 0v-2.25H15a.75.75 0 000-1.5h-2.25V9z" clip-rule="evenodd" />
                </svg>
                <span class="ml-3">Tambah Mahasiswa</span>
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
            <div class="flex flex-col items-center gap-y-2">
                <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="./../berkas/<?= $dosen['berkas'] ?>" alt="Lecturer Photo"/>
                <a href="./../crud/download_dsn.php?id=<?= $dosen["nip"] ?>" class="inline-flex w-full items-center text-center px-4 py-2 text-sm font-medium text-center text-white bg-green-600 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">Download</a>
            </div>
            <div class="flex flex-col gap-y-2">
                <div class="text-lg text-slate-400 font-medium">
                    Selamat datang,
                </div>
                <div class="text-3xl text-slate-900 font-semibold">
                    <?= $dosen['nama'] ?>
                </div>
            </div>
            <div class="flex flex-col gap-y-2">
                <div class="text-lg text-slate-400 font-medium">
                    Jabatan fungsional
                </div>
                <div class="text-3xl text-slate-900 font-semibold">
                    <?= $dosen['jabatan'] ?>
                </div>
            </div>
            <div class="flex flex-col gap-y-2">
                <div class="text-lg text-slate-400 font-medium">
                        Kelas diampu:
                    </div>
                    <div class="text-3xl text-slate-900 font-semibold">
                        <?= $classcount ?>
                    </div>
            </div>
            <div class="flex flex-col gap-y-2">
                <div class="text-lg text-slate-400 font-medium">
                        Mahasiswa diampu:
                    </div>
                    <div class="text-3xl text-slate-900 font-semibold">
                        <?= $mhscount ?>
                    </div>
            </div>
                
                
        </div>

        <div class="text-2xl text-slate-900 font-semibold mb-8">
            Daftar Kelas Diampu:
        </div>

        <div class="table-read bg-white p-5 rounded-lg">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-slate-500">
                    <thead class="text-s text-slate-700 uppercase bg-slate-100">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nama Kelas
                            </th>
                            <th scope="col" class="px-6 py-3">
                                SKS
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Mahasiswa Diampu
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($kelas as $kls) : ?>
                        <tr class="bg-white border-b hover:bg-green-50">
                            <td class="px-6 py-4 font-medium text-base text-slate-500">
                                <?= $kls['nama_kelas'] ?>
                            </td>
                            <td class="px-6 py-4 font-medium text-base text-slate-500">
                                <?= $kls['sks'] ?>
                            </td>
                            <td class="px-6 py-4 font-medium text-base text-slate-500">
                                <?php $diampu = getRowCount("SELECT * FROM kelas_mahasiswa WHERE id_kelas = '{$kls["id_kelas"]}'"); echo $diampu ?>
                            </td>
                            <td class="px-6 py-4 font-medium text-base text-slate-500 flex flex-row gap-x-2">
                                <a href="./update_kelas.php?id_kelas=<?= $kls['id_kelas']?>" type="button" class="flex gap-x-2 items-center justify-center focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 ">Edit <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                        <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                        </svg>
                                </a>
                                <a href="./delete_kelas.php?id_kelas=<?= $kls["id_kelas"] ?>" onclick="return confirm('Yakin menghapus?')" type="button" class="flex gap-x-2 items-center focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Delete <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                    <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                        </svg>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>
</html>