SELECT CONCAT(first,' ',last) AS actors 
FROM Actor, MovieActor, Movie
WHERE Actor.id=MovieActor.aid AND MovieActor.mid=Movie.id AND Movie.title="Die Another Day";

-- Find all the actors in the movie "Die Another Day".
-- The name of movie must be "Die Another Day" and the movie-actor relationship must match the movie id.

SELECT COUNT(DISTINCT l.aid) AS Actor_in_Multi_Movies
FROM MovieActor l
INNER JOIN MovieActor r
ON l.aid = r.aid AND l.mid != r.mid;

-- Find the number of actors who acted in multiple movies.
-- In movie-actor relation, there must be multiple movie ids correponding to the same actor id.

SELECT COUNT(DISTINCT l.aid) AS Actor_Director_of_Same_Movie
FROM MovieActor l
INNER JOIN MovieDirector r
ON l.aid = r.did AND l.mid = r.mid; 

-- Find the number of people who is both a director and an actor of a same movie.
-- The movie-actor relation and movie-director relation must have same movie id and person id.


