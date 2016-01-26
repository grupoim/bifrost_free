@extends('modal')
@section('modal-content')
{{ Form::open(array('action' => 'MantenimientoControlador@postRenovar', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'producto')) }}
 
 
 <div class="form-group">
                                  <label class="col-lg-2 control-label">Periodo</label>
                                  <div class="col-lg-8">
                                    <label class="radio-inline">
                                            <input type="radio" name="periodo" id="inlineRadio1" value="Sencilla" checked="true" title="Sencilla">Trimestre
                                          </label>
                                          <label class="radio-inline">
                                            <input type="radio" name="periodo" id="inlineRadio2" value="Doble" title="Doble">Semestral
                                          </label>
                                          <label class="radio-inline">
                                            <input type="radio" name="periodo" id="inlineRadio3" value="Triple" title="Triple">Anual
                                          </label>
                                          

                                    </div>
                                </div> {{{$status}}}
                                
{{ Form::close() }}
@overwrite