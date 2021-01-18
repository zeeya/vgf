@extends('layouts.app')

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
                                    <h3 class="mb-0">Demandes</h3>
                                </div>
                                <div class="col-4 text-right">
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                        </div>

                        <div class="table-responsive">
                            <table class="table align-items-center table-flush"  id="retunRequestDatatableAjax">
                                <thead class="thead-light">
                                <tr role="row" class="filter">
                                <td><input type="text" class="form-control" name="compteur" id="compteur"
                                               autocomplete="off" placeholder="Compteur">                                    </td>
                                    <td><input type="text" class="form-control" name="name_designation" id="name_designation"
                                               autocomplete="off" placeholder="Designation">                                    </td>
                                    <td><input type="text" class="form-control" name="name_type" id="name_type"
                                               autocomplete="off" placeholder="Type">                                    </td>
                                    <td><input type="text" class="form-control" name="n_kvps" id="n_kvps"
                                               autocomplete="off" placeholder="KVPS">                                    </td>
                                    <td><input type="text" class="form-control" name="weight_kg" id="weight_kg"
                                               autocomplete="off" placeholder="weight_kg">                                    </td>
                                    <td>       </td>
                                    <td>   </td>
                                </tr>
                                <tr>
                                    <th scope="col">Compteur</th>

                                    <th scope="col">Designation</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">N kvps</th>
                                    <th scope="col">weight kg</th>
                                    <th scope="col">Date de creation</th>
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
            var oTable = $('#retunRequestDatatableAjax').DataTable({
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
                    url: '{!! route('listsReturn_request') !!}',
                    data: function (d) {
                        d.name_designation = $('#name_designation').val();
                        d.n_kvps = $('#n_kvps').val();
                        d.weight_kg = $('#weight_kg').val();
                        d.name_type = $('#name_type').val();
                        d.compteur = $('#compteur').val();

                    }
                }, columns: [
                    {data: 'compteur', name: 'compteur'},
                    {data: 'name_designation', name: 'name_designation'},
                    {data: 'name_type', name: 'name_type'},
                    {data: 'n_kvps', name: 'n_kvps'},
                    {data: 'weight_kg', name: 'weight_kg'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: true, searchable: false}
                ]
            });
            $('#datatable-search-form').on('submit', function (e) {
                oTable.draw();
                e.preventDefault();
            });
            $('#name_type').on('keyup', function (e) {
                oTable.draw();
                e.preventDefault();
            });
            $('#weight_kg').on('keyup', function (e) {
                oTable.draw();
                e.preventDefault();
            });
            $('#n_kvps').on('keyup', function (e) {
                oTable.draw();
                e.preventDefault();
            });
            $('#name_designation').on('keyup', function (e) {
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
            $('#compteur').on('keyup', function (e) {
                oTable.draw();
                e.preventDefault();
            });


        });


        function deleteRequest(id) {
            var msg = 'Are you sure?';
            if (confirm(msg)) {
                $.post("{{ route('supprimerReturn_request') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        if (response == 'ok') {
                            var table = $('#retunRequestDatatableAjax').DataTable();
                            table.row('requestDtRow' + id).remove().draw(false);
                        } else {
                            alert('Request Failed!');
                        }
                    });
            }
        }

    </script>
@endpush
