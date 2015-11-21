import sys
import csv

def intersect(a, b):
    """ return the intersection of two lists """
    return list(set(a) & set(b))

def union(a, b):
    """ return the union of two lists """
    return list(set(a) | set(b))

def combinarA(x,y):
	return (x,y,"A")

def combinarB(x,y):
	return (x,y,"B")

def printCSV(list,file):
	with open(file, 'wb') as myfile:
	    wr = csv.writer(myfile, quoting=csv.QUOTE_ALL)
	    wr.writerow(list)

#print sys.argv[1]
file_input = sys.argv[1]
file_output = sys.argv[2]

reader = csv.reader(open(file_input, 'rb'))

name_exist = []
ax = []
ay = []
bx = []
by = []
for index,row in enumerate(reader) : 
	if not row[0].isdigit() :
		continue
	if row[0] in name_exist :
		break
	name_exist.append(row[0])

	row[1] = row[1].replace("TRUE","1")
	row[2] = row[2].replace("TRUE","1")
	row[3] = row[3].replace("TRUE","1")
	row[4] = row[4].replace("TRUE","1")

	row[1] = row[1].replace("FALSE",row[1].replace("","0"))
	row[2] = row[2].replace("FALSE",row[2].replace("","0"))
	row[3] = row[3].replace("FALSE",row[3].replace("","0"))
	row[4] = row[4].replace("FALSE",row[4].replace("","0"))

	if (len(row[1])==0):
		row[1] = "0"
	if (len(row[2])==0):
		row[2] = "0"
	if (len(row[3])==0):
		row[3] = "0"
	if (len(row[4])==0):
		row[4] = "0"

	ax.append(row[0]*int(row[1]))
	ay.append(row[0]*int(row[2]))
	bx.append(row[0]*int(row[3]))
	by.append(row[0]*int(row[4]))

ax = intersect(ax,name_exist)
ay = intersect(ay,name_exist)
bx = intersect(bx,name_exist)
by = intersect(by,name_exist)

a = map(combinarA,ax,ay)
b = map(combinarB,bx,by)

output = union(a,b)

printCSV(output,file_output)
