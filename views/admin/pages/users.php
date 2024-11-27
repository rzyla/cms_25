<?php 

require_once 'app/inc/classes/grid.php';

$grid = new grid(true, true, false, false);
$grid->addFields(['header6','header5']);
$grid->addHeaders(['header1','header2']);
$grid->addItems([['header6' => 'aa', 'header5' => 'bb'],['header6' => 'dd', 'header5' => 'ee']]);

$app['grid'] = $grid->getGrid();

require_once 'views/inc/grid.ind.php';
?>