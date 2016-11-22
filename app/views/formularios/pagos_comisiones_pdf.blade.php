<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Pagos de comisiones</title>
<style>
 
 .col-md-12 {
    width: 100%;
} 

.box {
    position: relative;
    border-radius: 3px;
    background: #ffffff;
    border-top: 3px solid #d2d6de;
    margin-bottom: 20px;
    width: 100%;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    background-color: #ECF0F5;
}

.box-header {
    color: #444;
    display: block;
    padding: 10px;
    position: relative;
}

.box-header.with-border {
    border-bottom: 1px solid #f4f4f4;
}


.box-header .box-title {
    display: inline-block;
    font-size: 18px;
    margin: 0;
    line-height: 1;
}

.box-body {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    padding: 10px;

}


.box-footer {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    border-top: 1px solid #f4f4f4;
    padding: 10px;
    background-color: #fff;
}


.table-bordered {
    border: 1px solid #f4f4f4;
}


.table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 20px;
}

table {
    background-color: transparent;
}

 .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
    border: 1px solid #f4f4f4;
}


.badge {
    display: inline-block;
    min-width: 10px;
    padding: 3px 7px;
    font-size: 12px;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    background-color: #777;
    border-radius: 10px;
}

.bg-red {
    background-color: #dd4b39 !important;
}


</style>
	  
</head>
<body>

<div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Pagos de de la semana </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="table" class="table table-striped table-bordered display" cellpadding="0" cellspacing="0" border="0">
            <thead>
              <tr>
                <th class="text-center">ID</th>             
                <th class="text-center col-md-1">Folio</th>
                <th class="text-center col-md-3"> Cliente</th>
                <th class="text-center col-md-3"> Vendedor</th>
                <th class="text-center col-md-2">Monto</th>
                <th class="text-center col-md-3">estatus</th>

                <th>Operaciones</th>

              </tr>
            </thead>
            <tbody>
              @foreach($abonos as $abono)
              
              <tr>
                <td class="text-center">{{{$abono->id}}}</td>
                <td><strong>{{{ $abono->folio }}}</strong></td>
                <td> {{{$abono->cliente}}}</td><td>{{{$abono->abono_asesor}}} @if($abono->vendedor <> $abono->abono_asesor) <span class="label label-warning" ><i  class="fa fa-exclamation-triangle" aria-hidden="true"></i> No pertenece al vendedor</span> @endif </td>
                <td class="text-right"><input type="number" step="any"class="form-control" placeholder="0" name="abono_comision" value="{{{$abono->monto_abono}}}">$ {{{number_format($abono->monto_abono, 0, ".", ",")}}}</td>                
                <td>
                  
                {{{round(($abono->pagado * $abono->numero_pagos)/$abono->total_comisionable)}}} de {{{$abono->numero_pagos}}}
                </td>              
              </tr>       

              @endforeach
                
            </tbody>
          </table>

          <table id="table" class="table table-striped table-bordered display" cellpadding="0" cellspacing="0" border="0">
            <thead>
              <tr>
                <th class="text-center">ID</th>             
                <th class="text-center col-md-1">Folio</th>
                <th class="text-center col-md-3"> Cliente</th>
                <th class="text-center col-md-3"> Vendedor</th>
                <th class="text-center col-md-2">Monto</th>
                <th class="text-center col-md-3">estatus</th>

                <th>Operaciones</th>

              </tr>
            </thead>
            <tbody>
              @foreach($abonos as $abono)
              
              <tr>
                <td class="text-center">{{{$abono->id}}}</td>
                <td><strong>{{{ $abono->folio }}}</strong></td>
                <td> {{{$abono->cliente}}}</td><td>{{{$abono->abono_asesor}}} @if($abono->vendedor <> $abono->abono_asesor) <span class="label label-warning" ><i  class="fa fa-exclamation-triangle" aria-hidden="true"></i> No pertenece al vendedor</span> @endif </td>
                <td class="text-right"><input type="number" step="any"class="form-control" placeholder="0" name="abono_comision" value="{{{$abono->monto_abono}}}">$ {{{number_format($abono->monto_abono, 0, ".", ",")}}}</td>                 
                <td>
                  
                {{{round(($abono->pagado * $abono->numero_pagos)/$abono->total_comisionable)}}} de {{{$abono->numero_pagos}}}
                </td>              
              </tr>       

              @endforeach
                
            </tbody>
          </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  
                </div>
              </div><!-- /.box -->

              
            </div>


	
</body>
</html>


