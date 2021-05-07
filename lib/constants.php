<?php

// set assignments of important variables
define(SE_SUN, 0);
define(SE_MOON, 1);
define(SE_MERCURY, 2);
define(SE_VENUS, 3);
define(SE_MARS, 4);
define(SE_JUPITER, 5);
define(SE_SATURN, 6);
define(SE_URANUS, 7);
define(SE_NEPTUNE, 8);
define(SE_PLUTO, 9);
define(SE_CHIRON, 10);
define(SE_LILITH, 11);
define(SE_TNODE, 12);		//this must be last thing before angle stuff
define(SE_POF, 13);
define(SE_VERTEX, 14);
define(LAST_PLANET, 14);

define(EMAIL_enabled, True);
define(EMAIL, "ae33@astrowin.org");

$pl_name[0] = "Güneş";
$pl_name[1] = "Ay";
$pl_name[2] = "Merkür";
$pl_name[3] = "Venüs";
$pl_name[4] = "Mars";
$pl_name[5] = "Jüpiter";
$pl_name[6] = "Satürn";
$pl_name[7] = "Uranüs";
$pl_name[8] = "Neptün";
$pl_name[9] = "Pluto";
$pl_name[10] = "Chiron";
$pl_name[11] = "Lilit";
$pl_name[12] = "Gerçek DÜğüm";
$pl_name[13] = "Şans Noktası";		//add a planet
$pl_name[14] = "Verteks";
$pl_name[LAST_PLANET + 1] = "Yükselen";
$pl_name[LAST_PLANET + 2] = "Gökyüzü Ortası";

$pl_name[LAST_PLANET + 1] = "Yükselen";
$pl_name[LAST_PLANET + 2] = "Burç 2";
$pl_name[LAST_PLANET + 3] = "Burç 3";
$pl_name[LAST_PLANET + 4] = "Burç 4";
$pl_name[LAST_PLANET + 5] = "Burç 5";
$pl_name[LAST_PLANET + 6] = "Burç 6";
$pl_name[LAST_PLANET + 7] = "Burç 7";
$pl_name[LAST_PLANET + 8] = "Burç 8";
$pl_name[LAST_PLANET + 9] = "Burç 9";
$pl_name[LAST_PLANET + 10] = "Gökyüzü Ortası";
$pl_name[LAST_PLANET + 11] = "Burç 11";
$pl_name[LAST_PLANET + 12] = "Burç 12";

$pl_ephem_number[0] = "0";
$pl_ephem_number[1] = "1";
$pl_ephem_number[2] = "2";
$pl_ephem_number[3] = "3";
$pl_ephem_number[4] = "4";
$pl_ephem_number[5] = "5";
$pl_ephem_number[6] = "6";
$pl_ephem_number[7] = "7";
$pl_ephem_number[8] = "8";
$pl_ephem_number[9] = "9";
$pl_ephem_number[10] = "D";
$pl_ephem_number[11] = "A";
$pl_ephem_number[12] = "t";

$sign_name[1] = "KOÇ";
$sign_name[2] = "BOĞA";
$sign_name[3] = "İKİZLER";
$sign_name[4] = "YENGEÇ";
$sign_name[5] = "ASLAN";
$sign_name[6] = "BAŞAK";
$sign_name[7] = "TERAZİ";
$sign_name[8] = "AKREP";
$sign_name[9] = "YAY";
$sign_name[10] = "OĞLAK";
$sign_name[11] = "KOVA";
$sign_name[12] = "BALIK";
$sign_name[13] = "KOÇ";

$name_of_sign[1] = "Koç";
$name_of_sign[2] = "Boğa";
$name_of_sign[3] = "İkizler";
$name_of_sign[4] = "Yengeç";
$name_of_sign[5] = "Aslan";
$name_of_sign[6] = "Başak";
$name_of_sign[7] = "Terazi";
$name_of_sign[8] = "Akrep";
$name_of_sign[9] = "Yay";
$name_of_sign[10] = "Oğlak";
$name_of_sign[11] = "Kova";
$name_of_sign[12] = "Balık";
$name_of_sign[13] = "Koç";

$aspects_defined[1] = "000";
$aspects_defined[2] = "045";
$aspects_defined[3] = "060";
$aspects_defined[4] = "090";
$aspects_defined[5] = "120";
$aspects_defined[6] = "135";
$aspects_defined[7] = "180";
$aspects_defined[8] = "030";
$aspects_defined[9] = "150";

$pl_glyph[0] = 81;
$pl_glyph[1] = 87;
$pl_glyph[2] = 69;
$pl_glyph[3] = 82;
$pl_glyph[4] = 84;
$pl_glyph[5] = 89;
$pl_glyph[6] = 85;
$pl_glyph[7] = 73;
$pl_glyph[8] = 79;
$pl_glyph[9] = 80;
$pl_glyph[10] = 77;
$pl_glyph[11] = 96;
$pl_glyph[12] = 141;
$pl_glyph[13] = 60;		//Part of Fortune
$pl_glyph[14] = 109;	//Vertex
$pl_glyph[LAST_PLANET + 1] = 90;		//Ascendant
$pl_glyph[LAST_PLANET + 2] = 88;		//Midheaven

$asp_color[1] = $blue;
$asp_color[2] = $red;
$asp_color[3] = $green;
$asp_color[4] = $red;			//$magenta;
$asp_color[5] = $blue;			//$cyan;
$asp_color[6] = $green;			//$orange;

$asp_name[1] = "Birleşme";
$asp_name[2] = "Zıtlaşma";
$asp_name[3] = "Üçlü";
$asp_name[4] = "Kare";
$asp_name[5] = "Beş Noktanın Düzeni";
$asp_name[6] = "Altmışlık Düzen";

$asp_glyph[1] = 113;		//  0 deg
$asp_glyph[2] = 119;		//180 deg
$asp_glyph[3] = 101;		//120 deg
$asp_glyph[4] = 114;		// 90 deg
$asp_glyph[5] = 111;		//150 deg
$asp_glyph[6] = 116;		// 60 deg

$sign_glyph[1] = 97;
$sign_glyph[2] = 115;
$sign_glyph[3] = 100;
$sign_glyph[4] = 102;
$sign_glyph[5] = 103;
$sign_glyph[6] = 104;
$sign_glyph[7] = 106;
$sign_glyph[8] = 107;
$sign_glyph[9] = 108;
$sign_glyph[10] = 122;
$sign_glyph[11] = 120;
$sign_glyph[12] = 99;

define(CLR_BLACK, "#000000");
define(CLR_WHITE, "#ffffff");

define(CLR_RED, "#ff0000");
define(CLR_ANOTHER_RED, "#ff3c3c");

define(CLR_GREEN, "#2dac00");
define(CLR_LIME, "#9cce04");

define(CLR_BLUE, "#0000ff");
define(CLR_LIGHT_BLUE, "#c0c0ff");
define(CLR_ANOTHER_BLUE, "#c0c0ff");

define(CLR_PURPLE, "#ff00ff");
define(CLR_CYAN, "#00ffff");

define(CLR_YELLOW, "#ffff00");

define(CLR_GRAY, "#c0c0c0");
define(CLR_ANOTHER_GRAY, "#e0e0e0");

define(CLR_ORANGE, "#db9b40");

define(CLR_10TH_H, "#0000ff");
define(CLR_11TH_H, "#ff0000");
define(CLR_12TH_H, "#2dac00");
define(CLR_1ST_H, "#840da9");
define(CLR_2ND_H, "#c0004d");
define(CLR_3RD_H, "#808080");

?>
