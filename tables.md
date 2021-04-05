Schema of the project -> https://drive.google.com/file/d/1fNM8E-KdrGRa7raDDep0PNkrhECByMZE/view?usp=sharing

# Following are the create table commands for the project-

1. create table login(login_username varchar(20) primary key,password varchar(20) NOT NULL)
2. create table customer(Cust_ID int(4) primary key AUTO_INCREMENT,Cust_name varchar(25),gender enum('Male',Female'),email varchar(40) UNIQUE,phone_number varchar(12),login_username varchar(20),foreign key(login_username) references login(login_username));
3. create table airline_Coordinator(Emp_ID int(4) primary key Auto_increment,Emp_name varchar(20),salary double(7,2),gender varchar(7),phone_no varchar(13),email varchar(40) UNIQUE,Date_of_join date,Role varchar(20),check(Gender in('Male','Female')));
   alter table airline_Coordinator add login_username varchar(20) references login(login_username);
4. create table airline_Coordinator(Emp_ID int(4) primary key Auto_increment,Emp_name varchar(20),salary double(7,2),gender varchar(7),phone_no varchar(13),email varchar(40) UNIQUE,Date_of_join date,Role varchar(20),check(Gender in('Male','Female')));
 alter table airline_Coordinator add login_username varchar(20) references login(login_username);
![image](https://user-images.githubusercontent.com/59526292/113536707-5543d600-95f4-11eb-8f7e-50bda577efc4.png)


