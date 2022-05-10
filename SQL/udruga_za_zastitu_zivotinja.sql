# C:\xampp\mysql\bin\mysql -uroot < C:\Users\Kleep\Documents\GitHub\PP25\SQL\udruga_za_zastitu_zivotinja.sql

# Udruga za zaštitu životinja

drop database if exists udruga_za_zastitu_zivotinja;
create database udruga_za_zastitu_zivotinja;
use udruga_za_zastitu_zivotinja;

create table radnik (
    ime varchar(50),
    prezime varchar(50),
    email varchar(50),
    OIB varchar(50),
    IBAN varchar(50)
);

create table sticenik_udruge (
    vrsta_zivotinje varchar(50),
    prostor varchar(50)
);

create table prostor (
    naziv_prostora varchar(50),
    povrsina varchar(50),
    zauzetost  varchar(50)
);