# C:\xampp\mysql\bin\mysql -uroot --default_character_set=utf8 < C:\Users\Kleep\Documents\GitHub\PP25\SQL\Sa_predavanja\bela.sql

drop database if exists bela;
create database bela charset utf8mb4;
use bela;

create table partija_igrac (
    partija int not null,
    igrac int not null
);

create table partija (
    id int not null primary key auto_increment,
    lokacija int,
    unosi int,
    dokolikoseigra int not null,
    vrsta varchar(30) not null 
);

create table igrac (
    id int not null primary key auto_increment,
    ime varchar(40) not null,
    prezime varchar(40) not null,
    urlslika varchar(50) not null,
    spol int not null
);

create table lokacija (
    id int not null primary key auto_increment,
    longitude decimal(8,5),
    latitude decimal(8,5)
);

create table mjesanje (
    id int not null primary key auto_increment,
    partija int,
    stiglja boolean not null,
    belot boolean not null,
    datumunosa datetime not null,
    vrsta varchar(30),
    bodovaprviunos int,
    bodovadrugiunos int,
    zvanjeprviunos int,
    zvanjedrugiunos int,
    bodovatreciunos int,
    zvanjetreciunos int
);

alter table partija add foreign key (lokacija) references lokacija(id);
alter table partija_igrac add foreign key (partija) references partija(id);
alter table partija_igrac add foreign key (igrac) references igrac(id);
alter table mjesanje add foreign key (partija) references partija(id);
alter table partija add foreign key (unosi) references igrac(id);