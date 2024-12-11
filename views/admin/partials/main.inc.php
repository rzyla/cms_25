<main class="app-main">
	<?php if($provider->layout->title != "" || count($provider->layout->breadcrumb->items) > 0): ?>
	<div class="app-content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
    					<h3 class="mb-0">
    						<?php if($provider->layout->title != ""): ?>
            					<?php echo $provider->layout->title; ?>
            					<?php if($provider->buttons->add): ?>
            						<a href="<?php echo $provider->route->add($provider->variables->page); ?>" class="button-item button-add"><i class="bi bi-plus-lg"></i></a>
            					<?php endif; ?>
            					<?php if($provider->buttons->list): ?>
            						<a href="<?php echo $provider->route->index($provider->variables->page); ?>" class="button-item button-list"><i class="bi bi-list"></i></a>
            					<?php endif; ?>
        					<?php endif; ?>
    					</h3>
				</div>
				<div class="col-sm-6">
					<?php if(count($provider->layout->breadcrumb->items) > 0): ?>
    					<ol class="breadcrumb float-sm-end">
    						<?php foreach($provider->layout->breadcrumb->items as $item): ?>
    							 <?php if($item->url == null): ?>
    							 	<li class="breadcrumb-item active" aria-current="page"><?php echo $item->value; ?></li>
    							 <?php else: ?>
    							 	<li class="breadcrumb-item"><a href="<?php echo $item->url ?>"><?php echo $item->value; ?></a></li>
    							 <?php endif; ?>
    						<?php endforeach; ?>
    					</ol>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<div class="app-content">
		<div class="container-fluid">
			<?php if($provider->message->message != ""): ?>
				<div>
					<?php echo $provider->message->message; ?>
				</div>
			<?php endif; ?>
			<?php require_once $provider->variables->view; ?>
		</div>
	</div>
</main>