# mes-candidatures
## 📋 Gestion des Candidatures PFE

Cette application est conçue pour faciliter la gestion des candidatures pour des stages de fin d'études (PFE) grâce à **Laravel** et **Livewire**. Elle offre des fonctionnalités complètes pour ajouter, modifier, supprimer et rechercher des candidatures.

---

## 🌟 Fonctionnalités

- **CRUD complet** : Ajouter, modifier et supprimer des candidatures.
- **Recherche dynamique** : Trouver facilement une candidature par :
  - Entreprise
  - Ville
  - Poste
  - Technologies
- **Tri interactif** : Trier les candidatures par colonnes (Entreprise, Poste, Ville, etc.).
- **Feedback utilisateur** : Affichage de messages de confirmation et de gestion des erreurs.

---

## 📁 Structure du Projet

### 🔑 Fichier Principal : `Candidature.php`

Le fichier contient :
- **Validation** : Validation des données avec Livewire (`$this->validate`).
- **Gestion des actions CRUD** :
  - `createCandidature()` : Ajouter une candidature.
  - `updateCandidature()` : Modifier une candidature.
  - `deleteCandidature()` : Supprimer une candidature.
- **Recherche et tri** : Gestion des filtres dynamiques avec des propriétés Livewire.

### 📄 Vue : `candidature.blade.php`

La vue contient :
- **Formulaire** : Ajouter ou modifier une candidature.
- **Liste des candidatures** : Affichage dynamique via Livewire.
- **Boutons interactifs** : Édition et suppression des entrées.
- **Messages utilisateur** : Confirmation ou erreurs après chaque action.

---

## 🛠️ Technologies Utilisées

- **Backend** : [Laravel 10](https://laravel.com/)
- **Frontend** : [Livewire](https://laravel-livewire.com/) pour des interfaces dynamiques
- **UI Styling** : [Tailwind CSS](https://tailwindcss.com/) pour une personnalisation rapide et élégante

---

## 🚀 Installation et Configuration

### 📝 Prérequis

- **PHP 8.1+** avec Composer
- **MySQL** ou tout autre gestionnaire de base de données compatible
- **Node.js** et **NPM/Yarn** (pour les assets front-end)

### ⚙️ Étapes d'installation

1. **Clonez le dépôt** :
   ```bash
   git clone https://github.com/votre-utilisateur/gestion-candidatures.git
   cd gestion-candidatures
   ```
   
2. **Installez les dépendances PHP** :
   ```bash
   composer install
   ```

3. **Configurez l'environnement** : Dupliquez le fichier `.env.example` et nommez-le `.env`, puis ajoutez vos configurations :
   ```env
   DB_DATABASE=nom_de_la_base
   DB_USERNAME=utilisateur
   DB_PASSWORD=mot_de_passe
   ```

4. **Lancez les migrations** :
   ```bash
   php artisan migrate
   ```

5. **Compilez les assets front-end** (si nécessaire) :
   ```bash
   npm install && npm run dev
   ```

6. **Lancez le serveur local** :
   ```bash
   php artisan serve
   ```

7. **Accédez à l'application** : Ouvrez [http://localhost:8000](http://localhost:8000) dans votre navigateur.

---

## 🔍 Utilisation

### ➕ Ajouter une Candidature
1. Remplissez le formulaire d'ajout en haut de la page.
2. Cliquez sur **Ajouter** pour enregistrer la candidature.

### ✏️ Modifier une Candidature
1. Cliquez sur le bouton **Modifier** à côté de la candidature souhaitée.
2. Modifiez les champs nécessaires, puis cliquez sur **Mettre à jour**.

### 🗑️ Supprimer une Candidature
1. Cliquez sur le bouton **Supprimer**.
2. Confirmez l'action dans la boîte de dialogue.

### 🔍 Rechercher et Trier
- **Rechercher** : Saisissez un mot-clé dans la barre de recherche pour filtrer les candidatures.
- **Trier** : Cliquez sur les en-têtes des colonnes pour trier les résultats.

---

## 👤 Auteur

**[Elmahdi AI](https://github.com/ElmahdiAI)**  
Étudiant en développement web passionné par les frameworks modernes et les solutions dynamiques.

---

## 📝 Licence

Ce projet est distribué sous la licence [MIT](LICENSE). Consultez le fichier `LICENSE` pour plus d'informations.

