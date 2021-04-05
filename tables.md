Schema of the project -> https://drive.google.com/file/d/1fNM8E-KdrGRa7raDDep0PNkrhECByMZE/view?usp=sharing

# Following are the create table commands for the project-

1. create table login(login_username varchar(20) primary key,password varchar(20) NOT NULL)
2. create table customer(Cust_ID int(4) primary key AUTO_INCREMENT,Cust_name varchar(25),gender enum('Male',Female'),email varchar(40) UNIQUE,phone_number varchar(12),login_username varchar(20),foreign key(login_username) references login(login_username));
3. create table airline_Coordinator(Emp_ID int(4) primary key Auto_increment,Emp_name varchar(20),salary double(7,2),gender varchar(7),phone_no varchar(13),email varchar(40) UNIQUE,Date_of_join date,Role varchar(20),check(Gender in('Male','Female')));
   alter table airline_Coordinator add login_username varchar(20) references login(login_username);
![image](https://user-images.githubusercontent.com/59526292/113536707-5543d600-95f4-11eb-8f7e-50bda577efc4.png)
4.create table customer_Care_Agent(Emp_ID int(4) primary key Auto_increment,Emp_name varchar(20),salary double(7,2),gender varchar(7),phone_no varchar(13),email varchar(40) UNIQUE,Date_of_join date,login_username varchar(20) references login(login_username),check(Gender in('Male','Female')));![image](https://user-images.githubusercontent.com/59526292/113536769-7d333980-95f4-11eb-93f2-7f1d958ec660.png)
5. create table airline(FLight_ID int(4) primary key,Flight_Type varchar(20),Airline_name varchar(30),Reference_no varchar(6),economy_Fare double(7,2),buisness_fare double(8,2),vacant_seats int(3) default 100,dept_Time time,dept_date date,departure_Destination varchar(30),arrival_time time,arrival_date date,arrival_destination varchar(30));
![image](https://user-images.githubusercontent.com/59526292/113536871-c3889880-95f4-11eb-8dc7-c2dbf62a9e4e.png)
6. create table ticket(Ticket_no int(6) primary key,Class varchar(20),Booking_Ref varchar(8),Seat_No int(3),payment_Type varchar(15),booking_time time,booking_date date,account_No varchar(10),Bank_name varchar(30),flight_ID int(4) references airline(Flight_ID));
![image](https://user-images.githubusercontent.com/59526292/113536915-de5b0d00-95f4-11eb-9772-79e554eaa6d4.png)

 


 
