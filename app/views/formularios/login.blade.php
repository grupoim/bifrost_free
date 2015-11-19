<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <!-- Title and other stuffs -->
  <title>Inicio de Sesión - BifrostPFG</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">

  <!-- Stylesheets -->
  <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
  
  <script src="{{ URL::asset('js/respond.min.js') }}"></script>
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <![endif]-->

  <!-- Favicon -->
  <link rel="shortcut icon" href="img/favicon/favicon.png">
</head>

<body>

<!-- Form area -->
<div class="admin-form">
  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <!-- Widget starts -->
            <div class="widget worange">
              <!-- Widget head -->
              <div class="widget-head">
                <i class="fa fa-lock"></i> Inicio de sesión 
              </div>

              <div class="widget-content">
                <div class="padd">
                
                  @if(Session::has('login_errors'))
                    <div class="alert alert-danger alert-dismissible" role="alert">

                   <script type="text/javascript">
                                window.setTimeout(function() {
                                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                                $(this).remove();
                                   });
                                      }, 4000);
                    </script>

                   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

  
                   <strong>¡Error!</strong>  Datos incorrectos, vuelve a intentar.
                   </div>
           
                @endif

                  <!-- Login form -->
                  {{ Form::open(array('action' => 'LoginControlador@postAutenticar', 'class' => 'form-horizontal')) }}
                    <!-- Email -->
                    <div class="form-group">
                      <label class="control-label col-lg-3" for="inputEmail">Usuario</label>
                      <div class="col-lg-9">
                        <input type="text" class="form-control" id="inputEmail" placeholder="Usuario" name="usuario">
                      </div>
                    </div>
                    <!-- Password -->
                    <div class="form-group">
                      <label class="control-label col-lg-3" for="inputPassword">Contraseña</label>
                      <div class="col-lg-9">
                        <input type="password" class="form-control" id="inputPassword" placeholder="Contraseña" name="contrasenia">
                      </div>
                    </div>
                    <!-- Remember me checkbox and sign in button -->
                    <div class="form-group">
					<div class="col-lg-9 col-lg-offset-3">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> Recordar mis datos de sesión
                        </label>
						</div>
					</div>
					</div>
                        <div class="col-lg-9 col-lg-offset-3">
							<button type="submit" class="btn btn-info btn-sm">Entrar</button>
							<button type="reset" class="btn btn-default btn-sm">Borrar</button>
						</div>
                    <br />
                  {{ Form::close() }}  
				</div>
                </div>
            </div>  
      </div>
    </div>
  </div> 
</div>
<!-- JS -->
<script src="{{ URL::asset('js/jquery.js') }}"></script> <!-- jQuery -->
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script> <!-- Bootstrap -->
</body>
</html>