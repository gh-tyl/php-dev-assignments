DROP DATABASE IF EXISTS `EmployDB`;
CREATE DATABASE `EmployDB` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `EmployDB`;

DROP TABLE IF EXISTS `emp_tb`;
CREATE TABLE `EmployDB`.`emp_tb` (
  `eid` INT NOT NULL,
  `fname` VARCHAR(50) NOT NULL,
  `lname` VARCHAR(50) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `pass` VARCHAR(200) NOT NULL,
  `married` BOOLEAN NOT NULL,
  `child_num` INT NOT NULL,
  PRIMARY KEY (`eid`)
  );

DROP TABLE IF EXISTS `position_tb`;
CREATE TABLE `EmployDB`.`position_tb` (
  `pid` INT NOT NULL,
  `p_name` VARCHAR(50) NOT NULL,
  `p_salary` DOUBLE NOT NULL,
  PRIMARY KEY (`pid`)
  );

DROP TABLE IF EXISTS `hire_tb`;
CREATE TABLE `EmployDB`.`hire_tb` (
  `contract_id` INT NOT NULL,
  `eid` INT NOT NULL,
  `pid` INT NOT NULL,
  `sDate` VARCHAR(50) NOT NULL,
  `eDate` VARCHAR(50) NOT NULL,
  -- `sDate` DATE NOT NULL,
  -- `eDate` DATE NOT NULL,
  PRIMARY KEY (`contract_id`),
  FOREIGN KEY (`eid`) REFERENCES `emp_tb`(`eid`) ON UPDATE CASCADE,
  FOREIGN KEY (`pid`) REFERENCES `position_tb`(`pid`)  ON UPDATE CASCADE
  );

DROP TABLE IF EXISTS `dep_tb`;
CREATE TABLE `EmployDB`.`dep_tb` (
  `did` INT NOT NULL,
  `d_name` VARCHAR(50) NOT NULL,
  `p_phone` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`did`)
  );

DROP TABLE IF EXISTS `dep_tr`;
CREATE TABLE `EmployDB`.`dep_tr` (
  `deptrid` INT NOT NULL,
  `contract_id` INT NOT NULL,
  `did` INT NOT NULL,
  PRIMARY KEY (`deptrid`),
  FOREIGN KEY (`contract_id`) REFERENCES `hire_tb`(`contract_id`) ON UPDATE CASCADE,
  FOREIGN KEY (`did`) REFERENCES `dep_tb`(`did`)  ON UPDATE CASCADE
  );
