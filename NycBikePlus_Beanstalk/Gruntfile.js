module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    uglify: {
      options: {
        banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd HH:MM") %> */\n'
      },
      build: {
        src: 'assets/js/app.js',
        dest: 'assets/js/app.min.js'
      }
    },
    compass: {
      dist: {
        options: {
          config: 'assets/config.rb'
        }
      }
    },
    watch: {
      //options: {
      //  livereload: true
      //},
      js: {
        files: ['assets/js/app.js'], //['**/*.js'],
        tasks: ['uglify'],
        options: {
          spawn: false
        }
      },
      scss: {
        files: ['assets/scss/*'], //['**/*.js'],
        tasks: ['compass'],
        options: {
          spawn: false
        }
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-compass');

  // Default task(s).
  grunt.registerTask('default', ['watch']);

};