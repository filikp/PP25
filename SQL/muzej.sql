# C:\xampp\mysql\bin\mysql -uroot < C:\Users\Kleep\Documents\GitHub\PP25\SQL\muzej.sql

# Muzej

drop database if exists muzej;
create database muzej;
use muzej;

create table izlozba (
    vrsta_djela varchar(50),
    broj_djela varchar(50),
    kustos varchar(50),
    sponzor varchar(50)
);

create table kustos (
    ime varchar(50),
    prezime varchar(50),
    OIB varchar(50),
    IBAN varchar(50),
    email varchar(50)
);

create table sponzor (
    ime_sponzora varchar(50),
    vrijednost_sponzora varchar(50),
    trajanje_ugovora varchar(50)
);