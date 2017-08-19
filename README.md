# Peer Education Application

# Classes

## Authentication
### Attributes 
current_user // store either student_id or null <br />
### Methods
// Login: pull FIC student_id from database and pwd, compare, set current_user  <br />
public login(student_id, encrypted_password); <br /> <br />
// Logout: set current_user to null  <br />
public logout(); <br /> <br />
// Signup: write info into database  <br />
public signup(firstname, lastname, prefername, student_id, password); <br /> <br />

## Manager
### Attributes
manager_id // PRIMARY KEY <br />
username <br />
password <br />
first_name <br />
last_name <br />
section_time <br />
### Methods
// Get Section Time: return a PEducator's section time <br />
public get_section_time(student_id); <br />

## PEducator
### Attributes
id // AUTO_INCREMENT PRIMARY KEY <br />
student_id // FIC student id <br />
first_name <br />
last_name <br />
section_time <br />
### Methods
// Get Section Time: return a PEducator's section time <br />
public get_section_time(student_id); <br />
// Get Courses: return all courses a PEducator can teach <br />
public get_courses(student_id);  <br /> <br />
// Get Weekly Contributed Hours: return a PEducator's attended hours in a specific week <br />
public get_weekly_contributed_hrs(student_id, semester_id, week_number); <br /> <br />

## Courses
### Attributes
course_id // i.e. "MATH100" <br />
### Methods
// Get Total Count: returns a courses total times been taught <br />
public get_total_count(course_id); <br /> <br />
// Get PEducator for Course: returns all PEducators that can teach the course <br />
public get_peducator_for_course(course_id); <br /> <br />

