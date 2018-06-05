<?php

class Pads

{

  private $pads = array();
  private $css = false;
  private $book_js = false;
  private $book_css = false;

  public function __construct($pads = array()) {
    $this->push($pads);
  }

  public function push($pads){
    $pads = (array)$pads;
    foreach ($pads as $pad) :
      if(endsWith($pad, '.css') || endsWith($pad, '.js')):
        $this->pads[] = new Pad($pad . ' (type: settings visibility: private)');
      else:
        $this->pads[] = new Pad($pad);
      endif;
    endforeach;
    return $this;
  }

  public function css() {
    if($css = $this->find('style.css')):
      return $css->css();
    endif;
    return false;
  }

  public function book_css() {
    if($book_css = $this->find('book.css')):
      return $book_css->css();
    endif;
    return false;
  }

  public function book_js() {
    if($book_js = $this->find('book.js')):
      return $book_js->js();
    endif;
    return false;
  }

  public function find($p){
    foreach($this->pads as $pad) :
      if (strtolower($pad->id()) == strtolower($p)):
        return $pad;
      endif;
    endforeach;
    return false;
  }

  public function children($filter = false) {
    global $libreto;
    $pads = array_filter($this->pads, function($pad) use ($filter) {
      if($pad->visible($filter)) { return true; }
      return false;
    });
    $pads = array_values($pads);
    return $pads;
  }

  public function first() {
    $pads = $this->children();
    if(array_key_exists(0, $pads)):
      return $pads[0];
    endif;
    return;
  }

  public function selected(){
    foreach ($this->pads as $pad) {
      if($pad->selected()) { return $pad; }
    }
    return false;
  }

  public function selectActivePad() {

    global $libreto;

    // set default pad
    $default = $this->first() ?: $this->find("help");

    // set requested pad
    $pad = $libreto->router()->pad() ?: $default;

    $pad->select();

    return $pad;

  }

}
