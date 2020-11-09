<!DOCTYPE html>
<html lang="en">
@include('layouts.head')
<!-- Datatables-->
<link rel="stylesheet" href="{{ asset('design/vendor/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{ asset('design/vendor/datatables.net-keytable-bs/css/keyTable.bootstrap.css')}}">
<link rel="stylesheet" href="{{ asset('design/vendor/datatables.net-responsive-bs/css/responsive.bootstrap.css')}}"><!-- =============== BOOTSTRAP STYLES ===============-->
<link rel="stylesheet" href="{{ asset('design/vendor/dropzone/dist/basic.css')}}">
<link rel="stylesheet" href="{{ asset('design/vendor/dropzone/dist/dropzone.css')}}">
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
                            <div class="card-title">A table showing questions per class</div>
                            </div>
                            <div class="card-body">
                            <table class="table table-striped my-4 w-100" id="datatable2">
                                <thead>
                                    <tr>
                                        <th data-priority="1">No .</th>
                                        <th>Class</th>
                                        <th>Added By</th>
                                        <th class="sort-numeric">Questions</th>
                                        @if(auth()->user()->category == 'student')
                                        <th>Answers</th>
                                        @endif
                                        @if(in_array("Can add answers to question for he or she added", auth()->user()->getUserPermisions()) || 
                                        in_array("Can delete questions", auth()->user()->getUserPermisions()) || 
                                        in_array("Can edit questions", auth()->user()->getUserPermisions()) || 
                                        in_array("Can view answers to questions", auth()->user()->getUserPermisions()))
                                        <th class="sort-alpha" data-priority="2">Options</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($all_questions as $id => $questions)
                                        <tr class="gradeX">
                                            <td>{{ $id+1 }}</td>
                                            <td>{{ $questions->class }}</td>
                                            <td>{{ $questions->name }}</td>
                                            <td>
                                                <a href="{{ asset('questions/'.$questions->questions_pdf) }}" target="_blank"><i class="fa fa-download"></i> download</a>                                                
                                            </td>
                                            @if(in_array("Can add answers to question for he or she added", auth()->user()->getUserPermisions()) || 
                                            in_array("Can delete questions", auth()->user()->getUserPermisions()) || 
                                            in_array("Can edit questions", auth()->user()->getUserPermisions()) || 
                                            in_array("Can view answers to questions", auth()->user()->getUserPermisions()))
                                            <td>
                                                @if(in_array("Can add answers to question for he or she added", auth()->user()->getUserPermisions()))
                                                <a href="/add-answers-form/{{ $questions->id }}">
                                                    <button class="btn btn-sm btn-success"><i class="fa fa-plus"></i></button>
                                                </a>
                                                @endif
                                                @if(in_array("Can delete questions", auth()->user()->getUserPermisions()))
                                                <a href="/delete-question/{{ $questions->id }}">
                                                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                                </a>
                                                @endif
                                                @if(in_array("Can edit questions", auth()->user()->getUserPermisions()))
                                                <a href="/edit-question-form/{{ $questions->id }}">
                                                    <button class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button>
                                                </a>
                                                @endif
                                                @if(in_array("Can view answers to questions", auth()->user()->getUserPermisions()))
                                                <a href="/get-answers-to-question/{{ $questions->id }}">
                                                    <button class="btn btn-sm btn-secondary"><i class="fa fa-eye"></i></button>
                                                </a>
                                                @endif
                                                @if(auth()->user()->category == 'student')
                                                <a href="/get-answers-to-question/{{ $questions->id }}">
                                                    <button class="btn btn-sm btn-secondary"><i class="fa fa-eye"></i></button>
                                                </a>
                                                @endif
                                            </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                            @if(in_array("Can add questions", auth()->user()->getUserPermisions()))
                            <div class="row">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4 text-right">
                                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal" type="button"><i class="fa fa-plus"></i> Add Questions</button>
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
<form action="/create-questions" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">To add questions, Fill this form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            @include('layouts.messages')
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="browser">Choose the Subject:</label>
                                    <input list="subjects" name="subject_name" id="subject" class="form-control" autocomplete="off" />
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
                                    id="dropzone-area" accept=".pdf" name="questions_pdf">
                                </div>
                                <div class="col-lg-12">
        
                                </div>
                            </div>
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