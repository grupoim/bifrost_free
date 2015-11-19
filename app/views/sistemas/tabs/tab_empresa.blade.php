 <!--pestaña empresa-->
                      <div @if ($tab=='tab1' or $tab == '') class="tab-pane fade in active"@else class="tab-pane fade" @endif id="empresa">
                        <p><!-- widget empresa -->
   <div class="col-md-5">  
 
    <div class="widget">
                <!-- Widget title -->
                <div class="widget-head">                 
                @if($status=='update')
      <div class="alert alert-info alert-dismissible" role="alert" align="center">
     
     <strong><h4> Registro actualizado!!</h4></strong>
    </div>  

      @endif
                <div align="center">Empresa Activa</div>
                  <div class="widget-icons pull-right">                    
                  </div>  
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                <div class="padd">
                {{ Form::open(array('action' => 'ConfiguracionControlador@postEditEmpresa', 'class' => 'form-horizontal', 'role' => 'form', 'id'=>'empresa','files' => true)) }}        
                @foreach($empresa as $empresa_activa)
                <div align="center"><img src="{{ URL::asset('img/upload/empresa/'.$empresa_activa->logo) }}" width="50%" height="50%" /></div>
                <br>
                         
                <div class="form-group">
                                  <label class="col-lg-3 control-label">Empresa</label>
                                  <div class="col-lg-9">
                                    <input type="text" class="form-control" placeholder="Empresa"  id="nombre" name="nombre" @if($registro <>'modificando')value="{{{$empresa_activa->nombre}}}" @else value="{{Input::old('nombre')}}" @endif required>
                                  @if($errors->has('nombre')) <div align="center" class="alert alert-danger">{{$errors->first('nombre')}}</div> @endif
                                  </div>
                                </div>
                <div class="form-group">
                
                                  <label class="col-lg-3 control-label">Razon Social</label>
                                  <div class="col-lg-9">
                                    <input type="text" class="form-control" placeholder="Razon Social" id="razon_social" name="razon_social" @if($registro <>'modificando')value="{{{$empresa_activa->razon_social}}}" @else value="{{Input::old('razon_social')}}" @endif required>
                                  	 @if($errors->has('razon_social')) <div align="center" class="alert alert-danger">{{$errors->first('razon_social')}}</div> @endif
                                  </div>
                                </div>                
        
           <div class="form-group">
                
                                  <label class="col-lg-3 control-label">RFC</label>
                                  <div class="col-lg-9">
                                    <input type="text" class="form-control" placeholder="RFC" id="rfc" name="rfc" @if($registro <>'modificando')value="{{{$empresa_activa->rfc}}}" @else value="{{Input::old('rfc')}}" @endif required>
                                  	 @if($errors->has('rfc')) <div align="center" class="alert alert-danger">{{$errors->first('rfc')}}</div> @endif
                                  </div>
                                </div>
                                
                       <div class="form-group">
                 
                                  <label class="col-lg-3 control-label">Domicilio</label>
                                  <div class="col-lg-9">
                                    <input type="text" class="form-control" placeholder="Domicilio Fiscal" id="domicilio" name="domicilio" @if($registro <>'modificando')value="{{{$empresa_activa->domicilio}}}" @else value="{{Input::old('domicilio')}}" @endif required>
                                  	 @if($errors->has('domicilio')) <div align="center" class="alert alert-danger">{{$errors->first('domicilio')}}</div> @endif
                                  </div>
                                </div> 
                      <div class="form-group">
                
                                  <label class="col-lg-3 control-label">C.P.</label>
                                  <div class="col-lg-9">
                                    <input type="text" class="form-control" placeholder="Codigo Postal" @if($registro <>'modificando') value="{{{$empresa_activa->cp}}}" @else value="{{Input::old('cp')}}" @endif id="cp" name="cp" required>
                                  	@if($errors->has('cp')) <div align="center" class="alert alert-danger">{{$errors->first('cp')}}</div> @endif
                                  </div>
                                </div>
                      <div class="form-group">
                
                                  <label class="col-lg-3 control-label">Telefono</label>
                                  <div class="col-lg-9">
                                    <input type="text" class="form-control" placeholder="telefono" @if($registro <>'modificando')value="{{{$empresa_activa->telefono}}}" @else value="{{Input::old('telefono')}}" @endif id="telefono" name="telefono" required>
                                 	@if($errors->has('telefono')) <div align="center" class="alert alert-danger">{{$errors->first('telefono')}}</div> @endif
                                  </div>
                                </div>
                                <div class="form-group">
                
                                  <label class="col-lg-3 control-label">Cambiar logo:</label>
                                  <div class="col-lg-9">
                                    {{ Form::file('logo') }}
                                    @if($errors->has('logo')) <div align="center" class="alert alert-danger">{{$errors->first('logo')}}</div> @endif
                                  </div>
                                </div>                               
              <div class="clearfix"></div>             
                @endforeach               
                </div>

      </div>
      <div class="widget-foot">
       
      <button type="submit" class="btn btn-m btn-default" id="btn_send" ><i class="fa fa-floppy-o"></i> Guardar</button>             
      </div>
      </div>   
    </div>
    <input type="hidden" name="id" id="id" value="{{$empresa_activa->id}}">    
    <input type="hidden" name="logo" id="logo" value="{{$empresa_activa->logo}}">
   {{ Form::close() }}
    <!-- fin empresa --></p>
                      </div> <!-- fin pestaña empresa-->
