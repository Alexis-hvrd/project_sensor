<?php
        include("commun/menu.php");
        include("commun/header.php");

    ?>
<body>
    <div class="container">
        <canvas id="uvChart"></canvas>

    </div>
    <script>
        fetch('data.php')
            .then(response => response.json())
            .then(data => {
                const dates = data.dates;
                const uvValues = data.uvValue;
          

                var uvChart = new Chart(document.getElementById('uvChart').getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: dates,
                        datasets: [{
                            label: 'value',
                            data: uvValues,
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