---
stepsCompleted: ['step-01-init', 'step-02-discovery', 'step-03-success', 'step-04-journeys', 'step-05-domain', 'step-06-innovation', 'step-07-project-type', 'step-08-scoping', 'step-09-functional', 'step-10-nonfunctional', 'step-11-polish', 'step-12-complete']
status: complete
completionDate: '2026-02-20'
inputDocuments: ['product-brief-vitroLib-2026-02-20.md', 'brainstorming-session-2026-02-15.md']
workflowType: 'prd'
documentCounts:
  briefs: 1
  research: 0
  brainstorming: 1
  projectDocs: 0
classification:
  projectType: web_app_saas_b2b
  domain: marketplace_services
  complexity: medium
  projectContext: greenfield
---

# Product Requirements Document - VitroLib

**Author:** Lawsonabraham  
**Date:** 2026-02-20  
**Status:** Complete

## Executive Summary

**Vision:** VitroLib — "Le Doctolib du vitrage automobile"

**Différenciateur:** Première marketplace B2B connectant garages et techniciens vitriers indépendants avec paiement sécurisé (séquestre Stripe) et matching géolocalisé.

**Utilisateurs cibles:**
- **Garages automobiles** (demandeurs) — Publient des missions, paient via plateforme
- **Techniciens vitriers indépendants** (offreurs) — Acceptent des missions, sont payés sous 48h
- **Clients finaux** (indirects) — Bénéficient du réseau sans accès direct

**Stack technique:** Laravel 11 + Vue.js 3 | Architecture DDD + CQRS | Docker | TDD

**MVP Timeline:** 8-10 semaines avec 1-2 développeurs full-stack

## Success Criteria

### User Success

**Garagiste (Marc) :**
- Publie une mission en < 2 minutes
- Trouve un technicien en < 24h
- Satisfaction post-mission ≥ 4.5/5
- "Aha!" moment : "J'ai servi un client à 500km sans bouger"

**Technicien (Karim) :**
- Reçoit des missions correspondant à sa zone
- Payé sous 48h après validation
- Complète ≥ 5 missions/mois
- "Aha!" moment : "J'ai rempli mon planning sans démarcher"

### Business Success

| Métrique | 3 mois | 12 mois |
|----------|--------|---------|
| Garages payants (99€/mois) | 20 | 100 |
| Techniciens actifs | 50 | 200 |
| MRR | 1 980€ | 9 900€ |
| Missions/mois | 60 | 500 |
| Churn garages | < 10% | < 5% |
| NPS | ≥ 40 | ≥ 50 |

### Technical Success

| Critère | Cible MVP |
|---------|-----------|
| Disponibilité | 99.5% |
| Temps réponse API | < 500ms (P95) |
| Temps chargement page | < 3s FCP |
| Sécurité paiement | PCI-DSS SAQ-A (via Stripe) |
| Conformité | RGPD |

### Measurable Outcomes

- **North Star :** Missions réussies/mois (+20%/mois)
- **Ratio offre/demande :** Techniciens/Garages ≈ 2:1
- **Activation :** Time-to-First-Mission < 7 jours
- **Anti-bypass :** < 5% missions hors plateforme

## Product Scope

### MVP - Minimum Viable Product

8 fonctionnalités P0 (du Product Brief) :
1. Inscription Garage (Kbis + abonnement)
2. Inscription Technicien (profil)
3. Publier une mission
4. Liste des missions (Leboncoin-style)
5. Accepter une mission
6. Messagerie basique
7. Paiement sécurisé (séquestre)
8. Validation photo

### Growth Features (Post-MVP)

- GPS temps réel
- Notation bidirectionnelle
- Badges (SuperTech, Réponse Rapide)
- Rappels SMS
- Agenda synchronisé
- Facturation automatique

### Vision (Future)

- Marketplace vitrages intégrée
- VitroLib Academy (formation ADAS)
- App mobile native
- Partenariats assureurs directs
- Expansion européenne

## User Journeys

### Journey 1 : Marc le Garagiste — "Le pare-brise de Sophie"

**Scène d'ouverture :**
Marc, garagiste à Chartres, reçoit Sophie en urgence. Impact sur pare-brise, calibrage ADAS requis. Son technicien habituel est en vacances.

**Action montante :**
1. Marc ouvre VitroLib sur son PC
2. Publie une mission : "Renault Captur 2023 - Pare-brise + calibrage ADAS"
3. Ajoute photos du bris, délai "sous 48h"
4. Notification push → 3 techniciens voient l'offre

**Climax :**
Karim accepte en 2h. Marc valide son profil (4.8★, 127 missions).

**Résolution :**
Sophie récupère sa voiture. Marc a gardé son client et découvert un technicien fiable.

---

### Journey 2 : Karim le Technicien — "Remplir son planning"

**Scène d'ouverture :**
Karim, technicien indépendant à Orléans, a un trou dans son planning.

**Action montante :**
1. Notification VitroLib : "Nouvelle mission à 45km"
2. Karim consulte les détails, accepte en un tap
3. Échange avec Marc via messagerie

**Climax :**
Karim intervient, prend photos avant/après, valide la mission.

**Résolution :**
Paiement libéré sous 48h. Karim gagne 350€ net. Marc lui met 5★.

---

### Journey 3 : Sophie la Cliente — "Le bris invisible"

**Scène d'ouverture :**
Sophie découvre un impact sur son pare-brise.

**Action montante :**
1. Cherche "réparation pare-brise Chartres" sur Google
2. Trouve le garage de Marc
3. Marc gère la déclaration sinistre avec elle

**Résolution :**
Sophie ne voit jamais VitroLib mais bénéficie du réseau.

---

### Journey 4 : Admin VitroLib — "Le litige"

**Scène d'ouverture :**
Marc conteste une mission pour malfaçon.

**Action montante :**
1. Admin reçoit alerte "Litige ouvert"
2. Consulte photos avant/après et messagerie
3. Contacte les deux parties

**Résolution :**
Admin tranche via preuves photo. Documentation du cas.

---

### Journey Requirements Summary

| Journey | Capacités Requises |
|---------|-------------------|
| Marc | Publication mission, messagerie, validation, paiement, favoris |
| Karim | Notifications push, liste missions, upload photos, suivi paiement |
| Sophie | SEO/visibilité garage |
| Admin | Dashboard litiges, accès logs, gestion paiements |

## Domain-Specific Requirements

### Contraintes Réglementaires

| Catégorie | Exigence | Priorité |
|-----------|----------|----------|
| **Paiement** | PCI-DSS SAQ-A (via Stripe) | MVP |
| **RGPD** | Consentements, droit à l'oubli, portabilité | MVP |
| **Plateforme** | CGU/CGV, médiation obligatoire | MVP |
| **Fiscal** | Info déclaration revenus techniciens | Post-MVP |
| **Assurance** | RC Pro recommandée (non bloquant) | Post-MVP |

### Notes Domaine

- Complexité **moyenne** — pas de régulation lourde type santé/finance
- Marketplace B2B standard en France
- Focus sur transparence et protection des deux parties

## Web App SaaS B2B Specific Requirements

### Project-Type Overview

VitroLib est une marketplace B2B biface (garages ↔ techniciens) construite en Laravel + Vue.js. Architecture hybride optimisée pour SEO et UX.

### Technical Architecture

| Composant | Choix | Justification |
|-----------|-------|---------------|
| **Backend** | Laravel 11 | Expertise équipe, écosystème riche |
| **Frontend public** | Blade + TailwindCSS | SEO natif, performance |
| **Frontend dashboard** | Vue.js 3 SPA | UX fluide, réactivité |
| **Base de données** | MySQL/PostgreSQL | Shared DB, scopes Eloquent |
| **Temps réel** | Laravel Reverb | WebSockets natif Laravel |
| **Cache** | Redis | Sessions, queues, cache |
| **File storage** | S3/Minio | Photos missions |

### Multi-tenancy Model

- **Approche :** Shared Database avec colonne discriminante
- **Isolation :** Scopes Eloquent automatiques (`garage_id`, `technician_id`)
- **Données partagées :** Référentiels (types véhicules, vitrages)

### Permission Matrix (RBAC)

| Rôle | Missions | Techniciens | Paiements | Litiges | Admin |
|------|----------|-------------|-----------|---------|-------|
| Garage | CRUD | Voir/Favoris | Gérer | Ouvrir | ❌ |
| Technicien | Voir/Accepter | — | Recevoir | Ouvrir | ❌ |
| Admin | Voir | Voir | Arbitrer | Résoudre | ✅ |
| Super Admin | Tout | Tout | Tout | Tout | Tout |

### Integrations MVP

| Service | Usage | Package Laravel |
|---------|-------|-----------------|
| **Stripe Connect** | Paiements séquestrés | `laravel/cashier` |
| **Laravel Reverb** | Notifications temps réel | Natif Laravel 11 |
| **Mailgun/Resend** | Emails transactionnels | `laravel/mail` |

### Integrations Post-MVP

| Service | Usage |
|---------|-------|
| Twilio | SMS rappels |
| Google Maps API | GPS technicien |
| Calendly/Cal.com | Sync agenda |

### Implementation Considerations

- **Queue system :** Redis + Laravel Horizon (notifications, emails)
- **API :** Laravel Sanctum (SPA auth), API REST pour future app mobile
- **Testing :** PHPUnit + Pest, Cypress pour E2E
- **Déploiement :** Laravel Forge ou Ploi sur DigitalOcean/AWS

## Project Scoping & Phased Development

### MVP Strategy & Philosophy

**MVP Approach:** Problem-Solving MVP — Résoudre le problème core (trouver un technicien fiable rapidement) avant tout.

**Resource Requirements:** 1-2 développeurs full-stack Laravel/Vue.js, 8-10 semaines

### MVP Feature Set (Phase 1)

**Core User Journeys Supported:**
- Marc : Publier mission → Trouver technicien → Payer
- Karim : Voir missions → Accepter → Réaliser → Être payé

**Must-Have Capabilities:**
| Feature | Journey | Priorité |
|---------|---------|----------|
| Inscription Garage (Kbis + Stripe) | Marc | P0 |
| Inscription Technicien (profil) | Karim | P0 |
| Publier une mission | Marc | P0 |
| Liste missions (Leboncoin-style) | Karim | P0 |
| Accepter une mission | Karim | P0 |
| Messagerie basique | Marc ↔ Karim | P0 |
| Paiement séquestre (Stripe Connect) | Marc + Karim | P0 |
| Upload photos avant/après | Karim | P0 |

### Post-MVP Features

**Phase 2 (Growth) — +4-6 semaines:**
- Notation bidirectionnelle (confiance)
- Notifications push (Laravel Reverb)
- Favoris techniciens
- Dashboard admin litiges
- Rappels email/SMS

**Phase 3 (Expansion):**
- GPS temps réel technicien
- App mobile native
- Marketplace vitrages
- VitroLib Academy (formation ADAS)
- Partenariats assureurs B2B

### Risk Mitigation Strategy

**Technical Risks:** Intégration Stripe Connect complexe → Utiliser mode test dès le début, POC early

**Market Risks:** Adoption techniciens incertaine → Lancer free, onboarding personnalisé, premiers techniciens recrutés manuellement

**Resource Risks:** Équipe réduite → Scope MVP minimal strict, pas de features "nice-to-have" en Phase 1

## Functional Requirements

### User Management

- **FR1:** Un garage peut créer un compte avec email, mot de passe et numéro Kbis
- **FR2:** Un technicien peut créer un compte avec email et profil professionnel
- **FR3:** Un utilisateur peut réinitialiser son mot de passe
- **FR4:** Un admin peut désactiver/réactiver un compte utilisateur
- **FR5:** Un garage peut configurer ses informations de paiement Stripe

### Mission Management

- **FR6:** Un garage peut créer une mission avec type de vitrage, véhicule, lieu et date souhaitée
- **FR7:** Un garage peut joindre des photos à une mission
- **FR8:** Un garage peut annuler une mission non-acceptée
- **FR9:** Un technicien peut consulter la liste des missions disponibles
- **FR10:** Un technicien peut filtrer les missions par zone géographique
- **FR11:** Un technicien peut accepter une mission disponible
- **FR12:** Un technicien peut refuser une mission proposée
- **FR13:** Un garage peut voir le statut en temps réel de ses missions

### Communication

- **FR14:** Un garage et un technicien peuvent échanger des messages sur une mission
- **FR15:** Un utilisateur reçoit des notifications pour les événements clés (nouvelle mission, acceptation, message)
- **FR16:** Un utilisateur peut consulter l'historique des messages d'une mission

### Payment & Billing

- **FR17:** Un garage peut payer une mission via Stripe (séquestre)
- **FR18:** Le système libère le paiement au technicien après validation du garage
- **FR19:** Un technicien peut consulter ses paiements reçus
- **FR20:** Un garage peut consulter son historique de paiements
- **FR21:** Le système prélève une commission sur chaque transaction

### Mission Completion

- **FR22:** Un technicien peut uploader des photos avant/après intervention
- **FR23:** Un garage peut valider la complétion d'une mission
- **FR24:** Un garage peut signaler un problème sur une mission terminée

### Trust & Reputation (Phase 2)

- **FR25:** Un garage peut noter un technicien après mission
- **FR26:** Un technicien peut noter un garage après mission
- **FR27:** Un utilisateur peut consulter les notes et avis d'un autre utilisateur
- **FR28:** Un garage peut ajouter un technicien en favori

### Administration

- **FR29:** Un admin peut consulter la liste de tous les utilisateurs
- **FR30:** Un admin peut consulter toutes les missions et leur statut
- **FR31:** Un admin peut intervenir sur un litige entre garage et technicien
- **FR32:** Un admin peut accéder aux métriques d'activité de la plateforme

### Compliance & Legal

- **FR33:** Un utilisateur peut accepter les CGU/CGV lors de l'inscription
- **FR34:** Un utilisateur peut consulter et télécharger les CGU/CGV
- **FR35:** Le système conserve les logs d'actions pour audit

## Non-Functional Requirements

### Performance

- **NFR1:** Les pages dashboard chargent en < 2 secondes (P95)
- **NFR2:** Les notifications WebSocket arrivent en < 500ms après l'événement
- **NFR3:** Les recherches de missions retournent en < 1 seconde
- **NFR4:** Upload photos < 5 secondes pour fichiers jusqu'à 10MB

### Security

- **NFR5:** Toutes les données en transit chiffrées via HTTPS/TLS 1.3
- **NFR6:** Mots de passe hashés avec bcrypt (cost factor 12)
- **NFR7:** Sessions expirées après 24h d'inactivité
- **NFR8:** Protection CSRF sur tous les formulaires
- **NFR9:** Rate limiting API : 100 req/min par utilisateur
- **NFR10:** Données de paiement jamais stockées (Stripe tokenization)
- **NFR11:** Conformité RGPD : export/suppression données utilisateur

### Scalability

- **NFR12:** Support de 1000 utilisateurs concurrents en MVP
- **NFR13:** Architecture stateless permettant scaling horizontal
- **NFR14:** Base de données optimisée pour 100k missions/an en Phase 2

### Architecture & Code Quality

- **NFR15:** Architecture DDD avec Bounded Contexts (Mission, User, Payment, Shared)
- **NFR16:** Pattern CQRS : Commands et Queries séparés
- **NFR17:** Pattern Repository pour abstraction persistance
- **NFR18:** DTOs pour transfert de données entre couches
- **NFR19:** Serializers pour transformation API responses
- **NFR20:** Singleton pattern pour services stateless
- **NFR21:** Principe DRY appliqué (traits, services partagés)

### Testing & Quality

- **NFR22:** Approche TDD : tests écrits avant implémentation
- **NFR23:** PHPUnit pour tests unitaires et d'intégration
- **NFR24:** Coverage cible : 80% minimum sur Domain layer
- **NFR25:** Tests E2E avec Cypress pour flows critiques

### Infrastructure & DevOps

- **NFR26:** Application containerisée avec Docker
- **NFR27:** docker-compose pour environnement de développement
- **NFR28:** Structure Monorepo (backend + frontend)
- **NFR29:** CI/CD pipeline avec tests automatisés
- **NFR30:** Logs structurés pour monitoring (Laravel Log + JSON)

### Integration

- **NFR31:** Stripe Connect API : retry automatique sur échec (3 tentatives)
- **NFR32:** Laravel Reverb : reconnexion automatique WebSocket
- **NFR33:** Email provider : failover sur provider secondaire

