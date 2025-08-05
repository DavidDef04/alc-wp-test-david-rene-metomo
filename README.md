# Test Développeur Full‑Stack Web – ALC Digital

Projet réalisé dans le cadre du test technique proposé par **ALC Digital – Douala, Cameroun**.  
Stack utilisée : WordPress, Astro.js, React, JavaScript/TypeScript, IA.

---

## 🏁 Partie A : Mini‑site WordPress

### 0️ Contraintes & environnement

- Déploiement choisi : **Railway (Docker)**
- Dépôt GitHub public : [`alc-wp-test-david-rene-metomo`]
- Pipeline CI/CD configuré (Railway) → Déclenchement automatique sur chaque push vers `main`
- URL publique : `https://alc-wp-test-david-rene-metomo-production.up.railway.app/`
- Accès temporaire :  
  - **Identifiant admin** : `//`  
  - **Mot de passe** : //

---

### 1️ Thème enfant + bloc Gutenberg

- Thème parent : `Twenty Twenty‑Five`
- Thème enfant `alc-child` :
  - `style.css`, `functions.php`, `theme.json`
  - Menu primaire enregistré
  - Pattern `Hero ALC` défini
- Bloc personnalisé `alc/cta-banner` :
  - Composant React
  - Props : titre, texte, URL, couleur de fond
  - Compatible éditeur & front-end
  - Responsive + accessibilité (focus + ARIA)

---

### 2️ Plugin “Témoignages”

- CPT `testimonial` :
  - Titre = nom client
  - Contenu = avis client
  - Métadonnée sécurisée `rating` (1–5)
- Shortcode `[alc_testimonials]` :
  - Affiche 6 avis
  - Bouton AJAX « Charger plus » via JS
- Route REST `alc/v1/testimonials` :
  - Méthode `GET`
  - Pagination supportée
- Options ALC :
  - Page de réglages personnalisée (Réglages > ALC)
  - Champ : slogan du site

---

### 3️ Déploiement CI/CD

- Déploiement via Docker (Railway)
- Pipeline automatique via GitHub Actions (ou Railway hooks)
- Trigger sur chaque push vers `main`
- `.env` non versionné (exclu via `.gitignore`)
- Variables d’environnement injectées via Railway UI

---

### 4️ Installation locale

#### Prérequis

```bash
git clone https://github.com/DavidDef04/alc-wp-test-david-rene-metomo.git
cd wp-content
