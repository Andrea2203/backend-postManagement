@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="container mx-auto flex flex-col items-center justify-center gap-6 px-4 md:px-6">
                        <div class="space-y-4 text-center">
                            <h2 class="text-2xl font-bold tracking-tighter sm:text-2xl md:text-2xl">Bienvenido  <br>Por favor ingresar los datos para su registro</h2>
                        </div>
                    </div>
                    <form id="loginForm">
                    @csrf
                        <div class="row mb-1">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Correo Electrónico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" required>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" minlength="8" required >
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit"  id="btn-registro" class="btn btn-primary ">
                                    Ingresar
                                </button>


                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
        function confirmValues(val1, val2, txt, boton) {
            
            var val1 = document.getElementById(val1).value;
            var val2 = document.getElementById(val2).value;
            var txt = document.getElementById(txt);
            var boton = document.getElementById(boton);
            console.log(val1,val2)
            if (val1 == val2) {
                txt.setAttribute("hidden", true);
                boton.removeAttribute("disabled");
            } else {
                txt.removeAttribute("hidden");
                boton.setAttribute("disabled", true);
            }
        }

        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this); 
            debugger
            axios.post('/api/login', formData)
            .then(response => {
                console.log(':', response.data);
                document.getElementById('loginForm').reset();
                debugger
                localStorage.setItem('auth_token', response.data.data.token);

                window.location.href = '/posts'; 
            })
            .catch(error => {
                console.error('Hubo un error al autenticar el usuario:', error);
                alert('Error al autenticar al usuario. Por favor, intenta de nuevo.');
            });
        });

    </script>
@endsection