<!DOCTYPE html>
<html>
    <head>
        <title>Juriscape Student System</title>
        <link rel="stylesheet" href="<?php echo $fnc->baseurl('resources/fontawesome/css/all.min.css'); ?>" />
        <link rel="stylesheet" href="<?php echo $fnc->baseurl('resources/css/bootstrap.min.css'); ?>" />
        <link rel="stylesheet" href="<?php echo $fnc->baseurl('resources/css/style.css'); ?>" />
        <link rel="stylesheet" href="<?php echo $fnc->baseurl('resources/css/dataTables.bootstrap4.css'); ?>" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <link rel="stylesheet" href="<?php echo $fnc->baseurl('resources/select2/select2.min.css'); ?>" />
    </head>
    <body>
        <div class="wrapper">
            <header>
                <div class="header-container mb-5">
                    <div class="firstdiv">
                        <a href="#">
                            <img src="https://via.placeholder.com/200x68.png/000000/0000FF?text=Juriscape+Student+System" />
                        </a>
                    </div>
                    <div class="seconddiv">
                        <div class="d-inline-block align-top ml-3" title="Sign Out">
                            <a href="<?php echo $fnc->authurl('sign-out'); ?>">
                                <div class="menulink">
                                    <i class="fas fa-sign-out-alt"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </header>