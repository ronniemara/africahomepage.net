
const path = require('path');
module.exports = {
    entry: './public/js/main.js',
    output: {
        filename: 'public/js/bundle.js',
        publicPath: "http://localhost:8081/"
    },
    devtool: 'source-map',
    module: {
        loaders:[
            { test: /\.css$/, loader: 'style!css!'}           
        ]
    },    
    resolveLoader: {
      moduleDirectories: "http://localhost:8081/node_modules"
    } 
};

