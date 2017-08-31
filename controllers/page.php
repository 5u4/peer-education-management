<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/configs/config.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/manager.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/peducator.php'; // for further expension

// ----------------------
// Page Class
// ----------------------
// Description: Page object takes a $current_user as a parameter and the functions
//              outputs html code which formatting the page
// $page = new Page($current_user);

// ----------------------
// Nav functions
// ----------------------
// nav_head(): should be placed inside head tags for navigation
// nav_body_start(): should be placed at the beginning of the body; navigation links
//                   are inside this function
// nav_body_close(): should be placed at the end of the body where content are wrapped
//                 by nav_body_start() and nav_body_end()

// ----------------------
// DataTable functions
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
                <a href="#">'.
                    $this->get_name().'
                </a>
            </li>';
    }

    public function nav_dashboard() {
        echo '<li><a href="dashboard.php">Dashboard</a></li>';
    }

    public function nav_general_settings() {
        if ($this->permission >= 3) {
            // dropdown list start
            echo '            
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">General Settings<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li class="dropdown-header">Settings</li>';

            // dropdown list
            echo '
                    <li><a href="setting.php#section">Section</a></li>
                    <li><a href="setting.php#course">Course</a></li>
                    <li><a href="setting.php#peducator">Peer Educator</a></li>
                 ';

            // dropdown list end
            echo '</ul></li>';
        }
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
        echo '<li><a href="/controllers/logout.php">Logout</a></li>';
    }

    // ----------------------
    // Navigation functions
    // ----------------------
    public function nav_head() {
        echo '
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
            <title>'.$this->get_name().' - PE Management Tool</title>
        
            <!-- Bootstrap -->
            <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
            <link href="/assets/css/nav.css" rel="stylesheet">
        
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
        $this->nav_general_settings();
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

        // jQuery -- does not work with DataTable CDN
        echo '
        <!-- jQuery (necessary for Bootstrap\'s JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>';

        // compiled plugins
        echo '
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="/assets/js/bootstrap.min.js"></script>
        <script src="/assets/js/nav.js"></script>
        ';
    }

    public function nav_body_close_with_table() {
        // page content wrapper
        echo '</div></div></div></div>';

        // wrapper
        echo '</div>';

        // compiled plugins
        echo '
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="/assets/js/bootstrap.min.js"></script>
        <script src="/assets/js/nav.js"></script>
        ';
    }
}

function datatable_head() {
    echo '
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
        <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $(\'#courses\').DataTable( {
                    "order": [[ 3, "desc" ]]
                } );
            } );
        </script>
        ';
}
?>
