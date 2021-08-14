## _Documentation_

### /
- Request method: GET.
- Returns all the uploaded files names.

### /upload
- Request method: POST.
- Request body: {"file": "base64 encoded file (Data URI)"}
- Returns feedback message.

### /download
- Request method: POST.
- Request body: {"file": "the name of the file."}
- Returns The File.

### /delete
- Request method: POST.
- Request body: {"file": "the name of the file."}
- Returns feedback message.