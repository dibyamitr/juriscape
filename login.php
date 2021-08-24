<?php
ob_start();
session_start();
require_once "core/functions.php";
$fnc=new Functions();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Juriscape Student System</title>
        <link rel="stylesheet" href="<?php echo $fnc->baseurl('resources/css/bootstrap.min.css'); ?>" />
        <link rel="stylesheet" href="<?php echo $fnc->baseurl('resources/css/style.css'); ?>" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    </head>
    <body class="login">
        <div class="login-box">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <img src="https://via.placeholder.com/250x80.png/000000/0000FF?text=Juriscape+Student+System" />
                    </div>
                    <form action="<?php echo $fnc->siteurl('security/login'); ?>">
                        <div class="form-input mt-3">
                            <input type="email" class="form-control fieldval" name="email" autocomplete="off" placeholder="Email" />
                        </div>
                        <div class="form-input mt-3">
                            <input type="password" class="form-control fieldval" name="password" autocomplete="off" placeholder="Password" />
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="button" class="btn btn-primary btn-block ajaxsubmit">Sign In</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <footer>
            <p class="fieldtext">&copy; <?php echo date('Y'); ?> Juriscape Student System. All rights reserved.</p>
        </footer>
        <script src="<?php echo $fnc->baseurl('resources/js/jquery.min.js'); ?>"></script>
        <script src="<?php echo $fnc->baseurl('resources/js/bootstrap.min.js'); ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="<?php echo $fnc->baseurl('resources/js/developer.min.js'); ?>" baseurl="<?php echo $fnc->baseurl(); ?>"></script>
        <script src="https://kit.fontawesome.com/27c0c407f9.js" crossorigin="anonymous"></script>
    </body>
</html>
<?php
ob_end_flush();
?>