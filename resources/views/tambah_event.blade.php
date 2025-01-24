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

                    <a href="{{ url('home/event') }}" class="d-flex justify-content-end">
    <button class="btn btn-danger">Back</button>
</a>
                        <h4 class="card-title">Tambah</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ url('home/aksi_tambah_event') }}" method="POST" enctype="multipart/form-data">
                                <div class="row">

                            <div class="col-md-12 col-12">
                                <label>Deskripsi Event</label>
                            <div class="form-group">
                                <input type="text" id="event" class="form-control" name="event" placeholder="Deskripsi Event">
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


