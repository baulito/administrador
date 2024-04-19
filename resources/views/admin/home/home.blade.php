@extends("theme.admin.admin")
@section('content')
   <h1>Bienvenido a tu administrador de contenidos</h1>
   <div>Acá podrás administrar los contenidos de tu sitio web y gestionar los usuarios que podrán realizar las mismas.</div>
   <div class="row">
      <div class="col-sm-4">

      </div>
      <div class="col-sm-4">

      </div>
      <div class="col-sm-4">
         <div class="box-mipaquete">
            <img src="{{ asset('assets/admin/images/mipaquete.jpg')}}" alt="">
            <div id="info-mipaquete">
               <h3>Cuenta de mi paquete Registrada</h3>
               <div>
                  <strong>Correo:</strong>
                  {{ $mipaquete->correo }}
               </div>
               <br>
               <div class="text-right"><button id="btn-cambiar-mipaquete" class="btn btn-info">Cambiar Cuenta</button></div>
               
            </div>
            <div id="login-mipaquete">
               <form action="/loginmipaquete" method="POST">
                  @csrf
                  <div class="form-group">
                     <label for="">Correo</label>
                     <input type="text" name="email" class="form-control" autocomplete="off" value="{{ $mipaquete->correo }}" required>
                  </div>
                  <div class="form-group">
                     <label for="">Contraseña</label>
                     <input type="password" name="password" class="form-control" autocomplete="off" value="" required>
                  </div>
                  <br>
                  <div  class="text-end">
    
                        <button type="button" id="btn-cancelar-mipaquete" class="btn btn-block btn-danger">Cancelar</button>
                  
                        <button type="submit" class="btn btn-block btn-success">Inicia sesión</button>
  
                     
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>

   @endsection