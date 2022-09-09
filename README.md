# school
school management system

This is a school management system for a senior high school, but is easy to convert into college by just changing some data and codes.
Scenario: Once the student passed the entrance exam/once they are accepted to the school, 
they will be ask to go to Technical office of the school and the admin will create their 
account just by entering the data of the student, the email, student number and password(qwerty123) is auto generated. 
The student should wait for the announcement of the schedule of their enrollment. After they successfully enrolled, 
their data will be stored to the database of the system.

Userlevel: Admin Student Teacher
Functionalities for Admin: Create Student account, Edit info of student, Deactivate/Activate student account, delete student account.
Auto generated email and student number. formula for studentNumber(last 2number of schoolyear 2022-2023=2223, and created number of student in that schoolyear+1)
(for example, we have 3accounts in the database schoolyear 2022-2023, the student number of next account created would be 2223-4)
formula foremail(first letter of first name + dot(.) + lastname + 234(check the example of student number in line 18)+@school.com =l.tuazon234@school.com
(Lets assume that the first name is Lester and the last name is Tuazon))
Create Teacher account, Edit info of teacher, Deactivate/Activate teacher account, delete teacher account. 
Create course and subject, update, and delete. 
Create section with setting start time and end time of enrollment, update, and delete. 
Approve students who enrolled for the schoolyear. 
By approving, the data(subject) of that section will be sent to another table in database(enrolled_subject) with the information of the student. 
Once approved, the admin could not make it to pending status again. 
Can enroll the student who could not have the chance to enroll on the set time. 
Can add and drop subject of each student that they enrolled. 
(Example: STEM1A-ENGLISH ADDED, you can't add STEM1B-ENGLISH because the student already had an english subject.
Example: Once you dropped the one subject, it will be listed to the drop table and you are still able to add it back unless you added the same subject.) 
Can view the enrolled section with subject and grades of students(student copy of grades) in a pdf file. 
Can view who are the enrolled on the section and who are those student that did not enrolled in any section but qualified for that section. 
Can assign adviser in section, one advisory class per teacher is allowed per schoolyear. 
Can assign and re-assign teachers per subject.
Can add news, update and delete. 
The news has a headline, image header, automatic one textarea for the content body but you can add multiple text area depending on the news
you are going to post, same with the gallery picture. The viewing of views is set in just one design view.

Functionalities for Teacher: 
Can view the handle section and the students they are going to handle for that subject. 
Can view the section for their advisory class and the students enrolled on the section.
Can upload excel file for adding/updating grades of the student.

Functionalities for Student: 
Can view the sections that are matched to their yearlevel. 
If they are enrolled already, the viewing for enrollment view must be "Congrats (name), Please wait for the approval." 
Cannot enroll in multiple section. 
When a student enrolled to a section, the quantity of the student that are enrolled on the section must add 1,
once it get matched to the max quantity, the student cannot enrolled to that section anymore. 
Can view their registration per section/schoolyear. 
Can view their grades per section/schoolyear. 
Can view profile, update own profile info, and change password.

Note: There is a chance that I could not write other info in here. This is a personal project only for my portfolio
and there is no school using this web application.

Note Again: There are codes that are still in the css and js file that I did not use due to changes that I made
during the development. (example: a class for this design, a function for this event)

Video Demo Link: https://drive.google.com/file/d/1Wzc4ajXDQzkNLDfyKTAXwPUzqKx6lLRQ/view?usp=sharing

