# C:\xampp\mysql\bin\mysql -uroot < C:\Users\Kleep\Documents\GitHub\PP25\SQL\muzej.sql

# Muzej

-- U muzeju postoji više izložaba. 
-- Jedna izložba ima više djela. 
-- Svaki kustos je zadužen za jednu izložbu. 
-- Svaka izložba ima jednog sponzora.

drop database if exists muzej;
create database muzej;
use muzej;

create table izlozba (
    sifra int not null primary key auto_increment,
    vrsta_izlozbe varchar(50) not null,
    broj_djela int,
    sponzor int not null
);

create table djelo (
    sifra int not null primary key auto_increment,
    naziv_djela varchar(50) not null,
    vrsta_djela varchar(50),
    izlozba int not null
);

create table kustos (
    sifra int not null primary key auto_increment,
    ime varchar(50) not null,
    prezime varchar(50) not null,
    OIB char(11),
    IBAN varchar(50),
    email varchar(50),
    izlozba int not null
);

create table sponzor (
    sifra int not null primary key auto_increment,
    ime_sponzora varchar(50) not null,
    vrijednost_sponzora varchar(50),
    trajanje_ugovora varchar(50)
);

alter table izlozba add foreign key (sponzor) references sponzor(sifra);
alter table kustos add foreign key (izlozba) references izlozba(sifra);
alter table djelo add foreign key (izlozba) references izlozba(sifra);

# Ubacivanje

-- select * from izlozba;

-- insert into izlozba (vrsta_izlozbe, sponzor)
-- values ('Slike', 1);

-- select * from sponzor;

-- insert into sponzor (ime_sponzora)
-- values ('Pevec');

-- select * from djelo;

-- insert into djelo (naziv_djela, izlozba)
-- values ('Kikiriki', 1);

-- select * from kustos;

-- insert into kustos (ime, prezime, izlozba)
-- values ('Filip', 'Kovac', 1);