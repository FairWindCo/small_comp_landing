First need install nodeJS

https://nodejs.org/dist/v6.10.0/node-v6.10.0-x64.msi
https://nodejs.org/dist/v7.7.1/node-v7.7.1-x64.msi

Then install less or sass
$ npm install -g less
$ npm install -g sass

Then install gulp or grunt

npm install gulp-cli -g
npm install gulp -D
touch gulpfile.js
gulp --help

then in project dir install
npm install gulp-sass --save-dev

npm install grunt-contrib-less --save-dev


in package.json

{
  
"name": "small_comp_landing",
  
"version": "1.0.0",
  
"description": "Landing page for NKT small computers ",
  
"private": true,
  
"author": "Sergey Manenok",
  
"license": "ISC",  
  
"devDependencies": {
    "autoprefixer": "6.5.3",
    "browser-sync": "2.18.2",
    "gulp": "3.9.1",
    "gulp-plumber": "1.1.0",
    "gulp-postcss": "6.2.0",
    "gulp-sass": "2.3.2",
    "@htmlacademy/editorconfig-cli": "0.1.x"
  },
 
"scripts": {
    "test": "editorconfig-cli",
    "build": "gulp style",
    "start": "gulp serve"
  },
 
"editorconfig-cli": [
    "*.html",
    "*.json",
    "*.js",
    "js/**/*.js",
    "img/**/*.svg",
    "sass/**/*.{sass,scss}"
  ],
  
"engines": {
    "node": "7.7"
  },


  
"repository": {
    "type": "git",
    "url": "https://github.com/FairWindCo/small_comp_landing"
  }

}


in gulpfile.js 

"use strict";

var gulp = require("gulp");
var sass = require("gulp-sass");
var plumber = require("gulp-plumber");
var postcss = require("gulp-postcss");
var autoprefixer = require("autoprefixer");
var server = require("browser-sync").create();

gulp.task("style", function() {
  gulp.src("sass/style.scss")
    .pipe(plumber())
    .pipe(sass())
    .pipe(postcss([
      autoprefixer({browsers: [
        "last 2 versions"
      ]})
    ]))
    .pipe(gulp.dest("css"))
    .pipe(server.stream());
});

gulp.task("serve", ["style"], function() {
  server.init({
    server: ".",
    ghostMode: false,
    notify: false,
    open: true,
    cors: true,
    ui: false,
  });

  gulp.watch("sass/**/*.{scss,sass}", ["style"]);
  gulp.watch("*.html").on("change", server.reload);
}); 