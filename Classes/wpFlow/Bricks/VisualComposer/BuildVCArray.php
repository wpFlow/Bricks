<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 26.08.15
 * Time: 16:07
 */

namespace wpFlow\Bricks\VisualComposer;

use wpFlow\Core\Utilities\Debug;

class BuildVCArray
{
    protected $transporter;

    protected $bricks;

    public function __construct( array $rawArray ){
        $this->transporter = $rawArray;

        foreach($this->transporter as $base => $brickNode){
            $packageKey = $this->extractPackageKey($base);
            $baseName = $this->extractBaseName($base);
            $this->buildArray( $brickNode, $baseName, $packageKey );
        }

    }

    protected function extractPackageKey($base){
        $packageKey = explode(':', $base);
        return $packageKey[0];
    }

    protected function extractBaseName($base){
        $baseName = explode(':', $base);
        return $baseName[1];
    }

    protected function buildArray($brickNode, $baseName, $packageKey){

        if(empty($brickNode['admin_enqueue_js'])) unset($brickNode['admin_enqueue_js']);
        if(empty($brickNode['admin_enqueue_css'])) unset($brickNode['admin_enqueue_css']);
        if(empty($brickNode['front_enqueue_js'])) unset($brickNode['front_enqueue_js']);
        if(empty($brickNode['front_enqueue_css'])) unset($brickNode['front_enqueue_css']);
        if(empty($brickNode['params']['dependency'])) unset($brickNode['params']['dependency']);

        $brickNode['base'] = strtolower($baseName);
        $brickNode['packageKey'] = $packageKey;

        $this->bricks[] = $brickNode;
    }

    public function getBricks(){
        return $this->bricks;
    }
}