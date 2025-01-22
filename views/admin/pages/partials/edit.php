<div class="row">
	<div class="col-12">
		<div class="card">
			<form
				action="<?php echo $provider->route->update(consts::$page_partials, $provider->variables->id); ?>"
				method="post">
				<?php echo html_token($provider->security->token); ?>
				<div class="card-body">
					<div class="mb-3">
						<label for="name" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_partials . "_edit_name"); ?></label>
						<?php if(!empty($provider->variables->post('name'))): ?>
							<input type="text" class="form-control" name="name"
							value="<?php echo $provider->variables->post('name'); ?>">
						<?php else: ?>
							<input type="text" class="form-control" name="name"
							value="<?php echo $provider->variables->data[consts::$data_entity]['name']; ?>">
						<?php endif; ?>
						<?php if(!empty($provider->variables->errors['name'])): ?>
						<div class="form-error"><?php echo $provider->variables->errors['name']; ?></div>
						<?php endif; ?>
					</div>
					<div class="mb-3">
						<label for="symbol" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_partials . "_edit_symbol"); ?></label>
						<?php if(!empty($provider->variables->post('symbol'))): ?>
							<input type="text" class="form-control" name="symbol"
							value="<?php echo $provider->variables->post('symbol'); ?>">
						<?php else: ?>
							<input type="text" class="form-control" name="symbol"
							value="<?php echo $provider->variables->data[consts::$data_entity]['symbol']; ?>">
						<?php endif; ?>
						<?php if(!empty($provider->variables->errors['symbol'])): ?>
						<div class="form-error"><?php echo $provider->variables->errors['symbol']; ?></div>
						<?php endif; ?>
					</div>
					<div class="mb-3">
						<label for="module_id" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_partials . "_edit_module"); ?></label>
						<select class="form-select" name="module_id" disabled>
							<?php foreach($provider->variables->data[consts::$data_modules] as $key => $value): ?>
								<?php if($provider->variables->data[consts::$data_entity]['module_id'] == $key): ?>
									<option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
								<?php else: ?>
									<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="mb-3">
						<label for="created" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_users . "_edit_created"); ?></label>
						<input type="text" class="form-control" name="created"
							value="<?php echo $provider->variables->data[consts::$data_entity]['created']; ?>"
							disabled>
					</div>
					<div class="mb-3">
						<label for="modified" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_users . "_edit_modified"); ?></label>
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