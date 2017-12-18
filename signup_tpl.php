<div class="modal fade" id="signupmodal" tabindex="-1" role="dialog" aria-labelledby="signupmodalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="addparentmodalLabel">Register</h4>
			</div>
			<div class="modal-body">
				<form class="smart-form " id="wizard-1-tab1">
					
					<div class="form-group widthicons">
						<span class="new-user icon"></span>
						<input type="text" class="input-lg" v-model="first_name" name="first_name" id="first_name" placeholder="First Name">
					</div>
					
					<div class="form-group widthicons">
						<span class="new-user icon"></span>
						<input type="text" class="input-lg" v-model="last_name" name="last_name" id="last_name" placeholder="Last Name">
					</div>
					
					<div class="form-group widthicons">
						<span class="new-letter icon"></span>
						<input type="text" class="input-lg" v-model="email" name="email" id="email" placeholder="Email">
					</div>
					<div class="form-group widthicons" id="login_pass_div">
						<span class="new-password icon"></span>
						<input type="password" class="input-lg" v-model="password" name="password" id="password" placeholder="Password">
					</div>
					
					<div class="form-group widthicons">
						<span class="new-password icon"></span>
						<input type="password" class="input-lg" v-model="password_confirmation" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
					</div>
					
					<button type="button" class="btn btn-lg btn-primary fullwidth" v-on:click="do_register">Complete</button>
				</form>
			</div>
					
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->