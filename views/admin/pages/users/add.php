<div class="row">
	<div class="col-12">
		<div class="card">
			<form action="<?php echo $provider->route->insert(consts::$page_users); ?>" method="post">
				<div class="card-body">
					<div class="mb-3">
						<label for="login" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_users . "_edit_login"); ?></label>
						<input type="text" class="form-control" name="login" value="<?php echo $provider->variables->post('login'); ?>">
					</div>
					<div class="mb-3">
						<label for="exampleInputPassword1" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_users . "_edit_password"); ?></label>
						<input type="password" class="form-control" name="password" value="<?php echo $provider->variables->post('password'); ?>">
					</div>
					<div class="mb-3">
						<label for="name" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_users . "_edit_name"); ?></label>
						<input type="text" class="form-control" name="name" value="<?php echo $provider->variables->post('name'); ?>">
					</div>
					<div class="mb-3">
						<label for="active" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_users . "_edit_active"); ?></label>
						<select class="custom-select" name="active">
							<?php foreach($provider->dictionary->active() as $key => $value): ?>
								<?php if($provider->variables->post('active') == $key): ?>
									<option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
								<?php else: ?>
									<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="mb-3">
						<label for="acl" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_users . "_edit_acl"); ?></label>
						<select class="custom-select" name="acl">
							<?php foreach($provider->dictionary->acl() as $key => $value): ?>
								<?php if($provider->variables->post('acl') == $key): ?>
									<option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
								<?php else: ?>
									<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="card-footer text-right">
					<button type="submit" class="btn btn-primary"><?php echo $provider->language->translate("common_submit_save"); ?></button>
				</div>
			</form>
		</div>
	</div>
</div>