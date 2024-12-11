<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
               <table class="table table-bordered">
               		<?php if(count($provider->grid->headers) > 0): ?>
                    	<thead>
							<tr>
								<?php foreach($provider->grid->headers as $header): ?>
									<th><?php echo $header; ?></th>
                                <?php endforeach; ?>
                                <?php if($provider->grid->position == true): ?>
                                	<th></th>
                                <?php endif; ?>
                                <?php if($provider->grid->edit == true || $provider->grid->delete == true || $provider->grid->active == true): ?>
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
                                	<?php if($provider->grid->position == true): ?>
                                		<td></td>
                                	<?php endif; ?>
                                	<?php if($provider->grid->edit == true || $provider->grid->delete == true || $provider->grid->active == true): ?>
                                		<td>
                                			<?php if($provider->grid->active == true): ?>
                                				<?php if(array_key_exists(consts::$fields_active, $item)): ?>
                                					<?php if($item[consts::$fields_active] == consts::$value_activate): ?>
                                						<a href="<?php echo $provider->route->deactivate($provider->variables->page, $item[consts::$fields_id]); ?>"><?php echo $provider->language->translate('common_button_deactivate'); ?></a>
                                					<?php else: ?>
                                						<a href="<?php echo $provider->route->activate($provider->variables->page, $item[consts::$fields_id]); ?>"><?php echo $provider->language->translate('common_button_activate'); ?></a>
                                					<?php endif; ?>
                                				<?php endif; ?>
                                			<?php endif; ?>
                                			<?php if($provider->grid->edit == true): ?>
                                				<a href="<?php echo $provider->route->edit($provider->variables->page, $item[consts::$fields_id]); ?>"><?php echo $provider->language->translate('common_button_edit') ?></a>
                                			<?php endif; ?>
                                			<?php if($provider->grid->delete == true): ?>
                                				<a href="<?php echo $provider->route->delete($provider->variables->page, $item[consts::$fields_id]); ?>"><?php echo $provider->language->translate('common_button_delete') ?></a>
                                			<?php endif; ?>
                                		</td>
                                	<?php endif; ?>
								</tr>
							<?php endforeach; ?>
						</tbody>
					<?php endif; ?>
            	</table>
			</div>
		</div>
	</div>
</div>