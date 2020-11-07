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
                                        <th>Class</th>
                                        <th>Status</th>
                                        <th class="sort-numeric">Date</th>
                                        <th class="sort-alpha" data-priority="2">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($class as $id => $classes)
                                    <tr class="gradeX">
                                        <td>{{ $id + 1 }}</td>
                                        <td>{{ $classes->class }}</td>
                                        <td>{{ $classes->status }}</td>
                                        <td>{{ $classes->created_at }}</td>
                                        <td>
                                            <a href="/delete-class/{{ $classes->id }}"><button class="btn btn-sm btn-danger">Delete class</button></a>
                                            <a href="/edit-class-form/{{ $classes->id }}">
                                                <button class="btn btn-sm btn-info">Edit Class</button>
                                            </a>
                                            <a href="/get-class-homeworks/{{ $classes->id }}"><button class="btn btn-sm btn-success">Homeworks</button></a>
                                            <a href="/get-class-notes/{{ $classes->id }}"><button class="btn btn-sm btn-primary">Notes</button></a>
                                            <a href="/get-class-questions/{{ $classes->id }}"><button class="btn btn-sm btn-secondary">Questions</button></a>
                                            <a href="/get-class-past-papers/{{ $classes->id }}"><button class="btn btn-sm btn-warning">Past Papers</button></a>
                                        </td>
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
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal" type="button"><i class="fa fa-plus"></i> Add Class</button>
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

<!-- Modal -->
<form action="/create-class" method="GET">
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">To Add a class, Fill this form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="text" name="class" id="" class="form-control" value="{{ old('class') }}" autocomplete="off" min-length="11">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>