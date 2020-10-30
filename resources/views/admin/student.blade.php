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
                            <div class="card-title">A table showing all students</div>
                            </div>
                            <div class="card-body">
                            <table class="table table-striped my-4 w-100" id="datatable2">
                                <thead>
                                    <tr>
                                        <th data-priority="1">No.</th>
                                        <th>School</th>
                                        <th>Class</th>
                                        <th class="sort-numeric">Parent</th>
                                        <th class="sort-alpha" data-priority="2">Student names</th>
                                        <th>Age</th>
                                        <th>Status</th>
                                        <th>Photo</th>
                                        @if(auth()->user()->category == 'teacher')
                                        <th>Option</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($get_all_students as $id => $students)
                                    <tr class="gradeX">
                                        <td>{{ $id + 1}}</td>
                                        <td>{{ $students->name }}</td>
                                        <td>{{ $students->class }}</td>
                                        <td>{{ $students->parent_name }}</td>
                                        <td>{{ $students->student_name }}</td>
                                        <td>{{ $students->age }}</td>
                                        <td>{{ $students->status }}</td>
                                        <td><img src="{{ asset('student_photo/'. $students->photo) }}" style="width:100px; height:70px"/></td>
                                        @if(auth()->user()->category == 'teacher')
                                        <td>
                                            <a href='/delete-student/{{ $students->id }}'><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a>
                                            {{-- <a href="/edit-student/{{ $students->id }}">
                                                <button class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button>
                                            </a> --}}
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                        @if(auth()->user()->category == 'teacher')
                        <div class="row">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4 text-right">
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal" type="button"><i class="fa fa-plus"></i> New Student</button>
                            </div>
                        </div>
                        @endif
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
<form action="/create-student" method="POST" enctype="multipart/form-data">
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
                        <div class="col-lg-6">
                            <label for="First Name">First Name</label>
                            <input type="text" name="first_name" id="" class="form-control" autocomplete="off">
                        </div>
                        <div class="col-lg-6">
                            <label for="Last Name">Last Name</label>
                            <input type="text" name="last_name" id="" class="form-control" autocomplete="off">
                        </div>
                        <div class="col-lg-6">
                            <label for="browser">Select a Parent:</label>
                            <input list="parent" name="parent_name" id="parents" class="form-control" autocomplete="off">
                            <datalist id="parent">
                                @foreach ($parents as $parent)
                                    <option value="{{ $parent->parent_name }}">
                                @endforeach
                            </datalist>
                        </div>
                        <div class="col-lg-6">
                            <label for="class">Choose the Class:</label>
                            <input list="class" name="class_name" id="classes" class="form-control" autocomplete="off">
                            <datalist id="class">
                                @foreach ($classes as $class)
                                    <option value="{{ $class->class }}">
                                @endforeach
                            </datalist>
                        </div>
                        <div class="col-lg-12">
                            <label for="Age">Age:</label>
                            <input name="age" id="age" class="form-control" autocomplete="off" type="number">
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