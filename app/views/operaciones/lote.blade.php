@section('module')
<div class="widget">
	<div class="widget-head">
	<div class="pull-left">Sectores y Recintos</div>
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
								<th>Sector</th>
							</tr>
						</thead>
						<tbody>
							@foreach($sectores as $sector)
							<tr>
								<td>{{{ $sector->nombre }}}</td>
							</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th>Sector</th>
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
@stop