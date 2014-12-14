<?php
// include html header and display php-login message/error
include('header.php');

?>
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Iks Numbers</a>
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->

                <li class="dropdown"> <!--<p><?php ///echo $_SESSION['user_name'] ;?></p>-->
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span><?php echo  ucfirst($_SESSION['user_name']); ?></span> &nbsp &nbsp<img src="_style/img/user.png">
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                      <!--  <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>-->
                        <li><a href="index.php?logout"><i class="fa fa-sign-out fa-fw"></i> <?php echo $phplogin_lang['Logout']; ?></a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
 <?php  include('side-menu.php'); ?>
     <div id="page-wrapper">
        <!-- <div class="row">
        <div class="col-lg-12">
                    <h1 class="page-header">Welcome to your panel</h1>
                </div>
    </div>
        <div class="row">
        <?php 
        // if you need users's information, just put them into the $_SESSION variable and output them here

//echo $phplogin_lang['You are logged in as'] . $_SESSION['user_name'] ."<br />\n";
//echo $login->user_gravatar_image_url;
//echo $phplogin_lang['Profile picture'] .'<br/>'. $login->user_gravatar_image_tag;
        ?>

       <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Content header</h3>
  </div>
  <div class="panel-body">
    Panel content
  </div>
</div>
   </div><!--End row-->
   <div class="row">
    <div class="col-lg-12">
                    <h4 class="page-header">Welcome!</h4>
                </div>
   </div>
   <div class="row">

        <div class="col-lg-12">
          <img src="_style/img/under_const.png" width="80%" />
         <!--content-->
    </div>
    </div><!--End row-->

	  <!-- <a href="edit.php"><?php// echo $phplogin_lang['Edit user data']; ?></a>-->
     </div>
<script  src="_style/js/jquery-1.10.2.js"></script>
    <script src="_style/js/bootstrap.min.js"></script>
    <script src="_style/js/plugins/metisMenu/jquery.metisMenu.js"></script>
 
    <!--SB Admin Scripts - Include with every page--> 
    <script src="_style/js/sb-admin.js"></script>
</div>

<?php
// include html footer
include('footer.php');
?>
