<div class="container">
    <?php
    // Add the CSS link
    echo '<link rel="stylesheet" type="text/css" href="../csstyle/registrasi.css">';
    ?>
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div class="row header-wrapper">
                        <div class="col s12 m6">
                            <h3 class="page-title"><b>Data Masyarakat</b></h3>
                        </div>  
                        <div class="col s12 m6">
                            <a class="waves-effect waves-light btn modal-trigger add-button" href="#modal1">
                                <i class="material-icons left">add</i>Tambah Data
                            </a>
                        </div>
                    </div>

                    <div class="table-container">
                        <table id="example" class="responsive-table striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Telp</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no=1;
                                    $query = mysqli_query($koneksi,"SELECT * FROM masyarakat ORDER BY nik ASC");
                                    while ($r=mysqli_fetch_assoc($query)) { ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $r['nik']; ?></td>
                                        <td><?php echo $r['nama']; ?></td>
                                        <td><?php echo $r['username']; ?></td>
                                        <td><?php echo $r['telp']; ?></td>
                                        <td class="action-buttons">
                                            <a class="btn-small modal-trigger edit-btn" href="#regis_edit?nik=<?php echo $r['nik'] ?>">
                                                <i class="material-icons left">edit</i>Edit
                                            </a> 
                                            <a class="btn-small delete-btn" onclick="event.preventDefault(); showConfirm('Anda yakin ingin menghapus data ini?', function(confirmed) { 
                                                if(confirmed) window.location.href='index.php?p=regis_hapus&nik=<?php echo $r['nik'] ?>';
                                            })" href="#">
                                                <i class="material-icons left">delete</i>Hapus
                                            </a>
                                        </td>
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

<!-- Edit Modal -->
<?php 
$query = mysqli_query($koneksi,"SELECT * FROM masyarakat ORDER BY nik ASC");
while ($r=mysqli_fetch_assoc($query)) { ?>
    <div id="regis_edit?nik=<?php echo $r['nik'] ?>" class="modal">
        <div class="modal-content">
            <h4>Edit Data Masyarakat</h4>
            <form method="POST">
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">credit_card</i>
                        <input id="nik" type="number" name="nik" value="<?php echo $r['nik']; ?>" required>
                        <label for="nik">NIK</label>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">person</i>
                        <input id="nama" type="text" name="nama" value="<?php echo $r['nama']; ?>" required>
                        <label for="nama">Nama Lengkap</label>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="username" type="text" name="username" value="<?php echo $r['username']; ?>" required>
                        <label for="username">Username</label>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">phone</i>
                        <input id="telp" type="number" name="telp" value="<?php echo $r['telp']; ?>" required>
                        <label for="telp">Nomor Telepon</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#!" class="modal-close waves-effect waves-light btn-flat">Batal</a>
                    <button type="submit" name="Update" class="waves-effect waves-light btn">
                        <i class="material-icons left">save</i>Simpan
                    </button>
                </div>
            </form>
            <?php 
            if(isset($_POST['Update'])){
                $update=mysqli_query($koneksi,"UPDATE masyarakat SET nik='".$_POST['nik']."',nama='".$_POST['nama']."',username='".$_POST['username']."',telp='".$_POST['telp']."' WHERE nik='".$r['nik']."' ");
                if($update){
                    echo "<script>
                        showAlert('Data berhasil diupdate', 'success');
                        setTimeout(function() {
                            window.location.href = 'index.php?p=registrasi';
                        }, 2000);
                    </script>";
                }
            }
            ?>
        </div>
    </div>
<?php } ?>

<!-- Add Modal -->
<div id="modal1" class="modal">
    <div class="modal-content">
        <h4>Tambah Data Masyarakat</h4>
        <form method="POST">
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">credit_card</i>
                    <input id="nik_new" type="number" name="nik" required>
                    <label for="nik_new">NIK</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">person</i>
                    <input id="nama_new" type="text" name="nama" required>
                    <label for="nama_new">Nama Lengkap</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="username_new" type="text" name="username" required>
                    <label for="username_new">Username</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">lock</i>
                    <input id="password" type="password" name="password" required>
                    <label for="password">Password</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">phone</i>
                    <input id="telp_new" type="number" name="telp" required>
                    <label for="telp_new">Nomor Telepon</label>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-light btn-flat">Batal</a>
                <button type="submit" name="simpan" class="waves-effect waves-light btn">
                    <i class="material-icons left">save</i>Simpan
                </button>
            </div>
        </form>
        <?php 
        if(isset($_POST['simpan'])){
            $password = md5($_POST['password']);
            $query=mysqli_query($koneksi,"INSERT INTO masyarakat VALUES ('".$_POST['nik']."','".$_POST['nama']."','".$_POST['username']."','".$password."','".$_POST['telp']."')");
            if($query){
                echo "<script>
                    showAlert('Data berhasil disimpan', 'success');
                    setTimeout(function() {
                        window.location.href = 'index.php?p=registrasi';
                    }, 2000);
                </script>";
            }
        }
        ?>
    </div>
</div>