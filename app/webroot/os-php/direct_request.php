<?php
	//header("Content-type: application/xhtml+xml; charset=UTF-8");
	
	$confirmed = 'http://schemas.google.com/g/2005#event.confirmed';

	$three_months_in_seconds = 60 * 60 * 24 * 28 * 3;
	$three_months_ago = date("Y-m-d\Th:i:sP", time() - $three_months_in_seconds);
	$three_months_from_today = date("Y-m-d\Th:i:sP", time() + $three_months_in_seconds);

	$feed = "http://www.google.com/calendar/feeds/incredible.sndp%40gmail.com/public/full?orderby=starttime&singleevents=true&start-min=2012-09-21&start-max=2013-03-08";

$feed = file_get_contents($feed);  
header('Content-type: text/xml');   
echo $feed;  exit;

function xml2array($file) {
    $string = file_get_contents($file);
    $parser = xml_parser_create();
    xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
    xml_parse_into_struct($parser, $string, $vals, $index);
    xml_parser_free($parser);    
    $ary=array();
    $i=-1;
    foreach ($vals as $r){
        if($r['level'] == 1)continue;
        if($r['level'] == 2 && $r['type'] == "open"){
            ++$i;
            continue;
            }
        $ary[$i][$r['tag']] = @$r['value'];
    }
    return $ary;
}

	$s = xml2array($feed); 
echo'<pre>'; print_r($s); exit;
	foreach ($s->entry as $item) {
		$gd = $item->children('http://schemas.google.com/g/2005');

		if ($gd->eventStatus->attributes()->value == $confirmed) {
 ?>
			<font size=+1><b>
				<?php print $item->title; ?>
			</b></font><br>

			<?php 
			$startTime = '';
			if ( $gd->when ) {
				$startTime = $gd->when->attributes()->startTime;
			} elseif ( $gd->recurrence ) {
				$startTime = $gd->recurrence->when->attributes()->startTime; 
			} 

			print date("l jS \o\f F Y - h:i A", strtotime( $startTime ) );
			// Google Calendar API's support of timezones is buggy
			print " AST<br>";
			?>
			<?php print $gd->where->attributes()->valueString; ?><br>
			<br>

<?php
		}
} ?>
