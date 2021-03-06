<?php
  $months = array (0 => 'Choose month', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
  $my_error = "";

  $no_interps = True;				//set this to False when you want interpretations

  // check if the form has been submitted
  if (isset($_POST['submitted']) Or isset($_POST['h_sys_submitted']))
  {
    $h_sys = safeEscapeString($_POST["h_sys"]);

    // get all variables from form - Person #1
    $name1 = safeEscapeString($_POST["name1"]);

    $month1 = safeEscapeString($_POST["month1"]);
    $day1 = safeEscapeString($_POST["day1"]);
    $year1 = safeEscapeString($_POST["year1"]);

    $hour1 = safeEscapeString($_POST["hour1"]);
    $minute1 = safeEscapeString($_POST["minute1"]);

    $timezone1 = safeEscapeString($_POST["timezone1"]);

    $long_deg1 = safeEscapeString($_POST["long_deg1"]);
    $long_min1 = safeEscapeString($_POST["long_min1"]);
    $ew1 = safeEscapeString($_POST["ew1"]);

    $lat_deg1 = safeEscapeString($_POST["lat_deg1"]);
    $lat_min1 = safeEscapeString($_POST["lat_min1"]);
    $ns1 = safeEscapeString($_POST["ns1"]);

    // set cookie containing natal data here
    setcookie ('name', stripslashes($name1), time() + 60 * 60 * 24 * 30, '/', '', 0);

    setcookie ('month', $month1, time() + 60 * 60 * 24 * 30, '/', '', 0);
    setcookie ('day', $day1, time() + 60 * 60 * 24 * 30, '/', '', 0);
    setcookie ('year', $year1, time() + 60 * 60 * 24 * 30, '/', '', 0);

    setcookie ('hour', $hour1, time() + 60 * 60 * 24 * 30, '/', '', 0);
    setcookie ('minute', $minute1, time() + 60 * 60 * 24 * 30, '/', '', 0);

    setcookie ('timezone', $timezone1, time() + 60 * 60 * 24 * 30, '/', '', 0);

    setcookie ('long_deg', $long_deg1, time() + 60 * 60 * 24 * 30, '/', '', 0);
    setcookie ('long_min', $long_min1, time() + 60 * 60 * 24 * 30, '/', '', 0);
    setcookie ('ew', $ew1, time() + 60 * 60 * 24 * 30, '/', '', 0);

    setcookie ('lat_deg', $lat_deg1, time() + 60 * 60 * 24 * 30, '/', '', 0);
    setcookie ('lat_min', $lat_min1, time() + 60 * 60 * 24 * 30, '/', '', 0);
    setcookie ('ns', $ns1, time() + 60 * 60 * 24 * 30, '/', '', 0);

//    include ('header_synastry.html');				//here because of setting cookies above

    include("validation_class.php");

    //error check
    $my_form = new Validate_fields;

    $my_form->check_4html = true;

    $my_form->add_text_field("Name #1", $name1, "text", "y", 40);

    $my_form->add_text_field("Month #1", $month1, "text", "y", 2);
    $my_form->add_text_field("Day #1", $day1, "text", "y", 2);
    $my_form->add_text_field("Year #1", $year1, "text", "y", 4);

    $my_form->add_text_field("Hour #1", $hour1, "text", "y", 2);
    $my_form->add_text_field("Minute #1", $minute1, "text", "y", 2);

    $my_form->add_text_field("Time zone #1", $timezone1, "text", "y", 4);

    $my_form->add_text_field("Longitude degree #1", $long_deg1, "text", "y", 3);
    $my_form->add_text_field("Longitude minute #1", $long_min1, "text", "y", 2);
    $my_form->add_text_field("Longitude E/W #1", $ew1, "text", "y", 2);

    $my_form->add_text_field("Latitude degree #1", $lat_deg1, "text", "y", 2);
    $my_form->add_text_field("Latitude minute #1", $lat_min1, "text", "y", 2);
    $my_form->add_text_field("Latitude N/S #1", $ns1, "text", "y", 2);

    // additional error checks on user-entered data
    if ($month1 != "" And $day1 != "" And $year1 != "")
    {
      if (!$date = checkdate($month1, $day1, $year1))
      {
        $my_error .= "The date of birth you entered is not valid.<br>";
      }
    }

    if (($year1 < 1900) Or ($year1 >= 2100))
    {
      $my_error .= "Birth year person #1 - please enter a year between 1900 and 2099.<br>";
    }

    if (($hour1 < 0) Or ($hour1 > 23))
    {
      $my_error .= "Birth hour must be between 0 and 23.<br>";
    }

    if (($minute1 < 0) Or ($minute1 > 59))
    {
      $my_error .= "Birth minute must be between 0 and 59.<br>";
    }

    if (($long_deg1 < 0) Or ($long_deg1 > 179))
    {
      $my_error .= "Longitude degrees must be between 0 and 179.<br>";
    }

    if (($long_min1 < 0) Or ($long_min1 > 59))
    {
      $my_error .= "Longitude minutes must be between 0 and 59.<br>";
    }

    if (($lat_deg1 < 0) Or ($lat_deg1 > 65))
    {
      $my_error .= "Latitude degrees must be between 0 and 65.<br>";
    }

    if (($lat_min1 < 0) Or ($lat_min1 > 59))
    {
      $my_error .= "Latitude minutes must be between 0 and 59.<br>";
    }

    if (($ew1 == '-1') And ($timezone1 > 2))
    {
      $my_error .= "You have marked West longitude but set an east time zone.<br>";
    }

    if (($ew1 == '1') And ($timezone1 < 0))
    {
      $my_error .= "You have marked East longitude but set a west time zone.<br>";
    }

    if ($ew1 < 0)
    {
      $ew1_txt = "w";
    }
    else
    {
      $ew1_txt = "e";
    }

    if ($ns1 > 0)
    {
      $ns1_txt = "n";
    }
    else
    {
      $ns1_txt = "s";
    }


    // get all variables from form - Person #2
    $name2 = safeEscapeString($_POST["name2"]);

    $month2 = safeEscapeString($_POST["month2"]);
    $day2 = safeEscapeString($_POST["day2"]);
    $year2 = safeEscapeString($_POST["year2"]);

    $hour2 = safeEscapeString($_POST["hour2"]);
    $minute2 = safeEscapeString($_POST["minute2"]);

    $timezone2 = safeEscapeString($_POST["timezone2"]);

    $long_deg2 = safeEscapeString($_POST["long_deg2"]);
    $long_min2 = safeEscapeString($_POST["long_min2"]);
    $ew2 = safeEscapeString($_POST["ew2"]);

    $lat_deg2 = safeEscapeString($_POST["lat_deg2"]);
    $lat_min2 = safeEscapeString($_POST["lat_min2"]);
    $ns2 = safeEscapeString($_POST["ns2"]);

    // set cookie containing natal data here
    setcookie ('name2', stripslashes($name2), time() + 60 * 60 * 24 * 30, '/', '', 0);

    setcookie ('month2', $month2, time() + 60 * 60 * 24 * 30, '/', '', 0);
    setcookie ('day2', $day2, time() + 60 * 60 * 24 * 30, '/', '', 0);
    setcookie ('year2', $year2, time() + 60 * 60 * 24 * 30, '/', '', 0);

    setcookie ('hour2', $hour2, time() + 60 * 60 * 24 * 30, '/', '', 0);
    setcookie ('minute2', $minute2, time() + 60 * 60 * 24 * 30, '/', '', 0);

    setcookie ('timezone2', $timezone2, time() + 60 * 60 * 24 * 30, '/', '', 0);

    setcookie ('long_deg2', $long_deg2, time() + 60 * 60 * 24 * 30, '/', '', 0);
    setcookie ('long_min2', $long_min2, time() + 60 * 60 * 24 * 30, '/', '', 0);
    setcookie ('ew2', $ew2, time() + 60 * 60 * 24 * 30, '/', '', 0);

    setcookie ('lat_deg2', $lat_deg2, time() + 60 * 60 * 24 * 30, '/', '', 0);
    setcookie ('lat_min2', $lat_min2, time() + 60 * 60 * 24 * 30, '/', '', 0);
    setcookie ('ns2', $ns2, time() + 60 * 60 * 24 * 30, '/', '', 0);

    include ('header_synastry.html');				//here because of setting cookies above

    //error check
    $my_form->add_text_field("Name #2", $name2, "text", "y", 40);

    $my_form->add_text_field("Month #2", $month2, "text", "y", 2);
    $my_form->add_text_field("Day #2", $day2, "text", "y", 2);
    $my_form->add_text_field("Year #2", $year2, "text", "y", 4);

    $my_form->add_text_field("Hour #2", $hour2, "text", "y", 2);
    $my_form->add_text_field("Minute #2", $minute2, "text", "y", 2);

    $my_form->add_text_field("Time zone #2", $timezone2, "text", "y", 4);

    $my_form->add_text_field("Longitude degree #2", $long_deg2, "text", "y", 3);
    $my_form->add_text_field("Longitude minute #2", $long_min2, "text", "y", 2);
    $my_form->add_text_field("Longitude E/W #2", $ew2, "text", "y", 2);

    $my_form->add_text_field("Latitude degree #2", $lat_deg2, "text", "y", 2);
    $my_form->add_text_field("Latitude minute #2", $lat_min2, "text", "y", 2);
    $my_form->add_text_field("Latitude N/S #2", $ns2, "text", "y", 2);

    // additional error checks on user-entered data
    if ($month2 != "" And $day2 != "" And $year2 != "")
    {
      if (!$date = checkdate($month2, $day2, $year2))
      {
        $my_error .= "The date of birth you entered is not valid.<br>";
      }
    }

    if (($year2 < 1900) Or ($year2 >= 2100))
    {
      $my_error .= "Birth year person #2 - please enter a year between 1900 and 2099.<br>";
    }

    if (($hour2 < 0) Or ($hour2 > 23))
    {
      $my_error .= "Birth hour must be between 0 and 23.<br>";
    }

    if (($minute2 < 0) Or ($minute2 > 59))
    {
      $my_error .= "Birth minute must be between 0 and 59.<br>";
    }

    if (($long_deg2 < 0) Or ($long_deg2 > 179))
    {
      $my_error .= "Longitude degrees must be between 0 and 179.<br>";
    }

    if (($long_min2 < 0) Or ($long_min2 > 59))
    {
      $my_error .= "Longitude minutes must be between 0 and 59.<br>";
    }

    if (($lat_deg2 < 0) Or ($lat_deg2 > 65))
    {
      $my_error .= "Latitude degrees must be between 0 and 65.<br>";
    }

    if (($lat_min2 < 0) Or ($lat_min2 > 59))
    {
      $my_error .= "Latitude minutes must be between 0 and 59.<br>";
    }

    if (($ew2 == '-1') And ($timezone2 > 2))
    {
      $my_error .= "You have marked West longitude but set an east time zone.<br>";
    }

    if (($ew2 == '1') And ($timezone2 < 0))
    {
      $my_error .= "You have marked East longitude but set a west time zone.<br>";
    }

    if ($ew2 < 0)
    {
      $ew2_txt = "w";
    }
    else
    {
      $ew2_txt = "e";
    }

    if ($ns2 > 0)
    {
      $ns2_txt = "n";
    }
    else
    {
      $ns2_txt = "s";
    }

    $validation_error = $my_form->validation();

    if ((!$validation_error) || ($my_error != ""))
    {
      $error = $my_form->create_msg();
      echo "<TABLE align='center' WIDTH='98%' BORDER='0' CELLSPACING='15' CELLPADDING='0'><tr><td><center><b>";
      echo "<font color='#ff0000' size=+2>Error! - The following error(s) occurred:</font><br>";

      if ($error)
      {
        echo $error . $my_error;
      }
      else
      {
        echo $error . "<br>" . $my_error;
      }

      echo "</font>";
      echo "<font color='#c020c0'";
      echo "<br /><br />PLEASE RE-ENTER YOUR TIME ZONE DATA. THANK YOU.<br><br>";
      echo "</font>";
      echo "</b></center></td></tr></table>";
    }
    else
    {
      // no errors in filling out form, so process form
      $swephsrc = 'sweph';
      $sweph = 'sweph';

      putenv("PATH=$PATH:$swephsrc");

      if (strlen($h_sys) != 1)
      {
        $h_sys = "p";
      }

//Person 1 calculations
      // Unset any variables not initialized elsewhere in the program
      unset($PATH,$out,$pl_name,$longitude1,$house_pos1);

      $inmonth = $month1;
      $inday = $day1;
      $inyear = $year1;

      $inhours = $hour1;
      $inmins = $minute1;
      $insecs = "0";

      $intz = $timezone1;

      $my_longitude = $ew1 * ($long_deg1 + ($long_min1 / 60));
      $my_latitude = $ns1 * ($lat_deg1 + ($lat_min1 / 60));

      if ($intz >= 0)
      {
        $whole = floor($intz);
        $fraction = $intz - floor($intz);
      }
      else
      {
        $whole = ceil($intz);
        $fraction = $intz - ceil($intz);
      }

      $inhours = $inhours - $whole;
      $inmins = $inmins - ($fraction * 60);

      // adjust date and time for minus hour due to time zone taking the hour negative
      $utdatenow = strftime("%d.%m.%Y", mktime($inhours, $inmins, $insecs, $inmonth, $inday, $inyear));
      $utnow = strftime("%H:%M:%S", mktime($inhours, $inmins, $insecs, $inmonth, $inday, $inyear));

      exec ("swetest -edir$sweph -b$utdatenow -ut$utnow -p0123456789DAttt -eswe -house$my_longitude,$my_latitude,$h_sys -flsj -g, -head", $out);		//add a planet

      // Each line of output data from swetest is exploded into array $row, giving these elements:
      // 0 = longitude
      // 1 = speed
      // 2 = house position
      // planets are index 0 - index (LAST_PLANET), house cusps are index (LAST_PLANET + 1) - (LAST_PLANET + 12)
      foreach ($out as $key => $line)
      {
        $row = explode(',',$line);
        $longitude1[$key] = $row[0];
        $speed1[$key] = $row[1];
        $house_pos1[$key] = $row[2];
      };

      include("constants.php");			// this is here because we must rename the planet names

      //calculate the Part of Fortune
      //is this a day chart or a night chart?
      if ($longitude1[LAST_PLANET + 1] > $longitude1[LAST_PLANET + 7])
      {
        if ($longitude1[0] <= $longitude1[LAST_PLANET + 1] And $longitude1[0] > $longitude1[LAST_PLANET + 7])
        {
          $day_chart = True;
        }
        else
        {
          $day_chart = False;
        }
      }
      else
      {
        if ($longitude1[0] > $longitude1[LAST_PLANET + 1] And $longitude1[0] <= $longitude1[LAST_PLANET + 7])
        {
          $day_chart = False;
        }
        else
        {
          $day_chart = True;
        }
      }

      if ($day_chart == True)
      {
        $longitude1[SE_POF] = $longitude1[LAST_PLANET + 1] + $longitude1[1] - $longitude1[0];
      }
      else
      {
        $longitude1[SE_POF] = $longitude1[LAST_PLANET + 1] - $longitude1[1] + $longitude1[0];
      }

      if ($longitude1[SE_POF] >= 360)
      {
        $longitude1[SE_POF] = $longitude1[SE_POF] - 360;
      }

      if ($longitude1[SE_POF] < 0)
      {
        $longitude1[SE_POF] = $longitude1[SE_POF] + 360;
      }

//add a planet - maybe some code needs to be put here

      //capture the Vertex longitude
      $longitude1[LAST_PLANET] = $longitude1[LAST_PLANET + 16];		//Asc = +13, MC = +14, RAMC = +15, Vertex = +16


//get house positions of planets here
      for ($x = 1; $x <= 12; $x++)
      {
        for ($y = 0; $y <= LAST_PLANET; $y++)
        {
          $pl = $longitude1[$y] + (1 / 36000);
          if ($x < 12 And $longitude1[$x + LAST_PLANET] > $longitude1[$x + LAST_PLANET + 1])
          {
            If (($pl >= $longitude1[$x + LAST_PLANET] And $pl < 360) Or ($pl < $longitude1[$x + LAST_PLANET + 1] And $pl >= 0))
            {
              $house_pos1[$y] = $x;
              continue;
            }
          }

          if ($x == 12 And ($longitude1[$x + LAST_PLANET] > $longitude1[LAST_PLANET + 1]))
          {
            if (($pl >= $longitude1[$x + LAST_PLANET] And $pl < 360) Or ($pl < $longitude1[LAST_PLANET + 1] And $pl >= 0))
            {
              $house_pos1[$y] = $x;
            }
            continue;
          }

          if (($pl >= $longitude1[$x + LAST_PLANET]) And ($pl < $longitude1[$x + LAST_PLANET + 1]) And ($x < 12))
          {
            $house_pos1[$y] = $x;
            continue;
          }

          if (($pl >= $longitude1[$x + LAST_PLANET]) And ($pl < $longitude1[LAST_PLANET + 1]) And ($x == 12))
          {
            $house_pos1[$y] = $x;
          }
        }
      }

//Person 2 calculations
      // Unset any variables not initialized elsewhere in the program
      unset($out,$longitude2,$house_pos2);

      //assign data from database to local variables
      $inmonth = $month2;
      $inday = $day2;
      $inyear = $year2;

      $inhours = $hour2;
      $inmins = $minute2;
      $insecs = "0";

      $intz = $timezone2;

      $my_longitude = $ew2 * ($long_deg2 + ($long_min2 / 60));
      $my_latitude = $ns2 * ($lat_deg2 + ($lat_min2 / 60));

      if ($intz >= 0)
      {
        $whole = floor($intz);
        $fraction = $intz - floor($intz);
      }
      else
      {
        $whole = ceil($intz);
        $fraction = $intz - ceil($intz);
      }

      $inhours = $inhours - $whole;
      $inmins = $inmins - ($fraction * 60);

      // adjust date and time for minus hour due to time zone taking the hour negative
      $utdatenow = strftime("%d.%m.%Y", mktime($inhours, $inmins, $insecs, $inmonth, $inday, $inyear));
      $utnow = strftime("%H:%M:%S", mktime($inhours, $inmins, $insecs, $inmonth, $inday, $inyear));

      exec ("swetest -edir$sweph -b$utdatenow -ut$utnow -p0123456789DAttt -eswe -house$my_longitude,$my_latitude,$h_sys -flsj -g, -head", $out);		//add a planet

      // Each line of output data from swetest is exploded into array $row, giving these elements:
      // 0 = longitude
      // 1 = speed
      // 2 = house position
      // planets are index 0 - index (LAST_PLANET), house cusps are index (LAST_PLANET + 1) - (LAST_PLANET + 12)
      foreach ($out as $key => $line)
      {
        $row = explode(',',$line);
        $longitude2[$key] = $row[0];
        $speed2[$key] = $row[1];
        $house_pos2[$key] = $row[2];
      };

      //calculate the Part of Fortune
      //is this a day chart or a night chart?
      if ($longitude2[LAST_PLANET + 1] > $longitude2[LAST_PLANET + 7])
      {
        if ($longitude2[0] <= $longitude2[LAST_PLANET + 1] And $longitude2[0] > $longitude2[LAST_PLANET + 7])
        {
          $day_chart = True;
        }
        else
        {
          $day_chart = False;
        }
      }
      else
      {
        if ($longitude2[0] > $longitude2[LAST_PLANET + 1] And $longitude2[0] <= $longitude2[LAST_PLANET + 7])
        {
          $day_chart = False;
        }
        else
        {
          $day_chart = True;
        }
      }

      if ($day_chart == True)
      {
        $longitude2[SE_POF] = $longitude2[LAST_PLANET + 1] + $longitude2[1] - $longitude2[0];
      }
      else
      {
        $longitude2[SE_POF] = $longitude2[LAST_PLANET + 1] - $longitude2[1] + $longitude2[0];
      }

      if ($longitude2[SE_POF] >= 360)
      {
        $longitude2[SE_POF] = $longitude2[SE_POF] - 360;
      }

      if ($longitude2[SE_POF] < 0)
      {
        $longitude2[SE_POF] = $longitude2[SE_POF] + 360;
      }

//add a planet - maybe some code needs to be put here

      //capture the Vertex longitude
      $longitude2[LAST_PLANET] = $longitude2[LAST_PLANET + 16];


//get house positions of planets here
      for ($x = 1; $x <= 12; $x++)
      {
        for ($y = 0; $y <= LAST_PLANET; $y++)
        {
          $pl = $longitude2[$y] + (1 / 36000);
          if ($x < 12 And $longitude2[$x + LAST_PLANET] > $longitude2[$x + LAST_PLANET + 1])
          {
            If (($pl >= $longitude2[$x + LAST_PLANET] And $pl < 360) Or ($pl < $longitude2[$x + LAST_PLANET + 1] And $pl >= 0))
            {
              $house_pos2[$y] = $x;
              continue;
            }
          }

          if ($x == 12 And ($longitude2[$x + LAST_PLANET] > $longitude2[LAST_PLANET + 1]))
          {
            if (($pl >= $longitude2[$x + LAST_PLANET] And $pl < 360) Or ($pl < $longitude2[LAST_PLANET + 1] And $pl >= 0))
            {
              $house_pos2[$y] = $x;
            }
            continue;
          }

          if (($pl >= $longitude2[$x + LAST_PLANET]) And ($pl < $longitude2[$x + LAST_PLANET + 1]) And ($x < 12))
          {
            $house_pos2[$y] = $x;
            continue;
          }

          if (($pl >= $longitude2[$x + LAST_PLANET]) And ($pl < $longitude2[LAST_PLANET + 1]) And ($x == 12))
          {
            $house_pos2[$y] = $x;
          }
        }
      }


//display natal data
      $secs = "0";
      if ($timezone1 < 0)
      {
        $tz1 = $timezone1;
      }
      else
      {
        $tz1 = "+" . $timezone1;
      }

      if ($timezone2 < 0)
      {
        $tz2 = $timezone2;
      }
      else
      {
        $tz2 = "+" . $timezone2;
      }

      $name_without_slashes = stripslashes($name1);

      echo "<center>";
      echo "<FONT color='#0000ff' SIZE='3' FACE='Arial'><b>$name_without_slashes</b><br />";
      echo '<b>Born ' . strftime("%A, %B %d, %Y<br>%X (time zone = GMT $tz1 hours)</b><br />\n", mktime($hour1, $minute1, $secs, $month1, $day1, $year1));
      echo "<b>" . $long_deg1 . $ew1_txt . $long_min1 . ", " . $lat_deg1 . $ns1_txt . $lat_min1 . "</b><br /><br />";

      $name2_without_slashes = stripslashes($name2);
      echo "<b>$name2_without_slashes</b><br />";
      echo '<b>Born ' . strftime("%A, %B %d, %Y<br>%X (time zone = GMT $tz2 hours)</b><br />\n", mktime($hour2, $minute2, $secs, $month2, $day2, $year2));
      echo "<b>" . $long_deg2 . $ew2_txt . $long_min2 . ", " . $lat_deg2 . $ns2_txt . $lat_min2 . "</b><br /><br />";
      echo "</font>";
?>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <select name="h_sys" size="1">
          <?php
          echo "<option value='p' ";
          if ($h_sys == "p"){ echo " selected"; }
          echo "> Placidus </option>";

          echo "<option value='k' ";
          if ($h_sys == "k"){ echo " selected"; }
          echo "> Koch </option>";

          echo "<option value='r' ";
          if ($h_sys == "r"){ echo " selected"; }
          echo "> Regiomontanus </option>";

          echo "<option value='c' ";
          if ($h_sys == "c"){ echo " selected"; }
          echo "> Campanus </option>";

          echo "<option value='b' ";
          if ($h_sys == "b"){ echo " selected"; }
          echo "> Alcabitus </option>";

          echo "<option value='o' ";
          if ($h_sys == "o"){ echo " selected"; }
          echo "> Porphyrius </option>";

          echo "<option value='m' ";
          if ($h_sys == "m"){ echo " selected"; }
          echo "> Morinus </option>";

          echo "<option value='a' ";
          if ($h_sys == "a"){ echo " selected"; }
          echo "> Equal house - Asc </option>";

          echo "<option value='t' ";
          if ($h_sys == "t"){ echo " selected"; }
          echo "> Topocentric </option>";

          echo "<option value='v' ";
          if ($h_sys == "v"){ echo " selected"; }
          echo "> Vehlow </option>";
          ?>
        </select>

        <input type="hidden" name="name1" value="<?php echo stripslashes($_POST['name1']); ?>">
        <input type="hidden" name="month1" value="<?php echo $_POST['month1']; ?>">
        <input type="hidden" name="day1" value="<?php echo $_POST['day1']; ?>">
        <input type="hidden" name="year1" value="<?php echo $_POST['year1']; ?>">
        <input type="hidden" name="hour1" value="<?php echo $_POST['hour1']; ?>">
        <input type="hidden" name="minute1" value="<?php echo $_POST['minute1']; ?>">
        <input type="hidden" name="timezone1" value="<?php echo $_POST['timezone1']; ?>">
        <input type="hidden" name="long_deg1" value="<?php echo $_POST['long_deg1']; ?>">
        <input type="hidden" name="long_min1" value="<?php echo $_POST['long_min1']; ?>">
        <input type="hidden" name="ew1" value="<?php echo $_POST['ew1']; ?>">
        <input type="hidden" name="lat_deg1" value="<?php echo $_POST['lat_deg1']; ?>">
        <input type="hidden" name="lat_min1" value="<?php echo $_POST['lat_min1']; ?>">
        <input type="hidden" name="ns1" value="<?php echo $_POST['ns1']; ?>">

        <input type="hidden" name="name2" value="<?php echo stripslashes($_POST['name2']); ?>">
        <input type="hidden" name="month2" value="<?php echo $_POST['month2']; ?>">
        <input type="hidden" name="day2" value="<?php echo $_POST['day2']; ?>">
        <input type="hidden" name="year2" value="<?php echo $_POST['year2']; ?>">
        <input type="hidden" name="hour2" value="<?php echo $_POST['hour2']; ?>">
        <input type="hidden" name="minute2" value="<?php echo $_POST['minute2']; ?>">
        <input type="hidden" name="timezone2" value="<?php echo $_POST['timezone2']; ?>">
        <input type="hidden" name="long_deg2" value="<?php echo $_POST['long_deg2']; ?>">
        <input type="hidden" name="long_min2" value="<?php echo $_POST['long_min2']; ?>">
        <input type="hidden" name="ew2" value="<?php echo $_POST['ew2']; ?>">
        <input type="hidden" name="lat_deg2" value="<?php echo $_POST['lat_deg2']; ?>">
        <input type="hidden" name="lat_min2" value="<?php echo $_POST['lat_min2']; ?>">
        <input type="hidden" name="ns2" value="<?php echo $_POST['ns2']; ?>">

        <input type="hidden" name="h_sys_submitted" value="TRUE">
        <INPUT type="submit" name="submit" value="Go" align="middle" style="background-color:#66ff66;color:#000000;font-size:16px;font-weight:bold">
      </form>
<?php
      echo "</center>";

      $hr_ob1 = $hour1;
      $min_ob1 = $minute1;

      $ubt1 = 0;
      if (($hr_ob1 == 12) And ($min_ob1 == 0))
      {
        $ubt1 = 1;				// this person has an unknown birth time
      }

      $hr_ob2 = $hour2;
      $min_ob2 = $minute2;

      $ubt2 = 0;
      if (($hr_ob2 == 12) And ($min_ob2 == 0))
      {
        $ubt2 = 1;				// this person has an unknown birth time
      }

      $rx1 = "";
      for ($i = 0; $i <= SE_TNODE; $i++)
      {
        if ($speed1[$i] < 0)
        {
          $rx1 .= "R";
        }
        else
        {
          $rx1 .= " ";
        }
      }

      $rx2 = "";
      for ($i = 0; $i <= SE_TNODE; $i++)
      {
        if ($speed2[$i] < 0)
        {
          $rx2 .= "R";
        }
        else
        {
          $rx2 .= " ";
        }
      }

      // to make GET string shorter (for IE6)
      for ($i = 0; $i <= LAST_PLANET; $i++)
      {
        $L1[$i] = $longitude1[$i];
        $L2[$i] = $longitude2[$i];
      }

      for ($i = 1; $i <= LAST_PLANET; $i++)
      {
        $hc1[$i] = $longitude1[LAST_PLANET + $i];
        $hc2[$i] = $longitude2[LAST_PLANET + $i];
      }

// no need to urlencode unless perhaps magic quotes is ON (??)
    $ser_L1 = serialize($L1);
    $ser_hc1 = serialize($hc1);
    $ser_L2 = serialize($L2);
    $ser_hc2 = serialize($hc2);

    echo "<center>";
    //echo "<img border='0' src='chartwheel_synastry_line.php?rx1=$rx1&rx2=$rx2&p1=$ser_L1&p2=$ser_L2&hc1=$ser_hc1&hc2=$ser_hc2&ubt1=$ubt1&ubt2=$ubt2' width='730' height='400'>";
    echo "<img border='0' src='synastry_wheel.php?rx1=$rx1&rx2=$rx2&p1=$ser_L1&p2=$ser_L2&hc1=$ser_hc1&hc2=$ser_hc2&ubt1=$ubt1&ubt2=$ubt2' width='640' height='640'>";
    echo "<br><br>";
    echo "<img border='0' src='synastry_aspect_grid.php?rx1=$rx1&rx2=$rx2&p1=$ser_L1&p2=$ser_L2&hc1=$ser_hc1&hc2=$ser_hc2&ubt1=$ubt1&ubt2=$ubt2' width='830' height='475'>";
    echo "</center>";
    echo "<br>";

// display synastry data - planets
    echo '<center><table width="65%" cellpadding="0" cellspacing="0" border="0">',"\n";

    echo '<tr>';
    echo "<td><font color='#0000ff'><b> Planets 1 </b></font></td>";
    echo "<td><font color='#0000ff'><b> Longitude </b></font></td>";
    echo "<td><font color='#0000ff'><b> House<br>position 1 </b></font></td>";
    echo "<td><font color='#0000ff'><b> Planets 2 </b></font></td>";
    echo "<td><font color='#0000ff'><b> Longitude </b></font></td>";
    echo "<td><font color='#0000ff'><b> House<br>position 2 </b></font></td>";
    echo '</tr>';

    for ($i = 0; $i <= LAST_PLANET; $i++)
    {
      echo '<tr>';
      echo "<td>" . $pl_name[$i] . "</td>";
      echo "<td><font face='Courier New'>" . Convert_Longitude($longitude1[$i]) . " " . Mid($rx1, $i + 1, 1) . "</font></td>";
      if ($ubt1 == 1)
      {
        echo "<td>&nbsp;</td>";
      }
      else
      {
        $hse = floor($house_pos1[$i]);
        if ($hse < 10)
        {
          echo "<td>&nbsp;&nbsp;&nbsp;&nbsp; " . $hse . "</td>";
        }
        else
        {
          echo "<td>&nbsp;&nbsp;&nbsp;" . $hse . "</td>";
        }
      }

      echo "<td>" . $pl_name[$i] . "</td>";
      echo "<td><font face='Courier New'>" . Convert_Longitude($longitude2[$i]) . " " . Mid($rx2, $i + 1, 1) . "</font></td>";
      if ($ubt2 == 1)
      {
        echo "<td>&nbsp;</td>";
      }
      else
      {
        $hse = floor($house_pos2[$i]);
        if ($hse < 10)
        {
          echo "<td>&nbsp;&nbsp;&nbsp;&nbsp; " . $hse . "</td>";
        }
        else
        {
          echo "<td>&nbsp;&nbsp;&nbsp;" . $hse . "</td>";
        }
      }

      echo '</tr>';
    }

    echo '<tr>';
    echo "<td> &nbsp </td>";
    echo "<td> &nbsp </td>";
    echo "<td> &nbsp </td>";
    echo "<td> &nbsp </td>";
    echo '</tr>';

// display synastry data - house cusps
    if ($ubt1 == 0 Or $ubt2 == 0)
    {
      echo '<tr>';
      echo "<td><font color='#0000ff'><b> Name </b></font></td>";
      echo "<td><font color='#0000ff'><b> Longitude 1</b></font></td>";
      echo "<td> &nbsp </td>";
      echo "<td><font color='#0000ff'><b> Longitude 2</b></font></td>";
      echo "<td> &nbsp </td>";
      echo '</tr>';

      for ($i = 1; $i <= 12; $i++)
      {
        echo '<tr>';
        if ($i == 1)
        {
          echo "<td>Ascendant </td>";
        }
        elseif ($i == 10)
        {
          echo "<td>MC (Midheaven) </td>";
        }
        else
        {
          echo "<td>House " . ($i) . "</td>";
        }
        if ($ubt1 == 1)
        {
          echo "<td><font face='Courier New'>" . "&nbsp;</font></td>";
        }
        else
        {
          echo "<td><font face='Courier New'>" . Convert_Longitude($hc1[$i]) . "</font></td>";
        }
        echo "<td> &nbsp </td>";

        if ($ubt2 == 1)
        {
          echo "<td><font face='Courier New'>" . "&nbsp;</font></td>";
        }
        else
        {
          echo "<td><font face='Courier New'>" . Convert_Longitude($hc2[$i]) . "</font></td>";
        }
        echo "<td> &nbsp </td>";
        echo '</tr>';
      }
     }

    echo '</table></center>',"\n";
    echo "<br /><br />";


// display synastry data - aspect table
    $asp_name[1] = "Conjunction";
    $asp_name[2] = "Opposition";
    $asp_name[3] = "Trine";
    $asp_name[4] = "Square";
    $asp_name[5] = "Quincunx";
    $asp_name[6] = "Sextile";

    echo '<center><table width="40%" cellpadding="0" cellspacing="0" border="0">',"\n";

    echo '<tr>';
    echo "<td><font color='#0000ff'><b> Planet 1</b></font></td>";
    echo "<td><font color='#0000ff'><b> Aspect </b></font></td>";
    echo "<td><font color='#0000ff'><b> Planet 2</b></font></td>";
    echo "<td><font color='#0000ff'><b> Orb </b></font></td>";
    echo '</tr>';

    // include Ascendant and MC
    $longitude1[LAST_PLANET + 1] = $hc1[1];
    $longitude1[LAST_PLANET + 2] = $hc1[10];

    $pl_name[LAST_PLANET + 1] = "Ascendant";
    $pl_name[LAST_PLANET + 2] = "Midheaven";

    $longitude2[LAST_PLANET + 1] = $hc2[1];
    $longitude2[LAST_PLANET + 2] = $hc2[10];

    if ($ubt1 == 1)
    {
      $a1 = SE_TNODE;
    }
    else
    {
      $a1 = LAST_PLANET + 2;
    }

    if ($ubt2 == 1)
    {
      $b1 = SE_TNODE;
    }
    else
    {
      $b1 = LAST_PLANET + 2;
    }

    for ($i = 0; $i <= $a1; $i++)
    {
      echo "<tr><td colspan='4'>&nbsp;</td></tr>";
      for ($j = 0; $j <= $b1; $j++)
      {
        $q = 0;
        $da = Abs($longitude1[$i] - $longitude2[$j]);

        if ($da > 180)
        {
          $da = 360 - $da;
        }

        // set orb - 8 if Sun or Moon, 6 if not Sun or Moon
        if ($i == SE_POF Or $j == SE_POF)
        {
          $orb = 2;
        }
        elseif ($i == SE_LILITH Or $j == SE_LILITH)
        {
          $orb = 3;
        }
        elseif ($i == SE_TNODE Or $j == SE_TNODE)
        {
          $orb = 3;
        }
        elseif ($i == SE_VERTEX Or $j == SE_VERTEX)
        {
          $orb = 3;
        }
        elseif ($i == 0 Or $i == 1 Or $j == 0 Or $j == 1)
        {
          $orb = 8;
        }
        else
        {
          $orb = 6;
        }

        // is there an aspect within orb?
        if ($da <= $orb)
        {
          $q = 1;
          $dax = $da;
        }
        elseif (($da <= (60 + $orb)) And ($da >= (60 - $orb)))
        {
          $q = 6;
          $dax = $da - 60;
        }
        elseif (($da <= (90 + $orb)) And ($da >= (90 - $orb)))
        {
          $q = 4;
          $dax = $da - 90;
        }
        elseif (($da <= (120 + $orb)) And ($da >= (120 - $orb)))
        {
          $q = 3;
          $dax = $da - 120;
        }
        elseif (($da <= (150 + $orb)) And ($da >= (150 - $orb)))
        {
          $q = 5;
          $dax = $da - 150;
        }
        elseif ($da >= (180 - $orb))
        {
          $q = 2;
          $dax = 180 - $da;
        }

        if ($q > 0)
        {
          // aspect exists
          echo '<tr>';
          echo "<td>" . $pl_name[$i] . "</td>";
          echo "<td>" . $asp_name[$q] . "</td>";
          echo "<td>" . $pl_name[$j] . "</td>";
          echo "<td>" . sprintf("%.2f", abs($dax)) . "</td>";
          echo '</tr>';
        }
      }
    }

    echo '</table></center>',"\n";
    echo "<br /><br />";

    if (EMAIL_enabled == True)
    {
      @mail(EMAIL, "Synastry", "");
    }

//display the synastry chart report
    if ($no_interps == True)
    {
      include ('footer.html');
      exit();
    }
    else
    {
      echo '<center><table width="61.8%" cellpadding="0" cellspacing="0" border="0">';
      echo '<tr><td><font face="Verdana" size="3">';

      //display philosophy of astrology
      echo "<center><font size='+1' color='#0000ff'><b>MY PHILOSOPHY OF ASTROLOGY</b></font></center>";

      $file = "natal_files/philo.txt";
      $fh = fopen($file, "r");
      $string = fread($fh, filesize($file));
      fclose($fh);

      $philo = nl2br($string);
      echo "<font size=2>" . $philo . "</font>";


      if ($ubt1 == 0)
      {
        //display planet in house interpretation
        //get header first
        echo "<center><font size='+1' color='#0000ff'><b>HOUSE POSITIONS OF PLANETS</b></font></center>";

        $file = "natal_files/house.txt";
        $fh = fopen($file, "r");
        $string = fread($fh, filesize($file));
        fclose($fh);

        $string = nl2br($string);
        $house_interp = $string;

        // loop through each planet
        for ($i = 0; $i <= 9; $i++)
        {
          $h_pos = $house_pos1[$i];
          $phrase_to_look_for = $pl_name[$i] . " in";
          $file = "natal_files/house_" . trim($h_pos) . ".txt";
          $string = Find_Specific_Report_Paragraph($phrase_to_look_for, $file);
          $string = nl2br($string);
          $house_interp .= $string;
        }

        echo "<font size=2>" . $house_interp . "</font>";
      }


      //display planetary aspect interpretations
      //get header first
      echo "<center><font size='+1' color='#0000ff'><b>PLANETARY ASPECTS</b></font></center>";

      $file = "natal_files/aspect.txt";
      $fh = fopen($file, "r");
      $string = fread($fh, filesize($file));
      fclose($fh);

      $string = nl2br($string);
      $p_aspect_interp = $string;

      echo "<font size=2>" . $p_aspect_interp . "</font>";

      // loop through each planet
      for ($i = 0; $i <= 9; $i++)
      {
        for ($j = 0; $j <= 9; $j++)
        {
          if (($i == 1 Or $j == 1 Or $j == 10) And $ubt1 == 1)
          {
            continue;			// do not allow Moon aspects or Ascendant aspects if birth time is unknown
          }

          $da = Abs($longitude1[$i] - $longitude2[$j]);
          if ($da > 180)
          {
            $da = 360 - $da;
          }

          // set orb - 8 if Sun or Moon, 6 if not Sun or Moon
          if ($i == SE_POF Or $j == SE_POF)
          {
            $orb = 2;
          }
          elseif ($i == SE_LILITH Or $j == SE_LILITH)
          {
            $orb = 3;
          }
          elseif ($i == SE_TNODE Or $j == SE_TNODE)
          {
            $orb = 3;
          }
          elseif ($i == SE_VERTEX Or $j == SE_VERTEX)
          {
            $orb = 3;
          }
          elseif ($i == 0 Or $i == 1 Or $j == 0 Or $j == 1)
          {
            $orb = 8;
          }
          else
          {
            $orb = 6;
          }

          // are planets within orb?
          $q = 1;
          if ($da <= $orb)
          {
            $q = 2;
          }
          elseif (($da <= 60 + $orb) And ($da >= 60 - $orb))
          {
            $q = 3;
          }
          elseif (($da <= 90 + $orb) And ($da >= 90 - $orb))
          {
            $q = 4;
          }
          elseif (($da <= 120 + $orb) And ($da >= 120 - $orb))
          {
            $q = 5;
          }
          elseif ($da >= 180 - $orb)
          {
            $q = 6;
          }

          if ($q > 1)
          {
            if ($q == 2)
            {
              $aspect = " blending with ";
            }
            elseif ($q == 3 Or $q == 5)
            {
              $aspect = " harmonizing with ";
            }
            elseif ($q == 4 Or $q == 6)
            {
              $aspect = " discordant to ";
            }

            $phrase_to_look_for = $pl_name[$i] . $aspect . $pl_name[$j];
            $file = "natal_files/" . strtolower($pl_name[$i]) . ".txt";
            $string = Find_Specific_Report_Paragraph($phrase_to_look_for, $file);
            $string = nl2br($string);
            echo "<font size=2>" . $string . "</font>";
          }
        }
      }


      //display closing
      echo "<br><center><font size='+1' color='#0000ff'><b>CLOSING COMMENTS</b></font></center>";

      if ($ubt1 == 1)
      {
        $file = "natal_files/closing_unk.txt";
      }
      else
      {
        $file = "natal_files/closing.txt";
      }
      $fh = fopen($file, "r");
      $string = fread($fh, filesize($file));
      fclose($fh);

      $closing = nl2br($string);
      echo "<font size=2>" . $closing . "</font>";

      echo '</font></td></tr>';
      echo '</table></center>';
      echo "<br /><br />";

      include ('footer.html');
      exit();
      }
    }
  }
  else
  {
    include ('header_synastry.html');				//here because of cookies

    $name1 = stripslashes($_COOKIE['name']);

    $month1 = $_COOKIE['month'];
    $day1 = $_COOKIE['day'];
    $year1 = $_COOKIE['year'];

    $hour1 = $_COOKIE['hour'];
    $minute1 = $_COOKIE['minute'];

    $timezone1 = $_COOKIE['timezone'];

    $long_deg1 = $_COOKIE["long_deg"];
    $long_min1 = $_COOKIE["long_min"];
    $ew1 = $_COOKIE["ew"];

    $lat_deg1 = $_COOKIE["lat_deg"];
    $lat_min1 = $_COOKIE["lat_min"];
    $ns1 = $_COOKIE["ns"];

    $name2 = stripslashes($_COOKIE['name2']);

    $month2 = $_COOKIE['month2'];
    $day2 = $_COOKIE['day2'];
    $year2 = $_COOKIE['year2'];

    $hour2 = $_COOKIE['hour2'];
    $minute2 = $_COOKIE['minute2'];

    $timezone2 = $_COOKIE['timezone2'];

    $long_deg2 = $_COOKIE["long_deg2"];
    $long_min2 = $_COOKIE["long_min2"];
    $ew2 = $_COOKIE["ew2"];

    $lat_deg2 = $_COOKIE["lat_deg2"];
    $lat_min2 = $_COOKIE["lat_min2"];
    $ns2 = $_COOKIE["ns2"];
  }

?>

<table style="margin: 0px 20px;">
  <tr>
    <td>
      <font color='#ff0000' size=4>
      <b>Please Read This:</b><br>
      </font>

      <font color='#000000' size=2>
      If you do not know all the information that is required by the form below, then here is where you may go<br>
      for longitude, latitude, and time zone information (all of which are very important):<br><br>
      <a href="http://www.astro.com/atlas">http://www.astro.com/atlas</a><br><br>

      1) Click on SEARCH.<br>
      2) Click on the link that is your birth place.<br>
      3) Fill out the information in order to find the time zone at birth.<br>
      4) Click on Continue.<br>
      5) Locate the time zone information. For example:<br><br>
      &nbsp;&nbsp;&nbsp;&nbsp;<b>Time Zone: 5 h west,  Daylight Saving</b> (this means select the "GMT -04:00" option - one hour added for DST.<br><br>
      6) Enter the longitude, latitude, and time zone information into the below form.<br><br>

      OR JUST GO DIRECTLY TO:<br><br>
      <a href="http://www.astro.com/cgi/ade.cgi">http://www.astro.com/cgi/ade.cgi</a><br><br>
      and fill out all the information. Then come back here and fill out the form with the data you now have.<br><br><br>
      </font>
    </td>
  </tr>
</table>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" target="_blank" style="margin: 0px 20px;">
  <fieldset><legend><font size=4><b>Data entry for Synastry - Person #1</b></font></legend>

  &nbsp;&nbsp;<font color="#ff0000"><b>All fields are required.</b></font><br>

  <table style="font-size:12px;">
    <TR>
      <TD>
        <P align="right">Name #1:</P>
      </TD>

      <TD>
        <INPUT size="40" name="name1" value="<?php echo $name1; ?>">
        <font color="#0000ff">
        (do not use your full name if you do want want the world to see it)
        </font>
      </TD>
    </TR>

    <TR>
      <TD>
        <P align="right">Birth date #1:</P>
      </TD>

      <TD>
        <?php
        echo '<select name="month1">';
        foreach ($months as $key => $value)
        {
          echo "<option value=\"$key\"";
          if ($key == $month1)
          {
            echo ' selected="selected"';
          }
          echo ">$value</option>\n";
        }
        echo '</select>';
        ?>

        <INPUT size="2" maxlength="2" name="day1" value="<?php echo $day1; ?>">
        <b>,</b>&nbsp;
        <INPUT size="4" maxlength="4" name="year1" value="<?php echo $year1; ?>">
         <font color="#0000ff">
        (only years from 1900 through 2099 are valid)
        </font>
      </TD>
    </TR>

    <TR>
      <td valign="top"><P align="right">Birth time #1:</P></td>
      <TD>
        <INPUT maxlength="2" size="2" name="hour1" value="<?php echo $hour1; ?>">
        <b>:</b>
        <INPUT maxlength="2" size="2" name="minute1" value="<?php echo $minute1; ?>">

        <br>

        <font color="#0000ff">
        (please give time of birth in 24 hour format. If your birth time is unknown, please enter 12:00)<br>
        (if you were born EXACTLY at 12:00, then please enter 11:59 or 12:01 ? 12:00 is reserved for unknown birth times only)
        <br><br>
        </font>
      </TD>
    </TR>

    <TR>
      <td valign="top">
        <P align="right"><font color="#ff0000">
        <b>IMPORTANT</b>
        </font></P>
      </td>

      <td>
        <font color="#ff0000">
        <b>NOTICE:</b>
        </font>
        <b>&nbsp;&nbsp;West longitudes are MINUS time zones.&nbsp;&nbsp;East longitudes are PLUS time zones.</b>
      </td>
    </TR>

    <TR>
      <td valign="top"><P align="right">Time zone #1:</P></td>

      <TD>
        <select name="timezone1" size="1">
          <?php
          echo "<option value='' ";
          if ($timezone1 == ""){ echo " selected"; }
          echo "> Select Time Zone </option>";

          echo "<option value='-12' ";
          if ($timezone1 == "-12"){ echo " selected"; }
          echo ">GMT -12:00 hrs - IDLW</option>";

          echo "<option value='-11' ";
          if ($timezone1 == "-11"){ echo " selected"; }
          echo ">GMT -11:00 hrs - BET or NT</option>";

          echo "<option value='-10.5' ";
          if ($timezone1 == "-10.5"){ echo " selected"; }
          echo ">GMT -10:30 hrs - HST</option>";

          echo "<option value='-10' ";
          if ($timezone1 == "-10"){ echo " selected"; }
          echo ">GMT -10:00 hrs - AHST</option>";

          echo "<option value='-9.5' ";
          if ($timezone1 == "-9.5"){ echo " selected"; }
          echo ">GMT -09:30 hrs - HDT or HWT</option>";

          echo "<option value='-9' ";
          if ($timezone1 == "-9"){ echo " selected"; }
          echo ">GMT -09:00 hrs - YST or AHDT or AHWT</option>";

          echo "<option value='-8' ";
          if ($timezone1 == "-8"){ echo " selected"; }
          echo ">GMT -08:00 hrs - PST or YDT or YWT</option>";

          echo "<option value='-7' ";
          if ($timezone1 == "-7"){ echo " selected"; }
          echo ">GMT -07:00 hrs - MST or PDT or PWT</option>";

          echo "<option value='-6' ";
          if ($timezone1 == "-6"){ echo " selected"; }
          echo ">GMT -06:00 hrs - CST or MDT or MWT</option>";

          echo "<option value='-5' ";
          if ($timezone1 == "-5"){ echo " selected"; }
          echo ">GMT -05:00 hrs - EST or CDT or CWT</option>";

          echo "<option value='-4' ";
          if ($timezone1 == "-4"){ echo " selected"; }
          echo ">GMT -04:00 hrs - AST or EDT or EWT</option>";

          echo "<option value='-3.5' ";
          if ($timezone1 == "-3.5"){ echo " selected"; }
          echo ">GMT -03:30 hrs - NST</option>";

          echo "<option value='-3' ";
          if ($timezone1 == "-3"){ echo " selected"; }
          echo ">GMT -03:00 hrs - BZT2 or AWT</option>";

          echo "<option value='-2' ";
          if ($timezone1 == "-2"){ echo " selected"; }
          echo ">GMT -02:00 hrs - AT</option>";

          echo "<option value='-1' ";
          if ($timezone1 == "-1"){ echo " selected"; }
          echo ">GMT -01:00 hrs - WAT</option>";

          echo "<option value='0' ";
          if ($timezone1 == "0"){ echo " selected"; }
          echo ">Greenwich Mean Time - GMT or UT</option>";

          echo "<option value='1' ";
          if ($timezone1 == "1"){ echo " selected"; }
          echo ">GMT +01:00 hrs - CET or MET or BST</option>";

          echo "<option value='2' ";
          if ($timezone1 == "2"){ echo " selected"; }
          echo ">GMT +02:00 hrs - EET or CED or MED or BDST or BWT</option>";

          echo "<option value='3' ";
          if ($timezone1 == "3"){ echo " selected"; }
          echo ">GMT +03:00 hrs - BAT or EED</option>";

          echo "<option value='3.5' ";
          if ($timezone1 == "3.5"){ echo " selected"; }
          echo ">GMT +03:30 hrs - IT</option>";

          echo "<option value='4' ";
          if ($timezone1 == "4"){ echo " selected"; }
          echo ">GMT +04:00 hrs - USZ3</option>";

          echo "<option value='5' ";
          if ($timezone1 == "5"){ echo " selected"; }
          echo ">GMT +05:00 hrs - USZ4</option>";

          echo "<option value='5.5' ";
          if ($timezone1 == "5.5"){ echo " selected"; }
          echo ">GMT +05:30 hrs - IST</option>";

          echo "<option value='6' ";
          if ($timezone1 == "6"){ echo " selected"; }
          echo ">GMT +06:00 hrs - USZ5</option>";

          echo "<option value='6.5' ";
          if ($timezone1 == "6.5"){ echo " selected"; }
          echo ">GMT +06:30 hrs - NST</option>";

          echo "<option value='7' ";
          if ($timezone1 == "7"){ echo " selected"; }
          echo ">GMT +07:00 hrs - SST or USZ6</option>";

          echo "<option value='7.5' ";
          if ($timezone1 == "7.5"){ echo " selected"; }
          echo ">GMT +07:30 hrs - JT</option>";

          echo "<option value='8' ";
          if ($timezone1 == "8"){ echo " selected"; }
          echo ">GMT +08:00 hrs - AWST or CCT</option>";

          echo "<option value='8.5' ";
          if ($timezone1 == "8.5"){ echo " selected"; }
          echo ">GMT +08:30 hrs - MT</option>";

          echo "<option value='9' ";
          if ($timezone1 == "9"){ echo " selected"; }
          echo ">GMT +09:00 hrs - JST or AWDT</option>";

          echo "<option value='9.5' ";
          if ($timezone1 == "9.5"){ echo " selected"; }
          echo ">GMT +09:30 hrs - ACST or SAT or SAST</option>";

          echo "<option value='10' ";
          if ($timezone1 == "10"){ echo " selected"; }
          echo ">GMT +10:00 hrs - AEST or GST</option>";

          echo "<option value='10.5' ";
          if ($timezone1 == "10.5"){ echo " selected"; }
          echo ">GMT +10:30 hrs - ACDT or SDT or SAD</option>";

          echo "<option value='11' ";
          if ($timezone1 == "11"){ echo " selected"; }
          echo ">GMT +11:00 hrs - UZ10 or AEDT</option>";

          echo "<option value='11.5' ";
          if ($timezone1 == "11.5"){ echo " selected"; }
          echo ">GMT +11:30 hrs - NZ</option>";

          echo "<option value='12' ";
          if ($timezone1 == "12"){ echo " selected"; }
          echo ">GMT +12:00 hrs - NZT or IDLE</option>";

          echo "<option value='12.5' ";
          if ($timezone1 == "12.5"){ echo " selected"; }
          echo ">GMT +12:30 hrs - NZS</option>";

          echo "<option value='13' ";
          if ($timezone1 == "13"){ echo " selected"; }
          echo ">GMT +13:00 hrs - NZST</option>";
          ?>
        </select>

        <br>

        <font color="#0000ff">
        (example: Chicago is "GMT -06:00 hrs" (standard time), Paris is "GMT +01:00 hrs" (standard time).<br>
        Add 1 hour if Daylight Saving was in effect when you were born (select next time zone down in the list).
        <br><br>
        </font>
      </TD>
    </TR>

    <TR>
      <td valign="top"><P align="right">Longitude #1:</P></td>
      <TD>
        <INPUT maxlength="3" size="3" name="long_deg1" value="<?php echo $long_deg1; ?>">
        <select name="ew1">
          <?php
          if ($ew1 == "-1")
          {
            echo "<option value='-1' selected>W </option>";
            echo "<option value='1'>E </option>";
          }
          elseif ($ew1 == "1")
          {
            echo "<option value='-1'>W </option>";
            echo "<option value='1' selected>E </option>";
          }
          else
          {
            echo "<option value='' selected>Select</option>";
            echo "<option value='-1'>W </option>";
            echo "<option value='1'>E </option>";
          }
          ?>
        </select>

        <INPUT maxlength="2" size="2" name="long_min1" value="<?php echo $long_min1; ?>">
        <font color="#0000ff">
        (example: Chicago is 87 W 39, Sydney is 151 E 13)
        </font>
      </TD>
    </TR>

    <TR>
      <td valign="top"><P align="right">Latitude #1:</P></td>

      <TD>
        <INPUT maxlength="2" size="3" name="lat_deg1" value="<?php echo $lat_deg1; ?>">
        <select name="ns1">
          <?php
          if ($ns1 == "1")
          {
            echo "<option value='1' selected>N </option>";
            echo "<option value='-1'>S </option>";
          }
          elseif ($ns1 == "-1")
          {
            echo "<option value='1'>N </option>";
            echo "<option value='-1' selected>S </option>";
          }
          else
          {
            echo "<option value='' selected>Select</option>";
            echo "<option value='1'>N </option>";
            echo "<option value='-1'>S </option>";
          }
          ?>
        </select>

        <INPUT maxlength="2" size="2" name="lat_min1" value="<?php echo $lat_min1; ?>">
        <font color="#0000ff">
        (example: Chicago is 41 N 51, Sydney is 33 S 52)
        </font>
        <br><br>
      </TD>
    </TR>
  </table>

  <br><hr>

  <table style="font-size:12px;">
    <TR>
      <TD>
        <P align="right"><font size="+1" color="#0000ff"><b>Person</b></font></P>
      </TD>

      <TD>
        <P align="left"><font size="+1" color="#0000ff"><b>#2</b></font></P>
      </TD>
    </TR>

    <TR>
      <TD>
        <P align="right">Name #2:</P>
      </TD>

      <TD>
        <INPUT size="40" name="name2" value="<?php echo $name2; ?>">
        <font color="#0000ff">
        (do not use your full name if you do want want the world to see it)
        </font>
      </TD>
    </TR>

    <TR>
      <TD>
        <P align="right">Birth date #2:</P>
      </TD>

      <TD>
        <?php
        echo '<select name="month2">';
        foreach ($months as $key => $value)
        {
          echo "<option value=\"$key\"";
          if ($key == $month2)
          {
            echo ' selected="selected"';
          }
          echo ">$value</option>\n";
        }
        echo '</select>';
        ?>

        <INPUT size="2" maxlength="2" name="day2" value="<?php echo $day2; ?>">
        <b>,</b>&nbsp;
        <INPUT size="4" maxlength="4" name="year2" value="<?php echo $year2; ?>">
         <font color="#0000ff">
        (only years from 1900 through 2099 are valid)
        </font>
      </TD>
    </TR>

    <TR>
      <td valign="top"><P align="right">Birth time #2:</P></td>
      <TD>
        <INPUT maxlength="2" size="2" name="hour2" value="<?php echo $hour2; ?>">
        <b>:</b>
        <INPUT maxlength="2" size="2" name="minute2" value="<?php echo $minute2; ?>">

        <br>

        <font color="#0000ff">
        (please give time of birth in 24 hour format. If your birth time is unknown, please enter 12:00)<br>
        (if you were born EXACTLY at 12:00, then please enter 11:59 or 12:01 ? 12:00 is reserved for unknown birth times only)
        <br><br>
        </font>
      </TD>
    </TR>

    <TR>
      <td valign="top">
        <P align="right"><font color="#ff0000">
        <b>IMPORTANT</b>
        </font></P>
      </td>

      <td>
        <font color="#ff0000">
        <b>NOTICE:</b>
        </font>
        <b>&nbsp;&nbsp;West longitudes are MINUS time zones.&nbsp;&nbsp;East longitudes are PLUS time zones.</b>
      </td>
    </TR>

    <TR>
      <td valign="top"><P align="right">Time zone #2:</P></td>

      <TD>
        <select name="timezone2" size="1">
          <?php
          echo "<option value='' ";
          if ($timezone2 == ""){ echo " selected"; }
          echo "> Select Time Zone </option>";

          echo "<option value='-12' ";
          if ($timezone2 == "-12"){ echo " selected"; }
          echo ">GMT -12:00 hrs - IDLW</option>";

          echo "<option value='-11' ";
          if ($timezone2 == "-11"){ echo " selected"; }
          echo ">GMT -11:00 hrs - BET or NT</option>";

          echo "<option value='-10.5' ";
          if ($timezone2 == "-10.5"){ echo " selected"; }
          echo ">GMT -10:30 hrs - HST</option>";

          echo "<option value='-10' ";
          if ($timezone2 == "-10"){ echo " selected"; }
          echo ">GMT -10:00 hrs - AHST</option>";

          echo "<option value='-9.5' ";
          if ($timezone2 == "-9.5"){ echo " selected"; }
          echo ">GMT -09:30 hrs - HDT or HWT</option>";

          echo "<option value='-9' ";
          if ($timezone2 == "-9"){ echo " selected"; }
          echo ">GMT -09:00 hrs - YST or AHDT or AHWT</option>";

          echo "<option value='-8' ";
          if ($timezone2 == "-8"){ echo " selected"; }
          echo ">GMT -08:00 hrs - PST or YDT or YWT</option>";

          echo "<option value='-7' ";
          if ($timezone2 == "-7"){ echo " selected"; }
          echo ">GMT -07:00 hrs - MST or PDT or PWT</option>";

          echo "<option value='-6' ";
          if ($timezone2 == "-6"){ echo " selected"; }
          echo ">GMT -06:00 hrs - CST or MDT or MWT</option>";

          echo "<option value='-5' ";
          if ($timezone2 == "-5"){ echo " selected"; }
          echo ">GMT -05:00 hrs - EST or CDT or CWT</option>";

          echo "<option value='-4' ";
          if ($timezone2 == "-4"){ echo " selected"; }
          echo ">GMT -04:00 hrs - AST or EDT or EWT</option>";

          echo "<option value='-3.5' ";
          if ($timezone2 == "-3.5"){ echo " selected"; }
          echo ">GMT -03:30 hrs - NST</option>";

          echo "<option value='-3' ";
          if ($timezone2 == "-3"){ echo " selected"; }
          echo ">GMT -03:00 hrs - BZT2 or AWT</option>";

          echo "<option value='-2' ";
          if ($timezone2 == "-2"){ echo " selected"; }
          echo ">GMT -02:00 hrs - AT</option>";

          echo "<option value='-1' ";
          if ($timezone2 == "-1"){ echo " selected"; }
          echo ">GMT -01:00 hrs - WAT</option>";

          echo "<option value='0' ";
          if ($timezone2 == "0"){ echo " selected"; }
          echo ">Greenwich Mean Time - GMT or UT</option>";

          echo "<option value='1' ";
          if ($timezone2 == "1"){ echo " selected"; }
          echo ">GMT +01:00 hrs - CET or MET or BST</option>";

          echo "<option value='2' ";
          if ($timezone2 == "2"){ echo " selected"; }
          echo ">GMT +02:00 hrs - EET or CED or MED or BDST or BWT</option>";

          echo "<option value='3' ";
          if ($timezone2 == "3"){ echo " selected"; }
          echo ">GMT +03:00 hrs - BAT or EED</option>";

          echo "<option value='3.5' ";
          if ($timezone2 == "3.5"){ echo " selected"; }
          echo ">GMT +03:30 hrs - IT</option>";

          echo "<option value='4' ";
          if ($timezone2 == "4"){ echo " selected"; }
          echo ">GMT +04:00 hrs - USZ3</option>";

          echo "<option value='5' ";
          if ($timezone2 == "5"){ echo " selected"; }
          echo ">GMT +05:00 hrs - USZ4</option>";

          echo "<option value='5.5' ";
          if ($timezone2 == "5.5"){ echo " selected"; }
          echo ">GMT +05:30 hrs - IST</option>";

          echo "<option value='6' ";
          if ($timezone2 == "6"){ echo " selected"; }
          echo ">GMT +06:00 hrs - USZ5</option>";

          echo "<option value='6.5' ";
          if ($timezone2 == "6.5"){ echo " selected"; }
          echo ">GMT +06:30 hrs - NST</option>";

          echo "<option value='7' ";
          if ($timezone2 == "7"){ echo " selected"; }
          echo ">GMT +07:00 hrs - SST or USZ6</option>";

          echo "<option value='7.5' ";
          if ($timezone2 == "7.5"){ echo " selected"; }
          echo ">GMT +07:30 hrs - JT</option>";

          echo "<option value='8' ";
          if ($timezone2 == "8"){ echo " selected"; }
          echo ">GMT +08:00 hrs - AWST or CCT</option>";

          echo "<option value='8.5' ";
          if ($timezone2 == "8.5"){ echo " selected"; }
          echo ">GMT +08:30 hrs - MT</option>";

          echo "<option value='9' ";
          if ($timezone2 == "9"){ echo " selected"; }
          echo ">GMT +09:00 hrs - JST or AWDT</option>";

          echo "<option value='9.5' ";
          if ($timezone2 == "9.5"){ echo " selected"; }
          echo ">GMT +09:30 hrs - ACST or SAT or SAST</option>";

          echo "<option value='10' ";
          if ($timezone2 == "10"){ echo " selected"; }
          echo ">GMT +10:00 hrs - AEST or GST</option>";

          echo "<option value='10.5' ";
          if ($timezone2 == "10.5"){ echo " selected"; }
          echo ">GMT +10:30 hrs - ACDT or SDT or SAD</option>";

          echo "<option value='11' ";
          if ($timezone2 == "11"){ echo " selected"; }
          echo ">GMT +11:00 hrs - UZ10 or AEDT</option>";

          echo "<option value='11.5' ";
          if ($timezone2 == "11.5"){ echo " selected"; }
          echo ">GMT +11:30 hrs - NZ</option>";

          echo "<option value='12' ";
          if ($timezone2 == "12"){ echo " selected"; }
          echo ">GMT +12:00 hrs - NZT or IDLE</option>";

          echo "<option value='12.5' ";
          if ($timezone2 == "12.5"){ echo " selected"; }
          echo ">GMT +12:30 hrs - NZS</option>";

          echo "<option value='13' ";
          if ($timezone2 == "13"){ echo " selected"; }
          echo ">GMT +13:00 hrs - NZST</option>";
          ?>
        </select>

        <br>

        <font color="#0000ff">
        (example: Chicago is "GMT -06:00 hrs" (standard time), Paris is "GMT +01:00 hrs" (standard time).<br>
        Add 1 hour if Daylight Saving was in effect when you were born (select next time zone down in the list).
        <br><br>
        </font>
      </TD>
    </TR>

    <TR>
      <td valign="top"><P align="right">Longitude #2:</P></td>
      <TD>
        <INPUT maxlength="3" size="3" name="long_deg2" value="<?php echo $long_deg2; ?>">
        <select name="ew2">
          <?php
          if ($ew2 == "-1")
          {
            echo "<option value='-1' selected>W </option>";
            echo "<option value='1'>E </option>";
          }
          elseif ($ew2 == "1")
          {
            echo "<option value='-1'>W </option>";
            echo "<option value='1' selected>E </option>";
          }
          else
          {
            echo "<option value='' selected>Select</option>";
            echo "<option value='-1'>W </option>";
            echo "<option value='1'>E </option>";
          }
          ?>
        </select>

        <INPUT maxlength="2" size="2" name="long_min2" value="<?php echo $long_min2; ?>">
        <font color="#0000ff">
        (example: Chicago is 87 W 39, Sydney is 151 E 13)
        </font>
      </TD>
    </TR>

    <TR>
      <td valign="top"><P align="right">Latitude #2:</P></td>

      <TD>
        <INPUT maxlength="2" size="3" name="lat_deg2" value="<?php echo $lat_deg2; ?>">
        <select name="ns2">
          <?php
          if ($ns2 == "1")
          {
            echo "<option value='1' selected>N </option>";
            echo "<option value='-1'>S </option>";
          }
          elseif ($ns2 == "-1")
          {
            echo "<option value='1'>N </option>";
            echo "<option value='-1' selected>S </option>";
          }
          else
          {
            echo "<option value='' selected>Select</option>";
            echo "<option value='1'>N </option>";
            echo "<option value='-1'>S </option>";
          }
          ?>
        </select>

        <INPUT maxlength="2" size="2" name="lat_min2" value="<?php echo $lat_min2; ?>">
        <font color="#0000ff">
        (example: Chicago is 41 N 51, Sydney is 33 S 52)
        </font>
        <br><br>
      </TD>
    </TR>
  </table>

  <br />

  <center>
  <font color="#ff0000"><b>Most people mess up the time zone selection. Please make sure your selection is correct.</b></font><br><br>
  <input type="hidden" name="submitted" value="TRUE">
  <INPUT type="submit" name="submit" value="Submit data (AFTER DOUBLE-CHECKING IT FOR ERRORS)" align="middle" style="background-color:#66ff66;color:#000000;font-size:16px;font-weight:bold">
  </center>

  <br>
  </fieldset>
</form>

<?php
include ('footer.html');


Function left($leftstring, $leftlength)
{
  return(substr($leftstring, 0, $leftlength));
}


Function Reduce_below_30($longitude)
{
  $lng = $longitude;

  while ($lng >= 30)
  {
    $lng = $lng - 30;
  }

  return $lng;
}


Function Convert_Longitude($longitude)
{
  $signs = array (0 => 'Ari', 'Tau', 'Gem', 'Can', 'Leo', 'Vir', 'Lib', 'Sco', 'Sag', 'Cap', 'Aqu', 'Pis');

  $sign_num = floor($longitude / 30);
  $pos_in_sign = $longitude - ($sign_num * 30);
  $deg = floor($pos_in_sign);
  $full_min = ($pos_in_sign - $deg) * 60;
  $min = floor($full_min);
  $full_sec = round(($full_min - $min) * 60);

  if ($deg < 10)
  {
    $deg = "0" . $deg;
  }

  if ($min < 10)
  {
    $min = "0" . $min;
  }

  if ($full_sec < 10)
  {
    $full_sec = "0" . $full_sec;
  }

  return $deg . " " . $signs[$sign_num] . " " . $min . "' " . $full_sec . chr(34);
}


Function mid($midstring, $midstart, $midlength)
{
  return(substr($midstring, $midstart-1, $midlength));
}


Function safeEscapeString($inp)
{
  if(is_array($inp))
    return array_map(__METHOD__, $inp);

// replace HTML tags '<>' with '[]'
  $temp1 = str_replace("<", "[", $inp);
  $temp2 = str_replace(">", "]", $temp1);

// but keep <br> or <br />
// turn <br> into <br /> so later it will be turned into ""
// using just <br> will add extra blank lines
  $temp1 = str_replace("[br]", "<br />", $temp2);
  $temp2 = str_replace("[br /]", "<br />", $temp1);

  if(!empty($temp2) && is_string($temp2))
  {
    return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $temp2);
  }

  return $temp2;
}


Function Find_Specific_Report_Paragraph($phrase_to_look_for, $file)
{
  $string = "";
  $len = strlen($phrase_to_look_for);

  //put entire file contents into an array, line by line
  $file_array = file($file);

  // look through each line searching for $phrase_to_look_for
  for($i = 0; $i < count($file_array); $i++)
  {
    if (left(trim($file_array[$i]), $len) == $phrase_to_look_for)
    {
      $flag = 0;
      while (trim($file_array[$i]) != "*")
      {
        if ($flag == 0)
        {
          $string .= "<b>" . $file_array[$i] . "</b>";
        }
        else
        {
          $string .= $file_array[$i];
        }
        $flag = 1;
        $i++;
      }
      break;
    }
  }

  return $string;
}

?>
