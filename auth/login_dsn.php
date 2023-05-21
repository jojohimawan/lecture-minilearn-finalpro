<?php 
    session_start();
    require_once "../php/conn.php";

    if(isset($_POST['logindsn'])) {
        // catch credential data
        $username = $_POST['username'];
        $password = $_POST['password'];

        // find username in db
        $result = mysqli_query($conn, "SELECT * FROM dosen WHERE username = '$username'");
        if(mysqli_num_rows($result) === 1) { // if found
            $row = mysqli_fetch_assoc($result); // catch the record
            if(password_verify($password, $row['password'])) { // verify pass
                // create session
                $_SESSION['logindsn'] = true;
                $_SESSION['usernamedsn'] = $username;
                $_SESSION['nip'] = $row['nip'];

                header("Location: ./../homepages/home_dsn.php"); // redirect if pass verified
                exit;
            }
        }

        $error = true;
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
    <title>Auth - Login</title>
</head>
<body>
    <div class="grid grid-cols-2 gap-5 h-screen">
        <div class="w-full p-40 flex flex-col gap-y-12">
            <div class="flex flex-col gap-y-4">
                <div class="">
                    <svg viewBox="0 0 248 31" class="text-slate-900 dark:text-white w-auto h-5"><path fill-rule="evenodd" clip-rule="evenodd" d="M25.517 0C18.712 0 14.46 3.382 12.758 10.146c2.552-3.382 5.529-4.65 8.931-3.805 1.941.482 3.329 1.882 4.864 3.432 2.502 2.524 5.398 5.445 11.722 5.445 6.804 0 11.057-3.382 12.758-10.145-2.551 3.382-5.528 4.65-8.93 3.804-1.942-.482-3.33-1.882-4.865-3.431C34.736 2.92 31.841 0 25.517 0zM12.758 15.218C5.954 15.218 1.701 18.6 0 25.364c2.552-3.382 5.529-4.65 8.93-3.805 1.942.482 3.33 1.882 4.865 3.432 2.502 2.524 5.397 5.445 11.722 5.445 6.804 0 11.057-3.381 12.758-10.145-2.552 3.382-5.529 4.65-8.931 3.805-1.941-.483-3.329-1.883-4.864-3.432-2.502-2.524-5.398-5.446-11.722-5.446z" fill="#16a34a"></path></svg>
                </div>
                <p class="text-3xl font-bold">Login Dosen</p>
                <div class="">
                    <a href="./register_dsn.php" class="text-lg text-slate-500">No account?</a>
                    <a href="./register_dsn.php" class="text-lg text-green-700 font-medium">Register</a>
                </div>
                <?php if( isset($error) ) : ?>
                    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <span class="font-medium">Warning</span> Username atau password salah.
                    </div>
                <?php endif; ?>
            </div>
            
            <form action="" method="post">
                <div class="mb-6">
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                    <input type="username" id="username" name="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" placeholder="e.g Eisenhower Widodo" required>
                </div>
                <div class="mb-6">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Your password</label>
                    <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" required>
                </div>
                <div class="flex items-start mb-6">
                    <div class="flex items-center h-5">
                    <input id="remember" name="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-green-300">
                    </div>
                    <label for="remember" class="ml-2 text-sm font-medium text-gray-900">Remember me</label>
                </div>
                <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-full px-5 py-2.5 text-center" name="logindsn">Login</button>
            </form>

            <div class=""></div>

        </div>

        <div class="bg-cover bg-center" style="background-image: url(https://images.unsplash.com/photo-1541506618330-7c369fc759b5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=765&q=80)"></div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>
</html>