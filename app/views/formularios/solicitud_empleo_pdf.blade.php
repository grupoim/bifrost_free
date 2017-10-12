<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Solicitud de empleo</title>
<style>
* { 
  margin: 0; 
  padding: 0; 
}
body { 
  font: 13px/1.4 Georgia, Serif;  

}
#page-wrap {
  margin: 25px;
}
#page2{
  margin: 25px;
  padding:0.5%;
}
p {
  margin: 20px 0; 
}

  /* 
  Generic Styling, for Desktops/Laptops 
  */
  .title{

  background: #BCC099;
  }
 .title1{

  background: #BCC099;
  width: 50%;
  height: 4%;
  margin-left: 27.5%;
  margin-top: -5%;
  text-align: center;

 }
  .total{
    color: #610f22;
  }


  .promotoria{
    text-align: right;
  }


  hr {
  background-color: black;
} 

/* Curso CSS estilos aprenderaprogramar.com*/
body {font-family: Arial, Helvetica, sans-serif;}

table {     font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
    font-size: 13px;    margin: 45px;     width: 100%; text-align: left;    border-collapse: collapse; }

th {     font-size: 12px;     font-weight: normal;     padding: 8px;     background: #fff;
    border-top: 1px solid #fff;    border-bottom: 1px solid #fff; color: #111; }

td {    padding: 30px;     background: #fff;     border-bottom: 1px solid #fff;
    color: #222;    border-top: 1px solid transparent; }


</style>
    

</head>
<body>

<div class="col-md-12" id="page-wrap">
       
               <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/todofacil.jpg'))) }}" width="210" class="img-responsive" alt="Image"><h2 class="title1">Solicitud de empleo </h2>

<br><br>       
                <h4>Fecha de la solicitud:<u class="total"><strong> {{date('d-m-Y h:i:s a', strtotime($dato->fecha_solicitud))}}</strong></h4></u><br>
                <h4>Puesto que solicita: <u class="total">{{$dato->puesto}}</u></h4><br>
                <h4>Cordinador: <u class="total">{{$cordinador->cordinador}}</u></h4><br>
                <h4>Zona asignada: <u class="total">{{$dato->zona}}</u></h4>                 
                <br><!-- /.box-header -->
<div align="center" class="title" ><h3 >Datos del solicitante</h3></div>
  <br>

<table border="0px;" cellspacing="2" cellpadding="2"> <!-- Lo cambiaremos por CSS -->
            <tr>
                <td colspan="2" ><h3>Nombre completo:<u class="total"> {{$dato->empleado}}</u></h3></td>
                <td><h3>Edad:<u class="total"> {{$dato->edad}}</u></h3></td>

            </tr>
            <tr>
                <td colspan="3"><h3>Domicilio:<u class="total"> {{$dato->domicilio}}</u></h3></td>
                
            </tr>
            <tr>
                 <td><h3>Calle:<u class="total"> {{$dato->calle}}</u></h3></td>
                <td><h3>Numero interior:<u class="total"> {{$dato->numero_interior}}</u></h3></td>
                <td><h3>Numero exterior:<u class="total"> {{$dato->numero_exterior}}</u></h3></td>
                
            </tr>
            <tr>
                <td ><h3>Telefono:<u class="total"> {{$dato->telefono}} ({{$dato->tipo_telefono}})</u></h3></td>
                <td><h3>Lugar nacimiento:<u class="total"> {{$dato->lugar_nacimiento}}</u></h3></td>
                 @if($dato->sexo == 1)
                <td><h3>Sexo:<u class="total"> Masculino</u></h3></td>
                @else
                <td><h3>Sexo:<u class="total"> Femenino</u></h3></td>
                @endif
            </tr>
            <tr>
                 <td><h3>Estado civil:<u class="total"> {{$dato->estado_civil}}</u></h3></td>
                <td><h3>Vive con:<u class="total"> {{$dato->vive_con}}</u></h3></td>
                <td colspan="2"><h3>Dependientes:<u class="total"> {{$dato->dependientes}}</u></h3></td>

            </tr>
        </table>
        <br><br>
     <div align="center" class="title" ><h3 >Documentación</h3></div>
  <br>
            <table border="0px;" cellspacing="2" cellpadding="2"> <!-- Lo cambiaremos por CSS -->
            <tr>
                <td ><h3>CURP:<u class="total"> {{strtoupper($dato->curp)}}</u></h3></td>
                <td><h3>RFC:<u class="total"> {{strtoupper($dato->rfc)}}</u></h3></td>
                <td><h3>IMSS:<u class="total"> {{strtoupper($dato->imss)}}</u></h3></td>
            </tr>

        </table>
                  <br><br>
     <div align="center" class="title" ><h3 >Datos familiares</h3></div>
  <br>

<table border="0px;" cellspacing="2" cellpadding="2">
<thead>
  <tr>
  <th><h3>Parentesco</h3></th>
  <th><h3>Nombre</h3></th>
  <th><h3>Vive</h3></th>
  <th><h3>Domicilio</h3></th>
  <th><h3>Ocupación</h3></th>
</tr>
</thead>
<tbody>

@foreach($familiares as $familiar) 
<tr>
  <td align="center">{{{$familiar->familiar}}}</td>
   <td align="center">{{{$familiar->nombre}}}</td>
   @if($familiar->vive == 1)
  <td align="center"><strong>Si</strong></td>
   @else
   <td align="center"><strong>No</strong></td>
   @endif
  <td align="center">{{$familiar->colonia}}</td>
  <td align="center">{{$familiar->ocupacion}}</td>

   </tr> 
  @endforeach

</tbody>
</table>
           <br> 
                  <br><br>
     <div align="center" class="title" ><h3 >Referencias personales</h3></div>
  <br>

<table border="0px;" cellspacing="2" cellpadding="2">
<thead>
  <tr>
  <th><h3>Nombre</h3></th>
  <th><h3>Domicilio</h3></th>
  <th><h3>Telefono</h3></th>
  <th><h3>Ocupación</h3></th>
  <th><h3>Conocerlo</h3></th>
</tr>
</thead>
<tbody>


@foreach($referencias as $referencia) 
<tr>
    <td align="center">{{{$referencia->persona}}}</td>
    <td align="center">{{{$referencia->colonia}}}</td>
    <td align="center">{{$referencia->telefono}}</td>
    <td align="center">{{$referencia->ocupacion}}</td>
    <td align="center">{{$referencia->tiempo_conocerlo}}</td>

   </tr> 
  @endforeach

</tbody>
</table>
          <br>
          <br>
          <br>
          <br>  
          <br>

        </div>
        <br>

<div class="col-md-12" id="page2" >

                  
     <div align="center" class="title" ><h3 >Escolaridad</h3></div>
  <br>

<table border="0px;" cellspacing="2" cellpadding="2">
<thead>
  <tr>
  <th><h3>Nivel</h3></th>
  <th><h3>Nombre</h3></th>
  <th><h3>Domicilio</h3></th>
  <th><h3>Fechas <br> De-A</h3></th>
  <th><h3>Años</h3></th>
  <th><h3>Documento</h3></th>
</tr>
</thead>
<tbody>

@foreach($estudios as $estudio) 
<tr>
  <td align="center">{{{$estudio->nivel_estudio}}}</td>
   <td align="center">{{{$estudio->escuela}}}</td>
  <td align="center">{{$estudio->colonia}}</td>
  <td align="center"><strong>{{date('d-m-Y', strtotime($estudio->fecha_inicio))}}  <br>{{date('d-m-Y', strtotime($estudio->fecha_fin))}}</strong></td>
  <td align="center">{{$estudio->años}}</td>
  <td align="center">{{$estudio->titulo}}</td>

   </tr> 
  @endforeach

</tbody>
</table>
           <br> 
                  <br><br>
   
          <br>
          <br>
          <br>
          <br>
          <br>

        <div align="center">
        <hr  align="center" width="30%">
        <strong> Firma del solicitante </strong>
        </div>
        </div>
</body>
</html>

