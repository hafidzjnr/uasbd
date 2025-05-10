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
                $query = mysqli_query($koneksi,"SELECT * FROM pengaduan");
                $total_laporan = mysqli_num_rows($query);
                if($total_laporan<1){
                    $total_laporan=0;
                }
            ?>
            <span class="card-title">Laporan Masuk<b class="right"><?php echo $total_laporan; ?></b></span>
            </div>
        </div>

        <div class="card-small">
            <div class="card-content text">
            <?php 
                $query = mysqli_query($koneksi,"SELECT * FROM pengaduan WHERE status='selesai'");
                $laporan_selesai = mysqli_num_rows($query);
                if($laporan_selesai<1){
                    $laporan_selesai=0;
                }
                $laporan_proses = $total_laporan - $laporan_selesai;
            ?>
            <span class="card-title">Laporan Selesai <b class="right"><?php echo $laporan_selesai; ?></b></span>
            </div>
        </div>
    </div>
</div>

<script>
const ctx = document.getElementById('reportChart').getContext('2d');
const reportChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Selesai', 'Proses'],
        datasets: [{
            data: [<?php echo $laporan_selesai; ?>, <?php echo $laporan_proses; ?>],
            backgroundColor: [
                '#e91e63',
                '#333333'
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