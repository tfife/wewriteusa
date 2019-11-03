DROP TABLE profile CASCADE;
DROP TABLE document CASCADE;
DROP TABLE comment CASCADE;
DROP TABLE faveDoc CASCADE;
DROP TABLE friends CASCADE;

CREATE TABLE profile
(
    user_id SERIAL PRIMARY KEY,
    username VARCHAR(80) NOT NULL UNIQUE,
    password VARCHAR(80) NOT NULL,
    display_name VARCHAR(80) NOT NULL
);

CREATE TABLE document
(
    doc_id SERIAL NOT NULL PRIMARY KEY,
    doc_title VARCHAR(50) NOT NULL,
    doc_sum VARCHAR(200),
    doc_text TEXT NOT NULL,
    user_id INT NOT NULL REFERENCES profile(user_id) ON DELETE CASCADE
);

CREATE TABLE comment
(
    comment_id SERIAL NOT NULL PRIMARY KEY,
    unread boolean DEFAULT true,
    comment_text TEXT NOT NULL,
    user_id INT NOT NULL REFERENCES profile(user_id) ON DELETE CASCADE,
    doc_id INT NOT NULL REFERENCES document(doc_id) ON DELETE CASCADE
);


CREATE TABLE faveDoc
(
    user_id INT NOT NULL REFERENCES profile(user_id) ON DELETE CASCADE,
    doc_id INT NOT NULL REFERENCES document(doc_id) ON DELETE CASCADE
);

CREATE TABLE friends
(
    f_one INT NOT NULL REFERENCES profile(user_id) ON DELETE CASCADE,
    f_two INT NOT NULL REFERENCES profile(user_id) ON DELETE CASCADE
);
