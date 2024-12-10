<div class="row">
    <div class="col-md">
        <h5>Status alumni saat ini</h5>
        <canvas id="myChart"></canvas>
    </div>
    <div class="col-md">
        <h5>Mendapatkan pekerjaan <= 6 bulan</h5>
        <canvas id="myChart2"></canvas>
    </div>
</div>
<div class="row">

</div>
<div class="row">
    <div class="col-md">
        <h5>Seberapa Sesuai Hubugan Bidang Studi dengan Pekerjaan</h5>
        <canvas id="myChart3"></canvas>
    </div>
    <div class="col-md">
        <h5>Pendapatan rata-rata per bulan</h5>
        <canvas id="myChart4"></canvas>
    </div>
</div>
<script>
    $(document).ready(function () {
        const chartData = @json($status_mahasiswa);

        const data = {
            labels: chartData.labels,
            datasets: [{
                label: 'Status alumni saat ini',
                backgroundColor: [
                    'rgba(255, 99, 132, 0.3)',
                    'rgba(54, 162, 235, 0.3)',
                    'rgba(255, 206, 86, 0.3)',
                    'rgba(75, 192, 192, 0.3)',
                    'rgba(153, 102, 255, 0.3)',
                    'rgba(255, 159, 64, 0.3)',
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 206, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(153, 102, 255)',
                    'rgb(255, 159, 64)',
                ],
                data: chartData.data,
            }]
        };

        const config = {
            type: 'pie',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            boxWidth: 20,
                            padding: 10
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                const total = chartData.data.reduce((sum, value) => sum + value, 0);
                                const value = tooltipItem.raw;
                                const label = chartData.labels[tooltipItem.dataIndex];
                                const percentage = ((value / total) * 100).toFixed(2);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );

        // Mendapatkan pekerjaan <= 6 bulan
        const chartData2 = @json($mendapatkan_pekerjaan);

        const data2 = {
            labels: chartData2.labels,
            datasets: [{
                label: 'Jumlah respon berdasarkan waktu mendapatkan pekerjaan',
                backgroundColor: [
                    'rgba(255, 99, 132, 0.3)',
                    'rgba(54, 162, 235, 0.3)',
                    'rgba(255, 206, 86, 0.3)',
                    'rgba(75, 192, 192, 0.3)',
                    'rgba(153, 102, 255, 0.3)',
                    'rgba(255, 159, 64, 0.3)',
                    'rgba(100, 181, 246, 0.3)',
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 206, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(153, 102, 255)',
                    'rgb(255, 159, 64)',
                    'rgb(100, 181, 246)',
                ],
                borderWidth: 1,
                data: chartData2.data, // Data untuk setiap jawaban
            }]
        };

        const config2 = {
            type: 'pie',
            data: data2,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                const label = tooltipItem.label || '';
                                const value = tooltipItem.raw;
                                return `${label}: ${value} respon`;
                            }
                        }
                    }
                },
            }
        };

        const myChart2 = new Chart(
            document.getElementById('myChart2'),
            config2
        );

        //seberapa sesuai hubungan bidang studi dengan pekerjaan
        const chartData3 = @json($seberapa_erat);

        const data3 = {
            labels: chartData3.labels,
            datasets: [{
                label: 'Jumlah respon berdasarkan kesesuaian bidang studi dengan pekerjaan',
                backgroundColor: [
                    'rgba(255, 99, 132, 0.3)',
                    'rgba(54, 162, 235, 0.3)',
                    'rgba(255, 206, 86, 0.3)',
                    'rgba(75, 192, 192, 0.3)',
                    'rgba(153, 102, 255, 0.3)',
                    'rgba(255, 159, 64, 0.3)',
                    'rgba(100, 181, 246, 0.3)',
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 206, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(153, 102, 255)',
                    'rgb(255, 159, 64)',
                    'rgb(100, 181, 246)',
                ],
                borderWidth: 1,
                data: chartData3.data,
            }]
        };

        const config3 = {
            type: 'pie',
            data: data3,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                const label = tooltipItem.label || '';
                                const value = tooltipItem.raw;
                                return `${label}: ${value} respon`;
                            }
                        }
                    }
                },
            }
        };

        const myChart3 = new Chart(
            document.getElementById('myChart3'),
            config3
        );

        //pendapatan rata-rata perbulan
        const chartData4 = @json($rata_rata_pendapatan);

        const data4 = {
            labels: chartData4.labels,
            datasets: [{
                label: 'Jumlah respon berdasarkan kesesuaian bidang studi dengan pekerjaan',
                data: chartData4.data,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
            }]
        };

        const config4 = {
            type: 'bar',
            data: data4,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                const label = tooltipItem.label || '';
                                const value = tooltipItem.raw;
                                return `${label}: ${value} respon`;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Range rata-rata pendapatan'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Respon'
                        }
                    }
                }
            }
        };

        const myChart4 = new Chart(
            document.getElementById('myChart4'),
            config4
        );
    });
</script>
