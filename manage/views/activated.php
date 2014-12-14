<?php
 // include html header and display php-login message/error
    include('header.php'); 
    include_once('classes/manage_DB.php');
     // calling the Database object---
    $bd = new manageBD(); 

  //if(isset($_POST["activar_codigo"]) && ($_POST["codeDelete"] != '')){
    // $bd->InactiveCode($_POST["codeDelete"], $_POST["oldCode"], $_POST["codigo"], $_POST["inactivated"]);

   // }
    if(isset($_POST['modifyCode']) && (!empty($_POST['newCodigo'])) ){
          $bd->modifyCode($_POST['newCodigo'], $_POST['oldCode'], $_POST['interCode'] );
    }
       if(isset($_POST['activateCode'])){
         // $bd->modifyCode($_POST['newCodigo'], $_POST['oldCode'], $_POST['interCode'] );
       $bd->ActiveCode($_POST["interCode1"]);
    }
      if(isset($_POST['InactivateCode'])){
         // $bd->modifyCode($_POST['newCodigo'], $_POST['oldCode'], $_POST['interCode'] );
       $bd->InactiveCode($_POST["interCode2"]);
    }
?> 
<style type="text/css">
#Modify .modal-content {
    max-width: 450px;
    overflow: visible;
}
</style>
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
        <h4 class="page-header">Your codes</h4>
       </div>
   </div>
   <div class="row">
        <div class="col-lg-12">
            <table class="table">
                <tr>
                    <th>Code</th>
                    <th>Order ID</th>
                    <th>Server info</th>
                    <th>Expire On</th>
                    <th>Status</th>
                    <th>Expiration Date</th>
                    <th>Accion</th>
                </tr>
            <?php  
                //--- Show the codes of the table
          $bd->showCodesTableActivated();
              ?>
            </table>
    </div>
    </div><!--End row-->
  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <!-- <script  src="_style/js/jquery-1.10.2.js"></script>-->
    <script src="_style/js/bootstrap.min.js"></script>
    <script src="_style/js/plugins/metisMenu/jquery.metisMenu.js"></script>
 
    <!--SB Admin Scripts - Include with every page--> 
    <script src="_style/js/sb-admin.js"></script>
    <script type="text/javascript">

      $(".modificar").click(function(){ 
      //alert($(this).attr("name"));
      $("#oldCode").val( $(this).closest('tr').children("td:first").text() );
     // $("#oldCode").val( $(this).closest('tr').children("td:first").text() );
      $("#interCode").val($(this).attr("name"));
      $("#Modify").modal('show');
    });

    $(".activar").click(function(){ 
      
  $("#actualCode").html( $(this).closest('tr').children("td:first").text() );
      $("#interCode1").val($(this).attr("name"));
     $("#Active").modal('show');
    });

    $(".desactiva").click(function(){ 
      $("#interCode2").val($(this).attr("name"));
       $("#actualCode1").html( $(this).closest('tr').children("td:first").text() );
     $("#Inactive").modal('show');
    });

    </script>
	  <!-- <a href="edit.php"><?php// echo $phplogin_lang['Edit user data']; ?></a>-->
     </div>
     <div class="modal fade" id="Modify" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
       <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" METHOD="POST" name="pregunta_modificacion">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><span style="color:green;">Edit your Code</span></h4>
      </div>
      <div class="modal-body">
        <p>You can Change your code here.&nbsp;</p>
		<label for="codigo">Current code: </label>	
			<input type="text" class="form-control" id="oldCode" value="codigo" name="oldCode" size='08' readonly> </br>
      <label for="newCodigo">New code: </label> 
      <input type="text" class="form-control" id="newCodigo" name="newCodigo" size='08' > </br>
      </div>
      <div class="modal-footer">
          <input type="hidden" name="interCode" value="0" id="interCode">
        <input  name="modifyCode" type="submit" class="btn btn-success"  value="Editar" >
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
      </form>
    </div>
  </div>
</div> <!--end modificar-->
    <div class="modal fade" id="Active" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
       <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" METHOD="POST" name="pregunta_modificacion">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><span style="color:#3399FF;">Activate your code.</span></h4>
      </div>
      <div class="modal-body">
        <form action="">
      <input type="hidden" name="interCode1" value="0" id="interCode1">
      <p> Are you sure that you want activate te code <label id="actualCode"></label> ?</p> 
    </form>
      </div>
      <div class="modal-footer">
        <input  name="activateCode" type="submit" class="btn btn-info"  value="Activate" >
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
      </form>
    </div>
  </div>
</div> <!--end modificar-->
   <div class="modal fade" id="Inactive" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
       <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" METHOD="POST" name="pregunta_modificacion">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><span style="color:#CC3333;">Desactivate your code.</span></h4>
      </div>
      <div class="modal-body">
           <input type="hidden" name="interCode2" value="0" id="interCode2">
      <p> Are you sure that you want activate te code <label id="actualCode1"></label> ?</p>
    
      </div>
      <div class="modal-footer">
        <input  name="InactivateCode" type="submit" class="btn btn-success"  value="Inactivate" >
        <button type="button" class="btn btn-default" data-dismiss="modal">No yet</button>
      </div>
      </form>
    </div>
  </div>
</div> <!--end modificar-->
 
</div><!--Page content-->
   
</div>

<?php
// include html footer
include('footer.php');
?>