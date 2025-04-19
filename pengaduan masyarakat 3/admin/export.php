<?php
// Memanggil atau membutuhkan file function.php
require '../conn/koneksi.php';

// Menampilkan semua data dari table siswa berdasarkan nis secara Descending

// Membuat nama file
$filename = "data siswa-" . date('Ymd') . ".xls";

// Kodingam untuk export ke excel
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Siswa.xls");

?>
<table class="text-center" border="1">
    <thead class="text-center">
        <tr>
        <td>No</td>
        <td>NIK Pelapor</td>
        <td>Nama Pelapor</td>
        <td>Nama Petugas</td>
        <td>Tanggal Masuk</td>
        <td>Tanggal Ditanggapi</td>
        <td>Status</td>
    </tr>
        </tr>
    </thead>
    <tbody class="text-center">
        <?php 
        include '../conn/koneksi.php';
        $no=1;
        $query = mysqli_query($koneksi,"SELECT * FROM pengaduan INNER JOIN masyarakat ON pengaduan.nik=masyarakat.nik INNER JOIN tanggapan ON tanggapan.id_pengaduan=pengaduan.id_pengaduan INNER JOIN petugas ON tanggapan.id_petugas=petugas.id_petugas ORDER BY tgl_pengaduan DESC");
        while ($r=mysqli_fetch_assoc($query)) { ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $r['nik']; ?></td>
            <td><?php echo $r['nama']; ?></td>
            <td><?php echo $r['nama_petugas']; ?></td>
            <td><?php echo $r['tgl_pengaduan']; ?></td>
            <td><?php echo $r['tgl_tanggapan']; ?></td>
            <td><?php echo $r['status']; ?></td>
        </tr>
    <?php   }
     ?>
    </tbody>
</table>