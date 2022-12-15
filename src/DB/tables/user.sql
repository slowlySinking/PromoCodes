CREATE TABLE user
(
    id INT NOT NULL AUTO_INCREMENT,
    login varchar(10) NOT NULL UNIQUE,
    email varchar(20) NOT NULL UNIQUE,
    password varchar(255) NOT NULL,
    promo_code_id INT,
    CONSTRAINT user_pk
        PRIMARY KEY (id),
    CONSTRAINT user_promo_code_fk
        FOREIGN KEY (promo_code_id) REFERENCES promo_code (id)
);
