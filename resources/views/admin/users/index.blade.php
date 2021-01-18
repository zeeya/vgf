@extends('admin.layouts.admin_layout')

@section('content')
        <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
            <div class="container-fluid">
                <div class="header-body">
                </div>
            </div>
        </div>
        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Users</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="{{ route('admin.create.user') }}" class="btn btn-sm btn-primary">Add user</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                        </div>

                        <div class="table-responsive">
                            <table class="table align-items-center table-flush"  id="userDatatableAjax">
                                <thead class="thead-light">
                                <tr role="row" class="filter">
                                    <td><input type="text" class="form-control" name="firstname" id="firstname"
                                               autocomplete="off" placeholder="Nom"></td>
                                    <td><input type="text" class="form-control" name="lastname" id="lastname"
                                               autocomplete="off" placeholder="Prenom"></td>
                                    <td><input type="text" class="form-control" name="email" id="email"
                                               autocomplete="off" placeholder="Email">                                    </td>
                                    <td>   </td>
                                </tr>
                                <tr>
                                    <th scope="col">firstname</th>
                                    <th scope="col">lastname</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer py-4">
                            <nav class="d-flex justify-content-end" aria-label="...">

                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>


@endsection

@push('scripts')
    <script>
        $(function () {
            var oTable = $('#userDatatableAjax').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                searching: false,
                /*
                 "order": [[1, "asc"]],
                 paging: true,
                 info: true,
                 */
                ajax: {
                    url: '{!! route('admin.fetch.data.users') !!}',
                    data: function (d) {
                        d.email = $('#email').val();
                        d.firstname = $('#firstname').val();
                        d.lastname = $('#lastname').val();
                    }
                }, columns: [
                    {data: 'firstname', name: 'firstname'},
                    {data: 'lastname', name: 'lastname'},
                    {data: 'email', name: 'email'},
                    {data: 'action', name: 'action', orderable: true, searchable: false}

                ]
            });
            $('#datatable-search-form').on('submit', function (e) {
                oTable.draw();
                e.preventDefault();
            });
            $('#email').on('keyup', function (e) {
                oTable.draw();
                e.preventDefault();
            });
            $('#firstname').on('keyup', function (e) {
                oTable.draw();
                e.preventDefault();
            });
            $('#lastname').on('keyup', function (e) {
                oTable.draw();
                e.preventDefault();
            });


        });

        function deleteUser(id) {
            var msg = 'Are you sure?';
            if (confirm(msg)) {
                $.post("{{ route('admin.delete.user') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        if (response == 'ok') {
                            var table = $('#userDatatableAjax').DataTable();
                            table.row('userDtRow' + id).remove().draw(false);
                        } else {
                            alert('Request Failed!');
                        }
                    });
            }
        }

        {{--$(function () {--}}

            {{--var table = $('#userDatatableAjax').DataTable({--}}
                {{--processing: true,--}}
                {{--serverSide: true,--}}
                {{--ajax: "{{ route('admin.fetch.data.users') }}",--}}
                {{--columns: [--}}
                    {{--{data: 'DT_RowIndex', name: 'DT_RowIndex'},--}}
                    {{--{data: 'firstname', name: 'firstname'},--}}
                    {{--{data: 'lastname', name: 'lastname'},--}}
                    {{--{data: 'email', name: 'email'},--}}
                    {{--{--}}
                        {{--data: 'action',--}}
                        {{--name: 'action',--}}
                        {{--orderable: true,--}}
                        {{--searchable: true--}}
                    {{--},--}}
                {{--]--}}
            {{--});--}}

        {{--});--}}
    </script>
@endpush
