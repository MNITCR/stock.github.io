<!DOCTYPE html>
<html lang="en">

<head>
    @extends('admin.links')
    @section('title', 'Category')
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
                            <h1 class="h3 mb-0 text-gray-800">Category</h1>
                        </div>
                        <!-- Content Row -->
                        <div class="row">
                            <div class="container-fluid py-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-end mb-3">
                                            <div class="mr-3">
                                                <input type="search" name="search_data" id="search_input" class="form-control" placeholder="Search data">
                                            </div>
                                            <button type="button" class="btn btn-sm btn-primary AddCat">Add Category</button>
                                        </div>
                                        <table class="table table-hover table-bordered text-center" id="cat_data">
                                            <tr class="table-active">
                                                <th>Cate_ID</th>
                                                <th>Name</th>
                                                <th>Name KH</th>
                                                <th>Description</th>
                                                <th>Active</th>
                                            </tr>
                                            @foreach ($cate as $item)
                                                <tr class="cat_row">
                                                    <td>{{ $item->catid }}</td>
                                                    <td>{{ $item->title }}</td>
                                                    <td>{{ $item->titlekh }}</td>
                                                    <td>{{ $item->desciption }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary btn-sm edit">EDIT</button>
                                                        <form class="d-inline" action="{{ route('delete-cat', ['catid' => $item->catid]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Category?')">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <!-- No found row -->
                                                <tr id="no_row" style="display:none;">
                                                    <td colspan="10" class="text-center text-danger">No user found</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                        {{$cate->links()}}
                                    </div>

                                    <!-- Add Modal -->
                                    <div class="modal fade" id="AddCatModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Category</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div align="right"><a href="#" id="addMoreButton">Add</a></div>
                                                    <table class="table " id="tblcat">
                                                        <thead>
                                                            <tr>
                                                                <td>Name</td>
                                                                <td>Name KH</td>
                                                                <td>Description</td>
                                                                <td>Remove</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="AddForm">
                                                            <tr class="input-set">
                                                                <td><input type="text" name="txttitle[]"
                                                                        class="txttitle"></td>
                                                                <td><input type="text" name="txttitlekh[]"
                                                                        class="titlekh"></td>
                                                                <td><input type="text" name="txtdescription[]"
                                                                        class="descript">
                                                                </td>
                                                                <td><button class="btn btn-sm btn-danger remove-input">Remove</button></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary"
                                                        id="btnsave">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- updete modal --}}
                                    <div class="modal fade" id="FormEdit" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Category
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" id="catid">
                                                    <div class="group-form mb-3">
                                                        <label for="">Name</label>
                                                        <input type="text" class="form-control" id="title"
                                                            required placeholder="Title">
                                                    </div>
                                                    <div class="group-form mb-3">
                                                        <label for="">Name Khmer</label>
                                                        <input type="text" class="form-control" id="title_kh"
                                                            required placeholder="Title_Kh">
                                                    </div>
                                                    <div class="group-form mb-3">
                                                        <label for="">Discription</label>
                                                        <input type="text" class="form-control" id="descript"
                                                            required placeholder="Description">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary"
                                                        id="btnEdit">Save</button>
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
        <script src="{{ asset('js/category/add.js') }}"></script>
        <script src="{{ asset('js/category/edit.js') }}"></script>
        <script src="{{ asset('js/category/search.js') }}"></script>
    </body>
</body>

</html>
