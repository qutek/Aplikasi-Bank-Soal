<?php  

function menuAvailable($menu){
  $available = array('dashboard');

  return $menu;
}

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

    // filter menu by user role
    $av_menu = menuAvailable($arr_menu);
    foreach ($arr_menu as $key => $value) {
        if(in_array($key, $av_menu))
          unset($arr_menu[$key]);
    }

    // echo "<pre>";
    // print_r($av_menu);
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

  if(!empty($_SESSION['level'])){
    if(is_array($levels)){
      foreach ($levels as $level) {
          if($level == $_SESSION['level'])
            $can_access = true;
      }
    } else {
      // echo $levels; exit();
        if($levels == $_SESSION['level'])
            $can_access = true;
    }
  }

  // echo (is_array($levels)) ? 'array' : 'gak'; exit();


  // if user can't access this page, redirect please
  if(!$can_access){
    header('location:login.php');
    // echo '<script language="javascript">alert("Silahkan Login Terlebih Dahulu!"); document.location="login.php";</script>';
    return false;
  }

  return true;
}

function get_userdata($user_id=''){
  
  $db = new Database();
  $db->connect();

  $where = (!empty($user_id)) ? 'id='.$user_id : '';

  $db->select('users', '*', '', $where);
  $res = $db->getResult();

  return $res;
}

function get_mapel(){
  
  $db = new Database();
  $db->connect();

  $db->select('mapel');
  $res = $db->getResult();

  return $res;
}

function get_kelas(){
  
  $db = new Database();
  $db->connect();

  $db->select('kelas');
  $res = $db->getResult();

  return $res;
}

function get_kelas_name($id=''){
  
  $db = new Database();
  $db->connect();

  $res = '';
  if($id != ''){
    $db->select('kelas', 'kelas', '', 'id='.$id);
    $result = $db->getResult();
    $res = $result[0]['kelas'];
  }
  return $res;
}

function get_mapel_name($id=''){
  
  $db = new Database();
  $db->connect();

  $res = '';
  if($id != ''){
    $db->select('mapel', 'mapel', '', 'id='.$id);
    $result = $db->getResult();
    $res = $result[0]['mapel'];
  }
  return $res;
}

function filter_by_value($array, $index, $value){ 
    if(is_array($array) && count($array)>0)  
    { 
        foreach(array_keys($array) as $key){ 
            $temp[$key] = $array[$key][$index]; 
             
            if ($temp[$key] == $value){ 
                $newarray[$key] = $array[$key]; 
            } 
        } 
      } 
  return $newarray; 
} 

?>