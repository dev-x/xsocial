<?php
/**
 * Create a web friendly URL slug from a string.
 * 
 * Although supported, transliteration is discouraged because
 *     1) most web browsers support UTF-8 characters in URLs
 *     2) transliteration causes a loss of information
 *
 * @author Sean Murphy <sean@iamseanmurphy.com>
 * @copyright Copyright 2012 Sean Murphy. All rights reserved.
 * @license http://creativecommons.org/publicdomain/zero/1.0/
 *
 * @param string $str
 * @param array $options
 * @return string
 */
function url_slug($str, $options = array()) {
	// Make sure string is in UTF-8 and strip invalid UTF-8 characters
	$str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
	
	$defaults = array(
		'delimiter' => '-',
		'limit' => null,
		'lowercase' => true,
		'replacements' => array(),
		'transliterate' => false,
	);
	
	// Merge options
	$options = array_merge($defaults, $options);
	
	$char_map = array(
		// Latin
		'A' => 'A', 'A' => 'A', 'A' => 'A', 'A' => 'A', 'A' => 'A', 'A' => 'A', '?' => 'AE', 'C' => 'C', 
		'E' => 'E', 'E' => 'E', 'E' => 'E', 'E' => 'E', 'I' => 'I', 'I' => 'I', 'I' => 'I', 'I' => 'I', 
		'?' => 'D', 'N' => 'N', 'O' => 'O', 'O' => 'O', 'O' => 'O', 'O' => 'O', 'O' => 'O', 'O' => 'O', 
		'O' => 'O', 'U' => 'U', 'U' => 'U', 'U' => 'U', 'U' => 'U', 'U' => 'U', 'Y' => 'Y', '?' => 'TH', 
		'?' => 'ss', 
		'a' => 'a', 'a' => 'a', 'a' => 'a', 'a' => 'a', 'a' => 'a', 'a' => 'a', '?' => 'ae', 'c' => 'c', 
		'e' => 'e', 'e' => 'e', 'e' => 'e', 'e' => 'e', 'i' => 'i', 'i' => 'i', 'i' => 'i', 'i' => 'i', 
		'?' => 'd', 'n' => 'n', 'o' => 'o', 'o' => 'o', 'o' => 'o', 'o' => 'o', 'o' => 'o', 'o' => 'o', 
		'o' => 'o', 'u' => 'u', 'u' => 'u', 'u' => 'u', 'u' => 'u', 'u' => 'u', 'y' => 'y', '?' => 'th', 
		'y' => 'y',

		// Latin symbols
		'©' => '(c)',

		// Greek
		'?' => 'A', '?' => 'B', '?' => 'G', '?' => 'D', '?' => 'E', '?' => 'Z', '?' => 'H', '?' => '8',
		'?' => 'I', '?' => 'K', '?' => 'L', '?' => 'M', '?' => 'N', '?' => '3', '?' => 'O', '?' => 'P',
		'?' => 'R', '?' => 'S', '?' => 'T', '?' => 'Y', '?' => 'F', '?' => 'X', '?' => 'PS', '?' => 'W',
		'?' => 'A', '?' => 'E', '?' => 'I', '?' => 'O', '?' => 'Y', '?' => 'H', '?' => 'W', '?' => 'I',
		'?' => 'Y',
		'?' => 'a', '?' => 'b', '?' => 'g', '?' => 'd', '?' => 'e', '?' => 'z', '?' => 'h', '?' => '8',
		'?' => 'i', '?' => 'k', '?' => 'l', '?' => 'm', '?' => 'n', '?' => '3', '?' => 'o', '?' => 'p',
		'?' => 'r', '?' => 's', '?' => 't', '?' => 'y', '?' => 'f', '?' => 'x', '?' => 'ps', '?' => 'w',
		'?' => 'a', '?' => 'e', '?' => 'i', '?' => 'o', '?' => 'y', '?' => 'h', '?' => 'w', '?' => 's',
		'?' => 'i', '?' => 'y', '?' => 'y', '?' => 'i',

		// Turkish
		'S' => 'S', 'I' => 'I', 'C' => 'C', 'U' => 'U', 'O' => 'O', 'G' => 'G',
		's' => 's', '?' => 'i', 'c' => 'c', 'u' => 'u', 'o' => 'o', 'g' => 'g', 

		// Russian
		'À' => 'A', 'Á' => 'B', 'Â' => 'V', 'Ã' => 'G', 'Ä' => 'D', 'Å' => 'E', '¨' => 'Yo', 'Æ' => 'Zh',
		'Ç' => 'Z', 'È' => 'I', 'É' => 'J', 'Ê' => 'K', 'Ë' => 'L', 'Ì' => 'M', 'Í' => 'N', 'Î' => 'O',
		'Ï' => 'P', 'Ð' => 'R', 'Ñ' => 'S', 'Ò' => 'T', 'Ó' => 'U', 'Ô' => 'F', 'Õ' => 'H', 'Ö' => 'C',
		'×' => 'Ch', 'Ø' => 'Sh', 'Ù' => 'Sh', 'Ú' => '', 'Û' => 'Y', 'Ü' => '', 'Ý' => 'E', 'Þ' => 'Yu',
		'ß' => 'Ya',
		'à' => 'a', 'á' => 'b', 'â' => 'v', 'ã' => 'g', 'ä' => 'd', 'å' => 'e', '¸' => 'yo', 'æ' => 'zh',
		'ç' => 'z', 'è' => 'i', 'é' => 'j', 'ê' => 'k', 'ë' => 'l', 'ì' => 'm', 'í' => 'n', 'î' => 'o',
		'ï' => 'p', 'ð' => 'r', 'ñ' => 's', 'ò' => 't', 'ó' => 'u', 'ô' => 'f', 'õ' => 'h', 'ö' => 'c',
		'÷' => 'ch', 'ø' => 'sh', 'ù' => 'sh', 'ú' => '', 'û' => 'y', 'ü' => '', 'ý' => 'e', 'þ' => 'yu',
		'ÿ' => 'ya',

		// Ukrainian
		'ª' => 'Ye', '²' => 'I', '¯' => 'Yi', '¥' => 'G',
		'º' => 'ye', '³' => 'i', '¿' => 'yi', '´' => 'g',

		// Czech
		'C' => 'C', 'D' => 'D', 'E' => 'E', 'N' => 'N', 'R' => 'R', 'S' => 'S', 'T' => 'T', 'U' => 'U', 
		'Z' => 'Z', 
		'c' => 'c', 'd' => 'd', 'e' => 'e', 'n' => 'n', 'r' => 'r', 's' => 's', 't' => 't', 'u' => 'u',
		'z' => 'z', 

		// Polish
		'A' => 'A', 'C' => 'C', 'E' => 'e', 'L' => 'L', 'N' => 'N', 'O' => 'o', 'S' => 'S', 'Z' => 'Z', 
		'Z' => 'Z', 
		'a' => 'a', 'c' => 'c', 'e' => 'e', 'l' => 'l', 'n' => 'n', 'o' => 'o', 's' => 's', 'z' => 'z',
		'z' => 'z',

		// Latvian
		'A' => 'A', 'C' => 'C', 'E' => 'E', 'G' => 'G', 'I' => 'i', 'K' => 'k', 'L' => 'L', 'N' => 'N', 
		'S' => 'S', 'U' => 'u', 'Z' => 'Z',
		'a' => 'a', 'c' => 'c', 'e' => 'e', 'g' => 'g', 'i' => 'i', 'k' => 'k', 'l' => 'l', 'n' => 'n',
		's' => 's', 'u' => 'u', 'z' => 'z'
	);
	
	// Make custom replacements
	$str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
	
	// Transliterate characters to ASCII
	if ($options['transliterate']) {
		$str = str_replace(array_keys($char_map), $char_map, $str);
	}
	
	// Replace non-alphanumeric characters with our delimiter
	$str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
	
	// Remove duplicate delimiters
	$str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
	
	// Truncate slug to max. characters
	$str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
	
	// Remove delimiter from ends
	$str = trim($str, $options['delimiter']);
	
	return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}
?>