<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?= base_url('vendor/twbs/bootstrap/dist/css/bootstrap.min.css'); ?>">
    <!-- CSS File -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #c0d5f5;
        }

        .login {
            width: 360px;
            height: min-content;
            padding: 20px;
            border-radius: 12px;
            background: #ffffff;
        }

        .login h1 {
            font-size: 36px;
            margin-bottom: 25px;
        }

        .login form {
            font-size: 20px;
        }

        .login form .form-group {
            margin-bottom: 12px;
        }

        .login form input[type="submit"] {
            font-size: 20px;
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <div class="login">
        <h1 class="text-center">Sign In</h1>
        <form method="post" action="<?= base_url('login') ?>" class="needs-validation">
            <div class="form-group was-validated">
                <label class="form-label" for="username">username</label>
                <input class="form-control" name="username" type="username" id="username" required>
                <div class="invalid-feedback">
                    Please enter your username
                </div>
            </div>
            <div class="form-group was-validated">
                <label class="form-label" for="password">Password</label>
                <input class="form-control" name="password" type="password" id="password" required>
                <div class="invalid-feedback">
                    Please enter your password
                </div>
            </div>
            <input class="btn btn-success w-100" type="submit" value="SIGN IN">
        </form>

    </div>
    
    <script src="<?= base_url('vendor/twbs/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- jquery -->
    <script src="<?= base_url('vendor/axllent/jquery/jquery.min.js') ?>"></script>
    <script>
        
    </script>
</body>

</html>