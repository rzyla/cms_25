<?php require 'views/admin/layout/default/partials/menu_breadcrumb.inc.php'; ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<form
				action="<?php echo $provider->route->insert(consts::$page_menu, $provider->variables->id); ?>"
				method="post">
				<?php echo html_token($provider->security->token); ?>
				<div class="card-body">
					<div class="mb-3">
						<label for="name" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_menu . "_edit_name"); ?></label>
						<input type="text" class="form-control" name="name"
							value="<?php echo $provider->variables->html_value(consts::$data_entity, 'name'); ?>">
					</div>
					<?php if($provider->variables->id == 0 ): ?>
					<div class="mb-3">
						<label for="symbol" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_menu . "_edit_symbol"); ?></label>
						<input type="text"
							class="form-control <?php if(!empty($provider->variables->errors['symbol'])): ?>error<?php endif; ?>"
							name="symbol"
							value="<?php echo $provider->variables->html_value(consts::$data_entity, 'symbol'); ?>">
						<?php if(!empty($provider->variables->errors['symbol'])): ?>
							<div class="form-error"><?php echo $provider->variables->errors['symbol']; ?></div>
						<?php endif; ?>
					</div>
					<?php endif; ?>
					<div class="mb-3 jq-menu-url <?php if(intval($provider->variables->html_value(consts::$data_entity, 'type')) == 9): ?>display-none<?php endif?>">
						<label for="url" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_menu . "_edit_url"); ?></label>
						<input type="text"
							class="form-control <?php if(!empty($provider->variables->errors['url'])): ?>error<?php endif; ?>"
							name="url"
							value="<?php echo $provider->variables->html_value(consts::$data_entity, 'url'); ?>">
						<?php if(!empty($provider->variables->errors['url'])): ?>
							<div class="form-error"><?php echo $provider->variables->errors['url']; ?></div>
						<?php endif; ?>
					</div>
					<div class="mb-3">
						<label for="type" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_menu . "_edit_type"); ?></label>
						<select class="form-select jq-menu-type" name="type">
							<?php foreach($provider->dictionary->menu() as $key => $value): ?>
								<?php if($provider->variables->id == 0 && ($key != consts::$value_menu_parent)) { continue; } ?>
								<?php if($provider->variables->html_value(consts::$data_entity, 'type') == $key): ?>
									<option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
								<?php else: ?>
									<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="mb-3 jq-menu-link <?php if(intval($provider->variables->html_value(consts::$data_entity, 'type')) != 9): ?>display-none<?php endif?>">
						<label for="name" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_menu . "_edit_link"); ?></label>
						<input type="text" class="form-control" name="link"
							value="<?php echo $provider->variables->html_value(consts::$data_entity, 'url'); ?>">
					</div>
					<div class="mb-3">
						<label for="target" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_menu . "_edit_target"); ?></label>
						<select class="form-select" name="target">
							<?php foreach($provider->dictionary->target() as $key => $value): ?>
								<?php if($provider->variables->id == 0 && $key == consts::$value_target_blank) { continue; } ?>
								<?php if($provider->variables->html_value(consts::$data_entity, 'target') == $key): ?>
									<option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
								<?php else: ?>
									<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="mb-3">
						<label for="active" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_menu . "_edit_active"); ?></label>
						<select class="form-select" name="active">
							<?php foreach($provider->dictionary->active() as $key => $value): ?>
								<?php if($provider->variables->id == 0 && $key == consts::$value_deactivate) { continue; } ?>
								<?php if($provider->variables->html_value(consts::$data_entity, 'active') == $key): ?>
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