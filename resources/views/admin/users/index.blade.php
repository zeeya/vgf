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
                                    <h3 class="mb-0">Liste des utilisateurs</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="{{ route('admin.create.user') }}" class="btn btn-sm btn-primary">Ajouter un utilisateur</a>
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
                                               autocomplete="off" placeholder="Prenom"></td>
                                    <td><input type="text" class="form-control" name="lastname" id="lastname"
                                               autocomplete="off" placeholder="Nom"></td>
                                    <td><input type="text" class="form-control" name="email" id="email"
                                               autocomplete="off" placeholder="Email">                                    </td>
                                    <td>   </td>
                                </tr>
                                <tr>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Nom</th>
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
                language: {
                    processing:     "Traitement en cours...",
                    search:         "Rechercher&nbsp;:",
                    lengthMenu:    "Afficher _MENU_ &eacute;l&eacute;ments",
                    info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                    infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                    infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                    infoPostFix:    "",
                    loadingRecords: "Chargement en cours...",
                    zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                    emptyTable:     "Aucune donnée disponible dans le tableau",
                    paginate: {
                        first:      "Premier",
                        previous:   "Pr&eacute;c&eacute;dent",
                        next:       "Suivant",
                        last:       "Dernier"
                    },
                    aria: {
                        sortAscending:  ": activer pour trier la colonne par ordre croissant",
                        sortDescending: ": activer pour trier la colonne par ordre décroissant"
                    }
                },
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

        function deleteUser(id,row) {
            var msg = 'Etes-vous sûr que vous voulez supprimer?';
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
