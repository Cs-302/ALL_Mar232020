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
cur.execute("UPDATE users  SET visits=0 WHERE visits is NULL;")
cur.execute("UPDATE users SET status = 'silver' WHERE visits < 11")
cur.execute("UPDATE users SET status = 'gold' WHERE visits > 10 AND visits < 21")
cur.execute("UPDATE users SET status = 'diamond' WHERE visits > 20")
db.commit()

# print all the first cell of all the rows

db.close()
