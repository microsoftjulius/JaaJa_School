<!DOCTYPE html>
<html lang="en">
@include('layouts.head')
<!-- Datatables-->
<link rel="stylesheet" href="{{ asset('design/vendor/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{ asset('design/vendor/datatables.net-keytable-bs/css/keyTable.bootstrap.css')}}">
<link rel="stylesheet" href="{{ asset('design/vendor/datatables.net-responsive-bs/css/responsive.bootstrap.css')}}"><!-- =============== BOOTSTRAP STYLES ===============-->
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
                            <div class="card-title">A table showing home work per class</div>
                            </div>
                            <div class="card-body">
                            <table class="table table-striped my-4 w-100" id="datatable2">
                                <thead>
                                    <tr>
                                        <th data-priority="1">No.</th>
                                        <th>Subject</th>
                                        <th>Class</th>
                                        <th>Teacher</th>
                                        <th>HomeWork</th>
                                        <th class="sort-numeric">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($homeworks as $id => $homework)
                                    <tr class="gradeX">
                                        <td>{{ $id + 1 }}</td>
                                        <td>{{ $homework->subject }}</td>
                                        <td>{{ $homework->class }}</td>
                                        <td>{{ $homework->teachers_name }}</td>
                                        <td><a href="{{ asset('home_work/'.$homework->home_work) }}" target="_blank"><i class="fa fa-download"></i> download</a></td>
                                        <td>{{ $homework->created_at }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4 text-right">
                                <a href="/display-classes"><button class="btn sm btn-info"><i class="fa fa-arrow-left"></i> back</button></a>
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
</body>
</html>
