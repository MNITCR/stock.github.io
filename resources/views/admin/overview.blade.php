<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Overview</title>
</head>

<body>
    <div style="width:80%; margin:0 auto;">
     <div class="group-form mb-3">
          <form method="POST" action="/graph">
               @csrf
               <label for="selected_table">Select Data Overview</label>
               <select name="selected_table" id="selected_table">
                    <option value="product">Product</option>
                    <option value="book">Book</option>
               </select>
               <button type="submit">Generate Graph</button>
          </form>
     </div>
        <canvas id="overview"></canvas>
    </div>
    {{-- <script type="text/js" src="{{ asset('js/chart/overview.js')}}"></script> --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('overview').getContext('2d');

            const data = {
                labels: @json($data['labels']),
                datasets: [{
                    label: "Quantities",
                    backgroundColor: [
                         'red',
                         'black',
                         'blue',
                         'yellow'
                    ],
                    borderColor: 'rgba(75, 192, 192, 1',
                    borderWidth: 1,
                    data: @json($data['quantities']),
                }, ],
            };

            const options = {
               responsive: true,
               scales: {
                    y: {
                         beginAtZero: true,
                         title: {
                              display: true,
                              text: 'Quantity',
                         },
                    },
               },
            };

            const MyChart = new Chart(ctx, {
               type: 'bar',
               data: data,
               options: options,
            });
        });
    </script>
</body>

</html>
