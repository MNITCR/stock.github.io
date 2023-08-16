<!DOCTYPE html>
<html lang="en">

<head>
    @extends('admin.links')
    @section('title', 'Product')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

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
                            <h1 class="h3 mb-0 text-gray-800">Products</h1>
                        </div>

                        <!-- loop data from database -->
                        <div class="row">
                            <div class="container-fluid py-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-end mb-3">
                                            <div class="mr-3">
                                                <input type="search" name="search_data" id="search_input" class="form-control" placeholder="Search data">
                                            </div>
                                            <button type="button" class="btn btn-sm btn-primary Add">Add Product</button>
                                        </div>
                                        <table class="table table-hover table-bordered text-center" id="pro_data">
                                            <tr class="table-active">
                                                <th>ID</th>
                                                <th>Barcode</th>
                                                <th>ProductTitle</th>
                                                <th>Qty</th>
                                                <th>Price</th>
                                                <th>Amount</th>
                                                <th>Catid</th>
                                                <th>Cattitle</th>
                                                <th>Action</th>
                                            </tr>
                                            @foreach ($list as $item)
                                                <tr class="user_row">
                                                    <td>{{ $item->proid }}</td>
                                                    <td>{{ $item->barcode }}</td>
                                                    <td>{{ $item->protitle }}</td>
                                                    <td>{{ $item->qty }}</td>
                                                    <td>{{ $item->price }} $</td>
                                                    <td>{{ $item->amount }} $</td>
                                                    <td>{{ $item->catid }}</td>
                                                    <td>{{ $item->cattitle }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary btn-sm editPro" >Edit</button>
                                                        <form class="d-inline" action="{{ route('delete-pro', ['id' => $item->proid]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Product?')">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <!-- No found row -->
                                                <tr id="no_row" style="display:none;">
                                                    <td colspan="10" class="text-center text-danger">No user found</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                        {{ $list->links() }}
                                    </div>

                                    {{-- Add Product --}}
                                    <div class="modal fade" id="AddPro" tabindex="-1" aria-labelledby="AddModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-fullscreen">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add Product</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="d-flex justify-content-end">
                                                        <button type="button" class="btn btn-success btn-sm" id="addMoreButton">Add More</button>
                                                    </div>

                                                    <div class="d-flex gap-1 justify-content-between mt-2">
                                                        <div><label for="">Barcode</label></div>
                                                        <div style="margin-left: 10px"><label for="">Title</label></div>
                                                        <div style="margin-left: 35px"><label for="">Quantity</label></div>
                                                        <div><label for="">Price</label></div>
                                                        <div style="position: relative;left: 30px"><label for="">Category Title</label></div>
                                                        <div><label for="">Remove</label></div>
                                                    </div>
                                                    <hr/>
                                                    <form id="AddForm">
                                                        @csrf
                                                        <div class="d-flex justify-content-between mb-3 input-set">
                                                            <div class="group-form">
                                                                <input type="text" name="addbarcode" id="addbarcode"  placeholder="barcode" class="form-control" required>
                                                            </div>
                                                            <div class="group-form">
                                                                <input type="text" name="addtitle" id="addtitle" placeholder="title" class="form-control" required>
                                                            </div>
                                                            <div class="group-form">
                                                                <input type="text" name="addqty" id="addqty" placeholder="quantity" class="form-control" required>
                                                            </div>
                                                            <div class="group-form">
                                                                <input type="text" name="addprice" id="addprice" placeholder="price" class="form-control" required>
                                                            </div>
                                                            <div class="group-form">
                                                                <select name="addcate" id="addcate" class="form-select addcate" style="width: 200px">
                                                                    {{-- <option value=""></option> <!-- Default empty option --> --}}
                                                                </select>
                                                            </div>
                                                            <div class="group-form">
                                                                <button type="button" class="btn btn-danger btn-sm remove-input">Remove</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary AddButton" id="AddButton">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- update --}}
                                    <div class="modal fade" id="updatePro" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Product</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        @csrf
                                                        <input type="hidden" id="ProId">
                                                        <div class="group-form mb-3">
                                                            <label class="form-label">Barcode</label>
                                                            <input type="text" name="barcode" id="barcode"  placeholder="barcode" class="form-control">
                                                        </div>
                                                        <div class="group-form mb-3">
                                                            <label class="form-label">Title</label>
                                                            <input type="text" name="title" id="title" placeholder="title" class="form-control">
                                                        </div>
                                                        <div class="group-form mb-3">
                                                            <label class="form-label">Quantity</label>
                                                            <input type="text" name="qty" id="qty" placeholder="quantity" class="form-control">
                                                        </div>
                                                        <div class="group-form mb-3">
                                                            <label class="form-label">Price</label>
                                                            <input type="text" name="price" id="price" placeholder="price" class="form-control">
                                                        </div>
                                                        <label class="form-label">Category Id</label>
                                                        <div class="group-form mb-3">
                                                            <select name="cate" id="cate" class="form-select">
                                                                {{-- <option value=""></option> <!-- Default empty option --> --}}
                                                            </select>
                                                        </div>
                                                   </form>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary UpdateButton" id="UpdateButton">Submit</button>
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
            </div>
            <!-- End of Content Wrapper -->

        </div>
        <script src="{{ asset('js/product/add.js') }}"></script>
        <script src="{{ asset('js/product/edit.js') }}"></script>
        <script src="{{ asset('js/product/search.js') }}"></script>
    </body>

</html>
