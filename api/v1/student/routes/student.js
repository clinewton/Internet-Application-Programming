const express = require('express');
const studentController = require('../controllers/StudentController');

const router = express.Router();

router.post('/student/new', studentController.newStudent);
router.get('/student/all', studentController.students);
router.get('/student/find', studentController.findStudent);
router.get('/student/delete', studentController.deleteStudent);
router.post('/student/update', studentController.updateStudent);

module.exports = router;