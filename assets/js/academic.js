/*----------------------------------------
 Academic
 ----------------------------------------*/

function academicLogin(evt) {
    const req = new XMLHttpRequest();

    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            const result = JSON.parse(req.responseText);

            if (result['status'] === 'success') {
                setInterval(() => {
                    window.location = 'index.php';
                }, 500)
            } else {
                document.getElementById("name-err").innerHTML = result['name-err'];
                document.getElementById("pass-err").innerHTML = result['pass-err'];
            }
        }
    }
    req.open('post', 'login-process.php', true);
    req.send(new FormData(document.getElementById("login-form")));

    evt.preventDefault();
}

function sendForgotPasswordEmail(evt) {
    const req = new XMLHttpRequest();

    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            document.getElementById("loading-btn").classList.add('d-none');
            document.getElementById("send-btn").classList.remove('d-none');

            let txt = req.responseText;
            if (txt == "success") {
                document.getElementById("err-msg-fp").innerHTML = "";
                document.querySelector("#send-btn button").innerHTML = "Email Sent";
                document.querySelector("#send-btn button").disabled = true;
            } else {
                document.getElementById("err-msg-fp").innerHTML = txt;
            }
        } else {
            document.getElementById("loading-btn").classList.remove('d-none');
            document.getElementById("send-btn").classList.add('d-none');
        }
    }

    req.open('post', 'send-forgot-pass-process.php', true);
    req.send(new FormData(document.getElementById('fp-form')));

    evt.preventDefault();
}

function forgotAcademicPassword(evt, vc) {
    let form = new FormData(document.getElementById('pass-reset-form'));
    form.append('vc', vc);

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            let txt = req.responseText;

            if (txt === 'success') {
                document.querySelector(".toast-body").innerHTML = "Academic Officer password reset successful";
                new bootstrap.Toast(document.getElementById('confirm-toast')).show();
                setTimeout(() => {
                    window.location = 'login.php';
                }, 1000)
            } else {
                document.getElementById('pass-err').innerHTML = txt;
            }
        }
    }
    req.open('post', 'reset-password-fp-process.php', true);
    req.send(form);

    evt.preventDefault();
}

function updateAcademicProfileImg() {
    const file = document.getElementById('profile-img').files[0];
    document.getElementById('academic-profile-img-tag').src = URL.createObjectURL(file);

    const form = new FormData();
    form.append('file', file);

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            const txt = req.responseText;
            if (txt == 'success') {
                document.querySelector(".toast-body").innerHTML = "Profile image updated successfully.";
                new bootstrap.Toast(document.getElementById('confirm-toast')).show();
            }
        }
    }

    req.open('post', 'update-academic-profile-img-process.php', true);
    req.send(form);
}

function updateAcademic() {
    const fname = document.getElementById("fname");
    const lname = document.getElementById("lname");
    const mobile = document.getElementById("mobile");
    const email = document.getElementById("aemail");

    const form = new FormData();
    form.append('fname', fname.value);
    form.append('lname', lname.value);
    form.append('mobile', mobile.value);
    form.append('email', email.value);

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            let txt = req.responseText;
            if (txt === "success") {
                document.querySelector(".toast-body").innerHTML = "Academic profile updated successfully";
                new bootstrap.Toast(document.getElementById('confirm-toast')).show();
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            } else {
                document.getElementById("err-msg").innerHTML = txt;
            }
        }
    }
    req.open('post', 'update-academic-process.php', true);
    req.send(form);
}

function resetAcademicPassword(evt) {
    const req = new XMLHttpRequest();

    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            let txt = req.responseText;
            if (txt === "success") {
                document.getElementById('academic-reset-pass-form').reset();
                document.querySelector(".toast-body").innerHTML = "Academic password reset successfully.";
                new bootstrap.Toast(document.getElementById('confirm-toast')).show();
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            } else {
                document.getElementById('err-msg2').innerHTML = txt;
            }
        }
    }

    req.open('post', 'reset-password-process.php', true)
    req.send(new FormData(document.getElementById('academic-reset-pass-form')));

    evt.preventDefault();
}

let studentUpdateModal;

function showStudentUpdateModal(student) {
    document.getElementById("fname").value = student['first_name'];
    document.getElementById("lname").value = student['last_name'];
    document.getElementById("mobile").value = student['mobile'];
    document.getElementById("aemail").value = student['email'];
    document.getElementById("batch").value = student['batch_id'];

    studentUpdateModal = new bootstrap.Modal(document.getElementById("update-student"));
    studentUpdateModal.show();
}

function updateStudent() {
    const fname = document.getElementById("fname");
    const lname = document.getElementById("lname");
    const mobile = document.getElementById("mobile");
    const email = document.getElementById("aemail");

    const form = new FormData();
    form.append('fname', fname.value);
    form.append('lname', lname.value);
    form.append('mobile', mobile.value);
    form.append('email', email.value);

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            let txt = req.responseText;
            if (txt === "success") {
                studentUpdateModal.hide();
                document.querySelector(".toast-body").innerHTML = "Student profile updated successfully";
                new bootstrap.Toast(document.getElementById('confirm-toast')).show();
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            } else {
                document.getElementById("err-msg").innerHTML = txt;
            }
        }
    }
    req.open('post', 'update-student-process.php', true);
    req.send(form);
}


function searchStudents(page) {
    const txt = document.getElementById("student-search");

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            document.getElementById('card-body').innerHTML = req.responseText;
        }
    }

    req.open('get', 'search-students-process.php?txt=' + txt.value + '&page=' + page, true);
    req.send();
}

function registerStudent(evt) {
    const req = new XMLHttpRequest();

    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            document.getElementById('register-btn').classList.remove('d-none');
            document.getElementById('loading-btn').classList.add('d-none');

            let txt = req.responseText;

            if (txt == "success") {
                document.getElementById("register_form_err").innerHTML = "";
                document.getElementById('student-register-form').reset();

                document.querySelector(".toast-body").innerHTML = "Accounted created successfully & email sent.";
                new bootstrap.Toast(document.getElementById('confirm-toast')).show();
            } else {
                document.getElementById("register_form_err").innerHTML = txt;
            }
        } else {
            document.getElementById('register-btn').classList.add('d-none');
            document.getElementById('loading-btn').classList.remove('d-none');
        }
    }

    req.open('post', 'register-student-process.php', true);
    req.send(new FormData(document.getElementById('student-register-form')));

    evt.preventDefault();
}

let updateBatchModal;

function showUpdateBatchModal(batch) {
    document.getElementById("batch-id").value = batch['batch_id'];
    document.getElementById("bname").value = batch['batch_name'];
    document.getElementById("year").value = batch['year_id'];

    updateBatchModal = new bootstrap.Modal(document.getElementById("update-batch"));
    updateBatchModal.show();
}

function updateBatch(evt) {
    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            if (req.responseText == 'success') {
                updateBatchModal.hide();
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } else {
                document.getElementById("err-msg").innerHTML = req.responseText;
            }
        }
    }

    req.open('post', 'update-batch-process.php', true);
    req.send(new FormData(document.getElementById('update-batch-form')));

    evt.preventDefault();
}


function searchBatches(page) {
    const txt = document.getElementById("batch-search");

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            document.getElementById('card-body').innerHTML = req.responseText;
        }
    }

    req.open('get', 'search-batches-process.php?txt=' + txt.value + '&page=' + page, true);
    req.send();
}

function registerBatch(evt) {
    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            document.getElementById('register-btn').classList.remove('d-none');
            document.getElementById('loading-btn').classList.add('d-none');

            if (req.responseText == "success") {
                document.getElementById("register_form_err").innerHTML = "";
                document.getElementById('batch-register-form').reset();

            } else {
                document.getElementById("register_form_err").innerHTML = req.responseText;
            }
        } else {
            document.getElementById('register-btn').classList.add('d-none');
            document.getElementById('loading-btn').classList.remove('d-none');
        }

    }

    req.open('post', 'register-branch-process.php', true);
    req.send(new FormData(document.getElementById('batch-register-form')));

    evt.preventDefault();
}

function searchAssignmentAnswerSheets(assId) {
    let txt = document.getElementById('aas-input').value;
    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            const txt = req.responseText;
            document.getElementById('table-body').innerHTML = txt;
        }
    }

    req.open('get', 'search-assignment-answer-sheets-process.php?txt=' + txt + '&assId=' + assId, true);
    req.send();
}

function releaseAssignmentMarksToStudents(assId) {
    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            const txt = req.responseText;
            if (txt == 'success') {
                document.querySelector(".toast-body").innerHTML = "Assignment Marks Released to Students";
                setTimeout(() => {
                    window.location = "all-assignments.php";
                }, 1000);
            } else {
                document.querySelector(".toast-body").innerHTML = txt;
            }
            new bootstrap.Toast(document.getElementById('confirm-toast')).show();
        }
    }

    req.open('get', 'release-assignment-marks-to-students.php?assId=' + assId, true);
    req.send();
}