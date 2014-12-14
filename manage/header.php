<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>iksnumbers.com - Panel</title>
<link rel="stylesheet" type="text/css" href="_style/css/bootstrap.css">
<link href="_style/css/sb-admin.css" rel="stylesheet">
</head>
<body>
    <div class="container">
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
