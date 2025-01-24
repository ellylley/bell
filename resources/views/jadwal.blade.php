
<style>
        .disabled-field {
    pointer-events: none;
    background-color: #e9ecef; /* Optional: change the background color to indicate it's disabled */
}
.img-circle {
    border-radius: 50%;
    width: 150px; /* Sesuaikan ukuran yang diinginkan */
    height: 150px; /* Sesuaikan ukuran yang diinginkan */
    object-fit: cover;
}

        </style>

<body>
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'></nav>
            </div>
        </div>
    </div>
    <div id="dynamicContent">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
    <h4 class="card-title">JADWAL</h4>

    <!-- Tombol Tambah dan Field Pencarian di Kanan -->
    <div class="d-flex">
        <div class="input-group me-2" style="max-width: 300px;">
            <input type="text" id="searchInput" class="form-control" placeholder="Cari">
            <button class="btn btn-warning" onclick="filterTable()">Cari</button>
        </div>
        <button class="btn btn-success" onclick="loadAddeventForm()">Tambah</button>
    </div>
</div>

                <div class="card-content">
                    <!-- table bordered -->
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Bell</th>
                                    <th>Hari</th>
                                    <th>Keterangan</th>
                                    <th>Waktu</th>
                                    <th>Suara</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach($elly as $gou){
                                    if ($gou->isdelete == 0) {  
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?=$gou->deskripsi_event?></td>
                                    <td><?=$gou->hari?></td>
                                    <td><?=$gou->keterangan?></td>
                                    <td><?=$gou->waktu?></td>
                                    <td><?=$gou->keterangan_suara?></td>
                                    
                                    <td>
    <div class="dropdown">
        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="actionMenu" data-bs-toggle="dropdown" aria-expanded="false">
            Aksi
        </button>
        <ul class="dropdown-menu" aria-labelledby="actionMenu">
        <li>
        <li><a class="dropdown-item" onclick="loadEditeventForm(<?= $gou->id_jadwal ?>)">Edit</a></li>

</li>

<li><a class="dropdown-item" href="{{ route('home.hapusjadwal', $gou->id_jadwal) }}">Hapus</a></li>

            <?php if (isset($backup_jadwal[$gou->id_jadwal])): ?>
            <li>
            <a class="dropdown-item" onclick="loadUndoEditeventForm(<?= $gou->id_jadwal ?>)">Undo Edit
            </li>
            <?php endif; ?>
        </ul>
    </div>
</td>


                                </tr>
                                <?php
                                    }}
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Script to populate edit modal with existing data -->
<script>
    function filterTable() {
        const searchInput = document.getElementById("searchInput").value.toLowerCase();
        const table = document.querySelector("table tbody");
        const rows = table.getElementsByTagName("tr");

        for (let i = 0; i < rows.length; i++) {
            const satuCell = rows[i].getElementsByTagName("td")[1];
            const satuText = satuCell ? satuCell.textContent.toLowerCase() : "";
            const duaCell = rows[i].getElementsByTagName("td")[2];
            const duaText = duaCell ? duaCell.textContent.toLowerCase() : "";
            const tigaCell = rows[i].getElementsByTagName("td")[3];
            const tigaText = tigaCell ? tigaCell.textContent.toLowerCase() : "";
            const empatCell = rows[i].getElementsByTagName("td")[4];
            const empatText = empatCell ? empatCell.textContent.toLowerCase() : "";
            const limaCell = rows[i].getElementsByTagName("td")[5];
            const limaText = limaCell ? limaCell.textContent.toLowerCase() : "";

            if (satuText.includes(searchInput) || duaText.includes(searchInput)|| tigaText.includes(searchInput)|| empatText.includes(searchInput)|| limaText.includes(searchInput)) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }

    
    // Load Add Jurusan Form
    function loadAddeventForm() {
        fetch("{{ route('home.tambah_jadwal') }}")
                .then(response => response.text())
                .then(data => {
                    document.getElementById('dynamicContent').innerHTML = data;
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memuat form tambah jadwal.');
                });
        }

        function loadEditeventForm(id_jadwal) {
    fetch("{{ url('home/edit_jadwal') }}/" + id_jadwal)
        .then(response => response.text())
        .then(data => {
            document.getElementById('dynamicContent').innerHTML = data;
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memuat form edit jadwal.');
        });
}


        // Load Undo Edit Jurusan Form
        function loadUndoEditeventForm(id_jadwal) {
            fetch("{{ url('home/undo_edit_jadwal') }}/" + id_jadwal)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('dynamicContent').innerHTML = data;
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memuat form undo edit jadwal.');
                });
        }

        

</script>



</body>

