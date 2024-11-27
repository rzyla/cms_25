<main class="app-main">
	<div class="app-content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h3 class="mb-0">
    					<?php echo $admin->language->translate("page_" . $admin->variables->page() . "_title"); ?>
    					<?php if($admin->buttons->showAdd()): ?>
    						<a href="<?php echo routeAdd($app['page']); ?>" class="button-item button-add"><i class="bi bi-plus-lg"></i></a>
    					<?php endif; ?>
    					<?php if($admin->buttons->showList()): ?>
    						<a href="<?php echo routeList($app['page']); ?>" class="button-item button-list"><i class="bi bi-list"></i></a>
    					<?php endif; ?>
					</h3>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-end">
						<li class="breadcrumb-item"><a href="<?php echo $admin->config->app_admin_path() ?>"><?php echo $admin->language->translate("breadcrumb_home"); ?></a></li>
						<li class="breadcrumb-item active" aria-current="page"><?php echo $admin->language->translate("page_" . $admin->variables->page() . "_title"); ?></li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<div class="app-content">
		<div class="container-fluid">
			<?php require_once $admin->variables->view(); ?>
		</div>
	</div>
</main>