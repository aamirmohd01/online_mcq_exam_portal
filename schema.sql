--CREATE DATABASE : 
CREATE DATABASE MCQ;

--USE DATABASE
USE MCQ;

--TO CREATE USERS TABLE
CREATE TABLE USERS (USN VARCHAR(10) PRIMARY KEY, NAME VARCHAR(30), PASSWORD VARCHAR(15));

--TO CREATE SUBJECT TABLE
CREATE TABLE SUBJECT (SID INT PRIMARY KEY AUTO_INCREMENT, SNAME VARCHAR(100));

--TO CREATE QUESTIONS TABLE
CREATE TABLE QUESTIONS (QID INT PRIMARY KEY AUTO_INCREMENT, QUESTION VARCHAR(200), SID INT, FOREIGN KEY(SID) REFERENCES SUBJECT (SID));

--TO CREATE OPTIONS TABLE
CREATE TABLE OPTIONS (QID INT PRIMARY KEY AUTO_INCREMENT, O1 VARCHAR(100), O2 VARCHAR(100),O3 VARCHAR(100),O4 VARCHAR(100),ANSWER VARCHAR(100), FOREIGN KEY (QID) REFERENCES QUESTIONS (QID) ON DELETE CASCADE);

--TO CREATE SCORE TABLE
CREATE TABLE SCORE (USN VARCHAR(10), SID INT, TIME_TAKEN VARCHAR(5), SCORE INT, FOREIGN KEY (USN) REFERENCES USERS (USN) ON DELETE CASCADE, FOREIGN KEY (SID) REFERENCES SUBJECT (SID));

--TO INSERT ADMIN DATA
INSERT INTO USERS VALUES (1122334455, "KETAN HEGDE", "MiniPro@24"),(1122334456, "MOHAMMAD AAMIR", "MiniPro@24");

--TO INSERT SUBJECT DATA
INSERT INTO SUBJECT (SNAME) VALUES ("COMPUTER NETWORKS"),("OPERATING SYSTEMS"),("DATABASE MANAGEMENT SYSTEMS");



--TO INSERT COMPUTER NETWORKS QUESTIONS
INSERT INTO QUESTIONS (QUESTION,SID) VALUES 
("Which of these is a standard interface for serial data transmission?",1),
("Which type of topology is best suited for large businesses which must carefully control and coordinate the operation of distributed branch outlets?",1),
("Which of the following transmission directions listed is not a legitimate channel?",1),
("\"Parity bits\" are used for which of the following purposes?",1),
("What kind of transmission medium is most appropriate to carry data in a computer network that is exposed to electrical interferences?",1),
("A collection of hyperlinked documents on the internet forms the ___________",1),
("The location of a resource on the internet is given by its ___________",1),
("The term HTTP stands for",1),
("A Proxy server is used as the computer",1),
("Which one of the following would breach the integrity of a system?",1),
("Which software prevents the external access to a system?",1),
("Which one of the following is a valid email address?",1),
("Which of the following best describes uploading information?",1),
("Which one of the following is the most common internet protocol?",1),
("Software programs that allow you to legally copy files and give them away at no cost are called ____________",1);


--TO INSERT OPERATING SYSTEMS QUESTIONS
INSERT INTO QUESTIONS (QUESTION,SID) VALUES
("Which of the following is not an operating system?",2),
("What is the maximum length of the filename in DOS?",2),
("When was the first operating system developed?",2),
("When were MS windows operating systems proposed?",2),
("Which of the following is the extension of Notepad?",2),
("What else is a command interpreter called?",2),
("What is the full name of FAT?",2),
("BIOS is used by",2),
("What is the mean of the Booting in the operating system?",2),
("When does a page fault occur?",2),
("Banker's algorithm is used to",2),
("When you delete a file in your computer, where does it go?",2),
("Which is the Linux operating system?",2),
("What is the full name of the DSM?",2),
("What is the full name of the IDL?",2);


--TO INSERT DBMS QUESTIONS
INSERT INTO QUESTIONS (QUESTION,SID) VALUES
("Which of the following is generally used for performing tasks like creating the structure of the relations, deleting relation?",3),
("Which of the following provides the ability to query information from the database and insert tuples into, delete tuples from, and modify tuples in the database?",3),
("Which one of the following given statements possibly contains the error?",3),
("What do you mean by one to many relationships?",3),
("A Database Management System is a type of _________ software.",3),
("The term \"FAT\" stands for _______.",3),
("Which of the following can be considered as the maximum size that is supported by FAT?",3),
("The term \"NTFS\" refers to which one of the following?",3),
("Which of the following can be used to extract or filter the data & information from the data warehouse?",3),
("Which one of the following refers to the copies of the same data (or information) occupying the memory space at multiple places.",3),
("Which one of the following refers to the \"data about data\"?",3),
("Which of the following refers to the level of data abstraction that describes exactly how the data actually stored?",3),
("To which of the following does the term \"DBA\" refer to?",3),
("In general, a file is basically a collection of all related ________.",3),
("Rows of a relation are known as the _______.",3);



--TO INSERT OPTIONS & ANSWERS FOR CN
INSERT INTO OPTIONS (O1,O2,O3,O4,ANSWER) VALUES
("ASCII", "RS232C", 	"2", "Centronics", "RS232C"),
("Ring", "Local area",	"Hierarchical",	"Star",	"Star"),
("Simplex","Half Duplex", "Full Duplex","Double Duplex", "Double Duplex"),
("Encryption of data",	"To transmit faster", "To detect errors", "To identify the user", "To detect errors"),
("Unshielded twisted pair", "Optical fiber", "Coaxial cable", "Microwave", "Optical fiber"),
("World Wide Web (WWW)", "E-mail system", "Mailing list", "Hypertext markup language", "World Wide Web (WWW)"),
("Protocol", "URL", "E-mail address", "ICQ", "URL"),
("Hyper terminal tracing program", "Hypertext tracing protocol", "Hypertext transfer protocol",	"Hypertext transfer program", "Hypertext transfer protocol"),
("with external access", "acting as a backup",	"performing file handling", "accessing user permissions", "with external access"),
("Looking the room to prevent theft", "Full access rights for all users", "Fitting the system with an anti-theft device", "Protecting the device against willful or accidental damage", "Full access rights for all users"),
("Firewall", "Gateway", "Router", "Virus checker",	"Firewall"),
("javat@point.com", "gmail.com", "tpoint@.com",	"javatpoint@books", "javat@point.com"),
("Sorting data on a disk drive", "Sending information to a host computer", "Receiving information from a host computer",  "Sorting data on a hard drive", "Sending information to a host computer"),
("HTML", "NetBEUI", "TCP/IP", "IPX/SPX", "TCP/IP"),
("Probe ware",	"Timeshare", "Shareware", "Public domain", "Public domain");

--TO INSERT OPTIONS & ANSWERS FOR OS
INSERT INTO OPTIONS (O1,O2,O3,O4,ANSWER) VALUES			
("Linux", "Oracle", "DOS", "Windows" ,"Oracle"),
("5", "8", "12", "4", "8"),
("1949", "1950", "1951", "1948", "1950"),
("1990", "1992", "1985", "1994", "1985"),
(".xls", ".ppt", ".bmp", ".txt", ".txt"),
("kernal", "shell", "command", "prompt", "shell"),
("File allocation table", "Font attribute table", "Format allocation table", "File attribute table", "File allocation table"),
("Compiler", "Interpreter", "Application software", "Operating system", "Operating system"),
("Install the program", "To scan", "To turn off", "Restarting computer", "Restarting computer"),
("The deadlock occurs", "The page is not present in memory", "The buffering occurs","The page is present in memory","The page is not present in memory"),
("Deadlock recovery", "Solve the deadlock", "Prevent deadlock", "None of these","Prevent deadlock"),
("Hard disk", " Taskbar", "Recycle Bin", "None of these", "Recycle Bin"),
("Windows operating system", "Open-source operating system", "Private operating system", "None of these", "Open-source operating system"),
("Direct system memory", "Demoralized system memory", "Distributed shared memory","Direct system module","Distributed shared memory"),
("Interface direct language", "Interface data library", "Interface definition language", "None of these", "Interface definition language");

--TO INSERT OPTIONS & ANSWERS FOR DBMS 
INSERT INTO OPTIONS (O1,O2,O3,O4,ANSWER) VALUES
("DML(Data Manipulation Language)", "Relational Schema", "Query", "DDL(Data Definition Language)", "DDL(Data Definition Language)"),
("DML(Data Manipulation Language)", "DDL(Data Definition Language)", "Query", "Relational Schema", "DML(Data Manipulation Language)"),
("select * from emp where empid = 10003;", "select empid from emp where empid = 10006;",  "select empid from emp;", "select empid where empid = 1009 and Lastname = 'GELLER';",	"select empid where empid = 1009 and Lastname = 'GELLER';"),
("One class may have many teachers", "One teacher can have many classes", "Many classes may have many teachers", "Many teachers may have many classes",	"One teacher can have many classes"),
("It is a type of system software", "It is a kind of application software", "It is a kind of general software",  "Both A and C", "It is a type of system software"),
("File Allocation Tree","File Allocation Table", "File Allocation Graph", "None of the above", "File Allocation Table"),
("8GB", "4GB", "4TB", "None of the above", "4GB"),
("New Technology File System",	"New Tree File System", "New Table type File System", "Both A and C", "New Technology File System"),
("Data redundancy", "Data recovery tool",  "Data mining", "Both B and C", "Data mining"),
("Data Repository", "Data Inconsistency", "Data Mining", "Data Redundancy", "Data Redundancy"),
("Directory", "Sub Data", "Warehouse", "Meta Data", "Meta Data"),
("Conceptual Level", "Physical Level",	"File Level",	"Logical Level", "Physical Level"),
("Data Bank Administrator", "Database Administrator", "Data Administrator", "None of the above"	, "Database Administrator"),
("Rows & Columns", "Fields", "Database", "Records", "Records"),
("Degree", "Tuples", "Entity", "All of the above", "All of the above");