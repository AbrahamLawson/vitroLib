---
stepsCompleted: ['step-01-validate-prerequisites', 'step-02-design-epics', 'step-03-create-stories']
status: 'complete'
completedAt: '2026-02-21'
inputDocuments: ['prd.md', 'architecture.md', 'ux-design-specification.md']
workflowType: 'epics'
project_name: 'vitroLib'
user_name: 'Lawsonabraham'
date: '2026-02-21'
---

# VitroLib - Epic Breakdown

## Overview

This document provides the complete epic and story breakdown for VitroLib, decomposing the requirements from the PRD, UX Design, and Architecture requirements into implementable stories.

## Requirements Inventory

### Functional Requirements

**User Management (5 FRs)**
- FR1: Un garage peut créer un compte avec email, mot de passe et numéro Kbis
- FR2: Un technicien peut créer un compte avec email et profil professionnel
- FR3: Un utilisateur peut réinitialiser son mot de passe
- FR4: Un admin peut désactiver/réactiver un compte utilisateur
- FR5: Un garage peut configurer ses informations de paiement Stripe

**Mission Management (8 FRs)**
- FR6: Un garage peut créer une mission avec type de vitrage, véhicule, lieu et date souhaitée
- FR7: Un garage peut joindre des photos à une mission
- FR8: Un garage peut annuler une mission non-acceptée
- FR9: Un technicien peut consulter la liste des missions disponibles
- FR10: Un technicien peut filtrer les missions par zone géographique
- FR11: Un technicien peut accepter une mission disponible
- FR12: Un technicien peut refuser une mission proposée
- FR13: Un garage peut voir le statut en temps réel de ses missions

**Communication (3 FRs)**
- FR14: Un garage et un technicien peuvent échanger des messages sur une mission
- FR15: Un utilisateur reçoit des notifications pour les événements clés
- FR16: Un utilisateur peut consulter l'historique des messages d'une mission

**Payment & Billing (5 FRs)**
- FR17: Un garage peut payer une mission via Stripe (séquestre)
- FR18: Le système libère le paiement au technicien après validation du garage
- FR19: Un technicien peut consulter ses paiements reçus
- FR20: Un garage peut consulter son historique de paiements
- FR21: Le système prélève une commission sur chaque transaction

**Mission Completion (3 FRs)**
- FR22: Un technicien peut uploader des photos avant/après intervention
- FR23: Un garage peut valider la complétion d'une mission
- FR24: Un garage peut signaler un problème sur une mission terminée

**Trust & Reputation (4 FRs - Phase 2)**
- FR25: Un garage peut noter un technicien après mission
- FR26: Un technicien peut noter un garage après mission
- FR27: Un utilisateur peut consulter les notes et avis d'un autre utilisateur
- FR28: Un garage peut ajouter un technicien en favori

**Administration (4 FRs)**
- FR29: Un admin peut consulter la liste de tous les utilisateurs
- FR30: Un admin peut consulter toutes les missions et leur statut
- FR31: Un admin peut intervenir sur un litige entre garage et technicien
- FR32: Un admin peut accéder aux métriques d'activité de la plateforme

**Compliance & Legal (3 FRs)**
- FR33: Un utilisateur peut accepter les CGU/CGV lors de l'inscription
- FR34: Un utilisateur peut consulter et télécharger les CGU/CGV
- FR35: Le système conserve les logs d'actions pour audit

### Non-Functional Requirements

**Performance:** NFR1-NFR4 (pages < 2s, WebSocket < 500ms, search < 1s, upload < 5s)
**Security:** NFR5-NFR11 (HTTPS, bcrypt, CSRF, rate limiting, RGPD)
**Scalability:** NFR12-NFR14 (1000 users concurrents, stateless, 100k missions/an)
**Architecture:** NFR15-NFR21 (DDD, CQRS, Repository, DTOs, Serializers)
**Testing:** NFR22-NFR25 (TDD, PHPUnit, 80% coverage, Cypress E2E)
**Infrastructure:** NFR26-NFR30 (Docker, Monorepo, CI/CD, logs)
**Integration:** NFR31-NFR33 (Stripe retry, Reverb reconnect, email failover)

### Additional Requirements

**From Architecture:**
- Starter Template: Laravel 11 fresh + DDD structure manuelle
- 4 Bounded Contexts: Mission, User, Payment, Shared
- Serializers DDD pour réponses API
- Invokable Controllers (1 action = 1 controller)
- PostgreSQL 16 avec PostGIS pour géolocalisation
- Redis 7 pour cache, queues, WebSockets
- Meilisearch pour recherche missions

**From UX Design:**
- Mobile-first pour techniciens (80% mobile)
- Publication mission < 2 minutes, 3 étapes
- Timeline Uber-style pour suivi missions
- Atomic Design components (Storybook)
- Design System: Inter font, Bleu #2563EB, Lucide icons

### FR Coverage Map

| FR | Epic | Description |
|----|------|-------------|
| FR1 | Epic 1 | Inscription garage (Kbis) |
| FR2 | Epic 1 | Inscription technicien |
| FR3 | Epic 1 | Reset password |
| FR4 | Epic 1 | Admin gestion comptes |
| FR5 | Epic 1 | Config Stripe garage |
| FR6 | Epic 2 | Créer mission |
| FR7 | Epic 2 | Photos mission |
| FR8 | Epic 2 | Annuler mission |
| FR9 | Epic 3 | Liste missions |
| FR10 | Epic 3 | Filtre géographique |
| FR11 | Epic 3 | Accepter mission |
| FR12 | Epic 3 | Refuser mission |
| FR13 | Epic 3 | Statut temps réel |
| FR14 | Epic 4 | Messagerie mission |
| FR15 | Epic 4 | Notifications |
| FR16 | Epic 4 | Historique messages |
| FR17 | Epic 5 | Paiement Stripe |
| FR18 | Epic 5 | Libération paiement |
| FR19 | Epic 5 | Consultation paiements (tech) |
| FR20 | Epic 5 | Historique paiements (garage) |
| FR21 | Epic 5 | Commission plateforme |
| FR22 | Epic 5 | Upload photos avant/après |
| FR23 | Epic 5 | Validation mission |
| FR24 | Epic 5 | Signaler problème |
| FR25 | Epic 7 | Noter technicien |
| FR26 | Epic 7 | Noter garage |
| FR27 | Epic 7 | Consulter notes |
| FR28 | Epic 7 | Favoris techniciens |
| FR29 | Epic 6 | Liste utilisateurs |
| FR30 | Epic 6 | Liste missions admin |
| FR31 | Epic 6 | Gestion litiges |
| FR32 | Epic 6 | Métriques plateforme |
| FR33 | Epic 1 | Acceptation CGU |
| FR34 | Epic 1 | Consultation CGU |
| FR35 | Epic 6 | Audit logs |

## Epic List

### Epic 1: Foundation & User Authentication
Les garages et techniciens peuvent créer un compte, se connecter et gérer leur profil.
**FRs covered:** FR1, FR2, FR3, FR4, FR5, FR33, FR34

### Epic 2: Mission Publication
Un garage peut publier une mission vitrage complète avec photos et détails.
**FRs covered:** FR6, FR7, FR8

### Epic 3: Mission Discovery & Acceptance
Un technicien peut trouver et accepter des missions dans sa zone.
**FRs covered:** FR9, FR10, FR11, FR12, FR13

### Epic 4: Communication & Messaging
Garage et technicien peuvent communiquer sur une mission.
**FRs covered:** FR14, FR15, FR16

### Epic 5: Mission Completion & Payment
Une mission peut être complétée avec photos et paiement libéré.
**FRs covered:** FR17, FR18, FR19, FR20, FR21, FR22, FR23, FR24

### Epic 6: Administration & Compliance
Les admins peuvent gérer la plateforme et résoudre les litiges.
**FRs covered:** FR29, FR30, FR31, FR32, FR35

### Epic 7: Trust & Reputation (Post-MVP)
Garages et techniciens peuvent se noter et créer des relations de confiance.
**FRs covered:** FR25, FR26, FR27, FR28

---

## Epic 1: Foundation & User Authentication

**Goal:** Les garages et techniciens peuvent créer un compte, se connecter et gérer leur profil.

### Story 1.1: Project Initialization

As a **developer**,
I want **to initialize the Laravel project with DDD structure**,
So that **the codebase follows the architectural decisions documented**.

**Acceptance Criteria:**

**Given** a fresh development environment
**When** I run the initialization commands
**Then** Laravel 11 is installed with DDD folder structure (src/Domain, src/Application, src/Infrastructure)
**And** Docker compose is configured with PostgreSQL 16, Redis 7
**And** Base configuration files are set up (strict_types, composer autoload)

### Story 1.2: Garage Registration

As a **garage owner (Marc)**,
I want **to create an account with my business information**,
So that **I can access the platform and publish missions**.

**Acceptance Criteria:**

**Given** I am on the registration page
**When** I submit my email, password, company name, and Kbis number
**Then** my account is created with "garage" role
**And** I must accept the CGU/CGV before completing registration
**And** I receive a confirmation email
**And** I am redirected to my dashboard

### Story 1.3: Technician Registration

As a **technician (Karim)**,
I want **to create a professional profile**,
So that **I can receive and accept missions**.

**Acceptance Criteria:**

**Given** I am on the technician registration page
**When** I submit my email, password, name, phone, and service zone
**Then** my account is created with "technician" role
**And** I must accept the CGU/CGV before completing registration
**And** I can specify my intervention radius (km)
**And** I am redirected to the missions list

### Story 1.4: User Authentication

As a **registered user**,
I want **to log in securely**,
So that **I can access my dashboard**.

**Acceptance Criteria:**

**Given** I have a registered account
**When** I submit valid credentials
**Then** I am authenticated via Laravel Sanctum
**And** my session is created with 24h expiry
**And** I am redirected to my role-specific dashboard

### Story 1.5: Password Reset

As a **user who forgot my password**,
I want **to reset my password via email**,
So that **I can regain access to my account**.

**Acceptance Criteria:**

**Given** I am on the login page
**When** I click "Forgot password" and enter my email
**Then** I receive a password reset link (valid 60 minutes)
**And** I can set a new password
**And** I am logged in automatically after reset

### Story 1.6: Stripe Configuration (Garage)

As a **garage owner**,
I want **to configure my Stripe payment information**,
So that **I can pay for missions via the platform**.

**Acceptance Criteria:**

**Given** I am a logged-in garage owner
**When** I access payment settings
**Then** I can link my Stripe account via Stripe Connect onboarding
**And** my payment method is securely stored (tokenized)
**And** I see confirmation of successful setup

### Story 1.7: Admin User Management

As an **admin**,
I want **to view and manage user accounts**,
So that **I can maintain platform integrity**.

**Acceptance Criteria:**

**Given** I am logged in as admin
**When** I access the users list
**Then** I can see all garages and technicians
**And** I can filter by role, status, registration date
**And** I can activate/deactivate accounts
**And** changes are logged for audit

---

## Epic 2: Mission Publication

**Goal:** Un garage peut publier une mission vitrage complète avec photos et détails.

### Story 2.1: Create Mission Wizard

As a **garage owner**,
I want **to create a mission in 3 simple steps**,
So that **I can quickly request a technician**.

**Acceptance Criteria:**

**Given** I am on my garage dashboard
**When** I click "Nouvelle mission"
**Then** I see a 3-step wizard: (1) Vehicle, (2) Glazing, (3) Location/Date
**And** progress is clearly indicated
**And** I can navigate back without losing data

### Story 2.2: Mission Vehicle Information

As a **garage owner**,
I want **to specify the vehicle details**,
So that **technicians know what they'll work on**.

**Acceptance Criteria:**

**Given** I am in step 1 of mission creation
**When** I enter vehicle brand, model, year, VIN (optional)
**Then** the information is validated
**And** I can proceed to step 2

### Story 2.3: Mission Glazing Details

As a **garage owner**,
I want **to specify the glazing type and intervention**,
So that **technicians can assess the job**.

**Acceptance Criteria:**

**Given** I am in step 2 of mission creation
**When** I select glazing type (windshield, rear, side) and intervention (replace, repair, calibration)
**Then** I can add special requirements (ADAS calibration, tinted, etc.)
**And** I can proceed to step 3

### Story 2.4: Mission Location and Schedule

As a **garage owner**,
I want **to specify where and when the intervention should happen**,
So that **technicians can plan their schedule**.

**Acceptance Criteria:**

**Given** I am in step 3 of mission creation
**When** I enter the intervention address and preferred date/time window
**Then** the address is geocoded (PostGIS)
**And** I can set urgency level (standard, urgent)
**And** I can add price offer

### Story 2.5: Mission Photo Upload

As a **garage owner**,
I want **to attach photos of the damage**,
So that **technicians can better assess the job**.

**Acceptance Criteria:**

**Given** I am creating a mission
**When** I upload photos (max 5, max 10MB each)
**Then** photos are compressed and stored in S3/Minio
**And** I see thumbnails of uploaded photos
**And** I can remove photos before submission

### Story 2.6: Mission Submission and Confirmation

As a **garage owner**,
I want **to review and submit my mission**,
So that **it becomes visible to technicians**.

**Acceptance Criteria:**

**Given** I have completed all mission steps
**When** I click "Publier la mission"
**Then** the mission is created with status "published"
**And** I see a confirmation with mission details
**And** nearby technicians are notified (push notification)

### Story 2.7: Cancel Unpublished Mission

As a **garage owner**,
I want **to cancel a mission that hasn't been accepted**,
So that **I can withdraw if circumstances change**.

**Acceptance Criteria:**

**Given** I have a published mission with no acceptance
**When** I click "Annuler la mission"
**Then** the mission status changes to "cancelled"
**And** it is removed from the available missions list
**And** no charges are applied

---

## Epic 3: Mission Discovery & Acceptance

**Goal:** Un technicien peut trouver et accepter des missions dans sa zone.

### Story 3.1: Mission List View

As a **technician**,
I want **to see available missions**,
So that **I can find work opportunities**.

**Acceptance Criteria:**

**Given** I am logged in as technician
**When** I access the missions page
**Then** I see a list of available missions as cards
**And** each card shows: vehicle, glazing type, location, date, price
**And** missions are sorted by relevance (distance, date)

### Story 3.2: Geographic Filter

As a **technician**,
I want **to filter missions by distance**,
So that **I only see missions within my service area**.

**Acceptance Criteria:**

**Given** I am viewing the missions list
**When** I set a distance filter (e.g., 50km)
**Then** only missions within that radius from my location are shown
**And** distance to each mission is displayed
**And** filter persists across sessions

### Story 3.3: Mission Detail View

As a **technician**,
I want **to see full mission details**,
So that **I can decide whether to accept**.

**Acceptance Criteria:**

**Given** I click on a mission card
**When** the detail view opens
**Then** I see all information: vehicle, glazing, photos, location map, garage profile
**And** I see the garage's rating and history
**And** I have clear "Accept" and "Decline" buttons

### Story 3.4: Accept Mission

As a **technician**,
I want **to accept a mission**,
So that **I can commit to performing the work**.

**Acceptance Criteria:**

**Given** I am viewing a mission detail
**When** I click "Accepter"
**Then** the mission status changes to "accepted"
**And** the mission is removed from other technicians' lists
**And** the garage is notified immediately (push + email)
**And** a chat channel is opened between us

### Story 3.5: Decline Mission

As a **technician**,
I want **to decline a mission**,
So that **it's clear I'm not interested**.

**Acceptance Criteria:**

**Given** I am viewing a mission detail
**When** I click "Refuser"
**Then** the mission is hidden from my list
**And** it remains available for other technicians
**And** the garage is not notified of my decline

### Story 3.6: Real-time Mission Status

As a **garage owner**,
I want **to see my missions' status in real-time**,
So that **I know when a technician accepts**.

**Acceptance Criteria:**

**Given** I have published missions
**When** a technician accepts my mission
**Then** I receive an instant notification (WebSocket via Reverb)
**And** my dashboard updates without refresh
**And** I can see the technician's profile

---

## Epic 4: Communication & Messaging

**Goal:** Garage et technicien peuvent communiquer sur une mission.

### Story 4.1: Mission Chat

As a **garage owner or technician**,
I want **to exchange messages about a mission**,
So that **we can coordinate details**.

**Acceptance Criteria:**

**Given** a mission has been accepted
**When** I access the mission detail
**Then** I see a chat panel
**And** I can send text messages
**And** messages appear in real-time (WebSocket)

### Story 4.2: Push Notifications

As a **user**,
I want **to receive push notifications for important events**,
So that **I don't miss critical updates**.

**Acceptance Criteria:**

**Given** I have enabled notifications
**When** a key event occurs (new mission nearby, mission accepted, new message)
**Then** I receive a browser/mobile push notification
**And** clicking the notification takes me to the relevant page

### Story 4.3: Message History

As a **user**,
I want **to view message history for a mission**,
So that **I can reference past conversations**.

**Acceptance Criteria:**

**Given** I am viewing a mission
**When** I open the chat
**Then** I see all previous messages in chronological order
**And** messages show sender, timestamp, and read status
**And** I can scroll through history

---

## Epic 5: Mission Completion & Payment

**Goal:** Une mission peut être complétée avec photos et paiement libéré.

### Story 5.1: Before/After Photo Upload

As a **technician**,
I want **to upload before and after photos**,
So that **the garage can verify my work**.

**Acceptance Criteria:**

**Given** I am working on an accepted mission
**When** I upload before photos (at arrival) and after photos (at completion)
**Then** photos are timestamped and geolocated
**And** they are attached to the mission
**And** the garage can view them

### Story 5.2: Mission Completion Request

As a **technician**,
I want **to mark a mission as completed**,
So that **the garage can validate and release payment**.

**Acceptance Criteria:**

**Given** I have uploaded before/after photos
**When** I click "Demander validation"
**Then** the mission status changes to "pending_validation"
**And** the garage is notified
**And** I see a timeline showing the pending state

### Story 5.3: Garage Validation

As a **garage owner**,
I want **to validate a completed mission**,
So that **the technician gets paid**.

**Acceptance Criteria:**

**Given** a mission is pending validation
**When** I review the before/after photos and click "Valider"
**Then** the mission status changes to "completed"
**And** the escrow payment is released to the technician
**And** both parties are notified

### Story 5.4: Report Problem

As a **garage owner**,
I want **to report a problem with a completed mission**,
So that **issues can be resolved**.

**Acceptance Criteria:**

**Given** a mission is pending validation or completed
**When** I click "Signaler un problème"
**Then** I can describe the issue and attach evidence
**And** the mission status changes to "disputed"
**And** an admin is notified
**And** payment is held pending resolution

### Story 5.5: Stripe Escrow Payment

As a **garage owner**,
I want **to pay for a mission upfront (in escrow)**,
So that **the technician is guaranteed payment**.

**Acceptance Criteria:**

**Given** I accept a technician for my mission
**When** I confirm the mission
**Then** the payment is charged to my Stripe account
**And** funds are held in escrow (Stripe Connect)
**And** I see "Payment secured" badge on the mission

### Story 5.6: Payment Release

As the **system**,
I want **to release payment after garage validation**,
So that **technicians are paid promptly**.

**Acceptance Criteria:**

**Given** a garage validates a mission
**When** the validation is confirmed
**Then** the escrowed amount minus commission is transferred to the technician
**And** the platform commission is collected
**And** both parties receive payment confirmation

### Story 5.7: Technician Payment History

As a **technician**,
I want **to see my payment history**,
So that **I can track my earnings**.

**Acceptance Criteria:**

**Given** I am logged in as technician
**When** I access my payments page
**Then** I see all completed payments with dates and amounts
**And** I can see pending payments
**And** I can filter by date range

### Story 5.8: Garage Payment History

As a **garage owner**,
I want **to see my payment history**,
So that **I can track my expenses**.

**Acceptance Criteria:**

**Given** I am logged in as garage
**When** I access my payments page
**Then** I see all mission payments with dates and amounts
**And** I can see invoices
**And** I can export for accounting

---

## Epic 6: Administration & Compliance

**Goal:** Les admins peuvent gérer la plateforme et résoudre les litiges.

### Story 6.1: Admin Dashboard

As an **admin**,
I want **to see platform metrics at a glance**,
So that **I can monitor platform health**.

**Acceptance Criteria:**

**Given** I am logged in as admin
**When** I access the admin dashboard
**Then** I see key metrics: active users, missions this month, revenue, disputes
**And** I see charts showing trends
**And** I can drill down into details

### Story 6.2: All Missions View

As an **admin**,
I want **to see all missions and their status**,
So that **I can monitor platform activity**.

**Acceptance Criteria:**

**Given** I am on the admin dashboard
**When** I access the missions list
**Then** I see all missions with status, parties, and dates
**And** I can filter by status, date, garage, technician
**And** I can view any mission's full details

### Story 6.3: Dispute Management

As an **admin**,
I want **to handle disputes between garages and technicians**,
So that **issues are resolved fairly**.

**Acceptance Criteria:**

**Given** a mission is in "disputed" status
**When** I access the dispute
**Then** I see all evidence: photos, messages, problem report
**And** I can contact both parties
**And** I can resolve in favor of either party
**And** I can release or refund payment accordingly

### Story 6.4: Audit Logging

As the **system**,
I want **to log all significant actions**,
So that **we have an audit trail for compliance**.

**Acceptance Criteria:**

**Given** any user performs an action (login, mission creation, payment, etc.)
**When** the action is executed
**Then** a log entry is created with: user, action, timestamp, IP, details
**And** logs are stored securely
**And** admins can search and export logs

---

## Epic 7: Trust & Reputation (Post-MVP)

**Goal:** Garages et techniciens peuvent se noter et créer des relations de confiance.

### Story 7.1: Rate Technician

As a **garage owner**,
I want **to rate a technician after a mission**,
So that **other garages can benefit from my experience**.

**Acceptance Criteria:**

**Given** a mission is completed
**When** I submit a rating (1-5 stars) and optional comment
**Then** the rating is attached to the technician's profile
**And** their average rating is updated
**And** the technician is notified

### Story 7.2: Rate Garage

As a **technician**,
I want **to rate a garage after a mission**,
So that **other technicians know what to expect**.

**Acceptance Criteria:**

**Given** a mission is completed
**When** I submit a rating (1-5 stars) and optional comment
**Then** the rating is attached to the garage's profile
**And** their average rating is updated
**And** the garage is notified

### Story 7.3: View Ratings

As a **user**,
I want **to see ratings and reviews of other users**,
So that **I can make informed decisions**.

**Acceptance Criteria:**

**Given** I am viewing a user profile
**When** I access their ratings section
**Then** I see their average rating and total reviews
**And** I can read individual reviews
**And** reviews show the reviewer and date

### Story 7.4: Favorite Technicians

As a **garage owner**,
I want **to mark technicians as favorites**,
So that **I can easily find them for future missions**.

**Acceptance Criteria:**

**Given** I have worked with a technician
**When** I click "Add to favorites"
**Then** the technician is added to my favorites list
**And** I can view my favorites list
**And** I can send missions directly to favorites

