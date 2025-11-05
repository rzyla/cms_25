<div class="row">
	<div class="col-12">
		<div class="card">
			<form action="<?php echo $provider->content->form_content_url; ?>"
				method="post">
				<?php echo html_token($provider->security->token); ?>
				<div class="card-body">
					<?php
    $partials = $provider->variables->data[consts::$data_partial];
    $partial = $partials[consts::$data_partial];
    include $partial->view;
    ?>
				</div>
				<div class="card-footer">
					<a
						href="<?php echo $provider->route->edit(consts::$page_partials, $provider->variables->content_id); ?>"
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