@extends('layouts.admin')

@section('title', 'Roles y Permisos')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0 fw-bold">Gestión de Roles</h2>
            @can('roles_create')
                <a href="{{ route('roles.create') }}" class="btn btn-primary btn-primary-custom">
                    <i class="fas fa-plus me-2"></i>Nuevo Rol
                </a>
            @endcan
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card card-custom">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle table-custom">
                        <thead>
                            <tr>
                                <th>Rol</th>
                                <th>Permisos</th>
                                <th class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td class="fw-bold">{{ ucfirst($role->name) }}</td>
                                    <td>
                                        @foreach($role->permissions->take(5) as $permission)
                                            <span class="badge bg-light text-dark border me-1 mb-1">{{ $permission->name }}</span>
                                        @endforeach
                                        @if($role->permissions->count() > 5)
                                            <span class="badge bg-light text-muted border">+{{ $role->permissions->count() - 5 }}
                                                más</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        @if($role->name !== 'admin')
                                            @can('roles_edit')
                                                <a href="{{ route('roles.edit', $role) }}"
                                                    class="btn btn-sm btn-light text-primary me-1"><i class="fas fa-edit"></i></a>
                                            @endcan
                                            @can('roles_delete')
                                                <form action="{{ route('roles.destroy', $role) }}" method="POST"
                                                    class="d-inline delete-form">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-light text-danger"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>
                                            @endcan
                                        @else
                                            <span class="text-muted small"><i class="fas fa-lock me-1"></i>Protegido</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $roles->links() }}
            </div>
        </div>
    </div>
@endsection