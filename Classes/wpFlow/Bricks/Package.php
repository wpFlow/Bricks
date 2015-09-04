<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 22.07.15
 * Time: 09:41
 */

namespace wpFlow\Bricks;

use wpFlow\Bricks\Shortcodes\ShortcodeFactory;
use wpFlow\Bricks\VisualComposer\BuildVCArray;
use wpFlow\Bricks\VisualComposer\ExtractBaseName;
use wpFlow\Bricks\VisualComposer\VcMapConfiguration;
use wpFlow\Core\Bootstrap;
use wpFlow\Core\Package\Package as BasePackage;
use wpFlow\Core\Utilities\Debug;


class Package extends BasePackage
{
    /**
     * If this package is able to read ConfigFiles.
     * @var boolean
     */
    protected $configManagementEnabled = true;

    /**
     * The TemplateParser Class
     * @var object
     */
    protected $templateParser;


    protected $bootstrap;

    public $bricks;


    public function boot(Bootstrap $bootstrap){
        $this->bootstrap = $bootstrap;
        $this->templateParser = $this->bootstrap->registerDependency('TemplateParser', 'wpFlow\Shortcodes\TemplateEngine\TemplateParser');
        $configManager = $this->bootstrap->injectDependency('configManager');
        $configManager->addConfigValidation('BrickNodes.yaml', new VcMapConfiguration());

    }

    public function run(){

        $brickNode = $this->getConfigValues('BrickNodes.yaml');

        $vcConfig =  new BuildVCArray($brickNode['Bricks']);

        $shortcode = new ShortcodeFactory();

        foreach($vcConfig->getBricks() as $bricks) {

            if(empty($bricks['content_object'])){
                $base = $bricks['base'];
                $resourcePath = $this->getPackageManager()->getPackage($bricks['packageKey'])->getResourcesPath();

                unset($bricks['packageKey']);

                $shortcode->createDynamic($base, $resourcePath, $this->templateParser);

                vc_map($bricks);

            } else {

                $base = $bricks['base'];
                $resourcePath = $this->getPackageManager()->getPackage($bricks['packageKey'])->getResourcesPath();

                unset($bricks['packageKey']);
                $shortcode->createStatic($base, $bricks['content_object'] ,$resourcePath, $this->templateParser);

                vc_map($bricks);
            }
        }

    }



}