# ristorante-tradizione
Ristorante pizzeria - Tradizione

## 🎨 Design del Progetto (Figma)

Per questo progetto è stata seguita una metodologia di design preventiva. È possibile consultare i wireframe e il prototipo interattivo direttamente su Figma tramite il seguente link:

[![Figma](https://img.shields.io/badge/Figma-F24E1E?style=for-the-badge&logo=figma&logoColor=white)](https://www.figma.com/design/TOzWcIeQ6Ahs8P3L9Z8Tt2/Wireframe---Pizzeria?node-id=0-1&p=f&t=RE54bmQshkSnCI8P-0)

> [!TIP]
> Puoi visualizzare l'architettura delle informazioni e il flusso di navigazione dell'utente nel link sopra indicato.

---

## 🎨 Design e Prototipazione (Figma)

Il design visivo e l'architettura delle informazioni sono disponibili su Figma. Puoi consultare i wireframe e il flusso di navigazione al seguente link:

[![Figma](https://img.shields.io/badge/Figma-F24E1E?style=for-the-badge&logo=figma&logoColor=white)](https://www.figma.com/design/TOzWcIeQ6Ahs8P3L9Z8Tt2/Wireframe---Pizzeria?node-id=0-1&p=f&t=RE54bmQshkSnCI8P-0)

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
