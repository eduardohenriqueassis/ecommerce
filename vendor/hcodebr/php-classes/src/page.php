<?php

namespace Hcode;
 
use Rain\Tpl;

class Page {

    private $tpl;
    private $options = [];
    private $defaults = [
        "header"=>true,
        "footer"=>true,
        "data"=>[]
    ];

    public function __construct($opts = array(), $tpl_dir = "/views/"){

        $this->options = array_merge($this->defaults, $opts);

            // config
        $config = array(
            "tpl_dir"       => $_SERVER["DOCUMENT_ROOT"].$tpl_dir,  //Variável de sistema para dizer para o tpl procurar o root.
            "cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
            "debug"         => false // set to false to improve the speed
        );

        Tpl::configure( $config );

        $this->tpl = new Tpl;

        $this->setData($this->options["data"]);

        // foreach ($this->options["data"] as $key => $value ) {
        //     $this->tpl->assign($key, $value);
        // }
        //O foreach acima foi comentado pois ele foi colocado na função setData();

        if($this->options["header"] === true)$this->tpl->draw("header");

    }

    private function setData($data = array())
    {
        foreach ($data as $key => $value){
            $this->tpl->assign($key, $value);
        }
    }

    // Method for the Body.

    public function setTpl($name, $data = array(), $returnHTML = false)
    {
        
        $this->setData($data);
        return $this->tpl->draw($name, $returnHTML);

    }

    public function __destruct(){

        if ($this->options["header"] === true) $this->tpl->draw("footer");

    }
}

?>