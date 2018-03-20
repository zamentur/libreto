<?php

class Libreto

{

  private $options;
  private $name;
  private $language;
  private $mode;
  private $menu;
  private $pads;
  private $router;
  private $provider;

  public function defaults(){
    $defaults = array(
      'name'                   => "Libreto",
      'scheme'                 => ( isset($_SERVER["HTTPS"]) ? 'https' : 'http' ) . '://',
      'server_name'            => $_SERVER["SERVER_NAME"],
      'url'                    => ( isset($_SERVER["HTTPS"]) ? 'https' : 'http' ) . '://' . $_SERVER["SERVER_NAME"],
      'default_provider'       => 'framapad',
    );

    return $defaults;
  }

  public function __construct($options) {

    $this->pads     = new Pads();
    $this->router   = new Router();
    $this->options  = array_merge($this->defaults(), $options);

    $this->set_provider();
    $this->set_name();
    $this->set_language();
    $this->set_mode();

  }

  public function launch(){

    $this->set_menu();
    $this->set_pads();

    // Load template
    include ROOT . DS . "views" . DS . "templates" . DS . $this->router()->template() . ".php";

  }

    public function set_provider(){
    $name = $this->router()->provider() ?: $this->options('default_provider');
    $providers = $this->options('providers');
    if ($name && array_key_exists($name, $providers)) :
      $this->provider = $providers[$name];
    endif;
    return;
  }

  public function provider($key = 'url'){
    return $this->provider[$key];
  }

  public function set_name(){
    $this->name = $this->router()->name();
  }

  public function set_language() {
    $language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    switch ($language){
      case "fr":
        $this->language = "fr";
        return "fr";
        break;

      default:
        $this->language = "en";
        return "en";
        break;
    }
  }

  public function language()
  {
    return $this->language;
  }

  public function set_mode() {
    if (!isset($_SESSION['mode'])) {
      $_SESSION['mode'] = 'read';
    }
    if(isset($_GET['mode'])):
      if($_GET['mode'] == "write") :
        $_SESSION['mode'] = 'write';
      else :
        $_SESSION['mode'] = 'read';
      endif;
      // redirect to same page without url parameters
      $url = strtok($_SERVER["REQUEST_URI"],'?');
      header('Location: ' . $url );
    endif;
    $this->mode = $_SESSION['mode'];
  }

  public function set_menu(){
    $this->pads()->push('Menu (type: settings visibility: private)');
    $pad = $this->pads()->find('Menu');
    $menu = array_values(array_filter(preg_split('/\r\n|\r|\n/', $pad->txt())));
    $menu = array_map('trim', $menu);
    // if menu is filled with default text, make it empty
    if(count($menu)):
      if( strpos($menu[0], $this->provider('default_text')) === 0 ) :
        $menu = array();
      endif;
    endif;
    $this->menu = $menu;
  }

  public function set_pads(){
    $this->pads->push($this->menu);
    // find the requested pad or else the first of the menu list
    $pad = $this->router()->pad() ?: $this->pads->first();
    // select requested pad
    if ($pad):
      $pad->select();
    endif;
  }

  public function router(){
    // Router
    return $this->router;
  }

  public function name() {
    return $this->name;
  }

  public function pads() {
    return $this->pads;
  }

  public function mode(){
    return $this->mode;
  }

  public function options($key){
    if(array_key_exists($key, $this->options)):
      return $this->options[$key];
    endif;
    return;
  }

  public function export(){

    $title = $this->name();
    $introduction = $this->pads()->find('about')->html();

    $pads = $this->pads()->children();
    $chapters = array();
    foreach($pads as $pad) :
      $chapter = $pad->name();
      $html = $pad->html();
      $chapters[] = array("title" => $chapter, "html" => $html);
    endforeach;

    $odt = new \CatoTH\HTML2OpenDocument\Text();
    $odt->addHtmlTextBlock('<h1>' . $title . '</h1>');
    $odt->addHtmlTextBlock($introduction);
    foreach ($chapters as $chapter) {
      $odt->addHtmlTextBlock('<h2>' . $chapter['title'] . '</h2>');
      $odt->addHtmlTextBlock($chapter['html']);
    }
    $odt->finishAndOutputOdt('libreto-' . $title . '.odt');

  }

}
