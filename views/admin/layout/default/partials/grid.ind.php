<?php if($provider->grid->actions->position == true): ?>
<form
	action="<?php echo $provider->route->position($provider->variables->page, $provider->variables->id); ?>"
	method="post">
	<?php echo html_token($provider->security->token); ?>
<?php endif; ?>
    <div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<table class="table table-last-no-border">
                   		<?php if(count($provider->grid->headers) > 0): ?>
                        	<thead>
							<tr>
    								<?php foreach($provider->grid->headers as $header): ?>
    									<th><?php echo $header; ?></th>
                                    <?php endforeach; ?>
                                    <?php if($provider->grid->actions->position == true): ?>
                                    	<th
									class="text-center jq-grid-toggle display-none">
                                    		<?php echo $provider->language->translate('common_header_position'); ?>
                                    	</th>
                                    <?php endif; ?>
                                    <?php if($provider->grid->actions->edit == true || $provider->grid->actions->delete == true || $provider->grid->actions->active == true || count($provider->grid->actions->custom) > 0): ?>
                                    	<th></th>
                                    <?php endif; ?>
                            	</tr>
						</thead>
                        <?php endif; ?>
                        <?php if(count($provider->grid->items) > 0): ?>
    						<tbody>
    							<?php foreach($provider->grid->items as $item): ?>
    								<tr class="align-middle">
    									<?php foreach($provider->grid->fields as $field): ?>
                                    		<td><?php echo $item[$field]; ?></td>
                                    	<?php endforeach; ?>
                                    	<?php if($provider->grid->actions->position == true): ?>
                                    		<td
									class="text-center jq-grid-toggle display-none"><input
									type="text" class="input-position jq-numeric"
									name="position[<?php echo $item['id']; ?>]"
									value="<?php echo $item['position']; ?>" /></td>
                                    	<?php endif; ?>
                                    	<?php if($provider->grid->actions->edit == true || $provider->grid->actions->delete == true || $provider->grid->actions->active == true || count($provider->grid->actions->custom) > 0): ?>
                                    		<td class="table-actions">
                                    			<?php if(count($provider->grid->actions->custom) > 0): ?>
                                                	<?php if(array_key_exists($item['id'], $provider->grid->actions->custom)): ?>
                                                		<?php foreach($provider->grid->actions->custom[$item['id']] as $action): ?>
                                                				<a
									class="item-icon-left item-icon btn btn-dark btn-sm"
									href="<?php echo $action->url; ?>"><i
										class="bi <?php echo $action->icon; ?>"></i> <?php echo $action->value; ?></a>
                                                		<?php endforeach; ?>
                                                	<?php endif; ?>
                                                <?php endif; ?>
                                    			<?php if($provider->grid->actions->active == true): ?>
                                    				<?php if(array_key_exists(consts::$fields_active, $item)): ?>
                                    					<?php if($item[consts::$fields_active] == consts::$value_activate): ?>
                                    						<a
									class="item-icon-left item-icon btn btn-secondary btn-sm"
									href="<?php echo $provider->route->deactivate($provider->variables->page, $item[consts::$fields_id], $provider->variables->id); ?>"><i
										class="bi bi-eye-slash"></i> <?php echo $provider->language->translate('common_button_deactivate'); ?></a>
                                    					<?php else: ?>
                                    						<a
									class="item-icon-left item-icon btn btn-secondary btn-sm"
									href="<?php echo $provider->route->activate($provider->variables->page, $item[consts::$fields_id], $provider->variables->id); ?>"><i
										class="bi bi-eye"></i> <?php echo $provider->language->translate('common_button_activate'); ?></a>
                                    					<?php endif; ?>
                                    				<?php endif; ?>
                                    			<?php endif; ?>
                                    			<?php if($provider->grid->actions->edit == true): ?>
                                    				<a
									class="item-icon-left item-icon btn btn-primary btn-sm"
									href="<?php echo $provider->route->edit($provider->variables->page, $item[consts::$fields_id], $provider->variables->id); ?>"><i
										class="bi bi-pencil"></i> <?php echo $provider->language->translate('common_button_edit') ?></a>
                                    			<?php endif; ?>
                                    			<?php if($provider->grid->actions->delete == true): ?>
                                    				<a
									class="jq-alert item-icon-left item-icon btn btn-danger btn-sm"
									jq-alert-title="<?php echo $provider->language->translate('alert_title_delete_emelent') ?>"
									href="<?php echo $provider->route->delete($provider->variables->page, $item[consts::$fields_id], $provider->variables->id); ?>"><i
										class="bi bi-trash"></i> <?php echo $provider->language->translate('common_button_delete') ?></a>
                                    			<?php endif; ?>
                                    		</td>
                                    	<?php endif; ?>
    								</tr>
    							<?php endforeach; ?>
    						</tbody>
    					<?php endif; ?>
    					<tfoot class="jq-grid-toggle display-none">
							<tr class="no-border">
    							<?php foreach($provider->grid->headers as $header): ?>
    								<td class="no-border"></td>
                                <?php endforeach; ?>
                                <?php if($provider->grid->actions->position == true): ?>
                                	<th
									class="relative text-center no-border "><a href="#"
									class="btn btn-primary item-icon-left item-icon btn btn-primary btn-sm jq-closest-form-submit"><i
										class="bi bi-arrow-down-up"></i> <?php echo $provider->language->translate('common_submit_save'); ?></a>
								</th>
                                <?php endif; ?>
                                <?php if($provider->grid->actions->edit == true || $provider->grid->actions->delete == true || $provider->grid->actions->active == true || count($provider->grid->actions->custom) > 0): ?>
                                	<td class="no-border"></td>
                                <?php endif; ?>
    						</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
<?php if($provider->grid->actions->position == true): ?>
	</form>
<?php endif; ?>