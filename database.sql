CREATE TABLE users (
  idUsers int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  emailUsers TINYTEXT NOT NULL,
  fnameUsers TINYTEXT NOT NULL,
  lnameUsers TINYTEXT NOT NULL,
  bdayUsers Date NOT NULL, 
  pwdUsers LONGTEXT NOT NULL,
  nlogUsers int DEFAULT 1,
  logdate Date,
  sq1Users TINYTEXT NOT NULL,
  sq2Users TINYTEXT NOT NULL,
  sqa1Users LONGTEXT NOT NULL,
  sqa2Users LONGTEXT NOT NULL,
  forgot_pass_identity LONGTEXT,
  active int (1) NOT NULL DEFAULT 0,
  hashUsers LONGTEXT  
);

CREATE TABLE Map (
  mapID int(8) AUTO_INCREMENT NOT NULL,
  mapName TINYTEXT NOT NULL,
  mapAdmin int(8) NOT NULL,
  PRIMARY KEY (mapID)
);
