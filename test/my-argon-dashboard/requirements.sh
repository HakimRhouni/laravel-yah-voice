#!/bin/bash

# Fonction pour afficher des messages avec style
function print_message() {
  echo -e "\n\e[1;32m$1\e[0m\n"
}

# 1. Mise à jour du système
print_message "Mise à jour du système..."
sudo apt update && sudo apt upgrade -y

# 2. Installation de PHP et des extensions nécessaires
print_message "Installation de PHP 8.1 et des extensions requises pour Laravel 10..."
sudo apt install -y php8.1 php8.1-cli php8.1-common php8.1-curl php8.1-mbstring php8.1-xml php8.1-zip php8.1-bcmath php8.1-tokenizer php8.1-pdo php8.1-mysql

# 3. Installation de Composer
print_message "Installation de Composer..."
EXPECTED_CHECKSUM="$(php -r 'copy("https://composer.github.io/installer.sig", "php://stdout");')"
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
ACTUAL_CHECKSUM="$(php -r 'echo hash_file("sha384", "composer-setup.php");')"

if [ "$EXPECTED_CHECKSUM" != "$ACTUAL_CHECKSUM" ]; then
    >&2 echo 'ERROR: Invalid installer checksum'
    rm composer-setup.php
    exit 1
fi

php composer-setup.php --install-dir=/usr/local/bin --filename=composer
rm composer-setup.php

# 4. Vérification de l'installation de Composer
print_message "Vérification de l'installation de Composer..."
composer --version

# 5. Se déplacer dans le projet Laravel
print_message "Accès au dossier du projet Laravel..."
cd votre-dossier-laravel # Remplace par le chemin de ton projet existant

# 6. Installation des dépendances Laravel via Composer
print_message "Installation des dépendances Laravel..."
composer install

# 7. Configuration de l'environnement
print_message "Configuration du fichier .env..."
cp .env.example .env

# 8. Modification des paramètres du fichier .env
sed -i 's/APP_NAME=Laravel/APP_NAME="VotreNomDeProjet"/' .env
sed -i 's/DB_DATABASE=laravel/DB_DATABASE=nom_de_votre_base/' .env
sed -i 's/DB_USERNAME=root/DB_USERNAME=nom_utilisateur/' .env
sed -i 's/DB_PASSWORD=/DB_PASSWORD=mot_de_passe/' .env

# 9. Génération de la clé de l'application Laravel
print_message "Génération de la clé de l'application..."
php artisan key:generate

# 10. Migration de la base de données
print_message "Exécution des migrations de la base de données..."
php artisan migrate

# 11. Démarrage du serveur Laravel
print_message "Démarrage du serveur Laravel..."
php artisan serve --host=0.0.0.0 --port=8000
