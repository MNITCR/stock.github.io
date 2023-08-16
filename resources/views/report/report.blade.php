<!DOCTYPE html>
<html lang="en">

<head>
    @extends('admin.links')
    @section('title', 'Report')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') } });
    </script>
</head>

<body>
    <body id="page-top">
        <div id="wrapper">
            {{-- navbar --}}
            @include('admin.Navbar')
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    {{-- sidebar --}}
                    @include('admin.Sidebar')

                    <div class="container-fluid">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Report</h1>
                        </div>
                        <!-- Content Row -->
                        <div class="row">
                            <div class="container-fluid py-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-end mb-3">
                                            <div class="mr-3 d-flex gap-3">
                                                <div class="d-flex flex-row align-items-end ">
                                                    <label for="" class="mr-3" style="width: 13rem;">Search from date </label>
                                                    <input type="date" name="search_from" id="search_from" class="form-control" required>
                                                </div>
                                                <div class="d-flex flex-row align-items-end">
                                                    <label for="" style="width: 13rem;">Search to date </label>
                                                    <input type="date" name="search_to" id="search_to" class="form-control" placeholder="Search to date" required>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-sm btn-primary Search">Search</button>
                                        </div>
                                        <table class="table table-hover table-bordered text-center" id="rep_data">
                                            <thead>
                                                <tr class="table-active">
                                                    <th>Product Code</th>
                                                    <th>Discound</th>
                                                    <th>Tax</th>
                                                    <th>Total</th>
                                                    <th>Grand Total</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($rep as $item)
                                                    <tr class="rep_row">
                                                        <td class="d-none">{{ $item->poid}}</td>
                                                        <td>{{ $item->pocode }}</td>
                                                        <td>{{ $item->dis }}</td>
                                                        <td>{{ $item->tax }}</td>
                                                        <td>{{ $item->total }}</td>
                                                        <td>{{ $item->grand_total }}</td>
                                                        <td>{{ $item->date }}</td>
                                                        <td>
                                                            <button class="btn btn-sm editrep""><i class="fa-solid fa-file-pen text-primary"></i></button>
                                                            <button class="btn btn-sm view" data-id="{{ $item->poid }}"><i class="fa-solid fa-eye text-info"></i></button>
                                                            <button class="btn btn-sm print"><i class="fa-solid fa-print text-success"></i></button>
                                                            <form class="d-inline" action="{{ route('delete-rep', ['id' => $item->poid]) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button  class="btn btn-sm delete" onclick="return confirm('Are you sure you want to delete this po?')"><i class="fa-solid fa-trash text-danger"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{$rep->links()}}
                                    </div>

                                    {{-- updete modal --}}
                                    <div class="modal fade" id="FormEditrep" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit P.O</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" id="poid">
                                                    <div class="group-form mb-3">
                                                        <label for="">Product Code</label>
                                                        <input type="text" class="form-control" id="procode"
                                                            required placeholder="Product Code">
                                                    </div>
                                                    <div class="group-form mb-3">
                                                        <label for="">Discound</label>
                                                        <input type="text" class="form-control" id="dsc"
                                                            required placeholder="Discound">
                                                    </div>
                                                    <div class="group-form mb-3">
                                                        <label for="">Tax</label>
                                                        <input type="text" class="form-control" id="tax"
                                                            required placeholder="Tax">
                                                    </div>
                                                    <div class="group-form mb-3">
                                                        <label for="">Total</label>
                                                        <input type="text" class="form-control" id="total"
                                                            required placeholder="Total">
                                                    </div>
                                                    <div class="group-form mb-3">
                                                        <label for="">Grand Total</label>
                                                        <input type="text" class="form-control" id="grandtotal"
                                                            required placeholder="Grandtotal">
                                                    </div>
                                                    <div class="group-form mb-3">
                                                        <label for="">Date</label>
                                                        <input type="date" class="form-control" id="date"
                                                            required placeholder="Date">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary btnEditrep">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Show modal --}}
                                    <div class="modal fade" id="FormShow" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail P.O</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-hover table-bordered text-center" id="podtail_data">
                                                        <thead>
                                                            <tr class="table-active">
                                                                <th>PoId</th>
                                                                <th>ProductId</th>
                                                                <th>Qty</th>
                                                                <th>Const</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            {{-- data get from js --}}
                                                        </tbody>
                                                    </table>
                                                    <nav id="modal-pagination" aria-label="Page navigation">
                                                        <ul class="pagination justify-content-center">
                                                            <!-- Pagination links will be inserted here -->
                                                        </ul>
                                                    </nav>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary btnEditrep">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Receipt --}}
                                    <div class="modal fade" id="FormPrint" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    {{-- <h1 class="modal-title fs-5" id="exampleModalLabel">Payment Receipt --}}
                                                    {{-- </h1> --}}
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="FormPayment">
                                                    <div class="receipt text-center" >
                                                        <h5 class="text-xl text-center mt-3">Payment Receipt</h5>
                                                        <hr/>
                                                        <p class="fw-bold">Product Code: <span id="pdcode" class="fw-normal"></span></p>
                                                        <p class="fw-bold">Discound: <span id="ds" class="fw-normal"></span> $</p>
                                                        <p class="fw-bold">Tax: <span id="tax1" class="fw-normal"></span> $</p>
                                                        <p class="fw-bold">Grand Totals: <span id="GDT" class="fw-normal"></span> $</p>
                                                        <p class="fw-bold">Total: <span id="total1" class="fw-normal"></span> $</p>
                                                        <p class="fw-bold">Date: <span id="date1" class="fw-normal"></span></p>
                                                        <p class="fw-bold">Transaction ID: <span id="transaction" class="fw-normal"></span></p>
                                                        <hr/>
                                                        <p>Thank You!</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    {{-- <button type="button" class="btn btn-secondary Download">Download Receipt</button> --}}
                                                    <button type="button" class="btn btn-primary PrintReceipt">Print Receipt</button>
                                                    <a id="downloadButton" class="btn btn-primary Receipt">Download Receipt</a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Content Wrapper -->

        </div>
        <script src="{{ asset('js/reports/edit.js') }}"></script>
        {{-- <script src="{{ asset('js/podatail/show.js') }}"></script> --}}
        <script src="{{ asset('js/reports/search.js') }}"></script>
        <script src="{{ asset('js/reports/print.js') }}"></script>
    </body>
</body>

</html>
