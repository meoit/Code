<?php
if (!defined('VALIDREQUEST')) die ('Access Denied.');
function plugin_highslide_run ($str) {

	$highslide_search =	"/<a href=\"(\S+?)\" target=\"_blank\"><img src=\"(\S+?)\"((.+?)|\S*)\/><\/a>/ise";
	
	$highslide_replace ="makeslideimg('\\1', '\\2','\\3')";

		$str=preg_replace($highslide_search, $highslide_replace, $str);
		return $str;
}
function makeslideimg($url,$src,$other){
	
if ($url==$src){
		$imgcode="<a href=\"{$src}\" class=\"highslide\" onclick=\"return hs.expand(this)\"><img src=\"{$src}\" class=\"insertimage\" alt=\"Highslide JS\" title=\"Click để xem ảnh\" border=\"0\"{$other}/></a>";
	}
	else{
		$imgcode="<a href=\"{$url}\" target=\"_blank\"><img src=\"{$src}\" class=\"insertimage\" alt=\"{$alt}\" title=\"{$title}\" border=\"0\"{$other}/></a>";
	}
	$imgcode=str_replace('\"','"',$imgcode);
	return $imgcode;
}

?>