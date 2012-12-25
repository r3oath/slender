<?php

class Slender {

    public static $VERSION  = '1.0.3';
    public static $REPO     = 'https://github.com/r3oath/slender';

    // --------------------------------------------------------------------------
    // Public Slender CMS interface methods.
    // --------------------------------------------------------------------------

    /*
        HTML Tag: Used for raw html code:
            <b>Welcome to my website!</b>
    */
    public static function html($tag, $desc = '', $global = false){
        static::handlr('html', $tag, $desc, $global);
    }

    /*
        TEXT Tag: Used for plain text with no formatting:
            Welcome to my website!
    */
    public static function text($tag, $desc = '', $global = false){
        static::handlr('text', $tag, $desc, $global);
    }

    /*
        IMAGE Tag: Used for image URLs, the handlr adds the neccessary <img> html tag:
        The actual content formating is handled by the slender dashboard.
    */
    public static function image($tag, $desc = '', $global = false){
        static::handlr('image', $tag, $desc, $global);
    }

    /*
        CSS Tag: Used for raw css code:
            Turns: body { background-color: red; }
            Into: <style>body { background-color: red; }</style>

        The actual content formating is handled by the slender dashboard.
    */
    public static function css($tag, $desc = '', $global = false){
        static::handlr('css', $tag, $desc, $global);
    }

    /*
        JS Tag: Used for raw JavaScript/jQuery/Backbone etc code:
            Turns: $('#welcome').html('Welcome to my website!');
            Into: <script type="text/javascript">$('#welcome').html('Welcome to my website!');</script>

        The actual content formating is handled by the slender dashboard.
    */
    public static function js($tag, $desc = '', $global = false){
        static::handlr('js', $tag, $desc, $global);
    }

    /*
        If you enjoy using Slender and would like to add a "Content powered by Slender <version>"
        notice on your website, just call this! A small way of saying thanks.
    */
    public static function thanks($showVersion = true){
        echo 'Content powered by <a href="' . static::repo() . '" class="thanks-slender">Slender ';
        echo ($showVersion === true) ? static::version() . '</a>' : '</a>';
    }

    /*
        Get the installed version info.
    */
    public static function version(){
        return static::$VERSION;
    }

    /*
        Get this Slender Git Repo.
    */
    public static function repo(){
        return static::$REPO;
    }

    // --------------------------------------------------------------------------
    // Everything else below is used internally. 
    // --------------------------------------------------------------------------

    private static function handlr($type, $tagName, $desc, $global){
        // Get the current page.
        $page = URL::current();

        // Attempt to grab the tag if it exists.
        if($global === false)
            $tag = Slendertag::where_name($tagName)->where_page($page)->first();
        else
            $tag = Slendertag::where_name($tagName)->first();

        // If this tag does not exist, create a new one.
        if($tag === null){
            $tag = new Slendertag;
            $tag->type = $type;
            $tag->name = $tagName;
            $tag->page = $page;
            $tag->description = ($desc === '') ? 'No Description.' : $desc;
            $tag->save();
        }

        // Update the description if it has changed.
        if($desc !== '' && $tag->description !== $desc){
            $tag->description = $desc;
            $tag->save();
        }

        // Display the tag contents if it is enabled.
        if($tag->enabled === 1)
            call_user_func('static::' . $tag->type . '_handlr', $tag->contents, $tag->alt);
    }

    private static function html_handlr($content, $alt){
        echo $content;
    }

    private static function text_handlr($content, $alt){
        echo htmlentities($content);
    }

    private static function image_handlr($content, $alt){
        echo '<img src="' . $content . '" alt="' . $alt . '">';
    }

    private static function css_handlr($content, $alt){
        echo '<style>';
        echo $content;
        echo '</style>';
    }

    private static function js_handlr($content, $alt){
        echo '<script type="text/javascript">';
        echo $content;
        echo '</script>';
    }

}