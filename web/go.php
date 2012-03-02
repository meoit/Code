<?PHP
/* -----------------------------------------------------
Bo-Blog 2 : The Blog Reloaded.
<<A Bluview Technology Product>>
禁止使用Windows记事本修改文件，由此造成的一切使用不正常恕不解答！
PHP+MySQL blog system.
Code: Bob Shen
Offical site: http://www.bo-blog.com
Copyright (c) Bob Shen
In memory of my university life
本文件用于基于PHP的URL优化
------------------------------------------------------- */

@error_reporting(E_ERROR | E_WARNING | E_PARSE);

$q_url=$_SERVER["REQUEST_URI"];
@list($relativePath, $rawURL)=@explode('/go.php/', $q_url);
$rewritedURL=$rawURL;

$RewriteRules=$RedirectTo=array();

$RewriteRules[]="/page\/([0-9]+)\/([0-9]+)\/?/";
$RewriteRules[]="/starred\/([0-9]+)\/?([0-9]+)?\/?/";
$RewriteRules[]="/category\/([^\/]+)\/?([0-9]+)?\/?([0-9]+)?\/?/";
$RewriteRules[]="/archiver\/([0-9]+)\/([0-9]+)\/?([0-9]+)?\/?([0-9]+)?\/?/";
$RewriteRules[]="/date\/([0-9]+)\/([0-9]+)\/([0-9]+)\/?([0-9]+)?\/?([0-9]+)?\/?/";
$RewriteRules[]="/user\/([0-9]+)\/?/";
$RewriteRules[]="/tags\/([^\/]+)\/?([0-9]+)?\/?([0-9]+)?\/?/";
$RewriteRules[]="/component\/id\/([0-9]+)\/?/";
$RewriteRules[]="/component\/([^\/]+)\/?/";

$RedirectTo[]="index.php?mode=\\1&page=\\2";
$RedirectTo[]="star.php?mode=\\1&page=\\2";
$RedirectTo[]="index.php?go=category_\\1&mode=\\2&page=\\3";
$RedirectTo[]="index.php?go=archive&cm=\\1&cy=\\2&mode=\\3&page=\\4";
$RedirectTo[]="index.php?go=showday_\\1-\\2-\\3&mode=\\4&page=\\5";
$RedirectTo[]="view.php?go=user_\\1";
$RedirectTo[]="tag.php?tag=\\1&mode=\\2&page=\\3";
$RedirectTo[]="page.php?pageid=\\1";
$RedirectTo[]="page.php?pagealias=\\1";

$i=0;
foreach ($RewriteRules as $rule) {
	if (preg_match($rule, $rewritedURL)) {
		$tmp_rewritedURL=preg_replace($rule, '<'.$RedirectTo[$i].'<', $rewritedURL, 1);
		$tmp_rewritedURL=@explode('<', $tmp_rewritedURL);
		$rewritedURL=($tmp_rewritedURL[2]) ? false : $tmp_rewritedURL[1];
		break;
	}
	$i+=1;
}

if ($rewritedURL==$rawURL || !$rewritedURL) {
	include_once("./data/config.php");
	@header ("HTTP/1.1 404 Not Found");
	if ($config['customized404']) {
		@header ("Location: {$config['customized404']}");
	}
	else {
		die("<html><head><title>Not Found</title></head><body><h1>HTTP/1.1 404 Not Found</h1></body></html>");
	}
}

$parsedURL=parse_url ($rewritedURL);
parse_str($parsedURL['query']);
include(basename($parsedURL['path']));

