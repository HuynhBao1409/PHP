<?php
    require ('inc/essentials.php');
    adminLogin();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin-Dashboard</title>
    <?php require ('inc/links.php'); ?>
</head>
<body class="bg-light">

    <div class="container-flud bg-dark text-light p-3 d-flex align-items-center justify-content-between">
        <h3 class="mb-0">ADMIN PANEL</h3>
        <a href="logout.php" class="btn btn-light btn-sm">Login Out</a>
    </div>

<?php require ('inc/scripts.php'); ?>
</body>
</html>
