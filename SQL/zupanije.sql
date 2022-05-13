# C:\xampp\mysql\bin\mysql -uroot --default_character_set=utf8 < C:\Users\Kleep\Documents\GitHub\PP25\SQL\zupanije.sql

drop database if exists zupanije;
create database zupanije default charset utf8mb4;
use zupanije;

create table zupanija (
    sifra int not null primary key auto_increment,
    naziv varchar(50) not null,
    zupan int not null
);

create table zupan (
    sifra int not null primary key auto_increment,
    ime varchar(30) not null,
    prezime varchar(30) not null    
);

create table opcina (
    sifra int not null primary key auto_increment,
    zupanija int not null,
    naziv varchar(50)
);

create table mjesto (
    sifra int not null primary key auto_increment,
    opcina int not null,
    naziv varchar(50)
);

alter table zupanija add foreign key (zupan) references zupan(sifra);
alter table opcina add foreign key (zupanija) references zupanija(sifra);
alter table mjesto add foreign key (opcina) references opcina(sifra);

insert into zupan (ime, prezime)
values ('Filip', 'Kovač');
insert into zupan (ime, prezime)
values ('Mislav', 'Petrović');
insert into zupan (ime, prezime)
values ('Luka', 'Bušić');

insert into zupanija (naziv, zupan)
values ('Osječko-baranjska',1);
insert into zupanija (naziv, zupan)
values ('Splitsko-dalmatinska',2);
insert into zupanija (naziv, zupan)
values ('Primorsko-goranska',3);

insert into opcina (naziv, zupanija)
values ('Đakovo',1);
insert into opcina (naziv, zupanija)
values ('Strizivojna',1);
insert into opcina (naziv, zupanija)
values ('Split',2);
insert into opcina (naziv, zupanija)
values ('Kaštel',2);
insert into opcina (naziv, zupanija)
values ('Fužine',3);
insert into opcina (naziv, zupanija)
values ('Vrbovsko',3);

insert into mjesto (naziv, opcina)
values ('Pisak',1);
insert into mjesto (naziv, opcina)
values ('Kuševac',1);
insert into mjesto (naziv, opcina)
values ('Piškorevci',1);
insert into mjesto (naziv, opcina)
values ('Đakovački Selci',1);

