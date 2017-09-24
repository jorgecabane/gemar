<li class="bold active sidebarlink">
	<a href="index.php" class="waves-effect waves-cyan">
		<i class="mdi-action-dashboard"></i>
		Dashboard
	</a>
</li>
<li class="bold sidebarlink">
	<a href="#" class="waves-effect waves-cyan load-content"  what="views/app_calendar.php" where="content">
		<i class="mdi-editor-insert-invitation"></i>
		Calendario
	</a>
</li>
<li class="no-padding">
	<ul class="collapsible collapsible-accordion">
		<li class="bold sidebarlink">
			<a class="collapsible-header  waves-effect waves-cyan">
				<i class="mdi-social-pages"></i>
				Pages
			</a>
			<div class="collapsible-body">
				<ul>
					<li>
						<a href="#" what="views/app_todo.php" where="content" class="load-content">Tasks</a>
					</li>
				</ul>
			</div>
		</li>
			
		<li class="bold sidebarlink">
			<a class="collapsible-header  waves-effect waves-cyan">
				<i class="mdi-action-account-circle"></i>
				Usuarios
			</a>
			<div class="collapsible-body">
				<ul>
					<li class="sidebarlink">
						<a class="waves-effect waves-light modal-trigger modal-profile-trigger" href="#modal5">Perfiles</a>
					</li>
					<li class="sidebarlink">
						<a href="#" what="views/admin/register_new_user.php" where="content" class="load-content">Registrar Nuevos</a>
					</li>
				</ul>
			</div>
		</li>
	</ul>
</li>

<?php

require_once dirname(__FILE__) . "/profile_modal.php";