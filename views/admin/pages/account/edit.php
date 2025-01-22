<div class="row">
	<div class="col-12">
		<div class="card">
			<form
				action="<?php echo $provider->route->update(consts::$page_account, $provider->user->id); ?>"
				method="post" enctype="multipart/form-data">
				<?php echo html_token($provider->security->token); ?>
				<div class="card-body">
					<div class="mb-3">
						<label for="login" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_account . "_edit_login"); ?></label>
						<input type="text" class="form-control" name="login"
							value="<?php echo $provider->variables->data[consts::$data_entity]['login']; ?>"
							disabled>
					</div>
					<div class="mb-3">
						<label for="exampleInputPassword1" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_account . "_edit_password"); ?></label>
						<input type="password" class="form-control" name="password"
							value="<?php echo $provider->variables->post('password'); ?>">
						<div class="form-text"><?php echo $provider->language->translate("page_" . consts::$page_account . "_edit_password_text"); ?></div>
					</div>
					<div class="mb-3">
						<label for="name" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_account . "_edit_name"); ?></label>
						<?php if(!empty($provider->variables->post('login'))): ?>
							<input type="text" class="form-control" name="name"
							value="<?php echo $provider->variables->post('name'); ?>">
						<?php else: ?>
							<input type="text" class="form-control" name="name"
							value="<?php echo $provider->variables->data[consts::$data_entity]['name']; ?>">
						<?php endif; ?>
					</div>

					<div>
						<label for="active" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_account . "_edit_avatar"); ?></label>
					</div>
					<div class="input-group mb-3">
						<input type="file" class="form-control" id="avatar" name="avatar">
					</div>

					<div class="mb-3">
						<label for="active" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_account . "_edit_active"); ?></label>
						<?php foreach($provider->dictionary->active() as $key => $value): ?>
							<?php if(($provider->variables->post('active') != "" && $provider->variables->post('active') == $key) || ($provider->variables->post('active') == "" && $provider->variables->data[consts::$data_entity]['active'] == $key)): ?>
								<input type="text" class="form-control" name="active"
							value="<?php echo $value; ?>" disabled>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
					<div class="mb-3">
						<label for="acl" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_account . "_edit_acl"); ?></label>
						<?php foreach($provider->dictionary->acl() as $key => $value): ?>
							<?php if(($provider->variables->post('acl') != "" && $provider->variables->post('acl') == $key) || ($provider->variables->post('acl') == "" && $provider->variables->data[consts::$data_entity]['acl'] == $key)): ?>
								<input type="text" class="form-control" name="acl"
							value="<?php echo $value; ?>" disabled>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
					<div class="mb-3">
						<label for="created" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_account . "_edit_created"); ?></label>
						<input type="text" class="form-control" name="created"
							value="<?php echo $provider->variables->data[consts::$data_entity]['created']; ?>"
							disabled>
					</div>
					<div class="mb-3">
						<label for="modified" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_account . "_edit_modified"); ?></label>
						<input type="text" class="form-control" name="modified"
							value="<?php echo $provider->variables->data[consts::$data_entity]['modified']; ?>"
							disabled>
					</div>
				</div>
				<div class="card-footer text-right">
					<button type="submit" class="btn btn-primary"><?php echo $provider->language->translate("common_submit_save"); ?></button>
				</div>
			</form>
		</div>
	</div>
</div>