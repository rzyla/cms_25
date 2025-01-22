<div class="row">
	<div class="col-12">
		<div class="card">
			<form
				action="<?php echo $provider->route->insert(consts::$page_modules); ?>"
				method="post">
				<?php echo html_token($provider->security->token); ?>
				<div class="card-body">
					<div class="mb-3">
						<label for="file" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_modules . "_edit_file"); ?></label>
						<select class="form-select" name="file">
							<?php foreach($provider->variables->data[consts::$data_modules] as $key => $value): ?>
								<?php if($provider->variables->post('file') == $key): ?>
									<option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
								<?php else: ?>
									<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="mb-3">
						<label for="file" class="form-label"><?php echo $provider->language->translate("page_" . consts::$page_modules . "_edit_type"); ?></label>
						<select class="form-select" name="type">
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
								<?php if($provider->variables->post('active') == $key): ?>
									<option value="<?php echo $key; ?>" selected="selected"><?php echo $value; ?></option>
								<?php else: ?>
									<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="card-footer">
					<a href="<?php echo $provider->buttons->back; ?>"
						class="btn btn-secondary float-left item-icon-left"><i
						class="bi bi-arrow-left"></i> <?php echo $provider->language->translate("common_submit_back"); ?></a>
						<?php if(count($provider->variables->data[consts::$data_modules]) > 0): ?>
						<button type="submit"
						class="btn btn-primary float-right item-icon-left">
						<i class="bi bi-floppy"></i> <?php echo $provider->language->translate("common_submit_save"); ?></button>
					<div class="clear"></div>
					<?php endif; ?>
				</div>
			</form>
		</div>
	</div>
</div>