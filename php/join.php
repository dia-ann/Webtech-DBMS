<?php
$conn = mysqli_connect("localhost", "root", "", "project25_db");

$sql = "SELECT 
            team_assignment.assign_id,
            team_assignment.req_id,
            maintenance_team.team_name,
            maintenance_team.specialization,
            team_assignment.assigned_date
        FROM team_assignment
        INNER JOIN maintenance_team
        ON team_assignment.team_id = maintenance_team.team_id";

$result = mysqli_query($conn, $sql);

echo "<h2>Maintenance Team Assignments (JOIN Result)</h2>";

echo "<table border='1' cellpadding='8'>
<tr>
    <th>Assign ID</th>
    <th>Request ID</th>
    <th>Team Name</th>
    <th>Specialization</th>
    <th>Assigned Date</th>
</tr>";

while ($row = mysqli_fetch_array($result)) {
    echo "<tr>
            <td>{$row['assign_id']}</td>
            <td>{$row['req_id']}</td>
            <td>{$row['team_name']}</td>
            <td>{$row['specialization']}</td>
            <td>{$row['assigned_date']}</td>
          </tr>";
}

echo "</table>";

mysqli_close($conn);
?>

<br><br>
<button onclick="window.location.href='../html/admin_dashboard.html'">Back to Dashboard</button>
