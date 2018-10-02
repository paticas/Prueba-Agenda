const Router = require('express').Router();
const model = require('./model.js')

var sesion = "";

//login de usuarios
Router.post('/login', function(req, res) {
    model.UserModel.findOne({userId: req.body.user, contrasena: req.body.pass}).exec(function(err, docs) {
         if (err) {
             res.status(500)
             console.log("error");
             res.json(err)
         }
         //console.log(docs);
         if(docs != null){
           sesion = req.body.user;
           res.send("Validado");
         }else{
           sesion = ""
          res.send("No Validado");
         }
   })
})

//Obtener todos los eventos
Router.get('/all', function(req, res) {
    model.eventModel.find({idUsuario: sesion}).exec(function(err, docs) {
        if (err) {
            res.status(500)
            res.json(err)
        }
        //console.log(docs);
        var respuesta = [];
        for(var i = 0; i < docs.length; i++){
          respuesta[i] = {id:docs[i]._id, title:docs[i].titulo, start:docs[i].inicio, end:docs[i].final}
        }
        //console.log(respuesta);
        res.json(respuesta)
    })
})

//Nuevo evento
Router.post('/new', function(req, res) {
  if(sesion != ""){
    console.log(req.body.title + " " + req.body.start + " " + req.body.end);
    var newEvent = new model.eventModel({idUsuario: sesion, titulo:req.body.title, inicio:req.body.start, final:req.body.end});

    newEvent.save((error)=>{
      if(error){
        res.status(500)
        console.log(error);
        res.json(error)
      }else{
        res.send("Agregado");
      }
    })

  }else{
    res.send("Inicia Sesion Primero");
  }
})

//Eliminar evento
Router.post('/delete', function(req, res) {
  console.log(req.body.id);
  model.eventModel.remove({_id:req.body.id}, (error)=>{
    if(error){
      res.status(500)
      console.log(error);
      res.json(error)
    }else{
      res.send("Eliminado");
    }
  })
})

//Editar evento
Router.post('/update', function(req, res) {
  console.log(req.body.id + " " + req.body.start + " " + req.body.end);
  model.eventModel.findOneAndUpdate({_id:req.body.id}, {inicio:req.body.start, final:req.body.end}, function(err, doc){
    if (err) return res.send(500, { error: err });
    return res.send("Actualizado");
  })
})

module.exports = Router