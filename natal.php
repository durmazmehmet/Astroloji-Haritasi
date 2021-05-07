<?php
$months = array( 0 => 'Ay Seç', 'Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık' );
$my_error = "";

// check if the form has been submitted
if ( isset( $_POST[ 'submitted' ] )Or isset( $_POST[ 'h_sys_submitted' ] ) ) {
	// get all variables from form
	$h_sys = safeEscapeString( $_POST[ "h_sys" ] );
	$name = safeEscapeString( $_POST[ "name" ] );

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

	// set cookie containing natal data here
	setcookie( 'name', stripslashes( $name ), time() + 60 * 60 * 24 * 30, '/', '', 0 );

	setcookie( 'month', $month, time() + 60 * 60 * 24 * 30, '/', '', 0 );
	setcookie( 'day', $day, time() + 60 * 60 * 24 * 30, '/', '', 0 );
	setcookie( 'year', $year, time() + 60 * 60 * 24 * 30, '/', '', 0 );

	setcookie( 'hour', $hour, time() + 60 * 60 * 24 * 30, '/', '', 0 );
	setcookie( 'minute', $minute, time() + 60 * 60 * 24 * 30, '/', '', 0 );

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

	$my_form->add_text_field( "Month", $month, "text", "y", 2 );
	$my_form->add_text_field( "Day", $day, "text", "y", 2 );
	$my_form->add_text_field( "Year", $year, "text", "y", 4 );

	$my_form->add_text_field( "Hour", $hour, "text", "y", 2 );
	$my_form->add_text_field( "Minute", $minute, "text", "y", 2 );

	//$my_form->add_text_field("Time zone", $timezone, "text", "y", 4);

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
		$my_error .= "LGirdiğiz doğum yeri bulunamadı.<br>";
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
		$error = $my_form->create_msg();
		echo "<TABLE align='center' WIDTH='98%' BORDER='0' CELLSPACING='15' CELLPADDING='0'><tr><td><center><b>";

		if ( $error ) {
			echo $error . $my_error;
		} else {
			echo $error . $my_error;
		}

		echo "</font>";
		echo "<font color='#c020c0'";
		echo "<br>Girdiğiz doğum yeri bulunamadı.";
		echo "</font>";
		echo "</b></center></td></tr></table>";
	} else {
		// no errors in filling out form, so process form
		// calculate astronomic data
		$swephsrc = 'sweph';
		$sweph = 'sweph';

		// Unset any variables not initialized elsewhere in the program
		unset( $PATH, $out, $pl_name, $longitude1, $house_pos );

		//assign data from database to local variables
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

		// adjust date and time for minus hour due to time zone taking the hour negative
		$utdatenow = strftime( "%d.%m.%Y", mktime( $inhours, $inmins, $insecs, $inmonth, $inday, $inyear ) );
		$utnow = strftime( "%H:%M:%S", mktime( $inhours, $inmins, $insecs, $inmonth, $inday, $inyear ) );

		putenv( "PATH=$PATH:$swephsrc" );

		// get LAST_PLANET planets and all house cusps
		if ( strlen( $h_sys ) != 1 ) {
			$h_sys = "p";
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
		}?>

		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
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
			<input type="hidden" name="name" value="<?php echo $_POST['name']; ?>">
			<input type="hidden" name="month" value="<?php echo $_POST['month']; ?>">
			<input type="hidden" name="day" value="<?php echo $_POST['day']; ?>">
			<input type="hidden" name="year" value="<?php echo $_POST['year']; ?>">
			<input type="hidden" name="hour" value="<?php echo $_POST['hour']; ?>">
			<input type="hidden" name="minute" value="<?php echo $_POST['minute']; ?>">
			<input type="hidden" name="timezone" value="<?php echo $_POST['timezone']; ?>">
			<input type="hidden" name="long_deg" value="<?php echo $_POST['long_deg']; ?>">
			<input type="hidden" name="long_min" value="<?php echo $_POST['long_min']; ?>">
			<input type="hidden" name="ew" value="<?php echo $_POST['ew']; ?>">
			<input type="hidden" name="lat_deg" value="<?php echo $_POST['lat_deg']; ?>">
			<input type="hidden" name="lat_min" value="<?php echo $_POST['lat_min']; ?>">
			<input type="hidden" name="ns" value="<?php echo $_POST['ns']; ?>">
			<input type="hidden" name="h_sys_submitted" value="TRUE">
			<INPUT type="submit" name="submit" value="Go" align="middle" style="background-color:#66ff66;color:#000000;font-size:16px;font-weight:bold">
		</form>
		<?php
		//display natal data
		echo "<center>";

		$restored_name = stripslashes( $name );
		echo "<FONT color='#ff0000' SIZE='2' FACE='Arial'><b>Merhaba $restored_name </b></font>";

		$secs = "0";
		if ( $timezone < 0 ) {
			$tz = $timezone;
		} else {
			$tz = "+" . $timezone;
		}

		echo '<font size="2"><b>Doğum Tarihiniz: ' . strftime( "%d %B %Y %X (GMT $tz)</b></font> ", mktime( $hour, $minute, $secs, $month, $day, $year ) );
		echo "<font size = '2'><b> Koordinat:" . $long_deg . $ew_txt . $long_min . ", " . $lat_deg . $ns_txt . $lat_min . "</b></font>";
	
		echo "</center>";

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
		echo "<img border='0' src='lib/natal_wheel_2.php?rx1=$rx1&p1=$ser_L1&hc1=$ser_hc1&hpos=$ser_hpos' width='640' height='640'>";
		//echo "<br><br>";
		echo "<img border='0' src='lib/natal_aspect_grid.php?rx1=$rx1&rx2=$rx2&p1=$ser_L1&p2=$ser_L2&hc1=$ser_hc1&ubt1=$ubt1&ubt2=$ubt2' width='705' height='450'>";
		echo "</center>";
		echo "<br>";

		//display natal data
		echo '<center><table width="40%" cellpadding="0" cellspacing="0" border="0">', "\n";

		echo '<tr>';
		echo "<td><font color='#0000ff'><b> Gezegen </b></font></td>";
		echo "<td><font color='#0000ff'><b> Boylam </b></font></td>";
		if ( $ubt1 == 1 ) {
			echo "<td>&nbsp;</td>";
		} else {
			echo "<td><font color='#0000ff'><b> Burç<br>pozisyon </b></font></td>";
		}
		echo '</tr>';

		if ( $ubt1 == 1 ) {
			$a1 = SE_TNODE;
		} else {
			$a1 = LAST_PLANET;
		}

		for ( $i = 0; $i <= $a1; $i++ ) {
			echo '<tr>';
			echo "<td>" . $pl_name[ $i ] . "</td>";
			echo "<td><font face='Courier New'>" . Convert_Longitude( $longitude1[ $i ] ) . " " . Mid( $rx1, $i + 1, 1 ) . "</font></td>";
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

		echo '<tr>';
		echo "<td> &nbsp </td>";
		echo "<td> &nbsp </td>";
		echo "<td> &nbsp </td>";
		echo "<td> &nbsp </td>";
		echo '</tr>';

		if ( $ubt1 == 0 ) {
			echo '<tr>';
			echo "<td><font color='#0000ff'><b> House </b></font></td>";
			echo "<td><font color='#0000ff'><b> Longitude </b></font></td>";
			echo "<td> &nbsp </td>";
			echo '</tr>';

			for ( $i = LAST_PLANET + 1; $i <= LAST_PLANET + 12; $i++ ) {
				echo '<tr>';
				if ( $i == LAST_PLANET + 1 ) {
					echo "<td>Yükselen </td>";
				} elseif ( $i == LAST_PLANET + 10 ) {
					echo "<td>Gökyüzü Ortası </td>";
				}
				else {
					echo "<td>Burç " . ( $i - LAST_PLANET ) . "</td>";
				}
				echo "<td><font face='Courier New'>" . Convert_Longitude( $longitude1[ $i ] ) . "</font></td>";
				echo "<td> &nbsp </td>";
				echo '</tr>';
			}
		}

		echo '</table></center>', "\n";
		echo "<br /><br />";

		if ( EMAIL_enabled == True ) {
			@mail( EMAIL, "Natal Rapor", "" );
		}

		include( 'footer_natal.html' );
		exit();
	}
} else {
	include( 'header_natal.html' ); //here because of cookies

	$name = stripslashes( $_COOKIE[ 'name' ] );

	$month = $_COOKIE[ 'month' ];
	$day = $_COOKIE[ 'day' ];
	$year = $_COOKIE[ 'year' ];

	$hour = $_COOKIE[ 'hour' ];
	$minute = $_COOKIE[ 'minute' ];

	$timezone = $_COOKIE[ 'timezone' ];

	$long_deg = $_COOKIE[ "long_deg" ];
	$long_min = $_COOKIE[ "long_min" ];
	$ew = $_COOKIE[ "ew" ];

	$lat_deg = $_COOKIE[ "lat_deg" ];
	$lat_min = $_COOKIE[ "lat_min" ];
	$ns = $_COOKIE[ "ns" ];
}

?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" target="_self" style="margin: 0px 20px;">
	<fieldset>
		<table style="font-size:12px;">
			<TR>
				<TD>
					<P align="right">İsim</P>
				</TD>
				<TD>
					<INPUT size="40" name="name" value="<?php echo $name; ?>">
					<INPUT type="hidden" size="4" name="timezone" id="timezone" value="<?php echo $timezone; ?>">					
					<INPUT type="hidden" size="4" name="long_deg" id="long_deg" value="<?php echo $long_deg; ?>">
					<INPUT type="hidden" size="4" name="ew" id="ew" value="<?php echo $ew; ?>">						
					<INPUT type="hidden" size="4" name="long_min" id="long_min"  value="<?php echo $long_min; ?>">
					<INPUT type="hidden" size="4" name="lat_deg" id="lat_deg" value="<?php echo $lat_deg; ?>">
					<INPUT type="hidden" size="4" name="ns" id="ns" value="<?php echo $ns; ?>">					
					<INPUT type="hidden" size="4" name="lat_min" id="lat_min" value="<?php echo $lat_min; ?>">
				</TD>
			</TR>
			<TR>
				<TD>
					<P align="right">Doğum Yeri2</P>
				</TD>
				<TD>
					<input size="31" id="provider-json" keypress="return event.keyCode != 13;" >
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

									var vtimezone = $( "#provider-json" ).getSelectedItemData().timezone;
									$( "#timezone" ).val( vtimezone ).trigger( "change" );

								},
								match: {
									enabled: true
								},
								showAnimation: {
									type: "fade", //normal|slide|fade
									time: 200,
									callback: function () {}
								},
								hideAnimation: {
									type: "fade", //normal|slide|fade
									time: 200,
									callback: function () {}
								}
							}
						};
						$( "#provider-json" ).easyAutocomplete( options );
					</script>
				</TD>
			</TR>
			<TR>
				<TD>
					<P align="right">Doğum Tarihi</P>
				</TD>
				<TD>
					
					<INPUT size="2" maxlength="2" name="day" value="<?php echo $day; ?>">
					<?php
					echo '<select name="month">';
					foreach ( $months as $key => $value ) {
						echo "<option value=\"$key\"";
						if ( $key == $month ) {
							echo ' selected="selected"';
						}
						echo ">$value</option>\n";
					}
					echo '</select>';
					?>
					<INPUT size="4" maxlength="4" name="year" value="<?php echo $year; ?>">
				</TD>
			</TR>
			<TR>
				<td valign="top">
					<P align="right">Doğum Saati</P>
				</td>
				<TD>
					<INPUT maxlength="2" size="2" name="hour" value="<?php echo $hour; ?>">
					<INPUT maxlength="2" size="2" name="minute" value="<?php echo $minute; ?>">
					</font>
				</TD>
			</TR>
		</table>
		<center>
			<input type="hidden" name="submitted" value="TRUE">
			<INPUT type="submit" name="submit" value="İlerle" align="middle" style="background-color:#66ff66;color:#000000;font-size:16px;font-weight:bold">
	</fieldset>
</form>
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
	$signs = array( 0 => 'Ari', 'Tau', 'Gem', 'Can', 'Leo', 'Vir', 'Lib', 'Sco', 'Sag', 'Cap', 'Aqu', 'Pis' );

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