#!/bin/bash

# Fonction pour afficher les messages avec style
function print_message() {
  echo -e "\n\e[1;32m$1\e[0m\n"
}

# 1. Cloner le dépôt Laravel (si nécessaire)
print_message "Clonage du dépôt..."
git clone https://github.com/HakimRhouni/laravel-yah-voice

# Se déplacer dans le dossier du projet
cd my-argon-dashboard 

# 2. Installer les dépendances avec Composer
print_message "Installation des dépendances avec Composer..."
composer install

# 3. Configurer le fichier .env
print_message "Configuration du fichier .env..."
cp .env.example .env

# Modifier automatiquement certaines valeurs du fichier .env
sed -i 's/APP_NAME=Laravel/APP_NAME="VotreNomDeProjet"/' .env
sed -i 's/DB_DATABASE=laravel/DB_DATABASE=nom_de_votre_base/' .env
sed -i 's/DB_USERNAME=root/DB_USERNAME=nom_utilisateur/' .env
sed -i 's/DB_PASSWORD=/DB_PASSWORD=mot_de_passe/' .env

# 4. Générer la clé de l'application
print_message "Génération de la clé de l'application..."
php artisan key:generate

# 5. Lancer les migrations de base de données (si nécessaire)
print_message "Exécution des migrations..."
php artisan migrate

# 6. Lancer le serveur Laravel
print_message "Démarrage du serveur Laravel..."
php artisan serve --host=0.0.0.0 --port=8000
