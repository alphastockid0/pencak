<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="<?= base_url('vendor/twbs/bootstrap/dist/css/bootstrap.min.css') ?>">
    <!-- fontawesome -->
    <link rel="stylesheet" href="<?= base_url('vendor/fortawesome/font-awesome/css/all.min.css'); ?>">
    <!-- sweetalert2 -->
    <link rel="stylesheet" href="<?= base_url('node_modules/sweetalert2/dist/sweetalert2.min.css'); ?>">
    <!-- CSS File -->
    <link rel="stylesheet" href="<?= base_url('HTML/bootstrap-icons/bootstrap-icons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('HTML/assets/css/pencak.css') ?>">
    <!-- socket -->
    <script src="<?= base_url('node_modules/socket.io-client/dist/socket.io.js') ?>"></script>
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
    <div id="main">
        <div class="login">
            <div class="form-group">
                <h2 class="text-center">Halo <?= $juri['nama']; ?></h2>
                <small class="text-center text-success">Silahkan pilih posisi Anda saat ini</small>
            </div>
            <form id="jurror-sign" action="" method="post" class="needs-validation">
                <div class="form-group was-validated">
                    <label class="form-label" for="gelanggang">Gelanggang</label>
                    <select class="form-select text-center" name="gelanggang" id="gelanggang">
                        <option value="" hidden selected>-- silakan pilih --</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                    </select>
                    <div class="invalid-feedback">
                        Silahkan Pilih Gelanggang
                    </div>
                </div>
                <div class="form-group was-validated">
                    <label class="form-label" for="juri_number">Posisi Juri</label>
                    <select class="form-select text-center" name="juri_number" id="juri_number">
                        <option value="" hidden selected>-- silakan pilih --</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                    <div class="invalid-feedback">
                        Silahkan Pilih Posisi Juri
                    </div>
                </div>
                <input id="submit" class="btn btn-success w-100" type="submit" value="submit" disabled>
                <hr>
                <a href="#" id="logout" class="btn btn-danger w-100">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Log Out</span>
                </a>
            </form>

        </div>
    </div>
    <!-- bootstrap -->
    <script src="<?= base_url('vendor/twbs/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- jquery -->
    <script src="<?= base_url('vendor/axllent/jquery/jquery.min.js') ?>"></script>
    <!-- fontawesome -->
    <script src="<?= base_url('vendor/fortawesome/font-awesome/js/all.min.js'); ?>"></script>
    <!-- sweetalert2 -->
    <script src="<?= base_url('node_modules/sweetalert2/dist/sweetalert2.all.min.js'); ?>"></script>

    <script>
        $('select').click(function() {
            if ($(this).val() === '') {
                $(this).addClass('is-invalid');
                $('input[type=submit]').attr('disabled', true); // menonaktifkan tombol submit
            } else {
                $(this).removeClass('is-invalid');
                // mengaktifkan tombol submit jika semua select memiliki nilai
                if ($('select').filter(function() {
                        return $(this).val() === '';
                    }).length === 0) {
                    $('input[type=submit]').removeAttr('disabled');
                }
            }
        });

        // saat tombol logout di klik
        $('#logout').click(function() {
            // tampilkan kotak konfirmasi SweetAlert
            Swal.fire({
                title: 'Anda yakin ingin logout?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                // jika user mengklik tombol 'Ya'
                if (result.isConfirmed) {
                    // lakukan logout
                    $.ajax({
                        type: 'POST',
                        url: '<?= base_url('logout') ?>',
                        success: function(response) {
                            // redirect ke halaman login
                            window.location.href = '<?= base_url('login') ?>';
                        },
                        error: function(error) {
                            // tampilkan pesan error
                            console.log(error);
                            Swal.fire({
                                title: 'Terjadi Kesalahan',
                                text: 'Gagal melakukan logout. Silakan coba lagi.',
                                icon: 'error',
                                confirmButtonText: 'Tutup',
                            });
                        }
                    });
                }
            });
        });


        $('#submit').click(function(e) {
            e.preventDefault();
            var formdata = $('#jurror-sign').serialize();
            // tampilkan kotak konfirmasi SweetAlert
            Swal.fire({
                title: 'Apakah semua sudah benar?',
                icon: 'warning',
                html: '<p>Gelanggang : ' + $('select[name=gelanggang]').val() + '</br>Posisi Juri : ' + $('select[name=juri_number]').val() + '</p>',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                // jika user mengklik tombol 'Ya'
                if (result.isConfirmed) {
                    // lakukan logout
                    $.ajax({
                        url: '<?= base_url('juri') ?>',
                        data: formdata,
                        method: 'POST',
                        success: function(response) {
                            console.log('success');
                            $('#main').html(response);
                        },
                        error: function(error) {
                            // tampilkan pesan error
                            console.log(error);
                            Swal.fire({
                                title: 'Terjadi Kesalahan',
                                text: 'Gagal melakukan logout. Silakan coba lagi.',
                                icon: 'error',
                                confirmButtonText: 'Tutup',
                            });
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>