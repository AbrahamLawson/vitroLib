---
stepsCompleted: [1, 2, 3, 4, 5, 6]
status: complete
inputDocuments: ['brainstorming-session-2026-02-15.md']
date: 2026-02-20
author: Lawsonabraham
---

# Product Brief: VitroLib

## Executive Summary

**VitroLib** est une plateforme marketplace B2B qui connecte les garages automobiles avec des techniciens spécialisés en vitrage (pare-brise, vitres, toits ouvrants) partout en France. 

La plateforme résout un problème critique : le marché du vitrage indépendant est opaque et fragmenté, empêchant les garages de servir leurs clients nationaux et les techniciens de développer leur activité. VitroLib crée une "franchise virtuelle" permettant à chaque garage de devenir national sans infrastructure physique.

**Modèle économique :** Abonnement 99€/mois pour les garages, gratuit pour les techniciens.

---

## Core Vision

### Problem Statement

Les garages automobiles en France font face à un problème majeur : trouver des techniciens vitrage qualifiés est extrêmement difficile. Le marché fonctionne comme une "secte fermée" basée uniquement sur le bouche-à-oreille, sans visibilité ni garantie de qualité.

**Conséquences directes :**
- Les garages refusent des clients hors de leur zone géographique
- Les techniciens indépendants manquent de missions faute de visibilité
- Les clients finaux subissent des délais et un manque de choix

### Problem Impact

- **Pour les garages :** Perte de revenus estimée sur les clients nationaux, image dégradée
- **Pour les techniciens :** Activité sous-optimisée, dépendance au bouche-à-oreille local
- **Pour le marché :** Un secteur de 185M€+ (Mondial Pare-Brise seul) en croissance de +10%/an, dominé par quelques réseaux fermés

### Why Existing Solutions Fall Short

| Solution existante | Limite |
|-------------------|--------|
| **Carglass / France Pare-Brise** | Réseaux fermés, pas accessibles aux indépendants |
| **Bouche-à-oreille** | Limité géographiquement, opaque, sans garantie |
| **Plateformes généralistes** | Pas spécialisées vitrage, pas de mécanismes de confiance adaptés |

### Proposed Solution

**VitroLib** est une plateforme de mise en relation qui offre :

1. **Publication de missions** — Les garages postent leurs besoins (lieu, véhicule, type de vitrage)
2. **Réseau national de techniciens** — Profils vérifiés, disponibilités en temps réel
3. **Paiement sécurisé** — Séquestre jusqu'à validation photo de l'intervention
4. **Garantie qualité** — Notation bidirectionnelle, badges de performance

### Key Differentiators

| Différenciateur | Avantage compétitif |
|-----------------|---------------------|
| **Franchise virtuelle** | Un garage devient national sans investir dans des locaux |
| **Certification par réputation** | Pas de diplôme obligatoire, mais notation transparente |
| **Stack anti-bypass** | Assurance + Séquestre + Réputation + Outils = impossible de contourner |
| **Fondateur du secteur** | Connaissance intime des pain points réels |
| **Niche défendable** | Trop petit pour les géants, trop spécifique pour les généralistes |

---

## Target Users

### Primary Users

#### 1. Le Garagiste — "Marc"

**Profil type :**
- **Âge :** 40-55 ans
- **Rôle :** Gérant de garage multimarque ou carrosserie
- **Équipe :** 2-10 employés, aucun spécialiste vitrage en interne
- **Zone :** Principalement urbain/péri-urbain

**Contexte quotidien :**
- Attire des clients via marketing (cadeaux, pub, bouche-à-oreille)
- Prend en charge les dossiers bris de glace de ses clients
- Déclare les sinistres avec le client auprès des assurances
- Doit trouver un technicien vitrage pour réaliser l'intervention

**Problème actuel :**
- Marché des techniciens vitrage opaque ("une secte")
- Limité géographiquement à son réseau local
- Refuse des clients hors zone faute de techniciens fiables
- Peurs : travail mal fait, ghosting, casse

**Motivation VitroLib :**
- Devenir "national" sans ouvrir de franchises
- Servir n'importe quel client en France via un réseau de techniciens vérifiés
- Garanties de qualité (paiement séquestre, notation, photos)

**Succès :** "J'ai accepté un client à Marseille depuis Paris — mission réalisée en 48h, client satisfait."

---

#### 2. Le Technicien Vitrage — "Karim"

**Profil type :**
- **Âge :** 25-45 ans
- **Statut :** Indépendant, auto-entrepreneur ou micro-entreprise
- **Équipement :** Camionnette équipée, mobile
- **Zone :** Intervient dans un rayon de 50-100 km

**Contexte quotidien :**
- Travaille au bouche-à-oreille, réseau personnel
- Planning irrégulier, missions non garanties
- Compétent mais invisible sur le marché

**Problème actuel :**
- Pas de marketing/visibilité
- Réseau limité géographiquement
- Missions perdues faute de contacts

**Motivation VitroLib :**
- Remplir son planning avec des missions régulières
- Élargir sa zone d'intervention
- Construire une réputation visible (profil, avis, badges)

**Deal-breakers :**
- Mauvaise UI/UX
- Service client défaillant
- Paiements retardés

**Succès :** "J'ai des missions tous les jours, je choisis ma zone, je suis payé sous 48h."

---

### Secondary Users

#### Le Client Final — "Sophie" (Bénéficiaire indirect)

**Profil type :**
- Automobiliste avec bris de glace
- Contacte ou est attiré par un garagiste
- Déclare le sinistre avec le garagiste à son assurance

**Interaction avec VitroLib :** Aucune directe.
- Sophie voit uniquement son garagiste
- VitroLib opère en B2B, invisible pour le client final
- La qualité VitroLib impacte indirectement sa satisfaction

---

### User Journey

#### Parcours Garagiste (Marc)

| Étape | Action |
|-------|--------|
| **Découverte** | Entend parler de VitroLib (bouche-à-oreille pro, LinkedIn, salon) |
| **Inscription** | Crée un compte, vérifie Kbis, souscrit 99€/mois |
| **Première mission** | Publie une mission (lieu, véhicule, type vitrage, date) |
| **Matching** | Reçoit des candidatures de techniciens, valide le profil |
| **Intervention** | Suit l'intervention (photos avant/après) |
| **Validation** | Valide le travail, paiement déclenché |
| **Moment "Aha!"** | "J'ai servi un client à 500km sans bouger de mon bureau" |

#### Parcours Technicien (Karim)

| Étape | Action |
|-------|--------|
| **Découverte** | Invitation par un garage ou recherche Google |
| **Inscription** | Crée un profil (compétences, zone, photos réalisations) |
| **Première mission** | Reçoit une notification push, voit les détails |
| **Acceptation** | Postule, est validé par le garage |
| **Intervention** | Se déplace, prend photos avant/après, réalise le travail |
| **Paiement** | Reçoit le paiement sous 48h après validation |
| **Moment "Aha!"** | "J'ai 3 missions cette semaine sans avoir démarché personne" |

---

## Success Metrics

### User Success Metrics

#### Garagiste (Marc)

| Métrique | Cible | Comment mesurer |
|----------|-------|------------------|
| Missions publiées/mois | ≥ 3 | Compteur plateforme |
| Délai technicien trouvé | < 24h | Temps publication → acceptation |
| Satisfaction post-mission | ≥ 4.5/5 | Notation après intervention |
| Taux de missions réussies | ≥ 90% | Missions validées / missions publiées |

#### Technicien (Karim)

| Métrique | Cible | Comment mesurer |
|----------|-------|------------------|
| Missions acceptées/mois | ≥ 5 | Compteur plateforme |
| Délai de paiement | < 48h | Temps validation → virement |
| Taux de complétion | ≥ 95% | Missions terminées / missions acceptées |
| Note moyenne | ≥ 4.5/5 | Moyenne des notations garages |

---

### Business Objectives

| Objectif | Cible 3 mois | Cible 12 mois |
|----------|--------------|---------------|
| Garages abonnés (99€/mois) | 20 | 100 |
| Techniciens inscrits | 50 | 200 |
| MRR (Monthly Recurring Revenue) | 1 980€ | 9 900€ |
| Missions/mois | 60 | 500 |
| Churn garages | < 10%/mois | < 5%/mois |
| Couverture géographique | 3 régions | France entière |

---

### Key Performance Indicators

| KPI | Définition | Cible | Priorité |
|-----|------------|-------|----------|
| **🎯 Missions réussies/mois** | Missions complétées + validées + payées | +20%/mois | North Star |
| **Ratio Techniciens/Garages** | Équilibre offre-demande | ≈ 2:1 | Critique |
| **Time-to-First-Mission** | Inscription garage → 1ère mission | < 7 jours | Activation |
| **NPS Garages** | Net Promoter Score trimestriel | ≥ 50 | Satisfaction |
| **Taux bypass** | Missions faites hors plateforme après 1er contact | < 5% | Anti-fraude |

---

## MVP Scope

### Core Features

| # | Fonctionnalité | Description | Priorité |
|---|----------------|-------------|----------|
| 1 | **Inscription Garage** | Compte + vérification Kbis + abonnement 99€/mois | P0 |
| 2 | **Inscription Technicien** | Compte + profil (compétences, zone, photos) | P0 |
| 3 | **Publier une mission** | Lieu, type vitrage, véhicule, date souhaitée | P0 |
| 4 | **Liste des missions** | Interface Leboncoin (liste + filtres par zone/date) | P0 |
| 5 | **Accepter une mission** | Technicien postule → garage valide | P0 |
| 6 | **Messagerie basique** | Chat garage ↔ technicien intégré | P0 |
| 7 | **Paiement sécurisé** | Séquestre via Stripe/Mangopay | P0 |
| 8 | **Validation photo** | Photos avant/après intervention obligatoires | P0 |

---

### Out of Scope for MVP

| Fonctionnalité | Phase | Raison |
|----------------|-------|--------|
| GPS temps réel | 2 | Complexité technique, non-bloquant |
| Notation bidirectionnelle | 2 | Besoin de volume pour être pertinent |
| Rappels SMS | 2 | Nice-to-have, email suffit au début |
| Agenda synchronisé | 2 | Complexité intégration calendriers |
| Badges (SuperTech, Réponse Rapide) | 2 | Besoin d'historique de missions |
| Facturation automatique | 2 | Peut être fait manuellement au début |
| Marketplace vitrages | 3+ | Nécessite partenariats fournisseurs |
| VitroLib Academy | 3+ | Création de contenu, pas prioritaire |
| App mobile native | 3+ | Web responsive suffit au lancement |

---

### MVP Success Criteria

| Critère | Seuil de validation | Délai |
|---------|---------------------|-------|
| Garages payants | ≥ 10 abonnements actifs | 3 mois |
| Techniciens actifs | ≥ 25 profils avec ≥ 1 mission | 3 mois |
| Missions complétées | ≥ 30 missions validées + payées | 3 mois |
| Taux complétion | ≥ 85% des missions publiées | 3 mois |
| NPS utilisateurs | ≥ 40 (enquête qualitative) | 3 mois |

**Go/No-Go Decision :** Si 4/5 critères atteints → Phase 2. Sinon → Pivot ou arrêt.

---

### Future Vision

**Vision 12 mois :** "Le Doctolib du vitrage automobile en France"

| Phase | Horizon | Objectif |
|-------|---------|----------|
| **Phase 2** | 6-12 mois | GPS, notation, badges, facturation auto, SMS |
| **Phase 3** | 12-24 mois | Marketplace vitrages, app native, partenariats assureurs |
| **Phase 4** | 24+ mois | VitroLib Academy, expansion européenne, API partenaires |

**Ambition long terme :**
- Devenir LA référence de mise en relation vitrage en France
- Réseau de 500+ techniciens vérifiés couvrant toute la France
- Partenariats directs avec assureurs pour flux automatisé

