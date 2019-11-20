

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.1/Chart.min.js"></script>
  <title>Document</title>
</head>
<style>
body{
  background-color: #666;
}

#barChart{
  background-color: wheat;
  border-radius: 6px;
/*   Check out the fancy shadow  on this one */
  box-shadow: 0 3rem 5rem -2rem rgba(0, 0, 0, 0.6);
}

</style>
<body>

<div class="container">
  <br />
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">

      <canvas id="barChart"></canvas>
    </div>
    <div class="col-md-1"></div>
  </div>
</div>
</body>
</html>

<script>
var canvas = document.getElementById("barChart");
var ctx = canvas.getContext('2d');

// Global Options:
Chart.defaults.global.defaultFontColor = 'black';
Chart.defaults.global.defaultFontSize = 16;

var data = {
  labels: ["00:00:26", "00:01:26", "00:02:27", "00:03:28", "00:04:28", "00:05:29", "00:06:29", "00:07:30", "00:08:30", "00:09:31", "00:10:31", "00:11:32", "00:12:32", "00:13:33", "00:14:33", "00:15:34", " 00:16:34",  "00:17:35", "00:18:35", "00:19:36", "00:15:35", " 00:16:36",  "00:17:37", "00:18:38", "00:19:39"],
  datasets: [{
   
      data: [55, 59, 80, 81, 56, 55, 40,55 ,60,55,30,78],

    }

  ]
};

// Notice the scaleLabel at the same level as Ticks
var options = {
  scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                },
                scaleLabel: {
                     display: true,
                     labelString: 'Moola',
                     fontSize: 20 
                  }
            }]            
        }  
};

// Chart declaration:
var myBarChart = new Chart(ctx, {
  type: 'line',
  data: data,
  options: options
});
</script>