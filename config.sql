/* Luodaan tietokanta */
CREATE DATABASE v0kahe03;

USE v0kahe03;

/* Luodaan taulu käyttäjätiedoista: */
CREATE TABLE user (
    id int primary key auto_increment,
    username varchar(40) not null,
    password varchar(40) not null
);

/* Luodaan taulu käyttäjän yksityisistä tiedoista: */
CREATE TABLE info (
    id int primary key auto_increment,
    firstname varchar(40) not null,
    lastname varchar(40) not null,
    userid int not null, 
    index user_id(user_id),
    foreign key (user_id) references user(id)
    on delete restrict
);