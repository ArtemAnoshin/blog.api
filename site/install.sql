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