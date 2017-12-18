var realtime_update = true;
var node_endpoint = 'http://localhost:3000';
var page_data = {
    'checked_location': 0,
    'location_list': [],
    'invites_list': [],
    'event_type': 1,
    'event_list': [],
    'user_list': [],
    'checked_users': [],
    'page': 'home',
    'page_title': 'Dashboard',
    'user_name': '',
    'dash_board_data': {},
    'user_type': 1,
    'user_id': 0,
    'login_email': '',
    'login_password': '',
    'email': '',
    'password': '',
    'application_api_url': application_api_url,
    'login_msg': '',
    'password_confirmation': '',
    'verify_msg': '',
    'first_name': '',
    'last_name': '',
    'event_name': '',
    'event_date': ''
};

/**
 * @name Vue.component
 * @summary This function register the vue component. event-item component used for dash board event listing
 * @param null.
 * @returns null.
 * @version    Git: 1.1
 * @author     Lijo E John <lijoejohn@gmail.com>
 */
Vue.component('event-item', {
    props: ['event'],
    template: '<div class="col-sm-6 col-md-4"><div class="thumbnail"><div class="caption"><h3 style="word-break: break-all;"><b>{{ event.event_title }}</b></h3><p>{{ event.event_location }}</p><p>{{ event.event_time }}</p><p>Host Name : <b>{{event.host_name}}</b></p><div class="button_section"><p><a class="btn btn-sm btn-primary pull-right view_invites_button" v-bind:data-event_id="event.event_id" data-toggle="modal" data-target="#viewinvitesmodal" role="button">View invites </a></p></div></div></div></div>'
});

/**
 * @name Vue.use VueGoogleMaps
 * @summary importing Vue GoogleMaps plugin in to app
 * @param null.
 * @returns null.
 * @version    Git: 1.1
 * @author     Lijo E John <lijoejohn@gmail.com>
 */
Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyA-rI3iyiCnPqGvsyd-XhNI5EbedAd-V7o'
    },
});

var app = new Vue({
    el: '#app',
    data: page_data,
    methods: {
		/**
		* @name setPlace
		* @summary Function to get the formated address from google maps geocode api.
		* @param {object} place
		* @returns {object} formated address results.
		* @version    Git: 1.1
		* @author     Lijo E John <lijoejohn@gmail.com>
		*/
        setPlace(place) {
            if (typeof place != "undefined") {
                if (typeof place.latLng != "undefined" && typeof place.latLng.lat() != "undefined" && typeof place.latLng.lng() != "undefined") {
                    this.latLng = {
                        lat: place.latLng.lat(),
                        lng: place.latLng.lng()
                    };
                    axios.defaults.headers.common['Content-Type'] = 'application/json';
                    delete axios.defaults.headers.common["Authorization"];

                    axios.get('https://maps.googleapis.com/maps/api/geocode/json?&result_type=street_address|route|intersection|locality|premise|airport|park&latlng=' + this.latLng.lat + ',' + this.latLng.lng + '&key=AIzaSyA-rI3iyiCnPqGvsyd-XhNI5EbedAd-V7o', {}).then(function(response) {
                        app.location_list = response.data.results;
                    }).catch(function(error) {
                    });
                }
            }

        },
		/**
		* @name get_all_invites
		* @summary Function to get the invites list by passing a event id.
		* @param {number} event_id
		* @returns {object} invites list.
		* @version    Git: 1.1
		* @author     Lijo E John <lijoejohn@gmail.com>
		*/
        get_all_invites(event_id) {
            axios.defaults.headers.common['Authorization'] = "Bearer " + Cookie.get('api_token');
            axios.post(application_api_url + '/user/invites_list', {
                event_id: event_id
            }).then(function(response) {
                if (typeof response.data.status != "undefined") {
                    if (response.data.status == 1) {

                        app.invites_list = response.data.results.users;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }).catch(function(error) {}).then(function(lista) {

            });

        },
		/**
		* @name do_add_event
		* @summary Function to add a new event.
		* @param {number} event_id
		* @returns {object} invites list.
		* @description actions :- update dash board data,update all the socket clients.
		* @version    Git: 1.1
		* @author     Lijo E John <lijoejohn@gmail.com>
		*/
        do_add_event: function() {
            var $valid = $('#add_event_form').valid();
            if ($valid) {
                axios.defaults.headers.common['Authorization'] = "Bearer " + Cookie.get('api_token');
                axios.post(application_api_url + '/user/event', {
                    event_name: this.event_name,
                    event_date: this.event_date,
                    checked_users: this.checked_users,
                    event_type: this.event_type,
                    checked_location: this.checked_location,
                    lat: $("input[name='checked_location']:checked").data('lat'),
                    lng: $("input[name='checked_location']:checked").data('lng'),
                    formatted_address: $("input[name='checked_location']:checked").data('formatted_address')

                }).then(function(response) {
                    if (typeof response.data.status != "undefined") {
                        if (response.data.status == 1) {
                            app.event_list = response.data.results;
                            handle_realtime();
                            $('#addeventmodal').modal('hide');
                            app.event_name = '';
                            app.event_date = '';
                            app.event_type = 1;
                            app.checked_users = [];
                            app.location_list = [];
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                }).catch(function(error) {}).then(function(lista) {

                });
            }

        },
		/**
		* @name do_logout
		* @summary Function to make in-activate the server side auth token on logout action.
		* @param null
		* @returns null.
		* @description actions :- update dash board data,realtime socket update token.
		* @version    Git: 1.1
		* @author     Lijo E John <lijoejohn@gmail.com>
		*/
        do_logout: function() {
            axios.defaults.headers.common['Authorization'] = "Bearer " + Cookie.get('api_token');
            axios.post(application_api_url + '/login/logout', {

            }).then(function(response) {
                if (typeof response.data.status != "undefined") {
                    if (response.data.status == 1) {
                        app.login_msg = '';
                        Cookie.set('api_token', "", {
                            expires: 365
                        });
                        app.user_id = 0;
                        app.user_type = 1;
                        app.user_name = "Guest";
                        app.get_dash_board_data();
                        handle_realtime_update_token();
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }).catch(function(error) {});
        },
		/**
		* @name get_all_users
		* @summary Function to get the active all active users.
		* @param null
		* @returns null.
		* @version    Git: 1.1
		* @author     Lijo E John <lijoejohn@gmail.com>
		*/
        get_all_users: function() {
            axios.defaults.headers.common['Authorization'] = "Bearer " + Cookie.get('api_token');
            axios.get(application_api_url + '/user/list', {

            }).then(function(response) {
                if (typeof response.data.status != "undefined") {
                    if (response.data.status == 1) {
                        app.user_list = response.data.results.users;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }).catch(function(error) {}).then(function(lista) {

            });
        },
		/**
		* @name get_dash_board_data
		* @summary Function to get the dash board data.
		* @param null
		* @returns null.
		* @version    Git: 1.1
		* @author     Lijo E John <lijoejohn@gmail.com>
		*/
        get_dash_board_data: function() {
            axios.defaults.headers.common['Authorization'] = "Bearer " + Cookie.get('api_token');
            axios.post(application_api_url + '/dashboard', {

            }).then(function(response) {
                if (typeof response.data.status != "undefined") {
                    if (response.data.status == 1) {
                        app.event_list = response.data.results;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }).catch(function(error) {}).then(function(lista) {

            });
        },
		/**
		* @name do_login
		* @summary Function to make the user login action.
		* @param null
		* @returns null.
		* @description actions :- update dash board data,realtime socket update token.
		* @version    Git: 1.1
		* @author     Lijo E John <lijoejohn@gmail.com>
		*/
        do_login: function() {
            app.login_msg = '';
            $('#login_error_msg').hide();
            var $validator1 = $('#login_form').valid();
            if (!$validator1) {
                return false;
            }
            axios.post(application_api_url + '/login/auth', {
                email: this.login_email,
                password: this.login_password
            }).then(function(response) {
                if (typeof response.data.status != "undefined") {
                    if (response.data.status == 1) {
                        app.login_msg = '';
                        Cookie.set('api_token', response.data.data.token, {
                            expires: 365
                        });
                        app.user_id = response.data.data.user_id;
                        app.user_type = 1;
                        app.user_name = response.data.data.user_name;
                        $('#loginmodal').modal('hide');
                        $('#signupmodal').modal('hide');
                        app.email = '';
                        app.password = '';
                        app.get_dash_board_data();
                        handle_realtime_update_token();
                    } else {
                        $('#login_error_msg').show();
                        app.login_msg = response.data.message;
                    }
                } else {
                    app.login_msg = response.data.message;
                }
            }).catch(function(error) {});
        },
		/**
		* @name auth
		* @summary Function to check whether the user is logged or not.
		* @param null
		* @returns null.
		* @version    Git: 1.1
		* @author     Lijo E John <lijoejohn@gmail.com>
		*/
        auth: function() {
            // Make a request for a user with a given ID
            axios.defaults.headers.common['Authorization'] = "Bearer " + Cookie.get('api_token');
            axios.post(application_api_url + '/login/auth', {}).then(function(response) {
                if (typeof response.data.status != "undefined" && response.data.status == 1) {
                    app.user_id = response.data.data.user_id;
                    app.user_type = 1;
                    app.user_name = response.data.data.user_name;

                } else {
                    app.user_id = 0;
                    app.user_type = 1;
                    app.user_name = "Guest";
                }
            }).catch(function(error) {});

        },
		/**
		* @name do_register
		* @summary Function to create a new user account.
		* @param null
		* @returns null.
		* @description actions :- update dash board data.
		* @version    Git: 1.1
		* @author     Lijo E John <lijoejohn@gmail.com>
		*/
        do_register: function() {
            var $valid = $('#wizard-1-tab1').valid();
            if ($valid) {
                app.show_loader();

                axios.post(application_api_url + '/user/register_user', {
                    first_name: this.first_name,
                    last_name: this.last_name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                }).then(function(response) {

                    if (typeof response.data.status != "undefined") {
                        if (response.data.status == 1) {
                            Cookie.set('api_token', response.data.data.token, {
                                expires: 365
                            });
                            app.user_id = response.data.data.user_id;
                            app.user_type = 1;
                            app.user_name = response.data.data.user_name;
                            $('#loginmodal').modal('hide');
                            $('#signupmodal').modal('hide');
                            app.email = '';
                            app.password = '';
                            app.get_dash_board_data();
                        } else {
                            if (response.data.message != '') {
                                $('#wizard-1-tab' + (response.data.error_index) + '').valid();
                            }
                        }
                    } else {
                        return false;
                    }
                }).catch(function(error) {}).then(function(lista) {
                    app.hide_loader();
                });
            }
        },
		/**
		* @name validateEmail
		* @summary Function to validateEmail using regular expression.
		* @param string email
		* @returns bool.
		* @version    Git: 1.1
		* @author     Lijo E John <lijoejohn@gmail.com>
		*/
        validateEmail: function(email) {
            email = typeof email == "undefined" ? '' : email;
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        },
		/**
		* @name show_loader
		* @summary Function to show the blockUI loader.
		* @param null
		* @returns null.
		* @version    Git: 1.1
		* @author     Lijo E John <lijoejohn@gmail.com>
		*/
        show_loader: function() {
            $.blockUI({
                message: '<div class="loader"></div>'
            });
        },
		/**
		* @name hide_loader
		* @summary Function to hide the blockUI loader.
		* @param null
		* @returns null.
		* @version    Git: 1.1
		* @author     Lijo E John <lijoejohn@gmail.com>
		*/
        hide_loader: function() {
            $.unblockUI();
        },
    }
});


handle_realtime_connection();
var socket;

/**
* @name handle_realtime_connection
* @summary Function to connect the client to socket server.
* @param null
* @returns null.
* @description once any user created a new event the ping_event_added socket will be triggered to all the connected clients. 
All client will listen to the ping_event_added and will ping back to the sync_event_added socket server with the client token and server will call back ping_event_recived to the connected client.
* @version    Git: 1.1
* @author     Lijo E John <lijoejohn@gmail.com>
*/
function handle_realtime_connection() {
    if (realtime_update) {
        socket = io(node_endpoint, {
            query: "api_token=" + ((Cookie.get('api_token')==null)?'':Cookie.get('api_token'))
        });

        socket.on('ping_event_added', function() {
            socket.emit('sync_event_added');
        });

        socket.on('ping_event_recived', function(data, api_token) {
			console.log('ping_event_recived');
            app.event_list = data;
        });
    }
}
/**
* @name handle_realtime_update_token
* @summary Function to update the client token on socket.
* @param null
* @returns null.
* @description on login and logout actions client token will be update on the socket server.
* @version    Git: 1.1
* @author     Lijo E John <lijoejohn@gmail.com>
*/
function handle_realtime_update_token() {
	if (realtime_update) {
		socket.emit('update_token', Cookie.get('api_token'));
	}
}
/**
* @name handle_realtime
* @summary Function to update all the connected client with the newly added event.
* @param null
* @returns null.
* @version    Git: 1.1
* @author     Lijo E John <lijoejohn@gmail.com>
*/
function handle_realtime() {
    if (realtime_update) {
        socket.emit('event_added');
    }
}

$(document).ready(function() {
	/**
	* @name addeventmodal - shown.bs.modal
	* @summary handle the event add popup DOM loaded call back.
	* @param null
	* @returns null.
	* @description we need to update the invites list and Resize the google map.
	* @version    Git: 1.1
	* @author     Lijo E John <lijoejohn@gmail.com>
	*/
    $('#addeventmodal').on('shown.bs.modal', function() {
        app.get_all_users();
        Vue.$gmapDefaultResizeBus.$emit('resize');
        //do something…
    })
	
	/**
	* @name viewinvitesmodal - shown.bs.modal
	* @summary handle the view event popup DOM loaded call back.
	* @param null
	* @returns null.
	* @description we need to get the list of invites for the event. 
	* @version    Git: 1.1
	* @author     Lijo E John <lijoejohn@gmail.com>
	*/
    $('#viewinvitesmodal').on('shown.bs.modal', function() {
        var selected_event_id = $(".selected_link").data('event_id');
        app.get_all_invites(selected_event_id);
    })
	
	/**
	* @name viewinvitesmodal - show.bs.modal
	* @summary handle the view event popup DOM loading call back.
	* @param null
	* @returns null.
	* @description we need to clear the previous list of invites for the event. 
	* @version    Git: 1.1
	* @author     Lijo E John <lijoejohn@gmail.com>
	*/
    $('#viewinvitesmodal').on('show.bs.modal', function() {
        app.invites_list = [];
    });
	
	/**
	* @name view_invites_button - click
	* @summary handle the click event of view invites button.
	* @param null
	* @returns null.
	* @version    Git: 1.1
	* @author     Lijo E John <lijoejohn@gmail.com>
	*/
    $(document).on("click", ".view_invites_button", function() {
        $('.view_invites_button').removeClass('selected_link');
        $(this).addClass('selected_link');
    });
	
	/**
	* @name datetimepicker - init
	* @summary handle the initialization  of date time picker.
	* @param null
	* @returns null.
	* @version    Git: 1.1
	* @author     Lijo E John <lijoejohn@gmail.com>
	*/
    $('#event_date').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        ignoreReadonly: true,
        minDate: moment()
    });
	
	/**
	* @name event_date - blur
	* @summary on change focus from the date time text box set that value to the Vue attribute.
	* @param null
	* @returns null.
	* @version    Git: 1.1
	* @author     Lijo E John <lijoejohn@gmail.com>
	*/
    $('#event_date').blur(function() {
        app.event_date = $(this).val();
    });
	
	/**
	* @name input - keypress
	* @summary handle the form submission on enter key press.
	* @param null
	* @returns null.
	* @version    Git: 1.1
	* @author     Lijo E John <lijoejohn@gmail.com>
	*/
    $('input').keypress(function(e) {
        if (e.which == 13) {
            $('.submit_button').trigger('click');
        }
    });
	/**
	* @name input - keypress
	* @summary handle the form submission on enter key press.
	* @param null
	* @returns null.
	* @version    Git: 1.1
	* @author     Lijo E John <lijoejohn@gmail.com>
	*/
    $('#login_form').keypress(function(e) {
        if (e.which == 13) {
            $('#login_btn').trigger('click');
            return false;
        }
    });
	
	/**
	* @name numeric - keypress
	* @summary handle non numeric validation.
	* @param null
	* @returns null.
	* @version    Git: 1.1
	* @author     Lijo E John <lijoejohn@gmail.com>
	*/
    $(document).on('keypress', ".numeric", function(e) {
        if (window.event) {

            var charCode = window.event.keyCode;
            //var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
        } else if (e) {

            var charCode = e.which;
        } else {
            return true;
        }
        if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 45 && charCode != 46) {
            return false;
        }
        return true;
    });
	/**
	* @name input - keypress
	* @summary handle the popup close on custom close button click.
	* @param null
	* @returns null.
	* @version    Git: 1.1
	* @author     Lijo E John <lijoejohn@gmail.com>
	*/
    $(".close_modal").on('click', function(e) {
        $('.modal-header .close').trigger('click');
    });
	/**
	* @name show.bs.modal
	* @summary on show action of popup clean all the previous validation messages.
	* @param null
	* @returns null.
	* @version    Git: 1.1
	* @author     Lijo E John <lijoejohn@gmail.com>
	*/
    $("div[role='dialog']").on('show.bs.modal', function(e) {
        unhighlight_validation($(this).find("form:first").attr("id"));
    });
	/**
	* @name login form validate
	* @summary client side jquery validation for login form.
	* @param null
	* @returns null.
	* @version    Git: 1.1
	* @author     Lijo E John <lijoejohn@gmail.com>
	*/
    $("#login_form").validate({
        ignore: [],
        rules: {
            user_name: {
                required: true,
                email: true
            },
            login_password: {
                required: true
            }
        },
        messages: {
            user_name: "Please specify User Name",
            login_password: "Please specify Password"
        },

        highlight: function(element) {
            $('#login_error_msg').hide();
            $(element).closest('.form-group').removeClass('hassuccess').addClass('haserror');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('haserror').addClass('hassuccess');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });

	/**
	* @name register page form validate
	* @summary client side jquery validation for register form.
	* @param null
	* @returns null.
	* @version    Git: 1.1
	* @author     Lijo E John <lijoejohn@gmail.com>
	*/
    $("#wizard-1-tab1").validate({
        ignore: [],
        rules: {
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                password_validation: true,
            },
            password_confirmation: {
                required: true,
                password_validation: true,
                equalTo: "#password",
            }
        },

        messages: {
            first_name: "Please specify your First name",
            last_name: "Please specify your Last name",
            email: "Please specify your E-mail",
            password: {
                required: "Please enter Password",
                password_validation: "The password must be at least 6 characters (Alphanumeric without space) "
            },
            password_confirmation: {
                required: "Please enter Confirm Password",
                password_validation: "The password must be at least 6 characters (Alphanumeric without space) ",
                equalTo: "Confirm Password does not match Password"

            },
        },

        highlight: function(element) {
            $(element).closest('.form-group').removeClass('hassuccess').addClass('haserror');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('haserror').addClass('hassuccess');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });

	/**
	* @name add event page form validate
	* @summary client side jquery validation for add event form.
	* @param null
	* @returns null.
	* @version    Git: 1.1
	* @author     Lijo E John <lijoejohn@gmail.com>
	*/
    $("#add_event_form").validate({
        ignore: [],
        rules: {
            event_name: {
                required: true
            },
            event_date: {
                required: true
            },
            checked_location: {
                checked_location_required: true,
            },
        },

        messages: {
            event_name: "Please specify your Event name",
            event_date: "Please specify your Event date",
            checked_location: {
                checked_location_required: "Please specify your Event location"
            },
        },

        highlight: function(element) {
            $(element).closest('.form-group').removeClass('hassuccess').addClass('haserror');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('haserror').addClass('hassuccess');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if ($(element).attr('name') == 'checked_location') {
                error.insertAfter(element.parent().parent());
            } else {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            }
        }
    });

    jQuery.validator.addMethod("password_validation", function(value, element) {
        var patt = /^[a-zA-Z0-9]{6,}$/;
        return patt.test(value);
    }, "The password must be at least 6 characters (Alphanumeric without space) ");

    jQuery.validator.addMethod("checked_location_required", function(value, element) {
        if (!$("input[name='checked_location']:checked").val()) {
            return false;
        } else {
            return true;
        }

    }, "");

});

/**
* @name unhighlight_validation
* @summary function to unhighlight the validation message'.
* @param string from_id
* @returns null.
* @version    Git: 1.1
* @author     Lijo E John <lijoejohn@gmail.com>
*/
function unhighlight_validation(from_id) {
    if (typeof from_id != "undefined") {
        $('#' + from_id).validate().resetForm();
        $('.form-group').removeClass('haserror').addClass('hassuccess');
    }
}