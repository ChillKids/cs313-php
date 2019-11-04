Create TABLE user_profile(
    id SERIAL NOT NULL PRIMARY KEY UNIQUE ,
    password VARCHAR(256),
    name VARCHAR(20)
);

Create TABLE class(
    id SERIAL NOT NULL PRIMARY KEY UNIQUE,
    name VARCHAR(20)
);

Create TABLE module(
    id SERIAL NOT NULL PRIMARY KEY UNIQUE,
    name VARCHAR(20)
);

CREATE TABLE note(
    id SERIAL NOT NULL PRIMARY KEY UNIQUE,
    content VARCHAR(250),
    class_id SERIAL,
    module_id SERIAL,
    user_id  SERIAL,
    FOREIGN KEY (module_id) REFERENCES module(id),
    FOREIGN KEY (class_id) REFERENCES class(id),
    FOREIGN KEY (user_id) REFERENCES user_profile(id)
);

CREATE TABLE user_notebook(
    user_id  SERIAL,
    note_id SERIAL,
    FOREIGN KEY (user_id) REFERENCES user_profile(id),
    FOREIGN KEY (note_id) REFERENCES note(id)
);

CREATE TABLE enrollment(
    user_id  SERIAL,
    class_id SERIAL,
    FOREIGN KEY (user_id) REFERENCES user_profile(id),
    FOREIGN KEY (class_id) REFERENCES class(id)
);

CREATE TABLE class_module(
    class_id  SERIAL,
    module_id SERIAL,
    FOREIGN KEY (class_id) REFERENCES class(id),
    FOREIGN KEY (module_id) REFERENCES module(id)
);

CREATE TABLE module_note(
    module_id  SERIAL,
    note_id SERIAL,
    FOREIGN KEY (module_id) REFERENCES module(id),
    FOREIGN KEY (note_id) REFERENCES note(id)
);


INSERT INTO user_profile (name, password) VALUES ('Jack', '1234');
INSERT INTO class (id, name) VALUES (1, 'CS313');
INSERT INTO module (id, name) VALUES (1, 'Week01');
INSERT INTO note (id, content, class_id, module_id, user_id) VALUES 
(1, 'Intro to web engineering: Dont forget to submit your hw on time', 1, 1, 8);
INSERT INTO user_notebook (user_id, note_id) VALUES (8, 1);
INSERT INTO enrollment (user_id, class_id) VALUES (8, 1);
INSERT INTO class_module (class_id, module_id) VALUES (1, 1);
INSERT INTO module_note (module_id, note_id) VALUES (1, 1);

INSERT INTO class (id, name) VALUES (2, 'CS246');
INSERT INTO module (id, name) VALUES (2, 'Week02');
INSERT INTO note (id, content, class_id, module_id, user_id) VALUES 
(2, 'Review HTML', 1, 2, 1);
INSERT INTO user_notebook (user_id, note_id) VALUES (1, 2);
INSERT INTO enrollment (user_id, class_id) VALUES (1, 2);
INSERT INTO class_module (class_id, module_id) VALUES (1, 2);
INSERT INTO module_note (module_id, note_id) VALUES (1, 2);

INSERT INTO note (id, content, class_id, module_id, user_id) VALUES 
(3, 'The purpose in this class is to learn php and database.', 1, 1, 1);

SELECT * FROM user_profile
DELETE FROM note WHERE id > 3; 

UPDATE note SET content = 'I am the edited note' WHERE id = 34;
SELECT id, class_id, module_id, content FROM note WHERE (user_id ='$user_id' AND id !='$note_id');

DELETE FROM user_profile;
DELETE FROM class;
DELETE FROM module;
DELETE FROM enrollment;
DELETE FROM note;
DELETE FROM class_module;
DELETE FROM module_note;
DELETE FROM user_notebook;
