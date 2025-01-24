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
                        <h4 class="card-title">Edit</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ url('home/aksi_edit_jadwal') }}" method="POST" enctype="multipart/form-data">
                                <div class="row">
                    

                                <div class="col-md-12 col-12">
                                <label>Deskripsi Event</label>
                            <div class="form-group">
                            <select class="form-select" id="event" name="event">
                            <option value="">Pilih</option>
    <?php foreach($event as $eve){ ?>
        <option value="<?=$eve->id_event?>" <?= (isset($elly->id_event) && $elly->id_event == $eve->id_event) ? 'selected' : '' ?>><?=$eve->deskripsi_event?></option>
    <?php } ?>
                                    </select>
                            </div>
                            </div>

                            <div class="col-md-12 col-12">
    <label>Hari</label>
    <div class="form-group">
        <select id="hari" class="form-control" name="hari">
            <option value="">Pilih</option>
            <option value="Senin" <?= $elly->hari == 'Senin' ? 'selected' : '' ?>>Senin</option>
            <option value="Selasa" <?= $elly->hari == 'Selasa' ? 'selected' : '' ?>>Selasa</option>
            <option value="Rabu" <?= $elly->hari == 'Rabu' ? 'selected' : '' ?>>Rabu</option>
            <option value="Kamis" <?= $elly->hari == 'Kamis' ? 'selected' : '' ?>>Kamis</option>
            <option value="Jumat" <?= $elly->hari == 'Jumat' ? 'selected' : '' ?>>Jumat</option>
            <option value="Sabtu" <?= $elly->hari == 'Sabtu' ? 'selected' : '' ?>>Sabtu</option>
            <option value="Minggu" <?= $elly->hari == 'Minggu' ? 'selected' : '' ?>>Minggu</option>
        </select>
    </div>
</div>
                            <div class="col-md-12 col-12">
                                <label>Keterangan</label>
                            <div class="form-group">
                                <input type="text" id="keterangan" class="form-control" name="keterangan" placeholder="Keterangan" value="<?= $elly->keterangan ?? '' ?>">
                            </div>
                            </div>
                          

                            <div class="col-md-12 col-12">
                                <label>Waktu</label>
                            <div class="form-group">
                                <input type="time" id="waktu" class="form-control" name="waktu" value="<?= $elly->waktu ?? '' ?>">
                            </div>
                            </div>

                            <div class="col-md-12 col-12">
                                <label>Suara</label>
                            <div class="form-group">
                            <select class="form-select" id="suara" name="suara">
                            <option value="">Pilih</option>
    <?php foreach($suara as $sur){ ?>
        <option value="<?=$sur->id_suara?>" <?= (isset($elly->id_suara) && $elly->id_suara == $sur->id_suara) ? 'selected' : '' ?>><?=$sur->keterangan_suara?></option>
    <?php } ?>
                                    </select>
                            </div>
                            </div>
                          
                                    <!-- Button Submit dan Reset -->
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
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


</body>

  