<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 19.08.15
 * Time: 16:44
 */

namespace wpFlow\Bricks\Shortcodes;


class ShortcodeFactory
{

    /** Creates a new Shortcode Instance
     * @param $base
     */
    public function createDynamic($base, $resourcePath, $templateParser)
    {
        new DynamicShortcode($base, $resourcePath, $templateParser);
    }

    public function createStatic($base, $class, $resourcePath, $templateParser)
    {
        new StaticShortcode($base, $class, $resourcePath, $templateParser);
    }
}