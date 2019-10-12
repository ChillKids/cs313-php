Create TABLE user_profile(
    id int NOT NULL UNIQUE,
    canvas_id VARCHAR(100),
    name VARCHAR(20),
    note_id int,
    class_id int,
    PRIMARY KEY(canvas_id)
);

Create TABLE class(
    id int NOT NULL UNIQUE,
    name VARCHAR(20),
    module_id int,
    PRIMARY KEY(id)
);

Create TABLE module(
    id int NOT NULL UNIQUE,
    name VARCHAR(20),
    note_id int,
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

ALTER TABLE user_profile
ADD FOREIGN KEY (note_id) REFERENCES note(id);

ALTER TABLE user_profile
ADD FOREIGN KEY (class_id) REFERENCES class(id);

ALTER TABLE class
ADD FOREIGN KEY (module_id) REFERENCES module(id);

ALTER TABLE module
ADD FOREIGN KEY (note_id) REFERENCES note(id);

ALTER TABLE module
ADD class_id int;

ALTER TABLE module
ADD FOREIGN KEY (class_id) REFERENCES class(id);