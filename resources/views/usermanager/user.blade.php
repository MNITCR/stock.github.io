<!DOCTYPE html>
<html lang="en">

<head>
    @extends('admin.links')
    @section('title', 'User Manage')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">User list</h1>
                        </div>
                        <!-- Content Row -->
                        <div class="row">
                            <div class="container-fluid py-4">
                                <div class="card">

                                    {{-- Loop data from database --}}
                                    <div class="card-body">
                                        <div class="d-flex justify-content-end">
                                            <div class="mr-3">
                                                <input type="search" name="search_data" id="search_input" class="form-control" placeholder="Search data">
                                            </div>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddModal" data-bs-whatever="@mdo">Add user</button>
                                        </div>
                                        <table class="table table-hover table-bordered text-center mt-3" id="user_data">
                                            <tr class="table-active">
                                                <th>UserID</th>
                                                <th>Username</th>
                                                <th>Password</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            @foreach ($userM as $item)
                                                <tr class="user_row">
                                                    <td>{{ $item->id }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->password}}</td>
                                                    <td>{{ $item->status }}</td>
                                                    <td>
                                                        <button class="btn btn-primary btn-sm edit">Edit</button>
                                                        <form class="d-inline" action="{{ route('delete-user', ['id' => $item->id]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <!-- No found row -->
                                                <tr id="no_row" style="display:none;">
                                                    <td colspan="10" class="text-center text-danger">No user found</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                        {{$userM->links()}}
                                    </div>

                                    <!-- Add Modal -->
                                    <div class="modal fade" id="AddModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="updateModalLabel">Add User</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="d-flex justify-content-end">
                                                        <button type="button" class="btn btn-success btn-sm" id="addMoreButton">Add More</button>
                                                    </div>
                                                    <hr/>
                                                    <form id="AddForm" class="justify-content-center gap-3 mt-3">
                                                        @csrf
                                                        <div class="d-flex align-items-center gap-3 input-set mb-3">
                                                            <label class="form-label m-auto align-items-center">Name</label>
                                                            <input type="text" class="form-control" placeholder="Name">
                                                            <label class="form-label m-auto align-items-center">Password</label>
                                                            <input type="password" class="form-control" placeholder="Password">
                                                            <label class="form-label m-auto align-items-center">Status</label>
                                                            <select class="form-select" aria-label="Disabled select example">
                                                                <option value="Active">Active</option>
                                                                <option value="InActive">Inactive</option>
                                                            </select>
                                                            {{-- <input type="text" class="form-control" placeholder="Status"> --}}
                                                            <button type="button" class="btn btn-danger btn-sm remove-input">Remove</button>
                                                        </div>
                                                    </form>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary AddUserButton" id="AddUserButton">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Update Modal -->
                                    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="updateModalLabel">Update User</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="updateForm">
                                                        <input type="hidden" id="updateUserId">
                                                        <div class="mb-3">
                                                            <label class="form-label">Name</label>
                                                            <input type="text" id="updateUserName" class="form-control" placeholder="Name">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Password</label>
                                                            <input type="password" id="updateUserPassword" class="form-control" placeholder="Password">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Status</label>
                                                            <select class="form-select" aria-label="Disabled select example" id="updateUserStatus">
                                                                <option value="Active">Active</option>
                                                                <option value="InActive">Inactive</option>
                                                            </select>
                                                            {{-- <input type="text" id="updateUserStatus" class="form-control" placeholder="Status"> --}}
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary updateUserButton" id="updateUserButton">Save changes</button>
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

        <script src="{{ asset('js/userManage/search.js') }}"></script>
        <script src="{{ asset('js/userManage/add.js') }}"></script>
        <script src="{{ asset('js/userManage/update.js') }}"></script>
    </body>
</body>

</html>
