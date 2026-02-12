@extends('layouts.admin')

@section('title', 'Usuarios')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0 fw-bold">Gestión de Usuarios</h2>
            @can('users_create')
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-primary-custom">
                    <i class="fas fa-plus me-2"></i>Nuevo Usuario
                </a>
            @endcan
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card card-custom">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle table-custom">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="fw-bold">{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach($user->roles as $role)
                                            <span class="badge bg-dark text-white me-1">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="text-end">
                                        @can('users_edit')
                                            <a href="{{ route('users.edit', $user) }}"
                                                class="btn btn-sm btn-light text-primary me-1"><i class="fas fa-edit"></i></a>
                                        @endcan
                                        @can('users_delete')
                                            <form action="{{ route('users.destroy', $user) }}" method="POST"
                                                class="d-inline delete-form">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-light text-danger"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection