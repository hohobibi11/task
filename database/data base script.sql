-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema ibookdb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ibookdb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ibookdb` DEFAULT CHARACTER SET utf8 ;
USE `ibookdb` ;

-- -----------------------------------------------------
-- Table `ibookdb`.`book`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ibookdb`.`book` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NOT NULL,
  `isbn` VARCHAR(10) NOT NULL,
  `date_pub` DATE NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `isbn_UNIQUE` (`isbn` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ibookdb`.`author`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ibookdb`.`author` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `f_name` VARCHAR(45) NOT NULL,
  `birth` DATE NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ibookdb`.`book_has_author`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ibookdb`.`book_has_author` (
  `book_id` INT NOT NULL,
  `author_id` INT NOT NULL,
  PRIMARY KEY (`book_id`, `author_id`),
  INDEX `fk_book_has_author_author1_idx` (`author_id` ASC),
  INDEX `fk_book_has_author_book_idx` (`book_id` ASC),
  CONSTRAINT `fk_book_has_author_book`
    FOREIGN KEY (`book_id`)
    REFERENCES `ibookdb`.`book` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_book_has_author_author1`
    FOREIGN KEY (`author_id`)
    REFERENCES `ibookdb`.`author` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
