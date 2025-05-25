@extends('layouts.app')

@section('content')
<div class="main p-3 ms-3 mt-3">
    <h1 class="mb-4">Tambah Data User</h1>
    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" class="form-control" value="" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" value="" required>
    </div>

    <button type="submit" class="btn btn-primary">Tambah Data User</button>
        <a href="" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection