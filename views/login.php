<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Acceso al sistema</title>

    <!-- Custom fonts for this template-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo RUTA . 'assets/'; ?>css/login.css" rel="stylesheet">
    <link href="<?php echo RUTA . 'assets/'; ?>css/snackbar.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo RUTA . 'assets/'; ?>css/animate.min.css"/>
</head>

<body>

    <div class="wrapper">
        <form class="login animate__animated animate__rotateInUpLeft" id="frmLogin" autocomplete="off">
            <p class="title">Login</p>
            <input type="text" class="animate__animated animate__slideInDown" placeholder="E-mail" id="email" autofocus />
            <input type="password" class="animate__animated animate__slideInUp" id="password" placeholder="Password" />
            <button type="submit">
                <i class="spinner"></i>
                <span class="state">Login</span>
            </button>
        </form>
        <footer><a target="blank" href="https://sistemasfree.com/">Site</a></footer>
    </div>

    <script src="<?php echo RUTA . 'assets/'; ?>vendor/js/jquery.min.js"></script>
    <script src="<?php echo RUTA . 'assets/'; ?>js/snackbar.min.js"></script>
    <script src="<?php echo RUTA . 'assets/'; ?>js/axios.min.js"></script>
    <script>
        const ruta = '<?php echo RUTA; ?>';
    </script>
    <script src="<?php echo RUTA . 'assets/'; ?>js/login.js"></script>
</body>

</html>