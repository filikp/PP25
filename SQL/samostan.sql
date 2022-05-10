# C:\xampp\mysql\bin\mysql -uroot < C:\Users\Kleep\Documents\GitHub\PP25\SQL\samostan.sql

# Samostan

drop database if exists samostan;
create database samostan;
use samostan;

create table svecenik (
    osoba varchar(50),
    nadredjeni_svecenik varchar(50)
);

create table nadredjeni_svecenik (
    osoba varchar(50)
);

create table osoba (
    ime varchar(50),
    prezime varchar(50),
    OIB varchar(50),
    IBAN varchar(50),
    email varchar(50)
);

create table posao (
    vrsta_posla varchar(50),
    trajanje_posla varchar(50),
    lokacija_posla varchar(50)
);