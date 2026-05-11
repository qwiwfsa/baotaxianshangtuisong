import http.client, uuid, json

conn = http.client.HTTPConnection('localhost', 3000, timeout=5)
boundary = str(uuid.uuid4())

# Build multipart body
lines = []
lines.append('--' + boundary)
lines.append('Content-Disposition: form-data; name="file"; filename="test.jpg"')
lines.append('Content-Type: image/jpeg')
lines.append('')
lines.append('fakeimagedata')
lines.append('--' + boundary + '--')
body = '\r\n'.join(lines)

headers = {'Content-Type': 'multipart/form-data; boundary=' + boundary}
conn.request('POST', '/api/upload', body.encode(), headers)
resp = conn.getresponse()
print('Status:', resp.status, resp.reason)
data = resp.read().decode('utf-8')
print('Body:', data[:1000])
conn.close()
