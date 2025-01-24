<?php
// Fungsi untuk mengurutkan berdasarkan hari
function sortByDayAndTime($a, $b) {
    $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
    $day_a = array_search($a->hari, $days);
    $day_b = array_search($b->hari, $days);

    // Jika hari sama, urutkan berdasarkan waktu
    if ($day_a === $day_b) {
        return strtotime($a->waktu) - strtotime($b->waktu);
    }

    // Jika hari berbeda, urutkan berdasarkan hari
    return $day_a - $day_b;
}

// Ambil data event dari database (misalnya menggunakan $elly)
$events_by_id = [];

// Kelompokkan event berdasarkan id_event
foreach ($elly as $gou) {
    $events_by_id[$gou->id_event][] = $gou;
}
?>

<body>
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'></nav>
                </div>
            </div>
        </div>

        <div class="row" id="table-bordered">
            <div class="col-12">
            <div class="row mb-3">
    <div class="col-12 text-end">
        <button id="toggleBellButton" class="btn btn-primary">Nyala</button>
    </div>
</div>

                    <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">BELL</h4>
                        <h2 id="currentTime" style="font-size: 1.5rem;"></h2> <!-- Menampilkan waktu saat ini -->
                    </div>
                    <div class="card-content">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Bell</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($events_by_id as $id_event => $events) {
                                        // Urutkan detail event berdasarkan hari dan waktu
                                        usort($events, 'sortByDayAndTime');

                                        $first_event = true;
                                        foreach ($events as $gou) {
                                            if ($first_event) {
                                    ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $gou->deskripsi_event ?></td>
                                                    <td>
                                                        <button class="btn btn-info detail-btn">Detail</button>
                                                        <?php
                                                        // Menentukan status tombol berdasarkan status event
                                                        $status_class = ($gou->status == 1) ? 'btn-success' : 'btn-danger';
                                                        $status_text = ($gou->status == 1) ? 'Aktif' : 'Non-Aktif';
                                                        ?>
                                                        <button class="btn <?= $status_class ?> status-btn" data-id-event="<?= $gou->id_event ?>" data-status="<?= $gou->status ?>">
                                                            <?= $status_text ?>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr class="additional-details" style="display: none;" data-id-event="<?= $gou->id_event ?>">
                                                    <td colspan="3">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Hari</th>
                                                                    <th>Keterangan</th>
                                                                    <th>Waktu</th>
                                                                    <th>Suara</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                // Kelompokkan data berdasarkan hari
                                                                $grouped_by_day = [];
                                                                foreach ($events as $event_detail) {
                                                                    $grouped_by_day[$event_detail->hari][] = $event_detail;
                                                                }

                                                                // Tampilkan data dengan hari yang sama dalam satu kolom
                                                                foreach ($grouped_by_day as $hari => $details) {
                                                                    // Urutkan detail berdasarkan waktu
                                                                    usort($details, function ($a, $b) {
                                                                        return strtotime($a->waktu) - strtotime($b->waktu);
                                                                    });
                                                                ?>
                                                                    <tr>
                                                                        <td rowspan="<?= count($details) ?>"><?= $hari ?></td>
                                                                        <?php
                                                                        $first_row = true;
                                                                        foreach ($details as $detail) {
                                                                            if (!$first_row) {
                                                                                echo '<tr>';
                                                                            }
                                                                        ?>
                                                                            <td><?= $detail->keterangan ?></td>
                                                                            <td><?= $detail->waktu ?></td>
                                                                            <td><?= $detail->keterangan_suara ?></td>
                                                                    </tr>
                                                                <?php
                                                                            $first_row = false;
                                                                        }
                                                                    }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                    <?php
                                            }
                                            $first_event = false;
                                        }
                                    }
                                    ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const detailButtons = document.querySelectorAll('.detail-btn');

            detailButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const row = this.closest('tr');
                    const additionalDetails = row.nextElementSibling;

                    // Toggle visibility of additional details
                    if (additionalDetails.style.display === 'none') {
                        additionalDetails.style.display = 'table-row';
                    } else {
                        additionalDetails.style.display = 'none';
                    }
                });
            });

            const statusButtons = document.querySelectorAll('.status-btn');

            statusButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id_event = this.getAttribute('data-id-event');
                    const currentStatus = this.getAttribute('data-status');

                    // Tentukan status baru (jika 1 maka jadi 0, jika 0 jadi 1)
                    const newStatus = (currentStatus == 1) ? 0 : 1;

                    // Tampilkan indikator loading
                    this.disabled = true;
                    const originalText = this.textContent;
                    this.textContent = 'Memperbarui...';

                    // Kirim request untuk mengupdate status
                    fetch(`/update-status/${id_event}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                status: newStatus
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Optimistic UI: Update status tombol langsung
                                this.setAttribute('data-status', newStatus);
                                this.textContent = newStatus == 1 ? 'Aktif' : 'Non-Aktif';
                                this.classList.toggle('btn-success');
                                this.classList.toggle('btn-danger');
                            } else {
                                alert('Gagal memperbarui status: ' + data.message);
                                // Reset tombol jika gagal
                                this.setAttribute('data-status', currentStatus);
                                this.textContent = originalText;
                                this.classList.toggle('btn-success');
                                this.classList.toggle('btn-danger');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan');
                            // Reset tombol jika ada error
                            this.setAttribute('data-status', currentStatus);
                            this.textContent = originalText;
                            this.classList.toggle('btn-success');
                            this.classList.toggle('btn-danger');
                        })
                        .finally(() => {
                            // Hapus loading state
                            this.disabled = false;
                        });
                });
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
    console.log('JavaScript is running');
    
    const events = <?= json_encode($elly) ?>; // Data jadwal dari backend
    const soundFolder = '/sound/'; // Path ke folder suara
    const daysIndo = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

    // Ambil status tombol dari localStorage, default ke false (matikan)
    let bellEnabled = localStorage.getItem('bellEnabled') === 'true'; 

    // Fungsi untuk mengecek dan memutar bel
    function checkEventAndPlayBell() {
    if (!bellEnabled) {
        console.log('Bell is disabled.');
        return;
    }

    const currentDate = new Date();
    const currentDay = daysIndo[currentDate.getDay()];
    const currentTime = currentDate.toTimeString().slice(0, 8);

    console.log('Current Day:', currentDay);
    console.log('Current Time:', currentTime);
    console.log('Events:', events);

    // Mencari semua event yang cocok dengan hari, waktu, dan status aktif
    const matchingEvents = events.filter(e => e.hari === currentDay && e.waktu === currentTime && e.status === 1);

    console.log('Found Events:', matchingEvents);

    if (matchingEvents.length > 0) {
        // Jika ada event yang cocok, mainkan suara untuk setiap event
        matchingEvents.forEach(event => {
            console.log('Playing sound for event:', event);
            playBellSound(event.file);
        });
    } else {
        console.log('No active event found for current time.');
    }
}

    // Fungsi untuk memainkan suara bel
    function playBellSound(file) {
        const audioFile = `${soundFolder}${file}`;
        console.log('Attempting to play:', audioFile);
        const audio = new Audio(audioFile);

        audio.play()
            .then(() => {
                console.log('Audio played successfully!');
            })
            .catch(error => {
                console.error('Error playing audio:', error);
            });
    }

    // Mengaktifkan atau menonaktifkan bel berdasarkan tombol
    const toggleButton = document.getElementById('toggleBellButton');
    
    // Update tombol sesuai dengan status yang ada
    toggleButton.textContent = bellEnabled ? 'Matikan' : 'Nyala';

    toggleButton.addEventListener('click', function() {
        bellEnabled = !bellEnabled; // Toggle status bel
        localStorage.setItem('bellEnabled', bellEnabled); // Simpan status ke localStorage
        const buttonText = bellEnabled ? 'Matikan' : 'Nyala';
        this.textContent = buttonText; // Update teks tombol
    });

    let lastCheckedMinute = null;

    setInterval(() => {
        const now = new Date();
        const currentMinute = now.getMinutes();

        if (currentMinute !== lastCheckedMinute) {
            lastCheckedMinute = currentMinute;
            console.log('Checking events...');
            checkEventAndPlayBell();
        }
    }, 1000);
});


document.addEventListener("DOMContentLoaded", function() {
    // Fungsi untuk memperbarui waktu saat ini
    function updateCurrentTime() {
        const now = new Date();
        const options = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
        const currentTimeString = now.toLocaleTimeString('id-ID', options); // Format waktu dalam Bahasa Indonesia
        document.getElementById('currentTime').textContent = currentTimeString;
    }

    // Panggil fungsi untuk memperbarui waktu saat ini setiap detik
    setInterval(updateCurrentTime, 1000);
    updateCurrentTime(); // Panggil sekali untuk menampilkan waktu saat ini segera
});

    </script>
</body>
</html>
