const express = require('express');
const routes = require('./routes/student');
const parser = require('body-parser');

const app = express();


app.use(parser.urlencoded({ extended: true }));
app.use(routes);

app.listen('9000');