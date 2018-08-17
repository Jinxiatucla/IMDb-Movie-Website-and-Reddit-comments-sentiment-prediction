LOAD DATA LOCAL INFILE '~/data/movie.del' INTO TABLE Movie FIELDS TERMINATED BY ',';
LOAD DATA LOCAL INFILE '~/data/actor1.del' INTO TABLE Actor FIELDS TERMINATED BY ',';
LOAD DATA LOCAL INFILE '~/data/actor2.del' INTO TABLE Actor FIELDS TERMINATED BY ',';
LOAD DATA LOCAL INFILE '~/data/actor3.del' INTO TABLE Actor FIELDS TERMINATED BY ',';
LOAD DATA LOCAL INFILE '~/data/director.del' INTO TABLE Director FIELDS TERMINATED BY ',';
LOAD DATA LOCAL INFILE '~/data/moviegenre.del' INTO TABLE MovieGenre FIELDS TERMINATED BY ',';
LOAD DATA LOCAL INFILE '~/data/moviedirector.del' INTO TABLE MovieDirector FIELDS TERMINATED BY ',';
LOAD DATA LOCAL INFILE '~/data/movieactor1.del' INTO TABLE MovieActor FIELDS TERMINATED BY ',';
LOAD DATA LOCAL INFILE '~/data/movieactor2.del' INTO TABLE MovieActor FIELDS TERMINATED BY ',';
INSERT INTO MaxPersonID VALUES (69000);
INSERT INTO MaxMovieID VALUES (4750);
UPDATE Movie SET title=REPLACE(title,'"',''), rating=REPLACE(rating,'"',''), company=REPLACE(company,'"','');
UPDATE Actor SET first=REPLACE(first,'"',''), last=REPLACE(last,'"',''), sex=REPLACE(sex,'"','');
UPDATE Director SET last=REPLACE(last,'"',''), first=REPLACE(first,'"','');
UPDATE MovieGenre SET genre=REPLACE(genre,'"','');
UPDATE MovieActor SET role=REPLACE(role,'"','');
UPDATE Review SET name=REPLACE(name,'"',''), comment=REPLACE(comment,'"','');



