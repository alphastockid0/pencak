<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="<?= base_url('vendor/twbs/bootstrap/dist/css/bootstrap.min.css') ?>">
    <!-- CSS File -->
    <link rel="stylesheet" href="<?= base_url('node_modules/boxicons/css/boxicons.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('HTML/assets/css/style.css') ?>">

</head>

<body id="body-pd">
    <div class="container">
        <header class="header" id="header">
            <div class="header_toggle">
                <i class='bx bx-menu' id="header-toggle"></i>
            </div>
            <div class="row justify-content-center my-2">
                <div class="header_img">
                    <img src="<?= base_url('HTML/assets/img/avatar.png') ?>" alt="">
                </div>
                <small class="text-center"><?= $namaLengkap; ?></small>
            </div>
        </header>
        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <div class="nav_list">
                        <a href="#" class="nav_link active"> <i class='bx bx-grid-alt nav_icon'></i>
                            <span class="nav_name">Dashboard</span>
                        </a>
                        <a href="#" class="nav_link">
                            <i class='bx bx-user nav_icon'></i>
                            <span class="nav_name">Users</span>
                        </a>
                        <a href="#" class="nav_link">
                            <i class='bx bx-message-square-detail nav_icon'></i>
                            <span class="nav_name">Messages</span>
                        </a>
                        <a href="#" class="nav_link">
                            <i class='bx bx-bookmark nav_icon'></i>
                            <span class="nav_name">Bookmark</span>
                        </a>
                        <a href="#" class="nav_link">
                            <i class='bx bx-folder nav_icon'></i>
                            <span class="nav_name">Files</span>
                        </a>
                        <a href="#" class="nav_link">
                            <i class='bx bx-bar-chart-alt-2 nav_icon'></i>
                            <span class="nav_name">Stats</span>
                        </a>
                    </div>
                </div>
                <a href="<?= base_url('logout')?>" class="nav_link">
                    <i class='bx bx-log-out nav_icon'></i>
                    <span class="nav_name">SignOut</span>
                </a>
            </nav>
        </div>
        <!--Container Main start-->
        <div class="height-100 bg-light">
            <h1>Pertandingan</h1>
            <p>Mulai Pertandingan</p>
            <a id="start" onclick="return mulai(true)" class="mulai btn btn-large btn-primary" href="#">Start</a>
            <a id="stop" onclick="return mulai(false)" class="mulai btn btn-large btn-primary" href="#">Stop</a>
        </div>
        <!--Container Main end-->
    </div>
    <script src="<?= base_url('vendor/twbs/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- jquery -->
    <script src="<?= base_url('vendor/axllent/jquery/jquery.min.js') ?>"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {

            const showNavbar = (toggleId, navId, bodyId, headerId) => {
                const toggle = document.getElementById(toggleId),
                    nav = document.getElementById(navId),
                    bodypd = document.getElementById(bodyId),
                    headerpd = document.getElementById(headerId)

                // Validate that all variables exist
                if (toggle && nav && bodypd && headerpd) {
                    toggle.addEventListener('click', () => {
                        // show navbar
                        nav.classList.toggle('show')
                        // change icon
                        toggle.classList.toggle('bx-x')
                        // add padding to body
                        bodypd.classList.toggle('body-pd')
                        // add padding to header
                        headerpd.classList.toggle('body-pd')
                    })
                }
            }

            showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

            /*===== LINK ACTIVE =====*/
            const linkColor = document.querySelectorAll('.nav_link')

            function colorLink() {
                if (linkColor) {
                    linkColor.forEach(l => l.classList.remove('active'))
                    this.classList.add('active')
                }
            }
            linkColor.forEach(l => l.addEventListener('click', colorLink))

            // Your code to run since DOM is loaded and ready
        });
    </script>
    <script>
        function mulai(cond) {
            $.ajax({
                url: "<?= base_url('juri/start') ?>",
                data: {
                    'start': cond,
                    'gelanggang': 'A'
                },
                method: "GET",
                success: function (data) {
                    console.log(data);
                }
            })
        }
    </script>

</body>

</html>