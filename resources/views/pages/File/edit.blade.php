  <!-- start Modal Edit -->
  <div class="modal fade" id="modalEdit{{$item['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">modifier le document {{$item['title']}} </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form method="post" action="{{ route('document.update', $item['id']) }}" class="form-horizontal needs-validation"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="form-group">
                        <div class="mb-3">
                            <label>Titre du document</label>
                            <input type="text" name="title" value="{{$item['title']}}" class="form-control" placeholder="rapport" required>
                            <div class="invalid-feedback">
                                champs obligatoire
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Categorie du document</label>
                            <select name="category" id="" class="form-control" required>
                                <option desabled value>Choisir une categorie</option>
                                <option value="rapport" {{ $item['category']=='rapport' ? 'selected' : ''}}>Rapport</option>
                                <option value="bilan" {{ $item['category']=='bilan' ? 'selected' : ''}}>Bilan</option>
                                <option value="note_analyse" {{ $item['category']=='note_analyse' ? 'selected' : ''}}>Note d'analyse</option>
                            </select>
                            <div class="invalid-feedback">
                                champs obligatoire
                            </div>
                        </div>

                        <div>
                            <label>Fichier</label>
                            <h6 class="text-success">Fichier exixtant : {{$item->getFirstMedia('files')->file_name }}</h6>
                            <input type="file" value="{{$item->getFirstMedia('files')->file_name }}" name="file" class="form-control" accept="application/pdf">
                            {{-- <div class="invalid-feedback">
                                champs obligatoire
                            </div> --}}
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
<!-- end Modal Edit -->
