# 0. Kreirajte tablice (16) i veze između tablica. (6)

# C:\xampp\mysql\bin\mysql -uroot --default_character_set=utf8  < C:\Users\Kleep\Documents\GitHub\PP25\SQL\DZ_mini_break\kolokvij_vjezba_1.sql

drop database if exists vjezba_1;
create database vjezba_1 default charset utf8mb4;
use vjezba_1;

create table sestra (
    sifra int not null primary key auto_increment,
    introvertno boolean,
    haljina varchar(31) not null,
    maraka decimal(16,6),
    hlace varchar(46) not null,
    narukvica int not null
);

create table zena (
    sifra int not null primary key auto_increment,
    treciputa datetime,
    hlace varchar(46),
    kratkamajica varchar(31) not null,
    jmbag char(11) not null,
    bojaociju varchar(39) not null,
    haljina varchar(44),
    sestra int not null
);

create table muskarac (
    sifra int not null primary key auto_increment,
    bojaociju varchar(50) not null,
    hlace varchar(30),
    modelnaocala varchar(43),
    maraka decimal(14,5) not null,
    zena int not null
);

create table mladic (
    sifra int not null primary key auto_increment,
    suknja varchar(50) not null,
    kuna decimal(16,8) not null,
    drugiputa datetime,
    asocijalno boolean,
    ekstroventno boolean not null,
    dukserica varchar(48) not null,
    muskarac int
);

create table svekar (
    sifra int not null primary key auto_increment,
    bojaociju varchar(40) not null,
    prstena int,
    dukserica varchar(41),
    lipa decimal(13,8),
    eura decimal(12,7),
    majica varchar(35)
);

create table sestra_svekar (
    sifra int not null primary key auto_increment,
    sestra int not null,
    svekar int not null
);

create table punac (
    sifra int not null primary key auto_increment,
    ogrlica int,
    gustoca decimal(14,9),
    hlace varchar(40) not null
);

create table cura (
    sifra int not null primary key auto_increment,
    novcica decimal(16,5) not null,
    gustoca decimal(18,6) not null,
    lipa decimal(13,10),
    ogrlica int not null,
    bojakose varchar(38),
    suknja varchar(36),
    punac int
);

alter table zena add foreign key (sestra) references sestra(sifra);
alter table muskarac add foreign key (zena) references zena(sifra);
alter table mladic add foreign key (muskarac) references muskarac(sifra);

alter table cura add foreign key (punac) references punac(sifra);
alter table sestra_svekar add foreign key (sestra) references sestra(sifra);
alter table sestra_svekar add foreign key (svekar) references svekar(sifra);

-- # 1. U tablice muskarac, zena i sestra_svekar unesite po 3 retka

-- insert into sestra (haljina, hlace, narukvica)
-- values 	('Only', 'Only', 14), 
-- 		('Tom Tailor', 'Jeans', 12),
-- 		('Gucci', 'Versace', 9);

-- insert into zena (kratkamajica, jmbag, bojaociju,  sestra)
-- values 	('Tommy Hilfiger', 67281906547, 'plava', 1),
-- 		('Gucci', 87543890765, 'zelena', 2),
-- 		('Prada', 12789304726, 'smeđa', 3);
	
-- insert into muskarac (bojaociju,maraka,zena)
-- values 	('zelena', 135.25, 1),
-- 		('plava', 170.99, 2),
-- 		('smeđa', 15.99, 3);

-- insert into svekar (bojaociju)
-- values 	('smeđa'),
-- 		('smeđa'),
-- 		('siva');

-- insert into sestra_svekar (sestra, svekar)
-- values 	(1,1), 
-- 		(2,2), 
-- 		(3,3);

-- # 2. U tablici cura postavite svim zapisima kolonu gustoca na vrijednost 15.77

-- insert into cura (novcica, gustoca, ogrlica)
-- values 	(11.22, 14.55, 5),
-- 		(5.33, 21.66, 123),
-- 		(55.22, 12.11, 16);

-- update cura 
-- set gustoca = 15.77
-- where gustoca > 0;

