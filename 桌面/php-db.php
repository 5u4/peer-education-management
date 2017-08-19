// at includes/dbh.inc.php
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

<body>
<form action="includes/signup.inc.php" method="POST">
	<input type="text" name="first" placeholder="Firstname">
	<button type="submit" name="submit">Sign up</button>
</form>

<?php
	$sql = "SELECT * FROM users;";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if ($resultCheck > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			echo $row['user_uid']."<br/>";
		}
	}
?>
</body>

<?php
// at includes/signup.inc.php
include_once 'dbh.inc.php';

$first = mysqli_real_escape_string($conn, $_POST['first']);
$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
$sql = "INSERT INTO users (user_first, user_pwd, ...) VALUES ('$first', $pwd, ...);"; // insert
mysqli_query($conn, $sql);
header("Location: ../index.php?signup=success");

// Created a template
$data = "Admin";
$sql = "SELECT * FROM users WHERE user_uid=? AND user_first=?;";
// Created a prepared statement
$stmt = mysqli_stmt_init($conn);
// Prepare the prepared statement
if (!mysqli_stmt_prepare($stmt, $sql)) {
	echo "SQL statement failed";
} else {
	// Bind parameters to the placeholder
	mysqli_stmt_bind_param($stmt, "ss", $data, $data);
	// Run parameters inside database
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	while ($row = mysqli_fetch_assoc($result)) {
		echo $row['user_uid']."<br/>";
	}
}

// at includes/signup.inc.php
// Prepare Statement
$first = mysqli_real_escape_string($conn, $_POST['first']);
$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
$sql = "INSERT INTO users (user_first, user_pwd, ...) VALUES (?, ?, ...);"; // insert
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "SQL error";
} else {
    mysqli_stmt_bind_param($stmt, "ss", $first, $pwd);
    mysqli_stmt_execute($stmt);
}

header("Location: ../index.php?signup=success");
?>

<?php

    // Hash && Dehash
//    echo "test123";
//    echo "<br/>";
//    echo password_hash("test123", PASSWORD_DEFAULT);

    $input = "test123";
    $hashedPwdInDb = password_harsh("test123", PASSWORD_DEFAULT);

    echo password_verify($input, $hashedPwdInDb);

?>
