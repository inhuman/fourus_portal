var User = require('./User.js');


var vasya = new User.User("Вася");
var petya = new User.User("Петя");

vasya.hello(petya);