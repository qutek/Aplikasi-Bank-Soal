<?php  

// Regenerate array to multidimention based parent
function createMenu($arr_menu, $args = array() ){
    krsort($arr_menu);
      foreach ($arr_menu as $k => &$item) {
        if (!empty($item['parent'])) {
          $parent = $item['parent'];
          if (empty($arr_menu[$parent]['childs'])) {
            $arr_menu[$parent]['childs'] = array();
          }
          //2
          array_unshift($arr_menu[$parent]['childs'],$item);
          unset($arr_menu[$k]);
        }
      }
      //3
    ksort($arr_menu);

    // echo "<pre>";
    // print_r($arr_menu);
    // echo "</pre>";
    // exit();

    buildMenu($arr_menu, $args);

}

// build menu from multidimention array
function buildMenu($array, $args = array(), $has_parent = false ) {
  // extract($args);

  if($has_parent){
    echo '<ul class="sub">';
  } else {
    echo '<ul class="'.$args['menu_class'].'" id="'.$args['menu_id'].'">';
  }

  foreach ($array as $item) {
    $li_class = (!empty($item['childs'])) ? 'sub-menu' : '';

    echo '<li class="'.$li_class.'"><a href="'.$item['link'].'"><i class="fa '.$item['icon'].'"></i> <span>'.$item['title'].'</span>';
    if (!empty($item['childs'])) {
        // close <a> tag before create new ul
        echo "</a>";
        buildMenu($item['childs'], array('menu_class' => '', 'menu_id', ''), true );
    }
    echo '</a></li>';
  }
  echo '</ul>';
}

function get_level_name($level){
  switch ($level) {
    case '1':
      return 'Administator';
      break;
    
    case '2':
      return 'Guru';
      break;
    
    case '3':
      return 'Siswa';
      break;
    
    default:
      return false;
      break;
  }

}

function check_selected($val, $current){
  if ($val == $current)
    echo 'selected="selected"';

  return;
}

function is_can_access($levels){
  session_start();

  $can_access = false;

  if(is_array($levels)){
    foreach ($levels as $level) {
      if(isset($_SESSION[$level]))
        $can_access = true;
    }
  } else {
    if(isset($_SESSION[$level]))
        $can_access = true;
  }

  // if user can't access this page, redirect please
  if(!$can_access){
    echo '<script language="javascript">alert("Silahkan Login Terlebih Dahulu!"); document.location="login.php";</script>';
    return false;
  }

  return true;
}

?>