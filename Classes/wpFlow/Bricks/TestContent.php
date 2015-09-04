<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 04.09.15
 * Time: 10:26
 */

namespace wpFlow\Bricks;


class TestContent extends ShortcodeContent
{

    protected function processAtts(){
        $this->atts['more'] = 'Shit';
    }
}