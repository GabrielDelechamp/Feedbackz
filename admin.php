<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DynaPuff:wght@400..700&display=swap')
    </style>
</head>
<body>
    <header>
        <?php
        include('includes/header.php');
       ?>
    </header>
    <div class="admin-container horizontal-flex-container">
        <a href="admin_param.php?type=articles">Articles</a>
        <a href="admin_param.php?type=page">Pages</a>
        <a href="admin_param.php?type=contact">Contact</a>
    </div>
    <footer>
    <?php
    include('includes/footer.php');
    ?>
    </footer>
</body>
</html>