<!DOCTYPE html>
<html lang="en">

<head>
    @extends('admin.links')
    @section('title', 'Purchase')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
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
                            <h1 class="h3 mb-0 text-gray-800">Purchase</h1>
                        </div>
                        <!-- Content Row -->
                        <div align="right"><a href="/purchase">Back</a></div>
                        <h3 align="center" style="padding-bottom:20px;"> Form Create P.O </h3>
                        <div class="container">
                            <div class="row">
                                <div class="col-3">
                                    <input type="date" id="podate" class="form-control">
                                </div>
                                <div class="col-3">
                                    <input type="text" id="barcode" class="form-control" placeholder="input code">
                                </div>
                                <div class="col-3">
                                    <input type="number" id="discount" class="form-control"
                                        placeholder="Input discount">
                                </div>
                                <div class="col-3">
                                    <input type="number" id="tax" class="form-control" placeholder="input tax">
                                </div>
                            </div>
                        </div>


                        <div class="container" style="margin-top:20px;">
                            <div class="row" style="margin-bottom:20px;">
                                <div class="col-5">
                                    <input type="text" id="searchpro" class="form-control"
                                        placeholder="input Product Code">
                                </div>
                            </div>
                            <table class="table table-hover table-bordered" id="tblpo">
                                <thead>
                                    <tr class="table-active">
                                        <td>Product</td>
                                        <td>Qty</td>
                                        <td>Cost</td>
                                        <td>Amount</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody id="add_row">
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" align="right">Total</td>
                                        <td><input type="text" id="total" class="form-control"></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td colspan="3" align="right">Grand Total</td>
                                        <td><input type="text" id="grandtotal" class="form-control"></td>
                                        <td></td>
                                    </tr>

                                </tfoot>

                            </table>
                        </div>
                        <div align="center"><button id="Save" class="btn btn-primary">Save</button></div>
                    </div>
                </div>
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <script src="{{ asset('js/po/po.js') }}"></script>
    </body>
</body>

</html>
