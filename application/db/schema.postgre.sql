-- MusicClub Database Schema
-- PostgreSQL

-- Drops
DROP TABLE IF EXISTS songs;
DROP TABLE IF EXISTS albums;
DROP TABLE IF EXISTS artists;
DROP TABLE IF EXISTS art;
DROP TABLE IF EXISTS files;

-- Files table
CREATE TABLE files (
	_id serial primary key,
	type varchar(64) not null,
	path varchar(65536) not null unique
);
CREATE INDEX idx_files_type ON files (type);

-- Art table
CREATE TABLE art (
	_id serial primary key,
	type varchar(255) not null,
	uri varchar(65536) not null unique
);
CREATE INDEX idx_art_type on art (type);

-- Artists table
CREATE TABLE artists (
	_id serial primary key,
	name varchar(255) not null unique,
	art_group integer references art (_id) default null,
	desc_genre varchar(255) default null,
	desc_bio text default null,
	desc_active_year_start int default null,
	desc_active_year_end int default null,
	enabled boolean not null default true
);

-- Albums table
CREATE TABLE albums (
	_id serial primary key,
	name varchar(255) not null unique,
	art_primary integer references art (_id) default null,
	art_secondary integer references art (_id) default null,
	desc_genre varchar(255) default null,
	enabled boolean not null default true
);

-- Songs table
CREATE TABLE songs (
	_id serial primary key,
	artist_id integer not null references artists (_id),
	album_id integer not null references albums (_id),
	title varchar(255) not null,
	desc_genre varchar(255) default null,
	desc_lyrics text default null,
	desc_release_year integer default null,
	enabled boolean not null default true
);
