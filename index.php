<!DOCTYPE html>
<html lang="en-us">
    <?php require_once('header.php'); ?>
    <body class="">

        <div id="app">
            <title> Dashboard</title>
            <?php require_once('inner_header.php'); ?>
			<aside id="left-panel"></aside>

            <!-- MAIN PANEL -->
			<div id="main" role="main">
				<!-- MAIN CONTENT -->
				<div id="content ">
				
					
						<span class="no-data" v-if="event_list.length == 0">No Events Found</span>
					
						<event-item
						v-for="item in event_list"
						v-bind:event="item"
						v-bind:user_id_logged="user_id"
						v-bind:key="item.id">
						</event-item>
					  
					
					  
				</div>
					

				<div class="clearfix"></div>
				<?php require_once('add_event_tpl.php'); ?>
				<?php require_once('invites_tpl.php'); ?>

				</div>
				<!-- END MAIN CONTENT -->
				
			<?php require_once('login_tpl.php'); ?>
			<?php require_once('signup_tpl.php'); ?>
			
			
			</div>
			<!-- END MAIN PANEL -->
			
		
        <?php require_once('footer.php'); ?>

		<script src="node_modules/vue2-google-maps/dist/vue-google-maps.js"></script>
        <script src="js/app.js"></script>
		
        <script type="text/javascript">
            app.auth();
        </script>

        <script type="text/javascript">
            $(document).ready(function()
            {
                $('#ind_page_title').html('Dashboard');
				app.get_dash_board_data();

            });
                
        </script>

    </body>

</html>