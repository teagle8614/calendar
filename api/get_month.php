<?php

  $year=$_GET['s_year'];

  if($year!=0){
    echo "<option value='0' select>請選擇</option>";
    for($i=1;$i<=12;$i++){
      echo "<option value='$i'>$i</option>";
    }
  }

?>