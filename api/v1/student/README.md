This is an Express Js API withe the following routes:
1.  '/student/all' - this is a get method that is used to get all the student records from the database
2.  '/student/new' - this is a post method that adds new student to the database. It requires the folowing  x-www-form-urlencoded variables in the body: firstName and LastName
3.  '/student/find' - this is a get method used to fetch a specific student record from the database using the student's first name. It requires an x-www-form-urlencoded variable called studName
4.  'student/update/' - this is a post method that updates a student's record. It requires the following x-www-form-urlencoded variables in the body: studID, newFirstName, newLastName. The function updates the record if it finds a record matching the studID number provided.
5.  '/student/delete' - this is a get method that deletes a student's record from the database matching the firstName provided. It requires an x-www-form-urlencoded variable called firstName.