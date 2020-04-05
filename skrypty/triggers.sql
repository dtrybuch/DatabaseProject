-- WYZWALACZE
CREATE OR REPLACE FUNCTION project.add_to_logs() RETURNS TRIGGER 
LANGUAGE plpgsql AS $$
DECLARE
Content VARCHAR;
BEGIN
      Content   := TG_ARGV[0];
      INSERT INTO project.logs(Content, Insertion_date) VALUES (Content, NOW());
      RETURN NEW;
   END;
$$;

CREATE TRIGGER add_appointment_log AFTER INSERT ON project.appointments
FOR EACH ROW EXECUTE PROCEDURE project.add_to_logs('Dodanie wizyty.');

CREATE TRIGGER update_appointment_log AFTER UPDATE ON project.appointments
FOR EACH ROW EXECUTE PROCEDURE project.add_to_logs('Zaktualizowanie wizyty.');

CREATE TRIGGER delete_appointment_log AFTER DELETE ON project.appointments
FOR EACH ROW EXECUTE PROCEDURE project.add_to_logs('Usuniecie wizyty.');


CREATE TRIGGER add_documentation_log AFTER INSERT ON project.patients_documentation
FOR EACH ROW EXECUTE PROCEDURE project.add_to_logs('Dodanie dokumentacji.');

CREATE TRIGGER delete_documentation_log AFTER DELETE ON project.patients_documentation
FOR EACH ROW EXECUTE PROCEDURE project.add_to_logs('Usuniecie dokumentacji.');


CREATE TRIGGER add_cabinet_log AFTER INSERT ON project.cabinets
FOR EACH ROW EXECUTE PROCEDURE project.add_to_logs('Dodanie gabinetu.');

CREATE TRIGGER delete_cabinet_log AFTER DELETE ON project.cabinets
FOR EACH ROW EXECUTE PROCEDURE project.add_to_logs('Usuniecie gabinetu.');


CREATE TRIGGER add_doctor_log AFTER INSERT ON project.doctors
FOR EACH ROW EXECUTE PROCEDURE project.add_to_logs('Dodanie lekarza.');

CREATE TRIGGER delete_doctor_log AFTER DELETE ON project.doctors
FOR EACH ROW EXECUTE PROCEDURE project.add_to_logs('Usuniecie lekarza.');


CREATE TRIGGER add_attendance_log AFTER INSERT ON project.attendances
FOR EACH ROW EXECUTE PROCEDURE project.add_to_logs('Dodanie obecnosci.');

CREATE TRIGGER delete_attendance_log AFTER DELETE ON project.attendances
FOR EACH ROW EXECUTE PROCEDURE project.add_to_logs('Usuniecie obecnosci.');


CREATE TRIGGER add_opinion_log AFTER INSERT ON project.opinions
FOR EACH ROW EXECUTE PROCEDURE project.add_to_logs('Dodanie opinii.');

CREATE TRIGGER delete_opinion_log AFTER DELETE ON project.opinions
FOR EACH ROW EXECUTE PROCEDURE project.add_to_logs('Usuniecie opinii.');


CREATE TRIGGER add_patient_log AFTER INSERT ON project.patients
FOR EACH ROW EXECUTE PROCEDURE project.add_to_logs('Dodanie pacjenta.');

CREATE TRIGGER delete_patient_log AFTER DELETE ON project.patients
FOR EACH ROW EXECUTE PROCEDURE project.add_to_logs('Usuniecie pacjenta.');


CREATE TRIGGER add_employee_log AFTER INSERT ON project.employees
FOR EACH ROW EXECUTE PROCEDURE project.add_to_logs('Dodanie pracownika.');

CREATE TRIGGER delete_employee_log AFTER DELETE ON project.employees
FOR EACH ROW EXECUTE PROCEDURE project.add_to_logs('Usuniecie pracownika.');


CREATE TRIGGER add_specialization_log AFTER INSERT ON project.specializations
FOR EACH ROW EXECUTE PROCEDURE project.add_to_logs('Dodanie specjalizacji.');

CREATE TRIGGER delete_specialization_log AFTER DELETE ON project.specializations
FOR EACH ROW EXECUTE PROCEDURE project.add_to_logs('Usuniecie specjalizacji.');


CREATE TRIGGER add_wage_log AFTER INSERT ON project.wages
FOR EACH ROW EXECUTE PROCEDURE project.add_to_logs('Dodanie wyplaty.');

CREATE TRIGGER delete_wage_log AFTER DELETE ON project.wages
FOR EACH ROW EXECUTE PROCEDURE project.add_to_logs('Usuniecie wyplaty.');