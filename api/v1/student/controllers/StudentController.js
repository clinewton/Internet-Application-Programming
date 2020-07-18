const models = require('../models');

exports.newStudent = (req, res, next) => {
    let firstName = req.body.firstName;
    let lastName = req.body.lastName;
    let regDate = new Date();

    models.Student.create({
        firstName: firstName,
        lastName: lastName,
        registrationDate: regDate
    }).then(result => {
        res.send('Student has been created');
    }).catch(error => {
        res.send(error);
    });

}

exports.students = (req, res, next) => {
    models.Student.findAll().then(students => {
        res.send(students);
    }).catch(error => {
        res.status(400).send(error);
    });
}

exports.findStudent = (req, res, next) => {
    let studName = req.body.studName;

    models.Student.findAll({
        where: {
            firstName: studName
        }
    }).then(student => {
        res.send(student);
    }).catch(error => {
        res.status(400).send(error);
    });
}

exports.deleteStudent = (req, res, next) => {
    let studName = req.body.firstName;

    models.Student.destroy({
        where: {
            firstName: studName
        }
    }).then(result => {
        res.send('Student has been deleted!');
    }).catch(error => {
        res.send(error);
    });
}

exports.updateStudent = (req, res, next) => {
    let studID = req.body.studID;
    let newFirstName = req.body.newFirstName;
    let newLastName = req.body.newLastName;

    models.Student.update({
        firstName: newFirstName,
        lastName: newLastName
    }, {
        where: {
            id: studID
        }
    }).then(result => {
        res.send('Student record has been updated');
    }).catch(error => {
        res.send(error);
    });
}