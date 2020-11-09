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
            <div class="row">
                <div class="col-lg-12">
                    @include('layouts.messages')
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">A table showing past papers per class</div>
                            </div>
                            <div class="card-body">
                            <table class="table table-striped my-4 w-100" id="datatable2">
                                <thead>
                                    <tr>
                                        <th data-priority="1">No.</th>
                                        <th>Role</th>
                                        <th>Permission</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $id => $permission)
                                    <tr class="gradeX">
                                        <td>{{ $id + 1 }}</td>
                                        <td style="text-transform: capitalize">{{ $permission->role }}</td>
                                        <td>{{ $permission->Permissions }}</td>
                                        <td><a href="/revoke-permissions-from-role/{{ $permission->id }}"><button class="btn btn-sm btn-danger" type="button">revoke permission</button></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 text-right">
                                <a href="/get-settings-page"><button class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Back</button></a>
                            </div>
                        </div>
                </div>
            </div>
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