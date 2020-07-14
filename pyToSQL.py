import sys
import csv
import xml.dom.minidom
document = xml.dom.minidom.parse(sys.argv[1])
infile = sys.argv[2]
data = []
tableElements = document.getElementsByTagName('table')
data.append("exchange")
data.append("symbol")
data.append("company")
data.append("volume")
data.append("price")
data.append("change")
','.join(data)
for tr in tableElements[2].getElementsByTagName('tr')[1:]:
    data = []
    data.append("Nasdaq")
    for td in tr.getElementsByTagName('td'):
        for a in td.getElementsByTagName('a'):
            for node in a.childNodes:
                if node.nodeType == node.TEXT_NODE:
                    x = node.nodeValue
                    a,b = x.split('(')
                    data.append(b[:-2])
                    data.append(a[:-1])
        for node in td.childNodes:
            if node.nodeType == node.TEXT_NODE:
                data.append(node.nodeValue)
    del data[-1]
    del data[0] 
    del data[2]
    output = ','.join(data)

def insert(cursor):
    query = 'INSERT INTO stockexchange(exchange, symbol, company, volume, price, change) VALUES (%s,%s,%s,%d,%d,%d)'
    args = (output)

try:
    db = mysql.connector.connect(host='localhost', user='root',database='mysql')
    cursor = db.cursor()

    insert(cursor)
    db.commit()

    cursor.close()
except mysql.connector.Error as err:
    print(err)
finally:
    try:
        db
    except NameError:
        pass
    else:
        db.close()
