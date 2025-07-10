# Oppryddede migrasjoner for Erle

Dette er en oppryddet versjon av migrasjonsfilene som slår sammen relaterte endringer og fjerner unødvendige mellomsteg.

## Endringer gjort:

### 1. Users-tabellen
- Slått sammen alle brukerfelt i én migrasjon
- Inkludert: avatar, locale, roles, bio
- Fjernet separate migrasjoner for disse feltene

### 2. Contacts-tabellen  
- Slått sammen alle kontaktfelt i én migrasjon
- Inkludert: organization_number, contact_persons (JSON)
- Fjernet separate migrasjoner for disse feltene
- Fjernet midlertidige felt som ble erstattet

### 3. Forbedret indeksering
- Lagt til relevante indekser for bedre ytelse
- Tydelige foreign key-relasjoner

## Instruksjoner for å bruke:

1. **Stopp alle aktive migrasjoner**
2. **Sikkerhetskopier databasen**
3. **Kjør rollback til fresh state**
4. **Erstatt gamle migrasjoner med nye**
5. **Kjør migrasjoner på nytt**

## Kommandoer:

```bash
# Sikkerhetskopi
php artisan db:backup

# Rollback alle
php artisan migrate:fresh

# Flytt nye migrasjoner
mv database/migrations_clean/*.php database/migrations/

# Kjør migrasjoner
php artisan migrate
```

## Fordeler:

- **Renere struktur**: Færre migrasjoner å håndtere
- **Bedre ytelse**: Riktige indekser fra start
- **Enklere vedlikehold**: Mindre kompleksitet
- **Tydelige relasjoner**: Bedre foreign key-struktur
