<?php
require_once 'db.php';

function executeSQL($SQL, $params = null) {
  global $conn;
  global $notification;
  try {
    $statement = $conn->prepare($SQL);
    if ($statement->execute() === true) {
      $result = $statement->get_result(); 
      if ($result === true) {
        return true;
      } else if ($result === false) {
        if ($conn->error != '') {
          $notification = 'SQL Fehler: ' . $conn->error;
        }
        return false;
      } else {
        $tableData = [];
        while ($row = $result->fetch_assoc()) {
          $tableData[] = $row;
        }
        return $tableData;
      }
    } else {
      if ($conn->error != '') {
        $notification = 'SQL Fehler: ' . $conn->error;
      }
      return false;
    }
  } catch (Exception $e) {
    if ($conn->error != '') {
      $notification = 'SQL Fehler: ' . $conn->error;
    }
    return false;
  }
}