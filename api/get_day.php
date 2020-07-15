<?php

  $year=$_GET['s_year'];
  $month=$_GET['s_month'];

  $monthDays=date("t", strtotime(date("$year-$month")));

  if($month!=0){
    echo "<option value='0' select>請選擇</option>";
    for($i=1;$i<=$monthDays;$i++){
      echo "<option value='$i'>$i</option>";
    }
  }
  
?>