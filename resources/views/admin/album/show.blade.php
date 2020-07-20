@extends('admin.layouts.master')

@section('title', 'Detail Album Sekolah')

@section('page-name', 'Detail Album Sekolah')

@section('content')
<div class="container-fluid">
    <div class="my-2">
        <a href="{{ route('admin.album.index') }}" class="btn btn-sm btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="img-fluit img-thumbnail"
                            src="{{ asset($album->thumbnail_url ?? '') }}"
                            alt="Thumbnail">
                    </div>

                    <h6 class="profile-username text-center">{{ $album->name ?? '-' }}</h6>
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Status</span>
                        <span class="info-box-number text-center {{ $album->is_active == 1 ? 'text-success':'text-danger' }} mb-0">Status {{ $album->is_active == 1 ? 'Aktif':'Tidak Aktif' }}</span>
                        </div>
                    </div>
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Dibuat Oleh</span>
                            <span class="info-box-number text-center text-primary mb-0">Ahmad Qorib</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <span class="float-right text-muted small"><i>di perbaharui : {{ convert_date_ind($album->updated_at, '%d %B %Y %H:%M') }}</i></span>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    Deskripsi Album
                </div>
                <div class="card-body">
                    <p class="text-muted small">
                        {{ $album->description }}
                    </p>
                </div>
            </div>

            <div>
                <span class="text-primary">Masukkan gambar dengan menekan area dibawah ini :</span>
                <form method="post" action="" enctype="multipart/form-data"
                    class="dropzone" id="dropzone">
                    @csrf
                </form>
            </div>
        </div>
    </div>
  </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/file-input/css/fileinput.css') }}"><link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/dropzone/dropzone.min.css') }}"><link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css"/>
    <style>
        .dz-message{
            text-align: center;
            font-size: 28px;
        }

        .dz-preview .dz-image img{
            width: 100% !important;
            height: 100% !important;
            object-fit: cover;
        }

        .dz-preview{
            margin: 6px !important;
        }

        .dropzone {
            border:2px dashed #2980b9;
            border-radius: 10px;
        }
    </style>
    @endpush

@push('scripts')
    <script src="{{ asset('assets/admin/plugins/dropzone/dropzone.min.js') }}"></script>
    <script>
        var url_upload = "{{ route('admin.album.upload-image', $album->id) }}";
        Dropzone.autoDiscover = false;
        $(".dropzone").dropzone({
            maxFilesize: 2, 
            addRemoveLinks: true,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            url: url_upload,
            headers:{
                'X-CSRF-Token':$('input[name="_token"]').val()
            }, 
            success: function(file, response){
                file.id = response.id;
            },
            init: function() {
                thisDropzone = this;
                var get_image = "{{ route('admin.album.get-image', $album->id) }}";
                $.get(get_image, function(data) {
                    $.each(data, function(key,value){
                        var mockFile = { id: value.id, name: value.name, size: value.size };
                        
                        thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                        thisDropzone.options.thumbnail.call(thisDropzone, mockFile, value.path);
                        thisDropzone.options.complete.call(thisDropzone, mockFile);
                    });
                });
            },
            removedfile: function(file) {
                var url_delete = '{{ route("admin.album.delete-image",":id") }}';
                url_delete = url_delete.replace(':id',file.id);

                $.ajax({
                    headers:{
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    }, 
                    type: 'DELETE',
                    url: url_delete, 
                    dataType: 'json'
                });

                var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            },
        });
    </script>
@endpush