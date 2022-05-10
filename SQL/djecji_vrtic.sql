# C:\xampp\mysql\bin\mysql -uroot < C:\Users\Kleep\Documents\GitHub\PP25\SQL\djecji_vrtic.sql

# Dječji vrtić

drop database if exists djecji_vrtic;
create database djecji_vrtic;
use djecji_vrtic;

create table odgojna_skupina (
    broj_djece varchar(50),
    odgojateljica varchar(50)
);

create table odgojateljica (
    ime varchar(50),
    prezime varchar(50),
    OIB varchar(50),
    IBAN varchar(50),
    email varchar(50),
    strucna_sprema varchar(50)
);