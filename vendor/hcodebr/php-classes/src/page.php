<?php

namespace Hcode;
 
use Rain\Tpl;

class Page {

    private $tpl;
    private $options = [];
    private $defaults = [
        "data"=>[]
    ];

    public function __construct($opts = array()){

        $this->options = array_merge($this->defaults, $opts);

            // config
        $config = array(
            "tpl_dir"       => $_SERVER["DOCUMENT_ROOT"]."/views/",  //Variável de sistema para dizer para o tpl procurar o root.
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

        $this->tpl->draw("header");

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
        $this->tpl->draw($name, $returnHTML);

    }

    public function __destruct(){

        return $this->tpl->draw("footer");

    }
}

?>