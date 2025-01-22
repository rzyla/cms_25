<div class="login-box">
	<div class="login-logo">
		<a href="<?php echo consts::$arteh_url; ?>" target="_blank"><b><?php echo $provider->language->translate("common_arteh_upper"); ?></b><?php echo $provider->language->translate("common_cms_upper"); ?></a>
	</div>
		<?php require_once $path . 'views/admin/layout/default/partials/message.inc.php'; ?>
		<div class="card">
		<div class="card-body login-card-body">
			<p class="login-box-msg"><?php echo $provider->language->translate("page_login_lead"); ?></p>
			<form action="<?php echo $provider->route->login() ?>" method="post">
					<?php echo html_token($provider->security->token); ?>
					<div class="input-group mb-3">
					<input type="login" name="login"
						class="form-control <?php if(!empty($provider->variables->errors['login'])): ?>error<?php endif; ?>"
						placeholder="<?php echo $provider->language->translate("page_login_placeholder_login"); ?>">
					<div class="input-group-text">
						<span class="bi bi-person-fill"></span>
					</div>
				</div>
				<div class="input-group mb-3">
					<input type="password" name="password"
						class="form-control <?php if(!empty($provider->variables->errors['password'])): ?>error<?php endif; ?>"
						placeholder="<?php echo $provider->language->translate("page_login_placeholder_password"); ?>">
					<div class="input-group-text">
						<span class="bi bi-lock-fill"></span>
					</div>
				</div>
				<div class="row">
					<div class="col-8"></div>
					<div class="col-4">
						<div class="d-grid gap-2">
							<button type="submit" class="btn btn-primary"><?php echo $provider->language->translate("page_login_button_submit"); ?></button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>