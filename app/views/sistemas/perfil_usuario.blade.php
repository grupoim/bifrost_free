@section('scripts')
<script type="text/javascript">	
      
$(document).on('ready', function(){

      window.setTimeout(function() {
  $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove();
  });
}, 4000);

    });

</script>
@stop
@section('module')
 <!-- Matter -->

	              <div class="row">

            <div class="col-md-6">


              <div class="widget wgreen">
                
                <div class="widget-head">
                  <div class="pull-left">Perfiles de Usuario</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>
                  <div class="clearfix"></div>
                </div>

                <div class="widget-content">
                  <div class="padd">

                    <br/>
                   <div class="user">
                      <div class="user-pic">
                        <!-- User pic -->
                        <a href="#"><img src="img/user-big.jpg" alt="" /></a>
                      </div>

                      <div class="user-details">
                        <h5>Ashok, B.Tech, MBA</h5>
                        <p> Maecenas quis tristique turpis. Nulla facilisi. Duis sed velit at ac ultrices magna. Aliquam consequat, purus vitae auctor ullamcorper.</p>
                        <a href="#" class="btn btn-info btn-xs"><i class="fa fa-user"></i> View Profile</a> 
                        <a href="#" class="btn btn-xs btn-default"><i class="fa fa-envelope"></i> Send Message</a>
                      </div>
                      <div class="clearfix"></div>
                    </div>

                    <hr />

                    <div class="user">
                      <div class="user-pic">
                        <!-- User pic -->
                        <a href="#"><img src="img/user-big.jpg" alt="" /></a>
                      </div>

                      <div class="user-details">
                        <h5>Ravi Kumar, B.Tech, MBA</h5>
                        <p> Maecenas quis tristique turpis. Nulla facilisi. Duis sed velit at ac ultrices magna. Aliquam consequat, purus vitae auctor ullamcorper.</p>
                        <a href="#" class="btn btn-info btn-xs"><i class="fa fa-user"></i> View Profile</a> 
                        <a href="#" class="btn btn-xs btn-default"><i class="fa fa-envelope"></i> Send Message</a>
                      </div>
                      <div class="clearfix"></div>
                    </div>

                    <hr />

                    <div class="user">
                      <div class="user-pic">
                        <!-- User pic -->
                        <a href="#"><img src="img/user-big.jpg" alt="" /></a>
                      </div>

                      <div class="user-details">
                        <h5>Bala Rajan, B.Tech, MBA</h5>
                        <p> Maecenas quis tristique turpis. Nulla facilisi. Duis sed velit at ac ultrices magna. Aliquam consequat, purus vitae auctor ullamcorper.</p>
                        <a href="#" class="btn btn-info btn-xs"><i class="fa fa-user"></i> View Profile</a> 
                        <a href="#" class="btn btn-xs btn-default"><i class="fa fa-envelope"></i> Send Message</a>
                      </div>
                      <div class="clearfix"></div>
                    </div>                                        
   
                              
                  </div>
                </div>
                  <div class="widget-foot">
                 
                    <!-- Footer goes here -->
                  </div>
              </div> 



            </div>
              <!-- widget nicho-->
               <div class="col-md-5">


              <div class="widget wgreen">
                
                <div class="widget-head">
                  <div class="pull-left">Nuevo/Editar</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div>
                  <div class="clearfix"></div>
                </div>

                <div class="widget-content">
                  <div class="padd">

                    <br/>
                   <div class="form quick-post">
                                      <!-- Quick setting form (not working)-->
                                      <form class="form-horizontal" role="form">
                          <!-- Name -->
                          <div class="form-group">
                          <label class="control-label col-md-2" for="sitename"> Name</label>
                          <div class="col-md-7">
                            <input type="text" class="form-control" id="sitename" placeholder="Metro King">
                          </div>
                          </div>   
                          <!-- description -->
                          <div class="form-group">
                          <label class="control-label col-lg-2" for="sitedescription"> Description</label>
                          <div class="col-lg-7">
                            <textarea class="form-control" rows="5" id="sitedescription"></textarea>
                          </div>
                          </div>                           
                          <!-- Comments -->
                          <div class="form-group">
                          <label class="control-label col-lg-2">Comments</label>
                          <div class="col-lg-7"> 
                            <div class="checkbox">                              
                              <label>
                                <input type="checkbox" value="value1" checked="checked"> Something
                              </label> 
                            </div>
                          </div>
                          </div>   
                          <!-- Registraion -->
                          <div class="form-group">
                          <label class="control-label col-lg-2">Registration</label>
                          <div class="col-lg-7">  
                            <div class="checkbox">
                             <label>
                              <input type="checkbox"> Any One Can Register
                              </label>
                            </div>
                          </div>
                          </div>  

                          <!-- Date Format -->
                          <div class="form-group">
                          <label class="control-label col-lg-2">Date </label>
                          <div class="col-lg-7">  
                            <div class="radio">
                              <label><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1"> Jan 18,2012</label>
                            </div>
                            <div class="radio">
                              <label><input type="radio" name="optionsRadios" id="optionsRadios2" value="option2"> Jan 18,2012</label>
                            </div>
                            <div class="radio">
                             <label><input type="radio" name="optionsRadios" id="optionsRadios3" value="option3"> Jan 18,2012</label>
                            </div>
                          </div>
                          </div>                                            
                          
                          <!-- User role Format -->
                          <div class="form-group">
                          <label class="control-label col-lg-2">New User </label>
                          <div class="col-lg-4">                               
                            <select class="form-control">
                            <option value='option1'>Author</option>
                            <option value='option2'>Moderator</option>
                            <option value='option3'>Editor</option>
                            </select>
                          </div>
                          </div>                                          

                          <!-- Buttons -->
                          <div class="form-group">
                           <!-- Buttons -->
                           <div class="col-lg-9 col-lg-offset-2">
                            <button type="submit" class="btn btn-info">Save Now</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                           </div>
                          </div>
                        </form>
                                    </div>                               
                             
                  </div>
                </div>
                  <div class="widget-foot">
              
                 
                    <!-- Footer goes here -->
                  </div>
              </div> 



            </div>
              <!-- widget nicho--> 
          </div>

        

		<!-- Matter ends -->

@stop