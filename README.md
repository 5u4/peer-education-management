# Peer Education Application

# Classes

## Authentication
### Attributes 
current_user // store either manager_id or null <br />
### Methods
// Login: pull manager's manager_id from database and authenticate.  <br />
public login(username, password, db_connection); <br /> <br />
// Logout: set current_user to null. Destroy current session.  <br />
public logout(); <br /> <br />
// Signup: Create new user.  <br />
public signup(firstname, lastname, username, password, db_connection); <br /> <br />

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

## peducators
### Attributes
peducator_id // AUTO_INCREMENT PRIMARY KEY <br />
student_id // FIC student id <br />
preferred_name <br />
first_name <br />
last_name <br />
section_id<br />
courses (from other table)<br />
weekly_contributed_hours (from other table)<br />

### Methods
// Get Section Time: return a PEducator's section time <br />
public get_section_time(student_id); <br />
// Get Courses: return all courses a PEducator can teach <br />
public get_courses(student_id);  <br /> <br />
// Get Weekly Contributed Hours: return a PEducator's attended hours in a specific week <br />
public get_weekly_contributed_hrs(student_id, semester_id, week_number); <br /> <br />
// Set Section id
// Set Courses (from other table)
// Set Weekly Contributed Hours (from other table)
// Set PE inoformation (including deleting PE)

## Courses
### Attributes
course_id // i.e. "MATH100" <br />
### Methods
// Get Total Count: returns a courses total times been taught <br />
public get_total_count(course_id); <br /> <br />
// Get PEducator for Course: returns all PEducators that can teach the course <br />
public get_peducator_for_course(course_id); <br /> <br />

