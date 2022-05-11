# C:\xampp\mysql\bin\mysql -uroot < C:\Users\Kleep\Documents\GitHub\PP25\SQL\taxi_sluzba.sql

# Taxi služba

-- Taksi tvrtka ima više vozila. 
-- Jedno vozilo vozi jedan vozač. 
-- U jednoj vožnji vozač može prevesti više putnika. 
-- Jedan putnik se naravno može tijekom vremena imati više vožnji.

drop database if exists taxi_sluzba;
create database taxi_sluzba;
use taxi_sluzba;

create table vozilo (
    sifra int not null primary key auto_increment,
    proizvodjac varchar(30),
    vrsta_vozila varchar(30),
    prijedjeni_kilometri decimal,
    maksimalni_broj_putnika int not null,
    vozac int not null
);

create table vozac (
    sifra int not null primary key auto_increment,
    osoba int not null,
    IBAN varchar(50),
    vozilo int not null,
    voznja int not null
);

create table putnik (
    sifra int not null primary key auto_increment,
    osoba int not null,
    putnik_voznja int not null
);

create table putnik_voznja (
    sifra int not null primary key auto_increment,
    putnik int not null,
    voznja int not null
);

create table voznja (
    sifra int not null primary key auto_increment,
    polaziste varchar(50),
    odrediste varchar(50),
    cijena decimal,
    putnik_voznja int not null
);

create table osoba (
    sifra int not null primary key auto_increment,
    ime varchar(30),
    prezime varchar(30),
    OIB char(11),
    email varchar(50)
);

alter table vozac add foreign key (osoba) references osoba(sifra);
alter table vozac add foreign key (vozilo) references vozilo(sifra);
alter table vozac add foreign key (voznja) references voznja(sifra);

alter table putnik_voznja add foreign key (putnik) references putnik(sifra);
alter table putnik_voznja add foreign key (voznja) references voznja(sifra);