CREATE TABLE transazioni (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_utente INT,
    importo DECIMAL(10,2),
    carta VARCHAR(255),
    data_operazione DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_utente) REFERENCES utenti(id)
);

INSERT INTO transazioni (id_utente, importo, carta, data_operazione) VALUES
(1, 120.50, '4539 1488 0343 6467', '2025-04-10'),
(2, 89.99, '5500 0000 0000 0004', '2025-02-20'),
(3, 250.00, '3400 0000 0000 009', '2025-01-02'),
(1, 50.00, '4539 1488 0343 6467', '2025-05-08'),
(4, 300.75, '6011 0000 0000 0004', '2025-03-14');