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
                <div>Private - Discussion with {{ $user_name }}</div>
                {{-- <div class="ml-auto"><a class="btn btn-sm btn-secondary text-sm" href="#">&lt; back</a></div> --}}
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @include('layouts.messages')
                </div>
            </div>
            <div class="card card-default">
                <table class="table table-striped">
                    <tbody>
                        @foreach ($chat_with_teacher as $item)
                        <tr>
                            <td class="text-center" style="width: 15%;">
                                <div class="mt-2"><a href="#"><img class="rounded-circle thumb64" src="{{ asset('design/img/Logo.png') }}" alt="avatar"></a></div>
                            </td>
                            <td>
                                <p>{{ $item->message }}</p>
                                <div class="text-right"><em>{{ $item->created_at }}</em></div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="collase" id="topic-reply">
                <div class="text-center">
                    <div class="text-sm">Please type your comment here</div>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="col-xl-12">
                    <form class="form-horizontal" action="/send-private-message/{{ request()->route()->user_id }}" method="get">
                        <div class="form-group"><textarea class="form-control" id="reply-message" name="comment" rows="5" placeholder="Type your question here..." required></textarea></div>
                        <div class="form-group text-center"><button class="btn btn-sm btn-primary" type="submit">Post Comment</button></div>
                    </form>
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
