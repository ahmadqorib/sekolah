@extends('admin.layouts.master')

@section('title', 'Permission')

@section('page-name', 'Permission')

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
                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Permission</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permissions as $i => $permission)
                            <tr>
                                <td>{{ $i + 1 }}.</td>
                                <td>
                                    {{ $permission->name }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $permissions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection