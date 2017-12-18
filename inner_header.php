<!-- HEADER -->
<header id="header">
<a class="logo_href" href="<?php echo $application_url;?>">
    <div id="logo-group">

        <!-- PLACE YOUR LOGO HERE -->
        <span id="logo"> <img style="width: 100px;height: 76px;" src="img/logo-small.png" alt="Drive Safe" class="loginlogo"></span>
        <!-- END LOGO PLACEHOLDER -->

    </div>
</a> 

    
    <!-- pulled right: nav area -->

    <div class="pull-right rightmenu">
        <div class="avatar dropdown" v-cloak>
            <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);">{{ user_name }} <i class="fa fa-caret-down" aria-hidden="true"></i></a>
            <ul class="dropdown-menu">
				
                <li id="logout" v-if="user_id>0">
                    <a title="Logout" v-on:click="do_logout"><span class="icon new-logout transition"></span>Logout</a>
                </li>
				
				<li id="logout" v-if="user_id>0">
                    <a title="Add Event" data-toggle="modal" data-target="#addeventmodal"><span class="transition"></span>Add Event</a>
                </li>
				
				<li id="login" v-if="user_id==0">
                    <a title="Login" data-toggle="modal" data-target="#loginmodal"><span class="icon new-logout transition"></span>Login</a>
                </li>
				
            </ul>

        </div>
        
        <div class="clearfix"></div>
        
    </div>

    <!-- end pulled right: nav area -->
    <div class="pull-right showmenus"><i class="new-more" aria-hidden="true"></i></div>

</header>
<!-- END HEADER -->