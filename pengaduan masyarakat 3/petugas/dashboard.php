<link rel="stylesheet" href="../csstyle/dashboard.css">
<!-- Tambahkan Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<h3 class="header-text"><b>Dashboard</b></h3>

<div class="row">
    <div class="col s8">
        <div class="card">
            <div class="card-content">
                <span class="card-title">Statistik Laporan</span>
                <canvas id="reportChart"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col s4">
        <div class="card-small">
            <div class="card-content text">
            <?php 
                $query = mysqli_query($koneksi,"SELECT * FROM pengaduan WHERE status='proses'");
                $laporan_proses = mysqli_num_rows($query);
                if($laporan_proses<1){
                    $laporan_proses=0;
                }
            ?>
            <span class="card-title">Laporan Proses<b class="right"><?php echo $laporan_proses; ?></b></span>
            </div>
        </div>

        <div class="card-small">
            <div class="card-content text">
            <?php 
                $query = mysqli_query($koneksi,"SELECT * FROM tanggapan WHERE id_petugas='".$_SESSION['data']['id_petugas']."'");
                $laporan_tanggap = mysqli_num_rows($query);
                if($laporan_tanggap<1){
                    $laporan_tanggap=0;
                }
            ?>
            <span class="card-title">Laporan Ditanggapi<b class="right"><?php echo $laporan_tanggap; ?></b></span>
            </div>
        </div>
    </div>
</div>

<script>
const ctx = document.getElementById('reportChart').getContext('2d');
const reportChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Proses', 'Ditanggapi'],
        datasets: [{
            data: [<?php echo $laporan_proses; ?>, <?php echo $laporan_tanggap; ?>],
            backgroundColor: [
                '#333333',
                '#e91e63'
            ],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    color: '#333',
                    font: {
                        size: 14
                    }
                }
            }
        },
        cutout: '70%'
    }
});
</script>