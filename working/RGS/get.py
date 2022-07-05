import requests

while (1):
	x = requests.get('https://www.rgscp.in/')
	print(x.status_code)
	pass
