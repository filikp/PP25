# C:\xampp\mysql\bin\mysql -uroot < C:\Users\Kleep\Documents\GitHub\PP25\SQL\taxi_sluzba.sql

# Taxi služba

drop database if exists taxi_sluzba;
create database taxi_sluzba;
use taxi_sluzba;

create table vozilo (
    proizvodjac varchar(50),
    vrsta_vozila varchar(50),
    prijedjeni_kilometri varchar(50),
    maksimalni_broj_putnika varchar(50)
);

create table vozac (
    osoba varchar(50),
    IBAN varchar(50),
    vozilo varchar(50)
);

create table putnik (
    osoba varchar(50),
    polaziste varchar(50),
    odrediste varchar(50)
);

create table osoba (
    ime varchar(50),
    prezime varchar(50),
    OIB varchar(50),
    email varchar(50)
);