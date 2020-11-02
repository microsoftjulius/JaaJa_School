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
            <div class="row pt-4">
                <div class="col-lg-12">
                    @include('layouts.messages')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-md-6">
                                        <!-- START card-->
                                        <div class="card card-default">
                                            <div class="card-header text-center">Upload Answers For Selected Question</div>
                                            <div class="card-body">
                                                <form action="/create-answers/{{ $question_id }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-lg-12"><br>
                                                            <input type="file" class="form-control dropzone mb-3 card d-flex flex-row justify-content-center flex-wrap"
                                                            id="dropzone-area" accept=".pdf" name="answer_pdf">
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <label for="Youtube">Youtube Url</label>
                                                            <input type="url" class="form-control" name="youtube_video_url">
                                                            <br>
                                                        </div>
                                                        <div class="col-lg-12 text-center">
                                                            <button class="btn btn-sm btn-success" type="submit"><i class="fa fa-save"></i> Save</button>
                                                            <a href="/get-all-questions"><button class="btn btn-sm btn-info" type="button"><i class="fa fa-arrow-left"></i> Back</button></a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div><!-- END card-->
                                    </div>
                                    <div class="col-lg-3"></div>
                                </div><!-- END row-->
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