# Peer Education Application

# Classes

## Authentication
### Attributes 
current_user // store either student_id or null
### Login: pull FIC student_id from database and pwd, compare, set current_user 
public login(student_id, encrypted_password);
### Logout: set current_user to null 
public logout();
### Signup: write info into database 
public signup(firstname, lastname, prefername, student_id, password);

## Member
### Attributes
student_id // FIC student id, i.e. "wonsd1503" PRIMARY KEY <br />
prefername <br />
firstname <br />
lastname <br />
section_time <br />
### Get Section Time: return a PEducator's section time
public get_section_time(student_id);

## PEducator extends Member
### Attributes
id // AUTO_INCREMENT PRIMARY KEY
### Get Courses: return all courses a PEducator can teach
public get_courses(student_id); 
### Get Weekly Contributed Hours: return a PEducator's attended hours in a specific week
public get_weekly_contributed_hrs(student_id, semester_id, week_number);

## Manager extends Member
### Attributes
id // AUTO_INCREMENT PRIMARY KEY

## Courses
### Attributes
course_id // i.e. "MATH100"
### Get Total Count: returns a courses total times been taught
public get_total_count(course_id);
### Get PEducator for Course: returns all PEducators that can teach the course
public get_peducator_for_course(course_id);

