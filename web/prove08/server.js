var http = require('http');
var fs = require('fs');
var add = require('./add.js');

function onRequest(req, res) {
    console.log("req: " + req.url);
    if (req.url === "/home") {
        fs.readFile("home.html", function(error, pgResp) {
            if (error) {
                res.writeHead(404);
                res.write('Page Not Found');
            } else {
                res.writeHead(200, { 'Content-Type': 'text/html' });
                res.write(pgResp);
            }
            res.end();
        });
    } else if (req.url === "/getData") {
        fs.readFile("data.json", function(error, pgResp) {
            if (error) {
                res.writeHead(404);
                res.write('Page Not Found');
            } else {
                res.writeHead(200, { "Content-Type": "application/json" });
                res.write(pgResp);
            }
            res.end();
        });
    }
    if (req.url === "/add") {
        fs.readFile("add.js", function(error, pgResp) {
            if (error) {
                res.writeHead(404);
                res.write('Page Not Found');
            } else {
                res.writeHead(200, { 'Content-Type': 'text/html' });
                res.write("The sum plus: " + pgResp);
                res.end();
            }
        });
    } else {
        res.writeHead(200, { 'Content-Type': 'text/html' });
        res.write('Page Not Found');
        res.end();
    }

}

var server = http.createServer(onRequest);
server.listen(8888);

console.log("The server is working")