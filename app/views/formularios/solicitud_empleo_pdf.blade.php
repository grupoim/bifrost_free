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
p {
  font-size: 14px;
}
span {
  page-break-after: always;
  border: 0;
  margin: 0;
  padding: 0;
}

</style>
    

</head>
<body>

<div class="col-md-12" id="page-wrap"> 
               <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/todofacil.jpg'))) }}" width="210" class="img-responsive" alt="Image"><h2 class="title1">Solicitud de empleo </h2>
          <br>      

       <table border="0px;" cellspacing="2" cellpadding="2"> <!-- Lo cambiaremos por CSS -->
            <tr>
            <td><p>Fecha de solicitud:<u class="total"> {{date('d-m-Y', strtotime($dato->fecha_solicitud))}}</u></p><br>
                <p>Puesto que solicita:<u class="total"> {{$dato->puesto}}</u></p><br>
                <p>Coordinador:<u class="total"> {{$cordinador->cordinador}}</u></p><br>
                <p>Zona asignada:<u class="total"> {{$dato->zona}}</u></p>
            </td>
            <td></td>
            <td><img src="{{ public_path("img/upload/".$dato->foto) }}" width="120" class="img-responsive" alt="Image"></td>
            </tr>
        </table>

                <br><!-- /.box-header -->
<div align="center" class="title" ><h3 >Datos del solicitante</h3></div>
  <br>

<table border="0px;" cellspacing="2" cellpadding="2"> <!-- Lo cambiaremos por CSS -->
            <tr>
                <td colspan="2" ><p>Nombre completo:<u class="total"> {{$dato->empleado}}</u></p></td>
                <td><p>Edad:<u class="total"> {{$dato->edad}}</u></p></td>

            </tr>
            <tr>
                <td colspan="3"><p>Domicilio:<u class="total"> {{$dato->domicilio}}</u></p></td>
                
            </tr>
            <tr>
                 <td><p>Calle:<u class="total"> {{$dato->calle}}</u></p></td>
                <td><p>Numero interior:<u class="total"> {{$dato->numero_interior}}</u></p></td>
                <td><p>Numero exterior:<u class="total"> {{$dato->numero_exterior}}</u></p></td>
                
            </tr>
            <tr>
                <td ><p>Telefono:<u class="total"> {{$dato->telefono}} ({{$dato->tipo_telefono}})</u></p></td>
                <td><p>Lugar nacimiento:<u class="total"> {{$dato->lugar_nacimiento}}</u></p></td>
                 @if($dato->sexo == 1)
                <td><p>Sexo:<u class="total"> Masculino</u></p></td>
                @else
                <td><p>Sexo:<u class="total"> Femenino</u></p></td>
                @endif
            </tr>
            <tr>
                 <td><p>Estado civil:<u class="total"> {{$dato->estado_civil}}</u></p></td>
                <td><p>Vive con:<u class="total"> {{$dato->vive_con}}</u></p></td>
                <td colspan="2"><p>Dependientes:<u class="total"> {{$dato->dependientes}}</u></p></td>

            </tr>
        </table>
        <br><br>
     <div align="center" class="title" ><h3 >Documentación</h3></div>
  <br>
            <table border="0px;" cellspacing="2" cellpadding="2"> <!-- Lo cambiaremos por CSS -->
            <tr>
                <td ><p>CURP:<u class="total"> {{strtoupper($dato->curp)}}</u></p></td>
                <td><p>RFC:<u class="total"> {{strtoupper($dato->rfc)}}</u></p></td>
                <td><p>IMSS:<u class="total"> {{strtoupper($dato->imss)}}</u></p></td>
                <td><p>Clinica:<u class="total"> {{$dato->clinica}}</u></p></td>
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
        
        </div>

     <span></span>
<div class="col-md-12" id="page-wrap"> 
                  
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
  <td align="center"><strong>{{$estudio->fecha_inicio}}  <br>{{$estudio->fecha_fin}}</strong></td>
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
        <br>
       <div class="box-footer clearfix">

        </div>
        </div>
</body>
</html>

