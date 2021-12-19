/* Luodaan tietokanta */
CREATE DATABASE v0kahe03;

USE v0kahe03;

/* Luodaan taulut */
CREATE TABLE user (
    id int primary key auto_increment,
    username varchar(40) text not null,
    password varchar(40) text not null
);

CREATE TABLE info (
    id int primary key auto_increment,
    firstname varchar(40) text not null,
    lastname varchar(40) text not null,
    userid int not null, 
    index userid(userid),
    foreign key (userid) references user(id)
    on delete restrict
);