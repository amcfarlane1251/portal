module.exports = function(grunt) {
  require("matchdep").filterDev("grunt-*").forEach(grunt.loadNpmTasks);
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    uglify: {
      dist:{
        files:{
          '<%= pkg.name %>/wettoolkit/dist/js/script.min.js' : '<%= pkg.name %>/wettoolkit/dist/js/script.js',
          '<%= pkg.name %>/wettoolkit/dist/js/jquery.joyride-2.1.min.js' : '<%= pkg.name %>/wettoolkit/dist/js/jquery.joyride-2.1.js',
          '<%= pkg.name %>/wettoolkit/dist/js/settings.min.js' : '<%= pkg.name %>/wettoolkit/dist/js/settings.js'
        }
      }
    },

    cssmin: {
    	dist: {
        files:{
          '<%= pkg.name %>/wettoolkit/css/styles.min.css' : '<%= pkg.name %>/wettoolkit/css/styles.css',
          '<%= pkg.name %>/wettoolkit/dist/js/css/joyride-2.1.min.css' : '<%= pkg.name %>/wettoolkit/dist/js/css/joyride-2.1.css'
        }
    	}
    },

    sass: {
    	build: {
    		files: {
    			'<%= pkg.name %>/wettoolkit/css/styles.css' : '<%= pkg.name %>/wettoolkit/css/styles.scss'
    		}
    	}
    }
  });

  // Load the plugin that provides the "uglify" task.

  // Default task(s).
  grunt.registerTask('default', ['uglify', 'sass', 'cssmin']);

  grunt.registerTask('buildcss', ['sass', 'cssmin']);

};