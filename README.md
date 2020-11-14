# Albertos PHP MVC Framework

## Installation

Es müssen folgende Dateien angepasst werden:\
**Im Ordner config:** Alle Werte für die DB-Verbindung und Pfade zur URL und System-Ordner\
**Im Ordner public:** In der .htaccess Datei muss der Pfad bei "RewriteBase" angepasst werden

## Docker

Die docker-compose.yml enthält alle Images für eine funktionierende Entwicklungsumgebung mit PHP, MySQL und PHPMyAdmin.\
Das Dockerfile enthält alle nötigen Befehle, damit die Module **mod_rewrite** und **pdo_mysql** freigeschaltet werden.

```bash
Diese Module sind zwingend notwendig, damit das Framework korrekt funktioniert!
```
