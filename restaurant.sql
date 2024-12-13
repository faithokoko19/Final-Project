Create database restaurant_reservations;
use restaurant_reservations;
CREATE TABLE Customers (
    customerId INT NOT NULL UNIQUE AUTO_INCREMENT,
    customerName VARCHAR(45) NOT NULL,
    contactInfo VARCHAR(200),
    PRIMARY KEY (customerId)
);

CREATE TABLE Reservations (
    reservationId INT NOT NULL UNIQUE AUTO_INCREMENT,
    customerId INT NOT NULL,
    reservationTime DATETIME NOT NULL,
    numberOfGuests INT NOT NULL,
    specialRequests VARCHAR(200),
    PRIMARY KEY (reservationId),
    FOREIGN KEY (customerId) REFERENCES Customers(customerId)
);

CREATE TABLE DiningPreferences (
    preferenceId INT NOT NULL UNIQUE AUTO_INCREMENT,
    customerId INT NOT NULL,
    favoriteTable VARCHAR(45),
    dietaryRestrictions VARCHAR(200),
    PRIMARY KEY (preferenceId),
    FOREIGN KEY (customerId) REFERENCES Customers(customerId)
);

INSERT INTO Customers (customerName, contactInfo)
VALUES 
('John Denga', 'johndenga@gmail.com'),
('Jane Smith', 'janesmith@outlook.com'),
('Emily Hassan', 'emilyhassan@yahoo.com'),
('Adam Perez', 'adamp@gmail.com'),
('Sarah Lee', 'sarahlee@live.com');

INSERT INTO Reservations (customerId, reservationTime, numberOfGuests, specialRequests)
VALUES 
(1, '2024-12-15 19:00:00', 2, 'Window seat'),
(2, '2024-12-16 18:30:00', 4, 'High chair for baby'),
(3, '2024-12-17 20:00:00', 3, 'Vegetarian menu'),
(4, '2024-12-18 21:00:00', 5, 'None'),
(5, '2024-12-19 19:30:00', 2, 'Celebrating anniversary');

INSERT INTO DiningPreferences (customerId, favoriteTable, dietaryRestrictions)
VALUES 
(1, 'Table 5', 'None'),
(2, 'Table 3', 'Gluten-free'),
(3, 'Table 8', 'Vegan'),
(4, 'Table 10', 'None'),
(5, 'Table 2', 'Dairy-free');

DELIMITER $$

CREATE PROCEDURE findReservations(IN inputCustomerId INT)
BEGIN
    SELECT * FROM Reservations
    WHERE customerId = inputCustomerId;
END$$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE addSpecialRequest(IN reservationId INT, IN requests VARCHAR(200))
BEGIN
    UPDATE Reservations
    SET specialRequests = requests
    WHERE reservationId = reservationId;
END$$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE addReservation(
    IN p_customerId INT, 
    IN p_customerName VARCHAR(45), 
    IN p_contactInfo VARCHAR(200),
    IN p_reservationTime DATETIME, 
    IN p_numberOfGuests INT, 
    IN p_specialRequests VARCHAR(200)
)
BEGIN
    DECLARE existingCustomerId INT;

    
    SELECT customerId INTO existingCustomerId
    FROM Customers
    WHERE customerId = p_customerId
    LIMIT 1;

    
    IF existingCustomerId IS NULL THEN
        INSERT INTO Customers (customerName, contactInfo)
        VALUES (p_customerName, p_contactInfo);

        
        SET existingCustomerId = LAST_INSERT_ID();
    END IF;

    
    INSERT INTO Reservations (customerId, reservationTime, numberOfGuests, specialRequests)
    VALUES (existingCustomerId, p_reservationTime, p_numberOfGuests, p_specialRequests);
    
END$$

DELIMITER ;

