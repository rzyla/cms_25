<div class="menu-breadcrumb">
    <?php foreach($provider->variables->data[consts::$menu_breadcrumb] as $breadcrumb): ?>
    	<?php if($breadcrumb['parent_id'] == 0): ?>
    		<a href="<?php echo $provider->route->index(consts::$page_menu); ?>"><?php echo $breadcrumb['name']; ?></a>
    	<?php else: ?>
    		<a href="<?php echo $provider->route->action(consts::$path_child, consts::$page_menu, $breadcrumb['id']); ?>"><?php echo $breadcrumb['name']?></a>
    	<?php endif; ?>
    	<span class="separator"> / </span>
    <?php endforeach; ?>
    <?php if(array_key_exists('name', $provider->variables->data[consts::$data_entity]))
    {
        echo $provider->variables->data[consts::$data_entity]['name']; 
    }
    ?>
</div>