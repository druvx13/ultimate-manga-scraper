<?php
/*
 * Copyright (C) 2026 NIKOL
 * Licensed under LUCA Free License v1.0
 * DO WHAT THE FUCK YOU WANT TO.
 */
   function ums_logs()
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
       global $wp_filesystem;
       if ( ! is_a( $wp_filesystem, 'WP_Filesystem_Base') ){
           include_once(ABSPATH . 'wp-admin/includes/file.php');$creds = request_filesystem_credentials( site_url() );
           wp_filesystem($creds);
       }
       if(isset($_POST['ums_delete']))
       {
           if($wp_filesystem->exists(WP_CONTENT_DIR . '/ums_info.log'))
           {
               $wp_filesystem->delete(WP_CONTENT_DIR . '/ums_info.log');
           }
       }
       if(isset($_POST['ums_delete_rules']))
       {
           $running = array();
           update_option('ums_running_list', $running);
           $flock_disabled = explode(',', ini_get('disable_functions'));
           if(!in_array('flock', $flock_disabled))
           {
               foreach (glob(get_temp_dir() . 'ums_*') as $filename) 
               {
                  $f = fopen($filename, 'w');
                  if($f !== false)
                  {
                     flock($f, LOCK_UN);
                     fclose($f);
                  }
                  $wp_filesystem->delete($filename);
               }
           }
       }
       if(isset($_POST['ums_restore_defaults']))
       {
           ums_activation_callback(true);
       }
       if(isset($_POST['ums_delete_all']))
       {
           ums_delete_all_posts();
       }
   ?>
<div class="wp-header-end"></div>
<div class="wrap gs_popuptype_holder seo_pops">
<div>
   <div>
      <h3>
         <?php echo esc_html__("System Info:", 'ultimate-manga-scraper');?> 
         <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
            <div class="bws_hidden_help_text cr_min_260px">
               <?php
                  echo esc_html__("Some general system information.", 'ultimate-manga-scraper');
                  ?>
            </div>
         </div>
      </h3>
      <hr/>
      <table class="cr_server_stat">
         <tr class="cdr-dw-tr">
            <td class="cdr-dw-td"><?php echo esc_html__("User Agent:", 'ultimate-manga-scraper');?></td>
            <td class="cdr-dw-td-value"><?php echo esc_html($_SERVER['HTTP_USER_AGENT']); ?></td>
         </tr>
         <tr class="cdr-dw-tr">
            <td class="cdr-dw-td"><?php echo esc_html__("Web Server:", 'ultimate-manga-scraper');?></td>
            <td class="cdr-dw-td-value"><?php echo esc_html($_SERVER['SERVER_SOFTWARE']); ?></td>
         </tr>
         <tr class="cdr-dw-tr">
            <td class="cdr-dw-td"><?php echo esc_html__("PHP Version:", 'ultimate-manga-scraper');?></td>
            <td class="cdr-dw-td-value"><?php echo esc_html(phpversion()); ?></td>
         </tr>
         <tr class="cdr-dw-tr">
            <td class="cdr-dw-td"><?php echo esc_html__("PHP Max POST Size:", 'ultimate-manga-scraper');?></td>
            <td class="cdr-dw-td-value"><?php echo esc_html(ini_get('post_max_size')); ?></td>
         </tr>
         <tr class="cdr-dw-tr">
            <td class="cdr-dw-td"><?php echo esc_html__("PHP Max Upload Size:", 'ultimate-manga-scraper');?></td>
            <td class="cdr-dw-td-value"><?php echo esc_html(ini_get('upload_max_filesize')); ?></td>
         </tr>
         <tr class="cdr-dw-tr">
            <td class="cdr-dw-td"><?php echo esc_html__("PHP Memory Limit:", 'ultimate-manga-scraper');?></td>
            <td class="cdr-dw-td-value"><?php echo esc_html(ini_get('memory_limit')); ?></td>
         </tr>
         <tr class="cdr-dw-tr">
            <td class="cdr-dw-td"><?php echo esc_html__("PHP DateTime Class:", 'ultimate-manga-scraper');?></td>
            <td class="cdr-dw-td-value"><?php echo (class_exists('DateTime') && class_exists('DateTimeZone')) ? '<span class="cdr-green">' . esc_html__('Available', 'ultimate-manga-scraper') . '</span>' : '<span class="cdr-red">' . esc_html__('Not available', 'ultimate-manga-scraper') . '</span> | <a href="http://php.net/manual/en/datetime.installation.php" target="_blank">more info&raquo;</a>'; ?> </td>
         </tr>
         <tr class="cdr-dw-tr">
            <td class="cdr-dw-td"><?php echo esc_html__("PHP Curl:", 'ultimate-manga-scraper');?></td>
            <td class="cdr-dw-td-value"><?php echo (function_exists('curl_version')) ? '<span class="cdr-green">' . esc_html__('Available', 'ultimate-manga-scraper') . '</span>' : '<span class="cdr-red">' . esc_html__('Not available', 'ultimate-manga-scraper') . '</span>'; ?> </td>
         </tr>
         <?php do_action('coderevolution_dashboard_widget_server') ?>
      </table>
   </div>
   <div>
      <br/>
      <hr class="cr_special_hr"/>
      <div>
         <h3>
            <?php echo esc_html__("Rules Currently Running:", 'ultimate-manga-scraper');?>
            <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
               <div class="bws_hidden_help_text cr_min_260px">
                  <?php
                     echo esc_html__("These rules are currently running on your server.", 'ultimate-manga-scraper');
                     ?>
               </div>
            </div>
         </h3>
         <div>
            <?php
               if (!get_option('ums_running_list')) {
                   $running = array();
               } else {
                   $running = get_option('ums_running_list');
               }
               if (!empty($running)) {
                   echo '<ul>';
                   foreach($running as $key => $thread)
                   {
                       foreach($thread as $param => $type)
                       {
                           $ech = '';
                           if ($type == '0') {
                               $ech .= 'FanFox Scraping Rules';
                           } elseif ($type == '1') {
                               $ech .= 'WuxiaWorld Scraping Rules';
                           } elseif ($type == '2') {
                               $ech .= 'NovGo Scraping Rules';
                           } elseif ($type == '3') {
                               $ech .= 'NewNovel Scraping Rules';
                           }
                           else{
                               $ech .= esc_html__('Unknown rule type: ', 'ultimate-manga-scraper') . $type;
                           }
                           echo '<li><b>' . esc_html($ech) . '</b> - ID' . esc_html($param) . '</li>';
                       }
                   }
                   echo '</ul>';        
               }
               else
               {
                   echo esc_html__('No rules are running right now', 'ultimate-manga-scraper');
               }
               ?>
         </div>
         <hr/>
         <form method="post" onsubmit="return confirm('<?php echo esc_html__('Are you sure you want to clear the running list?', 'ultimate-manga-scraper');?>');">
            <input name="ums_delete_rules" type="submit" title="<?php echo esc_html__('Caution! This is for debugging purpose only!', 'ultimate-manga-scraper');?>" value="<?php echo esc_html__('Clear Running Rules List', 'ultimate-manga-scraper');?>">
         </form>
      </div>
      <div>
         <br/>
         <hr class="cr_special_hr"/>
         <div>
            <h3>
               <?php echo esc_html__('Restore Plugin Default Settings', 'ultimate-manga-scraper');?> 
               <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                  <div class="bws_hidden_help_text cr_min_260px">
                     <?php
                        echo esc_html__('Hit this button and the plugin settings will be restored to their default values. Warning! All settings will be lost!', 'ultimate-manga-scraper');
                        ?>
                  </div>
               </div>
            </h3>
            <hr/>
            <form method="post" onsubmit="return confirm('<?php echo esc_html__('Are you sure you want to restore the default plugin settings?', 'ultimate-manga-scraper');?>');"><input name="ums_restore_defaults" type="submit" value="<?php echo esc_html__('Restore Plugin Default Settings', 'ultimate-manga-scraper');?>"></form>
         </div>
         <br/>
         <hr class="cr_special_hr"/>
         <div>
            <h3>
               <?php echo esc_html__('Delete All Posts Generated by this Plugin:', 'ultimate-manga-scraper');?> 
               <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                  <div class="bws_hidden_help_text cr_min_260px">
                     <?php
                        echo esc_html__('Hit this button and all posts generated by this plugin will be deleted!', 'ultimate-manga-scraper');
                        ?>
                  </div>
               </div>
            </h3>
            <hr/>
            <form method="post" onsubmit="return confirm('<?php echo esc_html__('Are you sure you want to delete all generated posts? This can take a while, please wait until it finishes.', 'ultimate-manga-scraper');?>');"><input name="ums_delete_all" type="submit" value="<?php echo esc_html__('Delete All Generated Posts', 'ultimate-manga-scraper');?>"></form>
         </div>
         <br/>
         <hr class="cr_special_hr"/>
         <h3>
            <?php echo esc_html__('Activity Log:', 'ultimate-manga-scraper');?>
            <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
               <div class="bws_hidden_help_text cr_min_260px">
                  <?php
                     echo esc_html__('This is the main log of your plugin. Here will be listed every single instance of the rules you run or are automatically run by schedule jobs (if you enable logging, in the plugin configuration).', 'ultimate-manga-scraper');
                     ?>
               </div>
            </div>
         </h3>
         <div>
            <?php
               if($wp_filesystem->exists(WP_CONTENT_DIR . '/ums_info.log'))
               {
                    $log = $wp_filesystem->get_contents(WP_CONTENT_DIR . '/ums_info.log');
                   $log = esc_html($log);$log = str_replace('&lt;br/&gt;', '<br/>', $log);echo $log;
               }
               else
               {
                   echo esc_html__('Log empty', 'ultimate-manga-scraper');
               }
               ?>
         </div>
      </div>
      <hr/>
      <form method="post" onsubmit="return confirm('<?php echo esc_html__('Are you sure you want to delete all logs?', 'ultimate-manga-scraper');?>');">
         <input name="ums_delete" type="submit" value="<?php echo esc_html__('Delete Logs', 'ultimate-manga-scraper');?>">
      </form>
   </div>
</div>
<?php
   }
   ?>