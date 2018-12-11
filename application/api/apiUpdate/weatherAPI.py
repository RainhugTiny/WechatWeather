#encoding:utf-8
import requests
import time
import re,io
import os

#正则匹配citycode
cityCode=[]
with io.open('ins_city.sql','r',encoding="utf-8") as f:
    str=f.read()
    cityCode = re.findall(r"', '(\d+?)', null, '2018/7/29", str)

headers={'User-Agent':'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0'}
if os.path.exists('cityCode.txt'):
    os.remove('cityCode.txt')
startTime=time.time()
    #读取每一个cityCode构建一个url请求，将返回json数据存入文件
with io.open('cityCode.txt', 'w', encoding="utf-8") as f:
    for code in cityCode:
        time.sleep(0.2)
        url= "http://t.weather.sojson.com/api/weather/city/" + code
        r=requests.get(url,headers=headers)
        print(url)
        f.write(r.text+'\n')
    print('[info]耗时:%s'%(time.time()-startTime))
