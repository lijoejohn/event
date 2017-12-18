# Event Management System

A Single page web application for Event Management with Lumen, Vue.js, axios, express, socket-io, nodejs and Mysql.

## Getting Started

These instructions will get you a copy of the project up and running on your server for production purposes. See deployment for notes on how to deploy the project on a live system.

### Technology Stack:

- [Lumen - The stunningly fast micro-framework by Laravel](https://lumen.laravel.com/)
- [Vue.js - The Progressive JavaScript Framework](https://vuejs.org/)
- [VueGoogleMaps -  Vue 2.x port of vue-google-maps](https://www.npmjs.com/package/vue2-google-maps)
- [Google Map - Reverse Geocoding (Address Lookup)](https://developers.google.com/maps/documentation/geocoding/intro#ReverseGeocoding)
- [axios - Promise based HTTP client for the browser and node.js](https://github.com/axios/axios)
- [Node.js](https://nodejs.org/en/)
- [SOCKET.IO 2.0 - Socket.IO enables real-time bidirectional event-based communication](https://socket.io/)
- [Express - Minimalist web framework for Node.js](https://expressjs.com/)
- [Sequelize - Sequelize is a promise-based ORM for Node.js v4 and up](http://docs.sequelizejs.com/)
- [Mysql - Open-source relational database management system](https://www.mysql.com/)

### Application Options:

- Users can sign up and sign into the system.
- Users can create events, set venues, time and dates for the events and invite participants from the list of existing users.
- Private events can only be seen by participants.
- All users should be able to see other users.
- All upcoming events should be listed in the main page, sorted by date and time.
- Events are either public or private. Private events should not be listed for users who were not invited to them.
- Only public events are visible to everyone and open for them to participate in.
- Real time update of the event listing page.

### Database & Code documentations:

- [Design documents for database] (https://[APPURL]/img/db.png/)
- [PHP Code documentation generated using https://www.phpdoc.org/] (https://[APPURL]/apidoc/)
- [Javascript Code documentation generated using http://usejsdoc.org/] (https://[APPURL]/jsdoc/)

### Prerequisites

What things you need to install the software ?

	Web Server 	- PHP 5.6.18 and Apache 2.2 or newer
	Database 	- Mysql 5.7.19
	Node server 	- v6.11.3

### Deployment Steps

- git clone https://github.com/lijoejohn/event.git projectname
- cd event
- Create a database named event
- Import the db dump file  /db/event.sql
- Change the following application level config values

**api/v1.1/.env**

- `DB_HOST=localhost` [Database hostname]
- `DB_PORT=3306` [Database port number]
- `DB_DATABASE=event` [Database name]
- `DB_USERNAME=root` [Database user name]
- `DB_PASSWORD=''` [Database password]

**js/app.js**
	
- `var realtime_update = true;` [Enable/Disable Real time data update using node socket io]
- `var node_endpoint = 'http://localhost:3000';` [Node server end point]

**node-server.js**
	
- `var db_name 	= 'event';` [Database name]
- `var user_name 	= 'root';` [Database user name]
- `var password 	= '';` [Database password]
- `var db_host 	= 'localhost';` [Database hostname]

### Front End:
* A modern JavaScript enabled browser is required to use the app.  We recommend a current version of Firefox or Chrome. 