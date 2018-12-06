#encoding:utf-8
import MySQLdb,io
#连接数据库
db=MySQLdb.connect("127.0.0.1","sql140_143_28_2","PEBBh7YP4H","sql140_143_28_2",charset='utf8')
with io.open('cityCode.txt','r',encoding='utf-8') as f:
    cursor=db.cursor()
    num=0#记录id号
    for line in f.readlines():
        num+=1
        line=line.strip()
        sql= "update ins_county set weather_info = '"+line+"' where id = "+str(num)
        print(num)
        try:
            cursor.execute(sql)
            db.commit()
        except:
            db.rollback()
db.close()