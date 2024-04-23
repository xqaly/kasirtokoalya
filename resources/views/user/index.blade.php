@extends('layouts.main', ['title' => 'User'])

@section('title-content')
<i class="fas fa-user-tie mr-2"></i>
User
@endsection

@section('content')
@if (session('store') == 'success')
<x-alert type="success">
    <strong>Berhasil dibuat!</strong> User berhasil dibuat.
</x-alert>
@endif
@if (session('update') == 'success')
<x-alert type="success">
    <strong>Berhasil diupdate!</strong> User berhasil diupdate.
</x-alert>
@endif
@if (session('destroy') == 'success') {{-- Fix the typo here --}}
<x-alert type="success">
    <strong>Berhasil dihapus!</strong> User berhasil dihapus.
</x-alert>
@endif

<div class="card card-orange card-outline">
    <div class="card-header form-inline">
        <a href="{{ route('user.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i> Tambah
        </a>
        <form action="?" method="get" class="ml-auto">
            <div class="input-group">
                <input type="text" class="form-control" name="search" value="{{ request()->input('search') }}" placeholder="Nama, Username">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
        @if($users->isEmpty())
    <script>
        alert("User yang Anda cari tidak ditemukan.");
    </script>
@endif
    </div>
    <div class="card-body p-0">
        <table class="table table-striped table hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $key => $user)
                <tr>
                    <td>{{ $users->firstItem() + $key }}</td>
                    <td>{{ $user->nama }}</td>
                    <td>{{ $user->username }}</td>
                    <td class="text-right">
                        <a href="{{ route('user.edit', ['user' => $user->id]) }}" class="btn btn-xs text-success p-0 mr-1">
                            <i class="fas fa-edit"></i>
                        </a>

                        <button type="button" data-toggle="modal" data-target="#modalDelete{{ $user->id }}"
                                    data-url="{{ route('user.destroy', ['user' => $user->id]) }}"
                                    class="btn btn-xs text-danger p-0 btn-delete" id="btn-delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $users->appends(['search' => request()->input('search')])->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>
@endsection
@push('modals')
    @foreach ($users as $user)
        <div class="modal fade" id="modalDelete{{ $user->id }}" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah yakin akan dihapus?</p>
                        <form action="{{ route('user.destroy', ['user' => $user->id]) }}" method="post" style="display: none;" id="formBatal{{ $user->id }}">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        <button type="button" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('formBatal{{ $user->id }}').submit();">
                            Ya, Hapus!
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endpush