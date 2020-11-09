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
                            <div class="card-title">A table showing Parents</div>
                            </div>
                            <div class="card-body">
                            <table class="table table-striped my-4 w-100" id="datatable2">
                                <thead>
                                    <tr>
                                        <th data-priority="1">No.</th>
                                        <th>Names</th>
                                        <th>Photo</th>
                                        <th>Contact</th>
                                        <th class="sort-numeric">Location</th>
                                        <th>Role</th>
                                        <th class="sort-alpha" data-priority="2">Status</th>
                                        <th>Date</th>
                                        @if(in_array("Can activate parents", auth()->user()->getUserPermisions()) || in_array("Can suspend parents", auth()->user()->getUserPermisions()))
                                        <th>Options</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($parent_information as $id => $parents)
                                    <tr class="gradeX">
                                        <td>{{ $id + 1 }}</td>
                                        <td>{{ $parents->parent_name }}</td>
                                        <td><img src="{{ asset('parent_photo/'. $parents->photo) }}" style="width:100px; height:70px"/></td>
                                        <td>{{ $parents->contact }}</td>
                                        <td>{{ $parents->location }}</td>
                                        <td style="text-transform: capitalize">{{ $parents->role }}</td>
                                        <td>{{ $parents->status }}</td>
                                        <td>{{ $parents->created_at }}</td>
                                        @if(in_array("Can activate parents", auth()->user()->getUserPermisions()) || in_array("Can suspend parents", auth()->user()->getUserPermisions()))
                                        <td>
                                            @if($parents->status == 'inactive')
                                                @if(in_array("Can activate parents", auth()->user()->getUserPermisions()))
                                                    <a href="/activate-parent/{{ $parents->id }}"><button class="btn btn-sm btn-success">Activate parent</button></a>
                                                @endif
                                            @else
                                                @if(in_array("Can suspend parents", auth()->user()->getUserPermisions()))
                                                    <a href='/suspend-parent/{{ $parents->id }}'><button class="btn btn-sm btn-warning">Suspend parent</button></a>
                                                @endif
                                            @endif
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                        @if(in_array("Can add parents", auth()->user()->getUserPermisions()))
                        <div class="row">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4 text-right">
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal" type="button"><i class="fa fa-plus"></i> Add Parent</button>
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
<form action="/create-parent" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">To Add a Parent, Fill this form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="Names">Names</label>
                            <input type="text" name="parent_name" id="" class="form-control" value="{{ old('parent_name') }}" autocomplete="off" />
                        </div>
                        <div class="col-lg-6">
                            <label for="Contact">Contact</label>
                            <input type="text" name="contact" id="" class="form-control" value="{{ old('contact') }}" autocomplete="off" />
                        </div>
                        <div class="col-lg-6">
                            <label for="Location">Location</label>
                            <input type="text" name="location" id="" class="form-control" value="{{ old('location') }}" autocomplete="off" />
                        </div>
                        <div class="col-lg-6">
                            <label for="Role">Role</label>
                            <input list="roles" name="role" id="role" class="form-control" autocomplete="off" value="{{ old('role') }}" required>
                            <datalist id="roles">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->role }}">
                                @endforeach
                            </datalist>
                        </div>
                        <div class="col-lg-12"><br>
                            <label for="Photo">Parents Photo</label>
                            <input type="file" class="form-control dropzone mb-3 card d-flex flex-row justify-content-center flex-wrap"
                            id="dropzone-area" accept="image/*" name="photo">
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