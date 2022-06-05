drop database if exists vjezba_3;
create database vjezba_3 default charset utf8mb4;
use vjezba_3;

create table svekar (
    sifra int not null primary key auto_increment,
    novcica decimal(16,8) not null,
    suknja varchar(44) not null,
    bojakose varchar(36),
    prstena int,
    narukvica int not null,
    cura int not null
);

create table cura (
    sifra int not null primary key auto_increment,
    dukserica varchar(49),
    maraka decimal(13,7),
    drugiputa datetime,
    majica varchar(49),
    novcica decimal(15,8),
    ogrlica int not null
);

create table snasa (
    sifra int not null primary key auto_increment,
    introvertno boolean,
    kuna decimal(15,6) not null,
    eura decimal(12,9) not null,
    treciputa datetime,
    ostavljena int not null
);

create table punica (
    sifra int not null primary key auto_increment,
    asocijalno boolean,
    kratkamajica varchar(44),
    kuna decimal(13,8) not null,
    vesta varchar(32) not null,
    snasa int
);

create table ostavljena (
    sifra int not null primary key auto_increment,
    kuna decimal(17,5),
    lipa decimal(15,6),
    majica varchar(36),
    modelnaocala varchar(31) not null,
    prijatelj int
);

create table prijatelj (
    sifra int not null primary key auto_increment,
    kuna decimal(16,10),
    haljina varchar(37),
    lipa decimal(13,10),
    dukserica varchar(31),
    indiferentno boolean not null
);

create table prijatelj_brat (
    sifra int not null primary key auto_increment,
    prijatelj int not null,
    brat int not null
);

create table brat (
    sifra int not null primary key auto_increment,
    jmbag char(11),
    ogrlica int not null,
    ekstroventno boolean not null
);


alter table svekar add foreign key (cura) references cura(sifra);
alter table punica add foreign key(snasa) references snasa(sifra);
alter table snasa add foreign key (ostavljena) references ostavljena(sifra);
alter table ostavljena add foreign key (prijatelj) references prijatelj(sifra);
alter table prijatelj_brat add foreign key (prijatelj) references prijatelj (sifra);
alter table prijatelj_brat add foreign key (brat) references brat(sifra);


# 1.

insert into snasa (kuna, eura, ostavljena)
values 	(13.55, 2.54, 1),
		(12.22, 3.55, 2),
		(54.32, 14.66, 3);

insert into ostavljena (modelnaocala)
values 	('brze'),
		('Ray Ban'),
		('Police');
		
insert into prijatelj_brat (prijatelj, brat)
values 	(1,1),
		(2,2),
		(3,3);

insert into prijatelj (indiferentno)
values	(true),
		(false),
		(true);
		
insert into brat (ogrlica, ekstroventno)
values 	(3, true),
		(55, false),
		(23, true);
		
# dodatno
	
insert into cura (ogrlica)
values 	(13),
		(44),
		(52);
	
insert into svekar (novcica, suknja, narukvica, cura)
values 	(12.34, 'dugacka suknja', 44, 1),
		(43.21, 'kratka suknja', 12, 2),
		(11.45, 'ljetna suknja', 99, 3);
		
insert into punica (kuna, vesta)
values 	(66.89, 'bapska vesta'),
		(467.43, 'pokidana vesta'),
		(87.32, 'karirana vesta');
		
# 2
	
update svekar 
set suknja = 'Osijek'
where sifra > 0;

# 3
delete from punica where kratkamajica = 'AB';

# 4
select majica from ostavljena 
where lipa in (9,10,20,30);

# 5

select a.ekstroventno, f.vesta, e.kuna 
from brat a inner join prijatelj_brat b 
on a.sifra = b.brat 
inner join prijatelj c on b.prijatelj = c.sifra 
inner join ostavljena d on c.sifra = d.prijatelj 
inner join snasa e on d.sifra = e.ostavljena 
inner join punica f on e.sifra = f.snasa
where d.lipa != 91 and c.haljina like "%ba%"
order by e.kuna desc; 