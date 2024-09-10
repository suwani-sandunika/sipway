<div>
    <div class="table-responsive table-desi">
        <table class="user-table table table-striped all-package">
            <thead>
            <tr>
                <th>#</th>
                <th></th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Year</th>
                <th>Batch</th>
                <th>Verified</th>
                <th>Registered</th>
                <th>Payment</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>

            <?php
            session_start();
            require "../MySQL.php";

            $txt = $_GET['txt'];
            if (isset($_GET["page"]) && $_GET["page"] != 0) {
                $page_no = $_GET["page"];
            } else {
                $page_no = 1;
            }

            $student_rs = MySQL::search("SELECT * FROM student WHERE email LIKE '${txt}%' OR mobile LIKE '%${txt}%'");
            $no_of_students = $student_rs->num_rows;

            $results_per_page = 10;
            $no_of_pages = ceil($no_of_students / $results_per_page);
            $viewed_count = ((int)$page_no - 1) * $results_per_page;

            $student_rs2 = MySQL::search("SELECT * FROM student JOIN batch b on student.batch_id = b.id JOIN year y on y.id = b.year_id WHERE email LIKE '${txt}%' OR mobile LIKE '%${txt}%' ORDER BY creation_time DESC LIMIT ${results_per_page} OFFSET ${viewed_count}");

            $x = 1;

            while ($student = $student_rs2->fetch_assoc()) {
                ?>
                <tr>


                    <td class="switch-td mt-2">
                        <div class="form-check form-switch">
                            <input id="student_status_switch<?= $x ?>"
                                   class="form-check-input" type="checkbox"
                                   role="switch"
                                   onchange="changeStudentStatus('<?= $student["email"] ?>', 'student_status_switch<?= $x ?>')" <?= ($student["status"] == 1) ? "checked" : "" ?>>
                        </div>

                    </td>


                    <td>
                                                    <span>
                                                    <img src="../<?= ($student['profile_img'] != null) ? $student['profile_img'] : 'assets/images/profile/user.png' ?>"
                                                         alt="users">
                                                    </span>
                    </td>

                    <td>
                        <a href="javascript:void(0)">
                            <span class="d-block "><?= $student['first_name'] . ' ' . $student['last_name'] ?></span>
                            <span class="text-muted">Student</span>
                        </a>
                    </td>

                    <td><?= $student['mobile'] ?></td>

                    <td><?= $student['email'] ?></td>

                    <td><?= $student['year_name'] ?></td>

                    <td><?= $student['batch_name'] ?></td>

                    <td class="<?= ($student['is_verified'] == 1) ? "order-success" : "order-cancle" ?>"><?= ($student['is_verified'] == 1) ? "<span>Verified</span>" : '<span>Not Verified</span>' ?></td>

                    <td><?= $student['creation_time'] ?></td>

                    <td class="<?= ($student['payment_status'] == 1) ? "order-success" : "order-pending" ?>"><?= ($student['payment_status'] == 1) ? "<span>Paid</span>" : '<span>Not Paid</span>' ?></td>

                    <td>
                        <ul>
                            <li>
                                <!--data-bs-toggle="modal" data-bs-target="#update-student"-->
                                <button class="table-button text-primary"
                                        onclick='showStudentUpdateModal(<?= json_encode($student) ?>)'>
                                    <span class="lnr lnr-pencil"></span>
                                </button>
                            </li>

                            <li>
                                <button onclick="showStudentDeleteConfirmModal('<?= $student["email"] ?>')"
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
</div>
</div>

<div class="pagination-box d-flex justify-content-center mt-3">
    <nav class="ms-auto me-auto " aria-label="...">
        <ul class="pagination pagination-primary">
            <li class="page-item">
                <a class="page-link"
                   href="<?= ($page_no <= 1) ? 'javascript:void(0)' : 'javascript:searchStudents(' . ($page_no - 1) . ')' ?>">Previous</a>
            </li>
            <?php
            for ($i = 1; $i <= $no_of_pages; $i++) {
                if ($page_no == $i) {
                    ?>
                    <li class="page-item active">
                        <a class="page-link" href="javascript:searchStudents('<?= $i ?>')"><?= $i ?></a>
                    </li>

                    <?php
                } else {
                    ?>
                    <li class="page-item">
                        <a class="page-link" href="javascript:searchStudents('<?= $i ?>')"><?= $i ?></a>
                    </li>
                    <?php
                }
            }
            ?>
            <li class="page-item">
                <a class="page-link"
                   href="<?= ($page_no >= $no_of_pages) ? "javascript:void(0)" : 'javascript:searchStudents(' . ($page_no + 1) . ')' ?>">Next</a>
            </li>
        </ul>
    </nav>
</div>