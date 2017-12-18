<div class="modal fade" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="loginmodalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="addparentmodalLabel">Login</h4>
			</div>
			<div class="modal-body">
				<form class="smart-form " id="login_form">
					<div class="form-group widthicons">
						<span class="new-user icon"></span>
						<input type="text" class="input-lg" placeholder="Username" name="user_name" id="login_email" v-model="login_email">
					</div>
					<div class="form-group widthicons" id="login_pass_div">
						<span class="new-password icon"></span>
						<input type="password" class="input-lg last_input" placeholder="Password" name="login_password" id="login_password" v-model="login_password">

						<span class="help-block" id="login_error_msg">{{login_msg}}</span>
					</div>
					
					<button type="button" class="btn btn-lg btn-primary fullwidth submit_button" id="login_btn" v-on:click="do_login">Log in</button>

					<div class="footersection">
						<a class="register" data-toggle="modal" data-target="#signupmodal">Register</a>
						<div class="clearfix"></div>
					</div>
				</form>
			</div>
					
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->