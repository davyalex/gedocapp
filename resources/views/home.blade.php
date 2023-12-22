@extends('layout')
@section('content')
    @auth
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Documents Disponibles <span
                    style="font-size: 16px; {{ request('category') ? 'display:block' : 'display:none' }}" class=""> <i
                        class="fa fa-angle-right"></i> Categorie <i class="fa fa-angle-right"></i>
                    {{ request('category') }}</span></h1>

        </div>


        <div class="row">
            @foreach ($documents as $key => $item)
                <div class="col-md-3 py-2">
                    <div class="card">
                        {{-- card-img-top -- style}}
            {{-- {{$item->getFirstMedia('files')->file_name }} --}}
                        {{-- <embed src="{{ asset($item->getFirstMediaUrl('files')) }}" width="600" height="500" alt="pdf" /> --}}
                        {{-- <iframe src="{{ asset($item->getFirstMediaUrl('files')) }}"  frameborder="0"></iframe> --}}
                        {{-- {{$item->getFirstMedia('files')->getPath()}} --}}
                        <img src="{{ asset('images/pdf-icone.png') }}" width="70%" class="m-auto" alt="...">
                        <div class="card-body text-center">
                            <h5 class="card-title"> {{ $item['title'] }} </h5>
                            <i class="fa fa-download"></i>
                            <p class="card-text counter" id={{ $item['id'] }}>
                                {{ $item['nb_download'] }} Fois</p>
                            {{-- <a href="{{$item->getFirstMediaUrl('files')}}" target="_blank" class="btn btn-primary"> <i class="fa fa-download"></i> apercu</a> --}}
                            <a href="/document/download?path={{ $item->getFirstMedia('files')->getPath() }} && doc_id= {{ $item['id'] }}"
                                class="btn btn-outline-success btn-increase" id="{{ $item['id'] }}"
                                data-id={{ $item['id'] }}> <i class="fa fa-download"></i> Telecharger</a>

                        </div>
                    </div>
                </div>
            @endforeach



        </div>
    @endauth


    <script>
        $(document).ready(function() {
            $('.btn-increase').click(function(e) {
                // e.preventDefault();
                var id = $(this).attr('data-id');
                var documentId = $(this).attr('id')


                $.ajax({
                    type: "GET",
                    url: "/document/nb_download/" + id,
                    // data: "data",
                    dataType: "json",
                    success: function(response) {

                        $.each(response, function (index, value) { 
                            if (value.id == documentId) {
                                $('#' + documentId).html(value.nb_download);
                            }
                        });




                        // if (response.id == parseInt(id)) {
                        // var documents = {{ Js::from($documents) }}
                        // var idDoc = document.getElementById(id);
                        // var value = document.getElementById(id);
                        // var idFound = document.getElementById(id);
                        // value = response.nb_download++
                        // document.getElementById(id).value = value;

                        // var filteredValue = documents.filter(function(item) {
                        //     return item.id == response.id;
                        // });

                        // console.log(filteredValue[0].id);

                        // documents.map((doc, index) => {
                        //     if (doc.id === 1) {
                        //         documents[index] = {
                        //             id: 1,
                        //             name: 'Baba Benny'
                        //         };
                        //     }
                        //     return user
                        // })

                        // if (response.id == filteredValue[0].id) {

                        //     $('.counter').html(value)
                        // }

                        // console.log(response.id, filteredValue[0].id);

                        // //    value.id = response.nb_download;
                        // //    value =  value.innerHtml
                        //     // console.log(value);
                        //     var l = $('.counter').find(idFound);

                        //     console.log(l);

                        // var value = document.getElementById(id);
                        // var increase = response.nb_download++
                        // value = increase

                        // documents.map((el) => {
                        //    return {
                        //         ...el,
                        //         response.nb_download: id == response.id ? value : nb_download
                        //     }
                        // })

                        // console.log(value);
                        // $('.counter').app(value);
                        // }

                    }
                });

            });
        });
    </script>
@endsection
