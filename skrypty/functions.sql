CREATE OR REPLACE FUNCTION project.add_patient(Name VARCHAR ,Surname VARCHAR ,email VARCHAR , Password VARCHAR , pesel project.good_pesel, Age INTEGER , Sex BOOLEAN, Phone_number project.good_Phone_number, Address VARCHAR,  ZIP_code project.good_ZIP_code, Locality VARCHAR) RETURNS VARCHAR 
LANGUAGE plpgsql AS $$
BEGIN
IF EXISTS (SELECT * FROM project.patients WHERE project.patients.email = $3) THEN
    RETURN 'Podany email jest w bazie!!!';
ELSE IF EXISTS(SELECT * FROM project.patients WHERE project.patients.pesel = $5) THEN
    RETURN 'Podany PESEL jest w bazie!!!';
END IF;
END IF;
INSERT INTO project.patients(Name, Surname,Email,Password,PESEL,Age,Sex,Phone_number,Address,ZIP_code,Locality) VALUES($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11);
RETURN 'Poprawnie dodano pacjenta';
END;
$$;


CREATE OR REPLACE FUNCTION project.add_employee(Name VARCHAR ,Surname VARCHAR ,email VARCHAR , Password VARCHAR , Account_number project.good_account_number, Occupation VARCHAR, Phone_number project.good_Phone_number,Address VARCHAR, ZIP_code project.good_ZIP_code, Locality VARCHAR) RETURNS VARCHAR 
LANGUAGE plpgsql AS $$
BEGIN
IF EXISTS (SELECT * FROM project.employees WHERE project.employees.email = $3) THEN
    RETURN 'Podany email jest w bazie!!!';
END IF;
INSERT INTO project.employees(Name, Surname,Email,Password,Account_number,Occupation,Is_Admin,Phone_number,Address,ZIP_code,Locality) VALUES($1,$2,$3,$4,$5,$6,FALSE,$7,$8,$9,$10);
RETURN 'Poprawnie dodano pracownika';
END;
$$;


CREATE OR REPLACE FUNCTION project.add_appointment(lekId VARCHAR , patId VARCHAR, data project.not_weekend, godz TIME, Cause VARCHAR, kwota INTEGER, Is_paid BOOLEAN) RETURNS VARCHAR 
LANGUAGE plpgsql AS $$
BEGIN
IF EXISTS (SELECT DISTINCT project.employees.Employee_id FROM project.employees WHERE project.employees.Employee_id = $1) THEN
    IF  (SELECT o.Employee_id FROM project.attendances o where o.Employee_id = $1 and (o.Day = $3) and (o.Start_time <= $4) and (o.Finish_time >= $4 + '00:30'))
    THEN
        IF EXISTS (SELECT w.Employee_id FROM project.appointments w, project.doctors l WHERE w.Employee_id = l.Employee_id AND w.Appointment_date = $3 AND ($4 <= (w.Appointment_hour + '00:30') AND $4 >= w.Appointment_hour) )
            THEN
                RETURN 'Lekarz ma wtedy inna wizyte!';
        ELSE INSERT INTO project.appointments(Employee_id, Patient_id,Appointment_date,Cause,Appointment_hour,Payment_count,Is_paid) VALUES($1,$2,$3,$5,$4,$6,$7);
        END IF;
    ELSE RETURN 'Lekarz jest wtedy nieobecny! Podaj inna date!!!';
    END IF;
RETURN 'Poprawnie dodano wizyte';
ELSE
    RETURN 'Podany lekarz nie istnieje w bazie!!!';
END IF;
END;
$$;


CREATE OR REPLACE FUNCTION project.add_specialization(nazwa VARCHAR) RETURNS VARCHAR 
LANGUAGE plpgsql AS $$
BEGIN
IF EXISTS (SELECT DISTINCT s.specialization_name FROM project.specializations s WHERE s.specialization_name = $1) THEN
    RETURN 'Podana nazwa specjalizacji istnieje w bazie';
ELSE
    INSERT INTO project.specializations(specialization_name) VALUES ($1);
        RETURN 'Poprawnie dodano specjalizacje';
END IF;

END;
$$;


CREATE OR REPLACE FUNCTION project.add_cabinet(nr INTEGER, Floor INTEGER) RETURNS VARCHAR 
LANGUAGE plpgsql AS $$
BEGIN

IF EXISTS (SELECT DISTINCT g.Cabinet_id FROM project.cabinets g WHERE g.Cabinet_number = $1 AND g.Floor = $2) THEN
    RETURN 'Podany Cabinet istnieje w bazie';

ELSE
    INSERT INTO project.cabinets(Cabinet_number,Floor) VALUES ($1,$2);
        RETURN 'Poprawnie dodano gabinet';
END IF;

END;
$$;


CREATE OR REPLACE FUNCTION project.see_users_appointments(id VARCHAR) RETURNS TABLE(appointment_id VARCHAR,Appointment_date project.not_weekend, Appointment_hour TIME,Cause VARCHAR, Name VARCHAR, Surname VARCHAR,Cabinet_number INTEGER, Floor INTEGER) 
LANGUAGE plpgsql AS $$
BEGIN

RETURN QUERY SELECT w.appointment_id,w.Appointment_date,w.Appointment_hour,w.Cause, pl.Name,pl.Surname, g.Cabinet_number , g.Floor
    FROM project.appointments w,
    (SELECT p.Employee_id,p.Name, p.Surname, l.Cabinet_id FROM project.employees p JOIN project.doctors l ON  p.Employee_id = l.Employee_id) AS pl ,
    (SELECT g.Cabinet_id, g.Cabinet_number, g.Floor FROM project.cabinets g, project.doctors l WHERE l.Cabinet_id = g.Cabinet_id) AS g
    WHERE w.Patient_id = $1 AND w.Employee_id = pl.Employee_id ORDER BY w.Appointment_date, w.Appointment_hour ASC;

END;
$$;


CREATE OR REPLACE FUNCTION project.see_doctors_appointments(id VARCHAR) RETURNS TABLE(appointment_id VARCHAR,Appointment_date project.not_weekend, Appointment_hour TIME,Cause VARCHAR, Name VARCHAR, Surname VARCHAR) 
LANGUAGE plpgsql AS $$
BEGIN

RETURN QUERY SELECT w.appointment_id,w.Appointment_date, w.Appointment_hour, w.Cause, p.Name, p.Surname
    FROM project.appointments w, project.patients p WHERE w.Employee_id = $1 AND p.Patient_id = w.Patient_id;

END;
$$;


CREATE OR REPLACE FUNCTION project.see_all_appointments() 
RETURNS TABLE(appointment_id VARCHAR,Appointment_date project.not_weekend, Appointment_hour TIME,Cause VARCHAR, Name_doc VARCHAR, Surname_doc VARCHAR,Cabinet_number INTEGER, Floor INTEGER , Name_pat VARCHAR, Surname_pat VARCHAR, Phone_number project.good_Phone_number, Address VARCHAR,  ZIP_code project.good_ZIP_code, Locality VARCHAR, Is_paid BOOLEAN, Payment_count INTEGER) 
LANGUAGE plpgsql AS $$
BEGIN

RETURN QUERY SELECT DISTINCT w.appointment_id,w.Appointment_date,w.Appointment_hour,w.Cause, pl.Name,pl.Surname, g.Cabinet_number , g.Floor, pat.Name, pat.Surname, pat.Phone_number, pat.Address, pat.ZIP_code, pat.Locality, w.Is_paid, w.Payment_count
    FROM project.appointments w, project.patients pat ,
    (SELECT p.Employee_id,p.Name, p.Surname, l.Cabinet_id FROM project.employees p JOIN project.doctors l ON  p.Employee_id = l.Employee_id) AS pl ,
    (SELECT g.Cabinet_id, g.Cabinet_number, g.Floor FROM project.cabinets g, project.doctors l WHERE l.Cabinet_id = g.Cabinet_id) AS g
    WHERE w.Employee_id = pl.Employee_id AND pat.Patient_id = w.Patient_id ORDER BY w.Appointment_date, w.Appointment_hour ASC;

END;
$$;


CREATE OR REPLACE FUNCTION project.is_doctor(id VARCHAR) RETURNS BOOLEAN 
LANGUAGE plpgsql AS $$
BEGIN

IF EXISTS(SELECT * FROM project.employees p, project.doctors l WHERE p.Employee_id = $1 AND p.Employee_id = l.Employee_id)
THEN RETURN TRUE;

ELSE RETURN FALSE;

END IF;
END;
$$;

CREATE OR REPLACE FUNCTION project.add_opinion(Name VARCHAR, Surname VARCHAR, userID VARCHAR, Opinion VARCHAR) RETURNS VARCHAR
LANGUAGE plpgsql AS $$
BEGIN
    IF EXISTS (SELECT p.Employee_id FROM project.employees p WHERE p.Name = $1 AND p.Surname = $2) AS Employee THEN
        INSERT INTO project.opinions(Employee_id, Patient_id, Content, Insertion_date) VALUES (Employee.Employee_id, $3, $4,NOW());
        RETURN 'Poprawnie dodano opinie!';
    ELSE
        RETURN 'Podany lekarz nie istnieje!!!';
    END IF;
END;
$$;

CREATE OR REPLACE FUNCTION project.see_all_opinions() RETURNS TABLE(Opinion_id VARCHAR,Name_doc VARCHAR, Surname_doc VARCHAR,Name_pat VARCHAR, Surname_pat VARCHAR, Insertion_date DATE,Content VARCHAR) 
LANGUAGE plpgsql AS $$
BEGIN

RETURN QUERY SELECT o.Opinion_id, doctors.Name as doc_name, doctors.Surname as doc_surname, pat.Name as pat_name, pat.Surname as pat_surname, o.Insertion_date, o.Content
    FROM project.opinions o, project.patients pat,
    (SELECT * FROM project.employees prac WHERE project.is_doctor(prac.Employee_id) = TRUE) AS doctors
    WHERE doctors.Employee_id = o.Employee_id AND pat.Patient_id = o.Patient_id;


END;
$$;


CREATE OR REPLACE FUNCTION project.add_attendance(Day project.not_weekend,Start_time TIME, Finish_time TIME, id VARCHAR) RETURNS VARCHAR 
LANGUAGE plpgsql AS $$

BEGIN
IF ($3 < $2) THEN
    RETURN 'Godzina zakonczenia jest wczesniej niz godzina rozpoczecia!!!';
END IF;

IF ($2 < CAST ('8:00' AS TIME) OR $3 > CAST ('18:00' AS TIME)) THEN
    RETURN 'Pracujemy od 8:00 do 18:00 !!!';
END IF;

IF EXISTS (SELECT obec.Employee_id FROM
    (SELECT o.attendance_id, o.Employee_id, o.Day, o.Start_time, o.Finish_time FROM project.attendances o,project.doctors l, (SELECT DISTINCT * FROM project.doctors l WHERE l.Employee_id = $4) AS Cabinet WHERE Cabinet.Cabinet_id = l.Cabinet_id AND o.Employee_id = Cabinet.Employee_id ) AS obec
    -- WHERE $1 = obec.Day AND (( $2 >= obec.Start_time AND $2 <= obec.Finish_time) OR ( $3 >= obec.Start_time  AND $3 <= obec.Finish_time) OR ($2 <= obec.Start_time AND $3 >= obec.Finish_time)))
    WHERE $1 = obec.Day AND (( $2 BETWEEN obec.Start_time AND obec.Finish_time) OR ( $3 NOT BETWEEN  obec.Start_time  AND obec.Finish_time) OR ($2 <= obec.Start_time AND $3 >= obec.Finish_time)))

THEN
    RETURN 'O tej porze w tym gabinecie przebywa inny lekarz!!!';
ELSE
    INSERT INTO project.attendances(Employee_id,Day,Start_time,Finish_time) VALUES($4,$1,$2,$3);
END IF;
RETURN 'Poprawnie dodano obecnosc';
END;
$$;


CREATE OR REPLACE FUNCTION project.see_all_attendance_in_cabinet(doctor_id VARCHAR) RETURNS TABLE(attendance_id VARCHAR, Employee_id VARCHAR, Day project.not_weekend, Start_time TIME, Finish_time TIME, Name VARCHAR, Surname VARCHAR)
LANGUAGE plpgsql AS $$
BEGIN
RETURN QUERY SELECT o.attendance_id, o.Employee_id, o.Day, o.Start_time, o.Finish_time, p.Name, p.Surname FROM project.attendances o,project.doctors l, project.employees p ,
    (SELECT DISTINCT * FROM project.doctors l WHERE l.Employee_id = $1) AS Cabinet
        WHERE Cabinet.Cabinet_id = l.Cabinet_id AND o.Employee_id = Cabinet.Employee_id AND p.Employee_id = l.Employee_id;

END;
$$;

