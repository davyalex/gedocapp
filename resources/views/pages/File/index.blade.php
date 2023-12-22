@extends('layout')

@auth
    
@section('content')
    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css
    ">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css
    ">
    @endpush

    <div class="my-3">
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalAdd"> <i
                class="fa fa-plus"></i> Ajouter un document</button>
    </div>


  @include('components.validationMessage')


    <table id="table" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Titre</th>
                <th>categorie</th>
                <th>Date de creation</th>
                <th>Nombre de telechargement</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($documents as $key => $item)
                <tr>
                    <td> {{ ++$key }} </td>
                    <td>{{ $item['title'] }}</td>
                    <td>{{ $item['category'] }}</td>
                    <td>{{ $item['created_at']->format('d-m-Y') }}</td>
                    <td>{{ $item['nb_download'] }}</td>


                    <td>
                        <div class="d-flex justify-content-center gap-2 text-center">
                            <a href=""  data-bs-toggle="modal" data-bs-target="#modalEdit{{$item['id']}}"  class="bg-success p-2 text-white rounded-2" style="text-decoration: none"><i
                                    class="fa fa-pencil"></i> </a>
                            <a href="#" role="button" data-id="{{ $item['id'] }}"
                                class="bg-danger p-2 text-white rounded-2 deleteDocument" style="text-decoration: none"><i
                                    class="fa fa-trash"></i> </a>
                        </div>
                    </td>
                </tr>

  <!-- start Modal Edit -->
@include('pages.File.edit')
  <!-- end Modal Edit -->


            @endforeach

        </tbody>
    </table>





    <!-- start Modal Add -->
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter un document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form method="post" action="{{ route('document.store') }}" class="form-horizontal needs-validation"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="form-group">
                            <div class="mb-3">
                                <label>Titre du document</label>
                                <input type="text" name="title" class="form-control" placeholder="" required>
                                <div class="invalid-feedback">
                                    champs obligatoire
                                </div>
                            </div>

                            <div class="mb-3">
                                <label>Categorie du document</label>
                                <select name="category" id="" class="form-control" required>
                                    <option desabled value>Choisir une categorie</option>
                                    <option value="rapport">Rapport</option>
                                    <option value="bilan">Bilan</option>
                                    <option value="note_analyse">Note d'analyse</option>
                                </select>
                                <div class="invalid-feedback">
                                    champs obligatoire
                                </div>
                            </div>

                            <div>
                                <label>Fichier</label>
                                <input type="file" name="file" class="form-control" accept="application/pdf" required>
                                <div class="invalid-feedback">
                                    champs obligatoire
                                </div>
                            </div>

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Quitter</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end Modal Add -->

      


  

    </div>

    @push('scripts')
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    @endpush

    <script type="text/javascript">
        //datatable
        $(document).ready(function() {
            $('table').DataTable();
        });

        //validation form
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()

        //delete document
        $(".deleteDocument").click(function(e) {
            e.preventDefault();
            var Id = $(this).attr('data-id');

            Swal.fire({
                title: "Etes vous supprimer?",
                text: "Cette action est irreversible!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Oui, Supprimer!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                            type: "POST",
                            url: "/document/destroy/" + Id,
                            dataType: "json",
                            data: {
                                _token: '{{ csrf_token() }}',

                            },
                            success: function(response) {
                                if (response.status === 200) {
                                    Swal.fire({
                                        toast: true,
                                        icon: 'success',
                                        title: 'document supprimé avec success',
                                        animation: false,
                                        position: 'top',
                                        background: '#3da108e0',
                                        iconColor: '#fff',
                                        color: '#fff',
                                        showConfirmButton: false,
                                        timer: 500,
                                        timerProgressBar: true,
                                    });
                                    setTimeout(function() {
                                        window.location.href =
                                            "{{ route('document.index') }}";
                                    }, 500);
                                }
                            }
                        });
                }
            });

        });


    </script>
@endsection
@endauth
