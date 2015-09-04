<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 24.08.15
 * Time: 09:25
 */

namespace wpFlow\Bricks\Shortcodes;

use wpFlow\Shortcodes\BaseShortcode;

class StaticShortcode extends BaseShortcode
{
    protected static $templateParser;

    /**
     * The Classname und Namespace.
     * @var string
     */
    protected static $class;

    protected static $resourcePath;

    protected static $template;


    public function __construct( $tag, $class, $resourcePath, $templateParser ){
        parent::__construct();

        self::$class = $class;
        self::$resourcePath = $resourcePath;
        self::$templateParser = $templateParser;

        $this->setTag($tag);
        self::$template = $tag;

        $this->register();
    }

    public function shortCodeMagic($atts, $content = NULL){
        $output = self::content($atts, $content);

        return do_shortcode($output);
    }

    protected static function content($atts, $content){
        $reflectionClass = new \ReflectionClass(self::$class);
        return $reflectionClass->newInstanceArgs([self::$template, $atts, $content, self::$resourcePath ,self::$templateParser]);
    }
}