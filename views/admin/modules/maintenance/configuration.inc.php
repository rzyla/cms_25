<div class="configuration-header"><?php echo $provider->language->translate("page_configuration_edit_maintenance_header"); ?></div>
<div class="configuration-body">
	<div class="mb-3">
		<div class="form-check">
			<input class="form-check-input" type="checkbox" value="1"
				id="maintenance-active" name="configuration[maintenance][active]"
				<?php if($module->data('active') == '1'):?> checked <?php endif; ?>>
			<label class="form-check-label" for="maintenance-active"><?php echo $provider->language->translate("page_configuration_edit_maintenance_active"); ?></label>
		</div>
	</div>
	<div class="mb-3">
		<label for="maintenance-html" class="form-label"><?php echo $provider->language->translate("page_configuration_edit_maintenance_html"); ?></label>
		<textarea class="form-control" name="configuration[maintenance][html]"><?php echo $module->data('html'); ?></textarea>
	</div>
</div>
<div class="configuration-footer"></div>