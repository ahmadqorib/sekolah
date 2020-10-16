@extends('admin.layouts.master')

@section('title', 'Role / Peran')

@section('page-name', 'Role / Peran')

@section('content')
<div class="container-fluid">
    <!-- Info boxes -->
    <div class="row mb-4">
        <div class="col-12 col-sm-6">
            <div class="mr-auto p-1">
                <a href="{{ route('admin.role.create') }}" class="btn btn-success btn-sm" title="tambah"><i class="fas fa-plus"></i> tambah role</a>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($roles as $role)
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="info-box-number"><b>{{ $role->name }}</b></div>
                    <div>{{ $role->permissions_count }} Permission/izin akses</div>
                    <div class="text-info">{{ $role->users_count }} Pengguna</div>
                </div>
                <div class="card-footer">
                    <div class="btn-group float-right">
                        <a href="{{ route('admin.role.delete', $role->id) }}" class="btn btn-danger btn-sm" data-confirm="Apakah anda yakin menghapus data ?" data-method="delete" title="hapus"><i class="far fa-trash-alt"></i></a>
                        <a href="{{ route('admin.role.edit', $role->id) }}" class="btn btn-info btn-sm"><i class="far fa-edit"></i></a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection