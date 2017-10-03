function connect(ip, port) {

  let adresse = ip+":"+port;
  return new WebSocket("ws://"+adresse);

}


var socket = connect(ip,port);


socket.on("message", function(event) {

  var data = JSON.parse(event.data);
  translated = translate(data);
})
