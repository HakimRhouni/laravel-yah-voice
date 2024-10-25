#!/bin/bash

# Arrêter le script en cas d'erreur
set -e

# Message d'accueil
echo "🔧 Configuration automatique du projet Laravel..."

# Vérification de la présence de PHP
if ! command -v php &> /dev/null
then
    echo "⚠️ PHP n'est pas installé. Installation de PHP..."
    sudo apt update
    sudo apt install -y php php-cli php-mbstring php-xml php-zip
else
    echo "✅ PHP est déjà installé."
fi

# Vérification de la présence du fichier .env
if [ ! -f .env ]; then
  echo "📄 Copie du fichier .env.example vers .env"
  cp .env.example .env
fi

# Mise à jour du fichier .env
echo "⚙️ Mise à jour des valeurs dans le fichier .env"
sed -i 's/DB_DATABASE=homestead/DB_DATABASE=votre_nom_de_base/' .env
sed -i 's/DB_USERNAME=homestead/DB_USERNAME=votre_nom_utilisateur/' .env
sed -i 's/DB_PASSWORD=secret/DB_PASSWORD=votre_mot_de_passe/' .env

# Installation des dépendances Composer
echo "📦 Installation des dépendances Composer..."
composer install

# Génération de la clé d'application Laravel
echo "🔑 Génération de la clé d'application..."
php artisan key:generate

# Installation des dépendances npm
echo "📦 Installation des dépendances npm..."
npm install

# Compilation des fichiers d'assets
echo "🚀 Compilation des fichiers front-end..."
npm run dev

# Exécution des migrations de la base de données
echo "🛠️ Exécution des migrations..."
php artisan migrate

# Fin du script
echo "🎉 Le projet a été configuré et est prêt à être utilisé."
