<?php
/*
 * Copyright (C) 2026 NIKOL
 * Licensed under LUCA Free License v1.0
 * DO WHAT THE FUCK YOU WANT TO.
 */
if ( !class_exists( 'CodeRevoDashboard' ) ) {
	class CodeRevoDashboard {
		var $feed = 'https://wpinitiate.com/custom-feeds/items.xml';
		var $num_items = 5;
		var $quick = 0;
		function __construct( ) {
			add_action('wp_dashboard_setup', array( $this, 'add_dashboard_widget' ) );
			add_action('wp_user_dashboard_setup', array( $this, 'add_dashboard_widget' ) );
			add_action('wp_newtwork_dashboard_setup', array( $this, 'add_dashboard_widget' ) );
		}

		function add_dashboard_widget() {
			add_meta_box( 'coderevodashboard-widget', esc_html__( 'Recommended Plugins For You', 'playomatic-google-play-post-generator' ), array( $this, 'show_dashboard_widget' ), 'dashboard', 'side', 'high');
            $reg_css_code = '.cr_float_right{float:right}.cr_al_right{text-align:right}.cr_mixedx{float:left;width:18%;margin-right:4%;display:block;padding-top:4px}.cr_widthf{width:100%;height:auto}.cr_float_left{float:left;}.cr_width_78{width:78%}.cr_clear{clear:both}';
            wp_register_style( 'coderevo-plugin-dash-style', false );
            wp_enqueue_style( 'coderevo-plugin-dash-style' );
            wp_add_inline_style( 'coderevo-plugin-dash-style', $reg_css_code );
		}

		function show_dashboard_widget() {
			$str = '';
			if( $this->quick )
            {
				add_filter( 'wp_feed_cache_transient_lifetime', array( $this, 'update_feed_quickly' ) );
            }
            else
            {
                add_filter( 'wp_feed_cache_transient_lifetime', array( $this, 'default_update_feed_quickly' ) );
            }
			$rss = fetch_feed( $this->feed );
			if( $this->quick )
            {
				remove_filter( 'wp_feed_cache_transient_lifetime', array( $this, 'update_feed_quickly' ) );
            }
            else
            {
                remove_filter( 'wp_feed_cache_transient_lifetime', array( $this, 'default_update_feed_quickly' ) );
            }
		    if ( is_wp_error($rss) ) {
				if ( is_admin() || current_user_can('manage_options') ) {
				   echo '<p>';
				   printf('<strong>' . esc_html__( 'Error getting content: ', 'playomatic-google-play-post-generator' ) . '</strong>: %s', $rss->get_error_message());
				   echo '</p>';
				}
		    	return;
			}

			if ( !$rss->get_item_quantity() ) {
			     echo '<p>' . esc_html__( 'Apparently, there are no updates to show!', 'playomatic-google-play-post-generator' ) . '</p>';
			     $rss->__destruct();
			     unset($rss);
			     return;
			}
			$str .= '<ul>';

			if ( !isset($items) )
			     foreach ( $rss->get_items(0, $this->num_items) as $item ) {
			          $date = '';
			          $link = esc_url_raw( strip_tags( $item->get_link() ) );
			          $title = esc_html( $item->get_title() );
			          $cat = $item->get_item_tags('', 'thumbnail');
			          if(isset($cat[0]['data'])){$thumbnail_img = $cat[0]['data'];}else{$thumbnail_img = '';}
			          $content = $item->get_content();
			          $content = wp_html_excerpt($content, 300, '[...]');
			          $content .= "<p class='cr_al_right'><a href='" . esc_attr($link) . "'  target='_blank'>" . esc_html__( 'Learn more', 'playomatic-google-play-post-generator' ) . "</a></p>";

                        $str .= "<li>";
                        if($thumbnail_img != '')
                        {
                           $str .= "<div class='cr_mixedx'><a href='" . esc_attr($link) . "' target='_blank'><img src='".esc_attr($thumbnail_img)."' class='cr_widthf' /></a></div>";
                        }
			         	$str .= "<div class='cr_float_left";
                        if($thumbnail_img != '')
                        {
                            $str .= " cr_width_78";
                        }
                        $str .= "'><a class='rsswidget' href='" . esc_attr($link) . "' target='_blank'>$title</a>\n<div class='rssSummary'>$content</div></div>
			         	<div class='clear'></div>
			         	</li>\n<li><hr/></li>";
			}

			$str .= '</ul><div class="cr_clear"></div><a href="https://coderevolution.ro/knowledge-base" class="button button-secondary" target="_blank">' . esc_html__( 'FAQ', 'playomatic-google-play-post-generator' ) . '</a>&nbsp;<a href="https://coderevolution.ro/support" class="button button-secondary" target="_blank">' . esc_html__( 'Support', 'playomatic-google-play-post-generator' ) . '</a>&nbsp;<a href="https://1.envato.market/coderevolutionplugins" class="button button-primary" target="_blank">+ ' . esc_html__( 'View More', 'playomatic-google-play-post-generator' ) . '</a><a class="cr_float_right" href="#" id="wp_coderevodashboard_hide">' . esc_html__( 'Don\'t show this widget', 'playomatic-google-play-post-generator' ) . '</a><div class="cr_clear"></div>';
            wp_enqueue_script('coderevo-other-script', plugins_url('script.js', __FILE__), array('jquery'));
            echo $str;
			$rss->__destruct();
			unset($rss);
		}
		function update_feed_quickly( $seconds ) {
		    return 5;
		}
        function default_update_feed_quickly( $seconds ) {
		    return 2592000;
		}
	}
	new CodeRevoDashboard( );
}

if ( !class_exists( 'CodeRevoNewsDashboard' ) ) {
	class CodeRevoNewsDashboard {
		var $feed = 'https://coderevolution.ro/feed/';
		var $num_items = 5;
		var $quick = 0;
		function __construct( ) {
			add_action('wp_dashboard_setup', array( $this, 'add_dashboard_widget' ) );
			add_action('wp_user_dashboard_setup', array( $this, 'add_dashboard_widget' ) );
			add_action('wp_newtwork_dashboard_setup', array( $this, 'add_dashboard_widget' ) );
		}

		function add_dashboard_widget() {
			add_meta_box( 'coderevonewsdashboard-widget', esc_html__( 'Latest News', 'playomatic-google-play-post-generator' ), array( $this, 'show_dashboard_widget' ), 'dashboard', 'side', 'high');
            $reg_css_code = '.cr_float_right{float:right}.cr_al_right{text-align:right}.cr_mixedx{float:left;width:18%;margin-right:4%;display:block;padding-top:4px}.cr_widthf{width:100%;height:auto}.cr_float_left{float:left;}.cr_width_78{width:78%}.cr_clear{clear:both}';
            wp_register_style( 'coderevo-plugin-dash-style', false );
            wp_enqueue_style( 'coderevo-plugin-dash-style' );
            wp_add_inline_style( 'coderevo-plugin-dash-style', $reg_css_code );
		}

		function show_dashboard_widget() {
			$str = '';
			if( $this->quick )
            {
				add_filter( 'wp_feed_cache_transient_lifetime', array( $this, 'update_feed_quickly' ) );
            }
            else
            {
                add_filter( 'wp_feed_cache_transient_lifetime', array( $this, 'default_update_feed_quickly' ) );
            }
			$rss = fetch_feed( $this->feed );
			if( $this->quick )
            {
				remove_filter( 'wp_feed_cache_transient_lifetime', array( $this, 'update_feed_quickly' ) );
            }
            else
            {
                remove_filter( 'wp_feed_cache_transient_lifetime', array( $this, 'default_update_feed_quickly' ) );
            }

		    if ( is_wp_error($rss) ) {
				if ( is_admin() || current_user_can('manage_options') ) {
				   echo '<p>';
				   printf('<strong>' . esc_html__( 'Error getting content: ', 'playomatic-google-play-post-generator' ) . '</strong>: %s', $rss->get_error_message());
				   echo '</p>';
				}
		    	return;
			}

			if ( !$rss->get_item_quantity() ) {
			     echo '<p>' . esc_html__( 'Apparently, there are no updates to show!', 'playomatic-google-play-post-generator' ) . '</p>';
			     $rss->__destruct();
			     unset($rss);
			     return;
			}

			$str .= '<ul>';

			if ( !isset($items) )
			     foreach ( $rss->get_items(0, $this->num_items) as $item ) {
			          $link = esc_url_raw( strip_tags( $item->get_link() ) );
			          $title = esc_html( $item->get_title() );
			          $cat = $item->get_item_tags('', 'thumbnail');
			          if(isset($cat[0]['data'])){$thumbnail_img = $cat[0]['data'];}else{$thumbnail_img = '';}
			          $content = $item->get_content();
			          $content = wp_html_excerpt($content, 300, '[...]');
			          $content .= "<p class='cr_al_right'><a href='" . esc_attr($link) . "'  target='_blank'>" . esc_html__( 'Learn more', 'playomatic-google-play-post-generator' ) . "</a></p>";

                        $str .= "<li>";
                        if($thumbnail_img != '')
                        {
                           $str .= "<div class='cr_mixedx'><a href='" . esc_attr($link) . "' target='_blank'><img src='".esc_attr($thumbnail_img)."' class='cr_widthf' /></a></div>";
                        }
			         	$str .= "<div class='cr_float_left";
                        if($thumbnail_img != '')
                        {
                            $str .= " cr_width_78";
                        }
                        $str .= "'><a class='rsswidget' href='" . esc_attr($link) . "' target='_blank'>$title</a>\n<div class='rssSummary'>$content</div></div>
			         	<div class='clear'></div>
			         	</li>\n<li><hr/></li>";
			}

			$str .= '</ul><div class="cr_clear"></div><a href="https://coderevolution.ro/blog/" class="button button-primary" target="_blank">' . esc_html__( '+ More', 'playomatic-google-play-post-generator' ) . '</a><a class="cr_float_right" href="#" id="wp_coderevonewsdashboard_hide">' . esc_html__( 'Don\'t show this widget', 'playomatic-google-play-post-generator' ) . '</a><div class="cr_clear"></div>';
            wp_enqueue_script('coderevo-other-script-news', plugins_url('scriptnews.js', __FILE__), array('jquery'));
			echo $str;
			$rss->__destruct();
			unset($rss);
		}
		function update_feed_quickly( $seconds ) {
		    return 5;
		}
        function default_update_feed_quickly( $seconds ) {
		    return 2592000;
		}
	}
	new CodeRevoNewsDashboard( );
}

if ( !class_exists( 'CodeRevoDashboardPlugins' ) ) {
	class CodeRevoDashboardPlugins {
		var $feed = 'https://wpinitiate.com/custom-feeds/products.xml';
		var $num_items = 8;
		var $quick = 0;
		function __construct() {
			add_filter( 'plugin_install_action_links', array( $this, 'plugin_links' ), 10, 2 );
			add_filter( 'install_plugins_tabs', array( $this, 'plugin_tabs' ), 10, 2 );
			add_action( 'install_plugins_coderevolutionplugins', array( $this, 'install_plugins_im' ), 10, 1 );
			add_action( 'install_plugins_pre_coderevolutionplugins', array( $this, 'get_favorites' ) );
			add_action( 'install_plugins_coderevolutionplugins', 'display_plugins_table');
			add_filter( 'plugins_api', array( $this, 'inject_plugin_info' ), 20, 3 );
		}

		function update_feed_quickly( $seconds ) {
		  return 5;
		}
        function default_update_feed_quickly( $seconds ) {
		    return 2592000;
		}
		function plugin_tabs( $tabs ) {
			$plugins = $this->check_remote_plugins();
			if( $plugins )
		    	$tabs = array( 'coderevolutionplugins' => __( 'Highlighted' ) ) + $tabs;
			return $tabs;
		}

		function install_plugins_im() {
?>
            <p><?php echo esc_html__( 'A selection of plugins, highlighted for you.', 'playomatic-google-play-post-generator' );
        $reg_css_code = '.cr_centex{text-align:center}.plugin-install-tab-coderevolutionplugins .tablenav.top {display: none;}.plugin-install-tab-coderevolutionplugins p.authors {display: none;}';
        wp_register_style( 'coderevo-plugin-other-style', false );
        wp_enqueue_style( 'coderevo-plugin-other-style' );
        wp_add_inline_style( 'coderevo-plugin-other-style', $reg_css_code );
?></p>
        <?php
		}

		function get_favorites() {
		   global $wp_list_table;
			$args = array();
			$api = $this->query_server();
			$wp_list_table->items = $api->plugins;
			$wp_list_table->set_pagination_args(
				array(
					'total_items' => $api->info['results'],
					'per_page' => $api->info['per_page'],
				)
			);
		}

		function query_server() {
			$res = new stdclass();
			$res->plugins = array();

			$res->plugins = $this->get_remote_plugins();
			$num_res = 0;
			if( $res->plugins )
				$num_res = count( $res->plugins );
			$res->info = array(
				'results' => $num_res,
				'per_page' => 20
			);
			return $res;
		}

		function check_remote_plugins( $force_check = 0 ) {
			$plugins = $this->get_remote_plugins();
			if( empty( $plugins ) )
				return false;
			return true;
		}

		private function get_remote_plugins() {
			if( $this->quick )
				delete_transient( 'coderevolution_plugins' );
			if ( false === ( $coderevolution_plugins = get_transient( 'coderevolution_plugins' ) ) || empty( $coderevolution_plugins ) ) {
			     $coderevolution_plugins = $this->do_get_remote_plugins();
                 set_transient( 'coderevolution_plugins', $coderevolution_plugins, 12 * HOUR_IN_SECONDS );
			}
			return $coderevolution_plugins;
		}

		private function do_get_remote_plugins() {
			$i = 0;
			$myposts = array();
			$url = add_query_arg( 'paged', $i, $this->feed );
			if( $this->quick )
            {
				add_filter( 'wp_feed_cache_transient_lifetime' , array( $this, 'update_feed_quickly' ) );
            }
            else
            {
                add_filter( 'wp_feed_cache_transient_lifetime' , array( $this, 'default_update_feed_quickly' ) );
            }
			$rss = fetch_feed( $url );
			if ( is_wp_error( $rss ) ) {
				if( !empty( $myposts ) )
					return $myposts;
				return false;
			}

			if( $this->quick )
            {
				remove_filter( 'wp_feed_cache_transient_lifetime', array( $this, 'update_feed_quickly' ) );
            }
            else
            {
                remove_filter( 'wp_feed_cache_transient_lifetime', array( $this, 'default_update_feed_quickly' ) );
            }
			$strip_htmltags = $rss->strip_htmltags;
			array_splice( $strip_htmltags, array_search('iframe', $strip_htmltags), 1 );
			array_splice( $strip_htmltags, array_search('param', $strip_htmltags), 1 );
			array_splice( $strip_htmltags, array_search('embed', $strip_htmltags), 1 );

			if( !is_wp_error( $rss ) )
				$rss->strip_htmltags( $strip_htmltags );
			$maxitems = $rss->get_item_quantity( 50 );
		    if ( is_wp_error($rss) ) {
				if( !empty( $myposts ) )
					return $myposts;
		    	return false;
			}
			if ( !$rss->get_item_quantity() ) {
			     $rss->__destruct();
			     unset($rss);
			     if( !empty( $myposts ) )
			     	return $myposts;
			     return false;
			}
			foreach ( $rss->get_items() as $item ) {
				$purchaseurl = esc_url_raw( strip_tags( $item->get_link() ) );
				$title = esc_html( $item->get_title() );
				$slug = $this->get_rss_field( $item, 'autors_slug' );
				if( empty( $slug ) )
					continue;
				if( 1 && $this->coderevolution_plugin_installed( $slug ) ) 
					continue;
				$installs = $this->get_rss_field( $item, 'autors_installs' );
				$lastupdated = $this->get_rss_field( $item, 'autors_lastupdated' );
				$rating = $this->get_rss_field( $item, 'autors_rating' );
				$reviews = $this->get_rss_field( $item, 'autors_reviews' );
				$authorname = $this->get_rss_field( $item, 'autors_authorname' );
				$authorurl = $this->get_rss_field( $item, 'autors_authorurl' );
				$description = $this->get_rss_field( $item, 'autors_description' );
				$version = $this->get_rss_field( $item, 'autors_version' );
				$previews = array();
				$rfields = array( 'review1_name', 'review1_txt', 'review2_name', 'review2_txt', 'review3_name', 'review3_txt' );
				foreach( $rfields as $rfield ) {
					$val = $this->get_rss_field( $item, $rfield );
					$previews[ $rfield ] = $val;
				}
				$content = $item->get_content();
				if( empty( $authorname ) ) {
					$authorname = 'CodeRevolution';
				}
				if( empty( $authorurl ) ) {
					$authorurl = 'https://coderevolution.ro/';
				}
				if( empty( $lastupdated ) ) {
					$lastupdated = date( 'Y' ).'-'.date( 'm' ).'-01 8:49pm GMT';
				}
				if( empty( $version ) ) {
					$version = 1.8;
				}
				if( empty( $rating ) )
					$rating = rand( 90, 99);
				if( empty( $reviews ) )
					$reviews = rand( 237, 1283 );
				if( empty( $installs ) )
					$installs = rand( 3678, 13372 );
				$thumbnail = $item->get_item_tags( '', 'featured_image' );
				$thumbnail2 = $thumbnail[0]['data'];

				$vers = get_bloginfo( 'version' );
				if(is_numeric($vers))
				{
					$vers = floatval($vers);
				}
				else
				{
					$vers = 6.0;
				}
				$myposts[] = array(
					'name' => $title,
					'slug' => $slug,
					'crtype' => 'coderevolution',
					'version' => $version,
					'author' => '<a href="'.$authorurl.'">'.$authorname.'</a>',
					'author_profile' => $authorurl,
					'homepage' => $purchaseurl,
					'download_link' => $purchaseurl,
					'requires' => '3.5',
					'tested' => ceil( $vers ).'.0',
					'requires_php' => false,
					'rating' => $rating,
					'num_ratings' => $reviews,
					'active_installs' => $installs,
					'last_updated' => $lastupdated,
					'downloaded' => $installs,
					'description' => $content,
					'short_description' => $description,
					'apreviews' => $previews,
					'icons' => array(
						'1x' => $thumbnail2,
						'2x' => $thumbnail2
					),
					'author_block_count' => 2,
					'author_block_rating' => 94,
				);

			}
			return $myposts;
		}
		function plugin_links( $links, $plugin ) {
			if( isset( $plugin[ 'crtype' ] ) && ( $plugin[ 'crtype' ] == 'coderevolution' ) ) {
				$links[0] = '<a class="button" data-slug="'.$plugin[ 'slug' ].'" href="'.$plugin[ 'download_link' ].'" target="_blank" aria-label="Install Plugin" data-name="'.$plugin[ 'name' ].'">'.esc_html__( 'Download Now', 'playomatic-google-play-post-generator' ).'</a>';
				$links[1] = '<a href="'.$plugin[ 'download_link' ].'" class="" aria-label="'.sprintf( esc_html__( 'More information about', 'playomatic-google-play-post-generator' ) . ' %s', $plugin[ 'name' ] ).'" target="_blank" data-title="'.$plugin[ 'name' ].'">'.esc_html__( 'More Details', 'playomatic-google-play-post-generator' ).'</a>';
			}
			return $links;
		}

		public function inject_plugin_info($result, $action = null, $args = null){
			if( $action !== 'plugin_information' )
				return $result;
			$our_plugin_info = $this->is_our_plugin( $args->slug );
			if( !$our_plugin_info )
				return $result;

			$pluginInfo = $this->requestPluginInfo( $our_plugin_info );
			if ( $pluginInfo ) {
				return $pluginInfo;
			}

			return $result;
		}

		private function is_our_plugin( $slug ) {
			$plugins = $this->get_remote_plugins();
			if( empty( $plugins ) )
				return false;
			foreach( $plugins as $plugin ) {
				if( $plugin['slug'] === $slug )
					return $plugin;
			}
			return false;
		}

		public function requestPluginInfo( $info ) {
			$description = isset( $info[ 'description' ] ) ? trim( $info[ 'description' ] ) : '';
			$intro = '<h3 class="cr_centex"><center><a href="'.$info[ 'homepage' ].'" target="_blank" class="button button-primary">' . esc_html__( 'Click here to get the plugin', 'playomatic-google-play-post-generator' ) . '</a></center></h3>';
			$outro = '<h3><center><a href="'.$info[ 'homepage' ].'" target="_blank" class="button button-primary">' . esc_html__( 'Download the plugin here', 'playomatic-google-play-post-generator' ) . '</a></center></p>';

			$ret = array(
				'name' => isset( $info[ 'name' ] ) ? trim( $info[ 'name' ] ) : '',
				'slug' => isset( $info[ 'slug' ] ) ? trim( $info[ 'slug' ] ) : '',
				'homepage' => isset( $info[ 'homepage' ] ) ? trim( $info[ 'homepage' ] ) : '',
				'download_url' => isset( $info[ 'download_link' ] ) ? trim( $info[ 'download_link' ] ) : '',
				'version' => isset( $info[ 'version' ] ) ? trim( $info[ 'version' ] ) : '',
				'required' => isset( $info[ 'required' ] ) ? trim( $info[ 'required' ] ) : '',
				'tested' => isset( $info[ 'tested' ] ) ? trim( $info[ 'tested' ] ) : '',
				'last_updated' => isset( $info[ 'last_updated' ] ) ? trim( $info[ 'last_updated' ] ) : '',
				'author' => isset( $info[ 'author' ] ) ? trim( $info[ 'author' ] ) : '',
				'author_homepage' => isset( $info[ 'author_profile' ] ) ? trim( $info[ 'author_profile' ] ) : '',
				'rating' => isset( $info[ 'rating' ] ) ? intval( $info[ 'rating' ] ) : '',
				'num_ratings' => isset( $info[ 'num_ratings' ] ) ? intval( $info[ 'num_ratings' ] ) : '',
				'active_installs' => isset( $info[ 'active_installs' ] ) ? intval( $info[ 'active_installs' ] ) . '+' : '',
				'downloaded' => isset( $info[ 'downloaded' ] ) ? intval( $info[ 'downloaded' ] ) : '',
				'sections' => array(
					'description' => $intro . $description . $outro,
					'installation' => '<p>' . esc_html__( 'Just download the plugin from CodeCanyon and install it to your site in a few seconds.', 'playomatic-google-play-post-generator' ) . '</p>
					<p><a href="'.$info[ 'homepage' ].'" target="_blank" class="button button-primary">' . esc_html__( 'Click here to get the plugin', 'playomatic-google-play-post-generator' ) . '</a></p>'
				)
			);

			$reviews = isset( $info[ 'apreviews' ] ) ? $info[ 'apreviews' ] : false;
			if( !empty( $reviews ) && isset( $reviews[ 'review1_name' ] )  && !empty( $reviews[ 'review1_name' ] ) )
				$ret[ 'sections' ][ 'review' ] = $this->format_reviews( $reviews );
			return (object) $ret;
		}

		private function format_reviews( $reviews ) {
			if( empty( $reviews ) )
				return '';
			$ret = '';
			$review1_name = isset( $reviews[ 'review1_name' ] ) ? trim( $reviews[ 'review1_name' ] ) : '';
			$review1_txt = isset( $reviews[ 'review1_txt' ] ) ? trim( $reviews[ 'review1_txt' ] ) : '';
			if( !empty( $review1_txt ) ) {
				$ret .= $this->format_review( $review1_name, $review1_txt );
			}
			$review2_name = isset( $reviews[ 'review2_name' ] ) ? trim( $reviews[ 'review2_name' ] ) : '';
			$review2_txt = isset( $reviews[ 'review2_txt' ] ) ? trim( $reviews[ 'review2_txt' ] ) : '';
			if( !empty( $review2_txt ) ) {
				$ret .= $this->format_review( $review2_name, $review2_txt );
			}
			$review3_name = isset( $reviews[ 'review3_name' ] ) ? trim( $reviews[ 'review3_name' ] ) : '';
			$review3_txt = isset( $reviews[ 'review3_txt' ] ) ? trim( $reviews[ 'review3_txt' ] ) : '';
			if( !empty( $review3_txt ) ) {
				$ret .= $this->format_review( $review3_name, $review3_txt );
			}
			return $ret;
			;

		}

		private function format_review( $name, $content ) {
			return '<div class="review">
				<div class="review-head">
					<div class="reviewer-info">
						<div class="review-title-section">
							<h4>' . esc_html($name) . '</h4>
							<div class="star-rating">
							<div class="wporg-ratings"><span class="star dashicons dashicons-star-filled"></span><span class="star dashicons dashicons-star-filled"></span><span class="star dashicons dashicons-star-filled"></span><span class="star dashicons dashicons-star-filled"></span><span class="star dashicons dashicons-star-filled"></span></div>				</div>
						</div>
					</div>
				</div>
				<div class="review-body">' . esc_html($content) . '</div>
			</div>';
		}
		private function get_rss_field( $item, $field ) {
			$value = $item->get_item_tags( '', $field );
			if(isset($value[0]['data']))
			{
				$val = $value[0]['data'];
			}
			else
			{
				return '';
			}
			return trim( html_entity_decode( $val ) );
		}

		private function coderevolution_plugin_installed( $slug ) {
			return $this->is_plugin_there( $slug );
		}

		private function is_plugin_there( $plugin_dir ) {
		    $plugins = get_plugins( '/'.$plugin_dir );
			if ( $plugins )
				return $plugins;
			return false;
		}

	}
	//new CodeRevoDashboardPlugins();
}
?>