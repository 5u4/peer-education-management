<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/configs/config.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/manager.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/peducator.php'; // for further expension

// ----------------------
// Navigation description
// ----------------------
// initialize a Manager (should not be used explicitly): new Manager($manager_id)
// get methods: get_attributes() returns attributes
// set methods: set_attributes_to($new_value) return true/false

// ----------------------
// other functions
// ----------------------

class Page {
    // ----------------------
    // Navigation attributes
    // ----------------------
    private $current_user;
    private $permission; // unlogin = 0 | pe = 1 | manager = 2 | manager_admin = 3

    // ----------------------
    // Constructor
    // ----------------------
    public function __construct($current_user) {
        $this->current_user = $current_user;
        $this->permission = $current_user->get_permission();
    }

    // ----------------------
    // User functions
    // ----------------------
    public function get_name() {
        // manager_admin
        if ($this->permission >= 2) {
            return $this->current_user->get_first_name();
        }
    }

    // ----------------------
    // Navigation links
    // ----------------------
    public function nav_brand() {
        echo '
            <li class="sidebar-brand">
                <a href="#">
                    Peer Education
                </a>
            </li>';
    }

    public function nav_dashboard() {
        echo '<li><a href="#">Dashboard</a></li>';
    }

    public function nav_general() {
        if ($this->permission >= 3)
        echo '<li><a href="#">General Settings</a></li>';
    }

    public function nav_weekly_section() {
        // dropdown list start
        echo '            
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Weekly Section<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li class="dropdown-header">Weekly Section Record</li>';

        // dropdown list
        $this->nav_attendence();
        $this->nav_course();
        $this->nav_schedule();

        // dropdown list end
        echo '</ul></li>';
    }

    public function nav_attendence() {
        echo '<li><a href="attendence.php">Attendence</a></li>';
    }

    public function nav_course() {
        echo '<li><a href="course.php">Course</a></li>';
    }

    public function nav_peducator() {
        echo '<li><a href="peducator.php">Peer Educators</a></li>';
    }

    public function nav_schedule() {
        echo '<li><a href="section_schedule.php">Section Schedule</a></li>';
    }

    public function nav_announcement() {
        echo '<li><a href="announcement.php">Announcements</a></li>';
    }

    public function nav_logout() {
        echo '<li><a href="#">Logout</a></li>';
    }

    // ----------------------
    // Navigation functions
    // ----------------------
    public function nav_head() {
        echo '
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
            <title>'.$this->get_name().' - PE Management Tool</title>
        
            <!-- Bootstrap -->
            <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
            <link href="../assets/css/nav.css" rel="stylesheet">
        
            <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn\'t work if you view the page via file:// -->
            <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
        ';

        // '.$_SERVER['DOCUMENT_ROOT'].'

        // include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/_nav.php';
    }

    public function nav_body_start() {
        // wrapper
        echo '<div id="wrapper"><div class="overlay"></div>';

        // sidebar wrapper
        echo '<nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
                <ul class="nav sidebar-nav">\'';

        // lists
        $this->nav_brand();
        $this->nav_dashboard();
        $this->nav_general();
        $this->nav_weekly_section();
        $this->nav_announcement();
        $this->nav_peducator();
        $this->nav_logout();

        // sidebar wrapper
        echo '</ul></nav>';

        // page content wrapper
        echo '<div id="page-content-wrapper">
                <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
                    <span class="hamb-top"></span>
                    <span class="hamb-middle"></span>
                    <span class="hamb-bottom"></span>
                </button>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
        ';
    }

    public function nav_body_close() {
        // page content wrapper
        echo '</div></div></div></div>';

        // wrapper
        echo '</div>';

        // jQuery
        echo '
        <!-- jQuery (necessary for Bootstrap\'s JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/nav.js"></script>
        ';
    }
}
?>