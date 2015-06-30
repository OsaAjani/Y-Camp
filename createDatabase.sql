#Fichier de création de la base
CREATE DATABASE IF NOT EXISTS y_camp;
use y_camp;

-- Create table of teams
CREATE TABLE IF NOT EXISTS teams
(
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	PRIMARY KEY (id),
	UNIQUE (name)
);

-- Create table of challenges
CREATE TABLE IF NOT EXISTS challenges
(
	id INT NOT NULL AUTO_INCREMENT,
	kind INT NOT NULL, /* 0 = object, 1 = picture */
	title VARCHAR(500) NOT NULL,
	points INT NOT NULL,
	PRIMARY KEY (id),
	UNIQUE (title)
);

-- Create table of users
CREATE TABLE IF NOT EXISTS users
(
	id INT NOT NULL AUTO_INCREMENT,
	team_id INT NOT NULL,
	email VARCHAR(255) NOT NULL,
	password VARCHAR(255) NOT NULL,
	firstname VARCHAR(100) NOT NULL,
	lastname VARCHAR(100) NOT NULL,
	birthdate DATE NOT NULL,
	sexe BOOLEAN NOT NULL, /* 0 = woman, 1 = man */
	promotion VARCHAR(100) NOT NULL,
	school VARCHAR(100) NOT NULL,
	studies VARCHAR(255) NOT NULL,
	city VARCHAR(255) NOT NULL,
	photo VARCHAR(100),
	PRIMARY KEY (id),
	UNIQUE (email),
	INDEX users_team_id (team_id),
	FOREIGN KEY (team_id)
		REFERENCES teams(id)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

-- Create table of validates_challenges
CREATE TABLE IF NOT EXISTS validated_challenges
(
	id INT NOT NULL AUTO_INCREMENT,
	team_id INT NOT NULL,
	challenge_id INT NOT NULL,
	validated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
	document VARCHAR(1000) DEFAULT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (team_id)
		REFERENCES teams(id)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY (challenge_id)
		REFERENCES challenges(id)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

-- Create table of popups
CREATE TABLE IF NOT EXISTS popups
(
	id INT NOT NULL AUTO_INCREMENT,
	message VARCHAR(1000) NOT NULL,
	start_at TIMESTAMP NOT NULL,
	end_at TIMESTAMP NOT NULL,
	PRIMARY KEY (id)
);

-- Create table of displayed_popups
CREATE TABLE IF NOT EXISTS displayed_popups
(
	id INT NOT NULL AUTO_INCREMENT,
	popup_id INT NOT NULL,
	user_id INT NOT NULL,
	PRIMARY KEY (id),
	INDEX displayed_popups_popup_id (popup_id),
	INDEX displayed_popups_user_id (user_id),
	FOREIGN KEY (popup_id)
		REFERENCES popups(id)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY (user_id)
		REFERENCES users(id)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);
