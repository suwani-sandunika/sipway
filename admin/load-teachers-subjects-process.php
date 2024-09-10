<?php

require "../MySQL.php";
$email = $_GET['email'];

if (empty($email)) {
    echo "Please enter your email";
} else {
    $thsRs = MySQL::search("SELECT *, subject_id as id FROM teacher_has_subject JOIN subject s on teacher_has_subject.subject_id = s.id JOIN year y on s.year_id = y.id WHERE teacher_email='${email}'");

    if ($thsRs->num_rows > 0) {
        ?>
        <div class="table-responsive table-desi">
            <table class="user-table table table-striped all-package">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Subject</th>
                    <th>Grade</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="subjects-modal-body">
                <?php
                $x = 1;
                while ($thsData = $thsRs->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?= $x ?></td>
                        <td><?= $thsData['subject_name'] ?></td>
                        <td><?= $thsData['year_name'] ?></td>
                        <td>
                            <ul>
                                <li>
                                    <button onclick="unassignTeachersSubject('<?= $thsData['id'] ?>', '<?= $thsData['teacher_email'] ?>')"
                                            class="table-button text-danger">
                                        <span class="lnr lnr-trash"></span>
                                    </button>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <?php
                    $x++;
                }

                ?>
                </tbody>
            </table>
        </div>
        <?php
    } else {
        ?>
        <div class="d-flex flex-column align-items-center p-5">
            <svg height="100" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                <path fill="none" d="M0 0h48v48h-48z"/>
                <path fill="#e22454"
                      d="M24 4c-11.04 0-20 8.95-20 20s8.96 20 20 20 20-8.95 20-20-8.96-20-20-20zm2 30h-4v-4h4v4zm0-8h-4v-12h4v12z"/>
            </svg>
            <span class="text-danger fw-bold fs-3">No Subjects Assigned</span>
        </div>
        <?php
    }
}