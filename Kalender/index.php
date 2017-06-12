<?php
date_default_timezone_set('Europe/Berlin');

// Get prev & next month
if (isset($_GET['ym'])) { //isset = obs das gibt
    $ym = $_GET['ym'];
} else {
    // This month
    $ym = date('Y-m');
}

// Check format for the date
$timestamp = strtotime($ym,"-01");
if ($timestamp === false) {
    $timestamp = time();
}

// Today
$today = date('Y-m-j', time());

// For H3 title
$html_title = date('Y / m', $timestamp);

// Create prev & next month link
$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));

//mktime(hour,minute,second,month,day,year)

// Create prev & next year link
$prevy = date('Y-m', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)-1));
$nexty = date('Y-m', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)+1));

// Number of days in the month
$day_count = date('t', $timestamp);

// 0:So etc.
$str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));
function kweek(){
    $weeknr=0;
    $weeknr = date('W',time());
    return $weeknr;
}

// Create Calendar
$weeks = array();
$week = '';

// Add empty cell
$week .= str_repeat('<td></td>', $str); //.= ist wie += nur für Strings

for ( $day = 1; $day <= $day_count; $day++, $str++) {
    $date = $ym.'-'.$day;

    if ($today == $date) {
        $week .= '<td class="today">'.$day;
    } else {
        $week .= '<td>'.$day;
    }
    $week .= '</td>';

    // End of the week OR End of the month
    if ($str % 7 == 6 || $day == $day_count) {
        if($day == $day_count) {
            // Add empty cell
            $week .= str_repeat('<td></td>', 6 - ($str % 7));
        }
        $weeks[] = '<tr>'.$week.'</tr>';

        // Prepare for new week
        $week = '';
    }
}
?>
<!DOCTYPE html >
<head>
  <meta charset="utf-8">
  <!-- Das neueste kompilierte und minimierte CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

  <!-- jquery einbinden-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

  <!-- Das neueste kompilierte und minimierte JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="phpkalender.css">
  <title>PHP-Kalender</title>
</head>

<body>
  <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">
            Misu
          </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav"></ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
  </nav>
  <div class="container">
      <h3>
      <a href="?ym=<?php echo $prevy; ?>"> << </a>
      <a href="?ym=<?php echo $prev; ?>">&lt;</a>
      <?php echo $html_title; ?>
      <a href="?ym=<?php echo $next; ?>">&gt;</a>
      <a href="?ym=<?php echo $nexty; ?>"> >> </a>
      <?php echo 'Aktuelle Kalenderwoche: '.kweek() ?>
      </h3>
      <br>
      <table class="table table-bordered">
          <tr>
              <th>So</th>
              <th>Mo</th>
              <th>Di</th>
              <th>Mi</th>
              <th>Do</th>
              <th>Fr</th>
              <th>Sa</th>
          </tr>
          <?php
              foreach ($weeks as $week) {
                  echo $week;
              }
          ?>
      </table>
      <a class="btn btn-danger" href="index.php" role="button">Aktueller Monat</a>
  </div>
</body>
