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
│   ├── config/          # Configurazione del database e costanti globali
│   ├── controllers/     # Logica di controllo (Gestione richieste HTTP)
│   ├── helpers/         # Funzioni ausiliarie e utility riutilizzabili
│   ├── middleware/      # Filtri di accesso (es. autenticazione sessioni)
│   ├── models/          # Logica dei dati: interazione con la base di dati pizzeria_db
│   └── views/           # Interfaccia utente (Template Engine)
│       ├── includes/    # Componenti parziali (header, footer, navbar)
│       ├── 404.php      # Pagina di errore risorsa non trovata
│       ├── 503.php      # Pagina di modalità manutenzione (site_settings)
│       ├── all_recipes.php # Catalogo completo delle ricette
│       ├── our-menu.php    # Visualizzazione del menu (menu_items)
│       ├── dashboard.php # Pannello di amministrazione per gestione contenuti
│       ├── index.php    # Home page del sito
│       └── login.php    # Form di accesso per amministratori/collaboratori
├── public/              # Unica cartella accessibile dal web (Root del server)
│   ├── assets/          # Risorse statiche: immagini ricette (es. margherita.webp)
│   ├── js/              # Logica lato client (JavaScript)
│   ├── style/           # Fogli di stile CSS e framework (Bootstrap)
│   └── index.php        # Front Controller: punto di ingresso unico all'app
├── .htaccess            # Regole di Apache per URL puliti (Mod_Rewrite)
├── LICENSE              # Licenza del software (MIT)
└── README.md            # Documentazione tecnica del progetto
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

Il progetto utilizza **MySQL** con le seguenti tabelle principali per la gestione dei contenuti e degli utenti:

### 📊 Modello dei Dati

| Tabella | Descrizione |
| :--- | :--- |
| **`menu_categories`** | Gestisce le categorie del menu come pizze, bevande e vini, includendo l'ordine di visualizzazione. |
| **`menu_items`** | Contiene i prodotti specifici offerti nel menu, i relativi prezzi, la disponibilità e il collegamento alle ricette. |
| **`site_settings`** | Conserva le configurazioni globali del sito, come l'attivazione della modalità manutenzione. |
| **`recipes`** | Memorizza le informazioni dettagliate delle pizze, i processi di preparazione e le valutazioni. |
| **`users`** | Gestisce le credenziali di accesso e i ruoli del sistema. |

### 📝 Dizionario della Tabella menu_categories
| Campo | Tipo | Descrizione |
| :--- | :--- | :--- |
| **`id`** | INT | Chiave primaria autoincrementale. |
| **`slug`** | VARCHAR(50) | Identificatore testuale per URL amichevoli. |
| **`name`** | VARCHAR(100) | Nome della categoria (es. PIZZE, BEVANDE). |
| **`display_order`** | INT | Ordine di visualizzazione nel menu. |

### 📝 Dizionario della Tabella menu_items
| Campo | Tipo | Descrizione |
| :--- | :--- | :--- |
| **`id`** | INT | Chiave primaria autoincrementale. |
| **`category_id`** | INT | FK. Riferimento alla categoria di appartenenza. |
| **`name`** | VARCHAR(150) | Nome del piatto o prodotto. |
| **`description`** | TEXT | Ingredienti o dettagli dell'articolo. |
| **`price`** | DECIMAL(10,2) | Prezzo di vendita. |
| **`is_available`** | TINYINT | Disponibilità (1 = disponibile, 0 = esaurito). |
| **`recipe_id`** | INT | FK. Riferimento opzionale a una ricetta dettagliata. |

### 📝 Dizionario della Tabella recipes
| Campo | Tipo | Descrizione |
| :--- | :--- | :--- |
| **`id`** | INT | Chiave primaria autoincrementale. |
| **`title`** | VARCHAR(150) | Nome della ricetta. |
| **`subtitle`** | VARCHAR(150) | Breve descrizione secondaria o slogan. |
| **`description`** | TEXT | Introduzione o riassunto del piatto. |
| **`complete_process`**| TEXT | Istruzioni passo dopo passo per l'elaborazione. |
| **`preparation_time`**| VARCHAR(50) | Tempo stimato di preparazione. |
| **`rating`** | DECIMAL(2,1) | Valutazione della ricetta (da 0.0 a 5.0). |
| **`image_url`** | VARCHAR(255) | Nome o percorso del file immagine. |
| **`created_at`** | TIMESTAMP | Data di creazione del record. |

### 📝 Dizionario della Tabella site_settings
| Campo | Tipo | Descrizione |
| :--- | :--- | :--- |
| **`id`** | INT | Chiave primaria autoincrementale. |
| **`setting_key`** | VARCHAR(50) | Chiave univoca dell'impostazione (es. maintenance_mode). |
| **`setting_value`** | TINYINT | Valore dell'impostazione (booleano 0/1). |

### 📝 Dizionario della Tabella users
| Campo | Tipo | Descrizione |
| :--- | :--- | :--- |
| **`id`** | INT | Chiave primaria autoincrementale. |
| **`username`** | VARCHAR(50) | Nome utente univoco per il login. |
| **`password`** | VARCHAR(255) | Password cifrata. |
| **`role`** | VARCHAR(20) | Ruolo dell'utente (es. Amministratore, Collaboratore). |

---

## 🔗 Relazioni tra le Tabelle (Logica di Business)
| Relazione | Cardinalità | Descrizione |
| :--- | :--- | :--- |
| **`Categoría > Articoli`** | 1:N | Una categoria contiene più prodotti. Se la categoria viene eliminata, i prodotti vengono rimossi (CASCADE). |
| **`Ricetta > Articoli`** | 1:1 / 1:N | Un articolo può avere una ricetta. Se la ricetta viene eliminata, l'articolo rimane nel menu (SET NULL). |

---

## 🚀 Installazione del Database

Per replicare l'ambiente dei dati localmente, segui questi passaggi:

### 1. Creazione delle Tabelle
Esegui il seguente script SQL nel tuo gestore (phpMyAdmin o MySQL Workbench):

```sql
CREATE TABLE `menu_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `display_order` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `is_available` tinyint(1) DEFAULT 1,
  `recipe_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_category` FOREIGN KEY (`category_id`) REFERENCES `menu_categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_recipe` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(50) NOT NULL,
  `setting_value` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_key` (`setting_key`)
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
-- Categorie di esempio
INSERT INTO `menu_categories` (`slug`, `name`, `display_order`) VALUES
('PIZZE', 'LE NOSTRE PIZZE', 1),
('BEVANDE', 'LE NOSTRE BEVANDE', 2),
('VINI', 'I NOSTRI VINI', 3);

-- Ricette di esempio
INSERT INTO `recipes` (`title`, `subtitle`, `description`, `complete_process`, `preparation_time`, `rating`, `image_url`) VALUES
('Margherita Classica', 'La regina di Napoli', 'Il simbolo universale della pizza italiana.', '1. Impasto... 2. Pomodoro... 3. Cottura...', '20 min', 5.0, 'margherita.webp'),
('Diavola Piccante', 'Un tocco di fuoco', 'Per chi ama i sapori forti.', '1. Base... 2. Salame... 3. Cottura...', '25 min', 4.8, NULL),
('Quattro Formaggi Bianca', 'Sinfonia di latticini', 'Una prelibatezza senza pomodoro.', '1. Selezione... 2. Base... 3. Cottura...', '25 min', 4.7, NULL),
('Pistacchio e Mortadella', 'Delizia Gourmet', 'Una delle pizze bianche più amate.', '1. Base... 2. Cottura... 3. Ingredienti a freddo...', '20 min', 5.0, 'pistacchio.webp');

-- Articoli del menu di esempio
INSERT INTO `menu_items` (`category_id`, `name`, `description`, `price`, `is_available`, `recipe_id`) VALUES
(1, 'Pizza Margherita', 'Pomodoro, mozzarella, basilico fresco.', 7.50, 1, 1),
(1, 'Pizza Diavola', 'Pomodoro, mozzarella, salame piccante.', 9.50, 1, 2),
(2, 'Acqua Minerale (500ml)', NULL, 1.50, 1, NULL),
(3, 'Chianti Classico (Rosso)', 'Toscana, Italia', 24.00, 1, NULL);

-- Impostazioni del sito
INSERT INTO `site_settings` (`setting_key`, `setting_value`) VALUES
('maintenance_mode', 0);

-- Utenti di sistema
INSERT INTO `users` (`username`, `password`, `role`) VALUES
('Gabriel', 'Admin%1987', 'Amministratore'),
('Franco', 'Pizza%2026', 'Collaboratore');
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
