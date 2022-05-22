# C:\xampp\mysql\bin\mysql -uroot --default_character_set=utf8 < C:\Users\Kleep\Documents\GitHub\PP25\SQL\bicikli.sql

drop database if exists trgovina_bicikala;
create database trgovina_bicikala charset utf8mb4;
use trgovina_bicikala;

create table bicikl (
    sifra int not null primary key auto_increment,
    proizvodac varchar(50) not null,
    namjena varchar(40),
    elektricni boolean,
    broj_brzina int,
    velicina decimal(5,2),
    cijena decimal(18,2)
);

create table prodavac (
    sifra int not null primary key auto_increment,
    ime varchar(50) not null,
    prezime varchar(50) not null,
    email varchar(50),
    OIB char(11),
    IBAN varchar(50)
);

create table kupac (
    sifra int not null primary key auto_increment,
    ime varchar(50) not null,
    prezime varchar(50) not null
);

create table stavka (
    sifra int not null primary key auto_increment,
    bicikl int not null,
    kolicina int,
    racun int not null
);

create table racun (
    sifra int not null primary key auto_increment,
    vrijeme_kupnje datetime,
    prodavac int not null,
    kupac int not null
);

alter table stavka add foreign key (racun) references racun(sifra);
alter table stavka add foreign key (bicikl) references bicikl(sifra);
alter table racun add foreign key (prodavac) references prodavac(sifra);
alter table racun add foreign key (kupac) references kupac(sifra);