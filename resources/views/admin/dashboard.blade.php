<!DOCTYPE html>
<html lang="en">

<head>
    @extends('admin.links')
    @section('title', 'Dashboard')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</head>
<body>
    <main id="page-top bg-dark">
        <div id="wrapper">
            {{-- navbar --}}
            @include('admin.Navbar')
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    {{-- sidebar --}}
                    @include('admin.Sidebar')

                    <!-- Content -->
                    <div class="container-fluid">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        </div>
                    </div>
                    <!-- End Content -->
                    <div class="card">
                        <div class="card-body">
                            <div class="container-fluid">
                                <div style="width:80%; margin:0 auto;">
                                    <canvas id="overview"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; developer MNITCR 2023</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->
            </div>
        </div>
    </main>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('overview').getContext('2d');

            const data = {
                labels: @json($data['labels']),
                datasets: [{
                    label: "Quantities",
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
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
