<?php
/*
 * Copyright (C) 2026 NIKOL
 * Licensed under LUCA Free License v1.0
 * DO WHAT THE FUCK YOU WANT TO.
 */
   function ums_admin_settings()
   {
      $theme = wp_get_theme();
      if ( 'Madara' != $theme->name && 'Madara' != $theme->parent_theme ) {
          echo '<h1>This plugin requires the "Madara" theme to be installed and active on this site before it can function! Please install it from here: <a href="https://mangabooth.com/product/wp-manga-theme-madara/" target="_blank">Madara - WordPress Theme for Manga</a></h1>';
          return;
      }
      if( ! class_exists('WP_MANGA_STORAGE') ) {
          echo '<h1>This plugin requires the "Madara Core" plugin to be installed and active on this site before it can function! Please install it from here: <a href="https://mangabooth.com/product/wp-manga-theme-madara/" target="_blank">Madara - WordPress Theme for Manga</a></h1>';
          return;
      }
   ?>
<div class="wp-header-end"></div>
<div class="wrap gs_popuptype_holder seo_pops">
   <div>
      <form autocomplete="off" id="myForm" method="post" action="<?php if(is_multisite() && is_network_admin()){echo '../options.php';}else{echo 'options.php';}?>">
         <div class="cr_autocomplete">
            <input type="password" id="PreventChromeAutocomplete"
               name="PreventChromeAutocomplete" autocomplete="address-level4" />
         </div>
         <?php
            settings_fields('ums_option_group');
            do_settings_sections('ums_option_group');
            $ums_Main_Settings = get_option('ums_Main_Settings', false);
            if (isset($ums_Main_Settings['ums_enabled'])) {
                $ums_enabled = $ums_Main_Settings['ums_enabled'];
            } else {
                $ums_enabled = '';
            }
            if (isset($ums_Main_Settings['headlessbrowserapi_key'])) {
                $headlessbrowserapi_key = $ums_Main_Settings['headlessbrowserapi_key'];
            } else {
                $headlessbrowserapi_key = '';
            }
            if (isset($ums_Main_Settings['manga_storage'])) {
                $manga_storage = $ums_Main_Settings['manga_storage'];
            } else {
                $manga_storage = '';
            }
            if (isset($ums_Main_Settings['deepl_auth'])) {
                $deepl_auth = $ums_Main_Settings['deepl_auth'];
            } else {
                $deepl_auth = '';
            }
            if (isset($ums_Main_Settings['bing_auth'])) {
                $bing_auth = $ums_Main_Settings['bing_auth'];
            } else {
                $bing_auth = '';
            }
            if (isset($ums_Main_Settings['google_trans_auth'])) {
                $google_trans_auth = $ums_Main_Settings['google_trans_auth'];
            } else {
                $google_trans_auth = '';
            }
            if (isset($ums_Main_Settings['bing_region'])) {
                $bing_region = $ums_Main_Settings['bing_region'];
            } else {
                $bing_region = '';
            }
            if (isset($ums_Main_Settings['deppl_free'])) {
                $deppl_free = $ums_Main_Settings['deppl_free'];
            } else {
                $deppl_free = '';
            }
            if (isset($ums_Main_Settings['enable_detailed_logging'])) {
                $enable_detailed_logging = $ums_Main_Settings['enable_detailed_logging'];
            } else {
                $enable_detailed_logging = '';
            }
            if (isset($ums_Main_Settings['enable_logging'])) {
                $enable_logging = $ums_Main_Settings['enable_logging'];
            } else {
                $enable_logging = '';
            }
            if (isset($ums_Main_Settings['disable_rerun'])) {
                $disable_rerun = $ums_Main_Settings['disable_rerun'];
            } else {
                $disable_rerun = '';
            }
            if (isset($ums_Main_Settings['also_images'])) {
                $also_images = $ums_Main_Settings['also_images'];
            } else {
                $also_images = '';
            }
            if (isset($ums_Main_Settings['enable_cloudflare'])) {
                $enable_cloudflare = $ums_Main_Settings['enable_cloudflare'];
            } else {
                $enable_cloudflare = '';
            }
            if (isset($ums_Main_Settings['auto_clear_logs'])) {
                $auto_clear_logs = $ums_Main_Settings['auto_clear_logs'];
            } else {
                $auto_clear_logs = '';
            }
            if (isset($ums_Main_Settings['rule_timeout'])) {
                $rule_timeout = $ums_Main_Settings['rule_timeout'];
            } else {
                $rule_timeout = '';
            }
            if (isset($ums_Main_Settings['request_timeout'])) {
                $request_timeout = $ums_Main_Settings['request_timeout'];
            } else {
                $request_timeout = '';
            }
            if (isset($ums_Main_Settings['default_chapters'])) {
                $default_chapters = $ums_Main_Settings['default_chapters'];
            } else {
                $default_chapters = '';
            }
            if (isset($ums_Main_Settings['default_manga'])) {
                $default_manga = $ums_Main_Settings['default_manga'];
            } else {
                $default_manga = '';
            }
            if (isset($ums_Main_Settings['default_schedule'])) {
                $default_schedule = $ums_Main_Settings['default_schedule'];
            } else {
                $default_schedule = '';
            }
            if (isset($ums_Main_Settings['post_author'])) {
                $post_author = $ums_Main_Settings['post_author'];
            } else {
                $post_author = '';
            }
            if (isset($ums_Main_Settings['phantom_timeout'])) {
                $phantom_timeout = $ums_Main_Settings['phantom_timeout'];
            } else {
                $phantom_timeout = '';
            }
            if (isset($ums_Main_Settings['phantom_path'])) {
                $phantom_path = $ums_Main_Settings['phantom_path'];
            } else {
                $phantom_path = '';
            }
            if (isset($ums_Main_Settings['proxy_url'])) {
                $proxy_url = $ums_Main_Settings['proxy_url'];
            } else {
                $proxy_url = '';
            }
            if (isset($ums_Main_Settings['proxy_auth'])) {
                $proxy_auth = $ums_Main_Settings['proxy_auth'];
            } else {
                $proxy_auth = '';
            }
            if (isset($_GET['settings-updated'])) {
            ?>
         <div id="message" class="updated">
            <p class="cr_saved_notif"><strong>&nbsp;<?php echo esc_html__('Settings saved.', 'ultimate-manga-scraper');?></strong></p>
         </div>
         <?php
            $get = get_option('coderevolution_settings_changed', 0);
            if($get == 1)
            {
                delete_option('coderevolution_settings_changed');
            ?>
         <div id="message" class="updated">
            <p class="cr_failed_notif"><strong>&nbsp;<?php echo esc_html__('Plugin registration failed!', 'ultimate-manga-scraper');?></strong></p>
         </div>
         <?php
            }
            elseif($get == 2)
            {
                    delete_option('coderevolution_settings_changed');
            ?>
         <div id="message" class="updated">
            <p class="cr_saved_notif"><strong>&nbsp;<?php echo esc_html__('Plugin registration successful!', 'ultimate-manga-scraper');?></strong></p>
         </div>
         <?php
            }
                }
            ?>
         <div>
            <div class="ums_class">
               <table class="widefat">
                  <tr>
                     <td>
                        <h1>
                           <span class="gs-sub-heading"><b>Ultimate Web Novel & Manga Scraper - <?php echo esc_html__('Main Switch:', 'ultimate-manga-scraper');?></b>&nbsp;</span>
                           <?php
                           //phpCore was here
                           ?>
                           <span class="cr_07_font">v2.0.3 <sup><small><code>Nulled</code></small></sup>&nbsp;</span>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Enable or disable this plugin. This acts like a main switch.", 'ultimate-manga-scraper');
                                    ?>
                              </div>
                           </div>
                        </h1>
                     </td>
                     <td>
                        <div class="slideThree">
                           <input class="input-checkbox" type="checkbox" id="ums_enabled" name="ums_Main_Settings[ums_enabled]"<?php
                              if ($ums_enabled == 'on')
                                  echo ' checked ';
                              ?>>
                           <label for="ums_enabled"></label>
                        </div>
                     </td>
                  </tr>
               </table>
            </div>
            <div><?php if($ums_enabled != 'on'){echo '<div class="crf_bord cr_color_red cr_auto_update">' . esc_html__('This feature of the plugin is disabled! Please enable it from the above switch.', 'ultimate-manga-scraper') . '</div>';}?>
               <table class="widefat">
                  <tr>
                     <td colspan="2">
                        <?php
                           $plugin = plugin_basename(__FILE__);
                           $plugin_slug = explode('/', $plugin);
                           $plugin_slug = $plugin_slug[0];
                           $uoptions = array();
                           $uoptions['item_id'] = 34167486;
                           $uoptions['item_uid'] = 'pqwl9-he9jk-p6t92-c8sdu-og987-rqidc-egybg';
                           $uoptions['code'] = 'pqwl9-he9jk-p6t92-c8sdu-og987-rqidc-egybg';
                           $uoptions['item_name'] = ' Ultimate Web Novel and Manga Scraper';
                           $uoptions['created_at'] = '24.12.1974';
                           $uoptions['buyer'] = 'Tom & Jerry & Szabi';
                           $uoptions['licence'] = 'extended';
                           $uoptions['supported_until'] = '24.12.2038';
                           ?>
                  </tr>
                  <tr>
                     <td>
                        <hr/>
                     </td>
                     <td>
                        <hr/>
                     </td>
                  </tr>
      <tr><td colspan="2">
      <h3><?php echo esc_html__("Tips for using the plugin:", 'ultimate-manga-scraper');?></h3>
         <ul>
         <li><?php echo sprintf( wp_kses( __( 'This plugin requires the <a href="%s" target="_blank">Madara - WordPress Theme for Manga</a> to work. Please get it from <a href="%s" target="_blank">here</a>.', 'ultimate-manga-scraper'), array(  'a' => array( 'href' => array(), 'target' => array() ) ) ), esc_url_raw( 'https://mangabooth.com/product/wp-manga-theme-madara/' ), esc_url_raw( 'https://mangabooth.com/product/wp-manga-theme-madara/' ) );?>
            </li>
            <li><?php echo sprintf( wp_kses( __( 'Need help configuring this plugin? Please check it\'s <a href="%s" target="_blank">video tutorial</a>.', 'ultimate-manga-scraper'), array(  'a' => array( 'href' => array(), 'target' => array() ) ) ), esc_url_raw( 'https://www.youtube.com/watch?v=kUz8xXIJNAs&list=PLEiGTaa0iBIgRIhjGCYUk545tWkfJrTru&index=1' ) );?>
            </li>
            <li><?php echo sprintf( wp_kses( __( 'Having issues with the plugin? Please be sure to check our <a href="%s" target="_blank">knowledge-base</a> before you contact <a href="%s" target="_blank">our support</a>!', 'ultimate-manga-scraper'), array(  'a' => array( 'href' => array(), 'target' => array() ) ) ), esc_url_raw( '//coderevolution.ro/knowledge-base' ), esc_url_raw('//coderevolution.ro/support' ) );?></li>
            <li><?php echo sprintf( wp_kses( __( 'Do you enjoy our plugin? Please give it a <a href="%s" target="_blank">rating</a> on CodeCanyon, or check <a href="%s" target="_blank">our website</a> for other cool plugins.', 'ultimate-manga-scraper'), array(  'a' => array( 'href' => array(), 'target' => array() ) ) ), esc_url_raw( '//codecanyon.net/downloads' ), esc_url_raw( 'https://coderevolution.ro' ) );?></a></li>
         </ul>
         <hr/>
      </td></tr>
                  <tr>
                     <td colspan="2">
                        <h3><?php echo esc_html__("Scraping Enhancements:", 'ultimate-manga-scraper');?></h3>
                     </td>
                  </tr>
                  <tr>
                    <td>
                       <div>
                          <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                             <div class="bws_hidden_help_text cr_min_260px">
                                <?php
                                   echo sprintf( wp_kses( __( "If you wish to use the HeadlessBrowserAPI to render JavaScript generated content for your scraped pages, enter your API key here. Get one <a href='%s' target='_blank'>here</a>. If you enter a value here, new options will become available in the 'Use PhantomJs/Puppeteer/Tor To Parse JavaScript On Pages' in importing rule settings.", 'ultimate-manga-scraper'), array(  'a' => array( 'href' => array(), 'target' => array() ) ) ), esc_url_raw( 'https://headlessbrowserapi.com/pricing/' ) );
                                   ?>
                             </div>
                          </div>
                          <b><a href="https://headlessbrowserapi.com/pricing/" target="_blank"><?php echo esc_html__("HeadlessBrowserAPI Key (Optional)", 'ultimate-manga-scraper');?>:</a></b>
                          <?php
                           $call_count = get_option('headless_calls', false);
                           if($headlessbrowserapi_key != '' && $call_count !== false)
                           {
                              echo esc_html__("Remaining API Calls For Today: ", 'ultimate-manga-scraper') . '<b>' . $call_count . '</b>';
                           }
                          ?>
                          <div class="cr_float_right bws_help_box bws_help_box_right dashicons cr_align_middle"><img class="cr_align_middle" src="<?php echo plugins_url('../images/new.png', __FILE__);?>" alt="new feature"/>
                                                      <div class="bws_hidden_help_text cr_min_260px"><?php echo esc_html__("New feature added to this plugin: it is able to use HeadlessBrowserAPI to scrape with JavaScript rendered content any website from the internet. Also, the Tor node of the API will be able to scrape .onion sites from the Dark Net!", 'ultimate-manga-scraper');?>
                                                      </div>
                                                   </div>
                       </div>
                    </td>
                    <td>
                       <div>
                          <input type="password" autocomplete="off" id="headlessbrowserapi_key" placeholder="<?php echo esc_html__("API key", 'ultimate-manga-scraper');?>" name="ums_Main_Settings[headlessbrowserapi_key]" value="<?php
                             echo esc_html($headlessbrowserapi_key);
                             ?>"/>
                       </div>
                    </td>
                 </tr>
                  <tr>
                     <td colspan="2">
                        <h3><?php echo esc_html__("Plugin Options:", 'ultimate-manga-scraper');?></h3>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Please check this checkbox if your server has CloudFlare caching active. This is needed to prevent some issues happening, because CloudFlare is limiting the execution time of plugins to 100 seconds.", 'ultimate-manga-scraper');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("My Server Is Using CloudFlare Caching:", 'ultimate-manga-scraper');?></b>
                     </td>
                     <td>
                     <input type="checkbox" id="enable_cloudflare" name="ums_Main_Settings[enable_cloudflare]" onclick="mainChanged()"<?php
                        if ($enable_cloudflare == 'on')
                            echo ' checked ';
                        ?>>
                     </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Select the storage you wish to use to store scraped manga. To display more options here, set up storage settings in Madara Theme Settings.", 'ultimate-manga-scraper');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Manga Storage Device:", 'ultimate-manga-scraper');?></b>
                        </div>
                     </td>
                     <td>
                        <div>
                           <select id="manga_storage" name="ums_Main_Settings[manga_storage]" >
                           <?php
                           if(!isset($GLOBALS['wp_manga']))
                           {
                              echo '<option value="local" selected>Local</option>';
                           }
                           else
                           {
                              foreach ( $GLOBALS['wp_manga']->get_available_host() as $host )
                              { ?>
                                 <option value="<?php echo esc_attr( $host['value'] ) ?>" <?php selected( $host['value'], $manga_storage ); ?>><?php echo esc_attr( $host['text'] ) ?></option>
                              <?php
                              }
                           }
                           ?>
                           </select>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Do you want to enable logging for rules?", 'ultimate-manga-scraper');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Enable Logging for Rules:", 'ultimate-manga-scraper');?></b>
                     </td>
                     <td>
                     <input type="checkbox" id="enable_logging" name="ums_Main_Settings[enable_logging]" onclick="mainChanged()"<?php
                        if ($enable_logging == 'on')
                            echo ' checked ';
                        ?>>
                     </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div class="hideLog">
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Do you want to enable detailed logging for rules? Note that this will dramatically increase the size of the log this plugin generates.", 'ultimate-manga-scraper');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Enable Detailed Logging for Rules:", 'ultimate-manga-scraper');?></b>
                        </div>
                     </td>
                     <td>
                        <div class="hideLog">
                           <input type="checkbox" id="enable_detailed_logging" name="ums_Main_Settings[enable_detailed_logging]"<?php
                              if ($enable_detailed_logging == 'on')
                                  echo ' checked ';
                              ?>>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("In case of your server forcefully stopping the processing of chapters in the plugin, it will attempt to recover and restart processing. On some servers, this might cause duplicate content issues. Do you want to disable automatic rerunning of rules?", 'ultimate-manga-scraper');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Disable Automatic Rerunning of Rules:", 'ultimate-manga-scraper');?></b>
                     </td>
                     <td>
                     <input type="checkbox" id="disable_rerun" name="ums_Main_Settings[disable_rerun]" onclick="mainChanged()"<?php
                        if ($disable_rerun == 'on')
                            echo ' checked ';
                        ?>>
                     </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Select if you want to scrape images of chapters also using headless browsers configured in the plugin.", 'ultimate-manga-scraper');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Scrape Images Also Using Headless Browsers:", 'ultimate-manga-scraper');?></b>
                     </td>
                     <td>
                     <input type="checkbox" id="also_images" name="ums_Main_Settings[also_images]"<?php
                        if ($also_images == 'on')
                            echo ' checked ';
                        ?>>
                     </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div class="hideLog">
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Choose if you want to automatically clear logs after a period of time.", 'ultimate-manga-scraper');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Automatically Clear Logs After:", 'ultimate-manga-scraper');?></b>
                        </div>
                     </td>
                     <td>
                        <div class="hideLog">
                           <select id="auto_clear_logs" name="ums_Main_Settings[auto_clear_logs]" >
                              <option value="No"<?php
                                 if ($auto_clear_logs == "No") {
                                     echo " selected";
                                 }
                                 ?>><?php echo esc_html__("Disabled", 'ultimate-manga-scraper');?></option>
                              <option value="monthly"<?php
                                 if ($auto_clear_logs == "monthly") {
                                     echo " selected";
                                 }
                                 ?>><?php echo esc_html__("Once a month", 'ultimate-manga-scraper');?></option>
                              <option value="weekly"<?php
                                 if ($auto_clear_logs == "weekly") {
                                     echo " selected";
                                 }
                                 ?>><?php echo esc_html__("Once a week", 'ultimate-manga-scraper');?></option>
                              <option value="daily"<?php
                                 if ($auto_clear_logs == "daily") {
                                     echo " selected";
                                 }
                                 ?>><?php echo esc_html__("Once a day", 'ultimate-manga-scraper');?></option>
                              <option value="twicedaily"<?php
                                 if ($auto_clear_logs == "twicedaily") {
                                     echo " selected";
                                 }
                                 ?>><?php echo esc_html__("Twice a day", 'ultimate-manga-scraper');?></option>
                              <option value="hourly"<?php
                                 if ($auto_clear_logs == "hourly") {
                                     echo " selected";
                                 }
                                 ?>><?php echo esc_html__("Once an hour", 'ultimate-manga-scraper');?></option>
                           </select>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("If you want to use a proxy to crawl webpages, input it's address here. Required format: IP Address/URL:port", 'ultimate-manga-scraper');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Web Proxy Address:", 'ultimate-manga-scraper');?></b>
                        </div>
                     </td>
                     <td>
                        <div>
                           <input type="text" id="proxy_url" placeholder="<?php echo esc_html__("Input web proxy url", 'ultimate-manga-scraper');?>" name="ums_Main_Settings[proxy_url]" value="<?php echo esc_html($proxy_url);?>"/>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("If you want to use a proxy to crawl webpages, and it requires authentification, input it's authentification details here. Required format: username:password", 'ultimate-manga-scraper');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Web Proxy Authentification:", 'ultimate-manga-scraper');?></b>
                        </div>
                     </td>
                     <td>
                        <div>
                           <input type="text" id="proxy_auth" placeholder="<?php echo esc_html__("Input web proxy auth", 'ultimate-manga-scraper');?>" name="ums_Main_Settings[proxy_auth]" value="<?php echo esc_html($proxy_auth);?>"/>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Set the timeout (in seconds) for every rule running. I recommend that you leave this field at it's default value (3600).", 'ultimate-manga-scraper');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Timeout for Rule Running (seconds):", 'ultimate-manga-scraper');?></b>
                        </div>
                     </td>
                     <td>
                        <div>
                           <input type="number" id="rule_timeout" step="1" min="0" placeholder="<?php echo esc_html__("Input rule timeout in seconds", 'ultimate-manga-scraper');?>" name="ums_Main_Settings[rule_timeout]" value="<?php
                              echo esc_html($rule_timeout);
                              ?>"/>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Set the delay (in seconds) for every scraping request. I recommend that you leave this field at it's default value (1).", 'ultimate-manga-scraper');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Delay Between Requests (seconds):", 'ultimate-manga-scraper');?></b>
                        </div>
                     </td>
                     <td>
                        <div>
                           <input type="number" id="request_timeout" step="1" min="0" placeholder="<?php echo esc_html__("Input request timeout in seconds", 'ultimate-manga-scraper');?>" name="ums_Main_Settings[request_timeout]" value="<?php echo esc_html($request_timeout);?>"/>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Set a default value for the 'Schedule' rule paramter. If you leave this field blank, the value 24 will be used.", 'ultimate-manga-scraper');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Default Value For The 'Schedule' Rule Parameter:", 'ultimate-manga-scraper');?></b>
                        </div>
                     </td>
                     <td>
                        <div>
                           <input type="number" id="default_schedule" step="1" min="0" placeholder="<?php echo esc_html__("24", 'ultimate-manga-scraper');?>" name="ums_Main_Settings[default_schedule]" value="<?php echo esc_html($default_schedule);?>"/>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Set a default value for the 'Author' rule paramter. If you leave this field blank, there will not be set a default author for rules.", 'ultimate-manga-scraper');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Default Value For The 'Author' Rule Parameter:", 'ultimate-manga-scraper');?></b>
                        </div>
                     </td>
                     <td>
                        <div>
                        <select id="post_author" name="ums_Main_Settings[post_author]" class="cr_width_auto cr_max_width_150">
                  <?php
                     $blogusers = get_users( [ 'role__in' => [ 'contributor', 'author', 'editor', 'administrator' ] ] );
                     foreach ($blogusers as $user) {
                         echo '<option value="' . esc_html($user->ID) . '"';
                         if($user->ID == $post_author)
                         {
                           echo ' selected';
                         }
                         echo '>' . esc_html($user->display_name) . '</option>';
                     }
                     ?>
                  </select>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Set a default value for the 'Max # Chapters' rule paramter. If you leave this field blank, the value 1 will be used.", 'ultimate-manga-scraper');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Default Value For The 'Max # Chapters' Rule Parameter:", 'ultimate-manga-scraper');?></b>
                        </div>
                     </td>
                     <td>
                        <div>
                           <input type="number" id="default_chapters" step="1" min="0" placeholder="<?php echo esc_html__("1", 'ultimate-manga-scraper');?>" name="ums_Main_Settings[default_chapters]" value="<?php echo esc_html($default_chapters);?>"/>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Set a default value for the 'Maximum Number Of Manga to Scrape' rule paramter. If you leave this field blank, the value 1 will be used.", 'ultimate-manga-scraper');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Default Value For The 'Maximum Number Of Manga to Scrape' Rule Parameter:", 'ultimate-manga-scraper');?></b>
                        </div>
                     </td>
                     <td>
                        <div>
                           <input type="number" id="default_manga" step="1" min="0" placeholder="<?php echo esc_html__("1", 'ultimate-manga-scraper');?>" name="ums_Main_Settings[default_manga]" value="<?php echo esc_html($default_manga);?>"/>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td colspan="2">
                     <h3><?php echo esc_html__("Translation Options:", 'ultimate-manga-scraper');?></h3>
                              </td>
                              </tr>

                     <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo sprintf( wp_kses( __( "If you wish to use the official version of the Google Translator API for translation, you must enter first a Google API Key. Get one <a href='%s' target='_blank'>here</a>.  Please enable the 'Cloud Translation API' in <a href='%s' target='_blank'>Google Cloud Console</a>. Translation will work even without even without entering an API key here, but in this case, an unofficial Google Translate API will be used.", 'ultimate-manga-scraper'), array(  'a' => array( 'href' => array(), 'target' => array() ) ) ), esc_url_raw( 'https://console.cloud.google.com/apis/credentials' ), esc_url_raw( 'https://console.cloud.google.com/marketplace/browse?q=translate' ) );
                                    ?>
                              </div>
                           </div>
                           <b><a href="https://console.cloud.google.com/apis/credentials" target="_blank"><?php echo esc_html__("Google Translator API Key (Optional)", 'ultimate-manga-scraper');?>:</a></b>
                        </div>
                     </td>
                     <td>
                        <div>
                           <input type="password" autocomplete="off" id="google_trans_auth" placeholder="<?php echo esc_html__("API Key (optional)", 'ultimate-manga-scraper');?>" name="ums_Main_Settings[google_trans_auth]" value="<?php
                              echo esc_html($google_trans_auth);
                              ?>"/>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo sprintf( wp_kses( __( "If you wish to use Microsoft for translation, you must enter first a Microsoft 'Access Key'. Learn how to get one <a href='%s' target='_blank'>here</a>. If you enter a value here, new options will become available in the 'Automatically Translate Content To' and 'Source Language' fields.", 'ultimate-manga-scraper'), array(  'a' => array( 'href' => array(), 'target' => array() ) ) ), esc_url_raw( 'https://coderevolution.ro/knowledge-base/faq/how-to-create-a-microsoft-translator-api-key-from-using-azure-control-panel/' ) );
                                    ?>
                              </div>
                           </div>
                           <b><a href="https://coderevolution.ro/knowledge-base/faq/how-to-create-a-microsoft-translator-api-key-from-using-azure-control-panel/" target="_blank"><?php echo esc_html__("Microsoft Translator Access Key (Optional)", 'ultimate-manga-scraper');?>:</a></b>
                        </div>
                     </td>
                     <td>
                        <div>
                           <input type="password" autocomplete="off" id="bing_auth" placeholder="<?php echo esc_html__("Access key (optional)", 'ultimate-manga-scraper');?>" name="ums_Main_Settings[bing_auth]" value="<?php
                              echo esc_html($bing_auth);
                              ?>"/>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo sprintf( wp_kses( __( "If you selected a specific region in your Azure Microsoft account, you must enter it here. Learn more <a href='%s' target='_blank'>here</a>. The default is global.", 'ultimate-manga-scraper'), array(  'a' => array( 'href' => array(), 'target' => array() ) ) ), esc_url_raw( 'https://coderevolution.ro/knowledge-base/faq/how-to-create-a-microsoft-translator-api-key-from-using-azure-control-panel/' ) );
                                    ?>
                              </div>
                           </div>
                           <b><a href="https://coderevolution.ro/knowledge-base/faq/how-to-create-a-microsoft-translator-api-key-from-using-azure-control-panel/" target="_blank"><?php echo esc_html__("Microsoft Translator Region Code (Optional)", 'ultimate-manga-scraper');?>:</a></b>
                        </div>
                     </td>
                     <td>
                        <div>
                           <input type="text" id="bing_region" placeholder="<?php echo esc_html__("global", 'ultimate-manga-scraper');?>" name="ums_Main_Settings[bing_region]" value="<?php
                              echo esc_html($bing_region);
                              ?>"/>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo sprintf( wp_kses( __( "If you wish to use DeepL for translation, you must enter first a DeepL 'Authentication Key'. Get one <a href='%s' target='_blank'>here</a>. If you enter a value here, new options will become available in the 'Automatically Translate Content To' and 'Source Language' fields.", 'ultimate-manga-scraper'), array(  'a' => array( 'href' => array(), 'target' => array() ) ) ), esc_url_raw( 'https://www.deepl.com/subscription.html' ) );
                                    ?>
                              </div>
                           </div>
                           <b><a href="https://www.deepl.com/subscription.html" target="_blank"><?php echo esc_html__("DeepL Translator Authentication Key (Optional)", 'ultimate-manga-scraper');?>:</a></b>
                        </div>
                     </td>
                     <td>
                        <div>
                           <input type="password" autocomplete="off" id="deepl_auth" placeholder="<?php echo esc_html__("Auth key (optional)", 'ultimate-manga-scraper');?>" name="ums_Main_Settings[deepl_auth]" value="<?php
                              echo esc_html($deepl_auth);
                              ?>"/>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Check this checkbox if the above API key is a DeepL free plan key. If it is a PRO key, please uncheck this checkbox.", 'ultimate-manga-scraper');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("The Above Is A DeepL Free API Key:", 'ultimate-manga-scraper');?></b>
                     </td>
                     <td>
                     <input type="checkbox" id="deppl_free" name="ums_Main_Settings[deppl_free]"<?php
                        if ($deppl_free == 'on')
                           echo ' checked ';
                        ?>>
                     </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <hr/>
                     </td>
                     <td>
                        <hr/>
                     </td>
                  </tr>
                  <tr>
                     <td colspan="2">
                        <h3><?php echo esc_html__("PhantomJS Settings:", 'ultimate-manga-scraper');?></h3>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo sprintf( wp_kses( __( "Set the path on your local server of the phantomjs executable. If you leave this field blank, the default 'phantomjs' call will be used. <a href='%s' target='_blank'>How to install PhantomJs?</a>", 'ultimate-manga-scraper'), array(  'a' => array( 'href' => array(), 'target' => array() ) ) ), esc_url_raw( "//coderevolution.ro/knowledge-base/faq/how-to-install-phantomjs/" ));
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("PhantomJS Path On Server:", 'ultimate-manga-scraper');?></b>
<?php
                       if($phantom_path != '')
                       {
                           $phantom = ums_testPhantom();
                           if($phantom === 0)
                           {
                               echo '<br/><span class="cr_red12"><b>' . esc_html__('INFO: PhantomJS not found - please install it on your server or configure the path to it in plugin\'s \'Main Settings\'!', 'ultimate-manga-scraper') . '</b> <a href=\'//coderevolution.ro/knowledge-base/faq/how-to-install-phantomjs/\' target=\'_blank\'>' . esc_html__('How to install PhantomJs?', 'ultimate-manga-scraper') . '</a></span>';
                           }
                           elseif($phantom === -1)
                           {
                               echo '<br/><span class="cr_red12"><b>' . esc_html__('INFO: PhantomJS cannot run - shell exec is not enabled on your server. Please enable it and retry using this feature of the plugin.', 'ultimate-manga-scraper') . '</b></span>';
                           }
                           elseif($phantom === -2)
                           {
                               echo '<br/><span class="cr_red12"><b>' . esc_html__('INFO: PhantomJS cannot run - shell exec is not allowed to run on your server (in disable_functions list in php.ini). Please enable it and retry using this feature of the plugin.', 'ultimate-manga-scraper') . '</b></span>';
                           }
                           elseif($phantom === 1)
                           {
                               echo '<br/><span class="cr_green12"><b>' . esc_html__('INFO: PhantomJS OK', 'ultimate-manga-scraper') . '</b></span>';
                           }
                       }
?>
                        </div>
                     </td>
                     <td>
                        <div>
                           <input type="text" id="phantom_path" placeholder="<?php echo esc_html__("Path to phantomjs", 'ultimate-manga-scraper');?>" name="ums_Main_Settings[phantom_path]" value="<?php echo esc_html($phantom_path);?>"/>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Set the timeout (in milliseconds) for every phantomjs running. I recommend that you leave this field at it's default value (15000). If you leave this field blank, the default value will be used.", 'ultimate-manga-scraper');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Timeout for PhantomJs Execution:", 'ultimate-manga-scraper');?></b>
                        </div>
                     </td>
                     <td>
                        <div>
                           <input type="number" id="phantom_timeout" step="1" min="1" placeholder="<?php echo esc_html__("Input phantomjs timeout in milliseconds", 'ultimate-manga-scraper');?>" name="ums_Main_Settings[phantom_timeout]" value="<?php echo esc_html($phantom_timeout);?>"/>
                        </div>
                     </td>
                  </tr>
               </table>
               </div>
               </td></tr>
               </table>
            </div>
         </div>

   <hr/>
   <div><p class="crsubmit"><input type="submit" name="btnSubmit" id="btnSubmit" class="button button-primary" onclick="unsaved = false;" value="<?php echo esc_html__("Save Settings", 'ultimate-manga-scraper');?>"/></p></div>
   </form>
</div>
<?php
   }
   ?>