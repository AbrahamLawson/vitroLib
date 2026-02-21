---
stepsCompleted: ['step-01-init', 'step-02-context', 'step-03-starter', 'step-04-decisions', 'step-05-patterns', 'step-06-structure', 'step-07-validation', 'step-08-complete']
inputDocuments: ['prd.md', 'product-brief-vitroLib-2026-02-20.md', 'brainstorming-session-2026-02-15.md']
workflowType: 'architecture'
project_name: 'vitroLib'
user_name: 'Lawsonabraham'
date: '2026-02-20'
status: 'complete'
completedAt: '2026-02-21'
---

# Architecture Decision Document - VitroLib

_This document builds collaboratively through step-by-step discovery. Sections are appended as we work through each architectural decision together._

## Project Context Analysis

### Requirements Overview

**Functional Requirements:**
35 FRs organisés en 8 domaines fonctionnels couvrant le cycle complet d'une mission vitrage : de la publication par le garage jusqu'au paiement du technicien avec gestion des litiges.

**Non-Functional Requirements:**
33 NFRs définissant une architecture DDD avec CQRS, containerisée (Docker), testée en TDD (80% coverage), avec performance temps réel (WebSockets < 500ms).

**Scale & Complexity:**
- Primary domain: Full-stack Web SaaS B2B
- Complexity level: Medium-High
- Estimated architectural components: 4 Bounded Contexts

### Technical Constraints & Dependencies

| Contrainte | Source | Impact |
|------------|--------|--------|
| Laravel 11 | Expertise équipe | Framework imposé |
| Vue.js 3 SPA | UX Dashboard | Frontend séparé |
| Stripe Connect | Paiement séquestre | Event webhooks |
| Docker | NFR26 | Containerisation obligatoire |
| DDD + CQRS | NFR15-16 | Structure code imposée |

### Cross-Cutting Concerns Identified

1. **Authentication & RBAC** — Sanctum + middleware rôles
2. **Real-time Events** — Laravel Reverb broadcasting
3. **Audit Trail** — Logging structuré JSON
4. **Error Resilience** — Retry queues, circuit breaker
5. **File Management** — S3 abstraction, validation images

## Starter Template Evaluation

### Primary Technology Domain

Full-stack Laravel 11 + Vue.js 3 SPA avec architecture DDD et Design System.

### Starter Options Considered

| Option | Évaluation |
|--------|------------|
| Laravel Fresh | ✅ Contrôle total, compatible NFRs |
| Spatie CRUD | ⚠️ Patterns différents du CQRS demandé |
| Laravel Breeze | ❌ Trop simple, pas de DDD |

### Selected Starter: Laravel Fresh + DDD Structure + Design System

**Rationale for Selection:**
Architecture DDD/CQRS spécifique demandée dans les NFRs (NFR15-21) incompatible avec les starters existants. Setup manuel garantit conformité exacte aux requirements.

**Initialization Command:**

```bash
# Base Laravel
laravel new vitrolib --git
cd vitrolib

# Backend dependencies
composer require laravel/sanctum laravel/reverb stripe/stripe-php

# Frontend + Design System
npm install vue@3 @vitejs/plugin-vue tailwindcss
npx storybook@latest init --type vue3
npm install @storybook/addon-a11y lucide-vue-next
```

### Architectural Decisions Provided by Starter

**Language & Runtime:**
- PHP 8.2+ avec Laravel 11
- TypeScript optionnel pour Vue.js

**Styling Solution:**
- TailwindCSS 3.x
- Blade pour pages publiques (SEO)
- Vue.js SPA pour dashboard

**Build Tooling:**
- Vite (natif Laravel 11)
- docker-compose pour dev

**Testing Framework:**
- PHPUnit + Pest pour backend
- Vitest pour Vue.js components

**Code Organization:**
- Structure DDD : Domain → Application → Infrastructure → Presentation
- Bounded Contexts : Mission, User, Payment, Shared

### Design System Architecture

**Approach:** Atomic Design (Atoms → Molecules → Organisms → Templates)

**Tools:**
- Storybook 8 pour documentation et développement isolé
- TailwindCSS pour styling
- Lucide pour iconographie
- Design Tokens CSS custom

**Component Library Structure:**

| Layer | Exemples | Responsabilité |
|-------|----------|----------------|
| `atoms/` | Button, Input, Badge, Icon | Éléments de base |
| `molecules/` | Card, FormField, Alert | Combinaisons simples |
| `organisms/` | MissionCard, TechnicianProfile | Composants métier |
| `templates/` | DashboardLayout, PublicLayout | Structures de page |

## Core Architectural Decisions

### Decision Priority Analysis

**Critical Decisions (Block Implementation):**
- Database: PostgreSQL 16
- Caching/Queue: Redis 7
- Authentication: Laravel Sanctum
- Real-time: Laravel Reverb

**Important Decisions (Shape Architecture):**
- API Style: REST with versioning
- State Management: Pinia
- Search: Meilisearch
- File Storage: S3 + Minio

### Data Architecture

| Décision | Choix | Version | Rationale |
|----------|-------|---------|-----------|
| **Database** | PostgreSQL | 16.x | JSON natif, PostGIS pour géoloc, full-text search |
| **ORM** | Eloquent | Laravel 11 | Natif, scopes multi-tenancy |
| **Caching** | Redis | 7.x | Sessions, queues, pub/sub Reverb |
| **Search** | Meilisearch | 1.x | Recherche géo missions, typo-tolerant |
| **Migrations** | Laravel Migrations | - | Versionning DB, rollback |

### Authentication & Security

| Décision | Choix | Rationale |
|----------|-------|-----------|
| **Auth** | Laravel Sanctum | SPA tokens, API tokens |
| **RBAC** | Spatie Permission | Rôles Garage/Technicien/Admin |
| **Encryption** | bcrypt + AES-256 | Passwords + données sensibles |
| **Rate Limiting** | Laravel native | 60 req/min API |

### API & Communication Patterns

| Décision | Choix | Rationale |
|----------|-------|-----------|
| **API Style** | REST | Simplicité, API Resources Laravel |
| **Versioning** | URL `/api/v1/` | Clarté, migration facile |
| **Documentation** | Scribe | Génération auto OpenAPI |
| **Error Format** | RFC 7807 Problem Details | Standard, machine-readable |
| **Real-time** | Laravel Reverb | WebSockets natif, private channels |

### Frontend Architecture

| Décision | Choix | Rationale |
|----------|-------|-----------|
| **State Management** | Pinia | Officiel Vue 3, TypeScript |
| **HTTP Client** | Axios | Interceptors, retry, cancel |
| **Form Validation** | VeeValidate + Zod | Validation client + schémas |
| **Routing** | Vue Router 4 | SPA navigation |
| **Icons** | Lucide Vue | Léger, tree-shakeable |

### Infrastructure & Deployment

| Décision | Choix | Rationale |
|----------|-------|-----------|
| **File Storage** | S3 (prod) + Minio (dev) | Abstraction Flysystem |
| **Queue Driver** | Redis | Performance, retry, delay |
| **Monitoring Dev** | Laravel Telescope | Debug queries, jobs, events |
| **Monitoring Prod** | Sentry | Errors, performance |
| **Logging** | JSON structured | ELK-ready, audit trail |

### Decision Impact Analysis

**Implementation Sequence:**
1. Docker setup (PostgreSQL, Redis, Minio, Meilisearch)
2. Laravel base + Sanctum auth
3. DDD structure + first Bounded Context
4. Vue.js SPA + Pinia + Design System
5. Real-time avec Reverb

## Implementation Patterns & Consistency Rules

### PHP Strict Conventions

**Obligatoire dans TOUS les fichiers PHP :**

```php
<?php

declare(strict_types=1);

namespace Domain\Mission\Entities;
```

### Classes Final, Abstract, Readonly

| Type de Classe | Convention | Exemple |
|----------------|------------|---------|
| Entities | `final class` | `final class Mission` |
| Value Objects | `final readonly class` | `final readonly class Address` |
| DTOs | `final readonly class` | `final readonly class MissionDTO` |
| Commands/Queries | `final readonly class` | `final readonly class CreateMissionCommand` |
| Handlers | `final class` | `final class CreateMissionHandler` |
| Repositories Impl | `final class` | `final class EloquentMissionRepository` |
| Services Abstract | `abstract class` | `abstract class BasePaymentService` |
| Exceptions | `extends` | `class MissionNotFoundException extends DomainException` |
| Controllers | `final class` | `final class CreateMissionController` |
| Serializers | `final readonly class` | `final readonly class MissionSerializer` |

### Controllers Invokable (Single Action)

**1 action = 1 controller, méthode `__invoke()` uniquement**

```php
final class CreateMissionController extends Controller
{
    public function __construct(
        private readonly CreateMissionHandler $handler,
        private readonly MissionSerializer $serializer,
    ) {}

    public function __invoke(CreateMissionRequest $request): JsonResponse
    {
        $command = new CreateMissionCommand(...);
        $mission = $this->handler->handle($command);

        return response()->json([
            'data' => $this->serializer->serialize($mission),
        ], 201);
    }
}
```

**Structure Controllers :**
```
app/Http/Controllers/Api/V1/
├── Mission/
│   ├── CreateMissionController.php
│   ├── ListMissionsController.php
│   ├── ShowMissionController.php
│   ├── AcceptMissionController.php
│   └── CompleteMissionController.php
```

### Serializers DDD (Réponses API)

**Serializers pour servir les réponses HTTP (pas API Resources Laravel) :**

```php
final readonly class MissionSerializer
{
    public function __construct(
        private AddressSerializer $addressSerializer,
        private GarageSerializer $garageSerializer,
    ) {}

    public function serialize(Mission $mission): array
    {
        return [
            'id' => $mission->getId()->value(),
            'title' => $mission->getTitle(),
            'status' => $mission->getStatus()->value,
            'address' => $this->addressSerializer->serialize($mission->getAddress()),
            'created_at' => $mission->getCreatedAt()->format(\DateTimeInterface::ATOM),
        ];
    }

    public function serializeCollection(iterable $missions): array
    {
        return array_map(fn($m) => $this->serializeList($m), iterator_to_array($missions));
    }
}
```

**Structure Serializers :**
```
src/Infrastructure/Serializers/
├── Mission/
│   └── MissionSerializer.php
├── User/
│   ├── GarageSerializer.php
│   └── TechnicianSerializer.php
└── Shared/
    ├── AddressSerializer.php
    └── MoneySerializer.php
```

### FormRequest (Validation)

```php
final class CreateMissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', Mission::class);
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:10', 'max:255'],
            'address.postal_code' => ['required', 'regex:/^\d{5}$/'],
        ];
    }
}
```

### Policies (Authorization)

```php
final class MissionPolicy
{
    public function view(User $user, Mission $mission): bool
    {
        return $user->isAdmin()
            || $mission->garage_id === $user->garage_id
            || $mission->technician_id === $user->id;
    }

    public function create(User $user): bool
    {
        return $user->isGarage();
    }
}
```

### Naming Conventions

**Database (PostgreSQL) :**
| Élément | Convention | Exemple |
|---------|------------|---------|
| Tables | `snake_case` pluriel | `missions`, `garage_users` |
| Colonnes | `snake_case` | `created_at`, `garage_id` |
| Foreign Keys | `{table_singulier}_id` | `mission_id` |

**API REST :**
| Élément | Convention | Exemple |
|---------|------------|---------|
| Endpoints | `kebab-case` pluriel | `/api/v1/missions` |
| Query params | `snake_case` | `?page_size=10` |

**Code PHP :**
| Élément | Convention | Exemple |
|---------|------------|---------|
| Classes | `PascalCase` | `MissionService` |
| Méthodes | `camelCase` | `findByGarage()` |
| Variables | `camelCase` | `$missionId` |

**Code Vue.js :**
| Élément | Convention | Exemple |
|---------|------------|---------|
| Components | `PascalCase` | `MissionCard.vue` |
| Composables | `use{Name}` | `useMissions()` |
| Stores | `use{Name}Store` | `useMissionStore` |

### API Response Format

```json
{
  "data": { ... },
  "meta": {
    "timestamp": "2026-02-21T01:45:00Z",
    "request_id": "uuid"
  }
}
```

**Error (RFC 7807) :**
```json
{
  "type": "https://vitrolib.com/errors/mission-not-found",
  "title": "Mission Not Found",
  "status": 404,
  "detail": "Mission with ID 123 does not exist"
}
```

### Enums PHP 8.1+

```php
enum MissionStatus: string
{
    case PENDING = 'pending';
    case ACCEPTED = 'accepted';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'En attente',
            self::COMPLETED => 'Terminée',
            // ...
        };
    }
}
```

### Vue.js Composition API

```vue
<script setup lang="ts">
// 1. Vue core
import { ref, computed, onMounted } from 'vue'
// 2. Stores
import { useMissionStore } from '@/stores/mission'
// 3. Composables
import { useNotification } from '@/composables/useNotification'
// 4. Types
import type { Mission } from '@/types/mission'

const store = useMissionStore()
const { notify } = useNotification()

const isLoading = ref(false)

async function handleSubmit() {
  isLoading.value = true
  try {
    await store.createMission(data)
    notify.success('Mission créée')
  } finally {
    isLoading.value = false
  }
}
</script>
```

### Pinia Store Pattern

```typescript
export const useMissionStore = defineStore('mission', () => {
  const missions = ref<Mission[]>([])
  const isLoading = ref(false)

  const pendingMissions = computed(() => 
    missions.value.filter(m => m.status === 'pending')
  )

  async function fetchMissions() { ... }
  async function createMission(data: CreateMissionDTO) { ... }

  return { missions, isLoading, pendingMissions, fetchMissions, createMission }
})
```

### Enforcement Rules

**Tous les Agents AI DOIVENT :**
1. `declare(strict_types=1);` en ligne 3 de tout fichier PHP
2. `final class` pour Controllers, Handlers, Repositories, Serializers
3. `final readonly class` pour Value Objects, DTOs, Commands, Queries
4. Controllers invokables uniquement (1 action = 1 controller)
5. Serializers DDD pour les réponses API (pas API Resources)
6. FormRequest pour validation
7. Policies pour authorization
8. `snake_case` pour DB et JSON keys
9. `camelCase` pour code PHP/JS
10. ISO 8601 UTC pour dates JSON

## Project Structure & Boundaries

### Complete Project Directory Structure

```
vitrolib/
├── .docker/
│   ├── nginx/
│   │   └── default.conf
│   ├── php/
│   │   └── Dockerfile
│   └── node/
│       └── Dockerfile
├── .github/
│   └── workflows/
│       ├── ci.yml
│       ├── deploy-staging.yml
│       └── deploy-production.yml
├── docker-compose.yml
├── docker-compose.override.yml
├── Makefile
├── README.md
├── .env.example
├── .gitignore
│
├── composer.json
├── package.json
├── vite.config.ts
├── tailwind.config.js
├── tsconfig.json
├── phpunit.xml
├── phpstan.neon
├── .php-cs-fixer.php
│
├── src/
│   ├── Domain/
│   │   ├── Mission/
│   │   │   ├── Entities/
│   │   │   │   ├── Mission.php
│   │   │   │   └── MissionPhoto.php
│   │   │   ├── ValueObjects/
│   │   │   │   ├── MissionId.php
│   │   │   │   ├── MissionStatus.php
│   │   │   │   ├── VehicleType.php
│   │   │   │   └── GlassType.php
│   │   │   ├── Events/
│   │   │   │   ├── MissionCreated.php
│   │   │   │   ├── MissionAccepted.php
│   │   │   │   └── MissionCompleted.php
│   │   │   ├── Exceptions/
│   │   │   │   ├── MissionNotFoundException.php
│   │   │   │   └── InvalidMissionStatusTransitionException.php
│   │   │   └── Repositories/
│   │   │       └── MissionRepositoryInterface.php
│   │   │
│   │   ├── User/
│   │   │   ├── Entities/
│   │   │   │   ├── User.php
│   │   │   │   ├── Garage.php
│   │   │   │   └── Technician.php
│   │   │   ├── ValueObjects/
│   │   │   │   ├── UserId.php
│   │   │   │   ├── Email.php
│   │   │   │   ├── Phone.php
│   │   │   │   └── UserRole.php
│   │   │   ├── Events/
│   │   │   │   ├── GarageRegistered.php
│   │   │   │   └── TechnicianRegistered.php
│   │   │   ├── Exceptions/
│   │   │   │   └── UserNotFoundException.php
│   │   │   └── Repositories/
│   │   │       ├── UserRepositoryInterface.php
│   │   │       └── GarageRepositoryInterface.php
│   │   │
│   │   ├── Payment/
│   │   │   ├── Entities/
│   │   │   │   ├── Payment.php
│   │   │   │   └── Escrow.php
│   │   │   ├── ValueObjects/
│   │   │   │   ├── PaymentId.php
│   │   │   │   ├── Money.php
│   │   │   │   └── PaymentStatus.php
│   │   │   ├── Events/
│   │   │   │   ├── PaymentCaptured.php
│   │   │   │   └── PaymentReleased.php
│   │   │   ├── Exceptions/
│   │   │   │   └── PaymentFailedException.php
│   │   │   └── Repositories/
│   │   │       └── PaymentRepositoryInterface.php
│   │   │
│   │   └── Shared/
│   │       ├── ValueObjects/
│   │       │   ├── Address.php
│   │       │   ├── Coordinates.php
│   │       │   └── DateRange.php
│   │       └── Exceptions/
│   │           └── DomainException.php
│   │
│   ├── Application/
│   │   ├── Commands/
│   │   │   ├── Mission/
│   │   │   │   ├── CreateMissionCommand.php
│   │   │   │   ├── AcceptMissionCommand.php
│   │   │   │   └── CompleteMissionCommand.php
│   │   │   ├── User/
│   │   │   │   ├── RegisterGarageCommand.php
│   │   │   │   └── RegisterTechnicianCommand.php
│   │   │   └── Payment/
│   │   │       ├── CapturePaymentCommand.php
│   │   │       └── ReleaseEscrowCommand.php
│   │   │
│   │   ├── Queries/
│   │   │   ├── Mission/
│   │   │   │   ├── GetMissionQuery.php
│   │   │   │   ├── ListMissionsQuery.php
│   │   │   │   └── SearchNearbyMissionsQuery.php
│   │   │   └── User/
│   │   │       ├── GetGarageQuery.php
│   │   │       └── GetTechnicianQuery.php
│   │   │
│   │   ├── Handlers/
│   │   │   ├── Commands/
│   │   │   │   ├── CreateMissionHandler.php
│   │   │   │   ├── AcceptMissionHandler.php
│   │   │   │   └── CompleteMissionHandler.php
│   │   │   └── Queries/
│   │   │       ├── GetMissionHandler.php
│   │   │       └── ListMissionsHandler.php
│   │   │
│   │   ├── DTOs/
│   │   │   ├── Mission/
│   │   │   │   └── MissionDTO.php
│   │   │   ├── User/
│   │   │   │   ├── GarageDTO.php
│   │   │   │   └── TechnicianDTO.php
│   │   │   └── Shared/
│   │   │       ├── AddressDTO.php
│   │   │       └── PaginationDTO.php
│   │   │
│   │   └── Services/
│   │       ├── MissionApplicationService.php
│   │       └── PaymentApplicationService.php
│   │
│   └── Infrastructure/
│       ├── Persistence/
│       │   ├── Eloquent/
│       │   │   ├── Models/
│       │   │   │   ├── MissionModel.php
│       │   │   │   ├── UserModel.php
│       │   │   │   └── PaymentModel.php
│       │   │   └── Repositories/
│       │   │       ├── EloquentMissionRepository.php
│       │   │       ├── EloquentUserRepository.php
│       │   │       └── EloquentPaymentRepository.php
│       │   └── Mappers/
│       │       ├── MissionMapper.php
│       │       ├── UserMapper.php
│       │       └── PaymentMapper.php
│       │
│       ├── Serializers/
│       │   ├── Mission/
│       │   │   └── MissionSerializer.php
│       │   ├── User/
│       │   │   ├── GarageSerializer.php
│       │   │   └── TechnicianSerializer.php
│       │   ├── Payment/
│       │   │   └── PaymentSerializer.php
│       │   └── Shared/
│       │       ├── AddressSerializer.php
│       │       └── MoneySerializer.php
│       │
│       ├── ExternalServices/
│       │   ├── Stripe/
│       │   │   ├── StripePaymentService.php
│       │   │   └── StripeConnectService.php
│       │   ├── Meilisearch/
│       │   │   └── MissionSearchService.php
│       │   └── Storage/
│       │       └── S3FileService.php
│       │
│       └── Events/
│           └── LaravelEventDispatcher.php
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── Api/
│   │   │       └── V1/
│   │   │           ├── Mission/
│   │   │           │   ├── CreateMissionController.php
│   │   │           │   ├── ListMissionsController.php
│   │   │           │   ├── ShowMissionController.php
│   │   │           │   ├── AcceptMissionController.php
│   │   │           │   └── CompleteMissionController.php
│   │   │           ├── Auth/
│   │   │           │   ├── LoginController.php
│   │   │           │   ├── RegisterGarageController.php
│   │   │           │   └── RegisterTechnicianController.php
│   │   │           └── Payment/
│   │   │               ├── CreatePaymentIntentController.php
│   │   │               └── StripeWebhookController.php
│   │   │
│   │   ├── Requests/
│   │   │   ├── Mission/
│   │   │   │   ├── CreateMissionRequest.php
│   │   │   │   └── AcceptMissionRequest.php
│   │   │   └── Auth/
│   │   │       ├── LoginRequest.php
│   │   │       └── RegisterRequest.php
│   │   │
│   │   └── Middleware/
│   │       ├── SetTenantScope.php
│   │       ├── EnsureUserIsGarage.php
│   │       ├── EnsureUserIsTechnician.php
│   │       └── LogApiRequest.php
│   │
│   ├── Policies/
│   │   ├── MissionPolicy.php
│   │   └── PaymentPolicy.php
│   │
│   ├── Providers/
│   │   ├── AppServiceProvider.php
│   │   ├── AuthServiceProvider.php
│   │   ├── EventServiceProvider.php
│   │   ├── MissionServiceProvider.php
│   │   ├── PaymentServiceProvider.php
│   │   └── RouteServiceProvider.php
│   │
│   ├── Jobs/
│   │   ├── SendMissionNotificationsJob.php
│   │   ├── ProcessPaymentJob.php
│   │   └── ReleaseEscrowJob.php
│   │
│   ├── Notifications/
│   │   ├── MissionCreatedNotification.php
│   │   ├── MissionAcceptedNotification.php
│   │   └── PaymentReleasedNotification.php
│   │
│   ├── Events/
│   │   └── Broadcasting/
│   │       ├── MissionUpdatedEvent.php
│   │       └── NewMessageEvent.php
│   │
│   └── Listeners/
│       ├── SendMissionNotification.php
│       └── UpdateMeilisearchIndex.php
│
├── config/
│   ├── vitrolib.php
│   ├── services.php
│   └── broadcasting.php
│
├── database/
│   ├── migrations/
│   │   ├── 2026_01_01_000001_create_users_table.php
│   │   ├── 2026_01_01_000002_create_garages_table.php
│   │   ├── 2026_01_01_000003_create_technicians_table.php
│   │   ├── 2026_01_01_000004_create_missions_table.php
│   │   ├── 2026_01_01_000005_create_mission_photos_table.php
│   │   └── 2026_01_01_000006_create_payments_table.php
│   ├── factories/
│   │   ├── UserFactory.php
│   │   ├── GarageFactory.php
│   │   ├── TechnicianFactory.php
│   │   └── MissionFactory.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── DemoDataSeeder.php
│
├── routes/
│   ├── api.php
│   ├── web.php
│   └── channels.php
│
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── public.blade.php
│   │   └── pages/
│   │       ├── home.blade.php
│   │       └── legal/
│   │           ├── cgu.blade.php
│   │           └── cgv.blade.php
│   │
│   ├── js/
│   │   ├── app.ts
│   │   ├── router/
│   │   │   └── index.ts
│   │   ├── stores/
│   │   │   ├── auth.ts
│   │   │   ├── mission.ts
│   │   │   └── notification.ts
│   │   ├── composables/
│   │   │   ├── useMissions.ts
│   │   │   ├── useAuth.ts
│   │   │   └── useNotification.ts
│   │   ├── api/
│   │   │   ├── client.ts
│   │   │   ├── mission.ts
│   │   │   ├── auth.ts
│   │   │   └── payment.ts
│   │   ├── components/
│   │   │   ├── atoms/
│   │   │   │   ├── BaseButton.vue
│   │   │   │   ├── BaseInput.vue
│   │   │   │   ├── BaseBadge.vue
│   │   │   │   └── BaseIcon.vue
│   │   │   ├── molecules/
│   │   │   │   ├── FormField.vue
│   │   │   │   ├── Card.vue
│   │   │   │   └── Alert.vue
│   │   │   ├── organisms/
│   │   │   │   ├── MissionCard.vue
│   │   │   │   ├── MissionList.vue
│   │   │   │   ├── TechnicianProfile.vue
│   │   │   │   └── MessageThread.vue
│   │   │   └── templates/
│   │   │       ├── DashboardLayout.vue
│   │   │       ├── PublicLayout.vue
│   │   │       └── AuthLayout.vue
│   │   ├── pages/
│   │   │   ├── Dashboard.vue
│   │   │   ├── Missions/
│   │   │   │   ├── Index.vue
│   │   │   │   ├── Show.vue
│   │   │   │   └── Create.vue
│   │   │   └── Auth/
│   │   │       ├── Login.vue
│   │   │       └── Register.vue
│   │   └── types/
│   │       ├── mission.ts
│   │       ├── user.ts
│   │       └── api.ts
│   │
│   └── css/
│       ├── app.css
│       └── design-tokens.css
│
├── tests/
│   ├── Unit/
│   │   ├── Domain/
│   │   │   ├── Mission/
│   │   │   │   ├── MissionTest.php
│   │   │   │   └── MissionStatusTest.php
│   │   │   └── Shared/
│   │   │       └── AddressTest.php
│   │   └── Application/
│   │       └── Handlers/
│   │           └── CreateMissionHandlerTest.php
│   │
│   ├── Integration/
│   │   └── Infrastructure/
│   │       ├── EloquentMissionRepositoryTest.php
│   │       └── StripePaymentServiceTest.php
│   │
│   └── Feature/
│       └── Http/
│           ├── Mission/
│           │   ├── CreateMissionControllerTest.php
│           │   └── ListMissionsControllerTest.php
│           └── Auth/
│               └── LoginControllerTest.php
│
├── .storybook/
│   ├── main.ts
│   └── preview.ts
│
└── storage/
    ├── app/
    ├── logs/
    └── framework/
```

### Architectural Boundaries

**API Boundaries:**

| Boundary | Endpoint Prefix | Responsabilité |
|----------|-----------------|----------------|
| Auth API | `/api/v1/auth/*` | Login, Register, Token |
| Mission API | `/api/v1/missions/*` | CRUD Missions |
| Payment API | `/api/v1/payments/*` | Stripe intégration |
| Webhook | `/api/webhooks/stripe` | Events Stripe |

**Component Boundaries (DDD Layers):**

| Layer | Location | Responsabilité |
|-------|----------|----------------|
| Presentation | `app/Http/` | Controllers, Requests, Middleware |
| Application | `src/Application/` | Commands, Queries, Handlers, DTOs |
| Domain | `src/Domain/` | Entities, Value Objects, Events, Interfaces |
| Infrastructure | `src/Infrastructure/` | Eloquent, Serializers, External Services |

**Bounded Contexts:**

| Context | Responsabilité | Communication |
|---------|----------------|---------------|
| Mission | Gestion missions, photos, statuts | Events → Payment, User |
| User | Auth, Garage, Technician profiles | Events → Mission |
| Payment | Stripe, Escrow, Commissions | Events → Mission |
| Shared | ValueObjects communs (Address, Money) | Import direct |

### Requirements to Structure Mapping

| FR Category | Directories |
|-------------|-------------|
| User Management | `Domain/User/`, `app/Http/Controllers/Api/V1/Auth/` |
| Mission Management | `Domain/Mission/`, `app/Http/Controllers/Api/V1/Mission/` |
| Payment & Billing | `Domain/Payment/`, `Infrastructure/ExternalServices/Stripe/` |
| Communication | `app/Events/Broadcasting/`, `resources/js/components/organisms/` |

### Cross-Cutting Concerns Mapping

| Concern | Files |
|---------|-------|
| Authentication | `app/Http/Middleware/`, `app/Providers/AuthServiceProvider.php` |
| Multi-tenancy | `app/Http/Middleware/SetTenantScope.php`, Eloquent scopes |
| Audit Logging | `app/Http/Middleware/LogApiRequest.php` |
| Real-time | `app/Events/Broadcasting/`, `routes/channels.php` |

## Architecture Validation Results

### Coherence Validation ✅

**Decision Compatibility:**
Toutes les technologies choisies sont compatibles et forment un stack cohérent :
- Laravel 11 + PHP 8.2 : Support natif readonly, Enums, strict_types
- PostgreSQL 16 + Eloquent : JSON natif, PostGIS, scopes multi-tenancy
- Vue.js 3 + Pinia + TypeScript : Composition API, type safety
- Redis 7 + Reverb : Queue/Cache/WebSockets unifié
- Stripe Connect : Webhooks compatibles Laravel Events

**Pattern Consistency:**
- DDD Layers : `src/Domain/` → `src/Application/` → `src/Infrastructure/` → `app/`
- CQRS : Commands + Queries séparés, Handlers dédiés
- Serializers DDD : Cohérent avec Domain Entities
- Invokable Controllers : 1 action = 1 controller

**Structure Alignment:**
- 4 Bounded Contexts alignés avec `Domain/{Mission,User,Payment,Shared}/`
- Atomic Design aligné avec `resources/js/components/{atoms,molecules,organisms,templates}/`
- Tests 3 niveaux alignés avec `tests/{Unit,Integration,Feature}/`

### Requirements Coverage ✅

**Functional Requirements (35 FRs):**
Toutes les catégories FR sont architecturalement supportées par les Bounded Contexts et la structure projet définie.

**Non-Functional Requirements (33 NFRs):**
- Performance : Redis cache, Meilisearch, eager loading
- Security : Sanctum, RBAC Spatie, rate limiting
- DDD/CQRS : Structure complète, patterns documentés
- Testing : PHPUnit, Vitest, 80% coverage target
- Deployment : Docker, CI/CD GitHub Actions
- Real-time : Reverb WebSockets < 500ms

### Implementation Readiness ✅

**Decision Completeness:**
- Technology versions documentées
- 10 règles d'enforcement pour agents AI
- Code examples fournis pour tous patterns majeurs

**Structure Completeness:**
- ~150 fichiers définis dans la structure projet
- DDD directories complets
- Vue.js Atomic Design complet

**Pattern Completeness:**
- Naming conventions pour DB, API, PHP, Vue.js
- Error handling RFC 7807
- Serializers DDD pattern complet

### Architecture Completeness Checklist

**✅ Requirements Analysis**
- [x] Project context analysé (35 FRs, 33 NFRs)
- [x] Scale et complexity évalués (Medium-High)
- [x] Technical constraints identifiés
- [x] Cross-cutting concerns mappés

**✅ Architectural Decisions**
- [x] Critical decisions documentés avec versions
- [x] Technology stack complet spécifié
- [x] Integration patterns définis
- [x] Performance considerations adressées

**✅ Implementation Patterns**
- [x] Naming conventions établies
- [x] Structure patterns définis
- [x] Communication patterns spécifiés
- [x] Process patterns documentés

**✅ Project Structure**
- [x] Complete directory structure définie
- [x] Component boundaries établis
- [x] Integration points mappés
- [x] Requirements to structure mapping complet

### Architecture Readiness Assessment

**Overall Status:** ✅ READY FOR IMPLEMENTATION

**Confidence Level:** HIGH

**Key Strengths:**
- Architecture DDD/CQRS complète et cohérente
- Patterns PHP stricts (strict_types, final, readonly)
- Serializers DDD pour découplage API
- Structure projet détaillée prête pour scaffolding
- 10 règles d'enforcement claires pour agents AI

**First Implementation Priority:**
```bash
laravel new vitrolib --git
cd vitrolib
docker-compose up -d
mkdir -p src/{Domain,Application,Infrastructure}
```

