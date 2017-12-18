<div class="modal fade" id="viewinvitesmodal" tabindex="-1" role="dialog" aria-labelledby="viewinvitesmodal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="addparentmodalLabel">Invites</h4>
			</div>
			<div class="modal-body">
				<form class="smart-form " id="invites_form">
					<div class="inline-group form-group" v-if="invites_list.length > 0">
						
						<label class="checkbox invites_list" v-for="(item, index) in invites_list">
							{{ item.name }} ({{ item.user_name }} , <span class="reg_date">Registred on :{{ item.created_on }}</span>)
						</label>
					</div>
					<label class="checkbox invites_list align-cenetr" v-if="invites_list.length == 0">
							No Invites Found
					</label>
				</form>
			</div>
					
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->