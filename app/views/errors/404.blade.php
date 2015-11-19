<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <!-- Title and other stuffs -->
  <title>Error</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">

  <!-- Stylesheets -->
  <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
  
 <script src="{{ URL::asset('js/respond.min.js') }}"></script>
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <![endif]-->

  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ URL::asset('img/favicon/favicon.png') }}">
</head>

<body>

<!-- Form area -->
<div class="error-page">
  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <!-- Widget starts -->
            <div class="widget">
              <!-- Widget head -->
              <div class="widget-head">
                <i class="fa fa-question-circle"></i> Error 
              </div>

              <div class="widget-content">
                <div class="padd error">
                  
                  <h1>¡¡Upppsss!!</h1>
                  <p>Parece que has llegado a un lugar que no existe o también es posible que los programadores le estén moviendo al Sistema.</p>
                  <br />

                  <div class="input-group input-group-width">
					  <input type="text" class="form-control busca-personas"  placeholder="Buscar personas">
					  <span class="input-group-btn">
						<button class="btn btn-default" type="button">Buscar</button>
					  </span>
					</div>
                                 
                 <br />
                 <div class="horizontal-links">
                  <a href="/">Panel de Control</a> | <a href="manual-usuario">Manual de usuario</a>
                 </div>

                </div>
                <div class="widget-foot">
                  <!-- Footer goes here -->
                </div>
              </div>
            </div>  
      </div>
    </div>
  </div> 
</div>
	
		

<!-- JS -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>