<?php
        include("commun/menu.php");
        include("commun/header.php");

    ?>
<body>
    <div class="container">
        <canvas id="humChart"></canvas>

    </div>
    <script>
        fetch('data.php')
            .then(response => response.json())
            .then(data => {
                const dates = data.dates;
                const humidites = data.humiditys;
          

                var humChart = new Chart(document.getElementById('humChart').getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: dates,
                        datasets: [{
                            label: 'Humidity (%)',
                            data: humidites,
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