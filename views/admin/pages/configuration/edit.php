<div class="row">
	<div class="col-12">
		<div class="card">
			<form
				action="<?php echo $provider->route->update(consts::$page_configuration, 0); ?>"
				method="post">
				<?php echo html_token($provider->security->token); ?>
				<div class="card-body">
					<div class="card-body-slim-title"><?php echo $provider->language->translate("page_configuration_edit_modules_header"); ?></div>
				<?php
    foreach($provider->variables->data[consts::$data_modules] as $module)
    {
        if (file_exists($module->view))
        {
            include ($module->view);
        }
    }
    ?>
    			
    
				</div>
				<div class="card-footer text-right">
					<button type="submit"
						class="btn btn-primary float-right item-icon-left">
						<i class="bi bi-floppy"></i> <?php echo $provider->language->translate("common_submit_save"); ?></button>
				</div>
			</form>
		</div>
	</div>
</div>