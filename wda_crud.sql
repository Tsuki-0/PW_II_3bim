SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

SET NAMES utf8;

CREATE DATABASE wda_crud;
USE wda_crud;

CREATE TABLE IF NOT EXISTS enfermeiros (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(255) NOT NULL,
  coren int(3) NOT NULL,
  cep varchar(9) NOT NULL,
  phone varchar(20) NOT NULL,
);

INSERT INTO `enfermeiros` (`name`, `coren`, `cep`, `phone`) 
VALUES ('Emerson Fagundes', 032, 12345680, '15998760925');