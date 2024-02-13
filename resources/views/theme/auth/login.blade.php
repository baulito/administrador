<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Autenticación de usuario</title>
    <link rel="stylesheet" href="{{ asset('components/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('components/Font-Awesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/auth/css/auth.css')}}">
</head>
<body>
    <div class="main-body">
        <div class="row h-100 align-items-center">
            <div class="col-sm-6  h-100 ">
                <div class="bg-login">
                    <div>
                        <img src="{{ asset('assets/auth/images/users.png')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 text-center">
                <div class="box-login">
                    <div class="header">
                        <h2>¡Bienvenido!</h2>
                    </div>
                    <div class="body">
                        <div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <div>{{ $error }}</div>
                                    @endforeach
                                </div>
                            @endif    
                            @if (session("mensaje"))
                            <div class="alert alert-danger " >
                                <div>{{ session("mensaje") }}</div>
                            </div>
                        @endif
                        </div>
                        
                        <form action="/login" method="POST"  class=" g-3 needs-validation" novalidate>
                            @csrf
                            <div class="mb-3 ">
                                <label class="form-label" for="username">Usuario</label>
                                <input type="text" id="username" name="username" class="form-control" required>
                                <div class="invalid-feedback">
                                    Usuario Requerido
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="password">Contraseña</label>
                                <div class="input-group" id="show_hide_password">
                                    <input class="form-control" name="password"  id="password" type="password" required>
                                    <button class="btn btn-outline-secondary" type="button" ><i class="fa fa-eye-slash" aria-hidden="true"></i></button>
                                </div>
                                <div class="invalid-feedback">
                                    Contraseña Requerida
                                </div>
                            </div>
                            <div class="form-group " style="text-align: right;">
                                <button type="submit" class="btn btn-success">Inicia sesión</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('components/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{ asset('components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/auth/js/auth.js')}}"></script>
</body>
</html>