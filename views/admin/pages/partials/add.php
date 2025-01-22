<div class="row">
	<div class="col-12">
		<div class="card">
			<form
				action="<?php echo $provider->route->insert(consts::$page_partials); ?>"
				method="post">
				<?php echo html_token($provider->security->token); ?>
				<div class="card-body">
					<div class="mb-3">
						<label for="name" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_partials . "_edit_name"); ?></label>
						<input type="text"
							class="form-control <?php if(!empty($provider->variables->errors['name'])): ?>error<?php endif;?>"
							name="name"
							value="<?php echo $provider->variables->post('name'); ?>">
						<?php if(!empty($provider->variables->errors['name'])): ?>
						<div class="form-error"><?php echo $provider->variables->errors['name']; ?></div>
						<?php endif; ?>
					</div>
					<div class="mb-3">
						<label for="symbol" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_partials . "_edit_symbol"); ?></label>
						<input type="text"
							class="form-control <?php if(!empty($provider->variables->errors['symbol'])): ?>error<?php endif;?>"
							name="symbol"
							value="<?php echo $provider->variables->post('symbol'); ?>">
						<?php if(!empty($provider->variables->errors['symbol'])): ?>
						<div class="form-error"><?php echo $provider->variables->errors['symbol']; ?></div>
						<?php endif; ?>
					</div>
					<div class="mb-3">
						<label for="module_id" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_partials . "_edit_module"); ?></label>
						<select class="form-select" name="module_id">
							<?php foreach($provider->variables->data[consts::$data_modules] as $key => $value): ?>
								<?php if($provider->variables->post('module_id') == $key): ?>
									<option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
								<?php else: ?>
									<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="card-footer">
					<?php require 'views/admin/layout/default/partials/add_edit_buttons.inc.php'; ?>
				</div>
			</form>
		</div>
	</div>
</div>