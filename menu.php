<?php  
include 'inc/func.soal.php';
$menu = array(
'menusatu' => array(
        'Menu_IDX' => '1',
        'Order' => '1',
        'name' => 'History',
        'parent' => '',
        'Path' => 'History',
        'Link' => '',
    ),
'1' => array
    (
        'Menu_IDX' => '2',
        'Order' => '25',
        'name' => 'Review',
        'parent' => '',
        'Path' => 'Review',
        'Link' => 'Review',
    ),
'2' => array
    (
        'Menu_IDX' => '3',
        'Order' => '35',
        'name' => 'Past Medical History',
        'parent' => '',
        'Path' => 'Past Medical History',
        'Link' => 'Past Medical History',
    ),
'3' => array
    (
        'Menu_IDX' => '4',
        'Order' => '45',
        'name' => 'Item 1',
        'parent' => '0',
        'Path' => 'Item 1',
        'Link' => 'Item 1',
    ),
'4' => array
    (
        'Menu_IDX' => '5',
        'Order' => '55',
        'name' => 'Item 2',
        'parent' => '0',
        'Path' => 'Item 2',
        'Link' => 'Item 2',
    ),
'5' => array
    (
        'Menu_IDX' => '6',
        'Order' => '65',
        'name' => 'Item 3',
        'parent' => '0',
        'Path' => 'Item 3',
        'Link' => 'Item 3',
    ),
'6' => array
    (
        'Menu_IDX' => '7',
        'Order' => '65',
        'name' => 'Item 31',
        'parent' => 'menusatu',
        'Path' => 'Item 31',
        'Link' => 'Item 31',
    )
);





createMenu($menu);


// echo "<pre>";
//     print_r($menu);
//     echo "</pre>";
?>