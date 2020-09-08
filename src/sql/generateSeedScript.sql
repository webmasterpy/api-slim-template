drop database if exists testAPI;

create database testAPI;

use testAPI;

create table Users (UserId int auto_increment, Name varchar(100), Password varchar(500), Email varchar(50), IsActive int,
                            primary key (UserId))
ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='users table';

insert into Users (Name, Password, Email, IsActive) values ('Fernando Montoya', '$2y$12$x/NtPeiW38YZlYlGNAJ2veh09WxCAE1mbyBQEbLyPOB1g9CcOF2VK', 'test@test.com', 1);

create table data (id int auto_increment, name varchar(100),
                    primary key (id))
ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='data table';

insert into data (name) values ('test');
    
