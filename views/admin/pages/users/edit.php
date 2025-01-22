<div class="row">
	<div class="col-12">
		<div class="card">
			<form
				action="<?php echo $provider->route->update(consts::$page_users, $provider->variables->id); ?>"
				method="post">
				<?php echo html_token($provider->security->token); ?>
				<div class="card-body">
					<div class="mb-3">
						<label for="login" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_users . "_edit_login"); ?></label>
						<input type="text" class="form-control" name="login"
							value="<?php echo $provider->variables->data[consts::$data_entity]['login']; ?>"
							disabled>
					</div>
					<div class="mb-3">
						<label for="password" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_users . "_edit_password"); ?></label>
						<input type="password" class="form-control" name="password"
							value="<?php echo $provider->variables->post('password'); ?>">
						<div class="form-text"><?php echo $provider->language->translate("page_" . consts::$page_users . "_edit_password_text"); ?></div>
					</div>
					<div class="mb-3">
						<label for="name" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_users . "_edit_name"); ?></label>
						<?php if(!empty($provider->variables->post('name'))): ?>
							<input type="text" class="form-control" name="name"
							value="<?php echo $provider->variables->post('name'); ?>">
						<?php else: ?>
							<input type="text" class="form-control" name="name"
							value="<?php echo $provider->variables->data[consts::$data_entity]['name']; ?>">
						<?php endif; ?>
					</div>
					<div class="mb-3">
						<label for="active" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_users . "_edit_active"); ?></label>
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
						<label for="acl" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_users . "_edit_acl"); ?></label>
						<select class="form-select" name="acl">
							<?php foreach($provider->dictionary->acl() as $key => $value): ?>
								<?php if(!$provider->security->acl(consts::$value_acl_supervisor) && $key == consts::$value_acl_supervisor) continue; ?>
								<?php if(($provider->variables->post('acl') != "" && $provider->variables->post('acl') == $key) || ($provider->variables->post('acl') == "" && $provider->variables->data[consts::$data_entity]['acl'] == $key)): ?>
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