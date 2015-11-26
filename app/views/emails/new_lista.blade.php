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
                <p><h2>Registro de asistencias vía Bifrost PFG </h2></p>
             
                     <div>
                     <strong> <p><label>Periodo:</label></strong>
                     Del {{{date("d/M/Y", strtotime($fecha_inicio))}}} al {{{date("d/M/Y", strtotime($fecha_fin))}}} </p>
                  
                      <strong><p><label>Faltas:</label> </strong>
                     {{{$faltas}}}</p>
                      
                      <strong><p><label>Primas dominicales reportadas:</label> </strong>
                   <i> <q>{{{$primas}}}</q></p></i>
                     </div>
          
         <p> <a style="background-color: #549DA3; font-family:Arial, sans-serif; border: medium none; border-radius: 6px;color: white;font-size: 14px;height: 15px; text-decoration:none;padding-top:7px; padding-bottom:7px; padding-left: 30px; padding-right:30px;" href="{{URL::to('personal-operativo/asistencia/'.$lista)}}">Consulta detalles en Bifrost PFG</a> </p>
                      
          </div>
               
    

</body>
</html>