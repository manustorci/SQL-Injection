CREATE TABLE utenti (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ruolo VARCHAR(255),
    nome VARCHAR(255),
    pass VARCHAR(255)
);

INSERT INTO utenti (ruolo, nome, pass) VALUES
('admin', 'emanuele', '123'),
('user', 'alessio', '000'),
('user', 'flaminia', 'ciao'),
('user', 'giuseppe', 'roma');