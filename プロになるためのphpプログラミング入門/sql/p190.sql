create table burgers(
	id int unsigned not null auto_increment,
	name varchar(80),
	price int,
	primary key(id)
);
insert into burgers(name, price) values('チーズバーガー', 280);
insert into burgers(name, price) values('えびバーガー', 350);
insert into burgers(name, price) values('和風バーガー', 320);
