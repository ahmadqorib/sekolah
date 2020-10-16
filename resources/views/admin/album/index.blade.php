@extends('admin.layouts.master')

@section('title', 'Album')

@section('page-name', 'Album Sekolah')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <form action="">
                            <div class="d-flex justify-content-end">
                                <div class="mr-auto p-1">
                                    <a href="{{ route('admin.album.create') }}" class="btn btn-success btn-sm" title="tambah"><i class="fas fa-plus"></i> tambah</a>
                                </div>
                                <div class="p-1">
                                    <div class="input-group">
                                        <div class="input-group-md mx-1">
                                            <select name="status" id="" class="form-control select2">
                                                <option value="">Pilih Status Aktif</option>
                                            </select>
                                        </div>
                                        <div class="input-group-md">
                                            <input type="text" class="form-control" placeholder="Input nama album">
                                        </div>
                                        <div class="input-group-md mx-1">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                                </div>
                              </div>
                        </form>
                        
                    </div>
                    <div class="card-body p-1 table-responsive">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endpush

@push('scripts')
    <!-- DataTables -->
    <script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    {!! $dataTable->scripts() !!}

    <script>
        $( document ).ready(function() {
            
        });
    </script>
@endpush