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
<style type="text/css">
  table
table{
width:100%;
height:auto;
margin:10px 0 10px 0;
border-collapse:collapse;
text-align:center;
background-color:#365985;
color:#FFF;display: inline-block;
}

table td,th{
border:1px solid black;
}

table th{
color:#FC0; 
}

</style>
</head>

<body>
<table border="1"  WIDTH="100%">

    <caption>Titulo de la tabla</caption>

        <colgroup>
           <col />
           <col />
           <col />
        </colgroup>

        <thead>
           <tr>
                        
                  <th class="col-md-2"><strong>Nombre</strong></th>                 
                  <th>Salario Diario</th>
                  <th>Sueldo</th>                 
                  <th>D.T.</th>
                  <th>SS</th>
                  <th >Horas Extras</th>                  
                  <th class="col-md-1">Prima Dominical</th>
                  <th>Infonavit</th>
                  <th class="col-md-1">Prestamo</th>
                  <th class="col-md-1">Otras Percepciones</th>
                  <th class="col-md-1">Bono Mtto</th>                 
                  <th>Dias pagados</th>
                  <th class="col-md-3">Operaciones</th>
           </tr>
        </thead>

        <tfoot>
          
        </tfoot>

       <tbody> 
              @foreach($asistencias as $ctr => $empleado)
              {{ Form::open(array('action' => 'PersonalOperativoControlador@postNomina', 'class' => 'form-horizontal', 'role' => 'form', 'id'=>'historial','files' => true)) }}
                  <tr>
                                    
                    <td> {{{Str::title($empleado->empleado)}}}</td> 
                    <td>${{{number_format($empleado->salario_diario, 2, '.', ',')}}}</td>                 
                    <td>${{{number_format($empleado->salario_semanal, 0, '.', ',')}}}</td>                    
                    <td>{{{$empleado->dias_trabajados}}}</td>
                    <td>${{{number_format($empleado->ss, 0, '.', ',')}}}</td>        
                    <td> {{{$empleado->hora_extra}}} <br> ${{{number_format($empleado->h_extra, 0, '.', ',')}}} </td>
                    <td>${{{number_format($empleado->p_dominical, 0, '.', ',')}}}</td>
                    <td>${{{number_format($empleado->infonavit, 0, '.', ',')}}}</td>
                    <td><input type="text"class="form-control" placeholder="0" name="abono_prestamo" value="{{{$empleado->abono_prestamo}}}"></td>
                    <td><input type="text"class="form-control" placeholder="0" name="otras_percepciones" value="{{{$empleado->otras_percepciones}}}"></td>                    
                    <td>                  
                      @if($empleado->departamento_id == 2)
                        <input type="text"class="form-control" placeholder="0" name="bono_mtto" value="{{{$empleado->bono_mtto}}}">
                      @endif
                    </td>
                    <td><input type="number"class="form-control" placeholder="0" min="0" step="any" name="dias_pago" value="{{{$empleado->dias_pago}}}"></td>
                    
                    
                     <td>
                         <button type="submit" class="btn btn-m btn-default activa" id="btn_send" ><i class="fa fa-floppy-o"></i> </button>                         
                      
                      @if($empleado->revision_contabilidad == 1)
                      <span class="label label-info"><i class="fa fa-check"></i></span>
                      @else
                      <span class="label label-warning"><i class="fa fa-warning "></i></span>
                      @endif
                      <span class="badge">$ @if($empleado->revision_contabilidad == 1){{{number_format($empleado->nomina, 2, '.', ',')}}} @else {{{number_format($empleado->salario_total, 2, '.', ',')}}}@endif</span>
                    </td>

              <input type="hidden" name="asistencia_id" value="{{{$empleado->id}}}">
              <input type="hidden" name="empleado_id" value="{{{$empleado->empleado_id}}}">
              <input type="hidden" name= "lista_activa" value="{{{$lista->activa}}}">

              {{form::close()}}
              @endforeach

                              
              </tbody> 

 </table>
{{-- @foreach($asistencias as $ctr => $empleado)
              {{ Form::open(array('action' => 'PersonalOperativoControlador@postNomina', 'class' => 'form-horizontal', 'role' => 'form', 'id'=>'historial','files' => true)) }}
               
                                    
                  {{{Str::title($empleado->empleado)}}}
                  ${{{number_format($empleado->salario_diario, 2, '.', ',')}}}                 
                 ${{{number_format($empleado->salario_semanal, 0, '.', ',')}}}                    
                    {{{$empleado->dias_trabajados}}}
                    ${{{number_format($empleado->ss, 0, '.', ',')}}}        
                    {{{$empleado->hora_extra}}} <br> ${{{number_format($empleado->h_extra, 0, '.', ',')}}}
                   ${{{number_format($empleado->p_dominical, 0, '.', ',')}}}
                   ${{{number_format($empleado->infonavit, 0, '.', ',')}}}
                   <input type="text"class="form-control" placeholder="0" name="abono_prestamo" value="{{{$empleado->abono_prestamo}}}">
                   <input type="text"class="form-control" placeholder="0" name="otras_percepciones" value="{{{$empleado->otras_percepciones}}}">                    
                                    
                      @if($empleado->departamento_id == 2)
                        <input type="text"class="form-control" placeholder="0" name="bono_mtto" value="{{{$empleado->bono_mtto}}}">
                      @endif
                   
                    <input type="number"class="form-control" placeholder="0" min="0" step="any" name="dias_pago" value="{{{$empleado->dias_pago}}}">
                    
                    
                   
                         <button type="submit" class="btn btn-m btn-default activa" id="btn_send" ><i class="fa fa-floppy-o"></i> </button>                         
                      
                      @if($empleado->revision_contabilidad == 1)
                      <span class="label label-info"><i class="fa fa-check"></i></span>
                      @else
                      <span class="label label-warning"><i class="fa fa-warning "></i></span>
                      @endif
                      <span class="badge">$ @if($empleado->revision_contabilidad == 1){{{number_format($empleado->nomina, 2, '.', ',')}}} @else {{{number_format($empleado->salario_total, 2, '.', ',')}}}@endif</span>
                   

              <input type="hidden" name="asistencia_id" value="{{{$empleado->id}}}">
              <input type="hidden" name="empleado_id" value="{{{$empleado->empleado_id}}}">
              <input type="hidden" name= "lista_activa" value="{{{$lista->activa}}}">
<p>
              {{form::close()}}
              @endforeach
--}}
</body>
</html>