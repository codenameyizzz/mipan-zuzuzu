<div class="row">
    <div class="col-md">
        <h5>Jumlah Mahasiswa Tiap Kategori</h5>
        <canvas id="myChart"></canvas>
    </div>
    <div class="col-md">
        <h5>Proporsi Mahasiswa Tiap Kategori</h5>
        <canvas id="myChart2"></canvas>
    </div>
    <div class="col-md">
        <h5>Berdasarkan Angkatan</h5>
        <canvas id="myChart3"></canvas>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Chart 1: Jumlah Mahasiswa Tiap Kategori
        const chartData1 = @json($jumlah_mahasiswa_tiap_kategori);

        const config1 = {
            type: 'bar',
            data: {
                labels: chartData1.labels,
                datasets: [{
                    label: 'Jumlah Mahasiswa',
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.3)',
                        'rgba(54, 162, 235, 0.3)',
                        'rgba(255, 206, 86, 0.3)',
                        'rgba(75, 192, 192, 0.3)',
                        'rgba(153, 102, 255, 0.3)',
                        'rgba(255, 159, 64, 0.3)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 206, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(153, 102, 255)',
                        'rgb(255, 159, 64)'
                    ],
                    data: chartData1.data,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                const total = chartData1.data.reduce((sum, value) => sum + value, 0);
                                const value = tooltipItem.raw;
                                const percentage = ((value / total) * 100).toFixed(2);
                                return `${chartData1.labels[tooltipItem.dataIndex]}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        };

        new Chart(document.getElementById('myChart'), config1);

        // Chart 2: Proporsi Mahasiswa Tiap Kategori
        const chartData2 = @json($proporsi_mahasiswa_tiap_kategori);

        const config2 = {
            type: 'pie',
            data: {
                labels: chartData2.labels,
                datasets: [{
                    label: 'Proporsi Mahasiswa',
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.3)',
                        'rgba(54, 162, 235, 0.3)',
                        'rgba(255, 206, 86, 0.3)',
                        'rgba(75, 192, 192, 0.3)',
                        'rgba(153, 102, 255, 0.3)',
                        'rgba(255, 159, 64, 0.3)',
                        'rgba(100, 181, 246, 0.3)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 206, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(153, 102, 255)',
                        'rgb(255, 159, 64)',
                        'rgb(100, 181, 246)'
                    ],
                    data: chartData2.data,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                return `${tooltipItem.label}: ${tooltipItem.raw} respon`;
                            }
                        }
                    }
                }
            }
        };

        new Chart(document.getElementById('myChart2'), config2);

        // Chart 3: Berdasarkan Angkatan
        const chartData3 = @json($berdasarkan_angkatan);

        const config3 = {
            type: 'pie',
            data: {
                labels: chartData3.labels,
                datasets: [{
                    label: 'Jumlah Berdasarkan Angkatan',
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.3)',
                        'rgba(54, 162, 235, 0.3)',
                        'rgba(255, 206, 86, 0.3)',
                        'rgba(75, 192, 192, 0.3)',
                        'rgba(153, 102, 255, 0.3)',
                        'rgba(255, 159, 64, 0.3)',
                        'rgba(100, 181, 246, 0.3)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 206, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(153, 102, 255)',
                        'rgb(255, 159, 64)',
                        'rgb(100, 181, 246)'
                    ],
                    data: chartData3.data,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                return `${tooltipItem.label}: ${tooltipItem.raw} respon`;
                            }
                        }
                    }
                }
            }
        };

        new Chart(document.getElementById('myChart3'), config3);
    });
</script>
