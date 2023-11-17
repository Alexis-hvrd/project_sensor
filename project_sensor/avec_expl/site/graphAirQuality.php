<?php
        include("commun/menu.php");
        include("commun/header.php");

    ?>
<body>
    <div class="container">
        <canvas id="airChart"></canvas>

    </div>
    <script>
        fetch('data.php')
            .then(response => response.json())
            .then(data => {
                const dates = data.dates;
                const airQuality = data.airQualitys;
          

                var airChart = new Chart(document.getElementById('airChart').getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: dates,
                        datasets: [{
                            label: 'AirQuality (ppm)',
                            data: airQuality,
                            borderColor: '#FFE790',
                            fill: false
                        }]
                    }
                });

           
            });
    </script>
    
    <?php
        include("commun/footer.php");

    ?>