
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
    <h4 class="card-title">USER</h4>

    <!-- Tombol Tambah dan Field Pencarian di Kanan -->
    <div class="d-flex">
        <div class="input-group me-2" style="max-width: 300px;">
            <input type="text" id="searchInput" class="form-control" placeholder="Cari">
            <button class="btn btn-warning" onclick="filterTable()">Cari</button>
        </div>
        <button class="btn btn-success" onclick="loadAdduserForm()">Tambah</button>
    </div>
</div>

                <div class="card-content">
                    <!-- table bordered -->
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Level</th>
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
                                    <td><?=$gou->nama_user?></td>
                                    <td>
                                        <?php 
                                            switch($gou->level){
                                                case 1: echo "Admin"; break;
                                    
                                            }
                                        ?>
                                    </td>
                                    <td>
    <div class="dropdown">
        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="actionMenu" data-bs-toggle="dropdown" aria-expanded="false">
            Aksi
        </button>
        <ul class="dropdown-menu" aria-labelledby="actionMenu">
        <li>
        <li><a class="dropdown-item" onclick="loadEdituserForm(<?= $gou->id_user ?>)">Edit</a></li>

</li>

<li><a class="dropdown-item" href="{{ route('home.hapususer', $gou->id_user) }}">Hapus</a></li>
<li><a class="dropdown-item" href="{{ route('home.aksi_reset', $gou->id_user) }}">Reset</a></li>

            <?php if (isset($backup_users[$gou->id_user])): ?>
            <li>
            <a class="dropdown-item" onclick="loadUndoEdituserForm(<?= $gou->id_user ?>)">Undo Edit
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
            const namaCell = rows[i].getElementsByTagName("td")[1];
            const levelCell = rows[i].getElementsByTagName("td")[2];
            const namaText = namaCell ? namaCell.textContent.toLowerCase() : "";
            const levelText = levelCell ? levelCell.textContent.toLowerCase() : "";

            if (namaText.includes(searchInput) || levelText.includes(searchInput)) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }

    
    // Load Add Jurusan Form
    function loadAdduserForm() {
        fetch("{{ route('home.tambah_user') }}")
                .then(response => response.text())
                .then(data => {
                    document.getElementById('dynamicContent').innerHTML = data;
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memuat form tambah user.');
                });
        }

        function loadEdituserForm(id_user) {
    fetch("{{ url('home/edit_user') }}/" + id_user)
        .then(response => response.text())
        .then(data => {
            document.getElementById('dynamicContent').innerHTML = data;
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memuat form edit user.');
        });
}


        // Load Undo Edit Jurusan Form
        function loadUndoEdituserForm(id_user) {
            fetch("{{ url('home/undo_edit_user') }}/" + id_user)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('dynamicContent').innerHTML = data;
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memuat form undo edit user.');
                });
        }

        

</script>



</body>

