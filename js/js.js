function addstudent() {
  window.location('addstudent.php');
}

function closebutton_addstudent(who) {
  if (who == "addstudent") {
    document.getElementById('addstudentpageBox').style.display = "none";
    window.location = "viewstudent.php"
  }

  else if (who == "addteacher") {
    document.getElementById('addTeacher').style.display = "none";
    window.location = "viewteacher.php"
  }

  else if (who == "addsection") {
    document.getElementById('addSectionform').style.display = "none";
    window.location = "viewsections.php"
  }
}

function closebutton_editviews(who) {
  if (who == "student") {
    document.getElementById('editstudentpageBox').style.display = "none";
    window.location = "viewstudent.php";
  }

  else if (who == "teacher") {
    document.getElementById('editteacherbox').style.display = "none";
    window.location = "viewteacher.php";
  }

  else if (who == "assignTeachers") {
    document.getElementById('assignTeachers').style.display = "none";
    window.location = "viewsections.php";
  }

  else if (who == "editsection") {
    document.getElementById('updateSection').style.display = "none";
    window.location = "viewsections.php";
  }

  else if (who == "adminInfo") {
    document.getElementById('editAdmin').style.display = "none";
    window.location = "admininfo.php";
  }

}

function closeMessage() {
  document.getElementById('error').style.display = "none";
}

function closenav() {
  document.getElementById('adminNav').style.width = "30px";
  document.getElementById('closenav').style.display = "none";
  document.getElementById('opennav').style.display = "block";
  document.getElementById('logoutButton').style.display = "none";

  document.getElementById('wrap').style.marginLeft = "30px";

  document.getElementById("navlink").style.display = "none";

}

function opennav() {
  document.getElementById('adminNav').style.width = "300px";
  document.getElementById('closenav').style.display = "block";
  document.getElementById('opennav').style.display = "none";
  document.getElementById('logoutButton').style.display = "block";
  document.getElementById('wrap').style.marginLeft = "300px";
  document.getElementById("navlink").style.display = "block";
}

function editdata() {
  $(".editstudentpageBox").slideToggle();
}

/* open showAddteacher() */
function addTeacher() {
  $(".addTeacher").slideToggle();
}

/* ajax adding and deleting item without loading pages */
// Function
function deletedata(id) {
  $(document).ready(function () {
    $.ajax({
      url: '../../sql/studentdata_sql.php',
      type: 'POST',
      data: {
        id: id,
        action: "action_deleteStudent"
      },
      success: function (response) {
        // Response is the output of action file
        if (response == 1) {
          document.getElementById(id).style.display = "none";
          message('delete', 'Deleted')

        }
        else if (response == 0) {
          alert("Data Cannot Be Deleted");
        }
      }
    });
  });
}

function message(what, messageInput) {
  if (what == "delete") {
    document.getElementById("messageTo").innerHTML = messageInput;
    document.getElementById("messageTo").style.display = "block";
    document.getElementById("messageTo").style.backgroundColor = "black";
    document.getElementById("messageTo").style.color = "red";
    $("#messageTo").fadeTo(1000, 1).fadeOut(5000);
  }
  else if (what == "success") {
    document.getElementById("messageTo").innerHTML = messageInput;
    document.getElementById("messageTo").style.display = "block";
    document.getElementById("messageTo").style.backgroundColor = "#349beb";
    document.getElementById("messageTo").style.color = "#fff";
    $("#messageTo").fadeTo(1000, 1).fadeOut(5000);
  }
}


//add student
$(document).off().on('submit', '#userForm', function (e) {
  e.preventDefault();
  e.disabled = true;

  var firstname = document.getElementById('firstname').value;
  var middlename = document.getElementById('middlename').value;
  var lastname = document.getElementById('lastname').value;
  var course = document.getElementById('course').value;
  var contact_number = document.getElementById('contact_number').value;
  var year = document.getElementById('year').value;

  $.ajax({
    method: "POST",
    url: "../../sql/studentdata_sql.php",
    data: {
      firstname: firstname,
      middlename: middlename,
      lastname: lastname,
      course: course,
      contact_number: contact_number,
      year: year,
      action: "action_addStudent",
    },
    success: function (response) {
      if (response == 0) {
        message('delete', 'ERROR');
      } else if (response == 2) {
        message('delete', 'Error 2');
      }
      else {
        $('#userForm').find('input').val('');
        message('success', 'Added');
        document.getElementById('studentbox_data').style.display = "block";
        $('#studentbox_data').append(response);
      }
    }
  });
});

//edit data -get data and display to editForm
$(document).on('click', '.editbutton', function () {
  var student_id = $(this).attr("id");
  $.ajax({
    url: "../../sql/studentdata_sql.php",
    method: "POST",
    data: {
      student_id: student_id,
      action: "action_getdataStudent",
    },
    dataType: "json",
    success: function (data) {
      $('#student_id').val(student_id);
      $('#email').val(data.email);
      $('#put_firstname').val(data.firstname);
      $('#put_middlename').val(data.middlename);
      $('#put_lastname').val(data.lastname);
      $('#put_contact_number').val(data.contact_number);
      $('#put_year').val(data.year);
    }

  });
});

//edit data -submit 
$(document).on('submit', '#updateForm', function (e) {
  e.preventDefault();
  e.disabled = true;

  var student_id = document.getElementById('student_id').value;
  var email = document.getElementById('email').value;
  var firstname = document.getElementById('put_firstname').value;
  var middlename = document.getElementById('put_middlename').value;
  var lastname = document.getElementById('put_lastname').value;
  var contact_number = document.getElementById('put_contact_number').value;
  var year = document.getElementById('put_year').value;

  $.ajax({
    method: "POST",
    url: "../../sql/studentdata_sql.php",
    cache: false,
    data: {
      student_id: student_id,
      email: email,
      firstname: firstname,
      middlename: middlename,
      lastname: lastname,
      contact_number: contact_number,
      year: year,
      action: "action_updateStudent",
    },
    success: function (response) {
      if (response == 1) {
        message('success', 'Updated Successfully.');
      } else if (response == 0) {
        toastr.error('Username already exist.');
      }
    }
  });
});

//teacher ajax submission
function addTeacher() {
  var teacher_firstname = document.getElementById('teacher_firstname').value;
  var teacher_middlename = document.getElementById('teacher_middlename').value;
  var teacher_lastname = document.getElementById('teacher_lastname').value;
  var teacher_contactnumber = document.getElementById('teacher_contactnumber').value;
  var teacher_userlevel = document.getElementById('teacher_userlevel').value;
  var teacher_department = document.getElementById('teacher_department').value;
  var teacher_rank = document.getElementById('teacher_rank').value;

  $.ajax({
    method: "POST",
    url: "../../sql/teacherdata_sql.php",
    data: {
      teacher_firstname: teacher_firstname,
      teacher_middlename: teacher_middlename,
      teacher_lastname: teacher_lastname,
      teacher_contactnumber: teacher_contactnumber,
      teacher_userlevel: teacher_userlevel,
      teacher_department: teacher_department,
      teacher_rank: teacher_rank,
      action: "action_addTeacher",
    },
    success: function (response) {
      if (response == 1) {
        alert(response);
      } else if (response == 0) {
        alert(response);
      }
      else {
        document.getElementById('teacherbox_data').style.display = "block";
        $('#teacherbox_data').append(response);
        $('#addteacherbox').find('input').val('');
      }
    }
  })
}

function editteacher() {
  $(".editteacherbox").slideToggle();
}

//edit data -get data and display to editForm
$(document).on('click', '.editteacher', function () {
  var teacher_id = $(this).attr("id");
  $.ajax({
    url: "../../sql/teacherdata_sql.php",
    method: "POST",
    data: {
      teacher_id: teacher_id,
      action: "action_getData_Edit",
    },
    dataType: "json",
    success: function (data) {
      $('#put_teacher_id').val(teacher_id);
      $('#put_teacher_email').val(data.teacher_email);
      $('#put_teacher_firstname').val(data.teacher_firstname);
      $('#put_teacher_middlename').val(data.teacher_middlename);
      $('#put_teacher_lastname').val(data.teacher_lastname);
      $('#put_teacher_contactnumber').val(data.teacher_contactnumber);
      $('#put_teacher_department').val(data.teacher_department);
      $('#put_teacher_rank').val(data.teacher_rank);
    }
  });
});

//edit data -submit 
$(document).on('submit', '#updateTeacher', function (e) {
  e.preventDefault();
  e.disabled = true;
  var teacher_id = document.getElementById('put_teacher_id').value;
  var teacher_email = document.getElementById('put_teacher_email').value;
  var teacher_firstname = document.getElementById('put_teacher_firstname').value;
  var teacher_middlename = document.getElementById('put_teacher_middlename').value;
  var teacher_lastname = document.getElementById('put_teacher_lastname').value;
  var teacher_contactnumber = document.getElementById('put_teacher_contactnumber').value;
  var teacher_department = document.getElementById('put_teacher_department').value;
  var teacher_rank = document.getElementById('put_teacher_rank').value;

  $.ajax({
    method: "POST",
    url: "../../sql/teacherdata_sql.php",
    cache: false,
    data: {
      teacher_id: teacher_id,
      teacher_email: teacher_email,
      teacher_firstname: teacher_firstname,
      teacher_middlename: teacher_middlename,
      teacher_lastname: teacher_lastname,
      teacher_contactnumber: teacher_contactnumber,
      teacher_department: teacher_department,
      teacher_rank: teacher_rank,
      action: "action_updateTeacherdata",
    },
    success: function (response) {
      if (response == 1) {
        message('success', 'Updated Successfully.');
      } else if (response == 0) {
        message('delete', 'Failed to Update the data.');
      }
      else {
        alert(response);
      }
    }
  });
});

function deleteTeacher(teacher_id) {
  $(document).ready(function () {
    $.ajax({
      // Action
      url: '../../sql/teacherdata_sql.php',
      // Method
      type: 'POST',
      data: {
        // Get value
        teacher_id: teacher_id,
        action: "action_deleteTeacher"
      },
      success: function (response) {
        // Response is the output of action file
        if (response == 1) {
          document.getElementById(teacher_id).style.display = "none";
          message('delete', 'Deleted teacher successfully');
        }
        else if (response == 0) {
          alert("Data Cannot Be Deleted");
        }
      }
    });
  });
}

function assignButton() {
  $(".assignTeachers").slideToggle();
}

function showAddSection() {
  $(".addSectionform").slideToggle();
}

//update enrollment status in enrollment table --it is like a toggle

function approved(enrollment_id) {

  $(document).ready(function () {
    $.ajax({
      url: '../../sql/enrolledstudentdata_sql.php',
      type: 'POST',
      data: {
        enrollment_id: enrollment_id,
        action: "action_approvedPending"
      },
      success: function (response) {
        if (response == 1) {
          message('success', 'ID ' + enrollment_id + ' Approved');
          document.getElementById(enrollment_id).style.display = "none";

        }
        else if (response == 0) {
          message('success', 'ID ' + enrollment_id + ' Pending');
          document.getElementById(enrollment_id).style.display = "none";
        }


        else if (response == 5) {
          message('success', 'ID ' + enrollment_id + ' Approved' + response);
          document.getElementById(enrollment_id).style.display = "none";

        }


      }
    });
  });

}

function enroll() {

  $(document).on('submit', '#enrollmentForm', function (e) {
    e.preventDefault();
    e.disabled = true;


    $.ajax({
      method: "POST",
      url: "enrollstudent.php",
      cache: false,
      data: $(this).serialize(),
      success: function (response) {
        if (response == 0) {
          document.getElementById('enrollment-message').innerHTML = "Success!";
          document.getElementById('enrollment-message').style.color = "blue";
          message('success', 'You enrolled Successfully');


        } else if (response == 1) {
          document.getElementById('enrollment-message').innerHTML = "You are already enrolled";
          document.getElementById('enrollment-message').style.color = "red";
        } else if (response == 2) {
          document.getElementById('enrollment-message').innerHTML = "Full already";
          document.getElementById('enrollment-message').style.color = "red";
        } else {
          document.getElementById('enrollment-message').innerHTML = "Select section";
          document.getElementById('enrollment-message').style.color = "red";
        }


      }
    });
  });

}

function asd(id) {
  $("#yourBox_" + id).slideToggle();
}

//add section
function addSec() {
  $(document).off().on('submit', '#addsectionForm', function (e) {
    e.preventDefault();
    e.disabled = true;

    $.ajax({
      method: "POST",
      url: "../../sql/sectiondata_sql.php",
      data: $(this).serialize(),
      success: function (response) {
        if (response == 0) {
          message('success', 'Created Section Successfully.');
        }
        else {
          message('delete', response);
        }
      }
    });
  });
}
//delete section
function deleteSection(section_id) {
  $(document).ready(function () {
    $.ajax({
      // Action
      url: '../../sql/sectiondata_sql.php',
      // Method
      type: 'POST',
      data: {
        // Get value
        section_id: section_id,
        action: "action_deleteSection"
      },
      success: function (response) {
        // Response is the output of action file
        if (response == 1) {
          document.getElementById(section_id).style.display = "none";
          message('success', 'Deleted Section Successfully.');
        }
        else {
          alert('fasdwqe');
        }
      }
    });
  });
}

function editbuttonsection(section_id) {
  $(".updateSection").slideToggle();
  $.ajax({
    url: "../../sql/sectiondata_sql.php",
    method: "POST",
    data: {
      section_id: section_id,
      action: "action_getsectionData",
    },
    dataType: "json",
    success: function (data) {
      $('#editsection_id').val(section_id);
      $('#editsection_schoolyear').val(data.schoolyear);
      $('#editsection_yearsection').val(data.yearsection);
      $('#editsection_qty').val(data.max_qty);
      $('#get_section_course').val(data.section_course);

    }

  });
}

$(document).on('submit', '#updatesectionForm', function (e) {
  e.preventDefault();
  e.disabled = true;

  $.ajax({
    method: "POST",
    url: "../../sql/sectiondata_sql.php",
    cache: false,
    data: $(this).serialize(),
    success: function (response) {
      if (response == 1) {
        message('success', 'Updated the section successfully.');
      } else if (response == 0) {
        toastr.erorr('failed.');
      }


    }
  });
});

//re-assign teachers
function reAssigned(section_subjectId) {

  $("#reassignedTeacher").slideToggle();
  $.ajax({
    url: "../../sql/sectiondata_sql.php",
    method: "POST",
    data: {
      section_subjectId: section_subjectId,
      action: "getDataTeacher",
    },
    dataType: "json",
    success: function (data) {
      $('#section').html(data.section_course + data.yearsection + data.subject + ' ' + data.schoolyear);
      $('#reassign_id').val(data.section_subjectId);
      $('#new_teacher').val(data.teacher_id);

      $('#teacher_id').val(data.teacher_id);
      $('#section_id').val(data.section_id);
    }
  });
}
$(document).on('submit', '#new_reassignteacher', function (e) {
  e.preventDefault();
  e.disabled = true;
  var reassign_id = document.getElementById('reassign_id').value;
  var section_id = document.getElementById('section_id').value;
  var teacher_id = document.getElementById('teacher_id').value;
  var new_teacher = $('#new_teacher option:selected').val();

  $.ajax({
    method: "POST",
    url: "../../sql/sectiondata_sql.php",
    cache: false,
    data: {
      reassign_id: reassign_id,
      section_id: section_id,
      teacher_id: teacher_id,
      new_teacher: new_teacher,
      action: "action_reassignTeacher",
    },
    success: function (response) {
      if (response == 1) {
        message('success', 'Reassigned teacher successfully.');
      }
      else {
        message('delete', 'Oops, there is an error');
      }


    }
  });

})

//not using this for now, on this code 705 to 754
//re assign adviser
function reAdviser(section_id) {
  $("#reassignedAdviser").slideToggle();
  var aa = $(this).attr("id");
  $.ajax({
    url: "../../sql/sectiondata_sql.php",
    method: "POST",
    data: {
      section_id: section_id,
      action: "action_getDataAdviser",
    },
    dataType: "json",
    success: function (data) {
      $("#adviser_section_id").val(data.section_id);
      $('#new_adviser').val(data.adviser_id);
      $('#advsy').val(data.schoolyear_assign);
    }
  });
}

$(document).on('click', '#submit-reassignedAdviser', function (e) {
  e.preventDefault();
  e.disabled = true;

  var adviser_section_id = document.getElementById('adviser_section_id').value;
  var new_adviser = document.getElementById('new_adviser').value;
  var adv_sy = document.getElementById('advsy').value;

  $.ajax({
    url: "../../sql/sectiondata_sql.php",
    method: "POST",
    data: {
      adviser_section_id: adviser_section_id,
      new_adviser: new_adviser,
      adv_sy: adv_sy,
      action: "action_reassignAdviser",
    },
    success: function (response) {
      if (response == 1) {
        message('success', 'Adviser reassigned successfully');
      }
      else if (response == 2) {
        message('delete', 'The adviser you selected is already assigned to other section.');
      }
      else {
        message('delete', response);
      }
    }
  })

})

//filter for teachers
$(document).on('change', '#selectDepartment', function () {
  filterTeacher();
});
$(document).on('change', '#selectTeacher_rank', function () {
  filterTeacher();
});

$(document).on('keyup', '#searchTeacher', function () {
  filterTeacher();
});

function filterTeacher() {
  var selectedDepartment = $('#selectDepartment option:selected').val();
  var selectedTeacher_rank = $('#selectTeacher_rank option:selected').val();
  var searchTeacher = document.getElementById('searchTeacher').value;
  $.ajax({
    method: "POST",
    url: "displayTeachers.php",
    data: {
      action: "search",
      selectedDepartment: selectedDepartment,
      selectedTeacher_rank: selectedTeacher_rank,
      searchTeacher: searchTeacher,
    },
    success: function (response) {
      $('#myTable').html(response);
    }

  })
}

//filter for students
$(document).on('change', '#selectYear', function () {
  filterStudents();
});
$(document).on('keyup', '#searchStudent', function () {
  filterStudents();

});

function filterStudents() {
  var selectedYear = $('#selectYear option:selected').val();
  var searchStudent = $('#searchStudent').val();
  $.ajax({
    method: "POST",
    url: "displayStudent.php",
    data: {
      action: "search_students",
      selectedYear: selectedYear,
      searchStudent: searchStudent,
    },
    success: function (data) {
      $('#myTable').html(data);
    }
  })
}

function openUpload(section_id) {

  $('#section_id').val(section_id);
  $(".openUpload").slideToggle();

}

function adminEditForm() {
  $(".editAdmin").slideToggle();
}

$(document).on('click', '.adminEdit', function () {
  var admin_id = $(this).attr("id");
  $.ajax({
    url: "getadmininfo.php",
    method: "POST",
    data: { admin_id: admin_id },
    dataType: "json",
    success: function (response) {
      $('#admin_id').val(admin_id);
      $('#admin_email').val(response.email);
      $('#admin_firstname').val(response.firstname);
      $('#admin_middlename').val(response.middlename);
      $('#admin_lastname').val(response.lastname);
      $('#admin_schoolyear').val(response.schoolyear);
    }
  });
});

$(document).on('submit', '#updateAdmin', function (e) {
  e.preventDefault();
  e.disabled = true;
  $.ajax({
    method: "POST",
    url: "updateadmin.php",
    cache: false,
    data: $(this).serialize(),
    success: function (response) {
      if (response == 1) {
        message('success', 'Updated Info successfully');
      }
      else {
        alert(response);
      }
    }
  });
});

function showEnrolee(status) {
  $.ajax({
    method: "POST",
    url: "displayEnrollees.php",
    data: {
      action: "search_please",
      selectedStatus: status,

    },
    success: function (data) {
      $('#myTable').html(data);
    }
  })
}

$(window).on('load', function () {
  setTimeout(function () {
    $('#loading').hide();
  }, 2000);
})

//navbar right side -slide
function nav_rightSlide() {
  var ssbar = $('#student_sidebar').css("width");
  var windowSize = window.innerWidth;
  if (ssbar == "250px" && windowSize > 800) {
    document.getElementById('student_sidebar').style.width = "0px";
    document.getElementById('studentwrapper').style.marginLeft = "0px";
    document.getElementById('link_sidebar').style.display = "none";
    document.getElementById('logout_sidebar').style.display = "none";
  }
  else if (ssbar == "0px" && windowSize > 800) {
    document.getElementById('student_sidebar').style.width = "250px";
    document.getElementById('studentwrapper').style.marginLeft = "250px";
    document.getElementById('link_sidebar').style.display = "block";
    document.getElementById('logout_sidebar').style.display = "block";
  }
  else if (ssbar == "250px" && windowSize < 800) {
    document.getElementById('student_sidebar').style.width = "0px";
    document.getElementById('studentwrapper').style.marginLeft = "0px";
    document.getElementById('link_sidebar').style.display = "none";
    document.getElementById('logout_sidebar').style.display = "none";
  }
  else if (ssbar == "0px" && windowSize < 800) {
    document.getElementById('student_sidebar').style.width = "250px";
    document.getElementById('student_sidebar').style.zIndex = "1";
    document.getElementById('link_sidebar').style.display = "block";
    document.getElementById('logout_sidebar').style.display = "block";
  }
}

//need lagyan sa mobile w9 ka lang
$(document).on('click', '#teachernav_rightSlide', function () {
  var ssbar = $('#teacher_sidebar').css("width");
  var windowSize = window.innerWidth;
  if (ssbar == "250px" && windowSize > 800) {
    document.getElementById('teacher_sidebar').style.width = "0px";
    document.getElementById('teacherwrapper').style.marginLeft = "0px";
    document.getElementById('tlink_sidebar').style.display = "none";
    document.getElementById('tlogout_sidebar').style.display = "none";
  } else if (ssbar == "0px" && windowSize > 800) {
    document.getElementById('teacher_sidebar').style.width = "250px";
    document.getElementById('teacherwrapper').style.marginLeft = "250px";
    document.getElementById('tlink_sidebar').style.display = "block";
    document.getElementById('tlogout_sidebar').style.display = "block";
  }
  else if (ssbar == "250px" && windowSize < 800) {
    document.getElementById('teacher_sidebar').style.width = "0px";
    document.getElementById('teacherwrapper').style.marginLeft = "0px";
    document.getElementById('link_sidebar').style.display = "none";
    document.getElementById('logout_sidebar').style.display = "none";
  }
  else if (ssbar == "0px" && windowSize < 800) {
    document.getElementById('teacher_sidebar').style.width = "250px";
    document.getElementById('teacher_sidebar').style.zIndex = "1";
    document.getElementById('link_sidebar').style.display = "block";
    document.getElementById('logout_sidebar').style.display = "block";
  }

})

function addinputboxButton() {
  var boxNum = document.getElementById('addinput').value;
  $('#addinput').val(1);
  var x = 0;

  for (x; x < boxNum; x++) {
    var input_id = parseInt($('#totalnew_input').val()) + 1;
    var new_input = "<tr id='new_" + input_id + "'><td><input type='button'class='removeInput' id='new_" + input_id + "' value='x'>Story</td><td><textarea name='story[]'style='width:300px;height:100px;'></textarea></td></tr><br>";
    $('#newsTable').append(new_input);
  }
}

function addImages() {
  var boxNum = document.getElementById('addimage').value;
  var x = 0;
  for (x; x < boxNum; x++) {
    var file_id = parseInt($('#totalnew_file').val()) + 1;
    var new_inputFile = "<div id='file_" + file_id + "'><input type='button'class='removeFile'id='file_" + file_id + "' value='x'><input type='file' name='image[]'></div>";
    $('.boxFile').append(new_inputFile);

    $('#totalnew_file').val(file_id);
  }
}

/*

//add news ajax submission
$(document).on('submit','#addnewsForm',function(e) {
e.preventDefault();
e.disabled = true;

$.ajax({
  method:"POST",
  url: "sqlnews.php",
  cache:false,
  data:$(this).serialize(),
  success:function(response) {
    if(response == 1) {
      $('#addnewsForm').find('#headline').val('');
      $('#addnewsForm').find('textarea').val('')
      alert('Added News Successfully');
    }else if(response == 2) {
      alert('Failed to add News.');
    }
    else{
      alert(response);
    }
    

  }
});
});
*/

function deleteNews(news_id) {
  $.ajax({
    method: "POST",
    url: "deletenews.php",
    data: {
      news_id: news_id,
      action: "action_deletenews",
    },
    success: function (response) {
      if (response == 1) {
        document.getElementById(news_id).style.display = "none";
        alert(news_id);

      }
      else {
        alert('ewqewq');
      }
    }
  })
}

function poa() {
  alert('ewqe');
}

//navbar ng admin
function adminnav_rightSlide() {
  var ssbar = $('#admin_sidebar').css("width");
  var windowSize = window.innerWidth;
  if (ssbar == "250px" && windowSize > 800) {
    document.getElementById('admin_sidebar').style.width = "0px";
    document.getElementById('wrap').style.marginLeft = "0px";
    document.getElementById('adminlink_sidebar').style.display = "none";
    document.getElementById('adminlogout_sidebar').style.display = "none";
  }
  else if (ssbar == "0px" && windowSize > 800) {
    document.getElementById('admin_sidebar').style.width = "250px";
    document.getElementById('wrap').style.marginLeft = "250px";
    document.getElementById('adminlink_sidebar').style.display = "block";
    document.getElementById('adminlogout_sidebar').style.display = "block";
  }
  else if (ssbar == "250px" && windowSize < 800) {
    document.getElementById('admin_sidebar').style.width = "0px";
    document.getElementById('wrap').style.marginLeft = "0px";
    document.getElementById('adminlink_sidebar').style.display = "none";
    document.getElementById('adminlogout_sidebar').style.display = "none";
  }
  else if (ssbar == "0px" && windowSize < 800) {
    document.getElementById('admin_sidebar').style.width = "250px";
    document.getElementById('wrap').style.zIndex = "0";
    document.getElementById('adminlink_sidebar').style.display = "block";
    document.getElementById('adminlogout_sidebar').style.display = "block";
  }
}

function addSubject_button() {
  var newSubject = document.getElementById('newSubject').value;
  var subjectCode = document.getElementById('subjectCode').value;
  var description = document.getElementById('description').value;
  if (newSubject == "" || subjectCode == "" || description == "") {
    alert('Enter Needed Data');
  }
  else {
    $.ajax({
      method: "POST",
      url: "subjectsql.php",
      data: {
        newSubject: newSubject,
        subjectCode: subjectCode,
        description: description,
        action: "action_addSubject",
      },
      success: function (response) {
        if (response == 0) {
          alert('Oops, You added this section already');
        }
        else {
          $('#po').append(response);
          $('#newSubject').val('');
          $('#description').val('');
          message('success', 'Added Successfully');
        }

      }
    });
  }
}

function deleteSubject(subject_id) {

  $.ajax({
    method: "POST",
    url: "subjectsql.php",
    data: {
      subject_id: subject_id,
      action: "deleteSubject",
    },
    success: function (response) {
      if (response == 1) {
        document.getElementById(subject_id).style.display = "none";
      }
      else {
        alert(response);
      }
    }
  })
}

function addselectSection() {
  var i = 0;
  var num_select = document.getElementById('num_section_select').value;

  var original = document.getElementById('addsection_select');
  var clone = original.cloneNode(true); // "deep" clone
  clone.id = "num_section_select" + ++i;
  original.parentNode.appendChild(clone);
}

function dropSubject(enrolled_subject_id) {
  $.ajax({
    method: "POST",
    url: "../../sql/enrolledstudentdata_sql.php",
    data: {
      enrolled_subject_id: enrolled_subject_id,
      action: "action_drop",
    },
    success: function (response) {
      if (response == 1) {
        message('success', 'You dropped the subject successfully.');
        document.getElementById(enrolled_subject_id).style.display = "none";
      }
      else {
        alert(response);
      }
    }
  })
}

function addAgain_subject(enrolled_subject_id) {
  $.ajax({
    method: "POST",
    url: "../../sql/enrolledstudentdata_sql.php",
    data: {
      enrolled_subject_id: enrolled_subject_id,
      action: "action_addAgain",
    },
    success: function (response) {
      if (response == 1) {
        message('success', 'You have added the subject successfully.');
        document.getElementById(enrolled_subject_id).style.display = "none";
      }
      else {
        message('delete', response);
      }
    }
  })
}

function adddrop_addSubject(section_subjectId) {
  var student_number = document.getElementById('student_number').value;
  var student_schoolyear = document.getElementById('student_schoolyear').value;
  var student_eId = document.getElementById('student_eId').value;
  $.ajax({
    method: "POST",
    url: "../../sql/enrolledstudentdata_sql.php",
    data: {
      section_subjectId: section_subjectId,
      student_number: student_number,
      student_schoolyear: student_schoolyear,
      student_eId: student_eId,
      action: "action_adddrop_addSubject",
    },
    success: function (response) {
      if (response == 1 || response == 2) {
        message('success', 'You have added the subject successfully.');
      }
      else {
        message('delete', response);
      }

    }
  })
}

function deleteEnrolled_student(id) {
  var section_id = document.getElementById('sec_id').value;
  $.ajax({
    method: "POST",
    url: "../../sql/sectiondata_sql.php",
    data: {
      id: id,
      section_id: section_id,
      action: "action_deleteEnrolled_student",
    },
    success: function (response) {
      if (response == 1) {
        document.getElementById(id).style.display = "none";
        message('delete', 'Unenrolled student successfully11.');
      } else {
        alert(response);
      }
    }
  })
}

function adminEnroll_student(student_id) {
  var yearsection = document.getElementById('yearsection').value;
  var section_id = document.getElementById('sec_id').value;
  var syear = document.getElementById('syear').value;
  $.ajax({
    method: "POST",
    url: "../../sql/sectiondata_sql.php",
    data: {
      yearsection: yearsection,
      section_id: section_id,
      syear: syear,
      student_id: student_id,
      action: "action_adminEnroll_student",
    },
    success: function (response) {
      if (response == 1) {
        document.getElementById(student_id).style.display = "none";
        message('success', 'Enrolled student successfully.');
      } else {
        alert(response);
      }
    }
  })
}

// showhiddennavLink
function showhiddennavLink() {
  $('#hiddenLink').slideToggle();

}

function subjectCoursenav() {
  $('#subjectCourse').slideToggle();

}

function addCourse_button() {
  var newCourse = $('#newCourse').val();
  var courseDescription = $('#courseDescription').val();
  if (newCourse != "" && courseDescription != "") {
    $.ajax({
      method: "POST",
      url: "subjectsql.php",
      data: {
        newCourse: newCourse,
        courseDescription: courseDescription,
        action: "action_addCourse",
      },
      success: function (response) {
        if (response == 1) {
          message('delete', 'Failed to add the section.');
        } else {
          message('success', 'Course Added successfully.');
          $('#wrap').find('input').val('');
          $('.table').append(response);

        }
      }
    })
  } else {
    alert('Input Data!');
  }
}

function deleteCourse(course_id) {
  $.ajax({
    method: "POST",
    url: "subjectsql.php",
    data: {
      course_id: course_id,
      action: "action_deleteCourse",
    },
    success: function (response) {
      if (response == 1) {
        alert('error');
      } else {
        message('success', 'Course ' + response + ' Deleted successfully.');
        document.getElementById(course_id).style.display = "none";
      }
    }
  })
}

$(document).on('click', '.gq', function () {
  alert('ewq');
})

function userActivate(id) {
  $.ajax({
    method: "POST",
    url: '../../sql/studentdata_sql.php',
    data: {
      student_id: id,
      action: "action_studentActivation_toggle",
    },
    success: function (response) {
      if (response == 2) {
        document.getElementById('btn.' + id).className = "bluewhitebutton";
        document.getElementById('btn.' + id).innerHTML = 'ACTIVATED';
      }
      else if (response == 1) {
        document.getElementById('btn.' + id).className = "redblackButton";
        document.getElementById('btn.' + id).innerHTML = 'DEACTIVATED';
      }
      else {
        alert("Unexpected error" + response);
      }
    }
  })
}

function studentLogin() {
  var email = $('#studentEmail').val();
  var password = $('#studentPassword').val();
  $.ajax({
    method: "POST",
    url: "login_sql.php",
    data: {
      email: email,
      password: password,
      action: "student_login",
    },
    success: function (response) {
      if (response == 1) {
        document.getElementById('incorrectPassword').innerHTML = 'Incorrect Password';
        $('.loginBox').find('#studentPassword').val('');
      } else if (response == 2) {
        document.getElementById('invalidEmail').innerHTML = 'Invalid Email';
        $('.loginBox').find('input').val('');
      }
      else if (response == 4) {
        document.getElementById('incorrectPassword').innerHTML = 'Your account is deactivated by the admin.';
      }
      else {
        location.href = response;
      }
    }
  })
}

function teacherLogin() {
  var email = $('#teacherEmail').val();
  var password = $('#teacherPassword').val();
  $.ajax({
    method: "POST",
    url: "login_sql.php",
    data: {
      email: email,
      password: password,
      action: "teacher_login",
    },
    success: function (response) {
      if (response == 1) {
        document.getElementById('teacher_incorrectPassword').innerHTML = 'Incorrect Password';
        $('.loginBox').find('#teacherPassword').val('');
      } else if (response == 2) {
        document.getElementById('teacher_invalidEmail').innerHTML = 'Invalid Email';
        $('.loginBox').find('input').val('');
      }
      else if (response == 4) {
        document.getElementById('incorrectPassword').innerHTML = 'Your account is deactivated by the admin.';
      }
      else {
        location.href = response;
      }
    }
  })
}

$(document).on('click', '#teacher_changePassword', function () {
  var oldPassword = $('#teacher_oldPassword').val();
  var newPassword = $('#teacher_newPassword').val();
  var verifynewPassword = $('#teacher_verifynewPassword').val();
  var teacher_id = document.getElementById('teacher_id').value;

  if (newPassword != verifynewPassword) {
    alert('New password does not matched');
  }
  else {
    $.ajax({
      method: "POST",
      url: "../teacher/thisTeacher_sql.php",
      data: {
        oldPassword: oldPassword,
        newPassword: newPassword,
        verifynewPassword: verifynewPassword,
        teacher_id: teacher_id,
        action: "teacher_changePassword",
      },
      success: function (response) {
        alert(response);
      }

    })

  }
})

$(document).on('keyup', '#teacher_newPassword', function () {
  var newPassword = document.getElementById('teacher_newPassword').value;
  var verify_newPassword = document.getElementById('teacher_verifynewPassword').value;
  if (newPassword == verify_newPassword) {
    document.getElementById('teacher_new_compareMessage').style.color = "black";
    document.getElementById('teacher_new_compareMessage').innerHTML = "Password matched";

    document.getElementById('teacher_verify_compareMessage').style.color = "black";
    document.getElementById('teacher_verify_compareMessage').innerHTML = "Password matched";

  } else {
    document.getElementById('teacher_new_compareMessage').style.color = "red";
    document.getElementById('teacher_new_compareMessage').innerHTML = "Password not matched";

    document.getElementById('teacher_verify_compareMessage').style.color = "red";
    document.getElementById('teacher_verify_compareMessage').innerHTML = "Password not matched";

  }
})
$(document).on('keyup', '#teacher_verifynewPassword', function () {
  var newPassword = document.getElementById('teacher_newPassword').value;
  var verify_newPassword = document.getElementById('teacher_verifynewPassword').value;
  if (newPassword == verify_newPassword) {
    document.getElementById('teacher_new_compareMessage').style.color = "black";
    document.getElementById('teacher_new_compareMessage').innerHTML = "Password matched";

    document.getElementById('teacher_verify_compareMessage').style.color = "black";
    document.getElementById('teacher_verify_compareMessage').innerHTML = "Password matched";
  } else {
    document.getElementById('teacher_verify_compareMessage').style.color = "red";
    document.getElementById('teacher_verify_compareMessage').innerHTML = "Password not matched";

    document.getElementById('teacher_verify_compareMessage').style.color = "red";
    document.getElementById('teacher_verify_compareMessage').innerHTML = "Password not matched";

  }
})

$(document).on('click', '#editTeacherprofile', function () {
  var teacher_id = $('#teacher_id').val();
  alert(teacher_id);
})