# Content Scheduler

Laravel Social Post Scheduler
A Laravel-based backend API and basic frontend to schedule social media posts across multiple platforms (Twitter, Instagram, LinkedIn, Facebook, etc.). Supports user authentication, platform selection, post scheduling, analytics, and activity logging.

# Features
 - User registration and login with Laravel Sanctum API authentication

 - Create, update, delete posts with multiple platform selection

 - Schedule posts for future publishing with status management (draft, scheduled, published)

 - Validation rules including platform-specific content limits (e.g., Twitter 280 chars)

 - Post analytics by platform and publishing status

 - Rate limiting: max 10 scheduled posts per user per day

 - Activity logging of user actions (create, update, delete)

 - Basic frontend with Post Editor, Dashboard, and Platform Settings

## 🚀 Requirements

- PHP >= 8.1
- Composer
- Laravel ^11
- MySQL


## 🔧 Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/amanyzalat/ContentScheduler.git
   cd your-laravel-project

2. **Install dependencies:**
    composer install
    

3. **Set up environment file:**
    cp .env.example .env
    php artisan key:generate

4. **Configure .env and set your database credentials.**
5. **Run migrations ( with seeders):**
   php artisan migrate --seed
6. **Serve the application:**
   php artisan serve
  

# API Endpoints
 1. **POST /api/register** — Register a new user

 2. **POST /api/login** — Login user and get token

3. **GET /api/posts** — List user posts with filters

4. **POST /api/posts** — Create a new post with platforms

5. **PUT /api/posts/{id}** — Update scheduled post

6. **DELETE /api/posts/{id}** — Delete a post

7. **GET /api/platforms** — List available platforms

8. **POST /api/platforms/toggle** — Toggle active platforms for user

9. **GET /api/activity-log** — View user activity logs

#  Activity Logging
User actions such as post creation, updates, and deletions are logged and viewable in the Activity Log panel.

# Rate Limiting
Users can schedule up to 10 posts per day. Exceeding this limit returns a validation error.

# License
This project is licensed under the MIT License.

# Contribution
Feel free to open issues or submit pull requests.


