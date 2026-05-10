# Day 10: REST API with Sanctum Authentication

## Overview
Day 10 implements a full REST API with Sanctum bearer token authentication. All API endpoints are protected and return JSON responses using API Resources.

---

## API Endpoint Reference

### **Authentication Endpoints**

| Method | Endpoint | Auth | Purpose | Request Body |
|--------|----------|------|---------|--------------|
| POST | `/api/login` | No | Get Sanctum token | `{ "email": "user@example.com", "password": "password123" }` |
| POST | `/api/logout` | ✅ Bearer | Revoke current token | (empty) |
| GET | `/api/user` | ✅ Bearer | Get current user | (empty) |

### **Projects Endpoints**

| Method | Endpoint | Auth | Purpose | Response |
|--------|----------|------|---------|----------|
| GET | `/api/projects` | ✅ Bearer | List user's projects | `ProjectResource[]` |
| POST | `/api/projects` | ✅ Bearer | Create project | `ProjectResource` |
| GET | `/api/projects/{id}` | ✅ Bearer | Get project details | `ProjectResource` |
| PUT | `/api/projects/{id}` | ✅ Bearer | Update project | `ProjectResource` |
| DELETE | `/api/projects/{id}` | ✅ Bearer | Delete project | `{ "message": "..." }` |

### **Tasks Endpoints (under Projects)**

| Method | Endpoint | Auth | Purpose | Response |
|--------|----------|------|---------|----------|
| GET | `/api/projects/{project_id}/tasks` | ✅ Bearer | List project tasks | `TaskResource[]` |
| POST | `/api/projects/{project_id}/tasks` | ✅ Bearer | Create task | `TaskResource` |
| GET | `/api/projects/{project_id}/tasks/{id}` | ✅ Bearer | Get task details | `TaskResource` |
| PUT | `/api/projects/{project_id}/tasks/{id}` | ✅ Bearer | Update task | `TaskResource` |
| DELETE | `/api/projects/{project_id}/tasks/{id}` | ✅ Bearer | Delete task | `{ "message": "..." }` |

---

## API Resources

### **ProjectResource**
```json
{
    "id": 1,
    "name": "Project Name",
    "description": "Project description",
    "status": "pending|in_progress|completed",
    "user_id": 1,
    "owner": {
        "id": 1,
        "name": "Owner Name",
        "email": "owner@example.com"
    },
    "tasks_count": 5,
    "created_at": "2026-05-10T12:00:00Z",
    "updated_at": "2026-05-10T12:00:00Z"
}
```

### **TaskResource**
```json
{
    "id": 1,
    "title": "Task Title",
    "description": "Task description",
    "status": "todo|in_progress|done",
    "due_date": "2026-05-20",
    "project_id": 1,
    "assigned_to_id": 2,
    "assigned_to": {
        "id": 2,
        "name": "Assignee Name",
        "email": "assignee@example.com"
    },
    "created_at": "2026-05-10T12:00:00Z",
    "updated_at": "2026-05-10T12:00:00Z"
}
```

---

## Authentication Flow

### **1. Login to get Token**
```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email": "john@example.com", "password": "password123"}'
```

**Response:**
```json
{
    "message": "Login successful",
    "user": {
        "id": 49,
        "name": "John Admin",
        "email": "john@example.com",
        "role": "admin"
    },
    "token": "1|ABC123DEF456GHI789JKL012..."
}
```

### **2. Use Token in Subsequent Requests**
```bash
curl -X GET http://localhost:8000/api/projects \
  -H "Authorization: Bearer 1|ABC123DEF456GHI789JKL012..."
```

### **3. Logout (Revoke Token)**
```bash
curl -X POST http://localhost:8000/api/logout \
  -H "Authorization: Bearer 1|ABC123DEF456GHI789JKL012..."
```

---

## Implementation Details

### **Sanctum Setup**
- ✅ `composer require laravel/sanctum` — Package installed
- ✅ `php artisan vendor:publish --provider='Laravel\Sanctum\SanctumServiceProvider'` — Config published
- ✅ `php artisan migrate` — personal_access_tokens table created
- ✅ `HasApiTokens` trait added to User model
- ✅ `auth:sanctum` middleware protecting all protected routes

### **API Controllers** (`app/Http/Controllers/Api/`)
- ✅ `ProjectController` — Full CRUD with authorization
- ✅ `TaskController` — Full CRUD with authorization

### **API Resources** (`app/Http/Resources/`)
- ✅ `ProjectResource` — Transforms Project model to JSON
- ✅ `TaskResource` — Transforms Task model to JSON

---

## Error Responses

### **401 Unauthorized (Invalid credentials)**
```json
{
    "message": "Invalid credentials"
}
```

### **403 Forbidden (Not authorized to perform action)**
```json
{
    "message": "This action is unauthorized."
}
```

### **404 Not Found**
```json
{
    "message": "No query results found for model [App\\Models\\Project]."
}
```

### **422 Unprocessable Entity (Validation failed)**
```json
{
    "message": "The email field is required.",
    "errors": {
        "email": ["The email field is required."]
    }
}
```

---

## Testing in Postman

### **Import Collection**
- Location: `/postman/collection.json`
- Pre-configured with all endpoints
- Environment variables for base URL and token

### **Testing Workflow**
1. **POST /api/login** — Get token from response
2. Use token in `Authorization` header for all subsequent requests
3. **GET /api/projects** — List projects
4. **POST /api/projects** — Create a project
5. **GET /api/projects/{id}** — View project details
6. **PUT /api/projects/{id}** — Update project
7. **DELETE /api/projects/{id}** — Delete project
8. **POST /api/logout** — Revoke token

---

## Authorization

All API endpoints respect the same authorization policies as the web app:
- **Projects**: Owner can update/delete; owner OR team member can view
- **Tasks**: Owner of project can update/delete; owner OR project member can view/update

---

## Files Modified/Created

| File | Change |
|------|--------|
| `app/Models/User.php` | Added `HasApiTokens` trait |
| `app/Http/Resources/ProjectResource.php` | Created |
| `app/Http/Resources/TaskResource.php` | Created |
| `app/Http/Controllers/Api/ProjectController.php` | Created |
| `app/Http/Controllers/Api/TaskController.php` | Created |
| `routes/api.php` | Implemented all endpoints |
| `postman/collection.json` | Created with all endpoints |

---

## References

- [Laravel Sanctum Documentation](https://laravel.com/docs/sanctum)
- [API Resources](https://laravel.com/docs/eloquent-resources)
- [Postman Collection](./postman/collection.json)
