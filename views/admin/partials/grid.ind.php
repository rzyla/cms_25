<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
               <table class="table table-bordered">
               		<?php if(!empty($app['grid']['headers'])): ?>
                    	<thead>
							<tr>
								<?php foreach($app['grid']['headers'] as $header): ?>
									<th><?php echo $header; ?></th>
                                <?php endforeach; ?>
                                <?php if(!empty($app['grid']['position'])): ?>
                                	<th></th>
                                <?php endif; ?>
                                <?php if(!empty($app['grid']['edit']) || !empty($app['grid']['delete']) || !empty($app['grid']['active'])): ?>
                                	<th></th>
                                <?php endif; ?>
                        	</tr>
                    	</thead>
                    <?php endif; ?>
                    <?php if(!empty($app['grid']['items'])): ?>
						<tbody>
							<?php if(!empty($app['grid']['items'])): ?>
								<?php foreach($app['grid']['items'] as $item): ?>
									<tr class="align-middle">
										<?php foreach($app['grid']['fields'] as $field): ?>
                                			<td><?php echo $item[$field]; ?></td>
                                		<?php endforeach; ?>
                                		<?php if(!empty($app['grid']['position'])): ?>
                                			<td></td>
                                		<?php endif; ?>
                                		<?php if(!empty($app['grid']['edit']) || !empty($app['grid']['delete']) || !empty($app['grid']['active'])): ?>
                                			<td>
                                				<?php if(!empty($app['grid']['active'])): ?>
                                					<?php if(array_key_exists('active', $item)): ?>
                                						<?php if(!empty($item['active'])): ?>
                                							<a href="<?php echo $app['page']; ?>"><?php echo $lang['common_active'] ?></a>
                                						<?php else: ?>
                                							<a href=""><?php echo $lang['common_deactive'] ?></a>
                                						<?php endif; ?>
                                					<?php endif; ?>
                                				<?php endif; ?>
                                				<?php if(!empty($app['grid']['edit'])): ?>
                                					<a href=""><?php echo $lang['common_edit'] ?></a>
                                				<?php endif; ?>
                                				<?php if(!empty($app['grid']['delete'])): ?>
                                					<a href=""><?php echo $lang['common_delete'] ?></a>
                                				<?php endif; ?>
                                			</td>
                                		<?php endif; ?>
									</tr>
								<?php endforeach; ?>
							<?php endif; ?>
						</tbody>
					<?php endif; ?>
            	</table>
			</div>
		</div>
	</div>
</div>