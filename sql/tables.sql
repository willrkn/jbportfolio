USE cms;

DROP TABLE IF EXISTS articles;
CREATE TABLE articles(
	id				smallint NOT NULL auto_increment,
    publicationDate	date NOT NULL,
    title			varchar(255) NOT NULL,
    summary			text NOT NULL,
    content			mediumtext NOT NULL,
    
    PRIMARY KEY		(id)
);


