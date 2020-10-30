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
                            <div class="card-title">A table showing teachers</div>
                            </div>
                            <div class="card-body">
                            <table class="table table-striped my-4 w-100" id="datatable2">
                                <thead>
                                    <tr>
                                        <th data-priority="1">No.</th>
                                        <th>School</th>
                                        <th>Teacher Name</th>
                                        <th>Photo</th>
                                        <th>Status</th>
                                        <th>options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($get_all_teachers as $id => $teachers)
                                    <tr class="gradeX">
                                        <td>{{ $id + 1 }}</td>
                                        <td>{{ $teachers->name }}</td>
                                        <td>{{ $teachers->teachers_name }}</td>
                                        <td><img src="{{ asset('teachers-photos/'. $teachers->photo) }}" style="width:100px; height:70px"/></td>
                                        <td>{{ $teachers->status }}</td>
                                        <td>
                                            @if($teachers->status == "active")
                                                <a href='/suspend-teacher/{{ $teachers->teachers_login_id }}'><button class="btn btn-sm btn-warning" title="suspend teacher"><i class="fa fa-times"></i></button></a>
                                            @else
                                                <a href='/activate-teacher/{{ $teachers->teachers_login_id }}'><button class="btn btn-sm btn-success" title="Activate teacher"><i class="fa fa-check"></i></button></a>
                                            @endif
                                            {{-- <a href="/edit-teacher/{{ $teachers->id }}">
                                                <button class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button>
                                            </a> --}}
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
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal" type="button"><i class="fa fa-plus"></i> Add Teacher</button>
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
<!-- Modal -->
<form action="/create-teacher" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">To add homework, Fill this form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="Teachers Name">Teachers Name</label>
                            <input type="text" name="teachers_name" id="" class="form-control" autocomplete="off">
                        </div>
                        <div class="col-lg-12">
                            <label for="Contact">Contact:</label>
                            <input name="contact" id="contact" class="form-control" autocomplete="off" type="text">
                        </div>
                        <div class="col-lg-12"><br>
                            <input type="file" class="form-control dropzone mb-3 card d-flex flex-row justify-content-center flex-wrap"
                            id="dropzone-area" accept="image/*" name="photo">
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