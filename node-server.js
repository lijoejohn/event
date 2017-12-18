var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var db_name 	= 'event';
var user_name 	= 'root';
var password 	= '';
var db_host 	= 'localhost';

const Sequelize = require('sequelize');
const sequelize = new Sequelize(db_name, user_name, password, {
    host: db_host,
    dialect: 'mysql',
});

const Events = sequelize.define('events', {
    event_id: {
        type: Sequelize.INTEGER,
        primaryKey: true,
        autoIncrement: true
    }
}, {
    freezeTableName: true,
    timestamps: false
});
const Users = sequelize.define('users', {
    user_id: {
        type: Sequelize.INTEGER,
        primaryKey: true,
        autoIncrement: true
    }
}, {
    freezeTableName: true,
    timestamps: false
});
const Token = sequelize.define('auth_token', {
    id: {
        type: Sequelize.INTEGER,
        primaryKey: true,
        autoIncrement: true
    }
}, {
    freezeTableName: true,
    timestamps: false
});
const EventsInvites = sequelize.define('events_invites', {
    events_invites_id: {
        type: Sequelize.INTEGER,
        primaryKey: true,
        autoIncrement: true
    }
}, {
    freezeTableName: true,
    timestamps: false
});

Events.hasMany(EventsInvites, {
    foreignKey: 'event_id',
    sourceKey: 'event_id'
});
Users.hasMany(Token, {
    foreignKey: 'user_id',
    sourceKey: 'user_id'
});
EventsInvites.belongsTo(Events, {
    foreignKey: 'event_id'
});
Events.belongsTo(Users, {
    foreignKey: 'created_by'
});

io.on('connection', function(socket) {
    console.log('log input param : ' + socket.handshake.query.api_token);

    socket.on('update_token', function(api_token) {
        socket.handshake.query.api_token = api_token;
        console.log('log input param : ' + socket.handshake.query.api_token);
    });
    socket.on('event_added', function() {
		console.log('event_added');
        socket.broadcast.emit('ping_event_added');
    });

    socket.on('sync_event_added', function() {
        //console.log('log input param event_added: ' + socket.handshake.query.api_token);
        var api_token = socket.handshake.query.api_token;
		console.log('sync_event_added');
		api_token = ((!api_token || api_token=== null)?'':api_token);
        if (api_token != '') {
            Token.find({
                attributes: ['user_id'],
                raw: true,
                where: {
                    type: 1,
                    token: api_token,
                    status: 1
                }
            }).then(function(res) {
                if (res.user_id > 0) {
                    sequelize.query('SELECT users.user_name as host_name,events.event_id,event_name as event_title,event_time,' +
                        'event_lat,event_long,event_address as event_location,type,' +
                        'created_by FROM events INNER JOIN users on users.user_id=events.created_by' +
                        ' left join events_invites on events_invites.event_id=events.event_id where (events_invites.user_id=' + res.user_id + ' OR events.created_by=' + res.user_id + ' OR events.type=1) group by events.event_id order by event_time asc', {
                            model: {
                                Events,
                                Users,
                                EventsInvites
                            },
                            raw: true
                        }).then(events => {
                        socket.emit('ping_event_recived', events, api_token);
                        //Each record will now be a instance of Project
                    });
                } else {
                    sequelize.query('SELECT users.user_name as host_name,events.event_id,event_name as event_title,event_time,' +
                        'event_lat,event_long,event_address as event_location,type,' +
                        'created_by FROM events INNER JOIN users on users.user_id=events.created_by where events.type=1 group by events.event_id order by event_time asc', {
                            model: {
                                Events,
                                Users
                            },
                            raw: true
                        }).then(events => {
                        socket.emit('ping_event_recived', events, api_token);
                        //Each record will now be a instance of Project
                    });
                }
            }).catch(function(err) {

            });
        } else {
            sequelize.query('SELECT users.user_name as host_name,events.event_id,event_name as event_title,event_time,' +
                'event_lat,event_long,event_address as event_location,type,' +
                'created_by FROM events INNER JOIN users on users.user_id=events.created_by where events.type=1 group by events.event_id order by event_time asc', {
                    model: {
                        Events,
                        Users
                    },
                    raw: true
                }).then(events => {

                socket.emit('ping_event_recived', events, api_token);
                //Each record will now be a instance of Project
            });
        }
    });
});

http.listen(3000, function() {
    console.log('listening on *:3000');
});