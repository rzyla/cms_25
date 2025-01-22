<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
	<div class="sidebar-brand">
		<a
			href="<?php echo  $provider->route->index(consts::$page_dashboard); ?>"
			class="brand-link"> <span class="brand-text fw-light"><?php echo $provider->language->translate("common_arteh_upper"); ?><span><?php echo $provider->language->translate("common_cms_upper"); ?></span></span>
		</a>
	</div>
	<div class="sidebar-wrapper">
		<nav class="mt-2">
			<ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview"
				role="menu" data-accordion="false">

				<li class="nav-item"><a
					href="<?php echo $provider->route->index(consts::$page_dashboard); ?>"
					class="nav-link <?php if($provider->variables->page == consts::$page_dashboard): ?>active<?php endif; ?>">
						<i class="bi bi-speedometer"></i>
						<p><?php echo $provider->language->translate("sidebar_dashboard"); ?></p>
				</a></li>

				<li class="nav-item"><a
					href="<?php echo $provider->route->index(consts::$page_partials); ?>"
					class="nav-link <?php if($provider->variables->page == consts::$page_partials): ?>active<?php endif; ?>">
						<i class="bi bi-inboxes"></i>
						<p><?php echo $provider->language->translate("sidebar_partials"); ?></p>
				</a></li>

				<?php $in_array_modules = array_key_exists($provider->variables->page, $provider->layout->modules); ?>
				<li
					class="nav-item <?php if($in_array_modules): ?>menu-open<?php endif; ?>"><a
					href="#"
					class="nav-link <?php if($in_array_modules): ?>active<?php endif; ?>">
						<i class="nav-icon bi bi-columns-gap"></i>
						<p>
							<?php echo $provider->language->translate("sidebar_moules"); ?> <i
								class="nav-arrow bi bi-chevron-right"></i>
						</p>
				</a>
					<ul class="nav nav-treeview">
						<?php foreach($provider->layout->modules as $module => $name): ?>
    						<li class="nav-item"><a
							href="<?php /*echo $provider->route->index("menu");*/ ?>"
							class="nav-link"> <i
								class="bi <?php echo $provider->layout->icons["module_" . $module]; ?>"></i>
								<p><?php echo $name; ?></p>
						</a></li>
						<?php endforeach; ?>
					</ul></li>

				<?php if($provider->security->acl(consts::$value_acl_admin)): ?>
				<?php $in_array_admin = in_array($provider->variables->page, [consts::$page_menu, consts::$page_configuration, consts::$page_users, consts::$page_modules]); ?>
				<li
					class="nav-item <?php if($in_array_admin): ?>menu-open<?php endif; ?>"><a
					href="#"
					class="nav-link <?php if($in_array_admin): ?>active<?php endif; ?>">
						<i class="nav-icon bi bi-gear"></i>
						<p>
							<?php echo $provider->language->translate("sidebar_management"); ?> <i
								class="nav-arrow bi bi-chevron-right"></i>
						</p>
				</a>
					<ul class="nav nav-treeview">
						<li class="nav-item"><a
							href="<?php echo $provider->route->index(consts::$page_menu); ?>"
							class="nav-link <?php if($provider->variables->page == consts::$page_menu): ?>active<?php endif; ?>">
								<i class="bi bi-diagram-3"></i>
								<p><?php echo $provider->language->translate("sidebar_menu"); ?></p>
						</a></li>
						<li class="nav-item"><a
							href="<?php echo $provider->route->index(consts::$page_configuration); ?>"
							class="nav-link <?php if($provider->variables->page == consts::$page_configuration): ?>active<?php endif; ?>">
								<i class="bi bi-window-stack"></i>
								<p><?php echo $provider->language->translate("sidebar_configuration"); ?></p>
						</a></li>
						<li class="nav-item"><a
							href="<?php echo $provider->route->index(consts::$page_users); ?>"
							class="nav-link <?php if($provider->variables->page == consts::$page_users): ?>active<?php endif; ?>">
								<i class="bi bi-people"></i>
								<p><?php echo $provider->language->translate("sidebar_users"); ?></p>
						</a></li>
						<?php if($provider->security->acl(consts::$value_acl_supervisor)): ?>
						<li class="nav-item"><a
							href="<?php echo $provider->route->index(consts::$page_modules); ?>"
							class="nav-link <?php if($provider->variables->page == consts::$page_modules): ?>active<?php endif; ?>">
								<i class="bi bi-ui-checks-grid"></i>
								<p><?php echo $provider->language->translate("sidebar_modules"); ?></p>
						</a></li>
						<?php endif; ?>
					</ul></li>
				<?php endif; ?>
			</ul>
		</nav>
	</div>
</aside>