# CodFlix project

## Setup

### Run
1. You have to use a local server such as Wamp or Mamp
1. Import the database `codflix.sql`
1. Pull the repo in the `www/` directory of your local server
1. Follow the address of your repo. For example, if your repo is in ``www/codflix/``, the URL should be http://localhost/codflix or http://127.0.0.1/codflix

Nothing else is required. You can now start your development

--------------- INFORMATION ABOUT LOGIN -------------

Email : coding@gmail.com
Password : Coding@123

I implemented regex (PHP)on the password for security, a password need :
	- between 8 and 20 characters
	- an uppercase letter
	- a lowercase
	- a number
	- a symbol

There is the same control on client side with a JS Script.




----------------------------------------------------- 

--------------- INFORMATION ABOUT DATABASE -------------

TABLE MEDIA : addition of a column for the duration

TABLE USER : 
	- added a "key" column to verify the user's account through a link sent by mail
	- added an "active" column (equal to 0 or 1) to check if the account is active (if the user has clicked on the link received by email)

TABLE SEASON : 

----------------------------------------------------- 