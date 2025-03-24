# 🚀 Plant Care API (Laravel 12)

Une API Laravel 12 (PHP 8.4) pour gérer un catalogue personnalisé de plantes et leurs photos associées.

---

## 📆 Prérequis

- PHP >= 8.4
- Composer
- SQLite ou MySQL

---

## 📆 Installation

1. **Cloner le projet**
   ```bash
   git clone https://github.com/antoinegreuzard/plant-laravel-api
   cd plant-laravel-api
   ```

2. **Installer les dépendances PHP**
   ```bash
   composer install
   ```

3. **Copier le fichier d'environnement**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configurer la base de données**
    - Modifier `.env` pour utiliser SQLite (ou MySQL selon tes besoins)
    - Exemple SQLite :
      ```dotenv
      DB_CONNECTION=sqlite
      DB_DATABASE=database/database.sqlite
      ```

   ```bash
   touch database/database.sqlite
   php artisan migrate --seed
   ```

5. **Lancer le serveur**
   ```bash
   php artisan serve
   ```

L'API est accessible sur `http://127.0.0.1:8000/api/`

---

## 📢 Authentification (JWT)

Le projet utilise `tymon/jwt-auth` pour gérer l'authentification.

| Méthode | Endpoint              | Description                |
|---------|-----------------------|----------------------------|
| POST    | `/api/register/`      | Enregistrer un utilisateur |
| POST    | `/api/token/`         | Obtenir un token JWT       |
| POST    | `/api/token/refresh/` | Rafraîchir un token JWT    |

Ajouter le token dans l'en-tête `Authorization: Bearer {token}` pour accéder aux routes protégées.

---

## 🌿 Gestion des plantes

| Méthode | Endpoint            | Description                   |
|---------|---------------------|-------------------------------|
| GET     | `/api/plants/`      | Liste paginée des plantes     |
| POST    | `/api/plants/`      | Ajouter une nouvelle plante   |
| GET     | `/api/plants/{id}/` | Récupérer une plante          |
| PUT     | `/api/plants/{id}/` | Modifier une plante existante |
| DELETE  | `/api/plants/{id}/` | Supprimer une plante          |

---

## 📷 Photos de plantes

| Méthode | Endpoint                         | Description                       |
|---------|----------------------------------|-----------------------------------|
| POST    | `/api/plants/{id}/upload-photo/` | Ajouter une photo à une plante    |
| GET     | `/api/plants/{id}/photos/`       | Récupérer les photos d'une plante |

---

## ✅ Tests

Le projet utilise **Pest** pour les tests unitaires et fonctionnels.

### Lancer tous les tests

```bash
php artisan test
```

### Lancer uniquement les tests unitaires

```bash
php artisan test --testsuite=Unit
```

### Lancer uniquement les tests fonctionnels

```bash
php artisan test --testsuite=Feature
```

---

## 🛠 CI/CD avec GitHub Actions

Le projet utilise **GitHub Actions** pour :

- Lancer les tests avec Pest
- Vérifier les migrations
- Lint le code automatiquement

---

## 📜 Licence

Ce projet est sous licence **MIT**. 📄
