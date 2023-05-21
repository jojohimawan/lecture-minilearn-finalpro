<?php 
    session_start();
    if( !isset($_SESSION["loginmhs"]) ) {
        header("Location: ./../auth/login_mhs.php");
    }

    require_once "./../php/conn.php";
    require_once "./../php/functions.php";

    $loggeduser = $_SESSION['usernamemhs'];
    $loggednrp = $_SESSION['nrp'];
    $mahasiswa = queryRead("SELECT * FROM mahasiswa WHERE username = '$loggeduser'");

    $enrolled = queryReadAll("SELECT * FROM kelas_mahasiswa WHERE nrp = $loggednrp");
    // var_dump($enrolled); die;
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
                <a href="#" class="flex items-center p-5 text-white rounded-lg hover:bg-green-700 bg-green-600 mb-10">
                <svg aria-hidden="true" class="w-6 h-6 text-gray-500 transition duration-75 group-medium:text-white" fill="white" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
                <span class="ml-3">Dashboard</span>
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
                eLearning sisi pengguna siswa hanya memiliki akses untuk mengedit foto dan melihat nilai dari mata kuliah.
            </p>
            <a class="text-sm text-green-700 underline font-medium hover:text-green-800  " href="#">Turn new navigation off</a>
        </div>
    </div>
    </aside>

    <div class="py-12 px-24 sm:ml-64">
        <div class="w-full p-4 pb-12 mb-12 border-b">
                <span class="text-4xl text-slate-700 font-semibold">Selamat datang, <?= $mahasiswa['nama'] ?></span>
        </div>

        <div class="grid grid-cols-3 gap-2 mb-8">
            <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 p-4">
                <div class="flex flex-col items-center">
                    <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="./../berkas/<?= $mahasiswa['berkas'] ?>" alt="Student Photo"/>
                    <div class="mt-4">
                        <a href="./../crud/download_mhs.php?id=<?= $mahasiswa["nrp"] ?>" class="inline-flex w-full items-center text-center px-4 py-2 text-sm font-medium text-center text-white bg-green-600 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">Download</a>
                    </div>
                </div>
            </div>
            
            <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow">
                <svg class="w-10 h-10 mb-2 text-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M11.25 4.533A9.707 9.707 0 006 3a9.735 9.735 0 00-3.25.555.75.75 0 00-.5.707v14.25a.75.75 0 001 .707A8.237 8.237 0 016 18.75c1.995 0 3.823.707 5.25 1.886V4.533zM12.75 20.636A8.214 8.214 0 0118 18.75c.966 0 1.89.166 2.75.47a.75.75 0 001-.708V4.262a.75.75 0 00-.5-.707A9.735 9.735 0 0018 3a9.707 9.707 0 00-5.25 1.533v16.103z" />
                </svg>
                <a href="#">
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900">Program Studi</h5>
                </a>
                <p class="mb-3 font-normal text-gray-500"><?= $mahasiswa['jurusan'] ?></p>
            </div>

            <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow">
                <svg class="w-10 h-10 mb-2 text-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" >
                    <path d="M11.7 2.805a.75.75 0 01.6 0A60.65 60.65 0 0122.83 8.72a.75.75 0 01-.231 1.337 49.949 49.949 0 00-9.902 3.912l-.003.002-.34.18a.75.75 0 01-.707 0A50.009 50.009 0 007.5 12.174v-.224c0-.131.067-.248.172-.311a54.614 54.614 0 014.653-2.52.75.75 0 00-.65-1.352 56.129 56.129 0 00-4.78 2.589 1.858 1.858 0 00-.859 1.228 49.803 49.803 0 00-4.634-1.527.75.75 0 01-.231-1.337A60.653 60.653 0 0111.7 2.805z" />
                    <path d="M13.06 15.473a48.45 48.45 0 017.666-3.282c.134 1.414.22 2.843.255 4.285a.75.75 0 01-.46.71 47.878 47.878 0 00-8.105 4.342.75.75 0 01-.832 0 47.877 47.877 0 00-8.104-4.342.75.75 0 01-.461-.71c.035-1.442.121-2.87.255-4.286A48.4 48.4 0 016 13.18v1.27a1.5 1.5 0 00-.14 2.508c-.09.38-.222.753-.397 1.11.452.213.901.434 1.346.661a6.729 6.729 0 00.551-1.608 1.5 1.5 0 00.14-2.67v-.645a48.549 48.549 0 013.44 1.668 2.25 2.25 0 002.12 0z" />
                    <path d="M4.462 19.462c.42-.419.753-.89 1-1.394.453.213.902.434 1.347.661a6.743 6.743 0 01-1.286 1.794.75.75 0 11-1.06-1.06z" />
                </svg>
                <a href="#">
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900">Jenjang</h5>
                </a>
                <p class="mb-3 font-normal text-gray-500"><?= $mahasiswa['jenjang'] ?></p>
            </div>
        </div>

        <div class="table-read bg-white p-5 rounded-lg">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-slate-500">
                    <thead class="text-s text-slate-700 uppercase bg-slate-100">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Mata Kuliah
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Dosen
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nilai
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($enrolled as $enr) : ?>
                        <tr class="bg-white border-b hover:bg-green-50">
                            <td class="px-6 py-4 font-medium text-base text-slate-500">
                                <?php $result = queryRead("SELECT nama_kelas FROM kelas WHERE id_kelas = {$enr['id_kelas']}"); echo $result['nama_kelas'] ?>
                            </td>
                            <td class="px-6 py-4 font-medium text-base text-slate-500">
                            <?php $result = queryRead("SELECT nama FROM dosen WHERE nip = {$enr['nip']}");
                                    echo $result['nama'];
                            ?>
                            </td>
                            <td class="px-6 py-4 font-medium text-base text-slate-500">
                                <?= $enr['nilai'] ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>
</html>