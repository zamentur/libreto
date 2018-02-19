<?php
// export
if(isset($_GET['export'])):
  export();
  // redirect to same page without url parameters
  $url = strtok($_SERVER["REQUEST_URI"],'?');
  header('Location: ' . $url );
endif;
