const mongoose = require('mongoose')

mongoose.connect('mongodb://localhost/agendaNode')

const Schema = mongoose.Schema

let UserSchema = new Schema({
  userId: { type: String, required: true, unique: true},
  nombres: { type: String, required: true},
  contrasena: { type: String, required: true},
  nacimiento: { type: String, required: true}
})

let UserModel = mongoose.model('Usuario', UserSchema)

var newUser = new UserModel({userId:"frank_santills@hotmail.com", nombres:"Frank Santillan", contrasena:"1234", nacimiento:"1991-12-13"});

newUser.save((error)=>{
  if(error){
    console.log(error);
  }else{
    console.log("Usuario creado");
  }
})