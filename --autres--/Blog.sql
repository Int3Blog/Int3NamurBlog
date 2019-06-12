
DROP TABLE IF EXISTS Commentaires;
DROP TABLE IF EXISTS Articles;
DROP TABLE IF EXISTS Genres;
DROP TABLE IF EXISTS Utilisateurs;

CREATE TABLE Utilisateurs
(
    id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    pseudo NVARCHAR(16) NOT NULL UNIQUE,
    motDePasse NVARCHAR(16) NOT NULL,
    email NVARCHAR(32) NOT NULL,
    imageLien NVARCHAR(128) NOT NULL,
    dateInscription DATETIME NOT NULL,
    dateDerniereConnexion DATETIME NOT NULL,
    nbrMessages INT UNSIGNED NOT NULL,
    niveauAdmin ENUM('admin','moderateur','redacteur','utilisateur','suspendu') NOT NULL
) ENGINE=INNODB; 

CREATE TABLE Genres
(
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	genre NVARCHAR(32) NOT NULL UNIQUE
) ENGINE=INNODB;

CREATE TABLE Articles
(
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	titre NVARCHAR(64) NOT NULL,
	dateHeureCreation DATETIME NOT NULL,
	dateHeureModification DATETIME NOT NULL,
	contenu NVARCHAR(5096) NOT NULL,
	nbreVues INT UNSIGNED NOT NULL,
	idGenre INT UNSIGNED NOT NULL,
	idAuteur INT UNSIGNED NOT NULL,
	imageLien NVARCHAR(64) NOT NULL,
	CONSTRAINT FK_Articles_Utilisateurs FOREIGN KEY (idAuteur) REFERENCES Utilisateurs(id),
	CONSTRAINT FK_Articles_Genres FOREIGN KEY (idGenre) REFERENCES Genres(id)
) ENGINE=INNODB;

CREATE TABLE Commentaires
(
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idArticle INT UNSIGNED NOT NULL,
	dateHeureCreation DATETIME NOT NULL,
	dateHeureModification DATETIME NOT NULL,
	idAuteur INT UNSIGNED NOT NULL,
	message NVARCHAR(256) NOT NULL,
	CONSTRAINT FK_Commentaires_Articles FOREIGN KEY (idArticle) REFERENCES Articles(id),
	CONSTRAINT FK_Commentaires_Utilisateurs FOREIGN KEY (idAuteur) REFERENCES Utilisateurs(id)
) ENGINE=INNODB;

INSERT INTO `Genres` (`genre`) VALUES ('SANS GENRE');
INSERT INTO `Utilisateurs` (`pseudo`,`motDePasse`,`email`,`imageLien`,`dateInscription`,`dateDerniereConnexion`,`nbrMessages`,`niveauAdmin`) 
VALUES ('Anonyme',1234,'Anonyme@blog.be',' ',NOW(),NOW(),1,'utilisateur');
