CREATE TABLE promo_code
(
    id INT NOT NULL AUTO_INCREMENT,
    code VARCHAR(10) NOT NULL UNIQUE,
    issue_date DATE,
    CONSTRAINT promo_code_pk
        PRIMARY KEY (id)
);
