<?php
        include("commun/menu.php");
        include("commun/header.php");

    ?>

    <div class="container">
        <div class="column">
            <canvas id="temperatureChart"></canvas>
            <canvas id="humiditeChart"></canvas>
            <canvas id="luminositeChart"></canvas>
        </div>
        <div class="column">
            <canvas id="airQualityChart"></canvas>
            <canvas id="uvValueChart"></canvas>
        </div>
    </div>
    <script>
        fetch('data.php')
            .then(response => response.json())
            .then(data => {
                const dates = data.dates;
                const temperatures = data.temperatures;
                const humidites = data.humiditys;
                const luminosites = data.luminositys;
                const airQualitys = data.airQualitys;
                const uvValues = data.uvValue;

                function createChart(id, label, data) {
                    var ctx = document.getElementById(id).getContext('2d');
                    return new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: dates,
                            datasets: [{
                                label: label,
                                data: data,
                                borderColor: getRandomColor(),
                                fill: false
                            }]
                        }
                    });
                }

                var temperatureChart = createChart('temperatureChart', 'Température (°C)', temperatures);
                var humiditeChart = createChart('humiditeChart', 'Humidité (%)', humidites);
                var luminositeChart = createChart('luminositeChart', 'Luminosité', luminosites);
                var airQualityChart = createChart('airQualityChart', 'Qualité de l\'air', airQualitys);
                var uvValueChart = createChart('uvValueChart', 'UV Value', uvValues);


                function getRandomColor() {
                    var letters = '0123456789ABCDEF';
                    var color = '#';
                    for (var i = 0; i < 6; i++) {
                        color += letters[Math.floor(Math.random() * 16)];
                    }
                    return color;
                }
            });
    </script>

    <?php
        include("commun/footer.php");

    ?>