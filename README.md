# Auktionssystem - Laravel Anwendung

## Projektbeschreibung

Dieses Projekt ist Teil meiner Bachelorarbeit mit dem Thema: "Integration des Domain-Driven-Designs in PHP-Frameworks:
Ein Vergleich von Laravel, Symfony und Laminas". In meiner Bachelorarbeit untersuche ich die Unterschiede in der
Implementierung des Domain-Driven Designs in diesen drei Frameworks und zeige die Stärken und Schwächen der jeweiligen
Ansätze auf.

Dieses Projekt ist eine einfache Auktionsanwendung, die mit dem Laravel Framework entwickelt wurde. Das System
ermöglicht es Benutzern, Auktionen zu erstellen und daran teilzunehmen. Die Anwendung unterstützt grundlegende
CRUD-Operationen für Auktionen und Gebote sowie die Benutzerauthentifizierung. Es gibt zwei Benutzerarten: Gäste und
eingeloggte Benutzer.

### Funktionalitäten

- **Nicht angemeldeter Benutzer**:
    - Registrierung im System
    - Anmeldung im System
    - Anzeigen der Liste der Auktionen
    - Ansehen von Auktionsdetails

- **Eingeloggter Benutzer**:
    - Erstellen, Bearbeiten und Löschen eigener Auktionen
    - Abgabe von Geboten auf Auktionen
    - Abmeldung aus dem System

### Installation

1. **Repository klonen**:
   ```bash
   git clone <repository-url>
   ```

2. **Abhängigkeiten installieren**:
   ```bash
   cd auction-laravel
   composer install
   npm install && npm run dev
   ```

3. **Umgebungsvariablen konfigurieren**:
   Kopiere die `.env.example` Datei und benenne sie in `.env` um:
   ```bash
   cp .env.example .env
   ```
   Aktualisiere die Umgebungsvariablen entsprechend deiner Datenbank- und Anwendungskonfiguration.

4. **Datenbankmigrationen ausführen**:
   ```bash
   php artisan migrate
   ```

5. **Entwicklungserver starten**:
   ```bash
   php artisan serve
   ```

### Technologien

- Laravel Framework
- MySQL (oder eine andere relationale Datenbank)
- Blade Templates für die Benutzeroberfläche
- Tailwind UI für das UI-Design


