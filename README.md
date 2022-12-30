# Wycinek systemu sprzedaży

Aplikacja umożliwia:

- podgląd oraz dokonywanie operacji na bazie kontrahentów
- podgląd oraz dokonywanie operacji na bazie towarów
- podgląd oraz dokonywanie operacji na bazie faktur

Wideo poglądowe aplikacji: https://www.youtube.com/watch?v=emetcDepSJw&ab_channel=JakubKlejczyk

## Uruchomienie projektu

### Obsługa bazy danych

**PostgreSQL - pgAdmin4**

W repozytorium, w folderze database znajdują się dwa pliki.

sql_script - skryp do wglądu przez rekrutera.

sql_custom - skrypt, z którego odtwarzana będzie baza danych.

Dane konfiguracyjne bazy danych znajdują się w pliku config.php (src/api/config.php).

Po zalogowaniu się do serwera w programie pgAdmin4 należy utworzyć nową baze danych o nazwie "zadanie".

Po utworzeniu bazy, należy klinąć na nią prawym przyciskiem myszy oraz wybrać opcję "Restore..."

W zakładce General należy wybrać w pozycji Filename plik "sql_custom".

Po zakończeniu ładowania pliku baza danych powinna zostać odtworzona.

### Obsługa PHP

**XAMPP**

W celu obsługi PHP należy skorzystać z serwera dostępnego w ramach programu XAMPP.

Należy odnaleźć folder htdocs na komputerze.

Przykładowa ścieżka:
D:\xampp\htdocs

W folderze htdocs należy stworzyć nowy folder o naziwe "sensonics".

Do folder sensonics należy wkleić pliki pobrane z repozytorium.

Następnie, należy włączyć program XAMPP oraz uruchomić serwer Apache.

## Obsługa JavaScript

**Visual Studio Code**

Folder sensonics, w którym wcześniej zostały umieszczone pliki z repozytorium należy otworzyć za pomocą Visual Studio Code.

Następnie w konsoli należy wpisać:

```sh
npm install
```

oraz

```sh
npm run dev
```

Po otwarciu serwera testowego powinna uruchomić się aplikacja.
