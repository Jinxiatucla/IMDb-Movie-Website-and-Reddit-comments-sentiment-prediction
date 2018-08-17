INSERT INTO Movie
VALUES (NULL, 'moviename', 2018, 'R', 'MYCOMPANY');
-- set primary key to be NULL

-- INSERT INTO Movie
-- VALUES (4900, 'moviename', 2018, 'R', 'MYCOMPANY');
-- set id to be larger than maximum value

INSERT INTO Actor
VALUES (NULL, 'lastname', 'firstname', 'female' , 1999-01-01, 2018-01-01);
-- set primary key to be NULL

-- INSERT INTO Actor
-- VALUES (69999, 'lastname', 'firstname', 'female' , 1999-01-01, 2018-01-01);
-- set id to be larger than maximum value

INSERT INTO Director
VALUES (NULL, 'lastname', 'firstname', 1999-01-01, 2018-01-01);
-- set primary key to be NULL

-- INSERT INTO Actor
-- VALUES (69999, 'lastname', 'firstname', 1999-01-01, 2018-01-01);
-- set id to be larger than maximum value

INSERT INTO MovieGenre
VALUES (0000, 'comedy');
-- set mid to be value which is not in table Movie.

INSERT INTO MovieDirector
VALUES (0000, 11901);
-- set mid to be value which is not in table Movie.

INSERT INTO MovieDirector
VALUES (3895, 0000);
-- set did to be value which is not in table Director.

INSERT INTO MovieActor
VALUES (0000, 2525, 'role');
-- set mid to be value which is not in table Movie.

INSERT INTO MovieActor
VALUES (3895, 0000, 'role');
-- set aid to be value which is not in table Actor.

INSERT INTO Review
VALUES ('name', NULL, 0000, NULL, NULL);
-- set mid to be value which is not in table Movie.










