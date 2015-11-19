<!-- Upload to server link. Class "dropdown-big" creates big dropdown -->
<li class="dropdown dropdown-big">
<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-danger"><i class="fa fa-{{{ $progress['icon'] }}}"></i></span> {{{ $progress['title'] }}}</a>
  <!-- Dropdown -->
  <ul class="dropdown-menu">
    <li>
      <!-- Progress bar -->
      <p>{Progreso 1}</p>
      <!-- Bootstrap progress bar -->
      <div class="progress progress-striped active">
       <div class="progress-bar progress-bar-info"  role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
        <span class="sr-only">40% Complete</span>
      </div>
    </div>

    <hr />

    <!-- Progress bar -->
    <p>{Progreso N}</p>
    <!-- Bootstrap progress bar -->
    <div class="progress progress-striped active">
     <div class="progress-bar progress-bar-success"  role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
      <span class="sr-only">80% Complete</span>
    </div>
  </div> 

  <hr />             

  <!-- Dropdown menu footer -->
  <div class="drop-foot">
    <a href="#">Ver todos</a>
  </div>

</li>
</ul>
</li>