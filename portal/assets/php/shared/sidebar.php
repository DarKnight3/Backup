<!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a data-toggle="modal" href="#edit_profile"><img  src="<?=$_SESSION['caracal_user']['picture']?>" class="img-circle user-image-i" width="100" height="100"></a></p>
              	  <h5 class="centered"><?=$_SESSION['caracal_user']['firstname']?> <?=$_SESSION['caracal_user']['lastname']?></h5>
					
				  <li class="mt">
				  <?php
					if(!isset($dashboard_a)){ $dashboard_a="";}
					if(!isset($marking_a)){ $marking_a="";}
					if(!isset($user_a)){ $user_a="";}
				  ?>
                      <a class="<?=$dashboard_a?>" href="dashboard">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>
                  <?php if($user['access_level']>=200):?>
                  <li class="sub-menu">
                      <a class="<?=$marking_a?>" href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>Marking</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="assesments">Assesments</a></li>
                          
                            <li><a  href="manage-memos">Manage memo</a></li>
							
                         
                      </ul>
                  </li>
                  <?php endif;?>
                  <?php if($user['access_level']==100):?>
                    <li>
                    <a  data-toggle="modal" data-target="#marks-modal" class="<?=$marking_a?>">
                          <i class="fa fa-desktop"></i>
                          <span>Grades</span>
                      </a>
                      </li>
                      <li>
                    <a  data-toggle="modal" data-target="#upload-modal" class="<?=$marking_a?>">
                          <i class="fa fa-upload"></i>
                          <span>Upload</span>
                      </a>
                      </li>
                  <?php endif;?>
                  <?php if($user['access_level']>=200):?>
                   <li>
                    <a  href="reports.php">
                          <i class="fa fa-bar-chart-o"></i>
                          <span>Reports</span>
                      </a>
                      </li>
                    <?php endif;?>
                  <?php if($user['access_level']>=500):?>
                  <li class="sub-menu">
                      <a class="<?=$user_a?>" href="javascript:;" >
                          <i class="fa fa-cogs"></i>
                          <span>Users</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="manage-users">Manage users</a></li>

                      </ul>
                  </li>
                 <?php endif;?>
                 
           

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
	  

	  
	  

      