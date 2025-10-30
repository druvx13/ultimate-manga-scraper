<?php
class GoogleTranslatorAPI{
	public $ch;
    public $apikey;
	function __construct(&$ch, $apikey){
		$this->ch = $ch;
        $this->apikey = $apikey;
	}
	function translateText($sourceText, $fromLanguage ,$toLanguage){
        preg_match_all ( '{\[\d*\]}', $sourceText, $all_protected_matchs );
		$all_protected_matchs = $all_protected_matchs [0];
		$string_raw = preg_replace ( '{\[\d*\]}', '(*)', $sourceText );
        curl_setopt($this->ch, CURLOPT_URL, "https://www.googleapis.com/language/translate/v2?key=" . $this->apikey);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_POST, true );
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 60);
		$post = [
				'q' => $string_raw,
				'target'   => $toLanguage,
		];
        if($fromLanguage != 'auto')
        {
            $post['source']   = $fromLanguage;
        }
        curl_setopt ( $this->ch, CURLOPT_POSTFIELDS, $post );
		$headers = array();
		
		$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
		$headers[] = "Accept-Language: en-US,en;q=0.5";
		$headers[] = "Referer: https://translate.google.com/?tr=f&hl=en";
		$headers[] = "Connection: keep-alive";
		$headers[] = "Upgrade-Insecure-Requests: 1";
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
		$exec = curl_exec($this->ch);
        $httpcode = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
        if($httpcode != '200')
        {
            throw new Exception('Failed to translate string, incorrect response ' . $httpcode . ' - ' . $exec);
        }
		if($exec === FALSE || trim($exec) == ''){
			throw new Exception('Empty translator reply with possible curl error');
		}
        if(strstr($exec, 'Error 400 (Bad Request)!!1') !== false){
			throw new Exception('Failed to translate string!');
		}
        $jsonx = json_decode($exec);
        if(isset($jsonx->data->translations) && is_array($jsonx->data->translations))
        {
            $retex = '';
            foreach($jsonx->data->translations as $trx)
            {
                $retex .= $trx->translatedText;
            }
            $exec = $retex;
        }
        else
        {
            throw new Exception('Failed to decode translation response: ' . $exec);
        }
        foreach ( $all_protected_matchs as $protected_term ) {
			$exec = preg_replace ( '{\(\*\)}', $protected_term, $exec, 1 );
		}
		return $exec ;
	}
}
?>