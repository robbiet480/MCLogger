# MCLogger

## Introduction
Super simple log parser, utilizing JSONApi. Stores its data in MySQL for easy parsing later

## Installation

1.	Make sure JSONApi is installed and that a user is configured in JSONApiAuthentication.txt
2.	Fill in the relevant details in logdaemon.php and logviewer.php (MySQL in both, replace example.com, admin and test with the domain to JSONApi, and the username/password you set in JSONApiAuthentication.txt in logdaemon.php)
3.	Insert the database SQL into a database of your choosing. By default the SQL will insert it into minecraft_logs.
4.	Profit!

## Bugs

1.	Main issue right now is that there is no "one feed to rule them all" in JSONApi so for the time being (next 24 hours from this writing heh) it is limited to chat only.
2.	Pagination would be nice at some point
3.	Design not ripped from MCStats (sorry DeltaHat!)

## License

Go crazy, I really don't care

## Contributing

Fork it, code it, pull it, rinse wash repeat