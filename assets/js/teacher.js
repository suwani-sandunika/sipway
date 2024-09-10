/*----------------------------------------
 Teacher
 ----------------------------------------*/

function teacherLogin(evt) {
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

function forgotTeacherPassword(evt, vc) {
    let form = new FormData(document.getElementById('pass-reset-form'));
    form.append('vc', vc);

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            let txt = req.responseText;

            if (txt === 'success') {
                document.querySelector(".toast-body").innerHTML = "Teacher password reset successful";
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

function updateTeacherProfileImg() {
    const file = document.getElementById('profile-img').files[0];
    document.getElementById('teacher-profile-img-tag').src = URL.createObjectURL(file);

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

    req.open('post', 'update-teacher-profile-img-process.php', true);
    req.send(form);
}

function updateTeacher() {
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
                document.querySelector(".toast-body").innerHTML = "Teacher profile updated successfully";
                new bootstrap.Toast(document.getElementById('confirm-toast')).show();
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            } else {
                document.getElementById("err-msg").innerHTML = txt;
            }
        }
    }
    req.open('post', 'update-teacher-process.php', true);
    req.send(form);
}

function resetTeacherPassword(evt) {
    const req = new XMLHttpRequest();

    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            let txt = req.responseText;
            if (txt === "success") {
                document.getElementById('teacher-reset-pass-form').reset();
                document.querySelector(".toast-body").innerHTML = "Teacher password reset successfully.";
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
    req.send(new FormData(document.getElementById('teacher-reset-pass-form')));

    evt.preventDefault();
}

function deleteLessonNote(lessonId) {
    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            const txt = req.responseText;
            if (txt === 'success') {
                window.location.reload();
            } else {
                alert(txt);
            }
        }
    }
    req.open('get', 'delete-lesson-note-process.php?lid=' + lessonId, true);
    req.send();
}

function addNewLessonNote(evt) {
    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            const txt = req.responseText;

            if (txt == 'success') {
                document.getElementById("add-new-lesson-note-form").reset();
                document.querySelector(".toast-body").innerHTML = "Lesson note uploaded successfully";
                new bootstrap.Toast(document.getElementById('confirm-toast')).show();
            } else {
                document.getElementById("err_msg").innerHTML = txt;
            }

        }
    }

    req.open('post', 'add-new-lesson-note-process.php', true);
    req.send(new FormData(document.getElementById('add-new-lesson-note-form')));

    evt.preventDefault();
}

function deleteAssignment(assignmentId) {
    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            const txt = req.responseText;
            if (txt === 'success') {
                window.location.reload();
            } else {
                alert(txt);
            }
        }
    }
    req.open('get', 'delete-assignment-process.php?aid=' + assignmentId, true);
    req.send();
}

function addNewAssignment(evt) {
    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            const txt = req.responseText;
            if (txt === "success") {
                document.getElementById("add-new-assignment-form").reset();
                document.querySelector(".toast-body").innerHTML = "Assignment uploaded successfully";
                new bootstrap.Toast(document.getElementById('confirm-toast')).show();

                setTimeout(() => {
                    window.location = 'all-assignments.php';
                }, 1000)
            } else {
                document.getElementById("err_msg").innerHTML = txt;
            }
        }
    }
    req.open('post', 'add-new-assignment-process.php', true);
    req.send(new FormData(document.getElementById('add-new-assignment-form')));

    evt.preventDefault();
}

function showReleaseMarksModal(shaId) {
    document.getElementById('sha-id').value = shaId;
    new bootstrap.Modal(document.getElementById("release-marks-modal")).show();
}

function releaseStudentAssignmentMarks(evt) {

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            const txt = req.responseText;
            if (txt === 'success') {
                window.location.reload();
            } else {
                document.getElementById('err-msg').innerHTML = txt;
            }
        }
    }

    req.open('post', 'release-student-marks-process.php', true);
    req.send(new FormData(document.getElementById('release-marks-form')));

    evt.preventDefault();
}

function releaseAssignmentMarksToAcademic(assignmentId) {
    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            const txt = req.responseText;
            if (txt == 'success') {
                document.querySelector(".toast-body").innerHTML = "Assignment Marks Released to Academic";
                setTimeout(() => {
                    window.location = "all-assignments.php";
                }, 1000);
            } else {
                document.querySelector(".toast-body").innerHTML = txt;
            }

            new bootstrap.Toast(document.getElementById('confirm-toast')).show();
        }
    }

    req.open('get', 'release-assignment-marks-to-academic.php?assId=' + assignmentId, true);
    req.send();
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