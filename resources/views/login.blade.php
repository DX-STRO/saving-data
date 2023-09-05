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
    <div class="container-fluid d-flex justify-content-center align-items-center flex-column vh-100">
        @if (Session::has('status'))
        <div class="alert alert-sm alert-success alert-dismissible fade show" role="alert"
            style="position: fixed; width: 30%; top: 0; right: 0; ">
            {{ Session::get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if (Session::has('statusFail'))
        <div class="alert alert-sm alert-danger alert-dismissible fade show" role="alert"
            style="position: fixed; width: 30%; top: 0; right: 0; ">
            {{ Session::get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-sm alert-dismissible fade show alert-danger"
            style="position: fixed; width: 30%; top: 0; right: 0;">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="card" style="width: 25rem;">
            <div class="card-body">
                <h5 class="card-title text-center mb-4">LOGIN</h5>
                <div class="card-content">
                    <form action="" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email"
                                class="form-control @error('email') is-invalid @enderror" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" required>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary form-control" type="submit">Login</button>
                        </div>
                    </form>
                    <!-- TRIGGER BUTTON REGISTER-->
                    <div class="d-flex justify-content-center">
                        <a href="#add" class="text-center" data-bs-toggle="modal">Belum Mempunyai Akun? Silahkan Register</a>
                    </div>

                    <!-- MODAL BUTTON REGISTER-->
                    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Register</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="/register" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <div class="mb-3">
                                                <label for="name">Nama<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name"
                                                    id="name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email">Email<span class="text-danger">*</span></label>
                                                <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email"
                                                    id="email" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="password">Password<span class="text-danger">*</span></label>
                                                <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror"
                                                    name="password" id="password" required>
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
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>