<?php

define("WORD_LIMIT",3);
if(!class_exists('PhpTextSpinner'))
{
    class PhpTextSpinner {
        private $oldContent="";
        private $suggestContent=array();
        
        public function spinContentAlt($content){
            $this->oldContent=$content;
            $tmp=explode(" ",$this->oldContent);
            $c=count($tmp);
            for($i=0;$i<$c;$i++){
                $word=trim($tmp[$i]);
                $suggestions="";
                if(strlen($word)>WORD_LIMIT){
                    $url="http://freethesaurus.net/suggest.php?q=$word";			
                    $suggestions=$this->getHtmlCodeViaFopen($url);
                    if($suggestions === FALSE)
                    {
                        $suggestions = '';
                        $this->suggestContent[]=array($word,$suggestions);
                        continue;
                    }
                    $suggestions=str_replace("\r",", ",$suggestions);
                    $suggestions=str_replace("\n",", ",$suggestions);
                    $suggestions=str_replace("\r\n",", ",$suggestions);
                }
                $this->suggestContent[]=array($word,$suggestions);
            }		
            $c=count($this->suggestContent);
            for($i=0;$i<$c;$i++){
                $word=$this->suggestContent[$i][0];
                $temp=trim($this->suggestContent[$i][1]);			
                if(strlen($temp)>0){
                    $code="{";
                    $tmp=explode(",",$temp);
                    $ce=count($tmp);
                    for($j=0;$j<$ce;$j++){
                        $opt=trim($tmp[$j]);
                        if(!empty($opt)){
                            $code.="$opt|";
                        }
                    }
                    $opt=substr($opt,0,strlen($opt)-1);
                    $code.="}";
                    $this->oldContent=str_replace($word,$code,$this->oldContent);
                }
            }
            return $this->oldContent;
        }
        
        public function spinContent($content){
            $this->oldContent=$content;
            $tmp=explode(" ",$this->oldContent);
            $c=count($tmp);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $headers = array();
            $headers[] = "x-rapidapi-key: n5yuFj0HINmshz3BduR7dmPWIdqvp1NDfeYjsnVFNhLdP2V34g";$headers[] = "x-rapidapi-host: wikisynonyms.p.rapidapi.com";
            $headers[] = "Accept: application/json";
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            for($i=0;$i<$c;$i++){
                $word=trim($tmp[$i]);
                $suggestions="";
                if(strlen($word)>WORD_LIMIT && !preg_match('/[^A-Za-z]/', $word)){
                    curl_setopt($ch, CURLOPT_URL, "https://wikisynonyms.p.rapidapi.com/".$word);
                    $exec = curl_exec($ch);
                    if($exec === FALSE)
                    {
                        $suggestions = "";
                        $this->suggestContent[]=array($word,$suggestions);
                        continue;
                    }
                    $json = json_decode($exec);
                    
                    if(isset($json->http) && $json->http == '200')
                    {
                        if(isset($json->terms))
                        {
                            foreach($json->terms as $terms)
                            {
                                if(!preg_match('/[^A-Za-z0-9\-]/', $terms->term))
                                {
                                    $suggestions .= $terms->term . ', ';
                                }
                            }
                            $suggestions=trim($suggestions, ',');
                        }
                    }
                }
                $this->suggestContent[]=array($word, $suggestions);
            }
            curl_close($ch);        
            $c=count($this->suggestContent);
            for($i=0;$i<$c;$i++){
                $word=$this->suggestContent[$i][0];
                $temp=trim($this->suggestContent[$i][1]);			
                if(strlen($temp)>0){
                    $code="{";
                    $tmp=explode(",",$temp);
                    $ce=count($tmp);
                    for($j=0;$j<$ce;$j++){
                        $opt=trim($tmp[$j]);
                        if(!empty($opt)){
                            $code.="$opt|";
                        }
                    }
                    $opt=substr($opt,0,strlen($opt)-1);
                    $code.="}";
                    $this->oldContent=str_replace($word,$code,$this->oldContent);
                }
            }
            return $this->oldContent;
        }
        
        function runTextSpinnerSingle($content){
            $returnArray=array();
            $pattern="/{(.*)}/Uis";
            preg_match_all($pattern, $content, $returnArray, PREG_SET_ORDER);
            foreach($returnArray as $return){
                $code=$return[0];
                $str=$return[1];
                $str=substr($str,0,strlen($str)-1);
                $tmp=explode("|",$str);
                $c=count($tmp);
                $rand=rand(0,($c-1));			
                $word=$tmp[$rand];
                $content=str_replace($code,$word,$content);
            }
            return $content;
        }
        
        function runTextSpinner($content){
            $returnArray=array();
            $pattern="/\{[^\{]+?\}/ixsm";
            preg_match_all($pattern, $content, $returnArray, PREG_SET_ORDER);
            foreach($returnArray as $return){
                $code=$return[0];  
                $str=str_replace("{","",$code);
                $str=str_replace("}","",$str);   
                $tmp=explode("|",$str);
                $c=count($tmp);
                $rand=rand(0,($c-1));   
                $word=$tmp[$rand];
                $content=str_replace($code,$word,$content);
            }  
            $pos=strpos($content,"{");
            if($pos===false){
                return $content;
            } 
            else{
                return $this->runTextSpinner($content);
            } 
        }
        
        private function getHtmlCodeViaFopen($url){
            $returnStr="";
            $fp=fopen($url, "r");
            if($fp === FALSE)
            {
                return FALSE;
            }
            while (!feof($fp)) {
                $returnStr.=fgetc($fp);
            }
            fclose($fp);
            return $returnStr;
        }
    }
}
?>