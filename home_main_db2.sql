CREATE DATABASE home_main_db;

CREATE TABLE usertype (
    userTypeId int NOT NULL AUTO_INCREMENT,
    userTypeDescription varchar(255) NOT NULL,
    PRIMARY KEY (userTypeId)
);
ALTER TABLE usertype AUTO_INCREMENT=1;
SELECT * FROM usertype; 
INSERT INTO usertype (userTypeDescription) VALUES ('Property Owner');

CREATE TABLE managerlimitedusers (
    mluId int NOT NULL AUTO_INCREMENT,
    ownerId int not NULL,
    userTypeId int NOT NULL,
    userName varchar(255) NOT NULL UNIQUE,
    passWord varchar(255),
    firstName varchar(255),
    lastName varchar(255),
    email varchar(255),
    logDelete bool default 0,
    PRIMARY KEY (mluId),
    FOREIGN KEY (ownerId) REFERENCES users(userId),
    FOREIGN KEY (userTypeId) REFERENCES usertype(userTypeId)
);
ALTER TABLE users AUTO_INCREMENT=1;

CREATE TABLE users (
    userId int NOT NULL AUTO_INCREMENT,
    userTypeId int NOT NULL,
    userName varchar(255) NOT NULL UNIQUE,
    passWord varchar(255),
    firstName varchar(255),
    lastName varchar(255),
    email varchar(255),
    logDelete bool default 0,
    PRIMARY KEY (userId),
    FOREIGN KEY (userTypeId) REFERENCES usertype(userTypeId)
);
ALTER TABLE users AUTO_INCREMENT=1;

CREATE TABLE properties (
    propertyId int NOT NULL AUTO_INCREMENT,
    ownerid int NOT NULL,
    propertyName varchar(255),
    description varchar(255),
    address varchar(255),
    logDelete BOOLEAN default 0,
    PRIMARY KEY (propertyId),
    FOREIGN KEY (ownerid) REFERENCES users(userId)
);
ALTER TABLE properties AUTO_INCREMENT=1;

CREATE TABLE appliances (
    applianceId int NOT NULL AUTO_INCREMENT,
    applianceName varchar(255),
    logDelete BOOLEAN default 0,
    PRIMARY KEY (applianceId)
);
ALTER TABLE appliances AUTO_INCREMENT=1;

CREATE TABLE propertyappliancebridge (
	propertyApplianceId int NOT NULL AUTO_INCREMENT,
    propertyId int NOT NULL,
    applianceId int NOT NULL,
    PRIMARY KEY (propertyApplianceId),
    FOREIGN KEY (propertyId) REFERENCES properties(propertyId),
    FOREIGN KEY (applianceId) REFERENCES appliances(applianceId)
);
ALTER TABLE propertyappliancebridge AUTO_INCREMENT=1;

CREATE TABLE tasks (
    taskId int NOT NULL AUTO_INCREMENT,
    propertyApplianceId int NOT NULL,
    userId int NOT NULL,
    taskName varchar(255),
    description varchar(255),
    repeatTask BOOLEAN, 
    dueDate DATE,
    complete BOOLEAN default 0,
    intervalDays int,
    ReminderDate DATE,
    reminderInterval int,
    logDelete BOOLEAN default 0,
    PRIMARY KEY (taskId),
    FOREIGN KEY (propertyApplianceId) REFERENCES propertyappliancebridge(propertyApplianceId),
    FOREIGN KEY (userId) REFERENCES users(userId)
);
ALTER TABLE tasks AUTO_INCREMENT=1;

CREATE TABLE groups (
    groupId int NOT NULL AUTO_INCREMENT,
    groupOwnerId int NOT NULL,
    groupMluId int NOT NULL,
    groupName varchar(100),
    logDelete BOOLEAN default 0,
    PRIMARY KEY (groupId),
    FOREIGN KEY (groupMluId) REFERENCES managerlimitedusers(mulId),
    FOREIGN KEY (groupOwnerId) REFERENCES users(userId)
);
ALTER TABLE groups AUTO_INCREMENT=1;

CREATE TABLE usergroupbridge (
    userId int NOT NULL,
    groupId int NOT NULL,
    FOREIGN KEY (userId) REFERENCES users(userId),
    FOREIGN KEY (groupId) REFERENCES groups(groupId)
);

CREATE TABLE propertygroupbridge (
    groupId int NOT NULL,
    propertyId int NOT NULL,    
    FOREIGN KEY (groupId) REFERENCES groups(groupId),
    FOREIGN KEY (propertyId) REFERENCES properties(propertyId)
);

CREATE TABLE images (
    imageId int NOT NULL AUTO_INCREMENT,
    imageFile MEDIUMBLOB NOT NULL,
    alternateText varchar(255),
    logDelete BOOLEAN default 0,
    PRIMARY KEY (imageId)
);
ALTER TABLE images AUTO_INCREMENT=1;

CREATE TABLE imageobjectbridge (
	imageId int NOT NULL,
    objectId int NOT NULL,
    objectType varchar(255) NOT NULL,
    FOREIGN KEY (imageId) REFERENCES images(imageId)
);

CREATE TABLE taskHistory (
    taskId int NOT NULL,
    taskSequence int NOT NULL,
    userID int NOT NULL,
    PRIMARY KEY (taskId, taskSequence),
    FOREIGN KEY (taskId) REFERENCES tasks(taskId),
    FOREIGN KEY (userID) REFERENCES users(userID)
);

