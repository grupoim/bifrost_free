<div id="{{{ $modalId }}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title"><i class="fa fa-{{{ $modalIcon or 'plus'}}}"></i> {{{ $modalTitle }}}</h4>
      </div>
      <div class="modal-body">
        @yield('modal-content')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">{{{ $modalCancel }}}</button>
        <button type="button" class="btn btn-primary modalSubmit">{{{ $modalOk }}}</button>
      </div>
    </div>
  </div>
</div>

