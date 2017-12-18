# Event Management System

A Single page web application for Event Management with Lumen, Vue.js, axios, express, socket-io, nodejs and Mysql.

## Getting Started

These instructions will get you a copy of the project up and running on your server for production purposes. See deployment for notes on how to deploy the project on a live system.

### Technology Stack:

- [Lumen - The stunningly fast micro-framework by Laravel](https://lumen.laravel.com/)
- [Vue.js - The Progressive JavaScript Framework](https://vuejs.org/)
- [axios - Promise based HTTP client for the browser and node.js](https://github.com/axios/axios)
- [Node.js](https://nodejs.org/en/)
- [SOCKET.IO 2.0 - Socket.IO enables real-time bidirectional event-based communication](https://socket.io/)
- [Express - Minimalist web framework for Node.js](https://expressjs.com/)
- [Mysql - Open-source relational database management system](https://www.mysql.com/)

### Prerequisites

What things you need to install the software ?

	Web Server 	- PHP 5.6.18 and Apache 2.2 or newer
	Database 	- Mysql 5.7.19
	Node server - v6.11.3

### Deployment Steps

- git clone https://github.com/lijoejohn/event.git projectname
- cd event
- Create a database named event
- Import the db dump file  /db/event.sql
- Change the following application level config values

**api/v1.1/.env**

`DB_HOST=localhost` Database hostname
`DB_PORT=3306` Database port number
`DB_DATABASE=event` Database name
`DB_USERNAME=root` Database user name
`DB_PASSWORD=''` Database password

**js/app.js**
	
`var realtime_update = true;` Enable/Disable Real time data update using node socket io.
`var node_endpoint = 'http://localhost:3000';` Node server end point.

**node-server.js**
	
`var db_name 	= 'event';` Database name.
`var user_name 	= 'root';` Database user name.
`var password 	= '';` Database password.
`var db_host 	= 'localhost';` Database hostname.

### Front End:
* A modern JavaScript enabled browser is required to use the app.  We recommend a current version of Firefox or Chrome. 
