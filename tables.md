Schema of the project -> https://drive.google.com/file/d/1fNM8E-KdrGRa7raDDep0PNkrhECByMZE/view?usp=sharing

# Following are the create table commands for the project in flight_management database-

1. create table login(login_username varchar(20) primary key,password varchar(20) NOT NULL)
2. create table customer(Cust_ID int(4) primary key AUTO_INCREMENT,Cust_name varchar(25),gender enum('Male',Female'),email varchar(40) UNIQUE,phone_number varchar(12),login_username varchar(20),foreign key(login_username) references login(login_username));
3. create table airline_Coordinator(Emp_ID int(4) primary key Auto_increment,Emp_name varchar(20),salary double(7,2),gender varchar(7),phone_no varchar(13),email varchar(40) UNIQUE,Date_of_join date,Role varchar(20),check(Gender in('Male','Female')));
   alter table airline_Coordinator add login_username varchar(20) references login(login_username);
4. create table customer_Care_Agent(Emp_ID int(4) primary key Auto_increment,Emp_name varchar(20),salary double(7,2),gender varchar(7),phone_no varchar(13),email varchar(40) UNIQUE,Date_of_join date,login_username varchar(20) references login(login_username),check(Gender in('Male','Female')));
6. create table airline(FLight_ID int(4) primary key,Flight_Type varchar(20),Airline_name varchar(30),Reference_no varchar(6),economy_Fare double(7,2),buisness_fare double(8,2),vacant_seats int(3) default 100,dept_Time time,dept_date date,departure_Destination varchar(30),arrival_time time,arrival_date date,arrival_destination varchar(30));
7. create table ticket(Ticket_no int(6) primary key Auto_increment,Class varchar(20),Booking_Ref varchar(8),Seat_No int(3),payment_Type varchar(15),booking_time time,booking_date date,account_No varchar(10),Bank_name varchar(30),flight_ID int(4) references airline(Flight_ID));  
8.  create table enquiry(Enquiry_ID int(8) primary key Auto_increment,Enquiry_type varchar(10),Enquiry_title varchar(40) NOT NULL,Enquiry_Description varchar(200),enquiry_answer varchar(200) Default NULL,Cust_id int(4) references customer(CUST_ID));
9.  create table passenger_info(Aadhar_No int(12) primary key,P_DOB date,P_email varchar(40),P_Name varchar(30),P_gender varchar(7),P_age int(3),p_phone_no varchar(13),state varchar(10),city varchar(10),pincode varchar(10),check(p_gender in('Male','Female')));
 alter table ticket add aadhar_no  int(12) references passenger_info(aadhar_No);
 
10. create table answers(emp_id int(4) references customer_care_agent(Emp_id),enquiry_id int(8) references enquiry(enquiry_id),primary key(emp_id,enquiry_id));

11.  create table manages(emp_id int(4) references airline_Coordinator(Emp_id),flight_id int(4) references Airline(Flight_ID),primary key(Emp_ID,Flight_ID));



 
