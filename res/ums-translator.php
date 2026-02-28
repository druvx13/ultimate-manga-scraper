<?php
/*
 * Copyright (C) 2026 NIKOL
 * Licensed under LUCA Free License v1.0
 * DO WHAT THE FUCK YOU WANT TO.
 */
﻿<?php
class GoogleTranslator {
	public $ch;
	function __construct(&$ch) {
		$this->ch = $ch;
	}
	function translateText($sourceText, $fromLanguage, $toLanguage)
	{
		if(get_option('coderevo_translate_alt') == '1')
		{
			return $this->translateText_new($sourceText, $fromLanguage, $toLanguage);
		}
		else
		{
			return $this->translateText_old($sourceText, $fromLanguage, $toLanguage);
		}
	}
	function translateText_new($sourceText, $fromLanguage, $toLanguage) {
		$string = $sourceText;
		preg_match_all ( '{\[\d*\]}', $string, $all_protected_matchs );
		$all_protected_matchs = $all_protected_matchs [0];
		$string = preg_replace ( '{\[\d*\]}', '(*)', $string );
		$string_arr = explode ( '(*)', $string );
		$string_raw = implode ( '', $string_arr );
		$string_enc = '';
		$i = 0;
		foreach ( $string_arr as $single_string ) {
			if ($i == 0) {
				$string_enc = 'q=' . urlencode ( $single_string );
			} else {
				$string_enc .= '&q=' . urlencode ( $single_string );
			}
			$i++;
		}
		$string_raw = implode ( '', $string_arr );
		$article_size = function_exists ( 'mb_strlen' ) ? mb_strlen ( $string_raw ) : strlen ( $string_raw );
		
		if ($article_size > 13000) {
			throw new Exception ( 'Translated article is very long, it exceeds the limit of 13000 chars' );
		}
		$tkk = $this->generateTkk ();
		$tk = $this->generateTk ( $string_raw, $tkk );
		if ($fromLanguage == 'auto')
			$fromLanguage = 'auto';
		$args = [ 
				'anno' => 3,
				'client' => 'te_lib',
				'format' => 'html',
				'v' => '1.0',
				'key' => 'AIzaSyBOti4mM-6x9WDnZIjIeyEU21OpBXqWBgw',
				'logld' => 'vTE_20230725',
				'sl' => $fromLanguage,
				'tl' => $toLanguage,
				'sp' => 'nmt',
				'tc' => 1,
				'sr' => 1,
				'tk' => $tk,
				'mode' => 1 
		];
		
		$curlurl = 'https://translate.googleapis.com/translate_a/t?' . http_build_query ( $args );
		$curlpost = $string_enc;
		curl_setopt ( $this->ch, CURLOPT_URL, $curlurl );
		curl_setopt ( $this->ch, CURLOPT_POST, true );
		curl_setopt ( $this->ch, CURLOPT_POSTFIELDS, $curlpost );
		curl_setopt ( $this->ch, CURLOPT_TIMEOUT, 20 );
		curl_setopt ( $this->ch, CURLOPT_HEADER, 0 );
		curl_setopt ( $this->ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $this->ch, CURLOPT_CONNECTTIMEOUT, 10 );
		curl_setopt ( $this->ch, CURLOPT_TIMEOUT, 200 );
		curl_setopt ( $this->ch, CURLOPT_REFERER, 'http://www.bing.com/' );
		curl_setopt ( $this->ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 15_0_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36' );
		curl_setopt ( $this->ch, CURLOPT_MAXREDIRS, 20 );
		curl_setopt ( $this->ch, CURLOPT_FOLLOWLOCATION, 1 );
		$x = 'error';
		$exec = curl_exec ( $this->ch );
		$x = curl_error ( $this->ch );
		
		if (trim ( $exec ) == '' || trim ( $exec ) == '""') {
			throw new Exception ( 'Empty response from gtranslate ' . $x );
		}
		if (strpos ( $exec, 'Error 403' )) {
			throw new Exception ( 'Google returned forbidden which means proxies may be needed on the plugin settings page' );
		}
		$json_result = json_decode ( $exec );
		if(is_array($json_result [0]))
		{
			$json_changed = [];
			foreach($json_result as $jrez)
			{
				if(is_array($jrez) && isset($jrez[0]))
				{
					$json_changed[] = $jrez[0];
				}
			}
			if(!empty($json_changed))
			{
				$json_result = $json_changed;
			}
		}
		if (! isset ( $json_result [0] )) {
			throw new Exception ( 'Can not get JSON from returned response: ' . $exec );
		}
		$json_result_new= [];
		foreach($json_result as $json_array){
		
			if(is_array($json_array)){
				$json_result_new[] = $json_array[0];
			}else{
				$json_result_new[] = $json_array;
			}
			
		}
		$json_result = $json_result_new;
		$returned_text_plain = implode ( '(*)', $json_result );
		$returned_text_plain = preg_replace ( '{<i>.*?</i>}s', '', $returned_text_plain );
		$returned_text_plain = str_replace ( array (
				'<b>',
				'</b>' 
		), '', $returned_text_plain );
		foreach ( $all_protected_matchs as $protected_term ) {
			$returned_text_plain = preg_replace ( '{\(\*\)}', $protected_term, $returned_text_plain, 1 );
		}
		$translated = $returned_text_plain = str_replace ( '(*)', '', $returned_text_plain );
		return $translated;
	}
	private function generateTkk() {
		global $wp_filesystem;
		if ( ! is_a( $wp_filesystem, 'WP_Filesystem_Base') ){
			include_once(ABSPATH . 'wp-admin/includes/file.php');$creds = request_filesystem_credentials( site_url() );
			wp_filesystem($creds);
		}
		$upload_dir = wp_upload_dir ();
		$cache = $upload_dir ['basedir'] . '/tkk.cache';
		if ($wp_filesystem->exists ( $cache ) && filemtime ( $cache ) > strtotime ( 'now - 1 hour' )) {
			
			return $wp_filesystem->get_contents ( $cache );
		}
		$x = 'error';
		$url = 'https://translate.googleapis.com/translate_a/element.js';
		curl_setopt ( $this->ch, CURLOPT_HTTPGET, 1 );
		curl_setopt ( $this->ch, CURLOPT_URL, trim ( $url ) );
		curl_setopt ( $this->ch, CURLOPT_HEADER, 0 );
		curl_setopt ( $this->ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $this->ch, CURLOPT_CONNECTTIMEOUT, 10 );
		curl_setopt ( $this->ch, CURLOPT_TIMEOUT, 200 );
		curl_setopt ( $this->ch, CURLOPT_REFERER, 'http://www.bing.com/' );
		curl_setopt ( $this->ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 15_0_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36' );
		curl_setopt ( $this->ch, CURLOPT_MAXREDIRS, 20 );
		curl_setopt ( $this->ch, CURLOPT_FOLLOWLOCATION, 1 );
		$data = curl_exec ( $this->ch );
		$response = $data;
		if(strstr($response, 'c._ctkk=\'') === false)
		{
			throw new Exception ( 'Failed to generate tkk' );
		}
		$pos1 = strpos ( $response, 'c._ctkk=\'' ) + strlen ( 'c._ctkk=\'' );
		$pos2 = strpos ( $response, '\'', $pos1 );
		$tkk = substr ( $response, $pos1, $pos2 - $pos1 );
		$wp_filesystem->put_contents ( $cache, $tkk );
		return $tkk;
	}
	private function generateTk($f0, $w1) {
		if(!function_exists('mb_convert_encoding'))
		{
			return rand(77835, 519192) . '.' . rand(75055, 522556);
		}
		$w1 = explode ( '.', $w1 );
		$n2 = $w1 [0];
		for($j3 = [ ], $t4 = 0, $h5 = 0; $h5 < strlen ( mb_convert_encoding ( $f0, 'UTF-16LE', 'UTF-8' ) ) / 2; $h5 ++) {
			$z6 = ord ( mb_convert_encoding ( $f0, 'UTF-16LE', 'UTF-8' ) [$h5 * 2] ) + (ord ( mb_convert_encoding ( $f0, 'UTF-16LE', 'UTF-8' ) [$h5 * 2 + 1] ) << 8);
			if (128 > $z6) {
				$j3 [$t4 ++] = $z6;
			} else {
				if (2048 > $z6) {
					$j3 [$t4 ++] = ($z6 >> 6) | 192;
				} else {
					if (55296 == ($z6 & 64512) && $h5 + 1 < strlen ( mb_convert_encoding ( $f0, 'UTF-16LE', 'UTF-8' ) ) / 2 && 56320 == ((ord ( mb_convert_encoding ( $f0, 'UTF-16LE', 'UTF-8' ) [($h5 + 1) * 2] ) + (ord ( mb_convert_encoding ( $f0, 'UTF-16LE', 'UTF-8' ) [($h5 + 1) * 2 + 1] ) << 8)) & 64512)) {
						$h5 ++;
						$z6 = 65536 + (($z6 & 1023) << 10) + ((ord ( mb_convert_encoding ( $f0, 'UTF-16LE', 'UTF-8' ) [$h5 * 2] ) + (ord ( mb_convert_encoding ( $f0, 'UTF-16LE', 'UTF-8' ) [$h5 * 2 + 1] ) << 8)) & 1023);
						$j3 [$t4 ++] = ($z6 >> 18) | 240;
						$j3 [$t4 ++] = (($z6 >> 12) & 63) | 128;
					} else {
						$j3 [$t4 ++] = ($z6 >> 12) | 224;
					}
					$j3 [$t4 ++] = (($z6 >> 6) & 63) | 128;
				}
				$j3 [$t4 ++] = ($z6 & 63) | 128;
			}
		}
		$f0 = $n2;
		for($t4 = 0; $t4 < count ( $j3 ); $t4 ++) {
			$f0 += $j3 [$t4];
			$c7 = $f0;
			$x8 = '+-a^+6';
			for($r9 = 0; $r9 < strlen ( $x8 ) - 2; $r9 += 3) {
				$u10 = $x8 [$r9 + 2];
				$u10 = 'a' <= $u10 ? ord ( $u10 [0] ) - 87 : intval ( $u10 );
				$a11 = $c7;
				$c12 = $u10;
				if ($c12 >= 32 || $c12 < - 32) {
					$c13 = ( int ) ($c12 / 32);
					$c12 = $c12 - $c13 * 32;
				}
				if ($c12 < 0) {
					$c12 = 32 + $c12;
				}
				if ($c12 == 0) {
					return (($a11 >> 1) & 0x7fffffff) * 2 + (($a11 >> $c12) & 1);
				}
				if ($a11 < 0) {
					$a11 = $a11 >> 1;
					$a11 &= 2147483647;
					$a11 |= 0x40000000;
					$a11 = $a11 >> $c12 - 1;
				} else {
					$a11 = $a11 >> $c12;
				}
				$b14 = $a11;
				$u10 = '+' == $x8 [$r9 + 1] ? $b14 : $c7 << $u10;
				$c7 = '+' == $x8 [$r9] ? ($c7 + $u10) & 4294967295 : $c7 ^ $u10;
			}
			$f0 = $c7;
		}
		$c7 = $f0;
		$x8 = '+-3^+b+-f';
		for($r9 = 0; $r9 < strlen ( $x8 ) - 2; $r9 += 3) {
			$u10 = $x8 [$r9 + 2];
			$u10 = 'a' <= $u10 ? ord ( $u10 [0] ) - 87 : intval ( $u10 );
			$a11 = $c7;
			$c12 = $u10;
			if ($c12 >= 32 || $c12 < - 32) {
				$c13 = ( int ) ($c12 / 32);
				$c12 = $c12 - $c13 * 32;
			}
			if ($c12 < 0) {
				$c12 = 32 + $c12;
			}
			if ($c12 == 0) {
				return (($a11 >> 1) & 0x7fffffff) * 2 + (($a11 >> $c12) & 1);
			}
			if ($a11 < 0) {
				$a11 = $a11 >> 1;
				$a11 &= 2147483647;
				$a11 |= 0x40000000;
				$a11 = $a11 >> $c12 - 1;
			} else {
				$a11 = $a11 >> $c12;
			}
			$b14 = $a11;
			$u10 = '+' == $x8 [$r9 + 1] ? $b14 : $c7 << $u10;
			$c7 = '+' == $x8 [$r9] ? ($c7 + $u10) & 4294967295 : $c7 ^ $u10;
		}
		$f0 = $c7;
		$f0 ^= $w1 [1] ? $w1 [1] + 0 : 0;
		if (0 > $f0) {
			$f0 = ($f0 & 2147483647) + 2147483648;
		}
		$f0 = fmod ( $f0, pow ( 10, 6 ) );
		return $f0 . '.' . ($f0 ^ $n2);
	}
	function translateText_old($sourceText, $fromLanguage, $toLanguage){
		if (function_exists('tmpfile')) 
		{
			$tempHnd = tmpfile();
			$metaDatas = stream_get_meta_data($tempHnd);
			$tmpFileUri = $metaDatas['uri'];
		} else {
			$tmpFileUri = sys_get_temp_dir() . '/tempfile_' . uniqid() . '.tmp';
			$tempHnd = fopen($tmpFileUri, 'w+');
		}
		fwrite($tempHnd, $sourceText);
		curl_setopt($this->ch, CURLOPT_URL, "https://translate.googleusercontent.com/translate_f");
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_POST, true );
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 60);
		if( class_exists('CurlFile')){
			$curlFile = new \CurlFile( $tmpFileUri, 'text/plain', 'test.txt');
		}else{
			$curlFile = '@'.$tmpFileUri.';type=text/plain;filename=test.txt';
		}
		$post = [
				'file' => $curlFile,
				'sl'   => $fromLanguage,
				'tl'   => $toLanguage,
				'js'   => 'y',
				'prev' => '_t',
				'hl'   => 'en',
				'ie'   => 'UTF-8',
                'oe'   => 'UTF-8'
		];
		curl_setopt ( $this->ch, CURLOPT_POSTFIELDS, $post );
		$headers = [];
		
		$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
		$headers[] = "Accept-Language: en-US,en;q=0.5";
		$headers[] = "Referer: https://translate.google.com/?tr=f&hl=en";
		$headers[] = "Connection: keep-alive";
		$headers[] = "Upgrade-Insecure-Requests: 1";
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
		$exec = curl_exec($this->ch);
		fclose($tempHnd);
        $httpcode = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
        if($httpcode != '200')
        {
			update_option('coderevo_translate_alt', '1');
            throw new Exception('Failed to translate string, incorrect response ' . $httpcode . ' - ' . $exec);
        }
		if($exec === FALSE || trim($exec) == ''){
			throw new Exception('Empty translator reply with possible curl error');
		}
            require_once (dirname(__FILE__) . "/simple_html_dom.php");
            $strip_list = array('google-src-active-text','google-src-text', 'spinner-container');$exec = str_replace('）', ')', $exec);$exec = str_replace('（', '(', $exec);
            $html_dom_original_html = ums_str_get_html($exec);
            if($html_dom_original_html !== false && method_exists($html_dom_original_html, 'find')){
                foreach ($strip_list as $strip_class) {
                    if(trim($strip_class) == '')
                    {
                        continue;
                    }
                    $ret = $html_dom_original_html->find('*[class="'.trim($strip_class).'"]');
                    foreach ($ret as $itm ) {
                        $itm->outertext = '' ;
                    }
                }
                $exec = $html_dom_original_html->save();
                $html_dom_original_html->clear();
                unset($html_dom_original_html);
            }
		return $exec ;
	}
}
?>