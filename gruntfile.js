'use strict';
/* jslint camelcase: false */

module.exports = function(grunt) {
  /**
   * Load required Grunt tasks. These are installed based on the versions listed
   * in `package.json` when you do `npm install --save-dev` in this directory.
   */
  require('load-grunt-tasks')(grunt, {scope: ['devDependencies', 'dependencies']});

  /**
   * This is the configuration object Grunt uses to give each plugin its
   * instructions.
   */
  grunt.initConfig({
    // Metadata.
    pkg: grunt.file.readJSON('package.json'),

    conf: {
      src_dir: 'src',
      dist_dir: 'SocialMediaEnhancer',
      plugin_dir: '../../_lab/wordpress/wp-content/plugins/SocialMediaEnhancer',
      vendor_files: {
        js: [],
        css: []
      }
    },

    banner: '/*! <%= pkg.title || pkg.name %> - v<%= pkg.version %> - ' +
      '<%= grunt.template.today("yyyy-mm-dd") %>\n' +
      '<%= pkg.homepage ? "* " + pkg.homepage + "\\n" : "" %>' +
      '* Copyright (c) <%= grunt.template.today("yyyy") %> <%= pkg.author.name %>;' +
      ' Licensed <%= _.pluck(pkg.licenses, "type").join(", ") %> */\n',

    sass: {
      dist: {
        options: {
          outputStyle: 'compressed'
        },
        files: {
          '<%= conf.dist_dir %>/assets/css/sme.css': '<%= conf.src_dir %>/scss/main.scss'
        }
      }
    },

    /**
     * Merging files
     */
    concat: {
      css: {
        options: {
          banner: '<%= banner %>',
          stripBanners: true,
        },
        src: [
          '<%= conf.vendor_files.css %>',
          '<%= conf.dist_dir %>/assets/css/sme.css'
        ],
        dest: '<%= conf.dist_dir %>/assets/css/sme.css'
      }
    },

    cssmin: {
      minify: {
        expand: true,
        cwd: '<%= conf.dist_dir %>/assets/css/',
        src: ['*.css', '!*.min.css'],
        dest: '<%= conf.dist_dir %>/assets/css/'
      }
    },

    jshint: {
      options: {
        node: true,
        curly: true,
        eqeqeq: true,
        immed: true,
        latedef: true,
        newcap: true,
        noarg: true,
        sub: true,
        undef: true,
        unused: true,
        boss: true,
        eqnull: true,
        browser: true,
        globals: {}
      },
      gruntfile: {
        src: 'Gruntfile.js'
      }
    },

    copy: {
      images: {
        expand: true,
        cwd: '<%= conf.src_dir %>/img/',
        src: ['**'],
        dest: '<%= conf.dist_dir %>/assets/images/'
      },
      fonts: {
        expand: true,
        cwd: '<%= conf.src_dir %>/fonts/',
        src: ['**'],
        dest: '<%= conf.dist_dir %>/assets/fonts/'
      },
      plugin: {
        expand: true,
        cwd: '<%= conf.dist_dir %>',
        src: ['**'],
        dest: '<%= conf.plugin_dir %>'
      }
    },

    /**
     * [delta description]
     */
    delta: {
      gruntfile: {
        files: '<%= jshint.gruntfile.src %>',
        tasks: ['jshint:gruntfile']
      },
      css: {
        files: '<%= conf.src_dir %>/assets/scss/**/*.scss',
        tasks: ['sass:dist', 'concat:css', 'cssmin', 'copy:plugin']
      }
    },

    /**
     * [browser_sync description]
     */
    browser_sync: {
      dev: {
        bsFiles: {
          src : [
            '<%= conf.dist_dir %>/assets/css/*.css'
          ]
        },
        options: {
          watchTask: true,
          proxy: {
            // Your existing vhost setup
            host: 'wplab.dev',
            port: 80
          }
        }
      }
    }
  });

  /**
   * register grunt tasks
   */
  grunt.registerTask('default', [
    'jshint:gruntfile',
    'sass:dist',
    'concat:css',
    'cssmin',
    'copy'
  ]);

  grunt.renameTask('watch', 'delta');

  grunt.registerTask('watch', [
    'default',
    'browser_sync',
    'delta'
  ]);
};
