# 🍕 Ristorante Pizzeria - Tradizione
> Un'esperienza culinaria digitale: Sistema di gestione ricette e menu sviluppato in PHP e MySQL.

![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
[![PHP Version](https://img.shields.io/badge/PHP-8.2.12-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-10.4.32-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
![SQL](https://img.shields.io/badge/SQL-CC2927?style=for-the-badge&logo=sqlite&logoColor=white)
[![Figma](https://img.shields.io/badge/Figma-F24E1E?style=for-the-badge&logo=figma&logoColor=white)](https://www.figma.com/design/TOzWcIeQ6Ahs8P3L9Z8Tt2/Wireframe---Pizzeria?node-id=0-1&p=f&t=RE54bmQshkSnCI8P-0)
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)

---

## 📖 Descrizione
**Tradizione** è una piattaforma web progettata per un ristorante-pizzeria che permette di gestire e visualizzare un catalogo completo di ricette autentiche. Il progetto si concentra sulla semplicità d'uso e sulla fedeltà alle preparazioni classiche italiane.

### ✨ Caratteristiche Principali
* **Catalogo Ricette**: Visualizzazione dettagliata con tempi di preparazione, descrizioni e processi completi.
* **Sistema di Valutazione**: Ogni piatto include un punteggio (rating) basato sull'esperienza degli utenti.
* **Area Riservata**: Accesso sicuro per gli amministratori per gestire i contenuti del menu.
* **Design Responsivo**: Progettato meticolosamente su Figma per garantire un'ottima esperienza su ogni dispositivo.

## 📂 Struttura del Progetto

Il progetto è organizzato seguendo un'architettura **MVC (Model-View-Controller)** semplificata, che separa la logica di gestione dei dati dall'interfaccia utente:

```text
RISTORANTE-TRADIZIONE
├── app/
│   ├── config/          # File di configurazione (DB, costanti, parametri globali)
│   ├── controllers/     # Logica di controllo: elabora le richieste e gestisce i dati
│   ├── models/          # Logica dei dati: classi e funzioni per l'interazione con il database
│   └── views/           # Interfaccia utente: file PHP/HTML e componenti del layout (header/footer)
├── public/              # Punto di accesso pubblico (Root del server)
│   ├── assets/          # Risorse statiche: immagini delle ricette e icone
│   ├── js/              # Script per il comportamento lato client
│   ├── style/           # Fogli di stile CSS per il design responsivo
│   └── index.php        # Front Controller: gestisce tutte le richieste in entrata
├── .htaccess            # Regole di configurazione del server e URL puliti
└── README.md            # Documentazione del progetto
```
💡 Organizzazione dei Contenuti
Logica Applicativa (app/): Questa cartella contiene il nucleo del sistema. È protetta dall'accesso diretto via browser per garantire la sicurezza del codice e delle credenziali del database.

Accesso Pubblico (public/): Contiene solo i file che devono essere caricati dal browser (CSS, JS, Immagini). Il file index.php funge da unico punto di ingresso per l'intera applicazione.

Separazione delle Responsabilità: I Controller ricevono gli input, i Model interagiscono con il database pizzeria_db e le View si occupano esclusivamente della visualizzazione dei dati all'utente.

---

## 🎨 Design del Progetto (Figma)

Per questo progetto è stata seguita una metodologia di design preventiva. È possibile consultare i wireframe e il prototipo interattivo direttamente su Figma tramite il seguente link:

[![Figma](https://img.shields.io/badge/Figma-F24E1E?style=for-the-badge&logo=figma&logoColor=white)](https://www.figma.com/design/TOzWcIeQ6Ahs8P3L9Z8Tt2/Wireframe---Pizzeria?node-id=0-1&p=f&t=RE54bmQshkSnCI8P-0)

> [!TIP]
> Puoi visualizzare l'architettura delle informazioni e il flusso di navigazione dell'utente nel link sopra indicato.

---

## 🗄️ Struttura del Database

Il progetto utilizza **MySQL** (MariaDB) con le seguenti tabelle principali per la gestione dei contenuti e degli utenti:

### 📊 Modello dei Dati

| Tabella | Descrizione |
| :--- | :--- |
| **`recipes`** | Memorizza le informazioni dettagliate delle pizze, i processi di preparazione e le valutazioni. |
| **`users`** | Gestisce le credenziali di accesso e i ruoli del sistema. |

### 📝 Dizionario della Tabella `recipes`

| Campo | Tipo | Descrizione |
| :--- | :--- | :--- |
| **id** | `INT` | Chiave primaria autoincrementale. |
| **title** | `VARCHAR(150)` | Nome della ricetta. |
| **subtitle** | `VARCHAR(150)` | Breve descrizione secondaria o slogan. |
| **description** | `TEXT` | Introduzione o riassunto del piatto. |
| **complete_process**| `TEXT` | Istruzioni passo dopo passo per l'elaborazione. |
| **preparation_time**| `VARCHAR(50)` | Tempo stimato di preparazione. |
| **rating** | `DECIMAL(2,1)` | Valutazione della ricetta (da 0.0 a 5.0). |
| **image_url** | `VARCHAR(255)` | Nome o percorso del file immagine. |

---

## 🚀 Installazione del Database

Per replicare l'ambiente dei dati localmente, segui questi passaggi:

### 1. Creazione delle Tabelle
Esegui il seguente script SQL nel tuo gestore (phpMyAdmin o MySQL Workbench):

```sql
CREATE TABLE `recipes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `subtitle` varchar(150) DEFAULT NULL,
  `description` text NOT NULL,
  `complete_process` text NOT NULL,
  `preparation_time` varchar(50) DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT 0.0,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

```

### 2. Caricamento dei Dati Iniziali (Seeders)
Inserisci questi dati di esempio per testare le funzionalità:
```sql
-- Utente di esempio
INSERT INTO `users` (`username`, `password`, `role`) VALUES
('admin', 'admin123', 'administrador');

-- Ricette di esempio
INSERT INTO `recipes` (`title`, `subtitle`, `description`, `complete_process`, `preparation_time`, `rating`, `image_url`) VALUES
('Margherita Classica', 'La regina di Napoli', 'Il simbolo universale della pizza italiana.', '1. Impasto... 2. Pomodoro... 3. Cottura...', '20 min', 5.0, 'margherita.webp'),
('Diavola Piccante', 'Un tocco di fuoco', 'Per chi ama i sapori forti.', '1. Base... 2. Salame... 3. Cottura...', '25 min', 4.8, NULL),
('Quattro Formaggi Bianca', 'Sinfonia di latticini', 'Una prelibatezza senza pomodoro.', '1. Selezione... 2. Base... 3. Cottura...', '25 min', 4.7, NULL),
('Pizza Napoletana STG', 'Specialità Tradizionale Garantita', 'Il disciplinare ufficiale della pizza napoletana.', '1. Impasto... 2. Stesura... 3. Condimento...', '20 min', 4.8, NULL);
```
---

### 📜 Licenza
Questo progetto è distribuito sotto la licenza **MIT**. Consulta il file `LICENSE` per ulteriori dettagli.

<p align="center">
  Realizzato con ❤️ da <strong>Rotger Gabriel Augusto</strong><br>
  <i>"La vera tradizione si impasta con passione."</i>
</p>

<p align="center">
  <a href="#top">🔼 Torna all'inizio</a>
</p>
