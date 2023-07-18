import requests
import json
headers = {'Authorization': 'Basic MjE3ZDJkODNiYmUzZjdkY2Y2YzBkMmI5ODYxYjhhNjc6ZDg1ZWVjNWRiNDA3YTdhZDIyZGU0MjY1ODM2MzRkMjg='}
response = requests.get('https://domain/api/2.0/admin/customers/customer-info/2', headers=headers)
print(response.json())
with open("readme.csv", "a") as outfile:
    json.dump(response.json()+ '\n', outfile)
