# C:\xampp\mysql\bin\mysql -uroot --default_character_set=utf8 < C:\Users\Kleep\Documents\GitHub\PP25\SQL\bicikli.sql

drop database if exists trgovina_bicikala;
create database trgovina_bicikala charset utf8mb4;
use trgovina_bicikala;

create table bicikl (
    sifra int not null primary key auto_increment,
    proizvodac varchar(50) not null,
    velicina int not null,
    vrsta int not null
);

create table velicina (
    sifra int not null primary key auto_increment,
    velicina_rame decimal(5,1),
    velicina_tockova decimal(5,1)
);

create table vrsta (
    sifra int not null primary key auto_increment,
    namjena varchar(40),
    elektricni boolean
);

create table broj_brzina (
    sifra int not null primary key auto_increment,
    prednji_zupcanik int,
    straznji_zupcanik int
); 

create table brzine_u_vrsti (
    sifra int not null primary key auto_increment,
    broj_brzina int not null,
    vrsta int not null
);

create table osoba (
    sifra int not null primary key auto_increment,
    ime varchar(50) not null,
    prezime varchar(50) not null,
    email varchar(50),
    OIB char(11)
);

create table prodavac (
    sifra int not null primary key auto_increment,
    osoba int not null,
    IBAN varchar(50),
    trgovina int not null
);

create table kupac (
    sifra int not null primary key auto_increment,
    osoba int not null,
    bicikl int not null
);

create table trgovina (
    sifra int not null primary key auto_increment,
    ime varchar(50) not null,
    bicikl int not null
);

create table lokacija (
    sifra int not null primary key auto_increment,
    grad varchar(50) not null,
    postanski_broj int not null,
    ulica varchar(50) not null,
    kucni_broj int not null,
    trgovina int not null
);

create table bicikl_trgovina (
    sifra int not null primary key auto_increment,
    bicikl int not null,
    trgovina int not null,
    cijena decimal (18,2)
);


alter table bicikl add foreign key (velicina) references velicina(sifra);
alter table bicikl add foreign key (vrsta) references vrsta(sifra);
alter table lokacija add foreign key (trgovina) references trgovina(sifra);
alter table bicikl_trgovina add foreign key (trgovina) references trgovina(sifra);
alter table bicikl_trgovina add foreign key (bicikl) references bicikl(sifra);
alter table prodavac add foreign key (trgovina) references trgovina(sifra);
alter table prodavac add foreign key (osoba) references osoba(sifra);
alter table kupac add foreign key (osoba) references osoba(sifra);
alter table brzine_u_vrsti add foreign key (broj_brzina) references broj_brzina(sifra);
alter table brzine_u_vrsti add foreign key (vrsta) references vrsta(sifra);