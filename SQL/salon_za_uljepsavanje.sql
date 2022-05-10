# C:\xampp\mysql\bin\mysql -uroot < C:\Users\Kleep\Documents\GitHub\PP25\SQL\salon_za_uljepsavanje.sql

# Salon za uljepšavanje

drop database if exists salon_za_uljepsavanje;
create database salon_za_uljepsavanje;
use salon_za_uljepsavanje;

create table djelatnik (
    osoba varchar(50),
    IBAN varchar(50)
);

create table osoba (
    ime varchar(50),
    prezime varchar(50),
    email varchar(50),
    OIB varchar(50)
);

create table korisnik (
    osoba varchar(50),
    usluga varchar(50)
);

create table usluga (
    naziv_usluge varchar(50),
    cijena varchar(50),
    trajanje varchar(50)
);