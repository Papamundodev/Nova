<?php

namespace Theme_base;
    
class Base
{
    private string $theme_name;
    private string $theme_slug; 

    public function __construct(string $theme_name, string $theme_slug)
    {
        $this->theme_name = $theme_name;
        $this->theme_slug = $theme_slug;
    }

    public function includeStyles() : void
    {
        add_action('wp_enqueue_scripts', function () {
            wp_enqueue_style('main', get_template_directory_uri() . '/assets/css/main.css', [], null);
        });
    }   

    public function includeScripts() : void
    {
        add_action('wp_enqueue_scripts', function () {
            wp_register_script('main', get_template_directory_uri() . '/assets/js/main.js', [], null, true);
            wp_enqueue_script('main');
        });
    }

    public function themeSupports() : void
    {
        add_action('after_setup_theme', function () {
            // Menus
            add_theme_support('menus');
            add_theme_support('post-thumbnails');
            add_theme_support('title-tag');
            add_post_type_support('page', 'excerpt');
            // Enables post and comment RSS feed links to head
            add_theme_support('automatic-feed-links');
            // I18N
            load_theme_textdomain('theme_base', get_template_directory() . '/languages');
            // Activer le lazy loading natif
            add_theme_support('lazy-loading-images');
            // Ajouter des tailles d'images optimisées
            add_image_size('icon_small', 32, 32, true);  // Pour les miniatures très petites
            add_image_size('icon', 48, 48, true);  // Pour les miniatures très petites
            add_image_size('mobile', 576, '', true); // Pour les mobiles
            add_image_size('tablet', 768, '', true); // Pour les tablettes
            add_image_size('medium', 992, '', true); // Medium 
            add_image_size('large', 1200, '', true); // Large 
            add_image_size('team_member', 500, 500, true);   // Team cards (displayed 500×500)
            add_image_size('layout_img', 700, 700, false);   // our_values, portfolio (max 700px)

        }, 99);
    }

    public function registerMenus() : void
    {
        register_nav_menus([
            'header' => __('Header', 'theme_base'),
            'footer' => __('Footer', 'theme_base'),
            'policy' => __('Policy', 'theme_base'),
        ]);
    }

    public function allowSVGUploads() :void
    {
        add_action('init', function () {

            add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {
                global $wp_version;
                if ($wp_version !== '4.7.1') {
                    return $data;
                }

                $filetype = wp_check_filetype($filename, $mimes);

                return [
                    'ext'             => $filetype['ext'],
                    'type'            => $filetype['type'],
                    'proper_filename' => $data['proper_filename']
                ];
            }, 10, 4);

        });

    }

    public function addSVGSupport() :void
    {
        add_action('init', function () {

            add_filter('upload_mimes', function ($mimes) {
                $mimes['svg'] = 'image/svg+xml';

                return $mimes;
            });

        });

    }


    public static function get_meta_description(){
        if (is_category()){
            return get_queried_object()->description;
        }elseif(is_page() || is_single()){
            return get_the_excerpt();
        }else{
            return bloginfo('description');
        }
    }

    public static function get_breadcrumbs(){
        $links = array();
        $cats = get_the_category();
        if ( ! empty( $cats ) ) {
            foreach ($cats as $cat) {
                $cat_link = array(
                    'url' => get_category_link( $cat->term_id ),
                    'text' => $cat->name
                );
                array_push($links, $cat_link);
            }
        }
        $current_page = array(
            'url' => get_permalink(),
            'text' => get_the_title()
        );
        array_push($links, $current_page);
        return $links;
    }


    /**
     * Get nav menu items by location
     *
     * @param string|null $location The menu location id
     */
    public static function  wp_get_menu_array(?string $location = null, $args = []) : array
    {   
        // Get all locations
        $locations = get_nav_menu_locations();

        if ($location === null || !array_key_exists($location, $locations)) {
            return [];
        }

        // Get object id by location
        $object = wp_get_nav_menu_object($locations[$location]);
        // Get menu items by menu name
        $menu_items = wp_get_nav_menu_items($object->name, array( 'update_post_term_cache' => false ));
        _wp_menu_item_classes_by_context( $menu_items );
        // Return menu post objects
        $menu = [];

        foreach ($menu_items as $k => $m) {
       
            if (empty($m->menu_item_parent)) {
                $menu[$m->ID] = [];
                $menu[$m->ID]['ID'] = intval($m->ID);
                $menu[$m->ID]['title'] = $m->title;
                $menu[$m->ID]['classes'] = $m->classes;
                $menu[$m->ID]['url'] = $m->url;
                $menu[$m->ID]['object_id'] = intval($m->object_id);
                if($m->type === 'post_type'){
                    $object = get_post($m->object_id);
                }elseif($m->type === 'taxonomy'){
                    $object = get_term($m->object_id);
                }
                $menu[$m->ID]['object'] = $object;
                $menu[$m->ID]['target'] = $m->target;
                unset($menu_items[$k]);
                $menu[$m->ID]['children'] = self::populate_children($menu_items, $m);

                    
            }
        }
        return $menu;

    }

    /**
     * Populate children
     *
     */

    public static function populate_children( array $menu_array = null, \WP_Post $menu_item = null) : array
    {
        $children = [];
        if (!empty($menu_array)) {
            foreach ($menu_array as $k => $m) {
                if ($m->menu_item_parent == $menu_item->ID) {
                    $children[$m->ID] = [];
                    $children[$m->ID]['ID'] = intval($m->ID);
                    $children[$m->ID]['title'] = $m->title;
                    $children[$m->ID]['classes'] = $m->classes;
                    $children[$m->ID]['url'] = $m->url;
                    $children[$m->ID]['parent'] = intval($menu_item->ID);
                    $children[$m->ID]['target'] = $m->target;
                    $children[$m->ID]['object_id'] = intval($m->object_id);
                    // Get the object based on the menu item type
                    if ($m->type === 'post_type') {
                        $children[$m->ID]['object'] = get_post($m->object_id);
                    } elseif ($m->type === 'taxonomy') {
                        $children[$m->ID]['object'] = get_term($m->object_id);
                    }
                    unset($menu_array[$k]);
                    $children[$m->ID]['children'] = self::populate_children($menu_array, $m);
                }
            }
        };
        return $children;
    }

    public static function get_active_class($item) : string
    {
        if(in_array('current-menu-item', $item['classes'] ?? [])){
            return 'active';
        }
        return '';
    }

    /**
     * Check if an object is a WP_Post or WP_Term
     * @param mixed $object The object to check
     * @return string 'post'|'term'|'unknown'
     */
    public static function get_object_type($object) : string
    {
        if ($object instanceof \WP_Post) {
            return 'post';
        } elseif ($object instanceof \WP_Term) {
            return 'term';
        }
        return 'unknown';
    }

    /**
     * Get active class for parent menu items
     * @param array $item Menu item array
     * @param object $object Current queried object
     * @param int $page_for_posts ID of the posts page
     * @return string Active class if conditions are met
     */
    public static function get_parent_active_class($item, $object) : string
    {
        $active_class = '';
        $page_for_posts = get_option('page_for_posts');
        if(self::get_object_type($item['object']) === 'post' && $object && $object->post_type === 'post'){
            if($item['object']->ID === intval($page_for_posts)){
                $active_class = 'active';
            }
        }elseif(self::get_object_type($item['object']) === 'term' && $object){
            if($item['object']->term_id === intval($object->parent)){
                $active_class = 'active';
            }
        }
        return $active_class;
    }

    /**
     * Register sidebars and widgetized areas.
     *
     * search
     *
     */
    public function registerWidgets() :void
    {
        add_action('widgets_init', function () {

            //add sidebars and widgets here

        });
    }

    /**
     * @return void
     * add widget for language selector if wpml is active
     */
    public function sidebar_widgets_language_selector_init() : void
    {
        add_action( 'widgets_init',  function(){
            register_sidebar( array(
                'name'          => 'language_selector_theme_base',
                'id'            => 'language_selector',
                'before_widget' => '<ul class="language-selector">',
                'after_widget'  => '</ul>',
                'before_title'  => '<li>',
                'after_title'   => '</li>',
            ) );
        });
    }
    

    /**
     * Calcule le temps de lecture estimé d'un contenu
     * @param string $content Le contenu du post
     * @return string Le temps de lecture formaté
     */
    public static function get_reading_time(string $content = '') : string 
    {
        // Si pas de contenu, utiliser le contenu du post courant
        if (empty($content)) {
            $content = get_the_content();
        }

        // Nettoyer le contenu des balises HTML
        $clean_content = strip_tags($content);
        
        // Nombre de caractères par minute (vitesse moyenne de lecture)
        $chars_per_minute = 1500;
        
        // Calculer le temps en minutes
        $chars_count = strlen($clean_content);
        $minutes = ceil($chars_count / $chars_per_minute);
        
        // Formater le résultat
        if ($minutes <= 1) {
            return __('1 min read', 'theme_base');
        } else {
            return sprintf(__('%d min read', 'theme_base'), $minutes);
        }
    }

}