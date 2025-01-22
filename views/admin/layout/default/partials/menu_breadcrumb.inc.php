<div class="row">
	<div class="col-12">
		<div class="menu-breadcrumb">
			<span class="menu-breadcrumb-home"><?php echo $provider->language->translate("page_menu_edit_parent_id"); ?>: </span>
			<?php if(empty($provider->variables->data[consts::$menu_breadcrumb])): ?>
				<?php if(empty($provider->variables->get_value('name', $provider->variables->data[consts::$data_menu_item]))): ?>
					<?php echo $provider->language->translate("page_menu_edit_parent_id_empty"); ?>
				<?php else: ?>
					<a href="<?php echo url_back($provider, consts::$page_menu, $provider->variables->get_value('id', $provider->variables->data[consts::$data_menu_item]), $provider->variables->get_value('parent_id', $provider->variables->data[consts::$data_menu_item])); ?>"><?php echo $provider->variables->get_value('name', $provider->variables->data[consts::$data_menu_item]); ?></a>
				<?php endif ;?>
			<?php else: ?>
			412
			<?php endif; ?>
		</div>
	</div>
</div>