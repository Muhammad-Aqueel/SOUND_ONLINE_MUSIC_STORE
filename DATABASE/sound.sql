create database SOUND;
Use SOUND;
create Table ADMIN(
Admin_ID INT AUTO_INCREMENT PRIMARY KEY  NOT NULL,
Name VARCHAR(100) NOT NULL,
Email VARCHAR(20) UNIQUE NOT NULL,
Password VARCHAR(100) NOT NULL,
Contact VARCHAR(16) NOT NULL,
Address VARCHAR(255) NOT NULL,
Gender VARCHAR(6),
photo VARCHAR(300)
);
create Table USERS(
User_ID INT AUTO_INCREMENT PRIMARY KEY  NOT NULL,
Name VARCHAR(100) NOT NULL,
Email VARCHAR(320) UNIQUE NOT NULL,
Password VARCHAR(100) NOT NULL,
Contact VARCHAR(16) NOT NULL,
Address VARCHAR(255) NOT NULL,
Gender VARCHAR(6) NOT NULL,
photo VARCHAR(300)
);
create Table ARTIST(
Artist_ID INT AUTO_INCREMENT PRIMARY KEY  NOT NULL,
Name VARCHAR(100) UNIQUE NOT NULL,
photo VARCHAR(300)
);
create Table ALBUM(
Album_ID INT AUTO_INCREMENT PRIMARY KEY  NOT NULL,
Name VARCHAR(100) UNIQUE NOT NULL,
photo VARCHAR(300)
);
create Table videos_Songs(
    VS_ID INT AUTO_INCREMENT PRIMARY KEY  NOT NULL,
    Title VARCHAR(100) NOT NULL,
    Language VARCHAR(50) NOT NULL,
    Year VARCHAR(100),
    Genre VARCHAR(50) NOT NULL,
    Album_ID INT,
    photo VARCHAR(300),
    URLs VARCHAR(2000),
    FOREIGN KEY (Album_ID) REFERENCES ALBUM(Album_ID)
);
create Table Song_Artist(
    VS_ID INT,
    Artist_ID INT,
    FOREIGN KEY (Artist_ID) REFERENCES ARTIST(Artist_ID),
    FOREIGN KEY (VS_ID) REFERENCES videos_Songs(VS_ID)

);
create Table Ratings(
    Ratings_ID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    User_ID INT,
    VS_ID INT,
    Rate TINYINT(1),
    Review VARCHAR(255),
    FOREIGN KEY (User_ID) REFERENCES USERS(User_ID),
    FOREIGN KEY (VS_ID) REFERENCES videos_Songs(VS_ID)
);
-- Admin Password = 1234
INSERT INTO `admin` (`Admin_ID`, `Name`, `Email`, `Password`, `Contact`, `Address`, `Gender`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$hysIaTNslazKNXERYP8LweV1ir.I6tnWxHgIhvujIDBcGJ.3cVbTG', '123456789', 'KHI', 'male');
