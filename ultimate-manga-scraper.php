<?php
/**
 * Plugin Name: Ultimate Web Novel & Manga Scraper
 * Plugin URI: https://github.com/druvx13/ultimate-manga-scraper
 * Description: This plugin will scrape manga for you, day and night
 * Author: NIKOL
 * Version: 2.0.3
 * Author URI: https://github.com/druvx13/ultimate-manga-scraper
 * License: LUCA Free License v1.0
 * License URI: https://github.com/druvx13/ultimate-manga-scraper/blob/main/LICENSE
 * Text Domain: ultimate-manga-scraper
 * 
 * Copyright (C) 2026 NIKOL
 * Licensed under LUCA Free License v1.0
 * DO WHAT THE FUCK YOU WANT TO.
 */
defined('ABSPATH') or die();
require_once (dirname(__FILE__) . "/res/other/plugin-dash.php"); 

function ums_load_textdomain() {
    if(!function_exists('ot_get_option'))
    {
        function ot_get_option($nname)
        {
            return get_option($nname);
        }
    }
    load_plugin_textdomain( 'ultimate-manga-scraper', false, basename( dirname( __FILE__ ) ) . '/languages' ); 
}
add_action( 'init', 'ums_load_textdomain' );

function ums_isSecure() {
    return
      (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
      || $_SERVER['SERVER_PORT'] == 443;
}

function ums_redirect($url, $statusCode = 301)
{
   if(!function_exists('wp_redirect'))
   {
       include_once( ABSPATH . 'wp-includes/pluggable.php' );
   }
   wp_redirect($url, $statusCode);
   die();
}
$language_names = array(
    "Disabled",
    "Afrikaans (Google Translate)",
    "Albanian (Google Translate)",
    "Arabic (Google Translate)",
    "Amharic (Google Translate)",
    "Armenian (Google Translate)",
    "Belarusian (Google Translate)",
    "Bulgarian (Google Translate)",
    "Catalan (Google Translate)",
    "Chinese Simplified (Google Translate)",
    "Croatian (Google Translate)",
    "Czech (Google Translate)",
    "Danish (Google Translate)",
    "Dutch (Google Translate)",
    "English (Google Translate)",
    "Estonian (Google Translate)",
    "Filipino (Google Translate)",
    "Finnish (Google Translate)",
    "French (Google Translate)",
    "Galician (Google Translate)",
    "German (Google Translate)",
    "Greek (Google Translate)",
    "Hebrew (Google Translate)",
    "Hindi (Google Translate)",
    "Hungarian (Google Translate)",
    "Icelandic (Google Translate)",
    "Indonesian (Google Translate)",
    "Irish (Google Translate)",
    "Italian (Google Translate)",
    "Japanese (Google Translate)",
    "Korean (Google Translate)",
    "Latvian (Google Translate)",
    "Lithuanian (Google Translate)",
    "Norwegian (Google Translate)",
    "Macedonian (Google Translate)",
    "Malay (Google Translate)",
    "Maltese (Google Translate)",
    "Persian (Google Translate)",
    "Polish (Google Translate)",
    "Portuguese (Google Translate)",
    "Romanian (Google Translate)",
    "Russian (Google Translate)",
    "Serbian (Google Translate)",
    "Slovak (Google Translate)",
    "Slovenian (Google Translate)",
    "Spanish (Google Translate)",
    "Swahili (Google Translate)",
    "Swedish (Google Translate)",
    "Thai (Google Translate)",
    "Turkish (Google Translate)",
    "Ukrainian (Google Translate)",
    "Vietnamese (Google Translate)",
    "Welsh (Google Translate)",
    "Yiddish (Google Translate)",
    "Tamil (Google Translate)",
    "Azerbaijani (Google Translate)",
    "Kannada (Google Translate)",
    "Basque (Google Translate)",
    "Bengali (Google Translate)",
    "Latin (Google Translate)",
    "Chinese Traditional (Google Translate)",
    "Esperanto (Google Translate)",
    "Georgian (Google Translate)",
    "Telugu (Google Translate)",
    "Gujarati (Google Translate)",
    "Haitian Creole (Google Translate)",
    "Urdu (Google Translate)",
        
    "Burmese (Google Translate)",
    "Bosnian (Google Translate)",
    "Cebuano (Google Translate)",
    "Chichewa (Google Translate)",
    "Corsican (Google Translate)",
    "Frisian (Google Translate)",
    "Scottish Gaelic (Google Translate)",
    "Hausa (Google Translate)",
    "Hawaian (Google Translate)",
    "Hmong (Google Translate)",
    "Igbo (Google Translate)",
    "Javanese (Google Translate)",
    "Kazakh (Google Translate)",
    "Khmer (Google Translate)",
    "Kurdish (Google Translate)",
    "Kyrgyz (Google Translate)",
    "Lao (Google Translate)",
    "Luxembourgish (Google Translate)",
    "Malagasy (Google Translate)",
    "Malayalam (Google Translate)",
    "Maori (Google Translate)",
    "Marathi (Google Translate)",
    "Mongolian (Google Translate)",
    "Nepali (Google Translate)",
    "Pashto (Google Translate)",
    "Punjabi (Google Translate)",
    "Samoan (Google Translate)",
    "Sesotho (Google Translate)",
    "Shona (Google Translate)",
    "Sindhi (Google Translate)",
    "Sinhala (Google Translate)",
    "Somali (Google Translate)",
    "Sundanese (Google Translate)",
    "Swahili (Google Translate)",
    "Tajik (Google Translate)",
    "Uzbek (Google Translate)",
    "Xhosa (Google Translate)",
    "Yoruba (Google Translate)",
    "Zulu (Google Translate)",
    
    "Assammese (Google Translate)",
    "Aymara (Google Translate)",
    "Bambara (Google Translate)",
    "Bhojpuri (Google Translate)",
    "Dhivehi (Google Translate)",
    "Dogri (Google Translate)",
    "Ewe (Google Translate)",
    "Guarani (Google Translate)",
    "Ilocano (Google Translate)",
    "Kinyarwanda (Google Translate)",
    "Konkani (Google Translate)",
    "Krio (Google Translate)",
    "Kurdish - Sorani (Google Translate)",
    "Lingala (Google Translate)",
    "Luganda (Google Translate)",
    "Maithili (Google Translate)",
    "Meiteilon (Google Translate)",
    "Mizo (Google Translate)",
    "Odia (Google Translate)",
    "Oromo (Google Translate)",
    "Quechua (Google Translate)",
    "Sanskrit (Google Translate)",
    "Sepedi (Google Translate)",
    "Tatar (Google Translate)",
    "Tigrinya (Google Translate)",
    "Tsonga (Google Translate)",
    "Turkmen (Google Translate)",
    "Twi (Google Translate)",
    "Uyghur (Google Translate)"
);
$language_codes = array(
    "disabled",
    "af",
    "sq",
    "ar",
    "am",
    "hy",
    "be",
    "bg",
    "ca",
    "zh-CN",
    "hr",
    "cs",
    "da",
    "nl",
    "en",
    "et",
    "tl",
    "fi",
    "fr",
    "gl",
    "de",
    "el",
    "iw",
    "hi",
    "hu",
    "is",
    "id",
    "ga",
    "it",
    "ja",
    "ko",
    "lv",
    "lt",
    "no",
    "mk",
    "ms",
    "mt",
    "fa",
    "pl",
    "pt",
    "ro",
    "ru",
    "sr",
    "sk",
    "sl",
    "es",
    "sw",
    "sv",   
    "th",
    "tr",
    "uk",
    "vi",
    "cy",
    "yi",
    "ta",
    "az",
    "kn",
    "eu",
    "bn",
    "la",
    "zh-TW",
    "eo",
    "ka",
    "te",
    "gu",
    "ht",
    "ur",
    
    "my",
    "bs",
    "ceb",
    "ny",
    "co",
    "fy",
    "gd",
    "ha",
    "haw",
    "hmn",
    "ig",
    "jw",
    "kk",
    "km",
    "ku",
    "ky",
    "lo",
    "lb",
    "mg",
    "ml",
    "mi",
    "mr",
    "mn",
    "ne",
    "ps",
    "pa",
    "sm",
    "st",
    "sn",
    "sd",
    "si",
    "so",
    "su",
    "sw",
    "tg",
    "uz",
    "xh",
    "yo",
    "zu",

    "as",
    "ay",
    "bm",
    "bho",
    "dv",
    "doi",
    "ee",
    "gn",
    "ilo",
    "rw",
    "gom",
    "kri",
    "ckb",
    "ln",
    "lg",
    "mai",
    "mni-Mtei",
    "lus",
    "or",
    "om",
    "qu",
    "sa",
    "nso",
    "tt",
    "ti",
    "ts",
    "tk",
    "ak",
    "ug"
);
$language_names_deepl = array(
 "English (DeepL)",
 "German (DeepL)",
 "French (DeepL)",
 "Spanish (DeepL)",
 "Italian (DeepL)",
 "Dutch (DeepL)",
 "Polish (DeepL)",
 "Russian (DeepL)",
 "Portuguese (DeepL)",
 "Chinese (DeepL)",
 "Japanese (DeepL)",
 "Bulgarian (DeepL)",
 "Czech (DeepL)",
 "Danish (DeepL)",
 "Greek (DeepL)",
 "Estonian (DeepL)",
 "Finnish (DeepL)",
 "Hungarian (DeepL)",
 "Lithuanian (DeepL)",
 "Latvian (DeepL)",
 "Romanian (DeepL)",
 "Slovak (DeepL)",
 "Slovenian (DeepL)",
 "Swedish (DeepL)",
 "Indonesian (DeepL)",
 "Turkish (DeepL)",
 "Korean (DeepL)",
 "Norwegian (DeepL)",
 "Ukrainian (DeepL)",
"Arabic (DeepL)",
"Hebrew (DeepL)",
"Thai (DeepL)",
"Vietnamese (DeepL)"
 );
 $language_codes_deepl = array(
     "EN-",
     "DE-",
     "FR-",
     "ES-",
     "IT-",
     "NL-",
     "PL-",
     "RU-",
     "PT-",
     "ZH-",
     "JA-",
     "BG-",
     "CS-",
     "DA-",
     "EL-",
     "ET-",
     "FI-",
     "HU-",
     "LT-",
     "LV-",
     "RO-",
     "SK-",
     "SL-",
     "SV-",
     "ID-",
     "TR-",
     "KO-",
     "NB-",
     "UK-",
    "AR-",
    "HE-",
    "TH-",
    "VI-"
 );
 $language_names_bing = array(
    "English (Microsoft Translator)",
    "Arabic (Microsoft Translator)",
    "Bosnian (Latin) (Microsoft Translator)",
    "Bulgarian (Microsoft Translator)",
    "Catalan (Microsoft Translator)",
    "Chinese Simplified (Microsoft Translator)",
    "Chinese Traditional (Microsoft Translator)",
    "Croatian (Microsoft Translator)",
    "Czech (Microsoft Translator)",
    "Danish (Microsoft Translator)",
    "Dutch (Microsoft Translator)",
    "Estonian (Microsoft Translator)",
    "Finnish (Microsoft Translator)",
    "French (Microsoft Translator)",
    "German (Microsoft Translator)",
    "Greek (Microsoft Translator)",
    "Haitian Creole (Microsoft Translator)",
    "Hebrew (Microsoft Translator)",
    "Hindi (Microsoft Translator)",
    "Hmong Daw (Microsoft Translator)",
    "Hungarian (Microsoft Translator)",
    "Indonesian (Microsoft Translator)",
    "Italian (Microsoft Translator)",
    "Japanese (Microsoft Translator)",
    "Kiswahili (Microsoft Translator)",
    "Klingon (Microsoft Translator)",
    "Klingon (pIqaD) (Microsoft Translator)",
    "Korean (Microsoft Translator)",
    "Latvian (Microsoft Translator)",
    "Lithuanian (Microsoft Translator)",
    "Malay (Microsoft Translator)",
    "Maltese (Microsoft Translator)",
    "Norwegian (Microsoft Translator)",
    "Persian (Microsoft Translator)",
    "Polish (Microsoft Translator)",
    "Portuguese (Microsoft Translator)",
    "Queretaro Otomi (Microsoft Translator)",
    "Romanian (Microsoft Translator)",
    "Russian (Microsoft Translator)",
    "Serbian (Cyrillic) (Microsoft Translator)",
    "Serbian (Latin) (Microsoft Translator)",
    "Slovak (Microsoft Translator)",
    "Slovenian (Microsoft Translator)",
    "Spanish (Microsoft Translator)",
    "Swedish (Microsoft Translator)",
    "Thai (Microsoft Translator)",
    "Turkish (Microsoft Translator)",
    "Ukrainian (Microsoft Translator)",
    "Urdu (Microsoft Translator)",
    "Vietnamese (Microsoft Translator)",
    "Welsh (Microsoft Translator)",
    "Yucatec Maya (Microsoft Translator)",
  
    "Afrikaans (Microsoft Translator)",
    "Albanian (Microsoft Translator)",
    "Amharic (Microsoft Translator)",
    "Armenian (Microsoft Translator)",
    "Assamese (Microsoft Translator)",
    "Azerbaijani (Microsoft Translator)",
    "Bangla (Microsoft Translator)", 
    "Bashkir (Microsoft Translator)",
    "Basque (Microsoft Translator)",
    "Cantonese (Microsoft Translator)",
    "Chinese (Literary) (Microsoft Translator)",
    "Dari (Microsoft Translator)",
    "Divehi (Microsoft Translator)",
    "Faroese (Microsoft Translator)",
    "Fijian (Microsoft Translator)",
    "Filipino (Microsoft Translator)",
    "French (Canada) (Microsoft Translator)",
    "Galician (Microsoft Translator)",
    "Georgian (Microsoft Translator)",
    "Gujarati (Microsoft Translator)",
    "Icelandic (Microsoft Translator)",
    "Inuinnaqtun (Microsoft Translator)",
    "Inuktitut (Microsoft Translator)",
    "Inuktitut (Latin) (Microsoft Translator)",
    "Irish (Microsoft Translator)",
    "Kannada (Microsoft Translator)",
    "Kazakh (Microsoft Translator)",
    "Khmer (Microsoft Translator)",
    "Kurdish (Central) (Microsoft Translator)",
    "Kurdish (Northern) (Microsoft Translator)",
    "Kyrgyz (Cyrillic) (Microsoft Translator)",
    "Lao (Microsoft Translator)",
    "Macedonian (Microsoft Translator)",
    "Malagasy (Microsoft Translator)",
    "Malayalam (Microsoft Translator)",
    "Maori (Microsoft Translator)",
    "Marathi (Microsoft Translator)",
    "Mongolian (Cyrillic) (Microsoft Translator)",
    "Mongolian (Traditional) (Microsoft Translator)",
    "Myanmar (Microsoft Translator)",
    "Nepali (Microsoft Translator)",
    "Odia (Microsoft Translator)",
    "Pashto (Microsoft Translator)",
    "Portuguese (Portugal) (Microsoft Translator)",
    "Punjabi (Microsoft Translator)",
    "Samoan (Microsoft Translator)",
    "Somali (Arabic) (Microsoft Translator)",
    "Swahili (Latin) (Microsoft Translator)",
    "Tahitian (Microsoft Translator)",
    "Tamil (Microsoft Translator)",
    "Tatar (Latin) (Microsoft Translator)",
    "Telugu (Microsoft Translator)",
    "Tibetan (Microsoft Translator)",
    "Tigrinya (Microsoft Translator)",
    "Tongan (Microsoft Translator)",
    "Turkmen (Latin) (Microsoft Translator)",
    "Upper Sorbian (Microsoft Translator)",
    "Uyghur (Arabic) (Microsoft Translator)",
    "Uzbek (Microsoft Translator)",
    "Zulu (Microsoft Translator)"
    );

    $language_codes_bing = array(
        "en!",
        "ar!",
        "bs-Latn!",
        "bg!",
        "ca!",
        "zh-CHS!",
        "zh-CHT!",
        "hr!",
        "cs!",
        "da!",
        "nl!",
        "et!",
        "fi!",
        "fr!",
        "de!",
        "el!",
        "ht!",
        "he!",
        "hi!",
        "mww!",
        "hu!",
        "id!",
        "it!",
        "ja!",
        "sw!",
        "tlh!",
        "tlh-Qaak!",
        "ko!",
        "lv!",
        "lt!",
        "ms!",
        "mt!",
        "nor!",
        "fa!",
        "pl!",
        "pt!",
        "otq!",
        "ro!",
        "ru!",
        "sr-Cyrl!",
        "sr-Latn!",
        "sk!",
        "sl!",
        "es!",
        "sv!",
        "th!",
        "tr!",
        "uk!",
        "ur!",
        "vi!",
        "cy!",
        "yua!",
        
        "af!",
        "sq!",
        "am!",
        "hy!",
        "as!",
        "az!",
        "bn!",
        "ba!",
        "eu!",
        "yue!",
        "lzh!",
        "prs!",
        "dv!",
        "fo!",
        "fj!",
        "fil!",
        "fr-ca!",
        "gl!",
        "ka!",
        "gu!",
        "is!",
        "ikt!",
        "iu!",
        "iu-Latn!",
        "ga!",
        "kn!",
        "kk!",
        "km!",
        "ku!",
        "kmr!",
        "ky!",
        "lo!",
        "mk!",
        "mg!",
        "ml!",
        "mi!",
        "mr!",
        "mn-Cyrl!",
        "mn-Mong!",
        "my!",
        "ne!",
        "or!",
        "ps!",
        "pt-pt!",
        "pa!",
        "sm!",
        "so!",
        "sw!",
        "ty!",
        "ta!",
        "tt!",
        "te!",
        "bo!",
        "ti!",
        "to!",
        "tk!",
        "hsb!",
        "ug!",
        "uz!",
        "zu!"
    );
function ums_get_random_user_agent($ua = '') {
	if($ua != '')
	{
		return $ua;
	}
	$os_type = rand(1, 3);
    $chrome_version = rand(100, 108) . '.0.' . rand(1, 4044) . '.' . rand(0, 138);
    if ($os_type == 1) {
        $agent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36";
    } elseif ($os_type == 2) {
        $agent = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36";
        $mac_version = "10_" . rand(6, 15) . "_" . rand(1, 4);
        $agent = str_replace('10_15_4', $mac_version, $agent);
    } elseif ($os_type == 3) {
        $agent = "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36";
    }
    $agent = str_replace("81.0.4044.138", $chrome_version, $agent);
    return $agent;
}
function ums_assign_var(&$target, $var, $root = false) {
	static $cnt = 0;
    $key = key($var);
    if(is_array($var[$key])) 
        ums_assign_var($target[$key], $var[$key], false);
    else {
        if($key==0)
		{
			if($cnt == 0 && $root == true)
			{
				$target['_umsr_nonce'] = $var[$key];
				$cnt++;
			}
			elseif($cnt == 1 && $root == true)
			{
				$target['_wp_http_referer'] = $var[$key];
				$cnt++;
			}
			else
			{
				$target[] = $var[$key];
			}
		}
        else
		{
            $target[$key] = $var[$key];
		}
    }   
}

$plugin = plugin_basename(__FILE__);
if(is_admin())
{
    if($_SERVER["REQUEST_METHOD"]==="POST" && !empty($_POST["coderevolution_max_input_var_data"])) {
        $vars = explode("&", $_POST["coderevolution_max_input_var_data"]);
        $coderevolution_max_input_var_data = array();
        foreach($vars as $var) {
            parse_str($var, $variable);
            ums_assign_var($_POST, $variable, true);
        }
        unset($_POST["coderevolution_max_input_var_data"]);
    }
}
add_action('wp_enqueue_scripts', 'ums_wp_load_front_files');
function ums_wp_load_front_files()
{
    wp_enqueue_style('coderevolution-front-css', plugins_url('styles/coderevolution-front.css', __FILE__));
}
$min_timeout = 1;

function ums_is_demo_server()
{
    return false;
}
function ums_is_activated($plugin_slug, &$uoptions)
{
    return true;
}
function ums_enhancements_enqueue_scripts($hook) {
    if ($hook != 'ultimate-web-novel-manga-scraper_page_ums_enhancements') {
        return;
    }
    wp_enqueue_script('ums-enhancements', plugin_dir_url(__FILE__) . 'scripts/madara-enhancements.js', array('jquery'), '1.0', true);
    wp_localize_script('ums-enhancements', 'madaraEnhancements', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('madara_enhancements_nonce')
    ));
}
add_action('admin_menu', 'ums_register_my_custom_menu_page');
add_action('network_admin_menu', 'ums_register_my_custom_menu_page');
function ums_register_my_custom_menu_page()
{
    $plugin = plugin_basename(__FILE__);
    require(dirname(__FILE__) . "/res/ums-main.php");
    add_menu_page('Ultimate Web Novel & Manga Scraper', 'Ultimate Web Novel & Manga Scraper', 'manage_options', 'ums_admin_settings', 'ums_admin_settings', plugins_url('images/icon.png', __FILE__));
    $main = add_submenu_page('ums_admin_settings', esc_html__("Main Settings", 'ultimate-manga-scraper'), esc_html__("Main Settings", 'ultimate-manga-scraper'), 'manage_options', 'ums_admin_settings');
    add_action( 'load-' . $main, 'ums_load_all_admin_js' );
    add_action( 'load-' . $main, 'ums_load_main_admin_js' );
    $ums_Main_Settings = get_option('ums_Main_Settings', false);
    if (isset($ums_Main_Settings['ums_enabled']) && $ums_Main_Settings['ums_enabled'] == 'on') {
        add_action('admin_enqueue_scripts', 'ums_enhancements_enqueue_scripts');
        $mangaxyzx = add_submenu_page('ums_admin_settings', esc_html__('Manga Scraper (Madara Theme Sites)', 'ultimate-manga-scraper'), esc_html__('Manga Scraper (Madara Theme Sites)', 'ultimate-manga-scraper'), 'manage_options', 'ums_manga_generic_panel', 'ums_manga_generic_panel');
        add_action( 'load-' . $mangaxyzx, 'ums_load_admin_js' );
        add_action( 'load-' . $mangaxyzx, 'ums_load_all_admin_js' );
        $mangaxyz = add_submenu_page('ums_admin_settings', esc_html__('Web Novel Scraper (Madara Theme Sites)', 'ultimate-manga-scraper'), esc_html__('Web Novel Scraper (Madara Theme Sites)', 'ultimate-manga-scraper'), 'manage_options', 'ums_novel_generic_panel', 'ums_novel_generic_panel');
        add_action( 'load-' . $mangaxyz, 'ums_load_admin_js' );
        add_action( 'load-' . $mangaxyz, 'ums_load_all_admin_js' );
        $mangax = add_submenu_page('ums_admin_settings', esc_html__('Manga Scraper (FanFox.net)', 'ultimate-manga-scraper'), esc_html__('Manga Scraper (FanFox.net)', 'ultimate-manga-scraper'), 'manage_options', 'ums_items_panel', 'ums_items_panel');
        add_action( 'load-' . $mangax, 'ums_load_admin_js' );
        add_action( 'load-' . $mangax, 'ums_load_all_admin_js' );
        $mangaxyx = add_submenu_page('ums_admin_settings', esc_html__('Web Novel Scraper (novlove.com)', 'ultimate-manga-scraper'), esc_html__('Web Novel Scraper (novlove.com)', 'ultimate-manga-scraper'), 'manage_options', 'ums_novel_panel', 'ums_novel_panel');
        add_action( 'load-' . $mangaxyx, 'ums_load_admin_js' );
        add_action( 'load-' . $mangaxyx, 'ums_load_all_admin_js' );
        //$mangaxy = add_submenu_page('ums_admin_settings', esc_html__('Web Novel Scraper (NewNovel.org)', 'ultimate-manga-scraper'), esc_html__('Web Novel Scraper (NewNovel.org)', 'ultimate-manga-scraper'), 'manage_options', 'ums_vipnovel_panel', 'ums_vipnovel_panel');
        //add_action( 'load-' . $mangaxy, 'ums_load_admin_js' );
        //add_action( 'load-' . $mangaxy, 'ums_load_all_admin_js' );
        $mangaxx = add_submenu_page('ums_admin_settings', esc_html__('Web Novel Scraper (WuxiaWorld.site)', 'ultimate-manga-scraper'), esc_html__('Web Novel Scraper (WuxiaWorld.site)', 'ultimate-manga-scraper'), 'manage_options', 'ums_text_panel', 'ums_text_panel');
        add_action( 'load-' . $mangaxx, 'ums_load_admin_js' );
        add_action( 'load-' . $mangaxx, 'ums_load_all_admin_js' );
        $mangafanmtl = add_submenu_page('ums_admin_settings', esc_html__('Web Novel Scraper (FanMTL / ReadWN / Wuxia Sites)', 'ultimate-manga-scraper'), esc_html__('Web Novel Scraper (FanMTL / ReadWN / Wuxia Sites)', 'ultimate-manga-scraper'), 'manage_options', 'ums_fanmtl_panel', 'ums_fanmtl_panel');
        add_action( 'load-' . $mangafanmtl, 'ums_load_admin_js' );
        add_action( 'load-' . $mangafanmtl, 'ums_load_all_admin_js' );
        $enhancements = add_submenu_page('ums_admin_settings', esc_html__("Madara Enhancements", 'ultimate-manga-scraper'), esc_html__("Madara Enhancements", 'ultimate-manga-scraper'), 'manage_options', 'ums_enhancements', [ 'UMS_Madara_Handler', 'ums_enhancements' ]);
        add_action( 'load-' . $enhancements, 'ums_load_all_admin_js' );
        $logs = add_submenu_page('ums_admin_settings', esc_html__("Activity & Logging", 'ultimate-manga-scraper'), esc_html__("Activity & Logging", 'ultimate-manga-scraper'), 'manage_options', 'ums_logs', 'ums_logs');
        add_action( 'load-' . $logs, 'ums_load_all_admin_js' );
    }
}
function ums_load_admin_js(){
    add_action('admin_enqueue_scripts', 'ums_enqueue_admin_js');
}

function ums_enqueue_admin_js(){
    wp_enqueue_script('ums-footer-script', plugins_url('scripts/footer.js', __FILE__), array('jquery'), false, true);
    $cr_miv = ini_get('max_input_vars');
	if($cr_miv === null || $cr_miv === false || !is_numeric($cr_miv))
	{
        $cr_miv = '9999999';
    }
    $footer_conf_settings = array(
        'max_input_vars' => $cr_miv,
        'plugin_dir_url' => plugin_dir_url(__FILE__),
        'ajaxurl' => admin_url('admin-ajax.php')
    );
    wp_localize_script('ums-footer-script', 'mycustomsettings', $footer_conf_settings);
    wp_register_style('ums-rules-style', plugins_url('styles/ums-rules.css', __FILE__), false, '1.0.0');
    wp_enqueue_style('ums-rules-style');
}
function ums_load_main_admin_js(){
    add_action('admin_enqueue_scripts', 'ums_enqueue_main_admin_js');
}

function ums_enqueue_main_admin_js(){
    $ums_Main_Settings = get_option('ums_Main_Settings', false);
    wp_enqueue_script('ums-main-script', plugins_url('scripts/main.js', __FILE__), array('jquery'), '1.0.0');
    if(!isset($ums_Main_Settings['best_user']))
    {
        $best_user = '';
    }
    else
    {
        $best_user = $ums_Main_Settings['best_user'];
    }
    if(!isset($ums_Main_Settings['best_password']))
    {
        $best_password = '';
    }
    else
    {
        $best_password = $ums_Main_Settings['best_password'];
    }
    $plugin = plugin_basename(__FILE__);
    $plugin_slug = explode('/', $plugin);
    $plugin_slug = $plugin_slug[0];
    $header_main_settings = array(
        'best_user' => $best_user,
        'best_password' => $best_password,
        'ajaxurl' => admin_url('admin-ajax.php'),
        'plugin_slug' => $plugin_slug
    );
    wp_localize_script('ums-main-script', 'mycustommainsettings', $header_main_settings);
}
function ums_load_all_admin_js(){
    add_action('admin_enqueue_scripts', 'ums_admin_load_files');
}
function ums_add_rating_link($links)
{
    // Rating link changed to GitHub - LUCA Free License v1.0
    $settings_link = '<a href="//github.com/druvx13/ultimate-manga-scraper" target="_blank" title="' . esc_html__('View on GitHub', 'ultimate-manga-scraper') . '">
            ' . esc_html__('GitHub', 'ultimate-manga-scraper') . '</a>';
    array_push($links, $settings_link);
    return $links;
}
add_filter("plugin_action_links_$plugin", 'ums_add_support_link');
function ums_add_support_link($links)
{
    $settings_link = '<a href="//coderevolution.ro/knowledge-base/" target="_blank">' . esc_html__('Support', 'ultimate-manga-scraper') . '</a>';
    array_push($links, $settings_link);
    return $links;
}
add_filter("plugin_action_links_$plugin", 'ums_add_settings_link');
add_filter("plugin_action_links_$plugin", 'ums_add_rating_link');
function ums_add_settings_link($links)
{
    $settings_link = '<a href="admin.php?page=ums_admin_settings">' . esc_html__('Settings', 'ultimate-manga-scraper') . '</a>';
    array_push($links, $settings_link);
    return $links;
}

add_filter('cron_schedules', 'ums_add_cron_schedule');
function ums_add_cron_schedule($schedules)
{
    $schedules['ums_cron'] = array(
        'interval' => 3600,
        'display' => esc_html__('ums Cron', 'ultimate-manga-scraper')
    );
    $schedules['minutely'] = array(
        'interval' => 60,
        'display' => esc_html__('Once A Minute', 'ultimate-manga-scraper')
    );
    $schedules['weekly']        = array(
        'interval' => 604800,
        'display' => esc_html__('Once Weekly', 'ultimate-manga-scraper')
    );
    $schedules['monthly']       = array(
        'interval' => 2592000,
        'display' => esc_html__('Once Monthly', 'ultimate-manga-scraper')
    );
    return $schedules;
}
function ums_auto_clear_log()
{
    global $wp_filesystem;
    if ( ! is_a( $wp_filesystem, 'WP_Filesystem_Base') ){
        include_once(ABSPATH . 'wp-admin/includes/file.php');$creds = request_filesystem_credentials( site_url() );
       wp_filesystem($creds);
    }
    if ($wp_filesystem->exists(WP_CONTENT_DIR . '/ums_info.log')) {
        $wp_filesystem->delete(WP_CONTENT_DIR . '/ums_info.log');
    }
}

register_deactivation_hook(__FILE__, 'ums_my_deactivation');
function ums_my_deactivation()
{
    wp_clear_scheduled_hook('umsaction');
    wp_clear_scheduled_hook('umsactionclear');
    $running = array();
    update_option('ums_running_list', $running, false);
}
add_action('umsaction', 'ums_cron');
add_action('umsactionclear', 'ums_auto_clear_log');

function ums_cron_schedule()
{
    $ums_Main_Settings = get_option('ums_Main_Settings', false);
    if (isset($ums_Main_Settings['ums_enabled']) && $ums_Main_Settings['ums_enabled'] === 'on') {
        if (!wp_next_scheduled('umsaction')) {
            $unlocker = get_option('ums_minute_running_unlocked', false);
            if($unlocker == '1')
            {
                $rez = wp_schedule_event(time(), 'minutely', 'umsaction');
            }
            else
            {
                $rez = wp_schedule_event(time(), 'hourly', 'umsaction');
            }
            
            if ($rez === FALSE) {
                ums_log_to_file('[Scheduler] Failed to schedule umsaction to ums_cron!');
            }
        }
        
        if (isset($ums_Main_Settings['enable_logging']) && $ums_Main_Settings['enable_logging'] === 'on' && isset($ums_Main_Settings['auto_clear_logs']) && $ums_Main_Settings['auto_clear_logs'] !== 'No') {
            if (!wp_next_scheduled('umsactionclear')) {
                $rez = wp_schedule_event(time(), $ums_Main_Settings['auto_clear_logs'], 'umsactionclear');
                if ($rez === FALSE) {
                    ums_log_to_file('[Scheduler] Failed to schedule umsactionclear to ' . $ums_Main_Settings['auto_clear_logs'] . '!');
                }
                add_option('ums_schedule_time', $ums_Main_Settings['auto_clear_logs']);
            } else {
                if (!get_option('ums_schedule_time')) {
                    wp_clear_scheduled_hook('umsactionclear');
                    $rez = wp_schedule_event(time(), $ums_Main_Settings['auto_clear_logs'], 'umsactionclear');
                    add_option('ums_schedule_time', $ums_Main_Settings['auto_clear_logs']);
                    if ($rez === FALSE) {
                        ums_log_to_file('[Scheduler] Failed to schedule umsactionclear to ' . $ums_Main_Settings['auto_clear_logs'] . '!');
                    }
                } else {
                    $the_time = get_option('ums_schedule_time');
                    if ($the_time != $ums_Main_Settings['auto_clear_logs']) {
                        wp_clear_scheduled_hook('umsactionclear');
                        delete_option('ums_schedule_time');
                        $rez = wp_schedule_event(time(), $ums_Main_Settings['auto_clear_logs'], 'umsactionclear');
                        add_option('ums_schedule_time', $ums_Main_Settings['auto_clear_logs']);
                        if ($rez === FALSE) {
                            ums_log_to_file('[Scheduler] Failed to schedule umsactionclear to ' . $ums_Main_Settings['auto_clear_logs'] . '!');
                        }
                    }
                }
            }
        } else {
            if (!wp_next_scheduled('umsactionclear')) {
                delete_option('ums_schedule_time');
            } else {
                wp_clear_scheduled_hook('umsactionclear');
                delete_option('ums_schedule_time');
            }
        }
    } else {
        if (wp_next_scheduled('umsaction')) {
            wp_clear_scheduled_hook('umsaction');
        }
        
        if (!wp_next_scheduled('umsactionclear')) {
            delete_option('ums_schedule_time');
        } else {
            wp_clear_scheduled_hook('umsactionclear');
            delete_option('ums_schedule_time');
        }
    }
}
function ums_cron()
{
    $GLOBALS['wp_object_cache']->delete('ums_rules_list', 'options');
    if (!get_option('ums_rules_list')) {
        $rules = array();
    } else {
        $rules = get_option('ums_rules_list');
    }
    $unlocker = get_option('ums_minute_running_unlocked', false);
    if (!empty($rules)) {
        $cont = 0;
        foreach ($rules as $request => $bundle[]) {
            $bundle_values   = array_values($bundle);
            $myValues        = $bundle_values[$cont];
            $array_my_values = array_values($myValues);for($iji=0;$iji<count($array_my_values);++$iji){if(is_string($array_my_values[$iji])){$array_my_values[$iji]=stripslashes($array_my_values[$iji]);}}
            $schedule        = isset($array_my_values[1]) ? $array_my_values[1] : '24';
            $active          = isset($array_my_values[2]) ? $array_my_values[2] : '0';
            $last_run        = isset($array_my_values[3]) ? $array_my_values[3] : ums_get_date_now();
            if ($active == '1') {
                $now                = ums_get_date_now();
                if($unlocker == '1')
                {
                    $nextrun        = ums_add_minute($last_run, $schedule);
                    $ums_hour_diff = (int) ums_minute_diff($now, $nextrun);
                }
                else
                {
                    $nextrun            = ums_add_hour($last_run, $schedule);
                    $ums_hour_diff = (int) ums_hour_diff($now, $nextrun);
                }
                if ($ums_hour_diff >= 0) {
                    ums_run_rule($cont, 0);
                }
            }
            $cont = $cont + 1;
        }
    }
    $GLOBALS['wp_object_cache']->delete('ums_text_list', 'options');
    if (!get_option('ums_text_list')) {
        $xrules = array();
    } else {
        $xrules = get_option('ums_text_list');
    }
    if (!empty($xrules)) {
        $xcont = 0;
        foreach ($xrules as $xrequest => $xbundle[]) {
            $xbundle_values   = array_values($xbundle);
            $xmyValues        = $xbundle_values[$xcont];
            $xarray_my_values = array_values($xmyValues);for($xiji=0;$xiji<count($xarray_my_values);++$xiji){if(is_string($xarray_my_values[$xiji])){$xarray_my_values[$xiji]=stripslashes($xarray_my_values[$xiji]);}}
            $xschedule        = isset($xarray_my_values[1]) ? $xarray_my_values[1] : '24';
            $xactive          = isset($xarray_my_values[2]) ? $xarray_my_values[2] : '0';
            $xlast_run        = isset($xarray_my_values[3]) ? $xarray_my_values[3] : ums_get_date_now();
            if ($xactive == '1') {
                $xnow                = ums_get_date_now();
                if($unlocker == '1')
                {
                    $xnextrun        = ums_add_minute($xlast_run, $xschedule);
                    $xums_hour_diff = (int) ums_minute_diff($xnow, $xnextrun);
                }
                else
                {
                    $xnextrun            = ums_add_hour($xlast_run, $xschedule);
                    $xums_hour_diff = (int) ums_hour_diff($xnow, $xnextrun);
                }
                if ($xums_hour_diff >= 0) {
                    ums_run_rule($xcont, 1);
                }
            }
            $xcont = $xcont + 1;
        }
    }
    $GLOBALS['wp_object_cache']->delete('ums_novel_list', 'options');
    if (!get_option('ums_novel_list')) {
        $xrules = array();
    } else {
        $xrules = get_option('ums_novel_list');
    }
    if (!empty($xrules)) {
        $xcont = 0;
        foreach ($xrules as $xrequest => $xbundle[]) {
            $xbundle_values   = array_values($xbundle);
            $xmyValues        = $xbundle_values[$xcont];
            $xarray_my_values = array_values($xmyValues);for($xiji=0;$xiji<count($xarray_my_values);++$xiji){if(is_string($xarray_my_values[$xiji])){$xarray_my_values[$xiji]=stripslashes($xarray_my_values[$xiji]);}}
            $xschedule        = isset($xarray_my_values[1]) ? $xarray_my_values[1] : '24';
            $xactive          = isset($xarray_my_values[2]) ? $xarray_my_values[2] : '0';
            $xlast_run        = isset($xarray_my_values[3]) ? $xarray_my_values[3] : ums_get_date_now();
            if ($xactive == '1') {
                $xnow                = ums_get_date_now();
                if($unlocker == '1')
                {
                    $xnextrun        = ums_add_minute($xlast_run, $xschedule);
                    $xums_hour_diff = (int) ums_minute_diff($xnow, $xnextrun);
                }
                else
                {
                    $xnextrun            = ums_add_hour($xlast_run, $xschedule);
                    $xums_hour_diff = (int) ums_hour_diff($xnow, $xnextrun);
                }
                if ($xums_hour_diff >= 0) {
                    ums_run_rule($xcont, 2);
                }
            }
            $xcont = $xcont + 1;
        }
    }
    $GLOBALS['wp_object_cache']->delete('ums_vipnovel_list', 'options');
    if (!get_option('ums_vipnovel_list')) {
        $xrules = array();
    } else {
        $xrules = get_option('ums_vipnovel_list');
    }
    if (!empty($xrules)) {
        $xcont = 0;
        foreach ($xrules as $xrequest => $xbundle[]) {
            $xbundle_values   = array_values($xbundle);
            $xmyValues        = $xbundle_values[$xcont];
            $xarray_my_values = array_values($xmyValues);for($xiji=0;$xiji<count($xarray_my_values);++$xiji){if(is_string($xarray_my_values[$xiji])){$xarray_my_values[$xiji]=stripslashes($xarray_my_values[$xiji]);}}
            $xschedule        = isset($xarray_my_values[1]) ? $xarray_my_values[1] : '24';
            $xactive          = isset($xarray_my_values[2]) ? $xarray_my_values[2] : '0';
            $xlast_run        = isset($xarray_my_values[3]) ? $xarray_my_values[3] : ums_get_date_now();
            if ($xactive == '1') {
                $xnow                = ums_get_date_now();
                if($unlocker == '1')
                {
                    $xnextrun        = ums_add_minute($xlast_run, $xschedule);
                    $xums_hour_diff = (int) ums_minute_diff($xnow, $xnextrun);
                }
                else
                {
                    $xnextrun            = ums_add_hour($xlast_run, $xschedule);
                    $xums_hour_diff = (int) ums_hour_diff($xnow, $xnextrun);
                }
                if ($xums_hour_diff >= 0) {
                    ums_run_rule($xcont, 3);
                }
            }
            $xcont = $xcont + 1;
        }
    }
    $GLOBALS['wp_object_cache']->delete('ums_novel_generic_list', 'options');
    if (!get_option('ums_novel_generic_list')) {
        $yrules = array();
    } else {
        $yrules = get_option('ums_novel_generic_list');
    }
    if (!empty($yrules)) {
        $ycont = 0;
        foreach ($yrules as $yrequest => $ybundle[]) {
            $ybundle_values   = array_values($ybundle);
            $ymyValues        = $ybundle_values[$ycont];
            $yarray_my_values = array_values($ymyValues);for($yiji=0;$yiji<count($yarray_my_values);++$yiji){if(is_string($yarray_my_values[$yiji])){$yarray_my_values[$yiji]=stripslashes($yarray_my_values[$yiji]);}}
            $yschedule        = isset($yarray_my_values[1]) ? $yarray_my_values[1] : '24';
            $yactive          = isset($yarray_my_values[2]) ? $yarray_my_values[2] : '0';
            $ylast_run        = isset($yarray_my_values[3]) ? $yarray_my_values[3] : ums_get_date_now();
            if ($yactive == '1') {
                $ynow                = ums_get_date_now();
                if($unlocker == '1')
                {
                    $ynextrun        = ums_add_minute($ylast_run, $yschedule);
                    $yums_hour_diff = (int) ums_minute_diff($ynow, $ynextrun);
                }
                else
                {
                    $ynextrun            = ums_add_hour($ylast_run, $yschedule);
                    $yums_hour_diff = (int) ums_hour_diff($ynow, $ynextrun);
                }
                if ($yums_hour_diff >= 0) {
                    ums_run_rule($ycont, 4);
                }
            }
            $ycont = $ycont + 1;
        }
    }
    $GLOBALS['wp_object_cache']->delete('ums_manga_generic_list', 'options');
    if (!get_option('ums_manga_generic_list')) {
        $zrules = array();
    } else {
        $zrules = get_option('ums_manga_generic_list');
    }
    if (!empty($zrules)) {
        $zcont = 0;
        foreach ($zrules as $zrequest => $zbundle[]) {
            $zbundle_values   = array_values($zbundle);
            $zmyValues        = $zbundle_values[$zcont];
            $zarray_my_values = array_values($zmyValues);for($ziji=0;$ziji<count($zarray_my_values);++$ziji){if(is_string($zarray_my_values[$ziji])){$zarray_my_values[$ziji]=stripslashes($zarray_my_values[$ziji]);}}
            $zschedule        = isset($zarray_my_values[1]) ? $zarray_my_values[1] : '24';
            $zactive          = isset($zarray_my_values[2]) ? $zarray_my_values[2] : '0';
            $zlast_run        = isset($zarray_my_values[3]) ? $zarray_my_values[3] : ums_get_date_now();
            if ($zactive == '1') {
                $znow                = ums_get_date_now();
                if($unlocker == '1')
                {
                    $znextrun        = ums_add_minute($zlast_run, $zschedule);
                    $zums_hour_diff = (int) ums_minute_diff($znow, $znextrun);
                }
                else
                {
                    $znextrun            = ums_add_hour($zlast_run, $zschedule);
                    $zums_hour_diff = (int) ums_hour_diff($znow, $znextrun);
                }
                if ($zums_hour_diff >= 0) {
                    ums_run_rule($zcont, 5);
                }
            }
            $zcont = $zcont + 1;
        }
    }
    $GLOBALS['wp_object_cache']->delete('ums_fanmtl_list', 'options');
    if (!get_option('ums_fanmtl_list')) {
        $frules = array();
    } else {
        $frules = get_option('ums_fanmtl_list');
    }
    if (!empty($frules)) {
        $fcont = 0;
        foreach ($frules as $frequest => $fbundle[]) {
            $fbundle_values   = array_values($fbundle);
            $fmyValues        = $fbundle_values[$fcont];
            $farray_my_values = array_values($fmyValues);for($fiji=0;$fiji<count($farray_my_values);++$fiji){if(is_string($farray_my_values[$fiji])){$farray_my_values[$fiji]=stripslashes($farray_my_values[$fiji]);}}
            $fschedule        = isset($farray_my_values[1]) ? $farray_my_values[1] : '24';
            $factive          = isset($farray_my_values[2]) ? $farray_my_values[2] : '0';
            $flast_run        = isset($farray_my_values[3]) ? $farray_my_values[3] : ums_get_date_now();
            if ($factive == '1') {
                $fnow                = ums_get_date_now();
                if($unlocker == '1')
                {
                    $fnextrun        = ums_add_minute($flast_run, $fschedule);
                    $fums_hour_diff = (int) ums_minute_diff($fnow, $fnextrun);
                }
                else
                {
                    $fnextrun            = ums_add_hour($flast_run, $fschedule);
                    $fums_hour_diff = (int) ums_hour_diff($fnow, $fnextrun);
                }
                if ($fums_hour_diff >= 0) {
                    ums_run_rule($fcont, 6);
                }
            }
            $fcont = $fcont + 1;
        }
    }
    $running = array();
    update_option('ums_running_list', $running);
}

function ums_log_to_file($str)
{
    $ums_Main_Settings = get_option('ums_Main_Settings', false);
    if (isset($ums_Main_Settings['enable_logging']) && $ums_Main_Settings['enable_logging'] == 'on') {
        $d = date("j-M-Y H:i:s e", current_time( 'timestamp' ));
        error_log("[$d] " . $str . "<br/>\r\n", 3, WP_CONTENT_DIR . '/ums_info.log');
    }
}
function ums_delete_all_posts()
{
    $failed                 = false;
    $number                 = 0;
    $ums_Main_Settings = get_option('ums_Main_Settings', false);
    $post_list = array();
    $postsPerPage = 50000;
    $paged = 0;
    do
    {
        $postOffset = $paged * $postsPerPage;
        $query = array(
            'post_status' => array(
                'publish',
                'draft',
                'pending',
                'trash',
                'private',
                'future'
            ),
            'post_type' => array(
                'any'
            ),
            'numberposts' => $postsPerPage,
            'meta_key' => 'ums_parent_rule',
            'fields' => 'ids',
            'offset'  => $postOffset
        );
        $got_me = get_posts($query);
        $post_list = array_merge($post_list, $got_me);
        $paged++;
    }while(!empty($got_me));
    wp_suspend_cache_addition(true);
    foreach ($post_list as $post) {
        $index = get_post_meta($post, 'ums_parent_rule', true);
        if (isset($index) && $index !== '') {
            $args             = array(
                'post_parent' => $post
            );
            $post_attachments = get_children($args);
            if (isset($post_attachments) && !empty($post_attachments)) {
                foreach ($post_attachments as $attachment) {
                    wp_delete_attachment($attachment->ID, true);
                }
            }
            $res = wp_delete_post($post, true);
            if ($res === false) {
                $failed = true;
            } else {
                $number++;
            }
        }
    }
    wp_suspend_cache_addition(false);
    if ($failed === true) {
        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
            ums_log_to_file('[PostDelete] Failed to delete all posts!');
        }
    } else {
        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
            ums_log_to_file('[PostDelete] Successfuly deleted ' . esc_html($number) . ' posts!');
        }
    }
}
// License activation/verification functions removed - plugin now uses LUCA Free License v1.0
// No purchase code or activation required - DO WHAT THE FUCK YOU WANT TO.
add_action('wp_ajax_ums_my_action', 'ums_my_action_callback');
function ums_my_action_callback()
{
    if ( ! current_user_can('edit_posts') ) {
        wp_send_json_error( array( 'message' => 'Unauthorized' ), 403 );
    }
    $ums_Main_Settings = get_option('ums_Main_Settings', false);
    $failed                 = false;
    $type                   = $_POST['type'];
    $del_id                 = $_POST['id'];
    $how                    = $_POST['how'];
    $force_delete           = true;
    $number                 = 0;
    if ($how == 'trash') {
        $force_delete = false;
    }
    $post_list = array();
    $postsPerPage = 50000;
    $paged = 0;
    do
    {
        $postOffset = $paged * $postsPerPage;
        $query = array(
            'post_status' => array(
                'publish',
                'draft',
                'pending',
                'trash',
                'private',
                'future'
            ),
            'post_type' => array(
                'any'
            ),
            'numberposts' => $postsPerPage,
            'meta_key' => 'ums_parent_rule',
            'fields' => 'ids',
            'offset'  => $postOffset
        );
        $got_me = get_posts($query);
        $post_list = array_merge($post_list, $got_me);
        $paged++;
    }while(!empty($got_me));
    wp_suspend_cache_addition(true);
    foreach ($post_list as $post) {
        $index = get_post_meta($post, 'ums_parent_rule', true);
        if ($index == $type . '-' . $del_id) {
            $args             = array(
                'post_parent' => $post
            );
            $post_attachments = get_children($args);
            if (isset($post_attachments) && !empty($post_attachments)) {
                foreach ($post_attachments as $attachment) {
                    wp_delete_attachment($attachment->ID, true);
                }
            }
            $res = wp_delete_post($post, $force_delete);
            if ($res === false) {
                $failed = true;
            } else {
                $number++;
            }
        }
    }
    wp_suspend_cache_addition(false);
    if ($failed === true) {
        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
            ums_log_to_file('[PostDelete] Failed to delete all posts for rule id: ' . esc_html($del_id) . '!');
        }
        echo 'failed';
    } else {
        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
            ums_log_to_file('[PostDelete] Successfuly deleted ' . esc_html($number) . ' posts for rule id: ' . esc_html($del_id) . '!');
        }
        if ($number == 0) {
            echo 'nochange';
        } else {
            echo 'ok';
        }
    }
    die();
}
add_action('wp_ajax_ums_run_my_action', 'ums_run_my_action_callback');
function ums_run_my_action_callback()
{
    if ( ! current_user_can('edit_posts') ) {
        wp_send_json_error( array( 'message' => 'Unauthorized' ), 403 );
    }
    $run_id = $_POST['id'];
    $run_type = isset($_POST['type']) ? $_POST['type'] : 0;
    $rerun_count = isset($_POST['rerun_count']) ? $_POST['rerun_count'] : 0;
    $ums_Main_Settings = get_option('ums_Main_Settings', false);
    if (isset($ums_Main_Settings['disable_rerun']) && trim($ums_Main_Settings['disable_rerun']) == 'on')
    {
        if($rerun_count > 0)
        {
            sleep(5);
            echo 'ok';
            die();
        }
    }
    echo ums_run_rule($run_id, $run_type, 0, $rerun_count);
    die();
}


function ums_clearFromList($param, $type)
{
    $GLOBALS['wp_object_cache']->delete('ums_running_list', 'options');
    $running = get_option('ums_running_list');
    if($running !== false)
    {
        $key = array_search(array(
            $param => $type
        ), $running);
        if ($key !== FALSE) {
            unset($running[$key]);
            update_option('ums_running_list', $running);
        }
    }
}

function ums_get_page_PuppeteerAPI($url, $custom_cookies, $custom_user_agent, $use_proxy, $user_pass, $timeout = '')
{
    $ums_Main_Settings = get_option('ums_Main_Settings', false);
    if (!isset($ums_Main_Settings['headlessbrowserapi_key']) || trim($ums_Main_Settings['headlessbrowserapi_key']) == '')
    {
        ums_log_to_file('You need to add your HeadlessBrowserAPI key in the plugin\'s \'Main Settings\' before you can use this feature.');
        return false;
    }
    if($custom_user_agent == '')
    {
        $custom_user_agent = 'default';
    }
    if($custom_cookies == '')
    {
        $custom_cookies = 'default';
    }
    if($user_pass == '')
    {
        $user_pass = 'default';
    }
    if($timeout != '')
    {
        $phantomjs_timeout = $timeout;
    }
    else
    {
        if (isset($ums_Main_Settings['phantom_timeout']) && $ums_Main_Settings['phantom_timeout'] != '') 
        {
            $phantomjs_timeout = ((int)$ums_Main_Settings['phantom_timeout']);
        }
        else
        {
            $phantomjs_timeout = 'default';
        }
    }
    $phantomjs_proxcomm = '"null"';
    if ($use_proxy == '1' && isset($ums_Main_Settings['proxy_url']) && $ums_Main_Settings['proxy_url'] != '') 
    {
        $proxy_url = $ums_Main_Settings['proxy_url'];
        if(isset($ums_Main_Settings['proxy_auth']) && $ums_Main_Settings['proxy_auth'] != '')
        {
            $proxy_auth = $ums_Main_Settings['proxy_auth'];
        }
        else
        {
            $proxy_auth = 'default';
        }
    }
    else
    {
        $proxy_url = 'default';
        $proxy_auth = 'default';
    }
    
    $za_api_url = 'https://headlessbrowserapi.com/apis/scrape/v1/puppeteer?apikey=' . trim($ums_Main_Settings['headlessbrowserapi_key']) . '&url=' . urlencode($url) . '&custom_user_agent=' . urlencode($custom_user_agent) . '&custom_cookies=' . urlencode($custom_cookies) . '&user_pass=' . urlencode($user_pass) . '&timeout=' . urlencode($phantomjs_timeout) . '&proxy_url=' . urlencode($proxy_url) . '&proxy_auth=' . urlencode($proxy_auth);
    $api_timeout = 120;
    $args = array(
       'timeout'     => $api_timeout,
       'redirection' => 10,
       'blocking'    => true,
       'compress'    => false,
       'decompress'  => true,
       'sslverify'   => false,
       'stream'      => false
    );
    $ret_data = wp_remote_get($za_api_url, $args);
    $response_code       = wp_remote_retrieve_response_code( $ret_data );
    $response_message    = wp_remote_retrieve_response_message( $ret_data );    
    if ( 200 != $response_code ) {
        if (isset($ums_Main_Settings['enable_detailed_logging'])) 
        {
            ums_log_to_file('Failed to get response from HeadlessBrowserAPI: ' . $za_api_url . ' code: ' . $response_code . ' message: ' . $response_message);
            if(isset($ret_data->errors['http_request_failed']))
            {
                foreach($ret_data->errors['http_request_failed'] as $errx)
                {
                    ums_log_to_file('Error message: ' . html_entity_decode($errx));
                }
            }
        }
        return false;
    } else {
        $cmdResult = wp_remote_retrieve_body( $ret_data );
    }
    $jcmdResult = json_decode($cmdResult, true);
    if($jcmdResult === false)
    {
        ums_log_to_file('Failed to decode response from HeadlessBrowserAPI: ' . $za_api_url . ' - ' . print_r($cmdResult, true));
        return false;
    }
    $cmdResult = $jcmdResult;
    if(isset($cmdResult['apicalls']))
    {
        update_option('headless_calls', esc_html($cmdResult['apicalls']));
    }
    if(isset($cmdResult['error']))
    {
        ums_log_to_file('An error occurred while getting content from HeadlessBrowserAPI: ' . $za_api_url . ' - ' . print_r($cmdResult['error'], true));
        return false;
    }
    if(!isset($cmdResult['html']))
    {
        ums_log_to_file('Malformed data imported from HeadlessBrowserAPI: ' . $za_api_url . ' - ' . print_r($cmdResult, true));
        return false;
    }
    return $cmdResult['html'];
}
function ums_get_page_TorAPI($url, $custom_cookies, $custom_user_agent, $use_proxy, $user_pass, $timeout = '')
{
    $ums_Main_Settings = get_option('ums_Main_Settings', false);
    if (!isset($ums_Main_Settings['headlessbrowserapi_key']) || trim($ums_Main_Settings['headlessbrowserapi_key']) == '')
    {
        ums_log_to_file('You need to add your HeadlessBrowserAPI key in the plugin\'s \'Main Settings\' before you can use this feature.');
        return false;
    }
    if($custom_user_agent == '')
    {
        $custom_user_agent = 'default';
    }
    if($custom_cookies == '')
    {
        $custom_cookies = 'default';
    }
    if($user_pass == '')
    {
        $user_pass = 'default';
    }
    if($timeout != '')
    {
        $phantomjs_timeout = $timeout;
    }
    else
    {
        if (isset($ums_Main_Settings['phantom_timeout']) && $ums_Main_Settings['phantom_timeout'] != '') 
        {
            $phantomjs_timeout = ((int)$ums_Main_Settings['phantom_timeout']);
        }
        else
        {
            $phantomjs_timeout = 'default';
        }
    }
    $phantomjs_proxcomm = '"null"';
    if ($use_proxy == '1' && isset($ums_Main_Settings['proxy_url']) && $ums_Main_Settings['proxy_url'] != '') 
    {
        $proxy_url = $ums_Main_Settings['proxy_url'];
        if(isset($ums_Main_Settings['proxy_auth']) && $ums_Main_Settings['proxy_auth'] != '')
        {
            $proxy_auth = $ums_Main_Settings['proxy_auth'];
        }
        else
        {
            $proxy_auth = 'default';
        }
    }
    else
    {
        $proxy_url = 'default';
        $proxy_auth = 'default';
    }
    
    $za_api_url = 'https://headlessbrowserapi.com/apis/scrape/v1/tor?apikey=' . trim($ums_Main_Settings['headlessbrowserapi_key']) . '&url=' . urlencode($url) . '&custom_user_agent=' . urlencode($custom_user_agent) . '&custom_cookies=' . urlencode($custom_cookies) . '&user_pass=' . urlencode($user_pass) . '&timeout=' . urlencode($phantomjs_timeout) . '&proxy_url=' . urlencode($proxy_url) . '&proxy_auth=' . urlencode($proxy_auth);
    $api_timeout = 120;
    $args = array(
       'timeout'     => $api_timeout,
       'redirection' => 10,
       'blocking'    => true,
       'compress'    => false,
       'decompress'  => true,
       'sslverify'   => false,
       'stream'      => false
    );
    $ret_data = wp_remote_get($za_api_url, $args);
    $response_code       = wp_remote_retrieve_response_code( $ret_data );
    $response_message    = wp_remote_retrieve_response_message( $ret_data );    
    if ( 200 != $response_code ) {
        if (isset($ums_Main_Settings['enable_detailed_logging'])) 
        {
            ums_log_to_file('Failed to get response from HeadlessBrowserAPI: ' . $za_api_url . ' code: ' . $response_code . ' message: ' . $response_message);
            if(isset($ret_data->errors['http_request_failed']))
            {
                foreach($ret_data->errors['http_request_failed'] as $errx)
                {
                    ums_log_to_file('Error message: ' . html_entity_decode($errx));
                }
            }
        }
        return false;
    } else {
        $cmdResult = wp_remote_retrieve_body( $ret_data );
    }
    $jcmdResult = json_decode($cmdResult, true);
    if($jcmdResult === false)
    {
        ums_log_to_file('Failed to decode response from HeadlessBrowserAPI: ' . $za_api_url . ' - ' . print_r($cmdResult, true));
        return false;
    }
    $cmdResult = $jcmdResult;
    if(isset($cmdResult['apicalls']))
    {
        update_option('headless_calls', esc_html($cmdResult['apicalls']));
    }
    if(isset($cmdResult['error']))
    {
        ums_log_to_file('An error occurred while getting content from HeadlessBrowserAPI: ' . $za_api_url . ' - ' . print_r($cmdResult['error'], true));
        return false;
    }
    if(!isset($cmdResult['html']))
    {
        ums_log_to_file('Malformed data imported from HeadlessBrowserAPI: ' . $za_api_url . ' - ' . print_r($cmdResult, true));
        return false;
    }
    return $cmdResult['html'];
}
function ums_sanitize_html_content($html) 
{
    libxml_use_internal_errors(true); 
    $doc = new DOMDocument();
    $doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
    $tags_to_remove = ['img', 'video', 'iframe', 'script', 'style', 'object', 'embed', 'noscript', 'ins'];
    foreach ($tags_to_remove as $tag) {
        $elements = $doc->getElementsByTagName($tag);
        while ($elements->length > 0) {
            $el = $elements->item(0);
            $el->parentNode->removeChild($el);
        }
    }
    $xpath = new DOMXPath($doc);
    $ad_nodes = $xpath->query('//*[contains(@class, "ad") or contains(@id, "ad") or contains(@class, "ads") or contains(@id, "ads")]');
    foreach ($ad_nodes as $node) {
        $node->parentNode->removeChild($node);
    }
    $body = $doc->getElementsByTagName('body')->item(0);
    $clean_html = '';
    foreach ($body->childNodes as $child) {
        $clean_html .= $doc->saveHTML($child);
    }
    return $clean_html;
}
function ums_get_page_PhantomJSAPI($url, $custom_cookies, $custom_user_agent, $use_proxy, $user_pass, $timeout = '')
{
    $ums_Main_Settings = get_option('ums_Main_Settings', false);
    if (!isset($ums_Main_Settings['headlessbrowserapi_key']) || trim($ums_Main_Settings['headlessbrowserapi_key']) == '')
    {
        ums_log_to_file('You need to add your HeadlessBrowserAPI key in the plugin\'s \'Main Settings\' before you can use this feature.');
        return false;
    }
    if($custom_user_agent == '')
    {
        $custom_user_agent = 'default';
    }
    if($custom_cookies == '')
    {
        $custom_cookies = 'default';
    }
    if($user_pass == '')
    {
        $user_pass = 'default';
    }
    if($timeout != '')
    {
        $phantomjs_timeout = $timeout;
    }
    else
    {
        if (isset($ums_Main_Settings['phantom_timeout']) && $ums_Main_Settings['phantom_timeout'] != '') 
        {
            $phantomjs_timeout = ((int)$ums_Main_Settings['phantom_timeout']);
        }
        else
        {
            $phantomjs_timeout = 'default';
        }
    }
    $phantomjs_proxcomm = '"null"';
    if ($use_proxy == '1' && isset($ums_Main_Settings['proxy_url']) && $ums_Main_Settings['proxy_url'] != '') 
    {
        $proxy_url = $ums_Main_Settings['proxy_url'];
        if(isset($ums_Main_Settings['proxy_auth']) && $ums_Main_Settings['proxy_auth'] != '')
        {
            $proxy_auth = $ums_Main_Settings['proxy_auth'];
        }
        else
        {
            $proxy_auth = 'default';
        }
    }
    else
    {
        $proxy_url = 'default';
        $proxy_auth = 'default';
    }
    
    $za_api_url = 'https://headlessbrowserapi.com/apis/scrape/v1/phantomjs?apikey=' . trim($ums_Main_Settings['headlessbrowserapi_key']) . '&url=' . urlencode($url) . '&custom_user_agent=' . urlencode($custom_user_agent) . '&custom_cookies=' . urlencode($custom_cookies) . '&user_pass=' . urlencode($user_pass) . '&timeout=' . urlencode($phantomjs_timeout) . '&proxy_url=' . urlencode($proxy_url) . '&proxy_auth=' . urlencode($proxy_auth);
    $api_timeout = 120;
    $args = array(
       'timeout'     => $api_timeout,
       'redirection' => 10,
       'blocking'    => true,
       'compress'    => false,
       'decompress'  => true,
       'sslverify'   => false,
       'stream'      => false
    );
    $ret_data = wp_remote_get($za_api_url, $args);
    $response_code       = wp_remote_retrieve_response_code( $ret_data );
    $response_message    = wp_remote_retrieve_response_message( $ret_data );    
    if ( 200 != $response_code ) {
        if (isset($ums_Main_Settings['enable_detailed_logging'])) 
        {
            ums_log_to_file('Failed to get response from HeadlessBrowserAPI: ' . $za_api_url . ' code: ' . $response_code . ' message: ' . $response_message);
            if(isset($ret_data->errors['http_request_failed']))
            {
                foreach($ret_data->errors['http_request_failed'] as $errx)
                {
                    ums_log_to_file('Error message: ' . html_entity_decode($errx));
                }
            }
        }
        return false;
    } else {
        $cmdResult = wp_remote_retrieve_body( $ret_data );
    }
    $jcmdResult = json_decode($cmdResult, true);
    if($jcmdResult === false)
    {
        ums_log_to_file('Failed to decode response from HeadlessBrowserAPI: ' . $za_api_url . ' - ' . print_r($cmdResult, true));
        return false;
    }
    $cmdResult = $jcmdResult;
    if(isset($cmdResult['apicalls']))
    {
        update_option('headless_calls', esc_html($cmdResult['apicalls']));
    }
    if(isset($cmdResult['error']))
    {
        ums_log_to_file('An error occurred while getting content from HeadlessBrowserAPI: ' . $za_api_url . ' - ' . print_r($cmdResult['error'], true));
        return false;
    }
    if(!isset($cmdResult['html']))
    {
        ums_log_to_file('Malformed data imported from HeadlessBrowserAPI: ' . $za_api_url . ' - ' . print_r($cmdResult, true));
        return false;
    }
    return $cmdResult['html'];
}
function ums_get_web_page($url, $ua = '', $use_phantom = '0', $phantom_wait = '')
{
    if(ums_startsWith($url, '//'))
    {
        $url = 'http:' . $url;
    }
    $content = false;
    $ums_Main_Settings = get_option('ums_Main_Settings', false);
    $got_phantom = false;
    if($use_phantom == '1')
    {
        $content = ums_get_page_PhantomJS($url, 'isAdult=1', ums_get_random_user_agent($ua), '1', '', $phantom_wait);
        if($content !== false)
        {
            $got_phantom = true;
        }
    }
    elseif($use_phantom == '2')
    {
        $content = ums_get_page_Puppeteer($url, 'isAdult=1', ums_get_random_user_agent($ua), '1', '');
        if($content !== false)
        {
            $got_phantom = true;
        }
    }
    elseif($use_phantom == '4')
    {
        $content = ums_get_page_PuppeteerAPI($url, 'isAdult=1', ums_get_random_user_agent($ua), '1', '', '');
        if($content !== false)
        {
            $got_phantom = true;
        }
    }
    elseif($use_phantom == '5')
    {
        $content = ums_get_page_TorAPI($url, 'isAdult=1', ums_get_random_user_agent($ua), '1', '', '');
        if($content !== false)
        {
            $got_phantom = true;
        }
    }
    elseif($use_phantom == '6')
    {
        $content = ums_get_page_PhantomJSAPI($url, 'isAdult=1', ums_get_random_user_agent($ua), '1', '', '');
        if($content !== false)
        {
            $got_phantom = true;
        }
    }
    if($got_phantom === false)
    {
        $toor = 'https://google.com/';
        $parse = parse_url($url);
        if(isset($parse['host']))
        {
            $toor = 'https://' . $parse['host'];
        }
        if (!isset($ums_Main_Settings['proxy_url']) || $ums_Main_Settings['proxy_url'] == '') {
            $args = array(
               'timeout'     => 120,
               'redirection' => 10,
               'user-agent'  => ums_get_random_user_agent($ua),
               'blocking'    => true,
               'compress'    => false,
               'decompress'  => true,
               'sslverify'   => false,
               'stream'      => false,
               'filename'    => null,
               'headers' => array(
                    'referer' => $toor
                )
            );
            $cookies = [];
            $cookies[] = new WP_Http_Cookie( array(
                'name'  => 'isAdult',
                'value' => '1',
            ));
            $args['cookies'] = $cookies;
            
            $ret_data            = wp_remote_get($url, $args);  
            $response_code       = wp_remote_retrieve_response_code( $ret_data );
            $response_message    = wp_remote_retrieve_response_message( $ret_data );        
            if ( 200 != $response_code ) {
            } else {
                $content = wp_remote_retrieve_body( $ret_data );
            }
        }
        if($content === false)
        {
            if(function_exists('curl_version') && filter_var($url, FILTER_VALIDATE_URL))
            {
                $user_agent = ums_get_random_user_agent($ua);
                $options    = array(
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_COOKIEJAR => get_temp_dir() . 'umscookie.txt',
                    CURLOPT_COOKIEFILE => get_temp_dir() . 'umscookie.txt',
                    CURLOPT_USERAGENT => $user_agent,
                    CURLOPT_REFERER => $toor,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_CONNECTTIMEOUT => 10,
                    CURLOPT_TIMEOUT => 120,
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_SSL_VERIFYHOST => 0,
                    CURLOPT_SSL_VERIFYPEER => 0,
                    CURLOPT_COOKIE => 'isAdult=1'
                );
                $ch         = curl_init($url);
                if (isset($ums_Main_Settings['proxy_url']) && $ums_Main_Settings['proxy_url'] != '') {
                    curl_setopt($ch, CURLOPT_PROXY, $ums_Main_Settings['proxy_url']);
                    if (isset($ums_Main_Settings['proxy_auth']) && $ums_Main_Settings['proxy_auth'] != '') {
                        curl_setopt($ch, CURLOPT_PROXYUSERPWD, $ums_Main_Settings['proxy_auth']);
                    }
                }
                if ($ch === FALSE) {
                    return FALSE;
                }
                curl_setopt_array($ch, $options);
                $content = curl_exec($ch);
                curl_close($ch);
            }
            else
            {
                $allowUrlFopen = preg_match('/1|yes|on|true/i', ini_get('allow_url_fopen'));
                if ($allowUrlFopen) {
                    global $wp_filesystem;
                    if ( ! is_a( $wp_filesystem, 'WP_Filesystem_Base') ){
                        include_once(ABSPATH . 'wp-admin/includes/file.php');$creds = request_filesystem_credentials( site_url() );
                        wp_filesystem($creds);
                    }
                    return $wp_filesystem->get_contents($url);
                }
            }
        }
    }
    return $content;
}

function ums_extractMangaImages($htmlContent) 
{
    $imageUrls = [];

    // Step 1: Strip HTML comments
    $htmlContent = preg_replace('/<!--.*?-->/s', '', $htmlContent);

    // Step 2: DOMDocument & DOMXPath Method
    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($htmlContent);
    libxml_clear_errors();
    $xpath = new DOMXPath($dom);

    // Find all img elements with the class "wp-manga-chapter-img"
    $imageNodes = $xpath->query("//img[contains(concat(' ', normalize-space(@class), ' '), ' wp-manga-chapter-img ')]");

    foreach ($imageNodes as $img) {
        $url = null;

        // Check for multiple attributes
        if ($img->hasAttribute('data-src')) {
            $url = $img->getAttribute('data-src');
        } elseif ($img->hasAttribute('src')) {
            $url = $img->getAttribute('src');
        } elseif ($img->hasAttribute('data-sv1')) {
            $url = $img->getAttribute('data-sv1');
        } elseif ($img->hasAttribute('data-sv2')) {
            $url = $img->getAttribute('data-sv2');
        }

        if ($url) {
            $imageUrls[] = $url;
        }
    }

    // Step 3: Regex fallback for common attributes (class before src)
    if (empty($imageUrls)) {
        $regex = '/<img[^>]+class="[^"]*\bwp-manga-chapter-img\b[^"]*"[^>]+(?:src|data-src|data-sv1|data-sv2|data-lazy|data-original)="([^"]+)"/i';
        if (preg_match_all($regex, $htmlContent, $matches)) {
            $imageUrls = $matches[1];
        }
    }

    // Step 4: Regex fallback for class after src
    if (empty($imageUrls)) {
        $regex = '/<img[^>]+(?:src|data-src|data-sv1|data-sv2|data-lazy|data-original)="([^"]+)"[^>]+class="[^"]*\bwp-manga-chapter-img\b[^"]*"/i';
        if (preg_match_all($regex, $htmlContent, $matches)) {
            $imageUrls = $matches[1];
        }
    }

    // Step 5: Regex fallback where class and src are interleaved
    if (empty($imageUrls)) {
        $regex = '/<img(?=.*\bwp-manga-chapter-img\b)(?=.*\b(?:src|data-src|data-sv1|data-sv2|data-lazy|data-original)\b=["\']([^"\']+)["\'])[^\>]*>/i';
        if (preg_match_all($regex, $htmlContent, $matches)) {
            $imageUrls = $matches[1];
        }
    }

    // Step 6: Regex for base64 images
    if (empty($imageUrls)) {
        $base64Regex = '/<img[^>]+class="[^"]*\bwp-manga-chapter-img\b[^"]*"[^>]+src="data:image\/[^"]+"/i';
        if (preg_match_all($base64Regex, $htmlContent, $matches)) {
            foreach ($matches[0] as $base64Image) {
                // Extract the data URI
                if (preg_match('/src="([^"]+)"/i', $base64Image, $dataMatches)) {
                    $imageUrls[] = $dataMatches[1];
                }
            }
        }
    }

    // Step 7: General lazy load attributes
    if (empty($imageUrls)) {
        $generalRegex = '/<img[^>]+class="[^"]*\bwp-manga-chapter-img\b[^"]*"[^>]+(?:src|data-lazy|data-src|data-original|data-image|lazy-src|lazyload-src)="([^"]+)"/i';
        if (preg_match_all($generalRegex, $htmlContent, $matches)) {
            $imageUrls = $matches[1];
        }
    }

    // Step 8: Handle picture and source tags with lazy-loading attributes
    if (empty($imageUrls)) {
        $pictureRegex = '/<source[^>]+(?:srcset|data-srcset)="([^"]+)"/i';
        if (preg_match_all($pictureRegex, $htmlContent, $matches)) {
            $imageUrls = $matches[1];
        }
    }

    // Step 9: Handle inline styles with background images
    if (empty($imageUrls)) {
        $backgroundRegex = '/style="[^"]*background-image:\s*url\(([^)]+)\)/i';
        if (preg_match_all($backgroundRegex, $htmlContent, $matches)) {
            $imageUrls = array_merge($imageUrls, $matches[1]);
        }
    }

    // Step 10: Handle images loaded via JavaScript or inline event handlers
    if (empty($imageUrls)) {
        $jsRegex = '/onload="[^"]*src=\\\'([^\\\']+)\\\'/i';
        if (preg_match_all($jsRegex, $htmlContent, $matches)) {
            $imageUrls = array_merge($imageUrls, $matches[1]);
        }
    }

    // Step 11: Handle iframes that may contain images
    if (empty($imageUrls)) {
        $iframeRegex = '/<iframe[^>]+src="([^"]+)"/i';
        if (preg_match_all($iframeRegex, $htmlContent, $matches)) {
            $imageUrls = array_merge($imageUrls, $matches[1]);
        }
    }

    // Step 12: Handle noscript tags containing image fallback content
    if (empty($imageUrls)) {
        $noscriptRegex = '/<noscript[^>]*>(.*?)<\/noscript>/is';
        if (preg_match_all($noscriptRegex, $htmlContent, $noscriptMatches)) {
            foreach ($noscriptMatches[1] as $noscriptContent) {
                $noscriptImgRegex = '/<img[^>]+src="([^"]+)"/i';
                if (preg_match_all($noscriptImgRegex, $noscriptContent, $matches)) {
                    $imageUrls = array_merge($imageUrls, $matches[1]);
                }
            }
        }
    }

    // Step 13: Handle srcset attributes to get the highest resolution image
    if (empty($imageUrls)) {
        $srcsetRegex = '/<img[^>]+class="[^"]*\bwp-manga-chapter-img\b[^"]*"[^>]+srcset="([^"]+)"/i';
        if (preg_match_all($srcsetRegex, $htmlContent, $matches)) {
            foreach ($matches[1] as $srcset) {
                $srcsetUrls = explode(',', $srcset);
                $lastUrl = trim(end($srcsetUrls)); // Get the highest resolution version
                $lastUrl = explode(' ', $lastUrl)[0]; // Strip the resolution part
                $imageUrls[] = $lastUrl;
            }
        }
    }

    // Step 14: Manual search for patterns matching known URL structures (e.g., CDN URLs)
    if (empty($imageUrls)) {
        $cdnRegex = '/https:\/\/cdn\.[^"\']+/i'; // Pattern to match common CDN URLs
        if (preg_match_all($cdnRegex, $htmlContent, $matches)) {
            $imageUrls = array_merge($imageUrls, $matches[0]);
        }
    }

    return array_unique($imageUrls); // Ensure unique URLs
}

function ums_get_manga_page($url)
{
    if(ums_startsWith($url, '//'))
    {
        $url = 'http:' . $url;
    }
    $user_agent = ums_get_random_user_agent();
    $options    = array(
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_USERAGENT => $user_agent,
        CURLOPT_REFERER => 'https://fanfox.net/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_TIMEOUT => 120,
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_COOKIE => 'webstickynode=c24fa7357dc1dc361a8957736ebdb93c;wd=2133x1087;presence=EDvF3EtimeF1680850190EuserFA21B01157412606A2EstateFDutF0CEchF_7bCC;fr=0M12KGXSyvzIKQzQc.AWWEs8ckc4zZ1cvV60Dtu9wq6Nw.BkL70H.ia.AAA.0.0.BkL70H.AWXuzvceS5I;c_user=100001157412606;usida=eyJ2ZXIiOjEsImlkIjoiQXJzcWdiMDExNnQwOG0iLCJ0aW1lIjoxNjgwODUwMTg4fQ%3D%3D;dpr=0.8999999761581421;xs=44%3AYKtoDsOJnuA45g%3A2%3A1662217638%3A-1%3A6679%3A%3AAcWh5qXW2KHRwlWehThVlw_TX2bQy1OCtjcqL1AkH0AfYQ'
    );
    $ch         = curl_init($url);
    if (isset($ums_Main_Settings['proxy_url']) && $ums_Main_Settings['proxy_url'] != '') {
        curl_setopt($ch, CURLOPT_PROXY, $ums_Main_Settings['proxy_url']);
        if (isset($ums_Main_Settings['proxy_auth']) && $ums_Main_Settings['proxy_auth'] != '') {
            curl_setopt($ch, CURLOPT_PROXYUSERPWD, $ums_Main_Settings['proxy_auth']);
        }
    }
    if ($ch === FALSE) {
        return FALSE;
    }
    curl_setopt_array($ch, $options);
    $content = curl_exec($ch);
    curl_close($ch);
    return $content;
}

function ums_utf8_encode($str)
{
    if(function_exists('mb_detect_encoding') && function_exists('mb_convert_encoding'))
    {
        $enc = mb_detect_encoding($str);
        if ($enc !== FALSE) {
            $str = mb_convert_encoding($str, 'UTF-8', $enc);
        } else {
            $str = mb_convert_encoding($str, 'UTF-8');
        }
    }
    return $str;
}
function ums_startsWith($haystack, $needle)
{
     $length = strlen($needle);
     return (substr($haystack, 0, $length) === $needle);
}
function ums_image_url_filter( $url ){

    $url = str_replace( 'https://', '', $url );
    $url = str_replace( 'http://', '', $url );
    $url = str_replace( '//', '', $url );
    $url = str_replace( 'http:', '', $url );
    if(strpos($url, '/') === false){
        $url = 'fanfox.net' . $url;
    }
    return "https://{$url}";
}
function ums_getFacebookButton($url)
{
    $button = '<a class="crf_twitt ums_facebook ums_btn button purchase" href="https://www.facebook.com/sharer/sharer.php?display=popup&ref=plugin&src=share_button&u=' . urlencode($url) . '" onclick="return !window.open(this.href, \'Facebook\', \'width=640,height=580\')"><img src="' . ums_get_file_url('images/facebook.png') . '" alt="Facebook" class="crf_social_img"></a>';
    return $button;
}
function ums_getTwitterButton($url, $item_title)
{
    $button = '<a class="crf_twitt ums_twitter ums_btn button purchase" href="https://twitter.com/intent/tweet?text=Check+out+%27' . urlencode($item_title) . '%27&url=' . urlencode(htmlspecialchars_decode($url)) . '" onclick="return !window.open(this.href, \'Twitter\', \'width=640,height=580\')"><img src="' . ums_get_file_url('images/twitter.png') . '" alt="Twitter" class="crf_social_img"></a>';
    return $button;
}
function ums_getPinterestButton($url, $item_title, $banner)
{
    $button = '<a class="crf_twitt ums_pinterest ums_btn button purchase" href="http://pinterest.com/pin/create/button?description=' . urlencode($item_title) . '&media=' . urlencode($banner) . '&url=' . urlencode(htmlspecialchars_decode($url)) . '" onclick="return !window.open(this.href, \'Pinterest\', \'width=640,height=580\')"><img src="' . ums_get_file_url('images/pinterest.png') . '" alt="Pinterest" class="crf_social_img"></a>';
    return $button;
}

function ums_get_page_Puppeteer($url, $custom_cookies, $custom_user_agent, $use_proxy, $user_pass)
{
    $ums_Main_Settings = get_option('ums_Main_Settings', false);
    if(!function_exists('shell' . '_exec')) {
        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
            ums_log_to_file('shel' . 'l_exec not found!');
        }
        return false;
    }
    if($custom_user_agent == '')
    {
        $custom_user_agent = 'default';
    }
    if($custom_cookies == '')
    {
        $custom_cookies = 'default';
    }
    if($user_pass == '')
    {
        $user_pass = 'default';
    }
    $phantomjs_proxcomm = '"null"';
    if ($use_proxy == '1' && isset($ums_Main_Settings['proxy_url']) && $ums_Main_Settings['proxy_url'] != '') 
    {
        $prx = explode(',', $ums_Main_Settings['proxy_url']);
        $randomness = array_rand($prx);
        $phantomjs_proxcomm = '"' . trim($prx[$randomness]);
        if (isset($ums_Main_Settings['proxy_auth']) && $ums_Main_Settings['proxy_auth'] != '') 
        {
            $prx_auth = explode(',', $ums_Main_Settings['proxy_auth']);
            if(isset($prx_auth[$randomness]) && trim($prx_auth[$randomness]) != '')
            {
                $phantomjs_proxcomm .= '~~~' . trim($prx_auth[$randomness]);
            }
        }
        $phantomjs_proxcomm .= '"';
    }
    $disabled = explode(',', ini_get('disable_functions'));
    if(in_array('shell' . '_exec', $disabled))
    {
        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
            ums_log_to_file('shel' . 'l_exec disabled');
        }
        return false;
    }
    
    $puppeteer_comm = 'node ';
    $puppeteer_comm .= '"' . dirname(__FILE__) . '/res/puppeteer/puppeteer.js" "' . $url . '" ' . $phantomjs_proxcomm . '  "' . $custom_user_agent . '" "' . $custom_cookies . '" "' . $user_pass . '"';
    $puppeteer_comm .= ' 2>&1';
    if (isset($ums_Main_Settings['enable_detailed_logging'])) {
        ums_log_to_file('Puppeteer command: ' . $puppeteer_comm);
    }
    $shefunc = trim(' s ') . trim(' h ') . 'ell' . '_exec';
    $cmdResult = $shefunc($puppeteer_comm);
    if($cmdResult === NULL || $cmdResult == '')
    {
        ums_log_to_file('puppeteer did not return usable info for: ' . $url);
        return false;
    }
    if(trim($cmdResult) === 'timeout')
    {
        ums_log_to_file('puppeteer timed out while getting page: ' . $url. ' - please increase timeout in Main Settings');
        return false;
    }
    if(stristr($cmdResult, 'sh: node: command not found') !== false || stristr($cmdResult, 'throw err;') !== false)
    {
        ums_log_to_file('nodeJS not found, please install it on your server: ' . $puppeteer_comm);
        return false;
    }
    if(stristr($cmdResult, 'sh: puppeteer: command not found') !== false)
    {
        ums_log_to_file('puppeteer not found, please install it on your server');
        return false;
    }
    if(stristr($cmdResult, 'res/puppeteer/puppeteer.js:') !== false)
    {
        ums_log_to_file('puppeteer failed to run, error: ' . $cmdResult);
        return false;
    }
    return $cmdResult;
}
function ums_get_page_PhantomJS($url, $custom_cookies, $custom_user_agent, $use_proxy, $user_pass, $phantom_wait)
{
    if(!function_exists('shell' . '_exec')) {
        return false;
    }
    $disabled = explode(',', ini_get('disable_functions'));
    if(in_array('shell' . '_exec', $disabled))
    {
        return false;
    }
    $ums_Main_Settings = get_option('ums_Main_Settings', false);
    if (isset($ums_Main_Settings['phantom_path']) && $ums_Main_Settings['phantom_path'] != '') 
    {
        $phantomjs_comm = $ums_Main_Settings['phantom_path'];
    }
    else
    {
        $phantomjs_comm = 'phantomjs';
    }
    if (isset($ums_Main_Settings['phantom_timeout']) && $ums_Main_Settings['phantom_timeout'] != '') 
    {
        $phantomjs_timeout = ((int)$ums_Main_Settings['phantom_timeout']);
    }
    else
    {
        $phantomjs_timeout = '15000';
    }
    if($custom_user_agent == '')
    {
        $custom_user_agent = 'default';
    }
    if($custom_cookies == '')
    {
        $custom_cookies = 'default';
    }
    if($user_pass == '')
    {
        $user_pass = 'default';
    }
    if ($use_proxy == '1' && isset($ums_Main_Settings['proxy_url']) && $ums_Main_Settings['proxy_url'] != '') 
    {
        $prx = explode(',', $ums_Main_Settings['proxy_url']);
        $randomness = array_rand($prx);
        $phantomjs_comm .= ' --proxy=' . trim($prx[$randomness]);
        if (isset($ums_Main_Settings['proxy_auth']) && $ums_Main_Settings['proxy_auth'] != '') 
        {
            $prx_auth = explode(',', $ums_Main_Settings['proxy_auth']);
            if(isset($prx_auth[$randomness]) && trim($prx_auth[$randomness]) != '')
            {
                $phantomjs_comm .= ' --proxy-auth=' . trim($prx_auth[$randomness]);
            }
        }
    }
    $phantomjs_comm .= ' --ignore-ssl-errors=true ';
    $phantomjs_comm .= '"' . dirname(__FILE__) . '/res/phantomjs/phantom.js" "' . $url . '" "' . esc_html($phantomjs_timeout) . '" "' . $custom_user_agent . '" "' . $custom_cookies . '" "' . $user_pass . '" "' . esc_html($phantom_wait) . '"';
    $phantomjs_comm .= ' 2>&1';
    $shefunc = trim(' s ') . trim(' h ') . 'ell' . '_exec';
    $cmdResult = $shefunc($phantomjs_comm);
    if($cmdResult === NULL || $cmdResult == '')
    {
        ums_log_to_file('phantomjs did not return usable info for: ' . $url);
        return false;
    }
    if(trim($cmdResult) === 'timeout')
    {
        ums_log_to_file('phantomjs timed out while getting page: ' . $url. ' - please increase timeout in Main Settings');
        return false;
    }
    if(stristr($cmdResult, 'sh: phantomjs: command not found') !== false)
    {
        ums_log_to_file('phantomjs not found, please install it on your server');
        return false;
    }
    return $cmdResult;
}

function ums_testPhantom()
{
    if(!function_exists('shell' . '_exec')) {
        return -1;
    }
    $disabled = explode(',', ini_get('disable_functions'));
    if(in_array('shell' . '_exec', $disabled))
    {
        return -2;
    }
    $ums_Main_Settings = get_option('ums_Main_Settings', false);
    if (isset($ums_Main_Settings['phantom_path']) && $ums_Main_Settings['phantom_path'] != '') 
    {
        $phantomjs_comm = $ums_Main_Settings['phantom_path'] . ' ';
    }
    else
    {
        $phantomjs_comm = 'phantomjs ';
    }
    $shefunc = trim(' s ') . trim(' h ') . 'ell' . '_exec';
    $cmdResult = $shefunc($phantomjs_comm . '-h 2>&1');
    if(stristr($cmdResult, 'Usage') !== false)
    {
        return 1;
    }
    return 0;
}

function ums_wp_mcl_e_upload_file( $url, $use_phantom, $phantom_wait, $post_id = 0 )
{
    if($url == '' || $url == false)
    {
        return false;
    }
    if(stristr($url, 'novlove') !== false)
    {
        $content = ums_get_web_page($url, ums_get_random_user_agent(), $use_phantom, $phantom_wait);
        if($content == false)
        {
            ums_log_to_file( 'Failed to download image:' . $url);
            return false;
        }
        if($use_phantom == '2' || $use_phantom == '4')
        {
            $content = base64_decode($content);
            if( $content === false ){
                return false;
            }
        }
    }
    else
    {
        $ch = curl_init();
        if ($ch === FALSE) 
        {
            ums_log_to_file ('Failed to init curl in image downloader');
            return false;
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
        if(stristr($url, 'wuxiaworld') === false)
        {
            $headers = array();
            $headers[] = 'Sec-Ch-Ua: ^^';
            $headers[] = 'Referer: https://fanfox.net/';
            $headers[] = 'Sec-Ch-Ua-Mobile: ?0';
            $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36';
            $headers[] = 'Sec-Ch-Ua-Platform: ^^Windows^^\"\"';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        $content = curl_exec($ch);
        if (curl_errno($ch)) 
        {
            ums_log_to_file( 'Image Error:' . curl_error($ch));
            return false;
        }
        if($content == false)
        {
            ums_log_to_file( 'Failed to download image:' . $url);
            return false;
        }
        curl_close($ch);
    }
    $pathinfo = pathinfo( $url );
    $upload_dir = wp_upload_dir();
    if(stristr($pathinfo['extension'], 'render_jsfalse'))
    {
        $pathinfo['extension'] = 'jpg';
    }
    $file_tmp_path = $upload_dir['basedir'] . '/' . $pathinfo['filename'] . '-' . $post_id . '.' . explode('?', $pathinfo['extension'])[0];
    global $wp_filesystem;
    if ( ! is_a( $wp_filesystem, 'WP_Filesystem_Base') )
    {
        include_once(ABSPATH . 'wp-admin/includes/file.php');$creds = request_filesystem_credentials( site_url() );
        wp_filesystem($creds);
    }
    $file = $wp_filesystem->put_contents( $file_tmp_path, $content );
    $wp_filetype = wp_check_filetype(basename($file_tmp_path), null );
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => $post_id,
        'post_content' => '',
        'post_status' => 'inherit'
    );

    $attach_id = wp_insert_attachment( $attachment, $file_tmp_path );
    $imagenew = get_post( $attach_id );
    $fullsizepath = get_attached_file( $imagenew->ID );
    require_once( ABSPATH . 'wp-admin/includes/image.php' );
    require_once( ABSPATH . 'wp-admin/includes/media.php' );
    $attach_data = wp_generate_attachment_metadata( $attach_id, $fullsizepath );
    wp_update_attachment_metadata( $attach_id, $attach_data );
    return $attach_id;
}

function ums_update_post_ratings( $post_id, $ratings = array() ){
    if( empty( $ratings ) || !isset( $ratings['avg'] ) || !isset( $ratings['numbers'] ) ){
        return false;
    }

    extract( $ratings );

    $totals = intval( (float)trim($avg) * (float)$numbers );
    $int_avg_totals = intval( $avg ) * $numbers;

    $above_avg_numbers = $totals - $int_avg_totals;
    $int_avg_numbers = $numbers - $above_avg_numbers;

    $rates = array();

    for( $i = 1; $i <= $above_avg_numbers; $i++ ){
        $rates[] = intval( (int)$avg + 1 );
    }

    for( $i = 1; $i <= $int_avg_numbers; $i++ ){
        $rates[] = intval( $avg );
    }

    update_post_meta( $post_id, '_manga_avarage_reviews', $avg );
    update_post_meta( $post_id, '_manga_reviews', $rates );

    return true;
}

function ums_update_post_views( $post_id, $views ){

    $month = date('m');

    update_post_meta( $post_id, '_wp_manga_month_views', array(
        'date' => $month,
        'views' => $views
    ) );
    
    update_post_meta( $post_id, '_wp_manga_views', $views );
    
    $new_year_views = array( 'views' => $views, 'date' => date('y') );
    update_post_meta( $post_id, '_wp_manga_year_views', $new_year_views );
    update_post_meta( $post_id, '_wp_manga_year_views_value', $views );

}
function ums_add_manga_terms( $post_id, $terms, $taxonomy ){

    $terms = explode(',', $terms);

    if( empty( $terms ) ){
        return false;
    }

    $taxonomy_obj = get_taxonomy( $taxonomy );

    if( is_object($taxonomy_obj) && $taxonomy_obj->hierarchical )
    {
        $output_terms = array();
        foreach( $terms as $current_term ){

            if( empty( $current_term ) ){
                continue;
            }
            $term = term_exists( $current_term, $taxonomy );
            if( ! $term || is_wp_error( $term ) ){
                $term = wp_insert_term( $current_term, $taxonomy );
                if( !is_wp_error( $term ) && isset( $term['term_id'] ) ){
                    $term = intval( $term['term_id'] );

                }else{
                    continue;
                }
            }else{
                $term = intval( $term['term_id'] );
            }

            $output_terms[] = $term;
        }

        $terms = $output_terms;
    }

    $resp = wp_set_post_terms( $post_id, $terms, $taxonomy );

    return $resp;

}
function ums_fetch_chapters( $volume, $post_id, $itemx, $storage = 'local', $manga_name = '', $rule_translate = 'disabled', $skip_last = '0' ){

    global $wp_manga_storage, $wp_manga_volume, $wp_manga_chapter;
    if($itemx->volume != 'NO-VOLUME' && $itemx->volume != 'No Volume' && $itemx->volume != '-1' && is_object($wp_manga_volume)){
        $find_vols = $wp_manga_volume->get_volumes(
            array(
                'post_id'     => $post_id,
                'volume_name' => $itemx->volume
            )
        );
        
        if( !empty( $find_vols ) ){
            $volume_id = $find_vols[0]['volume_id'];
            $is_volume_created = true;

        }
        else
        {
            $volume_id = $wp_manga_storage->create_volume( $itemx->volume, $post_id );
        }
    } 
    else 
    {
        $is_volume_created = true;
        $volume_id = 0;
    }
    if( !empty( $is_volume_created ) && is_object($wp_manga_volume) )
    {
        $vol_created_chaps = $wp_manga_volume->get_volume_chapters( $post_id, $volume_id );

        if( !empty( $vol_created_chaps ) ){

            $vol_created_chaps = array_column( $vol_created_chaps, 'chapter_name' );
            
            if(isset($volume['chapters']))
            {
                foreach( $volume['chapters'] as $index => $chapter ){							
                    if( in_array( $chapter['name'], $vol_created_chaps ) === false ){
                        $cur_chap_index = $index;
                        break;
                    }
                }
            }
        }
        else
        {
            $cur_chap_index = 0;
        }
    }
    else
    {
        $cur_chap_index = 0;
    }
    $resp = ums_fetch_single_chapter( $volume, $volume_id, $post_id, $itemx, $storage, $manga_name, $rule_translate, $skip_last );
    if( is_wp_error( $resp ) ){
        return $resp;
    }
    elseif($resp === false || $resp == null)
    {
        return false;
    }
    elseif($resp === 'CloudFlare')
    {
        return 'CloudFlare';
    }
    elseif($resp === 'fail')
    {
        return 'fail';
    }
    elseif($resp !== true)
    {
        return 'ok';
    }
    return true;
}
function ums_manga_url_filter( $url ){

    $url = str_replace( 'https://', '', $url );
    $url = str_replace( 'http://', '', $url );
    $url = str_replace( '//', '', $url );
    $url = str_replace( 'http:', '', $url );

    return "http://{$url}";
}
function ums_get_chapter_images( $url )
{
    $url = ums_manga_url_filter( $url );
    $images_url = array();
    $page_html = ums_get_web_page($url);
    if( strpos( $page_html, 'Sorry, its licensed, and not available.') !== false || strpos( $page_html, 'has been licensed, it is not available in') !== false ){
        ums_log_to_file( "URL not available in your country: $url");
        return false;
    }
    if( strpos( $page_html, 'licensed and not available.') !== false ){
        ums_log_to_file( "URL not available in your country (licensed): $url");
        return false;
    }
    $total_pages = 1;
    preg_match('/var imagecount=(\d+);/', $page_html, $matches);
    if($matches){
        $total_pages = $matches[1];
    }
    $chapterid = '';
    preg_match('/var chapterid =(\d+);/', $page_html, $matches);
    if($matches){
        $chapterid = $matches[1];
    }
    require_once (dirname(__FILE__) . "/res/UMSJavaScriptUnpacker.php"); 
    $dm5_key = '';
    preg_match('/eval\(.*(dm5_key).*\)/', $page_html, $matches);
    $unpacker = new UMSJavaScriptUnpacker();
    if($matches){
        $eval = $matches[0];
        $js = $unpacker->unpack($eval);
        $dm5_key = str_replace(array('\'','+',' '),array('','',''),str_replace(array('var guidkey=',';$("#dm5_key").val(guidkey);'), array('',''), $js));
    }
    $newImgs = '';
    preg_match('/eval\(.*(newImgs).*\)/', $page_html, $matches);
    if($matches){
        $eval = $matches[0];
        $js = $unpacker->unpack($eval);
        $newImgs = explode(',', str_replace('var newImgs=[', '', substr($js, 0, strpos($js, '];var newImginfos'))));
    }
    if($newImgs)
    {
        foreach($newImgs as $img){
            $url = 'http:' . str_replace("'", "", $img);
            array_push($images_url, substr($url, 0, strpos($url, '?')));
        }
        if(count($images_url) > 0)
        {
            return $images_url;
        }
    }			
    $base_url = str_replace( '1.html', '', $url );
    $base_url = str_replace( '1.htm', '', $base_url );
    $base_url = ums_manga_url_filter( $base_url );
    for( $i = 1; $i <= $total_pages; $i++ ){
        $data_url = $base_url . 'chapterfun.ashx?cid=' . $chapterid . '&page=' . $i . '&key=' . ($i == 1 ? '' : $dm5_key);
        $eval = ums_get_web_page($data_url);
        if($eval != '' && strpos($eval, "Bad Request - Invalid URL") === false){
            $js = $unpacker->unpack($eval);
            $idx1 = strpos($js, 'var pix="') + 9;
            $idx2 = strpos($js, '";');
            $url_1 = substr($js, $idx1, $idx2 - $idx1);
            $idx1 = strpos($js, 'var pvalue=["') + 13;
            $idx2 = strpos($js, '","');
            if($idx2 === false)
            {
                $idx2 = strpos($js, '"];');
            }
            $url_2 = substr($js, $idx1, $idx2 - $idx1);
            $image = $url_1 . $url_2;
            $image = ums_image_url_filter($image);
            array_push( $images_url, substr($image, 0, strpos($image, '?')) );
        }
    }
    if(count($images_url) == 0)
    {
        require_once (dirname(__FILE__) . "/res/simple_html_dom.php"); 
        $html = ums_str_get_html( $page_html );
        if( empty( $html ) ){
            ums_log_to_file( "Cannot get chapter images from $url");
            return false;
        }
        $pages = $html->find('#top_bar select.m > option');
        if( empty( $pages ) && !isset( $pages[ count( $pages ) - 2 ] ) )
        {
            preg_match_all('#<a href="[\s\S]*?" data-page="(\d*)">(?:\d*)<\/a>[\s\n]*<span>\.\.\.<\/span>[\s\n]*<a href="[\s\S]*?" data-page="(?:\d*)">&gt;<\/a>#', $page_html, $mxt);
            if(isset($mxt[1][0]))
            {
                $total_pages = intval($mxt[1][0]);
            }
            else
            {
                ums_log_to_file( "Cannot get chapter total pages " . $page_html);
                return false;
            }
        }
        else
        {
            $total_pages = $pages[ count( $pages ) - 2 ]->plaintext;
        }
        $page_url = str_replace( '1.html', '', $url );
        $page_url = str_replace( '1.htm', '', $page_url );
        $page_url = ums_manga_url_filter( $page_url );
        $images_url = array();
        for( $i = 1; $i <= $total_pages; $i++ ){
            $image = ums_get_page_images( "{$page_url}{$i}.html" );
            if( empty( $image ) ){
                ums_log_to_file( "Cannot get page image {$page_url}{$i}.html" );
                return false;
            }
            $images_url = array_merge( $images_url, $image );
        }
    }
    return $images_url;
}
function ums_get_page_images( $page_url ){
				
    require_once (dirname(__FILE__) . "/res/simple_html_dom.php"); 
    $page_html = ums_get_web_page($page_url);
    $html = ums_str_get_html( $page_html );

    if( empty( $html ) ){
        ums_log_to_file("Cannot get page images from " . $page_url);
        return false;
    }

    $images = $html->find( '#viewer .read_img a > img' );
    
    if( empty( $images ) ){
        return false;
    }

    $images_url = array();

    foreach( $images as $image ){
        $images_url[] = $image->src;
    }

    return $images_url;

}
$ums_chapter_images = array();
function ums_fetch_single_chapter( $chapter, $volume_id, $post_id, $itemx, $storage = 'local', $manga_name = '', $rule_translate = 'disabled', $skip_last = '0')
{
    $ums_Main_Settings = get_option('ums_Main_Settings', false);
    global $wp_manga, $wp_manga_storage;
    $timestamp = time();
    if($wp_manga == null)
    {
        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
            ums_log_to_file('wp_manga global variable not found');
        }
        return false;
    }
    if($wp_manga_storage == null)
    {
        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
            ums_log_to_file('wp_manga_storage global variable not found');
        }
        return false;
    }
    $uniqid = $wp_manga->get_uniqid( $post_id );
    if(empty($uniqid))
    {
        $uniqid = uniqid( 'manga_' );
        update_post_meta( $post_id, 'manga_unique_id', $uniqid );
    }
    $slugified_name = $wp_manga_storage->slugify( $itemx->title );
    global $wp_manga_chapter;
    $chapter_2 = $wp_manga_chapter->get_chapter_by_slug( $post_id, $slugified_name );
    if($chapter_2 && $chapter_2['volume_id'] == $volume_id && $chapter_2['chapter_slug'] == $slugified_name){
        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
            ums_log_to_file('Chapter already existing: ' . $chapter_2['chapter_name']);
        }
        return true;
    }
    
    global $ums_chapter_images;
    $ums_chapter_images = array();
    $chapter->each(function($itempx, $keyx) 
    {
        global $ums_chapter_images;
        $ums_chapter_images[] = $itempx->scan;
    });
    
    $extract = WP_MANGA_DATA_DIR . $uniqid . '/' . $slugified_name;
    $extract_uri = WP_MANGA_DATA_URL . $uniqid . '/';
    global $wp_filesystem;
    if ( ! is_a( $wp_filesystem, 'WP_Filesystem_Base') ){
        include_once(ABSPATH . 'wp-admin/includes/file.php');$creds = request_filesystem_credentials( site_url() );
       wp_filesystem($creds);
    }
    if (!$wp_filesystem->exists( $extract ) ){
        if( ! wp_mkdir_p( $extract ) ){
            ums_log_to_file("Cannot make dir $extract");
        }
    }
    if(count($ums_chapter_images) == 0)
    {
        $ums_chapter_images = ums_get_chapter_images( $itemx->url );
        if($ums_chapter_images === false)
        {
            if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                ums_log_to_file('No images found for: ' . $itemx->title);
            }
            return 'fail';
        }
    }
    $has_image = '';
    $existing_images = get_post_meta($post_id, 'ums_' . $slugified_name . '_cnt', true);
    if(!$existing_images)
    {
        $existing_images = 0;
    }
    $index = 1;
    foreach( $ums_chapter_images as $image )
    {
        if($skip_last == '1')
        {
            if($index == count($ums_chapter_images) && $index > 1)
            {
                $index++;
                continue;
            }
        }
        if($index > $existing_images){
            $data = ums_get_manga_page( $image );
            if( $data === false ){
                ums_log_to_file("Cannot get single chapter manga image from " . $image);            
                continue;
            }
            $pathinfo = pathinfo( $image );
            $file_name = ums_url_file_name_filter( $pathinfo['basename'] );
            $resp = $wp_filesystem->put_contents( "{$extract}/{$file_name}", $data );
            if( $resp && empty( $has_image ) )
            {
                $has_image = '1';
            }
            if (isset($ums_Main_Settings['enable_cloudflare']) && $ums_Main_Settings['enable_cloudflare'] == 'on')
            {
                if(time() - $timestamp >= 93 && count($ums_chapter_images) > $index)
                {
                    update_post_meta($post_id, 'ums_' . $slugified_name . '_cnt', $index);
                    ums_log_to_file('Your server is behind CloudFlare and scraping was stopped because of the 100 second limit CloudFlare is enforcing on sites.');
                    return 'CloudFlare';
                }
            }
        }
        $index++;
    }
    if( empty( $has_image ) ){
        $wp_filesystem->copy( dirname(__FILE__) . "/images/image-placeholder.jpg", "{$extract}/image-placeholder.jpg" );
    }
    $zat = $itemx->title;
    if(empty($zat))
    {
        $zat = 'Manga';
    }
    $z_arr = explode('-', $zat);
    $ch_name = trim($z_arr[0]);
    if(isset($z_arr[1]))
    {
        $ch_name_ext = trim($z_arr[1]);
    }
    else
    {
        $ch_name_ext = '';
    }
    $arr = ums_spin_and_translate($ch_name, $ch_name_ext, $rule_translate, 'en');
    if($arr === false)
    {
        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
            ums_log_to_file('Failed to translate manga details: ' . print_r($ch_name, true));
        }
    }
    else
    {
        $ch_name = $arr[0];
        $ch_name_ext = $arr[1];
    }
    $chapter_args = array(
        'post_id'             => $post_id,
        'volume_id'           => $volume_id,
        'chapter_name'        => $ch_name,
        'chapter_name_extend' => $ch_name_ext,
        'chapter_slug'        => $slugified_name,
    );
    $chapter_2 = $wp_manga_chapter->get_chapter_by_slug( $post_id, $slugified_name );
    if($chapter_2 && $chapter_2['volume_id'] == $volume_id && $chapter_2['chapter_slug'] == $slugified_name){
        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
            ums_log_to_file('Chapter found to be already published: ' . $zat);
        }
        return true;
    }
    if (isset($ums_Main_Settings['enable_detailed_logging'])) {
        ums_log_to_file('Uploading chapter: ' . $zat);
    }
    $result = $wp_manga_storage->wp_manga_upload_single_chapter( $chapter_args, $extract, $extract_uri, $storage );
    if($result == false || $result == null)
    {
        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
            ums_log_to_file('wp_manga_upload_single_chapter failed, details: extract: ' . $extract . ' -- extract_uri: ' . $extract_uri . ' -- storage: ' . $storage . ' -- chapter_args: ' . print_r($chapter_args, true));
        }
    }
    return $result; 
}
function ums_url_file_name_filter( $name ){
    $name = explode('?', $name);
    return $name[0];
}
function ums_my_user_by_rand( $ua ) {
  remove_action('pre_user_query', 'ums_my_user_by_rand');
  $ua->query_orderby = str_replace( 'user_login ASC', 'RAND()', $ua->query_orderby );
}
function ums_get_upload_cloud_list($upload_cloud_file){
    global $wp_filesystem;
    if ( ! is_a( $wp_filesystem, 'WP_Filesystem_Base') ){
        include_once(ABSPATH . 'wp-admin/includes/file.php');$creds = request_filesystem_credentials( site_url() );
       wp_filesystem($creds);
    }
    if ($wp_filesystem->exists( $upload_cloud_file ) ){
        $content = $wp_filesystem->get_contents( $upload_cloud_file );

        return json_decode( $content, true );
    }

    return [];

}

function ums_fetch_chapters_generic( $scans, $post_id, $itemx, $storage = 'local', $manga_name = '', $use_phantom = '0' ){

    global $wp_manga_storage, $wp_manga_volume, $wp_manga_chapter;
    if(isset($itemx['volume']) && $itemx['volume'] != 'NO-VOLUME' && $itemx['volume'] != 'No Volume' && $itemx['volume'] != '-1' && is_object($wp_manga_volume)){
        $find_vols = $wp_manga_volume->get_volumes(
            array(
                'post_id'     => $post_id,
                'volume_name' => $itemx['volume']
            )
        );
        
        if( !empty( $find_vols ) ){
            $volume_id = $find_vols[0]['volume_id'];
            $is_volume_created = true;

        }
        else
        {
            $volume_id = $wp_manga_storage->create_volume( $itemx['volume'], $post_id );
        }
    } 
    else 
    {
        $is_volume_created = true;
        $volume_id = 0;
    }
    $cur_chap_index = 0;
    $resp = ums_fetch_single_chapter_generic( $scans, $volume_id, $post_id, $itemx, $storage, $manga_name, $use_phantom );
    if( is_wp_error( $resp ) ){
        return $resp;
    }
    elseif($resp === false || $resp == null)
    {
        return false;
    }
    elseif($resp === 'CloudFlare')
    {
        return 'CloudFlare';
    }
    elseif($resp !== true)
    {
        return 'ok';
    }
    return true;
}
function ums_fetch_single_chapter_generic( $ums_chapter_images, $volume_id, $post_id, $itemx, $storage = 'local', $manga_name = '', $use_phantom = '0')
{
    $ums_Main_Settings = get_option('ums_Main_Settings', false);
    global $wp_manga, $wp_manga_storage;
    if($wp_manga == null)
    {
        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
            ums_log_to_file('wp_manga global variable not found');
        }
        return false;
    }
    if($wp_manga_storage == null)
    {
        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
            ums_log_to_file('wp_manga_storage global variable not found');
        }
        return false;
    }
    $uniqid = $wp_manga->get_uniqid( $post_id );
    if(empty($uniqid))
    {
        $uniqid = uniqid( 'manga_' );
        update_post_meta( $post_id, 'manga_unique_id', $uniqid );
    }
    $clearstring = sanitize_title($itemx['title']);
    $slugified_name = $wp_manga_storage->slugify( $clearstring );
    $slugified_name = sanitize_title($slugified_name);
    $slugified_name = preg_replace('/%[a-fA-F0-9]{2}/', '', $slugified_name);
    if(empty($slugified_name))
    {
        $slugified_name = uniqid();
    }
    global $wp_manga_chapter;
    $chapter_2 = $wp_manga_chapter->get_chapter_by_slug( $post_id, $slugified_name );
    if($chapter_2 && $chapter_2['volume_id'] == $volume_id && $chapter_2['chapter_slug'] == $slugified_name){
        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
            ums_log_to_file('Chapter already existing: ' . $chapter_2['chapter_name']);
        }
        return true;
    }
    
    $extract = WP_MANGA_DATA_DIR . $uniqid . '/' . $slugified_name;
    $extract_uri = WP_MANGA_DATA_URL;
    global $wp_filesystem;
    if ( ! is_a( $wp_filesystem, 'WP_Filesystem_Base') ){
        include_once(ABSPATH . 'wp-admin/includes/file.php');$creds = request_filesystem_credentials( site_url() );
       wp_filesystem($creds);
    }
    if (!$wp_filesystem->exists( $extract ) ){
        if( ! wp_mkdir_p( $extract ) ){
            ums_log_to_file("Cannot make dir $extract");
        }
    }
    if(count($ums_chapter_images) == 0)
    {
        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
            ums_log_to_file('No images found for: ' . $itemx['title']);
        }
        return true;
    }
    $has_image = '';
    $existing_images = get_post_meta($post_id, 'ums_' . $slugified_name . '_cnt', true);
    if(!$existing_images)
    {
        $existing_images = 0;
    }
    $index = 1;
    foreach( $ums_chapter_images as $image )
    {
        if($index > $existing_images){
            if($use_phantom == '2' || $use_phantom == '4')
            {
                $img_use_phantom = $use_phantom;
            }
            else
            {
                $img_use_phantom = '0';
            }
            $data = ums_get_web_page( $image, ums_get_random_user_agent(), $img_use_phantom );
            if( $data === false ){
                ums_log_to_file("Cannot get single chapter image from " . $image);            
                continue;
            }
            if($img_use_phantom == '2' || $img_use_phantom == '4')
            {
                $data = base64_decode($data);
                if( $data === false ){
                    ums_log_to_file("Cannot base64decode for " . $image);            
                    continue;
                }
            }
            $pathinfo = pathinfo( $image );
            $file_name = ums_url_file_name_filter( $pathinfo['basename'] );
            $resp = $wp_filesystem->put_contents( "{$extract}/{$index}-{$file_name}", $data );
            error_log("{$extract}/{$index}-{$file_name}");
            if( $resp && empty( $has_image ) )
            {
                $has_image = '1';
            }
        }
        $index++;
    }
    if( empty( $has_image ) ){
        $wp_filesystem->copy( dirname(__FILE__) . "/images/image-placeholder.jpg", "{$extract}/image-placeholder.jpg" );
    }
    $ch_name = str_replace($manga_name, '', $itemx['title']);
    $ch_name = trim(trim($ch_name, '- '));
    $ch_name = trim($ch_name);
    $chapter_args = array(
        'post_id'             => $post_id,
        'volume_id'           => $volume_id,
        'chapter_name'        => $ch_name,
        'chapter_name_extend' => '',
        'chapter_slug'        => $slugified_name,
    );
    $chapter_2 = $wp_manga_chapter->get_chapter_by_slug( $post_id, $slugified_name );
    if($chapter_2 && $chapter_2['volume_id'] == $volume_id && $chapter_2['chapter_slug'] == $slugified_name){
        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
            ums_log_to_file('Chapter found to be already published: ' . $itemx['title']);
        }
        return true;
    }
    if (isset($ums_Main_Settings['enable_detailed_logging'])) {
        ums_log_to_file('Uploading chapter: ' . $itemx['title']);
    }
    $result = $wp_manga_storage->wp_manga_upload_single_chapter( $chapter_args, $extract, $extract_uri, $storage );
    if($result == false || $result == null)
    {
        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
            ums_log_to_file('wp_manga_upload_single_chapter failed, details: extract: ' . $extract . ' -- extract_uri: ' . $extract_uri . ' -- storage: ' . $storage . ' -- chapter_args: ' . print_r($chapter_args, true));
        }
    }
    return $result; 
}
function ums_display_random_user(){
    add_action('pre_user_query', 'ums_my_user_by_rand');
    $args = array(
      'orderby' => 'user_login', 'order' => 'ASC', 'number' => 1, 'role__in' => array( 'contributor','author','editor','administrator','super-admin' )
    );
    $user_query = new WP_User_Query( $args );
    $user_query->query();
    $results = $user_query->results;
    if(empty($results))
    {
        return false;
    }
    shuffle($results);
    return array_pop($results);
  }
function ums_put_upload_cloud_list( $item, $upload_cloud_file ){

    $list = ums_get_upload_cloud_list($upload_cloud_file);
    
    if( ! isset( $list[ $item['id'] ] ) )
    {
        global $wp_filesystem;
        if ( ! is_a( $wp_filesystem, 'WP_Filesystem_Base') ){
            include_once(ABSPATH . 'wp-admin/includes/file.php');$creds = request_filesystem_credentials( site_url() );
            wp_filesystem($creds);
        }
        $list[ $item['id'] ] = $item;
        $wp_filesystem->put_contents( $upload_cloud_file, json_encode( $list, JSON_PRETTY_PRINT ) );
    }

    return true;
}

function ums_randomName() {
    $firstname = array(
        'Johnathon',
        'Anthony',
        'Erasmo',
        'Raleigh',
        'Nancie',
        'Tama',
        'Camellia',
        'Augustine',
        'Christeen',
        'Luz',
        'Diego',
        'Lyndia',
        'Thomas',
        'Georgianna',
        'Leigha',
        'Alejandro',
        'Marquis',
        'Joan',
        'Stephania',
        'Elroy',
        'Zonia',
        'Buffy',
        'Sharie',
        'Blythe',
        'Gaylene',
        'Elida',
        'Randy',
        'Margarete',
        'Margarett',
        'Dion',
        'Tomi',
        'Arden',
        'Clora',
        'Laine',
        'Becki',
        'Margherita',
        'Bong',
        'Jeanice',
        'Qiana',
        'Lawanda',
        'Rebecka',
        'Maribel',
        'Tami',
        'Yuri',
        'Michele',
        'Rubi',
        'Larisa',
        'Lloyd',
        'Tyisha',
        'Samatha',
    );

    $lastname = array(
        'Mischke',
        'Serna',
        'Pingree',
        'Mcnaught',
        'Pepper',
        'Schildgen',
        'Mongold',
        'Wrona',
        'Geddes',
        'Lanz',
        'Fetzer',
        'Schroeder',
        'Block',
        'Mayoral',
        'Fleishman',
        'Roberie',
        'Latson',
        'Lupo',
        'Motsinger',
        'Drews',
        'Coby',
        'Redner',
        'Culton',
        'Howe',
        'Stoval',
        'Michaud',
        'Mote',
        'Menjivar',
        'Wiers',
        'Paris',
        'Grisby',
        'Noren',
        'Damron',
        'Kazmierczak',
        'Haslett',
        'Guillemette',
        'Buresh',
        'Center',
        'Kucera',
        'Catt',
        'Badon',
        'Grumbles',
        'Antes',
        'Byron',
        'Volkman',
        'Klemp',
        'Pekar',
        'Pecora',
        'Schewe',
        'Ramage',
    );

    $name = $firstname[rand ( 0 , count($firstname) -1)];
    $name .= ' ';
    $name .= $lastname[rand ( 0 , count($lastname) -1)];

    return $name;
}
function ums_strip_links($content)
{
    $content1 = preg_replace('~<a(?:[^>]*)>~', "", $content);
    if($content1 !== null)
    {
        $content = $content1;
    }
    $content1 = preg_replace('~<\/a>~', "", $content);
    if($content1 !== null)
    {
        $content = $content1;
    }
    return $content;
}
function ums_run_rule($param, $type, $auto = 1, $rerun_count = 0)
{
    // LUCA Free License v1.0 - No activation required, DO WHAT THE FUCK YOU WANT TO.
    global $wp_filesystem;
    if ( ! is_a( $wp_filesystem, 'WP_Filesystem_Base') ){
        include_once(ABSPATH . 'wp-admin/includes/file.php');$creds = request_filesystem_credentials( site_url() );
        wp_filesystem($creds);
    }
    $theme = wp_get_theme();
    if ( 'Madara' != $theme->name && 'Madara' != $theme->parent_theme ) {
        ums_log_to_file('This plugin requires the Madara theme to work! Please install it from here: https://mangabooth.com/product/wp-manga-theme-madara/');
        if($auto == 1)
        {
            ums_clearFromList($param, $type);
        }
        return 'fail';
    }
    if( ! class_exists('WP_MANGA_STORAGE') ) {
        ums_log_to_file('Madara Core Plugin is missing! Please install it from here: https://mangabooth.com/product/wp-manga-theme-madara/');
        if($auto == 1)
        {
            ums_clearFromList($param, $type);
        }
        return 'fail';
    }
    $ums_Main_Settings = get_option('ums_Main_Settings', false);
    global $wp_embed;
    global $wp_manga;
    global $wp_manga_storage;
    global $wp_manga_chapter;
    global $wp_manga_volume;
    if($rerun_count == 0)
    {
        $f = fopen(get_temp_dir() . 'ums_' . $type . '_' . $param, 'w');
        if($f !== false)
        {
            $flock_disabled = explode(',', ini_get('disable_functions'));
            if(!in_array('flock', $flock_disabled))
            {
                if (!flock($f, LOCK_EX | LOCK_NB)) {
                    return 'nochange';
                }
            }
        }
        $GLOBALS['wp_object_cache']->delete('ums_running_list', 'options');
        if (!get_option('ums_running_list')) {
            $running = array();
        } else {
            $running = get_option('ums_running_list');
        }
        if (!empty($running)) {
            if (in_array(array(
                $param => $type
            ), $running))
            {
                if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                    ums_log_to_file('Only one instance of this rule is allowed. Rule is already running!');
                }
                return 'nochange';
            }
        }
        $running[] = array(
            $param => $type
        );
        update_option('ums_running_list', $running, false);
        register_shutdown_function('ums_clear_flag_at_shutdown', $param, $type);
        if (isset($ums_Main_Settings['rule_timeout']) && $ums_Main_Settings['rule_timeout'] != '') {
            $timeout = intval($ums_Main_Settings['rule_timeout']);
        } else {
            $timeout = 3600;
        }
        ini_set('safe_mode', 'Off');
        ini_set('max_execution_time', $timeout);
        ini_set('ignore_user_abort', 1);
        if(function_exists('ignore_user_abort'))
        {
            ignore_user_abort(true);
        }
                if(function_exists('set_time_limit'))
        {
            set_time_limit($timeout);
        }
    }
    else
    {
        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
            ums_log_to_file('Retrying to run rule, retry count: ' . $rerun_count);
        }
    }
    $ums_imported_chapters = 0;
    if (isset($ums_Main_Settings['ums_enabled']) && $ums_Main_Settings['ums_enabled'] == 'on') {
        try {
            $item_img         = '';
            $cont             = 0;
            $found            = 0;
            $schedule         = '';
            $max              = PHP_INT_MAX;
            $active           = '0';
            $last_run         = '';
            $first            = false;
            $others           = array();
            $list_item        = '';
            $default_category = '';
            $extra_categories = '';
            $posted_items    = array();
            $post_status     = 'publish';
            $accept_comments = 'closed';
            $post_user_name  = 1;
            $can_create_cat  = 'off';
            $item_create_tag = '';
            $can_create_tag  = 'disabled';
            $item_tags       = '';
            $auto_categories = 'disabled';
            $get_img         = '';
            $img_found       = false;
            $post_array      = array();
            $use_phantom     = '';
            $source_site     = 'fanfox.net';
            $manga_name      = '';
            $reverse_chapters= '';
            $skip_last      = '';
            $result_type     = '';
            $manga_author    = '';
            $manga_artist    = '';
            $manga_genres    = '';
            $manga_exgenres  = '';
            $manga_year_after = '';
            $manga_year_before= '';
            $manga_min_rating = '';
            $manga_completed  = '';
            $manga_sorting    = '';
            $manga_direction  = '';
            $max_manga        = '';
            $continue_search  = '';
            $chapter_warning  = '';
            $chapter_slug     = '';
            $always_first     = '';
            $enable_pingback  = '';
            $enable_comments  = '';
            $rule_translate   = '';
            $no_translate_title='';
            $get_date         = '';
            $phantom_wait     = '';
            $strip_images     = '';
            if($type == 0)
            {
                $GLOBALS['wp_object_cache']->delete('ums_rules_list', 'options');
                if (!get_option('ums_rules_list')) {
                    $rules = array();
                } else {
                    $rules = get_option('ums_rules_list');
                }
                if (!empty($rules)) {
                    foreach ($rules as $request => $bundle[]) {
                        if ($cont == $param) {
                            $bundle_values    = array_values($bundle);
                            $myValues         = $bundle_values[$cont];
                            $array_my_values  = array_values($myValues);for($iji=0;$iji<count($array_my_values);++$iji){if(is_string($array_my_values[$iji])){$array_my_values[$iji]=stripslashes($array_my_values[$iji]);}}
                            $manga_name       = isset($array_my_values[0]) ? $array_my_values[0] : '';
                            $schedule         = isset($array_my_values[1]) ? $array_my_values[1] : '';
                            $active           = isset($array_my_values[2]) ? $array_my_values[2] : '';
                            $last_run         = isset($array_my_values[3]) ? $array_my_values[3] : '';
                            $max              = isset($array_my_values[4]) ? $array_my_values[4] : '';
                            $post_status      = isset($array_my_values[5]) ? $array_my_values[5] : '';
                            $post_user_name   = isset($array_my_values[6]) ? $array_my_values[6] : '';
                            $item_create_tag  = isset($array_my_values[7]) ? $array_my_values[7] : '';
                            $default_category = isset($array_my_values[8]) ? $array_my_values[8] : '';
                            $auto_categories  = isset($array_my_values[9]) ? $array_my_values[9] : '';
                            $can_create_tag   = isset($array_my_values[10]) ? $array_my_values[10] : '';
                            $use_phantom      = isset($array_my_values[11]) ? $array_my_values[11] : '';
                            $reverse_chapters = isset($array_my_values[12]) ? $array_my_values[12] : '';
                            $result_type      = isset($array_my_values[13]) ? $array_my_values[13] : '';
                            $manga_author     = isset($array_my_values[14]) ? $array_my_values[14] : '';
                            $manga_artist     = isset($array_my_values[15]) ? $array_my_values[15] : '';
                            $manga_genres     = isset($array_my_values[16]) ? $array_my_values[16] : '';
                            $manga_exgenres   = isset($array_my_values[17]) ? $array_my_values[17] : '';
                            $manga_year_before= isset($array_my_values[18]) ? $array_my_values[18] : '';
                            $manga_year_after = isset($array_my_values[19]) ? $array_my_values[19] : '';
                            $manga_min_rating = isset($array_my_values[20]) ? $array_my_values[20] : '';
                            $manga_completed  = isset($array_my_values[21]) ? $array_my_values[21] : '';
                            $manga_sorting    = isset($array_my_values[22]) ? $array_my_values[22] : '';
                            $manga_direction  = isset($array_my_values[23]) ? $array_my_values[23] : '';
                            $max_manga        = isset($array_my_values[24]) ? $array_my_values[24] : '';
                            $continue_search  = isset($array_my_values[25]) ? $array_my_values[25] : '';
                            $chapter_warning  = isset($array_my_values[26]) ? $array_my_values[26] : '';
                            $enable_comments  = isset($array_my_values[27]) ? $array_my_values[27] : '';
                            $enable_pingback  = isset($array_my_values[28]) ? $array_my_values[28] : '';
                            $get_date         = isset($array_my_values[29]) ? $array_my_values[29] : '';
                            $phantom_wait     = isset($array_my_values[30]) ? $array_my_values[30] : '';
                            $rule_translate   = isset($array_my_values[31]) ? $array_my_values[31] : '';
                            $no_translate_title = isset($array_my_values[32]) ? $array_my_values[32] : '';
                            $skip_last       = isset($array_my_values[33]) ? $array_my_values[33] : '';
                            $found            = 1;
                            break;
                        }
                        $cont = $cont + 1;
                    }
                } else {
                    ums_log_to_file('No rules found for ums_rules_list!');
                    if($auto == 1)
                    {
                        ums_clearFromList($param, $type);
                    }
                    return 'fail';
                }
                if ($found == 0) {
                    ums_log_to_file($param . ' not found in ums_rules_list!');
                    if($auto == 1)
                    {
                        ums_clearFromList($param, $type);
                    }
                    return 'fail';
                } else {
                    if($rerun_count == 0)
                    {
                        $GLOBALS['wp_object_cache']->delete('ums_rules_list', 'options');
                        $rules = get_option('ums_rules_list');
                        $rules[$param][3] = ums_get_date_now();
                        update_option('ums_rules_list', $rules, false);
                    }
                }
            }
            elseif($type == 1)
            {
                $GLOBALS['wp_object_cache']->delete('ums_text_list', 'options');
                if (!get_option('ums_text_list')) {
                    $rules = array();
                } else {
                    $rules = get_option('ums_text_list');
                }
                if (!empty($rules)) {
                    foreach ($rules as $request => $bundle[]) {
                        if ($cont == $param) {
                            $bundle_values    = array_values($bundle);
                            $myValues         = $bundle_values[$cont];
                            $array_my_values  = array_values($myValues);for($iji=0;$iji<count($array_my_values);++$iji){if(is_string($array_my_values[$iji])){$array_my_values[$iji]=stripslashes($array_my_values[$iji]);}}
                            $manga_name       = isset($array_my_values[0]) ? $array_my_values[0] : '';
                            $schedule         = isset($array_my_values[1]) ? $array_my_values[1] : '';
                            $active           = isset($array_my_values[2]) ? $array_my_values[2] : '';
                            $last_run         = isset($array_my_values[3]) ? $array_my_values[3] : '';
                            $max              = isset($array_my_values[4]) ? $array_my_values[4] : '';
                            $post_status      = isset($array_my_values[5]) ? $array_my_values[5] : '';
                            $post_user_name   = isset($array_my_values[6]) ? $array_my_values[6] : '';
                            $item_create_tag  = isset($array_my_values[7]) ? $array_my_values[7] : '';
                            $default_category = isset($array_my_values[8]) ? $array_my_values[8] : '';
                            $auto_categories  = isset($array_my_values[9]) ? $array_my_values[9] : '';
                            $can_create_tag   = isset($array_my_values[10]) ? $array_my_values[10] : '';
                            $use_phantom      = isset($array_my_values[11]) ? $array_my_values[11] : '';
                            $reverse_chapters = isset($array_my_values[12]) ? $array_my_values[12] : '';
                            $max_manga        = isset($array_my_values[13]) ? $array_my_values[13] : '';
                            $chapter_warning  = isset($array_my_values[14]) ? $array_my_values[14] : '';
                            $enable_comments  = isset($array_my_values[15]) ? $array_my_values[15] : '';
                            $enable_pingback  = isset($array_my_values[16]) ? $array_my_values[16] : '';
                            $get_date         = isset($array_my_values[17]) ? $array_my_values[17] : '';
                            $rule_translate   = isset($array_my_values[18]) ? $array_my_values[18] : '';
                            $no_translate_title= isset($array_my_values[19]) ? $array_my_values[19] : '';
                            $chapter_slug     = isset($array_my_values[20]) ? $array_my_values[20] : '';
                            $phantom_wait     = isset($array_my_values[21]) ? $array_my_values[21] : '';
                            $strip_images     = isset($array_my_values[22]) ? $array_my_values[22] : '';
                            $found            = 1;
                            break;
                        }
                        $cont = $cont + 1;
                    }
                } else {
                    ums_log_to_file('No rules found for ums_text_list!');
                    if($auto == 1)
                    {
                        ums_clearFromList($param, $type);
                    }
                    return 'fail';
                }
                if ($found == 0) {
                    ums_log_to_file($param . ' not found in ums_text_list!');
                    if($auto == 1)
                    {
                        ums_clearFromList($param, $type);
                    }
                    return 'fail';
                } else {
                    if($rerun_count == 0)
                    {
                        $GLOBALS['wp_object_cache']->delete('ums_text_list', 'options');
                        $rules = get_option('ums_text_list');
                        $rules[$param][3] = ums_get_date_now();
                        update_option('ums_text_list', $rules, false);
                    }
                }
            }
            elseif($type == 2)
            {
                $GLOBALS['wp_object_cache']->delete('ums_novel_list', 'options');
                if (!get_option('ums_novel_list')) {
                    $rules = array();
                } else {
                    $rules = get_option('ums_novel_list');
                }
                if (!empty($rules)) {
                    foreach ($rules as $request => $bundle[]) {
                        if ($cont == $param) {
                            $bundle_values    = array_values($bundle);
                            $myValues         = $bundle_values[$cont];
                            $array_my_values  = array_values($myValues);for($iji=0;$iji<count($array_my_values);++$iji){if(is_string($array_my_values[$iji])){$array_my_values[$iji]=stripslashes($array_my_values[$iji]);}}
                            $manga_name       = isset($array_my_values[0]) ? $array_my_values[0] : '';
                            $schedule         = isset($array_my_values[1]) ? $array_my_values[1] : '';
                            $active           = isset($array_my_values[2]) ? $array_my_values[2] : '';
                            $last_run         = isset($array_my_values[3]) ? $array_my_values[3] : '';
                            $max              = isset($array_my_values[4]) ? $array_my_values[4] : '';
                            $post_status      = isset($array_my_values[5]) ? $array_my_values[5] : '';
                            $post_user_name   = isset($array_my_values[6]) ? $array_my_values[6] : '';
                            $item_create_tag  = isset($array_my_values[7]) ? $array_my_values[7] : '';
                            $default_category = isset($array_my_values[8]) ? $array_my_values[8] : '';
                            $auto_categories  = isset($array_my_values[9]) ? $array_my_values[9] : '';
                            $can_create_tag   = isset($array_my_values[10]) ? $array_my_values[10] : '';
                            $use_phantom      = isset($array_my_values[11]) ? $array_my_values[11] : '';
                            $reverse_chapters = isset($array_my_values[12]) ? $array_my_values[12] : '';
                            $max_manga        = isset($array_my_values[13]) ? $array_my_values[13] : '';
                            $chapter_warning  = isset($array_my_values[14]) ? $array_my_values[14] : '';
                            $enable_comments  = isset($array_my_values[15]) ? $array_my_values[15] : '';
                            $enable_pingback  = isset($array_my_values[16]) ? $array_my_values[16] : '';
                            $get_date         = isset($array_my_values[17]) ? $array_my_values[17] : '';
                            $rule_translate   = isset($array_my_values[18]) ? $array_my_values[18] : '';
                            $no_translate_title= isset($array_my_values[19]) ? $array_my_values[19] : '';
                            $chapter_slug     = isset($array_my_values[20]) ? $array_my_values[20] : '';
                            $phantom_wait     = isset($array_my_values[21]) ? $array_my_values[21] : '';
                            $strip_images     = isset($array_my_values[22]) ? $array_my_values[22] : '';
                            $found            = 1;
                            break;
                        }
                        $cont = $cont + 1;
                    }
                } else {
                    ums_log_to_file('No rules found for ums_novel_list!');
                    if($auto == 1)
                    {
                        ums_clearFromList($param, $type);
                    }
                    return 'fail';
                }
                if ($found == 0) {
                    ums_log_to_file($param . ' not found in ums_novel_list!');
                    if($auto == 1)
                    {
                        ums_clearFromList($param, $type);
                    }
                    return 'fail';
                } else {
                    if($rerun_count == 0)
                    {
                        $GLOBALS['wp_object_cache']->delete('ums_novel_list', 'options');
                        $rules = get_option('ums_novel_list');
                        $rules[$param][3] = ums_get_date_now();
                        update_option('ums_novel_list', $rules, false);
                    }
                }
            }
            elseif($type == 3)
            {
                $GLOBALS['wp_object_cache']->delete('ums_vipnovel_list', 'options');
                if (!get_option('ums_vipnovel_list')) {
                    $rules = array();
                } else {
                    $rules = get_option('ums_vipnovel_list');
                }
                if (!empty($rules)) {
                    foreach ($rules as $request => $bundle[]) {
                        if ($cont == $param) {
                            $bundle_values    = array_values($bundle);
                            $myValues         = $bundle_values[$cont];
                            $array_my_values  = array_values($myValues);for($iji=0;$iji<count($array_my_values);++$iji){if(is_string($array_my_values[$iji])){$array_my_values[$iji]=stripslashes($array_my_values[$iji]);}}
                            $manga_name       = isset($array_my_values[0]) ? $array_my_values[0] : '';
                            $schedule         = isset($array_my_values[1]) ? $array_my_values[1] : '';
                            $active           = isset($array_my_values[2]) ? $array_my_values[2] : '';
                            $last_run         = isset($array_my_values[3]) ? $array_my_values[3] : '';
                            $max              = isset($array_my_values[4]) ? $array_my_values[4] : '';
                            $post_status      = isset($array_my_values[5]) ? $array_my_values[5] : '';
                            $post_user_name   = isset($array_my_values[6]) ? $array_my_values[6] : '';
                            $item_create_tag  = isset($array_my_values[7]) ? $array_my_values[7] : '';
                            $default_category = isset($array_my_values[8]) ? $array_my_values[8] : '';
                            $auto_categories  = isset($array_my_values[9]) ? $array_my_values[9] : '';
                            $can_create_tag   = isset($array_my_values[10]) ? $array_my_values[10] : '';
                            $use_phantom      = isset($array_my_values[11]) ? $array_my_values[11] : '';
                            $reverse_chapters = isset($array_my_values[12]) ? $array_my_values[12] : '';
                            $max_manga        = isset($array_my_values[13]) ? $array_my_values[13] : '';
                            $chapter_warning  = isset($array_my_values[14]) ? $array_my_values[14] : '';
                            $enable_comments  = isset($array_my_values[15]) ? $array_my_values[15] : '';
                            $enable_pingback  = isset($array_my_values[16]) ? $array_my_values[16] : '';
                            $get_date         = isset($array_my_values[17]) ? $array_my_values[17] : '';
                            $rule_translate   = isset($array_my_values[18]) ? $array_my_values[18] : '';
                            $no_translate_title= isset($array_my_values[19]) ? $array_my_values[19] : '';
                            $chapter_slug     = isset($array_my_values[20]) ? $array_my_values[20] : '';
                            $phantom_wait     = isset($array_my_values[21]) ? $array_my_values[21] : '';
                            $strip_images     = isset($array_my_values[22]) ? $array_my_values[22] : '';
                            $found            = 1;
                            break;
                        }
                        $cont = $cont + 1;
                    }
                } else {
                    ums_log_to_file('No rules found for ums_vipnovel_list!');
                    if($auto == 1)
                    {
                        ums_clearFromList($param, $type);
                    }
                    return 'fail';
                }
                if ($found == 0) {
                    ums_log_to_file($param . ' not found in ums_vipnovel_list!');
                    if($auto == 1)
                    {
                        ums_clearFromList($param, $type);
                    }
                    return 'fail';
                } else {
                    if($rerun_count == 0)
                    {
                        $GLOBALS['wp_object_cache']->delete('ums_vipnovel_list', 'options');
                        $rules = get_option('ums_vipnovel_list');
                        $rules[$param][3] = ums_get_date_now();
                        update_option('ums_vipnovel_list', $rules, false);
                    }
                }
            }
            elseif($type == 4)
            {
                $GLOBALS['wp_object_cache']->delete('ums_novel_generic_list', 'options');
                if (!get_option('ums_novel_generic_list')) {
                    $rules = array();
                } else {
                    $rules = get_option('ums_novel_generic_list');
                }
                if (!empty($rules)) {
                    foreach ($rules as $request => $bundle[]) {
                        if ($cont == $param) {
                            $bundle_values    = array_values($bundle);
                            $myValues         = $bundle_values[$cont];
                            $array_my_values  = array_values($myValues);for($iji=0;$iji<count($array_my_values);++$iji){if(is_string($array_my_values[$iji])){$array_my_values[$iji]=stripslashes($array_my_values[$iji]);}}
                            $manga_name       = isset($array_my_values[0]) ? $array_my_values[0] : '';
                            $schedule         = isset($array_my_values[1]) ? $array_my_values[1] : '';
                            $active           = isset($array_my_values[2]) ? $array_my_values[2] : '';
                            $last_run         = isset($array_my_values[3]) ? $array_my_values[3] : '';
                            $max              = isset($array_my_values[4]) ? $array_my_values[4] : '';
                            $post_status      = isset($array_my_values[5]) ? $array_my_values[5] : '';
                            $post_user_name   = isset($array_my_values[6]) ? $array_my_values[6] : '';
                            $item_create_tag  = isset($array_my_values[7]) ? $array_my_values[7] : '';
                            $default_category = isset($array_my_values[8]) ? $array_my_values[8] : '';
                            $auto_categories  = isset($array_my_values[9]) ? $array_my_values[9] : '';
                            $can_create_tag   = isset($array_my_values[10]) ? $array_my_values[10] : '';
                            $use_phantom      = isset($array_my_values[11]) ? $array_my_values[11] : '';
                            $reverse_chapters = isset($array_my_values[12]) ? $array_my_values[12] : '';
                            $max_manga        = isset($array_my_values[13]) ? $array_my_values[13] : '';
                            $chapter_warning  = isset($array_my_values[14]) ? $array_my_values[14] : '';
                            $enable_comments  = isset($array_my_values[15]) ? $array_my_values[15] : '';
                            $enable_pingback  = isset($array_my_values[16]) ? $array_my_values[16] : '';
                            $get_date         = isset($array_my_values[17]) ? $array_my_values[17] : '';
                            $rule_translate   = isset($array_my_values[18]) ? $array_my_values[18] : '';
                            $no_translate_title= isset($array_my_values[19]) ? $array_my_values[19] : '';
                            $chapter_slug     = isset($array_my_values[20]) ? $array_my_values[20] : '';
                            $phantom_wait     = isset($array_my_values[21]) ? $array_my_values[21] : '';
                            $always_first     = isset($array_my_values[22]) ? $array_my_values[22] : '';
                            $strip_images     = isset($array_my_values[23]) ? $array_my_values[23] : '';
                            $found            = 1;
                            break;
                        }
                        $cont = $cont + 1;
                    }
                } else {
                    ums_log_to_file('No rules found for ums_novel_generic_list!');
                    if($auto == 1)
                    {
                        ums_clearFromList($param, $type);
                    }
                    return 'fail';
                }
                if ($found == 0) {
                    ums_log_to_file($param . ' not found in ums_novel_generic_list!');
                    if($auto == 1)
                    {
                        ums_clearFromList($param, $type);
                    }
                    return 'fail';
                } else {
                    if($rerun_count == 0)
                    {
                        $GLOBALS['wp_object_cache']->delete('ums_novel_generic_list', 'options');
                        $rules = get_option('ums_novel_generic_list');
                        $rules[$param][3] = ums_get_date_now();
                        update_option('ums_novel_generic_list', $rules, false);
                    }
                }
            }
            elseif($type == 5)
            {
                $GLOBALS['wp_object_cache']->delete('ums_manga_generic_list', 'options');
                if (!get_option('ums_manga_generic_list')) {
                    $rules = array();
                } else {
                    $rules = get_option('ums_manga_generic_list');
                }
                if (!empty($rules)) {
                    foreach ($rules as $request => $bundle[]) {
                        if ($cont == $param) {
                            $bundle_values    = array_values($bundle);
                            $myValues         = $bundle_values[$cont];
                            $array_my_values  = array_values($myValues);for($iji=0;$iji<count($array_my_values);++$iji){if(is_string($array_my_values[$iji])){$array_my_values[$iji]=stripslashes($array_my_values[$iji]);}}
                            $manga_name       = isset($array_my_values[0]) ? $array_my_values[0] : '';
                            $schedule         = isset($array_my_values[1]) ? $array_my_values[1] : '';
                            $active           = isset($array_my_values[2]) ? $array_my_values[2] : '';
                            $last_run         = isset($array_my_values[3]) ? $array_my_values[3] : '';
                            $max              = isset($array_my_values[4]) ? $array_my_values[4] : '';
                            $post_status      = isset($array_my_values[5]) ? $array_my_values[5] : '';
                            $post_user_name   = isset($array_my_values[6]) ? $array_my_values[6] : '';
                            $item_create_tag  = isset($array_my_values[7]) ? $array_my_values[7] : '';
                            $default_category = isset($array_my_values[8]) ? $array_my_values[8] : '';
                            $auto_categories  = isset($array_my_values[9]) ? $array_my_values[9] : '';
                            $can_create_tag   = isset($array_my_values[10]) ? $array_my_values[10] : '';
                            $use_phantom      = isset($array_my_values[11]) ? $array_my_values[11] : '';
                            $max_manga        = isset($array_my_values[12]) ? $array_my_values[12] : '';
                            $chapter_warning  = isset($array_my_values[13]) ? $array_my_values[13] : '';
                            $enable_comments  = isset($array_my_values[14]) ? $array_my_values[14] : '';
                            $enable_pingback  = isset($array_my_values[15]) ? $array_my_values[15] : '';
                            $get_date         = isset($array_my_values[16]) ? $array_my_values[16] : '';
                            $rule_translate   = isset($array_my_values[17]) ? $array_my_values[17] : '';
                            $no_translate_title= isset($array_my_values[18]) ? $array_my_values[18] : '';
                            $found            = 1;
                            break;
                        }
                        $cont = $cont + 1;
                    }
                } else {
                    ums_log_to_file('No rules found for ums_manga_generic_list!');
                    if($auto == 1)
                    {
                        ums_clearFromList($param, $type);
                    }
                    return 'fail';
                }
                if ($found == 0) {
                    ums_log_to_file($param . ' not found in ums_manga_generic_list!');
                    if($auto == 1)
                    {
                        ums_clearFromList($param, $type);
                    }
                    return 'fail';
                } else {
                    if($rerun_count == 0)
                    {
                        $GLOBALS['wp_object_cache']->delete('ums_manga_generic_list', 'options');
                        $rules = get_option('ums_manga_generic_list');
                        $rules[$param][3] = ums_get_date_now();
                        update_option('ums_manga_generic_list', $rules, false);
                    }
                }
            }
            elseif($type == 6)
            {
                $GLOBALS['wp_object_cache']->delete('ums_fanmtl_list', 'options');
                if (!get_option('ums_fanmtl_list')) {
                    $rules = array();
                } else {
                    $rules = get_option('ums_fanmtl_list');
                }
                if (!empty($rules)) {
                    foreach ($rules as $request => $bundle[]) {
                        if ($cont == $param) {
                            $bundle_values    = array_values($bundle);
                            $myValues         = $bundle_values[$cont];
                            $array_my_values  = array_values($myValues);for($iji=0;$iji<count($array_my_values);++$iji){if(is_string($array_my_values[$iji])){$array_my_values[$iji]=stripslashes($array_my_values[$iji]);}}
                            $manga_name       = isset($array_my_values[0]) ? $array_my_values[0] : '';
                            $schedule         = isset($array_my_values[1]) ? $array_my_values[1] : '';
                            $active           = isset($array_my_values[2]) ? $array_my_values[2] : '';
                            $last_run         = isset($array_my_values[3]) ? $array_my_values[3] : '';
                            $max              = isset($array_my_values[4]) ? $array_my_values[4] : '';
                            $post_status      = isset($array_my_values[5]) ? $array_my_values[5] : '';
                            $post_user_name   = isset($array_my_values[6]) ? $array_my_values[6] : '';
                            $item_create_tag  = isset($array_my_values[7]) ? $array_my_values[7] : '';
                            $default_category = isset($array_my_values[8]) ? $array_my_values[8] : '';
                            $auto_categories  = isset($array_my_values[9]) ? $array_my_values[9] : '';
                            $can_create_tag   = isset($array_my_values[10]) ? $array_my_values[10] : '';
                            $use_phantom      = isset($array_my_values[11]) ? $array_my_values[11] : '';
                            $reverse_chapters = isset($array_my_values[12]) ? $array_my_values[12] : '';
                            $max_manga        = isset($array_my_values[13]) ? $array_my_values[13] : '';
                            $chapter_warning  = isset($array_my_values[14]) ? $array_my_values[14] : '';
                            $enable_comments  = isset($array_my_values[15]) ? $array_my_values[15] : '';
                            $enable_pingback  = isset($array_my_values[16]) ? $array_my_values[16] : '';
                            $get_date         = isset($array_my_values[17]) ? $array_my_values[17] : '';
                            $rule_translate   = isset($array_my_values[18]) ? $array_my_values[18] : '';
                            $no_translate_title= isset($array_my_values[19]) ? $array_my_values[19] : '';
                            $chapter_slug     = isset($array_my_values[20]) ? $array_my_values[20] : '';
                            $phantom_wait     = isset($array_my_values[21]) ? $array_my_values[21] : '';
                            $strip_images     = isset($array_my_values[22]) ? $array_my_values[22] : '';
                            $found            = 1;
                            break;
                        }
                        $cont = $cont + 1;
                    }
                } else {
                    ums_log_to_file('No rules found for ums_fanmtl_list!');
                    if($auto == 1)
                    {
                        ums_clearFromList($param, $type);
                    }
                    return 'fail';
                }
                if ($found == 0) {
                    ums_log_to_file($param . ' not found in ums_fanmtl_list!');
                    if($auto == 1)
                    {
                        ums_clearFromList($param, $type);
                    }
                    return 'fail';
                } else {
                    if($rerun_count == 0)
                    {
                        $GLOBALS['wp_object_cache']->delete('ums_fanmtl_list', 'options');
                        $rules = get_option('ums_fanmtl_list');
                        $rules[$param][3] = ums_get_date_now();
                        update_option('ums_fanmtl_list', $rules, false);
                    }
                }
            }
            else
            {
                ums_log_to_file('Unrecognized rule type: ' . $type);
                if($auto == 1)
                {
                    ums_clearFromList($param, $type);
                }
                return 'fail';
            }
            $user_name_type = $post_user_name;
            if (isset($ums_Main_Settings['manga_storage']) && $ums_Main_Settings['manga_storage'] != '') {
                $storage = $ums_Main_Settings['manga_storage'];
            }
            else
            {
                $storage = 'local';
            }
            if($type == 0)
            {
                $items = array();
                $page_increased = false;
                if($source_site == 'fanfox.net')
                {
                    require_once (dirname(__FILE__) . "/res/mangafox-master/vendor/autoload.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/Exceptions/MangafoxDirectoryBuilderInvalidBrowseByFilterException.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/Exceptions/MangafoxDirectoryBuilderInvalidBrowseByGenreValueException.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/Exceptions/MangafoxDirectoryBuilderInvalidBrowseByInitialValueException.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/Exceptions/MangafoxDirectoryBuilderInvalidBrowseByReleasedYearValueException.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/Exceptions/MangafoxDirectoryBuilderInvalidBrowseByStatusValueException.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/Exceptions/MangafoxDirectoryBuilderInvalidSortByDirectionException.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/Exceptions/MangafoxDirectoryBuilderInvalidSortByValueException.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/Exceptions/MangafoxException.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/Exceptions/MangafoxInvalidArgumentException.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/Exceptions/MangafoxParserDateNotSupportedException.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/Exceptions/MangafoxResourceParserInvalidUrlException.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/Exceptions/MangafoxResourceRequestNotFoundException.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/Exceptions/MangafoxScanBuilderInvalidUrlException.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/Exceptions/MangafoxSearchBuilderInvalidArtistFilterException.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/Exceptions/MangafoxSearchBuilderInvalidAuthorFilterException.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/Exceptions/MangafoxSearchBuilderInvalidCompletedValueException.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/Exceptions/MangafoxSearchBuilderInvalidFilterException.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/Exceptions/MangafoxSearchBuilderInvalidGenresFilterException.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/Exceptions/MangafoxSearchBuilderInvalidGenresValueException.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/Exceptions/MangafoxSearchBuilderInvalidNameFilterException.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/Exceptions/MangafoxSearchBuilderInvalidRatingFilterException.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/Exceptions/MangafoxSearchBuilderInvalidRatingValueException.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/Exceptions/MangafoxSearchBuilderInvalidReleasedYearFilterException.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/Exceptions/MangafoxSearchBuilderInvalidReleasedYearValueException.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/Exceptions/MangafoxSearchBuilderInvalidSortByDirectionException.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/Exceptions/MangafoxSearchBuilderInvalidSortByValueException.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/Exceptions/MangafoxSearchBuilderInvalidTypeException.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/Traits/ParseDateTrait.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/MangafoxDirectoryBuilder.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/MangafoxDirectoryParser.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/MangafoxDirectoryRequest.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/MangafoxIndexBuilder.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/MangafoxIndexParser.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/MangafoxIndexRequest.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/MangafoxReleasesBuilder.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/MangafoxReleasesParser.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/MangafoxReleasesRequest.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/MangafoxResourceBuilder.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/MangafoxResourceParser.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/MangafoxResourceRequest.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/MangafoxScanBuilder.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/MangafoxScanParser.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/MangafoxScanRequest.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/MangafoxSearchBuilder.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/MangafoxSearchParser.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/MangafoxSearchRequest.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/MangaReaderContract.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/MangaReader.php"); 
                    require_once (dirname(__FILE__) . "/res/mangafox-master/src/Mangafox.php"); 
                    try
                    {
                        $umsmangamanager = new \Railken\Mangafox\Mangafox();
                        $prefixh = 'http://fanfox.net/manga/';
                        $wprefixh = 'http://www.fanfox.net/manga/';
                        $prefixs = 'https://fanfox.net/manga/';
                        $wprefixs = 'https://www.fanfox.net/manga/';
                        $manga_names = explode(',', $manga_name);
                        $manga_names = array_map('trim', $manga_names);
                        foreach($manga_names as $manga_name)
                        {
                            $manga_arr = array();
                            $is_url_search = true;
                            if (substr($manga_name, 0, strlen($prefixs)) == $prefixs) {
                                $manga_name = substr($manga_name, strlen($prefixs));
                                $manga_arr[] = $manga_name;
                            }
                            elseif (substr($manga_name, 0, strlen($prefixh)) == $prefixh) {
                                $manga_name = substr($manga_name, strlen($prefixh));
                                $manga_arr[] = $manga_name;
                            }
                            elseif (substr($manga_name, 0, strlen($wprefixh)) == $wprefixh) {
                                $manga_name = substr($manga_name, strlen($wprefixh));
                                $manga_arr[] = $manga_name;
                            }
                            elseif (substr($manga_name, 0, strlen($wprefixs)) == $wprefixs) {
                                $manga_name = substr($manga_name, strlen($wprefixs));
                                $manga_arr[] = $manga_name;
                            }
                            else
                            {
                                $is_url_search = false;
                            }
                            if($is_url_search == false)
                            {
                                if($result_type == '')
                                {
                                    $result_type = 'any';
                                }
                                $xresults = $umsmangamanager
                                    ->search()
                                    ->type($result_type);
                                if($manga_name != '' && $manga_name != '*')
                                {
                                    $xresults = $xresults->name('contains', $manga_name);
                                }
                                if($manga_author != '' && $manga_author != '*')
                                {
                                    $xresults = $xresults->author('contains', $manga_author);
                                }
                                if($manga_artist != '' && $manga_artist != '*')
                                {
                                    $xresults = $xresults->artist('contains', $manga_artist);
                                }
                                if($manga_genres != '' && $manga_genres != '*')
                                {
                                    $manga_genres = explode(',', $manga_genres);
                                    $manga_genres = array_map('trim', $manga_genres);
                                    $manga_genres = array_map('ucfirst', $manga_genres);
                                    $xresults = $xresults->genres('include', $manga_genres);
                                }
                                if($manga_exgenres != '' && $manga_exgenres != '*')
                                {
                                    $manga_exgenres = explode(',', $manga_exgenres);
                                    $manga_exgenres = array_map('trim', $manga_exgenres);
                                    $manga_exgenres = array_map('ucfirst', $manga_exgenres);
                                    $xresults = $xresults->genres('exclude', $manga_exgenres);
                                }
                                if($manga_year_before != '' && $manga_year_before != '*')
                                {
                                    $xresults = $xresults->releasedYear('<', $manga_year_before);
                                }
                                if($manga_year_after != '' && $manga_year_after != '*')
                                {
                                    $xresults = $xresults->releasedYear('>', $manga_year_after);
                                }
                                if($manga_min_rating != '' && $manga_min_rating != '*')
                                {
                                    $xresults = $xresults->rating('>', $manga_min_rating);
                                }
                                if($manga_completed != '' && $manga_completed != 'any')
                                {
                                    if($manga_completed == 'completed')
                                    {
                                        $xresults = $xresults->completed(1);
                                    }
                                    elseif($manga_completed == 'ongoing')
                                    {
                                        $xresults = $xresults->completed(0);
                                    }
                                }
                                if($manga_sorting != '' && $manga_sorting != 'any')
                                {
                                    if($manga_direction == '' || $manga_direction == 'any')
                                    {
                                        $manga_direction = 'asc';
                                    }
                                    $xresults = $xresults->sortBy($manga_sorting, $manga_direction);
                                }
                                elseif($manga_direction != '' && $manga_direction != 'any')
                                {
                                    $xresults = $xresults->sortBy('name', $manga_direction);
                                }
                                $skip_posts = '';
                                if($continue_search == '1')
                                {
                                    $GLOBALS['wp_object_cache']->delete('ums_continue_search', 'options');
                                    $skip_posts_temp = get_option('ums_continue_search', array());
                                    if(isset($skip_posts_temp[$param][$type]) && is_numeric($skip_posts_temp[$param][$type]))
                                    {
                                        $skip_posts = $skip_posts_temp[$param][$type];
                                        if($skip_posts == '0')
                                        {
                                            $skip_posts = 1;
                                            $skip_posts_temp[$param][$type] = '1';
                                        }
                                    }
                                    else
                                    {
                                        if(!is_array($skip_posts_temp))
                                        {
                                            $skip_posts_temp = array();
                                        }
                                        $skip_posts_temp[$param][$type] = 1;
                                    }
                                }
                                if($skip_posts != '')
                                {
                                    $xresults = $xresults->page($skip_posts);
                                }
                                $xresults = $xresults->get();
                                foreach($xresults->results as $mngres)
                                {
                                    $manga_arr[] = $mngres->uid;
                                }
                                if(count($manga_arr) == 0)
                                {
                                    if($continue_search == '1')
                                    {
                                        $skip_posts_temp[$param][$type] = 1;
                                        update_option('ums_continue_search', $skip_posts_temp);
                                    }
                                }
                                else
                                {
                                    if($continue_search == '1')
                                    {
                                        if(trim($max_manga) == '')
                                        {
                                            $page_increased = true;
                                            if(isset($skip_posts_temp[$param][$type]))
                                            {
                                                $skip_posts_temp[$param][$type] += 1;
                                            }
                                            else
                                            {
                                                $skip_posts_temp[$param][$type] = 2;
                                            }
                                            update_option('ums_continue_search', $skip_posts_temp);
                                        }
                                    }
                                }
                            }
                            if(trim($max_manga) != '')
                            {
                                $get_max_manga = intval(trim($max_manga));
                            }
                            else
                            {
                                $get_max_manga = 999;
                            }
                            $scraped_manga = 0;
                            foreach($manga_arr as $current_manga_slug)
                            {
                                if($get_max_manga <= $scraped_manga)
                                {
                                    break;
                                }
                                if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                    ums_log_to_file('Processing manga: ' . $current_manga_slug);
                                }
                                $current_manga_slug = trim($current_manga_slug, '/');
                                $current_manga_slug = $wp_manga_storage->slugify( $current_manga_slug );
                                $umsmanga = $umsmangamanager->resource($current_manga_slug)->get();
                                if(empty($umsmanga))
                                {
                                    ums_log_to_file('No results found in response ' . print_r($umsmanga, true));
                                    continue;
                                }
                                
                                $arr = ums_spin_and_translate($umsmanga->name, $umsmanga->description, $rule_translate, 'en');
                                if($arr === false)
                                {
                                    if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                        ums_log_to_file('Failed to translate manga details: ' . print_r($umsmanga->name, true));
                                    }
                                }
                                else
                                {
                                    if($no_translate_title != '1')
                                    {
                                        $umsmanga->name = $arr[0];
                                    }
                                    $umsmanga->description = $arr[1];
                                }
                                $xposts = get_posts(
                                    array(
                                        'post_type'              => 'wp-manga',
                                        'title'                  => html_entity_decode($umsmanga->name),
                                        'post_status'            => 'all',
                                        'numberposts'            => 1,
                                        'update_post_term_cache' => false,
                                        'update_post_meta_cache' => false,           
                                        'orderby'                => 'post_date ID',
                                        'order'                  => 'ASC',
                                    )
                                );
                                if ( ! empty( $xposts ) ) {
                                    $existing = $xposts[0];
                                } else {
                                    $existing = null;
                                }
                                $xrelease = '2021';
                                $released_time = '';
                                $sort_chap = $umsmanga->chapters;
                                foreach($sort_chap as $rvchap)
                                {
                                    $released_time = $rvchap->released_at;
                                    $time_year = strtotime($rvchap->released_at);
                                    if($time_year !== false)
                                    {
                                        $time_year = date("Y", $time_year);
                                        if($time_year !== false)
                                        {
                                            $xrelease = $time_year;
                                            break;
                                        }
                                    }
                                }
                                $iterator = $sort_chap->getIterator();
                                $iterator->uasort(function ($a, $b) {
                                    return ($a->number < $b->number) ? -1 : 1;
                                });
                                $umsmanga->chapters = iterator_to_array($iterator);
                                $accept_comments = 'closed';
                                if ($enable_comments == '1') {
                                    $accept_comments = 'open';
                                }
                                if(stristr($umsmanga->status, 'ongoing') !== false)
                                {
                                    $umsmanga->status = 'on-going';
                                }
                                elseif(stristr($umsmanga->status, 'completed') !== false)
                                {
                                    $umsmanga->status = 'end';
                                }
                                elseif(stristr($umsmanga->status, 'canceled') !== false)
                                {
                                    $umsmanga->status = 'canceled';
                                }
                                elseif(stristr($umsmanga->status, 'on hold') !== false)
                                {
                                    $umsmanga->status = 'on-hold';
                                }
                                elseif(stristr($umsmanga->status, 'upcoming') !== false)
                                {
                                    $umsmanga->status = 'upcoming';
                                }
                                if($existing == null)
                                {
                                    $post_args = array(
                                        'manga_import_slug' => $umsmanga->uid,
                                        'title'             => $umsmanga->name,
                                        'post_title'        => $umsmanga->name,
                                        'post_status'       => $post_status,
                                        'description'       => $umsmanga->description,
                                        'post_content'      => $umsmanga->description,
                                        'thumb'             => $umsmanga->cover,
                                        'status'            => $umsmanga->status,
                                        'altername'         => $umsmanga->name,
                                        'type'              => isset($umsmanga->genres[0]) ? $umsmanga->genres[0] : '',
                                        'release'           => $xrelease,
                                        'authors'           => str_replace(' [Add]', '', $umsmanga->author),
                                        'artists'           => str_replace(' [Add]', '', $umsmanga->author),
                                    );
                                    if ($enable_pingback == '1') 
                                    {
                                        $post_args['ping_status'] = 'open';
                                    } 
                                    else 
                                    {
                                        $post_args['ping_status'] = 'closed';
                                    }
                                    if($get_date == '1')
                                    {
                                        if(!empty($released_time))
                                        {
                                            if(strlen($released_time) == 4)
                                            {
                                                $released_time .= '-01-01 00:00';
                                            }
                                            $postdatex = gmdate("Y-m-d H:i:s", strtotime($released_time));
                                            $post_args['post_date_gmt'] = $postdatex;
                                        }
                                    }
                                    $post_args['comment_status'] = $accept_comments;
                                    $post_args['genres'] = '';
                                    $post_args['tags'] = '';
                                    if($auto_categories == 'genre')
                                    {
                                        $post_args['genres'] = implode(',', $umsmanga->genres);
                                    }
                                    if($default_category != '')
                                    {
                                        if($post_args['genres'] != '')
                                        {
                                            $post_args['genres'] .= ',';
                                        }
                                        $genreplus = get_term_by('id', $default_category, 'wp-manga-genre');
                                        if($genreplus !== false)
                                        {
                                            $post_args['genres'] .= $genreplus->slug;
                                        }
                                    }
                                    $post_args['views'] = '';
                                    $post_args['ratings'] = $umsmanga->rating ;
                                    if($can_create_tag == 'genre')
                                    {
                                        $post_args['tags'] = implode(',', $umsmanga->genres);
                                    }
                                    if($item_create_tag != '')
                                    {
                                        $ctag = explode(',', $item_create_tag);
                                        foreach($ctag as $ctap)
                                        {
                                            $ctap = trim($ctap);
                                            if($post_args['tags'] != '')
                                            {
                                                $post_args['tags'] .= ',';
                                            }
                                            $genreplus = get_term_by('name', $ctap, 'wp-manga-tag');
                                            if($genreplus !== false)
                                            {
                                                $post_args['tags'] .= $genreplus->slug;
                                            }
                                            else
                                            {
                                                $cat = wp_insert_term($ctap, 'wp-manga-tag');
                                                if(!is_wp_error( $cat ))
                                                {
                                                    $post_args['tags'] .= $cat['slug'];
                                                }
                                            }
                                        }
                                    }
                                    $author = $umsmanga->author;
                                    $post_args['post_type'] = 'wp-manga';
                                    if($user_name_type == 'rand')
                                    {
                                        $randid = ums_display_random_user();
                                        if($randid === false)
                                        {
                                            $post_args['post_author']               = ums_randomName();
                                        }
                                        else
                                        {
                                            $post_args['post_author']               = $randid->ID;
                                        }
                                    }
                                    elseif($user_name_type == 'feed-news')
                                    {
                                        $sp_post_user_name = ums_randomName();
                                        if($author == '' || $author == '1' || $author == 'null')
                                        {
                                            $author = ums_randomName();
                                        }
                                        if($author != '')
                                        {
                                            $xauthor = sanitize_user( $author );
                                            $xauthor = apply_filters( 'pre_user_login', $xauthor );
                                            $xauthor = trim( $xauthor );
                                            if(username_exists( $xauthor ))
                                            {
                                                $user_id_t = get_user_by('login', $xauthor);
                                                if($user_id_t)
                                                {
                                                    $sp_post_user_name = $user_id_t->ID;
                                                }
                                            }
                                            else
                                            {
                                                $palphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^*()-+=_?><,.;:}{][';
                                                $ppass = '';
                                                $alphaLength = strlen($palphabet) - 1;
                                                for ($ipass = 0; $ipass < 8; $ipass++) 
                                                {
                                                    $npass = rand(0, $alphaLength);
                                                    $ppass .= $palphabet[$npass];
                                                }
                                                $curr_id = wp_create_user($xauthor, $ppass, ums_generate_random_email());
                                                if ( is_int($curr_id) )
                                                {
                                                    $u = new WP_User($curr_id);
                                                    $u->remove_role('subscriber');
                                                    $u->add_role('author');
                                                    $sp_post_user_name               = $curr_id;
                                                }
                                            }
                                        }
                                        $post_args['post_author']               = ums_utf8_encode($sp_post_user_name);
                                    }
                                    else
                                    {
                                        $post_args['post_author']               = ums_utf8_encode($post_user_name);
                                    }
                                    
                                    if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                        ums_log_to_file('Inserting new manga: ' . $post_args['post_title']);
                                    }
                                    $umspostid = wp_insert_post( $post_args );
                                    if( ! $umspostid || is_wp_error( $umspostid ) )
                                    {
                                        ums_log_to_file("Insert new manga post failed. Manga name : {$post_args['title']}");
                                        continue;
                                    }
                                    add_post_meta($umspostid, 'ums_parent_rule', $type . '-' . $param);
                                    wp_set_object_terms( $umspostid, 'Ums_' . $type . '_' . $param, 'coderevolution_post_source', true);
                                    $thumb_id = ums_wp_mcl_e_upload_file( $post_args['thumb'], $use_phantom, $phantom_wait, $umspostid );
                                    
                                    $meta_data = array(
                                        '_manga_import_slug'     => $post_args['manga_import_slug'],
                                        '_thumbnail_id'          => $thumb_id,
                                        '_wp_manga_alternative'  => isset( $post_args['altername'] ) ? $post_args['altername'] : '',
                                        '_wp_manga_chapters_warning'=> $chapter_warning,
                                        '_wp_manga_type'         => isset( $post_args['type'] ) ? $post_args['type'] : '',
                                        '_wp_manga_status'       => isset( $post_args['status'] ) ? $post_args['status'] : '',
                                        '_wp_manga_chapter_type' => 'manga',
                                    );
                
                                    foreach( $meta_data as $key => $value )
                                    {
                                        if( !empty( $value ) ){
                                            update_post_meta( $umspostid, $key, $value );
                                        }
                                    }
                                    $manga_terms = array(
                                        'wp-manga-release'     => isset( $post_args['release'] ) ? $post_args['release'] : null,
                                        'wp-manga-author'      => isset( $post_args['authors'] ) ? $post_args['authors'] : null,
                                        'wp-manga-artist'      => isset( $post_args['artists'] ) ? $post_args['artists'] : null,
                                        'wp-manga-genre'       => isset( $post_args['genres'] ) ? $post_args['genres'] : '',
                                        'wp-manga-tag'         => isset( $post_args['tags'] ) ? $post_args['tags'] : null,
                                    );
                                    foreach( $manga_terms as $tax => $term )
                                    {
                                        $resp = ums_add_manga_terms( $umspostid, $term, $tax );
                                    }
                                    if( !empty( $post_args['views'] ) )
                                    {
                                        ums_update_post_views( $umspostid, $post_args['views'] );
                                    }
                                    if( !empty( $post_args['ratings'] ) )
                                    {
                                        $xrating = array(
                                            'avg'     => $post_args['ratings'],
                                            'numbers' => rand(50,200)
                                        );
                                        if(floatval($xrating['avg']) == 0)
                                        {
                                            $xrating['numbers'] = 0;
                                        }
                                        ums_update_post_ratings( $umspostid, $xrating );
                                    }
                                }
                                else
                                {
                                    $umspostid = $existing->ID;
                                }
                                $ums_max_chapters = $max;
                                if($reverse_chapters == '1')
                                {
                                    $reverse = true;
                                }
                                else
                                {
                                    $reverse = false;
                                }
                                if($reverse == false)
                                {
                                    $umsmanga->chapters = array_reverse($umsmanga->chapters, true);
                                }
                                $new_chap = false;
                                $local_imported = 0;
                                $fail_counter = 0;
                                foreach($umsmanga->chapters as $mng)
                                {
                                    $mng->title = str_replace('Ch.', 'Chapter ', $mng->title);
                                    if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                        ums_log_to_file('Fetching chapter for: ' . $mng->title);
                                    }
                                    if($ums_max_chapters <= $local_imported)
                                    {
                                        break;
                                    }
                                    $slugified_name = $wp_manga_storage->slugify( $mng->title );
                                    $chapter_2 = $wp_manga_chapter->get_chapter_by_slug( $umspostid, $slugified_name );
                                    if($chapter_2 && $chapter_2['chapter_slug'] == $slugified_name){
                                        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                            ums_log_to_file('Chapter found to be already published, skipping it: ' . $chapter_2['chapter_name'] . ' for manga slug: ' . $slugified_name);
                                        }
                                        continue;
                                    }
                                    $scans = $umsmangamanager->scan($umsmanga->uid, $mng->volume, $mng->number)->get();
                                    $resp = ums_fetch_chapters( $scans, $umspostid, $mng, $storage, $umsmanga->name, $rule_translate, $skip_last);
                                    if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                        ums_log_to_file('Response: ' . print_r($resp, true));
                                    }
                                    if( is_wp_error( $resp ) )
                                    {
                                        ums_log_to_file('Failed to download chapter, wperror: ' . print_r($resp, true));
                                    }
                                    elseif( $resp === 'fail')
                                    {
                                        $fail_counter++;
                                        if($fail_counter >= 3)
                                        {
                                            ums_log_to_file('The page has protected images, try installing Puppeteer on your server to download them.');
                                            break;
                                        }
                                    }
                                    elseif( $resp === false || $resp === null)
                                    {
                                        ums_log_to_file('Generic error when downloading chapters.');
                                    }
                                    elseif( trim($resp) === 'CloudFlare' && isset($ums_Main_Settings['enable_cloudflare']) && $ums_Main_Settings['enable_cloudflare'] == 'on')
                                    {
                                        if($auto == 1 && $rerun_count <= 10)
                                        {
                                            sleep(5);
                                            $rerun_count++;
                                            ums_log_to_file('Rerunning scraping using CloudFlare protection ' . $param . ' - ' . $type . ' - ' . $auto . ' - ' . $rerun_count);
                                            $returnx = ums_run_rule($param, $type, $auto, $rerun_count);
                                            return $returnx;
                                        }
                                        return 'nochange';
                                    }
                                    elseif( trim($resp) == 'ok')
                                    {
                                        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                            ums_log_to_file('Chapter imported OK: ' . $mng->title);
                                        }
                                        $new_chap = true;
                                        $ums_imported_chapters++;
                                        $local_imported++;
                                    }
                                    elseif( $resp == true)
                                    {
                                        ums_log_to_file('Chapter already existing, skipping it');
                                    }
                                    else
                                    {
                                        ums_log_to_file('Invalid response from call: ' . print_r($resp, true));
                                    }
                                    if (isset($ums_Main_Settings['request_timeout']) && $ums_Main_Settings['request_timeout'] != '') {
                                        $timeout = intval($ums_Main_Settings['request_timeout']);
                                    } else {
                                        $timeout = 1;
                                    }
                                    sleep($timeout);
                                }
                                if($new_chap == true)
                                {
                                    if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                        ums_log_to_file('Imported chapter count: ' . $local_imported);
                                    }
                                    $scraped_manga++;
                                }
                            }
                            if($get_max_manga <= $scraped_manga)
                            {
                                break;
                            }
                        }
                    }
                    catch(Exception $e)
                    {
                        ums_log_to_file('Importing failed: ' . $e->getMessage());
                        if($auto == 1)
                        {
                            ums_clearFromList($param, $type);
                        }
                        return 'fail';
                    }
                }
            }
            elseif($type == 1)
            {
                if(trim($max_manga) != '')
                {
                    $get_max_manga = intval(trim($max_manga));
                }
                else
                {
                    $get_max_manga = 999;
                }
                $items = array();
                $page_increased = false;
                {
                    $manga_arr = array();
                    try
                    {
                        global $wp_filesystem;
                        if ( ! is_a( $wp_filesystem, 'WP_Filesystem_Base') ){
                            include_once(ABSPATH . 'wp-admin/includes/file.php');$creds = request_filesystem_credentials( site_url() );
                            wp_filesystem($creds);
                        }
                        $prefixh = 'http://wuxiaworld.site/novel/';
                        $wprefixh = 'http://www.wuxiaworld.site/novel/';
                        $prefixs = 'https://wuxiaworld.site/novel/';
                        $wprefixs = 'https://www.wuxiaworld.site/novel/';
                        $manga_names = explode(',', $manga_name);
                        $manga_names = array_map('trim', $manga_names);
                        foreach($manga_names as $mngn)
                        {
                            if (substr($mngn, 0, strlen($prefixs)) == $prefixs) {
                                $manga_arr[] = $mngn;
                            }
                            elseif (substr($mngn, 0, strlen($prefixh)) == $prefixh) {
                                $manga_arr[] = $mngn;
                            }
                            elseif (substr($mngn, 0, strlen($wprefixh)) == $wprefixh) {
                                $manga_arr[] = $mngn;
                            }
                            elseif (substr($mngn, 0, strlen($wprefixs)) == $wprefixs) {
                                $manga_arr[] = $mngn;
                            }
                            else
                            {
                                if($wp_filesystem->exists(dirname(__FILE__) . "/sitemap.txt"))
                                {
                                    $handle = fopen(dirname(__FILE__) . "/sitemap.txt", "r");
                                    if ($handle)
                                    {
                                        while (!feof($handle))
                                        {
                                            $buffer = fgets($handle);
                                            if($buffer !== false)
                                            {
                                                if($mngn == '*')
                                                {
                                                    $manga_arr[] = 'https://wuxiaworld.site/novel/' . trim($buffer) . '/';
                                                }
                                                else
                                                {
                                                    $xbuffer = str_replace('-', ' ', $buffer);
                                                    $mngnwords = explode(' ', $mngn);
                                                    $xbuffer_arr = explode(' ', $xbuffer);
                                                    foreach($mngnwords as $mangx)
                                                    {
                                                        $mangx = trim($mangx);
                                                        $xfound = false;
                                                        foreach($xbuffer_arr as $xbf)
                                                        {
                                                            $xbf = trim($xbf);
                                                            if($xbf == $mangx)
                                                            {
                                                                $xfound = true;
                                                            }
                                                        }
                                                        if($xfound == true)
                                                        {
                                                            $manga_arr[] = 'https://wuxiaworld.site/novel/' . trim($buffer) . '/';
                                                            break;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        fclose($handle);
                                    }
                                }
                                else
                                {
                                    ums_log_to_file('Only URLs from https://wuxiaworld.site/novel/ are allowed, because sitemap file failed to be opened, skipping: ' . $mngn);
                                    continue;
                                }
                            }
                        }
                        if(count($manga_arr) == 0)
                        {
                            ums_log_to_file('No Web Novel matched your query: ' . $manga_name);
                            return 'nochange';
                        }
                        $scraped_manga = 0;
                        foreach($manga_arr as $current_manga)
                        {
                            if($get_max_manga <= $scraped_manga)
                            {
                                break;
                            }
                            $current_manga = trim($current_manga, '/');
                            $current_manga = $current_manga . '/';
                            $html_site = ums_get_web_page($current_manga, ums_get_random_user_agent(), $use_phantom, $phantom_wait);
                            if($html_site == false)
                            {
                                ums_log_to_file('Failed to download manga chapter: ' . $current_manga);
                                continue;
                            }
                            if(stristr($html_site, 'Cloudflare Ray ID:') !== false || stristr($html_site, 'Ray ID: <code>') !== false)
                            {
                                ums_log_to_file('CloudFlare protection active on wuxiaworld.site, access is limited! Please install puppeteer on your site and set the "Content Scraping Method To Use" to Puppeteer for scraping to work. Manga URL: ' . $current_manga);
                                sleep(1);
                                continue;
                            }
                            if(stristr($html_site, 'manga-title-badges custom comic') !== false)
                            {
                                ums_log_to_file('This URL is a web comic, not a web novel, skipping it: ' . $current_manga);
                                continue;
                            }
                            if (isset($ums_Main_Settings['request_timeout']) && $ums_Main_Settings['request_timeout'] != '') {
                                $timeout = intval($ums_Main_Settings['request_timeout']);
                            } else {
                                $timeout = 1;
                            }
                            sleep($timeout);
                            require_once (dirname(__FILE__) . "/res/simple_html_dom.php"); 
                            $html = ums_str_get_html( $html_site );
                            $tag = $html->find( '.profile-manga .post-title h1', 0 );
                            $name_str = '';
                            $my_slug = '';
                            $my_slug = str_replace( 'http://', '', $current_manga );
                            $my_slug = str_replace( 'https://', '', $my_slug );
                            $my_slug = str_replace( 'http:', '', $my_slug );
                            $my_slug = str_replace( 'wuxiaworld.site/novel/', '', $my_slug );
                            $my_slug = str_replace( '/', '', $my_slug );
                            $my_slug = str_replace( '.html', '', $my_slug );
                            $my_slug = str_replace( '.htm', '', $my_slug );
                            if($tag){
                                $name_str = trim($tag->plaintext);
                                $span = $tag->find('span', 0);
                                if($span){
                                    $name_str = trim(str_replace($span->plaintext,'', $name_str));
                                }
                            }
                            if($name_str == '')
                            {
                                preg_match_all('#<title>([^<]*?) - WuxiaWorld<\/title>#i', $html_site, $tmathc);
                                if(isset($tmathc[1][0]))
                                {
                                    $name_str = $tmathc[1][0];
                                }
                            }
                            if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                ums_log_to_file('Processing novel: ' . $name_str);
                            }
                            $find_post = new WP_Query( array(
                                'title'     => $name_str,
                                'post_type' => 'wp-manga',
                            ) );
                            $existing_post_id = false;
                            if( $find_post->have_posts() )
                            {
                                $existing_post_id = $find_post->posts[0]->ID;
                            }
                            if($existing_post_id == false)
                            {
                                $args = array(
                                    'post_type'  => 'wp-manga',
                                    'meta_key'   => '_manga_import_slug',
                                    'meta_value' => $my_slug,
                                    'post_status' => array('publish','draft','pending','trash','private','future')
                                );
                                $query = new WP_Query( $args );
                                if( $query->have_posts() ){
                                    $existing_post_id = $query->posts[0]->ID;
                                }
                            }
                            if($existing_post_id == false)
                            {
                                $block_warning = $html->find('#page .warning', 0);
                                if( !empty( $block_warning ) && strpos( $block_warning->plaintext, 'has been licensed, it is not available' ) !== false ){
                                    ums_log_to_file('Request blocked, please use a proxy!');
                                    continue;
                                }
                                $desc = '';
                                $xdesc = $html->find( '.summary__content' );
                                $xd = '';
                                if(is_array($xdesc))
                                {
                                    foreach($xdesc as $dd)
                                    {
                                        if(stristr($dd->plaintext, 'Description'))
                                        {
                                            $xd = trim($dd->plaintext);
                                            $xprefix = 'Description';
                                            if (substr($xd, 0, strlen($xprefix)) == $xprefix) {
                                                $xd = substr($xd, strlen($xprefix));
                                            } 
                                            $xd = trim($xd);
                                        }
                                    }
                                }
                                if($xd != '')
                                {
                                    $desc = $xd;
                                }
                                $xdesc = $html->find( '.description-summary' );
                                $xd = '';
                                if(is_array($xdesc))
                                {
                                    foreach($xdesc as $dd)
                                    {
                                        $xd .= trim($dd->plaintext);
                                    }
                                }
                                if($xd != '')
                                {
                                    $desc = $xd;
                                    $desc = preg_replace('/Show more$/', '', $desc);
                                }
                                if($desc == '')
                                {
                                    $xdesc = $html->find( '.summary__content .show-more' );
                                    $xd = '';
                                    if(is_array($xdesc))
                                    {
                                        $xd = '';
                                        foreach($xdesc as $dd)
                                        {
                                            $xd .= $dd->plaintext;
                                        }
                                    }
                                    if($xd != '')
                                    {
                                        $desc = $xd;
                                    }
                                }
                                if($desc == '')
                                {
                                    preg_match_all('#<div class="summary__content show-more">(?:<p>)?([\s\S]*?)(?:<\/p>)?<\/div>#i', $html_site, $dmathc);
                                    if(isset($dmathc[1][0]))
                                    {
                                        $desc = $dmathc[1][0];
                                    }
                                }
                                $desc = str_replace('wuxiaworld.site', '',$desc);
                                $thumb = $html->find( '.summary_image .img-responsive' );
                                $thumb = !empty( $thumb ) ? $thumb[0]->src : '';
                                if($thumb == '')
                                {
                                    $thumb = $html->find( '.summary_image' );
                                    $thumb = !empty( $thumb ) ? $thumb[0]->src : '';
                                }
                                $stx = '';
                                $status = $html->find( '.post-status .post-content_item' );
                                if(is_array($status))
                                {
                                    foreach($status as $st)
                                    {
                                        $temp_stat = $st->plaintext;
                                        if(stristr($temp_stat, 'status') !== false)
                                        {
                                            $stx = $temp_stat;
                                        }
                                    }
                                }
                                if($stx === '')
                                {
                                    $status = '';
                                }
                                else
                                {
                                    $status = $stx;
                                }
                                if(stristr($status, 'ongoing') !== false)
                                {
                                    $status = 'on-going';
                                }
                                elseif(stristr($status, 'completed') !== false)
                                {
                                    $status = 'end';
                                }
                                elseif(stristr($status, 'canceled') !== false)
                                {
                                    $status = 'canceled';
                                }
                                elseif(stristr($status, 'on hold') !== false)
                                {
                                    $status = 'on-hold';
                                }
                                elseif(stristr($status, 'upcoming') !== false)
                                {
                                    $status = 'upcoming';
                                }
                                $alter_name = $html->find( '.summary_content .post-content .post-content_item' );
                                
                                $xplain = '';
                                if( !empty( $alter_name ) )
                                {
                                    foreach($alter_name as $an)
                                    {
                                        if(stristr($an->plaintext, 'Alternative '))
                                        {
                                            $xplain = trim($an->plaintext);
                                            $xprefix = 'Alternative';
                                            if (substr($xplain, 0, strlen($xprefix)) == $xprefix) {
                                                $xplain = substr($xplain, strlen($xprefix));
                                            } 
                                            $xplain = trim($xplain);
                                        }
                                    }
                                }
                                if($xplain != '')
                                {
                                    $alter_name = $xplain;
                                }
                                else
                                {
                                    $alter_name = '';
                                }
                                $data = $html->find( '.summary_content .post-content .post-content_item' );
                                $xtype = '';
                                if( !empty( $data ) ){
                                    foreach($data as $item){
                                        if(trim($item->find('.summary-heading h5',0)->plaintext) == 'Type'){
                                            $xtype = $item->find('.summary-content', 0)->plaintext;
                                            if(trim($xtype) == 'Updating')
                                            {
                                                $xtype = '';
                                            }
                                        }
                                    }
                                }
                                $xrelease = '2021';
                                preg_match_all('#<a href="https:\/\/wuxiaworld\.site\/(?:manga-)?release\/(?:[^"]*?)" rel="tag">([^<]+?)<\/a>#i', $html_site, $xmathc);
                                if(isset($xmathc[1][0]))
                                {
                                    $xrelease = trim($xmathc[1][0]);
                                }
                                $xauthor = '';
                                $author = '';
                                $data = $html->find( '.author-content a' );
                                if( !empty( $data ) ){
                                    $authors = array();
                                    foreach($data as $arxthor)
                                    {
                                        array_push($authors, $arxthor->plaintext);
                                        if($author == '')
                                        {
                                            $author = $arxthor->plaintext;
                                        }
                                    }
                                    $xauthor = implode(',', $authors);
                                }

                                $xartists = '';
                                $data = $html->find( '.artist-content a' );
                                if( !empty( $data ) ){
                                    $artists = array();
                                    foreach($data as $artist){
                                        array_push($artists, $artist->plaintext);
                                    }
                                    $xartists = implode(',', $artists);
                                }
                                $xgenres = '';
                                $data = $html->find( '.genres-content a' );
                                if( !empty( $data ) ){
                                    $genres = array();
                                    foreach($data as $genre){
                                        array_push($genres, $genre->plaintext);
                                    }
                                    $xgenres = implode(',', $genres);
                                }
                                $items = $html->find('.summary_content .post-content .post-content_item');
                                $views = '';
                                foreach($items as $item){
                                    if(trim($item->find('.summary-heading', 0)->plaintext) == 'Rank'){
                                        $str = $item->find('.summary-content',0)->plaintext;
                                        preg_match_all('~\d+(?:\.\d+)?~', $str, $matches);
                                        if($matches){
                                            if(count($matches) == 3){
                                                $views = $matches[0][1];
                                            } else {
                                                $views = $matches[0][0];
                                            }
                                            if(strpos($str, 'K monthly views') !== false){
                                                $views = floatval($views) * 1000;
                                            }
                                            if(strpos($str, 'M monthly views') !== false){
                                                $views = floatval($views) * 1000000;
                                            }
                                            break;
                                        }
                                    }
                                }
                                if(empty(trim($views)) || !is_numeric(strip_tags( $views  )))
                                {
                                    $viewsm = rand(100,500);
                                }
                                else
                                {
                                    $viewsm = strip_tags(trim($views));
                                }
                                $average_vote = $html->find('.post-total-rating .total_votes', 0);
                                $str = $html->find('.vote-details',0);
                                $xrating = array();
                                if(!empty($str))
                                {
                                    preg_match_all('!\d+!', $str, $matches);
                                    $number_votes = 1;
                                    if($matches && count($matches[0]) == 3)
                                    {
                                        $number_votes = $matches[0][2];
                                    }
                                    if( !empty( $average_vote ) && $average_vote->plaintext > 0 ){
                                        $xrating = array(
                                            'avg'     => $average_vote->plaintext,
                                            'numbers' => $number_votes
                                        );
                                    }
                                }
                                $xtags = '';
                                $data = $html->find( '.wp-manga-tags-list a' );
                                if( !empty( $data ) ){
                                    $tags = array();
                                    foreach($data as $tag){
                                        $ttext = trim($tag->plaintext);
                                        $ttext = str_ireplace('wuxiaworldsite', get_bloginfo('name'), $ttext);
                                        $ttext = str_ireplace('daonovel', get_bloginfo('name'), $ttext);
                                        array_push($tags, $ttext);
                                    }
                                    $xtags = implode(',', $tags);
                                }
                                $xtime_year = '';
                                $time_year = strtotime($xrelease);
                                if($time_year !== false)
                                {
                                    $time_year = date("Y", $time_year);
                                    if($time_year !== false)
                                    {
                                        $xtime_year = $time_year;
                                    }
                                }
                                $post_args = array(
                                    'manga_import_slug' => $my_slug,
                                    'title'             => $name_str,
                                    'post_status'       => $post_status,
                                    'description'       => $desc,
                                    'thumb'             => $thumb,
                                    'status'            => $status,
                                    'altername'         => strip_tags( $alter_name ),
                                    'type'              => strip_tags( $xtype ),
                                    'release'           => $xtime_year,
                                    'authors'           => strip_tags( $xauthor ),
                                    'artists'           => strip_tags( $xartists ),
                                );
                                $post_args['genres'] = '';
                                if($auto_categories == 'genre')
                                {
                                    $post_args['genres'] = strip_tags( $xgenres );
                                }
                                if($default_category != '')
                                {
                                    if($post_args['genres'] != '')
                                    {
                                        $post_args['genres'] .= ',';
                                    }
                                    $genreplus = get_term_by('id', $default_category, 'wp-manga-genre');
                                    if($genreplus !== false)
                                    {
                                        $post_args['genres'] .= $genreplus->slug;
                                    }
                                }
                                $post_args['views'] = strip_tags( $viewsm  );
                                $post_args['ratings'] = $xrating;
                                if($can_create_tag == 'genre')
                                {
                                    $post_args['tags'] = strip_tags( $xgenres );
                                }
                                elseif($can_create_tag == 'tags')
                                {
                                    $post_args['tags'] = strip_tags( $xtags );
                                }
                                else
                                {
                                    $post_args['tags'] = '';
                                }
                                if($item_create_tag != '')
                                {
                                    $ctag = explode(',', $item_create_tag);
                                    foreach($ctag as $ctap)
                                    {
                                        $ctap = trim($ctap);
                                        if($post_args['tags'] != '')
                                        {
                                            $post_args['tags'] .= ',';
                                        }
                                        $genreplus = get_term_by('name', $ctap, 'wp-manga-tag');
                                        if($genreplus !== false)
                                        {
                                            $post_args['tags'] .= $genreplus->slug;
                                        }
                                        else
                                        {
                                            $cat = wp_insert_term($ctap, 'wp-manga-tag');
                                            if(!is_wp_error( $cat ))
                                            {
                                                $post_args['tags'] .= $cat['slug'];
                                            }
                                        }
                                    }
                                }
                                $post_args['description'] = str_ireplace('wuxiaworld.site', $_SERVER['HTTP_HOST'], $post_args['description']);
                                $arr = ums_spin_and_translate($post_args['title'], $post_args['description'], $rule_translate, 'en');
                                if($arr === false)
                                {
                                    if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                        ums_log_to_file('Skipping web novel (because it failed to be translated): ' . print_r($post_args, true));
                                    }
                                    continue;
                                }
                                else
                                {
                                    if($no_translate_title != '1')
                                    {
                                        $post_args['title']              = $arr[0];
                                    }
                                    $post_args['description']        = $arr[1];
                                }
                                $za_xpost_args = array(
                                    'post_title'   => !empty( $post_args['title'] ) ? $post_args['title'] : '',
                                    'post_content' => !empty( $post_args['description'] ) ? $post_args['description'] : '',
                                    'post_type'    => 'wp-manga',
                                    'post_status'  => isset( $post_args['post_status'] ) ? $post_args['post_status'] : 'pending',
                                );
                                $existing_again = false;
                                if($za_xpost_args['post_title'] != '')
                                {
                                    $xposts = get_posts(
                                        array(
                                            'post_type'              => 'wp-manga',
                                            'title'                  => html_entity_decode($za_xpost_args['post_title']),
                                            'post_status'            => 'all',
                                            'numberposts'            => 1,
                                            'update_post_term_cache' => false,
                                            'update_post_meta_cache' => false,           
                                            'orderby'                => 'post_date ID',
                                            'order'                  => 'ASC',
                                        )
                                    );
                                    if ( ! empty( $xposts ) ) {
                                        $ex_page = $xposts[0];
                                    } else {
                                        $ex_page = null;
                                    }
                                    if(isset($ex_page->ID))
                                    {
                                        $existing_again = true;
                                        $existing_post_id = $ex_page->ID;
                                    }
                                }
                                if($existing_again == false)
                                {
                                    $accept_comments = 'closed';
                                    if ($enable_comments == '1') {
                                        $accept_comments = 'open';
                                    }
                                    $za_xpost_args['comment_status'] = $accept_comments;
                                    if ($enable_pingback == '1') 
                                    {
                                        $za_xpost_args['ping_status'] = 'open';
                                    } 
                                    else 
                                    {
                                        $za_xpost_args['ping_status'] = 'closed';
                                    }
                                    if($get_date == '1')
                                    {
                                        if(!empty($xrelease))
                                        {
                                            if(strlen($xrelease) == 4)
                                            {
                                                $xrelease .= '-01-01 00:00';
                                            }
                                            $postdatex = gmdate("Y-m-d H:i:s", strtotime($xrelease));
                                            $za_xpost_args['post_date_gmt'] = $postdatex;
                                        }
                                    }
                                    if($user_name_type == 'rand')
                                    {
                                        $randid = ums_display_random_user();
                                        if($randid === false)
                                        {
                                            $za_xpost_args['post_author']               = ums_randomName();
                                        }
                                        else
                                        {
                                            $za_xpost_args['post_author']               = $randid->ID;
                                        }
                                    }
                                    elseif($user_name_type == 'feed-news')
                                    {
                                        $sp_post_user_name = ums_randomName();
                                        if($author == '' || $author == '1' || $author == 'null')
                                        {
                                            $author = ums_randomName();
                                        }
                                        if($author != '')
                                        {
                                            $xauthor = sanitize_user( $author );
                                            $xauthor = apply_filters( 'pre_user_login', $xauthor );
                                            $xauthor = trim( $xauthor );
                                            if(username_exists( $xauthor ))
                                            {
                                                $user_id_t = get_user_by('login', $xauthor);
                                                if($user_id_t)
                                                {
                                                    $sp_post_user_name = $user_id_t->ID;
                                                }
                                            }
                                            else
                                            {
                                                $palphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^*()-+=_?><,.;:}{][';
                                                $ppass = '';
                                                $alphaLength = strlen($palphabet) - 1;
                                                for ($ipass = 0; $ipass < 8; $ipass++) 
                                                {
                                                    $npass = rand(0, $alphaLength);
                                                    $ppass .= $palphabet[$npass];
                                                }
                                                $curr_id = wp_create_user($xauthor, $ppass, ums_generate_random_email());
                                                if ( is_int($curr_id) )
                                                {
                                                    $u = new WP_User($curr_id);
                                                    $u->remove_role('subscriber');
                                                    $u->add_role('author');
                                                    $sp_post_user_name               = $curr_id;
                                                }
                                            }
                                        }
                                        $za_xpost_args['post_author']               = ums_utf8_encode($sp_post_user_name);
                                    }
                                    else
                                    {
                                        $za_xpost_args['post_author']               = ums_utf8_encode($post_user_name);
                                    }
                                    
                                    if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                        ums_log_to_file('Inserting new novel: ' . $za_xpost_args['post_title']);
                                    }
                                    $existing_post_id = wp_insert_post( $za_xpost_args );
                                    if( ! $existing_post_id || is_wp_error( $existing_post_id ) ){
                                        ums_log_to_file('Failed to insert novel into db: ' . $post_args['title']);
                                        continue;
                                    }
                                    add_post_meta($existing_post_id, 'ums_parent_rule', $type . '-' . $param);
                                    wp_set_object_terms( $existing_post_id, 'Ums_' . $type . '_' . $param, 'coderevolution_post_source', true);
                                    if($thumb != '')
                                    {
                                        $thumb_id = ums_wp_mcl_e_upload_file( $post_args['thumb'], $use_phantom, $phantom_wait, $existing_post_id );
                                        if($thumb_id === false)
                                        {
                                            include_once( ABSPATH . 'wp-admin/includes/image.php' );
                                            $thcontent = ums_get_web_page($thumb);
                                            if (isset($ums_Main_Settings['request_timeout']) && $ums_Main_Settings['request_timeout'] != '') {
                                                $timeout = intval($ums_Main_Settings['request_timeout']);
                                            } else {
                                                $timeout = 1;
                                            }
                                            sleep($timeout);
                                            $pathinfo = pathinfo( $thumb );
                                            if( $thcontent != false ){
                                                $upload_dir = wp_upload_dir();
                                                $file_tmp_path = $upload_dir['basedir'] . '/' . $pathinfo['filename'] . '-' . $existing_post_id . '.' . explode('?',$pathinfo['extension'])[0];
                                                $file = $wp_filesystem->put_contents( $file_tmp_path, $thcontent );
                                                $wp_filetype = wp_check_filetype(basename($file_tmp_path), null );
                                                $attachment = array(
                                                    'post_mime_type' => $wp_filetype['type'],
                                                    'post_title' => $existing_post_id,
                                                    'post_content' => '',
                                                    'post_status' => 'inherit'
                                                );
                                                $attach_id = wp_insert_attachment( $attachment, $file_tmp_path );
                                                $thumb_id = $attach_id;
                                                $imagenew = get_post( $attach_id );
                                                $fullsizepath = get_attached_file( $imagenew->ID );
                                                require_once( ABSPATH . 'wp-admin/includes/image.php' );
                                                require_once( ABSPATH . 'wp-admin/includes/media.php' );
                                                $attach_data = wp_generate_attachment_metadata( $attach_id, $fullsizepath );
                                                wp_update_attachment_metadata( $attach_id, $attach_data );
                                            }
                                        }
                                    }
                                    else
                                    {
                                        $thumb_id = false;
                                    }
                                    $meta_data = array(
                                        '_manga_import_slug'     => $my_slug,
                                        '_thumbnail_id'          => $thumb_id,
                                        '_wp_manga_alternative'  => strip_tags( $alter_name ),
                                        '_wp_manga_type'         => strip_tags( $xtype ),
                                        '_wp_manga_status'       => $status,
                                        '_wp_manga_chapter_type' => 'text',
                                        '_wp_manga_chapters_warning'=> $chapter_warning,
                                    );
                                    foreach( $meta_data as $key => $value ){
                                        if( !empty( $value ) ){
                                            update_post_meta( $existing_post_id, $key, $value );
                                        }
                                    }
                                    $manga_terms = array(
                                        'wp-manga-release'     => strip_tags( $xrelease ),
                                        'wp-manga-author'      => strip_tags( $xauthor ),
                                        'wp-manga-artist'      => strip_tags( $xartists ),
                                        'wp-manga-genre'       => isset( $post_args['genres'] ) ? $post_args['genres'] : '',
                                        'wp-manga-tag'         => isset( $post_args['tags'] ) ? $post_args['tags'] : null,
                                    );
                                    foreach( $manga_terms as $tax => $term ){
                                        $resp = ums_add_manga_terms( $existing_post_id, $term, $tax );
                                    }
                                    ums_update_post_views( $existing_post_id, strip_tags( $viewsm ) );
                                    ums_update_post_ratings( $existing_post_id, $xrating );
                                }
                            }

                            $find_chapters  = $html->find('.listing-chapters_wrap li');
                            $output = array();
                            $current_vol = 'NO-VOLUME';
                            $chapters = array();
                            foreach( $find_chapters as $chapter )
                            {
                                $full_chapter_name = trim(preg_replace('/\t+/', '', $chapter->find('a',0)->plaintext));
                                $chapter_extend_name = '';
                                $names = explode(' - ', $full_chapter_name);
                                $chapter_name = $full_chapter_name;
                                if(count($names) == 2){
                                    $chapter_extend_name = $names[1];
                                    $chapter_name = $names[0];
                                }
                                $chapters[] = array(
                                    'name'        => $chapter_name,
                                    'extend_name' => $chapter_extend_name,
                                    'url'         => $chapter->find('a',0)->href
                                );
                            }
                            $lazy_loaded = false;
                            if(count($chapters) == 0)
                            {
                                $latest_scraped = get_post_meta( $existing_post_id, 'ums_latest_scraped', true );
                                if(!empty($latest_scraped))
                                {
                                    if(!stristr($latest_scraped, 'wuxiaworld'))
                                    {
                                        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                            ums_log_to_file('Skipping, already scraped from another source: ' . $za_xpost_args['post_title'] . ' (' . $latest_scraped . ')');
                                        }
                                        continue;
                                    }
                                    $chap_url = $latest_scraped;
                                }
                                else
                                {
                                    if($chapter_slug != '')
                                    {
                                        $chap_url = $current_manga . $chapter_slug . '/';
                                    }
                                    else
                                    {
                                        $chap_url = $current_manga . 'chapter-1/';
                                    }
                                }
                                $lazy_loaded = true;
                                preg_match_all('#\/chapter-([^/]*?)\/#i', $chap_url, $chnamje);
                                if(isset($chnamje[1][0]))
                                {
                                    $chap_name = 'Chapter ' . $chnamje[1][0];
                                }
                                else
                                {
                                    $chap_name = 'Chapter ' . rand();
                                }
                                $chapters[] = array(
                                    'name'        => $chap_name,
                                    'url'         => $chap_url
                                );
                            }
                            $ums_max_chapters = $max;
                            if($reverse_chapters == '1')
                            {
                                $reverse = true;
                            }
                            else
                            {
                                $reverse = false;
                            }
                            if($reverse == true)
                            {
                                $chapters = array_reverse($chapters);
                            }
                            $local_imported = 0;
                            $new_chap = false;
                            //$chapters = array(array('url' => 'https://wuxiaworld.site/novel/the-demon-prince-goes-to-the-academy-pvt/chapter-219/', 'name' => 'ch 219'));
                            if($lazy_loaded == true)
                            {
                                $chapid = 1;
                                while(count($chapters) != 0)
                                {
                                    $randsleep = rand(500,1000);
                                    usleep($randsleep * 1000);
                                    $chaps = $chapters[0];
                                    if($ums_max_chapters <= $local_imported)
                                    {
                                        break;
                                    }
                                    if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                        ums_log_to_file('Processing novel chapter: ' . $chaps['url']);
                                    }
                                    $page_html = ums_get_web_page($chaps['url'], ums_get_random_user_agent(), $use_phantom, $phantom_wait);
                                    if( $page_html == false ){
                                        ums_log_to_file('Failed to download HTML for current chapter: ' . $chaps['name']);
                                        break;;
                                    }
                                    if(stristr($page_html, 'Cloudflare Ray ID:') !== false)
                                    {
                                        ums_log_to_file('CloudFlare protection active on chapter, access is limited! Please install puppeteer on your site and set the "Content Scraping Method To Use" to Puppeteer for scraping to work. Chapter URL: ' . $chaps['url']);
                                        sleep(1);
                                        break;
                                    }
                                    $html = ums_str_get_html( $page_html );
                                    if( empty( $html ) ){
                                        ums_log_to_file('Failed to parse HTML for current chapter: ' . $chaps['name']);
                                        break;
                                    }
                                    $chapid++;
                                    preg_match_all('#<div class="cha-tit skiptranslate">\s*<h3>([^<]*?)<\/h3>#i', $page_html, $titli);
                                    if(isset($titli[1][0]))
                                    {
                                        $chaps['name'] = $titli[1][0];
                                    }
                                    preg_match_all('#<a\s*href="([^"]*?)"\s*class="btn next_page"#i', $page_html, $zurli);
                                    if(isset($zurli[1][0]))
                                    {
                                        preg_match_all('#https:\/\/wuxiaworld\.site\/novel\/(?:[^\/]*?)\/chapter-([^\/]*?)\/#i', $zurli[1][0], $xurli);
                                        if(isset($xurli[1][0]))
                                        {
                                            $dummy_chap = array(
                                                'name'        => 'Chapter ' . $xurli[1][0],
                                                'url'         => $zurli[1][0]
                                            );
                                        }
                                        else
                                        { 
                                            $dummy_chap = array(
                                                'name'        => 'Chapter ' . $chapid,
                                                'url'         => $zurli[1][0]
                                            );
                                        }
                                        update_post_meta($existing_post_id, 'ums_latest_scraped', $zurli[1][0]);
                                    }
                                    else
                                    {
                                        $dummy_chap = false;
                                    }
                                    if($dummy_chap !== false)
                                    {
                                        $chapters = array($dummy_chap);
                                    }
                                    else
                                    {
                                        $chapters = array();
                                    }
                                    $slugified_name = $wp_manga_storage->slugify( $chaps['name'] );
                                    $chapter_2 = $wp_manga_chapter->get_chapter_by_slug( $existing_post_id, $slugified_name );
                                    if($chapter_2 && strtolower($chapter_2['chapter_slug']) == strtolower($slugified_name))
                                    {
                                        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                            ums_log_to_file('Chapter is already published, skipping it: ' . $chapter_2['chapter_name']);
                                        }
                                        continue;
                                    }
                                    $content = '';
                                    $doc = new DOMDocument;
                                    $internalErrors = libxml_use_internal_errors(true);
                                    $doc->loadHTML('<?xml encoding="utf-8" ?>' . $page_html);
                                    libxml_use_internal_errors($internalErrors);
                                    $xpath = new \DOMXpath($doc);
                                    $articles = $xpath->query('//*[contains(@class, "text-left")]');
                                    if(empty($content)) 
                                    {
                                        $articles = $xpath->query('//*[contains(@class, "text-left")]');
                                        if($articles !== false && count($articles) > 0)
                                        {
                                            foreach($articles as $container) 
                                            {
                                                if(method_exists($container, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->saveHTML();
                                                }
                                                elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->ownerDocument->saveHTML($container);
                                                }
                                                elseif(isset($container->nodeValue))
                                                {
                                                    $content .= ' ' . $container->nodeValue;
                                                }
                                            }
                                            $content = trim($content);
                                        }
                                    }
                                    if(empty($content)) 
                                    {
                                        if($articles !== false && count($articles) > 0)
                                        {
                                            foreach($articles as $container) 
                                            {
                                                if(method_exists($container, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->saveHTML();
                                                }
                                                elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->ownerDocument->saveHTML($container);
                                                }
                                                elseif(isset($container->nodeValue))
                                                {
                                                    $content .= ' ' . $container->nodeValue;
                                                }
                                                break;
                                            }
                                            $content = trim($content);
                                            $prfx1 = '<div class="text-left">';
                                            $prfx2 = '<div class="new-content">';
                                            $prfx3 = '<div class="chapter-entity">';

                                            if (substr($content, 0, strlen($prfx1)) == $prfx1) {
                                                $content = substr($content, strlen($prfx1));
                                                $content = preg_replace('#<\/div>$#', '', $content);
                                            }
                                            $content = trim($content);
                                            if (substr($content, 0, strlen($prfx2)) == $prfx2) {
                                                $content = substr($content, strlen($prfx2));
                                                $content = preg_replace('#<\/div>$#', '', $content);
                                            }
                                            $content = trim($content);
                                            if (stristr($content, $prfx3) !== false) {
                                                $content = str_ireplace($prfx3, '', $content);
                                                $content = preg_replace('#<\/div>$#', '', $content);
                                            }
                                            $content = trim($content);
                                            if(strstr($content, '<div class="entry-content">') !== false)
                                            {
                                                $content = str_replace('<div class="entry-content">', '', $content);
                                                $content = preg_replace('#<\/div>$#', '', $content);
                                            }
                                            $content = trim($content);
                                            if(preg_match('#<div(?:[^>]*?)id="chapterText">#', $content))
                                            {
                                                $content = preg_replace('#<div(?:[^>]*?)id="chapterText">#', '', $content);
                                                $content = preg_replace('#<\/div>$#', '', $content);
                                            }
                                        }
                                    }
                                    if(empty($content)) 
                                    {
                                        $articles = $xpath->query('//*[contains(@class, "content-body")]');
                                        if($articles !== false && count($articles) > 0)
                                        {
                                            foreach($articles as $container) 
                                            {
                                                if(method_exists($container, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->saveHTML();
                                                }
                                                elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->ownerDocument->saveHTML($container);
                                                }
                                                elseif(isset($container->nodeValue))
                                                {
                                                    $content .= ' ' . $container->nodeValue;
                                                }
                                            }
                                            $content = trim($content);
                                        }
                                    }
                                    if(empty($content)) 
                                    {
                                        $articles = $xpath->query('//*[contains(@class, "cha-tit")]');
                                        if($articles !== false && count($articles) > 0)
                                        {
                                            foreach($articles as $container) 
                                            {
                                                if(method_exists($container, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->saveHTML();
                                                }
                                                elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->ownerDocument->saveHTML($container);
                                                }
                                                elseif(isset($container->nodeValue))
                                                {
                                                    $content .= ' ' . $container->nodeValue;
                                                }
                                            }
                                            $content = trim($content);
                                        }
                                        $articles = $xpath->query('//*[contains(@class, "cha-content")]');
                                        if($articles !== false && count($articles) > 0)
                                        {
                                            foreach($articles as $container) 
                                            {
                                                if(method_exists($container, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->saveHTML();
                                                }
                                                elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->ownerDocument->saveHTML($container);
                                                }
                                                elseif(isset($container->nodeValue))
                                                {
                                                    $content .= ' ' . $container->nodeValue;
                                                }
                                            }
                                        }
                                    }
                                    if(empty($content)) 
                                    {
                                        $content = $html->find('.reading-content .text-left .cha-words .cha-words', 0);
                                        if($content) 
                                        {
                                            $other_ps = $content->find('p');
                                            if(count($other_ps) > 0)
                                            {
                                                $text = '';
                                                foreach($other_ps as $p)
                                                {
                                                    $text .= '<p> ' . $p->plaintext . '</p>';
                                                }
                                                $content = $text;
                                            } 
                                            else 
                                            {
                                                $content = $content->innertext;
                                            }
                                            $content = trim($content);
                                        }
                                        else 
                                        {
                                            if($html->find('.reading-content #content', 0))
                                            {
                                                $content = $html->find('.reading-content #content', 0)->innertext;
                                            } 
                                            else 
                                            {
                                                $content = $html->find('.reading-content .text-left .cha-content .cha-words', 0);
                                                if($content) 
                                                {
                                                    $content = $content->innertext;
                                                } 
                                                else 
                                                {
                                                    $content = $html->find('.reading-content .text-left', 0);
                                                    if($content)
                                                    {
                                                        $other_ps = $content->find('p');
                                                        if(count($other_ps) > 0)
                                                        {
                                                            $text = '';
                                                            foreach($other_ps as $p)
                                                            {
                                                                $text .= '<p> ' . $p->plaintext . '</p>';
                                                            }
                                                            $content = $text;
                                                        } 
                                                        else 
                                                        {							
                                                            if($inner_content = $content->find('#chapter-content', 0))
                                                            {
                                                                $content = $inner_content->innertext;
                                                            }
                                                            else
                                                            {
                                                                if($inner_content = $content->find('.text-left', 0))
                                                                {
                                                                    $content = $inner_content->innertext;
                                                                }
                                                                else
                                                                {
                                                                    if($inner_content = $content->find('.fr-view', 0))
                                                                    {
                                                                        $content = $inner_content->innertext;
                                                                    }
                                                                    else
                                                                    {
                                                                        $content = $content->innertext;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                            if(!$content)
                                            {
                                                $content = '';
                                                $ps = $html->find('.reading-content .text-left p');
                                                foreach($ps as $p)
                                                {
                                                    $content .= '<p>' . $p->plaintext . '</p>';
                                                }
                                            }
                                        }
                                    }
                                    $content = preg_replace('#<a[^>]*href=["\']https?:\/\/wuxiaworld\.site[^"\']*["\'][^>]*>\s*<p[^>]*>.*?Wuxia.*?World\.Site.*?<\/p>\s*<\/a>#', '', $content);
                                    $content = str_replace('wuxiaworld.site', '', $content);
                                    $content = str_replace('wuxiaworldsite', '', $content);
                                    if(stristr($content, '<article') !== false)
                                    {
                                        $html2 = ums_str_get_html( $content );
                                        if( !empty( $html2 ) ){
                                            $artcontent = $html2->find('//article', 0);
                                            if($artcontent !== false)
                                            {
                                                $content = $artcontent->innertext;
                                            }
                                        }
                                    }
                                    $content = preg_replace('#<div class="wp-container-[a-zA-Z0-9]* entry-content wp-block-post-content">#i', '', $content);
                                    $content = preg_replace('#<\/div>$#', '', $content);
                                    $qtags = array('div', 'iframe', 'script', 'ins', 'h12');
                                    foreach ($qtags as $qtag) {
                                        $regex = '#<\s*' . $qtag . '[^>]*>.*?<\s*\/\s*'. $qtag . '>#msi';
                                        $content = preg_replace($regex, '', $content);
                                    }
                                    $content = preg_replace('#<style([\s\S]+?)<\/style>#i', '', $content);
                                    $content = preg_replace('#<\/?div([^>]*)>#i', '', $content);
                                    if($strip_images == '1')
                                    {
                                        $content = ums_sanitize_html_content($content);
                                    }
                                    $chapter_content = trim($content);
                                    $chapter_content = ums_strip_links($chapter_content);
                                    if($chapter_content == '')
                                    {
                                        
                                        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                            ums_log_to_file('Skipping current chapter (because it failed to parse first chapter content): ' . print_r($chaps['url'], true));
                                        }
                                        //new_chap true to prevent infinite running
                                        $new_chap = true;
                                        break;
                                    }
                                    $arr = ums_spin_and_translate($chaps['name'], $chapter_content, $rule_translate, 'en');
                                    if($arr === false)
                                    {
                                        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                            ums_log_to_file('Skipping current chapter (because it failed to be translated): ' . print_r($chaps['url'], true));
                                        }
                                    }
                                    elseif($no_translate_title != '1')
                                    {
                                        $chaps['name']              = $arr[0];
                                        $chaps['extend_name']       = $arr[0];
                                        $chapter_content = $arr[1];
                                    }
                                    global $wp_manga_text_type;
                                    if(empty($chaps['name']))
                                    {
                                        $chaps['name'] = 'Novel';
                                    }
                                    $chapter_args = array(
                                        'post_id'             => $existing_post_id,
                                        'chapter_name'        => $chaps['name'],
                                        'chapter_name_extend' => $name_str . ' ' . $chaps['extend_name'],
                                        'volume_id'           => '',
                                        'chapter_content'     => $chapter_content,
                                    );
                                    $slugified_name = $wp_manga_storage->slugify( $chaps['name'] );
                                    $chapter_2 = $wp_manga_chapter->get_chapter_by_slug( $existing_post_id, $slugified_name );
                                    if($chapter_2 && strtolower($chapter_2['chapter_slug']) == strtolower($slugified_name))
                                    {
                                        ums_log_to_file('Chapter name already published, we will skip: ' . $chapter_2['chapter_name']);
                                        continue; 
                                    }
                                    $chapter_id = $wp_manga_text_type->insert_chapter( $chapter_args );
                                    if( $chapter_id ){
                                        if( is_wp_error( $chapter_id ) ){
                                            ums_log_to_file('Failed to insert new chapter: ' . $chaps['name'] . ' error: ' . $chapter_id->get_error_message());
                                            continue;
                                        }
                                        else
                                        {
                                            $new_chap = true;
                                            $ums_imported_chapters++;
                                            $local_imported++;
                                        }
                                    }
                                    if (isset($ums_Main_Settings['request_timeout']) && $ums_Main_Settings['request_timeout'] != '') {
                                        $timeout = intval($ums_Main_Settings['request_timeout']);
                                    } else {
                                        $timeout = 1;
                                    }
                                    sleep($timeout);
                                }
                            }
                            else
                            {
                                foreach($chapters as $chaps)
                                {
                                    if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                        ums_log_to_file('Processing novel chapter (no lazyload): ' . $chaps['url']);
                                    }
                                    if($ums_max_chapters <= $local_imported)
                                    {
                                        break;
                                    }
                                    $slugified_name = $wp_manga_storage->slugify( $chaps['name'] );
                                    $chapter_2 = $wp_manga_chapter->get_chapter_by_slug( $existing_post_id, $slugified_name );
                                    if($chapter_2 && strtolower($chapter_2['chapter_slug']) == strtolower($slugified_name))
                                    {
                                        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                            ums_log_to_file('Chapter already published, skipping it: ' . $chapter_2['chapter_name']);
                                        }
                                        continue;
                                    }
                                    $page_html = ums_get_web_page($chaps['url'], ums_get_random_user_agent(), $use_phantom, $phantom_wait);
                                    if( $page_html == false ){
                                        ums_log_to_file('Failed to download HTML for chapter: ' . $chaps['name']);
                                        continue;
                                    }
                                    $html = ums_str_get_html( $page_html );
                                    if( empty( $html ) ){
                                        ums_log_to_file('Failed to parse HTML for chapter: ' . $chaps['name']);
                                        continue;
                                    }
                                    $content = '';
                                    $doc = new DOMDocument;
                                    $internalErrors = libxml_use_internal_errors(true);
                                    $doc->loadHTML('<?xml encoding="utf-8" ?>' . $page_html);
                                    libxml_use_internal_errors($internalErrors);
                                    $xpath = new \DOMXpath($doc);
                                    $articles = $xpath->query('//*[contains(@class, "text-left")]');
                                    if(empty($content)) 
                                    {
                                        $articles = $xpath->query('//*[contains(@class, "text-left")]');
                                        if($articles !== false && count($articles) > 0)
                                        {
                                            foreach($articles as $container) 
                                            {
                                                if(method_exists($container, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->saveHTML();
                                                }
                                                elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->ownerDocument->saveHTML($container);
                                                }
                                                elseif(isset($container->nodeValue))
                                                {
                                                    $content .= ' ' . $container->nodeValue;
                                                }
                                            }
                                            $content = trim($content);
                                        }
                                    }
                                    if(empty($content)) 
                                    {
                                        if($articles !== false && count($articles) > 0)
                                        {
                                            foreach($articles as $container) 
                                            {
                                                if(method_exists($container, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->saveHTML();
                                                }
                                                elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->ownerDocument->saveHTML($container);
                                                }
                                                elseif(isset($container->nodeValue))
                                                {
                                                    $content .= ' ' . $container->nodeValue;
                                                }
                                                break;
                                            }
                                            $content = trim($content);
                                            $prfx1 = '<div class="text-left">';
                                            $prfx2 = '<div class="new-content">';
                                            if (substr($content, 0, strlen($prfx1)) == $prfx1) {
                                                $content = substr($content, strlen($prfx1));
                                                $content = preg_replace('#<\/div>$#', '', $content);
                                            }
                                            $content = trim($content);
                                            if (substr($content, 0, strlen($prfx2)) == $prfx2) {
                                                $content = substr($content, strlen($prfx2));
                                                $content = preg_replace('#<\/div>$#', '', $content);
                                            }
                                            $content = trim($content);
                                            if(strstr($content, '<div class="entry-content">') !== false)
                                            {
                                                $content = str_replace('<div class="entry-content">', '', $content);
                                                $content = preg_replace('#<\/div>$#', '', $content);
                                            }
                                        }
                                    }
                                    if(empty($content)) 
                                    {
                                        $articles = $xpath->query('//*[contains(@class, "content-body")]');
                                        if($articles !== false && count($articles) > 0)
                                        {
                                            foreach($articles as $container) 
                                            {
                                                if(method_exists($container, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->saveHTML();
                                                }
                                                elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->ownerDocument->saveHTML($container);
                                                }
                                                elseif(isset($container->nodeValue))
                                                {
                                                    $content .= ' ' . $container->nodeValue;
                                                }
                                            }
                                        }
                                    }
                                    if(empty($content)) 
                                    {
                                        $articles = $xpath->query('//*[contains(@class, "cha-tit")]');
                                        if($articles !== false && count($articles) > 0)
                                        {
                                            foreach($articles as $container) 
                                            {
                                                if(method_exists($container, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->saveHTML();
                                                }
                                                elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->ownerDocument->saveHTML($container);
                                                }
                                                elseif(isset($container->nodeValue))
                                                {
                                                    $content .= ' ' . $container->nodeValue;
                                                }
                                            }
                                        }
                                        $articles = $xpath->query('//*[contains(@class, "cha-content")]');
                                        if($articles !== false && count($articles) > 0)
                                        {
                                            foreach($articles as $container) 
                                            {
                                                if(method_exists($container, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->saveHTML();
                                                }
                                                elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->ownerDocument->saveHTML($container);
                                                }
                                                elseif(isset($container->nodeValue))
                                                {
                                                    $content .= ' ' . $container->nodeValue;
                                                }
                                            }
                                        }
                                    }
                                    if(empty($content)) 
                                    {
                                        $content = $html->find('.reading-content .text-left .cha-words .cha-words', 0);
                                        if($content) 
                                        {
                                            $other_ps = $content->find('p');
                                            if(count($other_ps) > 0)
                                            {
                                                $text = '';
                                                foreach($other_ps as $p)
                                                {
                                                    $text .= '<p> ' . $p->plaintext . '</p>';
                                                }
                                                $content = $text;
                                            } 
                                            else 
                                            {
                                                $content = $content->innertext;
                                            }
                                        }
                                        else 
                                        {
                                            if($html->find('.reading-content #content', 0))
                                            {
                                                $content = $html->find('.reading-content #content', 0)->innertext;
                                            } 
                                            else 
                                            {
                                                $content = $html->find('.reading-content .text-left .cha-content .cha-words', 0);
                                                if($content) 
                                                {
                                                    $content = $content->innertext;
                                                } 
                                                else 
                                                {
                                                    $content = $html->find('.reading-content .text-left', 0);
                                                    if($content)
                                                    {
                                                        $other_ps = $content->find('p');
                                                        if(count($other_ps) > 0)
                                                        {
                                                            $text = '';
                                                            foreach($other_ps as $p)
                                                            {
                                                                $text .= '<p> ' . $p->plaintext . '</p>';
                                                            }
                                                            $content = $text;
                                                        } 
                                                        else 
                                                        {							
                                                            if($inner_content = $content->find('#chapter-content', 0))
                                                            {
                                                                $content = $inner_content->innertext;
                                                            }
                                                            else
                                                            {
                                                                if($inner_content = $content->find('.text-left', 0))
                                                                {
                                                                    $content = $inner_content->innertext;
                                                                }
                                                                else
                                                                {
                                                                    if($inner_content = $content->find('.fr-view', 0))
                                                                    {
                                                                        $content = $inner_content->innertext;
                                                                    }
                                                                    else
                                                                    {
                                                                        $content = $content->innertext;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                            if(!$content)
                                            {
                                                $content = '';
                                                $ps = $html->find('.reading-content .text-left p');
                                                foreach($ps as $p)
                                                {
                                                    $content .= '<p>' . $p->plaintext . '</p>';
                                                }
                                            }
                                        }
                                    }
                                    $content = preg_replace('#<a[^>]*href=["\']https?:\/\/wuxiaworld\.site[^"\']*["\'][^>]*>\s*<p[^>]*>.*?Wuxia.*?World\.Site.*?<\/p>\s*<\/a>#', '', $content);
                                    $content = str_replace('wuxiaworld.site', '', $content);
                                    $content = str_replace('world.site', '', $content);
                                    $content = str_replace('wuxia', '', $content);
                                    $content = str_replace('wuxiaworldsite', '', $content);
                                    if(stristr($content, '<article') !== false)
                                    {
                                        $html2 = ums_str_get_html( $content );
                                        if( !empty( $html2 ) ){
                                            $artcontent = $html2->find('//article', 0);
                                            if($artcontent !== false)
                                            {
                                                $content = $artcontent->innertext;
                                            }
                                        }
                                    }
                                    $qtags = array('iframe', 'script', 'ins', 'h12');
                                    foreach ($qtags as $qtag) {
                                        $regex = '#<\s*' . $qtag . '[^>]*>.*?<\s*\/\s*'. $qtag . '>#msi';
                                        $content = preg_replace($regex, '', $content);
                                    }
                                    $content = preg_replace('#<style([\s\S]+?)<\/style>#i', '', $content);
                                    if($strip_images == '1')
                                    {
                                        $content = ums_sanitize_html_content($content);
                                    }
                                    $chapter_content = trim($content);
                                    $chapter_content = ums_strip_links($chapter_content);
                                    if($chapter_content == '')
                                    {
                                        
                                        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                            ums_log_to_file('Skipping current chapter (because it failed to parse first chapter content): ' . print_r($chaps['url'], true));
                                        }
                                        //new_chap true to prevent infinite running
                                        $new_chap = true;
                                        break;
                                    }
                                    $arr = ums_spin_and_translate($chaps['name'], $chapter_content, $rule_translate, 'en');
                                    if($arr === false)
                                    {
                                        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                            ums_log_to_file('Skipping chapter (because it failed to be translated): ' . print_r($post_args, true));
                                        }
                                    }
                                    elseif($no_translate_title != '1')
                                    {
                                        $chaps['name']              = $arr[0];
                                        $chaps['extend_name']       = $arr[0];
                                        $chapter_content = $arr[1];
                                    }
                                    global $wp_manga_text_type;
                                    if(empty($chaps['name']))
                                    {
                                        $chaps['name'] = 'Novel';
                                    }
                                    $chapter_args = array(
                                        'post_id'             => $existing_post_id,
                                        'chapter_name'        => $chaps['name'],
                                        'chapter_name_extend' => $name_str . ' ' . $chaps['extend_name'],
                                        'volume_id'           => '',
                                        'chapter_content'     => $chapter_content,
                                    );
                                    $slugified_name = $wp_manga_storage->slugify( $chaps['name'] );
                                    $chapter_2 = $wp_manga_chapter->get_chapter_by_slug( $existing_post_id, $slugified_name );
                                    if($chapter_2 && strtolower($chapter_2['chapter_slug']) == strtolower($slugified_name))
                                    {
                                        ums_log_to_file('Chapter name already published, skipping it: ' . $chapter_2['chapter_name']);
                                        continue; 
                                    }
                                    $chapter_id = $wp_manga_text_type->insert_chapter( $chapter_args );
                                    if( $chapter_id ){
                                        if( is_wp_error( $chapter_id ) ){
                                            ums_log_to_file('Failed to insert chapter: ' . $chaps['name'] . ' error: ' . $chapter_id->get_error_message());
                                            continue;
                                        }
                                        else
                                        {
                                            $new_chap = true;
                                            $ums_imported_chapters++;
                                            $local_imported++;
                                        }
                                    }
                                    if (isset($ums_Main_Settings['request_timeout']) && $ums_Main_Settings['request_timeout'] != '') {
                                        $timeout = intval($ums_Main_Settings['request_timeout']);
                                    } else {
                                        $timeout = 1;
                                    }
                                    sleep($timeout);
                                }
                            }
                            if($new_chap == true)
                            {
                                if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                    ums_log_to_file('Total novel chapters scraped: ' . $local_imported);
                                }
                                $scraped_manga++;
                            }                            
                        }
                    }
                    catch(Exception $e)
                    {
                        ums_log_to_file('Importing failed: ' . $e->getMessage());
                        if($auto == 1)
                        {
                            ums_clearFromList($param, $type);
                        }
                        return 'fail';
                    }
                }
            }
            elseif($type == 2)
            {
                if(trim($max_manga) != '')
                {
                    $get_max_manga = intval(trim($max_manga));
                }
                else
                {
                    $get_max_manga = 999;
                }
                $items = array();
                $page_increased = false;
                {
                    $manga_arr = array();
                    try
                    {
                        global $wp_filesystem;
                        if ( ! is_a( $wp_filesystem, 'WP_Filesystem_Base') ){
                            include_once(ABSPATH . 'wp-admin/includes/file.php');$creds = request_filesystem_credentials( site_url() );
                            wp_filesystem($creds);
                        }
                        $prefixh = 'http://novlove.com/novel/';
                        $wprefixh = 'http://www.novlove.com/novel/';
                        $prefixs = 'https://novlove.com/novel/';
                        $wprefixs = 'https://www.novlove.com/novel/';
                        $manga_names = explode(',', $manga_name);
                        $manga_names = array_map('trim', $manga_names);
                        foreach($manga_names as $mngn)
                        {
                            if (substr($mngn, 0, strlen($prefixs)) == $prefixs) {
                                $manga_arr[] = $mngn;
                            }
                            elseif (substr($mngn, 0, strlen($prefixh)) == $prefixh) {
                                $manga_arr[] = $mngn;
                            }
                            elseif (substr($mngn, 0, strlen($wprefixh)) == $wprefixh) {
                                $manga_arr[] = $mngn;
                            }
                            elseif (substr($mngn, 0, strlen($wprefixs)) == $wprefixs) {
                                $manga_arr[] = $mngn;
                            }
                            else
                            {
                                if($wp_filesystem->exists(dirname(__FILE__) . "/sitemap_box.txt"))
                                {
                                    $handle = fopen(dirname(__FILE__) . "/sitemap_box.txt", "r");
                                    if ($handle)
                                    {
                                        while (!feof($handle))
                                        {
                                            $buffer = fgets($handle);
                                            if($buffer !== false)
                                            {
                                                if($mngn == '*')
                                                {
                                                    $manga_arr[] = 'https://novlove.com/novel/' . trim($buffer) . '/';
                                                }
                                                else
                                                {
                                                    $xbuffer = str_replace('-', ' ', $buffer);
                                                    $mngnwords = explode(' ', $mngn);
                                                    $xbuffer_arr = explode(' ', $xbuffer);
                                                    foreach($mngnwords as $mangx)
                                                    {
                                                        $mangx = trim($mangx);
                                                        $xfound = false;
                                                        foreach($xbuffer_arr as $xbf)
                                                        {
                                                            $xbf = trim($xbf);
                                                            if($xbf == $mangx)
                                                            {
                                                                $xfound = true;
                                                            }
                                                        }
                                                        if($xfound == true)
                                                        {
                                                            $manga_arr[] = 'https://novlove.com/novel/' . trim($buffer) . '/';
                                                            break;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        fclose($handle);
                                    }
                                }
                                else
                                {
                                    ums_log_to_file('Only URLs from https://novlove.com/novel/ are allowed, because sitemap file failed to be opened, skipping: ' . $mngn);
                                    continue;
                                }
                            }
                        }
                        if(count($manga_arr) == 0)
                        {
                            ums_log_to_file('No Web Novel matched your query: ' . $manga_name);
                            return 'nochange';
                        }
                        $scraped_manga = 0;
                        foreach($manga_arr as $current_manga)
                        {
                            if($get_max_manga <= $scraped_manga)
                            {
                                break;
                            }
                            $current_manga = trim($current_manga, '/');
                            $current_manga = $current_manga . '/';
                            $html_site = ums_get_web_page($current_manga, ums_get_random_user_agent(), $use_phantom, $phantom_wait);
                            if($html_site == false)
                            {
                                ums_log_to_file('Failed to download manga chapter: ' . $current_manga);
                                continue;
                            }
                            if(stristr($html_site, 'Cloudflare Ray ID:') !== false)
                            {
                                ums_log_to_file('CloudFlare protection active on novlove.com, access is limited! Please install puppeteer on your site and set the "Content Scraping Method To Use" to Puppeteer for scraping to work. Manga URL: ' . $current_manga);
                                sleep(1);
                                continue;
                            }
                            if(stristr($html_site, 'manga-title-badges custom comic') !== false)
                            {
                                ums_log_to_file('This URL is a web comic, not a web novel, skipping it: ' . $current_manga);
                                continue;
                            }
                            if (isset($ums_Main_Settings['request_timeout']) && $ums_Main_Settings['request_timeout'] != '') {
                                $timeout = intval($ums_Main_Settings['request_timeout']);
                            } else {
                                $timeout = 1;
                            }
                            sleep($timeout);
                            require_once (dirname(__FILE__) . "/res/simple_html_dom.php"); 
                            $html = ums_str_get_html( $html_site );
                            
                            // Detect if this is a FanMTL/ReadWN/Wuxia site
                            $is_fanmtl = (stristr($current_manga, 'fanmtl') !== false || stristr($current_manga, 'fannovels') !== false || stristr($current_manga, 'fansmtl') !== false || stristr($current_manga, 'readwn') !== false || stristr($current_manga, 'novelmt') !== false || stristr($current_manga, 'novelmtl') !== false || stristr($current_manga, 'wuxiabee') !== false || stristr($current_manga, 'wuxiafox') !== false || stristr($current_manga, 'wuxiago') !== false || stristr($current_manga, 'wuxiahere') !== false || stristr($current_manga, 'wuxiahub') !== false || stristr($current_manga, 'wuxiamtl') !== false || stristr($current_manga, 'wuxiaone') !== false || stristr($current_manga, 'wuxiap') !== false || stristr($current_manga, 'wuxiapub') !== false || stristr($current_manga, 'wuxiaspot') !== false || stristr($current_manga, 'wuxiar') !== false || stristr($current_manga, 'wuxiau') !== false || stristr($current_manga, 'wuxiazone') !== false);
                            
                            $tag = null;
                            if ($is_fanmtl) {
                                // FanMTL/ReadWN uses: div.main-head h1
                                $tag = $html->find('div.main-head h1', 0);
                            }
                            if (!$tag) {
                                // Fallback to novlove selector
                                $tag = $html->find('.title', 0);
                            }
                            
                            $name_str = '';
                            $my_slug = '';
                            $my_slug = str_replace( 'http://', '', $current_manga );
                            $my_slug = str_replace( 'https://', '', $my_slug );
                            $my_slug = str_replace( 'http:', '', $my_slug );
                            $my_slug = str_replace( 'novlove.com/novel/', '', $my_slug );
                            // Also handle FanMTL URL structure
                            $my_slug = str_replace( 'fanmtl.com/novel/', '', $my_slug );
                            $my_slug = str_replace( 'readwn.com/novel/', '', $my_slug );
                            $my_slug = str_replace( '/', '', $my_slug );
                            $my_slug = str_replace( '.html', '', $my_slug );
                            $my_slug = str_replace( '.htm', '', $my_slug );
                            if($tag){
                                $name_str = trim($tag->plaintext);
                                $span = $tag->find('span', 0);
                                if($span){
                                    $name_str = trim(str_replace($span->plaintext,'', $name_str));
                                }
                            }
                            if($name_str == '')
                            {
                                preg_match_all('#<title>([^<]*?) - novlove<\/title>#i', $html_site, $tmathc);
                                if(isset($tmathc[1][0]))
                                {
                                    $name_str = $tmathc[1][0];
                                }
                            }
                            if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                ums_log_to_file('Processing novel: ' . $name_str);
                            }
                            $find_post = new WP_Query( array(
                                'title'     => $name_str,
                                'post_type' => 'wp-manga',
                            ) );
                            $existing_post_id = false;
                            if( $find_post->have_posts() )
                            {
                                $existing_post_id = $find_post->posts[0]->ID;
                            }
                            if($existing_post_id == false)
                            {
                                $args = array(
                                    'post_type'  => 'wp-manga',
                                    'meta_key'   => '_manga_import_slug',
                                    'meta_value' => $my_slug,
                                    'post_status' => array('publish','draft','pending','trash','private','future')
                                );
                                $query = new WP_Query( $args );
                                if( $query->have_posts() ){
                                    $existing_post_id = $query->posts[0]->ID;
                                }
                            }
                            if($existing_post_id == false)
                            {
                                $block_warning = $html->find('#page .warning', 0);
                                if( !empty( $block_warning ) && strpos( $block_warning->plaintext, 'has been licensed, it is not available' ) !== false ){
                                    ums_log_to_file('Request blocked, please use a proxy!');
                                    continue;
                                }
                                $xd = '';
                                // Try FanMTL/ReadWN description selector first
                                if ($is_fanmtl) {
                                    $desc_elems = $html->find('.summary .content');
                                    if (!empty($desc_elems)) {
                                        foreach($desc_elems as $dd) {
                                            $xd .= ' ' . trim($dd->innertext);
                                        }
                                        $xd = trim($xd);
                                    }
                                }
                                // Fallback to novlove selectors
                                if (empty($xd)) {
                                    $desc = $html->find( '.desc-text' );
                                    if(is_array($desc))
                                    {
                                        foreach($desc as $dd)
                                        {
                                            $xd = trim($dd->plaintext);
                                            $xprefix = 'Description';
                                            if (substr($xd, 0, strlen($xprefix)) == $xprefix) {
                                                $xd = substr($xd, strlen($xprefix));
                                            }
                                            $xprefix = 'Summary';
                                            if (substr($xd, 0, strlen($xprefix)) == $xprefix) {
                                                $xd = substr($xd, strlen($xprefix));
                                            } 
                                            $xd = trim($xd);
                                        }
                                    }
                                }
                                if($xd == '')
                                {
                                    $doc = new DOMDocument;
                                    $internalErrors = libxml_use_internal_errors(true);
                                    $doc->loadHTML('<?xml encoding="utf-8" ?>' . $html_site);
                                    libxml_use_internal_errors($internalErrors);
                                    $xpath = new \DOMXpath($doc);
                                    $articles = $xpath->query('//*[@class="g_txt_over mb48 fs16 j_synopsis _txtover _on"]');
                                    if($articles !== false && count($articles) > 0)
                                    {
                                        foreach($articles as $container) {
                                            if(method_exists($container, 'saveHTML'))
                                            {
                                                $xd .= ' ' . $container->saveHTML();
                                            }
                                            elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                            {
                                                $xd .= ' ' . $container->ownerDocument->saveHTML($container);
                                            }
                                            elseif(isset($container->nodeValue))
                                            {
                                                $xd .= ' ' . $container->nodeValue;
                                            }
                                        }
                                        $qtags = array('iframe', 'script');
                                        foreach ($qtags as $qtag) 
                                        {
                                            $regex = '#<\s*' . $qtag . '[^>]*>.*?<\s*/\s*'. $qtag . '>#msi';
                                            $xd = preg_replace($regex, '', $xd);
                                        }
                                    }
                                    else
                                    {
                                        $articles = $xpath->query('//*[@class="c_000"]');
                                        if($articles !== false && count($articles) > 0)
                                        {
                                            foreach($articles as $container) {
                                                if(method_exists($container, 'saveHTML'))
                                                {
                                                    $xd .= ' ' . $container->saveHTML();
                                                }
                                                elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                                {
                                                    $xd .= ' ' . $container->ownerDocument->saveHTML($container);
                                                }
                                                elseif(isset($container->nodeValue))
                                                {
                                                    $xd .= ' ' . $container->nodeValue;
                                                }
                                            }
                                        }
                                    }
                                }
                                if($xd == '')
                                {
                                    $desc = '';
                                }
                                else
                                {
                                    $desc = trim($xd);
                                }
                                if($desc == '')
                                {
                                    preg_match_all('#<div class="summary__content show-more">(?:<p>)?([\s\S]*?)(?:<\/p>)?<\/?div>#i', $html_site, $dmathc);
                                    if(isset($dmathc[1][0]))
                                    {
                                        $desc = $dmathc[1][0];
                                    }
                                }
                                $desc = ums_strip_links($desc);
                                $uxrlparts = wp_parse_url(home_url());
                                $domainx = $uxrlparts['host'];
                                $desc = preg_replace('#<p><center><a href="https:\/\/bronovel\.com\/"><em><strong>Announcement<\/strong><\/em>: we are moving[\s\S]*?<\/center><\/p>#', '', $desc);
                                $desc = str_ireplace('novlove.com', $domainx, $desc);
                                $desc = str_ireplace('novlove', get_bloginfo('name'), $desc);
                                $desc = str_ireplace('listnovel.com', $domainx, $desc);
                                $desc = str_ireplace('bronovel.com', $domainx, $desc);
                                $desc = str_ireplace('bronovel', get_bloginfo('name'), $desc);
                                $thumb = '';
                                // Try FanMTL/ReadWN cover selector first
                                if ($is_fanmtl && $thumb == '') {
                                    $cover_elem = $html->find('figure.cover img', 0);
                                    if ($cover_elem) {
                                        $thumb = $cover_elem->src;
                                        if (empty($thumb)) {
                                            $thumb = $cover_elem->{'data-src'};
                                        }
                                    }
                                }
                                if($thumb == '')
                                {
                                    preg_match_all('#<img class="lazy"(?:\s*title="[^"]*?"\s*)? (?:data-)?src="([^"]*?)"#is', $html_site, $xmathc);
                                    if(isset($xmathc[1][0]))
                                    {
                                        $thumb = trim($xmathc[1][0]);
                                    }
                                }
                                if($thumb == '')
                                {
                                    preg_match_all('#<meta property="og:image" content="([^"]*?)"#is', $html_site, $xmathc);
                                    if(isset($xmathc[1][0]))
                                    {
                                        $thumb = trim($xmathc[1][0]);
                                    }
                                }
                                if(empty($thumb))
                                {
                                    $thumb = $html->find( '.lazy' );
                                    $thumb = !empty( $thumb ) ? $thumb[0]->{'data-src'} : '';
                                    if($thumb == '')
                                    {
                                        $thumb = !empty( $thumb ) ? $thumb[0]->src : '';
                                    }
                                    if($thumb == '')
                                    {
                                        $thumb = $html->find( '.summary_image img' );
                                        $thumb = !empty( $thumb ) ? $thumb[0]->src : '';
                                    }
                                }
                                if($thumb == '')
                                {
                                    preg_match_all('#<img class="lazy" data-src="([^"]*?)"#is', $html_site, $xmathc);
                                    if(isset($xmathc[1][0]))
                                    {
                                        $thumb = trim($xmathc[1][0]);
                                    }
                                }
                                $stx = '';
                                preg_match_all('#<h3>Status:<\/h3>[\s\n]*?<a href="[^"]*?" class="text-primary">([^<]*?)<\/a>#is', $html_site, $xmathc);
                                if(isset($xmathc[1][0]))
                                {
                                    $status = $xmathc[1][0];
                                }
                                else
                                {
                                    $status = $html->find( '.text-primary' );
                                    if(is_array($status))
                                    {
                                        foreach($status as $st)
                                        {
                                            $stx = $st->plaintext;
                                        }
                                    }
                                    if($stx === '')
                                    {
                                        $status = '';
                                    }
                                    else
                                    {
                                        $status = $stx;
                                    }
                                }
                                if(stristr($status, 'ongoing') !== false)
                                {
                                    $status = 'on-going';
                                }
                                elseif(stristr($status, 'completed') !== false)
                                {
                                    $status = 'end';
                                }
                                elseif(stristr($status, 'canceled') !== false)
                                {
                                    $status = 'canceled';
                                }
                                elseif(stristr($status, 'on hold') !== false)
                                {
                                    $status = 'on-hold';
                                }
                                elseif(stristr($status, 'upcoming') !== false)
                                {
                                    $status = 'upcoming';
                                }
                                preg_match_all('#<h3>Alternative names:\s?<\/h3>[\s\n]*?([^<]*?)[\s\n]*?<\/li>#is', $html_site, $xmathc);
                                if(isset($xmathc[1][0]))
                                {
                                    $alter_name = $xmathc[1][0];
                                }
                                else
                                {
                                    $alter_name = $html->find( '.summary_content .post-content .post-content_item' );
                                    $xplain = '';
                                    if( !empty( $alter_name ) )
                                    {
                                        foreach($alter_name as $an)
                                        {
                                            if(stristr($an->plaintext, 'Alternative '))
                                            {
                                                $xplain = trim($an->plaintext);
                                                $xprefix = 'Alternative';
                                                if (substr($xplain, 0, strlen($xprefix)) == $xprefix) {
                                                    $xplain = substr($xplain, strlen($xprefix));
                                                } 
                                                $xplain = trim($xplain);
                                            }
                                        }
                                    }
                                    if($xplain != '')
                                    {
                                        $alter_name = $xplain;
                                    }
                                    else
                                    {
                                        $alter_name = '';
                                    }
                                }
                                $data = $html->find( '.summary_content .post-content .post-content_item' );
                                $xtype = '';
                                if( !empty( $data ) ){
                                    foreach($data as $item){
                                        if(trim($item->find('.summary-heading h5',0)->plaintext) == 'Type'){
                                            $xtype = $item->find('.summary-content', 0)->plaintext;
                                            if(trim($xtype) == 'Updating')
                                            {
                                                $xtype = '';
                                            }
                                        }
                                    }
                                }
                                $xrelease = '2021';
                                preg_match_all('#href="https:\/\/novlove\.com\/year\/(\d+)"#i', $html_site, $xmathc);
                                if(isset($xmathc[1][0]))
                                {
                                    $xrelease = trim($xmathc[1][0]);
                                }
                                $xauthor = '';
                                $author = '';
                                // Try FanMTL/ReadWN author selector first
                                if ($is_fanmtl) {
                                    $author_elem = $html->find('span[itemprop="author"]', 0);
                                    if ($author_elem) {
                                        $author = trim($author_elem->plaintext);
                                        $xauthor = $author;
                                    }
                                }
                                // Fallback to novlove selectors
                                if(empty($author)) {
                                    preg_match_all('#<h3>Author:<\/h3>[\n\s]*<a[\n\s]*href="[^"]*?">([^<]*?)<\/a>#i', $html_site, $xmathc);
                                    if(isset($xmathc[1][0]))
                                    {
                                        $author = trim($xmathc[1][0]);
                                        $xauthor = trim($xmathc[1][0]);
                                    }
                                }
                                if(empty($author))
                                {
                                    $data = $html->find( '.author-content a' );
                                    if( !empty( $data ) ){
                                        $authors = array();
                                        foreach($data as $arxthor)
                                        {
                                            array_push($authors, $arxthor->plaintext);
                                            if($author == '')
                                            {
                                                $author = $arxthor->plaintext;
                                            }
                                        }
                                        $xauthor = implode(',', $authors);
                                    }
                                }
                                $xartists = '';
                                $data = $html->find( '.artist-content a' );
                                if( !empty( $data ) ){
                                    $artists = array();
                                    foreach($data as $artist){
                                        array_push($artists, $artist->plaintext);
                                    }
                                    $xartists = implode(',', $artists);
                                }
                                $xgenres = '';
                                preg_match_all('#<li>[\s\n]*?<h3>Genre:<\/h3>[\s\n]*?([\s\S]*?)[\s\n]*?<\/li>#i', $html_site, $xmathc);
                                if(isset($xmathc[1][0]))
                                {
                                    preg_match_all('#>([^<]*?)</a>#i', $xmathc[1][0], $xamathc);
                                    if(isset($xamathc[1][0]))
                                    {
                                        $xgenres = implode(',', $xamathc[1]);
                                    }
                                }
                                if(empty($xgenres))
                                {
                                    $data = $html->find( '.genres-content a' );
                                    if( !empty( $data ) ){
                                        $genres = array();
                                        foreach($data as $genre){
                                            array_push($genres, $genre->plaintext);
                                        }
                                        $xgenres = implode(',', $genres);
                                    }
                                }
                                $items = $html->find('.summary_content .post-content .post-content_item');
                                $views = '';
                                foreach($items as $item){
                                    if(trim($item->find('.summary-heading', 0)->plaintext) == 'Rank'){
                                        $str = $item->find('.summary-content',0)->plaintext;
                                        preg_match_all('~\d+(?:\.\d+)?~', $str, $matches);
                                        if($matches){
                                            if(count($matches) == 3){
                                                $views = $matches[0][1];
                                            } else {
                                                $views = $matches[0][0];
                                            }
                                            if(strpos($str, 'K monthly views') !== false){
                                                $views = floatval($views) * 1000;
                                            }
                                            if(strpos($str, 'M monthly views') !== false){
                                                $views = floatval($views) * 1000000;
                                            }
                                            break;
                                        }
                                    }
                                }
                                if(empty(trim($views)) || !is_numeric(strip_tags( $views  )))
                                {
                                    $viewsm = rand(100,500);
                                }
                                else
                                {
                                    $viewsm = strip_tags(trim($views));
                                }
                                $average_vote = $html->find('.post-total-rating .total_votes', 0);
                                $str = $html->find('.vote-details',0);
                                $xrating = array();
                                if(!empty($str))
                                {
                                    preg_match_all('!\d+!', $str, $matches);
                                    $number_votes = 1;
                                    if($matches && count($matches[0]) == 3)
                                    {
                                        $number_votes = $matches[0][2];
                                    }
                                    if( !empty( $average_vote ) && $average_vote->plaintext > 0 ){
                                        $xrating = array(
                                            'avg'     => $average_vote->plaintext,
                                            'numbers' => $number_votes
                                        );
                                    }
                                }
                                $xtags = '';
                                $data = $html->find( '.tags-content a' );
                                if( !empty( $data ) ){
                                    $tags = array();
                                    foreach($data as $tag){
                                        $ttext = trim($tag->plaintext);
                                        $ttext = str_ireplace('novlove', get_bloginfo('name'), $ttext);
                                        $ttext = str_ireplace('box novel', get_bloginfo('name'), $ttext);
                                        array_push($tags, $ttext);
                                    }
                                    $xtags = implode(',', $tags);
                                }
                                $xtime_year = '';
                                $time_year = strtotime($xrelease);
                                if($time_year !== false)
                                {
                                    $time_year = date("Y", $time_year);
                                    if($time_year !== false)
                                    {
                                        $xtime_year = $time_year;
                                    }
                                }
                                $post_args = array(
                                    'manga_import_slug' => $my_slug,
                                    'title'             => $name_str,
                                    'post_status'       => $post_status,
                                    'description'       => $desc,
                                    'thumb'             => $thumb,
                                    'status'            => $status,
                                    'altername'         => strip_tags( $alter_name ),
                                    'type'              => strip_tags( $xtype ),
                                    'release'           => $xtime_year,
                                    'authors'           => strip_tags( $xauthor ),
                                    'artists'           => strip_tags( $xartists ),
                                );
                                $post_args['genres'] = '';
                                if($auto_categories == 'genre')
                                {
                                    $post_args['genres'] = strip_tags( $xgenres );
                                }
                                if($default_category != '')
                                {
                                    if($post_args['genres'] != '')
                                    {
                                        $post_args['genres'] .= ',';
                                    }
                                    $genreplus = get_term_by('id', $default_category, 'wp-manga-genre');
                                    if($genreplus !== false)
                                    {
                                        $post_args['genres'] .= $genreplus->slug;
                                    }
                                }
                                $post_args['views'] = strip_tags( $viewsm  );
                                $post_args['ratings'] = $xrating;
                                if($can_create_tag == 'genre')
                                {
                                    $post_args['tags'] = strip_tags( $xgenres );
                                }
                                elseif($can_create_tag == 'tags')
                                {
                                    $post_args['tags'] = strip_tags( $xtags );
                                }
                                else
                                {
                                    $post_args['tags'] = '';
                                }
                                if($item_create_tag != '')
                                {
                                    $ctag = explode(',', $item_create_tag);
                                    foreach($ctag as $ctap)
                                    {
                                        $ctap = trim($ctap);
                                        if($post_args['tags'] != '')
                                        {
                                            $post_args['tags'] .= ',';
                                        }
                                        $genreplus = get_term_by('name', $ctap, 'wp-manga-tag');
                                        if($genreplus !== false)
                                        {
                                            $post_args['tags'] .= $genreplus->slug;
                                        }
                                        else
                                        {
                                            $cat = wp_insert_term($ctap, 'wp-manga-tag');
                                            if(!is_wp_error( $cat ))
                                            {
                                                $post_args['tags'] .= $cat['slug'];
                                            }
                                        }
                                    }
                                }
                                $post_args['description'] = str_ireplace('novlove.com', $_SERVER['HTTP_HOST'], $post_args['description']);
                                $arr = ums_spin_and_translate($post_args['title'], $post_args['description'], $rule_translate, 'en');
                                if($arr === false)
                                {
                                    if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                        ums_log_to_file('Skipping web novel (because it failed to be translated): ' . print_r($post_args, true));
                                    }
                                    continue;
                                }
                                else
                                {
                                    if($no_translate_title != '1')
                                    {
                                        $post_args['title']              = $arr[0];
                                    }
                                    $post_args['description']        = $arr[1];
                                }
                                $za_xpost_args = array(
                                    'post_title'   => !empty( $post_args['title'] ) ? $post_args['title'] : '',
                                    'post_content' => !empty( $post_args['description'] ) ? $post_args['description'] : '',
                                    'post_type'    => 'wp-manga',
                                    'post_status'  => isset( $post_args['post_status'] ) ? $post_args['post_status'] : 'pending',
                                );
                                $existing_again = false;
                                if($za_xpost_args['post_title'] != '')
                                {
                                    $xposts = get_posts(
                                        array(
                                            'post_type'              => 'wp-manga',
                                            'title'                  => html_entity_decode($za_xpost_args['post_title']),
                                            'post_status'            => 'all',
                                            'numberposts'            => 1,
                                            'update_post_term_cache' => false,
                                            'update_post_meta_cache' => false,           
                                            'orderby'                => 'post_date ID',
                                            'order'                  => 'ASC',
                                        )
                                    );
                                    if ( ! empty( $xposts ) ) {
                                        $ex_page = $xposts[0];
                                    } else {
                                        $ex_page = null;
                                    }
                                    if(isset($ex_page->ID))
                                    {
                                        $existing_again = true;
                                        $existing_post_id = $ex_page->ID;
                                    }
                                }
                                if($existing_again == false)
                                {
                                    $accept_comments = 'closed';
                                    if ($enable_comments == '1') {
                                        $accept_comments = 'open';
                                    }
                                    $za_xpost_args['comment_status'] = $accept_comments;
                                    if ($enable_pingback == '1') 
                                    {
                                        $za_xpost_args['ping_status'] = 'open';
                                    } 
                                    else 
                                    {
                                        $za_xpost_args['ping_status'] = 'closed';
                                    }
                                    if($get_date == '1')
                                    {
                                        if(!empty($xrelease))
                                        {
                                            if(strlen($xrelease) == 4)
                                            {
                                                $xrelease .= '-01-01 00:00';
                                            }
                                            $postdatex = gmdate("Y-m-d H:i:s", strtotime($xrelease));
                                            $za_xpost_args['post_date_gmt'] = $postdatex;
                                        }
                                    }
                                    if($user_name_type == 'rand')
                                    {
                                        $randid = ums_display_random_user();
                                        if($randid === false)
                                        {
                                            $za_xpost_args['post_author']               = ums_randomName();
                                        }
                                        else
                                        {
                                            $za_xpost_args['post_author']               = $randid->ID;
                                        }
                                    }
                                    elseif($user_name_type == 'feed-news')
                                    {
                                        $sp_post_user_name = ums_randomName();
                                        if($author == '' || $author == '1' || $author == 'null')
                                        {
                                            $author = ums_randomName();
                                        }
                                        if($author != '')
                                        {
                                            $xauthor = sanitize_user( $author );
                                            $xauthor = apply_filters( 'pre_user_login', $xauthor );
                                            $xauthor = trim( $xauthor );
                                            if(username_exists( $xauthor ))
                                            {
                                                $user_id_t = get_user_by('login', $xauthor);
                                                if($user_id_t)
                                                {
                                                    $sp_post_user_name = $user_id_t->ID;
                                                }
                                            }
                                            else
                                            {
                                                $palphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^*()-+=_?><,.;:}{][';
                                                $ppass = '';
                                                $alphaLength = strlen($palphabet) - 1;
                                                for ($ipass = 0; $ipass < 8; $ipass++) 
                                                {
                                                    $npass = rand(0, $alphaLength);
                                                    $ppass .= $palphabet[$npass];
                                                }
                                                $curr_id = wp_create_user($xauthor, $ppass, ums_generate_random_email());
                                                if ( is_int($curr_id) )
                                                {
                                                    $u = new WP_User($curr_id);
                                                    $u->remove_role('subscriber');
                                                    $u->add_role('author');
                                                    $sp_post_user_name               = $curr_id;
                                                }
                                            }
                                        }
                                        $za_xpost_args['post_author']               = ums_utf8_encode($sp_post_user_name);
                                    }
                                    else
                                    {
                                        $za_xpost_args['post_author']               = ums_utf8_encode($post_user_name);
                                    }
                                    
                                    if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                        ums_log_to_file('Inserting new novel: ' . $za_xpost_args['post_title']);
                                    }
                                    $existing_post_id = wp_insert_post( $za_xpost_args );
                                    if( ! $existing_post_id || is_wp_error( $existing_post_id ) ){
                                        ums_log_to_file('Failed to insert novel into db: ' . $post_args['title']);
                                        continue;
                                    }
                                    add_post_meta($existing_post_id, 'ums_parent_rule', $type . '-' . $param);
                                    wp_set_object_terms( $existing_post_id, 'Ums_' . $type . '_' . $param, 'coderevolution_post_source', true);
                                    if($thumb != '')
                                    {
                                        $thumb_id = ums_wp_mcl_e_upload_file( $post_args['thumb'], $use_phantom, $phantom_wait, $existing_post_id );
                                        if($thumb_id === false)
                                        {
                                            include_once( ABSPATH . 'wp-admin/includes/image.php' );
                                            $thcontent = ums_get_web_page($thumb);
                                            if (isset($ums_Main_Settings['request_timeout']) && $ums_Main_Settings['request_timeout'] != '') {
                                                $timeout = intval($ums_Main_Settings['request_timeout']);
                                            } else {
                                                $timeout = 1;
                                            }
                                            sleep($timeout);
                                            $pathinfo = pathinfo( $thumb );
                                            if( $thcontent != false ){
                                                $upload_dir = wp_upload_dir();
                                                $file_tmp_path = $upload_dir['basedir'] . '/' . $pathinfo['filename'] . '-' . $existing_post_id . '.' . explode('?',$pathinfo['extension'])[0];
                                                $file = $wp_filesystem->put_contents( $file_tmp_path, $thcontent );
                                                $wp_filetype = wp_check_filetype(basename($file_tmp_path), null );
                                                $attachment = array(
                                                    'post_mime_type' => $wp_filetype['type'],
                                                    'post_title' => $existing_post_id,
                                                    'post_content' => '',
                                                    'post_status' => 'inherit'
                                                );
                                                $attach_id = wp_insert_attachment( $attachment, $file_tmp_path );
                                                $thumb_id = $attach_id;
                                                $imagenew = get_post( $attach_id );
                                                $fullsizepath = get_attached_file( $imagenew->ID );
                                                require_once( ABSPATH . 'wp-admin/includes/image.php' );
                                                require_once( ABSPATH . 'wp-admin/includes/media.php' );
                                                $attach_data = wp_generate_attachment_metadata( $attach_id, $fullsizepath );
                                                wp_update_attachment_metadata( $attach_id, $attach_data );
                                            }
                                        }
                                    }
                                    else
                                    {
                                        $thumb_id = false;
                                    }
                                    $meta_data = array(
                                        '_manga_import_slug'     => $my_slug,
                                        '_thumbnail_id'          => $thumb_id,
                                        '_wp_manga_alternative'  => strip_tags( $alter_name ),
                                        '_wp_manga_type'         => strip_tags( $xtype ),
                                        '_wp_manga_status'       => $status,
                                        '_wp_manga_chapter_type' => 'text',
                                        '_wp_manga_chapters_warning'=> $chapter_warning,
                                    );
                                    foreach( $meta_data as $key => $value ){
                                        if( !empty( $value ) ){
                                            update_post_meta( $existing_post_id, $key, $value );
                                        }
                                    }
                                    $manga_terms = array(
                                        'wp-manga-release'     => strip_tags( $xrelease ),
                                        'wp-manga-author'      => strip_tags( $xauthor ),
                                        'wp-manga-artist'      => strip_tags( $xartists ),
                                        'wp-manga-genre'       => isset( $post_args['genres'] ) ? $post_args['genres'] : '',
                                        'wp-manga-tag'         => isset( $post_args['tags'] ) ? $post_args['tags'] : null,
                                    );
                                    foreach( $manga_terms as $tax => $term ){
                                        $resp = ums_add_manga_terms( $existing_post_id, $term, $tax );
                                    }
                                    ums_update_post_views( $existing_post_id, strip_tags( $viewsm ) );
                                    ums_update_post_ratings( $existing_post_id, $xrating );
                                }
                            }
                            $chapters = array();
                            $lazy_loaded = false;
                            $ums_max_chapters = $max;
                            if($reverse_chapters == '1')
                            {
                                $reverse = true;
                            }
                            else
                            {
                                $reverse = false;
                            }
                            $first_chapter = '';
                            $latest_scraped = get_post_meta( $existing_post_id, 'ums_latest_scraped', true );
                            if(!empty($latest_scraped))
                            {
                                if(stristr($latest_scraped, 'novlove') || stristr($latest_scraped, 'fanmtl') || stristr($latest_scraped, 'fannovels') || stristr($latest_scraped, 'fansmtl') || stristr($latest_scraped, 'readwn') || stristr($latest_scraped, 'novelmt') || stristr($latest_scraped, 'novelmtl') || stristr($latest_scraped, 'wuxiabee') || stristr($latest_scraped, 'wuxiafox') || stristr($latest_scraped, 'wuxiago') || stristr($latest_scraped, 'wuxiahere') || stristr($latest_scraped, 'wuxiahub') || stristr($latest_scraped, 'wuxiamtl') || stristr($latest_scraped, 'wuxiaone') || stristr($latest_scraped, 'wuxiap') || stristr($latest_scraped, 'wuxiapub') || stristr($latest_scraped, 'wuxiaspot') || stristr($latest_scraped, 'wuxiar') || stristr($latest_scraped, 'wuxiau') || stristr($latest_scraped, 'wuxiazone'))
                                {
                                    $first_chapter = $latest_scraped;
                                }
                            }
                            if(empty($first_chapter))
                            {
                                libxml_use_internal_errors(true); 
                                $dom = new DOMDocument();
                                $dom->loadHTML($html_site);
                                $xpath = new DOMXPath($dom);
                                $links = $xpath->query('//ul[contains(@class, "list-chapter")]//a');
                                $chapterUrls = [];
                                foreach ($links as $link) {
                                    $href = $link->getAttribute('href');
                                    if ($href) {
                                        $chapterUrls[] = $href;
                                    }
                                }
                                // FanMTL / ReadWN uses "chapter-list" instead of "list-chapter"
                                if(empty($chapterUrls))
                                {
                                    $links = $xpath->query('//ul[contains(@class, "chapter-list")]//a');
                                    foreach ($links as $link) {
                                        $href = $link->getAttribute('href');
                                        if ($href) {
                                            $chapterUrls[] = $href;
                                        }
                                    }
                                }
                                if($reverse == true)
                                {
                                    $chapterUrls = array_reverse($chapterUrls);
                                }
                                if(!empty($chapterUrls))
                                {
                                    $first_chapter = $chapterUrls[0];
                                }
                            }
                            if(empty($first_chapter))
                            {
                                preg_match_all('#<meta property="og:novel:read_url"[\s\n]*?content="([^"]*?)"#i', $html_site, $xmathc);
                                if(isset($xmathc[1][0]))
                                {
                                    $first_chapter = $xmathc[1][0];
                                }
                                if(empty($first_chapter))
                                {
                                    preg_match_all('#<a class="btn btn-danger btn-read-now" title="READ NOW"[\s\n]*?href="([^"]*?)">#i', $html_site, $xmathc);
                                    if(isset($xmathc[1][0]))
                                    {
                                        $first_chapter = $xmathc[1][0];
                                    }
                                }
                            }
                            if(empty($first_chapter))
                            {
                                if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                    ums_log_to_file('Skipping web novel (because first chapter URL was not detected): ' . print_r($post_args, true));
                                }
                                continue;
                            }
                            $local_imported = 0;
                            $new_chap = false;
                            {
                                $chapid = 1;
                                while(!empty($first_chapter))
                                {
                                    $randsleep = rand(500,1000);
                                    usleep($randsleep * 1000);
                                    if($ums_max_chapters <= $local_imported)
                                    {
                                        break;
                                    }
                                    if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                        ums_log_to_file('Processing novel chapter: ' . $first_chapter);
                                    }
                                    $page_html = ums_get_web_page($first_chapter, ums_get_random_user_agent(), $use_phantom, $phantom_wait);
                                    if( $page_html == false ){
                                        ums_log_to_file('Failed to download HTML for current chapter: ' . $first_chapter);
                                        break;;
                                    }
                                    if(stristr($page_html, 'Cloudflare Ray ID:') !== false)
                                    {
                                        ums_log_to_file('CloudFlare protection active on chapter, access is limited! Please install puppeteer on your site and set the "Content Scraping Method To Use" to Puppeteer for scraping to work. Chapter URL: ' . $chaps['url']);
                                        sleep(1);
                                        break;
                                    }
                                    $html = ums_str_get_html( $page_html );
                                    if( empty( $html ) ){
                                        ums_log_to_file('Failed to parse HTML for current chapter: ' . $first_chapter);
                                        break;
                                    }
                                    $chapid++;
                                    $ntitle = '';
                                    preg_match_all('#<a class="chr-title" href="[^"]*?" title="([^"]*?)">#i', $page_html, $titli);
                                    if(isset($titli[1][0]))
                                    {
                                        $ntitle = $titli[1][0];
                                    }
                                    else
                                    {
                                        preg_match_all('#const chapterInfo = "([^"]*?)"#i', $page_html, $titli);
                                        if(isset($titli[1][0]))
                                        {
                                            $ntitle = $titli[1][0];
                                        }
                                    }
                                    $slugified_name = $wp_manga_storage->slugify( $ntitle );
                                    $chapter_2 = $wp_manga_chapter->get_chapter_by_slug( $existing_post_id, $slugified_name );
                                    if($chapter_2 && strtolower($chapter_2['chapter_slug']) == strtolower($slugified_name))
                                    {
                                        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                            ums_log_to_file('Chapter is already published, skipping it: ' . $chapter_2['chapter_name']);
                                        }
                                        preg_match_all('#title="[^"]*?"[\s\n]*href="([^"]*?)"[\s\n]*?class="btn btn-success"[\s\n]*id="next_chap">#i', $page_html, $titli);
                                        if(isset($titli[1][0]) && !ums_str_ends_with( $titli[1][0], 'null' ))
                                        {
                                            $first_chapter = $titli[1][0];
                                            update_post_meta($existing_post_id, 'ums_latest_scraped', $first_chapter);
                                        }
                                        else
                                        {
                                            $first_chapter = '';
                                        }
                                        continue;
                                    }
                                    $content = '';
                                    $doc = new DOMDocument;
                                    $internalErrors = libxml_use_internal_errors(true);
                                    $doc->loadHTML('<?xml encoding="utf-8" ?>' . $page_html);
                                    libxml_use_internal_errors($internalErrors);
                                    $xpath = new \DOMXpath($doc);
                                    $articles = $xpath->query('//*[contains(@class, "chr-c")]');
                                    if($articles !== false && count($articles) > 0)
                                    {
                                        foreach($articles as $container) 
                                        {
                                            if(method_exists($container, 'saveHTML'))
                                            {
                                                $content .= ' ' . $container->saveHTML();
                                            }
                                            elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                            {
                                                $content .= ' ' . $container->ownerDocument->saveHTML($container);
                                            }
                                            elseif(isset($container->nodeValue))
                                            {
                                                $content .= ' ' . $container->nodeValue;
                                            }
                                            break;
                                        }
                                    }
                                    if(empty($content)) 
                                    {
                                        $articles = $xpath->query('//*[contains(@class, "content-body")]');
                                        if($articles !== false && count($articles) > 0)
                                        {
                                            foreach($articles as $container) 
                                            {
                                                if(method_exists($container, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->saveHTML();
                                                }
                                                elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->ownerDocument->saveHTML($container);
                                                }
                                                elseif(isset($container->nodeValue))
                                                {
                                                    $content .= ' ' . $container->nodeValue;
                                                }
                                            }
                                        }
                                    }
                                    // FanMTL / ReadWN specific selector - div.chapter-content
                                    if(empty($content)) 
                                    {
                                        $articles = $xpath->query('//div[contains(@class, "chapter-content")]');
                                        if($articles !== false && count($articles) > 0)
                                        {
                                            foreach($articles as $container) 
                                            {
                                                if(method_exists($container, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->saveHTML();
                                                }
                                                elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->ownerDocument->saveHTML($container);
                                                }
                                                elseif(isset($container->nodeValue))
                                                {
                                                    $content .= ' ' . $container->nodeValue;
                                                }
                                            }
                                        }
                                    }
                                    if(empty($content)) 
                                    {
                                        $articles = $xpath->query('//*[contains(@class, "cha-tit")]');
                                        if($articles !== false && count($articles) > 0)
                                        {
                                            foreach($articles as $container) 
                                            {
                                                if(method_exists($container, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->saveHTML();
                                                }
                                                elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->ownerDocument->saveHTML($container);
                                                }
                                                elseif(isset($container->nodeValue))
                                                {
                                                    $content .= ' ' . $container->nodeValue;
                                                }
                                            }
                                        }
                                        $articles = $xpath->query('//*[contains(@class, "cha-content")]');
                                        if($articles !== false && count($articles) > 0)
                                        {
                                            foreach($articles as $container) 
                                            {
                                                if(method_exists($container, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->saveHTML();
                                                }
                                                elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->ownerDocument->saveHTML($container);
                                                }
                                                elseif(isset($container->nodeValue))
                                                {
                                                    $content .= ' ' . $container->nodeValue;
                                                }
                                            }
                                        }
                                    }
                                    if(empty($content)) 
                                    {
                                        $ccontent = $html->find('.reading-content .text-left .cha-words .cha-words');
                                        if($ccontent) 
                                        {
                                            $content = '';
                                            foreach($ccontent as $xct)
                                            {
                                                $other_ps = $xct->find('p');
                                                if(count($other_ps) > 0)
                                                {
                                                    $text = '';
                                                    foreach($other_ps as $p)
                                                    {
                                                        $text .= '<p> ' . $p->plaintext . '</p>';
                                                    }
                                                    $content .= $text . '<hr/>';
                                                } 
                                                else 
                                                {
                                                    $content .= $xct->innertext . '<hr/>';
                                                }
                                            }
                                        }
                                        else 
                                        {
                                            if($html->find('.reading-content #content', 0))
                                            {
                                                $content = $html->find('.reading-content #content', 0)->innertext;
                                            } 
                                            else 
                                            {
                                                $ccontent = $html->find('.reading-content .text-left .cha-content .cha-words');
                                                if($ccontent) 
                                                {
                                                    $content = '';
                                                    foreach($ccontent as $xct)
                                                    {
                                                        $content .= $xct->innertext . '<hr/>';
                                                    }
                                                } 
                                                else 
                                                {
                                                    $content = $html->find('.reading-content .text-left', 0);
                                                    if($content)
                                                    {
                                                        $other_ps = $content->find('p');
                                                        if(count($other_ps) > 0)
                                                        {
                                                            $text = '';
                                                            foreach($other_ps as $p)
                                                            {
                                                                $text .= '<p> ' . $p->plaintext . '</p>';
                                                            }
                                                            $content = $text;
                                                        } 
                                                        else 
                                                        {							
                                                            if($inner_content = $content->find('#chapter-content', 0))
                                                            {
                                                                $content = $inner_content->innertext;
                                                            }
                                                            else
                                                            {
                                                                if($inner_content = $content->find('.text-left', 0))
                                                                {
                                                                    $content = $inner_content->innertext;
                                                                }
                                                                else
                                                                {
                                                                    if($inner_content = $content->find('.fr-view', 0))
                                                                    {
                                                                        $content = $inner_content->innertext;
                                                                    }
                                                                    else
                                                                    {
                                                                        $content = $content->innertext;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                            if(!$content)
                                            {
                                                $content = '';
                                                $ps = $html->find('.reading-content .text-left p');
                                                foreach($ps as $p)
                                                {
                                                    $content .= '<p>' . $p->plaintext . '</p>';
                                                }
                                            }
                                        }
                                    }
                                    $content = preg_replace('#(?:my)?[.]?b[.\s]?o[.\s]?x[.\s]?n[.\s]?o[.\s]?v[.\s]?e[.\s]?l[.]?(?:\s?.c[o0]m)?#i', get_bloginfo('name'), $content);
                                    $content = preg_replace('#<p class="text-m">[\s\S]*?<strong>\$1<\/strong>![\s\S]*?<\/p>#i', '', $content);
                                    $content = preg_replace('#<i class="glyphicon glyphicon-remove"><\/i> Remove Ads From \$1#i', '', $content);
                                    $content = preg_replace('#<button[\S\s]*?<\/button>#i', '', $content);
                                    $content = str_ireplace('novlove.com', get_bloginfo('name'), $content);
                                    $content = str_ireplace('nov love', get_bloginfo('name'), $content);
                                    $content = str_ireplace('novlove', get_bloginfo('name'), $content);
                                    $content = str_ireplace('Ads by PubFuture', '', $content);
                                    $qtags = array('iframe', 'script', 'ins');
                                    foreach ($qtags as $qtag) {
                                        $regex = '#<\s*' . $qtag . '[^>]*>.*?<\s*/\s*'. $qtag . '>#msi';
                                        $content = preg_replace($regex, '', $content);
                                    }
                                    $content = preg_replace('#<style([\s\S]+?)<\/style>#i', '', $content);
                                    $content = preg_replace('#<\/?div([^>]*)>#i', '', $content);
                                    $content = preg_replace("/\\\\u([0-9a-f]{3,4})/i", "&#x\\1;", $content);
                                    if($strip_images == '1')
                                    {
                                        $content = ums_sanitize_html_content($content);
                                    }
                                    $chapter_content = trim($content);
                                    $chapter_content = ums_strip_links($chapter_content);
                                    if($chapter_content == '')
                                    {
                                        
                                        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                            ums_log_to_file('Skipping current chapter (because it failed to parse first chapter content): ' . print_r($first_chapter, true));
                                        }
                                        //new_chap true to prevent infinite running
                                        $new_chap = true;
                                        break;
                                    }
                                    $arr = ums_spin_and_translate($ntitle, $chapter_content, $rule_translate, 'en');
                                    if($arr === false)
                                    {
                                        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                            ums_log_to_file('Skipping current chapter (because it failed to be translated): ' . print_r($first_chapter, true));
                                        }
                                    }
                                    elseif($no_translate_title != '1' && !empty($arr[0]) && !empty($arr[1]))
                                    {
                                        $ntitle = $arr[0];
                                        $chapter_content = $arr[1];
                                    }
                                    global $wp_manga_text_type;
                                    if(empty($ntitle))
                                    {
                                        $ntitle = 'Chapter';
                                    }
                                    if($ntitle == '')
                                    {
                                        $xext_name = $name_str;
                                    }
                                    else
                                    {
                                        $xext_name = '';
                                    }
                                    $chapter_args = array(
                                        'post_id'             => $existing_post_id,
                                        'chapter_name'        => $ntitle,
                                        'chapter_name_extend' => $xext_name,
                                        'volume_id'           => '',
                                        'chapter_content'     => $chapter_content,
                                    );
                                    $slugified_name = $wp_manga_storage->slugify( $ntitle );
                                    $chapter_2 = $wp_manga_chapter->get_chapter_by_slug( $existing_post_id, $slugified_name );
                                    if($chapter_2 && strtolower($chapter_2['chapter_slug']) == strtolower($slugified_name))
                                    {
                                        ums_log_to_file('Chapter name already published, we will skip: ' . $chapter_2['chapter_name']);
                                        preg_match_all('#title="[^"]*?"[\s\n]*href="([^"]*?)"[\s\n]*?class="btn btn-success"[\s\n]*id="next_chap">#i', $page_html, $titli);
                                        if(isset($titli[1][0]) && !ums_str_ends_with( $titli[1][0], 'null' ))
                                        {
                                            $first_chapter = $titli[1][0];
                                            update_post_meta($existing_post_id, 'ums_latest_scraped', $first_chapter);
                                        }
                                        else
                                        {
                                            $first_chapter = '';
                                        }
                                        continue; 
                                    }
                                    else
                                    {
                                        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                            ums_log_to_file('Now publishing: ' . print_r($ntitle, true));
                                        }
                                    }
                                    $chapter_id = $wp_manga_text_type->insert_chapter( $chapter_args );
                                    if( $chapter_id ){
                                        if( is_wp_error( $chapter_id ) ){
                                            ums_log_to_file('Failed to insert new chapter: ' . $ntitle . ' error: ' . $chapter_id->get_error_message());
                                            break;
                                        }
                                        else
                                        {
                                            $new_chap = true;
                                            $ums_imported_chapters++;
                                            $local_imported++;
                                        }
                                    }
                                    preg_match_all('#title="[^"]*?"[\s\n]*href="([^"]*?)"[\s\n]*?class="btn btn-success"[\s\n]*id="next_chap">#i', $page_html, $titli);
                                    if(isset($titli[1][0]) && !ums_str_ends_with( $titli[1][0], 'null' ))
                                    {
                                        $first_chapter = $titli[1][0];
                                        update_post_meta($existing_post_id, 'ums_latest_scraped', $first_chapter);
                                    }
                                    else
                                    {
                                        $first_chapter = '';
                                    }
                                    if (isset($ums_Main_Settings['request_timeout']) && $ums_Main_Settings['request_timeout'] != '') {
                                        $timeout = intval($ums_Main_Settings['request_timeout']);
                                    } else {
                                        $timeout = 1;
                                    }
                                    sleep($timeout);
                                }
                            }
                            if($new_chap == true)
                            {
                                if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                    ums_log_to_file('Total novel chapters scraped: ' . $local_imported);
                                }
                                $scraped_manga++;
                            }                            
                        }
                    }
                    catch(Exception $e)
                    {
                        ums_log_to_file('Importing failed: ' . $e->getMessage());
                        if($auto == 1)
                        {
                            ums_clearFromList($param, $type);
                        }
                        return 'fail';
                    }
                }
            }
            elseif($type == 3)
            {
                if(trim($max_manga) != '')
                {
                    $get_max_manga = intval(trim($max_manga));
                }
                else
                {
                    $get_max_manga = 999;
                }
                $items = array();
                $page_increased = false;
                {
                    $manga_arr = array();
                    try
                    {
                        global $wp_filesystem;
                        if ( ! is_a( $wp_filesystem, 'WP_Filesystem_Base') ){
                            include_once(ABSPATH . 'wp-admin/includes/file.php');$creds = request_filesystem_credentials( site_url() );
                            wp_filesystem($creds);
                        }
                        $prefixh = 'http://newnovel.org/novel/';
                        $wprefixh = 'http://www.newnovel.org/novel/';
                        $prefixs = 'https://newnovel.org/novel/';
                        $wprefixs = 'https://www.newnovel.org/novel/';
                        $prefixh2 = 'http://vipnovel.com/vipnovel/';
                        $wprefixh2 = 'http://www.vipnovel.com/vipnovel/';
                        $prefixs2 = 'https://vipnovel.com/vipnovel/';
                        $wprefixs2 = 'https://www.vipnovel.com/vipnovel/';
                        $manga_names = explode(',', $manga_name);
                        $manga_names = array_map('trim', $manga_names);
                        foreach($manga_names as $mngn)
                        {
                            if (substr($mngn, 0, strlen($prefixs)) == $prefixs) {
                                $manga_arr[] = $mngn;
                            }
                            elseif (substr($mngn, 0, strlen($prefixh)) == $prefixh) {
                                $manga_arr[] = $mngn;
                            }
                            elseif (substr($mngn, 0, strlen($wprefixh)) == $wprefixh) {
                                $manga_arr[] = $mngn;
                            }
                            elseif (substr($mngn, 0, strlen($wprefixs)) == $wprefixs) {
                                $manga_arr[] = $mngn;
                            }
                            elseif (substr($mngn, 0, strlen($prefixs2)) == $prefixs2) {
                                $mngn = str_replace('vipnovel.com/vipnovel', 'newnovel.org/novel', $mngn);
                                $manga_arr[] = $mngn;
                            }
                            elseif (substr($mngn, 0, strlen($prefixh2)) == $prefixh2) {
                                $mngn = str_replace('vipnovel.com/vipnovel', 'newnovel.org/novel', $mngn);
                                $manga_arr[] = $mngn;
                            }
                            elseif (substr($mngn, 0, strlen($wprefixh2)) == $wprefixh2) {
                                $mngn = str_replace('vipnovel.com/vipnovel', 'newnovel.org/novel', $mngn);
                                $manga_arr[] = $mngn;
                            }
                            elseif (substr($mngn, 0, strlen($wprefixs2)) == $wprefixs2) {
                                $mngn = str_replace('vipnovel.com/vipnovel', 'newnovel.org/novel', $mngn);
                                $manga_arr[] = $mngn;
                            }
                            else
                            {
                                if($wp_filesystem->exists(dirname(__FILE__) . "/sitemap_vip.txt"))
                                {
                                    $handle = fopen(dirname(__FILE__) . "/sitemap_vip.txt", "r");
                                    if ($handle)
                                    {
                                        while (!feof($handle))
                                        {
                                            $buffer = fgets($handle);
                                            if($buffer !== false)
                                            {
                                                if($mngn == '*')
                                                {
                                                    $manga_arr[] = 'https://newnovel.org/novel/' . trim($buffer) . '/';
                                                }
                                                else
                                                {
                                                    $xbuffer = str_replace('-', ' ', $buffer);
                                                    $mngnwords = explode(' ', $mngn);
                                                    $xbuffer_arr = explode(' ', $xbuffer);
                                                    foreach($mngnwords as $mangx)
                                                    {
                                                        $mangx = trim($mangx);
                                                        $xfound = false;
                                                        foreach($xbuffer_arr as $xbf)
                                                        {
                                                            $xbf = trim($xbf);
                                                            if($xbf == $mangx)
                                                            {
                                                                $xfound = true;
                                                            }
                                                        }
                                                        if($xfound == true)
                                                        {
                                                            $manga_arr[] = 'https://newnovel.org/novel/' . trim($buffer) . '/';
                                                            break;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        fclose($handle);
                                    }
                                }
                                else
                                {
                                    ums_log_to_file('Only URLs from https://newnovel.org/novel/ are allowed, because sitemap file failed to be opened, skipping: ' . $mngn);
                                    continue;
                                }
                            }
                        }
                        if(count($manga_arr) == 0)
                        {
                            ums_log_to_file('No Web Novel matched your query: ' . $manga_name);
                            return 'nochange';
                        }
                        $scraped_manga = 0;
                        foreach($manga_arr as $current_manga)
                        {
                            if($get_max_manga <= $scraped_manga)
                            {
                                break;
                            }
                            $current_manga = trim($current_manga, '/');
                            $current_manga = $current_manga . '/';
                            $html_site = ums_get_web_page($current_manga, ums_get_random_user_agent(), $use_phantom, $phantom_wait);
                            if($html_site == false)
                            {
                                ums_log_to_file('Failed to download manga chapter: ' . $current_manga);
                                continue;
                            }
                            if(stristr($html_site, 'Cloudflare Ray ID:') !== false)
                            {
                                ums_log_to_file('CloudFlare protection active on newnovel.org, access is limited! Please install puppeteer on your site and set the "Content Scraping Method To Use" to Puppeteer for scraping to work. Manga URL: ' . $current_manga);
                                sleep(1);
                                continue;
                            }
                            if(stristr($html_site, 'manga-title-badges custom comic') !== false)
                            {
                                ums_log_to_file('This URL is a web comic, not a web novel, skipping it: ' . $current_manga);
                                continue;
                            }
                            if (isset($ums_Main_Settings['request_timeout']) && $ums_Main_Settings['request_timeout'] != '') {
                                $timeout = intval($ums_Main_Settings['request_timeout']);
                            } else {
                                $timeout = 1;
                            }
                            sleep($timeout);
                            require_once (dirname(__FILE__) . "/res/simple_html_dom.php"); 
                            $html = ums_str_get_html( $html_site );
                            $tag = $html->find( '.profile-manga .post-title h1', 0 );
                            $name_str = '';
                            $my_slug = '';
                            $my_slug = str_replace( 'http://', '', $current_manga );
                            $my_slug = str_replace( 'https://', '', $my_slug );
                            $my_slug = str_replace( 'http:', '', $my_slug );
                            $my_slug = str_replace( 'newnovel.org/novel/', '', $my_slug );
                            $my_slug = str_replace( '/', '', $my_slug );
                            $my_slug = str_replace( '.html', '', $my_slug );
                            $my_slug = str_replace( '.htm', '', $my_slug );
                            if($tag){
                                $name_str = trim($tag->plaintext);
                                $span = $tag->find('span', 0);
                                if($span){
                                    $name_str = trim(str_replace($span->plaintext,'', $name_str));
                                }
                            }
                            if($name_str == '')
                            {
                                preg_match_all('#<title>([^<]*?) - NewNovel<\/title>#i', $html_site, $tmathc);
                                if(isset($tmathc[1][0]))
                                {
                                    $name_str = $tmathc[1][0];
                                }
                            }
                            if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                ums_log_to_file('Processing novel: ' . $name_str);
                            }
                            $find_post = new WP_Query( array(
                                'title'     => $name_str,
                                'post_type' => 'wp-manga',
                            ) );
                            $existing_post_id = false;
                            if( $find_post->have_posts() )
                            {
                                $existing_post_id = $find_post->posts[0]->ID;
                            }
                            if($existing_post_id == false)
                            {
                                $args = array(
                                    'post_type'  => 'wp-manga',
                                    'meta_key'   => '_manga_import_slug',
                                    'meta_value' => $my_slug,
                                    'post_status' => array('publish','draft','pending','trash','private','future')
                                );
                                $query = new WP_Query( $args );
                                if( $query->have_posts() ){
                                    $existing_post_id = $query->posts[0]->ID;
                                }
                            }
                            if($existing_post_id == false)
                            {
                                $block_warning = $html->find('#page .warning', 0);
                                if( !empty( $block_warning ) && strpos( $block_warning->plaintext, 'has been licensed, it is not available' ) !== false ){
                                    ums_log_to_file('Request blocked, please use a proxy!');
                                    continue;
                                }
                                $desc = $html->find( '.description-summary' );
                                $xd = '';
                                if(is_array($desc))
                                {
                                    foreach($desc as $dd)
                                    {
                                        $xd = trim($dd->plaintext);
                                        $xprefix = 'Description';
                                        if (substr($xd, 0, strlen($xprefix)) == $xprefix) {
                                            $xd = substr($xd, strlen($xprefix));
                                        } 
                                        $xd = trim($xd);
                                    }
                                }
                                if($xd == '')
                                {
                                    $desc = '';
                                }
                                else
                                {
                                    $desc = $xd;
                                }
                                $desc = preg_replace('#(?:my)?[.]?v[.\s]?i[.\s]?p[.\s]?n[.\s]?o[.\s]?v[.\s]?e[.\s]?l[.]?(?:\s?.c[o0]m)?#i', get_bloginfo('name'), $desc);
                                $desc = str_ireplace('newnovel.org', get_bloginfo('name'),$desc);
                                $desc = str_ireplace('newnovel', get_bloginfo('name'), $desc);
                                $thumb = $html->find( '.summary_image .img-responsive' );
                                $thumb = !empty( $thumb ) ? $thumb[0]->src : '';
                                if($thumb == '')
                                {
                                    $thumb = $html->find( '.summary_image' );
                                    $thumb = !empty( $thumb ) ? $thumb[0]->src : '';
                                }
                                $stx = '';
                                $status = $html->find( '.post-status .post-content_item' );
                                if(is_array($status))
                                {
                                    foreach($status as $st)
                                    {
                                        $temp_stat = $st->plaintext;
                                        if(stristr($temp_stat, 'status') !== false)
                                        {
                                            $stx = $temp_stat;
                                        }
                                    }
                                }
                                if($stx === '')
                                {
                                    $status = '';
                                }
                                else
                                {
                                    $status = $stx;
                                }
                                if(stristr($status, 'ongoing') !== false)
                                {
                                    $status = 'on-going';
                                }
                                elseif(stristr($status, 'completed') !== false)
                                {
                                    $status = 'end';
                                }
                                elseif(stristr($status, 'canceled') !== false)
                                {
                                    $status = 'canceled';
                                }
                                elseif(stristr($status, 'on hold') !== false)
                                {
                                    $status = 'on-hold';
                                }
                                elseif(stristr($status, 'upcoming') !== false)
                                {
                                    $status = 'upcoming';
                                }
                                $alter_name = $html->find( '.summary_content .post-content .post-content_item' );
                                $xplain = '';
                                if( !empty( $alter_name ) )
                                {
                                    foreach($alter_name as $an)
                                    {
                                        if(stristr($an->plaintext, 'Alternative '))
                                        {
                                            $xplain = trim($an->plaintext);
                                            $xprefix = 'Alternative';
                                            if (substr($xplain, 0, strlen($xprefix)) == $xprefix) {
                                                $xplain = substr($xplain, strlen($xprefix));
                                            } 
                                            $xplain = trim($xplain);
                                        }
                                    }
                                }
                                if($xplain != '')
                                {
                                    $alter_name = $xplain;
                                }
                                else
                                {
                                    $alter_name = '';
                                }
                                $data = $html->find( '.summary_content .post-content .post-content_item' );
                                $xtype = '';
                                if( !empty( $data ) ){
                                    foreach($data as $item){
                                        if(trim($item->find('.summary-heading h5',0)->plaintext) == 'Type'){
                                            $xtype = $item->find('.summary-content', 0)->plaintext;
                                            if(trim($xtype) == 'Updating')
                                            {
                                                $xtype = '';
                                            }
                                        }
                                    }
                                }
                                $xrelease = '2021';
                                preg_match_all('#<a href="https:\/\/newnovel\.org\/(?:manga-)?release\/(?:[^"]*?)" rel="tag">([^<]+?)<\/a>#i', $html_site, $xmathc);
                                if(isset($xmathc[1][0]))
                                {
                                    $xrelease = trim($xmathc[1][0]);
                                }
                                $xauthor = '';
                                $author = '';
                                $data = $html->find( '.author-content a' );
                                if( !empty( $data ) ){
                                    $authors = array();
                                    foreach($data as $arxthor)
                                    {
                                        array_push($authors, $arxthor->plaintext);
                                        if($author == '')
                                        {
                                            $author = $arxthor->plaintext;
                                        }
                                    }
                                    $xauthor = implode(',', $authors);
                                }

                                $xartists = '';
                                $data = $html->find( '.artist-content a' );
                                if( !empty( $data ) ){
                                    $artists = array();
                                    foreach($data as $artist){
                                        array_push($artists, $artist->plaintext);
                                    }
                                    $xartists = implode(',', $artists);
                                }
                                $xgenres = '';
                                $data = $html->find( '.genres-content a' );
                                if( !empty( $data ) ){
                                    $genres = array();
                                    foreach($data as $genre){
                                        array_push($genres, $genre->plaintext);
                                    }
                                    $xgenres = implode(',', $genres);
                                }
                                $items = $html->find('.summary_content .post-content .post-content_item');
                                $views = '';
                                foreach($items as $item){
                                    if(trim($item->find('.summary-heading', 0)->plaintext) == 'Rank'){
                                        $str = $item->find('.summary-content',0)->plaintext;
                                        preg_match_all('~\d+(?:\.\d+)?~', $str, $matches);
                                        if($matches){
                                            if(count($matches) == 3){
                                                $views = $matches[0][1];
                                            } else {
                                                $views = $matches[0][0];
                                            }
                                            if(strpos($str, 'K monthly views') !== false){
                                                $views = floatval($views) * 1000;
                                            }
                                            if(strpos($str, 'M monthly views') !== false){
                                                $views = floatval($views) * 1000000;
                                            }
                                            break;
                                        }
                                    }
                                }
                                if(empty(trim($views)) || !is_numeric(strip_tags( $views  )))
                                {
                                    $viewsm = rand(100,500);
                                }
                                else
                                {
                                    $viewsm = strip_tags(trim($views));
                                }
                                $average_vote = $html->find('.post-total-rating .total_votes', 0);
                                $str = $html->find('.vote-details',0);
                                $xrating = array();
                                if(!empty($str))
                                {
                                    preg_match_all('!\d+!', $str, $matches);
                                    $number_votes = 1;
                                    if($matches && count($matches[0]) == 3)
                                    {
                                        $number_votes = $matches[0][2];
                                    }
                                    if( !empty( $average_vote ) && $average_vote->plaintext > 0 ){
                                        $xrating = array(
                                            'avg'     => $average_vote->plaintext,
                                            'numbers' => $number_votes
                                        );
                                    }
                                }
                                $xtags = '';
                                $data = $html->find( '.tags-content a' );
                                if( !empty( $data ) ){
                                    $tags = array();
                                    foreach($data as $tag){
                                        $ttext = trim($tag->plaintext);
                                        $ttext = preg_replace('#(?:my)?[.]?v[.\s]?i[.\s]?p[.\s]?n[.\s]?o[.\s]?v[.\s]?e[.\s]?l[.]?(?:\s?.c[o0]m)?#i', get_bloginfo('name'), $ttext);
                                        $ttext = str_ireplace('newnovel', get_bloginfo('name'), $ttext);
                                        $ttext = str_ireplace('new novel', get_bloginfo('name'), $ttext);
                                        array_push($tags, $ttext);
                                    }
                                    $xtags = implode(',', $tags);
                                }
                                $xtime_year = '';
                                $time_year = strtotime($xrelease);
                                if($time_year !== false)
                                {
                                    $time_year = date("Y", $time_year);
                                    if($time_year !== false)
                                    {
                                        $xtime_year = $time_year;
                                    }
                                }
                                $post_args = array(
                                    'manga_import_slug' => $my_slug,
                                    'title'             => $name_str,
                                    'post_status'       => $post_status,
                                    'description'       => $desc,
                                    'thumb'             => $thumb,
                                    'status'            => $status,
                                    'altername'         => strip_tags( $alter_name ),
                                    'type'              => strip_tags( $xtype ),
                                    'release'           => $xtime_year,
                                    'authors'           => strip_tags( $xauthor ),
                                    'artists'           => strip_tags( $xartists ),
                                );
                                $post_args['genres'] = '';
                                if($auto_categories == 'genre')
                                {
                                    $post_args['genres'] = strip_tags( $xgenres );
                                }
                                if($default_category != '')
                                {
                                    if($post_args['genres'] != '')
                                    {
                                        $post_args['genres'] .= ',';
                                    }
                                    $genreplus = get_term_by('id', $default_category, 'wp-manga-genre');
                                    if($genreplus !== false)
                                    {
                                        $post_args['genres'] .= $genreplus->slug;
                                    }
                                }
                                $post_args['views'] = strip_tags( $viewsm  );
                                $post_args['ratings'] = $xrating;
                                if($can_create_tag == 'genre')
                                {
                                    $post_args['tags'] = strip_tags( $xgenres );
                                }
                                elseif($can_create_tag == 'tags')
                                {
                                    $post_args['tags'] = strip_tags( $xtags );
                                }
                                else
                                {
                                    $post_args['tags'] = '';
                                }
                                if($item_create_tag != '')
                                {
                                    $ctag = explode(',', $item_create_tag);
                                    foreach($ctag as $ctap)
                                    {
                                        $ctap = trim($ctap);
                                        if($post_args['tags'] != '')
                                        {
                                            $post_args['tags'] .= ',';
                                        }
                                        $genreplus = get_term_by('name', $ctap, 'wp-manga-tag');
                                        if($genreplus !== false)
                                        {
                                            $post_args['tags'] .= $genreplus->slug;
                                        }
                                        else
                                        {
                                            $cat = wp_insert_term($ctap, 'wp-manga-tag');
                                            if(!is_wp_error( $cat ))
                                            {
                                                $post_args['tags'] .= $cat['slug'];
                                            }
                                        }
                                    }
                                }
                                $post_args['description'] = str_ireplace('newnovel.org', $_SERVER['HTTP_HOST'], $post_args['description']);
                                $arr = ums_spin_and_translate($post_args['title'], $post_args['description'], $rule_translate, 'en');
                                if($arr === false)
                                {
                                    if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                        ums_log_to_file('Skipping web novel (because it failed to be translated): ' . print_r($post_args, true));
                                    }
                                    continue;
                                }
                                else
                                {
                                    if($no_translate_title != '1')
                                    {
                                        $post_args['title']              = $arr[0];
                                    }
                                    $post_args['description']        = $arr[1];
                                }
                                $za_xpost_args = array(
                                    'post_title'   => !empty( $post_args['title'] ) ? $post_args['title'] : '',
                                    'post_content' => !empty( $post_args['description'] ) ? $post_args['description'] : '',
                                    'post_type'    => 'wp-manga',
                                    'post_status'  => isset( $post_args['post_status'] ) ? $post_args['post_status'] : 'pending',
                                );
                                $existing_again = false;
                                if($za_xpost_args['post_title'] != '')
                                {
                                    $xposts = get_posts(
                                        array(
                                            'post_type'              => 'wp-manga',
                                            'title'                  => html_entity_decode($za_xpost_args['post_title']),
                                            'post_status'            => 'all',
                                            'numberposts'            => 1,
                                            'update_post_term_cache' => false,
                                            'update_post_meta_cache' => false,           
                                            'orderby'                => 'post_date ID',
                                            'order'                  => 'ASC',
                                        )
                                    );
                                    if ( ! empty( $xposts ) ) {
                                        $ex_page = $xposts[0];
                                    } else {
                                        $ex_page = null;
                                    }
                                    if(isset($ex_page->ID))
                                    {
                                        $existing_again = true;
                                        $existing_post_id = $ex_page->ID;
                                    }
                                }
                                if($existing_again == false)
                                {
                                    $accept_comments = 'closed';
                                    if ($enable_comments == '1') {
                                        $accept_comments = 'open';
                                    }
                                    $za_xpost_args['comment_status'] = $accept_comments;
                                    if ($enable_pingback == '1') 
                                    {
                                        $za_xpost_args['ping_status'] = 'open';
                                    } 
                                    else 
                                    {
                                        $za_xpost_args['ping_status'] = 'closed';
                                    }
                                    if($get_date == '1')
                                    {
                                        if(!empty($xrelease))
                                        {
                                            if(strlen($xrelease) == 4)
                                            {
                                                $xrelease .= '-01-01 00:00';
                                            }
                                            $postdatex = gmdate("Y-m-d H:i:s", strtotime($xrelease));
                                            $za_xpost_args['post_date_gmt'] = $postdatex;
                                        }
                                    }
                                    if($user_name_type == 'rand')
                                    {
                                        $randid = ums_display_random_user();
                                        if($randid === false)
                                        {
                                            $za_xpost_args['post_author']               = ums_randomName();
                                        }
                                        else
                                        {
                                            $za_xpost_args['post_author']               = $randid->ID;
                                        }
                                    }
                                    elseif($user_name_type == 'feed-news')
                                    {
                                        $sp_post_user_name = ums_randomName();
                                        if($author == '' || $author == '1' || $author == 'null')
                                        {
                                            $author = ums_randomName();
                                        }
                                        if($author != '')
                                        {
                                            $xauthor = sanitize_user( $author );
                                            $xauthor = apply_filters( 'pre_user_login', $xauthor );
                                            $xauthor = trim( $xauthor );
                                            if(username_exists( $xauthor ))
                                            {
                                                $user_id_t = get_user_by('login', $xauthor);
                                                if($user_id_t)
                                                {
                                                    $sp_post_user_name = $user_id_t->ID;
                                                }
                                            }
                                            else
                                            {
                                                $palphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^*()-+=_?><,.;:}{][';
                                                $ppass = '';
                                                $alphaLength = strlen($palphabet) - 1;
                                                for ($ipass = 0; $ipass < 8; $ipass++) 
                                                {
                                                    $npass = rand(0, $alphaLength);
                                                    $ppass .= $palphabet[$npass];
                                                }
                                                $curr_id = wp_create_user($xauthor, $ppass, ums_generate_random_email());
                                                if ( is_int($curr_id) )
                                                {
                                                    $u = new WP_User($curr_id);
                                                    $u->remove_role('subscriber');
                                                    $u->add_role('author');
                                                    $sp_post_user_name               = $curr_id;
                                                }
                                            }
                                        }
                                        $za_xpost_args['post_author']               = ums_utf8_encode($sp_post_user_name);
                                    }
                                    else
                                    {
                                        $za_xpost_args['post_author']               = ums_utf8_encode($post_user_name);
                                    }
                                    
                                    if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                        ums_log_to_file('Inserting new novel: ' . $za_xpost_args['post_title']);
                                    }
                                    $existing_post_id = wp_insert_post( $za_xpost_args );
                                    if( ! $existing_post_id || is_wp_error( $existing_post_id ) ){
                                        ums_log_to_file('Failed to insert novel into db: ' . $post_args['title']);
                                        continue;
                                    }
                                    add_post_meta($existing_post_id, 'ums_parent_rule', $type . '-' . $param);
                                    wp_set_object_terms( $existing_post_id, 'Ums_' . $type . '_' . $param, 'coderevolution_post_source', true);
                                    if($thumb != '')
                                    {
                                        $thumb_id = ums_wp_mcl_e_upload_file( $post_args['thumb'], $use_phantom, $phantom_wait, $existing_post_id );
                                        if($thumb_id === false)
                                        {
                                            include_once( ABSPATH . 'wp-admin/includes/image.php' );
                                            $thcontent = ums_get_web_page($thumb);
                                            if (isset($ums_Main_Settings['request_timeout']) && $ums_Main_Settings['request_timeout'] != '') {
                                                $timeout = intval($ums_Main_Settings['request_timeout']);
                                            } else {
                                                $timeout = 1;
                                            }
                                            sleep($timeout);
                                            $pathinfo = pathinfo( $thumb );
                                            if( $thcontent != false ){
                                                $upload_dir = wp_upload_dir();
                                                $file_tmp_path = $upload_dir['basedir'] . '/' . $pathinfo['filename'] . '-' . $existing_post_id . '.' . explode('?',$pathinfo['extension'])[0];
                                                $file = $wp_filesystem->put_contents( $file_tmp_path, $thcontent );
                                                $wp_filetype = wp_check_filetype(basename($file_tmp_path), null );
                                                $attachment = array(
                                                    'post_mime_type' => $wp_filetype['type'],
                                                    'post_title' => $existing_post_id,
                                                    'post_content' => '',
                                                    'post_status' => 'inherit'
                                                );
                                                $attach_id = wp_insert_attachment( $attachment, $file_tmp_path );
                                                $thumb_id = $attach_id;
                                                $imagenew = get_post( $attach_id );
                                                $fullsizepath = get_attached_file( $imagenew->ID );
                                                require_once( ABSPATH . 'wp-admin/includes/image.php' );
                                                require_once( ABSPATH . 'wp-admin/includes/media.php' );
                                                $attach_data = wp_generate_attachment_metadata( $attach_id, $fullsizepath );
                                                wp_update_attachment_metadata( $attach_id, $attach_data );
                                            }
                                        }
                                    }
                                    else
                                    {
                                        $thumb_id = false;
                                    }
                                    $meta_data = array(
                                        '_manga_import_slug'     => $my_slug,
                                        '_thumbnail_id'          => $thumb_id,
                                        '_wp_manga_alternative'  => strip_tags( $alter_name ),
                                        '_wp_manga_type'         => strip_tags( $xtype ),
                                        '_wp_manga_status'       => $status,
                                        '_wp_manga_chapter_type' => 'text',
                                        '_wp_manga_chapters_warning'=> $chapter_warning,
                                    );
                                    foreach( $meta_data as $key => $value ){
                                        if( !empty( $value ) ){
                                            update_post_meta( $existing_post_id, $key, $value );
                                        }
                                    }
                                    $manga_terms = array(
                                        'wp-manga-release'     => strip_tags( $xrelease ),
                                        'wp-manga-author'      => strip_tags( $xauthor ),
                                        'wp-manga-artist'      => strip_tags( $xartists ),
                                        'wp-manga-genre'       => isset( $post_args['genres'] ) ? $post_args['genres'] : '',
                                        'wp-manga-tag'         => isset( $post_args['tags'] ) ? $post_args['tags'] : null,
                                    );
                                    foreach( $manga_terms as $tax => $term ){
                                        $resp = ums_add_manga_terms( $existing_post_id, $term, $tax );
                                    }
                                    ums_update_post_views( $existing_post_id, strip_tags( $viewsm ) );
                                    ums_update_post_ratings( $existing_post_id, $xrating );
                                }
                            }

                            $find_chapters  = $html->find('.listing-chapters_wrap li');
                            $output = array();
                            $current_vol = 'NO-VOLUME';
                            $chapters = array();
                            foreach( $find_chapters as $chapter )
                            {
                                $full_chapter_name = trim(preg_replace('/\t+/', '', $chapter->find('a',0)->plaintext));
                                $chapter_extend_name = '';
                                $names = explode(' - ', $full_chapter_name);
                                $chapter_name = $full_chapter_name;
                                if(count($names) == 2){
                                    $chapter_extend_name = $names[1];
                                    $chapter_name = $names[0];
                                }
                                $chapters[] = array(
                                    'name'        => $chapter_name,
                                    'extend_name' => $chapter_extend_name,
                                    'url'         => $chapter->find('a',0)->href
                                );
                            }
                            $lazy_loaded = false;
                            if(count($chapters) == 0)
                            {
                                $latest_scraped = get_post_meta( $existing_post_id, 'ums_latest_scraped', true );
                                $latest_scraped = str_replace('vipnovel.com/vipnovel', 'newnovel.org/novel', $latest_scraped);
                                if(!empty($latest_scraped))
                                {
                                    if(!stristr($latest_scraped, 'newnovel'))
                                    {
                                        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                            ums_log_to_file('Skipping, already scraped from another source: ' . $za_xpost_args['post_title'] . ' (' . $latest_scraped . ')');
                                        }
                                        continue;
                                    }
                                    $chap_url = $latest_scraped;
                                }
                                else
                                {
                                    if($chapter_slug != '')
                                    {
                                        $chap_url = $current_manga . $chapter_slug . '/';
                                    }
                                    else
                                    {
                                        $chap_url = $current_manga . 'chapter-1/';
                                    }
                                }
                                $lazy_loaded = true;
                                preg_match_all('#\/chapter-([^/]*?)\/#i', $chap_url, $chnamje);
                                if(isset($chnamje[1][0]))
                                {
                                    $chap_name = 'Chapter ' . $chnamje[1][0];
                                }
                                else
                                {
                                    $chap_name = 'Chapter ' . rand();
                                }
                                $chapters[] = array(
                                    'name'        => $chap_name,
                                    'url'         => $chap_url
                                );
                            }
                            $ums_max_chapters = $max;
                            if($reverse_chapters == '1')
                            {
                                $reverse = true;
                            }
                            else
                            {
                                $reverse = false;
                            }
                            if($reverse == true)
                            {
                                $chapters = array_reverse($chapters);
                            }
                            $local_imported = 0;
                            $new_chap = false;
                            if($lazy_loaded == true)
                            {
                                $chapid = 1;
                                while(count($chapters) != 0)
                                {
                                    $randsleep = rand(500,1000);
                                    usleep($randsleep * 1000);
                                    $chaps = $chapters[0];
                                    if($ums_max_chapters <= $local_imported)
                                    {
                                        break;
                                    }
                                    if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                        ums_log_to_file('Processing novel chapter: ' . $chaps['url']);
                                    }
                                    $page_html = ums_get_web_page($chaps['url'], ums_get_random_user_agent(), $use_phantom, $phantom_wait);
                                    if( $page_html == false ){
                                        ums_log_to_file('Failed to download HTML for current chapter: ' . $chaps['name']);
                                        break;;
                                    }
                                    if(stristr($page_html, 'Cloudflare Ray ID:') !== false)
                                    {
                                        ums_log_to_file('CloudFlare protection active on chapter, access is limited! Please install puppeteer on your site and set the "Content Scraping Method To Use" to Puppeteer for scraping to work. Chapter URL: ' . $chaps['url']);
                                        sleep(1);
                                        break;
                                    }
                                    $html = ums_str_get_html( $page_html );
                                    if( empty( $html ) ){
                                        ums_log_to_file('Failed to parse HTML for current chapter: ' . $chaps['name']);
                                        break;
                                    }
                                    $chapid++;
                                    preg_match_all('#<div class="cha-tit skiptranslate">\s*<h3>([^<]*?)<\/h3>#i', $page_html, $titli);
                                    if(isset($titli[1][0]))
                                    {
                                        $chaps['name'] = $titli[1][0];
                                    }
                                    else
                                    {
                                        preg_match_all('#<li class="active">\s*?([^<]*?)\s*?<\/li>#i', $page_html, $titli);
                                        if(isset($titli[1][0]))
                                        {
                                            $chaps['name'] = $titli[1][0];
                                        }
                                    }
                                    preg_match_all('#<a\s*href="([^"]*?)"\s*class="btn next_page"#i', $page_html, $zurli);
                                    if(isset($zurli[1][0]))
                                    {
                                        $dummy_chap = array(
                                            'name'        => 'Chapter ' . $chapid,
                                            'url'         => $zurli[1][0]
                                        );
                                        update_post_meta($existing_post_id, 'ums_latest_scraped', $zurli[1][0]);
                                    }
                                    else
                                    {
                                        $dummy_chap = false;
                                    }
                                    if($dummy_chap !== false)
                                    {
                                        $chapters = array($dummy_chap);
                                    }
                                    else
                                    {
                                        $chapters = array();
                                    }
                                    $slugified_name = $wp_manga_storage->slugify( $chaps['name'] );
                                    $chapter_2 = $wp_manga_chapter->get_chapter_by_slug( $existing_post_id, $slugified_name );
                                    if($chapter_2 && strtolower($chapter_2['chapter_slug']) == strtolower($slugified_name))
                                    {
                                        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                            ums_log_to_file('Chapter is already published, skipping it: ' . $chapter_2['chapter_name']);
                                        }
                                        continue;
                                    }
                                    $content = '';
                                    $doc = new DOMDocument;
                                    $internalErrors = libxml_use_internal_errors(true);
                                    $doc->loadHTML('<?xml encoding="utf-8" ?>' . $page_html);
                                    libxml_use_internal_errors($internalErrors);
                                    $xpath = new \DOMXpath($doc);
                                    $articles = $xpath->query('//*[contains(@class, "text-left")]');
                                    if($articles !== false && count($articles) > 0)
                                    {
                                        foreach($articles as $container) 
                                        {
                                            if(method_exists($container, 'saveHTML'))
                                            {
                                                $content .= ' ' . $container->saveHTML();
                                            }
                                            elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                            {
                                                $content .= ' ' . $container->ownerDocument->saveHTML($container);
                                            }
                                            elseif(isset($container->nodeValue))
                                            {
                                                $content .= ' ' . $container->nodeValue;
                                            }
                                            break;
                                        }
                                    }
                                    if(empty($content)) 
                                    {
                                        $articles = $xpath->query('//*[contains(@class, "content-body")]');
                                        if($articles !== false && count($articles) > 0)
                                        {
                                            foreach($articles as $container) 
                                            {
                                                if(method_exists($container, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->saveHTML();
                                                }
                                                elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->ownerDocument->saveHTML($container);
                                                }
                                                elseif(isset($container->nodeValue))
                                                {
                                                    $content .= ' ' . $container->nodeValue;
                                                }
                                            }
                                        }
                                    }
                                    if(empty($content)) 
                                    {
                                        $articles = $xpath->query('//*[contains(@class, "cha-tit")]');
                                        if($articles !== false && count($articles) > 0)
                                        {
                                            foreach($articles as $container) 
                                            {
                                                if(method_exists($container, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->saveHTML();
                                                }
                                                elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->ownerDocument->saveHTML($container);
                                                }
                                                elseif(isset($container->nodeValue))
                                                {
                                                    $content .= ' ' . $container->nodeValue;
                                                }
                                            }
                                        }
                                        $articles = $xpath->query('//*[contains(@class, "cha-content")]');
                                        if($articles !== false && count($articles) > 0)
                                        {
                                            foreach($articles as $container) 
                                            {
                                                if(method_exists($container, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->saveHTML();
                                                }
                                                elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->ownerDocument->saveHTML($container);
                                                }
                                                elseif(isset($container->nodeValue))
                                                {
                                                    $content .= ' ' . $container->nodeValue;
                                                }
                                            }
                                        }
                                    }
                                    if(empty($content)) 
                                    {
                                        $ccontent = $html->find('.reading-content .text-left .cha-words .cha-words');
                                        if($ccontent) 
                                        {
                                            foreach($ccontent as $xct)
                                            {
                                                $other_ps = $xct->find('p');
                                                if(count($other_ps) > 0)
                                                {
                                                    $text = '';
                                                    foreach($other_ps as $p)
                                                    {
                                                        $text .= '<p> ' . $p->plaintext . '</p>';
                                                    }
                                                    $content .= $text . '<hr/>';
                                                } 
                                                else 
                                                {
                                                    $content .= $xct->innertext . '<hr/>';
                                                }
                                            }
                                        }
                                        else 
                                        {
                                            if($html->find('.reading-content #content', 0))
                                            {
                                                $content = $html->find('.reading-content #content', 0)->innertext;
                                            } 
                                            else 
                                            {
                                                $ccontent = $html->find('.reading-content .text-left .cha-content .cha-words');
                                                if($ccontent) 
                                                {
                                                    $content = '';
                                                    foreach($ccontent as $xct)
                                                    {
                                                        $content .= $xct->innertext . '<hr/>';
                                                    }
                                                } 
                                                else 
                                                {
                                                    $content = $html->find('.reading-content .text-left', 0);
                                                    if($content)
                                                    {
                                                        $other_ps = $content->find('p');
                                                        if(count($other_ps) > 0)
                                                        {
                                                            $text = '';
                                                            foreach($other_ps as $p)
                                                            {
                                                                $text .= '<p> ' . $p->plaintext . '</p>';
                                                            }
                                                            $content = $text;
                                                        } 
                                                        else 
                                                        {							
                                                            if($inner_content = $content->find('#chapter-content', 0))
                                                            {
                                                                $content = $inner_content->innertext;
                                                            }
                                                            else
                                                            {
                                                                if($inner_content = $content->find('.text-left', 0))
                                                                {
                                                                    $content = $inner_content->innertext;
                                                                }
                                                                else
                                                                {
                                                                    if($inner_content = $content->find('.fr-view', 0))
                                                                    {
                                                                        $content = $inner_content->innertext;
                                                                    }
                                                                    else
                                                                    {
                                                                        $content = $content->innertext;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                            if(!$content)
                                            {
                                                $content = '';
                                                $ps = $html->find('.reading-content .text-left p');
                                                foreach($ps as $p)
                                                {
                                                    $content .= '<p>' . $p->plaintext . '</p>';
                                                }
                                            }
                                        }
                                    }
                                    if($use_phantom != '0')
                                    {
                                        $xdoc = new DOMDocument;
                                        $internalErrors = libxml_use_internal_errors(true);
                                        $xdoc->loadHTML('<?xml encoding="utf-8" ?>' . $content);
                                        libxml_use_internal_errors($internalErrors);
                                        $xxpath = new \DOMXpath($xdoc);
                                        $ps = $xxpath->query('//p');
                                        if($ps !== false && count($ps) > 0)
                                        {
                                            $tmpcont = '';
                                            foreach($ps as $container) 
                                            {
                                                if(method_exists($container, 'saveHTML'))
                                                {
                                                    $tmpcont .= ' ' . $container->saveHTML();
                                                }
                                                elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                                {
                                                    $tmpcont .= ' ' . $container->ownerDocument->saveHTML($container);
                                                }
                                                elseif(isset($container->nodeValue))
                                                {
                                                    $tmpcont .= ' ' . $container->nodeValue;
                                                }
                                            }
                                            if($tmpcont != '')
                                            {
                                                $content = $tmpcont;
                                            }
                                        }
                                        $content = preg_replace('#(?:<p>)?<i(?:[^>]*?)>(?:[\s\S]*?)<\/i>(?:<\/p>)?#i', '', $content);
                                    }
                                    $content = preg_replace('#(?:my)?[.]?v[.\s]?i[.\s]?p[.\s]?n[.\s]?o[.\s]?v[.\s]?e[.\s]?l[.]?(?:\s?.c[o0]m)?#i', get_bloginfo('name'), $content);
                                    $content = str_ireplace('newnovel.org', get_bloginfo('name'), $content);
                                    $content = str_ireplace('new novel', get_bloginfo('name'), $content);
                                    $content = str_ireplace('newnovel', get_bloginfo('name'), $content);
                                    $qtags = array('iframe', 'script', 'ins');
                                    foreach ($qtags as $qtag) {
                                        $regex = '#<\s*' . $qtag . '[^>]*>.*?<\s*/\s*'. $qtag . '>#msi';
                                        $content = preg_replace($regex, '', $content);
                                    }
                                    $content = preg_replace('#<style([\s\S]+?)<\/style>#i', '', $content);
                                    $content = preg_replace('#<\/?div([^>]*)>#i', '', $content);
                                    if($strip_images == '1')
                                    {
                                        $content = ums_sanitize_html_content($content);
                                    }
                                    $chapter_content = trim($content);
                                    $chapter_content = ums_strip_links($chapter_content);
                                    if($chapter_content == '')
                                    {
                                        
                                        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                            ums_log_to_file('Skipping current chapter (because it failed to parse first chapter content): ' . print_r($chaps['url'], true));
                                        }
                                        //new_chap true to prevent infinite running
                                        $new_chap = true;
                                        break;
                                    }
                                    $arr = ums_spin_and_translate($chaps['name'], $chapter_content, $rule_translate, 'en');
                                    if($arr === false)
                                    {
                                        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                            ums_log_to_file('Skipping current chapter (because it failed to be translated): ' . print_r($chaps['url'], true));
                                        }
                                    }
                                    elseif($no_translate_title != '1')
                                    {
                                        $chaps['name']              = $arr[0];
                                        $chaps['extend_name']       = $arr[0];
                                        $chapter_content = $arr[1];
                                    }
                                    global $wp_manga_text_type;
                                    if(empty($chaps['name']))
                                    {
                                        $chaps['name'] = 'Novel';
                                    }
                                    if($chaps['name'] == '')
                                    {
                                        $xext_name = $name_str . ' ' . $chaps['extend_name'];
                                    }
                                    else
                                    {
                                        $xext_name = '';
                                    }
                                    if($xext_name == '')
                                    {
                                        $chapsx = explode('-', $chaps['name']);
                                        if(isset($chapsx[1]))
                                        {
                                            $xext_name = trim($chapsx[1]);
                                            $chaps['name'] = trim($chapsx[0]);
                                        }
                                    }
                                    $chapter_args = array(
                                        'post_id'             => $existing_post_id,
                                        'chapter_name'        => $chaps['name'],
                                        'chapter_name_extend' => $xext_name,
                                        'volume_id'           => '',
                                        'chapter_content'     => $chapter_content,
                                    );
                                    $slugified_name = $wp_manga_storage->slugify( $chaps['name'] );
                                    $chapter_2 = $wp_manga_chapter->get_chapter_by_slug( $existing_post_id, $slugified_name );
                                    if($chapter_2 && strtolower($chapter_2['chapter_slug']) == strtolower($slugified_name))
                                    {
                                        ums_log_to_file('Chapter name already published, we will skip: ' . $chapter_2['chapter_name']);
                                        continue; 
                                    }
                                    $chapter_id = $wp_manga_text_type->insert_chapter( $chapter_args );
                                    if( $chapter_id ){
                                        if( is_wp_error( $chapter_id ) ){
                                            ums_log_to_file('Failed to insert new chapter: ' . $chaps['name'] . ' error: ' . $chapter_id->get_error_message());
                                            continue;
                                        }
                                        else
                                        {
                                            $new_chap = true;
                                            $ums_imported_chapters++;
                                            $local_imported++;
                                        }
                                    }
                                    if (isset($ums_Main_Settings['request_timeout']) && $ums_Main_Settings['request_timeout'] != '') {
                                        $timeout = intval($ums_Main_Settings['request_timeout']);
                                    } else {
                                        $timeout = 1;
                                    }
                                    sleep($timeout);
                                }
                            }
                            else
                            {
                                foreach($chapters as $chaps)
                                {
                                    if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                        ums_log_to_file('Processing novel chapter (no lazyload): ' . $chaps['url']);
                                    }
                                    if($ums_max_chapters <= $local_imported)
                                    {
                                        break;
                                    }
                                    $slugified_name = $wp_manga_storage->slugify( $chaps['name'] );
                                    $chapter_2 = $wp_manga_chapter->get_chapter_by_slug( $existing_post_id, $slugified_name );
                                    if($chapter_2 && strtolower($chapter_2['chapter_slug']) == strtolower($slugified_name))
                                    {
                                        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                            ums_log_to_file('Chapter already published, skipping it: ' . $chapter_2['chapter_name']);
                                        }
                                        continue;
                                    }
                                    $page_html = ums_get_web_page($chaps['url'], ums_get_random_user_agent(), $use_phantom, $phantom_wait);
                                    if( $page_html == false ){
                                        ums_log_to_file('Failed to download HTML for chapter: ' . $chaps['name']);
                                        continue;
                                    }
                                    $html = ums_str_get_html( $page_html );
                                    if( empty( $html ) ){
                                        ums_log_to_file('Failed to parse HTML for chapter: ' . $chaps['name']);
                                        continue;
                                    }
                                    $content = '';
                                    $doc = new DOMDocument;
                                    $internalErrors = libxml_use_internal_errors(true);
                                    $doc->loadHTML('<?xml encoding="utf-8" ?>' . $page_html);
                                    libxml_use_internal_errors($internalErrors);
                                    $xpath = new \DOMXpath($doc);
                                    $articles = $xpath->query('//*[contains(@class, "text-left")]');
                                    if($articles !== false && count($articles) > 0)
                                    {
                                        foreach($articles as $container) 
                                        {
                                            if(method_exists($container, 'saveHTML'))
                                            {
                                                $content .= ' ' . $container->saveHTML();
                                            }
                                            elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                            {
                                                $content .= ' ' . $container->ownerDocument->saveHTML($container);
                                            }
                                            elseif(isset($container->nodeValue))
                                            {
                                                $content .= ' ' . $container->nodeValue;
                                            }
                                            break;
                                        }
                                    }
                                    if(empty($content)) 
                                    {
                                        $articles = $xpath->query('//*[contains(@class, "content-body")]');
                                        if($articles !== false && count($articles) > 0)
                                        {
                                            foreach($articles as $container) 
                                            {
                                                if(method_exists($container, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->saveHTML();
                                                }
                                                elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->ownerDocument->saveHTML($container);
                                                }
                                                elseif(isset($container->nodeValue))
                                                {
                                                    $content .= ' ' . $container->nodeValue;
                                                }
                                            }
                                        }
                                    }
                                    if(empty($content)) 
                                    {
                                        $articles = $xpath->query('//*[contains(@class, "cha-tit")]');
                                        if($articles !== false && count($articles) > 0)
                                        {
                                            foreach($articles as $container) 
                                            {
                                                if(method_exists($container, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->saveHTML();
                                                }
                                                elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->ownerDocument->saveHTML($container);
                                                }
                                                elseif(isset($container->nodeValue))
                                                {
                                                    $content .= ' ' . $container->nodeValue;
                                                }
                                            }
                                        }
                                        $articles = $xpath->query('//*[contains(@class, "cha-content")]');
                                        if($articles !== false && count($articles) > 0)
                                        {
                                            foreach($articles as $container) 
                                            {
                                                if(method_exists($container, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->saveHTML();
                                                }
                                                elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->ownerDocument->saveHTML($container);
                                                }
                                                elseif(isset($container->nodeValue))
                                                {
                                                    $content .= ' ' . $container->nodeValue;
                                                }
                                            }
                                        }
                                    }
                                    if(empty($content)) 
                                    {
                                        $content = $html->find('.reading-content .text-left .cha-words .cha-words', 0);
                                        if($content) 
                                        {
                                            $other_ps = $content->find('p');
                                            if(count($other_ps) > 0)
                                            {
                                                $text = '';
                                                foreach($other_ps as $p)
                                                {
                                                    $text .= '<p> ' . $p->plaintext . '</p>';
                                                }
                                                $content = $text;
                                            } 
                                            else 
                                            {
                                                $content = $content->innertext;
                                            }
                                        }
                                        else 
                                        {
                                            if($html->find('.reading-content #content', 0))
                                            {
                                                $content = $html->find('.reading-content #content', 0)->innertext;
                                            } 
                                            else 
                                            {
                                                $content = $html->find('.reading-content .text-left .cha-content .cha-words', 0);
                                                if($content) 
                                                {
                                                    $content = $content->innertext;
                                                } 
                                                else 
                                                {
                                                    $content = $html->find('.reading-content .text-left', 0);
                                                    if($content)
                                                    {
                                                        $other_ps = $content->find('p');
                                                        if(count($other_ps) > 0)
                                                        {
                                                            $text = '';
                                                            foreach($other_ps as $p)
                                                            {
                                                                $text .= '<p> ' . $p->plaintext . '</p>';
                                                            }
                                                            $content = $text;
                                                        } 
                                                        else 
                                                        {							
                                                            if($inner_content = $content->find('#chapter-content', 0))
                                                            {
                                                                $content = $inner_content->innertext;
                                                            }
                                                            else
                                                            {
                                                                if($inner_content = $content->find('.text-left', 0))
                                                                {
                                                                    $content = $inner_content->innertext;
                                                                }
                                                                else
                                                                {
                                                                    if($inner_content = $content->find('.fr-view', 0))
                                                                    {
                                                                        $content = $inner_content->innertext;
                                                                    }
                                                                    else
                                                                    {
                                                                        $content = $content->innertext;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                            if(!$content)
                                            {
                                                $content = '';
                                                $ps = $html->find('.reading-content .text-left p');
                                                foreach($ps as $p)
                                                {
                                                    $content .= '<p>' . $p->plaintext . '</p>';
                                                }
                                            }
                                        }
                                    }
                                    if($use_phantom != '0')
                                    {
                                        $xdoc = new DOMDocument;
                                        $internalErrors = libxml_use_internal_errors(true);
                                        $xdoc->loadHTML('<?xml encoding="utf-8" ?>' . $content);
                                        libxml_use_internal_errors($internalErrors);
                                        $xxpath = new \DOMXpath($xdoc);
                                        $ps = $xxpath->query('//p');
                                        if($ps !== false && count($ps) > 0)
                                        {
                                            $tmpcont = '';
                                            foreach($ps as $container) 
                                            {
                                                if(method_exists($container, 'saveHTML'))
                                                {
                                                    $tmpcont .= ' ' . $container->saveHTML();
                                                }
                                                elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                                {
                                                    $tmpcont .= ' ' . $container->ownerDocument->saveHTML($container);
                                                }
                                                elseif(isset($container->nodeValue))
                                                {
                                                    $tmpcont .= ' ' . $container->nodeValue;
                                                }
                                            }
                                            if($tmpcont != '')
                                            {
                                                $content = $tmpcont;
                                            }
                                        }
                                        $content = preg_replace('#(?:<p>)?<i(?:[^>]*?)>(?:[\s\S]*?)<\/i>(?:<\/p>)?#i', '', $content);
                                    }
                                    $content = preg_replace('#(?:my)?[.]?v[.\s]?i[.\s]?p[.\s]?n[.\s]?o[.\s]?v[.\s]?e[.\s]?l[.]?(?:\s?.c[o0]m)?#i', get_bloginfo('name'), $content);
                                    $content = str_ireplace('newnovel.org', get_bloginfo('name'), $content);
                                    $content = str_ireplace('new novel', get_bloginfo('name'), $content);
                                    $content = str_ireplace('newnovel', get_bloginfo('name'), $content);
                                    $qtags = array('iframe', 'script', 'ins');
                                    foreach ($qtags as $qtag) {
                                        $regex = '#<\s*' . $qtag . '[^>]*>.*?<\s*/\s*'. $qtag . '>#msi';
                                        $content = preg_replace($regex, '', $content);
                                    }
                                    $content = preg_replace('#<style([\s\S]+?)<\/style>#i', '', $content);
                                    $content = preg_replace('#<\/?div([^>]*)>#i', '', $content);
                                    if($strip_images == '1')
                                    {
                                        $content = ums_sanitize_html_content($content);
                                    }
                                    $chapter_content = trim($content);
                                    $chapter_content = ums_strip_links($chapter_content);
                                    $arr = ums_spin_and_translate($chaps['name'], $chapter_content, $rule_translate, 'en');
                                    if($arr === false)
                                    {
                                        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                            ums_log_to_file('Skipping chapter (because it failed to be translated): ' . print_r($post_args, true));
                                        }
                                    }
                                    elseif($no_translate_title != '1')
                                    {
                                        $chaps['name']              = $arr[0];
                                        $chaps['extend_name']       = $arr[0];
                                        $chapter_content = $arr[1];
                                    }
                                    global $wp_manga_text_type;
                                    if(empty($chaps['name']))
                                    {
                                        $xext_name = $name_str . ' ' . $chaps['extend_name'];
                                        $chaps['name'] = 'Novel';
                                    }
                                    else
                                    {
                                        $xext_name = '';
                                    }
                                    if($xext_name == '')
                                    {
                                        $chapsx = explode('-', $chaps['name']);
                                        if(isset($chapsx[1]))
                                        {
                                            $xext_name = trim($chapsx[1]);
                                            $chaps['name'] = trim($chapsx[0]);
                                        }
                                    }
                                    $chapter_args = array(
                                        'post_id'             => $existing_post_id,
                                        'chapter_name'        => $chaps['name'],
                                        'chapter_name_extend' => $xext_name,
                                        'volume_id'           => '',
                                        'chapter_content'     => $chapter_content,
                                    );
                                    $slugified_name = $wp_manga_storage->slugify( $chaps['name'] );
                                    $chapter_2 = $wp_manga_chapter->get_chapter_by_slug( $existing_post_id, $slugified_name );
                                    if($chapter_2 && strtolower($chapter_2['chapter_slug']) == strtolower($slugified_name))
                                    {
                                        ums_log_to_file('Chapter name already published, skipping it: ' . $chapter_2['chapter_name']);
                                        continue; 
                                    }
                                    $chapter_id = $wp_manga_text_type->insert_chapter( $chapter_args );
                                    if( $chapter_id ){
                                        if( is_wp_error( $chapter_id ) ){
                                            ums_log_to_file('Failed to insert chapter: ' . $chaps['name'] . ' error: ' . $chapter_id->get_error_message());
                                            continue;
                                        }
                                        else
                                        {
                                            $new_chap = true;
                                            $ums_imported_chapters++;
                                            $local_imported++;
                                        }
                                    }
                                    if (isset($ums_Main_Settings['request_timeout']) && $ums_Main_Settings['request_timeout'] != '') {
                                        $timeout = intval($ums_Main_Settings['request_timeout']);
                                    } else {
                                        $timeout = 1;
                                    }
                                    sleep($timeout);
                                }
                            }
                            if($new_chap == true)
                            {
                                if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                    ums_log_to_file('Total novel chapters scraped: ' . $local_imported);
                                }
                                $scraped_manga++;
                            }                            
                        }
                    }
                    catch(Exception $e)
                    {
                        ums_log_to_file('Importing failed: ' . $e->getMessage());
                        if($auto == 1)
                        {
                            ums_clearFromList($param, $type);
                        }
                        return 'fail';
                    }
                }
            }
            elseif($type == 4)
            {
                if(trim($max_manga) != '')
                {
                    $get_max_manga = intval(trim($max_manga));
                }
                else
                {
                    $get_max_manga = 999;
                }
                $items = array();
                $page_increased = false;
                {
                    $manga_arr = array();
                    try
                    {
                        global $wp_filesystem;
                        if ( ! is_a( $wp_filesystem, 'WP_Filesystem_Base') ){
                            include_once(ABSPATH . 'wp-admin/includes/file.php');$creds = request_filesystem_credentials( site_url() );
                            wp_filesystem($creds);
                        }
                        $manga_names = explode(',', $manga_name);
                        $manga_names = array_map('trim', $manga_names);
                        $manga_arr = $manga_names;
                        if(count($manga_arr) == 0)
                        {
                            ums_log_to_file('No Web Novel matched your query: ' . $manga_name);
                            return 'nochange';
                        }
                        $scraped_manga = 0;
                        foreach($manga_arr as $current_manga)
                        {
                            if($get_max_manga <= $scraped_manga)
                            {
                                break;
                            }
                            $parsedUrl = parse_url($current_manga);
                            if($parsedUrl === false)
                            {
                                ums_log_to_file('Cannot parse URL: ' . $current_manga);
                                continue;
                            }
                            if(!isset($parsedUrl['host']))
                            {
                                ums_log_to_file('Incorrect URL submitted: ' . $current_manga);
                                continue;
                            }
                            if(!isset($parsedUrl['path']) || empty($parsedUrl['path']))
                            {
                                ums_log_to_file('Incorrect URL format submitted: ' . $current_manga);
                                continue;
                            }
                            $domain = $parsedUrl['host'];

                            $path = trim($parsedUrl['path'], '/');

                            $pathParts = explode('/', $path);

                            $firstDirectory = isset($pathParts[0]) ? $pathParts[0] : '';


                            $current_manga = trim($current_manga, '/');
                            $current_manga = $current_manga . '/';
                            $html_site = ums_get_web_page($current_manga, ums_get_random_user_agent(), $use_phantom, $phantom_wait);
                            if($html_site == false)
                            {
                                ums_log_to_file('Failed to download manga chapter: ' . $current_manga);
                                continue;
                            }
                            if(stristr($html_site, 'Cloudflare Ray ID:') !== false)
                            {
                                ums_log_to_file('CloudFlare protection active on novel site, access is limited! Please install puppeteer on your site and set the "Content Scraping Method To Use" to Puppeteer for scraping to work. Manga URL: ' . $current_manga);
                                sleep(1);
                                continue;
                            }
                            if(stristr($html_site, 'manga-title-badges custom comic') !== false)
                            {
                                ums_log_to_file('This URL is a web comic, not a web novel, skipping it: ' . $current_manga);
                                continue;
                            }
                            if (isset($ums_Main_Settings['request_timeout']) && $ums_Main_Settings['request_timeout'] != '') {
                                $timeout = intval($ums_Main_Settings['request_timeout']);
                            } else {
                                $timeout = 1;
                            }
                            sleep($timeout);
                            require_once (dirname(__FILE__) . "/res/simple_html_dom.php"); 
                            $html = ums_str_get_html( $html_site );
                            $tag = $html->find( '.profile-manga .post-title h1', 0 );
                            $name_str = '';
                            $my_slug = '';
                            $my_slug = str_replace( 'http://', '', $current_manga );
                            $my_slug = str_replace( 'https://', '', $my_slug );
                            $my_slug = str_replace( 'http:', '', $my_slug );
                            $my_slug = str_replace( $domain . '/' . $firstDirectory . '/', '', $my_slug );
                            $my_slug = str_replace( '/', '', $my_slug );
                            $my_slug = str_replace( '.html', '', $my_slug );
                            $my_slug = str_replace( '.htm', '', $my_slug );
                            if($tag){
                                $name_str = trim($tag->plaintext);
                                $span = $tag->find('span', 0);
                                if($span){
                                    $name_str = trim(str_replace($span->plaintext,'', $name_str));
                                }
                            }
                            if($name_str == '')
                            {
                                preg_match_all('#<title>([^<]*?)<\/title>#i', $html_site, $tmathc);
                                if(isset($tmathc[1][0]))
                                {
                                    $name_str = $tmathc[1][0];
                                }
                            }
                            if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                ums_log_to_file('Processing novel: ' . $name_str);
                            }
                            $find_post = new WP_Query( array(
                                'title'     => $name_str,
                                'post_type' => 'wp-manga',
                            ) );
                            $existing_post_id = false;
                            if( $find_post->have_posts() )
                            {
                                $existing_post_id = $find_post->posts[0]->ID;
                            }
                            if($existing_post_id == false)
                            {
                                $args = array(
                                    'post_type'  => 'wp-manga',
                                    'meta_key'   => '_manga_import_slug',
                                    'meta_value' => $my_slug,
                                    'post_status' => array('publish','draft','pending','trash','private','future')
                                );
                                $query = new WP_Query( $args );
                                if( $query->have_posts() ){
                                    $existing_post_id = $query->posts[0]->ID;
                                }
                            }
                            if($existing_post_id == false)
                            {
                                $block_warning = $html->find('#page .warning', 0);
                                if( !empty( $block_warning ) && strpos( $block_warning->plaintext, 'has been licensed, it is not available' ) !== false ){
                                    ums_log_to_file('Request blocked, please use a proxy!');
                                    continue;
                                }
                                $desc = $html->find( '.description-summary' );
                                $xd = '';
                                if(is_array($desc))
                                {
                                    foreach($desc as $dd)
                                    {
                                        if(stristr($dd->plaintext, 'Description') || stristr($dd->plaintext, 'Summary'))
                                        {
                                            $xd = trim($dd->plaintext);
                                            $xprefix = 'Description';
                                            if (substr($xd, 0, strlen($xprefix)) == $xprefix) {
                                                $xd = substr($xd, strlen($xprefix));
                                            } 
                                            $xprefix = 'Summary';
                                            if (substr($xd, 0, strlen($xprefix)) == $xprefix) {
                                                $xd = substr($xd, strlen($xprefix));
                                            } 
                                            $xd = trim($xd);
                                        }
                                    }
                                }
                                if($xd == '')
                                {
                                    $doc = new DOMDocument;
                                    $internalErrors = libxml_use_internal_errors(true);
                                    $doc->loadHTML('<?xml encoding="utf-8" ?>' . $html_site);
                                    libxml_use_internal_errors($internalErrors);
                                    $xpath = new \DOMXpath($doc);
                                    $articles = $xpath->query('//*[@class="g_txt_over mb48 fs16 j_synopsis _txtover _on"]');
                                    if($articles !== false && count($articles) > 0)
                                    {
                                        foreach($articles as $container) {
                                            if(method_exists($container, 'saveHTML'))
                                            {
                                                $xd .= ' ' . $container->saveHTML();
                                            }
                                            elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                            {
                                                $xd .= ' ' . $container->ownerDocument->saveHTML($container);
                                            }
                                            elseif(isset($container->nodeValue))
                                            {
                                                $xd .= ' ' . $container->nodeValue;
                                            }
                                        }
                                        $qtags = array('iframe', 'script');
                                        foreach ($qtags as $qtag) 
                                        {
                                            $regex = '#<\s*' . $qtag . '[^>]*>.*?<\s*/\s*'. $qtag . '>#msi';
                                            $xd = preg_replace($regex, '', $xd);
                                        }
                                    }
                                    else
                                    {
                                        $articles = $xpath->query('//*[@class="c_000"]');
                                        if($articles !== false && count($articles) > 0)
                                        {
                                            foreach($articles as $container) {
                                                if(method_exists($container, 'saveHTML'))
                                                {
                                                    $xd .= ' ' . $container->saveHTML();
                                                }
                                                elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                                {
                                                    $xd .= ' ' . $container->ownerDocument->saveHTML($container);
                                                }
                                                elseif(isset($container->nodeValue))
                                                {
                                                    $xd .= ' ' . $container->nodeValue;
                                                }
                                            }
                                        }
                                    }
                                }
                                if($xd == '')
                                {
                                    $desc = '';
                                }
                                else
                                {
                                    $desc = trim($xd);
                                }
                                if($desc == '')
                                {
                                    preg_match_all('#<div class="summary__content show-more">(?:<p>)?([\s\S]*?)(?:<\/p>)?<\/?div>#i', $html_site, $dmathc);
                                    if(isset($dmathc[1][0]))
                                    {
                                        $desc = $dmathc[1][0];
                                    }
                                }
                                $desc = ums_strip_links($desc);
                                $uxrlparts = wp_parse_url(home_url());
                                $domainx = $uxrlparts['host'];
                                $desc = preg_replace('#<p><center><a href="https:\/\/bronovel\.com\/"><em><strong>Announcement<\/strong><\/em>: we are moving[\s\S]*?<\/center><\/p>#', '', $desc);
                                $desc = str_ireplace($domain, $domainx, $desc);
                                $thumb = $html->find( '.summary_image .img-responsive' );
                                $thumb = !empty( $thumb ) ? $thumb[0]->{'data-src'} : '';
                                if($thumb == '')
                                {
                                    $thumb = !empty( $thumb ) ? $thumb[0]->src : '';
                                }
                                if($thumb == '')
                                {
                                    $thumb = $html->find( '.summary_image' );
                                    $thumb = !empty( $thumb ) ? $thumb[0]->src : '';
                                }
                                if($thumb == '')
                                {
                                    preg_match_all('#<div class="summary_image">[\s\n]*<a href="[^"]*?">[\s\n]*<img[^>]*?src="([^"]*?)"#i', $html_site, $xmathc);
                                    if(isset($xmathc[1][0]))
                                    {
                                        $thumb = trim($xmathc[1][0]);
                                    }
                                }
                                if(empty($thumb))
                                {
                                    preg_match_all('#<meta\s*property="og:image"\s*content="([^"]*?)"\s*\/?>#i', $html_site, $imatch);
                                    if(isset($imatch[1][0]))
                                    {
                                        $thumb = trim($imatch[1][0]);
                                    }
                                }
                                $stx = '';
                                $status = $html->find( '.post-status .post-content_item' );
                                if(is_array($status))
                                {
                                    foreach($status as $st)
                                    {
                                        $temp_stat = $st->plaintext;
                                        if(stristr($temp_stat, 'status') !== false)
                                        {
                                            $stx = $temp_stat;
                                        }
                                    }
                                }
                                if($stx === '')
                                {
                                    $status = '';
                                }
                                else
                                {
                                    $status = $stx;
                                }
                                if(stristr($status, 'ongoing') !== false)
                                {
                                    $status = 'on-going';
                                }
                                elseif(stristr($status, 'completed') !== false)
                                {
                                    $status = 'end';
                                }
                                elseif(stristr($status, 'canceled') !== false)
                                {
                                    $status = 'canceled';
                                }
                                elseif(stristr($status, 'on hold') !== false)
                                {
                                    $status = 'on-hold';
                                }
                                elseif(stristr($status, 'upcoming') !== false)
                                {
                                    $status = 'upcoming';
                                }
                                $alter_name = $html->find( '.summary_content .post-content .post-content_item' );
                                $xplain = '';
                                if( !empty( $alter_name ) )
                                {
                                    foreach($alter_name as $an)
                                    {
                                        if(stristr($an->plaintext, 'Alternative '))
                                        {
                                            $xplain = trim($an->plaintext);
                                            $xprefix = 'Alternative';
                                            if (substr($xplain, 0, strlen($xprefix)) == $xprefix) {
                                                $xplain = substr($xplain, strlen($xprefix));
                                            } 
                                            $xplain = trim($xplain);
                                        }
                                    }
                                }
                                if($xplain != '')
                                {
                                    $alter_name = $xplain;
                                }
                                else
                                {
                                    $alter_name = '';
                                }
                                $data = $html->find( '.summary_content .post-content .post-content_item' );
                                $xtype = '';
                                if( !empty( $data ) ){
                                    foreach($data as $item){
                                        if($item->find('.summary-heading h5',0) !== null && trim($item->find('.summary-heading h5',0)->plaintext) == 'Type'){
                                            $xtype = $item->find('.summary-content', 0)->plaintext;
                                            if(trim($xtype) == 'Updating')
                                            {
                                                $xtype = '';
                                            }
                                        }
                                    }
                                }
                                $xrelease = '2021';
                                preg_match_all('#<a href="https:\/\/' . addslashes($domain) . '\/(?:manga-)?release\/(?:[^"]*?)" rel="tag">([^<]+?)<\/a>#i', $html_site, $xmathc);
                                if(isset($xmathc[1][0]))
                                {
                                    $xrelease = trim($xmathc[1][0]);
                                }
                                $xauthor = '';
                                $author = '';
                                $data = $html->find( '.author-content a' );
                                if( !empty( $data ) ){
                                    $authors = array();
                                    foreach($data as $arxthor)
                                    {
                                        array_push($authors, $arxthor->plaintext);
                                        if($author == '')
                                        {
                                            $author = $arxthor->plaintext;
                                        }
                                    }
                                    $xauthor = implode(',', $authors);
                                }

                                $xartists = '';
                                $data = $html->find( '.artist-content a' );
                                if( !empty( $data ) ){
                                    $artists = array();
                                    foreach($data as $artist){
                                        array_push($artists, $artist->plaintext);
                                    }
                                    $xartists = implode(',', $artists);
                                }
                                $xgenres = '';
                                $data = $html->find( '.genres-content a' );
                                if( !empty( $data ) ){
                                    $genres = array();
                                    foreach($data as $genre){
                                        array_push($genres, $genre->plaintext);
                                    }
                                    $xgenres = implode(',', $genres);
                                }
                                $items = $html->find('.summary_content .post-content .post-content_item');
                                $views = '';
                                foreach($items as $item){
                                    if(trim($item->find('.summary-heading', 0)->plaintext) == 'Rank'){
                                        $str = $item->find('.summary-content',0)->plaintext;
                                        preg_match_all('~\d+(?:\.\d+)?~', $str, $matches);
                                        if($matches){
                                            if(count($matches) == 3){
                                                $views = $matches[0][1];
                                            } else {
                                                $views = $matches[0][0];
                                            }
                                            if(strpos($str, 'K monthly views') !== false){
                                                $views = floatval($views) * 1000;
                                            }
                                            if(strpos($str, 'M monthly views') !== false){
                                                $views = floatval($views) * 1000000;
                                            }
                                            break;
                                        }
                                    }
                                }
                                if(empty(trim($views)) || !is_numeric(strip_tags( $views  )))
                                {
                                    $viewsm = rand(100,500);
                                }
                                else
                                {
                                    $viewsm = strip_tags(trim($views));
                                }
                                $average_vote = $html->find('.post-total-rating .total_votes', 0);
                                $str = $html->find('.vote-details',0);
                                $xrating = array();
                                if(!empty($str))
                                {
                                    preg_match_all('!\d+!', $str, $matches);
                                    $number_votes = 1;
                                    if($matches && count($matches[0]) == 3)
                                    {
                                        $number_votes = $matches[0][2];
                                    }
                                    if( !empty( $average_vote ) && $average_vote->plaintext > 0 ){
                                        $xrating = array(
                                            'avg'     => $average_vote->plaintext,
                                            'numbers' => $number_votes
                                        );
                                    }
                                }
                                $xtags = '';
                                $data = $html->find( '.tags-content a' );
                                if( !empty( $data ) ){
                                    $tags = array();
                                    foreach($data as $tag){
                                        $ttext = trim($tag->plaintext);
                                        array_push($tags, $ttext);
                                    }
                                    $xtags = implode(',', $tags);
                                }
                                $xtime_year = '';
                                $time_year = strtotime($xrelease);
                                if($time_year !== false)
                                {
                                    $time_year = date("Y", $time_year);
                                    if($time_year !== false)
                                    {
                                        $xtime_year = $time_year;
                                    }
                                }
                                $post_args = array(
                                    'manga_import_slug' => $my_slug,
                                    'title'             => $name_str,
                                    'post_status'       => $post_status,
                                    'description'       => $desc,
                                    'thumb'             => $thumb,
                                    'status'            => $status,
                                    'altername'         => strip_tags( $alter_name ),
                                    'type'              => strip_tags( $xtype ),
                                    'release'           => $xtime_year,
                                    'authors'           => strip_tags( $xauthor ),
                                    'artists'           => strip_tags( $xartists ),
                                );
                                $post_args['genres'] = '';
                                if($auto_categories == 'genre')
                                {
                                    $post_args['genres'] = strip_tags( $xgenres );
                                }
                                if($default_category != '')
                                {
                                    if($post_args['genres'] != '')
                                    {
                                        $post_args['genres'] .= ',';
                                    }
                                    $genreplus = get_term_by('id', $default_category, 'wp-manga-genre');
                                    if($genreplus !== false)
                                    {
                                        $post_args['genres'] .= $genreplus->slug;
                                    }
                                }
                                $post_args['views'] = strip_tags( $viewsm  );
                                $post_args['ratings'] = $xrating;
                                if($can_create_tag == 'genre')
                                {
                                    $post_args['tags'] = strip_tags( $xgenres );
                                }
                                elseif($can_create_tag == 'tags')
                                {
                                    $post_args['tags'] = strip_tags( $xtags );
                                }
                                else
                                {
                                    $post_args['tags'] = '';
                                }
                                if($item_create_tag != '')
                                {
                                    $ctag = explode(',', $item_create_tag);
                                    foreach($ctag as $ctap)
                                    {
                                        $ctap = trim($ctap);
                                        if($post_args['tags'] != '')
                                        {
                                            $post_args['tags'] .= ',';
                                        }
                                        $genreplus = get_term_by('name', $ctap, 'wp-manga-tag');
                                        if($genreplus !== false)
                                        {
                                            $post_args['tags'] .= $genreplus->slug;
                                        }
                                        else
                                        {
                                            $cat = wp_insert_term($ctap, 'wp-manga-tag');
                                            if(!is_wp_error( $cat ))
                                            {
                                                $post_args['tags'] .= $cat['slug'];
                                            }
                                        }
                                    }
                                }
                                $post_args['description'] = str_ireplace($domain, $_SERVER['HTTP_HOST'], $post_args['description']);
                                $arr = ums_spin_and_translate($post_args['title'], $post_args['description'], $rule_translate, 'en');
                                if($arr === false)
                                {
                                    if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                        ums_log_to_file('Skipping web novel (because it failed to be translated): ' . print_r($post_args, true));
                                    }
                                    continue;
                                }
                                else
                                {
                                    if($no_translate_title != '1')
                                    {
                                        $post_args['title']              = $arr[0];
                                    }
                                    $post_args['description']        = $arr[1];
                                }
                                $za_xpost_args = array(
                                    'post_title'   => !empty( $post_args['title'] ) ? $post_args['title'] : '',
                                    'post_content' => !empty( $post_args['description'] ) ? $post_args['description'] : '',
                                    'post_type'    => 'wp-manga',
                                    'post_status'  => isset( $post_args['post_status'] ) ? $post_args['post_status'] : 'pending',
                                );
                                $existing_again = false;
                                if($za_xpost_args['post_title'] != '')
                                {
                                    $xposts = get_posts(
                                        array(
                                            'post_type'              => 'wp-manga',
                                            'title'                  => html_entity_decode($za_xpost_args['post_title']),
                                            'post_status'            => 'all',
                                            'numberposts'            => 1,
                                            'update_post_term_cache' => false,
                                            'update_post_meta_cache' => false,           
                                            'orderby'                => 'post_date ID',
                                            'order'                  => 'ASC',
                                        )
                                    );
                                    if ( ! empty( $xposts ) ) {
                                        $ex_page = $xposts[0];
                                    } else {
                                        $ex_page = null;
                                    }
                                    if(isset($ex_page->ID))
                                    {
                                        $existing_again = true;
                                        $existing_post_id = $ex_page->ID;
                                    }
                                }
                                if($existing_again == false)
                                {
                                    $accept_comments = 'closed';
                                    if ($enable_comments == '1') {
                                        $accept_comments = 'open';
                                    }
                                    $za_xpost_args['comment_status'] = $accept_comments;
                                    if ($enable_pingback == '1') 
                                    {
                                        $za_xpost_args['ping_status'] = 'open';
                                    } 
                                    else 
                                    {
                                        $za_xpost_args['ping_status'] = 'closed';
                                    }
                                    if($get_date == '1')
                                    {
                                        if(!empty($xrelease))
                                        {
                                            if(strlen($xrelease) == 4)
                                            {
                                                $xrelease .= '-01-01 00:00';
                                            }
                                            $postdatex = gmdate("Y-m-d H:i:s", strtotime($xrelease));
                                            $za_xpost_args['post_date_gmt'] = $postdatex;
                                        }
                                    }
                                    if($user_name_type == 'rand')
                                    {
                                        $randid = ums_display_random_user();
                                        if($randid === false)
                                        {
                                            $za_xpost_args['post_author']               = ums_randomName();
                                        }
                                        else
                                        {
                                            $za_xpost_args['post_author']               = $randid->ID;
                                        }
                                    }
                                    elseif($user_name_type == 'feed-news')
                                    {
                                        $sp_post_user_name = ums_randomName();
                                        if($author == '' || $author == '1' || $author == 'null')
                                        {
                                            $author = ums_randomName();
                                        }
                                        if($author != '')
                                        {
                                            $xauthor = sanitize_user( $author );
                                            $xauthor = apply_filters( 'pre_user_login', $xauthor );
                                            $xauthor = trim( $xauthor );
                                            if(username_exists( $xauthor ))
                                            {
                                                $user_id_t = get_user_by('login', $xauthor);
                                                if($user_id_t)
                                                {
                                                    $sp_post_user_name = $user_id_t->ID;
                                                }
                                            }
                                            else
                                            {
                                                $palphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^*()-+=_?><,.;:}{][';
                                                $ppass = '';
                                                $alphaLength = strlen($palphabet) - 1;
                                                for ($ipass = 0; $ipass < 8; $ipass++) 
                                                {
                                                    $npass = rand(0, $alphaLength);
                                                    $ppass .= $palphabet[$npass];
                                                }
                                                $curr_id = wp_create_user($xauthor, $ppass, ums_generate_random_email());
                                                if ( is_int($curr_id) )
                                                {
                                                    $u = new WP_User($curr_id);
                                                    $u->remove_role('subscriber');
                                                    $u->add_role('author');
                                                    $sp_post_user_name               = $curr_id;
                                                }
                                            }
                                        }
                                        $za_xpost_args['post_author']               = ums_utf8_encode($sp_post_user_name);
                                    }
                                    else
                                    {
                                        $za_xpost_args['post_author']               = ums_utf8_encode($post_user_name);
                                    }
                                    
                                    if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                        ums_log_to_file('Inserting new novel: ' . $za_xpost_args['post_title']);
                                    }
                                    $existing_post_id = wp_insert_post( $za_xpost_args );
                                    if( ! $existing_post_id || is_wp_error( $existing_post_id ) ){
                                        ums_log_to_file('Failed to insert novel into db: ' . $post_args['title']);
                                        continue;
                                    }
                                    add_post_meta($existing_post_id, 'ums_parent_rule', $type . '-' . $param);
                                    wp_set_object_terms( $existing_post_id, 'Ums_' . $type . '_' . $param, 'coderevolution_post_source', true);
                                    if($thumb != '')
                                    {
                                        $thumb_id = ums_wp_mcl_e_upload_file( $post_args['thumb'], $use_phantom, $phantom_wait, $existing_post_id );
                                        if($thumb_id === false)
                                        {
                                            include_once( ABSPATH . 'wp-admin/includes/image.php' );
                                            $thcontent = ums_get_web_page($thumb);
                                            if (isset($ums_Main_Settings['request_timeout']) && $ums_Main_Settings['request_timeout'] != '') {
                                                $timeout = intval($ums_Main_Settings['request_timeout']);
                                            } else {
                                                $timeout = 1;
                                            }
                                            sleep($timeout);
                                            $pathinfo = pathinfo( $thumb );
                                            if( $thcontent != false ){
                                                $upload_dir = wp_upload_dir();
                                                $file_tmp_path = $upload_dir['basedir'] . '/' . $pathinfo['filename'] . '-' . $existing_post_id . '.' . explode('?',$pathinfo['extension'])[0];
                                                $file = $wp_filesystem->put_contents( $file_tmp_path, $thcontent );
                                                $wp_filetype = wp_check_filetype(basename($file_tmp_path), null );
                                                $attachment = array(
                                                    'post_mime_type' => $wp_filetype['type'],
                                                    'post_title' => $existing_post_id,
                                                    'post_content' => '',
                                                    'post_status' => 'inherit'
                                                );
                                                $attach_id = wp_insert_attachment( $attachment, $file_tmp_path );
                                                $thumb_id = $attach_id;
                                                $imagenew = get_post( $attach_id );
                                                $fullsizepath = get_attached_file( $imagenew->ID );
                                                require_once( ABSPATH . 'wp-admin/includes/image.php' );
                                                require_once( ABSPATH . 'wp-admin/includes/media.php' );
                                                $attach_data = wp_generate_attachment_metadata( $attach_id, $fullsizepath );
                                                wp_update_attachment_metadata( $attach_id, $attach_data );
                                            }
                                        }
                                    }
                                    else
                                    {
                                        $thumb_id = false;
                                    }
                                    $meta_data = array(
                                        '_manga_import_slug'     => $my_slug,
                                        '_thumbnail_id'          => $thumb_id,
                                        '_wp_manga_alternative'  => strip_tags( $alter_name ),
                                        '_wp_manga_type'         => strip_tags( $xtype ),
                                        '_wp_manga_status'       => $status,
                                        '_wp_manga_chapter_type' => 'text',
                                        '_wp_manga_chapters_warning'=> $chapter_warning,
                                    );
                                    foreach( $meta_data as $key => $value ){
                                        if( !empty( $value ) ){
                                            update_post_meta( $existing_post_id, $key, $value );
                                        }
                                    }
                                    $manga_terms = array(
                                        'wp-manga-release'     => strip_tags( $xrelease ),
                                        'wp-manga-author'      => strip_tags( $xauthor ),
                                        'wp-manga-artist'      => strip_tags( $xartists ),
                                        'wp-manga-genre'       => isset( $post_args['genres'] ) ? $post_args['genres'] : '',
                                        'wp-manga-tag'         => isset( $post_args['tags'] ) ? $post_args['tags'] : null,
                                    );
                                    foreach( $manga_terms as $tax => $term ){
                                        $resp = ums_add_manga_terms( $existing_post_id, $term, $tax );
                                    }
                                    ums_update_post_views( $existing_post_id, strip_tags( $viewsm ) );
                                    ums_update_post_ratings( $existing_post_id, $xrating );
                                }
                            }

                            $find_chapters  = $html->find('.listing-chapters_wrap li');
                            $output = array();
                            $current_vol = 'NO-VOLUME';
                            $chapters = array();
                            foreach( $find_chapters as $chapter )
                            {
                                $full_chapter_name = trim(preg_replace('/\t+/', '', $chapter->find('a',0)->plaintext));
                                $chapter_extend_name = '';
                                $names = explode(' - ', $full_chapter_name);
                                $chapter_name = $full_chapter_name;
                                if(count($names) == 2){
                                    $chapter_extend_name = $names[1];
                                    $chapter_name = $names[0];
                                }
                                $chapters[] = array(
                                    'name'        => $chapter_name,
                                    'extend_name' => $chapter_extend_name,
                                    'url'         => $chapter->find('a',0)->href
                                );
                            }
                            $lazy_loaded = false;
                            if(count($chapters) == 0)
                            {
                                if($always_first == '1' && $chapter_slug != '')
                                {
                                    $chap_url = $current_manga . $chapter_slug . '/';
                                }
                                else
                                {
                                    $latest_scraped = get_post_meta( $existing_post_id, 'ums_latest_scraped', true );
                                    if(!empty($latest_scraped))
                                    {
                                        $chap_url = $latest_scraped;
                                    }
                                    else
                                    {
                                        if($chapter_slug != '')
                                        {
                                            $chap_url = $current_manga . $chapter_slug . '/';
                                        }
                                        else
                                        {
                                            $chap_url = $current_manga . 'chapter-1/';
                                        }
                                    }
                                }
                                $lazy_loaded = true;
                                preg_match_all('#\/chapter-([^/]*?)\/#i', $chap_url, $chnamje);
                                if(isset($chnamje[1][0]))
                                {
                                    $chap_name = 'Chapter ' . $chnamje[1][0];
                                }
                                else
                                {
                                    $chap_name = 'Chapter ' . rand();
                                }
                                $chapters[] = array(
                                    'name'        => $chap_name,
                                    'url'         => $chap_url
                                );
                            }
                            $ums_max_chapters = $max;
                            if($reverse_chapters == '1')
                            {
                                $reverse = true;
                            }
                            else
                            {
                                $reverse = false;
                            }
                            if($reverse == true)
                            {
                                $chapters = array_reverse($chapters);
                            }
                            $local_imported = 0;
                            $new_chap = false;
                            if($lazy_loaded == true)
                            {
                                $chapid = 1;
                                while(count($chapters) != 0)
                                {
                                    $randsleep = rand(500,1000);
                                    usleep($randsleep * 1000);
                                    $chaps = $chapters[0];
                                    if($ums_max_chapters <= $local_imported)
                                    {
                                        break;
                                    }
                                    if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                        ums_log_to_file('Processing novel chapter: ' . $chaps['url']);
                                    }
                                    $page_html = ums_get_web_page($chaps['url'], ums_get_random_user_agent(), $use_phantom, $phantom_wait);
                                    if( $page_html == false ){
                                        ums_log_to_file('Failed to download HTML for current chapter: ' . $chaps['name']);
                                        break;;
                                    }
                                    if(stristr($page_html, 'Cloudflare Ray ID:') !== false)
                                    {
                                        ums_log_to_file('CloudFlare protection active on chapter, access is limited! Please install puppeteer on your site and set the "Content Scraping Method To Use" to Puppeteer for scraping to work. Chapter URL: ' . $chaps['url']);
                                        sleep(1);
                                        break;
                                    }
                                    $html = ums_str_get_html( $page_html );
                                    if( empty( $html ) ){
                                        ums_log_to_file('Failed to parse HTML for current chapter: ' . $chaps['name']);
                                        break;
                                    }
                                    $chapid++;
                                    preg_match_all('#<div class="cha-tit skiptranslate">\s*<h3>([^<]*?)<\/h3>#i', $page_html, $titli);
                                    if(isset($titli[1][0]))
                                    {
                                        $chaps['name'] = $titli[1][0];
                                    }
                                    else
                                    {
                                        preg_match_all('#<li class="active">\s*?([^<]*?)\s*?<\/li>#i', $page_html, $titli);
                                        if(isset($titli[1][0]))
                                        {
                                            $chaps['name'] = $titli[1][0];
                                        }
                                    }
                                    preg_match_all('#<a\s*href="([^"]*?)"\s*class="btn next_page"#i', $page_html, $zurli);
                                    if(isset($zurli[1][0]))
                                    {
                                        $dummy_chap = array(
                                            'name'        => 'Chapter ' . $chapid,
                                            'url'         => $zurli[1][0]
                                        );
                                        update_post_meta($existing_post_id, 'ums_latest_scraped', $zurli[1][0]);
                                    }
                                    else
                                    {
                                        $dummy_chap = false;
                                    }
                                    if($dummy_chap !== false)
                                    {
                                        $chapters = array($dummy_chap);
                                    }
                                    else
                                    {
                                        $chapters = array();
                                    }
                                    $slugified_name = $wp_manga_storage->slugify( $chaps['name'] );
                                    $chapter_2 = $wp_manga_chapter->get_chapter_by_slug( $existing_post_id, $slugified_name );
                                    if($chapter_2 && strtolower($chapter_2['chapter_slug']) == strtolower($slugified_name))
                                    {
                                        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                            ums_log_to_file('Chapter is already published, skipping it: ' . $chapter_2['chapter_name']);
                                        }
                                        continue;
                                    }
                                    $content = '';
                                    $doc = new DOMDocument;
                                    $internalErrors = libxml_use_internal_errors(true);
                                    $doc->loadHTML('<?xml encoding="utf-8" ?>' . $page_html);
                                    libxml_use_internal_errors($internalErrors);
                                    $xpath = new \DOMXpath($doc);
                                    $articles = $xpath->query('//*[contains(@class, "text-left")]');
                                    if($articles !== false && count($articles) > 0)
                                    {
                                        foreach($articles as $container) 
                                        {
                                            if(method_exists($container, 'saveHTML'))
                                            {
                                                $content .= ' ' . $container->saveHTML();
                                            }
                                            elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                            {
                                                $content .= ' ' . $container->ownerDocument->saveHTML($container);
                                            }
                                            elseif(isset($container->nodeValue))
                                            {
                                                $content .= ' ' . $container->nodeValue;
                                            }
                                            break;
                                        }
                                    }
                                    if(empty($content)) 
                                    {
                                        $articles = $xpath->query('//*[contains(@class, "content-body")]');
                                        if($articles !== false && count($articles) > 0)
                                        {
                                            foreach($articles as $container) 
                                            {
                                                if(method_exists($container, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->saveHTML();
                                                }
                                                elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->ownerDocument->saveHTML($container);
                                                }
                                                elseif(isset($container->nodeValue))
                                                {
                                                    $content .= ' ' . $container->nodeValue;
                                                }
                                            }
                                        }
                                    }
                                    if(empty($content)) 
                                    {
                                        $articles = $xpath->query('//*[contains(@class, "cha-tit")]');
                                        if($articles !== false && count($articles) > 0)
                                        {
                                            foreach($articles as $container) 
                                            {
                                                if(method_exists($container, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->saveHTML();
                                                }
                                                elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->ownerDocument->saveHTML($container);
                                                }
                                                elseif(isset($container->nodeValue))
                                                {
                                                    $content .= ' ' . $container->nodeValue;
                                                }
                                            }
                                        }
                                        $articles = $xpath->query('//*[contains(@class, "cha-content")]');
                                        if($articles !== false && count($articles) > 0)
                                        {
                                            foreach($articles as $container) 
                                            {
                                                if(method_exists($container, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->saveHTML();
                                                }
                                                elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->ownerDocument->saveHTML($container);
                                                }
                                                elseif(isset($container->nodeValue))
                                                {
                                                    $content .= ' ' . $container->nodeValue;
                                                }
                                            }
                                        }
                                    }
                                    if(empty($content)) 
                                    {
                                        $ccontent = $html->find('.reading-content .text-left .cha-words .cha-words');
                                        if($ccontent) 
                                        {
                                            $content = '';
                                            foreach($ccontent as $xct)
                                            {
                                                $other_ps = $xct->find('p');
                                                if(count($other_ps) > 0)
                                                {
                                                    $text = '';
                                                    foreach($other_ps as $p)
                                                    {
                                                        $text .= '<p> ' . $p->plaintext . '</p>';
                                                    }
                                                    $content .= $text . '<hr/>';
                                                } 
                                                else 
                                                {
                                                    $content .= $xct->innertext . '<hr/>';
                                                }
                                            }
                                        }
                                        else 
                                        {
                                            if($html->find('.reading-content #content', 0))
                                            {
                                                $content = $html->find('.reading-content #content', 0)->innertext;
                                            } 
                                            else 
                                            {
                                                $ccontent = $html->find('.reading-content .text-left .cha-content .cha-words');
                                                if($ccontent) 
                                                {
                                                    $content = '';
                                                    foreach($ccontent as $xct)
                                                    {
                                                        $content .= $xct->innertext . '<hr/>';
                                                    }
                                                } 
                                                else 
                                                {
                                                    $content = $html->find('.reading-content .text-left', 0);
                                                    if($content)
                                                    {
                                                        $other_ps = $content->find('p');
                                                        if(count($other_ps) > 0)
                                                        {
                                                            $text = '';
                                                            foreach($other_ps as $p)
                                                            {
                                                                $text .= '<p> ' . $p->plaintext . '</p>';
                                                            }
                                                            $content = $text;
                                                        } 
                                                        else 
                                                        {							
                                                            if($inner_content = $content->find('#chapter-content', 0))
                                                            {
                                                                $content = $inner_content->innertext;
                                                            }
                                                            else
                                                            {
                                                                if($inner_content = $content->find('.text-left', 0))
                                                                {
                                                                    $content = $inner_content->innertext;
                                                                }
                                                                else
                                                                {
                                                                    if($inner_content = $content->find('.fr-view', 0))
                                                                    {
                                                                        $content = $inner_content->innertext;
                                                                    }
                                                                    else
                                                                    {
                                                                        $content = $content->innertext;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                            if(!$content)
                                            {
                                                $content = '';
                                                $ps = $html->find('.reading-content .text-left p');
                                                foreach($ps as $p)
                                                {
                                                    $content .= '<p>' . $p->plaintext . '</p>';
                                                }
                                            }
                                        }
                                    }
                                    $content = preg_replace('#(?:my)?[.]?b[.\s]?o[.\s]?x[.\s]?n[.\s]?o[.\s]?v[.\s]?e[.\s]?l[.]?(?:\s?.c[o0]m)?#i', get_bloginfo('name'), $content);
                                    $qtags = array('iframe', 'script', 'ins');
                                    foreach ($qtags as $qtag) {
                                        $regex = '#<\s*' . $qtag . '[^>]*>.*?<\s*/\s*'. $qtag . '>#msi';
                                        $content = preg_replace($regex, '', $content);
                                    }
                                    $content = preg_replace('#<style([\s\S]+?)<\/style>#i', '', $content);
                                    $content = preg_replace('#<\/?div([^>]*)>#i', '', $content);
                                    if($strip_images == '1')
                                    {
                                        $content = ums_sanitize_html_content($content);
                                    }
                                    $chapter_content = trim($content);
                                    $chapter_content = ums_strip_links($chapter_content);
                                    if($chapter_content == '')
                                    {
                                        
                                        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                            ums_log_to_file('Skipping current chapter (because it failed to parse first chapter content): ' . print_r($chaps['url'], true));
                                        }
                                        //new_chap true to prevent infinite running
                                        $new_chap = true;
                                        break;
                                    }
                                    $arr = ums_spin_and_translate($chaps['name'], $chapter_content, $rule_translate, 'en');
                                    if($arr === false)
                                    {
                                        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                            ums_log_to_file('Skipping current chapter (because it failed to be translated): ' . print_r($chaps['url'], true));
                                        }
                                    }
                                    elseif($no_translate_title != '1')
                                    {
                                        $chaps['name']              = $arr[0];
                                        $chaps['extend_name']       = $arr[0];
                                        $chapter_content = $arr[1];
                                    }
                                    global $wp_manga_text_type;
                                    if(empty($chaps['name']))
                                    {
                                        $chaps['name'] = 'Novel';
                                    }
                                    if($chaps['name'] == '')
                                    {
                                        $xext_name = $name_str . ' ' . $chaps['extend_name'];
                                    }
                                    else
                                    {
                                        $xext_name = '';
                                    }
                                    if($xext_name == '')
                                    {
                                        $chapsx = explode('-', $chaps['name']);
                                        if(isset($chapsx[1]))
                                        {
                                            $xext_name = trim($chapsx[1]);
                                            $chaps['name'] = trim($chapsx[0]);
                                        }
                                    }
                                    $chapter_args = array(
                                        'post_id'             => $existing_post_id,
                                        'chapter_name'        => $chaps['name'],
                                        'chapter_name_extend' => $xext_name,
                                        'volume_id'           => '',
                                        'chapter_content'     => $chapter_content,
                                    );
                                    $slugified_name = $wp_manga_storage->slugify( $chaps['name'] );
                                    $chapter_2 = $wp_manga_chapter->get_chapter_by_slug( $existing_post_id, $slugified_name );
                                    if($chapter_2 && strtolower($chapter_2['chapter_slug']) == strtolower($slugified_name))
                                    {
                                        ums_log_to_file('Chapter name already published, we will skip: ' . $chapter_2['chapter_name']);
                                        continue; 
                                    }
                                    else
                                    {
                                        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                            ums_log_to_file('Now publishing: ' . print_r($chaps['name'], true));
                                        }
                                    }
                                    $chapter_id = $wp_manga_text_type->insert_chapter( $chapter_args );
                                    if( $chapter_id ){
                                        if( is_wp_error( $chapter_id ) ){
                                            ums_log_to_file('Failed to insert new chapter: ' . $chaps['name'] . ' error: ' . $chapter_id->get_error_message());
                                            continue;
                                        }
                                        else
                                        {
                                            $new_chap = true;
                                            $ums_imported_chapters++;
                                            $local_imported++;
                                        }
                                    }
                                    if (isset($ums_Main_Settings['request_timeout']) && $ums_Main_Settings['request_timeout'] != '') {
                                        $timeout = intval($ums_Main_Settings['request_timeout']);
                                    } else {
                                        $timeout = 1;
                                    }
                                    sleep($timeout);
                                }
                            }
                            else
                            {
                                foreach($chapters as $chaps)
                                {
                                    if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                        ums_log_to_file('Processing novel chapter (no lazyload): ' . $chaps['url']);
                                    }
                                    if($ums_max_chapters <= $local_imported)
                                    {
                                        break;
                                    }
                                    $slugified_name = $wp_manga_storage->slugify( $chaps['name'] );
                                    $chapter_2 = $wp_manga_chapter->get_chapter_by_slug( $existing_post_id, $slugified_name );
                                    if($chapter_2 && strtolower($chapter_2['chapter_slug']) == strtolower($slugified_name))
                                    {
                                        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                            ums_log_to_file('Chapter already published, skipping it: ' . $chapter_2['chapter_name']);
                                        }
                                        continue;
                                    }
                                    $page_html = ums_get_web_page($chaps['url'], ums_get_random_user_agent(), $use_phantom, $phantom_wait);
                                    if( $page_html == false ){
                                        ums_log_to_file('Failed to download HTML for chapter: ' . $chaps['name']);
                                        continue;
                                    }
                                    $html = ums_str_get_html( $page_html );
                                    if( empty( $html ) ){
                                        ums_log_to_file('Failed to parse HTML for chapter: ' . $chaps['name']);
                                        continue;
                                    }
                                    $content = '';
                                    $doc = new DOMDocument;
                                    $internalErrors = libxml_use_internal_errors(true);
                                    $doc->loadHTML('<?xml encoding="utf-8" ?>' . $page_html);
                                    libxml_use_internal_errors($internalErrors);
                                    $xpath = new \DOMXpath($doc);
                                    $articles = $xpath->query('//*[contains(@class, "text-left")]');
                                    if($articles !== false && count($articles) > 0)
                                    {
                                        foreach($articles as $container) 
                                        {
                                            if(method_exists($container, 'saveHTML'))
                                            {
                                                $content .= ' ' . $container->saveHTML();
                                            }
                                            elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                            {
                                                $content .= ' ' . $container->ownerDocument->saveHTML($container);
                                            }
                                            elseif(isset($container->nodeValue))
                                            {
                                                $content .= ' ' . $container->nodeValue;
                                            }
                                            break;
                                        }
                                    }
                                    if(empty($content)) 
                                    {
                                        $articles = $xpath->query('//*[contains(@class, "content-body")]');
                                        if($articles !== false && count($articles) > 0)
                                        {
                                            foreach($articles as $container) 
                                            {
                                                if(method_exists($container, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->saveHTML();
                                                }
                                                elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->ownerDocument->saveHTML($container);
                                                }
                                                elseif(isset($container->nodeValue))
                                                {
                                                    $content .= ' ' . $container->nodeValue;
                                                }
                                            }
                                        }
                                    }
                                    if(empty($content)) 
                                    {
                                        $articles = $xpath->query('//*[contains(@class, "cha-tit")]');
                                        if($articles !== false && count($articles) > 0)
                                        {
                                            foreach($articles as $container) 
                                            {
                                                if(method_exists($container, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->saveHTML();
                                                }
                                                elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->ownerDocument->saveHTML($container);
                                                }
                                                elseif(isset($container->nodeValue))
                                                {
                                                    $content .= ' ' . $container->nodeValue;
                                                }
                                            }
                                        }
                                        $articles = $xpath->query('//*[contains(@class, "cha-content")]');
                                        if($articles !== false && count($articles) > 0)
                                        {
                                            foreach($articles as $container) 
                                            {
                                                if(method_exists($container, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->saveHTML();
                                                }
                                                elseif(isset($container->ownerDocument) && method_exists($container->ownerDocument, 'saveHTML'))
                                                {
                                                    $content .= ' ' . $container->ownerDocument->saveHTML($container);
                                                }
                                                elseif(isset($container->nodeValue))
                                                {
                                                    $content .= ' ' . $container->nodeValue;
                                                }
                                            }
                                        }
                                    }
                                    if(empty($content)) 
                                    {
                                        $content = $html->find('.reading-content .text-left .cha-words .cha-words', 0);
                                        if($content) 
                                        {
                                            $other_ps = $content->find('p');
                                            if(count($other_ps) > 0)
                                            {
                                                $text = '';
                                                foreach($other_ps as $p)
                                                {
                                                    $text .= '<p> ' . $p->plaintext . '</p>';
                                                }
                                                $content = $text;
                                            } 
                                            else 
                                            {
                                                $content = $content->innertext;
                                            }
                                        }
                                        else 
                                        {
                                            if($html->find('.reading-content #content', 0))
                                            {
                                                $content = $html->find('.reading-content #content', 0)->innertext;
                                            } 
                                            else 
                                            {
                                                $content = $html->find('.reading-content .text-left .cha-content .cha-words', 0);
                                                if($content) 
                                                {
                                                    $content = $content->innertext;
                                                } 
                                                else 
                                                {
                                                    $content = $html->find('.reading-content .text-left', 0);
                                                    if($content)
                                                    {
                                                        $other_ps = $content->find('p');
                                                        if(count($other_ps) > 0)
                                                        {
                                                            $text = '';
                                                            foreach($other_ps as $p)
                                                            {
                                                                $text .= '<p> ' . $p->plaintext . '</p>';
                                                            }
                                                            $content = $text;
                                                        } 
                                                        else 
                                                        {							
                                                            if($inner_content = $content->find('#chapter-content', 0))
                                                            {
                                                                $content = $inner_content->innertext;
                                                            }
                                                            else
                                                            {
                                                                if($inner_content = $content->find('.text-left', 0))
                                                                {
                                                                    $content = $inner_content->innertext;
                                                                }
                                                                else
                                                                {
                                                                    if($inner_content = $content->find('.fr-view', 0))
                                                                    {
                                                                        $content = $inner_content->innertext;
                                                                    }
                                                                    else
                                                                    {
                                                                        $content = $content->innertext;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                            if(!$content)
                                            {
                                                $content = '';
                                                $ps = $html->find('.reading-content .text-left p');
                                                foreach($ps as $p)
                                                {
                                                    $content .= '<p>' . $p->plaintext . '</p>';
                                                }
                                            }
                                        }
                                    }
                                    $content = preg_replace('#(?:my)?[.]?b[.\s]?o[.\s]?x[.\s]?n[.\s]?o[.\s]?v[.\s]?e[.\s]?l[.]?(?:\s?.c[o0]m)?#i', get_bloginfo('name'), $content);
                                    $content = str_ireplace($domain, get_bloginfo('name'), $content);
                                    $qtags = array('iframe', 'script', 'ins');
                                    foreach ($qtags as $qtag) {
                                        $regex = '#<\s*' . $qtag . '[^>]*>.*?<\s*/\s*'. $qtag . '>#msi';
                                        $content = preg_replace($regex, '', $content);
                                    }
                                    $content = preg_replace('#<style([\s\S]+?)<\/style>#i', '', $content);
                                    $content = preg_replace('#<\/?div([^>]*)>#i', '', $content);
                                    if($strip_images == '1')
                                    {
                                        $content = ums_sanitize_html_content($content);
                                    }
                                    $chapter_content = trim($content);
                                    $chapter_content = ums_strip_links($chapter_content);
                                    $arr = ums_spin_and_translate($chaps['name'], $chapter_content, $rule_translate, 'en');
                                    if($arr === false)
                                    {
                                        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                            ums_log_to_file('Skipping chapter (because it failed to be translated): ' . print_r($post_args, true));
                                        }
                                    }
                                    elseif($no_translate_title != '1')
                                    {
                                        $chaps['name']              = $arr[0];
                                        $chaps['extend_name']       = $arr[0];
                                        $chapter_content = $arr[1];
                                    }
                                    global $wp_manga_text_type;
                                    if(empty($chaps['name']))
                                    {
                                        $xext_name = $name_str . ' ' . $chaps['extend_name'];
                                        $chaps['name'] = 'Novel';
                                    }
                                    else
                                    {
                                        $xext_name = '';
                                    }
                                    if($xext_name == '')
                                    {
                                        $chapsx = explode('-', $chaps['name']);
                                        if(isset($chapsx[1]))
                                        {
                                            $xext_name = trim($chapsx[1]);
                                            $chaps['name'] = trim($chapsx[0]);
                                        }
                                    }
                                    $chapter_args = array(
                                        'post_id'             => $existing_post_id,
                                        'chapter_name'        => $chaps['name'],
                                        'chapter_name_extend' => $xext_name,
                                        'volume_id'           => '',
                                        'chapter_content'     => $chapter_content,
                                    );
                                    $slugified_name = $wp_manga_storage->slugify( $chaps['name'] );
                                    $chapter_2 = $wp_manga_chapter->get_chapter_by_slug( $existing_post_id, $slugified_name );
                                    if($chapter_2 && strtolower($chapter_2['chapter_slug']) == strtolower($slugified_name))
                                    {
                                        ums_log_to_file('Chapter name already published, skipping it: ' . $chapter_2['chapter_name']);
                                        continue; 
                                    }
                                    $chapter_id = $wp_manga_text_type->insert_chapter( $chapter_args );
                                    if( $chapter_id ){
                                        if( is_wp_error( $chapter_id ) ){
                                            ums_log_to_file('Failed to insert chapter: ' . $chaps['name'] . ' error: ' . $chapter_id->get_error_message());
                                            continue;
                                        }
                                        else
                                        {
                                            $new_chap = true;
                                            $ums_imported_chapters++;
                                            $local_imported++;
                                        }
                                    }
                                    if (isset($ums_Main_Settings['request_timeout']) && $ums_Main_Settings['request_timeout'] != '') {
                                        $timeout = intval($ums_Main_Settings['request_timeout']);
                                    } else {
                                        $timeout = 1;
                                    }
                                    sleep($timeout);
                                }
                            }
                            if($new_chap == true)
                            {
                                if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                    ums_log_to_file('Total novel chapters scraped: ' . $local_imported);
                                }
                                $scraped_manga++;
                            }                            
                        }
                    }
                    catch(Exception $e)
                    {
                        ums_log_to_file('Importing failed: ' . $e->getMessage());
                        if($auto == 1)
                        {
                            ums_clearFromList($param, $type);
                        }
                        return 'fail';
                    }
                }
            }
            elseif($type == 5)
            {
                if(trim($max_manga) != '')
                {
                    $get_max_manga = intval(trim($max_manga));
                }
                else
                {
                    $get_max_manga = 999;
                }
                $items = array();
                $page_increased = false;
                {
                    $manga_arr = array();
                    try
                    {
                        global $wp_filesystem;
                        if ( ! is_a( $wp_filesystem, 'WP_Filesystem_Base') ){
                            include_once(ABSPATH . 'wp-admin/includes/file.php');$creds = request_filesystem_credentials( site_url() );
                            wp_filesystem($creds);
                        }
                        $manga_names = explode(',', $manga_name);
                        $manga_names = array_map('trim', $manga_names);
                        $manga_arr = $manga_names;
                        if(count($manga_arr) == 0)
                        {
                            ums_log_to_file('No Manga matched your query: ' . $manga_name);
                            return 'nochange';
                        }
                        $scraped_manga = 0;
                        $user_name_type = $post_user_name;
                        foreach($manga_arr as $ind => $current_manga)
                        {
                            $parsedUrl = parse_url($current_manga);
                            if($parsedUrl === false)
                            {
                                ums_log_to_file('Cannot parse URL: ' . $current_manga);
                                continue;
                            }
                            if(!isset($parsedUrl['host']))
                            {
                                ums_log_to_file('Incorrect URL submitted: ' . $current_manga);
                                continue;
                            }
                            if(!isset($parsedUrl['path']) || empty($parsedUrl['path']))
                            {
                                ums_log_to_file('Incorrect URL format submitted: ' . $current_manga);
                                continue;
                            }
                            $domain = $parsedUrl['host'];

                            $path = trim($parsedUrl['path'], '/');

                            $pathParts = explode('/', $path);

                            $firstDirectory = isset($pathParts[0]) ? $pathParts[0] : '';


                            $html_site = false;
                            if($get_max_manga <= $scraped_manga)
                            {
                                break;
                            }
                            if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                ums_log_to_file('Starting scraping for: (' . $ind . ') ' . $current_manga);
                            }
                            $is_url_search = true;
                            {
                                $html_site = ums_get_web_page($current_manga, ums_get_random_user_agent(), $use_phantom);
                                if($html_site == false)
                                {
                                    ums_log_to_file('Failed to download manga pages: ' . $html_site);
                                    usleep(rand(500000, 1000000));
                                    continue;
                                }
                                else
                                {
                                    if(strstr($html_site, '<html lang="en-US"><head><title>Just a moment...</title>') !== false)
                                    {
                                        ums_log_to_file('This page is protected by CloudFlare, please try scraping it using Puppeteer: ' . $current_manga);
                                        usleep(rand(500000, 1000000));
                                        continue;
                                    }
                                    preg_match_all('#<li[^>]*?class="[^"]*?wp-manga-chapter[^"]*?"[^>]*?>[\s\n]*?<a[^>]*?href="([^"]*?)"#i', $html_site, $azurli);
                                    if(isset($azurli[1][0]))
                                    {
                                        $current_manga = end($azurli[1]);
                                    }
                                    else
                                    {
                                        preg_match_all('#<a[^>]*?href="([^"]*?)"[^>]*?id="?btn-read-last"?#i', $html_site, $azurli);
                                        if(isset($azurli[1][0]))
                                        {
                                            $current_manga = end($azurli[1]);
                                        }
                                        else
                                        {
                                            $is_url_search = false;
                                            $possible = array('chapter-0', 'chapter-1', '0', 'n-a', '00', '1', '01');
                                            $foundit = false;
                                            foreach($possible as $pp)
                                            {
                                                $try_me = rtrim($current_manga, '/') . '/' . $pp;
                                                $html_sitex = ums_get_web_page($try_me, ums_get_random_user_agent(), $use_phantom);
                                                if($html_sitex == false)
                                                {
                                                    ums_log_to_file('Failed to download guessing pages: ' . $html_sitex);
                                                    usleep(rand(500000, 1000000));
                                                    continue;
                                                }
                                                if(strstr($html_sitex, '<html lang="en-US"><head><title>Just a moment...</title>') !== false)
                                                {
                                                    ums_log_to_file('This page is protected by CloudFlare, please try scraping it using Puppeteer: ' . $try_me);
                                                    usleep(rand(500000, 1000000));
                                                    continue;
                                                }
                                                preg_match_all('#<a\s*href="([^"]*?)"\s*class="btn next_page"#i', $html_sitex, $xzurli);
                                                if(isset($xzurli[1][0]))
                                                {
                                                    $current_manga = $try_me;
                                                    $foundit = true;
                                                    usleep(rand(500000, 1000000));
                                                    break;
                                                }
                                                preg_match_all('#<img id="(?:[^"]*?)" data-src="([^"]*?)" class="wp-manga-chapter-img#i', $html_sitex, $zurli);
                                                if(isset($zurli[1][0]))
                                                {
                                                    $current_manga = $try_me;
                                                    $foundit = true;
                                                    usleep(rand(500000, 1000000));
                                                    break;
                                                }
                                                usleep(rand(500000, 1000000));
                                            }
                                            if($foundit == false)
                                            {
                                                ums_log_to_file('Failed to find first chapter URL for: ' . $current_manga);
                                                continue;
                                            }
                                        }
                                    }
                                }
                            }
                            $latest_chapter = $current_manga;
                            if($html_site === false)
                            {
                                $html_site = ums_get_web_page($current_manga, ums_get_random_user_agent(), $use_phantom);
                                if($html_site == false)
                                {
                                    ums_log_to_file('Failed to download manga chapter: ' . $current_manga);
                                    continue;
                                }
                                if(strstr($html_site, '<html lang="en-US"><head><title>Just a moment...</title>') !== false)
                                {
                                    ums_log_to_file('This page is protected by CloudFlare, please try scraping it using Puppeteer: ' . $current_manga);
                                    usleep(rand(500000, 1000000));
                                    continue;
                                }
                            }
                            require_once (dirname(__FILE__) . "/res/simple_html_dom.php"); 
                            $html = ums_str_get_html( $html_site );
                            $tag = $html->find( '.profile-manga .post-title h1', 0 );
                            $name_str = '';
                            $my_slug = '';
                            $my_slug = str_replace( 'http://', '', $current_manga );
                            $my_slug = str_replace( 'https://', '', $my_slug );
                            $my_slug = str_replace( 'http:', '', $my_slug );
                            $my_slug = str_replace( $domain . '/' . $firstDirectory . '/', '', $my_slug );
                            $my_slug = str_replace( '/', '', $my_slug );
                            $my_slug = str_replace( '.html', '', $my_slug );
                            $my_slug = str_replace( '.htm', '', $my_slug );
                            if($tag){
                                $name_str = trim($tag->plaintext);
                                $span = $tag->find('span', 0);
                                if($span){
                                    $name_str = trim(str_replace($span->plaintext,'', $name_str));
                                }
                            }
                            if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                ums_log_to_file('Processing manga: ' . $name_str);
                            }
                            $find_post = new WP_Query( array(
                                'title'     => $name_str,
                                'post_type' => 'wp-manga',
                            ) );
                            $existing_post_id = false;
                            if( $find_post->have_posts() )
                            {
                                $existing_post_id = $find_post->posts[0]->ID;
                            }
                            if($existing_post_id == false)
                            {
                                $args = array(
                                    'post_type'  => 'wp-manga',
                                    'meta_key'   => '_manga_import_slug',
                                    'meta_value' => $my_slug,
                                    'post_status' => array('publish','draft','pending','trash','private','future')
                                );
                                $query = new WP_Query( $args );
                                if( $query->have_posts() ){
                                    $existing_post_id = $query->posts[0]->ID;
                                }
                            }
                            if($existing_post_id == false)
                            {
                                $block_warning = $html->find('#page .warning', 0);
                                if( !empty( $block_warning ) && strpos( $block_warning->plaintext, 'has been licensed, it is not available' ) !== false ){
                                    ums_log_to_file('Request blocked, please use a proxy!');
                                    continue;
                                }
                                $desc = $html->find( '.description-summary' );
                                $desc = !empty( $desc ) ? trim($desc[0]->plaintext) : '';
                                $desc = str_replace($domain, '',$desc);
                                $thumb = '';
                                $thumb = $html->find( '.summary_image .img-responsive' );
                                $thumb = !empty( $thumb ) ? $thumb[0]->{'data-src'} : '';
                                if($thumb == '')
                                {
                                    $thumb = !empty( $thumb ) ? $thumb[0]->src : '';
                                }
                                if($thumb == '')
                                {
                                    $thumb = $html->find( '.summary_image' );
                                    $thumb = !empty( $thumb ) ? $thumb[0]->src : '';
                                }
                                if($thumb == '')
                                {
                                    preg_match_all('#<div class="summary_image">[\s\n]*<a href="[^"]*?">[\s\n]*<img[^>]*?src="([^"]*?)"#i', $html_site, $xmathc);
                                    if(isset($xmathc[1][0]))
                                    {
                                        $thumb = trim($xmathc[1][0]);
                                    }
                                }
                                if(empty($thumb))
                                {
                                    preg_match_all('#<meta\s*property="og:image"\s*content="([^"]*?)"\s*\/?>#i', $html_site, $imatch);
                                    if(isset($imatch[1][0]))
                                    {
                                        $thumb = trim($imatch[1][0]);
                                    }
                                }
                                $status = 'ongoing';
                                preg_match_all('#Status(?:[\n\s]*?)<\/h5>(?:[\n\s]*?)<\/div>(?:[\n\s]*?)<div class="summary-content">(?:[\n\s]*?)([^<\s]*?)(?:[\n\s]*?)<\/div>#i', $html_site, $smatch);
                                if(isset($smatch[1][0]))
                                {
                                    $status = trim($smatch[1][0]);
                                }
                                if(stristr($status, 'ongoing') !== false)
                                {
                                    $status = 'on-going';
                                }
                                elseif(stristr($status, 'completed') !== false)
                                {
                                    $status = 'end';
                                }
                                elseif(stristr($status, 'canceled') !== false)
                                {
                                    $status = 'canceled';
                                }
                                elseif(stristr($status, 'on hold') !== false)
                                {
                                    $status = 'on-hold';
                                }
                                elseif(stristr($status, 'upcoming') !== false)
                                {
                                    $status = 'upcoming';
                                }
                                $alter_name = '';
                                preg_match_all('#Alternative(?:[\n\s]*?)<\/h5>(?:[\n\s]*?)<\/div>(?:[\n\s]*?)<div class="summary-content">(?:[\n\s]*?)([^<\s]*?)(?:[\n\s]*?)<\/div>#i', $html_site, $smatch);
                                if(isset($smatch[1][0]))
                                {
                                    $alter_name = trim($smatch[1][0]);
                                }
                                $data = $html->find( '.summary_content .post-content .post-content_item' );
                                $xtype = '';
                                if( !empty( $data ) ){
                                    foreach($data as $item){
                                        if(trim($item->find('.summary-heading h5',0)->plaintext) == 'Type'){
                                            $xtype = $item->find('.summary-content', 0)->plaintext;
                                            if(trim($xtype) == 'Updating')
                                            {
                                                $xtype = '';
                                            }
                                        }
                                    }
                                }
                                $xrelease = '2021';
                                preg_match_all('#<a href="https:\/\/' . addslashes($domain) . '\/manga-release\/(?:[^"]*?)" rel="tag">([^<]+?)<\/a>#i', $html_site, $xmathc);
                                if(isset($xmathc[1][0]))
                                {
                                    $xrelease = trim($xmathc[1][0]);
                                }
                                $xauthor = '';
                                $author = '';
                                $data = $html->find( '.author-content a' );
                                if( !empty( $data ) ){
                                    $authors = array();
                                    foreach($data as $arxthor)
                                    {
                                        array_push($authors, $arxthor->plaintext);
                                        if($author == '')
                                        {
                                            $author = $arxthor->plaintext;
                                        }
                                    }
                                    $xauthor = implode(',', $authors);
                                }

                                $xartists = '';
                                $data = $html->find( '.artist-content a' );
                                if( !empty( $data ) ){
                                    $artists = array();
                                    foreach($data as $artist){
                                        array_push($artists, $artist->plaintext);
                                    }
                                    $xartists = implode(',', $artists);
                                }
                                $xgenres = '';
                                $data = $html->find( '.genres-content a' );
                                if( !empty( $data ) ){
                                    $genres = array();
                                    foreach($data as $genre){
                                        array_push($genres, $genre->plaintext);
                                    }
                                    $xgenres = implode(',', $genres);
                                }
                                $items = $html->find('.summary_content .post-content .post-content_item');
                                $views = '';
                                foreach($items as $item){
                                    if(trim($item->find('.summary-heading', 0)->plaintext) == 'Rank'){
                                        $str = $item->find('.summary-content',0)->plaintext;
                                        preg_match_all('~\d+(?:\.\d+)?~', $str, $matches);
                                        if($matches){
                                            if(count($matches) == 3 && isset($matches[0][1])){
                                                $views = $matches[0][1];
                                            } elseif(isset($matches[0][0])) {
                                                $views = $matches[0][0];
                                            }
                                            else
                                            {
                                                $views = rand(30, 1000);
                                            }
                                            if(strpos($str, 'K monthly views') !== false){
                                                $views = floatval($views) * 1000;
                                            }
                                            if(strpos($str, 'M monthly views') !== false){
                                                $views = floatval($views) * 1000000;
                                            }
                                            break;
                                        }
                                    }
                                }
                                $average_vote = $html->find('.post-total-rating .total_votes', 0);
                                $str = $html->find('.vote-details',0);
                                $xrating = array();
                                if(!empty($str))
                                {
                                    preg_match_all('!\d+!', $str, $matches);
                                    $number_votes = 1;
                                    if($matches && count($matches[0]) == 3)
                                    {
                                        $number_votes = $matches[0][2];
                                    }
                                    if( !empty( $average_vote ) && $average_vote->plaintext > 0 ){
                                        $xrating = array(
                                            'avg'     => $average_vote->plaintext,
                                            'numbers' => $number_votes
                                        );
                                    }
                                }
                                $xtags = '';
                                $data = $html->find( '.wp-manga-tags-list a' );
                                if( !empty( $data ) ){
                                    $tags = array();
                                    foreach($data as $tag){
                                        array_push($tags, trim($tag->plaintext));
                                    }
                                    $xtags = implode(',', $tags);
                                }
                                $xtime_year = '';
                                $time_year = strtotime($xrelease);
                                if($time_year !== false)
                                {
                                    $time_year = date("Y", $time_year);
                                    if($time_year !== false)
                                    {
                                        $xtime_year = $time_year;
                                    }
                                }
                                $post_args = array(
                                    'manga_import_slug' => $my_slug,
                                    'title'             => $name_str,
                                    'post_status'       => $post_status,
                                    'description'       => $desc,
                                    'thumb'             => $thumb,
                                    'status'            => $status,
                                    'altername'         => strip_tags( $alter_name ),
                                    'type'              => strip_tags( $xtype ),
                                    'release'           => $xtime_year,
                                    'authors'           => strip_tags( $xauthor ),
                                    'artists'           => strip_tags( $xartists ),
                                );
                                if(empty(trim($views)) || !is_numeric(strip_tags( $views  )))
                                {
                                    $viewsm = rand(100,500);
                                }
                                else
                                {
                                    $viewsm = strip_tags(trim($views));
                                }
                                $post_args['genres'] = strip_tags( $xgenres );
                                $post_args['views'] = $viewsm;
                                $post_args['ratings'] = $xrating;
                                $post_args['tags'] = strip_tags( $xtags );
                                $post_args['description'] = str_ireplace($domain, $_SERVER['HTTP_HOST'], $post_args['description']);
                                $arr = ums_spin_and_translate($post_args['title'], $post_args['description'], $rule_translate, 'en');
                                if($arr === false)
                                {
                                    if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                        ums_log_to_file('Skipping manga (because it failed to be translated): ' . print_r($post_args, true));
                                    }
                                }
                                if($no_translate_title != '1')
                                {
                                    $post_args['title']              = $arr[0];
                                }
                                $post_args['description']        = $arr[1];
                                $za_xpost_args = array(
                                    'post_title'   => !empty( $post_args['title'] ) ? $post_args['title'] : '',
                                    'post_content' => !empty( $post_args['description'] ) ? $post_args['description'] : '',
                                    'post_type'    => 'wp-manga',
                                    'post_status'  => isset( $post_args['post_status'] ) ? $post_args['post_status'] : 'pending',
                                );
                                $accept_comments = 'closed';
                                if ($enable_comments == '1') {
                                    $accept_comments = 'open';
                                }
                                $za_xpost_args['comment_status'] = $accept_comments;
                                if ($enable_pingback == '1') 
                                {
                                    $za_xpost_args['ping_status'] = 'open';
                                } 
                                else 
                                {
                                    $za_xpost_args['ping_status'] = 'closed';
                                }
                                if($get_date == '1')
                                {
                                    if(!empty($xrelease))
                                    {
                                        $postdatex = gmdate("Y-m-d H:i:s", strtotime($xrelease));
                                        $za_xpost_args['post_date_gmt'] = $postdatex;
                                    }
                                }
                                if($user_name_type == 'rand')
                                {
                                    $randid = ums_display_random_user();
                                    if($randid === false)
                                    {
                                        $za_xpost_args['post_author']               = ums_randomName();
                                    }
                                    else
                                    {
                                        $za_xpost_args['post_author']               = $randid->ID;
                                    }
                                }
                                elseif($user_name_type == 'feed-news')
                                {
                                    $sp_post_user_name = ums_randomName();
                                    if($author == '' || $author == '1' || $author == 'null')
                                    {
                                        $author = ums_randomName();
                                    }
                                    if($author != '')
                                    {
                                        $xauthor = sanitize_user( $author );
                                        $xauthor = apply_filters( 'pre_user_login', $xauthor );
                                        $xauthor = trim( $xauthor );
                                        if(username_exists( $xauthor ))
                                        {
                                            $user_id_t = get_user_by('login', $xauthor);
                                            if($user_id_t)
                                            {
                                                $sp_post_user_name = $user_id_t->ID;
                                            }
                                        }
                                        else
                                        {
                                            $palphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^*()-+=_?><,.;:}{][';
                                            $ppass = '';
                                            $alphaLength = strlen($palphabet) - 1;
                                            for ($ipass = 0; $ipass < 8; $ipass++) 
                                            {
                                                $npass = rand(0, $alphaLength);
                                                $ppass .= $palphabet[$npass];
                                            }
                                            $curr_id = wp_create_user($xauthor, $ppass, ums_generate_random_email());
                                            if ( is_int($curr_id) )
                                            {
                                                $u = new WP_User($curr_id);
                                                $u->remove_role('subscriber');
                                                $u->add_role('author');
                                                $sp_post_user_name               = $curr_id;
                                            }
                                        }
                                    }
                                    $za_xpost_args['post_author']               = ums_utf8_encode($sp_post_user_name);
                                }
                                else
                                {
                                    $za_xpost_args['post_author']               = ums_utf8_encode($post_user_name);
                                }
                                
                                if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                    ums_log_to_file('Inserting new manga: ' . $za_xpost_args['post_title']);
                                }
                                $existing_post_id = wp_insert_post( $za_xpost_args );
                                if( ! $existing_post_id || is_wp_error( $existing_post_id ) ){
                                    ums_log_to_file('Failed to insert manga into db: ' . $post_args['title']);
                                    continue;
                                }
                                add_post_meta($existing_post_id, 'ums_parent_rule', $type . '-' . $param);
                                wp_set_object_terms( $existing_post_id, 'ums_' . $type . '_' . $param, 'coderevolution_post_source', true);
                                if($thumb != '')
                                {
                                    $thumb_id = ums_wp_mcl_e_upload_file( $post_args['thumb'], $use_phantom, $phantom_wait, $existing_post_id );
                                    if($thumb_id === false)
                                    {
                                        include_once( ABSPATH . 'wp-admin/includes/image.php' );
                                        if($use_phantom == '2' || $use_phantom == '4')
                                        {
                                            $img_use_phantom = $use_phantom;
                                        }
                                        else
                                        {
                                            $img_use_phantom = '0';
                                        }
                                        $thcontent = ums_get_web_page($thumb, ums_get_random_user_agent(), $img_use_phantom);
                                        if(strstr($thcontent, '<html lang="en-US"><head><title>Just a moment...</title>') !== false)
                                        {
                                            ums_log_to_file('This page is protected by CloudFlare, please try scraping it using Puppeteer: ' . $thumb);
                                            usleep(rand(500000, 1000000));
                                            $thcontent = false;
                                        }
                                        $pathinfo = pathinfo( $thumb );
                                        if( $thcontent != false ){
                                            if($img_use_phantom == '2' || $use_phantom == '4')
                                            {
                                                $thcontent = base64_decode($thcontent);
                                            }
                                            if( $thcontent !== false )
                                            {
                                                $upload_dir = wp_upload_dir();
                                                $file_tmp_path = $upload_dir['basedir'] . '/' . $pathinfo['filename'] . '-' . $existing_post_id . '.' . explode('?',$pathinfo['extension'])[0];
                                                $file = $wp_filesystem->put_contents( $file_tmp_path, $thcontent );
                                                $wp_filetype = wp_check_filetype(basename($file_tmp_path), null );
                                                $attachment = array(
                                                    'post_mime_type' => $wp_filetype['type'],
                                                    'post_title' => $existing_post_id,
                                                    'post_content' => '',
                                                    'post_status' => 'inherit'
                                                );
                                                $attach_id = wp_insert_attachment( $attachment, $file_tmp_path );
                                                $thumb_id = $attach_id;
                                                $imagenew = get_post( $attach_id );
                                                $fullsizepath = get_attached_file( $imagenew->ID );
                                                require_once( ABSPATH . 'wp-admin/includes/image.php' );
                                                require_once( ABSPATH . 'wp-admin/includes/media.php' );
                                                $attach_data = wp_generate_attachment_metadata( $attach_id, $fullsizepath );
                                                wp_update_attachment_metadata( $attach_id, $attach_data );
                                            }
                                        }
                                    }
                                }
                                else
                                {
                                    $thumb_id = false;
                                }
                                $meta_data = array(
                                    '_manga_import_slug'     => $my_slug,
                                    '_thumbnail_id'          => $thumb_id,
                                    '_wp_manga_alternative'  => strip_tags( $alter_name ),
                                    '_wp_manga_type'         => strip_tags( $xtype ),
                                    '_wp_manga_status'       => $status,
                                    '_wp_manga_chapter_type' => 'manga',
                                    '_wp_manga_chapters_warning'=> $chapter_warning,
                                );
                                foreach( $meta_data as $key => $value ){
                                    if( !empty( $value ) ){
                                        update_post_meta( $existing_post_id, $key, $value );
                                    }
                                }
                                $manga_terms = array(
                                    'wp-manga-release'     => strip_tags( $xrelease ),
                                    'wp-manga-author'      => strip_tags( $xauthor ),
                                    'wp-manga-artist'      => strip_tags( $xartists ),
                                    'wp-manga-genre'       => strip_tags( $xgenres ),
                                    'wp-manga-tag'         => strip_tags( $xtags ),
                                );
                                foreach( $manga_terms as $tax => $term ){
                                    $resp = ums_add_manga_terms( $existing_post_id, $term, $tax );
                                }
                                ums_update_post_views( $existing_post_id, $viewsm );
                                ums_update_post_ratings( $existing_post_id, $xrating );
                            }
                            if($is_url_search)
                            {
                                $skip_posts_temp = get_option('ums_continue_search', array());
                                if(isset($skip_posts_temp[$param]) && $skip_posts_temp[$param] != '')
                                {
                                    if(stristr($skip_posts_temp[$param], $current_manga) === false)
                                    {
                                        $skip_posts_temp[$param] = '';
                                        update_option('ums_continue_search', $skip_posts_temp);
                                        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                            ums_log_to_file('Manga URL changed: ' . $current_manga);
                                        }
                                    }
                                    else
                                    {
                                        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                            ums_log_to_file('Loading last scraped chapter from memory: ' . $skip_posts_temp[$param] . ' (replacing: ' . $latest_chapter . ')');
                                        }
                                        $latest_chapter = $skip_posts_temp[$param];
                                    }
                                }
                            }
                            $ums_max_chapters = $max;
                            $local_imported = 0;
                            $new_chap = false;
                            $cc = 1;
                            while(!empty($latest_chapter) && $latest_chapter != '#')
                            {
                                if($ums_max_chapters <= $local_imported)
                                {
                                    break;
                                }
                                if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                    ums_log_to_file('Processing manga chapter: ' . $latest_chapter);
                                }
                                
                                $page_html = ums_get_web_page($latest_chapter, ums_get_random_user_agent(), $use_phantom);
                                if( $page_html == false ){
                                    ums_log_to_file('Failed to download HTML for chapter: ' . $latest_chapter);
                                    break;
                                }
                                if(strstr($page_html, '<html lang="en-US"><head><title>Just a moment...</title>') !== false)
                                {
                                    ums_log_to_file('This page is protected by CloudFlare, please try scraping it using Puppeteer: ' . $latest_chapter);
                                    usleep(rand(500000, 1000000));
                                    break;
                                }
                                preg_match_all('#<h1[^>]*id="?chapter-heading"?>([^<]*?)<\/h1>#i', $page_html, $tmy);
                                if(!isset($tmy[1][0]))
                                {
                                    preg_match_all('#<li[^>]*class="active">[\s\n]*?([^<]*?)[\s\n]*?<\/li>#i', $page_html, $tmy);
                                    if(!isset($tmy[1][0]))
                                    {
                                        ums_log_to_file('Failed to detect title for chapter: ' . $latest_chapter);
                                        $cname = 'Chapter ' . $cc;
                                        $cc++;
                                        if($is_url_search)
                                        {
                                            $skip_posts_temp[$param] = '';
                                            update_option('ums_continue_search', $skip_posts_temp);
                                        }
                                    }
                                    else
                                    {
                                        $cname = trim($tmy[1][0]);
                                    }
                                }
                                else
                                {
                                    $cname = trim($tmy[1][0]);
                                }
                                $slugified_name = $wp_manga_storage->slugify( $cname );
                                $chapter_2 = $wp_manga_chapter->get_chapter_by_slug( $existing_post_id, $slugified_name );
                                if($chapter_2 && strtolower($chapter_2['chapter_slug']) == strtolower($slugified_name))
                                {
                                    preg_match_all('#<a\s*href="([^"]*?)"\s*class="btn next_page"#i', $page_html, $zurli);
                                    if(isset($zurli[1][0]))
                                    {
                                        $latest_chapter = $zurli[1][0];
                                        if($is_url_search)
                                        {
                                            $skip_posts_temp[$param] = $latest_chapter;
                                            update_option('ums_continue_search', $skip_posts_temp);
                                        }
                                    }
                                    else
                                    {
                                        $latest_chapter = '';
                                    }
                                    ums_log_to_file('Chapter already published, skipping it: ' . $chapter_2['chapter_name']);
                                    continue;
                                }
                                $scans = array();
                                preg_match_all('#<img id="(?:[^"]*?)" (?:data-)?src="([^"]*?)" class="wp-manga-chapter-img#i', $page_html, $zurli);
                                if(isset($zurli[1][0]))
                                {
                                    foreach($zurli[1] as $zuzu)
                                    {
                                        if(trim($zuzu) != '' && trim($zuzu) != '#')
                                        {
                                            $scans[] = trim($zuzu);
                                        }
                                    }
                                }
                                if(empty($scans))
                                {
                                    $scans = ums_extractMangaImages($page_html);
                                }
                                if(empty($scans))
                                {
                                    ums_log_to_file('Failed to extract images for (try using Puppeteer): ' . $chapter_2['chapter_name']);
                                    break;
                                }
                                $mng = array();
                                $mng['title'] = $cname;
                                if (isset($ums_Main_Settings['also_images']) && trim($ums_Main_Settings['also_images']) == 'on')
                                {
                                    $image_use_phantom = $use_phantom;
                                }
                                else
                                {
                                    $image_use_phantom = '0';
                                }
                                $resp = ums_fetch_chapters_generic( $scans, $existing_post_id, $mng, $storage, $name_str, $image_use_phantom);
                                if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                    ums_log_to_file('Response: ' . print_r($resp, true));
                                }
                                if( is_wp_error( $resp ) )
                                {
                                    ums_log_to_file('Failed to download chapter, wperror: ' . print_r($resp, true));
                                }
                                elseif( $resp === false || $resp === null)
                                {
                                    ums_log_to_file('Generic error when downloading chapters.');
                                }
                                elseif( trim($resp) === 'CloudFlare' && isset($ums_Main_Settings['enable_cloudflare']) && $ums_Main_Settings['enable_cloudflare'] == 'on')
                                {
                                    if($auto == 1 && $rerun_count <= 10)
                                    {
                                        sleep(5);
                                        $rerun_count++;
                                        ums_log_to_file('Rerunning scraping using CloudFlare protection ' . $param . ' - ' . $type . ' - ' . $auto . ' - ' . $rerun_count);
                                        $returnx = ums_run_rule($param, $type, $auto, $rerun_count);
                                        return $returnx;
                                    }
                                    return 'nochange';
                                }
                                elseif( trim($resp) == 'ok')
                                {
                                    if (isset($ums_Main_Settings['enable_detailed_logging'])) 
                                    {
                                        ums_log_to_file('Chapter imported OK: ' . $mng['title']);
                                    }
                                    $new_chap = true;
                                    $ums_imported_chapters++;
                                    $local_imported++;
                                }
                                elseif( $resp == true)
                                {
                                    ums_log_to_file('Chapter already existing, skipping it');
                                }
                                else
                                {
                                    ums_log_to_file('Invalid response from call: ' . print_r($resp, true));
                                }
                                if (isset($ums_Main_Settings['request_timeout']) && $ums_Main_Settings['request_timeout'] != '') 
                                {
                                    $timeout = intval($ums_Main_Settings['request_timeout']);
                                } 
                                else 
                                {
                                    $timeout = 1;
                                }
                                preg_match_all('#<a\s*href="([^"]*?)"\s*class="btn next_page"#i', $page_html, $zurli);
                                if(isset($zurli[1][0]))
                                {
                                    $latest_chapter = $zurli[1][0];
                                    if($is_url_search)
                                    {
                                        $skip_posts_temp[$param] = $latest_chapter;
                                        update_option('ums_continue_search', $skip_posts_temp);
                                    }
                                }
                                else
                                {
                                    $latest_chapter = '';
                                }
                                sleep($timeout);
                            }
                            if(empty($latest_chapter) || $latest_chapter == '')
                            {
                                $skip_posts_temp[$param] = '';
                                update_option('ums_continue_search', $skip_posts_temp);
                                if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                    ums_log_to_file('Finished processing for: ' . $current_manga);
                                }
                            }
                            if($new_chap == true)
                            {
                                if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                                    ums_log_to_file('Total manga chapters scraped: ' . $local_imported);
                                }
                                $scraped_manga++;
                            }                            
                        }
                    }
                    catch(Exception $e)
                    {
                        ums_log_to_file('Importing failed: ' . $e->getMessage());
                        if($auto == 1)
                        {
                            ums_clearFromList($param, $type);
                        }
                        return 'fail';
                    }
                }
            }
        }
        catch (Exception $e) {
            if($continue_search == '1')
            {
                $skip_posts_temp[$param][$type] = 1;
                update_option('ums_continue_search', $skip_posts_temp);
            }
            ums_log_to_file('Exception thrown ' . esc_html($e->getMessage()) . '!');
            if($auto == 1)
            {
                ums_clearFromList($param, $type);
            }
            return 'fail';
        }
        
        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
            ums_log_to_file('Rule ID ' . esc_html($param) . ' succesfully run! ' . esc_html($ums_imported_chapters) . ' chapters created!');
        }
    }
    if($type == 0)
    {
        if ($ums_imported_chapters == 0) 
        {
            if($continue_search == '1')
            {
                if($page_increased == false)
                {
                    if(trim($max_manga) != '')
                    {
                        if(isset($skip_posts_temp[$param][$type]))
                        {
                            $skip_posts_temp[$param][$type] += 1;
                        }
                        else
                        {
                            $skip_posts_temp[$param][$type] = 2;
                        }
                        update_option('ums_continue_search', $skip_posts_temp);
                    }
                    else
                    {
                        $skip_posts_temp[$param][$type] = 1;
                        update_option('ums_continue_search', $skip_posts_temp);
                    }
                }
            }
            if($auto == 1)
            {
                ums_clearFromList($param, $type);
            }
            return 'nochange';
        } 
        else 
        {
            if($auto == 1)
            {
                ums_clearFromList($param, $type);
            }
            return 'ok';
        }
    }
    else
    {
        if($auto == 1)
        {
            ums_clearFromList($param, $type);
        }
        if ($ums_imported_chapters == 0) 
        {
            return 'nochange';
        }
        else
        {
            return 'ok';
        }
    }
}

function ums_repairHTML($text)
{
    $text = htmlspecialchars_decode($text);
    $text = str_replace("< ", "<", $text);
    $text = str_replace(" >", ">", $text);
    $text = str_replace("= ", "=", $text);
    $text = str_replace(" =", "=", $text);
    $text = str_replace("\/ ", "\/", $text);
    $text = str_replace("</ iframe>", "</iframe>", $text);
    $text = str_replace("frameborder ", "frameborder=\"0\" allowfullscreen></iframe>", $text);
    $doc = new DOMDocument();
    $doc->substituteEntities = false;
    $internalErrors = libxml_use_internal_errors(true);
    $doc->loadHTML('<?xml encoding="utf-8" ?>' . $text);
    $text = $doc->saveHTML();
                    libxml_use_internal_errors($internalErrors);
	$text = preg_replace('#<!DOCTYPE html PUBLIC "-\/\/W3C\/\/DTD HTML 4\.0 Transitional\/\/EN" "http:\/\/www\.w3\.org\/TR\/REC-html40\/loose\.dtd">(?:[^<]*)<\?xml encoding="utf-8" \?><html><body>(?:<p>)?#i', '', $text);
	$text = str_replace('</p></body></html>', '', $text);
    $text = str_replace('</body></html></p>', '', $text);
    $text = str_replace('</body></html>', '', $text);
    return $text;
}
function ums_replaceExcludes($text, &$htmlfounds, &$pre_tags_matches, &$pre_tags_matches_s, &$conseqMatchs)
{
    preg_match_all ( '{<script.*?script>}s', $text, $script_matchs );
    $script_matchs = $script_matchs [0];
    preg_match_all ( '{<pre.*?/pre>}s', $text, $pre_matchs );
    $pre_matchs = $pre_matchs [0];
    preg_match_all ( '{<code.*?/code>}s', $text, $code_matchs );
    $code_matchs = $code_matchs [0];
    preg_match_all ( "/<[^<>]+>/is", $text, $matches, PREG_PATTERN_ORDER );
    $htmlfounds = array_filter ( array_unique ( $matches [0] ) );
    $htmlfounds = array_merge ( $script_matchs, $pre_matchs, $code_matchs, $htmlfounds );
    $htmlfounds [] = '&quot;';
    $imgFoundsSeparated = array ();
    $new_imgFoundsSeparated = array ();
    $altSeparator = '';
    $colonSeparator = '';
    foreach ( $htmlfounds as $key => $currentFound ) 
    {
        if (stristr ( $currentFound, '<img' ) && stristr ( $currentFound, 'alt' ) && ! stristr ( $currentFound, 'alt=""' )) 
        {
            $altSeparator = '';
            $colonSeparator = '';
            if (stristr ( $currentFound, 'alt="' )) {
                $altSeparator = 'alt="';
                $colonSeparator = '"';
            } elseif (stristr ( $currentFound, 'alt = "' )) {
                $altSeparator = 'alt = "';
                $colonSeparator = '"';
            } elseif (stristr ( $currentFound, 'alt ="' )) {
                $altSeparator = 'alt ="';
                $colonSeparator = '"';
            } elseif (stristr ( $currentFound, 'alt= "' )) {
                $altSeparator = 'alt= "';
                $colonSeparator = '"';
            } elseif (stristr ( $currentFound, 'alt=\'' )) {
                $altSeparator = 'alt=\'';
                $colonSeparator = '\'';
            } elseif (stristr ( $currentFound, 'alt = \'' )) {
                $altSeparator = 'alt = \'';
                $colonSeparator = '\'';
            } elseif (stristr ( $currentFound, 'alt= \'' )) {
                $altSeparator = 'alt= \'';
                $colonSeparator = '\'';
            } elseif (stristr ( $currentFound, 'alt =\'' )) {
                $altSeparator = 'alt =\'';
                $colonSeparator = '\'';
            }
            if (trim ( $altSeparator ) != '') 
            {
                $currentFoundParts = explode ( $altSeparator, $currentFound );
                $preAlt = $currentFoundParts [1];
                $preAltParts = explode ( $colonSeparator, $preAlt );
                $altText = $preAltParts [0];
                if (trim ( $altText ) != '') 
                {
                    unset ( $preAltParts [0] );
                    $past_alt_text = implode ( $colonSeparator, $preAltParts );
                    $imgFoundsSeparated [] = $currentFoundParts [0] . $altSeparator;
                    $imgFoundsSeparated [] = $colonSeparator . $past_alt_text;
                    $htmlfounds [$key] = '';
                }
            }
        }
    }
    $title_separator = str_replace ( 'alt', 'title', $altSeparator );
    if($title_separator == '')
    {
        $title_separator = 'title';
    }
    if($colonSeparator != '')
    {
        foreach ( $imgFoundsSeparated as $img_part ) 
        {
            if (stristr ( $img_part, ' title' )) 
            {
                $img_part_parts = explode ( $title_separator, $img_part );
                $pre_title_part = $img_part_parts [0] . $title_separator;
                $post_title_parts = explode ( $colonSeparator, $img_part_parts [1] );
                $found_title = $post_title_parts [0];
                unset ( $post_title_parts [0] );
                $past_title_text = implode ( $colonSeparator, $post_title_parts );
                $post_title_part = $colonSeparator . $past_title_text;
                $new_imgFoundsSeparated [] = $pre_title_part;
                $new_imgFoundsSeparated [] = $post_title_part;
            } else {
                $new_imgFoundsSeparated [] = $img_part;
            }
        }
    }
    if (count ( $new_imgFoundsSeparated ) != 0) {
        $htmlfounds = array_merge ( $htmlfounds, $new_imgFoundsSeparated );
    }
    preg_match_all ( "/<\!--.*?-->/is", $text, $matches2, PREG_PATTERN_ORDER );
    $newhtmlfounds = $matches2 [0];
    preg_match_all ( "/\[.*?\]/is", $text, $matches3, PREG_PATTERN_ORDER );
    $shortcodesfounds = $matches3 [0];
    $htmlfounds = array_merge ( $htmlfounds, $newhtmlfounds, $shortcodesfounds );
    $in = 0;
    $cleanHtmlFounds = array ();
    foreach ( $htmlfounds as $htmlfound ) {
        
        if ($htmlfound == '[19459000]') {
        } elseif (trim ( $htmlfound ) == '') {
        } else {
            $cleanHtmlFounds [] = $htmlfound;
        }
    }
    $htmlfounds = array_filter ( $cleanHtmlFounds );
    $start = 19459001;
    foreach ( $htmlfounds as $htmlfound ) {
        $text = str_replace ( $htmlfound, '[' . $start . ']', $text );
        $start ++;
    }
    $text = str_replace ( '.{', '. {', $text );
    preg_match_all ( '!(?:\[1945\d*\][\s]*){2,}!s', $text, $conseqMatchs );
    $startConseq = 19659001;
    foreach ( $conseqMatchs [0] as $conseqMatch ) {
        $text = preg_replace ( '{' . preg_quote ( trim ( $conseqMatch ) ) . '}', '[' . $startConseq . ']', $text, 1 );
        $startConseq ++;
    }
    preg_match_all ( '{\[.*?\]}', $text, $pre_tags_matches );
    $pre_tags_matches = ($pre_tags_matches [0]);
    preg_match_all ( '{\s*\[.*?\]\s*}u', $text, $pre_tags_matches_s );
    $pre_tags_matches_s = ($pre_tags_matches_s [0]);
    $text = str_replace ( '[', "\n\n[", $text );
    $text = str_replace ( ']', "]\n\n", $text );
	return $text;	
}
function ums_restoreExcludes($translated, $htmlfounds, $pre_tags_matches, $pre_tags_matches_s, $conseqMatchs){
    $translated = preg_replace ( '{]\s*?1945}', '][1945', $translated );
    $translated = preg_replace ( '{ 19459(\d*?)]}', ' [19459$1]', $translated );
    $translated = str_replace ( '[ [1945', '[1945', $translated );
    $translated = str_replace ( '], ', ']', $translated );
    preg_match_all ( '{\[.*?\]}', $translated, $bracket_matchs );
    $bracket_matchs = $bracket_matchs [0];
    foreach ( $bracket_matchs as $single_bracket ) 
    {
        if (stristr ( $single_bracket, '1' ) && stristr ( $single_bracket, '9' )) {
            $single_bracket_clean = str_replace ( array (
                    ',',
                    ' ' 
            ), '', $single_bracket );
            $translated = str_replace ( $single_bracket, $single_bracket_clean, $translated );
        }
    }
    preg_match_all ( '{\[\d*?\]}', $translated, $post_tags_matches );
    $post_tags_matches = ($post_tags_matches [0]);
    if (count ( $pre_tags_matches ) == count ( $post_tags_matches )) 
    {
        if ($pre_tags_matches !== $post_tags_matches) 
        {
            $i = 0;
            foreach ( $post_tags_matches as $post_tags_match ) {
                $translated = preg_replace ( '{' . preg_quote ( trim ( $post_tags_match ) ) . '}', '[' . $i . ']', $translated, 1 );
                $i ++;
            }
            $i = 0;
            foreach ( $pre_tags_matches as $pre_tags_match ) {
                $translated = str_replace ( '[' . $i . ']', $pre_tags_match, $translated );
                $i ++;
            }
        }
    }
    $translated = str_replace ( "\n\n[", '[', $translated );
    $translated = str_replace ( "]\n\n", ']', $translated );
    $i = 0;
    foreach ( $pre_tags_matches_s as $pre_tags_match ) 
    {
        $pre_tags_match_h = htmlentities ( $pre_tags_match );
        if (stristr ( $pre_tags_match_h, '&nbsp;' )) {
            $pre_tags_match = str_replace ( '&nbsp;', ' ', $pre_tags_match_h );
        }
        $translated = preg_replace ( '{' . preg_quote ( trim ( $pre_tags_match ) ) . '}', "[$i]", $translated, 1 );
        $i ++;
    }
    $translated = preg_replace ( '{\s*\[}u', '[', $translated );
    $translated = preg_replace ( '{\]\s*}u', ']', $translated );
    $i = 0;
    foreach ( $pre_tags_matches_s as $pre_tags_match ) 
    {
        $pre_tags_match_h = htmlentities ( $pre_tags_match );
        if (stristr ( $pre_tags_match_h, '&nbsp;' )) {
            $pre_tags_match = str_replace ( '&nbsp;', ' ', $pre_tags_match_h );
        }
        $translated = preg_replace ( '{' . preg_quote ( "[$i]" ) . '}', $pre_tags_match, $translated, 1 );
        $i ++;
    }
    $startConseq = 19659001;
    foreach ( $conseqMatchs [0] as $conseqMatch ) {
        $translated = str_replace ( '[' . $startConseq . ']', $conseqMatch, $translated );
        $startConseq ++;
    }
    preg_match_all ( '!\[.*?\]!', $translated, $brackets );
    $brackets = $brackets [0];
    $brackets = array_unique ( $brackets );
    foreach ( $brackets as $bracket ) {
        if (stristr ( $bracket, '19' )) 
        {
            $corrrect_bracket = str_replace ( ' ', '', $bracket );
            $corrrect_bracket = str_replace ( '.', '', $corrrect_bracket );
            $corrrect_bracket = str_replace ( ',', '', $corrrect_bracket );
            $translated = str_replace ( $bracket, $corrrect_bracket, $translated );
        }
    }
    $start = 19459001;
    foreach ( $htmlfounds as $htmlfound ) {
        $translated = str_replace ( '[' . $start . ']', $htmlfound, $translated );
        $start ++;
    }
    return $translated;
}
function ums_spin_and_translate($post_title, $final_content, $rule_translate, $rule_translate_source)
{
    $translation = false;
    $pre_tags_matches = array();
    $pre_tags_matches_s = array();
    $conseqMatchs = array();
    $ums_Main_Settings = get_option('ums_Main_Settings', false);
    if($rule_translate != '' && $rule_translate != 'disabled')
    {
        if (isset($rule_translate_source) && $rule_translate_source != 'disabled' && $rule_translate_source != '') {
            $tr = $rule_translate_source;
        }
        else
        {
            $tr = 'auto';
        }
        $htmlfounds = array();
        $final_content = str_replace('[', '(', $final_content);
        $final_content = str_replace(']', ')', $final_content);
        $final_content = ums_replaceExcludes($final_content, $htmlfounds, $pre_tags_matches, $pre_tags_matches_s, $conseqMatchs);
        $translation = ums_translate($post_title, $final_content, $tr, $rule_translate);
        if (is_array($translation) && isset($translation[1]))
        {
            $translation[1] = preg_replace('#(?<=[\*(])\s+(?=[\*)])#', '', $translation[1]);
            $translation[1] = preg_replace('#([^(*\s]\s)\*+\)#', '$1', $translation[1]);
            $translation[1] = preg_replace('#\(\*+([\s][^)*\s])#', '$1', $translation[1]);
            $translation[1] = ums_restoreExcludes($translation[1], $htmlfounds, $pre_tags_matches, $pre_tags_matches_s, $conseqMatchs);
        }
        else
        {
            $final_content = ums_restoreExcludes($final_content, $htmlfounds, $pre_tags_matches, $pre_tags_matches_s, $conseqMatchs);
        }
        if ($translation !== FALSE) {
            if (is_array($translation) && isset($translation[0]) && isset($translation[1])) {
                $post_title    = $translation[0];
                $final_content = $translation[1];
                $final_content = str_replace('</ iframe>', '</iframe>', $final_content);
                if(stristr($final_content, '<head>') !== false)
                {
                    $d = new DOMDocument;
                    $mock = new DOMDocument;
                    $internalErrors = libxml_use_internal_errors(true);
                    $d->loadHTML('<?xml encoding="utf-8" ?>' . $final_content);
                    libxml_use_internal_errors($internalErrors);
                    $body = $d->getElementsByTagName('body')->item(0);
                    foreach ($body->childNodes as $child)
                    {
                        $mock->appendChild($mock->importNode($child, true));
                    }
                    $new_post_content_temp = $mock->saveHTML();
                    if($new_post_content_temp !== '' && $new_post_content_temp !== false)
                    {
						$new_post_content_temp = str_replace('<?xml encoding="utf-8" ?>', '', $new_post_content_temp);
                        $final_content = preg_replace("/_addload\(function\(\){([^<]*)/i", "", $new_post_content_temp); 
                    }
                }
                $final_content = ums_repairHTML($final_content);
                $final_content = str_replace('%20', '', $final_content);
                $final_content = str_replace('/V/', '/v/', $final_content);
                $final_content = str_replace('?Oh=', '?oh=', $final_content);
                $final_content = htmlspecialchars_decode($final_content);
                $final_content = str_replace('</ ', '</', $final_content);
                $final_content = str_replace(' />', '/>', $final_content);
                $final_content = str_replace('< br/>', '<br/>', $final_content);
                $final_content = str_replace('< / ', '</', $final_content);
                $final_content = str_replace(' / >', '/>', $final_content);
                $final_content = preg_replace('/[\x00-\x1F\x7F\xA0]/u', '', $final_content);
                $post_title = preg_replace('{&\s*#\s*(\d+)\s*;}', '&#$1;', $post_title);
                $post_title = htmlspecialchars_decode($post_title);
                $post_title = str_replace('</ ', '</', $post_title);
                $post_title = str_replace(' />', '/>', $post_title);
                $post_title = preg_replace('/[\x00-\x1F\x7F\xA0]/u', '', $post_title);
            } else {
                if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                    ums_log_to_file('Translation failed - malformed data!');
                }
                return false;
            }
        } else {
            if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                ums_log_to_file('Translation Failed - returned false!');
            }
            return false;
        }
    }
    else
    {
        if (isset($ums_Main_Settings['translate']) && $ums_Main_Settings['translate'] != 'disabled') {
            if (isset($ums_Main_Settings['translate_source']) && $ums_Main_Settings['translate_source'] != 'disabled') {
                $tr = $ums_Main_Settings['translate_source'];
            }
            else
            {
                $tr = 'auto';
            }
            $htmlfounds = array();
            $final_content = str_replace('[', '(', $final_content);
            $final_content = str_replace(']', ')', $final_content);
            $final_content = ums_replaceExcludes($final_content, $htmlfounds, $pre_tags_matches, $pre_tags_matches_s, $conseqMatchs);
        
            $translation = ums_translate($post_title, $final_content, $tr, $ums_Main_Settings['translate']);
            if (is_array($translation) && isset($translation[1]))
            {
                $translation[1] = preg_replace('#(?<=[\*(])\s+(?=[\*)])#', '', $translation[1]);
                $translation[1] = preg_replace('#([^(*\s]\s)\*+\)#', '$1', $translation[1]);
                $translation[1] = preg_replace('#\(\*+([\s][^)*\s])#', '$1', $translation[1]);
                $translation[1] = ums_restoreExcludes($translation[1], $htmlfounds, $pre_tags_matches, $pre_tags_matches_s, $conseqMatchs);
            }
            else
            {
                $final_content = ums_restoreExcludes($final_content, $htmlfounds, $pre_tags_matches, $pre_tags_matches_s, $conseqMatchs);
            }
            if ($translation !== FALSE) {
                if (is_array($translation) && isset($translation[0]) && isset($translation[1])) {
                    $post_title    = $translation[0];
                    $final_content = $translation[1];
                    $final_content = str_replace('</ iframe>', '</iframe>', $final_content);
                    if(stristr($final_content, '<head>') !== false)
                    {
                        $d = new DOMDocument;
                        $mock = new DOMDocument;
                        $internalErrors = libxml_use_internal_errors(true);
                        $d->loadHTML('<?xml encoding="utf-8" ?>' . $final_content);
                    libxml_use_internal_errors($internalErrors);
                        $body = $d->getElementsByTagName('body')->item(0);
                        foreach ($body->childNodes as $child)
                        {
                            $mock->appendChild($mock->importNode($child, true));
                        }
                        $new_post_content_temp = $mock->saveHTML();
                        if($new_post_content_temp !== '' && $new_post_content_temp !== false)
                        {
                            $final_content = preg_replace("/_addload\(function\(\){([^<]*)/i", "", $new_post_content_temp); 
                        }
                    }
                    $final_content = ums_repairHTML($final_content);
                    $final_content = str_replace('%20', '', $final_content);
                    $final_content = str_replace('/V/', '/v/', $final_content);
                    $final_content = str_replace('?Oh=', '?oh=', $final_content);
                    $final_content = htmlspecialchars_decode($final_content);
                    $final_content = str_replace('</ ', '</', $final_content);
                    $final_content = str_replace(' />', '/>', $final_content);
                    $final_content = str_replace('< br/>', '<br/>', $final_content);
                    $final_content = str_replace('< / ', '</', $final_content);
                    $final_content = str_replace(' / >', '/>', $final_content);
                    $final_content = preg_replace('/[\x00-\x1F\x7F\xA0]/u', '', $final_content);
                    $post_title = preg_replace('{&\s*#\s*(\d+)\s*;}', '&#$1;', $post_title);
$post_title = htmlspecialchars_decode($post_title);
                    $post_title = str_replace('</ ', '</', $post_title);
                    $post_title = str_replace(' />', '/>', $post_title);
                    $post_title = preg_replace('/[\x00-\x1F\x7F\xA0]/u', '', $post_title);
                } else {
                    if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                        ums_log_to_file('Translation failed - malformed data!');
                    }
                    return false;
                }
            } else {
                if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                    ums_log_to_file('Translation Failed - returned false!');
                }
                return false;
            }
        }
    }
    return array(
        $post_title,
        $final_content
    );
}
function ums_translate($title, $content, $from, $to)
{
    $ch = FALSE;
    $ums_Main_Settings = get_option('ums_Main_Settings', false);
    try {
        if($from == 'disabled')
        {
            if(strstr($to, '-') !== false && $to != 'zh-CN' && $to != 'zh-TW')
            {
                $from = 'auto-';
            }
            else
            {
                $from = 'auto';
            }
        }
        if($from != 'en' && $from != 'EN-' && $from != 'en!' && $from == $to)
        {
            if(strstr($to, '-') !== false && $to != 'zh-CN' && $to != 'zh-TW')
            {
                $from = 'en-';
            }
            else
            {
                $from = 'en';
            }
        }
        elseif(($from == 'en' || $from == 'EN-' || $from == 'en!') && $from == $to)
        {
            return false;
        }
        if(strstr($to, '!') !== false)
        {
            if (!isset($ums_Main_Settings['bing_auth']) || trim($ums_Main_Settings['bing_auth']) == '')
            {
                throw new Exception('You must enter a Microsoft Translator API key from plugin settings, to use this feature!');
            }
            require_once (dirname(__FILE__) . "/res/ums-translator-microsoft.php");
            $options    = array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_CONNECTTIMEOUT => 10,
                CURLOPT_TIMEOUT => 60,
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0
            );
            $ch = curl_init();
            if ($ch === FALSE) {
                ums_log_to_file ('Failed to init curl in Microsoft Translator');
				return false;
            }
            if (isset($ums_Main_Settings['proxy_url']) && $ums_Main_Settings['proxy_url'] != '' && $ums_Main_Settings['proxy_url'] != 'disable' && $ums_Main_Settings['proxy_url'] != 'disabled') {
				$prx = explode(',', $ums_Main_Settings['proxy_url']);
                $randomness = array_rand($prx);
                $options[CURLOPT_PROXY] = trim($prx[$randomness]);
                if (isset($ums_Main_Settings['proxy_auth']) && $ums_Main_Settings['proxy_auth'] != '') 
                {
                    $prx_auth = explode(',', $ums_Main_Settings['proxy_auth']);
                    if(isset($prx_auth[$randomness]) && trim($prx_auth[$randomness]) != '')
                    {
                        $options[CURLOPT_PROXYUSERPWD] = trim($prx_auth[$randomness]);
                    }
                }
            }
            curl_setopt_array($ch, $options);
			$MicrosoftTranslator = new MicrosoftTranslator ( $ch );	
			try 
            {
                if (!isset($ums_Main_Settings['bing_region']) || trim($ums_Main_Settings['bing_region']) == '')
                {
                    $mt_region = 'global';
                }
                else
                {
                    $mt_region = trim($ums_Main_Settings['bing_region']);
                }
                if($from == 'auto' || $from == 'auto-' || $from == 'disabled')
                {
                    $from = 'no';
                }
				$accessToken = $MicrosoftTranslator->getToken ( trim($ums_Main_Settings['bing_auth']) , $mt_region  );
                $from = trim($from, '!');
                $to = trim($to, '!');
				$translated = $MicrosoftTranslator->translateWrap ( $content, $from, $to );
                $translated_title = $MicrosoftTranslator->translateWrap ( $title, $from, $to );
                curl_close($ch);
			} 
            catch ( Exception $e ) 
            {
                curl_close($ch);
				ums_log_to_file ('Microsoft Translation error: ' . $e->getMessage());
				return false;
			}
        }
        elseif(strstr($to, '-') !== false && $to != 'zh-CN' && $to != 'zh-TW')
        {
            if (!isset($ums_Main_Settings['deepl_auth']) || trim($ums_Main_Settings['deepl_auth']) == '')
            {
                throw new Exception('You must enter a DeepL API key from plugin settings, to use this feature!');
            }
            $to = rtrim($to, '-');
            $from = rtrim($from, '-');
            if(strlen($content) > 13000)
            {
                $translated = '';
                while($content != '')
                {
                    $first30k = substr($content, 0, 13000);
                    $content = substr($content, 13000);
                    if (isset($ums_Main_Settings['deppl_free']) && trim($ums_Main_Settings['deppl_free']) == 'on')
                    {
                        $ch = curl_init('https://api-free.deepl.com/v2/translate');
                    }
                    else
                    {
                        $ch = curl_init('https://api.deepl.com/v2/translate');
                    }
                    if($ch !== false)
                    {
                        $data           = array();
                        $data['text']   = $first30k;
                        if($from != 'auto')
                        {
                            $data['source_lang']   = $from;
                        }
                        $data['tag_handling']  = 'xml';
                        $data['non_splitting_tags']  = 'div';
                        $data['preserve_formatting']  = '1';
                        $data['target_lang']   = $to;
                        $data['auth_key']   = trim($ums_Main_Settings['deepl_auth']);
                        $fdata = "";
                        foreach ($data as $key => $val) {
                            $fdata .= "$key=" . urlencode(trim($val)) . "&";
                        }
                        $headers = [
                            'Content-Type: application/x-www-form-urlencoded',
                            'Content-Length: ' . strlen($fdata)
                        ];
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_USERAGENT, ums_get_random_user_agent());
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $fdata);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
                        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
                        $translated_temp = curl_exec($ch);
                        if($translated_temp === false)
                        {
                            throw new Exception('Failed to post to DeepL: ' . curl_error($ch));
                        }
                        curl_close($ch);
                    }
                    $trans_json = json_decode($translated_temp, true);
                    if($trans_json === false)
                    {
                        throw new Exception('Incorrect multipart response from DeepL: ' . $translated_temp);
                    }
                    if(!isset($trans_json['translations'][0]['text']))
                    {
                        throw new Exception('Unrecognized multipart response from DeepL: ' . $translated_temp);
                    }
                    $translated .= ' ' . $trans_json['translations'][0]['text'];
                }
            }
            else
            {
                if (isset($ums_Main_Settings['deppl_free']) && trim($ums_Main_Settings['deppl_free']) == 'on')
                {
                    $ch = curl_init('https://api-free.deepl.com/v2/translate');
                }
                else
                {
                    $ch = curl_init('https://api.deepl.com/v2/translate');
                }
                if($ch !== false)
                {
                    $data           = array();
                    $data['text']   = $content;
                    if($from != 'auto')
                    {
                        $data['source_lang']   = $from;
                    }
                    $data['tag_handling']  = 'xml';
                    $data['non_splitting_tags']  = 'div';
                    $data['preserve_formatting']  = '1';
                    $data['target_lang']   = $to;
                    $data['auth_key']   = trim($ums_Main_Settings['deepl_auth']);
                    $fdata = "";
                    foreach ($data as $key => $val) {
                        $fdata .= "$key=" . urlencode(trim($val)) . "&";
                    }
                    curl_setopt($ch, CURLOPT_POST, 1);
                    $headers = [
                        'Content-Type: application/x-www-form-urlencoded',
                        'Content-Length: ' . strlen($fdata)
                    ];
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $fdata);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_USERAGENT, ums_get_random_user_agent());
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
                    $translated = curl_exec($ch);
                    if($translated === false)
                    {
                        throw new Exception('Failed to post to DeepL: ' . curl_error($ch));
                    }
                    curl_close($ch);
                }
                $trans_json = json_decode($translated, true);
                if($trans_json === false)
                {
                    throw new Exception('Incorrect text response from DeepL: ' . $translated);
                }
                if(!isset($trans_json['translations'][0]['text']))
                {
                    throw new Exception('Unrecognized text response from DeepL: ' . 'https://api.deepl.com/v2/translate?text=' . urlencode($content) . '&source_lang=' . $from . '&target_lang=' . $to . '&auth_key=' . trim($ums_Main_Settings['deepl_auth']) . '&tag_handling=xml&preserve_formatting=1' . ' --- ' . $translated);
                }
                $translated = $trans_json['translations'][0]['text'];
            }
            $translated = str_replace('<strong>', ' <strong>', $translated);
            $translated = str_replace('</strong>', '</strong> ', $translated);
            if (isset($ums_Main_Settings['deppl_free']) && trim($ums_Main_Settings['deppl_free']) == 'on')
            {
                $ch = curl_init('https://api-free.deepl.com/v2/translate');
            }
            else
            {
                $ch = curl_init('https://api.deepl.com/v2/translate');
            }
            if($ch !== false)
            {
                $data           = array();
                $data['text']   = $title;
                if($from != 'auto')
                {
                    $data['source_lang']   = $from;
                }
                $data['tag_handling']  = 'xml';
                $data['non_splitting_tags']  = 'div';
                $data['preserve_formatting']  = '1';
                $data['target_lang']   = $to;
                $data['auth_key']   = trim($ums_Main_Settings['deepl_auth']);
                $fdata = "";
                foreach ($data as $key => $val) {
                    $fdata .= "$key=" . urlencode(trim($val)) . "&";
                }
                curl_setopt($ch, CURLOPT_POST, 1);
                $headers = [
                    'Content-Type: application/x-www-form-urlencoded',
                    'Content-Length: ' . strlen($fdata)
                ];
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fdata);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_USERAGENT, ums_get_random_user_agent());
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
                curl_setopt($ch, CURLOPT_TIMEOUT, 60);
                $translated_title = curl_exec($ch);
                if($translated_title === false)
                {
                    throw new Exception('Failed to post to DeepL: ' . curl_error($ch));
                }
                curl_close($ch);
            }
            $trans_json = json_decode($translated_title, true);
            if($trans_json === false)
            {
                throw new Exception('Incorrect text response from DeepL: ' . $translated_title);
            }
            if(!isset($trans_json['translations'][0]['text']))
            {
                throw new Exception('Unrecognized text response from DeepL: ' . 'https://api.deepl.com/v2/translate?text=' . urlencode($content) . '&source_lang=' . $from . '&target_lang=' . $to . '&auth_key=' . trim($ums_Main_Settings['deepl_auth']) . '&tag_handling=xml&preserve_formatting=1' . ' --- ' . $translated);
            }
            $translated_title = $trans_json['translations'][0]['text'];
        }
        else
        {
            if (isset($ums_Main_Settings['google_trans_auth']) && trim($ums_Main_Settings['google_trans_auth']) != '')
            {
                require_once(dirname(__FILE__) . "/res/translator-api.php");
                $ch = curl_init();
                if ($ch === FALSE) {
                    if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                        ums_log_to_file('Failed to init cURL in translator!');
                    }
                    return false;
                }
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
                curl_setopt($ch, CURLOPT_TIMEOUT, 10);
                $GoogleTranslatorAPI = new GoogleTranslatorAPI($ch, $ums_Main_Settings['google_trans_auth']);
                $translated = '';
                $translated_title = '';
                if($content != '')
                {
                    if(strlen($content) > 13000)
                    {
                        while($content != '')
                        {
                            $first30k = substr($content, 0, 13000);
                            $content = substr($content, 13000);
                            $translated_temp       = $GoogleTranslatorAPI->translateText($first30k, $from, $to);
                            $translated .= ' ' . $translated_temp;
                        }
                    }
                    else
                    {
                        $translated       = $GoogleTranslatorAPI->translateText($content, $from, $to);
                    }
                }
                if($title != '')
                {
                    $translated_title = $GoogleTranslatorAPI->translateText($title, $from, $to);
                }
                curl_close($ch);
            }
            else
            {
                require_once(dirname(__FILE__) . "/res/ums-translator.php");
                $ch = curl_init();
                if ($ch === FALSE) {
                    if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                        ums_log_to_file('Failed to init cURL in translator!');
                    }
                    return false;
                }
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
                curl_setopt($ch, CURLOPT_TIMEOUT, 60);
                curl_setopt($ch, CURLOPT_USERAGENT, ums_get_random_user_agent());
				if (isset($ums_Main_Settings['proxy_url']) && $ums_Main_Settings['proxy_url'] != '' && $ums_Main_Settings['proxy_url'] != 'disable' && $ums_Main_Settings['proxy_url'] != 'disabled') {
					$prx = explode(',', $ums_Main_Settings['proxy_url']);
					$randomness = array_rand($prx);
					curl_setopt( $ch, CURLOPT_PROXY, trim($prx[$randomness]));
					if (isset($ums_Main_Settings['proxy_auth']) && $ums_Main_Settings['proxy_auth'] != '') 
					{
						$prx_auth = explode(',', $ums_Main_Settings['proxy_auth']);
						if(isset($prx_auth[$randomness]) && trim($prx_auth[$randomness]) != '')
						{
							curl_setopt( $ch, CURLOPT_PROXYUSERPWD, trim($prx_auth[$randomness]) );
						}
					}
				}
				$GoogleTranslator = new GoogleTranslator($ch);
                if(strlen($content) > 13000)
                {
                    $translated = '';
                    while($content != '')
                    {
                        $first30k = substr($content, 0, 13000);
                        $content = substr($content, 13000);
                        $translated_temp       = $GoogleTranslator->translateText($first30k, $from, $to);
                        if (strpos($translated, '<h2>The page you have attempted to translate is already in ') !== false) {
                            throw new Exception('Page content already in ' . $to);
                        }
                        if (strpos($translated, 'Error 400 (Bad Request)!!1') !== false) {
                            throw new Exception('Unexpected error while translating page!');
                        }
                        if(substr_compare($translated_temp, '</pre>', -strlen('</pre>')) === 0){$translated_temp = substr_replace($translated_temp ,"", -6);}if(substr( $translated_temp, 0, 5 ) === "<pre>"){$translated_temp = substr($translated_temp, 5);}
                        $translated .= ' ' . $translated_temp;
                    }
                }
                else
                {
                    $translated       = $GoogleTranslator->translateText($content, $from, $to);
                    if (strpos($translated, '<h2>The page you have attempted to translate is already in ') !== false) {
                        throw new Exception('Page content already in ' . $to);
                    }
                    if (strpos($translated, 'Error 400 (Bad Request)!!1') !== false) {
                        throw new Exception('Unexpected error while translating page!');
                    }
                }
                $translated_title = $GoogleTranslator->translateText($title, $from, $to);
                if (strpos($translated_title, '<h2>The page you have attempted to translate is already in ') !== false) {
                    throw new Exception('Page title already in ' . $to);
                }
                if (strpos($translated_title, 'Error 400 (Bad Request)!!1') !== false) {
                    throw new Exception('Unexpected error while translating page title!');
                }
                curl_close($ch);
            }
        }
    }
    catch (Exception $e) {
        if($ch !== false)
        {
            curl_close($ch);
        }
        if (isset($ums_Main_Settings['enable_detailed_logging'])) {
            ums_log_to_file('Exception thrown in Translator ' . $e);
        }
        return false;
    }
    if(substr_compare($translated_title, '</pre>', -strlen('</pre>')) === 0){$title = substr_replace($translated_title ,"", -6);}else{$title = $translated_title;}if(substr( $title, 0, 5 ) === "<pre>"){$title = substr($title, 5);}
    if(substr_compare($translated, '</pre>', -strlen('</pre>')) === 0){$text = substr_replace($translated ,"", -6);}else{$text = $translated;}if(substr( $text, 0, 5 ) === "<pre>"){$text = substr($text, 5);}
    $text  = preg_replace('/' . preg_quote('html lang=') . '.*?' . preg_quote('>') . '/', '', $text);
    $text  = preg_replace('/' . preg_quote('!DOCTYPE') . '.*?' . preg_quote('<') . '/', '', $text);
    $text = str_replace('%% item_cat %%', '%%item_cat%%', $text);
    $text = str_replace('%% item_tags %%', '%%item_tags%%', $text);
    $text = str_replace('%% item_url %%', '%%item_url%%', $text);
    $text = str_replace('%% item_read_more_button %%', '%%item_read_more_button%%', $text);
    $text = str_replace('%%item_read_more_button %%', '%%item_read_more_button%%', $text);
    $text = str_replace('%% item_read_more_button%%', '%%item_read_more_button%%', $text);
    $text = str_replace('%% item_image_URL %%', '%%item_image_URL%%', $text);
    $text = str_replace('%% author_link %%', '%%author_link%%', $text);
    $text = str_replace('%% custom_html2 %%', '%%custom_html2%%', $text);
    $text = str_replace('%% custom_html %%', '%%custom_html%%', $text);
    $text = str_replace('%% random_sentence %%', '%%random_sentence%%', $text);
    $text = str_replace('%% random_sentence2 %%', '%%random_sentence2%%', $text);
    $text = str_replace('%% item_title %%', '%%item_title%%', $text);
    $text = str_replace('%% item_content %%', '%%item_content%%', $text);
    $text = str_replace('%% item_original_content %%', '%%item_original_content%%', $text);
    $text = str_replace('%% item_content_plain_text %%', '%%item_content_plain_text%%', $text);
    $text = str_replace('%% item_description %%', '%%item_description%%', $text);
    $text = str_replace('%% author %%', '%%author%%', $text);
    $text = str_replace('%% item_media %%', '%%item_media%%', $text);
    $text = str_replace('%% item_date %%', '%%item_date%%', $text);
    $text = str_replace('&amp; # 039;', '\'', $text);
    $text = str_replace('%% %% item_read_more_button', '%%item_read_more_button%%', $text);
    $text = str_replace('&amp; ldquo;', '"', $text);
    $text = str_replace('&amp; rdquo;', '"', $text);
    $text = str_replace(' \' ', '\'', $text);
    $text = preg_replace('{<iframe src="https://translate.google.com/translate(?:.*?)></iframe>}i', "", html_entity_decode($text, ENT_QUOTES));
    $text = preg_replace('{<span class="google-src-text.*?>.*?</span>}', "", $text);
    $text = preg_replace('{<span class="notranslate.*?>(.*?)</span>}', "$1", $text);
    $title = str_replace('%% random_sentence %%', '%%random_sentence%%', $title);
    $title = str_replace('%% random_sentence2 %%', '%%random_sentence2%%', $title);
    $title = str_replace('%% item_title %%', '%%item_title%%', $title);
    $title = str_replace('%% item_description %%', '%%item_description%%', $title);
    $title = str_replace('%% item_url %%', '%%item_url%%', $title);
    $title = str_replace('%% item_date %%', '%%item_date%%', $title);
    $title = str_replace('%% author %%', '%%author%%', $title);
    $title = str_replace('%% item_cat %%', '%%item_cat%%', $title);
    $title = str_replace('%% item_tags %%', '%%item_tags%%', $title);
    $title = str_replace('&amp; # 039;', '\'', $title);
    $title = str_replace('&amp; ldquo;', '"', $title);
    $title = str_replace('&amp; rdquo;', '"', $title);
    $title = str_replace(' \' ', '\'', $title);

    return array(
        $title,
        $text
    );
}
function ums_generate_random_email()
{
    $tlds = array("com", "net", "gov", "org", "edu", "biz", "info");
    $char = "0123456789abcdefghijklmnopqrstuvwxyz";
    $ulen = mt_rand(5, 10);
    $dlen = mt_rand(7, 17);
    $a = "";
    for ($i = 1; $i <= $ulen; $i++) {
        $a .= substr($char, mt_rand(0, strlen($char)), 1);
    }
    $a .= "@";
    for ($i = 1; $i <= $dlen; $i++) {
        $a .= substr($char, mt_rand(0, strlen($char)), 1);
    }
    $a .= ".";
    $a .= $tlds[mt_rand(0, (sizeof($tlds)-1))];
    return $a;
}
$ums_fatal = false;
function ums_clear_flag_at_shutdown($param, $type)
{
    $error = error_get_last();
    if ($error !== null && $error['type'] === E_ERROR && $GLOBALS['ums_fatal'] === false) {
        $GLOBALS['ums_fatal'] = true;
        $running = array();
        update_option('ums_running_list', $running);
        ums_log_to_file('[FATAL] Exit error: ' . $error['message'] . ', file: ' . $error['file'] . ', line: ' . $error['line'] . ' - rule ID: ' . $param . '!');
        ums_clearFromList($param, $type);
    }
    else
    {
        ums_clearFromList($param, $type);
    }
}

function ums_hour_diff($date1, $date2)
{
    $date1 = new DateTime($date1, ums_get_blog_timezone());
    $date2 = new DateTime($date2, ums_get_blog_timezone());
    
    $number1 = (int) $date1->format('U');
    $number2 = (int) $date2->format('U');
    return ($number1 - $number2) / 60;
}

function ums_add_hour($date, $hour)
{
    $date1 = new DateTime($date, ums_get_blog_timezone());
    $date1->modify("$hour hours");
    $date1 = (array)$date1;
    foreach ($date1 as $key => $value) {
        if ($key == 'date') {
            return $value;
        }
    }
    return $date;
}

function ums_minute_diff($date1, $date2)
{
    $date1 = new DateTime($date1, ums_get_blog_timezone());
    $date2 = new DateTime($date2, ums_get_blog_timezone());
    
    $number1 = (int) $date1->format('U');
    $number2 = (int) $date2->format('U');
    return ($number1 - $number2);
}

function ums_add_minute($date, $minute)
{
    $date1 = new DateTime($date, ums_get_blog_timezone());
    $date1->modify("$minute minutes");
    $date1 = (array)$date1;
    foreach ($date1 as $key => $value) {
        if ($key == 'date') {
            return $value;
        }
    }
    return $date;
}
function ums_str_ends_with( $haystack, $needle ) 
{
    $length = strlen( $needle );
    if( !$length ) {
        return true;
    }
    return substr( $haystack, -$length ) === $needle;
}
function ums_get_blog_timezone() {

    $tzstring = get_option( 'timezone_string' );
    $offset   = get_option( 'gmt_offset' );

    if( empty( $tzstring ) && 0 != $offset && floor( $offset ) == $offset ){
        $offset_st = $offset > 0 ? "-$offset" : '+'.absint( $offset );
        $tzstring  = 'Etc/GMT'.$offset_st;
    }
    if( empty( $tzstring ) ){
        $tzstring = 'UTC';
    }
    $timezone = new DateTimeZone( $tzstring );
    return $timezone; 
}
function ums_get_date_now($param = 'now')
{
    $date = new DateTime($param, ums_get_blog_timezone());
    $date = (array)$date;
    foreach ($date as $key => $value) {
        if ($key == 'date') {
            return $value;
        }
    }
    return '';
}

add_action('init', 'ums_create_taxonomy', 0);
add_action( 'enqueue_block_editor_assets', 'ums_enqueue_block_editor_assets' );
function ums_enqueue_block_editor_assets() {
	wp_register_style('ums-browser-style', plugins_url('styles/ums-browser.css', __FILE__), false, '1.0.0');
    wp_enqueue_style('ums-browser-style');
}
function ums_create_taxonomy()
{
    if(!taxonomy_exists('coderevolution_post_source'))
    {
        $labels = array(
            'name' => _x('Post Source', 'taxonomy general name', 'ultimate-manga-scraper'),
            'singular_name' => _x('Post Source', 'taxonomy singular name', 'ultimate-manga-scraper'),
            'search_items' => esc_html__('Search Post Source', 'ultimate-manga-scraper'),
            'popular_items' => esc_html__('Popular Post Source', 'ultimate-manga-scraper'),
            'all_items' => esc_html__('All Post Sources', 'ultimate-manga-scraper'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => esc_html__('Edit Post Source', 'ultimate-manga-scraper'),
            'update_item' => esc_html__('Update Post Source', 'ultimate-manga-scraper'),
            'add_new_item' => esc_html__('Add New Post Source', 'ultimate-manga-scraper'),
            'new_item_name' => esc_html__('New Post Source Name', 'ultimate-manga-scraper'),
            'separate_items_with_commas' => esc_html__('Separate Post Source with commas', 'ultimate-manga-scraper'),
            'add_or_remove_items' => esc_html__('Add or remove Post Source', 'ultimate-manga-scraper'),
            'choose_from_most_used' => esc_html__('Choose from the most used Post Source', 'ultimate-manga-scraper'),
            'not_found' => esc_html__('No Post Sources found.', 'ultimate-manga-scraper'),
            'menu_name' => esc_html__('Post Source', 'ultimate-manga-scraper')
        );
        
        $args = array(
            'hierarchical' => false,
            'public' => false,
            'show_ui' => false,
            'show_in_menu' => false,
            'description' => 'Post Source',
            'labels' => $labels,
            'show_admin_column' => true,
            'update_count_callback' => '_update_post_term_count',
            'rewrite' => false
        );
        
        $add_post_type = array(
            'wp-manga'
        );
        $xargs = array(
            'public'   => true,
            '_builtin' => false
        );
        $output = 'names'; 
        $operator = 'and';
        register_taxonomy('coderevolution_post_source', $add_post_type, $args);
        add_action('pre_get_posts', function($qry) {
            if (is_admin()) return;
            if (is_tax('coderevolution_post_source')){
                $qry->set_404();
            }
        });
    }
}

register_activation_hook(__FILE__, 'ums_activation_callback');
function ums_activation_callback($defaults = FALSE)
{
    if (!get_option('ums_posts_per_page') || $defaults === TRUE) {
        if ($defaults === FALSE) {
            add_option('ums_posts_per_page', '10');
        } else {
            update_option('ums_posts_per_page', '10');
        }
    }
    if (!get_option('ums_Main_Settings') || $defaults === TRUE) {
        $ums_Main_Settings = array(
            'ums_enabled' => 'on',
            'auto_clear_logs' => 'No',
            'enable_logging' => 'on',
            'enable_cloudflare' => '',
            'manga_storage' => 'local',
            'enable_detailed_logging' => '',
            'request_timeout' => '1',
            'rule_timeout' => '3600',
            'default_schedule' => '24',
            'post_author' => '',
            'default_manga' => '1',
            'default_chapters' => '1',
            'proxy_auth' => '',
            'proxy_url' => '',
            'disable_rerun' => '',
            'also_images' => '',
            'phantom_timeout' => '',
            'google_trans_auth' => '',
            'bing_auth' => '',
            'deepl_auth' => '',
            'bing_region' => '',
            'deppl_free' => ''
        );
        if ($defaults === FALSE) {
            add_option('ums_Main_Settings', $ums_Main_Settings);
        } else {
            update_option('ums_Main_Settings', $ums_Main_Settings);
        }
    }
}

register_activation_hook(__FILE__, 'ums_check_version');
function ums_check_version()
{
    if (!function_exists('curl_init')) {
        wp_die(
            'Please enable the cURL PHP extension. Contact your hosting provider for assistance.',
            'Plugin Activation Error',
            array('back_link' => true)
        );
    }

    if (!current_user_can('activate_plugins')) {
        wp_die(
            'You are not allowed to activate plugins!',
            'Plugin Activation Error',
            array('back_link' => true)
        );
    }

    $php_version_required = '5.0';
    $wp_version_required  = '2.7';

    if (version_compare(PHP_VERSION, $php_version_required, '<')) {
        deactivate_plugins(plugin_basename(__FILE__));
        wp_die(
            sprintf(
                'This plugin requires PHP version %1$s or higher. Your current version is %2$s.',
                $php_version_required,
                PHP_VERSION
            ),
            'Plugin Activation Error',
            array('back_link' => true)
        );
    }

    global $wp_version;
    if (version_compare($wp_version, $wp_version_required, '<')) {
        deactivate_plugins(plugin_basename(__FILE__));
        wp_die(
            sprintf(
                'This plugin requires WordPress version %1$s or higher. Your current version is %2$s.',
                $wp_version_required,
                $wp_version
            ),
            'Plugin Activation Error',
            array('back_link' => true)
        );
    }
}
add_action('admin_init', 'ums_register_mysettings');
function ums_register_mysettings()
{ 
    ums_cron_schedule();
    register_setting('ums_option_group', 'ums_Main_Settings');
    
    if(isset($_GET['ums_page']))
    {
        $curent_page = $_GET["ums_page"];
    }
    else
    {
        $curent_page = '';
    }
    $all_rules = array();
    $last_url = (ums_isSecure() ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if(stristr($last_url, 'ums_items_panel') !== false)
    {
        $GLOBALS['wp_object_cache']->delete('ums_rules_list', 'options');
        $all_rules = get_option('ums_rules_list', array());
    }
    elseif(stristr($last_url, 'ums_novel_panel') !== false)
    {
        $GLOBALS['wp_object_cache']->delete('ums_novel_list', 'options');
        $all_rules = get_option('ums_novel_list', array());
    }
    elseif(stristr($last_url, 'ums_novel_generic_panel') !== false)
    {
        $GLOBALS['wp_object_cache']->delete('ums_novel_generic_list', 'options');
        $all_rules = get_option('ums_novel_generic_list', array());
    }
    elseif(stristr($last_url, 'ums_manga_generic_panel') !== false)
    {
        $GLOBALS['wp_object_cache']->delete('ums_manga_generic_list', 'options');
        $all_rules = get_option('ums_manga_generic_list', array());
    }
    elseif(stristr($last_url, 'ums_vipnovel_panel') !== false)
    {
        $GLOBALS['wp_object_cache']->delete('ums_vipnovel_list', 'options');
        $all_rules = get_option('ums_vipnovel_list', array());
    }
    elseif(stristr($last_url, 'ums_text_panel') !== false)
    {
        $GLOBALS['wp_object_cache']->delete('ums_text_list', 'options');
        $all_rules = get_option('ums_text_list', array());
    }
    if($all_rules === false)
    {
        $all_rules = array();
    }
    $rules_count = count($all_rules);
    $rules_per_page = get_option('ums_posts_per_page', 10);
    $max_pages = ceil($rules_count/$rules_per_page);
    if($max_pages == 0)
    {
        $max_pages = 1;
    }
    if((stristr($last_url, 'ums_items_panel') !== false || stristr($last_url, 'ums_novel_panel') !== false || stristr($last_url, 'ums_novel_generic_panel') !== false || stristr($last_url, 'ums_manga_generic_panel') !== false || stristr($last_url, 'ums_text_panel') !== false) && (!is_numeric($curent_page) || $curent_page > $max_pages || $curent_page <= 0))
    {
        if(stristr($last_url, 'ums_page=') === false)
        {
            if(stristr($last_url, '?') === false)
            {
                $last_url .= '?ums_page=' . $max_pages;
            }
            else
            {
                $last_url .= '&ums_page=' . $max_pages;
            }
        }
        else
        {
            if(isset($_GET['ums_page']))
            {
                $curent_page = $_GET["ums_page"];
            }
            else
            {
                $curent_page = '';
            }
            if(is_numeric($curent_page))
            {
                $last_url = str_replace('ums_page=' . $curent_page, 'ums_page=' . $max_pages, $last_url);
            }
            else
            {
                if(stristr($last_url, '?') === false)
                {
                    $last_url .= '?ums_page=' . $max_pages;
                }
                else
                {
                    $last_url .= '&ums_page=' . $max_pages;
                }
            }
        }
        ums_redirect($last_url);
    }
    if (is_multisite()) {
        if (!get_option('ums_Main_Settings')) {
            ums_activation_callback(TRUE);
        }
    }
}

function ums_get_plugin_url()
{
    return plugins_url('', __FILE__);
}

function ums_get_file_url($url)
{
    return esc_url_raw(ums_get_plugin_url() . '/' . $url);
}

function ums_admin_load_files()
{
    wp_register_style('ums-browser-style', plugins_url('styles/ums-browser.css', __FILE__), false, '1.0.0');
    wp_enqueue_style('ums-browser-style');
    wp_register_style('ums-custom-style', plugins_url('styles/coderevolution-style.css', __FILE__), false, '1.0.0');
    wp_enqueue_style('ums-custom-style');
    wp_enqueue_script('jquery');
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_style('thickbox');
}

require(dirname(__FILE__) . "/res/ums-rules-list.php");
require(dirname(__FILE__) . "/res/ums-text-list.php");
require(dirname(__FILE__) . "/res/ums-novel-list.php");
require(dirname(__FILE__) . "/res/ums-fanmtl-list.php");
require(dirname(__FILE__) . "/res/ums-vipnovel-list.php");
require(dirname(__FILE__) . "/res/ums-novel-generic-list.php");
require(dirname(__FILE__) . "/res/ums-manga-generic-list.php");
require(dirname(__FILE__) . "/res/ums-logs.php");
require(dirname(__FILE__) . "/includes/class-madara-fetcher.php");
require(dirname(__FILE__) . "/includes/class-madara-handler.php");
UMS_Madara_Handler::init();
?>