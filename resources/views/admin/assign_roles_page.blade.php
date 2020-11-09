<!DOCTYPE html>
<html lang="en">
@include('layouts.head')
<!-- Datatables-->
<link rel="stylesheet" href="{{ asset('design/vendor/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{ asset('design/vendor/datatables.net-keytable-bs/css/keyTable.bootstrap.css')}}">
<link rel="stylesheet" href="{{ asset('design/vendor/datatables.net-responsive-bs/css/responsive.bootstrap.css')}}"><!-- =============== BOOTSTRAP STYLES ===============-->
<link rel="stylesheet" href="{{ asset('design/vendor/dropzone/dist/basic.css')}}">
<link rel="stylesheet" href="{{ asset('design/vendor/dropzone/dist/dropzone.css')}}"><!-- =============== BOOTSTRAP STYLES ===============-->
<body>
    <div class="wrapper">
        <!-- top navbar-->
        @include('layouts.header')
        @include('layouts.sidebar')
        <aside class="offsidebar d-none">
        @include('layouts.navbar')
        </aside><!-- Main section-->
    <section class="section-container">
        <!-- Page content-->
        <div class="content-wrapper">
            <div class="content-heading">
            <div>{{ request()->route()->getName() }}<small data-localize="dashboard.WELCOME"></small></div><!-- START Language list-->

            </div><!-- START cards box-->
            <form action="/assign-role-to-a-user" method="get">
                <div class="row">
                    <div class="col-lg-12">
                    @include('layouts.messages')
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title text-center" style="text-transform: capitalize">A table showing Permissions</div>
                                </div>
                                <div class="card-body">
                                <table class="table table-striped my-4 w-100" id="datatable1">
                                    <thead>
                                        <tr>
                                            <th data-priority="1">Select</th>
                                            <th>Username</th>
                                            <th>User Role</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($all_users as $id=>$user)
                                        <tr class="gradeX">
                                            <td><input type="checkbox" name="users[]" id="" value="{{ $user->id }}"></td>
                                            <td style="text-transform: capitalize">{{ $user->name }}</td>
                                            <td>{{ $user->role }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                </div>
                            </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title text-center" style="text-transform: capitalize">A table showing Roles</div>
                                </div>
                                <div class="card-body">
                                <table class="table table-striped my-4 w-100">
                                    <thead>
                                        <tr>
                                            <th data-priority="1">No.</th>
                                            <th>Select A Role</th>
                                            <th>Role</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($get_roles as $id=>$role)
                                        <tr class="gradeX">
                                            <td>{{ $id + 1 }}</td>
                                            <td><input type="radio" name="role_id" value="{{ $role->id }}"></td>
                                            <td style="text-transform: capitalize">{{ $role->role }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                </div>
                                
                            </div>
                            @if(in_array("Can assign roles to users", auth()->user()->getUserPermisions()))
                            <div class="text-left">
                                <button class="btn btn-sm btn-primary" type="submit"> Assign Role To User(s)</button>
                            </div>
                            @endif
                    </div>
                </div>
            </form>
        </div>
    </section><!-- Page footer-->
    @include('layouts.footer')
    </div><!-- =============== VENDOR SCRIPTS ===============-->
    <!-- MODERNIZR-->
    @include('layouts.javascript')
        <!-- Datatables-->
    <script src="{{ asset('design/vendor/datatables.net/js/jquery.dataTables.js')}}"></script>
    <script src="{{ asset('design/vendor/datatables.net-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{ asset('design/vendor/datatables.net-buttons/js/dataTables.buttons.js')}}"></script>
    <script src="{{ asset('design/vendor/datatables.net-buttons-bs/js/buttons.bootstrap.js')}}"></script>
    <script src="{{ asset('design/vendor/datatables.net-buttons/js/buttons.colVis.js')}}"></script>
    <script src="{{ asset('design/vendor/datatables.net-buttons/js/buttons.flash.js')}}"></script>
    <script src="{{ asset('design/vendor/datatables.net-buttons/js/buttons.html5.js')}}"></script>
    <script src="{{ asset('design/vendor/datatables.net-buttons/js/buttons.print.js')}}"></script>
    <script src="{{ asset('design/vendor/datatables.net-keytable/js/dataTables.keyTable.js')}}"></script>
    <script src="{{ asset('design/vendor/datatables.net-responsive/js/dataTables.responsive.js')}}"></script>
    <script src="{{ asset('design/vendor/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <script src="{{ asset('design/vendor/jszip/dist/jszip.js')}}"></script>
    <script src="{{ asset('design/vendor/pdfmake/build/pdfmake.js')}}"></script>
    <script src="{{ asset('design/vendor/dropzone/dist/dropzone.js')}}"></script>
</body>
</html>

<form action="/create-role" method="GET" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">To add a past paper, Fill this form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="role">Role:</label>
                            <input name="role" id="role" class="form-control" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>