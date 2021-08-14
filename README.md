## 🧾 Installation

1. `git clone https://github.com/SamyMuhammad/files-crud-task.git files-crud`
2. `files-crud`
3. Install dependencies using CLI:

   `composer install`

4. `cp .env.example .env`
5. `php artisan key:generate`
6. Set your `.env` with your domain config (`APP_URL`).
7. Run your server `php artisan serve`.


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
