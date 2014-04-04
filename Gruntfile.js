// Basic Grunt configuration
module.exports = function(grunt) {

    // 1. All configuration goes here
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        // Task settings here
        // Settings for the Sass task
        sass: {
            dist: {
                options: {
                    style: 'compressed'
                },
                files: {
                    'public/assets/css/screen.css': 'dev/sass/screen.scss'
                }
            }
        },

        // compress image files
        imagemin: {
            dynamic: {
                files: [{
                    expand: true,
                    cwd: 'dev/img/layout',
                    src: ['**/*.{png,jpg,gif}'],
                    dest: 'public/assets/img/layout'
                }]
            }
        },

        imagemin: {
            dynamic: {
                files: [{
                    expand: true,
                    cwd: 'dev/img/content/',
                    src: ['**/*.{png,jpg,gif}'],
                    dest: 'public/assets/img/content'
                }]
            }
        },

        // Concat JS Files
        concat: {
            dist: {
                src: ['dev/js/libs/*.js'],
                dest: 'dev/js/main.js',
            }
        },

        // Grunt task Uglify
        uglify: {
            options: {
                banner: ''
            },
            target_1: {

                // Source file
                src: ['dev/js/main.js'],

                // Minified new file
                dest: 'public/assets/js/main.min.js'

            }
        },

        // Grunt Watch
        watch: {
            sass: {
                files: ['dev/sass/**/*.scss'],
                tasks: ['sass'],
            },
            concat: {
                files: ['dev/js/libs/*.js'],
                tasks: ['concat']
            },
            uglify: {
                files: ['dev/js/main.js'],
                tasks: ['uglify']
            },
            imagemin: {
                files: ['dev/img/content/**/*.{png,jpg,gif}', 'dev/img/layout/*.{png,jpg,gif}'],
                tasks: ['imagemin']
            },
            livereload: {
                options: {
                    livereload: true
                },
                files: [
                    'app/views/*.php',
                    'app/views/**/*.php',
                    'public/assets/css/*.css',
                    'public/assets/js/*.js'
                ]
            },

        },
    });

    // 3. Where we tell Grunt we plan to use this plug-in.
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-imagemin');
    grunt.loadNpmTasks('grunt-contrib-livereload');
    grunt.loadNpmTasks('grunt-contrib-watch');

    // 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
    grunt.registerTask('default', ['watch']);

};