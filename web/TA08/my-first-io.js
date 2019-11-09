const fs = require('fs')
let filename = process.argv[2]
var content = fs.readFileSync(filename)

let array = content.toString().split('\n')
let number = array.length - 1

console.log(number)