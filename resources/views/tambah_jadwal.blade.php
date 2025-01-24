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
                        <h4 class="card-title">Tambah</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ url('home/aksi_tambah_jadwal') }}" method="POST" enctype="multipart/form-data">
                                <div class="row">

                            <div class="col-md-12 col-12">
                                <label>Deskripsi Event</label>
                            <div class="form-group">
                            <select class="form-select" id="event" name="event">
                                        <option value="">Pilih</option>
                                        @foreach ($elly as $gou)
                                            <option value="{{ $gou->id_event }}">{{ $gou->deskripsi_event }}</option>
                                        @endforeach
                                    </select>
                            </div>
                            </div>
                           
                            <div class="col-md-12 col-12">
    <label>Hari</label>
    <div class="form-group">
        <select id="hari" class="form-control" name="hari">
            <option value="Senin">Senin</option>
            <option value="Selasa">Selasa</option>
            <option value="Rabu">Rabu</option>
            <option value="Kamis">Kamis</option>
            <option value="Jumat">Jumat</option>
            <option value="Sabtu">Sabtu</option>
            <option value="Minggu">Minggu</option>
        </select>
    </div>
</div>
                            <div class="col-md-12 col-12">
                                <label>Keterangan</label>
                            <div class="form-group">
                                <input type="text" id="keterangan" class="form-control" name="keterangan" placeholder="Keterangan">
                            </div>
                            </div>

                            <div class="col-md-12 col-12">
                                <label>Waktu</label>
                            <div class="form-group">
                                <input type="time" id="waktu" class="form-control" name="waktu">
                            </div>
                            </div>

                            <div class="col-md-12 col-12">
                                <label>Suara</label>
                            <div class="form-group">
                            <select class="form-select" id="suara" name="suara">
                                        <option value="">Pilih</option>
                                        @foreach ($suara as $gou)
                                            <option value="{{ $gou->id_suara }}">{{ $gou->keterangan_suara }}</option>
                                        @endforeach
                                    </select>
                            </div>
                            </div>
                            


                           
                                    <!-- Button Submit dan Reset -->
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
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


