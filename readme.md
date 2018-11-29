# Libreto

Un Libreto est un carnet de note collaboratif fondé sur [etherpad](https://etherpad.org).
Il peut devenir un mini-site, le carnet de bord d'un workshop, le support de rédaction d'un livre collectif ou tout autre chose.

Libreto est libre, gratuit, et minimaliste.

Pas d'inscription, pas de connexion, tout le monde peut éditer un Libreto, comme un wiki.

## Installer Libreto (apache)

```
git clone https://github.com/Ventricule/libreto.git
cp libreto/dist/config* libreto/config.php
cp libreto/dist/.htaccess libreto/.htaccess
git submodule update --init --recursive
```

Modifier les variables de configuration du nouveau fichier config.php en fonction de votre propre personnalisation.

Faites de même pour le fichier .htaccess puis configurer un virtual host apache avec pour dossier racine ```/<path-to>/libreto```


## Installer Libreto avec YunoHost
Un package Libreto pour YunoHost existe.

[![Install Libreto with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=libreto)
