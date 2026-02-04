<?php
/*
 * Copyright (C) 2026 NIKOL
 * Licensed under LUCA Free License v1.0
 * DO WHAT THE FUCK YOU WANT TO.
 */
   function ums_manga_generic_panel()
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
        $ums_Main_Settings = get_option('ums_Main_Settings', false);
        $GLOBALS['wp_object_cache']->delete('ums_manga_generic_list', 'options');
        $all_rules = get_option('ums_manga_generic_list', array());
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
   ?>
<div class="wp-header-end"></div>
<div class="wrap gs_popuptype_holder seo_pops">
    <h2><?php echo esc_html__("Generic Manga Scraper (Any Madara Theme Website)", 'ultimate-manga-scraper');?></h2>
<div>
   <form id="myForm" method="post" action="<?php echo (ums_isSecure() ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>">
      <?php
         wp_nonce_field('ums_save_rules', '_umsr_nonce');
         
         if (isset($_GET['settings-updated'])) {
         ?>
      <div>
         <p class="cr_saved_notif"><strong><?php echo esc_html__("Settings saved.", 'ultimate-manga-scraper');?></strong></p>
      </div>
      <?php
         }
         $hu = get_home_url();
         ?>
      <div>
         <div class="hideMain">
            <hr/>
            <div class="table-responsive">
               <table id="mainRules" class="responsive table cr_main_table">
                  <thead>
                     <tr>
                        <th>
                           <?php echo esc_html__("ID", 'ultimate-manga-scraper');?>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("This is the ID of the rule.", 'ultimate-manga-scraper');
                                    ?>
                              </div>
                           </div>
                        </th>
                        <th>
                           <?php echo esc_html__("Manga URL", 'ultimate-manga-scraper');?>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Add the URL of the manga or your search keyword.", 'ultimate-manga-scraper');
                                    ?>
                              </div>
                           </div>
                        </th>
                        <th><?php echo esc_html__("Schedule", 'ultimate-manga-scraper');?><div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                        <div class="bws_hidden_help_text cr_min_260px">
                        <?php
                                    $unlocker = get_option('ums_minute_running_unlocked', false);
                                    if($unlocker == '1')
                                    {
                                        echo esc_html__("Select the interval in minutes after which you want this rule to run. Defined in minutes.", 'ultimate-manga-scraper');
                                    }
                                    else
                                    {
                                        echo esc_html__("Select the interval in hours after which you want this rule to run. Defined in hours.", 'ultimate-manga-scraper');
                                    }
                           
                           ?>
                        </div>
                        </div></th>
                        <th><?php echo esc_html__("Max # Chapters", 'ultimate-manga-scraper');?><div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                        <div class="bws_hidden_help_text cr_min_260px">
                        <?php
                           echo esc_html__("Number of chapters to scrape from each manga is listed and scraped by this rule.", 'ultimate-manga-scraper');
                           ?>
                        </div>
                        </div></th>
                        <th>
                           <?php echo esc_html__("Chapter Status", 'ultimate-manga-scraper');?><br/>
                           
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Select the chapter status: published, draft, pending.", 'ultimate-manga-scraper');
                                    ?>
                              </div>
                           </div>
                        </th>
                        <th><?php echo esc_html__("Manga Author", 'ultimate-manga-scraper');?><div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                        <div class="bws_hidden_help_text cr_min_260px">
                        <?php
                           echo esc_html__("Select the author that you want to assign for the automatically generated mangas.", 'ultimate-manga-scraper');
                           ?>
                        </div>
                        </div></th>
                        <th><?php echo esc_html__("More Options", 'ultimate-manga-scraper');?><div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                        <div class="bws_hidden_help_text cr_min_260px">
                        <?php
                           echo esc_html__("Shows advanced settings for this rule.", 'ultimate-manga-scraper');
                           ?>
                        </div>
                        </div></th>
                        <th class="cr_max_width_20"><?php echo esc_html__("Del", 'ultimate-manga-scraper');?><div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                        <div class="bws_hidden_help_text cr_min_260px">
                        <?php
                           echo esc_html__("Do you want to delete this rule?", 'ultimate-manga-scraper');
                           ?>
                        </div>
                        </div></th>
                        <th class="cr_max_42"><?php echo esc_html__("Active", 'ultimate-manga-scraper');?><div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                        <div class="bws_hidden_help_text cr_min_260px">
                        <?php
                           echo esc_html__("Do you want to enable this rule? You can deactivate any rule (you don't have to delete them to deactivate them).", 'ultimate-manga-scraper');
                           ?>
                        </div>
                        </div>
                        <br/>
                        <input type="checkbox" onchange="thisonChangeHandler(this)" id="exclusion"></th>
                        <th class="cr_max_32"><?php echo esc_html__("Info", 'ultimate-manga-scraper');?><div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                        <div class="bws_hidden_help_text cr_min_260px">
                        <?php
                           echo esc_html__("The number of mangas this rule has generated so far.", 'ultimate-manga-scraper');
                           ?>
                        </div>
                        </div></th>
                        <th class="cr_actions"><?php echo esc_html__("Actions", 'ultimate-manga-scraper');?><div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                        <div class="bws_hidden_help_text cr_min_260px">
                        <?php
                           echo esc_html__("Do you want to run this rule now? Note that only one instance of a rule is allowed at once.", 'ultimate-manga-scraper');
                           ?>
                        </div>
                        </div></th>
                     </tr>
                     
                  </thead>
                  <tbody>
                  <?php
                     echo ums_expand_rules_generic_manga($hu);
                     if(isset($_GET['ums_page']))
                     {
                         $current_page = $_GET['ums_page'];
                     }
                     else
                     {
                         $current_page = '';
                     }
                     if($current_page == '' || (is_numeric($current_page) && $current_page == $max_pages))
                     {
                     ?>
                  
                  <tr>
                  <td class="cr_comm_td">-</td>
                  <td class="cr_short_td"><input type="text" name="ums_manga_generic_list[location][]" placeholder="https://mangasite.com/manga/..." value="" class="cr_width_full"/></td>
                  <td class="cr_comm_td"><input type="number" step="1" min="1" name="ums_manga_generic_list[schedule][]" max="8765812" class="cr_width_60" placeholder="Select the rule schedule interval" value="24"/></td>
                  <td class="cr_comm_td"><input type="number" step="1" min="0"<?php if (stristr($hu, '143.198.112.144') !== false){ echo ' max="3"';}?> name="ums_manga_generic_list[max][]" placeholder="Select the max # of generated chapters" value="1" class="cr_width_60"/></td>
                  <td class="cr_status"><select id="submit_status" name="ums_manga_generic_list[submit_status][]" class="cr_width_70">
                  <option value="pending"><?php echo esc_html__("Pending -> Moderate", 'ultimate-manga-scraper');?></option>
                  <option value="draft"><?php echo esc_html__("Draft -> Moderate", 'ultimate-manga-scraper');?></option>
                  <option value="publish" selected><?php echo esc_html__("Published", 'ultimate-manga-scraper');?></option>
                  <option value="private"><?php echo esc_html__("Private", 'ultimate-manga-scraper');?></option>
                  <option value="trash"><?php echo esc_html__("Trash", 'ultimate-manga-scraper');?></option>
                  </select>  </td>
                  <td class="cr_author"><select id="post_author" name="ums_manga_generic_list[post_author][]" class="cr_width_auto cr_max_width_150">
                  <?php
                     $blogusers = get_users( [ 'role__in' => [ 'contributor', 'author', 'editor', 'administrator' ] ] );
                     foreach ($blogusers as $user) {
                         echo '<option value="' . esc_html($user->ID) . '"';
                         echo '>' . esc_html($user->display_name) . '</option>';
                     }
                     ?>
                     <option value="rand"><?php echo esc_html__("Random user", 'ultimate-manga-scraper');?></option>
                     <option value="feed-news"><?php echo esc_html__("Import author", 'ultimate-manga-scraper');?></option>
                  </select>  </td>
                  <td class="cr_width_70">
                  <input type="button" id="mybtnfzr" value="Settings">
                  <div id="mymodalfzr" class="codemodalfzr">
                  <div class="codemodalfzr-content">
                  <div class="codemodalfzr-header">
                  <span id="ums_close" class="codeclosefzr">&times;</span>
                  <h2><span class="cr_color_white"><?php echo esc_html__("New Rule", 'ultimate-manga-scraper');?></span> <?php echo esc_html__("Advanced Settings", 'ultimate-manga-scraper');?></h2>
                  </div>
                  <div class="codemodalfzr-body">
                  <div class="table-responsive">
                  <table class="responsive table cr_main_table_nowr">
                  <tr><td class="cr_min_width_200">
                  <div>
                  <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                  <div class="bws_hidden_help_text cr_min_260px">
                  <?php
                     echo esc_html__("Set the maximum manga count to scrape. This value is optional.", 'ultimate-manga-scraper');
                     ?>
                  </div>
                  </div>
                  <b><?php echo esc_html__("Maximum Number Of Manga to Scrape:", 'ultimate-manga-scraper');?></b>
                  </td><td><input type="number" min="1" name="ums_manga_generic_list[max_manga][]"<?php if (stristr($hu, '143.198.112.144') !== false){ echo ' max="1"';}?> value="1" placeholder="Maximum number of mangas to scrape" class="cr_width_full">
                  </div>
                  </td></tr>
				  <tr><td class="cr_min_width_200">
                  <div>
                  <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                  <div class="bws_hidden_help_text cr_min_260px">
                  <?php
                     echo esc_html__("Select the manga genre that you want for the automatically generated manga to have.", 'ultimate-manga-scraper');
                     ?>
                  </div>
                  </div>
                  <b><?php echo esc_html__("Additional Manga Genre:", 'ultimate-manga-scraper');?></b>
                  </td><td>
                  <select id="default_category" name="ums_manga_generic_list[default_category][]" class="cr_width_full">
                  <option value="ums_no_category_12345678" selected><?php echo esc_html__("Do Not Add a Genre", 'ultimate-manga-scraper');?></option>
                  <?php
                     $categories = get_terms( 'wp-manga-genre', array( 'hide_empty' => false ) );
                     foreach ($categories as $category) {
                     ?>
                  <option value="<?php
                     echo esc_html($category->term_id);
                     ?>"><?php
                     echo esc_html(sanitize_text_field($category->name));
                     ?></option>
                  <?php
                     }
                     ?>
                  </select>     
                  </div>
                  </td></tr><tr><td>
                  <div>
                  <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                  <div class="bws_hidden_help_text cr_min_260px">
                  <?php
                     echo esc_html__("Do you want to automatically add manga genres from the manga items?", 'ultimate-manga-scraper');
                     ?>
                  </div>
                  </div>
                  <b><?php echo esc_html__("Auto Add Genres:", 'ultimate-manga-scraper');?></b>
                  </td><td>
                  <select class="cr_width_full" id="auto_categories" name="ums_manga_generic_list[auto_categories][]">
                  <option value="disabled"><?php echo esc_html__("Disabled", 'ultimate-manga-scraper');?></option>
                  <option value="genre" selected><?php echo esc_html__("Manga Genres", 'ultimate-manga-scraper');?></option>
                  </select>   
                  </div>
                  </td></tr><tr><td>
                  <div>
                  <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                  <div class="bws_hidden_help_text cr_min_260px">
                  <?php
                     echo esc_html__("Do you want to automatically add manga tags from the manga items?", 'ultimate-manga-scraper');
                     ?>
                  </div>
                  </div>
                  <b><?php echo esc_html__("Auto Add Manga Tags:", 'ultimate-manga-scraper');?></b>
                  </td><td>
                  <select class="cr_width_full" id="auto_tags" name="ums_manga_generic_list[auto_tags][]">
                  <option value="disabled" selected><?php echo esc_html__("Disabled", 'ultimate-manga-scraper');?></option>
                  <option value="genre"><?php echo esc_html__("Manga Genres", 'ultimate-manga-scraper');?></option>
                  </select> 
                  </div>
                  </td></tr><tr><td>
                  <div>
                  <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                  <div class="bws_hidden_help_text cr_min_260px">
                  <?php
                     echo esc_html__("Select the manga tags that you want for the automatically generated manga to have.", 'ultimate-manga-scraper');
                     ?>
                  </div>
                  </div>
                  <b><?php echo esc_html__("Additional Manga Tags:", 'ultimate-manga-scraper');?></b>
                  </td><td>
                  <input type="text" name="ums_manga_generic_list[default_tags][]" value="" placeholder="Please insert your additional manga tags here" class="cr_width_full">
                  </div>
                  </td></tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px"><?php echo esc_html__("Do you want to try to use PhantomJS to try to parse JavaScript from crawled pages (for pages that create dynamic content, on page load, using JavaScript)? Please note that for this to work, you must have PhantomJs installed on your server. You can configure the path to PhantomJS from your server, from plugin's 'Main Settings'.", 'ultimate-manga-scraper');?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Content Scraping Method To Use:", 'ultimate-manga-scraper');?></b><div class="cr_float_right bws_help_box bws_help_box_right dashicons cr_align_middle"><img class="cr_align_middle" src="<?php echo plugins_url('../images/new.png', __FILE__);?>" alt="new feature"/>
                                                      <div class="bws_hidden_help_text cr_min_260px"><?php echo esc_html__("New feature added to this plugin: it is able to use HeadlessBrowserAPI to scrape with JavaScript rendered content any website from the internet. Also, the Tor node of the API will be able to scrape .onion sites from the Dark Net!", 'ultimate-manga-scraper');?>
                                                      </div>
                                                   </div>
                        </div>
                     </td>
                     <td>
                        <div>
                           <select id="use_phantom" name="ums_manga_generic_list[use_phantom][]" class="cr_width_full">
                            <option value="0" selected><?php echo esc_html__("WordPress (Default)", 'ultimate-manga-scraper');?></option>
                            <option value="1"><?php echo esc_html__("Use PhantomJS", 'ultimate-manga-scraper');?></option>          
                            <option value="2"><?php echo esc_html__("Use Puppeteer", 'ultimate-manga-scraper');?></option>
                            <option value="4"<?php if (!isset($ums_Main_Settings['headlessbrowserapi_key']) || trim($ums_Main_Settings['headlessbrowserapi_key']) == ''){echo ' title="' . esc_html__("This option is disabled. To enable it, add a HeadlessBrowserAPI Key in the plugin's 'Main Settings' menu.", 'ultimate-manga-scraper') . '" disabled';}?>><?php echo esc_html__("Puppeteer (HeadlessBrowserAPI)", 'ultimate-manga-scraper');if (!isset($ums_Main_Settings['headlessbrowserapi_key']) || trim($ums_Main_Settings['headlessbrowserapi_key']) == ''){echo esc_html__(' - to enable, add a HeadlessBrowserAPI key in the plugin\'s \'Main Settings\'', 'ultimate-manga-scraper');}?></option>
                            <option value="5"<?php if (!isset($ums_Main_Settings['headlessbrowserapi_key']) || trim($ums_Main_Settings['headlessbrowserapi_key']) == ''){echo ' title="' . esc_html__("This option is disabled. To enable it, add a HeadlessBrowserAPI Key in the plugin's 'Main Settings' menu.", 'ultimate-manga-scraper') . '" disabled';}?>><?php echo esc_html__("Tor (HeadlessBrowserAPI)", 'ultimate-manga-scraper');if (!isset($ums_Main_Settings['headlessbrowserapi_key']) || trim($ums_Main_Settings['headlessbrowserapi_key']) == ''){echo esc_html__(' - to enable, add a HeadlessBrowserAPI key in the plugin\'s \'Main Settings\'', 'ultimate-manga-scraper');}?></option>
                            <option value="6"<?php if (!isset($ums_Main_Settings['headlessbrowserapi_key']) || trim($ums_Main_Settings['headlessbrowserapi_key']) == ''){echo ' title="' . esc_html__("This option is disabled. To enable it, add a HeadlessBrowserAPI Key in the plugin's 'Main Settings' menu.", 'ultimate-manga-scraper') . '" disabled';}?>><?php echo esc_html__("PhantomJS (HeadlessBrowserAPI)", 'ultimate-manga-scraper');if (!isset($ums_Main_Settings['headlessbrowserapi_key']) || trim($ums_Main_Settings['headlessbrowserapi_key']) == ''){echo esc_html__(' - to enable, add a HeadlessBrowserAPI key in the plugin\'s \'Main Settings\'', 'ultimate-manga-scraper');}?></option>
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
                                    echo esc_html__("Do you want to enable comments for the generated manga?", 'ultimate-manga-scraper');
                                    ?>
                                </div>
                            </div>
                            <b><?php echo esc_html__("Enable Comments For Manga:", 'ultimate-manga-scraper');?></b>
                    </td>
                    <td>
                    <input type="checkbox" id="enable_comments" name="ums_manga_generic_list[enable_comments][]" checked>
                    </div>
                    </td>
                    </tr>
                    <tr>
                    <td>
                        <div>
                            <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                                <div class="bws_hidden_help_text cr_min_260px">
                                <?php
                                    echo esc_html__("Do you want to enable pingbacks/trackbacks for the generated manga?", 'ultimate-manga-scraper');
                                    ?>
                                </div>
                            </div>
                            <b><?php echo esc_html__("Enable Pingback/Trackback:", 'ultimate-manga-scraper');?></b>
                    </td>
                    <td>
                    <input type="checkbox" id="enable_pingback" name="ums_manga_generic_list[enable_pingback][]">
                    </div>
                    </td>
                    </tr>
                    <tr>
                    <td>
                        <div>
                            <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                                <div class="bws_hidden_help_text cr_min_260px">
                                <?php
                                    echo esc_html__("Do you want to get the publish date from the source mangas?", 'ultimate-manga-scraper');
                                    ?>
                                </div>
                            </div>
                            <b><?php echo esc_html__("Get Publish Date From Manga:", 'ultimate-manga-scraper');?></b>
                    </td>
                    <td>
                    <input type="checkbox" id="get_date" name="ums_manga_generic_list[get_date][]">
                    </div>
                    </td>
                    </tr>
                    <tr><td>
                  <div>
                  <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                  <div class="bws_hidden_help_text cr_min_260px">
                  <?php
                     echo esc_html__("Set a global chapter warning message to display on the scraped manga.", 'ultimate-manga-scraper');
                     ?>
                  </div>
                  </div>
                  <b><?php echo esc_html__("Global Chapter Warning Message:", 'ultimate-manga-scraper');?></b>
                  </td><td>
                  <input type="text" name="ums_manga_generic_list[chapter_warning][]" value="" placeholder="Global Chapter Warning Message" class="cr_width_full">
                  </div>
                    </td></tr>
                    <tr>
                    <td colspan="2">
                    <h3><?php echo esc_html__("Translation Options:", 'ultimate-manga-scraper');?></h3>
                    </td>
                    </tr>
                    <tr>
                    <td>
                        <div>
                            <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                                <div class="bws_hidden_help_text cr_min_260px"><?php echo esc_html__("Do you want to automatically translate generated content using Google Translate? If set, this will overwrite the 'Automatically Translate Content To' option from plugin's 'Main Settings'.", 'ultimate-manga-scraper');?>
                                </div>
                            </div>
                            <b><?php echo esc_html__("Automatically Translate Content To:", 'ultimate-manga-scraper');?></b><br/><b><?php echo esc_html__("Info:", 'ultimate-manga-scraper');?></b> <?php echo esc_html__("for translation, the plugin also supports WPML.", 'ultimate-manga-scraper');?> <b><a href="https://wpml.org/?aid=238195&affiliate_key=ix3LsFyq0xKz" target="_blank"><?php echo esc_html__("Get WPML now!", 'ultimate-manga-scraper');?></a></b>
                    </td>
                    <td>
                    <select class="cr_width_full" id="translate" name="ums_manga_generic_list[rule_translate][]" >
                    <?php
                        $i = 0;
                        foreach ($GLOBALS['language_names'] as $lang) {
                            echo '<option value="' . esc_attr($GLOBALS['language_codes'][$i]) . '"';
                            if ($i == 0) {
                                echo ' selected';
                            }
                            echo '>' . esc_html($GLOBALS['language_names'][$i]) . '</option>';
                            $i++;
                        }
                        if(isset($ums_Main_Settings['deepl_auth']) && $ums_Main_Settings['deepl_auth'] != '')
                        {
                            $i = 0;
                            foreach ($GLOBALS['language_names_deepl'] as $lang) {
                                echo '<option value="' . esc_attr($GLOBALS['language_codes_deepl'][$i]) . '"';
                                echo '>' . esc_html($GLOBALS['language_names_deepl'][$i]) . '</option>';
                                $i++;
                            }
                        }
                        if(isset($ums_Main_Settings['bing_auth']) && $ums_Main_Settings['bing_auth'] != '')
                        {
                            $i = 0;
                            foreach ($GLOBALS['language_names_bing'] as $lang) {
                                echo '<option value="' . esc_attr($GLOBALS['language_codes_bing'][$i]) . '"';
                                echo '>' . esc_html($GLOBALS['language_names_bing'][$i]) . '</option>';
                                $i++;
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
                                    echo esc_html__("Do you want to not translate manga titles", 'ultimate-manga-scraper');
                                    ?>
                                </div>
                            </div>
                            <b><?php echo esc_html__("Do Not Translate Title:", 'ultimate-manga-scraper');?></b>
                    </td>
                    <td>
                    <input type="checkbox" id="no_translate_title" name="ums_manga_generic_list[no_translate_title][]">
                    </div>
                    </td>
                    </tr>
                  </table></div>
                  </div>
                  <div class="codemodalfzr-footer">
                  <br/>
                  <h3 class="cr_inline">Madara Scraper</h3><span id="ums_ok" class="codeokfzr cr_inline">OK&nbsp;</span>
                  <br/><br/>
                  </div>
                  </div>
                  </div> 
                  </td>
                  <td class="cr_comm_td"><span class="cr_gray20">X</span></td>
                  <td class="cr_comm_td"><input type="checkbox" name="ums_manga_generic_list[active][]" value="1" checked />
                  <input type="hidden" name="ums_manga_generic_list[last_run][]" value="1988-01-27 00:00:00"/></td>
                  <td class="cr_comm_td"><div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                  <div class="bws_hidden_help_text cr_min_260px">
                  <?php
                     echo esc_html__("No info.", 'ultimate-manga-scraper');
                     ?>
                  </div>
                  </div></td>
                  <td class="cr_center">
                  <div>
                  <img src="<?php
                     echo esc_url_raw(plugin_dir_url(dirname(__FILE__)) . 'images/running.gif');
                     ?>" alt="Running" class="cr_running">
                  <div class="codemainfzr cr_gray_back">
                  <select id="actions" class="actions" name="actions" disabled>
                  <option value="select" disabled selected><?php echo esc_html__("Select an Action", 'ultimate-manga-scraper');?></option>
                  <option value="run" onclick=""><?php echo esc_html__("Run This Rule Now", 'ultimate-manga-scraper');?></option>
                  <option value="trash" onclick=""><?php echo esc_html__("Move All Manga To Trash", 'ultimate-manga-scraper');?></option>
                  <option value="delete" onclick=""><?php echo esc_html__("Permanently Delete All Manga", 'ultimate-manga-scraper');?></option>
                  </select>
                  </div>
                  </div>
                  </td>
                  </tr>
                  <?php
                     }
                     ?>
                     </tbody>
               </table>
               </div>
            </div>
         </div>
         <hr/>
         
         <?php
            $next_url = (ums_isSecure() ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            if(stristr($next_url, 'ums_page=') === false)
            {
                if(stristr($next_url, '?') === false)
                {
                    if($max_pages == 1)
                    {
                        $next_url .= '?ums_page=1';
                    }
                    else
                    {
                        $next_url .= '?ums_page=2';
                    }
                }
                else
                {
                    if($max_pages == 1)
                    {
                        $next_url .= '&ums_page=1';
                    }
                    else
                    {
                        $next_url .= '&ums_page=2';
                    }
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
                    $next_page = $curent_page + 1;
                    if($next_page > $max_pages)
                    {
                        $next_page = $max_pages;
                    }
                    if($next_page <= 0)
                    {
                        $next_page = 1;
                    }
                    $next_url = str_replace('ums_page=' . $curent_page, 'ums_page=' . $next_page, $next_url);
                }
                else
                {
                    if(stristr($next_url, '?') === false)
                    {
                        if($max_pages == 1)
                        {
                            $next_url .= '?ums_page=1';
                        }
                        else
                        {
                            $next_url .= '?ums_page=2';
                        }
                    }
                    else
                    {
                        if($max_pages == 1)
                        {
                            $next_url .= '&ums_page=1';
                        }
                        else
                        {
                            $next_url .= '&ums_page=2';
                        }
                    }
                }
            }
            $prev_url = (ums_isSecure() ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            if(stristr($prev_url, 'ums_page=') === false)
            {
                if(stristr($prev_url, '?') === false)
                {
                    $prev_url .= '?ums_page=1';
                }
                else
                {
                    $prev_url .= '&ums_page=1';
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
                    $go_to = $curent_page - 1;
                    if($go_to <= 0)
                    {
                        $go_to = 1;
                    }
                    if($go_to > $max_pages)
                    {
                        $go_to = $max_pages;
                    }
                    $prev_url = str_replace('ums_page=' . $curent_page, 'ums_page=' . $go_to, $prev_url);
                }
                else
                {
                    if(stristr($prev_url, '?') === false)
                    {
                        $prev_url .= '?ums_page=1';
                    }
                    else
                    {
                        $prev_url .= '&ums_page=1';
                    }
                }
            }
            $first_url = (ums_isSecure() ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            if(stristr($first_url, 'ums_page=') === false)
            {
                if(stristr($first_url, '?') === false)
                {
                    $first_url .= '?ums_page=1';
                }
                else
                {
                    $first_url .= '&ums_page=1';
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
                    $first_url = str_replace('ums_page=' . $curent_page, 'ums_page=1', $first_url);
                }
                else
                {
                    if(stristr($first_url, '?') === false)
                    {
                        $first_url .= '?ums_page=1';
                    }
                    else
                    {
                        $first_url .= '&ums_page=1';
                    }
                }
            }
            $last_url = (ums_isSecure() ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
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
            if(isset($_GET['ums_page']) && is_numeric($_GET['ums_page']))
            {
                $this_page = $_GET["ums_page"];
            }
            else
            {
                $this_page = '1';
            }
            echo '<center><a href="' . esc_url_raw($first_url) . '">' . esc_html__('First Page', 'ultimate-manga-scraper') . '</a>&nbsp;&nbsp;&nbsp;<a href="' . esc_url_raw($prev_url) . '">' . esc_html__('Previous Page', 'ultimate-manga-scraper') . '</a>&nbsp;&nbsp;' . esc_html__('Page', 'ultimate-manga-scraper') . ' ' . esc_html($this_page) . ' ' . esc_html__('of', 'ultimate-manga-scraper') . ' ' . esc_html($max_pages) . '&nbsp;-&nbsp;' . esc_html__("Rules Per Page:", 'ultimate-manga-scraper') . '&nbsp;&nbsp;<input class="cr_50" type="number" min="2" step="1" max="999" name="posts_per_page" value="' . esc_attr($rules_per_page). '" required/>&nbsp;&nbsp;&nbsp;<a href="' . esc_url_raw($next_url) . '">' . esc_html__('Next Page', 'ultimate-manga-scraper') . '</a>&nbsp;&nbsp;&nbsp;<a href="' . esc_url_raw($last_url) . '">' . esc_html__('Last Page', 'ultimate-manga-scraper') . '</a></center>
            <center></center>
            <center>Info: You can add new rules only on the last page.</center>';
            ?>
         <div>
            <p class="crsubmit"><input type="submit" name="btnSubmit" id="btnSubmit" class="button button-primary" onclick="unsaved = false;" value="<?php echo esc_html__("Save Settings", 'ultimate-manga-scraper');?>"/></p>
         </div>
         <div>
            <?php echo esc_html__("Confused about rule running status icons?", 'ultimate-manga-scraper');?> <a href="http://coderevolution.ro/knowledge-base/faq/how-to-interpret-the-rule-running-visual-indicators-red-x-yellow-diamond-green-tick-from-inside-plugins/" target="_blank"><?php echo esc_html__("More info", 'ultimate-manga-scraper');?></a><br/>
            <div class="cr_none" id="midas_icons">
               <table>
                  <tr>
                     <td><img id="run_img" src="<?php echo esc_url_raw(plugin_dir_url(dirname(__FILE__)) . 'images/running.gif');?>" alt="Running" title="status"></td>
                     <td><?php echo esc_html__("In Progress", 'ultimate-manga-scraper');?> - <b><?php echo esc_html__("Importing is Running", 'ultimate-manga-scraper');?></b></td>
                  </tr>
                  <tr>
                     <td><img id="ok_img" src="<?php echo esc_url_raw(plugin_dir_url(dirname(__FILE__)) . 'images/ok.gif');?>" alt="OK"  title="status"></td>
                     <td><?php echo esc_html__("Success", 'ultimate-manga-scraper');?> - <b><?php echo esc_html__("New Manga Created", 'ultimate-manga-scraper');?></b></td>
                  </tr>
                  <tr>
                     <td><img id="fail_img" src="<?php echo esc_url_raw(plugin_dir_url(dirname(__FILE__)) . 'images/failed.gif');?>" alt="Faield" title="status"></td>
                     <td><?php echo esc_html__("Failed", 'ultimate-manga-scraper');?> - <b><?php echo esc_html__("An Error Occurred.", 'ultimate-manga-scraper');?> <b><?php echo esc_html__("Please check 'Activity and Logging' plugin menu for details.", 'ultimate-manga-scraper');?></b></td>
                  </tr>
                  <tr>
                     <td><img id="nochange_img" src="<?php echo esc_url_raw(plugin_dir_url(dirname(__FILE__)) . 'images/nochange.gif');?>" alt="NoChange" title="status"></td>
                     <td><?php echo esc_html__("No Change - No New Manga Created", 'ultimate-manga-scraper');?> - <b><?php echo esc_html__("Possible reasons:", 'ultimate-manga-scraper');?></b></td>
                  </tr>
                  <tr>
                     <td></td>
                     <td>
                        <ul>
                           <li>&#9658; <?php echo esc_html__("Already all manga are published that match your search and mangas will be published when new content will be available", 'ultimate-manga-scraper');?></li>
                           <li>&#9658; <?php echo esc_html__("Some restrictions you defined in the plugin's 'Main Settings'", 'ultimate-manga-scraper');?> <i>(<?php echo esc_html__("example: 'Minimum Content Word Count', 'Maximum Content Word Count', 'Minimum Title Word Count', 'Maximum Title Word Count', 'Banned Words List', 'Reuired Words List', 'Skip Manga Without Images'", 'ultimate-manga-scraper');?>)</i> <?php echo esc_html__("prevent posting of new mangas.", 'ultimate-manga-scraper');?></li>
                        </ul>
                     </td>
                  </tr>
               </table>
            </div>
         </div>
   </form>
   </div>
</div>
<?php
   }
   if (isset($_POST['ums_manga_generic_list'])) {
       add_action('admin_init', 'ums_save_rules_generic_manga');
   }
   
   function ums_save_rules_generic_manga($data2)
   {
       $init_rules_per_page = get_option('ums_posts_per_page', 10);
       $rules_per_page = get_option('ums_posts_per_page', 10);
       if(isset($_POST['posts_per_page']))
       {
            update_option('ums_posts_per_page', $_POST['posts_per_page']);
       }
       check_admin_referer('ums_save_rules', '_umsr_nonce');
       
       $data2 = $_POST['ums_manga_generic_list'];
       $rules = get_option('ums_manga_generic_list', array());
       if($rules === false)
       {
           $rules = array();
       }
       $initial_count = count($rules);
       $add = false;
       $scad = false;
       if(isset($_GET["ums_page"]) && is_numeric($_GET["ums_page"]))
       {
           $curent_page = $_GET["ums_page"];
       }
       else
       {
           $curent_page = 1;
       }
       $offset = ($curent_page - 1) * $rules_per_page;
       $cont  = 0;
       if (isset($data2['location'][0])) {
           for ($i = 0; $i < sizeof($data2['location']); ++$i) {
               $bundle = array();
               if (isset($data2['schedule'][$i]) && $data2['schedule'][$i] != '' && trim($data2['location'][$i]) != '') {
                   $bundle[]     = trim($data2['location'][$i]);
                   $bundle[]     = trim(sanitize_text_field($data2['schedule'][$i]));
                   if (isset($data2['active'][$i])) {
                       $bundle[] = trim(sanitize_text_field($data2['active'][$i]));
                   } else {
                       $bundle[] = '0';
                   }
                   $bundle[]     = trim(sanitize_text_field($data2['last_run'][$i]));
                   $bundle[]     = trim(sanitize_text_field($data2['max'][$i]));
                   $bundle[]     = trim(sanitize_text_field($data2['submit_status'][$i]));
                   $bundle[]     = trim(sanitize_text_field($data2['post_author'][$i]));
                   $bundle[]     = trim(sanitize_text_field($data2['default_tags'][$i]));
                   $bundle[]     = trim(sanitize_text_field($data2['default_category'][$i]));
                   $bundle[]     = trim(sanitize_text_field($data2['auto_categories'][$i]));
                   $bundle[]     = trim(sanitize_text_field($data2['auto_tags'][$i]));
                   $bundle[]     = trim(sanitize_text_field($data2['use_phantom'][$i]));
                   $bundle[]     = trim(sanitize_text_field($data2['max_manga'][$i]));
                   $bundle[]     = trim($data2['chapter_warning'][$i]);
                   $bundle[]     = trim(sanitize_text_field($data2['enable_comments'][$i]));
                   $bundle[]     = trim(sanitize_text_field($data2['enable_pingback'][$i]));
                   $bundle[]     = trim(sanitize_text_field($data2['get_date'][$i]));
                   $bundle[]     = trim(sanitize_text_field($data2['rule_translate'][$i]));
                   $bundle[]     = trim(sanitize_text_field($data2['no_translate_title'][$i]));
                   $rules[$offset + $cont] = $bundle;
                   $cont++;
               }
           }
           while($cont < $init_rules_per_page)
           {
               if(isset($rules[$offset + $cont]))
               {
                   $rules[$offset + $cont] = false;
               }
               $cont = $cont + 1;
           }
           $rules = array_values(array_filter($rules));
       }
       update_option('ums_manga_generic_list', $rules, false);
       $final_count = count($rules);
       if($final_count > $initial_count)
       {
           $add = true;
       }
       elseif($final_count < $initial_count)
       {
           $scad = true;
       }
       if(count($rules) % $rules_per_page === 1 && $add === true)
       {
           $rules_count = count($rules);
           $max_pages = ceil($rules_count/$rules_per_page);
           if($max_pages == 0)
           {
               $max_pages = 1;
           }
           $last_url = (ums_isSecure() ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
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
       elseif(count($rules) != 0 && count($rules) % $rules_per_page === 0 && $scad === true)
       {
           $rules_count = count($rules);
           $max_pages = ceil($rules_count/$rules_per_page);
           if($max_pages == 0)
           {
               $max_pages = 1;
           }
           $last_url = (ums_isSecure() ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
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
   }
   function ums_expand_rules_generic_manga($hu)
   {
       $ums_Main_Settings = get_option('ums_Main_Settings', false);
       $categories = get_terms( 'wp-manga-genre', array( 'hide_empty' => false ) );
       if (!get_option('ums_running_list')) {
           $running = array();
       } else {
           $running = get_option('ums_running_list');
       }
       $GLOBALS['wp_object_cache']->delete('ums_manga_generic_list', 'options');
       $rules  = get_option('ums_manga_generic_list');
    if(!is_array($rules))
    {
       $rules = array();
    }
       $output = '';
       $cont   = 0;
       if (!empty($rules)) {
            if(isset($_GET["ums_page"]) && is_numeric($_GET["ums_page"]))
            {
                $curent_page = $_GET["ums_page"];
            }
            else
            {
                $curent_page = 1;
            }
           $posted_items = array();
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
               $rule_id = get_post_meta($post, 'ums_parent_rule', true);
               if ($rule_id != '') {
                   $exp = explode('-', $rule_id);
                   if(isset($exp[0]) && isset($exp[1]) && $exp[0] == '5')
                   {
                       $posted_items[] = $exp[1];
                   }
               }
           }
           $phantom = false;
           wp_suspend_cache_addition(false);
           $counted_vals = array_count_values($posted_items);
           $unlocker = get_option('ums_minute_running_unlocked', false);
           $rules_per_page = get_option('ums_posts_per_page', 10);
           foreach ($rules as $request => $bundle[]) {
                if(($cont < ($curent_page - 1) * $rules_per_page) || ($cont >= $curent_page * $rules_per_page))
                {
                    $cont++;
                    continue;
                }
               if (isset($counted_vals[$cont])) {
                   $generated_posts = $counted_vals[$cont];
               } else {
                   $generated_posts = 0;
               }
               $bundle_values          = array_values($bundle);
               $myValues               = $bundle_values[$cont];
               $array_my_values        = array_values($myValues);for($iji=0;$iji<count($array_my_values);++$iji){if(is_string($array_my_values[$iji])){$array_my_values[$iji]=stripslashes($array_my_values[$iji]);}}
               $manga_name             = $array_my_values[0];
               $schedule               = $array_my_values[1];
               $active                 = $array_my_values[2];
               $last_run               = $array_my_values[3];
               $max                    = $array_my_values[4];
               $status                 = $array_my_values[5];
               $post_user_name         = $array_my_values[6];
               $default_tags           = $array_my_values[7];
               $default_category       = $array_my_values[8];
               $auto_categories        = $array_my_values[9];
               $auto_tags              = $array_my_values[10];
               $use_phantom            = $array_my_values[11];
               $max_manga              = $array_my_values[12];
               $chapter_warning        = $array_my_values[13];
               $enable_comments        = $array_my_values[14];
               $enable_pingback        = $array_my_values[15];
               $get_date               = $array_my_values[16];
               $rule_translate         = $array_my_values[17];
               $no_translate_title     = $array_my_values[18];
               wp_add_inline_script('ums-footer-script', 'createAdmin(' . esc_html($cont) . ');', 'after');
               $output .= '<tr>
                           <td class="cr_comm_td">' . esc_html($cont) . '</td>
                           <td class="cr_short_td"><input type="text" step="1" name="ums_manga_generic_list[location][]" placeholder="https://mangasite.com/manga/..." value="' . esc_attr($manga_name) . '" class="cr_width_full" required/></td>
                           <td class="cr_comm_td"><input type="number" step="1" min="1" placeholder="# h" name="ums_manga_generic_list[schedule][]" max="8765812" value="' . esc_attr($schedule) . '" class="cr_width_60" required></td>
                           <td class="cr_comm_td"><input type="number" step="1" min="0" placeholder="# max" name="ums_manga_generic_list[max][]"';if (stristr($hu, '143.198.112.144') !== false){ $output .= ' max="3"';} $output .= ' value="' . esc_attr($max) . '"  class="cr_width_60" required></td>
                           <td class="cr_status"><select id="submit_status" name="ums_manga_generic_list[submit_status][]" class="cr_width_70">
                                     <option value="pending"';
               if ($status == 'pending') {
                   $output .= ' selected';
               }
               $output .= '>' . esc_html__("Pending -> Moderate", 'ultimate-manga-scraper') . '</option>
                                     <option value="draft"';
               if ($status == 'draft') {
                   $output .= ' selected';
               }
               $output .= '>' . esc_html__("Draft -> Moderate", 'ultimate-manga-scraper') . '</option>
                                     <option value="publish"';
               if ($status == 'publish') {
                   $output .= ' selected';
               }
               $output .= '>' . esc_html__("Published", 'ultimate-manga-scraper') . '</option>
                                     <option value="private"';
               if ($status == 'private') {
                   $output .= ' selected';
               }
               $output .= '>' . esc_html__("Private", 'ultimate-manga-scraper') . '</option>
                                     <option value="trash"';
               if ($status == 'trash') {
                   $output .= ' selected';
               }
               $output .= '>' . esc_html__("Trash", 'ultimate-manga-scraper') . '</option>
                       </select>  </td>
                       <td class="cr_author"><select id="post_author" name="ums_manga_generic_list[post_author][]" class="cr_width_auto cr_max_width_150">';
               $blogusers = get_users( [ 'role__in' => [ 'contributor', 'author', 'editor', 'administrator' ] ] );
               foreach ($blogusers as $user) {
                   $output .= '<option value="' . esc_html($user->ID) . '"';
                   if ($post_user_name == $user->ID) {
                       $output .= " selected";
                   }
                   $output .= '>' . esc_html($user->display_name) . '</option>';
               }
               $output .= '<option value="rand"';
               if ($post_user_name == "rand") {
                       $output .= " selected";
                   }
               $output .= '>' . esc_html__("Random user", 'ultimate-manga-scraper') . '</option>';
               $output .= '<option value="feed-news"';
               if ($post_user_name == "feed-news") {
                       $output .= " selected";
                   }
               $output .= '>' . esc_html__("Import author", 'ultimate-manga-scraper') . '</option>';
               $output .= '</select>  </td>
                       <td class="cr_width_70">
                       <input type="button" id="mybtnfzr' . esc_html($cont) . '" value="Settings">
                       <div id="mymodalfzr' . esc_html($cont) . '" class="codemodalfzr">
     <div class="codemodalfzr-content">
       <div class="codemodalfzr-header">
         <span id="ums_close' . esc_html($cont) . '" class="codeclosefzr">&times;</span>
         <h2>' . esc_html__('Rule', 'ultimate-manga-scraper') . ' <span class="cr_color_white">ID ' . esc_html($cont) . '</span> ' . esc_html__('Advanced Settings', 'ultimate-manga-scraper') . '</h2>
       </div>
       <div class="codemodalfzr-body">
       <div class="table-responsive">
         <table class="responsive table cr_main_table_nowr">
           <tr><td class="cr_min_width_200">
           <div>
           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                                           <div class="bws_hidden_help_text cr_min_260px">' . esc_html__("Set a maximum number of manga to scrape. This value is optional.", 'ultimate-manga-scraper') . '
                           </div>
                       </div>
                       <b>' . esc_html__("Maximum Number Of Manga to Scrape", 'ultimate-manga-scraper') . ':</b>
                       
                       </td><td>
                       <input class="cr_width_full" type="number" min="1" name="ums_manga_generic_list[max_manga][]"';if (stristr($hu, '143.198.112.144') !== false){ $output .= ' max="1"';} $output .= ' value="' . esc_attr($max_manga) . '" placeholder="Maximum number of mangas to scrape" >
           </div>
           </td></tr>
         <tr><td colspan="2"><h3>' . esc_html__("Miscellaneous Options:", 'ultimate-manga-scraper') . '</h3></td></tr><tr><td class="cr_min_width_200">
           <div>
           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                                           <div class="bws_hidden_help_text cr_min_260px">' . esc_html__("Select the manga genre that you want for the automatically generated manga to have.", 'ultimate-manga-scraper') . '
                           </div>
                       </div>
                       <b>' . esc_html__("Additional Manga Genre", 'ultimate-manga-scraper') . ':</b>
                       
                       </td><td>
                       <select class="cr_width_full" id="default_category" name="ums_manga_generic_list[default_category][]">
                       <option value="ums_no_category_12345678">' . esc_html__("Do Not Add a Genre", 'ultimate-manga-scraper') . '</option>';
               foreach ($categories as $category) {
                   $output .= '<option value="' . esc_attr($category->term_id) . '"';
                   if ($category->term_id == $default_category) {
                       $output .= ' selected';
                   }
                   $output .= '>' . sanitize_text_field($category->name) . '</option>';
               }
               $output .= '</select>     
           </div>
           </td></tr><tr><td>
           <div>
           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                                           <div class="bws_hidden_help_text cr_min_260px">' . esc_html__("Do you want to automatically add manga genres from the feed items?", 'ultimate-manga-scraper') . '
                           </div>
                       </div>
                       <b>' . esc_html__("Auto Add Genres", 'ultimate-manga-scraper') . ':</b>
                       
                       </td><td>
                       <select class="cr_width_full" id="auto_categories" name="ums_manga_generic_list[auto_categories][]">
                       <option value="disabled"';
               if ($auto_categories == 'disabled') {
                   $output .= ' selected';
               }
               $output .= '>' . esc_html__("Disabled", 'ultimate-manga-scraper') . '</option>
                       <option value="genre"';
               if ($auto_categories == 'genre') {
                   $output .= ' selected';
               }
               $output .= '>' . esc_html__("Manga Genres", 'ultimate-manga-scraper') . '</option>
                       </select>                
           </div>
           </td></tr><tr><td>
           <div>
           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                                           <div class="bws_hidden_help_text cr_min_260px">' . esc_html__("Do you want to automatically add manga tags from the feed items?", 'ultimate-manga-scraper') . '
                           </div>
                       </div>
                       <b>' . esc_html__("Auto Add Manga Tags", 'ultimate-manga-scraper') . ':</b>
                       
                       </td><td>
                       <select class="cr_width_full" id="auto_tags" name="ums_manga_generic_list[auto_tags][]">
                       <option value="disabled"';
               if ($auto_tags == 'disabled') {
                   $output .= ' selected';
               }
               $output .= '>' . esc_html__("Disabled", 'ultimate-manga-scraper') . '</option>
                       <option value="genre"';
               if ($auto_tags == 'genre') {
                   $output .= ' selected';
               }
               $output .= '>' . esc_html__("Manga Genres", 'ultimate-manga-scraper') . '</option>
                       </select>     
           </div>
           </td></tr><tr><td>
           <div>
           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                                           <div class="bws_hidden_help_text cr_min_260px">' . esc_html__("Select the manga tags that you want for the automatically generated manga to have.", 'ultimate-manga-scraper') . '
                           </div>
                       </div>
                       <b>' . esc_html__("Additional Manga Tags", 'ultimate-manga-scraper') . ':</b>
                       
                       </td><td>
                       <input class="cr_width_full" type="text" name="ums_manga_generic_list[default_tags][]" value="' . esc_attr($default_tags) . '" placeholder="Please insert your additional manga tags here" >
                           
           </div>
           </td></tr><tr><td>
           <div>
           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                                           <div class="bws_hidden_help_text cr_min_260px">' . esc_html__("Do you want to try to use PhantomJS to try to parse JavaScript from crawled pages (for pages that create dynamic content, on page load, using JavaScript)? Please note that for this to work, you must have PhantomJs installed on your server. You can configure the path to PhantomJS from your server, from plugin\'s \'Main Settings\'.", 'ultimate-manga-scraper') . '
                           </div>
                       </div>
                       <b>' . esc_html__("Content Scraping Method To Use", 'ultimate-manga-scraper') . ':</b><div class="cr_float_right bws_help_box bws_help_box_right dashicons cr_align_middle"><img class="cr_align_middle" src="' . plugins_url('../images/new.png', __FILE__) . '" alt="new feature"/>
                                                      <div class="bws_hidden_help_text cr_min_260px">' . esc_html__("New feature added to this plugin: it is able to use HeadlessBrowserAPI to scrape with JavaScript rendered content any website from the internet. Also, the Tor node of the API will be able to scrape .onion sites from the Dark Net!", 'ultimate-manga-scraper') . '</div></div>';
                       if($use_phantom == '1')
                       {
                           if($phantom === false)
                           {
                               $phantom = ums_testPhantom();
                           }
                           if($phantom === 0)
                           {
                               $output .= '<br/><span class="cr_red12"><b>' . esc_html__('INFO: PhantomJS not found - please install it on your server or configure the path to it in plugin\'s \'Main Settings\'!', 'ultimate-manga-scraper') . '</b> <a href=\'//coderevolution.ro/knowledge-base/faq/how-to-install-phantomjs/\' target=\'_blank\'>' . esc_html__('How to install PhantomJs?', 'ultimate-manga-scraper') . '</a></span>';
                           }
                           elseif($phantom === -1)
                           {
                               $output .= '<br/><span class="cr_red12"><b>' . esc_html__('INFO: PhantomJS cannot run - shell exec is not enabled on your server. Please enable it and retry using this feature of the plugin.', 'ultimate-manga-scraper') . '</b></span>';
                           }
                           elseif($phantom === -2)
                           {
                               $output .= '<br/><span class="cr_red12"><b>' . esc_html__('INFO: PhantomJS cannot run - shell exec is not allowed to run on your server (in disable_functions list in php.ini). Please enable it and retry using this feature of the plugin.', 'ultimate-manga-scraper') . '</b></span>';
                           }
                           elseif($phantom === 1)
                           {
                               $output .= '<br/><span class="cr_green12"><b>' . esc_html__('INFO: PhantomJS OK', 'ultimate-manga-scraper') . '</b></span>';
                           }
                       }
                       $output .= '</div>
                       </td><td>
                       <div>
                       <select id="use_phantom" name="ums_manga_generic_list[use_phantom][]" class="cr_width_full">
                        <option value="0"';
           if ($use_phantom == '0' || $use_phantom == '') {
               $output .= ' selected';
           }
           $output .= '>' . esc_html__("WordPress", 'ultimate-manga-scraper') . '</option>
                        <option value="1"';
           if ($use_phantom == '1') {
               $output .= ' selected';
           }
           $output .= '>' . esc_html__("Use PhantomJS", 'ultimate-manga-scraper') . '</option>          
                        <option value="2"';
           if ($use_phantom == '2') {
               $output .= ' selected';
           }
           $output .= '>' . esc_html__("Use Puppeteer (Default)", 'ultimate-manga-scraper') . '</option>
                          <option value="4"';
           if ($use_phantom == '4') {
               $output .= ' selected';
           }
           if (!isset($ums_Main_Settings['headlessbrowserapi_key']) || trim($ums_Main_Settings['headlessbrowserapi_key']) == '')
           {
               $output .= ' title="' . esc_html__("This option is disabled. To enable it, add a HeadlessBrowserAPI Key in the plugin's 'Main Settings' menu.", 'ultimate-manga-scraper') . '" disabled';
           }
           $output .= '>' . esc_html__("Puppeteer (HeadlessBrowserAPI)", 'ultimate-manga-scraper') . '</option>
                        <option value="5"';
           if ($use_phantom == '5') {
               $output .= ' selected';
           }
           if (!isset($ums_Main_Settings['headlessbrowserapi_key']) || trim($ums_Main_Settings['headlessbrowserapi_key']) == '')
           {
               $output .= ' title="' . esc_html__("This option is disabled. To enable it, add a HeadlessBrowserAPI Key in the plugin's 'Main Settings' menu.", 'ultimate-manga-scraper') . '" disabled';
           }
           $output .= '>' . esc_html__("Tor (HeadlessBrowserAPI)", 'ultimate-manga-scraper') . '</option>
                        <option value="6"';
           if ($use_phantom == '6') {
               $output .= ' selected';
           }
           if (!isset($ums_Main_Settings['headlessbrowserapi_key']) || trim($ums_Main_Settings['headlessbrowserapi_key']) == '')
           {
               $output .= ' title="' . esc_html__("This option is disabled. To enable it, add a HeadlessBrowserAPI Key in the plugin's 'Main Settings' menu.", 'ultimate-manga-scraper') . '" disabled';
           }
           $output .= '>' . esc_html__("PhantomJS (HeadlessBrowserAPI)", 'ultimate-manga-scraper') . '</option>
                       </select>            
           </div>
           </td></tr><tr><td>
           <div>
           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                                           <div class="bws_hidden_help_text cr_min_260px">' . esc_html__("Do you want to enable comments for the generated manga?", 'ultimate-manga-scraper') . '
                           </div>
                       </div>
                       <b>' . esc_html__("Enable Comments For Manga", 'ultimate-manga-scraper') . ':</b>
                       
                       </td><td>
                       <input type="checkbox" id="enable_comments" name="ums_manga_generic_list[enable_comments][]"';
               if ($enable_comments == '1') {
                   $output .= ' checked';
               }
               $output .= '>
                           
           </div>
           </td></tr><tr><td>
           <div>
           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                                           <div class="bws_hidden_help_text cr_min_260px">' . esc_html__("Do you want to enable pingbacks and trackbacks for the generated manga?", 'ultimate-manga-scraper') . '
                           </div>
                       </div>
                       <b>' . esc_html__("Enable Pingback/Trackback", 'ultimate-manga-scraper') . ':</b>
                       
                       </td><td>
                       <input type="checkbox" id="enable_pingback" name="ums_manga_generic_list[enable_pingback][]"';
               if ($enable_pingback == '1') {
                   $output .= ' checked';
               }
               $output .= '>
                           
           </div>
           </td></tr><tr><td>
           <div>
           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                                           <div class="bws_hidden_help_text cr_min_260px">' . esc_html__("Do you want to get the publish date from the source mangas?", 'ultimate-manga-scraper') . '
                           </div>
                       </div>
                       <b>' . esc_html__("Get Publish Date From Manga", 'ultimate-manga-scraper') . ':</b>
                       
                       </td><td>
                       <input type="checkbox" id="get_date" name="ums_manga_generic_list[get_date][]"';
               if ($get_date == '1') {
                   $output .= ' checked';
               }
               $output .= '>
                           
           </div>
           </td></tr><tr><td>
           <div>
           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                                           <div class="bws_hidden_help_text cr_min_260px">' . esc_html__("Set a global chapter warning message to display on the scraped manga.", 'ultimate-manga-scraper') . '
                           </div>
                       </div>
                       <b>' . esc_html__("Global Chapter Warning Message", 'ultimate-manga-scraper') . ':</b>
                       
                       </td><td>
                       <input class="cr_width_full" type="text" name="ums_manga_generic_list[chapter_warning][]" value="' . esc_attr($chapter_warning) . '" placeholder="Global Chapter Warning Message" >
                           
           </div>
           
           </td></tr><tr><td>
           <h3>' . esc_html__("Translation Options:", 'ultimate-manga-scraper') . '</h3></td></tr><tr><td>
               <div>
               <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                                               <div class="bws_hidden_help_text cr_min_260px">' . esc_html__("Do you want to automatically translate generated content using Google Translate? If set, this will overwrite the \'Automatically Translate Content To\' option from plugin\'s \'Main Settings\'.", 'ultimate-manga-scraper') . '
                               </div>
                           </div>
                           <b>' . esc_html__("Automatically Translate Content To", 'ultimate-manga-scraper') . ':</b><br/><b>' . esc_html__("Info:", 'ultimate-manga-scraper') . '</b> ' . esc_html__("for translation, the plugin also supports WPML.", 'ultimate-manga-scraper') . ' <b><a href="https://wpml.org/?aid=238195&affiliate_key=ix3LsFyq0xKz" target="_blank">' . esc_html__("Get WPML now!", 'ultimate-manga-scraper') . '</a></b>
                           
                           </td><td>
                           <select class="cr_width_full" id="translate" name="ums_manga_generic_list[rule_translate][]" >';
           $i = 0;
           foreach ($GLOBALS['language_names'] as $lang) {
               $output .= '<option value="' . esc_attr($GLOBALS['language_codes'][$i]) . '"';
               if ($rule_translate == $GLOBALS['language_codes'][$i]) {
                   $output .= ' selected';
               }
               $output .= '>' . esc_html($GLOBALS['language_names'][$i]) . '</option>';
               $i++;
           }
           if(isset($ums_Main_Settings['deepl_auth']) && $ums_Main_Settings['deepl_auth'] != '')
           {
               $i = 0;
               foreach ($GLOBALS['language_names_deepl'] as $lang) {
                   $output .= '<option value="' . esc_attr($GLOBALS['language_codes_deepl'][$i]) . '"';
                   if ($rule_translate == $GLOBALS['language_codes_deepl'][$i]) {
                       $output .= ' selected';
                   }
                   $output .= '>' . esc_html($GLOBALS['language_names_deepl'][$i]) . '</option>';
                   $i++;
               }
           }
           if(isset($ums_Main_Settings['bing_auth']) && $ums_Main_Settings['bing_auth'] != '')
           {
               $i = 0;
               foreach ($GLOBALS['language_names_bing'] as $lang) {
                   $output .= '<option value="' . esc_attr($GLOBALS['language_codes_bing'][$i]) . '"';
                   if ($rule_translate == $GLOBALS['language_codes_bing'][$i]) {
                       $output .= ' selected';
                   }
                   $output .= '>' . esc_html($GLOBALS['language_names_bing'][$i]) . '</option>';
                   $i++;
               }
           }
                   $output .= '</select>               
               </div>
           </td></tr>
           </td></tr><tr><td>
           <div>
           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                                           <div class="bws_hidden_help_text cr_min_260px">' . esc_html__("Do you want to not translate manga titles?", 'ultimate-manga-scraper') . '
                           </div>
                       </div>
                       <b>' . esc_html__("Do Not Translate Title", 'ultimate-manga-scraper') . ':</b>
                       
                       </td><td>
                       <input type="checkbox" id="no_translate_title" name="ums_manga_generic_list[no_translate_title][]"';
               if ($no_translate_title == '1') {
                   $output .= ' checked';
               }
               $output .= '>
                           
           </div></table></div> 
       </div>
       <div class="codemodalfzr-footer">
         <br/>
         <h3 class="cr_inline">Madara Scraper</h3><span id="ums_ok' . esc_html($cont) . '" class="codeokfzr cr_inline">OK&nbsp;</span>
         <br/><br/>
       </div>
     </div>
   
   </div>       
                       </td>
   						<td class="cr_comm_td"><span class="wpums-delete">X</span></td>
                           <td class="cr_comm_td"><input type="checkbox" name="ums_manga_generic_list[active][]" class="activateDeactivateClass" value="1"';
               if (isset($active) && $active === '1') {
                   $output .= ' checked';
               }
               $output .= '/>
                           <input type="hidden" name="ums_manga_generic_list[last_run][]" value="' . esc_attr($last_run) . '"/></td>
                           <td class="cr_comm_td"><div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                           <div class="bws_hidden_help_text cr_min_260px">' . esc_html__('Manga Generated:', 'ultimate-manga-scraper') . ' ' . esc_html($generated_posts) . '<br/>';
               if ($generated_posts != 0) {
                   $output .= '<a href="' . get_admin_url() . 'edit.php?coderevolution_post_source=ums_5_' . esc_html($cont) . '&post_type=wp-manga" target="_blank">' . esc_html__('View Generated Manga', 'ultimate-manga-scraper') . '</a><br/>';
               }
               $output .= esc_html__('Last Run: ', 'ultimate-manga-scraper');
               if ($last_run == '1988-01-27 00:00:00') {
                   $output .= 'Never';
               } else {
                   $output .= $last_run;
               }
               $output .= '<br/>' . esc_html__('Next Run: ', 'ultimate-manga-scraper');
               if($unlocker == '1')
               {
                   $nextrun = ums_add_minute($last_run, $schedule);
               }
               else
               {
                   $nextrun = ums_add_hour($last_run, $schedule);
               }
               $now     = ums_get_date_now();
               if ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ) {
                   $output .= esc_html__('WP-CRON Disabled. Rules will not automatically run!', 'ultimate-manga-scraper');
               }
               else
               {
                   if (isset($active) && $active === '1') {
                       if($unlocker == '1')
                       {
                           $ums_hour_diff = (int)ums_minute_diff($now, $nextrun);
                       }
                       else
                       {
                           $ums_hour_diff = (int)ums_hour_diff($now, $nextrun);
                       }
                       if ($ums_hour_diff >= 0) {
                           $append = 'Now.';
                           $cron   = _get_cron_array();
                           if ($cron != FALSE) {
                               $date_format = _x('Y-m-d H:i:s', 'Date Time Format1', 'ultimate-manga-scraper');
                               foreach ($cron as $timestamp => $cronhooks) {
                                   foreach ((array) $cronhooks as $hook => $events) {
                                       if ($hook == 'umsaction') {
                                           foreach ((array) $events as $key => $event) {
                                               $append = date_i18n($date_format, $timestamp);
                                           }
                                       }
                                   }
                               }
                           }
                           $output .= $append;
                       } else {
                           $output .= $nextrun;
                       }
                   } else {
                       $output .= esc_html__('Rule Disabled', 'ultimate-manga-scraper');
                   }
               }
               $output .= '<br/>' . esc_html__('Local Time: ', 'ultimate-manga-scraper') . $now;
               $output .= '</div>
                       </div></td>
                           <td class="cr_center">
                           <div>
                           <img id="run_img' . esc_html($cont) . '" src="' . plugin_dir_url(dirname(__FILE__)) . 'images/running.gif' . '" alt="Running" class="cr_status_icon';
               if (!empty($running)) {
                   if (!in_array(array($cont => 5), $running)) {
                       $output .= ' cr_hidden';
                   }
                   else
                   {
                       $f = fopen(get_temp_dir() . 'ums_5_' . $cont, 'w');
                       if($f !== false)
                       {
                           if (!flock($f, LOCK_EX | LOCK_NB)) {
                           }
                           else
                           {
                               $output .= ' cr_hidden';
                               flock($f, LOCK_UN);
                               if (($xxkey = array_search(array($cont => 5), $running)) !== false) {
                                   unset($running[$xxkey]);
                                   update_option('ums_running_list', $running);
                               }
                           }
                       }
                   }
               } else {
                   $output .= ' cr_hidden';
               }
               $output .= '" title="status">
                           <div class="codemainfzr">
                           <select id="actions" class="actions" name="actions" onchange="actionsChangedManual(' . esc_html($cont) . ', this.value, 5);" onfocus="this.selectedIndex = 0;">
                               <option value="select" disabled selected>' . esc_html__("Select an Action", 'ultimate-manga-scraper') . '</option>
                               <option value="run">' . esc_html__("Run This Rule Now", 'ultimate-manga-scraper') . '</option>
                               <option value="trash">' . esc_html__("Move All Manga To Trash", 'ultimate-manga-scraper') . '</option>
                               <option value="delete">' . esc_html__("Permanently Delete All Manga", 'ultimate-manga-scraper') . '</option>
                           </select>
                           </div>
                           </div>
                           </td>
   					</tr>	
   					';
               $cont = $cont + 1;
           }
       }
       return $output;
   }
   ?>