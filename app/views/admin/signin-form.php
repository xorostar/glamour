<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?php getLink('css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php getLink('css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?php getLink('css/dashboard-style.css'); ?>">
    <link rel="icon" href="<?php getLink('img/logo.ico'); ?>" type="image/x-icon">
    <title>Admin Panel</title>
    <style>
    html,
    body {
        height: 100%;
    }

    .form-container {
        height: 100%;
        display: -ms-flexbox;
        display: -webkit-box;
        display: flex;
        -ms-flex-align: center;
        -ms-flex-pack: center;
        -webkit-box-align: center;
        align-items: center;
        -webkit-box-pack: center;
        justify-content: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
    }

    .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
    }

    .form-signin .checkbox {
        font-weight: 400;
    }

    .form-signin .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
    }

    .form-signin .form-control:focus {
        z-index: 2;
    }

    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
    </style>
</head>

<body>
    <div class="form-container text-center">
        <form class="form-signin" action="<?php getLink('admin/login'); ?>" method="post">
            <img class="mb-4" src="<?php getLink('img/logo.ico'); ?>" alt="" width="100" height="100">
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
            <label for="username" class="sr-only">Username</label>
            <input type="text" id="username" class="form-control" name="username" placeholder="Username" required
                autofocus>
            <label for="password" class="sr-only">Password</label>
            <input type="password" id="password" class="form-control" name="password" placeholder="Password" required>
            <?php flash('login_failed'); ?>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2019-2020</p>
        </form>
    </div>
    <script src="<?php getLink('js/jquery.min.js'); ?>"></script>
    <script src="<?php getLink('js/popper.min.js'); ?>"></script>
    <script src="<?php getLink('js/bootstrap.min.js'); ?>"></script>
    <script src="<?php getLink('js/feather.min.js'); ?>"></script>
    <script>
    feather.replace();
    </script>
</body>

</html>