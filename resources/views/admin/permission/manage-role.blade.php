@extends('admin.layouts.master')

@section('title', 'Role / Peran')

@section('page-name', 'Role / Peran')

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
                    <form role="form" action="{{ isset($role) ? route('admin.role.update', $role->id):route('admin.role.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Role<span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $role->name ?? '') }}" class="form-control @error('name') is-invalid @enderror" id="" placeholder="Masukkan nama role">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            @if(isset($role))
                                @php
                                    $assigned = $role->permissions()->pluck('name')->toArray();
                                @endphp
                                <table class="table table-sm table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px"><input type="checkbox" id="checkAll"></th>
                                            <th>Permission</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($permissions as $permission)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="permissions[]" {{ in_array($permission->name, $assigned) ? 'checked="checked"' : '' }} value="{{ $permission->id }}">
                                            </td>
                                            <td>
                                                {{ $permission->name }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else 
                            <table class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px"><input type="checkbox" id="checkAll"></th>
                                        <th>Permission</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($permissions as $permission)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                                        </td>
                                        <td>
                                            {{ $permission->name }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.role.index') }}" class="btn btn-sm btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
                    <button type="submit" class="btn btn-success btn-sm"><i class="far fa-save"></i> Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#checkAll").click(function(){
                $('input:checkbox').not(this).prop('checked', this.checked);
            });
        });
    </script>
@endpush