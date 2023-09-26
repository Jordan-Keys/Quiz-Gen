CREATE DATABASE quizDb;

USE quizDb;

CREATE TABLE questions (
  id INT(11) NOT NULL AUTO_INCREMENT,
  question TEXT NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE answers (
  id INT(11) NOT NULL AUTO_INCREMENT,
  question_id INT(11) NOT NULL,
  answer TEXT NOT NULL,
  is_correct TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE
);

INSERT INTO questions (question) VALUES
('What is the capital of France?'),
('What is the largest planet in our solar system?'),
('Who painted the Mona Lisa?'),
('What is the currency of Japan?'),
('What is the name of the world''s largest desert?'),
('What is the tallest mammal in the world?'),
('What is the name of the scientist who developed the theory of relativity?'),
('What is the highest mountain in the world?'),
('What is the name of the largest ocean on Earth?'),
('What is the name of the second-largest country in the world?');

INSERT INTO answers (question_id, answer, is_correct) VALUES
(1, 'Paris', 1),
(1, 'London', 0),
(1, 'Rome', 0),
(2, 'Mars', 0),
(2, 'Jupiter', 1),
(2, 'Saturn', 0),
(3, 'Leonardo da Vinci', 1),
(3, 'Pablo Picasso', 0),
(3, 'Vincent van Gogh', 0),
(4, 'Yen', 1),
(4, 'Dollar', 0),
(4, 'Euro', 0),
(5, 'Sahara', 1),
(5, 'Arctic', 0),
(5, 'Antarctica', 0),
(6, 'Giraffe', 1),
(6, 'Elephant', 0),
(6, 'Rhino', 0),
(7, 'Albert Einstein', 1),
(7, 'Isaac Newton', 0),
(7, 'Stephen Hawking', 0),
(8, 'Mount Kilimanjaro', 0),
(8, 'Mount Everest', 1),
(8, 'Mount Fuji', 0),
(9, 'Pacific', 1),
(9, 'Atlantic', 0),
(9, 'Indian', 0),
(10, 'Canada', 1),
(10, 'USA', 0),
(10, 'China', 0);
