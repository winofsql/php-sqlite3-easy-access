<?php 

try {
  
  $db = new PDO('sqlite:../lightbox.sqlite3');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  $syain = $db->query("SELECT * FROM 社員マスタ");
    
  $db = null;
}
catch ( PDOException $ex ) {
  print $ex->getMessage();
}

$result = "";

foreach ( $syain as $row ) { 

  $result .= <<<SQLITE_DATA
  <h4>{$row['社員コード']} : {$row['氏名']}</h4>
SQLITE_DATA;    
  
}

require_once("view.php");
