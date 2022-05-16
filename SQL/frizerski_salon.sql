# C:\xampp\mysql\bin\mysql -uroot --default_character_set=utf8 < C:\Users\Kleep\Documents\GitHub\PP25\SQL\frizerski_salon.sql

# Frizerski salon

-- U frizerskom salonu radi više djelatnica. 
-- Jedna djelatnica na dan radi s više korisnika. 
-- Korisnik tijekom jednog posjeta koristi jednu usluga.

drop database if exists frizerski_salon;
create database frizerski_salon charset utf8mb4;
use frizerski_salon;

create table djelatnik (
    sifra int not null primary key auto_increment,
    osoba int not null,
    IBAN varchar(50)
);

create table osoba (
    sifra int not null primary key auto_increment,
    ime varchar(30) not null,
    prezime varchar(30) not null,
    email varchar(50),
    OIB char(11)
);

create table korisnik (
    sifra int not null primary key auto_increment,
    osoba int not null,
    usluga int not null,
    student boolean,
    termin datetime,
    djelatnik int not null
);

create table usluga (
    sifra int not null primary key auto_increment,
    naziv_usluge varchar(50) not null,
    cijena decimal(6,2),
    trajanje_minute int
);

alter table korisnik add foreign key (djelatnik) references djelatnik(sifra) ON DELETE CASCADE;
alter table korisnik add foreign key (usluga) references usluga(sifra) ON DELETE CASCADE;
alter table korisnik add foreign key (osoba) references osoba(sifra) ON DELETE CASCADE;

alter table djelatnik add foreign key (osoba) references osoba(sifra);

INSERT INTO osoba (ime, prezime)
VALUES  ('Filip', 'Kovač'),
        ('Mirko', 'Filipović'),
        ('Janica', 'Kostelić'),
        ('Đurđa', 'Botušić');

INSERT INTO djelatnik (osoba)
VALUES  (3),
        (4);

INSERT INTO usluga (naziv_usluge, cijena, trajanje_minute)
VALUES  ('šišanje kose', 50, 45),
        ('brijanje brade', 30, 20),
        ('bojanje kose', 100, 120),
        ('pranje kose', 20, 10);

INSERT INTO korisnik (osoba, usluga, student, djelatnik)
VALUES  (1,1,1,1),
        (2,3,0,2);

UPDATE osoba
SET ime = 'Ivan', prezime = 'Petrović'
WHERE ime = 'Filip';

UPDATE usluga
SET cijena = 200
WHERE naziv_usluge = 'bojanje kose';

UPDATE korisnik
SET usluga = 4, djelatnik = 2
WHERE osoba = 1;

DELETE FROM usluga
WHERE naziv_usluge = 'brijanje brade';