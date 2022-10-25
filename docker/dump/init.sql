create database symfony;
create user symfony@'%' identified by 'symfony';
grant all on symfony.* to symfony@'%';