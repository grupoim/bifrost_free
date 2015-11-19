@section('module')
 <div class="row">
	<div class="col-md-12">
		<div class="btn-group pull-left">			
		<a href="#myModal" class="btn btn-info " data-toggle="modal"><i class="fa fa-cog "></i> Nuevo</a>
		
		</div>
		 <!-- Modal -->
                    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
					  <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Modal title</h4>
                      </div>
                      <div class="modal-body">
                        <p>One fine body…</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                      </div>
                    </div>
					</div>
					</div>
                    <hr />
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="widget">
			<div class="widget-head">
				<div class="pull-left">Cotizaciones activas</div>
				<div class="widget-icons pull-right">
				</div>  
				<div class="clearfix"></div>
			</div>
			<div class="widget-content">
				<div class="padd">

					<!-- Table Page -->
					<div class="page-tables">
						<!-- Table -->
						<div class="table-responsive">
							<table cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%">
								<thead>
									<tr>
										<th>Rendering engine</th>
										<th>Browser</th>
										<th>Platform(s)</th>
										<th>Engine version</th>
										<th>CSS grade</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Trident</td>
										<td>Internet Explorer 4.0</td>
										<td>Win 95+</td>
										<td> 4</td>
										<td>X</td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<th>Rendering engine</th>
										<th>Browser</th>
										<th>Platform(s)</th>
										<th>Engine version</th>
										<th>CSS grade</th>
									</tr>
								</tfoot>
							</table>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="widget-foot">
				<!-- Footer goes here -->
			</div>
		</div>
	</div>  
</div>
       
@stop