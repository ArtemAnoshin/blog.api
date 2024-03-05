CREATE TABLE article
(  
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    author_name VARCHAR(255) NOT NULL,
    body TEXT NOT NULL
);

CREATE TABLE comment
(  
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    article_id int NOT NULL,
    comment_author VARCHAR(255) NOT NULL,
    body TEXT NOT NULL,
    CONSTRAINT FK_ArticleComment FOREIGN KEY (article_id)
    REFERENCES article(id)
);

ALTER TABLE comment
ADD created_at DATETIME NULL;

ALTER TABLE comment
   ADD UNIQUE `comment_author_1_per_second`(`created_at`, `comment_author`)
;

CREATE TABLE user
(  
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(2048) NOT NULL
);

INSERT INTO `user`(`name`,`password`) VALUES('testuser','e10adc3949ba59abbe56e057f20f883e'); # pass 123456