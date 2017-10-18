
                  <div class="col-lg-3  ds">
                    <!--COMPLETED ACTIONS DONUTS CHART-->
						<h3>NOTIFICATIONS</h3>
                                        
                    
                      
                      <!-- Fourth Action -->
					  <?php if(count($notifications)>0):?>
					  <?php foreach($notifications as $value):?>
                      <div class="desc">
                      	<div class="thumb">
                      		<span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                      	</div>
                      	<div class="details">
                      		<p><muted><?=$value['date']?> <?=$value['time']?></muted><br/>
                      		  <?=$value['message']?><br/>
                      		</p>
                      	</div>
                      </div>
                      <?php endforeach;?>
					  <?php else:?>
					  <div class="desc">
                      	<div class="thumb">
                      		<span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                      	</div>
                      	<div class="details">
                      		<p>No notifications mate</p>
                      	</div>
                      </div>
					  <?php endif;?>

                       <!-- USERS ONLINE SECTION -->
						<h3>Calendar</h3>
                     
                      

                        <!-- CALENDAR-->
                        <div id="calendar" class="mb">
                            <div class="panel green-panel no-margin">
                                <div class="panel-body">
                                    <div id="date-popover" class="popover top" style="cursor: pointer; disadding: block; margin-left: 33%; margin-top: -50px; width: 175px;">
                                        <div class="arrow"></div>
                                        <h3 class="popover-title" style="disadding: none;"></h3>
                                        <div id="date-popover-content" class="popover-content"></div>
                                    </div>
                                    <div id="my-calendar"></div>
                                </div>
                            </div>
                        </div><!-- / calendar -->
                      
                  </div><!-- /col-lg-3 -->