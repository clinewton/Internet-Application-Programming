'use strict';

const fake = require('faker');

module.exports = {
    up: async(queryInterface, Sequelize) => {
        /**
         * Add seed commands here.
         *
         * Example:
         * await queryInterface.bulkInsert('People', [{
         *   name: 'John Doe',
         *   isBetaMember: false
         * }], {});
         */

        let fakeStudents = [];

        for (let i = 0; i < 10; i++) {
            fakeStudents.push({
                firstName: fake.name.firstName(),
                lastName: fake.name.lastName(),
                registrationDate: new Date(),
                createdAt: new Date(),
                updatedAt: new Date()
            });
        }
        await queryInterface.bulkInsert('Students', fakeStudents, {});
    },

    down: async(queryInterface, Sequelize) => {
        /**
         * Add commands to revert seed here.
         *
         * Example:
         * await queryInterface.bulkDelete('People', null, {});
         */
    }
};