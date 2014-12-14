<?php
  require_once('config/config.php');

  class manageBD {

   private $link = null;
   private $DataBase = null;
     
	 function __construct(){

		$this->link = mysql_connect(DB_HOST, DB_USER, DB_PASS)
			 	      or die("<script type='text/javascript'>alert('Error al conectarse".mysql_error()."');</script>");
			    //mysql_select_db(DB_NAME, $link); 

		$select_DB = mysql_select_db(DB_NAME) 
		             or die("<script type='text/javascript'>alert('Error al seleccionar BD ".mysql_error()."');</script>");
	    } 

	 function showCodesTable(){
	 		$string = "SELECT * FROM codes WHERE idClient =".$_SESSION['user_id']." AND Status = 0";
	 		$query = mysql_query($string, $this->link)or die("<script type='text/javascript'>alert('Error en la consulta ".mysql_error()."');</script>");
			//echo '<script type="text/javascript">alert("todo correcto")</script>';
			 	//return $query;	

	while( $campo = mysql_fetch_array($query)){
    
	 echo '<tr><td>'.$campo['Codigo'].'</td>
			<td>'.ucwords($campo['OrderId']).'</td>
			<td>'. $campo['ServerInfo'].'</td>
			<td> FOR SALE</td>
			<td style="color:red;" >inactive</td>
			<td><button class="span3 btn btn-success :active btn-xs activar" name="'.$campo['idCodigo'].'" >activate</button></td>
			    </tr>  ';
          }//end while
	 }

	 // Function para Mostrar codigo activos
	 
	 function showCodesTableActivated(){

	 	$string = "SELECT `Codigo`, `idCodigo`
	 				,`OrderId`
	 				,`ServerInfo`		
	 				,datediff(`FechaExpiracion`,current_date()) AS Dias
		 			,`FechaExpiracion` 
	 				,(CASE 1 WHEN `Inactivo` = 1 THEN 'Inactive' ELSE 'Active' end) as Status
	 				FROM codes
	 				WHERE 	idClient =".$_SESSION['user_id']." 
	 				  	AND Status = 1
	 				ORDER BY `FechaExpiracion`";
	 	$query = mysql_query($string, $this->link)or die("<script type='text/javascript'>alert('Error en la consulta ".mysql_error()."');</script>");
	 	//echo '<script type="text/javascript">alert("todo correcto")</script>';
	 	//return $query;
	 
	 	while( $campo = mysql_fetch_array($query)){
	 		$color = 'red';

	 		if ($campo['Status'] == 'Inactive') {
	 			$button = '&nbsp;&nbsp;<button class="span3 btn btn-info :active btn-xs activar" name="'.$campo['idCodigo'].'"> Active</button>';
	 		}else{
	 			$button = '&nbsp;&nbsp;<button class="span3 btn btn-danger :active btn-xs desactiva" name="'.$campo['idCodigo'].'">Inactive</button>';
	 		}
	 		if($campo['Status'] == "Active"){ $color = "#339900";}

	 	 echo '<tr>
	 	 		<td>'.$campo['Codigo'].'</td>
				<td>'.ucwords($campo['OrderId']).'</td>
				<td>'. $campo['ServerInfo'].'</td>
				<td>'. $campo['Dias'].'</td>
				<td style="color:'.$color.'; font-weight:bold;" >'. $campo['Status'].'</td>
				<td>'. $campo['FechaExpiracion'].'</td>
				<td><button class="span3 btn btn-success :active btn-xs modificar" name="'.$campo['idCodigo'].'" >Edit</button>'.$button .'</td>
			    </tr>  ';
			    //name="'.$campo['idCodigo'].'"
	 	}//end while
	 	// data-toggle="modal" data-target="#Confirm"
	 	// echo "<script type='text/javascript'>alert('SELECT * FROM codes WHERE idClient =".$_SESSION['user_id']."');</script>";
	 }
	 
	 // FUNCION PARA ACTIVAR CODIGO Y NOTIFICAR..
	 function activateCode($code)
	 {
	 	$string1 = "SELECT * FROM `codes` WHERE `idCodigo` =  ".$code;
	 	$string = "UPDATE `codes` SET `Activo`= 1,`Inactivo`= 0,`Status`=1,`FechaActivacion`=current_date(),`FechaExpiracion`=DATE_ADD(current_date(), INTERVAL 1 YEAR), `MODIFDTE`=current_timestamp() WHERE `idCodigo` = ".$code;

	 	$query = mysql_query($string, $this->link)or die("<script type='text/javascript'>alert('Error al activar e codigo ".mysql_error()."');</script>");	
	 	$activado =mysql_query($string1, $this->link)or die("<script type='text/javascript'>alert('Error al activar e codigo ".mysql_error()."');</script>");	
 	    $campo = mysql_fetch_array($activado);

        $destino= "required@iksnumbers.com";
        $asunto= "Activacion de codigo - IksNumbers panel";
        $mensaje= "Buenas!\n Un usuario ha activado uno de sus codigos. A continuacion se le daran las informaciones necesrias del mismo para que proceda con la activacion: 
        \n User id: ".$_SESSION['user_id']." \n
        \n nombre id: ".$_SESSION['user_name']." \n
        \n Codigo: ".$campo['Codigo']." \n";
     
  		$enviando= mail($destino, $asunto, $mensaje);
      
	 	echo '<script type="text/javascript">
	 	  alert("the code '.$campo['Codigo'].' has been activated.");
         location.reload();
      </script>';
	 }// END function
	 
	 // FUNCION PARA INACTIVAR EL  CODIGO Y NOTIFICAR..
	 function InactiveCode($id)
	 {
	 	$sql = "UPDATE `codes` SET `Inactivo` =1, `Activo`= 0 WHERE `idCodigo` =".$id;
	 	$sql_datos = "SELECT * FROM `codes` WHERE `idCodigo` =  ".$id;
	 	$destino= "required@iksnumbers.com";
	 	$asunto= "Iks Panel - Codigo Inactivado.";

	 	$mensaje= "Buenas!\n Un usuario ha Inactivado uno de sus codigos. A continuacion se le daran las informaciones necesrias del mismo para que proceda a desactivar:
        \n User id: ".$_SESSION['user_id']." \n
        \n nombre id: ".$_SESSION['user_name']." \n
        \n Inter Code: ".$_SESSION['idCodigo']." \n
        \n Codigo: ".$data['Codigo'];
      

	   if($query = mysql_query($sql, $this->link)){
	    $UserData = mysql_query($sql_datos, $this->link);
	    $data = mysql_fetch_array($UserData);
	   	$enviando= mail($destino, $asunto, $mensaje);
				echo "<script type='text/javascript'>alert('Your code has been Inactivated correctly.'); 
				      location.reload();</script>";
		  }else{
			echo "<script type='text/javascript'>alert('Error activating code!');</script>";
		 	}
	 }// END function

	 function modifyCode($newCode, $oldCode, $id){
	 	$sql = "UPDATE `codes` SET `Codigo`='".$newCode."', `OldNumber` = '".$oldCode."' WHERE `idCodigo` = ".$id;
	 	$sql_datos = "SELECT * FROM `codes` WHERE `idCodigo` =  ".$id;
	 	$destino= "required@iksnumbers.com";
	 	$asunto= "Iks Panel - Codigo Modificado";

	 
		if($query = mysql_query($sql, $this->link)){

	    $UserData = mysql_query($sql_datos, $this->link);
	    $data = mysql_fetch_array($UserData);
				$mensaje= "Buenas!\n Un usuario ha Modificado uno de sus codigos. A continuacion se le daran las informaciones necesrias del mismo para que proceda a desactivar:
        \n User id: ".$_SESSION['user_id']." \n
        \n nombre id: ".$_SESSION['user_name']." \n
        \n Codigo: ".$data['Codigo']." \n
         \n Inter Code: ".$data['idCodigo']." \n
        \n Codigo anterior: ".$data['OldNumber']." \n";
			$enviando= mail($destino, $asunto, $mensaje);

			echo "<script type='text/javascript'>alert('Your code has been Edited correctly.'); 
			location.reload();</script>";
		}else{
			echo "<script type='text/javascript'>alert('Error editing code!');</script>";
		}
	 }

	 function ActiveCode($id){
	 	$sql = "UPDATE `codes` SET `Inactivo` =0, `Activo`= 1 WHERE `idCodigo` =".$id;
	 	$sql_datos = "SELECT * FROM `codes` WHERE `idCodigo` =  ".$id;
	 	$destino= "required@iksnumbers.com";
	 	$asunto= "Iks Panel - Codigo Activado.";

	 	
	   if($query = mysql_query($sql, $this->link)){
	   	$UserData = mysql_query($sql_datos, $this->link);
	    $data = mysql_fetch_array($UserData);

	   	$mensaje= "Buenas!\n Un usuario ha Activado uno de sus codigos. A continuacion se le daran las informaciones necesrias del mismo para que proceda a desactivar:
        \n User id: ".$_SESSION['user_id']." \n
        \n nombre id: ".$_SESSION['user_name']." \n
         \n Inter Code: ".$data['idCodigo']." \n
        \n Codigo: ".$data['Codigo'];
        
				$enviando= mail($destino, $asunto, $mensaje);
				echo "<script type='text/javascript'>alert('Your code has been activated correctly.'); 
				      location.reload();</script>";
		  }else{
			echo "<script type='text/javascript'>alert('Error activating code!');</script>";
		 	}
	 }

  } // end class


?>
