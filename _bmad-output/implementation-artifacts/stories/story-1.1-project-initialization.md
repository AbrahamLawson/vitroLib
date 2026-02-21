# Story 1.1: Project Initialization

## Story Info
- **Epic:** 1 - Foundation & User Authentication
- **Status:** done
- **Priority:** Critical (Foundation)

## Description

As a **developer**,
I want **to initialize the Laravel project with DDD structure**,
So that **the codebase follows the architectural decisions documented**.

## Acceptance Criteria

- [x] Laravel 11 is installed
- [x] DDD folder structure created (src/Domain, src/Application, src/Infrastructure)
- [x] Docker compose configured with PostgreSQL 16, Redis 7
- [x] Base configuration files set up (strict_types, composer autoload)
- [x] Sanctum installed for API authentication
- [x] Basic project runs successfully

## Technical Tasks

### Task 1: Laravel Installation
```bash
composer create-project laravel/laravel vitrolib
```

### Task 2: DDD Structure
```
src/
├── Domain/
│   ├── Mission/
│   ├── User/
│   ├── Payment/
│   └── Shared/
├── Application/
│   ├── Commands/
│   ├── Queries/
│   └── Handlers/
└── Infrastructure/
    ├── Persistence/
    └── Serializers/
```

### Task 3: Docker Compose
- PostgreSQL 16 with PostGIS
- Redis 7
- Meilisearch
- Mailpit (dev)

### Task 4: Composer Autoload
```json
"autoload": {
    "psr-4": {
        "App\\": "app/",
        "Domain\\": "src/Domain/",
        "Application\\": "src/Application/",
        "Infrastructure\\": "src/Infrastructure/"
    }
}
```

### Task 5: PHP Config
- strict_types=1 in all files
- PHP 8.2+ required

## Dev Notes

Architecture document: `_bmad-output/planning-artifacts/architecture.md`
