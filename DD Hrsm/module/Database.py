import pymysql
import datetime

class dba:
    def connect(self):
        return pymysql.connect("localhost","root","","hrms" )


    def insert(self,data):
        con = dba.connect(self)
        cursor = con.cursor()
        
        try:
            cursor.execute("INSERT INTO dd(name,email,password,type) VALUES( '"+data['name']+"','"+data['email']+"','"+data['password']+"','customer')")
            #cursor.execute("INSERT INTO dd(name,email,password) VALUES(\'%s\',\'%s\',\'%s\')"%(data['name'],data['email'],data['password'],))

            #cursor.execute("INSERT INTO test1(name,password) VALUES( '"+data['username']+"','"+data['password']+"')")
            con.commit()
            return True
        except:
            con.rollback()
            return False
        finally:
            con.close()

    def check_login(self,data):
        con = dba.connect(self)
        cursor = con.cursor()
        try:
            print(data)
            cursor.execute("SELECT * FROM dd WHERE name = %s and password = %s ",(data['name'],data['password']))
            return cursor.fetchall()
        except:
            return()
        finally:
            con.close()

