<?php
$months = array( 0 => 'Ay Seç', 'Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık' );
$my_error = "";
$TimeZoneTag = "";

// check if the form has been submitted //bu kısım ile formdaki değerleri al
if ( isset( $_POST[ 'submitted' ] )Or isset( $_POST[ 'h_sys_submitted' ] ) ) {
	// get all variables from form
	$h_sys = safeEscapeString( $_POST[ "h_sys" ] );
	$name = safeEscapeString( $_POST[ "name" ] );
	$lokasyon = safeEscapeString( $_POST[ "lokasyon" ] );

	$month = safeEscapeString( $_POST[ "month" ] );
	$day = safeEscapeString( $_POST[ "day" ] );
	$year = safeEscapeString( $_POST[ "year" ] );

	$hour = safeEscapeString( $_POST[ "hour" ] );
	$minute = safeEscapeString( $_POST[ "minute" ] );

	$timezone = safeEscapeString( $_POST[ "timezone" ] );

	$long_deg = safeEscapeString( $_POST[ "long_deg" ] );
	$long_min = safeEscapeString( $_POST[ "long_min" ] );
	$ew = safeEscapeString( $_POST[ "ew" ] );

	$lat_deg = safeEscapeString( $_POST[ "lat_deg" ] );
	$lat_min = safeEscapeString( $_POST[ "lat_min" ] );
	$ns = safeEscapeString( $_POST[ "ns" ] );

	$TimeZoneTag = safeEscapeString( $_POST[ "TimeZoneTag" ] );

	// set cookie containing natal data here
	//setcookie( 'name', stripslashes( $name ), time() + 60 * 60 * 24 * 30, '/', '', 0 );

	//setcookie( 'month', $month, time() + 60 * 60 * 24 * 30, '/', '', 0 );
	//setcookie( 'day', $day, time() + 60 * 60 * 24 * 30, '/', '', 0 );
	//setcookie( 'year', $year, time() + 60 * 60 * 24 * 30, '/', '', 0 );

	//setcookie( 'hour', $hour, time() + 60 * 60 * 24 * 30, '/', '', 0 );
	//setcookie( 'minute', $minute, time() + 60 * 60 * 24 * 30, '/', '', 0 );

	//setcookie( 'lokasyon', $lokasyon, time() + 60 * 60 * 24 * 30, '/', '', 0 );

	//setcookie ('timezone', $timezone, time() + 60 * 60 * 24 * 30, '/', '', 0);

	//setcookie ('long_deg', $long_deg, time() + 60 * 60 * 24 * 30, '/', '', 0);
	//setcookie ('long_min', $long_min, time() + 60 * 60 * 24 * 30, '/', '', 0);
	//setcookie ('ew', $ew, time() + 60 * 60 * 24 * 30, '/', '', 0);

	//setcookie ('lat_deg', $lat_deg, time() + 60 * 60 * 24 * 30, '/', '', 0);
	//setcookie ('lat_min', $lat_min, time() + 60 * 60 * 24 * 30, '/', '', 0);
	//setcookie ('ns', $ns, time() + 60 * 60 * 24 * 30, '/', '', 0);

	include( 'header_natal.html' ); //here because of setting cookies above

	include( "lib/validation_class.php" );

	//error check
	$my_form = new Validate_fields;

	$my_form->check_4html = true;

	$my_form->add_text_field( "Name", $name, "text", "y", 40 );

	//$my_form->add_text_field( "Lokasyon", $lokasyon, "text", "y", 40 );

	$my_form->add_text_field( "Month", $month, "text", "y", 2 );
	$my_form->add_text_field( "Day", $day, "text", "y", 2 );
	$my_form->add_text_field( "Year", $year, "text", "y", 4 );

	$my_form->add_text_field( "Hour", $hour, "text", "y", 2 );
	$my_form->add_text_field( "Minute", $minute, "text", "y", 2 );

	$my_form->add_text_field( "Doğum Yeri bulunamadı yada ", $timezone, "text", "y", 4 );

	//$my_form->add_text_field("Longitude degree", $long_deg, "text", "y", 3);
	//$my_form->add_text_field("Longitude minute", $long_min, "text", "y", 2);
	//$my_form->add_text_field("Longitude E/W", $ew, "text", "y", 2);

	//$my_form->add_text_field("Latitude degree", $lat_deg, "text", "y", 2);
	//$my_form->add_text_field("Latitude minute", $lat_min, "text", "y", 2);
	//$my_form->add_text_field("Latitude N/S", $ns, "text", "y", 2);

	// additional error checks on user-entered data
	if ( $month == 0 ) {
		$my_error .= "Ay Giriniz.<br>";
	}

	if ( $month != ""
		And $day != ""
		And $year != "" ) {
		if ( !$date = checkdate( settype( $month, "integer" ), settype( $day, "integer" ), settype( $year, "integer" ) ) ) {
			$my_error .= "Girdiğiniz tarih geçersizdir.<br>";
		}
	}

	if ( ( $year < 1900 )Or( $year >= 2100 ) ) {
		$my_error .= "Doğum yılı 1900 ile 2099 arasında olmalıdır.<br>";
	}

	if ( ( $hour < 0 )Or( $hour > 23 ) ) {
		$my_error .= "Girdiğiz doğum yeri bulunamadı.<br>";
	}

	if ( ( $minute < 0 )Or( $minute > 59 ) ) {
		$my_error .= "Girdiğiz doğum yeri bulunamadı.<br>";
	}

	if ( ( $long_deg < 0 )Or( $long_deg > 179 ) ) {
		$my_error .= "Girdiğiz doğum yeri bulunamadı.<br>";
	}

	if ( ( $long_min < 0 )Or( $long_min > 59 ) ) {
		$my_error .= "Girdiğiz doğum yeri bulunamadı.<br>";
	}

	if ( ( $lat_deg < 0 )Or( $lat_deg > 65 ) ) {
		$my_error .= "Girdiğiz doğum yeri bulunamadı.<br>";
	}

	if ( ( $lat_min < 0 )Or( $lat_min > 59 ) ) {
		$my_error .= "Girdiğiz doğum yeri bulunamadı.<br>";
	}

	if ( ( $ew == '-1' )And( $timezone > 2 ) ) {
		$my_error .= "Girdiğiz doğum yeri bulunamadı.<br>";
	}

	if ( ( $ew == '1' )And( $timezone < 0 ) ) {
		$my_error .= "Girdiğiz doğum yeri bulunamadı.<br>";
	}

	if ( $ew < 0 ) {
		$ew_txt = "w";
	} else {
		$ew_txt = "e";
	}

	if ( $ns > 0 ) {
		$ns_txt = "n";
	} else {
		$ns_txt = "s";
	}

	$validation_error = $my_form->validation();

	if ( ( !$validation_error ) || ( $my_error != "" ) ) {
		echo "<font color='#c020c0'";
		echo "<br>Girişleriniz hatalı kontrol ediniz";
		echo "</font>";
	} else {
		// no errors in filling out form, so process form
		// calculate astronomic data
		$swephsrc = 'sweph';
		$sweph = 'sweph';

		// Unset any variables not initialized elsewhere in the program
		unset( $PATH, $out, $pl_name, $longitude1, $house_pos );


		//DST UYGULAMASI EKLE		);	

		$dstStart = array( "1916-05-01 01:00", "1920-03-28 01:00", "1921-04-03 02:00", "1922-03-26 02:00", "1923-04-28 02:00", "1940-06-30 00:00", "1940-10-30 00:00", "1942-03-31 00:00", "1946-06-01 00:00", "1947-04-19 00:00", "1948-04-17 00:00", "1949-04-09 00:00", "1950-04-15 00:00", "1951-04-21 00:00", "1962-07-14 00:00", "1964-05-14 00:00", "1973-06-02 01:00", "1974-03-31 02:00", "1975-03-22 02:00", "1976-03-21 02:00", "1977-04-03 02:00", "1978-04-02 02:00", "1983-07-31 02:00", "1983-10-02 02:00", "1985-04-20 01:00", "1986-03-30 01:00", "1987-03-30 01:00", "1988-03-27 01:00", "1989-03-26 01:00", "1990-03-25 01:00", "1991-03-31 01:00", "1992-03-29 01:00", "1993-03-28 01:00", "1994-03-20 01:00", "1995-03-26 01:00", "1996-03-31 01:00", "1997-03-30 01:00", "1998-03-29 01:00", "1999-03-28 01:00", "2000-03-26 01:00", "2001-03-25 01:00", "2002-03-31 01:00", "2003-03-30 01:00", "2004-03-28 01:00", "2005-03-27 01:00", "2006-03-26 01:00", "2007-03-25 03:00", "2008-03-30 03:00", "2009-03-29 03:00", "2010-03-28 03:00", "2011-03-28 04:00", "2012-03-25 03:00", "2013-03-31 03:00", "2014-03-31 03:00", "2015-03-29 03:00", "2016-03-28 03:00" );
		$gDSTon = array( 3,	3,	3,	3,	3,	3,	4,	3,	3,	3,	3,	3,	3,	3,	3,	3,	3,	3,	3,	3,	3,	3,	4,	3,	3,	3,	3,	3,	3,	3,	3,	3,	3,	3,	3,	3,	3,	3,	3,	3,	3,	3,	3,	3,	3,	3,	3,	3,	3,	3,	3,	3,	3,	3,	3,	3 );
		$dstEnds = array( "1916-10-01 01:59", "1920-10-27 01:59", "1921-10-03 01:59", "1922-10-08 01:59", "1923-09-16 01:59", "1940-10-05 23:59", "1941-09-20 23:59", "1945-10-07 23:59", "1946-09-30 23:59", "1947-10-04 23:59", "1948-10-02 23:59", "1949-10-01 23:59", "1950-10-07 23:59", "1951-10-06 23:59", "1963-10-29 23:59", "1964-09-30 00:00", "1973-11-04 00:00", "1974-11-03 00:00", "1975-11-02 00:00", "1976-10-31 02:00", "1977-10-16 02:00", "1983-07-31 01:59", "1983-10-02 02:00", "1984-11-01 02:00", "1985-09-28 02:00", "1986-09-28 02:00", "1987-09-27 02:00", "1988-09-25 02:00", "1989-09-24 02:00", "1990-09-30 02:00", "1991-09-29 02:00", "1992-09-27 02:00", "1993-09-26 02:00", "1994-09-25 02:00", "1995-09-24 02:00", "1996-10-27 02:00", "1997-10-26 02:00", "1998-10-25 02:00", "1999-10-31 02:00", "2000-10-29 02:00", "2001-10-28 02:00", "2002-10-27 02:00", "2003-10-26 02:00", "2004-10-31 02:00", "2005-10-30 02:00", "2006-10-29 02:00", "2007-10-28 04:00", "2008-10-26 04:00", "2009-10-25 04:00", "2010-10-31 04:00", "2011-10-30 04:00", "2012-10-28 04:00", "2013-10-27 04:00", "2014-10-26 04:00", "2015-11-08 04:00" );
		$gDSToff = array( 2, 2, 2, 2, 2, 2, 3, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 3, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2 );

		mktime( $hour, $minute, $secs, $month, $day, $year );

		$orgTimeStamp = mktime( $hour, $minute, $secs, $month, $day, $year );
		$debugTxt = "no data";
		
		$currentDate = new datetime ($year . "-" . $month . "-" . $day . " " . $hour . ":" .$minute); // iş üstünde date time???		
			
		if ( $TimeZoneTag == "Europe/Istanbul" ) {

			$timezone = 2;		
			
			$firstDate = new datetime ($dstStart[ 0 ]);				
			if ( $firstDate > $currentDate ) {
				$timezone = 2;
				//echo "first " . $firstDate->format("Y-m-d H:i") . ">" . $currentDate->format("Y-m-d H:i") . "<br>";
			}

			for ( $i = 0; $i < 55; $i++ ) {
				
				$beforeDate = new datetime ($dstStart[ $i ]);
				$afterDate = new datetime ($dstEnds[ $i ]);		
				if ( $beforeDate <= $currentDate && $currentDate <= $afterDate ) {
					$timezone = $gDSTon[ $i ];
					$isDST = 1;
					//echo $i . "-1 ->" . $beforeDate->format("Y-m-d H:i") . "<" . $currentDate->format("Y-m-d H:i") . "<" . $afterDate->format("Y-m-d H:i") . "<br>";
				}
				
				$beforeDate = new datetime ($dstEnds[ $i ]);
				$afterDate = new datetime ($dstStart[ $i + 1 ]);
				if ( $beforeDate  < $currentDate && $currentDate <= $afterDate ) {
					$timezone = $gDSToff[ $i ];
					$isDST = 0;
					//echo $i . "-2 ->" . $beforeDate->format("Y-m-d H:i") . "<" . $currentDate->format("Y-m-d H:i") . "<" . $afterDate->format("Y-m-d H:i") . "<br>";
				}
			}
			
			$lastDate = new datetime ($dstStart[ 55 ]);
			if ( $currentDate >= $lastDate ) {
				$timezone = 3;
				$isDST = 1;
				//echo "last" . $firstDate->format("Y-m-d h:m") . "<br>";
			}

		} else {
			$isDST = date( "I", $datetime1 );
			$timezone = $isDST + $timezone;
			//$debugTxt = "YURDIŞI";
		}
		
		if ( $isDST == 0 ) {
			$isDSTmsg = "";
		} else {
			$isDSTmsg = " (ileri Saat ile)";
		}
		//DST UYGULAMASI EKLE

		if ( $timezone < 0 ) {
			$tz = $timezone;
		} else {
			$tz = "+" . $timezone;
		}



		//DST AYAYI YAPILACAK KISIM BİTTİ

		//assign data from database to local variables
		// kısımda saati gmt 0 zonuna çekiyor.
		$inmonth = $month;
		$inday = $day;
		$inyear = $year;

		$inhours = $hour;
		$inmins = $minute;
		$insecs = "0";

		$intz = $timezone;

		$my_longitude = $ew * ( $long_deg + ( $long_min / 60 ) );
		$my_latitude = $ns * ( $lat_deg + ( $lat_min / 60 ) );

		if ( $intz >= 0 ) {
			$whole = floor( $intz );
			$fraction = $intz - floor( $intz );
		} else {
			$whole = ceil( $intz );
			$fraction = $intz - ceil( $intz );
		}

		$inhours = $inhours - $whole;
		$inmins = $inmins - ( $fraction * 60 );

		//zaman ayarı


		// adjust date and time for minus hour due to time zone taking the hour negative
		$utdatenow = strftime( "%d.%m.%Y", mktime( $inhours, $inmins, $insecs, $inmonth, $inday, $inyear ) );
		$utnow = strftime( "%H:%M:%S", mktime( $inhours, $inmins, $insecs, $inmonth, $inday, $inyear ) );

		putenv( "PATH=$PATH:$swephsrc" );

		$h_sys = "r";

		// get LAST_PLANET planets and all house cusps
		if ( strlen( $h_sys ) != 1 ) {
			$h_sys = "r";
		}

		exec( "swetest -edir$sweph -b$utdatenow -ut$utnow -p0123456789DAttt -eswe -house$my_longitude,$my_latitude,$h_sys -flsj -g, -head", $out );

		// Each line of output data from swetest is exploded into array $row, giving these elements:
		// 0 = longitude
		// 1 = speed
		// 2 = house position
		// planets are index 0 - index (LAST_PLANET), house cusps are index (LAST_PLANET + 1) - (LAST_PLANET + 12)
		foreach ( $out as $key => $line ) {
			$row = explode( ',', $line );
			$longitude1[ $key ] = $row[ 0 ];
			$speed1[ $key ] = $row[ 1 ];
			$house_pos1[ $key ] = $row[ 2 ];
		};


		include( "lib/constants.php" ); // this is here because we must rename the planet names


		//calculate the Part of Fortune
		//is this a day chart or a night chart?
		if ( $longitude1[ LAST_PLANET + 1 ] > $longitude1[ LAST_PLANET + 7 ] ) {
			if ( $longitude1[ 0 ] <= $longitude1[ LAST_PLANET + 1 ]And $longitude1[ 0 ] > $longitude1[ LAST_PLANET + 7 ] ) {
				$day_chart = True;
			} else {
				$day_chart = False;
			}
		} else {
			if ( $longitude1[ 0 ] > $longitude1[ LAST_PLANET + 1 ]And $longitude1[ 0 ] <= $longitude1[ LAST_PLANET + 7 ] ) {
				$day_chart = False;
			} else {
				$day_chart = True;
			}
		}

		if ( $day_chart == True ) {
			$longitude1[ SE_POF ] = $longitude1[ LAST_PLANET + 1 ] + $longitude1[ 1 ] - $longitude1[ 0 ];
		} else {
			$longitude1[ SE_POF ] = $longitude1[ LAST_PLANET + 1 ] - $longitude1[ 1 ] + $longitude1[ 0 ];
		}

		if ( $longitude1[ SE_POF ] >= 360 ) {
			$longitude1[ SE_POF ] = $longitude1[ SE_POF ] - 360;
		}

		if ( $longitude1[ SE_POF ] < 0 ) {
			$longitude1[ SE_POF ] = $longitude1[ SE_POF ] + 360;
		}

		//add a planet - maybe some code needs to be put here

		//capture the Vertex longitude
		$longitude1[ LAST_PLANET ] = $longitude1[ LAST_PLANET + 16 ]; //Asc = +13, MC = +14, RAMC = +15, Vertex = +16


		//get house positions of planets here
		for ( $x = 1; $x <= 12; $x++ ) {
			for ( $y = 0; $y <= LAST_PLANET; $y++ ) {
				$pl = $longitude1[ $y ] + ( 1 / 36000 );
				if ( $x < 12 And $longitude1[ $x + LAST_PLANET ] > $longitude1[ $x + LAST_PLANET + 1 ] ) {
					If( ( $pl >= $longitude1[ $x + LAST_PLANET ]And $pl < 360 )Or( $pl < $longitude1[ $x + LAST_PLANET + 1 ]And $pl >= 0 ) ) {
						$house_pos1[ $y ] = $x;
						continue;
					}
				}

				if ( $x == 12 And( $longitude1[ $x + LAST_PLANET ] > $longitude1[ LAST_PLANET + 1 ] ) ) {
					if ( ( $pl >= $longitude1[ $x + LAST_PLANET ]And $pl < 360 )Or( $pl < $longitude1[ LAST_PLANET + 1 ]And $pl >= 0 ) ) {
						$house_pos1[ $y ] = $x;
					}
					continue;
				}

				if ( ( $pl >= $longitude1[ $x + LAST_PLANET ] )And( $pl < $longitude1[ $x + LAST_PLANET + 1 ] )And( $x < 12 ) ) {
					$house_pos1[ $y ] = $x;
					continue;
				}

				if ( ( $pl >= $longitude1[ $x + LAST_PLANET ] )And( $pl < $longitude1[ LAST_PLANET + 1 ] )And( $x == 12 ) ) {
					$house_pos1[ $y ] = $x;
				}
			}
		}
		?>
		<?php
		/*<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<input type="hidden" name="name" value="<?php echo $_POST['name']; ?>">
		<input type="hidden" name="month" value="<?php echo $_POST['month']; ?>">
		<input type="hidden" name="day" value="<?php echo $_POST['day']; ?>">
		<input type="hidden" name="year" value="<?php echo $_POST['year']; ?>">
		<input type="hidden" name="hour" value="<?php echo $_POST['hour']; ?>">
		<input type="hidden" name="minute" value="<?php echo $_POST['minute']; ?>">
		<input type="hidden" name="timezone" value="<?php echo $_POST['timezone']; ?>">
		<input type="hidden" name="TimeZoneTag" value="<?php echo $_POST['TimeZoneTag']; ?>">
		<input type="hidden" name="long_deg" value="<?php echo $_POST['long_deg']; ?>">
		<input type="hidden" name="long_min" value="<?php echo $_POST['long_min']; ?>">
		<input type="hidden" name="ew" value="<?php echo $_POST['ew']; ?>">
		<input type="hidden" name="lat_deg" value="<?php echo $_POST['lat_deg']; ?>">
		<input type="hidden" name="lat_min" value="<?php echo $_POST['lat_min']; ?>">
		<input type="hidden" name="ns" value="<?php echo $_POST['ns']; ?>">
		<input type="hidden" name="h_sys_submitted" value="TRUE">
		*/
		?>
		<center>
			<table cellspacing="5">
				<tr>
					<td colspan="2">
						<?php
						//display natal data					
						$restored_name = stripslashes( $name );
						echo "<center><font size='2'><b>Merhaba $restored_name </b></font>";
						$secs = "0";
						setlocale( LC_TIME, 'turkish' );
						echo '<font size="2"><b>' . iconv( 'latin5', 'utf-8', strftime( "%d %B %Y %X (GMT $tz) $isDSTmsg</b></font> ", mktime( $hour, $minute, $secs, $month, $day, $year ) ) );
						echo "<font size = '2'><b>" . $long_deg . $ew_txt . $long_min . ", " . $lat_deg . $ns_txt . $lat_min . "</b></font></center>";
						?>
					</td>
					<?php
					/*
									<tr>
										<td>
											<select name="h_sys" size="1">
												<?php
												echo "<option value='p' ";
												if ( $h_sys == "p" ) {
													echo " seçildi";
												}
												echo "> Placidus </option>";

												echo "<option value='k' ";
												if ( $h_sys == "k" ) {
													echo " selected";
												}
												echo "> Koch </option>";

												echo "<option value='r' ";
												if ( $h_sys == "r" ) {
													echo " selected";
												}
												echo "> Regiomontanus </option>";

												echo "<option value='c' ";
												if ( $h_sys == "c" ) {
													echo " selected";
												}
												echo "> Campanus </option>";

												echo "<option value='b' ";
												if ( $h_sys == "b" ) {
													echo " selected";
												}
												echo "> Alcabitus </option>";

												echo "<option value='o' ";
												if ( $h_sys == "o" ) {
													echo " selected";
												}
												echo "> Porphyrius </option>";

												echo "<option value='m' ";
												if ( $h_sys == "m" ) {
													echo " selected";
												}
												echo "> Morinus </option>";

												echo "<option value='a' ";
												if ( $h_sys == "a" ) {
													echo " selected";
												}
												echo "> Equal house - Asc </option>";

												echo "<option value='t' ";
												if ( $h_sys == "t" ) {
													echo " selected";
												}
												echo "> Topocentric </option>";

												echo "<option value='v' ";
												if ( $h_sys == "v" ) {
													echo " selected";
												}
												echo "> Vehlow </option>";
												?>
					</select>
					</td>
					<td>
						<INPUT type="submit" name="submit" value="Değiştir" align="middle" style="background-color:#66ff66;color:#000000;font-size:16px;font-weight:bold">
					</td>
				</tr>
				</form>
				*/ ?>
			</table>
		</center>

		<?php

		$hr_ob = $hour;
		$min_ob = $minute;

		$ubt1 = 0;
		if ( ( $hr_ob == 12 )And( $min_ob == 0 ) ) {
			$ubt1 = 1; // this person has an unknown birth time
		}

		$ubt2 = $ubt1;

		$rx1 = "";
		for ( $i = 0; $i <= SE_TNODE; $i++ ) {
			if ( $speed1[ $i ] < 0 ) {
				$rx1 .= "R";
			} else {
				$rx1 .= " ";
			}
		}

		$rx2 = $rx1;

		for ( $i = 1; $i <= LAST_PLANET; $i++ ) {
			$hc1[ $i ] = $longitude1[ LAST_PLANET + $i ];
		}

		// no need to urlencode unless perhaps magic quotes is ON (??)
		$ser_L1 = serialize( $longitude1 );
		$ser_L2 = serialize( $longitude1 );
		$ser_hc1 = serialize( $hc1 );
		$ser_hpos = serialize( $house_pos1 );

		echo "<center>";
		//echo "<img border='0' src='chartwheel_natal_line.php?rx1=$rx1&rx2=$rx2&p1=$ser_L1&p2=$ser_L2&hc1=$ser_hc1&ubt1=$ubt1&ubt2=$ubt2' width='730' height='400'>";
		//echo "<img border='0' src='natal_wheel_2.php?rx1=$rx1&rx2=$rx2&p1=$ser_L1&p2=$ser_L2&hc1=$ser_hc1&ubt1=$ubt1&ubt2=$ubt2&hpos=$ser_hpos' width='640' height='640'>";
		echo "<img border='0' src='lib/natal_wheel_2.php?rx1=$rx1&p1=$ser_L1&hc1=$ser_hc1&hpos=$ser_hpos' width='600' height='600'>";
		echo "<br><br>";
		echo "<img border='0' src='lib/natal_aspect_grid.php?rx1=$rx1&rx2=$rx2&p1=$ser_L1&p2=$ser_L2&hc1=$ser_hc1&ubt1=$ubt1&ubt2=$ubt2' width='705' height='450'>";
		echo "</center>";
		echo "<br>";

		//display natal data
		echo '<center><table width="30%" name="raporTablosu" id="raporTablosu" cellpadding="0" cellspacing="5">', "\n";

		echo '<tr>';
		echo "<td><font color='#0000ff'><b>&nbsp&nbsp&nbsp&nbspGezegen </b></font></td>";
		echo "<td><font color='#0000ff'><b> Boylam </b></font></td>";
		if ( $ubt1 == 1 ) {
			echo "<td>&nbsp;</td>";
		} else {
			echo "<td><font color='#0000ff'><b>Pozisyon</b></font></td>";
		}
		echo '</tr>';

		if ( $ubt1 == 1 ) {
			$a1 = SE_TNODE;
		} else {
			$a1 = LAST_PLANET;
		}

		for ( $i = 0; $i <= $a1; $i++ ) {
			echo '<tr>';
			echo "<td>&nbsp&nbsp&nbsp&nbsp" . $pl_name[ $i ] . "</td>";
			echo "<td>" . Convert_Longitude( $longitude1[ $i ] ) . " " . Mid( $rx1, $i + 1, 1 ) . "</td>";
			if ( $ubt1 == 1 ) {
				echo "<td>&nbsp;</td>";
			} else {
				$hse = floor( $house_pos1[ $i ] );
				if ( $hse < 10 ) {
					echo "<td>&nbsp;&nbsp;&nbsp;&nbsp; " . $hse . "</td>";
				} else {
					echo "<td>&nbsp;&nbsp;&nbsp;" . $hse . "</td>";
				}
			}
			echo '</tr>';
		}
		echo '</table><br/>';/*

		echo '<center><table width="30%" cellpadding="0" cellspacing="5">', "\n";
		if ( $ubt1 == 0 ) {
			echo '<tr>';
			echo "<td><font color='#0000ff'><b>&nbsp&nbsp&nbsp&nbspBurç </b></font></td>";
			echo "<td><font color='#0000ff'><b> Boylam </b></font></td>";
			echo "<td> &nbsp </td>";
			echo '</tr>';

			for ( $i = LAST_PLANET + 1; $i <= LAST_PLANET + 12; $i++ ) {
				echo '<tr>';
				if ( $i == LAST_PLANET + 1 ) {
					echo "<td>&nbsp&nbsp&nbsp&nbspYükselen </td>";
				} elseif ( $i == LAST_PLANET + 10 ) {
					echo "<td>&nbsp&nbsp&nbsp&nbspGökyüzü Ortası </td>";
				}
				else {
					echo "<td>&nbsp&nbsp&nbsp&nbspBurç " . ( $i - LAST_PLANET ) . "</td>";
				}
				echo "<td>" . Convert_Longitude( $longitude1[ $i ] ) . "</td>";
				echo "<td> &nbsp </td>";
				echo '</tr>';
			}
		}

		echo '</table></center>', "\n";
		echo "<br />";

		// display natal data - aspect table
		echo '<center><table width="30%" cellpadding="0" cellspacing="5">', "\n";

		echo '<tr>';
		echo "<td><font color='#0000ff'><b>&nbsp&nbsp&nbsp&nbspGezegen </b></font></td>";
		echo "<td><font color='#0000ff'><b> Açılar </b></font></td>";
		echo "<td><font color='#0000ff'><b> Gezegen </b></font></td>";
		echo "<td><font color='#0000ff'><b> Orb </b></font></td>";
		echo '</tr>';

		// include Ascendant and MC
		$longitude1[ LAST_PLANET + 1 ] = $hc1[ 1 ];
		$longitude1[ LAST_PLANET + 2 ] = $hc1[ 10 ];

		$pl_name[ LAST_PLANET + 1 ] = "Yükselen";
		$pl_name[ LAST_PLANET + 2 ] = "Gökyüzü Ortası";

		if ( $ubt1 == 1 ) {
			$a1 = SE_TNODE;
		} else {
			$a1 = LAST_PLANET + 2;
		}

		for ( $i = 0; $i <= $a1; $i++ ) {
			//echo "<tr><td colspan='4'>&nbsp;</td></tr>";
			for ( $j = 0; $j <= $a1; $j++ ) {
				$q = 0;
				$da = Abs( $longitude1[ $i ] - $longitude1[ $j ] );

				if ( $da > 180 ) {
					$da = 360 - $da;
				}

				// set orb - 8 if Sun or Moon, 6 if not Sun or Moon
				if ( $i == SE_POF Or $j == SE_POF ) {
					$orb = 2;
				} elseif ( $i == SE_LILITH Or $j == SE_LILITH ) {
					$orb = 3;
				}
				elseif ( $i == SE_TNODE Or $j == SE_TNODE ) {
					$orb = 3;
				}
				elseif ( $i == SE_VERTEX Or $j == SE_VERTEX ) {
					$orb = 3;
				}
				elseif ( $i == 0 Or $i == 1 Or $j == 0 Or $j == 1 ) {
					$orb = 8;
				}
				else {
					$orb = 6;
				}

				// is there an aspect within orb?
				if ( $da <= $orb ) {
					$q = 1;
					$dax = $da;
				} elseif ( ( $da <= ( 60 + $orb ) )And( $da >= ( 60 - $orb ) ) ) {
					$q = 6;
					$dax = $da - 60;
				}
				elseif ( ( $da <= ( 90 + $orb ) )And( $da >= ( 90 - $orb ) ) ) {
					$q = 4;
					$dax = $da - 90;
				}
				elseif ( ( $da <= ( 120 + $orb ) )And( $da >= ( 120 - $orb ) ) ) {
					$q = 3;
					$dax = $da - 120;
				}
				elseif ( ( $da <= ( 150 + $orb ) )And( $da >= ( 150 - $orb ) ) ) {
					$q = 5;
					$dax = $da - 150;
				}
				elseif ( $da >= ( 180 - $orb ) ) {
					$q = 2;
					$dax = 180 - $da;
				}

				if ( $q > 0 And $i != $j ) {
					// aspect exists
					echo '<tr>';
					echo "<td height=20>&nbsp&nbsp&nbsp&nbsp" . $pl_name[ $i ] . "</td>";
					echo "<td>" . $asp_name[ $q ] . "</td>";
					echo "<td>" . $pl_name[ $j ] . "</td>";
					echo "<td>" . sprintf( "%.2f", abs( $dax ) ) . "</td>";
					echo '</tr>';
				}
			}
		}

		echo '</table></center>', "\n";*/
		echo "<br /><br />";


		if ( EMAIL_enabled == True ) {
			@mail( EMAIL, "Natal Rapor", "" );
		}

		include( 'footer_natal.html' );
		exit();
	}
} else {
	include( 'header_natal.html' ); //here because of cookies

	//$name = stripslashes( $_COOKIE[ 'name' ] );

	//$month = $_COOKIE[ 'month' ];
	//$day = $_COOKIE[ 'day' ];
	//$year = $_COOKIE[ 'year' ];

	//$hour = $_COOKIE[ 'hour' ];
	//$minute = $_COOKIE[ 'minute' ];

	//$timezone = $_COOKIE[ 'timezone' ];
	//$lokasyon = $_COOKIE[ 'lokasyon' ];

	//$long_deg = $_COOKIE[ "long_deg" ];
	//$long_min = $_COOKIE[ "long_min" ];
	//$ew = $_COOKIE[ "ew" ];

	//$lat_deg = $_COOKIE[ "lat_deg" ];
	//$lat_min = $_COOKIE[ "lat_min" ];
	//$ns = $_COOKIE[ "ns" ];
}

?>
<!-- Şablon Başlangıç-->
<div class="size1 bg0 where1-parent">
	<!-- Coutdown -->
	<div class="flex-c-m bg-img1 size2 where1 overlay1 where2 respon2" style="background-image: url('img/bg01.jpg');">
		<div class="wsize2 flex-w flex-c-m cd100 js-tilt">
			<div class="flex-col-c-m size6 bor2 m-l-10 m-r-10 m-t-15"> </div>
			<div class="flex-col-c-m size6 bor2 m-l-10 m-r-10 m-t-15"> </div>
			<div class="flex-col-c-m size6 bor2 m-l-10 m-r-10 m-t-15"> </div>
			<div class="flex-col-c-m size6 bor2 m-l-10 m-r-10 m-t-15"> </div>
		</div>
	</div>

	<!-- Form -->
	<div class="size3 flex-col-sb flex-w p-l-75 p-r-75 p-t-45 p-b-45 respon1">
		<div class="wrap-pic1"> </div>
		<div class="p-t-50 p-b-60">
			<p class="m1-txt1 p-b-36">
				<span class="m1-txt2">horoskop.com.tr</span> yakında yayında,<br> bizi takip edin!
			</p>
			<span class="m1-txt2">
		  <span class="m1-txt2">
<!-- Şablon Form arası -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" target="_self">
	<fieldset style="border-style: hidden;">
		<INPUT type="hidden" size="4" name="timezone" id="timezone" value="<?php echo $timezone; ?>">
		<INPUT type="hidden" size="4" name="long_deg" id="long_deg" value="<?php echo $long_deg; ?>">
		<INPUT type="hidden" size="4" name="ew" id="ew" value="<?php echo $ew; ?>">
		<INPUT type="hidden" size="4" name="long_min" id="long_min" value="<?php echo $long_min; ?>">
		<INPUT type="hidden" size="4" name="lat_deg" id="lat_deg" value="<?php echo $lat_deg; ?>">
		<INPUT type="hidden" size="4" name="ns" id="ns" value="<?php echo $ns; ?>">
		<INPUT type="hidden" size="4" name="lat_min" id="lat_min" value="<?php echo $lat_min; ?>">
		<INPUT type="hidden" size="20" name="TimeZoneTag" id="TimeZoneTag" value="<?php echo $TimeZoneTag; ?>">
		<table width="340" style="font-size:12px;" cellspacing="5" class="center">
			<TR>
				<TD width="120">
					<P class="special" align="right">İsim</P>
				</TD>
				<TD colspan="4">
					<INPUT size="25" id="name" name="name" value="<?php echo $name; ?>" placeholder="Adınızı ve soyadınızı giriniz">
						<div class="loading" id="loading1"></div>
				</TD>
			</TR>
			<TR>
				<TD width="120">
					<p class="special" align="right">Doğum Yeri</P>
				</TD>
				<TD colspan="4">
					<input name="lokasyon" id="provider-json" size="24" class="bendesin" keypress="return event.keyCode != 13;" value="<?php echo $lokasyon; ?>" placeholder="Doğum yerinizi giriniz">
					<script>
						var options = {
							url: "lib/lokasyon.json",
							getValue: "Location",
							list: {
								maxNumberOfElements: 10,
								autofocus: true,
								onSelectItemEvent: function () {
									var vlongDeg = $( "#provider-json" ).getSelectedItemData().long_deg;
									$( "#long_deg" ).val( vlongDeg ).trigger( "change" );

									var vlongEW = $( "#provider-json" ).getSelectedItemData().ew;
									$( "#ew" ).val( vlongEW ).trigger( "change" );

									var vlongMin = $( "#provider-json" ).getSelectedItemData().long_min;
									$( "#long_min" ).val( vlongMin ).trigger( "change" );

									var vlatDeg = $( "#provider-json" ).getSelectedItemData().lat_deg;
									$( "#lat_deg" ).val( vlatDeg ).trigger( "change" );

									var vns = $( "#provider-json" ).getSelectedItemData().ns;
									$( "#ns" ).val( vns ).trigger( "change" );

									var vlat_min = $( "#provider-json" ).getSelectedItemData().lat_min;
									$( "#lat_min" ).val( vlat_min ).trigger( "change" );

									var vtimezone = $( "#provider-json" ).getSelectedItemData().GMT;
									$( "#timezone" ).val( vtimezone ).trigger( "change" );

									var vtimezone = $( "#provider-json" ).getSelectedItemData().TimeZoneTag;
									$( "#TimeZoneTag" ).val( vtimezone ).trigger( "change" );
								},
								onLoadEvent : function () {
									$( "#provider-json" ).css("background-image", "url(/img/loader.gif)");  
								},							
								onShowListEvent: function () {
								$( "#provider-json" ).css("background-image", "none");  
								},
								match: {
									enabled: true
								},
								showAnimation: {
									type: "fade", //normal|slide|fade
									time: 400,
									callback: function () { }
									
								},
								hideAnimation: {
									type: "slide", //normal|slide|fade
									time: 400,
									callback: function () {}
								},	
								
							}
							
						};
						$( "#provider-json" ).easyAutocomplete( options );

					</script><img id="loading" style="display:none" src="/img/loader.gif" />
				</TD>
			</TR>
			<TR>
				<TD width="120">
					<P class="special" align="right">Doğum Tarihi</P>
				</TD>
				<TD>

					<INPUT size="3" maxlength="2" id="day" name="day" value="<?php echo $day; ?>" placeholder="Gün">
					
				</TD>
				<TD colspan="2"><?php
					echo '<select name="month" id="aysec">';
					foreach ( $months as $key => $value ) {
						echo "<option value=\"$key\"";
						if ( $key == $month ) {
							echo ' selected="selected"';
						}
						echo ">$value</option>\n";
					}
					echo '</select>';
					?>
			  </TD>
				<TD><INPUT size="2" maxlength="4" id="year" name="year" value="<?php echo $year; ?>" placeholder="Yıl"></TD>
			</TR>
			<TR>
				<td width="120" valign="top">
					<P align="right" class="special">Doğum Saati</P>
				</td>
				<TD colspan="2">
					<INPUT maxlength="2" size="2" name="hour" id="hour" value="<?php echo $hour; ?>" placeholder="Saat">				
					
				</TD>
				<TD colspan="2"><INPUT maxlength="2" size="2" name="minute" id="minute" value="<?php echo $minute; ?>" placeholder="Dakika"></TD>
			</TR>				
				<tr>
					<td colspan="5"><input type="submit" name="submit2" id="submit2" value="İlerle" align="middle" style="background-color:#66ff66;color:#000000;font-size:16px;font-weight:bold">
					</td>
				</tr>
				<tr>
					<td colspan="5">
						<font face="Verdana" size="1">Betik: Allen Edwall</td>
				</tr>
				<tr>
					<td colspan="5">
						<font face="Verdana" size="1">Arayüz Geliştirme ve Düzenleme: Mehmet DURMAZ</td>
				</tr>
				</table>
				<center>
					<input type="hidden" name="submitted" value="TRUE">
					</fieldset>
					</form>
					<!-- Şablon Devam -->
					</span>
		









		</div>
		<div class="flex-w"> </div>
	</div>
</div>
<!-- Şablon Bitiş -->
<?php
include( 'footer_natal.html' );


Function left( $leftstring, $leftlength ) {
	return ( substr( $leftstring, 0, $leftlength ) );
}


Function Reduce_below_30( $longitude ) {
	$lng = $longitude;

	while ( $lng >= 30 ) {
		$lng = $lng - 30;
	}

	return $lng;
}


Function Convert_Longitude( $longitude ) {
	$signs = array( 0 => 'Koç', 'Boğa', 'İkizler', 'Yengeç', 'Aslan', 'Başak', 'Terazi', 'Akrep', 'Yay', 'Oğlak', 'Kova', 'Balık' );

	$sign_num = floor( $longitude / 30 );
	$pos_in_sign = $longitude - ( $sign_num * 30 );
	$deg = floor( $pos_in_sign );
	$full_min = ( $pos_in_sign - $deg ) * 60;
	$min = floor( $full_min );
	$full_sec = round( ( $full_min - $min ) * 60 );

	if ( $deg < 10 ) {
		$deg = "0" . $deg;
	}

	if ( $min < 10 ) {
		$min = "0" . $min;
	}

	if ( $full_sec < 10 ) {
		$full_sec = "0" . $full_sec;
	}

	return $deg . " " . $signs[ $sign_num ] . " " . $min . "' " . $full_sec . chr( 34 );
}


Function mid( $midstring, $midstart, $midlength ) {
	return ( substr( $midstring, $midstart - 1, $midlength ) );
}


Function safeEscapeString( $inp ) {
	if ( is_array( $inp ) )
		return array_map( __METHOD__, $inp );

	// replace HTML tags '<>' with '[]'
	$temp1 = str_replace( "<", "[", $inp );
	$temp2 = str_replace( ">", "]", $temp1 );

	// but keep <br> or <br />
	// turn <br> into <br /> so later it will be turned into ""
	// using just <br> will add extra blank lines
	$temp1 = str_replace( "[br]", "<br />", $temp2 );
	$temp2 = str_replace( "[br /]", "<br />", $temp1 );

	if ( !empty( $temp2 ) && is_string( $temp2 ) ) {
		return str_replace( array( '\\', "\0", "\n", "\r", "'", '"', "\x1a" ), array( '\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z' ), $temp2 );
	}

	return $temp2;
}


Function Find_Specific_Report_Paragraph( $phrase_to_look_for, $file ) {
	$string = "";
	$len = strlen( $phrase_to_look_for );

	//put entire file contents into an array, line by line
	$file_array = file( $file );

	// look through each line searching for $phrase_to_look_for
	for ( $i = 0; $i < count( $file_array ); $i++ ) {
		if ( left( trim( $file_array[ $i ] ), $len ) == $phrase_to_look_for ) {
			$flag = 0;
			while ( trim( $file_array[ $i ] ) != "*" ) {
				if ( $flag == 0 ) {
					$string .= "<b>" . $file_array[ $i ] . "</b>";
				} else {
					$string .= $file_array[ $i ];
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