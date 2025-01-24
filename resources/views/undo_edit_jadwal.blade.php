<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                </nav>
            </div>
        </div>
    </div>
    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">

                    <a href="{{ url('home/jadwal') }}" class="d-flex justify-content-end">
    <button class="btn btn-danger">Back</button>
</a>
                        <h4 class="card-title">Undo Edit</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ url('home/aksi_unedit_jadwal') }}" method="POST" enctype="multipart/form-data">
                                <div class="row">


                                <div class="col-md-12 col-12">
                                <label>Deskripsi Event</label>
                            <div class="form-group">
                            <select class="form-select disabled-field" id="event" name="event">
                            <option value="">Pilih</option>
   <?php foreach ($event as $gou) { ?>
    <option value="<?= $gou->id_event ?>" 
    <?= isset($backup_jadwal[$elly->id_jadwal]) 
        ? ($backup_jadwal[$elly->id_jadwal]->id_event == $gou->id_event ? 'selected' : '')
        : (isset($elly->id_event) && $elly->id_event == $gou->id_event ? 'selected' : '') ?>>
    <?= $gou->deskripsi_event ?>
</option>

<?php } ?>
                                    </select>
                            </div>
                            </div>

                            <div class="col-md-12 col-12">
    <label>Hari</label>
    <div class="form-group">
        <select id="hari" class="form-control disabled-field" name="hari">
            <option value="">Pilih</option>
            <option value="Senin" <?= (isset($backup_jadwal[$elly->id_jadwal]) && $backup_jadwal[$elly->id_jadwal]->hari == 'Senin') || (isset($elly->hari) && $elly->hari == 'Senin') ? 'selected' : '' ?>>Senin</option>
            <option value="Selasa" <?= (isset($backup_jadwal[$elly->id_jadwal]) && $backup_jadwal[$elly->id_jadwal]->hari == 'Selasa') || (isset($elly->hari) && $elly->hari == 'Selasa') ? 'selected' : '' ?>>Selasa</option>
            <option value="Rabu" <?= (isset($backup_jadwal[$elly->id_jadwal]) && $backup_jadwal[$elly->id_jadwal]->hari == 'Rabu') || (isset($elly->hari) && $elly->hari == 'Rabu') ? 'selected' : '' ?>>Rabu</option>
            <option value="Kamis" <?= (isset($backup_jadwal[$elly->id_jadwal]) && $backup_jadwal[$elly->id_jadwal]->hari == 'Kamis') || (isset($elly->hari) && $elly->hari == 'Kamis') ? 'selected' : '' ?>>Kamis</option>
            <option value="Jumat" <?= (isset($backup_jadwal[$elly->id_jadwal]) && $backup_jadwal[$elly->id_jadwal]->hari == 'Jumat') || (isset($elly->hari) && $elly->hari == 'Jumat') ? 'selected' : '' ?>>Jumat</option>
            <option value="Sabtu" <?= (isset($backup_jadwal[$elly->id_jadwal]) && $backup_jadwal[$elly->id_jadwal]->hari == 'Sabtu') || (isset($elly->hari) && $elly->hari == 'Sabtu') ? 'selected' : '' ?>>Sabtu</option>
            <option value="Minggu" <?= (isset($backup_jadwal[$elly->id_jadwal]) && $backup_jadwal[$elly->id_jadwal]->hari == 'Minggu') || (isset($elly->hari) && $elly->hari == 'Minggu') ? 'selected' : '' ?>>Minggu</option>
        </select>
    </div>
</div>

                            <div class="col-md-12 col-12">
                                <label>Keterangan</label>
                            <div class="form-group">
                                <input type="text" id="keterangan" class="form-control disabled-field" name="keterangan" placeholder="Keterangan" value="<?= isset($backup_jadwal[$elly->id_jadwal]) ? $backup_jadwal[$elly->id_jadwal]->keterangan : $elly->keterangan ?? '' ?>">
                            </div>
                            </div>
                           
                            <div class="col-md-12 col-12">
                                <label>Waktu</label>
                            <div class="form-group">
                                <input type="time" id="waktu" class="form-control disabled-field" name="waktu" value="<?= isset($backup_jadwal[$elly->id_jadwal]) ? $backup_jadwal[$elly->id_jadwal]->waktu : $elly->waktu ?? '' ?>">
                            </div>
                            </div>

                            <div class="col-md-12 col-12">
                                <label>Suara</label>
                            <div class="form-group">
                            <select class="form-select disabled-field" id="suara" name="suara">
                            <option value="">Pilih</option>
   <?php foreach ($suara as $gou) { ?>
    <option value="<?= $gou->id_suara ?>" 
    <?= isset($backup_jadwal[$elly->id_jadwal]) 
        ? ($backup_jadwal[$elly->id_jadwal]->id_suara == $gou->id_suara ? 'selected' : '')
        : (isset($elly->id_suara) && $elly->id_suara == $gou->id_suara ? 'selected' : '') ?>>
    <?= $gou->keterangan_suara ?>
</option>

<?php } ?>
                                    </select>
                            </div>
                            </div>


                    
                                    <!-- Button Submit dan Reset -->
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Undo</button>
                                        <input type="hidden" name="id" value="<?= $elly->id_jadwal ?? '' ?>">
                                    </div>
                                </div>
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->
</div>


<style>
    .disabled-field {
        pointer-events: none;
        background-color: #e9ecef; /* Optional: change the background color to indicate it's disabled */
    }
</style>

</body>



