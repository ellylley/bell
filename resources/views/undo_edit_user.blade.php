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

                    <a href="{{ url('home/user') }}" class="d-flex justify-content-end">
    <button class="btn btn-danger">Back</button>
</a>
                        <h4 class="card-title">Undo Edit</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ url('home/aksi_unedit_user') }}" method="POST" enctype="multipart/form-data">
                                <div class="row">

                            <div class="col-md-12 col-12">
                                <label>Nama User</label>
                            <div class="form-group">
                                <input type="text" id="undoNama" class="form-control disabled-field" name="nama" placeholder="Nama User" value="<?= isset($backup_user[$elly->id_user]) ? $backup_user[$elly->id_user]->nama_user : $elly->nama_user ?? '' ?>">
                            </div>
                            </div>
                    
                                    <!-- Button Submit dan Reset -->
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Undo</button>
                                        <input type="hidden" name="id" value="<?= $elly->id_user ?? '' ?>">
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



