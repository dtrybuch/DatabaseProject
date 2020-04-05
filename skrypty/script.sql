
CREATE SEQUENCE project.patients_id_n_seq START 10 ;
CREATE TABLE project.patients (
                Patient_id VARCHAR NOT NULL DEFAULT nextval('project.patients_id_n_seq'),
                Name VARCHAR NOT NULL,
                Surname VARCHAR NOT NULL,
                Email VARCHAR NOT NULL,
                Password VARCHAR NOT NULL,
                PESEL project.good_pesel NOT NULL,
                Age INTEGER NOT NULL,
                Sex BOOLEAN NOT NULL,
                Phone_number project.good_Phone_number NOT NULL,
                Address VARCHAR NOT NULL,
                ZIP_code project.good_ZIP_code NOT NULL,
                Locality VARCHAR NOT NULL,
                CONSTRAINT Patient_id PRIMARY KEY (Patient_id)
);
ALTER SEQUENCE project.patients_id_n_seq OWNED BY project.patients.Patient_id;

CREATE SEQUENCE project.documentation_id_n_seq START 10 ;
CREATE TABLE project.patients_documentation (
                documentation_ID VARCHAR NOT NULL DEFAULT nextval('project.documentation_id_n_seq'),
                Patient_id VARCHAR NOT NULL,
                Insertion_date TIMESTAMP NOT NULL,
                Content VARCHAR NOT NULL,
                CONSTRAINT documentation_id PRIMARY KEY (documentation_ID)
);

ALTER SEQUENCE project.documentation_id_n_seq OWNED BY project.patients_documentation.documentation_ID;

CREATE SEQUENCE project.cabinets_id_n_seq START 10 ;
CREATE TABLE project.cabinets (
                Cabinet_ID VARCHAR NOT NULL DEFAULT nextval('project.cabinets_id_n_seq'),
                Cabinet_number INTEGER NOT NULL,
                Floor INTEGER NOT NULL,
                CONSTRAINT Cabinet_id PRIMARY KEY (Cabinet_ID)
);
ALTER SEQUENCE project.cabinets_id_n_seq OWNED BY project.cabinets.Cabinet_ID;

CREATE SEQUENCE project.specializations_id_n_seq START 10 ;
CREATE TABLE project.specializations (
                Specialization_ID VARCHAR NOT NULL DEFAULT nextval('project.specializations_id_n_seq'),
                Specialization_name VARCHAR NOT NULL,
                CONSTRAINT Specialization_id PRIMARY KEY (Specialization_ID)
);
ALTER SEQUENCE project.specializations_id_n_seq OWNED BY project.specializations.Specialization_ID;

CREATE SEQUENCE project.employees_n_id_seq START 10 ;
CREATE TABLE project.employees (
                Employee_ID VARCHAR NOT NULL DEFAULT nextval('project.employees_n_id_seq'),
                Name VARCHAR NOT NULL,
                Surname VARCHAR NOT NULL,
                Occupation VARCHAR NOT NULL,
                Email VARCHAR NOT NULL,
                Password VARCHAR NOT NULL,
                Account_number project.good_account_number NOT NULL,
                Is_Admin BOOLEAN NOT NULL,
                Phone_number project.good_Phone_number NOT NULL,
                Address VARCHAR NOT NULL,
                ZIP_code project.good_ZIP_code NOT NULL,
                Locality VARCHAR NOT NULL,
                CONSTRAINT Employee_id PRIMARY KEY (Employee_ID)
);
ALTER SEQUENCE project.employees_n_id_seq OWNED BY project.employees.Employee_ID;

CREATE SEQUENCE project.attendances_id_n_seq START 10 ;
CREATE TABLE project.attendances (
                attendance_ID VARCHAR NOT NULL DEFAULT nextval('project.attendances_id_n_seq'),
                Employee_ID VARCHAR NOT NULL,
                Day project.not_weekend NOT NULL,
                Start_time TIME NOT NULL,
                Finish_time TIME NOT NULL,
                CONSTRAINT attendance_id PRIMARY KEY (attendance_ID)
);
ALTER SEQUENCE project.attendances_id_n_seq OWNED BY project.attendances.attendance_ID;

CREATE SEQUENCE project.wages_id_n_seq START 10 ;
CREATE TABLE project.wages (
                Wage_ID VARCHAR NOT NULL DEFAULT nextval('project.wages_id_n_seq'),
                Employee_ID VARCHAR NOT NULL,
                Wages_date VARCHAR NOT NULL,
                Wages_count INTEGER NOT NULL,
                CONSTRAINT Wage_id PRIMARY KEY (Wage_ID)
);
ALTER SEQUENCE project.wages_id_n_seq OWNED BY project.wages.Wage_ID;

CREATE TABLE project.doctors (
                Employee_ID VARCHAR NOT NULL,
                Cabinet_ID VARCHAR NOT NULL,
                CONSTRAINT doctor_id PRIMARY KEY (Employee_ID)
);

CREATE SEQUENCE project.opinions_id_n_seq START 10 ;
CREATE TABLE project.opinions (
                Opinion_ID VARCHAR NOT NULL DEFAULT nextval('project.opinions_id_n_seq'),
                Employee_ID VARCHAR NOT NULL,
                Patient_id VARCHAR NOT NULL,
                Content VARCHAR NOT NULL,
                Insertion_date DATE NOT NULL,
                CONSTRAINT Opinion_id PRIMARY KEY (Opinion_ID)
);
ALTER SEQUENCE project.opinions_id_n_seq OWNED BY projectopinions.Opinion_ID;

CREATE SEQUENCE project.appointment_id_n_seq START 10 ;
CREATE TABLE project.appointments (
                appointment_ID VARCHAR NOT NULL DEFAULT nextval('project.appointment_id_n_seq'),
                Employee_ID VARCHAR NOT NULL,
                Patient_id VARCHAR NOT NULL,
                Appointment_date project.not_weekend NOT NULL,
                Cause VARCHAR NOT NULL,
                Appointment_hour TIME NOT NULL,
                Is_paid BOOLEAN NOT NULL,
                Payment_count INTEGER NOT NULL,
                CONSTRAINT appointment_id PRIMARY KEY (appointment_ID)
);

ALTER SEQUENCE project.appointment_id_n_seq OWNED BY project.appointments.appointment_ID;

CREATE TABLE project.doc_spec (
                Employee_ID VARCHAR NOT NULL,
                Specialization_ID VARCHAR NOT NULL,
                CONSTRAINT prac_spec_id PRIMARY KEY (Specialization_ID, Employee_ID)
);
CREATE SEQUENCE project.logs_id_n_seq ;
CREATE TABLE project.logs (
                Log_ID VARCHAR NOT NULL DEFAULT nextval('project.logs_id_n_seq'),
                Content VARCHAR NOT NULL,
                Insertion_date TIMESTAMP NOT NULL
);
ALTER SEQUENCE project.logs_id_n_seq OWNED BY project.logs.Log_ID;


ALTER TABLE project.appointments ADD CONSTRAINT patients_appointments_fk
FOREIGN KEY (Patient_id)
REFERENCES project.patients (Patient_id)
ON DELETE CASCADE
ON UPDATE CASCADE
NOT DEFERRABLE;

ALTER TABLE project.opinions ADD CONSTRAINT patients_opinions_fk
FOREIGN KEY (Patient_id)
REFERENCES patients (Patient_id)
ON DELETE CASCADE
ON UPDATE CASCADE
NOT DEFERRABLE;

ALTER TABLE project.patients_documentation ADD CONSTRAINT patients_documentation_fk
FOREIGN KEY (Patient_id)
REFERENCES project.patients (Patient_id)
ON DELETE CASCADE
ON UPDATE CASCADE
NOT DEFERRABLE;

ALTER TABLE project.doctors ADD CONSTRAINT cabinets_doctors_fk
FOREIGN KEY (Cabinet_ID)
REFERENCES project.cabinets (Cabinet_ID)
ON DELETE CASCADE
ON UPDATE CASCADE
NOT DEFERRABLE;

ALTER TABLE project.doc_spec ADD CONSTRAINT specializations_doc_spec_fk
FOREIGN KEY (Specialization_ID)
REFERENCES project.specializations (Specialization_ID)
ON DELETE CASCADE
ON UPDATE CASCADE
NOT DEFERRABLE;

ALTER TABLE project.doctors ADD CONSTRAINT employees_doctors_fk
FOREIGN KEY (Employee_ID)
REFERENCES project.employees (Employee_ID)
ON DELETE CASCADE
ON UPDATE CASCADE
NOT DEFERRABLE;

ALTER TABLE project.wages ADD CONSTRAINT employees_wages_fk
FOREIGN KEY (Employee_ID)
REFERENCES project.employees (Employee_ID)
ON DELETE CASCADE
ON UPDATE CASCADE
NOT DEFERRABLE;

ALTER TABLE project.attendances ADD CONSTRAINT employees_attendances_fk
FOREIGN KEY (Employee_ID)
REFERENCES project.employees (Employee_ID)
ON DELETE CASCADE
ON UPDATE CASCADE
NOT DEFERRABLE;

ALTER TABLE project.doc_spec ADD CONSTRAINT doctors_doc_spec_fk
FOREIGN KEY (Employee_ID)
REFERENCES project.doctors (Employee_ID)
ON DELETE CASCADE
ON UPDATE CASCADE
NOT DEFERRABLE;

ALTER TABLE project.appointments ADD CONSTRAINT doctors_appointments_fk
FOREIGN KEY (Employee_ID)
REFERENCES project.doctors (Employee_ID)
ON DELETE CASCADE
ON UPDATE CASCADE
NOT DEFERRABLE;

ALTER TABLE project.opinions ADD CONSTRAINT doctors_opinions_fk
FOREIGN KEY (Employee_ID)
REFERENCES project.doctors (Employee_ID)
ON DELETE CASCADE
ON UPDATE CASCADE
NOT DEFERRABLE;