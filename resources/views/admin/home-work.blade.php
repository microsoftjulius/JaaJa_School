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
                            <div class="card-title">A table showing home work per class</div>
                            </div>
                            <div class="card-body">
                            <table class="table table-striped my-4 w-100" id="datatable2">
                                <thead>
                                    <tr>
                                        <th data-priority="1">No.</th>
                                        <th>Subject</th>
                                        <th>Class</th>
                                        <th class="sort-alpha" data-priority="2">Added By</th>
                                        <th>Home Work</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        @if(auth()->user()->category == 'teacher')
                                        <th>Options</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($homework as $id => $work)
                                        <tr class="gradeX">
                                            <td>{{ $id + 1 }}</td>
                                            <td style="text-transform: capitalize">{{ $work->subject }}</td>
                                            <td>{{ $work->class }}</td>
                                            <td>{{ $work->name }}</td>
                                            <td><a href="{{ asset('home_work/'.$work->home_work) }}" target="_blank"><i class="fa fa-download"></i> download</a></td>
                                            <td style="text-transform: capitalize">{{ $work->status }}</td>
                                            <td>{{ $work->created_at }}</td>
                                            @if(auth()->user()->category == 'teacher')
                                            <td>
                                                <a href="/delete-home-work/{{ $work->id }}"><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a>
                                                <a href="/edit-home-work-form/{{ $work->id }}">
                                                    <button class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button>
                                                </a>
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
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal" type="button"><i class="fa fa-plus"></i> Add Home Work</button>
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
<form action="/create-home-work" method="POST" enctype="multipart/form-data">
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
                            <label for="browser">Choose the Subject:</label>
                            <input list="subjects" name="subject_name" id="subject" class="form-control" autocomplete="off">
                            <datalist id="subjects">
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->subject }}">
                                @endforeach
                            </datalist>
                        </div>
                        <div class="col-lg-12">
                            <label for="class">Choose the Class:</label>
                            <input list="class" name="class_name" id="classes" class="form-control" autocomplete="off">
                            <datalist id="class">
                                @foreach ($classes as $class)
                                    <option value="{{ $class->class }}">
                                @endforeach
                            </datalist>
                        </div>
                        <div class="col-lg-12"><br>
                            <input type="file" class="form-control dropzone mb-3 card d-flex flex-row justify-content-center flex-wrap"
                            id="dropzone-area" accept=".pdf" name="home_work">
                        </div>
                        <div class="col-lg-12">

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