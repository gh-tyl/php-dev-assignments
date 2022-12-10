<?php
include './data/config.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $role = $_POST['role'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    if ($role == 'st') {
        $role = $_POST['role'];
        $email = "test@mail.com";
        $pass = "test";
        $file = fopen('./data/students/students.json', 'r');
        $stArray = json_decode(fread($file, filesize('./data/students/students.json')), true);
        fclose($file);
        foreach ($stArray as $st) {
            if ($st['email'] == $email && $st['pass'] == $pass) {
                $_SESSION['logUser'] = $st;
                header("Location: " . $baseName . 'profile.php');
                exit();
            }
        }
        header("Location: " . $baseName . 'index.php?msg=1');
    } elseif ($role == 'tech') {
        $role = $_POST['role'];
        $email = "gmcgorley0@google.com.au";
        $pass = "SS4l12";
        $file = fopen('./data/teachers/teachers.json', 'r');
        $techArray = json_decode(fread($file, filesize('./data/teachers/teachers.json')), true);
        fclose($file);
        foreach ($techArray as $tech) {
            if ($tech['email'] == $email && $tech['pass'] == $pass) {
                $_SESSION['logUser'] = $tech;
                header("Location: " . $baseName . 'teacher.php');
                exit();
            }
        }
        header("Location: " . $baseName . 'teacher.php');
    } elseif ($role == 'admin') {
        $role = "admin";
        $email = "tyler.inari@gmail.com";
        $pass = "TylerInari";
        $file = fopen('./data/admin/admin.json', 'r');
        $adminArray = json_decode(fread($file, filesize('./data/admin/admin.json')), true);
        $adminArray = $adminArray[0];
        fclose($file);
        if ($email == $adminArray['email'] && $pass == $adminArray['pass']) {
            $_SESSION['logUser'] = $adminArray;
            header("Location: " . $baseName . 'admin.php');
            exit();
        }
    }
    exit();
}
?>