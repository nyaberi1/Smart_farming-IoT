<!DOCTYPE HTML>
<html>

<head>
  <title>Farm Monitoring System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
    crossorigin="anonymous">
  <link rel="icon" href="data:,">
  <style>
    /* Your styles here */
  </style>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
  <div class="topnav">
    <h3>Farm Monitoring System</h3>
  </div>

  <div class="content">
    <div class="cards">
      <!-- MONITORING -->
      <div class="card">
        <div class="card header">
          <h3 style="font-size: 1rem;">MONITORING</h3>
        </div>
        <h4 class="temperatureColor"><i class="fas fa-thermometer-half"></i> TEMPERATURE</h4>
        <p class="temperatureColor"><span class="reading" id="ESP8266_01_Temp"></span> &deg;C</p>
        <h4 class="humidityColor"><i class="fas fa-tint"></i> HUMIDITY</h4>
        <p class="humidityColor"><span class="reading" id="ESP8266_01_Humd"></span> &percnt;</p>
        <!-- Add more readings as needed -->
      </div>

      <!-- CONTROLLING -->
      <div class="card">
        <div class="card header">
          <h3 style="font-size: 1rem;">CONTROLLING</h3>
        </div>
        <!-- Add controls for LEDs or other actuators as needed -->
      </div>

      <!-- CHARTS -->
      <div class="card">
        <div class="card header">
          <h3 class="fonrt-size: 0.5rem">Chart for Temperature</h3>
        </div>
        <canvas id="temperatureChart" width="400" height="200"></canvas>
      </div>

      <div class="card">
        <div class="card header">
          <h3 class="fonrt-size: 0.5rem">Chart for Humidity</h3>
        </div>
        <canvas id="humidityChart" width="400" height="200"></canvas>
      </div>

      <div class="card">
        <div class="card header">
          <h3 class="fonrt-size: 0.5rem">Chart for Moisture</h3>
        </div>
        <canvas id="moistureChart" width="400" height="200"></canvas>
      </div>
    </div>
  </div>

  <script>
    // Fetch data from the server
    function fetchData() {
      // Your PHP code to fetch data from the server
      <?php
        // Assume you have an array of data from your PHP logic
        $data = [/* Sample data for temperature, humidity, moisture, etc. */];
      ?>
      return <?php echo json_encode($data); ?>;
    }

    // Update the charts with new data
    function updateCharts() {
      const data = fetchData();

      // Update temperature chart
      // ... (similarly for humidity and moisture charts)

      // Example code for updating the temperature chart
      const temperatureChart = new Chart(document.getElementById('temperatureChart').getContext('2d'), {
        type: 'line',
        data: {
          labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5'],
          datasets: [{
            label: 'Temperature Data',
            data: data.temperature,
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
          }]
        }
      });
    }

    // Update charts periodically
    setInterval(updateCharts, 5000);

    // Initial update
    updateCharts();
  </script>
</body>

</html>
