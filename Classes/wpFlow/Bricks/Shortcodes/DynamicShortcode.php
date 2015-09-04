<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 21.08.15
 * Time: 10:51
 */

namespace wpFlow\Bricks\Shortcodes;


use wpFlow\Shortcodes\BaseShortcode;
use wpFlow\Shortcodes\TemplateEngine\TemplateParser;

class DynamicShortcode extends BaseShortcode
{
    /**
     * The Place where to find the Template in the Resourcefolder.
     * @const string
     */
    const TEMPLATEPATH = 'Private/Templates/';

    /**
     * @var TemplateParser
     */
    protected static $templateParser;

    /**
     * The Packages Resource Path.
     * @var string
     */
    protected $resourcePath;

    protected static $templatePathAndFilename;


    public function __construct( $tag, $resourcePath, TemplateParser $templateParser ){
        parent::__construct();
        self::$templateParser = $templateParser;
        $this->resourcePath = $resourcePath;
        $this->concatenathPath( $tag );

        $this->setTag( $tag );

        $this->register();
    }

    protected function concatenathPath($tag){
        self::$templatePathAndFilename = $this->resourcePath . self::TEMPLATEPATH . $tag . '.html';
    }

    public function shortCodeMagic($atts, $content = NULL){
        return do_shortcode(self::view($atts, $content));
    }

    protected static function view($atts, $content){
        self::$templateParser->setTemplatePathAndFilename(self::$templatePathAndFilename);
        return self::$templateParser->view($atts, $content);
    }

}