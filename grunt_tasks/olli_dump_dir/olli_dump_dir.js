/* olli-dump-dir
 * fork of grunt-dump-dir
 * https://github.com/bpampuch/grunt-dump-dir
 *
 * Copyright (c) 2014 Bartek Pampuch
 * Licensed under the MIT license.
 */

'use strict';

var path = require('path'),
    fs = require('fs'),
    md5file = require('md5-file'),
    base62 = require('base-62.js'),
    imageSize = require('image-size');


module.exports = function (grunt) {
    grunt.registerMultiTask('xxx', 'Grunt task to dump a dictionary (all files, their checksum and image-info) into a JSON object', function () {
        var options = this.options({
            rootPath: '',
            pre: 'module.exports = '
        });
        var imgTypes = {
            "png": "image/png",
            "jpeg": "image/jpeg",
            "jpg": "image/jpg",
            "gif": "image/gif"
        };
        this.files.forEach(function (f) {
            var result = {};
            grunt.log.writeln(f.dest);

            f.src.filter(function (filepath) {
                if (!grunt.file.exists(filepath)) {
                    grunt.log.warn('Source file "' + filepath + '" not found.');
                    return false;
                } else {
                    return !grunt.file.isDir(filepath);
                }
            }).forEach(function (filepath) {
                var key = filepath;

                if (options.rootPath) {
                    if (filepath.indexOf(options.rootPath) === 0) {
                        key = filepath.substring(options.rootPath.length);
                    } else {
                        grunt.warn('rootPath (' + options.rootPath + ') is not root for ' + filepath);
                    }
                }
                var ext = getExtension(filepath),
                    md5 = md5file.sync(filepath),
                    hash = base62.encodeHex(md5),
                    image = getImageInfo(filepath);

                result[key] = {ext: ext, md5: md5, hash: hash, image: image};
            });

            grunt.file.write(f.dest, options.pre + JSON.stringify(result));
            grunt.log.writeln('File "' + f.dest + '" created.');
        });
        function getExtension(filename) {
            var ext = path.extname(filename || '').split('.');
            return ext[ext.length - 1].toLowerCase();
        }

        function getImageInfo(filename) {
            var info = false,
                mime = imgTypes[getExtension(filename)];

            if (mime) {
                try {
                    var size = imageSize(filename);
                    info = {
                        mime: mime,
                        width: size.width,
                    height: size.height
                }
                } catch (err) {
                }
            }
            return info;
        }
    });
};
