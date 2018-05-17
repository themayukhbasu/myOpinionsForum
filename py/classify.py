import lib
import mysql.connector
from mysql.connector import Error


#lib.dummy_check()
v_host = 'localhost'
v_database = 'forum'
v_user = 'root'
v_password = 'cool123'

def main_classify(v_host, v_database, v_user, v_password):
	data = []
	try:
		conn = mysql.connector.connect(host = v_host,database = v_database,user = v_user,password = v_password)
		if conn.is_connected():
			print "Connected to MySql database";
			curA = conn.cursor(buffered=True);
			curB = conn.cursor(buffered=True);
			### Note: In Python, a tuple containing a single value must include a comma. For example, ('abc') is evaluated as a scalar while ('abc',) is evaluated as a tuple.

			query = "select data_id, fk_user_id, data from data where moderation = %s"
			update_moderation = "update data set moderation = %s where data_id = %s AND fk_user_id = %s"
			curA.execute(query,(-1,));
			
			for (data_id, user_id, dat) in curA:
				#print type(dat.decode())
				dat = dat.decode()
				spam_flag = int(lib.moderation_check(dat)[0])
				print spam_flag
				curB.execute(update_moderation,(spam_flag, data_id, user_id))

				conn.commit()		

	except Error as e:
		print(e)
	finally:
		curA.close()
		conn.close()


#########################################

main_classify(v_host, v_database, v_user, v_password)

#########################################