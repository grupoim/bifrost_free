<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <!-- Title and other stuffs -->
  <title>Quejas - BifrostPFG</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">

</head>

<body>

               <div >
                <p><h2>Seguimiento de queja en Sistema Bifrost PFG </h2></p>
             
                     <div>
                     <strong> <p><label>Departamento:</label></strong>
                     {{{$departamento}}} </p>
                  
                      <strong><p><label>Rubro:</label> </strong>
                     {{{$rubro}}}</p>
                      
                      <strong><p><label>Queja:</label> </strong>
                   {{{$queja}}}</p>
                   <strong><p><label>{{{$usuario }}} escribió:</label> </strong>
                   <i> "{{{$seguimiento}}}"</p></i>
                     </div>
          
         <p> <a style="background-color: #549DA3; font-family:Arial, sans-serif;border: medium none; border-radius: 6px;color: white;font-size: 14px;height: 15px; text-decoration:none;padding-top:7px; padding-bottom:7px; padding-left: 30px; padding-right:30px;" href="{{action('QuejaControlador@getRecupera', $queja_id)}}">
           Consulta detalles en Bifrost PFG</a> </p>
           
                      
          </div>
               
    

</body>
</html>