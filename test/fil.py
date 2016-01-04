fr = open('300201.csv', 'r')
fw = open('300201_edited.csv', 'w')
for line in fr:
	t = fr.readline().split(',')
	date = "\"" + t[0] + "-" + t[1] + "-" + t[2] +"\""
	following = ",".join(t[3:])
	s = date + "," + following
	print(s)
	fw.write(s)
fr.close()
fw.close()
