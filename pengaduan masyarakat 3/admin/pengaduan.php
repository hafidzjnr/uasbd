<div class="container">
<?php
    // Add the CSS link
    echo '<link rel="stylesheet" type="text/css" href="../csstyle/respon.css">';
    ?>
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div class="row header-wrapper">
                        <div class="col s12">
                            <h3 class="page-title"><b>Data Pengaduan</b></h3>
                        </div>
                    </div>

                    <div class="table-container">
                        <table id="example" class="responsive-table striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Status</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $no=1;
                                $query = mysqli_query($koneksi,"SELECT * FROM pengaduan INNER JOIN masyarakat ON pengaduan.nik=masyarakat.nik ORDER BY pengaduan.id_pengaduan DESC");
                                while ($r=mysqli_fetch_assoc($query)) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $r['nik']; ?></td>
                                    <td><?php echo $r['nama']; ?></td>
                                    <td><?php echo $r['tgl_pengaduan']; ?></td>
                                    <td><?php echo $r['status']; ?></td>
                                    <td>
                                        <a class="btn-small modal-trigger more-btn" href="#more?id_pengaduan=<?php echo $r['id_pengaduan'] ?>">More</a> 
                                        <a class="btn-small delete-btn" onclick="event.preventDefault(); showConfirm('Anda yakin ingin menghapus pengaduan ini?', function(confirmed) { 
                                            if(confirmed) window.location.href='index.php?p=pengaduan_hapus&id_pengaduan=<?php echo $r['id_pengaduan'] ?>';
                                        })" href="#">Hapus</a>
                                    </td>

                                    <!-- Modal Structure -->
                                    <div id="more?id_pengaduan=<?php echo $r['id_pengaduan'] ?>" class="modal">
                                        <div class="modal-content">
                                            <h4 class="text">Detail</h4>
                                            <div class="col s12 m6">
                                                <p>NIK : <?php echo $r['nik']; ?></p>
                                                <p>Dari : <?php echo $r['nama']; ?></p>
                                                <p>Tanggal Masuk : <?php echo $r['tgl_pengaduan']; ?></p>
                                                <?php 
                                                    if($r['foto']=="kosong"){ ?>
                                                        <img src="../img/noImage.png" width="100">
                                                <?php	}else{ ?>
                                                    <img width="100" src="../img/<?php echo $r['foto']; ?>">
                                                <?php }
                                                 ?>
                                                <br><b class="pink-text">Pesan</b>
                                                <p><?php echo $r['isi_laporan']; ?></p>
                                                <p>Status : <?php echo $r['status']; ?></p>
                                            </div>
                                            <?php 
                                                if($r['status']=="proses"){ ?>
                                                <div class="col s12 m6">
                                                    <form method="POST">
                                                        <div class="col s12 input-field">
                                                            <label for="textarea">Tanggapan</label>
                                                            <textarea id="textarea" name="tanggapan" class="materialize-textarea"></textarea>
                                                        </div>
                                                        <div class="col s12 input-field">
                                                            <input type="submit" name="tanggapi" value="Kirim" class="btn black pink-text">
                                                        </div>
                                                    </form>
                                                </div>
                                            <?php	}
                                             ?>

                                            <?php if(isset($_POST['tanggapi'])): ?>
                                            <?php
                                            $tgl = date('Y-m-d');
                                            $query = mysqli_query($koneksi,"INSERT INTO tanggapan VALUES (NULL,'".$r['id_pengaduan']."','".$tgl."','".$_POST['tanggapan']."','".$_SESSION['data']['id_petugas']."')");
                                            if($query){
                                                $update = mysqli_query($koneksi,"UPDATE pengaduan SET status='selesai' WHERE id_pengaduan='".$r['id_pengaduan']."'");
                                                if($update){
                                                    echo "<script>
                                                        showAlert('Tanggapan berhasil dikirim', 'success');
                                                        setTimeout(function() {
                                                            window.location.href = 'index.php?p=pengaduan';
                                                        }, 2000);
                                                    </script>";
                                                }
                                            }
                                            ?>
                                        <?php endif; ?>
                                        </div>
                                        <div class="modal-footer col s12">
                                            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
                                        </div>
                                    </div>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
