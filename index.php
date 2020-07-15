<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Nova+Flat&display=swap" rel="stylesheet">
  <title>萬年曆</title>
  <link rel="stylesheet" href="css/style.css">
  
  <!-- 
    
   -->
  <?php
  // 變更時區
    date_default_timezone_set('Asia/Taipei');
    // 預設值
    $today=date("Y-m-d");
    $dToday=date("j");
    $mToday=date("n");
    $yToday=date("Y");
    $day=date("j");
    $month=date("n");
    $year=date("Y");
    $monthPre=$month-1;
    $monthNext=$month+1;
    $mYearPre=$year;
    $mYearNext=$year;
    $yearPre=$year-1;
    $yearNext=$year+1;
    $lang="tw";
    $numWeek=date("w", strtotime(date("Y-m-d")));
    $week = func_week($numWeek);

    


    // 控制月份增減
    if(isset($_GET['month']) && isset($_GET['year'])){
      $month=$_GET['month'];
      $year=$_GET['year'];
      $monthPre=$month-1;
      $monthNext=$month+1;
      $yearPre=$year-1;
      $yearNext=$year+1;
      $mYearPre=$year;
      $mYearNext=$year;
      
      if($month==12){
        $monthNext=1;
        $monthPre=$month-1;
        $mYearNext=$year+1;
      }
      if($month==1){
        $monthPre=12;
        $monthNext=$month+1;
        $mYearPre=$year-1;
      }


      // 抓取日期
      if(isset($_GET['day'])){
        $day=$_GET['day'];

        //切換月份時防止超出當月日期
        $monthDays=date("t",strtotime(date("$year-$month")));
        if($day>$monthDays){
          $day=$monthDays;
        }
      }
     
    }


    // 顯示格式
    if(isset($_GET['lang'])){
      $lang=$_GET['lang'];
    }

    // 顯示中文星期
    function func_week($numWeek){
      switch($numWeek){
        case 0:
          $strWeek = "星期日";
          break;
        case 1:
          $strWeek = "星期一";
          break;
        case 2:
          $strWeek = "星期二";
          break;
        case "3":
          $strWeek = "星期三";
          break;
        case 4:
          $strWeek = "星期四";
          break;
        case 5:
          $strWeek = "星期五";
          break;
        case 6:
          $strWeek = "星期六";
      }
      return $strWeek;
    }

    // 顯示英文月份
    function func_enMonth($month){
      $enMonth=date("F", strtotime(date("Y-$month-d")));
      return $enMonth;
    }
  ?>
  

  
  <style>
  /* --------- *php-css設定 --------- */

  <?php
    switch($month){
      case 2:
      case 3:
      case 4:
        $color1 = '#ff526f';
        $color2 = '#ffc0cb';
        $imgUrl = 'img/spring.jpg';
        break;
      case 5:
      case 6:
      case 7:
        $color1 = '#0bcc45';
        $color2 = '#96f3d4';
        $imgUrl = 'img/summer.jpg';
        break;
      case 8:
      case 9:
      case 10:
        $color1 = '#ff5e00';
        $color2 = '#ffd3b5';
        $imgUrl = 'img/autumn.jpg';
        break;
      case 11:
      case 12:
      case 1:
        $color1 = '#00a2ff ';
        $color2 = '#b0e0ff';
        $imgUrl = 'img/winter.jpg';
    }

  ?>
   /* 控制面板按鈕 */
   .controlBtn{
    border-color: transparent transparent transparent <?=$color1;?>;
   }
   /* 圖片 */
   .calendarBox .leftBox{
    background-image: url(<?=$imgUrl;?>);
   }
   /* 年月份 */
   .dateRight a{
    color: <?=$color2;?>;
   }
   /* 表格hover */
   .calendarTable tr td:hover{
    background-color: <?=$color2;?>;
   }
   /* 六日 */
   .calendarTable tr td:first-child,
   .calendarTable tr td:last-child{
    color: <?=$color1;?>;
   }
   .calendarTable tr td a:hover{
    background-color: <?=$color2;?>;
   }
   /* 當天 */
   .calendarTable tr td .today{
    background-color: <?=$color1;?>;
   }
   .calendarTable tr td .today:hover{
    background-color: <?=$color1;?>;
   }
   /* 選擇的日期 */
   .calendarTable tr td .selectDay{
    background-color: <?=$color2;?>;
   }
   .calendarTable tr td .selectDay:hover{
    background-color: <?=$color2;?>;
   }
   /* --------- php-css設定* --------- */

   /* 顏色 */
   /*    淺         深
   粉  #ffc0cb   #ff526f
   綠  #96f3d4   #0bcc45
   橘  #ffd3b5   #ff5e00
   藍  #b0e0ff   #00a2ff 
   */

  
 </style>
 <!-- 春2 3 4 夏5 6 7 秋 8 9 10 冬11 12 1 -->

  
</head>
<body>
  <div class="container">

    <div class="controlPanel">
      <div class="controlBox">
        
        <!-- 導引箭頭 -->
        <div class="controlBtnDiv">
          <span class="controlBtn" onclick="controlToggle(this)"></span>
        </div>

        <h3>搜尋條件</h3>
        <form action="?" onsubmit="return checkContorl(this)">
          <div>
            <select name="year" id="selectYear" onchange="changeMonth(this.value)">
              <!-- 顯示今年前後25年的年份 -->
              <?php
                $y1=$yToday-25;
                if($y1<=0){
                  $y1=1;
                }
                $y2=$yToday+25;

                echo "<option value='0' select>請選擇</option>";
                for($i=$y1;$i<=$y2;$i++){
                  echo "<option value='$i'>$i</option>";
                  if($i==$year){
                    echo "<option value='$i' selected>$i</option>";
                  }
                  else{
                    echo "<option value='$i'>$i</option>";
                  }
                }
              ?>
            </select>年
          </div>
          <div>
            <select name="month" id="selectMonth" onchange="changeDay(this.value)">
              <?php
                echo "<option value='0' select>請選擇</option>";
                for($i=1;$i<=12;$i++){
                  if($i==$month){
                    echo "<option value='$i' selected>$i</option>";
                  }
                  else{
                    echo "<option value='$i'>$i</option>";
                  }
                }
              ?>
            </select>月
          </div>
          <div>
            <select name="day" id="selectDay">
              <?php
                echo "<option value='0' select>請選擇</option>";
                $monthDays=date("t",strtotime(date("$year-$month")));
                for($i=1;$i<=$monthDays;$i++){
                  if($i==$day){
                    echo "<option value='$i' selected>$i</option>";
                  }
                  else{
                    echo "<option value='$i'>$i</option>";
                  }
                }
              ?>
            </select>日
          </div>
          <!-- 讓lang也可藉由按鈕傳輸 -->
          <input type="hidden" name="lang" value="<?=$lang;?>">
          <p class="tip">　</p>

          <input type="submit" value="確定">
          <input type="reset" value="重置">
        </form>
        
        <div class="btn_group">
          <a href="index.php?day=<?=$dToday;?>&month=<?=$mToday;?>&year=<?=$yToday;?>&lang=<?=$lang;?>">今天日期</a>
          <?php
            if($lang=="tw"){
              echo '<a href="index.php?day='.$day.'&month='.$month.'&year='.$year.'&lang=en">切換格式</a>';
            }
            else{
              echo '<a href="index.php?day='.$day.'&month='.$month.'&year='.$year.'&lang=tw">切換格式</a>';
            }
          ?>
        </div>
      </div>
    </div>


    <div class="calendar">
      <div class="calendarBox">
        
        <div class="leftBox">
          <div class="dateLeft">
            <p class="todayTxt">
              <?php
                if($day==$dToday && $month==$mToday && $year==$yToday){
                  if($lang=="tw"){
                    echo "今日";
                  }
                  else{
                    echo "Today";
                  }
                }
                else{
                  echo "　";
                }
              ?>
            </p>
            <p class="ym">
              <?php
                  if($lang=="tw"){
                    echo $year."年".$month."月";
                  }
                  else{
                    echo func_enMonth($month).",".$year;
                  }
                ?>
            </p>
            <p class="day"><?=$day;?></p>
            <p class="weekend">
              <?php
                
                if($lang=="tw"){
                  $numWeek=date("w", strtotime(date("$year-$month-$day")));
                  $week = func_week($numWeek);
                  echo $week;
                }
                else{
                  $week=date("l", strtotime(date("$year-$month-$day")));
                  echo $week;
                }
              ?>              
            </p>
          </div>
        </div>

        <div class="rightBox">
          <div class="dateRight">
            <div>
              <a href="index.php?day=<?=$day;?>&month=<?=$month;?>&year=<?=$yearPre;?>&lang=<?=$lang;?>" class="arrowL">◄</a> 
              <span>
                <?php
                  if($lang=="tw"){
                    echo $year."年";
                  }
                  else{
                    echo $year;
                  }
                ?>
              </span>
              <a href="index.php?day=<?=$day;?>&month=<?=$month;?>&year=<?=$yearNext;?>&lang=<?=$lang;?>" class="arrowR">►</a>
            </div>
            <!-- 切換月份 -->
            <div>
              <a href="index.php?day=<?=$day;?>&month=<?=$monthPre;?>&year=<?=$mYearPre;?>&lang=<?=$lang;?>" class="arrowL">◄</a>
              <span>
                <?php
                  if($lang=="tw"){
                    echo $month."月";
                  }
                  else{
                    echo func_enMonth($month);
                  }
                ?>
              </span>
              <a href="index.php?day=<?=$day;?>&month=<?=$monthNext;?>&year=<?=$mYearNext;?>&lang=<?=$lang;?>" class="arrowR">►</a>
            </div>
          </div>
          
          <table class="calendarTable">
            <tr>
              <?php
                if($lang=="tw"){
                  echo '<td>日</td>';
                  echo '<td>一</td>';
                  echo '<td>二</td>';
                  echo '<td>三</td>';
                  echo '<td>四</td>';
                  echo '<td>五</td>';
                  echo '<td>六</td>';
                }
                else{
                  echo '<td>SUN</td>';
                  echo '<td>MON</td>';
                  echo '<td>TUE</td>';
                  echo '<td>WED</td>';
                  echo '<td>THU</td>';
                  echo '<td>FRI</td>';
                  echo '<td>SAT</td>';
                }
              ?>
            </tr>
            <?php
              // 本月的第一天
              // $firstday=date('Y-m-01', strtotime(date("Y-m-d")));
              $firstday="$year-$month-01";
              // 本月第一天是禮拜幾
              $firstdayWeek=date('w', strtotime($firstday));
              // 本月的最後一天
              $lastday = date('Y-m-d', strtotime("$firstday +1 month -1 day"));
              // 本月共有幾天
              $monthDays = date("t", strtotime($firstday));
              //本月有幾周
              $countW = $firstdayWeek + $monthDays;
              $w = ceil($countW/7);


              for($i=0;$i<$w;$i++){
                
                echo "<tr>";
                for($j=0;$j<7;$j++){
                  echo "<td>";

                  if($i==0 && $j<$firstdayWeek){
                    //將前面的日期印為空白
                    echo "";
                  }
                  else{
                    $num=$i*7+$j+1 - $firstdayWeek;
                    if($num<=$monthDays){
                      // 當天日期
                      if($num==$dToday && $month==$mToday && $year==$yToday){
                        // echo "<span class='today'>".$num."</span>";
                        echo '<a class="today" href="index.php?day='.$num.'&month='.$month.'&year='.$year.'&lang='.$lang.'">'.$num.'</a>';
                      }
                      else if($num==$day){
                        // echo "<span class='selectDay'>".$num."</span>";
                        echo '<a class="selectDay" href="index.php?day='.$num.'&month='.$month.'&year='.$year.'&lang='.$lang.'">'.$num.'</a>';
                      }
                      else{
                        // echo $num;
                        echo '<a href="index.php?day='.$num.'&month='.$month.'&year='.$year.'&lang='.$lang.'">'.$num.'</a>';
                      }
                    }
                  }
                  echo "</td>";
                }
                echo "</tr>";
              }
            ?>
          </table>
        </div>
      </div>
    </div>
  </div>


  <script src="js/jquery-3.5.1.min.js"></script>
  <script>
    function changeMonth(val){
      let selectY=document.querySelector("#selectYear").value;

      $.get("api/get_month.php",{"s_year":selectY},function(months){
        console.log(months);
        document.querySelector("#selectMonth").innerHTML=months;
        document.querySelector("#selectDay").innerHTML="";
      })
    }
    function changeDay(val){
      let selectY=document.querySelector("#selectYear").value;
      $.get("api/get_day.php",{"s_year":selectY,"s_month":val},function(days){
        // console.log(days);
        document.querySelector("#selectDay").innerHTML=days;
      })
    }

    function controlToggle(btn){
      $(btn).toggleClass("open");
      
      if($(btn).hasClass("open")==true){
        $(btn).css("transform"," rotate(-180deg)");
        $(".controlPanel").animate({  
          left: "-20px"
        },300);
      }else{
        $(btn).css("transform"," rotate(0deg)");
        $(".controlPanel").animate({  
          left: "-250px"
        },300);
      }
    }


    function checkContorl(chk){
      let sY=$("#selectYear").val();
      let sM=$("#selectMonth").val();
      let sD=$("#selectDay").val();

      if(sY==0 || sM==0 || sD==0){
        document.querySelector(".tip").innerHTML="尚有選項未選擇!";
        return false;
      }else{
        document.querySelector(".tip").innerHTML="　";
        return true;
      }
    }
  </script>
</body>
</html>