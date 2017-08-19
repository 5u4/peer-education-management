# peer_education

// ---------------------------
// Authentication
// ---------------------------
// Attributes 
char(11) current_user // store either student_id or null

// Login: pull FIC student_id from database and pwd, compare, set current_user public login(char(11) student_id, char(255) encrypted_password);

// Logout: set current_user to null public logout();

// Signup: write info into database public signup(varchar firstname, varchar lastname, varchar prefername, char(11) student_id, char(255) password);
