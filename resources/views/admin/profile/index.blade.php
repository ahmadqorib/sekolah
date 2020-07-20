@extends('admin.layouts.master')

@section('title', 'Profile')

@section('page-name', 'Profile Sekolah')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                            src="{{ asset($profile->logo_url ?? '') }}"
                            alt="Logo Sekolah">
                    </div>

                    <h3 class="profile-username text-center">{{ $profile->name ?? '-' }}</h3>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Nomor Telepon</b> <a class="float-right small">{{ $profile->phone_number ?? '-' }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Email</b> <a class="float-right small">{{ $profile->email ?? '-' }}</a>
                        </li>
                    </ul>

                    @if(!is_null($profile))
                    <a href="{{ route('admin.profile.edit') }}" class="btn btn-block bg-gradient-danger btn-sm float-right">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    @else 
                    <a href="{{ route('admin.profile.create') }}" class="btn btn-block bg-gradient-success btn-sm float-right">
                        <i class="fas fa-plus"></i> Tambah
                    </a>
                    @endif
                </div>
            </div>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tentang Kami</h3>
                </div>
                <div class="card-body">
                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                    <p class="text-muted">{{ $profile->address ?? '-' }}</p>

                    <hr>

                    <strong><i class="fab fa-facebook-square"></i> Facebook</strong>

                    <p class="text-muted">{{ $profile->facebook ?? '-' }}</p>

                    <hr>

                    <strong><i class="fab fa-twitter-square"></i> Twitter</strong>

                    <p class="text-muted">{{ $profile->twitter ?? '-' }}</p>

                    <hr>

                    <strong><i class="fab fa-instagram-square"></i> Instagram</strong>

                    <p class="text-muted">{{ $profile->instagram ?? '-' }}</p>
                    
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#vision" data-toggle="tab">Visi</a></li>
                        <li class="nav-item"><a class="nav-link" href="#mission" data-toggle="tab">Misi</a></li>
                        <li class="nav-item"><a class="nav-link" href="#profile" data-toggle="tab">Deskripsi Sekolah</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="vision">
                            <div class="post">
                                <p>
                                    {!! $profile->vision ?? '-' !!}
                                </p>
                            </div>
                        </div>
                        <div class="tab-pane" id="mission">
                            <div class="post">
                                <p>
                                    {!! $profile->mission ?? '-' !!}
                                </p>
                            </div>
                        </div>
                        <div class="tab-pane" id="profile">
                            <div class="post">
                                <p>
                                    {!! $profile->profile ?? '-' !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Peta</div>
                <div class="card-body">
                    {!! $profile->map ?? '-' !!}
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection