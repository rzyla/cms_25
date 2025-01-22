<div class="configuration-header"><?php echo $provider->language->translate("page_configuration_edit_meta_tags_header"); ?></div>
<div class="configuration-body">
	<div class="mb-3">
		<label for="meta_tags-title" class="form-label"><?php echo $provider->language->translate("page_configuration_edit_meta_tags_title"); ?></label>
		<input type="text" class="form-control"
			name="configuration[meta_tags][title]"
			value="<?php echo $module->data('title'); ?>">
	</div>
	<div class="mb-3">
		<label for="meta_tags-description" class="form-label"><?php echo $provider->language->translate("page_configuration_edit_meta_tags_description"); ?></label>
		<textarea class="form-control"
			name="configuration[meta_tags][description]"><?php echo $module->data('description'); ?></textarea>
	</div>
	<div class="mb-3">
		<label for="meta_tags-key_words" class="form-label"><?php echo $provider->language->translate("page_configuration_edit_meta_tags_key_words"); ?></label>
		<input type="text" class="form-control"
			name="configuration[meta_tags][key_words]"
			value="<?php echo $module->data('key_words'); ?>">
	</div>
</div>
<div class="configuration-footer"></div>