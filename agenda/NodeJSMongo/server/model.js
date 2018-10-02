const mongoose = require('mongoose')

const Schema = mongoose.Schema

let eventSchema = new Schema({

  idUsuario: { type: String, required: true},
  titulo: { type: String, required: true},
  inicio: { type: String, required: true},
  final: { type: String, required: true}

})

let eventModel = mongoose.model('Evento', eventSchema)

let UserSchema = new Schema({
  userId: { type: String, required: true, unique: true},
  nombres: { type: String, required: true},
  contrasena: { type: String, required: true},
  nacimiento: { type: String, required: true}
})

let UserModel = mongoose.model('Usuario', UserSchema)


module.exports = {eventModel, UserModel};