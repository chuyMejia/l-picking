<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chart.js Example</title>
    <!-- Agrega el CDN de Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="myChart" width="400" height="400"></canvas>

    <script>
        // Obtén la fecha actual
        const currentDate = new Date();

        // Ajusta la fecha al primer día de la semana actual (lunes)
        currentDate.setDate(currentDate.getDate() - currentDate.getDay() + 1);

        // Calcula los días laborables de la semana actual junto con sus fechas
        const weekdaysWithDates = [];
        for (let i = 0; i < 5; i++) {
            const day = new Date(currentDate);
            day.setDate(day.getDate() + i);

            const dayName = new Intl.DateTimeFormat('en-US', { weekday: 'long' }).format(day);
            const dateFormat = new Intl.DateTimeFormat('en-US', { month: 'numeric', day: 'numeric', year: 'numeric' });
            const dateString = dateFormat.format(day);

            weekdaysWithDates.push(`${dayName} ${dateString}`);
        }

        // Datos para las barras dobles (puedes ajustar estos valores según tus necesidades)
        const data1 = [30, 45, 60, 75, 90];
        const data2 = [45, 60, 75, 90, 105];

        // Configuración del gráfico
        const config = {
            type: 'bar',
            data: {
                labels: weekdaysWithDates,
                datasets: [{
                    label: 'Dataset 1',
                    data: data1,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgb(255, 99, 132)',
                    borderWidth: 1
                }, {
                    label: 'Dataset 2',
                    data: data2,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgb(75, 192, 192)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        // Obtén el contexto del lienzo
        const ctx = document.getElementById('myChart').getContext('2d');

        // Crea el gráfico con la configuración
        const myChart = new Chart(ctx, config);
    </script>
</body>
</html>
