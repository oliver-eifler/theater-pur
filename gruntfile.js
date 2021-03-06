/* olli.web */
module.exports = function (grunt) {
    var rollupString = require('rollup-plugin-string');
    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        banner: '/*! <%= pkg.title || pkg.name %> - v<%= pkg.version %> - ' +
        '<%= grunt.template.today("yyyy-mm-dd") %>\n' +
        '<%= pkg.homepage ? "* " + pkg.homepage + "\\n" : "" %>' +
        '* Copyright (c) <%= grunt.template.today("yyyy") %> <%= pkg.author %>;' +
        ' <%= pkg.license %> License */\n\n',
        dir: {
            release: 'dist',
            build: 'build',
            assets: 'src',
            vendor: 'src/js/vendor'
        },
        /* SVG ICON STUFF */
        svg2png: {
            iconpng: {
                // specify files in array format with multiple src-dest mapping
                files: [
                    // rasterize all SVG files in "img" and its subdirectories to "img/png"
                    {cwd: '<%= dir.assets %>/svg/icons/', src: ['**/*.svg'], dest: '<%= dir.build %>/icons/'}
                ]
            }
        },
        svgstore: {
            iconsvg: {
                options: {prefix: "icon-", includeTitleElement: false},
                files: {
                    '<%= dir.release %>/images/icons.svg': ['<%= dir.build %>/icons/*.svg'],
                },
            },
        },
        /* IMAGE STUFF */
        image: {                          // Task
            images: {                         // Another target
                options: {
                    pngquant: true,
                    optipng: false,
                    zopflipng: true,
                    jpegRecompress: false,
                    jpegoptim: true,
                    mozjpeg: true,
                    gifsicle: true,
                    svgo: false
                },
                files: [{
                    expand: true,                  // Enable dynamic expansion
                    cwd: '<%= dir.assets %>/images/',                   // Src matches are relative to this path
                    src: ['**/*.{png,jpg,gif}'],   // Actual patterns to match
                    dest: '<%= dir.release %>/images/'                  // Destination path prefix
                }]
            },
        },
        responsive_images: {
            thumbs: {
                options: {
                    sizes: [{
                        name: 'thumb',
                        width: 800,
                        quality: 20
                    }]
                },
                files: [{
                    expand: true,
                    src: ['*.{jpg,gif,png}'],
                    cwd: 'images/',
                    dest: '<%= dir.release %>/images/gallery'
                }]
            }
        },
        /* JAVASCRIPT STUFF */
        rollup: {
            options: {
                format: 'iife',
                banner: '<%= banner %>'
            },
            /*
             jsInline: {
             options: {format: 'es'},
             'dest': '<%= dir.build %>/js/inline.js',
             'src': '<%= dir.assets %>/js/inline.js' // Only one source file is permitted
             },
             */
            jsKickstart: {
                options: {
                    moduleName: 'µ'
                },
                'dest': '<%= dir.build %>/js/kickstart.js',
                'src': '<%= dir.assets %>/js/kickstart.js' // Only one source file is permitted
            },
            /*
             jsAsync: {
             options: {
             moduleName: 'olli'
             },
             'dest': '<%= dir.build %>/js/async.js',
             'src': '<%= dir.assets %>/js/async.js' // Only one source file is permitted
             },
             */
            jsSite: {
                options: {
                    plugins: [
                        rollupString({
                            // Required to be specified
                            include: '**/resource/*.{css,svg,txt,html}'
                        })
                    ]
                },
                'dest': '<%= dir.build %>/js/site.js',
                'src': '<%= dir.assets %>/js/site.js' // Only one source file is permitted
            }/*,
             jsFonts: {
             options: {format:'es6'},
             'dest':'<%= dir.build %>/js/fonts.js',
             'src' :'<%= dir.assets %>/js/fonts.js' // Only one source file is permitted
             }*/
        },
        uglify: {
            options: {
                //banner: '<%= banner %>'
            },
            dist: {
                options: {
                    compress: {
                        drop_console: true,
                        global_defs: {
                            'DEBUG': false
                        },
                        dead_code: true
                    }
                },
                files: {
                    '<%= dir.release %>/js/kickstart.js': ['<%= dir.build %>/js/kickstart.js'],
                    //'<%= dir.release %>/js/inline.js': ['<%= dir.build %>/js/inline.js'],
                    //'<%= dir.release %>/js/async.js': ['<%= dir.build %>/js/async.js'],
                    '<%= dir.release %>/js/site.js': ['<%= dir.vendor %>/promise.js', '<%= dir.build %>/js/site.js'],
                    /*polyfills*/
                    //'<%= dir.release %>/js/svgxuse.js': ['<%= dir.components %>/svgxuse.js'],
                    //'<%= dir.release %>/js/promise.js': ['<%= dir.components %>/promise.js']
                }
            },
            dev: {
                options: {
                    mangle: false,
                    compress: false,
                    beautify: true,
                    banner: '<%= banner %>\n/** @const */var DEBUG = true;\n'
                },
                files: {
                    '<%= dir.release %>/js/kickstart.js': ['<%= dir.build %>/js/kickstart.js'],
                    //'<%= dir.release %>/js/inline.js': ['<%= dir.build %>/js/inline.js'],
                    //'<%= dir.release %>/js/async.js': ['<%= dir.build %>/js/async.js'],
                    '<%= dir.release %>/js/site.js': ['<%= dir.vendor %>/promise.js', '<%= dir.build %>/js/site.js'],
                    /*polyfills*/
                    //'<%= dir.release %>/js/svgxuse.js': ['<%= dir.components %>/svgxuse.js'],
                    //'<%= dir.release %>/js/promise.js': ['<%= dir.components %>/promise.js']
                }
            }


        },
        /* Compile SASS to CSS */
        sass: {
            css: {
                options: {
                    style: 'expanded',
                    sourcemap: false
                },
                files: [{
                    expand: true,
                    cwd: '<%= dir.assets %>/scss',
                    src: ['*.scss',"!*.js.scss"],
                    dest: '<%= dir.build %>/css',
                    ext: '.css'
                }]
            },
            js: {
                options: {
                    style: 'expanded',
                    sourcemap: false
                },
                files: [{
                    expand: true,
                    cwd: '<%= dir.assets %>/scss',
                    src: ['!*.scss',"*.js.scss"],
                    dest: '<%= dir.build %>/css',
                    ext: '.js.css'
                }]
            }
        },
        /*POSTCSS*/
        postcss: {
            options: {
                map: false
            },
            dev: {
                options: {
                    processors: [
                        require('pixrem')() // rem to pixel the result
                    ]
                },
                files: [{
                    expand: true,
                    cwd: '<%= dir.build %>/css',
                    src: ['*.css', '!*.min.css','!*.js.css'],
                    dest: '<%= dir.release %>/css',
                    ext: '.css'
                }]
            },
            dist: {
                options: {
                    processors: [
                        require('pixrem')(), // rem to pixel the result
                        require('css-mqpacker')(), // rem to pixel the result

                        require('cssnano')({
                                safe: false,
                                autoprefixer: false,
                                normalizeURL: false,
                                discardComments: {removeAll: true}
                            }
                        ) // minify the result

                    ]
                },
                files: [{
                    expand: true,
                    cwd: '<%= dir.build %>/css',
                    src: ['*.css', '!*.min.css','!*.js.css'],
                    dest: '<%= dir.release %>/css',
                    ext: '.css'
                }]
            },
            js: {
                options: {
                    processors: [
                        require('css-mqpacker')(), // rem to pixel the result
                        require('cssnano')({
                                safe: false,
                                autoprefixer: false,
                                normalizeURL: false,
                                discardComments: {removeAll: true}
                            }
                        ) // minify the result
                    ]
                },
                files: [{
                    expand: true,
                    cwd: '<%= dir.build %>/css',
                    src: ['!*.css', '!*.min.css','*.js.css'],
                    dest: '<%= dir.assets %>/js/resource',
                    ext: '.css'
                }]
            }

        },
        xxx: {
            options: {
                pre: '',
                rootPath:'<%= dir.release %>/'
            },
            dist: {
                files: {
                    '<%= dir.release %>/data/files.json': ['<%= dir.release %>/css/*.css','<%= dir.release %>/js/*.js','<%= dir.release %>/images/**/*.{jpg,png,gif,svg}','!<%= dir.release %>/images/avatar/*.*']
                }
            },
        },
        /*GRUNTICON*/
        watch: {
            sass: {
                files: ['<%= dir.assets %>/sass/**/*.{scss,sass}'],
                tasks: ['sass']
            },
            css: {
                files: ['<%= dir.release %>/css/*.css'],
                options: {
                    livereload: true
                }
            }
        }
    });
    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-rollup');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-postcss');
    //image stuff
    grunt.loadNpmTasks('grunt-responsive-images');
    grunt.loadNpmTasks('grunt-image');
    //svg stuff
    grunt.loadNpmTasks('grunt-svg2png');
    grunt.loadNpmTasks('grunt-svgstore');
    //olli stuff
    grunt.loadTasks('grunt_tasks/olli_dump_dir');
    // Default task(s).
    grunt.loadNpmTasks('grunt-newer');
    grunt.registerTask('images', ['newer:image:images']);
    grunt.registerTask('dev-js', ['sass:js','postcss:js','rollup', 'uglify:dev']);
    grunt.registerTask('dist-js', ['sass:js','postcss:js','rollup', 'uglify:dist']);
    grunt.registerTask('dev-css', ['sass:css', 'postcss:dev']);
    grunt.registerTask('dist-css', ['sass:css', 'postcss:dist']);

    grunt.registerTask('default', ['dist-css', 'dist-js']);
};