<?php
session_start();

// Handle logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header("Location: index.php");
    exit;
}

// Handle login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check user from file (very simple example)
    $users = file('users.txt', FILE_IGNORE_NEW_LINES);
    foreach ($users as $user) {
        list($storedUsername, $storedPassword) = explode(':', $user);
        if ($username == $storedUsername && password_verify($password, $storedPassword)) {
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit;
        }
    }

    echo "Login gagal! <a href='index.php'>Coba lagi</a>";
}

// Handle registration
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Save user to file (very simple example)
    file_put_contents('users.txt', $username . ':' . $password . PHP_EOL, FILE_APPEND);

    echo "Registrasi berhasil! <a href='index.php'>Login</a>";
}

// Handle upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image'])) {
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if file is an image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File bukan gambar.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "Maaf, file terlalu besar.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "gif") {
        echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Maaf, file Anda tidak diunggah.";
    // If everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            echo "File " . htmlspecialchars(basename($_FILES["image"]["name"])) . " telah diunggah.";
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file Anda.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram Sederhana</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        
        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
        }

        main {
            padding: 20px;
        }

        img {
            width: 200px;
            height: auto;
            margin: 10px;
        }

        form {
            max-width: 300px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        form p {
            margin: 10px 0;
        }

        form label {
            display: block;
            margin-bottom: 5px;
        }

        form input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Instagram Sederhana</h1>
        <nav>
            <?php if (isset($_SESSION['username'])): ?>
                <a href="index.php?action=logout">Logout</a>
                | <a href="index.php?action=upload">Upload</a>
            <?php else: ?>
                <a href="index.php?action=login">Login</a> |
                <a href="index.php?action=register">Register</a>
            <?php endif; ?>
        </nav>
    </header>
    <main>
        <?php if (isset($_GET['action'])): ?>
            <?php if ($_GET['action'] === 'login'): ?>
                <form action="index.php" method="post">
                    <p>
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required>
                    </p>
                    <p>
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </p>
                    <button type="submit" name="login">Login</button>
                </form>
            <?php elseif ($_GET['action'] === 'register'): ?>
                <form action="index.php" method="post">
                    <p>
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required>
                    </p>
                    <p>
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </p>
                    <button type="submit" name="register">Register</button>
                </form>
            <?php elseif ($_GET['action'] === 'upload'): ?>
                <form action="index.php" method="post" enctype="multipart/form-data">
                    <p>
                        <label for="image">Pilih gambar:</label>
                        <input type="file" id="image" name="image" accept="image/*" required>
                    </p>
                    <button type="submit">Upload</button>
                </form>
            <?php endif; ?>
        <?php else: ?>
            <h2>Gambar Terbaru</h2>
            <?php
            $dir = 'uploads/';
            $images = glob($dir . "*.{jpg,png,gif}", GLOB_BRACE);
            foreach ($images as $image) {
                echo "<img src='$image' alt='Image' />";
            }
            ?>
        <?php endif; ?>
    </main>
</body>
</html>
