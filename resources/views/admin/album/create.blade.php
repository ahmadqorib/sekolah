@extends('admin.layouts.master')

@section('title', 'Tambah Album')

@section('page-name', 'Tambah Album Sekolah')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body py-1 table-responsive">
                        <form role="form" action="{{ route('admin.album.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Nama Album<span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" id="" placeholder="Masukkan nama album">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <textarea name="description" placeholder="Masukkan deskripsi singkat" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Status</label>
                                <div>
                                <input type="checkbox" value="1" name="status" data-on-text="Aktif" data-off-text="Tidak Aktif" checked data-bootstrap-switch data-off-color="danger" data-on-color="primary">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Gambar<span class="text-danger">*</span></label>
                                <input type="file" id="FileUpload1" class="form-control @error('thumbnail') is-invalid @enderror" name="thumbnail"/>
                                @error('thumbnail')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="my-1 img-container">
                                    <img id="image" class="img img-thumbnail img-fluit" src="{{ asset('assets/images/empty.jpg') }}" alt="" style="width:100%"/>
                                </div>
                                <input type="hidden" name="imgX1" id="imgX1" />
                                <input type="hidden" name="imgY1" id="imgY1" />
                                <input type="hidden" name="imgWidth" id="imgWidth" />
                                <input type="hidden" name="imgHeight" id="imgHeight" />
                            </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.album.index') }}" class="btn btn-sm btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
                        <button type="submit" class="btn btn-success btn-sm"><i class="far fa-save"></i> Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/cropperjs/dist/cropper.css" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/cropper/css/main.css') }}">

@endpush

@push('scripts')
    <!-- Bootstrap Switch -->
    <script src="{{ asset('assets/admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <script src="https://unpkg.com/cropperjs/dist/cropper.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/admin/plugins/cropper/js/jquery-cropper.js') }}"></script>
    <script>
        $( document ).ready(function() {
            
            $("input[data-bootstrap-switch]").each(function(){
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            });

            $('#FileUpload1').change(function () {
                // $('#image').hide();
                var reader = new FileReader();
                reader.onload = function (e) {
                    var $image = $('#image');
                    $image.cropper('destroy');
                    $image.attr("src", e.target.result);
                    var $dataX = $('#imgX1');
                    var $dataY = $('#imgY1');
                    var $dataWidth = $('#imgWidth');
                    var $dataHeight = $('#imgHeight');
                    var options = {
                        aspectRatio: 4 / 3,
                        crop: function (e) {
                            $dataX.val(Math.round(e.detail.x));
                            $dataY.val(Math.round(e.detail.y));
                            $dataHeight.val(Math.round(e.detail.height));
                            $dataWidth.val(Math.round(e.detail.width));
                        }
                    };
                    
                    $image.cropper(options);
                }
                reader.readAsDataURL($(this)[0].files[0]);
                // reader.readAsDataURL(this.files[0]);
            });

        });
    </script>
@endpush