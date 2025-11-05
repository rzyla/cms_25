<div class="row">
	<div class="col-12">
		<div class="card">
			<form
				action="<?php echo $provider->content->form_content_url; ?>"
				method="post">
				<?php echo html_token($provider->security->token); ?>
				<div class="card-body">
					<ul class="nav nav-tabs">
                    	<?php foreach($provider->variables->data[consts::$data_modules] as $module): ?>
                    		<li class="nav-item">
                    			<?php if($provider->variables->content_id == $module->content_id): ?>
                            		<a class="nav-link active"
							aria-current="page"
							href="<?php echo url_content_content_id($provider, $provider->variables->id, $module->content_id); ?>"><?php echo $module->name; ?></a>
                            	<?php else: ?>
                            		<a class="nav-link"
							href="<?php echo url_content_content_id($provider, $provider->variables->id, $module->content_id); ?>"><?php echo $module->name; ?></a>
                            	<?php endif; ?>
                          	</li>
                    	<?php endforeach; ?>
                    </ul>
                    <?php foreach($provider->variables->data[consts::$data_modules] as $module): ?>
                    	<?php if($provider->variables->content_id == $module->content_id): ?>
                    		<?php include $module->view; ?>
                    	<?php endif; ?>
                    <?php endforeach; ?>
				</div>
				<div class="card-footer">
					<a
						href="<?php echo $provider->route->action(consts::$path_manage, consts::$page_menu, $provider->variables->id); ?>"
						class="btn btn-secondary float-left item-icon-left"><i
						class="bi bi-gear"></i> <?php echo $provider->language->translate("common_button_manage"); ?></a>
					<button type="submit"
						class="btn btn-primary float-right item-icon-left">
						<i class="bi bi-floppy"></i> <?php echo $provider->language->translate("common_submit_save"); ?>
					</button>
					<div class="clear"></div>
				</div>
			</form>
		</div>
	</div>
</div>