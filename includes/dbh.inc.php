<?php

  $servername = "budget-app-database-1.cqlskylpfxg7.us-east-1.rds.amazonaws.com";
  $dbUsername = "admin";
  $dbPassword = "";
  $dbName = "auth";
  $dbPort = 3306;

  $conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName, $dbPort);

  if (!$conn) {
    die("Connection failed: ".mysqli_connect_error());
  }