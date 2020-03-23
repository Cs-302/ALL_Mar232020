#!/usr/bin/python
import MySQLdb

db = MySQLdb.connect(host="localhost",    # your host, usually localhost
                     user="ubuntu",         # your username
                     passwd="password",  # your password
                     db="cs302")        # name of the data base

# you must create a Cursor object. It will let
#  you execute all the queries you need
cur = db.cursor()

# Use all the SQL you like
cur.execute("SELECT  email FROM users")

print(cur.execute("Select email from users")

# print all the first cell of all the rows

db.close()
