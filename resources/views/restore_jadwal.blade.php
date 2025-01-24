<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                </nav>
            </div>
        </div>
    </div>

    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" align="center">RESTORE</h4>
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
                               ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $gou->deskripsi_event ?></td> 
                                        <td><?= $gou->hari ?></td> 
                                        <td><?= $gou->keterangan ?></td> 
                                        <td><?= $gou->waktu ?></td> 
                                        <td><?= $gou->keterangan_suara ?></td> 
                                        <td>
                                        
                                        <a href="{{ route('home.aksi_restore_jadwal', $gou->id_jadwal) }}">
    <button class="btn btn-danger btn-sm ">Restore</button>
    </a>
                                        </td>
                                    </tr>
                                <?php
                                    
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end of .card -->
        </div> <!-- end of .col-12 -->
    </div> <!-- end of .row -->
</div> <!-- end of .main-content container-fluid -->
