<?php
require 'function.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Terminal - Multisoft Communication Pvt. Ltd.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>

    <link href="<?=PUBLIC_URL?>assets/css/vendor.min.css" rel="stylesheet" />
    <link href="<?=PUBLIC_URL?>assets/css/app.min.css" rel="stylesheet" />


    <link href="<?=PUBLIC_URL?>assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <script type="text/javascript" src="<?=PUBLIC_URL?>assets/js/includes/jquery.js" ></script>
    <script type="text/javascript" src="<?=PUBLIC_URL?>assets/js/includes/jqueryui.js" ></script>
    <script type="text/javascript" src="<?=PUBLIC_URL?>assets/js/includes/jquery.mousewheel.min.js" ></script>
    <script type="text/javascript" src="<?=PUBLIC_URL?>assets/js/includes/jquery.iviewer.js" ></script>
    <script type="text/javascript" src="<?=PUBLIC_URL?>assets/js/includes/jquery.iviewer.min.js" ></script>
    <link rel="stylesheet" href="<?=PUBLIC_URL?>assets/css/includes/jquery.iviewer.css" />
    
    
    <style>
        .viewer {
        width: 100%;
        height: 81vh;
        border: 1px solid black;
        position: relative;
        }
        .wrapper {
        overflow: hidden;
        }
    </style>

</head>

<body>
    <div id="app" class="app">

        <div id="header" class="app-header">

            <div class="desktop-toggler">
                <button type="button" class="menu-toggler" data-toggle-class="app-sidebar-collapsed" data-dismiss-class="app-sidebar-toggled" data-toggle-target=".app">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </button>
            </div>


            <div class="mobile-toggler">
                <button type="button" class="menu-toggler" data-toggle-class="app-sidebar-mobile-toggled" data-toggle-target=".app">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </button>
            </div>


            <div class="brand">
                <a href="./" class="brand-logo">
                    <span class="brand-img">
                        <span class="brand-img-text text-theme">M</span>
                    </span>
                    <span class="brand-text text-uppercase">Project <span style="font-size: 9px;letter-spacing: 1px;font-weight: bold;position: absolute;opacity: .5;top: 5px;margin-left: -15px;">.NET CORE 6.0</span>
                </a>
            </div>

            <!-- Navbar Top -->
            <?php include 'navbar-top.php'; ?>


        </div>

        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>


        <button class="app-sidebar-mobile-backdrop" data-toggle-target=".app" data-toggle-class="app-sidebar-mobile-toggled"></button>