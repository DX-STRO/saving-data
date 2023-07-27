<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Saving Data App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <header>
        <nav class="navbar navbar-dark bg-primary px-5">
            <div class="container-fluid">
                <a class="navbar-brand">Saving Data App</a>
                <div>
                    <span class="mx-5 badge text-bg-light text-capitalize">Halo! {{ Auth::user()->name }} </span>
                    <a href="/logout" class="btn btn-danger btn-sm" style="text-decoration: none">Logout</a>
                </div>
            </div>
            </div>
        </nav>
    </header>

    <main class="mt-5">

        <div class="container">
            @if (Session::has('status'))
            <div class="alert alert-sm alert-success alert-dismissible fade show" role="alert"
                style="position: fixed; width: 30%; top: 0; right: 0; ">
                {{ Session::get('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-sm alert-dismissible fade show alert-danger"
                style="position: fixed; width: 30%; top: 0; right: 0; ">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif



            <div class="table-responsive">

                <form action="/search-profile" method="get">
                    <div class="top-content d-flex justify-content-between align-items-center">
                        <div class="input-group input-group-sm w-50">
                            <span style="margin-right: 15px;">Cari Data</span>
                            <input type="text" class="form-control" name="keyword" placeholder="Masukkan Nama"
                                value="{{ old('keyword') }}">
                            <button class="input-group-text btn btn-primary px-3 ">Cari</button>
                        </div>
                </form>

                <div class="bttn">
                    <!-- TRIGGER BUTTON EXPORT EXCEL -->
                    <button type="button" class="btn btn-success btn-sm mb-3 mx-5" data-bs-toggle="modal"
                        data-bs-target="#exportExcel">
                        Export
                    </button>

                    <!-- TRIGGER BUTTON ADD -->
                    <button type="button" class="btn btn-primary btn-sm mb-3 " data-bs-toggle="modal"
                        data-bs-target="#add">
                        Tambah +
                    </button>
                </div>

                <!-- MODAL BUTTON EXPORT EXCEL-->
                <div class="modal fade" id="exportExcel" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="/export-excel" method="GET">
                                <div class="modal-body">
                                    @csrf
                                    <h5>Export Data Ke File Excel?</h5>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success btn-sm">Export</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- MODAL BUTTON ADD -->
                <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="/add-profile" method="POST">
                                <div class="modal-body">
                                    @csrf
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="nik">Nik<span class="text-danger">*</span></label>
                                            <input type="number"
                                                class="form-control form-control-sm @error('nik') is-invalid @enderror"
                                                name="nik" id="nik" value="{{ old('nik') }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama">Nama<span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control form-control-sm @error('name') is-invalid @enderror"
                                                name="nama" id="nama" value="{{ old('nama') }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nohp">No. HP<span class="text-danger">*</span></label>
                                            <input type="number"
                                                class="form-control form-control-sm @error('nohp') is-invalid @enderror"
                                                name="nohp" id="nohp" value="{{ old('nohp') }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="rt">RT<span class="text-danger">*</span></label>
                                            <input type="number"
                                                class="form-control form-control-sm @error('rt') is-invalid @enderror"
                                                name="rt" id="rt" value="{{ old('rt') }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kelurahan">kelurahan<span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control form-control-sm @error('rt') is-invalid @enderror"
                                                name="kelurahan" id="kelurahan" value="{{ old('kelurahan') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th>NIK</th>
                        <th>NAMA</th>
                        <th>No. HP</th>
                        <th>RT</th>
                        <th>KELURAHAN</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($profiles as $profile)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $profile->nik }}</td>
                        <td>{{ $profile->nama }}</td>
                        <td>{{ $profile->nohp }}</td>
                        <td>{{ $profile->rt }}</td>
                        <td>{{ $profile->kelurahan }}</td>
                        <td class="d-flex">
                            <!-- TRIGGER BUTTON EDIT -->
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#edit{{ $profile->id }}">
                                Ubah
                            </button>

                            <!-- MODAL BUTTON EDIT -->
                            <div class="modal fade" id="edit{{ $profile->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="/edit-profile/{{ $profile->id }}" method="POST">
                                            <div class="modal-body">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <div class="mb-3">
                                                        <label for="nik">Nik<span class="text-danger">*</span></label>
                                                        <input type="number" class="form-control form-control-sm"
                                                            name="nik" id="nik" value="{{ old('nik') }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="nama">Nama<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="nama" id="nama" value="{{ old('nama') }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="nohp">No. HP<span
                                                                class="text-danger">*</span></label>
                                                        <input type="number" class="form-control form-control-sm"
                                                            name="nohp" id="nohp" value="{{ old('nohp') }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="rt">RT<span class="text-danger">*</span></label>
                                                        <input type="number" class="form-control form-control-sm"
                                                            name="rt" id="rt" value="{{ old('rt') }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="kelurahan">kelurahan<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="kelurahan" id="kelurahan"
                                                            value="{{ old('kelurahan') }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-1">|</div>
                            <!-- TRIGGER BUTTON DELETE -->
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#delete{{ $profile->id }}">
                                Hapus
                            </button>

                            <!-- MODAL BUTTON DELETE -->
                            <div class="modal fade" id="delete{{ $profile->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Anda Yakin Ingin
                                                Hapus
                                                Data Ini?</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table">
                                                <tr>
                                                    <td>NIK</td>
                                                    <td>:</td>
                                                    <td>{{ $profile->nik }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Nama</td>
                                                    <td>:</td>
                                                    <td>{{ $profile->nama }}</td>
                                                </tr>
                                                <tr>
                                                    <td>No. HP</td>
                                                    <td>:</td>
                                                    <td>{{ $profile->nohp }}</td>
                                                </tr>
                                                <tr>
                                                    <td>RT</td>
                                                    <td>:</td>
                                                    <td>{{ $profile->rt }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Kelurahan</td>
                                                    <td>:</td>
                                                    <td>{{ $profile->kelurahan }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm"
                                                data-bs-dismiss="modal">Batal</button>
                                            <form action="/delete-profile/{{ $profile->id }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="my-3 d-flex justify-content-between">
                {{-- {{ $profileList->appends(request()->except('page'))->withQueryString()->links() }} --}}
            </div>
        </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>