 <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="home" style="font-family: 'Dancing Script', sans-serif; font-size:30px; color:white;" class=" navbar-brand" ><b>Cam</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="home#">
                            <i class="fa fa-tasks" title="Tasks"></i>
                            <span class="badge bg-theme"><?=count($assesments)?></span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">There are <?=count($assesments)?> marking task pending</p>
                            </li>
							<?php if(count($assesments)>0):?>
							<?php foreach($assesments as $value):?>
                            <li>

                            	<?php if($value['no_papers_uploaded']!=0):
									$status=(($value['no_papers_marked']/$value['no_papers_uploaded'])*100);
									$status = ($status>100) ? 100 : ceil($status);
								 else:
									$status=0;
								 endif;?> 

								Complete (success)</span>
                                <a href="#">
                                    <div class="task-info">
                                        <div class="desc"><?=$value['name']?></div>
                                        <div class="percent">
										<?=$status?>%
										</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?=$status?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$status?>%">
										
                                            <span class="sr-only">
										<?=$status?>% Complete (success)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
							<?php endforeach;?>
							<?php endif;?>
                        </ul>
                    </li>
                    <!-- settings end -->
                    <!-- inbox dropdown start-->
                    <li id="header_inbox_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="home#">
                            <i class="fa fa-envelope-o"></i>
                            <span class="badge bg-theme"><?=count($notificationT->select_where(array("read_"=>"0")))?> </span>
                        </a>
                        <ul class="dropdown-menu extended inbox">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">You have <?=count($notificationT->select_where(array("read_"=>"0")))?> new notification</p>
                            </li>
							<?php if(count($notifications)>0):?>
							<?php foreach($notifications as $value):?>
                            <li>
                                <a href="home#">
                                    <span class="photo"><img alt="avatar" src="assets/img/ui-danro.jpg"></span>
                                    <span class="subject">
                                    <span class="from"><?=$userT->select_where(array("user_id"=>$value['from_']))[0]['firstname']?></span>
                                    <span class="time"><?=$value['date']?> <?=$value['time']?></span>
                                    </span>
                                    <span class="message">
                                        <?=$value['message']?>
                                    </span>
                                </a>
                            </li>
							<li>
                                <a href="home#">See all notification</a>
                            </li>
							<?php endforeach;?>
							<?php endif;?>
                              
                            
                        </ul>
                    </li>
                    <!-- inbox dropdown end -->
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-menu">
            	<ul class="nav pull-right top-menu" style="border:none">
                    <li style="border:none"><a  style="background-color: transparent; border-top:none ;margin:10px;font-size:20px; border: none;font-family: 'Cuprum', sans-serif;"  href="assets/php/shared/logout" ><span class=" glyphicon glyphicon-lock"></span> LOGOUT</a></li>
                    <!-- <li><a  href="lock" style="font-size:20px"><span class=" logout glyphicon glyphicon-lock"></span> Lock</a></li> -->
            	</ul>
            </div>
        </header>
      <!--header end-->
      