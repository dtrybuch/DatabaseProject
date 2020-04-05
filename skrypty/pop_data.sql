
INSERT INTO project.employees VALUES('1','Andrzej','Kowalski','Doctor','Doctor@Doctor.pl','Doctor',12345678912345678912345678,FALSE,999999999,'Krakow ul. Jana Pawła 23/46','33-300','Krakow');
INSERT INTO project.employees VALUES('2','Angelika','Nowak','Sekretarka','obsluga@obsluga.pl','obsluga',12345678912345678912345677,FALSE,999999999,'Krakow ul. Jana Pawła 23/46','33-300','Krakow');
INSERT INTO project.employees VALUES('3','admin','admin','admin','admin@admin.pl','admin',12345678912345678912345677,TRUE,999999999,'Krakow ul. Jana Pawła 23/46','33-300','Krakow');

INSERT INTO project.cabinets VALUES('1',001,0);
INSERT INTO project.cabinets VALUES('2',002,0);
INSERT INTO project.cabinets VALUES('3',101,1);
INSERT INTO project.cabinets VALUES('4',102,1);

INSERT INTO project.doctors VALUES('1','2');

INSERT INTO project.specializations VALUES('1','okulista');
INSERT INTO project.specializations VALUES('2','stomatolog');
INSERT INTO project.specializations VALUES('3','pediatra');
INSERT INTO project.specializations VALUES('4','dermatolog');
INSERT INTO project.specializations VALUES('5','psychiatra');

INSERT INTO project.doc_spec VALUES('1','1');
INSERT INTO project.doc_spec VALUES('1','2');
INSERT INTO project.doc_spec VALUES('1','3');
INSERT INTO project.doc_spec VALUES('1','4');
INSERT INTO project.doc_spec VALUES('1','5');

INSERT INTO project.attendances VALUES('1','1','01-01-2020','10:30','18:00');
INSERT INTO project.attendances VALUES('2','1','02-01-2020','10:30','18:00');
INSERT INTO project.attendances VALUES('3','1','03-01-2020','10:30','18:00');
INSERT INTO project.attendances VALUES('4','1','06-01-2020','10:30','18:00');
INSERT INTO project.attendances VALUES('5','1','07-01-2020','10:30','18:00');
INSERT INTO project.attendances VALUES('6','1','08-01-2020','10:30','18:00');
INSERT INTO project.attendances VALUES('7','1','09-01-2020','10:30','18:00');
INSERT INTO project.attendances VALUES('8','1','10-01-2020','10:30','18:00');
INSERT INTO project.attendances VALUES('9','1','13-01-2020','10:30','18:00');
INSERT INTO project.attendances VALUES('10','1','14-01-2020','10:30','18:00');
INSERT INTO project.attendances VALUES('11','1','15-01-2020','10:30','18:00');
INSERT INTO project.attendances VALUES('12','1','16-01-2020','10:30','18:00');
INSERT INTO project.attendances VALUES('13','1','17-01-2020','10:30','18:00');
INSERT INTO project.attendances VALUES('14','1','20-01-2020','10:30','18:00');
INSERT INTO project.attendances VALUES('15','1','21-01-2020','10:30','18:00');


INSERT INTO project.wages VALUES('1','1','10-03-2019',4000);
INSERT INTO project.wages VALUES('2','1','25-03-2019',4000);
INSERT INTO project.wages VALUES('3','1','30-03-2019',4000);
INSERT INTO project.wages VALUES('4','1','18-04-2019',4000);
INSERT INTO project.wages VALUES('5','2','18-04-2019',4000);
INSERT INTO project.wages VALUES('6','2','01-01-2020',4000);

INSERT INTO project.patients VALUES('1','Jozef','Adamiak','pacjent@pacjent.pl','pacjent','12345678912',21,FALSE,999999999,'Krakow ul. Jana Pawła 23/46','33-300','Krakow');
INSERT INTO project.patients VALUES('2','Jozef','Szczesny','jozef.szczesny@gmail.com','Password1','12345678913',35,FALSE,999999999,'Krakow ul. Jana Pawła 23/46','33-300','Krakow');
INSERT INTO project.patients VALUES('3','Dominik','Trybuch','dominik.trybuch@gmail.com','Password1','12345678914',68,FALSE,999999999,'Krakow ul. Jana Pawła 23/46','33-300','Krakow');
INSERT INTO project.patients VALUES('4','Szczepan','Wojtkowski','szczepan.ok@gmail.com','Password1','12345678915',45,FALSE,999999999,'Krakow ul. Jana Pawła 23/46','33-300','Krakow');
INSERT INTO project.patients VALUES('5','Damian','Grzegorczyk','damian.gerg@gmail.com','Password1','12345678916',54,FALSE,999999999,'Krakow ul. Jana Pawła 23/46','33-300','Krakow');
INSERT INTO project.patients VALUES('6','Krzysztof','Grzes','krzysztof@gmail.com','Password1','12345678916',54,FALSE,999999999,'Krakow ul. Jana Pawła 23/46','33-300','Krakow');
INSERT INTO project.patients VALUES('7','Adam','Grzegorzek','adam@gmail.com','Password1','12345678916',54,FALSE,999999999,'Krakow ul. Jana Pawła 23/46','33-300','Krakow');

INSERT INTO project.opinions VALUES('1','1','1','Dobry czloAge','2020-01-01');
INSERT INTO project.opinions VALUES('2','1','5','Ok','2020-01-10');
INSERT INTO project.opinions VALUES('3','1','6','Nie polecam','2020-01-25');
INSERT INTO project.opinions VALUES('4','1','4','Nie polecam','2020-01-22');
INSERT INTO project.opinions VALUES('5','1','3','Nie polecam','2020-01-23');
INSERT INTO project.opinions VALUES('6','1','7','Nie polecam','2020-01-23');
INSERT INTO project.opinions VALUES('7','1','2','Nie polecam','2020-01-23');

INSERT INTO project.appointments VALUES('1','1','2','2020-02-10','Zabieg','10:30',true,6000);
INSERT INTO project.appointments VALUES('2','1','5','2020-02-25','Zabieg','10:30',true,6000);
INSERT INTO project.appointments VALUES('3','1','3','2020-02-12','Zabieg','10:30',true,6000);
INSERT INTO project.appointments VALUES('4','1','1','2020-01-27','Zabieg','11:00',true,6000);
INSERT INTO project.appointments VALUES('5','1','4','2020-01-27','Zabieg','12:00',true,6000);
INSERT INTO project.appointments VALUES('6','1','5','2020-01-27','Zabieg','13:00',true,6000);
INSERT INTO project.appointments VALUES('7','1','3','2020-01-27','Zabieg','14:00',true,6000);
INSERT INTO project.appointments VALUES('8','1','7','2020-01-15','Zabieg','10:30',true,6000);
INSERT INTO project.appointments VALUES('9','1','6','2020-01-15','Zabieg','12:00',true,6000);
INSERT INTO project.appointments VALUES('10','1','3','2020-01-15','Zabieg','13:00',true,6000);
INSERT INTO project.appointments VALUES('11','1','2','2020-01-15','Zabieg','14:30',true,6000);
INSERT INTO project.appointments VALUES('12','1','5','2020-01-16','Zabieg','10:30',true,6000);
INSERT INTO project.appointments VALUES('14','1','4','2020-01-16','Zabieg','12:00',true,6000);
INSERT INTO project.appointments VALUES('15','1','6','2020-01-16','Zabieg','13:00',true,6000);
INSERT INTO project.appointments VALUES('16','1','2','2020-01-16','Zabieg','14:30',true,6000);
INSERT INTO project.appointments VALUES('17','1','3','2020-01-17','Zabieg','13:00',true,6000);
INSERT INTO project.appointments VALUES('18','1','5','2020-01-17','Zabieg','14:30',true,6000);
INSERT INTO project.appointments VALUES('19','1','4','2020-01-17','Zabieg','10:30',true,6000);
INSERT INTO project.appointments VALUES('20','1','1','2020-01-17','Zabieg','12:30',true,6000);

