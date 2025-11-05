<div class="configuration-header"><?php echo $provider->language->translate("page_configuration_edit_contact_header"); ?></div>
<div class="configuration-body">
	<div class="mb-3">
		<label for="form-mail" class="form-label"><?php echo $provider->language->translate("page_configuration_edit_contact_company_first_line"); ?></label>
		<input type="text" class="form-control"
			name="configuration[contact][first_line]" value="<?php echo $module->data('first_line'); ?>">
	</div>
	<div class="mb-3">
		<label for="form-mail" class="form-label"><?php echo $provider->language->translate("page_configuration_edit_contact_company_second_line"); ?></label>
		<input type="text" class="form-control"
			name="configuration[contact][second_line]" value="<?php echo $module->data('second_line'); ?>">
	</div>
	<div class="mb-3">
		<label for="form-mail" class="form-label"><?php echo $provider->language->translate("page_configuration_edit_contact_person_name"); ?></label>
		<input type="text" class="form-control"
			name="configuration[contact][person_name]" value="<?php echo $module->data('person_name'); ?>">
	</div>
	<div class="mb-3">
		<label for="form-mail" class="form-label"><?php echo $provider->language->translate("page_configuration_edit_contact_person_phone"); ?></label>
		<input type="text" class="form-control"
			name="configuration[contact][person_phone]" value="<?php echo $module->data('person_phone'); ?>">
	</div>
	<div class="mb-3">
		<label for="form-mail" class="form-label"><?php echo $provider->language->translate("page_configuration_edit_contact_person_mail"); ?></label>
		<input type="text" class="form-control"
			name="configuration[contact][person_mail]" value="<?php echo $module->data('person_mail'); ?>">
	</div>
</div>
<div class="configuration-footer"></div>