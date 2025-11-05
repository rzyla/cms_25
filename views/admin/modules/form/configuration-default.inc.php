<div class="configuration-header"><?php echo $provider->language->translate("page_configuration_edit_form_header"); ?></div>
<div class="configuration-body">
	<div class="mb-3">
		<label for="form-mail" class="form-label"><?php echo $provider->language->translate("page_configuration_edit_form_mail"); ?></label>
		<input type="text" class="form-control"
			name="configuration[form][mail]"
			value="<?php echo $module->data('mail'); ?>">
	</div>
</div>
<div class="configuration-footer"></div>