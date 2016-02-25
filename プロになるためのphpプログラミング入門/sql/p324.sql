create table feelings(
	id int unsigned not null auto_increment,
	name varchar(50) not null,
	primary key(id)
);

create table artists(
	id int unsigned not null auto_increment,
	name varchar(90) not null,
	primary key(id)
);

create table tunes(
	id int unsigned not null auto_increment,
	name varchar(90) not null,
	artist_id int unsigned not null,
	feeling_id int unsigned not null,
	comcont text,
	modified datetime,
	primary key(id)
);
