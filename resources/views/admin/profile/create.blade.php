@extends('admin.layouts.master')

@section('title', isset($profile) ? 'Edit Profile':'Tambah Profile')

@section('page-name', isset($profile) ? 'Edit Profile Sekolah': 'Tambah Profile Sekolah')

@section('content')
<div class="container-fluid">
    <div class="card card-outline card-info">
        <div class="card-header">
            <a href="{{ route('admin.profile.index') }}" class="btn btn-sm btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
        </div>
        
        <div class="card-body">
          <form role="form" action="{{ isset($profile) ? route('admin.profile.update'):route('admin.profile.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @if (isset($profile))
                <input type="hidden" name="id" value="{{ $profile->id }}">
            @endif
            <div class="form-group">
              <label for="">Nama Sekolah<span class="text-danger">*</span></label>
              <input type="text" name="name" value="{{ old('name', $profile->name ?? null) }}" class="form-control @error('name') is-invalid @enderror" id="" placeholder="Masukkan nama sekolah">
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group">
              <label for="">Visi<span class="text-danger">*</span></label>
              <textarea class="summernote @error('vision') is-invalid @enderror" name="vision" placeholder="Masukkan visi sekolah"
                    style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('vision', $profile->vision ?? null) }}</textarea>
                @error('vision')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
              <label for="">Misi<span class="text-danger">*</span></label>
              <textarea class="summernote @error('mission') is-invalid @enderror" name="mission" placeholder="Masukkan visi sekolah"
                    style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('mission', $profile->mission ?? null) }}</textarea>
                @error('mission')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
              <label for="">Deskripsi Sekolah</label>
              <textarea class="summernote" name="description" placeholder="Masukkan visi sekolah"
                    style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('description', $profile->profile ?? null) }}</textarea>
            </div>
            <div class="form-group">
              <label for="">Alamat<span class="text-danger">*</span></label>
              <textarea name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Masukkan alamat">{{ old('address', $profile->address ?? null) }}</textarea>
              @error('address')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group">
              <label for="">Nomor Hp<span class="text-danger">*</span></label>
              <input type="text" name="phone_number" value="{{ old('phone_number', $profile->phone_number ?? null) }}" class="form-control @error('phone_number') is-invalid @enderror" id="" placeholder="Masukkan nomor hp">
              @error('phone_number')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group">
              <label for="">Email<span class="text-danger">*</span></label>
              <input type="text" name="email" value="{{ old('email', $profile->email ?? null) }}" class="form-control @error('email') is-invalid @enderror" id="" placeholder="Masukkan email">
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group">
              <label for="">Facebook</label>
              <input type="text" name="facebook" value="{{ old('facebook', $profile->facebook ?? null) }}" class="form-control" id="" placeholder="Masukkan url facebook">
            </div>
            <div class="form-group">
              <label for="">Twitter</label>
              <input type="text" name="twitter" value="{{ old('twitter', $profile->twitter ?? null) }}" class="form-control" id="" placeholder="Masukkan url twitter">
            </div>
            <div class="form-group">
              <label for="">Instagram</label>
              <input type="text" name="instagram" value="{{ old('instagram', $profile->instagram ?? null) }}" class="form-control" id="" placeholder="Masukkan url instagram">
            </div>
            <div class="form-group">
              <label for="">Map</label>
              <div class="text-danger small mb-1">
                anda dapat membuat location anda <a target="_blank" href="https://developers.google.com/maps/documentation/embed/start?hl=in">di sini</a>
              </div>
              <textarea name="map" class="form-control" placeholder="Masukkan alamat">{{ old('map', $profile->map ?? null) }}</textarea>
            </div>
            <div class="form-group">
              <label for="">Logo Sekolah</label>
              <div>
                <img id="previewing" src="{{ isset($profile) ? asset($profile->logo_url) : 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcS8GikQJ4SjNowi37yU_TNhBxAamP_afG0hFaHXL7-m_64d4kQe&usqp=CAU' }}" width="200" />
              </div>
              <div class="input-group mt-1">
                <div class="custom-file">
                  <input type="file" name="logo" class="custom-file-input @error('logo') is-invalid @enderror" id="file">
                  <label class="custom-file-label" id="label-upload">{{ isset($profile) ? $profile->logo : 'Pilih Gambar' }}</label>
                  @error('logo')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-success btn-sm"><i class="far fa-save"></i> Simpan</button>
        </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/summernote/summernote-bs4.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
      $(function () {
        // Summernote
        $('.summernote').summernote();

        $('#file').change(function(e){
          readURL(this);
          var filename = e.target.files[0].name;
          $('#label-upload').html(filename);
        });
      });
      
      function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          
          reader.onload = function (e) {
            $('#previewing').attr('src', e.target.result);
            
          }
          
          reader.readAsDataURL(input.files[0]);
        }
      } 
    </script>
@endpush