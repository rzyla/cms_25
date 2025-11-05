<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body"><?php echo $provider->language->translate("massage_content_no_module"); ?></div>
			<div class="card-footer">
				<a
					href="<?php echo $provider->route->action(consts::$path_manage, consts::$page_menu, $provider->variables->id); ?>"
					class="btn btn-secondary float-left item-icon-left"><i
					class="bi bi-gear"></i> <?php echo $provider->language->translate("common_button_manage"); ?></a>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>