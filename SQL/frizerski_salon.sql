# C:\xampp\mysql\bin\mysql -uroot < C:\Users\Kleep\Documents\GitHub\PP25\SQL\frizerski_salon.sql

# Frizerski salon

drop database if exists frizerski_salon;
create database frizerski_salon;
use frizerski_salon;

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