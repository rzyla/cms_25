<div class="row">
	<div class="col-12">
		<div class="card">
			<form
				action="<?php echo $provider->route->update(consts::$page_modules, $provider->variables->id); ?>"
				method="post">
				<?php echo html_token($provider->security->token); ?>
				<div class="card-body">
					<div class="mb-3">
						<label for="name" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_modules . "_edit_name"); ?></label>
						<input type="text" class="form-control" name="name"
							value="<?php echo $provider->dictionary->modules()[$provider->variables->data[consts::$data_entity]['file']]; ?>"
							disabled>
					</div>
					<div class="mb-3">
						<label for="file" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_modules . "_edit_file"); ?></label>
						<input type="text" class="form-control" name="file"
							value="<?php echo $provider->variables->data[consts::$data_entity]['file']; ?>"
							disabled>
					</div>
					<div class="mb-3">
						<label for="file" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_modules . "_edit_type"); ?></label>
						<select class="form-select" name="type" disabled>
							<?php foreach($provider->variables->data[consts::$data_types] as $key => $value): ?>
								<?php if($provider->variables->post('type') == $key): ?>
									<option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
								<?php else: ?>
									<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="mb-3">
						<label for="active" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_modules . "_edit_active"); ?></label>
						<select class="form-select" name="active">
							<?php foreach($provider->dictionary->active() as $key => $value): ?>
								<?php if(($provider->variables->post('active') != "" && $provider->variables->post('active') == $key) || ($provider->variables->post('active') == "" && $provider->variables->data[consts::$data_entity]['active'] == $key)): ?>
									<option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
								<?php else: ?>
									<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="mb-3">
						<label for="created" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_modules . "_edit_created"); ?></label>
						<input type="text" class="form-control" name="created"
							value="<?php echo $provider->variables->data[consts::$data_entity]['created']; ?>"
							disabled>
					</div>
					<div class="mb-3">
						<label for="modified" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_modules . "_edit_modified"); ?></label>
						<input type="text" class="form-control" name="modified"
							value="<?php echo $provider->variables->data[consts::$data_entity]['modified']; ?>"
							disabled>
					</div>
				</div>
				<div class="card-footer">
					<?php require 'views/admin/layout/default/partials/add_edit_buttons.inc.php'; ?>
				</div>
			</form>
		</div>
	</div>
</div>