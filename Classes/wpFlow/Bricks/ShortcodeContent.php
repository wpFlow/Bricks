<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 28.08.15
 * Time: 18:51
 */

namespace wpFlow\Bricks;


class ShortcodeContent
{
    protected $tag;

    protected $atts;

    protected $content;

    protected $resourcePath;

    protected $templateParser;

    protected $templatePath;

    protected $templatePathAndFilename;

    protected $templateContent;



    public function __construct($tag , $atts, $content, $resourcePath , $templateParser){
       $this->tag = $tag;
       $this->atts = $atts;
       $this->content = $content;
       $this->resourcePath = $resourcePath;
       $this->templateParser = $templateParser;

       $this->setTemplatePath();
       $this->setTemplate();
       $this->concatenathPath();
       $this->setTemplatePathAndFileName();
       $this->processAtts();
       $this->templateContent = $this->templateParser->view($this->atts, $this->content);

    }

    protected function setTemplatePath(){
        $this->templatePath = 'Private/Templates/';
    }

    protected function setTemplate(){

    }

    protected function processAtts(){

    }

    protected function setTemplatePathAndFileName(){
        $this->templateParser->setTemplatePathAndFilename($this->templatePathAndFilename);
    }

    protected function concatenathPath(){
        $this->templatePathAndFilename = $this->resourcePath . $this->templatePath  . $this->tag . '.html';
    }

    public function __toString(){

        return $this->templateContent;
    }


}