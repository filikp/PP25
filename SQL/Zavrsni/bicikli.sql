# C:\xampp\mysql\bin\mysql -uroot --default_character_set=utf8 < C:\Users\Kleep\Documents\GitHub\PP25\SQL\Zavrsni\bicikli.sql

drop database if exists trgovina_bicikala;
create database trgovina_bicikala charset utf8mb4;
use trgovina_bicikala;

create table bicikl (
    sifra int not null primary key auto_increment,
    proizvodac varchar(50) not null,
    namjena varchar(40),
    elektricni boolean,
    broj_brzina int,
    velicina_cm decimal(5,2),
    cijena_kn decimal(18,2)
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
    prezime varchar(50) not null,
    mobitel varchar(30)
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

insert into bicikl (proizvodac, namjena, elektricni, broj_brzina, velicina_cm, cijena_kn)
values	('Trek', 'MTB', false, 30, 48, 7999),
		('Trek', 'Cestovni', false, 27, 43, 5499),
		('Giant', 'MTB', false, 20, 51, 9899),
		('Scott', 'Trkači', false, 30, 53.5, 13699),
		('Nakamura', 'Cestovni', false, 27, 38, 3599),
		('Trek', 'MTB', true, 11, 48, 45199);

insert into prodavac (ime, prezime, email, OIB, IBAN)
values 	('Mirko', 'Filipović', 'mirkofilipovic@gmail.com', '72839461728', 'HR8172638291800027836'),
		('Marko', 'Lozić', 'mlozic@gmail.com', '99892038716', 'HR1829300004736290006'),
		('Stjepan', 'Mažuranić', 'stjmazur@gmail.com', '76756281962', 'HR9812220003748590235');
		
insert into kupac (ime, prezime, mobitel)
values 	('Filip', 'Kovač', '09112345678'),
		('Ivan', 'Horvat', '0992387766'),
		('Zvonimir', 'Scitovski', '0951185523');
	
insert into racun (vrijeme_kupnje, prodavac, kupac)
values 	('2022-05-24', 1, 1),
		('2022-03-11', 1, 2),
		('2021-11-21', 2, 3),
		('2022-06-03', 3, 1),
		('2020-11-01', 2, 2);
		
insert into stavka (bicikl, kolicina, racun)
values 	(6, 1, 4),
		(2, 3, 2),
		(3, 1, 1),
		(5, 10, 3),
		(4, 1, 5);