<div class="mb-3">
	<label for="meta_tags-title" class="form-label"><?php echo $provider->language->translate("page_content_module_meta_tags_title"); ?></label>
	<input type="text" class="form-control"
		name="content[meta_tags][title]"
		value="<?php echo $module->data('title'); ?>">
</div>
<div class="mb-3">
	<label for="meta_tags-description" class="form-label"><?php echo $provider->language->translate("page_content_module_meta_tags_description"); ?></label>
	<textarea class="form-control froala_editor" name="content[meta_tags][description]"><?php echo $module->data('description'); ?></textarea>
</div>