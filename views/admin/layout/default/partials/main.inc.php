<nav class="app-header navbar navbar-expand bg-body">
	<div class="container-fluid">
		<ul class="navbar-nav">
			<li class="nav-item"><a class="nav-link" data-lte-toggle="sidebar"
				href="#" role="button"> <i class="bi bi-list"></i>
			</a></li>
			<li class="nav-item d-none d-md-block"><a
				href="<?php echo  $provider->route->index(consts::$page_dashboard); ?>"
				class="nav-link"><?php echo $provider->language->translate("container_fluid_dashboard"); ?></a>
			</li>
			<li class="nav-item d-none d-md-block"><a
				href="<?php echo $provider->route->module(consts::$module_contact); ?>"
				class="nav-link"><?php echo $provider->language->translate("container_fluid_contact"); ?></a>
			</li>
		</ul>
		<ul class="navbar-nav ms-auto">
			<li class="nav-item"><a class="nav-link" href="#"
				data-lte-toggle="fullscreen"> <i data-lte-icon="maximize"
					class="bi bi-arrows-fullscreen"></i> <i data-lte-icon="minimize"
					class="bi bi-fullscreen-exit" style="display: none;"></i>
			</a></li>
			<li class="nav-item dropdown user-menu"><a href="#"
				class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> 
				<?php if($provider->user->avatar == ''): ?>
					<img src="/assets/images/avatars-default.jpg"
					class="user-image rounded-circle"
					alt="<?php echo $provider->user->name; ?>">
				<?php else: ?>
					<img
					src="<?php echo $provider->files->path([$provider->config->path_images, consts::$dir_avatars, $provider->user->avatar]); ?>"
					class="user-image rounded-circle"
					alt="<?php echo $provider->user->name; ?>">
				<?php endif; ?>
				 <span class="d-none d-md-inline"><?php echo $provider->user->name; ?></span>
			</a>
				<ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
					<li class="user-header text-bg-primary">
					<?php if($provider->user->avatar == ''): ?>
    					<img src="/assets/images/avatars-default.jpg"
						class="rounded-circle" alt="<?php echo $provider->user->name; ?>">
    				<?php else: ?>
    					<img
						src="<?php echo $provider->files->path([$provider->config->path_images, consts::$dir_avatars, $provider->user->avatar]); ?>"
						class="rounded-circle" alt="<?php echo $provider->user->name; ?>">
    				<?php endif; ?>
						<p>
							<?php echo $provider->user->name; ?>
						</p>
					</li>
					<li class="user-footer"><a
						href="<?php echo $provider->route->index(consts::$page_account); ?>"
						class="btn btn-default btn-flat"><?php echo $provider->language->translate("sidebar_account"); ?></a>
						<a
						href="<?php echo $provider->route->route($provider->route->logout()); ?>"
						class="btn btn-default btn-flat float-end"><?php echo $provider->language->translate("sidebar_logout"); ?></a></li>
				</ul></li>
		</ul>
	</div>
</nav>

<main class="app-main">
	<?php if($provider->layout->title != "" || count($provider->layout->breadcrumb->items) > 0): ?>
	<div class="app-content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h3 class="mb-0">
    						<?php if($provider->layout->title != ""): ?>
            					<?php echo $provider->layout->title; ?>
            					<?php if($provider->buttons->add != ""): ?>
            						<a
							title="<?php echo $provider->language->translate("common_add"); ?>"
							href="<?php echo $provider->buttons->add; ?>"
							class="button-item button-add"><i class="bi bi-plus-square-fill"></i></a>
            					<?php endif; ?>
            					<?php if($provider->buttons->list != ""): ?>
            						<a href="<?php echo $provider->buttons->list; ?>"
							class="button-item button-list"><i class="bi bi-list"></i></a>
            					<?php endif; ?>
            					<?php if($provider->buttons->position): ?>
            						<a
							title="<?php echo $provider->language->translate("common_position_change"); ?>"
							href="" class="button-item button-up-down jq-grid-footer-toggle"><i
							class="bi bi-arrow-up-square-fill"></i></a>
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
    							 	<li class="breadcrumb-item"><a
							href="<?php echo $item->url ?>"><?php echo $item->value; ?></a></li>
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
			<?php require_once $path . 'views/admin/layout/default/partials/message.inc.php'; ?>
			<?php require_once $provider->variables->view; ?>
		</div>
	</div>
</main>