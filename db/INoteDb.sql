Create TABLE user_profile(
    id int NOT NULL UNIQUE,
    canvas_id VARCHAR(100),
    name VARCHAR(20),
    PRIMARY KEY(id)
);

Create TABLE class(
    id int NOT NULL UNIQUE,
    name VARCHAR(20),
    PRIMARY KEY(id)
);

Create TABLE module(
    id int NOT NULL UNIQUE,
    name VARCHAR(20),
    PRIMARY KEY(id)
);

CREATE TABLE note(
    id int NOT NULL UNIQUE,
    content VARCHAR(250),
    class_id int,
    module_id int,
    user_id  int,
    PRIMARY KEY(id),
    FOREIGN KEY (module_id) REFERENCES module(id),
    FOREIGN KEY (class_id) REFERENCES class(id),
    FOREIGN KEY (user_id) REFERENCES user_profile(id)
);

CREATE TABLE user_notebook(
    user_id  int,
    note_id int,
    FOREIGN KEY (user_id) REFERENCES user_profile(id),
    FOREIGN KEY (note_id) REFERENCES note(id)
);

CREATE TABLE enrollment(
    user_id  int,
    class_id int,
    FOREIGN KEY (user_id) REFERENCES user_profile(id),
    FOREIGN KEY (class_id) REFERENCES class(id)
);

CREATE TABLE class_module(
    class_id  int,
    module_id int,
    FOREIGN KEY (class_id) REFERENCES class(id),
    FOREIGN KEY (module_id) REFERENCES module(id)
);

CREATE TABLE module_note(
    module_id  int,
    note_id int,
    FOREIGN KEY (module_id) REFERENCES module(id),
    FOREIGN KEY (note_id) REFERENCES note(id)
);


INSERT INTO user_profile (id, canvas_id, name) VALUES (1, 'jack1293810923', 'Jack');
INSERT INTO class (id, name) VALUES (1, 'CS313');
INSERT INTO module (id, name) VALUES (1, 'Week01');
INSERT INTO note (id, content, class_id, module_id, user_id) VALUES 
(1, 'Intro to web engineering: Dont forget to submit your hw on time', 1, 1, 1);
INSERT INTO user_notebook (user_id, note_id) VALUES (1, 1);
INSERT INTO enrollment (user_id, class_id) VALUES (1, 1);
INSERT INTO class_module (class_id, module_id) VALUES (1, 1);
INSERT INTO module_note (module_id, note_id) VALUES (1, 1);