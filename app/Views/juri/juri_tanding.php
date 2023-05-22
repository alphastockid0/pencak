    <div id="app">
        <?php if ($data) { ?>
            <div class="main">
                <div class="mt-2">
                    <div id="tag-name" class="col-12">
                        <div class="row justify-content-center mx-1">
                            <div class="col-md-4">
                                <div class="card bg-danger">
                                    <div class="card-body text-wrap">
                                        <h5 class="nm_merah"><?= $data->nm_merah ?? ''; ?></h6>
                                    </div>
                                </div>
                                <div class="card bg-danger col-md-10">
                                    <div class="card-body">
                                        <h6 class="kontingen_merah"><?= $data->kontingen_merah ?? ''; ?></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card border col-md-1 border-5 border-danger justify-content-center px-0 pb-0">
                                <h1 class="nilai_merah text-center px-0 my-0 text-danger"><?= $data->nilai_merah ?? ''; ?></h1>
                            </div>
                            <div class="col-sm-2 mx-auto text-center justify-content-center">
                                <div class="card bg-dark col-md-12 mx-auto text-center align-items-center">
                                    <div class="card-body text-center">
                                        <h6 class="kelas" style="font-size: 12px;"><?= $data->kelas ?? ''; ?></h6>
                                    </div>
                                </div>
                                <div class="card col-md-8 bg-dark mt-1 mx-auto text-center align-items-center">
                                    <div class="d-flex text-center">
                                        <h6 style="font-size: 12px; color:aliceblue">PARTAI</br>
                                            <span class="active_partai" style="font-size: 28px; margin: 0px;"><?= $data->partai ?? ''; ?></span>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card border col-md-1 border-5 border-primary justify-content-center px-0 pb-0">
                                <h1 class="nilai_biru text-center px-0 my-0 text-primary"><?= $data->nilai_biru ?? ''; ?></h1>
                            </div>
                            <div class="col-sm-4">
                                <div class="card bg-primary">
                                    <div class="card-body text-wrap">
                                        <h5 class="nm_biru text-end"><?= $data->nm_biru ?? ''; ?></h5>
                                    </div>
                                </div>

                                <div class="card bg-primary col-md-10 offset-md-2">
                                    <div class="card-body d-grid place-items-center">
                                        <h6 class="kontingen_biru"><?= $data->kontingen_merah ?? ''; ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-1">
                    <div class="col-md-3 float-start">
                        <div class="col-md-12">
                            <button class="punch btn text-start" onclick="juri(this.value,1,'punch')" value="merah">
                                <img src="<?= base_url('HTML/assets/img/punch.png') ?>" alt="punch" style="max-width: 200px;">
                            </button>
                        </div>
                        <div class="col-md-12">
                            <button class="kick btn text-start" onclick="juri(this.value,2,'kick')" value="merah">
                                <img src="<?= base_url('HTML/assets/img/kick.png') ?>" alt="kick" style="max-width: 200px;">
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6 justify-content-center">
                        <div class="row">
                            <div class="col-md-4">
                                <h6 class="text-center col-12 mb-0 mt-5">Punch Correction</h6>
                                <div class="row mt-0">
                                    <div class="col-md-2 px-0 py-0 border border-danger border-4 mx-auto text-center">
                                        <h6 class="text-center my-0">1</h6>
                                    </div>
                                    <div class="col-md-2 px-0 py-0 border border-danger border-4 mx-auto text-center">
                                        <h6 class="text-center my-0">1</h6>
                                    </div>
                                    <div class="col-md-2 px-0 py-0 border border-danger border-4 mx-auto text-center">
                                        <h6 class="text-center my-0">1</h6>
                                    </div>
                                    <!-- <div class="col-md-2 px-0 py-0 border border-danger border-4 mx-auto text-center">
                                    <h6 class="text-center my-0">1</h6>
                                </div>
                                <div class="col-md-2 px-0 py-0 border border-danger border-4 mx-auto text-center">
                                    <h6 class="text-center my-0">1</h6>
                                </div> -->
                                </div>
                                <h6 class="text-center col-12 mb-0 mt-1">Kick Correction</h6>
                                <div class="row mt-0 justify-content-center">
                                    <div class="col-md-2 px-0 py-0 border border-danger border-4 mx-auto text-center">
                                        <h6 class="text-center my-0">2</h6>
                                    </div>
                                    <div class="col-md-2 px-0 py-0 border border-danger border-4 mx-auto text-center">
                                        <h6 class="text-center my-0">2</h6>
                                    </div>
                                    <div class="col-md-2 px-0 py-0 border border-danger border-4 mx-auto text-center">
                                        <h6 class="text-center my-0">2</h6>
                                    </div>
                                    <!-- <div class="col-md-2 px-0 py-0 border border-danger border-4 mx-auto text-center">
                                    <h6 class="text-center my-0">2</h6>
                                </div>
                                <div class="col-md-2 px-0 py-0 border border-danger border-4 mx-auto text-center">
                                    <h6 class="text-center my-0">2</h6> -->
                                    <!-- </div> -->
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card col-7 mt-4 mx-auto border border-5 border-dark px-0 justify-content-center">
                                    <div class="card-body text-center px-0 pb-0">
                                        <h1 class="text-dark mb-1" style="font-size: 16px; margin:0; padding:0;">ROUND</br></h1>
                                        <h1 class="active_babak text-dark"><?= $data->active_babak ?? ''; ?></h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 float-end">
                                <h6 class="text-center col-12 mb-0 mt-5">Punch Correction</h6>
                                <div class="row mt-0">
                                    <div class="col-md-2 px-0 py-0 border border-primary border-4 mx-auto text-center">
                                        <h6 class="text-center my-0">1</h6>
                                    </div>
                                    <div class="col-md-2 px-0 py-0 border border-primary border-4 mx-auto text-center">
                                        <h6 class="text-center my-0">1</h6>
                                    </div>
                                    <div class="col-md-2 px-0 py-0 border border-primary border-4 mx-auto text-center">
                                        <h6 class="text-center my-0">1</h6>
                                    </div>
                                    <!-- <div class="col-md-2 px-0 py-0 border border-primary border-4 mx-auto text-center">
                                    <h6 class="text-center my-0">1</h6>
                                </div>
                                <div class="col-md-2 px-0 py-0 border border-primary border-4 mx-auto text-center">
                                    <h6 class="text-center my-0">1</h6>
                                </div> -->
                                </div>
                                <h6 class="text-center col-12 mb-0 mt-1">Kick Correction</h6>
                                <div class="row mt-0 justify-content-center">
                                    <div class="col-md-2 px-0 py-0 border border-primary border-4 mx-auto text-center">
                                        <h6 class="text-center my-0">2</h6>
                                    </div>
                                    <div class="col-md-2 px-0 py-0 border border-primary border-4 mx-auto text-center">
                                        <h6 class="text-center my-0">2</h6>
                                    </div>
                                    <div class="col-md-2 px-0 py-0 border border-primary border-4 mx-auto text-center">
                                        <h6 class="text-center my-0">2</h6>
                                    </div>
                                    <!-- <div class="col-md-2 px-0 py-0 border border-primary border-4 mx-auto text-center">
                                    <h6 class="text-center my-0">2</h6>
                                </div>
                                <div class="col-md-2 px-0 py-0 border border-primary border-4 mx-auto text-center">
                                    <h6 class="text-center my-0">2</h6> -->
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>

                        <div class="card bg-dark col-md-2 mx-auto text-center px-0 py-0 mt-1 mb-1 d-flex align-items-center justify-content-center" style="max-height: 25px;">
                            <h6 class="user text-white mt-1" style="font-size: 14px;">JURI <?= $juri['juri_number']; ?></h6>
                        </div>
                        <div class="card bg-dark col-md-7 mx-auto text-center px-0 py-0 d-flex align-items-center justify-content-center" style="max-height: 25px;">
                            <h6 class="username text-white mt-1" style="font-size: 14px;"><?= $juri['nama']; ?></h6>
                        </div>
                        <div class="card bg-dark col-md-7 mx-auto mt-1 text-center px-0 py-0 d-flex align-items-center justify-content-center" style="max-height: 25px;">
                            <h6 class="gelanggang text-warning mt-1" style="font-size: 14px;">Gelanggang <span id="gelanggang"><?= $data->gelanggang ?? ''; ?></span></h6>
                        </div>

                    </div>
                    <div class="col-md-3 text-end">
                        <div class="col-md-12">
                            <button class="punch btn float-end" onclick="juri(this.value,1,'punch')" value="biru">
                                <img src="<?= base_url('HTML/assets/img/punch.png') ?>" alt="punch" style="max-width: 200px;">
                            </button>
                        </div>
                        <div class="col-md-12">
                            <button class="kick btn float-end" onclick="juri(this.value,2,'kick')" value="biru">
                                <img src="<?= base_url('HTML/assets/img/kick.png') ?>" alt="kick" style="max-width: 200px;">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div id="loading" class="load-body">
                <div class="triangle-wrapper">
                    <div class="triangle triangle-1"></div>
                    <div class="triangle triangle-2"></div>
                    <div class="triangle triangle-3"></div>
                    <div class="triangle triangle-4"></div>
                    <div class="triangle triangle-5"></div>
                    <!-- <p class="triangle-loading">Loading</p> -->
                    <h1 class="triangle-loading">Mencari Data Tanding</h1>
                </div>
            </div>

        <?php } ?>
        <div class="footer">
            <marquee class="fixed-bottom bg-dark text-white mt-2" scrollamount="20" behavior="scroll" direction="left">Pekan Olahraga Daerah Tingkat Kab.Purworejo Tahun Anggaran 2023. Tingkatkan Prestasi , Jaga Sportifitas</marquee>
        </div>
    </div>

    <script>
        'use strict';

        (function() {
            var $triangles = document.querySelectorAll('.triangle');
            var template = '<svg class="triangle-svg" viewBox="0 0 140 141">\n    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n      <polygon class="triangle-polygon"  points="70 6 136 138 4 138"></polygon>\n    </g>\n  </svg>';

            Array.prototype.forEach.call($triangles, function($triangle, index) {
                $triangle.innerHTML = template;
            });
        })();

        function juri(sudut, val, type) {
            if (document.querySelector('.active_babak').innerHTML == '0') {
                playSound('<?= base_url('HTML/assets/mp3/wrong.mp3') ?>', 2);
            } else {
                playSound('<?= base_url('HTML/assets/mp3/button.mp3') ?>', 1);
                var data = {
                    'sudut': sudut,
                    'ket': type,
                    'partai': document.querySelector('.active_partai').innerHTML,
                    'gelanggang': document.querySelector('#gelanggang').innerHTML,
                    'babak': document.querySelector('.active_babak').innerHTML,
                    'user': document.querySelector('.user').innerHTML.toLowerCase(),
                    'value': val,
                    'id_partai': '<?= $data->id_partai; ?>',
                };
                $.ajax({
                    url: '<?= base_url('juri/input') ?>',
                    data: data,
                    method: 'POST',
                    success: function(data) {
                        console.log(data);
                    },
                });
            }
        }

        function playSound(path, count = 1) {
            var audio = new Audio(path);
            var iteration = 0;

            audio.addEventListener("ended", function() {
                iteration++;
                if (iteration < count) {
                    audio.currentTime = 0;
                    audio.play();
                }
            });

            audio.play();
        }

        // Membuat koneksi WebSocket
        var socket = new WebSocket('ws://192.168.43.100:8080');

        // Mengatur event listener ketika koneksi terbuka
        socket.onopen = function(event) {
            console.log('Koneksi terbuka');
        };

        // Mengatur event listener untuk menerima pesan dari server
        socket.onmessage = function(event) {
            console.log(event);
            var message = event.data;
            console.log('Menerima pesan dari server:', message);
            // Lakukan tindakan yang sesuai dengan pesan yang diterima
        };

        // Mengatur event listener ketika koneksi ditutup
        socket.onclose = function(event) {
            console.log('Koneksi ditutup');
        };

        // Mengirim pesan ke server
        function sendMessage(message) {
            socket.send(message);
        }
    </script>