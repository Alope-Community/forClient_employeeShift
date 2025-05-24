@extends('layouts.app')

@section('content')
<div class="main p-3 ms-3 mt-3">
    <div class="row justify-content-center">
        
        <!-- Kotak Kiri -->
        <div class="col-md-4 mb-4">
            <div class="card border-primary rounded shadow-sm text-center">
                <div class="card-body">
                    <div class="rounded-circle bg-primary bg-opacity-25 d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 100px; height: 100px; font-size: 40px; color: #0d6efd;">
                        A
                    </div>
                    <h5 class="card-title text-primary">Alex Johnson</h5>
                    <p class="text-muted mb-1">alex.johnson@example.com</p>
                    <p class="text-muted">Begabung Pada: Pemrograman & Desain UI</p>
                </div>
            </div>
        </div>

        <!-- Kotak Kanan (Formulir) -->
        <div class="col-md-8">
            <div class="card border-primary rounded shadow-sm">
                <div class="card-body">
                    <h4 class="card-title text-primary mb-4">Edit Profile</h4>
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label text-primary">Nama</label>
                            <input type="text" class="form-control" id="name" placeholder="Masukkan nama">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label text-primary">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Masukkan email">
                        </div>
                        <div class="mb-3">
                            <label for="talent" class="form-label text-primary">Begabung Pada</label>
                            <input type="text" class="form-control" id="talent" placeholder="Masukkan bidang bakat">
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="form-label text-primary">Foto Profil</label>
                            <input class="form-control" type="file" id="photo" accept="image/*">
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
