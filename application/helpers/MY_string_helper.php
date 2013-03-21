<?php
function to_slug( $string, $encode = 'UTF-8' ){
	
	$acentos = array(
        'a' => '/&Agrave;|&Aacute;|&Acirc;|&Atilde;|&Auml;|&Aring;/i',
        'c' => '/&Ccedil;/i',
        'e' => '/&egrave;|&eacute;|&ecirc;|&euml;/i',
        'i' => '/&igrave;|&iacute;|&icirc;|&iuml;/i',
        'n' => '/&ntilde;/i',
        'o' => '/&ograve;|&oacute;|&ocirc;|&otilde;|&ouml;/i',
        'u' => '/&ugrave;|&uacute;|&ucirc;|&uuml;/i',
        'y' => '/&yacute;|&yuml;/i',
        'a.' => '/&ordf;/i',
        'o.' => '/&ordm;/i',
        '-' => '/[ _]/'
	);

	return strtolower(preg_replace($acentos, array_keys($acentos), htmlentities($string,ENT_NOQUOTES, $encode)));
}