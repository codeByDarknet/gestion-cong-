# Gestion des Congés

## 🚀 Comment démarrager le Laravel

Vous Suivres ces étapes pour configurer et lancer pourvoir projet sur votre machine locale.

### ⚙️ Installation des dépendances
```sh
composer install
```

### 🔢 Création du fichier `.env`
```sh
cp .env.example .env
```
Remplissez le fichier `.env` avec vos configurations.

### 📂 Génération de la clé d'application
```sh
php artisan key:generate
```

### 📂 Création de la base de données
Assurez-vous que votre base de données est bien créée avec le nom spécifié dans `.env`. Si vous changez le nom, ajustez les configurations en conséquence.

### 🔄 Exécution des migrations
```sh
php artisan migrate
```

### 💡 Exécution des seeders (données fictives)
```sh
php artisan db:seed
```

### 🚀 Lancement du projet
```sh
php artisan serve
```

## 🔍 Avant de commencer
Avant de modifier le code, prenez le temps d'explorer :
- 📚 Les tables de la base de données
- 🌍 Les routes d'API
- 🎓 Les modèles
- 🎨 Les contrôleurs et la logique du projet


Bonne contribution ! ✨

