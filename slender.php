<?php

/**
* Slender CMS Tag Manager
*
* @uses     
*
* @category Manager
* @package  Slender
* @author   Tristan Strathearn <r3oath@gmail.com>
* @license  MIT
*/
class Slender {
    /**
     * Current version number.
     *
     * @var string
     *
     * @access public
     * @static
     */
    public static $VERSION = '1.2.1';

    /**
     * Github repository URL.
     *
     * @var string
     *
     * @access public
     * @static
     */
    public static $REPO = 'https://github.com/r3oath/slender';

    /**
     * Create or return a html tag.
     * 
     * @param mixed  $name   The name.
     * @param string $desc   The description.
     * @param mixed  $global Show this tag regardless of what page it was created on.
     *
     * @access public
     * @static
     *
     * @return mixed Value.
     */
    public static function html($name, $desc = '', $global = false){
        static::handlr('html', $name, $desc, $global);
    }

    /**
     * Create or return a text tag.
     * 
     * @param mixed  $name   The name.
     * @param string $desc   The description.
     * @param mixed  $global Show this tag regardless of what page it was created on.
     *
     * @access public
     * @static
     *
     * @return mixed Value.
     */
    public static function text($name, $desc = '', $global = false){
        static::handlr('text', $name, $desc, $global);
    }

    /**
     * Create or return an image tag.
     * 
     * @param mixed  $name   The name.
     * @param string $desc   The description.
     * @param mixed  $global Show this tag regardless of what page it was created on.
     *
     * @access public
     * @static
     *
     * @return mixed Value.
     */
    public static function image($name, $desc = '', $global = false){
        static::handlr('image', $name, $desc, $global);
    }

    /**
     * Create or return a css tag.
     * 
     * @param mixed  $name   The name.
     * @param string $desc   The description.
     * @param mixed  $global Show this tag regardless of what page it was created on.
     *
     * @access public
     * @static
     *
     * @return mixed Value.
     */
    public static function css($name, $desc = '', $global = false){
        static::handlr('css', $name, $desc, $global);
    }

    /**
     * Create or return a js tag.
     * 
     * @param mixed  $name   The name.
     * @param string $desc   The description.
     * @param mixed  $global Show this tag regardless of what page it was created on.
     *
     * @access public
     * @static
     *
     * @return mixed Value.
     */
    public static function js($name, $desc = '', $global = false){
        static::handlr('js', $name, $desc, $global);
    }

    /**
     * Return a thanks/powered-by note with optional version number.
     * 
     * @param mixed $showVersion Description.
     *
     * @access public
     * @static
     *
     * @return mixed Value.
     */
    public static function thanks($showVersion = true){
        echo 'Content powered by <a href="' . static::repo() . '" class="thanks-slender">Slender ';
        echo ($showVersion === true) ? static::version() . '</a>' : '</a>';
    }

    /**
     * Get the current version number.
     * 
     * @access public
     * @static
     *
     * @return mixed Value.
     */
    public static function version(){
        return static::$VERSION;
    }

    /**
     * Get the Github Repository URL.
     * 
     * @access public
     * @static
     *
     * @return mixed Value.
     */
    public static function repo(){
        return static::$REPO;
    }

    /**
     * Handle various tag types.
     * 
     * @param mixed  $type   The type.
     * @param mixed  $name   The name.
     * @param string $desc   The description.
     * @param mixed  $global Show this tag regardless of what page it was created on.
     *
     * @access private
     * @static
     *
     * @return mixed Value.
     */
    private static function handlr($type, $name, $desc, $global){
        // Get the current page.
        $page = URL::current();

        // Attempt to grab the tag if it exists.
        if($global === false)
            $tag = Slendertag::where_name($name)->where_page($page)->first();
        else
            $tag = Slendertag::where_name($name)->first();

        // If tag does not exist, create a new one.
        if($tag === null){
            $tag = new Slendertag;
            $tag->type = $type;
            $tag->name = $name;
            $tag->page = $page;
            $tag->description = ($desc === '') ? 'No Description.' : $desc;
            $tag->save();
        }

        // Update the description if it has changed.
        if($desc !== '' && $tag->description !== $desc){
            $tag->description = $desc;
            $tag->save();
        }

        // Display the associated content if the tag is enabled.
        if($tag->enabled === 1)
            call_user_func('static::' . $tag->type . '_handlr', $tag->contents, $tag->alt);
    }

    /**
     * Handle html tags.
     * 
     * @param mixed $content    The content.
     * @param mixed $altContent The alternative content.
     *
     * @access private
     * @static
     *
     * @return mixed Value.
     */
    private static function html_handlr($content, $altContent){
        echo $content;
    }

    /**
     * Handle text tags.
     * 
     * @param mixed $content    The content.
     * @param mixed $altContent The alternative content.
     *
     * @access private
     * @static
     *
     * @return mixed Value.
     */
    private static function text_handlr($content, $altContent){
        echo htmlentities($content);
    }

    /**
     * Handle image tags.
     * 
     * @param mixed $content    The content.
     * @param mixed $altContent The alternative content.
     *
     * @access private
     * @static
     *
     * @return mixed Value.
     */
    private static function image_handlr($content, $altContent){
        echo '<img src="' . $content . '" alt="' . $altContent . '">';
    }

    /**
     * Handle css tags.
     * 
     * @param mixed $content    The content.
     * @param mixed $altContent The alternative content.
     *
     * @access private
     * @static
     *
     * @return mixed Value.
     */
    private static function css_handlr($content, $altContent){
        echo '<style>';
        echo $content;
        echo '</style>';
    }

    /**
     * Handle js tags.
     * 
     * @param mixed $content    The content.
     * @param mixed $altContent The alternative content.
     *
     * @access private
     * @static
     *
     * @return mixed Value.
     */
    private static function js_handlr($content, $altContent){
        echo '<script type="text/javascript">';
        echo $content;
        echo '</script>';
    }
}