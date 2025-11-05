<?php require 'views/admin/layout/default/partials/menu_breadcrumb.inc.php'; ?>
<div class="row">
	<div class="col-12">
		<div class="card">

			<div class="card-body">
				<div class="mb-3">
					<label for="name" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_menu . "_manage_name"); ?></label>
					<input type="text" class="form-control" name="name"
						value="<?php echo $provider->variables->html_value(consts::$data_entity, 'name'); ?>"
						disabled>
				</div>
				<div class="mb-3">
					<form
						action="<?php echo $provider->route->manage_submit(consts::$page_menu, $provider->variables->id); ?>"
						method="post">
				<?php echo html_token($provider->security->token); ?>
						<div class="manage-table-header-border"><?php echo $provider->language->translate("page_" . consts::$page_menu . "_manage_module"); ?></div>
						<div class="row">
							<div class="col-sm-11">
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
							<div class="col-sm-1 text-right padding-left-0">
								<button type="submit" class="btn btn-primary item-icon-left">
									<i class="bi bi-plus-lg"></i> <?php echo $provider->language->translate("common_add"); ?></button>
							</div>
						</div>
					</form>
				</div>

					<?php if(count($provider->variables->data[consts::$data_manage]) > 0): ?>
					<div class="manage-table-header-border"><?php echo $provider->language->translate("page_menu_manage_module_added_to_menu"); ?></div>

				<form
					action="<?php echo $provider->route->manage_position(consts::$page_menu, $provider->variables->id); ?>"
					method="post" class="jq-form-manage-position">

					<?php foreach($provider->variables->data[consts::$data_manage] as $value): ?>
						<div class="manage-table-item">
						<div class="float-left table-item-padding-top"><?php echo $provider->variables->data[consts::$data_modules][$value['module_id']]?></div>
						<a
							class="float-right item-icon-left item-icon jq-alert btn btn-danger btn-sm"
							jq-alert-title="<?php echo $provider->language->translate('alert_title_delete_module'); ?><?php echo $provider->variables->data[consts::$data_modules][$value['module_id']]?>"
							href="<?php echo $provider->route->manage_delete($provider->variables->page,  $provider->variables->id, $value['id']); ?>"><i
							class="bi bi-trash"></i> <?php echo $provider->language->translate('common_button_delete'); ?></a>
						<input type="text" class="form-control float-right form-position"
							name="position[<?php echo $value['id']; ?>]"
							value="<?php echo $value['position']; ?>" />

						<div class="clear"></div>
					</div>
					<?php endforeach; ?>
				</form>
					<?php endif; ?>
			</div>
			<div class="card-footer">
				<a href="<?php echo $provider->buttons->back; ?>"
					class="btn btn-secondary float-left item-icon-left"><i
					class="bi bi-arrow-left"></i> <?php echo $provider->language->translate("common_submit_back"); ?></a>
				<button type="button"
					class="btn btn-primary float-right item-icon-left jq-submit-form"
					data-form-class="jq-form-manage-position">
					<i class="bi bi-arrow-down-up"></i> <?php echo $provider->language->translate("common_submit_save"); ?></button>
				<a href="<?php echo $provider->route->content($provider->variables->id); ?>" class="btn btn-dark float-right item-icon-left margin-right-20"> <i
					class="bi bi-arrow-repeat"></i> <?php echo $provider->language->translate("common_button_update"); ?></a>
					<div class="clear"></div>
			
			</div>
		</div>
	</div>
</div>