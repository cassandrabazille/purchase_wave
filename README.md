# 📦 Plateforme de Gestion des Achats

## 🧭 Contexte

Dans un environnement commercial où l'efficacité des achats est cruciale, les acheteurs ont besoin d'une solution centralisée, sécurisée et intuitive pour suivre leurs commandes. Ce projet propose une plateforme web et mobile permettant de consulter, suivre et gérer les commandes passées et en cours.

---

## ❗ Problématique

Les utilisateurs rencontrent aujourd’hui plusieurs difficultés :

- **Fragmentation des données** : informations dispersées entre fichiers, emails, et outils.
- **Suivi discontinu** : peu de visibilité sur l’état global des commandes.
- **Manque de flexibilité** : outils trop rigides, non personnalisables.
- **Sécurité faible** : données sensibles exposées, accès non sécurisé.

---

## 🎯 Objectifs

- 📱 Offrir une **expérience multi-appareil** fluide.
- 🔐 Sécuriser les accès via **JWT**.
- 📈 Suivre les **commandes en temps réel**.
- 🔎 Faciliter la **recherche multi-critères**.
- 🧩 Centraliser les données dans une **base fiable et synchronisée**.
- 🧠 Proposer une **interface intuitive** et simple d'utilisation.

---

## 💡 Fonctionnalités

### 1. Interface de Connexion

- Formulaire de connexion (email + mot de passe).
- Authentification sécurisée via JWT.
- Gestion de session et déconnexion propre.

### 2. Interface d’Accueil / Dashboard

- Vue globale des **livraisons à venir**.
- Suivi des **commandes en cours**, **livrées**, ou **en retard**.
- Indicateurs : **nombre de commandes**, **montants mensuels**, **top fournisseurs**.
- Accès rapide à l’ajout ou la consultation des commandes.

### 3. Interface de Gestion des Commandes

- **Tableau dynamique** des commandes avec colonnes :
  - Référence
  - Date
  - Statut
  - Fournisseur
  - Montant HT
  - Date de livraison prévue
- Opérations possibles :
  - 🔍 Consultation
  - ✏️ Modification
  - ❌ Suppression
  - ➕ Ajout

### 4. Interface Détail d’une Commande

- Affichage des produits d’une commande avec :
  - Référence produit
  - Descriptif
  - Prix unitaire
  - Quantité
  - Montant total
  - Photo (si dispo)
- Rattachement à une commande et un fournisseur
- Modification ou suppression directe de lignes

---

## ⚙️ Architecture Technique

### 🏗️ Structure

- **MVC Laravel** (Model - View - Controller)
- **Frontend** : Blade (HTML5, CSS3, Bootstrap, JS)
- **Backend** : Laravel RESTful API
- **Base de données** : MySQL / MariaDB

### 🔒 Sécurité

- Authentification JWT
- Hashage des mots de passe (bcrypt ou Argon2)
- Utilisation de HTTPS obligatoire
- Gestion des CORS (React.js compatible)

### ⚡ Performance

- Requêtes SQL optimisées (index, jointures, Eloquent)
- Option : mise en cache avec Redis
- Réduction des appels API via state local côté frontend

---

## 🧾 Livrables

### 1. Conception

- Dictionnaire des données
- MCD / MLD / MPD
- Diagramme de classes (backend)
- Cas d’usage (UML)
- Maquettes Figma des interfaces

### 2. Base de données

- Script SQL complet
- Jeu de données fictives

### 3. Backend Laravel

- API RESTful documentée
- Authentification JWT
- Contrôle CORS
- Eloquent + requêtes SQL optimisées

### 4. Frontend HTML/CSS/Bootstrap/JS

- Page de connexion / déconnexion
- Dashboard : livraisons, indicateurs, stats
- Interface commandes : CRUD complet
- Vue détail : produits, prix, quantités, images

---

## 🔧 Technologies

| Technologie     | Utilisation               |
|----------------|----------------------------|
| Laravel         | Backend & API REST        |
| Blade / Bootstrap | Frontend UI             |
| MySQL / MariaDB | Base de données relationnelle |
| JWT             | Authentification sécurisée |
| React.js        | (optionnel) Frontend SPA  |
| Redis (optionnel)| Cache & performance      |

---

## 📚 Auteurs

- Projet réalisé dans le cadre de [ton école ou ton programme ici]
- Développé par : [Ton nom]
- Contact : [ton@email.com]

---

## ✅ Statut

🚧 En cours de développement  
📅 Date de début : [à remplir]  
🎯 Date cible : [à remplir]

