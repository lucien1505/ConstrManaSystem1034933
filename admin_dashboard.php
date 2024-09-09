<?php include 'header.php'; // Includes the header.php file which contains the header section of the page ?>

<div class="dashboard">
    <!-- Dashboard section for User Management -->
    <div class="section">
        <a href="user_management.php"> <!-- Link to the User Management page -->
            <img src="icons/user-management.png" alt="User Management"> <!-- User Management icon -->
            <h2>User Management</h2> <!-- User Management title -->
        </a>
    </div>

    <!-- Dashboard section for Viewing Projects -->
    <div class="section">
        <a href="view_projects.php"> <!-- Link to the View Projects page -->
            <img src="icons/projects.png" alt="View Projects"> <!-- View Projects icon -->
            <h2>View Projects</h2> <!-- View Projects title -->
        </a>
    </div>

    <!-- Dashboard section for Creating Projects (currently commented out) -->
    <!-- <div class="section">
        <a href="create_project.php"> 
            <img src="icons/create-project.png" alt="Create Project">
            <h2>Create Project</h2>
        </a>
    </div> -->

    <!-- Dashboard section for Reports & Analytics -->
    <div class="section">
        <a href="reports.php"> <!-- Link to the Reports & Analytics page -->
            <img src="icons/reports.png" alt="Reports"> <!-- Reports & Analytics icon -->
            <h2>Reports & Analytics</h2> <!-- Reports & Analytics title -->
        </a>
    </div>

    <!-- Dashboard section for Audit Log -->
    <div class="section">
        <a href="audit_log.php"> <!-- Link to the Audit Log page -->
            <img src="icons/audit-log.png" alt="Audit Log"> <!-- Audit Log icon -->
            <h2>Audit Log</h2> <!-- Audit Log title -->
        </a>
    </div>
</div>

<?php include 'footer.php'; // Includes the footer.php file which contains the footer section of the page ?>
