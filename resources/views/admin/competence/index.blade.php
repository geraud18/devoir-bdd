@extends('layouts/contentNavbarLayout')

@section('title', 'Competences')

@section('page-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <style>
        .border-ipt{
            border: 1px solid #ddd;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper" style="padding-top: 0px;">
        <div class="row"  style="margin-top: 10px;">
           <div class="col-md-3">
               <div>
                   <h3>Listes des Competences</h3>
               </div>
           </div>
        </div>
        <div class="row"  style="margin-top: 10px;">
            <div class="col-md-3">
                <div>
                    <a class="btn btn-primary btn-sm" href="{{ url('competences') }}">Ajouter</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card" style="margin-top: 10px;">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered" id="competence-datatable">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Nom</th>
                                    <th>Type</th>
                                    <th>Niveau</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            @include("admin.competence.modal.modalEdit")
            @include("admin.competence.modal.modalDelete")
        </div>
    </div>
@endsection


@section('page-script')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        'competences.id',
            'competences.name',
            'competences.type',
            'competences.niveau',
            'competences.userId',
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.fn.dataTable.ext.errMode = 'none';
            var table = $('#competence-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('competence') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'type', name: 'type'},
                    {data: 'niveau', name: 'niveau'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });

            $('.edit-modal').on('click', function () {
                alert("wwww");
            });


            $('#deleteModal').on('show.bs.modal', function (event) {

                var button = $(event.relatedTarget);
                var idchamps = button.data('id');
                var modal = $(this);

            });

        });
    </script>

@endsection
