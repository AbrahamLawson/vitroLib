---
stepsCompleted: ['step-01-init', 'step-02-discovery', 'step-03-core-experience', 'step-04-emotional-response', 'step-05-inspiration', 'step-06-design-system', 'step-07-defining-experience', 'step-08-visual-foundation', 'step-09-design-directions', 'step-10-user-journeys', 'step-11-component-strategy', 'step-12-ux-patterns', 'step-13-responsive-accessibility', 'step-14-complete']
status: 'complete'
completedAt: '2026-02-21'
inputDocuments: ['prd.md', 'architecture.md', 'product-brief-vitroLib-2026-02-20.md']
workflowType: 'ux-design'
project_name: 'vitroLib'
user_name: 'Lawsonabraham'
date: '2026-02-21'
---

# UX Design Specification VitroLib

**Author:** Lawsonabraham
**Date:** 2026-02-21

---

## Executive Summary

### Project Vision

**VitroLib** — "Le Doctolib du vitrage automobile"

Marketplace B2B biface connectant garages automobiles (demandeurs) et techniciens vitriers indépendants (offreurs) avec paiement sécurisé (séquestre Stripe) et matching géolocalisé.

### Target Users

| Persona | Profil | Besoin Principal | Device |
|---------|--------|------------------|--------|
| **Marc (Garage)** | Garagiste 45 ans, Chartres | Trouver technicien fiable en < 24h | Desktop (atelier) |
| **Karim (Technicien)** | Indépendant 32 ans, Orléans | Remplir son planning, être payé vite | **Mobile** (terrain) |
| **Sophie (Client final)** | Conductrice, bris de glace | Ne voit pas VitroLib (indirect) | — |
| **Admin** | Support VitroLib | Résoudre litiges rapidement | Desktop |

### Key Design Challenges

| Défi | Impact | Priorité |
|------|--------|----------|
| **Mobile-first technicien** | Karim consulte missions sur chantier | 🔴 Critique |
| **Publication rapide** | Marc doit publier en < 2 min | 🔴 Critique |
| **Confiance biface** | Paiement séquestre = UX complexe | 🟠 High |
| **Notifications temps réel** | Acceptation mission = immédiateté | 🟠 High |
| **Photos upload** | Avant/après intervention, terrain | 🟡 Medium |

### Design Opportunities

| Opportunité | Avantage Compétitif |
|-------------|---------------------|
| **Matching intelligent** | Suggestions techniciens par zone + rating |
| **Timeline mission** | Visualisation claire du statut (Uber-style) |
| **Quick actions** | Accepter en 1 tap, publier en 3 étapes |
| **Photo validation** | UX guidée avant/après avec overlay |

## Core User Experience

### Defining Experience

**Action Core par Persona:**
- **Marc (Garage):** Publier une mission vitrage (2-5x/semaine)
- **Karim (Technicien):** Accepter une mission (quotidien)

**Action critique:** Le matching mission ↔ technicien — si Karim ne trouve pas de missions pertinentes ou Marc n'a pas de réponse, l'expérience échoue.

### Platform Strategy

| Surface | Utilisateur | Priorité | Justification |
|---------|-------------|----------|---------------|
| **Web Dashboard** | Marc (Garage) | 🔴 MVP | Publication missions depuis l'atelier |
| **Web Mobile-First** | Karim (Technicien) | 🔴 MVP | Consultation missions sur terrain |
| **Pages publiques (Blade)** | SEO | 🔴 MVP | Acquisition garages |
| **App Native** | Karim | 🟡 Post-MVP | Push notifications, GPS |

**Responsive obligatoire:** Technicien = 80% mobile

### Effortless Interactions

| Interaction | Objectif | Pattern UX |
|-------------|----------|------------|
| **Publier mission** | < 2 minutes, 3 étapes | Wizard progressif |
| **Accepter mission** | 1 tap | Swipe ou bouton CTA proéminent |
| **Upload photos** | Terrain, connexion variable | Compression auto, upload background |
| **Voir statut mission** | Sans navigation | Timeline Uber-style en homepage |
| **Messagerie** | Sans quitter le flow | Inline chat, pas de page séparée |

### Critical Success Moments

| Moment | Persona | "Aha!" |
|--------|---------|--------|
| **Mission acceptée** | Marc | "J'ai trouvé quelqu'un en 2h !" |
| **Paiement reçu** | Karim | "Payé en 48h, fiable" |
| **Mission validée** | Marc | "Photos avant/après, impeccable" |
| **1ère mission complétée** | Both | Activation réussie |

**Make-or-break flow:** `Publication → Acceptation → Réalisation → Validation → Paiement`

### Experience Principles

| # | Principe | Application |
|---|----------|-------------|
| **1** | **Speed First** | Chaque action < 3 taps/clics |
| **2** | **Mobile Reality** | Tout fonctionne sur 4G, une main |
| **3** | **Trust by Design** | Séquestre visible, timeline claire |
| **4** | **Zero Ambiguity** | Statuts explicites, prochaine action évidente |
| **5** | **Pro-grade Simplicity** | Interface pro mais pas complexe |

## Desired Emotional Response

### Primary Emotional Goals

| Persona | Émotion Principale | Ce qu'ils diront |
|---------|-------------------|------------------|
| **Marc (Garage)** | **Soulagement + Confiance** | "Enfin une solution fiable, je peux me concentrer sur mon métier" |
| **Karim (Technicien)** | **Autonomie + Sécurité** | "Je contrôle mon planning et je suis payé à coup sûr" |

**Émotion différenciante:** Confiance transactionnelle — le séquestre Stripe élimine l'anxiété du paiement

### Emotional Journey Mapping

| Phase | Marc (Garage) | Karim (Technicien) |
|-------|---------------|-------------------|
| **Découverte** | Curiosité → "Ça existe ?" | Intérêt → "Missions sans démarcher ?" |
| **Inscription** | Confiance → Kbis = sérieux | Facilité → Profil en 5 min |
| **1ère mission** | Anxiété légère → "Qui va répondre ?" | Excitation → "Je choisis mes missions" |
| **Matching** | Soulagement → "Il a 4.8★, parfait" | Satisfaction → "Mission à 30 min, bien payée" |
| **Réalisation** | Sérénité → Timeline claire | Focus → "Je fais mon job" |
| **Validation** | Satisfaction → Photos impeccables | Accomplissement → "Mission terminée" |
| **Paiement** | Contrôle → "J'ai validé, libéré" | Sécurité → "48h, c'est fait" |

### Micro-Emotions

| Micro-émotion | À favoriser | À éviter |
|---------------|-------------|---------|
| **Confiance** | Séquestre visible, profils vérifiés | Doute sur le paiement |
| **Contrôle** | Annulation possible, timeline claire | Processus opaque |
| **Accomplissement** | Feedback immédiat, badges | Incertitude sur le statut |
| **Appartenance** | Réseau pro, favoris | Plateforme froide/anonyme |

### Design Implications

| Émotion | UX Design Approach |
|---------|-------------------|
| **Confiance** | Badge "Paiement sécurisé" visible, photos profils, ratings proéminents |
| **Contrôle** | Stepper progression, boutons action explicites, undo possible |
| **Soulagement** | Confirmation visuelles (✓ vert), notifications push succès |
| **Accomplissement** | Célébration mission terminée, compteur missions |
| **Sécurité** | Iconographie cadenas, montant séquestre toujours affiché |

### Emotional Design Principles

| # | Principe | Application |
|---|----------|-------------|
| **1** | **Visible Trust** | Éléments de confiance toujours visibles (séquestre, rating, vérifications) |
| **2** | **Progress Certainty** | L'utilisateur sait TOUJOURS où il en est |
| **3** | **Instant Feedback** | Chaque action = confirmation immédiate |
| **4** | **Pro Recognition** | Valoriser le professionnalisme (badges, historique, stats) |
| **5** | **Calm Commerce** | Transactions sans friction ni anxiété |

## Inspiration Analysis

### Reference Products

| Produit | Patterns à emprunter | Application VitroLib |
|---------|---------------------|---------------------|
| **Doctolib** | Booking flow simple, disponibilités claires | Publication mission en 3 étapes |
| **Uber** | Timeline temps réel, tracking statut | Suivi mission en cours |
| **Leboncoin** | Liste filtrable, cards informatives | Liste missions disponibles |
| **Stripe Dashboard** | Transactions claires, historique | Suivi paiements |
| **Malt** | Profils freelance, ratings | Profils techniciens |

### Patterns to Adopt

- **Card-based listings** (Leboncoin) → Missions en grille/liste
- **Progressive disclosure** (Doctolib) → Wizard publication mission
- **Real-time updates** (Uber) → WebSocket notifications
- **Trust badges** (Malt) → Vérifications visibles

## Design System Foundation

### Brand Personality

| Attribut | Valeur | Manifestation UX |
|----------|--------|------------------|
| **Professionnel** | B2B, sérieux | Typographie clean, peu de couleurs |
| **Fiable** | Paiement sécurisé | Badges confiance, iconographie solide |
| **Efficace** | Gain de temps | UI minimaliste, actions rapides |
| **Accessible** | Artisans terrain | Grands boutons, contraste fort |

### Color Palette

| Rôle | Couleur | Hex | Usage |
|------|---------|-----|-------|
| **Primary** | Bleu VitroLib | `#2563EB` | Actions principales, liens |
| **Secondary** | Gris ardoise | `#475569` | Textes secondaires |
| **Success** | Vert émeraude | `#10B981` | Validations, succès |
| **Warning** | Orange ambre | `#F59E0B` | Alertes, attention |
| **Error** | Rouge corail | `#EF4444` | Erreurs, annulations |
| **Background** | Gris clair | `#F8FAFC` | Fonds de page |

### Typography

| Niveau | Font | Size | Weight | Usage |
|--------|------|------|--------|-------|
| **H1** | Inter | 32px | 700 | Titres pages |
| **H2** | Inter | 24px | 600 | Sections |
| **H3** | Inter | 18px | 600 | Sous-sections |
| **Body** | Inter | 16px | 400 | Texte courant |
| **Small** | Inter | 14px | 400 | Labels, captions |
| **Micro** | Inter | 12px | 500 | Badges, tags |

### Spacing Scale

```
4px  → micro (badges internes)
8px  → small (padding boutons)
16px → base (gaps standards)
24px → medium (sections)
32px → large (séparations majeures)
48px → xl (marges page)
```

## Visual Foundation

### Iconography

| Catégorie | Style | Bibliothèque |
|-----------|-------|--------------|
| **UI Icons** | Outlined, 24px | Lucide Icons |
| **Status Icons** | Filled, 16px | Lucide Icons |
| **Illustrations** | Flat, minimal | Custom ou unDraw |

### Shadows & Elevation

| Niveau | Usage | CSS |
|--------|-------|-----|
| **sm** | Cards repos | `0 1px 2px rgba(0,0,0,0.05)` |
| **md** | Cards hover | `0 4px 6px rgba(0,0,0,0.1)` |
| **lg** | Modals, dropdowns | `0 10px 15px rgba(0,0,0,0.1)` |

### Border Radius

| Élément | Radius |
|---------|--------|
| Boutons | 8px |
| Cards | 12px |
| Inputs | 6px |
| Badges | 9999px (pill) |
| Avatars | 50% (circle) |

## Design Directions

### Direction choisie : "Pro Trust"

Interface professionnelle épurée inspirée des dashboards SaaS B2B, avec accents de confiance (badges, vérifications) et efficacité (actions rapides, feedback immédiat).

**Caractéristiques visuelles :**
- Fond clair avec cartes blanches
- Accent bleu pour actions
- Vert pour validations/succès
- Iconographie cohérente Lucide
- Typographie Inter pour lisibilité

## User Journeys (Wireframes conceptuels)

### Journey Marc : Publier une Mission

```
[Dashboard] → [+ Nouvelle Mission] → [Step 1: Véhicule] → [Step 2: Vitrage] → [Step 3: Lieu/Date] → [Confirmation] → [Attente réponses]
```

**Écrans clés :**
1. **Dashboard Garage** : Missions en cours (cards), bouton CTA "Nouvelle mission"
2. **Wizard Mission** : 3 steps, progression visible, preview à droite
3. **Attente** : Timeline "En attente de technicien", notifications activées

### Journey Karim : Accepter une Mission

```
[Liste Missions] → [Filtre zone] → [Détail Mission] → [Accepter] → [Chat Marc] → [Réaliser] → [Upload Photos] → [Valider] → [Paiement reçu]
```

**Écrans clés :**
1. **Liste Missions** : Cards avec distance, prix, type vitrage, date
2. **Détail Mission** : Toutes infos, profil garage, bouton "Accepter"
3. **Mission Active** : Timeline statut, chat intégré, bouton photos
4. **Upload Photos** : Camera native, overlay guidé "Avant/Après"

## Component Strategy

### Atomic Design Structure

```
atoms/
  ├── Button.vue (primary, secondary, danger)
  ├── Input.vue (text, email, tel, textarea)
  ├── Badge.vue (status, rating, verified)
  ├── Avatar.vue (user, garage)
  ├── Icon.vue (wrapper Lucide)
  └── Spinner.vue

molecules/
  ├── InputField.vue (label + input + error)
  ├── Card.vue (header, body, footer slots)
  ├── MissionCard.vue (mission summary)
  ├── UserBadge.vue (avatar + name + rating)
  ├── StatusTimeline.vue (mission progress)
  └── ChatMessage.vue

organisms/
  ├── MissionList.vue (filtres + cards)
  ├── MissionWizard.vue (3-step form)
  ├── ChatPanel.vue (messages + input)
  ├── ProfileCard.vue (user details)
  ├── PaymentSummary.vue (amounts + status)
  └── Navbar.vue / Sidebar.vue

templates/
  ├── DashboardLayout.vue (sidebar + content)
  ├── PublicLayout.vue (header + footer)
  └── AuthLayout.vue (centered card)
```

### Key Components Specs

| Composant | Props | Events |
|-----------|-------|--------|
| **Button** | variant, size, loading, disabled | click |
| **MissionCard** | mission, compact | click, accept |
| **StatusTimeline** | steps, currentStep | — |
| **ChatPanel** | messages, missionId | send |

## UX Patterns

### Forms

- **Validation** : Inline, temps réel (VeeValidate + Zod)
- **Errors** : Rouge sous le champ, message explicite
- **Success** : Bordure verte, check icon
- **Loading** : Spinner dans le bouton, disabled state

### Navigation

- **Garage** : Sidebar fixe (Dashboard, Missions, Paiements, Profil)
- **Technicien** : Bottom nav mobile (Missions, Mes missions, Profil)
- **Breadcrumbs** : Pour flows multi-étapes

### Notifications

| Type | Trigger | UX |
|------|---------|---|
| **Toast** | Actions succès/erreur | Bottom-right, 3s auto-dismiss |
| **Push** | Nouvelle mission, message | Native browser/mobile |
| **Badge** | Messages non lus | Dot rouge sur icône |

### Empty States

- Illustration + titre + CTA
- "Aucune mission en cours" → "Publier ma première mission"

### Loading States

- **Skeleton** pour listes (missions, messages)
- **Spinner** pour actions (boutons)
- **Progress bar** pour uploads

## Responsive & Accessibility

### Breakpoints

| Breakpoint | Min-width | Usage |
|------------|-----------|-------|
| **sm** | 640px | Mobile landscape |
| **md** | 768px | Tablet |
| **lg** | 1024px | Desktop small |
| **xl** | 1280px | Desktop large |

### Mobile Adaptations

| Desktop | Mobile |
|---------|--------|
| Sidebar navigation | Bottom tab bar |
| Table views | Card stacks |
| Multi-column | Single column |
| Hover states | Touch feedback |

### Accessibility Requirements

| Critère | Implementation |
|---------|----------------|
| **Contraste** | WCAG AA minimum (4.5:1 texte) |
| **Focus** | Outline visible 2px bleu |
| **Aria** | Labels sur tous les interactifs |
| **Keyboard** | Navigation complète Tab/Enter |
| **Screen reader** | Alt texts, aria-live pour notifications |

## Implementation Notes

### Tech Stack Alignment

| UX Decision | Tech Implementation |
|-------------|---------------------|
| Atomic Design | `resources/js/components/{atoms,molecules,organisms,templates}/` |
| Design Tokens | TailwindCSS config custom |
| Icons | `lucide-vue-next` package |
| Forms | VeeValidate + Zod schemas |
| Animations | CSS transitions, pas de lib lourde |

### Storybook Integration

Tous les composants atoms/molecules documentés dans Storybook avec :
- Variants visuels
- Props playground
- Usage examples
- Accessibility checks
