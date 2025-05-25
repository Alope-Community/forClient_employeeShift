@extends('layouts.app')

@section('title', 'Detail User')

@section('content')
<div class="main p-3 ms-3 mt-3">
    <h1 class="mb-4">Detail User</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Rizki</h5>
            <h6 class="card-subtitle mb-3 text-muted">
                Terdaftar sejak: 01 Januari 2024, 10:00
            </h6>

            <dl class="row">
                <dt class="col-sm-3">Nama</dt>
                <dd class="col-sm-9">Rizki</dd>

                <dt class="col-sm-3">Email</dt>
                <dd class="col-sm-9">rizki01@email.com</dd>

                <dt class="col-sm-3">Role</dt>
                <dd class="col-sm-9">
                    <span class="badge bg-primary">Admin</span>
                </dd>
            </dl>

            <a href="#" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
</div>
@endsection
