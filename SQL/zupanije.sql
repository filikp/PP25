# C:\xampp\mysql\bin\mysql -uroot --default_character_set=utf8 < C:\Users\Kleep\Documents\GitHub\PP25\SQL\zupanije.sql

DROP DATABASE IF EXISTS zupanije;
CREATE DATABASE zupanije DEFAULT charset utf8mb4;
USE zupanije;

CREATE TABLE zupanija (
    sifra INT NOT NULL PRIMARY KEY auto_increment,
    naziv VARCHAR(50) NOT NULL,
    zupan INT NOT NULL
);

CREATE TABLE zupan (
    sifra INT NOT NULL PRIMARY KEY auto_increment,
    ime VARCHAR(30) NOT NULL,
    prezime VARCHAR(30) NOT NULL    
);

CREATE TABLE opcina (
    sifra INT NOT NULL PRIMARY KEY auto_increment,
    zupanija INT NOT NULL,
    naziv VARCHAR(50)
);

CREATE TABLE mjesto (
    sifra INT NOT NULL PRIMARY KEY auto_increment,
    opcina INT NOT NULL,
    naziv VARCHAR(50)
);

ALTER TABLE zupanija ADD FOREIGN KEY (zupan) REFERENCES zupan(sifra) ON DELETE CASCADE;
ALTER TABLE opcina ADD FOREIGN KEY (zupanija) REFERENCES zupanija(sifra) ON DELETE CASCADE;
ALTER TABLE mjesto ADD FOREIGN KEY (opcina) REFERENCES opcina(sifra) ON DELETE CASCADE;

INSERT INTO zupan (ime, prezime)
VALUES  ('Filip', 'Kovač'),
        ('Mislav', 'Petrović'),
        ('Luka', 'Bušić');

INSERT INTO zupanija (naziv, zupan)
VALUES  ('Osječko-baranjska',1),
        ('Splitsko-dalmatinska',2),
        ('Primorsko-goranska',3);

INSERT INTO opcina (naziv, zupanija)
VALUES  ('Đakovo',1),
        ('Strizivojna',1),
        ('Split',2),
        ('Kaštel',2),
        ('Fužine',3),
        ('Vrbovsko',3);

INSERT INTO mjesto (naziv, opcina)
VALUES  ('Pisak',1),
        ('Kuševac',1),
        ('Piškorevci',1),
        ('Đakovački Selci',1);

INSERT INTO mjesto (naziv, opcina)
VALUES  ('Split', 2),
        ('Makarska', 2),
        ('Kaštel gornji', 2),
        ('Kaštel donji', 2);

INSERT INTO mjesto (naziv, opcina)
VALUES  ('Opatija', 3),
        ('Crikvenica', 3),
        ('Rijeka', 3),
        ('Baška', 3);

UPDATE mjesto
SET naziv = 'Gašinci'
WHERE sifra = 2;

UPDATE mjesto
SET naziv = 'Ilok'
WHERE sifra = 5;

UPDATE mjesto
SET naziv = 'Zagreb'
WHERE sifra = 7;

UPDATE mjesto
SET naziv = 'Pula'
WHERE sifra = 11;

UPDATE mjesto
SET naziv = 'Umag'
WHERE sifra = 6;

DELETE FROM opcina
WHERE naziv = 'Đakovo';
DELETE FROM opcina
WHERE naziv = 'Split';