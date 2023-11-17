<?php
        include("commun/menu.php");
        include("commun/header.php");

    ?>
<body>
    <div class="container">
        <canvas id="lumChart"></canvas>

    </div>
    <script>
        fetch('data.php')
            .then(response => response.json())
            .then(data => {
                const dates = data.dates;
                const luminosites = data.luminositys;
          

                var lumChart = new Chart(document.getElementById('lumChart').getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: dates,
                        datasets: [{
                            label: 'Brightness (lux)',
                            data: luminosites,
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