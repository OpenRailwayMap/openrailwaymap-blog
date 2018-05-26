<?php
	$header = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
	$langs = explode(",", $header);

	$entry = explode(";", $langs[0]);
	$langpair = explode("-", $entry[0]);

	if ($_GET['lang'])
		$langpair[0] = $_GET['lang'];

	$lang = ($langpair[0] == "de") ? "de" : "en";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $lang; ?>" lang="<?php echo $lang; ?>">
	<head>
		<title>OpenRailwayMap Blog</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" type="text/css" href="style.css">
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<meta http-equiv="content-language" content="<?php echo $lang; ?>" />
		<meta name="keywords" content="openstreetmap, openrailwaymap, alexander matheisen, rurseekatze, openlayers, osm, matheisen, orm, eisenbahnkarte, bahnkarte, railmap, railway, railways, eisenbahn, streckenkarte" />
		<meta name="title" content="OpenRailwayMap" />
		<meta name="author" content="rurseekatze, Alexander Matheisen" />
		<meta name="publisher" content="rurseekatze, Alexander Matheisen" />
		<meta name="revisit-after" content="after 10 days" />
		<meta name="date" content="2010-01-01" />
		<meta name="page-topic" content="OpenRailwayMap" />
		<meta name="robots" content="index,follow" />
		<link rel="alternate" type="application/rss+xml" title="OpenRailwayMap RSS Feed" href="https://blog.openrailwaymap.org/<?php echo $lang; ?>.rss" />
	</head>
	<body>
	<body id="background">
		<div id="container">
			<div id="titleframe" align="center">
        		<a href="#" id="title">OpenRailwayMap Blog</a>
				<a href="https://blog.openrailwaymap.org/<?php echo $lang; ?>.rss" target="_blank" type="application/rss+xml"><img src="img/rss.svg" width="20px" /></a>
     	 	</div>
		  	<div id="contentframe" align="left">
				<?php
					function rss2html($url)
					{
						$output = '<ul class="rssList">';
						if ($rss = @simplexml_load_file($url))
						{
							foreach($rss->channel->item as $item)
							{
								$guid = explode("#", $item->guid);
								$output .= '<a name="'.$guid[1].'" />';
								$output .= '<li class="rssEntry">';
								$output .= '<a class="rssTitle" href="'.$item->link.'">'.$item->title.'</a>';
								$output .= '<span class="rssDate"> - '.date("d.m.Y",strtotime($item->pubDate)).'</span>';
								$output .= '<br />';
								$output .= $item->children("content", true);
								$output .= '</li>';
							}
							return $output.'</ul>';
						}
					}

					echo rss2html("https://blog.openrailwaymap.org/".$lang.".rss");
				?>
			</div>

			<p><a href="https://www.openrailwaymap.org/imprint"><?php echo ($lang == "de") ? "Impressum &amp; Datenschutz" : "Imprint &amp; Privacy Policy" ?></a></p>
		</div>
	</body>
</html>
