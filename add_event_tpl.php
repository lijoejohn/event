<div class="modal fade " id="addeventmodal" tabindex="-1" role="dialog" aria-labelledby="addeventmodalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="addparentmodalLabel">Add Event</h4>
			</div>
			<div class="modal-body">
			
<form class="smart-form " id="add_event_form" >
	<div class="row" style="padding: 45px;padding-bottom: 5px;">
			<h4 style="padding-bottom: 20px;font-weight: bold;">Basic Info</h4>
			<div class="form-group widthicons">
				<span class="new-user icon"></span>
				<input type="text" class="input-lg" v-model="event_name" maxlength="60" name="event_name" id="event_name" placeholder="Event Name">
			</div>
			
			<div class="form-group widthicons col-md-6" >
				<input type='text' readonly class="input-lg" v-model="event_date" name="event_date" id='event_date' placeholder="Event Date"/>
			</div>
			
			<div class="inline-group form-group col-md-6" style="padding-left: 20px;">
				<span style="float: left;padding-right: 20px;"><h4 style="font-weight: bold;">Public event ?</h4></span>
				<label class="checkbox">
					<input type="checkbox" name="event_type" v-model="event_type" name="event_type" id="event_type">
					<i></i>
				</label>
			</div>
			<div class="clearfix"></div>
			<div class="inline-group form-group" v-if="user_list.length > 0">
				<h4 style="padding-bottom: 20px;font-weight: bold;">Select invites</h4>
				<label class="checkbox" v-for="(item, index) in user_list">
					<input type="checkbox" name="checked_users" v-model="checked_users" name="checked_users" v-bind:value="item.user_id">
					<i></i>{{ item.user_name }}
				</label>
			</div>
			
	</div>
	<div class="row" style="padding: 45px;padding-top: 5px;">
		<h4 style="padding-bottom: 20px;font-weight: bold;">Select Location</h4>
		<div class="col-sm-12 col-md-12">
			<gmap-map :center="{lat: 3.0178697398847247, lng: 101.7088508605957}" @click="setPlace" :zoom="16" style="width: 100%; height: 250px">

			</gmap-map>
		</div>
		
		<div class="inline-group form-group" v-if="location_list.length > 0">
			<h4 style="padding-top:20px; font-weight: bold; padding-bottom: 20px;">Locations</h4>
			<label class="radio" v-for="(item, index) in location_list" style="clear: both;">
				<input type="radio" name="checked_location" v-model="checked_location" name="checked_location" v-bind:value="item.place_id" v-bind:data-lat="item.geometry.location.lat" v-bind:data-lng="item.geometry.location.lng" v-bind:data-formatted_address="item.formatted_address" v-bind:value="item.place_id">
				<i></i>{{ item.formatted_address }}
			</label>
		</div>
		
	</div>
	<button type="button" class="btn btn-lg btn-primary fullwidth" v-on:click="do_add_event">Complete</button>
	<br>
</form>

			</div>
					
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->