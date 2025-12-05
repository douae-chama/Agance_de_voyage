create Database Agence;
use Agence ;
CREATE TABLE Clients (
    IdClient INT PRIMARY KEY AUTO_INCREMENT,
    Nom VARCHAR(50),
    Prenom VARCHAR(30),
    Adresse VARCHAR(100),
    telephone VARCHAR(15),
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_utilisateur INT, 
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateur(id) ON DELETE CASCADE
);
CREATE TABLE administrateur (
    IdAdmin INT PRIMARY KEY AUTO_INCREMENT,
    Nom VARCHAR(50),
    Prenom VARCHAR(30),
    Adresse VARCHAR(100),
    telephone VARCHAR(15),
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Utilisateur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) UNIQUE,
    password VARCHAR(100),
    type_user ENUM('admin', 'client') NOT NULL
);
CREATE TABLE Hotels (
    IdHotel INT PRIMARY KEY AUTO_INCREMENT,
    Nom VARCHAR(100),
    Adresse VARCHAR(255),
    Description TEXT,
    PrixParNuit DECIMAL(10,2),
    image VARCHAR(255)
);
CREATE TABLE Voyages (
    IdVoyage INT PRIMARY KEY AUTO_INCREMENT,
    Titre VARCHAR(100),
    Description TEXT,
    Prix DECIMAL(10,2),
    DateDepart DATE,
    DateRetour DATE,
    Destination VARCHAR(100),
    image VARCHAR(255)
    
);
CREATE TABLE Circuits (
    IdCircuit INT PRIMARY KEY AUTO_INCREMENT,
    Titre VARCHAR(100),
    Description TEXT,
    Prix DECIMAL(10,2),
    Duree INT,  
    DateDepart DATE,
    image VARCHAR(255)
);
CREATE TABLE Vols (
    IdVol INT PRIMARY KEY AUTO_INCREMENT,
	Destination VARCHAR(100),
    Compagnie VARCHAR(100),
    NumVol VARCHAR(20),
    DateDepart DATE,
    HeureDepart TIME,
    DateArrivee DATE,
    HeureArrivee TIME,
    PrixEconomique DECIMAL(10,2),
    PrixBusiness DECIMAL(10,2),
    PrixPremiere DECIMAL(10,2),
    image VARCHAR(255)
);


CREATE TABLE Bateaux (
    IdBateau INT PRIMARY KEY AUTO_INCREMENT,
	Destination VARCHAR(100),
    Compagnie VARCHAR(100),           
    NumBateau VARCHAR(20),       
    DateDepart DATE,
	HeureDepart TIME,   
    DateArrivee DATE,              
    HeureArrivee TIME,             
    PrixCabineInterieure DECIMAL(10,2),  
    PrixCabineExterieure DECIMAL(10,2),  
    PrixCabineBalcon DECIMAL(10,2),      
    PrixSuiteLuxe DECIMAL(10,2),    
    image VARCHAR(255)
    
);

CREATE TABLE Contact (
    IdContact INT PRIMARY KEY AUTO_INCREMENT,
    IdClient int,
    NOM VARCHAR(100),           
    Email VARCHAR(100),       
	Sujet varchar(100),
    Message text,
    DateContact TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (IdClient) REFERENCES Clients(IdClient)
);
CREATE TABLE Reservations (
    IdReservation INT AUTO_INCREMENT PRIMARY KEY,
    IdClient INT,
    IdVoyage INT,
    IdHotel INT,
    IdCircuit INT, 
    IdVol INT,
    IdBateau INT,
    Nom VARCHAR(50),
    Prenom VARCHAR(30),
    telephone VARCHAR(15),
    Adresse VARCHAR(100),
    email VARCHAR(100),
    DateReservation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    NombrePersonnes INT,
    prixtotal int,
    Statut VARCHAR(20) DEFAULT 'En attente', 
    FOREIGN KEY (IdClient) REFERENCES Clients(IdClient),
    FOREIGN KEY (IdVoyage) REFERENCES Voyages(IdVoyage),
    FOREIGN KEY (IdHotel) REFERENCES Hotels(IdHotel),
    FOREIGN KEY (IdCircuit) REFERENCES Circuits(IdCircuit),
    FOREIGN KEY (IdVol) REFERENCES Vols(IdVol),
    FOREIGN KEY (IdBateau) REFERENCES Bateaux(IdBateau)
);