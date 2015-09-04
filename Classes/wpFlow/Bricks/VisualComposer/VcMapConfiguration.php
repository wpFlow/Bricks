<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 21.08.15
 * Time: 16:23
 */

namespace wpFlow\Bricks\VisualComposer;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class VcMapConfiguration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('Register');

        $rootNode
            ->children()
                ->arrayNode('Bricks')
                    ->prototype('array')
                    ->children()
                        ->scalarNode('name')->end()
                        ->scalarNode('description')->end()
                        ->scalarNode('class')->end()
                        ->scalarNode('content_object')->end()
                        ->scalarNode('template')->end()
                        ->scalarNode('show_settings_on_create')->end()
                        ->scalarNode('weight')->end()
                        ->scalarNode('category')->end()
                        ->scalarNode('group')->end()
                        ->arrayNode('admin_enqueue_js')
                            ->prototype('scalar')->end()
                        ->end()
                        ->arrayNode('admin_enqueue_css')
                            ->prototype('scalar')->end()
                        ->end()
                        ->arrayNode('front_enqueue_js')
                            ->prototype('scalar')->end()
                        ->end()
                        ->arrayNode('front_enqueue_css')
                            ->prototype('scalar')->end()
                        ->end()
                        ->scalarNode('icon')->end()
                        ->scalarNode('custom_markup')->end()
                        ->scalarNode('js_view')->end()
                        ->scalarNode('deprecated')->end()
                        ->booleanNode('content_element')->end()
                        ->arrayNode('params')
                            ->prototype('array')
                            ->children()
                            ->enumNode('type')->values(
                            array('textarea_html',
                                'textfield',
                                'textarea',
                                'dropdown',
                                'attach_image',
                                'attach_images',
                                'posttypes',
                                'colorpicker',
                                'exploded_textarea',
                                'widgetised_sidebars',
                                'textarea_raw_html',
                                'vc_link',
                                'checkbox',
                                'loop',
                                'css'))->end()
                            ->scalarNode('holder')->end()
                            ->scalarNode('class')->end()
                            ->scalarNode('heading')->end()
                            ->scalarNode('param_name')->end()
                            ->arrayNode('value')
                                ->prototype('scalar')->end()
                            ->end()
                            ->scalarNode('description')->end()
                            ->scalarNode('admin_label')->end()
                            ->arrayNode('dependency')
                                ->prototype('scalar')->end()
                            ->end()
                            ->scalarNode('edit_field_class')->end()
                            ->integerNode('weight')->end()
                            ->scalarNode('group')->end()
                            ->end()
                        ->end()
                    ->end()
                    ->end()

                    ->end()
                ->end()
            ->end()
        ;
        return $treeBuilder;
    }
}