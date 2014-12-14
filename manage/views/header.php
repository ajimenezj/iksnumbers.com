<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Panel iksnumbers.com</title>
<link rel="stylesheet" type="text/css" href="_style/css/bootstrap.css">
<link href="_style/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Dashboard -->
    <link href="_style/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <link href="_style/css/plugins/timeline/timeline.css" rel="stylesheet">
    <!-- SB Admin CSS - Include with every page -->
    <link href="_style/css/sb-admin.css" rel="stylesheet">
     <!-- Core Scripts - Include with every page -->

</head>
<body>
    <div class="wrapper">
<?php

// show negative messages
if ($login->errors) {
    foreach ($login->errors as $error) {
        echo $error;
    }
}

// show positive messages
if ($login->messages) {
    foreach ($login->messages as $message) {
        echo $message;
    }
}

?>   
