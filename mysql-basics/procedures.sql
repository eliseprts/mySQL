-- Display all data
SELECT students.idStudent, students.nom, students.prenom, students.datenaissance, students.genre, school.idschool, school.school
FROM students
LEFT JOIN school
ON students.school = school.idschool;

-- Display prenom
SELECT prenom FROM students;

-- Display prenom, datenaissance, school
SELECT students.prenom, students.datenaissance, school.idschool, school.school
FROM students
LEFT JOIN school
ON students.school = school.idschool;

-- Display F students
SELECT * FROM students WHERE genre = 'F';

-- Display students from Andy school
SELECT students.idStudent, students.nom, students.prenom, students.datenaissance, students.genre, school.idschool, school.school
FROM students
LEFT JOIN school
ON students.school = school.idschool
WHERE school.school = 'Andy';

-- Display prenom order by reverse alphabetical order
SELECT prenom
FROM students
ORDER BY prenom DESC;

-- Display prenom order by reverse alphabetical order : first two results
SELECT prenom
FROM students
ORDER BY prenom DESC
LIMIT 0,2;

-- Insert student
INSERT INTO students
    (nom, prenom, datenaissance, genre, school)
VALUES
    ('Dallor', 'Ginette', '1990-01-01', 'F', 1);

-- Update student
UPDATE students
SET prenom = 'Omer', genre = 'M'
WHERE nom = 'Dallor';

-- Delet student using id
DELETE FROM students
WHERE idStudent = 3;

-- Set name of school instead of school id
ALTER TABLE students
MODIFY school VARCHAR(45);

UPDATE students
SET school = 'Bruxelles'
WHERE school = '1';

UPDATE students
SET school = 'Charleroi'
WHERE school = '2';