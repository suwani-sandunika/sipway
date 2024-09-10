<?php

require "../MySQL.php";

$text = $_GET['txt'];
$assId = $_GET['assId'];

$assignmentRs = MySQL::search("SELECT *, student_has_assignments.id as sha_id, a.name as ass_name FROM student_has_assignments JOIN student s on student_has_assignments.student_email = s.email JOIN assignments a on student_has_assignments.assignments_id = a.id JOIN batch b on s.batch_id = b.id WHERE (assignments_id = '${assId}') AND (s.email LIKE '%${text}%' OR s.mobile LIKE '%${text}%' OR s.first_name LIKE '%${text}%' OR s.last_name LIKE '%${text}%' OR CONCAT_WS(' ', first_name, last_name) LIKE '%${text}%')");

while ($assignmentData = $assignmentRs->fetch_assoc()) {
    ?>
    <tr class="text-center">
        <td class="d-flex flex-column justify-content-center">
            <span><?= $assignmentData['first_name'] . ' ' . $assignmentData['last_name'] ?></span>
            <span class="text-muted"
                  style="font-size: 10px"><?= $assignmentData['email'] ?></span>
        </td>
        <td class="text-center"><?= explode(' ', $assignmentData['submitted_date'])[0] ?></td>
        <td><?= ($assignmentData['marks'] == 0) ? "Not Released" : $assignmentData['marks'] ?></td>
        <td>
            <ul>
                <li>
                    <!--data-bs-toggle="modal" data-bs-target="#update-student"-->
                    <a href="../<?= $assignmentData['url'] ?>"
                       download="<?= $assignmentData['first_name'] . ' ' . $assignmentData['last_name'] . ' - ' . $assignmentData['ass_name'] ?>"
                       class="table-button text-primary">
                        <span class="lnr lnr-download text-primary"></span>
                        Download
                    </a>
                </li>
            </ul>
        </td>
    </tr>
    <?php
}
?>
