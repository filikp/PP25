# C:\xampp\mysql\bin\mysql -uroot --default_character_set=utf8  < C:\Users\Kleep\Documents\GitHub\PP25\SQL\DZ_mini_break\kolokvij_vjezba_2.sql

drop database if exists vjezba_2;
create database vjezba_2 default charset utf8mb4;
use vjezba_2;

create table decko (
    sifra int not null primary key auto_increment,
    indiferentno boolean,
    vesta varchar(34),
    asocijalno boolean not null
);

create table decko_zarucnica (
    sifra int not null primary key auto_increment,
    decko int not null,
    zarucnica int not null
);

create table zarucnica (
    sifra int not null primary key auto_increment,
    narukvica int,
    bojakose varchar(37) not null,
    novcica decimal(15,9),
    lipa decimal(15,8) not null,
    indiferentno boolean not null
);

create table cura (
    sifra int not null primary key auto_increment,
    haljina varchar(33) not null,
    drugiputa datetime not null,
    suknja varchar(38),
    narukvica int,
    introvertno boolean,
    majica varchar(40) not null,
    decko int
);

create table neprijatelj (
    sifra int not null primary key auto_increment,
    majica varchar(32),
    haljina varchar(43) not null,
    lipa decimal(16,8),
    modelnaocala varchar(49) not null,
    kuna decimal(12,6) not null,
    jmbag char(11),
    cura int
);

create table brat (
    sifra int not null primary key auto_increment,
    suknja varchar(47),
    ogrlica int not null,
    asocijalno boolean not null,
    neprijatelj int not null
);

create table prijatelj (
    sifra int not null primary key auto_increment,
    modelnaocala varchar(37),
    treciputa datetime not null,
    ekstroventno boolean not null,
    prviputa datetime,
    svekar int not null
);

create table svekar (
    sifra int not null primary key auto_increment,
    stilfrizura varchar(48),
    ogrlica int not null,
    asocijalno boolean not null
);

alter table decko_zarucnica add foreign key (decko) references decko(sifra);
alter table decko_zarucnica add foreign key (zarucnica) references zarucnica(sifra);
alter table cura add foreign key (decko) references decko(sifra);
alter table neprijatelj add foreign key (cura) references cura(sifra);
alter table brat add foreign key (neprijatelj) references neprijatelj(sifra);
alter table prijatelj add foreign key (svekar) references svekar(sifra);

# 1. U tablice neprijatelj, cura i decko_zarucnica unesite po 3 retka

insert into neprijatelj (haljina, modelnaocala, kuna)
values 	('dugacka', 'Ray Ban', 1234.99),
		('kratka haljina', 'Police', 2223.88),
		('ljetna haljina', 'Brze naocale', 19.99);

insert into cura (haljina, drugiputa, majica)
values 	('kratka haljina', '1999-05-25', 'Kratka majica'),
		('Duga haljina', '2009-11-12', 'Duga majica'),
		('Kratka haljina', '2020-02-20', 'Majica bez rukava');

insert into zarucnica (bojakose, lipa, indiferentno)
values 	('Plava', 11.55, true),
		('Crna', 44.88, false),
		('Zelena', 98.77, true);
	
insert into decko (asocijalno)
values 	(true),
		(false),
		(false);

insert into decko_zarucnica (decko, zarucnica)
values 	(1,2),
		(2,3),
		(3,1);