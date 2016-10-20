(Secure) Web-Based Systems
Fall 2016
CS 4339/5339
Professor L. Longpre
Assignment 2
In this assignment you will implement the authentication part of a generic
web-based system.
Pages
Your web site should have:
1.  a main page named
mainpage.php
,
2.  a registration page named
registration.php
,
3.  a sign in page named
login.php
4.  a page for signed in users named
user.php
,
5.  a page for administrators named
admin.php
.
Access
If the visitor is not logged in, all pages except all pages except
user.php
and
admin.php
should be accessible.
If the visitor is logged in as a regular user, all pages except
admin.php
should
be accessible.
If the visitor is logged in as an administrator, all pages should be accessible.
Trying to access a page where access is denied should display an appropriate
error message, for example, \you need to be logged in as an administrator to
access this page" instead of displaying the regular contents of the page.
Page Contents
All pages should have a sign in button if the visitor is not signed in, and a
sign out button otherwise.
All pages should have links to the other accessible pages, and no link to not
accessible pages.
All pages should have some text in it indicating where we are.
The registration page should have a form with a  eld named \username", a
 eld named \password", and a submit button.
User registration
You will need a database with a table of registered users.  You will use salting
and hashing to store the password in the table.  For salting, you should use
2 strings:  a constant string of random characters, and the username, so you
will store in the table the hash function applied to the concatenation of 3
strings: a constant string of random characters, the userid, and the password.
In this way, one would need to have access to both the database and the php
program to mount a password cracking attack, and the username used as an
additional salt will slow down the brute force attack.  Usernames should be
unique.
For  the  admin  account,  create  an  account  with
admin
as  user  name  and
nimda339
as password.  This will be the only administrator account.
Authentication
Do  not  use  the  HTTP  authentication  headers  described  in  our  textbook.
When  signing  in,  check  the  username  and  password  against  the  registered
users table.  Then use PHP sessions to keep the user logged in.  Make sure
you destroy the session when the user signs out.
Submission
Put a copy of your web page  les on the course web server under the directory
with a random name.  You may use the same directory as assignment 1, or
you can create a di erent directory.
Write a report that contains the following:
1.  How long did you spend to do this assignment?
2.  The name of the directory where your  les are,
3.  What problems (if any) did you encounter in this assignment,  and if
yes, how did you solve the problems?
4.  Comment on how useful this assignment was as a way to learn about
authentication on web-based system
