CREATE DOMAIN project.good_pesel AS varchar CONSTRAINT check_pesel CHECK (LENGTH(VALUE) = 11);

CREATE DOMAIN project.good_account_number AS varchar CONSTRAINT check_account_number CHECK (LENGTH(VALUE) = 26);

CREATE DOMAIN project.good_Phone_number AS varchar CONSTRAINT check_Phone_number CHECK (LENGTH(VALUE) = 9);

CREATE DOMAIN project.not_weekend AS date CONSTRAINT not_weekend CHECK (trim(to_char(VALUE,
'day'::VARCHAR)) != 'saturday' AND (trim(to_char(VALUE,'day')) != 'sunday')); 

CREATE DOMAIN project.good_ZIP_code AS VARCHAR CONSTRAINT check_ZIP_code CHECK (VALUE ~ '^\d{2}-\d{3}$'); 