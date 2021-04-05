Schema of the project ->https://drive.google.com/file/d/1fNM8E-KdrGRa7raDDep0PNkrhECByMZE/view?usp=sharing

# Following are the create table commands for the project-

create table login(login_username varchar(20) primary key,password varchar(20) NOT NULL)

create table customer(Cust_ID int(4) primary key AUTO_INCREMENT,Cust_name varchar(25),gender enum('Male',Female'),email varchar(40) UNIQUE,phone_number varchar(12),login_username varchar(20),foreign key(login_username) references login(login_username));
