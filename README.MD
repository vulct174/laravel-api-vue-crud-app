# Laravel API + Vue CRUD Blog Application

A full-stack blog application built with Laravel API backend and Vue.js frontend, implementing complete CRUD operations.

## Project Structure

The project is divided into two main parts:
- `backend-laravel-api-blog`: Laravel REST API backend
- `frontend-vue-blog`: Vue.js frontend application

## Backend Setup (Laravel API)

### Prerequisites
- PHP >= 8.1
- Composer
- MySQL/MariaDB
- Laravel CLI

### Installation Steps

1. Navigate to backend directory:
```bash
cd backend-laravel-api-blog
```

2. Install dependencies:
```bash
composer install
```

3. Create environment file:
```bash
cp .env.example .env
```

4. Configure your database settings in `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Run migrations and seeders:
```bash
php artisan migrate --seed
```

7. Start the development server:
```bash
php artisan serve
```

The API will be available at `http://localhost:8000`

## Frontend Setup (Vue.js)

### Prerequisites
- Node.js >= 16
- npm or yarn

### Installation Steps

1. Navigate to frontend directory:
```bash
cd frontend-vue-blog
```

2. Install dependencies:
```bash
npm install
# or
yarn install
```

3. Configure API endpoint:
Create `.env` file in frontend directory:
```
VITE_API_URL=http://localhost:8000/api
```

4. Start development server:
```bash
npm run dev
# or
yarn dev
```

The application will be available at `http://localhost:5173`

## Features

- RESTful API with Laravel
- JWT Authentication
- CRUD Operations for Blog Posts
- Responsive Vue.js Frontend
- Form Validation
- Error Handling
- Pagination

## API Endpoints

### Authentication
- `POST /api/auth/login` - User login
- `POST /api/auth/register` - User registration
- `POST /api/auth/logout` - User logout
- `GET /api/auth/user` - Get authenticated user

### Posts
- `GET /api/posts` - List all posts
- `GET /api/posts/{id}` - Get single post
- `POST /api/posts` - Create new post
- `PUT /api/posts/{id}` - Update post
- `DELETE /api/posts/{id}` - Delete post

## Directory Structure

### Backend
```
backend-laravel-api-blog/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Middleware/
│   ├── Models/
│   └── Services/
├── database/
│   ├── migrations/
│   └── seeders/
├── routes/
│   └── api.php
└── tests/
```

### Frontend
```
frontend-vue-blog/
├── src/
│   ├── components/
│   ├── views/
│   ├── router/
│   ├── store/
│   └── services/
├── public/
└── index.html
```

## Development

### Backend Development
- Follow Laravel best practices
- Use repository pattern for data access
- Implement proper validation and error handling
- Write tests for critical functionality

### Frontend Development
- Follow Vue.js composition API patterns
- Use Vuex for state management
- Implement proper form validation
- Use Vue Router for navigation

## Testing

### Backend Tests
```bash
cd backend-laravel-api-blog
php artisan test
```

### Frontend Tests
```bash
cd frontend-vue-blog
npm run test
```

## Deployment

1. Backend Deployment:
   - Configure production database
   - Set up proper environment variables
   - Run migrations
   - Configure web server (nginx/Apache)

2. Frontend Deployment:
   - Build production assets:
     ```bash
     npm run build
     ```
   - Deploy `dist` directory to web server
   - Configure web server for SPA routing

## Contributing

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a new Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.